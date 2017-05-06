# 流量直充档位表

`\Flc\Alidayu\Requests\AlibabaAliqinFcFlowGrade`

## 1. 官方文档

http://open.taobao.com/docs/api.htm?apiId=26312

## 2. 参数、方法

无

## 3. 使用

```php
<?php
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcFlowGrade;

// 配置信息
$config = [
    'app_key'    => '*****',
    'app_secret' => '************',
];

$client = new Client(new App($config));
$req    = new AlibabaAliqinFcFlowGrade;

print_r($client->execute($req));
?>
```
