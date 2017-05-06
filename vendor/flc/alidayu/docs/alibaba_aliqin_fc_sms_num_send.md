# 短信发送

`\Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend`

## 1. 官方文档

http://open.taobao.com/docs/api.htm?apiId=25450

## 2. 参数、方法

|官方参数|对应方法|类型|是否必须|默认值|说明|
|----|----|----|----|----|----|
|`extend`|`setExtend($value)`|string|可选| |公共回传参数|
|`sms_type`|-|string|**必须**|normal|短信类型，传入值请填写normal|
|`sms_free_sign_name`|`setSmsFreeSignName($value)`|string|**必须**| |短信签名|
|`sms_param`|`setSmsParam($value)`|array&#124;string|可选| |短信模板变量|
|`rec_num`|`setRecNum($value)`|array&#124;string|**必须**| |短信接收号码|
|`sms_template_code`|`setSmsTemplateCode($value)`|string|**必须**| |短信模板ID|

## 3. 使用

```php
<?php
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;

// 配置信息
$config = [
    'app_key'    => '*****',
    'app_secret' => '************',
];

$client = new Client(new App($config));
$req    = new AlibabaAliqinFcSmsNumSend;

$req->setRecNum('13312341234')
    ->setSmsParam([
        'number' => rand(100000, 999999)
    ])
    ->setSmsFreeSignName('叶子坑')
    ->setSmsTemplateCode('SMS_15105357');

print_r($client->execute($req));
?>
```
