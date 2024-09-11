<?php

/**
 * 提供开放平台的预验券接口，聚合商品数据信息
 * This file was automatically generated.
 */
namespace Meituan\Model\Coupon;
use Meituan\Mtclient\MeituanClient;

const ms_super_prepare_url = "/tuangou/ng/coupon/msprepare";

/**
 * ReceiptPrepareMSDTO 数据传输对象
 */
class ReceiptPrepareMSDTO
{
    /**
     * 项目开始时间
     * @var string
     */
    public $dealBeginTime;

    /**
     * 项目ID
     * @var int
     */
    public $dealId;

    /**
     * 券面值，即人们常说的市场价
     * @var float
     */
    public $dealValue;

    /**
     * 项目名称
     * @var string
     */
    public $dealTitle;

    /**
     * 最大可验证张数
     * @var int
     */
    public $count;

    /**
     * 量贩项目的单张券原价（普通券单张券原价与项目总价相同）
     * @var float
     */
    public $singleValue;

    /**
     * 团购券价格，即商家促销前的券购买价格
     * @var float
     */
    public $dealPrice;

    /**
     * 套餐类券码对应套餐详细内容，代金券券码包含适用范围
     * @var string
     */
    public $dealMenu;

    /**
     * 返回消息
     * @var string
     */
    public $message;

    /**
     * 最小消费张数
     * @var int
     */
    public $minConsume;

    /**
     * 券码有效期
     * @var string
     */
    public $couponEndTime;

    /**
     * 是否量贩：0：不是，1：是
     * @var int
     */
    public $volume;

    /**
     * 操作状态,0表示成功
     * @var int
     */
    public $result;

    /**
     * 券购买价,即用户在购买团购券时所付的实际价格
     * @var float
     */
    public $couponBuyPrice;

    /**
     * 券码
     * @var string
     */
    public $couponCode;

    /**
     * 是否代金券,true代表代金券,false代表套餐券
     * @var bool
     */
    public $vourcher; // 注意：这里应该是 "voucher" 而不是 "vourcher"，可能是个拼写错误

    /**
     * 开店宝套餐名
     * @var string
     */
    public $rawTitle;

    /**
     * 开店宝商品列表标题
     * @var string
     */
    public $platformTitle;

    /**
     * 第三方商品ID
     * @var string
     */
    public $thirdProductId;

    /**
     * C端场景中提单页、支付结果页等页面的项目标题
     * @var string
     */
    public $shortAttrTitle;

    /**
     * 返参内容与dealMenu一致，仅解析结构不同
     * @var string
     */
    public $dealMenuStd;
}
/**
 * MsSuperPrepareResponse 响应类
 */
class MsSuperPrepareResponse
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
     * @var ReceiptPrepareMSDTO
     */
    public $data;

    /**
     * 跟踪ID
     * @var string
     */
    public $traceId;

}


/**
 * MsSuperPrepareRequest 请求类
 */
class MsSuperPrepareRequest
{
    /**
     * 券码
     * @var string
     */
    public $code;
    public function doInvoke(MeituanClient $client, string $appAuthToken): MsSuperPrepareResponse {
        return $client->invokeApi(ms_super_prepare_url, 1, $appAuthToken, $this::class);
    }
}
