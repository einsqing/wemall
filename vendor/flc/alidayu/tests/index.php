<?php
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\AlibabaAliqinFcTtsNumSinglecall;
use Flc\Alidayu\Requests\AlibabaAliqinFcVoiceNumSinglecall;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumQuery;
use Flc\Alidayu\Requests\AlibabaAliqinFcFlowGrade;
use Flc\Alidayu\Requests\AlibabaAliqinFcVoiceNumDoublecall;
use Flc\Alidayu\Requests\AlibabaAliqinFcFlowCharge;
use Flc\Alidayu\Requests\AlibabaAliqinFcFlowQuery;
use Flc\Alidayu\Requests\AlibabaAliqinFcFlowChargeProvince;
use Flc\Alidayu\Requests\IRequest;

//require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../autoload.php';

// 配置信息
$config = [
    'app_key'    => '*****',
    'app_secret' => '************',
    'sandbox'    => true,  // 是否为沙箱环境，默认false
];

// $client = new Client(new App($config));

// // 短信发送 passed
// $req = new AlibabaAliqinFcSmsNumSend;
// $req->setRecNum('13312311231')
//     ->setSmsParam([
//         'number' => rand(100000, 999999)
//     ])
//     ->setSmsFreeSignName('叶子坑')
//     ->setSmsTemplateCode('SMS_15105357');

Client::configure($config);  // 只需定义一次

$rs = Client::request('alibaba.aliqin.fc.sms.num.send', function (IRequest $req) {
    $req->setRecNum('13312311231')
        ->setSmsParam([
            'number' => rand(100000, 999999)
        ])
        ->setSmsFreeSignName('叶子坑')
        ->setSmsTemplateCode('SMS_15105357');
});

print_r($rs);

// 文本转语音通知 passed
// $req = new AlibabaAliqinFcTtsNumSinglecall;
// $req->setCalledNum('13312311231')
//     ->setTtsParam([
//         'username' => 'admin',
//         'time'     => date('Y-m-d'),
//         'client'   => '微网站'
//     ])
//     ->setCalledShowNum('051482043270')
//     ->setTtsCode('TTS_15230020');

// 语音通知 passed
// $req = new AlibabaAliqinFcVoiceNumSinglecall;
// $req->setCalledNum('13312311231')
//     ->setCalledShowNum('051482043270')
//     ->setVoiceCode('08559b5f-0573-4e30-89ca-b82a9f4b94f8.wav');

// 短信发送记录查询 passed
// $req = new AlibabaAliqinFcSmsNumQuery;
// $req->setBizId('')
//     ->setRecNum('13312311231')
//     ->setQueryDate('20160920')
//     ->setCurrentPage(1)
//     ->setPageSize(10);

// 流量直充档位表 passed
// $req = new AlibabaAliqinFcFlowGrade;

// 多方通话 ---
// $req = new AlibabaAliqinFcVoiceNumDoublecall;
// $req->setCallerNum('13312311231')
//     ->setCallerShowNum('13312311231')
//     ->setCalledNum('13312311231')
//     ->setCalledShowNum('13312311231');

// 流量直充 ---
// $req = new AlibabaAliqinFcFlowCharge;
// $req->setPhoneNum('13312311231')
//     ->setGrade('50')
//     ->setOutRechargeId('111111');

// 流量直充 ---
// $req = new AlibabaAliqinFcFlowQuery;
// $req->setOutId('111111');

// 流量直充分省接口 ---
// $req = new AlibabaAliqinFcFlowChargeProvince;
// $req->setPhoneNum('13312311231')
//     ->setGrade('50')
//     ->setOutRechargeId('111111');

// print_r($req->getParams());

// print_r($client->execute($req));