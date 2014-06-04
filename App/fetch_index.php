<?php
	include 'config.php';
	// sleep(3);
	$sql = "select * from ".DB_PREFIX."menu";
	$query = mysql_query($sql) or die('SQL 错误！');

	$json = '';

	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		foreach ( $row as $key => $value ) {
			$row[$key] = urlencode(str_replace("\n","", $value));
		}
		$json .= urldecode(json_encode($row)).',';
	}

	echo '['.substr($json, 0, strlen($json) - 1).']';

	mysql_close();

?>