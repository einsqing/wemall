<?php
/**
 * 
 * @authors 清月曦 (1604583867@qq.com)
 * @date    2017-05-01 11:20:54
 * @version $Id$
 */
// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/application/');
define('ADDON_PATH', __DIR__ . '/addons/');
define('DATA_PATH', __DIR__ . '/data/');
define('PUBLIC_PATH', '/public');

// 检查是否安装
if(!is_file('./data/install.lock')){
	// 检测PHP环境
	if (version_compare(PHP_VERSION, '5.4.0', '<')) die('require PHP > 5.4.0 !');
	// 绑定模块
    define('BIND_MODULE', 'install');
}
// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';