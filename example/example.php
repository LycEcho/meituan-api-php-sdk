<?php
require "./vendor/autoload.php";
use lycecho\meituan\mtclient\DefaultMeituanClient;
use lycecho\meituan\model\tuangoung\coupon\QueryCouponByIdRequest;

// 使用示例
$client = new DefaultMeituanClient(100567, '***signKey***');
$appAuthToken = 'xxxxxxxxxx';

$request = new QueryCouponByIdRequest();
$request->couponCode = 12345;
try {
    $response = $request->doInvoke($client, $appAuthToken);
    $data = $response->data;
    echo "接口调用成功，得到响应: " . json_encode($data) . "\n";
} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
}