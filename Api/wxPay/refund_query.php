<?php
/**
 * 退款申请接口-demo
 * ====================================================
 * 
 * 
*/
	include_once("../WxPayPubHelper/WxPayPubHelper.php");

	//要查询的订单号
	if (!isset($_POST["out_trade_no"]))
	{
		$out_trade_no = " ";
	}else{
	    $out_trade_no = $_POST["out_trade_no"];
		
		//使用退款查询接口
		$refundQuery = new RefundQuery_pub();
		//设置必填参数
		//appid已填,商户无需重复填写
		//mch_id已填,商户无需重复填写
		//noncestr已填,商户无需重复填写
		//sign已填,商户无需重复填写
		$refundQuery->setParameter("out_trade_no","$out_trade_no");//商户订单号
		// $refundQuery->setParameter("out_refund_no","XXXX");//商户退款单号
		// $refundQuery->setParameter("refund_id","XXXX");//微信退款单号
		// $refundQuery->setParameter("transaction_id","XXXX");//微信退款单号
		//非必填参数，商户可根据实际情况选填
		//$refundQuery->setParameter("sub_mch_id","XXXX");//子商户号 
		//$refundQuery->setParameter("device_info","XXXX");//设备号 
		
		//退款查询接口结果
		$refundQueryResult = $refundQuery->getResult();
		
		//商户根据实际情况设置相应的处理流程,此处仅作举例
		if ($refundQueryResult["return_code"] == "FAIL") {
			echo "通信出错：".$refundQueryResult['return_msg']."<br>";
		}
		else{
			echo "业务结果：".$refundQueryResult['result_code']."<br>";
			echo "错误代码：".$refundQueryResult['err_code']."<br>";
			echo "错误代码描述：".$refundQueryResult['err_code_des']."<br>";
			echo "公众账号ID：".$refundQueryResult['appid']."<br>";
			echo "商户号：".$refundQueryResult['mch_id']."<br>";
			echo "子商户号：".$refundQueryResult['sub_mch_id']."<br>";
			echo "设备号：".$refundQueryResult['device_info']."<br>";
			echo "签名：".$refundQueryResult['sign']."<br>";
			echo "微信订单号：".$refundQueryResult['transaction_id']."<br>";
			echo "商户订单号：".$refundQueryResult['out_trade_no']."<br>";
			echo "退款笔数：".$refundQueryResult['refund_count']."<br>";
			echo "商户退款单号：".$refundQueryResult['out_refund_no']."<br>";
			echo "微信退款单号：".$refundQueryResult['refund_idrefund_id']."<br>";
			echo "退款渠道：".$refundQueryResult['refund_channel']."<br>";
			echo "退款金额：".$refundQueryResult['refund_fee']."<br>";
			echo "现金券退款金额：".$refundQueryResult['coupon_refund_fee']."<br>";
			echo "退款状态：".$refundQueryResult['refund_status']."<br>";
		}
	}


	

	
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>微信安全支付</title>
</head>
<body>
	</br></br></br></br>
	<div align="center">
		<form  action="./refund_query.php" method="post">
			<p>退款查询</p>
			<p>单号: <input type="text" name="out_trade_no"></p>
		    <button type="submit" >提交</button>
		</form>

		</br>
		<a href="../index.php">返回首页</a>

	</div>
</body>
</html>