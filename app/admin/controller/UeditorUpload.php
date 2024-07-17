<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\common\model\UploadFilesModel;
use think\exception\HttpResponseException;

class UeditorUpload extends AdminBase
{
    public function index()
    {
        $action = htmlspecialchars($this->request->get('action'));

        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(public_path()."static/admin/ueditor/php/config.json")), true);

        switch ($action) {
            case 'config':
                $result =  $CONFIG;
                break;

            /* 上传图片 */
            case 'uploadimage':
                $folder_name = $this->request->param('folder_name/s','ueditor');
                $data = (new UploadFilesModel())->upload($folder_name,1,0,'upfile');
                $result = [
                    'original' => $data['original'],
                    'size' => $data['file_size'],
                    'state' => 'SUCCESS',
                    'title' => $data['file_name'],
                    'type' => '',
                    'url' => $data['file'],
                ];
                break;
                /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':
                break;

            /* 列出图片 */
            case 'listimage':
                $size = $this->request->get('size');
                $start = $this->request->get('start');
                $list = UploadFilesModel::where('app', 1)
                    ->whereIn('extension', ['jpg','jpeg','png','gif','bmp'])
                    ->field('url')
                    ->limit($start,$size)
                    ->order('id desc')
                    ->select();
                $total = UploadFilesModel::where('app', 1)
                    ->count();
                $result = [
                    'state' => 'SUCCESS',
                    'list'  => $list,
                    'start' => $start,
                    'total' => $total
                ];
                break;
            /* 列出文件 */
            case 'listfile':
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                break;

            default:
                $result = array(
                    'state'=> '请求地址出错'
                );
                break;
        }

        $response = json($result);
        throw new HttpResponseException($response);
    }
}