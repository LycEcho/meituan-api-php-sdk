<?php

namespace Meituan\Mtclient;

interface MeituanClient
{
    /**
     * 自定义路径和参数调用美团API
     *
     * @param string $apiPath API 路径，例如 /waimai/order/queryById
     * @param int $businessId 业务 ID
     * @param string $appAuthToken 应用授权令牌
     * @param mixed $data 业务参数，可以是数组或对象
     * @return string 返回的响应数据
     * @throws \Exception
     */
    public function invokeApi(string $apiPath, int $businessId, string $appAuthToken, mixed $data):string;

    /**
     * 获取令牌
     *
     * @param int $businessId 业务 ID
     * @param string $code 授权码
     * @return string 返回的响应数据
     * @throws \Exception
     */
    public function getToken(int $businessId, string $code):string;

    /**
     * 刷新令牌
     *
     * @param int $businessId 业务 ID
     * @param string $refreshToken 刷新令牌
     * @return string 返回的响应数据
     * @throws \Exception
     */
    public function refreshToken(int $businessId, string $refreshToken):string;

}
