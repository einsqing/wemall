<?php
	include 'config.php';

	$_POST['uid'] = 1;
	$sql = "SELECT * FROM ".DB_PREFIX."orders where uid='$_POST[uid]'ORDER BY id DESC";	
	$query = mysql_query($sql) or die('error');

	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		// print_r($row);

		$sqlagain = "SELECT * FROM ".DB_PREFIX."orders_detail where orderid='$row[orderid]'ORDER BY id DESC";
		$queryagain = mysql_query($sqlagain);
		
		while (!!$rowagain = mysql_fetch_array($queryagain, MYSQL_ASSOC)) {

			foreach ( $rowagain as $key => $value ) {
				$rowagain[$key] = urlencode(str_replace("\n","", $value));
			}
			$json .= urldecode(json_encode($rowagain)).',';	
		}

		$json = substr($json, 0 , -1);
		$jsontext .= '{"orderid":"'.$row['orderid'].'","totalprice":"'.$row['totalprice'].'",'.'"status":"'.$row['status'].'",'.'"pay_status":"'.$row['pay_status'].'","menu":['.$json.']},';
		$json = '';
	}
	$jsontext = substr($jsontext, 0 , -1);
	echo '['.$jsontext.']';
	mysql_close();
	
?>