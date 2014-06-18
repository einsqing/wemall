<?php
include 'config.php';

$cartdata = $_POST['cartdata'];
$totalprice = $_POST['totalprice'];
// $_POST ['userdata'] = $_POST ['userdata'];

$uid = htmlspecialchars( $_POST['uid'] );
$username = $_POST ['userdata'] [0] [value];
$phone = $_POST ['userdata'] [1] [value];
$address = $_POST ['userdata'] [2] [value];
$note = $_POST ['userdata'] [3] [value];
$orderid = date ( "YmdHis" ) . mt_rand ( 10, 99 );
$time = date ( "Y/m/d H:i:s" );

$pay = '1';
$cartdataArray = json_decode(stripslashes($cartdata) , true);

switch ($pay) {
	case '1': //货到付款
		$status = '已打印';
		$pay_status = '未付款';
		break;
	case '2': //余额支付
		$sqlUserBalance = "SELECT * FROM ".DB_PREFIX."users where uid=\"$uid\"";
		$UserBalance = mysql_fetch_array(mysql_query($sqlUserBalance));
		$UserBalanceDiff = $UserBalance['balance'] - $totalprice;

		if ( $UserBalanceDiff >= 0 ) {
			$sqlUserBalanceUpdate = "UPDATE ".DB_PREFIX."users SET balance=\"$UserBalanceDiff\" WHERE uid=\"$uid\"";
			mysql_query($sqlUserBalanceUpdate);
			$pay_status = '已付款';
		}else{
			// echo "1";
			$pay_status = '付款失败';
		}

		$status = '已打印';
		break;
	case '3': //支付宝支付
		function request_by_curl($remote_server, $post_string){
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $remote_server);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, 'mypost=' . $post_string);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_USERAGENT, "WeMall Alipay");
		    $data = curl_exec($ch);
		    curl_close($ch);
		    return $data;
		}
		$post_string = "WIDseller_email=".WIDseller_email."&WIDout_trade_no=$orderid&WIDsubject=".WIDsubject."&WIDtotal_fee=$totalprice";
		request_by_curl('http://www.xxx.com/App/Extend/Alipay/alipayapi.php',$post_string);

		$status = '已打印';
		if (fail) {
			$pay_status = '付款失败';
		}else{
			$pay_status = '已付款';
		}
		
		break;
}

$sqlUser = "SELECT * FROM " . DB_PREFIX . "users where uid=\"$uid\"";
$userResult = mysql_fetch_array( mysql_query($sqlUser) ); 
if ($userResult == false) {
	$sqlInsertUser = "INSERT INTO " . DB_PREFIX . "users (uid , username , phone , address , balance , time) VALUES (\"$uid\",\"$username\",\"$phone\",\"$address\",\"0\",\"$time\")";
	mysql_query($sqlInsertUser);//把用户插入用户表
}else{
	$sqlUpdateUser = "UPDATE " . DB_PREFIX . "users SET  username=\"$username\" , phone=\"$phone\" , address=\"$address\" WHERE uid=\"$uid\"";
	mysql_query($sqlUpdateUser);//更新用户表
}
$sqlOrders = "INSERT INTO " . DB_PREFIX . "orders (uid , orderid , totalprice , pay_status , note , status , time) VALUES (\"$uid\",\"$orderid\",\"$totalprice\",\"$pay_status\",\"$note\",\"$status\",\"$time\")";
mysql_query($sqlOrders);

for ($i=0; $i < count($cartdataArray); $i++) { 
	$title = $cartdataArray[$i][name];
	$price = $cartdataArray[$i][price];
	$quantity = $cartdataArray[$i][num];

	//$feiyindetail .= $title.'      '.$price.'      '.$quantity.'</br>';//打印菜单列表

	$sqlOrdersDetail = "INSERT INTO ". DB_PREFIX."orders_detail (orderid , title , price , quantity) VALUES (\"$orderid\",\"$title\",\"$price\",\"$quantity\")";
	mysql_query($sqlOrdersDetail);
}

echo '0';
/*//开始打印 打印成功返回0
include './Extend/Feiyin/FeyinAPI.php';
$msgNo = testSendFreeMessage(
'郑州宜客来欢迎您订购

订单编号：'.$orderid.'

条目      单价（元）    数量
------------------------------
'.$feiyindetail.'

备注：'.$note.'
------------------------------
合计：'.$totalprice.'元 
付款状态：'.$pay_status.'

送货地址：'.$address.'
联系电话：'.$phone.'
订购时间：'.$time.'');//自由输出*/
?>
