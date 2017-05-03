<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 * @author 清月曦 <1604583867@qq.com>
 */
function data_auth_sign($data) {
    //数据类型检测
    if(!is_array($data)){
        $data = (array)$data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}
/**
 * 下载远程文件
 * @param  string  $url     网址
 * @param  string  $filename    保存文件名
 * @param  integer $timeout 过期时间
 * return boolean|string
 */
function http_down($url, $filename, $timeout = 60) {
    $path = dirname($filename);
    if (!is_dir($path) && !mkdir($path, 0755, true)) {
        return false;
    }
    $fp = fopen($filename, 'w');
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    return $filename;
}

// 防超时的file_get_contents改造函数
function wp_file_get_contents($url)
{
    $context = stream_context_create(array(
        'http' => array(
            'timeout' => 30
        )
    )); // 超时时间，单位为秒

    return file_get_contents($url, 0, $context);
}
/**
*解压文件
*/
function unzip($filePath, $toPath,$filesize=0){
    // $length = filesize($filePath);
    // if ($filesize == $length) {
        $zip = new ZipArchive; 
        $res = $zip->open($filePath); 

        if ($res === TRUE) {
            //解压缩到指定文件夹 
            $zip->extractTo($toPath); 
            $zip->close(); 
            //删除压缩包
            unlink($filePath);
            if ( is_dir( $toPath . '__MACOSX' ) ) {
                delDirAndFile($toPath . '__MACOSX');
            }
            return true;
        }else{
            return false;
        }
    // }else{
        // return false;
    // }
}











