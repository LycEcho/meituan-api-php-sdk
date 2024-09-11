<?php
namespace lycecho\meituan\model\tuangoung\coupon;
use lycecho\meituan\mtclient\MeituanClient;
/**
 * 执行验券
 * This file was automatically generated.
 */
const COUPON_CONSUME_URL = "/tuangou/coupon/consume";


/**
 * Class CouponConsumeResponse
 * 对应Go语言中的CouponConsumeResponse结构体
 */
class CouponConsumeResponse
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
     * @var CouponConsumeInfo 数据体
     */
    public $data;

    /**
     * @var string 跟踪ID
     */
    public $traceId;
}

/**
 * Class CouponConsumeInfo
 * 对应Go语言中的CouponConsumeInfo结构体
 */
class CouponConsumeInfo
{
    /**
     * @var string[] 验证券码数组
     */
    public $couponCodes = [];

    /**
     * @var int 操作状态
     */
    public $result;

    /**
     * @var int64 项目ID
     * 注意：PHP中没有int64类型，这里使用int或string代替，取决于实际数值大小和精度需求
     */
    public $dealId; // 或者使用字符串 public $dealIdStr = '';

    /**
     * @var string 项目名称
     */
    public $dealTitle;

    /**
     * @var int64 美团门店ID
     * 注意：同上，PHP中没有int64类型
     */
    public $poiid; // 或者使用字符串 public $poiidStr = '';

    /**
     * @var string 返回值消息
     */
    public $message;

    /**
     * @var string 开店宝套餐名
     */
    public $rawTitle;

    /**
     * @var string 团购项目在App端的展示标题
     */
    public $platformTitle;

    /**
     * @var float 券面值，即人们常说的市场价
     */
    public $dealValue;
}

/**
 * Class CouponConsumeRequest
 * 对应Go语言中的CouponConsumeRequest结构体
 */
class CouponConsumeRequest
{
    /**
     * @var string 商家登录ERP帐号ID
     */
    public $eId;

    /**
     * @var string 商家登录ERP帐号名称
     */
    public $eName;

    /**
     * @var string 第三方ERP订单号
     */
    public $eOrderId;

    /**
     * @var int 数量
     */
    public $count;

    /**
     * @var string 券码
     */
    public $couponCode;
}


/**
 * Class MsSuperConsumeRequest
 */
class MsSuperConsumeRequest
{
    /**
     * @var string 券码
     */
    public $code;

    /**
     * @var int 核销张数（支持该券码关联的订单下其他券码一起核销，核销本张券码传1）
     */
    public $num;
    public function doInvoke(MeituanClient $client, string $appAuthToken): CouponConsumeResponse
    {
        return $client->invokeApi(COUPON_CONSUME_URL, 1, $appAuthToken, $this::class);
    }
}