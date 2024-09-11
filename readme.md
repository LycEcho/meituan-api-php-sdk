# 美团开放平台 php-sdk-api
## 提示
本php版本是根据官方go版本修改封装的、只修改了作者使用的功能、剩下的可以放到gpt让他给你转换

## 官方go版本sdk连接
[https://developer.meituan.com/admin#/sdk/download](https://developer.meituan.com/admin#/sdk/download)

# 命令安装
```
composer require lycecho/meituan
```

## 已支持接口
### 生活服务 - 到店餐饮 - 团购API - 团购核销
| 状态 | 功能 | api链接 |
|-|-|-------|
|✅|已验券码查询|   tuangou/coupon/queryById    |
|✅|验券准备(新)|  tuangou/ng/coupon/msprepare     |
|✅|执行验券(新)|    tuangou/ng/coupon/msconsume   |
|✅|撤销验券|   tuangou/coupon/cancel    |
|✅|门店验券历史|  tuangou/coupon/queryListByDate     |

# 使用示例
```
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
```