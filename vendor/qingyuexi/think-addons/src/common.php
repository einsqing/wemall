<?php
// +----------------------------------------------------------------------
// | thinkphp5 Addons [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.zzstudio.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Byron Sampson <xiaobo.sun@qq.com>
// +----------------------------------------------------------------------

use think\Hook;
use think\Config;
use think\Loader;

// 插件目录
define('ADDON_PATH', ROOT_PATH . 'addons' . DS);

// 定义路由
\think\Route::any('addons/:v/:addon/:controller/:action', "\\think\\addons\\Route@execute");

// 如果插件目录不存在则创建
if (!is_dir(ADDON_PATH)) {
    // @mkdir(ADDON_PATH, 0777, true);
    recurse_copy(__DIR__.'/../addons/',ADDON_PATH);
}

// 注册类的根命名空间
\think\Loader::addNamespace('addons', ADDON_PATH);

// 闭包初始化行为
Hook::add('action_begin', function () {
    // 获取系统配置
    $data = \think\Config::get('app_debug') ? [] : cache('addons_hooks');
    $addons = (array)Config::get('addons');
    if (empty($data)) {
        // 初始化钩子
        foreach ($addons as $key => $values) {

            if (is_string($values)) {
                $values = explode(',', $values);
            } else {
                $values = (array)$values;
            }
            
            $addons[$key] = array_filter(array_map('get_addon_class', $values));

            \think\Hook::add($key, $addons[$key]);
        }
        cache('addons_hooks', $addons);
    } else {
        Hook::import($data, false);
    }
});


/**
 * 处理插件钩子
 * @param string $hook 钩子名称
 * @param mixed $params 传入参数
 * @return void
 */
function addons_hook($hook, $params = [])
{
    \think\Hook::listen($hook, $params);
}

/**
 * 获取插件类的类名
 * @param $name 插件名
 * @param string $type 返回命名空间类型
 * @param string $class 当前类名
 * @return string
 */
function get_addon_class($name, $type = 'hook', $class = null)
{
    
    $name = \think\Loader::parseName($name);

    // 处理多级控制器情况
    if (!is_null($class) && strpos($class, '.')) {

        $class = explode('.', $class);
        foreach ($class as $key => $cls) {
            $class[$key] = \think\Loader::parseName($cls, 1);
        }
        $class = implode('\\', $class);
    } else {
        $class = \think\Loader::parseName(is_null($class) ? $name : $class, 1);
    }

    switch ($type) {
        case 'controller':
            $namespace = "\\addons\\". $name . "\\controller\\" . $class;
            break;
        default:
            $namespace = "\\addons\\". $name;
    }

    return class_exists($namespace) ? $namespace : '';
}

/**
 * 获取插件类的配置文件数组
 * @param string $name 插件名
 * @return array
 */
function get_addon_config($name)
{
    $class = get_addon_class($name);
    if (class_exists($class)) {
        $addon = new $class();
        return $addon->getConfig();
    } else {
        return [];
    }
}

/**
 * 插件显示内容里生成访问插件的url
 * @param $url
 * @param array $param
 * @return bool|string
 * @param bool|string $suffix 生成的URL后缀
 * @param bool|string $domain 域名
 */
function addon_url($url, $param = [], $suffix = true, $domain = false)
{

    $url = parse_url($url);
    $case = config('url_convert');

    $v = $case ? Loader::parseName($url['scheme']) : $url['scheme'];
    $addons = $case ? Loader::parseName($url['host']) : $url['host'];
    $path = explode('/', $url['path']);
    $controller = $case ? Loader::parseName($path[1]) : $path[1];
    $action = trim($case ? strtolower($path[2]) : $path[2], '/');

    /* 解析URL带的参数 */
    if (isset($url['query'])) {
        parse_str($url['query'], $query);
        $param = array_merge($query, $param);
    }

    // 生成插件链接新规则
    $actions = "{$addons}/{$controller}/{$action}";

    return url("/addons/{$v}/{$actions}", $param, $suffix, $domain);
}
// 复制文件到新目录
function recurse_copy($src,$dst) { // 原目录，复制到的目录
    $dir = opendir($src);
    @mkdir($dst, 0777, true);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
// 应用公共文件
//获取文件目录列表,该方法返回数组
function getDir($dir)
{
    $dirArray[] = NULL;
    if (false != ($handle = opendir($dir))) {
        $i = 0;
        while (false !== ($file = readdir($handle))) {
            //去掉"“.”、“..”以及带“.xxx”后缀的文件
            if ($file != "." && $file != ".." && !strpos($file, ".") && $file != '.DS_Store') {
                $dirArray[$i] = $file;
                $i++;
            }
        }
        //关闭句柄
        closedir($handle);
    }
    return $dirArray;
}


/**
 * 保存模块配置
 * @param string $file 调用文件
 * @return array
 */
function save_config($file, $config)
{
    if (empty($config) || !is_array($config)) {
        return array();
    }
    $file = get_config_file($file);
    $conf = "<?php 
return [ \n";
    foreach ($config as $key => $value) {
        if (is_string($value) && !in_array($value, array('true', 'false'))) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'"; //如果是字符串，加上单引号
            }
        }
        $conf = $conf."    '" . $key . "'=>" . $value . ",\n";
    }
    $conf = $conf.'];';

    //写入应用配置文件
    if (!is_writable($file)) {
        return false;
    } else {
        if (file_put_contents($file, $conf)) {
            return true;
        } else {
            return false;
        }
        return '';
    }
}

/**
 * 解析配置文件路径
 * @param string $file 文件路径或简写路径
 * @return dir
 */
function get_config_file($file)
{
    $name = $file;
    if (!is_file($file)) {
        $str = explode('/', $file);
        $strCount = count($str);
        switch ($strCount) {
            case 1:
                $app = APP_NAME;
                $name = $str[0];
                break;
            case 2:
                $app = $str[0];
                $name = $str[1];
                break;
        }
        $app = strtolower($app);
        if (empty($app) && empty($file)) {
            throw new \Exception("Config '{$file}' not found'", 500);
        }
        $file = APP_PATH . "{$app}/conf/{$name}.php";
        if (!file_exists($file)) {
            throw new \Exception("Config '{$file}' not found", 500);
        }
    }
    return $file;
}

//内置插件助手函数
function x_model($name)
{
    $x_route = request()->route();
    // $namespace = 'addons\\'.$x_route['v'].'\\'.$x_route['addon'].'\\model\\'.$name;
    
    $model = '';
    $item = getDir(ADDON_PATH);
    if($item){
        foreach ($item as $key => $value) {
            $addons = getDir(ADDON_PATH.$value);
            foreach ($addons as $k => $v) {
                $namespace = 'addons\\'.$value.'\\'.$v.'\\model\\'.$name;
                if(class_exists($namespace)){
                    $model = model($namespace);
                }
            }
        }
    }
    if(!$model){
        $model = model('app\common\model\\'.$name);
    }
    return $model;
}





