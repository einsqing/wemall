# 语音通知

`\Flc\Alidayu\Requests\AlibabaAliqinFcVoiceNumSinglecall`

## 1. 官方文档

http://open.taobao.com/docs/api.htm?apiId=25445

## 2. 参数、方法

|官方参数|对应方法|类型|是否必须|默认值|说明|
|----|----|----|----|----|----|
|`extend`|`setExtend($value)`|string|可选| |公共回传参数|
|`called_num`|`setCalledNum($value)`|string|**必须**| |被叫号码|
|`called_show_num`|`setCalledShowNum($value)`|string|**必须**| |被叫号显|
|`voice_code`|`setVoiceCode($value)`|string|**必须**| |语音文件ID|

## 3. 使用

```php
<?php
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcVoiceNumSinglecall;

// 配置信息
$config = [
    'app_key'    => '*****',
    'app_secret' => '************',
];

$client = new Client(new App($config));
$req = new AlibabaAliqinFcVoiceNumSinglecall;

$req->setCalledNum('13312311231')
    ->setCalledShowNum('051482043270')
    ->setVoiceCode('08559b5f-0573-4e30-89ca-b82a9f4b94f8.wav');

print_r($client->execute($req));
?>
```
