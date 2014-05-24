<?php
include 'config.php';

$cartdataArray = $_POST ['cartdata'];
$totalprice = $_POST ['totalprice'];
$userdataArray = $_POST ['userdata'];

$user = $userdataArray [0] [value];
$tel = $userdataArray [1] [value];
$addr = $userdataArray [2] [value];
$note = $userdataArray [3] [value];
$orderid = date ( "YmdHis" , strtotime ( "+8 hour" )) . mt_rand ( 10, 99 );
$time = date ( "Y/m/d H:i:s" , strtotime ( "+8 hour" ));

$sql = "INSERT INTO " . DB_PREFIX . "orders (uid, orderid, username, mobile, address, totalprice, note, status, time) 
 		VALUES ('$_POST[uid]','$orderid','$user','$tel','$addr','$totalprice','$note','下单成功','$time')";

if ($user && $tel && $addr) {
	@mysql_query ( $sql );
	@$cartdataArray = json_decode ( $cartdataArray, true );
	
	for($i = 0; $i < count ( $cartdataArray ); $i ++) {
		$name = $cartdataArray [$i] [name];
		$price = $cartdataArray [$i] [price];
		$num = $cartdataArray [$i] [num];
		
		$sqldetail = "INSERT INTO " . DB_PREFIX . "orders_detail (uid , orderid , title , price , quantity, totalprice ,status)
 				VALUES ('$_POST[uid]','$orderid','$name','$price','$num','$totalprice','下单成功')";
		
		@mysql_query ( $sqldetail );
	}
	
	echo 'success';
} else {
	echo 'wrong';
}
mysql_close();
?>
