<?php
/**
 * 门店验券历史
 * This file was automatically generated.
 */

namespace lycecho\meituan\model\tuangoung\coupon;
use lycecho\meituan\mtclient\MeituanClient;


const COUPON_QUERY_LIST_BY_DATE_URL = "/tuangou/coupon/queryListByDate";

/**
 * 门店验券历史响应
 */
class CouponQueryListByDateResponse
{
    /**
     * @var string 响应码
     */
    public $code;

    /**
     * @var string 响应消息
     */
    public $msg;

    /**
     * @var CouponQueryListByDateData 数据
     */
    public $data;

    /**
     * @var string 跟踪ID
     */
    public $traceId;
}

/**
 * 门店验券历史响应数据
 */
class CouponQueryListByDateData
{
    /**
     * @var \CouponCodes 团购券码列表
     */
    public $couponCodes;

    /**
     * @var int 总数量
     */
    public $total;
}

/**
 * 团购券信息
 */
class CouponCodes
{
    /**
     * @var float 团购券购买价格
     */
    public $couponBuyPrice;

    /**
     * @var int 团购券是否可撤销。1表示可撤销，0表示不可撤销
     */
    public $couponCancelStatus;

    /**
     * @var string 团购券码
     */
    public $couponCode;

    /**
     * @var string 团购券状态，包含：未使用、已使用、已冻结、作弊已冻结、已退款
     */
    public $couponStatusDesc;

    /**
     * @var string 验券时间
     */
    public $couponUseTime;

    /**
     * @var string 团购券对应项目开始售卖时间
     */
    public $dealBeginTime;

    /**
     * @var string 项目对应的标题
     */
    public $dealTitle;

    /**
     * @var float 项目售卖价
     */
    public $dealValue;

    /**
     * @var int 是否验证支付
     */
    public $isVerifyPay;

    /**
     * @var bool 是否为代金券
     */
    public $isVoucher;

    /**
     * @var string 验券帐号
     */
    public $verifyAcct;

    /**
     * @var string 验券方式
     */
    public $verifyType;
}

/**
 * 门店验券历史请求
 */
class CouponQueryListByDateRequest
{
    /**
     * @var string 日期
     */
    public $date;

    /**
     * @var int 查询起始位置，从0开始
     */
    public $offset;

    /**
     * @var int 查询条数
     */
    public $limit;

    public function doInvoke(MeituanClient $client, string $appAuthToken)
    : CouponQueryListByDateResponse
    {
        return $client->invokeApi(COUPON_QUERY_LIST_BY_DATE_URL, 1, $appAuthToken, $this::class);
    }
}
