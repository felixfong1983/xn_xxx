<?php
// 应用公共文件

/**
 * 字节数Byte转换为KB、MB、GB、TB
 * @param int $size
 * @return string
 */
function xn_file_size($size){
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $units[$i];
}

/**
 * 密码加密函数
 * @param $password
 * @return string
 */
function xn_encrypt($password, $salt='')
{
    if (empty($salt)) {
        $salt = 'xiaoniu_admin';
    }
    return md5(md5($password.$salt));
}

/**
 * 管理员操作日志
 * @param $remark
 */
function xn_add_admin_log($remark)
{
    $data = [
        'admin_id' => session('admin_auth.id'),
        'url' => request()->url(true),
        'ip' => request()->ip(),
        'remark' => $remark,
        'method' =>request()->method(),
        'param' => json_encode(request()->param()),
        'create_time' => time()
    ];
    \app\common\model\AdminLogModel::insert($data);
}

/**
 * 获取自定义config/cfg目录下的配置
 * 用法： xn_cfg('base') 或 xn_cfg('base.website') 不支持无限极
 * @param string|null $name
 * @param string|null $default
 * @param string|null $path
 * @return array|string
 */
function xn_cfg($name, $default='', $path='cfg')
{
    if (false === strpos($name, '.')) {
        $name = strtolower($name);
        $config  = \think\facade\Config::load($path.'/'.$name, $name);
        return $config ?? [];
    }
    $name_arr    = explode('.', $name);
    $name_arr[0] = strtolower($name_arr[0]);
    $filename = $name_arr[0];
    $config  = \think\facade\Config::load($path.'/'.$filename, $filename);
    return $config[$name_arr[1]] ?? $default;
}

/**
 * 构建图片上传HTML 单图
 * @param string $value
 * @param string $file_name
 * @param null $water 是否添加水印 null-系统配置设定 1-添加水印 0-不添加水印
 * @param null $thumb 生成缩略图，传入宽高，用英文逗号隔开，如：200,200（仅对本地存储方式生效，七牛、oss存储方式建议使用服务商提供的图片接口）
 * @return string
 */
function xn_upload_one($value,$file_name,$water=null,$thumb=null)
{
$html=<<<php
    <div class="xn-upload-box">
        <div class="t layui-col-md12 layui-col-space10">
            <input type="hidden" name="{$file_name}" class="layui-input xn-images" value="{$value}">
            <div class="layui-col-md12">
                <div type="button" class="layui-btn webuploader-container" id="{$file_name}" data-water="{$water}" data-thumb="{$thumb}" style="width: 113px;"><i class="layui-icon layui-icon-picture"></i>上传图片</div>
                <div type="button" class="layui-btn chooseImage" data-num="1"><i class="layui-icon layui-icon-table"></i>选择图片</div>
            </div>
        </div>
        <ul class="upload-ul clearfix">
            <span class="imagelist"></span>
        </ul>
        <script>$('#{$file_name}').uploadOne();</script>
    </div>
php;
    return $html;
}

/**
 * 构建图片上传HTML 多图
 * @param string $value
 * @param string $file_name
 * @param null $water 是否添加水印 null-系统配置设定 1-添加水印 0-不添加水印
 * @param null $thumb 生成缩略图，传入宽高，用英文逗号隔开，如：200,200（仅对本地存储方式生效，七牛、oss存储方式建议使用服务商提供的图片接口）
 * @return string
 */
function xn_upload_multi($value,$file_name,$water=null,$thumb=null)
{
    $html=<<<php
    <div class="xn-upload-box">
        <div class="t layui-col-md12 layui-col-space10">
            <div class="layui-col-md8">
                <input type="text" name="{$file_name}" class="layui-input xn-images" value="{$value}">
            </div>
            <div class="layui-col-md4">
                <div type="button" class="layui-btn webuploader-container" id="{$file_name}" data-water="{$water}" data-thumb="{$thumb}" style="width: 113px;"><i class="layui-icon layui-icon-picture"></i>上传图片</div>
                <div type="button" class="layui-btn chooseImage"><i class="layui-icon layui-icon-table"></i>选择图片</div>
            </div>
        </div>
        <ul class="upload-ul clearfix">
            <span class="imagelist"></span>
        </ul>
        <script>$('#{$file_name}').upload();</script>
    </div>
php;
    return $html;
}

/**
 * 错误信息 - 为API设计的返回错误信息的方法
 * @param string $msg
 * @param int $code
 * @param array $data
 */
function retError($msg = 'fail', $code = 0, $data = [])
{
    $result = [
        'msg'  => $msg,
        'code' => $code,
        'data' => $data
    ];
    $response = json($result);
    throw new \think\exception\HttpResponseException($response);
}

/**
 * 成功信息 - 为API设计的返回数据的方法
 * @param array $data
 * @param string $msg
 * @param int $code
 */
function retSuccess($data = [], $msg = 'success', $code = 1)
{
    $result = [
        'data' => $data,
        'msg'  => $msg,
        'code' => $code
    ];
    $response = json($result);
    throw new \think\exception\HttpResponseException($response);
}

/**
 * 打印数据
 * @param array|string $data
 *
 */
function p($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
