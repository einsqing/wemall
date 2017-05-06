# 短信发送记录查询

`\Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumQuery`

## 1. 官方文档

http://open.taobao.com/docs/api.htm?apiId=26039

## 2. 参数、方法

|官方参数|对应方法|类型|是否必须|默认值|说明|
|----|----|----|----|----|----|
|`biz_id`|`setBizId($value)`|string|可选| |短信发送流水|
|`rec_num`|`setRecNum($value)`|string|**必须**|normal|短信接收号码|
|`query_date`|`setQueryDate($value)`|string|**必须**|当天年月日|短信发送日期，支持近30天记录查询，格式yyyyMMdd|
|`current_page`|`setCurrentPage($value)`|string|**必须**|1|分页参数,页码|
|`page_size`|`setPageSize($value)`|string|**必须**|10|分页参数，每页数量。最大值50|

## 3. 使用

```php
<?php
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumQuery;

// 配置信息
$config = [
    'app_key'    => '*****',
    'app_secret' => '************',
];

$client = new Client(new App($config));
$req = new AlibabaAliqinFcSmsNumQuery;

$req->setBizId('')
    ->setRecNum('13312311231')
    ->setQueryDate('20160920')
    ->setCurrentPage(1)
    ->setPageSize(10);

print_r($client->execute($req));
?>
```
