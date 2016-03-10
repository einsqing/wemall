<?php
$arr1 =  array(
	//'配置项'=>'配置值'
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_PORT'   => '3306', // 端口
	'DB_CHARSET'=> 'utf8',// 数据库编码默认采用utf8
// 	'URL_ROUTER_ON'   => true,
// 	'SHOW_PAGE_TRACE' => true,


    //'配置项'=>'配置值'
    'DEFAULT_MODULE' => 'Admin',  // 默认模块
    'MODULE_ALLOW_LIST' => array('App', 'Admin','Api'),
    'URL_MODEL' => 0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持
    'TMPL_FILE_DEPR' => '_', //模板文件CONTROLLER_NAME与ACTION_NAME之间的分割
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'SHOW_PAGE_TRACE' => false,
    'VAR_URL_PARAMS' => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR' => '/', //PATHINFO URL分割符
    'URL_HTML_SUFFIX' => '',  // URL伪静态后缀设置

    'AUTOLOAD_NAMESPACE' => array(
        'Addons' => ADDON_PATH, //自动加载命名空间
    )
);

include './Public/Conf/config.php';

$arr2 = array(
	'DB_HOST'   => DB_HOST, // 服务器地址
	'DB_NAME'   => DB_NAME, // 数据库名
	'DB_USER'   => DB_USER, // 用户名
	'DB_PWD'    => DB_PWD,  // 密码
	'DB_PREFIX' => DB_PREFIX, // 数据库表前缀
);

return array_merge($arr1 , $arr2);
