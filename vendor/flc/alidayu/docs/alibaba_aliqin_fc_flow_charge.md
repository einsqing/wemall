# 流量直充

`\Flc\Alidayu\Requests\AlibabaAliqinFcFlowCharge`

## 1. 官方文档

http://open.taobao.com/docs/api.htm?apiId=26306

## 2. 参数、方法

|官方参数|对应方法|类型|是否必须|默认值|说明|
|----|----|----|----|----|----|
|`phone_num`|`setPhoneNum($value)`|string|**必须**| |手机号|
|`reason`|`setReason($value)`|string|可选| |充值原因|
|`grade`|`setGrade($value)`|string|**必须**| |需要充值的流量|
|`out_recharge_id`|`setOutRechargeId($value)`|string|**必须**| |唯一流水号|

## 3. 使用

```php
<?php
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcFlowCharge;

// 配置信息
$config = [
    'app_key'    => '*****',
    'app_secret' => '************',
];

$client = new Client(new App($config));
$req = new AlibabaAliqinFcFlowCharge;

$req->setPhoneNum('13312311231')
    ->setGrade('50')
    ->setOutRechargeId('111111');

print_r($client->execute($req));
?>
```
