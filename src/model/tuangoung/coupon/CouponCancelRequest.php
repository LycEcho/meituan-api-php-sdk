<?php
namespace lycecho\meituan\model\tuangoung\coupon;
use lycecho\meituan\mtclient\MeituanClient;

const COUPON_CANCEL_URL = "/tuangou/coupon/cancel";
/**
 * 撤销验券
 * This file was automatically generated.
 */
class CouponCancelData {
    /**
     * @var int 操作状态0表示成功，其余表示失败
     */
    public $result;

    /**
     * @var string 撤销结果描述信息
     */
    public $message;
}

class CouponCancelResponse {
    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $msg;

    /**
     * @var CouponCancelData
     */
    public $data;

    /**
     * @var string
     */
    public $traceId;

}

class CouponCancelRequest {
    /**
     * @var string 商家登录ERP帐号ID，长度不超过32。
     */
    public $eId;

    /**
     * @var string 商家登录ERP帐号名称，长度不超过32位
     */
    public $eName;

    /**
     * @var int type值永远为1撤销验券
     */
    public $type = 1; // 默认值为1

    /**
     * @var string 券码
     */
    public $couponCode;

    // 构造函数
    public function doInvoke(MeituanClient $client, string $appAuthToken): CouponCancelResponse {
        return $client->invokeApi(COUPON_CANCEL_URL, 1, $appAuthToken, $this::class);
    }

}
