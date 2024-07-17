<?php

namespace app\common\service;



class Crpy
{

    const KEY = 'c5ebd10dbb94f9738d4336eeb59fb9a246ea228a9b56c28ce6cff0a566954d481';
    // 加密函数
    public static function encrypt($data) {
        $cipher = "aes-256-cbc";  // 加密算法
        $ivlen = openssl_cipher_iv_length($cipher); // 初始化向量长度
        $iv = openssl_random_pseudo_bytes($ivlen);  // 生成初始化向量

        $ciphertext_raw = openssl_encrypt($data, $cipher, self::KEY, $options=OPENSSL_RAW_DATA, $iv);  // 加密
        $hmac = hash_hmac('sha256', $ciphertext_raw, self::KEY, $as_binary=true);  // 生成HMAC

        return base64_encode($iv . $hmac . $ciphertext_raw);  // 返回加密数据
    }

    // 解密函数
    public static function decrypt($data) {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $data = base64_decode($data);

        $iv = substr($data, 0, $ivlen);  // 提取初始化向量
        $hmac = substr($data, $ivlen, $sha2len=32);  // 提取HMAC
        $ciphertext_raw = substr($data, $ivlen + $sha2len);  // 提取加密数据

        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, self::KEY, $options=OPENSSL_RAW_DATA, $iv);  // 解密

        // 验证HMAC以确保数据完整性
        $calcmac = hash_hmac('sha256', $ciphertext_raw, self::KEY, $as_binary=true);
        if (hash_equals($hmac, $calcmac)) {  // PHP 5.6+ hash_equals 安全对比
            return $original_plaintext;
        }
        return false;  // 验证失败
    }

}