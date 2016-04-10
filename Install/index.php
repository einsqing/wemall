<?php
if (file_exists('./install.lock')==true) {
  include_once ("./templates/lock.php");
  exit;
}

@set_time_limit(1000);
if (phpversion() <= '5.3.0')
    set_magic_quotes_runtime(0);
if ('5.2.0' > phpversion())
    exit('您的php版本过低，不能安装本软件，请升级到5.2.0或更高版本再安装，谢谢！');

date_default_timezone_set('PRC');
error_reporting(E_ALL & ~E_NOTICE);
header('Content-Type: text/html; charset=utf-8');
define('SITEDIR', _dir_path(substr(dirname(__FILE__), 0, -8)));

define("VERSION", date('Y-m-d').'http://wemall.duapp.com');
$sqlFile = 'wemall.sql';
$configFile = 'config.php';

if (!file_exists(SITEDIR . 'Install/' . $sqlFile)) {
    echo '缺少数据库文件!';
    exit;
}
$steps = array(
    '1' => '安装许可协议',
    '2' => '运行环境检测',
    '3' => '安装参数设置',
    '4' => '安装详细过程',
    '5' => '安装完成',
);
$step = isset($_GET['step']) ? $_GET['step'] : 1;

//地址
$scriptName = !empty($_SERVER["REQUEST_URI"]) ? $scriptName = $_SERVER["REQUEST_URI"] : $scriptName = $_SERVER["PHP_SELF"];
$rootpath = @preg_replace("/\/(I|i)nstall\/index\.php(.*)$/", "", $scriptName);
$domain = empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];

if ((int) $_SERVER['SERVER_PORT'] != 80) {
    $domain .= ":" . $_SERVER['SERVER_PORT'];
}
$domain = $domain . $rootpath;

