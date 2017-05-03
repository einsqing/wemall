<?php

/**
 * 系统环境检测
 * @return array 系统环境数据
 */
function check_env()
{
    $items = array(
        'os' => array('操作系统', '不限制', '类Unix', PHP_OS, 'success'),
        'php' => array('PHP版本', '5.4', '5.4+', PHP_VERSION, 'success'),
        'upload' => array('附件上传', '不限制', '2M+', '未知', 'success'),
        'gd' => array('GD库', '2.0', '2.0+', '未知', 'success'),
    );

    //PHP环境检测
    if ($items['php'][3] < $items['php'][1]) {
        $items['php'][4] = 'error';
    }

    //附件上传检测
    if (@ini_get('file_uploads'))
        $items['upload'][3] = ini_get('upload_max_filesize');

    //GD库检测
    $tmp = function_exists('gd_info') ? gd_info() : array();
    if (empty($tmp['GD Version'])) {
        $items['gd'][3] = '未安装';
        $items['gd'][4] = 'error';
    } else {
        $items['gd'][3] = $tmp['GD Version'];
    }
    unset($tmp);
    return $items;
}

/**
 * 目录，文件读写检测
 * @return array 检测数据
 */
function check_dirfile()
{
    $items = array(
        array('dir', '可写', 'success', 'addons'),
        array('dir', '可写', 'success', 'application'),
        array('dir', '可写', 'success', 'data'),
        array('dir', '可写', 'success', 'public'),
        array('dir', '可写', 'success', 'tpl'),
        array('dir', '可写', 'success', 'thinkphp'),
    );
    foreach ($items as &$val) {
        if ('dir' == $val[0]) {
            if (!is_writable($val[3])) {
                if (is_dir($items[3])) {
                    $val[1] = '可读';
                    $val[2] = 'error';
                    session('error', true);
                } else {
                    $val[1] = '不存在';
                    $val[2] = 'error';
                    session('error', true);
                }
            }
        } else {
            if (file_exists($val[3])) {
                if (!is_writable($val[3])) {
                    $val[1] = '不可写';
                    $val[2] = 'error';
                    session('error', true);
                }
            } else {
                if (!is_writable(dirname($val[3]))) {
                    $val[1] = '不存在';
                    $val[2] = 'error';
                    session('error', true);
                }
            }
        }
    }
    return $items;
}

/**
 * 函数检测
 * @return array 检测数据
 */
function check_func()
{
    $items = array(
        array('pdo','支持','success','类'),
        array('pdo_mysql','支持','success','模块'),
        array('fileinfo','支持','success','模块'),
        array('file_get_contents', '支持', 'success','函数'),
        array('mb_strlen', '支持', 'success','函数'),
        array('pathinfo', '支持', 'success','函数'),
        array('curl','支持','success','模块'),
    );
    foreach ($items as &$val) {
        if(('类'==$val[3] && !class_exists($val[0]))
            || ('模块'==$val[3] && !extension_loaded($val[0]))
            || ('函数'==$val[3] && !function_exists($val[0]))
        ){
            $val[1] = '不支持';
            $val[2] = 'error';
        }
    }

    return $items;
}

/**
 * 及时显示提示信息
 * @param  string $msg 提示信息
 */
function install_show_msg($msg, $class = true)
{
    if ($class) {
        echo "<script type=\"text/javascript\">showmsg(\"{$msg}\")</script>";
    } else {
        echo "<script type=\"text/javascript\">showmsg(\"{$msg}\", \"error\")</script>";
        exit;
    }
}

/**
 * 过滤数据
 * @param  array $data 过滤数据
 */
function filter_string($data)
{
    if ($data === NULL) {
        return false;
    }
    if (is_array($data)) {
        foreach ($data as $k => $v) {
            $data[$k] = filter_string($v);
        }
        return $data;
    } else {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * 保存模块配置
 * @param string $file 调用文件
 * @return array
 */
function install_save_config($file, $config)
{
    if (empty($config) || !is_array($config)) {
        return array();
    }
    $file = install_get_config_file($file);
    //读取配置内容
    $conf = file_get_contents($file);
    //替换配置项
    foreach ($config as $key => $value) {
        if (is_string($value) && !in_array($value, array('true', 'false'))) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'"; //如果是字符串，加上单引号
            }
        }
        $conf = preg_replace("/'" . $key . "'\s*=\>\s*(.*?),/iU", "'" . $key . "'=>" . $value . ",", $conf);
    }
    //写入应用配置文件
    if (!IS_WRITE) {
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
function install_get_config_file($file)
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

/**
 * 写入配置文件
 * @param $config
 * @return array 配置信息
 */
function write_config($config){
    if(is_array($config)){
        //读取配置内容
        $conf = file_get_contents(APP_PATH . 'install/data/database.tpl');
        // 替换配置项
        foreach ($config as $name => $value) {
            $conf = str_replace("[{$name}]", $value, $conf);
        }

        //写入应用配置文件
        if(file_put_contents(APP_PATH . 'database.php', $conf)){
            install_show_msg('配置文件写入成功');
        } else {
            install_show_msg('配置文件写入失败！', 'error');
        }
        return '';
    }
}

/*
    参数：
    $sql_path:sql文件路径；
    $old_prefix:原表前缀；
    $new_prefix:新表前缀；
    $separator:分隔符 参数可为";\n"或";\r\n"或";\r"
*/
function get_mysql_data($sql_path, $old_prefix = "", $new_prefix = "", $separator = ";\n")
{

    $commenter = array('#', '--');
    //判断文件是否存在
    if (!file_exists($sql_path))
        return false;

    $content = file_get_contents($sql_path);   //读取sql文件
    $content = str_replace(array($old_prefix, "\r"), array($new_prefix, "\n"), $content);//替换前缀

    //通过sql语法的语句分割符进行分割
    $segment = explode($separator, trim($content));

    //去掉注释和多余的空行
    $data = array();
    foreach ($segment as $statement) {
        $sentence = explode("\n", $statement);
        $newStatement = array();
        foreach ($sentence as $subSentence) {
            if ('' != trim($subSentence)) {
                //判断是会否是注释
                $isComment = false;
                foreach ($commenter as $comer) {
                    if (preg_match("/^(" . $comer . ")/is", trim($subSentence))) {
                        $isComment = true;
                        break;
                    }
                }
                //如果不是注释，则认为是sql语句
                if (!$isComment)
                    $newStatement[] = $subSentence;
            }
        }
        $data[] = $newStatement;
    }

    //组合sql语句
    foreach ($data as $statement) {
        $newStmt = '';
        foreach ($statement as $sentence) {
            $newStmt = $newStmt . trim($sentence) . "\n";
        }
        if (!empty($newStmt)) {
            $result[] = $newStmt;
        }
    }
    return $result;
}











