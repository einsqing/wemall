====
简介
============================================
接口名称：微信公众号支付接口
版本：V3.3
开发语言：PHP

========
配置说明
===========================================

1.【基本信息设置】
商户向微信提交企业以及银行账户资料，商户功能审核通过后，可以获得帐户基本信息，找到本例程的配置文件「WxPay.pub.config.php」，配置好如下信息：
	appId：微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看。
	Mchid：受理商ID，身份标识
	Key:商户支付密钥Key。审核通过后，在微信发送的邮件中查看。
	Appsecret:JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看。

2.【native支付链接设置】
native支付中，用户扫码后调微信会将productid和用户openid发送到商户设置的链接上，确保该链接与实际服务路径一致。本例程的响应服务为「./demo/native_call.php」

3.【JSAPI路径设置】
通过JSAPI发起支付的代码应该放置在商户设置的「支付授权目录」中。
并找到本例程的配置文件「WxPay.pub.config.php」，配置正确的路径。

4.【证书路径设置】
找到本例程的配置文件「WxPay.pub.config.php」，配置证书路径。

5.【异步通知url设置】
找到本例程的配置文件「WxPay.pub.config.php」，配置异步通知url。

6.【必须开启curl服务】
使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"即可。

7.【设置curl超时时间】
本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒。找到本例程的配置文件「WxPay.pub.config.php」，配置curl超时时间。

============
代码文件结构
===========================================
wxpay_php
|-- README.txt---------------------使用说明文本
|-- WxPayHelper--------------------微信支付类库及常用文件
|   |-- SDKRuntimeException.php----异常处理类
|   |-- WxPay.pub.config.php-----------商户配置文件
|   `-- WxPayPubHelper.php------------微信支付类库
|-- demo---------------------------例程
|   |-- js_api_call.php------------JSAPI支付例程
|   |-- native_call_qrcode.php-----native支付静态链接二维码例程
|   |-- native_call.php------------native支付后台响应例程
|   |-- native_call.log------------native支付后台响应日志
|   |-- native_dynamic_qrcode.php--native支付动态链接二维码例程
|   |-- notify_url.php-------------支付结果异步通知例程
|   |-- notify_url.log-------------支付结果异步通知日志
|   |-- order_query.php------------订单查询例程
|   |-- refund.php-----------------退款例程
|   |-- download_bill.php----------对账单例程
|   |-- refund_query.php-----------退款查询例程
|   |-- log_.php-------------------日志类
|   `-- qrcode.js------------------二维码生成工具
`-- index.php

==============
微信支付帮助sdk
====================================================
1.每一个接口对应一个类。
2.常用工具（产生随机字符串、生成签名、以post方式提交xml、证书的使用等）封装成CommonUtil类。
3.接口分三种类型:请求型接口、响应型接口、其他。请求型接口是将参数封装成xml，以post方式提交到微信，微信响应结果；响应型接口则是响应微信的post请求。Wxpay_client_是请求型接口的基类。Wxpay_server_是响应型接口的基类。Wxpay_client_、Wxpay_server_都继承CommonUtil类
4.结构明细
【常用工具】--CommonUtil
		trimString()，设置参数时需要用到的字符处理函数
		createNoncestr()，产生随机字符串，不长于32位
		formatBizQueryParaMap(),格式化参数，签名过程需要用到
		getSign(),生成签名
		arrayToXml(),array转xml
		xmlToArray(),xml转 array
		postXmlCurl(),以post方式提交xml到对应的接口url
		postXmlSSLCurl(),使用证书，以post方式提交xml到对应的接口url
【请求型接口】--Wxpay_client_
		统一支付接口----UnifiedOrder
		订单查询接口----OrderQuery
		退款申请接口----Refund
		退款查询接口----RefundQuery
		对账单接口------DownloadBill
		短链接转换接口--ShortUrl
【响应型接口】--Wxpay_server_
		通用通知接口----Notify
		Native支付——请求商家获取商品信息接口--NativeCall
【其他】
		静态链接二维码--NativeLink
		JSAPI支付-------JsApi