<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\common\model;

use think\exception\ValidateException;
use think\facade\Filesystem;
use think\facade\Session;
use think\Image;
use think\Model;

class UploadFilesModel extends Model
{
    protected $name = 'upload_files';

    /**
     * 获取器 - 文件上传来自应用名
     * @param $value
     * @return mixed
     */
    public function getAppAttr($value)
    {
        $status = [0=>'前台',1=>'后台'];
        return $status[$value];
    }

    /**
     * 获取器 - 格式化文件大小
     * @param $value
     * @return string
     */
    public function getFileSizeAttr($value)
    {
        return xn_file_size($value);
    }

    /**
     * 上传方法
     * @param $folder_name string 存储文件夹名称
     * @param $app int 0前台用户  1后台管理员
     * @param $user_id int 上传人ID: $app参数为0时属于前台用户ID $app参数为1为管理员ID
     * @param $file string 固定值
     * @param $exts array 允许上传的文件后缀
     * @return array
     */
    public function upload($folder_name='files',$app=1, $user_id=0, $file='file', $exts=[])
    {
        if( $app==1 && $user_id==0 ) {
            $user_id = intval(Session::get('admin_auth.id'));
        }

        //允许的格式
        if( empty($exts) ) {
            $exts = ['png','jpg','jpeg','gif','bmp','doc','docx','csv','xls','xlsx','xlsm','pdf'];
        }

        validate(['image'=>'filesize:10240|fileExt:jpg|image:200,200,jpg'])
            ->check(request()->file());

        try {
            $param = request()->param();

            $file = request()->file($file);
            //文件后缀名
            $ext = $file->getOriginalExtension();
            //配置信息
            $config = xn_cfg('upload');
            //存储类型
            $storage = $config['storage'];

            if( !in_array( strtolower($ext), $exts ) ) {
                return ['code'=>0,'msg'=>'格式不允许'];
            }

            //图片水印处理
            if( in_array( strtolower($ext), ['png','jpg','jpeg','gif','bmp'] ) ) {
                if( self::setWater($file,$param['water']) === false ) {
                    return ['code'=>0,'msg'=>'水印配置有误'];
                }
            }

            //上传到本地服务器
            $savename = Filesystem::disk('public')->putFile($folder_name,$file);
            if (!$savename) {
                return ['code'=>0,'msg'=>'上传失败'];
            }
            $file_path = config('filesystem.disks.public.url') . '/'. str_replace("\\","/",$savename);

            //缩略图
            if( $param['thumb']!='' ) {
                self::createThumb($file,$param['thumb'],$savename);
            }

            //记录入文件表
            $extension = strtolower(pathinfo($file->getOriginalName(), PATHINFO_EXTENSION));
            $insert_data = [
                'url' => $file_path,
                'storage' => $storage,
                'app' => $app,
                'user_id' => $user_id,
                'file_name' => $file->getOriginalName(),
                'file_size' => $file->getSize(),
                'file_type' => 'image',
                'extension' => $extension,
                'create_time' => time()
            ];
            $insert = self::create($insert_data);

            return ['code'=>1,'insert_id'=>$insert['id'],'file'=>$file_path,'file_name'=>$file->getOriginalName(),'file_size'=>$file->getSize(),'ext'=>$extension];
        } catch (ValidateException $e) {
            return ['code'=>0,'msg'=>$e->getMessage()];
        }
    }

    //删除服务器物理文件
    public function delStorageFile($storage, $file_path)
    {
        if( $storage == 'local' ) {
            //删除本地服务器文件
            $file_path = public_path().ltrim($file_path,'/');
            if( file_exists($file_path) ) {
                unlink($file_path);
            }
        }
    }

    /**
     * 图片添加水印
     * @param $file
     * @param null $is_water
     */
    public function setWater($file,$is_water=null)
    {
        if( $is_water=='0' ) {
            return true;
        }
        $config = xn_cfg('upload');
        //图片水印
        if( $config['is_water']==1 || $is_water=='1' ) {
            $water_path = public_path().ltrim($config['water_img'],'/');
            if( !file_exists($water_path) ) {
                return false;
            }
            $image = Image::open($file);
            $image->water($water_path, $config['water_locate'], $config['water_alpha']);
            $image->save($file->getPathName());
        }
        return true;
    }

    /**
     * 生成缩略图
     * @param object $file
     * @param string $thumb 缩略图格式,如 200,200  多张用 | 好隔开
     * @param string $save_path 保存文件的路径
     */
    public function createThumb($file,$thumb,$save_path)
    {
        $thumbs = explode('|',$thumb);
        foreach ($thumbs as $w_h) {
            $arr = explode('.',$save_path);
            $w_h = explode(',',$w_h);
            $thumb_name = $arr[0].'_'.$w_h[0].'_'.$w_h[1].'.'.$arr[1];
            $image = Image::open($file);
            $image->thumb($w_h[0],$w_h[1],3);
            $image->save(public_path().$thumb_name);
        }
    }
}