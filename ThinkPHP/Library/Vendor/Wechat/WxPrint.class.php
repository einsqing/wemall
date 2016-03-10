<?php

class WxPrint
{

    function httppost1($params)
    {
        $host = '114.215.116.141';
        $port = '8888';
        //需要提交的post数据
        $p = '';
        foreach ($params as $k => $v) {
            $p .= $k . '=' . $v . '&';
        }
        $p = rtrim($p, '&');

        $header = "POST / HTTP/1.1\r\n";
        $header .= "Host:$host:$port\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Expect:\r\n";
        $header .= "Content-Length: " . strlen($p) . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        $header .= $p;
        echo $header;
        $fp = fsockopen($host, $port);
        fwrite($fp, $header, 3024546);
        while (!feof($fp)) {
            $str = fgets($fp);
        }
        fclose($fp);
        print_r($str);
    }


    function generateSign($params, $apiKey, $msign)
    {
        //所有请求参数按照字母先后顺序排序
        ksort($params);
        //定义字符串开始 结尾所包括的字符串
        $stringToBeSigned = $apiKey;
        //把所有参数名和参数值串在一起
        foreach ($params as $k => $v) {
            $stringToBeSigned .= urldecode($k . $v);
        }
        unset($k, $v);
        //把venderKey夹在字符串的两端
        $stringToBeSigned .= $msign;
        //使用MD5进行加密，再转化成大写
        return strtoupper(md5($stringToBeSigned));
    }
}

?>

