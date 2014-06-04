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
$orderid = date ( "YmdHis" , strtotime ( "+8 hour" )) . mt_rand ( 10, 99 );
$time = date ( "Y/m/d H:i:s" , strtotime ( "+8 hour" ));

$pay = '1';
$cartdataArray = json_decode($cartdata , true);

switch ($pay) {
	case '1': //货到付款
		$status = '';
		$pay_status = '未付款';
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

echo '0';

?>
