# 流量直充查询

`\Flc\Alidayu\Requests\AlibabaAliqinFcFlowQuery`

## 1. 官方文档

http://open.taobao.com/docs/api.htm?apiId=26305

## 2. 参数、方法

|官方参数|对应方法|类型|是否必须|默认值|说明|
|----|----|----|----|----|----|
|`out_id`|`setOutId($value)`|string|**必须**| |唯一流水号|

## 3. 使用

```php
<?php
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcFlowQuery;

// 配置信息
$config = [
    'app_key'    => '*****',
    'app_secret' => '************',
];

$client = new Client(new App($config));
$req = new AlibabaAliqinFcFlowQuery;

$req->setOutId('111111');

print_r($client->execute($req));
?>
```
