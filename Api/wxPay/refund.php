<?php
/**
 * 退款申请接口-demo
 * ====================================================
 * 注意：同一笔单的部分退款需要设置相同的订单号和不同的
 * out_refund_no。一笔退款失败后重新提交，要采用原来的
 * out_refund_no。总退款金额不能超过用户实际支付金额(现
 * 金券金额不能退款)。
*/

	include_once("../WxPayPubHelper/WxPayPubHelper.php");

	//输入需退款的订单号
	if (!isset($_POST["out_trade_no"]) || !isset($_POST["refund_fee"]))
	{
		$out_trade_no = " ";
		$refund_fee = "1";
	}else{
	    $out_trade_no = $_POST["out_trade_no"];
	    $refund_fee = $_POST["refund_fee"];
		//商户退款单号，商户自定义，此处仅作举例
		$out_refund_no = "$out_trade_no"."$time_stamp";
		//总金额需与订单号out_trade_no对应，demo中的所有订单的总金额为1分
		$total_fee = "1";
		
		//使用退款接口
		$refund = new Refund_pub();
		//设置必填参数
		//appid已填,商户无需重复填写
		//mch_id已填,商户无需重复填写
		//noncestr已填,商户无需重复填写
		//sign已填,商户无需重复填写
		$refund->setParameter("out_trade_no","$out_trade_no");//商户订单号
		$refund->setParameter("out_refund_no","$out_refund_no");//商户退款单号
		$refund->setParameter("total_fee","$total_fee");//总金额
		$refund->setParameter("refund_fee","$refund_fee");//退款金额
		$refund->setParameter("op_user_id",WxPayConf_pub::MCHID);//操作员
		//非必填参数，商户可根据实际情况选填
		//$refund->setParameter("sub_mch_id","XXXX");//子商户号 
		//$refund->setParameter("device_info","XXXX");//设备号 
		//$refund->setParameter("transaction_id","XXXX");//微信订单号
		
		//调用结果
		$refundResult = $refund->getResult();
		
		//商户根据实际情况设置相应的处理流程,此处仅作举例
		if ($refundResult["return_code"] == "FAIL") {
			echo "通信出错：".$refundResult['return_msg']."<br>";
		}
		else{
			echo "业务结果：".$refundResult['result_code']."<br>";
			echo "错误代码：".$refundResult['err_code']."<br>";
			echo "错误代码描述：".$refundResult['err_code_des']."<br>";
			echo "公众账号ID：".$refundResult['appid']."<br>";
			echo "商户号：".$refundResult['mch_id']."<br>";
			echo "子商户号：".$refundResult['sub_mch_id']."<br>";
			echo "设备号：".$refundResult['device_info']."<br>";
			echo "签名：".$refundResult['sign']."<br>";
			echo "微信订单号：".$refundResult['transaction_id']."<br>";
			echo "商户订单号：".$refundResult['out_trade_no']."<br>";
			echo "商户退款单号：".$refundResult['out_refund_no']."<br>";
			echo "微信退款单号：".$refundResult['refund_idrefund_id']."<br>";
			echo "退款渠道：".$refundResult['refund_channel']."<br>";
			echo "退款金额：".$refundResult['refund_fee']."<br>";
			echo "现金券退款金额：".$refundResult['coupon_refund_fee']."<br>";
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
		<form  action="./refund.php" method="post">
			<p>申请退款：</p>
			<p>退款单号: <input type="text" name="out_trade_no" value=<?php echo $out_trade_no; ?> ></p>
			<p>退款金额(分): <input type="text" name="refund_fee" value=<?php echo $refund_fee; ?> ></p>
		    <button type="submit" >提交</button>
		</form>
		
		</br>
		<a href="../index.php">返回首页</a>

	</div>
</body>
</html>