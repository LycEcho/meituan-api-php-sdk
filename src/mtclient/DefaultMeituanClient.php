<?php

namespace lycecho\meituan\mtclient;
use lycecho\meituan\apiError\ApiError;
use lycecho\meituan\constants\Constants;
use lycecho\meituan\util\SignUtil;

class DefaultMeituanClient implements MeituanClient
{
    // 保存类的唯一实例
    private static $instance = null;
    private int $developerId;
    private string $signKey;
    private $httpClient;

    private const CHARSET = 'UTF-8';
    private const VERSION = '2';
    private const MEITUAN_OPEN_DOMAIN = 'https://api-open-cater.meituan.com';

    public function __construct(int $developerId, string $signKey, int $timeoutSec = 8)
    {
        $this->developerId = $developerId;
        $this->signKey = $signKey;
        $this->httpClient = $this->createHttpClient($timeoutSec);
    }

    private function createHttpClient(int $timeoutSec)
    {
        $httpClient = curl_init();
        curl_setopt($httpClient, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($httpClient, CURLOPT_TIMEOUT, $timeoutSec);
        return $httpClient;
    }

    private function getPublicProperties(string $className): array {
        // 检查类是否存在
        if (!class_exists($className)) {
            throw new \InvalidArgumentException("Class {$className} does not exist.");
        }

        // 创建一个\ReflectionClass实例
        $reflectionClass = new \ReflectionClass($className);

        // 获取所有属性，包括public, protected, 和 private
        $properties = $reflectionClass->getProperties();

        // 过滤出所有public属性
        $publicProperties = [];
        foreach ($properties as $property) {
            // 如果属性是public的，则添加到$publicProperties数组中
            if ($property->isPublic()) {
                $publicProperties[] = $property->getName();
            }
        }

        // 返回所有public属性的名称数组
        return $publicProperties;
    }

    public function invokeApi(string $apiPath, int $businessId, string $appAuthToken, mixed $data): string
    {
        if(is_string($data)){
            $data = $this->getPublicProperties($data);
        }

        $paramMap = $this->buildRequestParam($businessId, $appAuthToken, $data);
        $encodedData = $this->encodeParamMap($paramMap);

        $url = self::MEITUAN_OPEN_DOMAIN . $apiPath;

        curl_setopt($this->httpClient, CURLOPT_URL, $url);
        curl_setopt($this->httpClient, CURLOPT_POST, true);
        curl_setopt($this->httpClient, CURLOPT_POSTFIELDS, $encodedData);
        curl_setopt($this->httpClient, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Sdk-Info: php-sdk',
            'DeveloperId: ' . $paramMap['developerId']
        ]);

        $response = curl_exec($this->httpClient);
        if ($response === false) {
            throw new \Exception(curl_error($this->httpClient));
        }

        $response = json_decode($response);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Failed to parse response: " . json_last_error_msg());
        }

        if ($response->code !== Constants::SUCCESS_CODE) {
            throw new ApiError($response->code, $response->msg, $response->traceId);
        }

        return $response;
    }

    /**
     * @function getToken 暂时用不到 oauth使用
     * @param int $businessId
     * @param string $code
     * @return string
     * @throws \Exception
     */
    public function getToken(int $businessId, string $code): string
    {
        $paramMap = [
            'timestamp' => time(),
            'businessId' => $businessId,
            'developerId' => $this->developerId,
            'charset' => self::CHARSET,
            'code' => $code,
            'grantType' => 'authorization_code'
        ];

        $sign = SignUtil::calculateSign($paramMap, $this->signKey);
        $paramMap['sign'] = $sign;

        $encodedData = $this->encodeParamMap($paramMap);

        curl_setopt($this->httpClient, CURLOPT_URL, self::MEITUAN_OPEN_DOMAIN . '/oauth/token');
        curl_setopt($this->httpClient, CURLOPT_POSTFIELDS, $encodedData);
        curl_setopt($this->httpClient, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Sdk-Info: php-sdk',
            'DeveloperId: ' . $paramMap['developerId']
        ]);

        $response = curl_exec($this->httpClient);
        if ($response === false) {
            throw new \Exception(curl_error($this->httpClient));
        }

        return $response;
    }

    /**
     * @function refreshToken 暂时用不到 oauth使用
     * @param int $businessId
     * @param string $refreshToken
     * @return string
     * @throws \Exception
     */
    public function refreshToken(int $businessId, string $refreshToken): string
    {
        $paramMap = [
            'timestamp' => time(),
            'businessId' => $businessId,
            'developerId' => $this->developerId,
            'charset' => self::CHARSET,
            'refreshToken' => $refreshToken,
            'grantType' => 'refresh_token',
            'scope' => 'all'
        ];

        $sign = SignUtil::calculateSign($paramMap, $this->signKey);
        $paramMap['sign'] = $sign;

        $encodedData = $this->encodeParamMap($paramMap);

        curl_setopt($this->httpClient, CURLOPT_URL, self::MEITUAN_OPEN_DOMAIN . '/oauth/refresh');
        curl_setopt($this->httpClient, CURLOPT_POSTFIELDS, $encodedData);
        curl_setopt($this->httpClient, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Sdk-Info: php-sdk',
            'DeveloperId: ' . $paramMap['developerId']
        ]);

        $response = curl_exec($this->httpClient);
        if ($response === false) {
            throw new \Exception(curl_error($this->httpClient));
        }

        return $response;
    }

    private function buildRequestParam(int $businessId, string $appAuthToken, mixed $data = null): array
    {
        $paramMap = [
            'timestamp' => time(),
            'businessId' => $businessId,
            'developerId' => $this->developerId,
            'charset' => self::CHARSET,
            'version' => self::VERSION
        ];

        if ($data !== null) {
            $paramMap['biz'] = json_encode($data);
        }

        if ($appAuthToken !== '') {
            $paramMap['appAuthToken'] = $appAuthToken;
        }

        $sign = SignUtil::calculateSign($paramMap, $this->signKey);
        $paramMap['sign'] = $sign;

        return $paramMap;
    }

    private function encodeParamMap(array $paramMap): string
    {
        return http_build_query($paramMap);
    }
}
