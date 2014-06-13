<?php
	

	if (!file_exists('./Install/install.lock')) {
		header('location:./Install/index.php');
		exit();
	}
	//定义项目名称
	define('APP_NAME','Admin');

	//定义项目路径
	define('APP_PATH', './Admin/');

	define('APP_DEBUG', true);
	//加载框架入口文件
	require './Core/ThinkPHP.php';
	?>