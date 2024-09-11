<?php
namespace Meituan\Model\Coupon;
use Meituan\Mtclient\MeituanClient;

const COUPON_CANCEL_URL = "/tuangou/coupon/cancel";
/**
 * 撤销验券
 * This file was automatically generated.
 */
class CouponCancelResponse {
    public $code;
    public $msg;
    public $data; // 这里将是一个CouponCancelData的实例  
    public $traceId;
}

class CouponCancelData {
    /**
     * 操作状态0表示成功，其余表示失败
     */
    public $result;
    /**
     * 撤销结果描述信息
     */
    public $message;
}

class CouponCancelRequest {
    /**
     * 商家登录ERP帐号ID，长度不超过32。
     */
    public $eId;
    /**
     * 商家登录ERP帐号名称，长度不超过32位
     */
    public $eName;
    /**
     * type值永远为1撤销验券
     */
    public $type = 1; // 如果type总是1，可以考虑不设为公开属性或设为常量  
    /**
     * 券码
     */
    public $couponCode;
    public function doInvoke(MeituanClient $client, string $appAuthToken): CouponCancelResponse {
        return $client->invokeApi(COUPON_CANCEL_URL, 1, $appAuthToken, $this::class);
    }
}