<?php

namespace lycecho\meituan\util;

class SignUtil
{
    /**
     * 计算请求的签名
     *
     * @param array $param 请求参数
     * @param string $signKey 签名密钥
     * @return string 签名
     * @throws \Exception
     */
    public static function calculateSign(array $param, $signKey)
    {
        $sortedString = self::getSortedString($param, $signKey);
        return self::sha1Encode($sortedString);
    }

    /**
     * 获取排序后的字符串
     *
     * @param array $param 请求参数
     * @param string $signKey 签名密钥
     * @return string 排序后的字符串
     */
    private static function getSortedString(array $param, $signKey)
    {
        $keys = array_filter(array_keys($param), function ($key) use ($param) {
            return !empty($param[$key]);
        });

        sort($keys);

        $sortedString = $signKey;
        foreach ($keys as $key) {
            $sortedString .= $key . $param[$key];
        }

        return $sortedString;
    }

    /**
     * 计算 SHA1
     *
     * @param string $data 数据
     * @return string SHA1 值
     * @throws \Exception
     */
    private static function sha1Encode($data)
    {
        if (!function_exists('sha1')) {
            throw new \Exception('SHA1 function not available');
        }
        return strtolower(sha1($data, false));
    }
}
