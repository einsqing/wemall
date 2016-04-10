<?php
	header('Content-Type:text/html; charset=utf-8');
	error_reporting(E_ALL & ~E_NOTICE);
	
	define('DB_HOST', 'db_host');
	define('DB_PORT', 'db_port');
	define('DB_USER', 'db_user');
	define('DB_PWD', 'db_pwd');
	define('DB_NAME', 'db_name');
	define('DB_PREFIX', 'db_prefix');
	
	$conn = @mysql_connect(DB_HOST.":".DB_PORT, DB_USER, DB_PWD) or die('数据库链接失败：'.mysql_error());
	
	@mysql_select_db(DB_NAME) or die('数据库错误：'.mysql_error());
	
	@mysql_query('SET NAMES UTF8') or die('字符集错误：'.mysql_error());
?>