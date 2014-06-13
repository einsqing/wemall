<?php
	include '../Public/Conf/config.php';

	if(!strpos($_SERVER["HTTP_USER_AGENT"],"MicroMessenger")){
		die();
	}
?>