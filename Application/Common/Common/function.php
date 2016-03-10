<?php
/**
 * 其它版本
 * 使用方法：
 * $post_string = "app=request&version=beta";
 * request_by_other('http://facebook.cn/restServer.php',$post_string);
 */
function request_by_other($remote_server, $post_string)
{
	$context = array(
			'http' => array(
					'method' => 'POST',
					'header' => 'Content-type: application/x-www-form-urlencoded' .
					'\r\n'.'User-Agent : Jimmy\'s POST Example beta' .
					'\r\n'.'Content-length:' . strlen($post_string) + 8,
					'content' => 'mypost=' . $post_string)
	);
	$stream_context = stream_context_create($context);
	$data = file_get_contents($remote_server, false, $stream_context);
	return $data;
}
/**
 * Goofy 2011-11-30
 * getDir()去文件夹列表，getFile()去对应文件夹下面的文件列表,二者的区别在于判断有没有“.”后缀的文件，其他都一样
 */

//获取文件目录列表,该方法返回数组
function getDir($dir) {
	$dirArray[]=NULL;
	if (false != ($handle = opendir ( $dir ))) {
		$i=0;
		while ( false !== ($file = readdir ( $handle )) ) {
			//去掉"“.”、“..”以及带“.xxx”后缀的文件
			if ($file != "." && $file != ".." && !strpos($file,".") && $file != '.DS_Store') {
				$dirArray[$i]=$file;
				$i++;
			}
		}
		//关闭句柄
		closedir ( $handle );
	}
	return $dirArray;
}

//获取文件列表
function getFile($dir) {
	$fileArray[]=NULL;
	if (false != ($handle = opendir ( $dir ))) {
		$i=0;
		while ( false !== ($file = readdir ( $handle )) ) {
			//去掉"“.”、“..”以及带“.xxx”后缀的文件
			if ($file != "." && $file != ".."&&strpos($file,".")) {
				$fileArray[$i]="./imageroot/current/".$file;
				if($i==100){
					break;
				}
				$i++;
			}
		}
		//关闭句柄
		closedir ( $handle );
	}
	return $fileArray;
}

//调用方法getDir("./dir")……
function displayDir($str) {
	if (! is_dir ( $str ))
		die ( '不是一个目录！' );
	$files = array ();
	if ($hd = opendir ( $str )) {
		while ( $file = readdir ( $hd ) ) {
			if ($file != '.' && $file != '..') {
				if (is_dir ( $str . '/' . $file )) {
					$files [$file] = displayDir ( $str . '/' . $file );
				} else {
					$files [] = $file;
				}
			}
		}
	}
	return $files;
}

/**
 * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
 * 注意：服务器需要开通fopen配置
 * @param $word 要写入日志里的文本内容 默认值：空值
 */
function logResult($word = '')
{
    $fp = fopen("./log.log", "a");
    flock($fp, LOCK_EX);
    fwrite($fp, "执行日期：" . strftime("%Y%m%d%H%M%S", time()) . "\n" . $word . "\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}

?>