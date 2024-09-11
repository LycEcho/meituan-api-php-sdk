<?php
namespace Meituan\Model\Coupon;
use Meituan\Mtclient\MeituanClient;

/**
 * 已验券码查询
 * This file was automatically generated.
 */

const QUERY_COUPON_BY_ID_URL = "/tuangou/coupon/queryById";

/**
 * QueryCouponByIdData 数据类
 */
class QueryCouponByIdData
{
    /**
     * 团购券码购买价格
     * @var float
     */
    public $couponBuyPrice;

    /**
     * 券码是否可撤销，1表示可撤销，0表示不可撤销
     * @var int
     */
    public $couponCancelStatus;

    /**
     * 券码
     * @var string
     */
    public $couponCode;

    /**
     * 券状态
     * @var string
     */
    public $couponStatusDesc;

    /**
     * 券码使用时间
     * @var string
     */
    public $couponUseTime;

    /**
     * 项目开始时间
     * @var string
     */
    public $dealBeginTime;

    /**
     * 项目id
     * @var int
     */
    public $dealId;

    /**
     * 项目名称
     * @var string
     */
    public $dealTitle;

    /**
     * 市场价
     * @var float
     */
    public $dealValue;

    /**
     * 是否代金券，true代表代金券,false代表套餐券
     * @var bool
     */
    public $isVoucher;

    /**
     * 量贩项目的单张券原价（普通券单张券原价与项目总价相同）
     * @var float
     */
    public $singleValue;

    /**
     * 验券帐号
     * @var string
     */
    public $verifyAcct;

    /**
     * 验券方式
     * @var string
     */
    public $verifyType;

    /**
     * 是否量贩：0：不是，1：是
     * @var int
     */
    public $volume;
}

/**
 * QueryCouponByIdResponse 响应类
 */
class QueryCouponByIdResponse
{
    /**
     * 响应码
     * @var string
     */
    public $code;

    /**
     * 响应信息
     * @var string
     */
    public $msg;

    /**
     * 响应数据
     * @var QueryCouponByIdData
     */
    public $data;

    /**
     * 跟踪ID
     * @var string
     */
    public $traceId;

}


/**
 * QueryCouponByIdRequest 请求类
 */
class QueryCouponByIdRequest
{
    /**
     * 券码
     * @var string
     */
    public $couponCode;
    public function doInvoke(MeituanClient $client, string $appAuthToken): QueryCouponByIdResponse {
        return $client->invokeApi(QUERY_COUPON_BY_ID_URL, 1, $appAuthToken, $this::class);
    }
}
