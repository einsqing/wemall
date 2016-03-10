<?php
/**
 * Native（原生）支付模式一demo
 * ====================================================
 * 模式一：商户按固定格式生成链接二维码，用户扫码后调微信
 * 会将productid和用户openid发送到商户设置的链接上，商户收到
 * 请求生成订单，调用统一支付接口下单提交到微信，微信会返回
 * 给商户prepayid。
 * 本例程对应的二维码由native_call_qrcode.php生成；
 * 本例程对应的响应服务为native_call.php;
 * 需要两者配合使用。
 * 
*/
	include_once("./log_.php");
	include_once("../WxPayPubHelper/WxPayPubHelper.php");
	
	//以log文件形式记录回调信息，用于调试
	$log_ = new Log_();
	$log_name="./native_call.log";

    //使用native通知接口
	$nativeCall = new NativeCall_pub();

	//接收微信请求
	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
	$log_->log_result($log_name,"【接收到的native通知】:\n".$xml."\n");
	$nativeCall->saveData($xml);
	
	if($nativeCall->checkSign() == FALSE){
		$nativeCall->setReturnParameter("return_code","FAIL");//返回状态码
		$nativeCall->setReturnParameter("return_msg","签名失败");//返回信息
	}else{
	    //提取product_id
		$product_id = $nativeCall->getProductId();
		
		//使用统一支付接口
		$unifiedOrder = new UnifiedOrder_pub();
		
		//根据不同的$product_id设定对应的下单参数，此处只举例一种
		switch ($product_id) 
		{
			case WxPayConf_pub::APPID."static"://与native_call_qrcode.php中的静态链接二维码对应
				//设置统一支付接口参数
				//设置必填参数
				//appid已填,商户无需重复填写
				//mch_id已填,商户无需重复填写
				//noncestr已填,商户无需重复填写
				//spbill_create_ip已填,商户无需重复填写
				//sign已填,商户无需重复填写
				$unifiedOrder->setParameter("body","贡献一分钱");//商品描述
				//自定义订单号，此处仅作举例
				$timeStamp = time();
				$out_trade_no = WxPayConf_pub::APPID."$timeStamp";
				$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 			$unifiedOrder->setParameter("product_id","$product_id");//商品ID
				$unifiedOrder->setParameter("total_fee","1");//总金额
				$unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
				$unifiedOrder->setParameter("trade_type","NATIVE");//交易类型
				$unifiedOrder->setParameter("product_id","$product_id");//用户标识
				//非必填参数，商户可根据实际情况选填
				//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
				//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
				//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
				//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
				//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
				//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
				//$unifiedOrder->setParameter("openid","XXXX");//用户标识
				
				//获取prepay_id
				$prepay_id = $unifiedOrder->getPrepayId();
				//设置返回码
				//设置必填参数
				//appid已填,商户无需重复填写
				//mch_id已填,商户无需重复填写
				//noncestr已填,商户无需重复填写
				//sign已填,商户无需重复填写
				$nativeCall->setReturnParameter("return_code","SUCCESS");//返回状态码
				$nativeCall->setReturnParameter("result_code","SUCCESS");//业务结果
				$nativeCall->setReturnParameter("prepay_id","$prepay_id");//预支付ID
				
				break;
			default:
				//设置返回码
				//设置必填参数
				//appid已填,商户无需重复填写
				//mch_id已填,商户无需重复填写
				//noncestr已填,商户无需重复填写
				//sign已填,商户无需重复填写
				$nativeCall->setReturnParameter("return_code","SUCCESS");//返回状态码
				$nativeCall->setReturnParameter("result_code","FAIL");//业务结果
				$nativeCall->setReturnParameter("err_code_des","此商品无效");//业务结果
				break;
		}

	}
	
	//将结果返回微信
	$returnXml = $nativeCall->returnXml();
	$log_->log_result($log_name,"【返回微信的native响应】:\n".$returnXml."\n");

	echo $returnXml;
	
	//交易完成

?>