switch ($step) {

    case '1':
        include_once ("./templates/s1.php");
        exit();

    case '2':

        if (phpversion() < 5) {
            die('本系统需要PHP5+MYSQL >=4.1环境，当前PHP版本为：' . phpversion());
        }

        $phpv = @ phpversion();
        $os = PHP_OS;
        $os = php_uname();
        $tmp = function_exists('gd_info') ? gd_info() : array();
        $server = $_SERVER["SERVER_SOFTWARE"];
        $host = (empty($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_HOST"] : $_SERVER["SERVER_ADDR"]);
        $name = $_SERVER["SERVER_NAME"];
        $max_execution_time = ini_get('max_execution_time');
        $allow_reference = (ini_get('allow_call_time_pass_reference') ? '<font color=green>[√]On</font>' : '<font color=red>[�]Off</font>');
        $allow_url_fopen = (ini_get('allow_url_fopen') ? '<font color=green>[√]On</font>' : '<font color=red>[�]Off</font>');
        $safe_mode = (ini_get('safe_mode') ? '<font color=red>[�]On</font>' : '<font color=green>[√]Off</font>');

        $err = 0;
        if (empty($tmp['GD Version'])) {
            $gd = '<font color=red ;><b>[X]Off</b></font>';
            $err++;
        } else {
            $gd = '<font color=green>[√]On</font> ' . $tmp['GD Version'];
        }
        if (function_exists('mysql_connect')) {
            $mysql = '<span class="correct_span">√</span> 已安装';
        } else {
            $mysql = '<span class="correct_span error_span">√</span> 出现错误';
            $err++;
        }
        if (ini_get('file_uploads')) {
            $uploadSize = '<span class="correct_span">√</span> ' . ini_get('upload_max_filesize');
        } else {
            $uploadSize = '<span class="correct_span error_span">√</span>禁止上传';
        }
        if (function_exists('session_start')) {
            $session = '<span class="correct_span">√</span> 支持';
        } else {
            $session = '<span class="correct_span error_span">√</span> 不支持';
            $err++;
        }
        $folder = array('/', 'Application','Install', 'Public', 'Api');
        include_once ("./templates/s2.php");
        exit();

    case '3':

        if ($_GET['testdbpwd']) {
            $dbHost = $_POST['dbHost'] . ':' . $_POST['dbPort'];
            $conn = @mysql_connect($dbHost, $_POST['dbUser'], $_POST['dbPwd']);
            die($conn ? "1" : "");
        }
        include_once ("./templates/s3.php");
        exit();


    case '4':
        if (file_exists('./install.lock')==true) {
          include_once ("./templates/lock.php");
          exit;
        }

        if (intval($_GET['install'])) {
            $dbHost = trim($_POST['dbhost']);
            $dbPort = trim($_POST['dbport']);
            $dbName = trim($_POST['dbname']);
            //$dbHost = empty($dbPort) || $dbPort == 3306 ? $dbHost : $dbHost . ':' . $dbPort;
            $dbUser = trim($_POST['dbuser']);
            $dbPwd = trim($_POST['dbpw']);
            $dbPrefix = empty($_POST['dbprefix']) ? 'wemall_' : trim($_POST['dbprefix']);
            $username = trim($_POST['manager_email']);
            $password = md5( trim($_POST['manager_pwd']) );

			$config = array();      
			$config['DB_TYPE']='mysql';
            $config['DB_HOST'] = $dbHost;
            $config['DB_PORT'] = $dbPort;
            $config['DB_NAME'] = $dbName;
            $config['DB_USER'] = $dbUser;
            $config['DB_PWD'] = $dbPwd;
            $config['DB_PREFIX'] = $dbPrefix;  
			$conn = @ mysql_connect($dbHost.":".$dbPort, $dbUser, $dbPwd);
            
            mysql_query("set names 'utf8'"); 
            //创建数据库
            if (!mysql_select_db($dbName , $conn)) {
                mysql_query("CREATE DATABASE IF NOT EXISTS `" . $dbName . "` DEFAULT CHARACTER SET utf8;", $conn);
            }
            mysql_select_db($dbName , $conn);
            //读取数据文件
            $sqldata = file_get_contents(SITEDIR . 'Install/' . $sqlFile);
            $sqldata = str_replace('wemall_',$dbPrefix,$sqldata);
            $sqlFormat = sql_split($sqldata, $dbPrefix);

            //创建配置文件
            $fp = fopen("./templates/config-template.php","r");
            $configStr1 = fread($fp,filesize("./templates/config-template.php"));
            fclose($fp);
            
            $configStr1 = str_replace("db_host",$dbHost,$configStr1);   //初始化数据库服务器
            $configStr1 = str_replace("db_port", $dbPort, $configStr1);
            $configStr1 = str_replace("db_name",$dbName,$configStr1);       //初始化数据库名字
            $configStr1 = str_replace("db_user",$dbUser,$configStr1);           //初始化数据库用户名
            $configStr1 = str_replace("db_pwd",$dbPwd,$configStr1);         //初始化数据库密码
            $configStr1 = str_replace("db_prefix",$dbPrefix,$configStr1);           //初始化数据库表前缀
 
            $fp = fopen("../Public/Conf/config.php","w");
            fwrite($fp,$configStr1);
            fclose($fp);

            /**
              执行SQL语句
             */
            $counts = count($sqlFormat);
		
            for ($i = 0; $i < $counts; $i++) {
                $sql = trim($sqlFormat[$i]);

                if (strstr($sql, 'CREATE TABLE')) {
                    preg_match('/CREATE TABLE IF NOT EXISTS `([^ ]*)`/', $sql, $matches);
                    mysql_query("DROP TABLE IF EXISTS `$matches[1]");
                    mysql_query($sql);
                } else {
                    mysql_query($sql);
                }
            }
            
            //插入管理员
           
            $dbPrefixadmin = $dbPrefix.'admin';
            $query = "INSERT INTO `$dbPrefixadmin` (`id`, `username`, `password`) VALUES (1, \"$username\", \"$password\")";
            mysql_query($query);
        }

        include_once ("./templates/s4.php");
        @touch('./install.lock');
        exit();
}

function testwrite($d) {
    $tfile = "_test.txt";
    $fp = @fopen($d . "/" . $tfile, "w");
    if (!$fp) {
        return false;
    }
    fclose($fp);
    $rs = @unlink($d . "/" . $tfile);
    if ($rs) {
        return true;
    }
    return false;
}

function sql_execute($sql, $tablepre) {
    $sqls = sql_split($sql, $tablepre);
    if (is_array($sqls)) {
        foreach ($sqls as $sql) {
            if (trim($sql) != '') {
                mysql_query($sql);
            }
        }
    } else {
        mysql_query($sqls);
    }
    return true;
}

function sql_split($sql, $tablepre) {

    if ($tablepre != "www_")
        $sql = str_replace("www_", $tablepre, $sql);
    $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);

    if ($r_tablepre != $s_tablepre)
        $sql = str_replace($s_tablepre, $r_tablepre, $sql);
    $sql = str_replace("\r", "\n", $sql);
    $ret = array();
    $num = 0;
    $queriesarray = explode(";\n", trim($sql));
    unset($sql);
    foreach ($queriesarray as $query) {
        $ret[$num] = '';
        $queries = explode("\n", trim($query));
        $queries = array_filter($queries);
        foreach ($queries as $query) {
            $str1 = substr($query, 0, 1);
            if ($str1 != '#' && $str1 != '-')
                $ret[$num] .= $query;
        }
        $num++;
    }
    return $ret;
}

function _dir_path($path) {
    $path = str_replace('\\', '/', $path);
    if (substr($path, -1) != '/')
        $path = $path . '/';
    return $path;
}

function dir_create($path, $mode = 0777) {
    if (is_dir($path))
        return TRUE;
    $ftp_enable = 0;
    $path = dir_path($path);
    $temp = explode('/', $path);
    $cur_dir = '';
    $max = count($temp) - 1;
    for ($i = 0; $i < $max; $i++) {
        $cur_dir .= $temp[$i] . '/';
        if (@is_dir($cur_dir))
            continue;
        @mkdir($cur_dir, 0777, true);
        @chmod($cur_dir, 0777);
    }
    return is_dir($path);
}

function dir_path($path) {
    $path = str_replace('\\', '/', $path);
    if (substr($path, -1) != '/')
        $path = $path . '/';
    return $path;
}

/**
  +----------------------------------------------------------
 * 生成随机字符串
  +----------------------------------------------------------
 * @param int       $length  要生成的随机字符串长度
 * @param string    $type    随机码类型：0，数字+大写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+大小写字母+特殊字符
  +----------------------------------------------------------
 * @return string
  +----------------------------------------------------------
 */
function randCode($length = 5, $type = 0) {
    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
    if ($type == 0) {
        array_pop($arr);
        $string = implode("", $arr);
    } else if ($type == "-1") {
        $string = implode("", $arr);
    } else {
        $string = $arr[$type];
    }
    $count = strlen($string) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str[$i] = $string[rand(0, $count)];
        $code .= $str[$i];
    }
    return $code;
}

?>