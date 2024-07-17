<?php

namespace app\common\service\base;

class CurlApi
{

    public static function access_api(array $param,$url,$method = 'GET',)
    {
        $method = strtoupper($method);
        if($method == 'POST')
        {
            $options = [
                "http" => [
                    "method" => "POST",
                    "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                    "content" => http_build_query($param)
                ]
            ];
        }elseif($method == 'GET')
        {
            $options = [
                "http" => [
                    "method" => "GET",
                    "header" => "Content-type: application/x-www-form-urlencoded\r\n"
                ]
            ];
            $str = '?';
            foreach ($param as $k=>$v)
            {
                $str .= $k.'='.$v.'&';
            }
            $url = $url . $str;
        }elseif ($method == 'JSON')
        {
            $options = [
                "http" => [
                    "method" => "POST",
                    "header" => "Content-type: application/json\r\n",
                    "content" => json_encode($param),
                ]
            ];
        } else
        {
            return false;
        }

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        if ($response !== FALSE) {
            return json_decode($response, true);
        } else {
            echo "Error accessing the API.";
            return false;
        }
    }

    //检测地址是否有效
    public static function isUrlValid($url) {
        // 初始化 cURL 会话
        $ch = curl_init();

        // 设置 cURL 选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 返回响应而不是直接输出
        curl_setopt($ch, CURLOPT_HEADER, 1); // 返回头信息
        curl_setopt($ch, CURLOPT_NOBODY, 1); // 不返回响应体
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 设置请求超时时间
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 跟随重定向

        // 执行 cURL 请求
        $response = curl_exec($ch);

        // 检查HTTP状态码
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // 关闭 cURL 会话
        curl_close($ch);

        // 返回检测结果：状态码为200表示有效
        if ($httpCode == 200) {
            return true;
        } else {
            return false;
        }
    }

}