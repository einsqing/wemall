<?php
/**
 * 订单查询-demo
 * ====================================================
 * 该接口提供所有微信支付订单的查询。
 * 当支付通知处理异常或丢失的情况，商户可以通过该接口查询订单支付状态。
 * 
*/
	include_once("../WxPayPubHelper/WxPayPubHelper.php");
	
	//退款的订单号
	if (!isset($_POST["out_trade_no"]))
	{
		$out_trade_no = " ";
	}else{
	    $out_trade_no = $_POST["out_trade_no"];

		//使用订单查询接口
		$orderQuery = new OrderQuery_pub();
		//设置必填参数
		//appid已填,商户无需重复填写
		//mch_id已填,商户无需重复填写
		//noncestr已填,商户无需重复填写
		//sign已填,商户无需重复填写
		$orderQuery->setParameter("out_trade_no","$out_trade_no");//商户订单号 
		//非必填参数，商户可根据实际情况选填
		//$orderQuery->setParameter("sub_mch_id","XXXX");//子商户号  
		//$orderQuery->setParameter("transaction_id","XXXX");//微信订单号
		
		//获取订单查询结果
		$orderQueryResult = $orderQuery->getResult();
		
		//商户根据实际情况设置相应的处理流程,此处仅作举例
		if ($orderQueryResult["return_code"] == "FAIL") {
			echo "通信出错：".$orderQueryResult['return_msg']."<br>";
		}
		elseif($orderQueryResult["result_code"] == "FAIL"){
			echo "错误代码：".$orderQueryResult['err_code']."<br>";
			echo "错误代码描述：".$orderQueryResult['err_code_des']."<br>";
		}
		else{
			echo "交易状态：".$orderQueryResult['trade_state']."<br>";
			echo "设备号：".$orderQueryResult['device_info']."<br>";
			echo "用户标识：".$orderQueryResult['openid']."<br>";
			echo "是否关注公众账号：".$orderQueryResult['is_subscribe']."<br>";
			echo "交易类型：".$orderQueryResult['trade_type']."<br>";
			echo "付款银行：".$orderQueryResult['bank_type']."<br>";
			echo "总金额：".$orderQueryResult['total_fee']."<br>";
			echo "现金券金额：".$orderQueryResult['coupon_fee']."<br>";
			echo "货币种类：".$orderQueryResult['fee_type']."<br>";
			echo "微信支付订单号：".$orderQueryResult['transaction_id']."<br>";
			echo "商户订单号：".$orderQueryResult['out_trade_no']."<br>";
			echo "商家数据包：".$orderQueryResult['attach']."<br>";
			echo "支付完成时间：".$orderQueryResult['time_end']."<br>";
		}	
	}

	//商户自行增加处理流程
	//......
	
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>微信安全支付</title>
</head>
<body>
	</br></br>
	<div align="center">
		<form  action="./order_query.php" method="post">
			<p>订单查询</p>
			<p>单号: <input type="text" name="out_trade_no" value="<?php echo $out_trade_no; ?>"></p>
		    <button type="submit" >提交</button>
		</form>
		</br>

		<a href="../index.php">返回首页</a>

	</div>
</body>
</html>