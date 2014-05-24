<?php
	include 'config.php';
	$cartsqlfiled ='';
	$json = '';
	$cartArray = explode("; ",$_POST['cart']);

	for ($i = 0; $i < count($cartArray) ; $i++) {
		$cartSql = explode("=", $cartArray[$i]);
		$cartsqlfiled = DB_PREFIX.'menu';
		$json .= fetch_cart_data($cartsqlfiled , substr($cartSql[1],1));
	}
	
	function fetch_cart_data($cartsqlfiled , $id){
		$sql = "SELECT * FROM $cartsqlfiled WHERE id='$id'";			
		$query = mysql_query($sql) or die('SQL 错误！');
			
		while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
			foreach ( $row as $key => $value ) {
				$row[$key] = urlencode(str_replace("\n","", $value));
			}
			@$json .= urldecode(json_encode($row)).',';
		}
		return $json;
	}
	
	echo '['.substr($json, 0, strlen($json) - 1).']';
	
	mysql_close();
	
?>