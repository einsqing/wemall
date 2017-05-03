<?php
/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 * @author 清月曦 <1604583867@qq.com>
 */

// 应用公共文件
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
// 导出excle
function export_to($data,$name=false,$type = 0){
    if(!$name){$name=date("Y-m-d-H-i-s",time());}
    $PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
    $PHPExcel->getActiveSheet()->fromArray($data);
    $PHPExcel->getActiveSheet()->setTitle('Sheet1'); //给当前活动sheet设置名称
    $PHPExcel->setActiveSheetIndex(0);
    $fileName = './public/'.date('Y-m-d_', time()).time().'.xlsx';
    $saveName = $name.date('Y-m-d', time()).'.xlsx';

    $PHPWriter = PHPExcel_IOFactory::createWriter($PHPExcel,'Excel5');//按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，‘Excel5’表示生成2003版本Excel文件
    if ($type == 0) {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器输出07Excel文件
        header('Content-Type:application/vnd.ms-excel');//告诉浏览器将要输出Excel03版本文件
        header('Content-Disposition: attachment;filename="'.$saveName.'"');//告诉浏览器输出浏览器名称
        // header('Content-Disposition: attachment;filename="01simple.xlsx"');//告诉浏览器输出浏览器名称
        header('Cache-Control: max-age=0');//禁止缓存
        $PHPWriter->save("php://output");
    }else{
        $PHPWriter->save($fileName); //表示在$path路径下面生成demo.xlsx文件
    }
}

function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $keys = 'id', $sort = 'asc', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $list[$key][$child] = [];
            $refer [$data[$pk]] = &$list[$key];
        }

        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree [] = &$list[$key];
                $tree = my_sort($tree,$keys,$sort,SORT_NUMERIC);
            } else {
                if (isset ($refer [$parentId])) {
                    $parent = &$refer[$parentId];
                    $parent[$child] [] = &$list[$key];
                    $parent[$child] = my_sort($parent[$child],$keys,$sort,SORT_NUMERIC);
                }
            }
        }
    }
    return $tree;
}
/**
 * 数组按字段排序
 * @param  $arrays  要排序的数组
 * @return SORT_ASC     - 默认，按升序排列。(A-Z)
 * @return SORT_DESC    - 按降序排列。(Z-A)
 * @return SORT_REGULAR - 默认。将每一项按常规顺序排列。
 * @return SORT_NUMERIC - 将每一项按数字顺序排列。
 * @return SORT_STRING  - 将每一项按字母顺序排列
 * @author 清月曦 <1604583867@qq.com>
 */
function my_sort($arrays,$sort_key,$sort_order='asc',$sort_type=SORT_NUMERIC ){
    if($sort_order == 'asc') $sort_order=SORT_ASC;
    if($sort_order == 'desc') $sort_order=SORT_DESC;

    if(is_array($arrays)){   
        foreach ($arrays as $array){   
            if(is_array($array)){   
                $key_arrays[] = $array[$sort_key];   
            }else{   
                return false;   
            }   
        }   
    }else{   
        return false;   
    }  
    array_multisort($key_arrays,$sort_order,$sort_type,$arrays);   
    return $arrays;   
} 
/**
 * 及时显示提示信息
 * @param  string $msg 提示信息
 */
function show_msg($msg, $class = ''){
    echo "<script type=\"text/javascript\">showmsg(\"{$msg}\", \"{$class}\")</script>";
    flush();
    ob_flush();
}
/**
 * 执行SQL文件
 */
function execute_sql_file($sql_path)
{
    // 读取SQL文件
    $sql = wp_file_get_contents($sql_path);
    $sql = str_replace("\r", "\n", $sql);
    $sql = explode(";\n", $sql);

    // 替换表前缀
    $orginal = 'wemall_';
    $prefix = config('DB_PREFIX');
    $sql = str_replace("{$orginal}", "{$prefix}", $sql);

    // 开始安装
    foreach ($sql as $value) {
        $value = trim($value);
        if (empty ($value))
            continue;

        $res = \think\Db::execute($value);
    }
}
/**
 * 远程获取数据，GET模式
 * 注意：
 * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
 * @param $url 指定URL完整路径地址
 * return 远程输出的数据
 */
function getHttpResponseGET($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
    $responseText = curl_exec($curl);
    //var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    curl_close($curl);
    
    return $responseText;
}

/**
 * 系统邮件发送函数
 * @param string $tomail 接收邮件者邮箱
 * @param string $name 接收邮件者名称
 * @param string $subject 邮件主题
 * @param string $body 邮件内容
 * @param string $attachment 附件列表
 * @return boolean
 * @author static7 <static7@qq.com>
 使用方法：
$toemail='1604583867@qq.com';  
$name = '清月曦';//收件人昵称
$subject='注册验证码';
$mail_tpl = model('MailTpl')->where('type', 'register')->find()->toArray();
$content = str_replace("\$code","123456",$mail_tpl['content']);
$result = send_mail($toemail,$name,$subject,$content);
dump($result);
 */
function send_mail($tomail, $name, $subject = '', $body = '', $attachment = null) {
    $config_mail = model('Mail')->find()->toArray();
    $shop = model('Config')->find();
    $mail = new \PHPMailer();           //实例化PHPMailer对象
    
    $mail->CharSet = 'UTF-8';           //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();                    // 设定使用SMTP服务
    $mail->SMTPDebug = 0;               // SMTP调试功能 0=关闭 1 = 错误和消息 2 = 消息
    $mail->SMTPAuth = true;             // 启用 SMTP 验证功能
    if($config_mail['secure']){
        $mail->SMTPSecure = 'ssl';      // 使用安全协议Enable TLS encryption, `ssl` also accepted
    }else{
        $mail->SMTPSecure = 'tls';      // 使用安全协议Enable TLS encryption, `ssl` also accepted
    }
    $mail->Host = $config_mail['host']; // SMTP 服务器
    $mail->Port = $config_mail['port'];                  // SMTP服务器的端口号
    $mail->Username = $config_mail['user'];    // SMTP服务器用户名
    $mail->Password = $config_mail['pass'];     // SMTP服务器密码
    $mail->SetFrom($config_mail['user'], $shop['title']);
    $replyEmail = $config_mail['replyTo'];                   //留空则为发件人EMAIL
    $replyName = '发送回复';                    //回复名称（留空则为发件人名称）
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($tomail, $name);
    if (is_array($attachment)) { // 添加附件
        foreach ($attachment as $file) {
            is_file($file) && $mail->AddAttachment($file);
        }
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}
/**
 * @param $id
 *
 * 易联云微信打印机
 */
function wxPrint($id)
{
    $result = model('Order')->with('user,contact,delivery,detail.product.file')->find($id);

    $config = model('Config')->find();

    $msg = '';
    $msgtitle = $config['name'] . '欢迎您订购

订单编号：' . $result["orderid"] . '

条目      单价（元）    数量
--------------------------------------------
';
    $detail = '';
    for ($j = 0; $j < count($result["detail"]); $j++) {
        $row = $result["detail"][$j];
        $title = $row['name'];
        $price = $row['price'];
        $num = $row['num'];

        $detail .=
            $title . '      ' . $price . '      ' . $num . '
';
    }
    $msgcontent = $detail;

    $msgfooter = '
备注：' . $result["remark"] . '
--------------------------------------------
合计：' . $result["totalprice"] . '元
付款状态：' . $result['pay_status'] . '

联系用户：' . $result["contact"]["name"] . '
送货地址：' . $result["contact"]["province"] . $result["contact"]["city"] . $result["contact"]["district"] . $result["contact"]["address"] . '
联系电话：' . $result["contact"]["phone"] . '
订购时间：' . $result["created_at"] . '




';//自由输出

    $msg .= $msgtitle . $msgcontent . $msgfooter;

    $wxPrint = model("WxPrint")->find();
    $partner = $wxPrint["partner"];//用户id
    $machine_code = $wxPrint["machine_code"];//机器码
    $apiKey = $wxPrint["apikey"];//apiKey
    $msign = $wxPrint["mkey"];//秘钥

    vendor("dodgepudding.wechat-php-sdk.WxPrint#class");
    $print = new \WxPrint();
    //打印
    $print->action_print($partner,$machine_code,$msg,$apiKey,$msign);
}
/**
 *  产生一个随机数，传入长度
 * @param [type]  用户 QQ互联一键登录　产生密码随机
 * .@param string $length 随机数密码长度  默认为10个字符;
 **/
function rand_code($length = 6)
{
    $chars = "123456789";
    $str = "";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[mt_rand(0, $size - 1)];
    }
    return $str;
}

/**
 * 最简单的XML转数组
 * @param string $xmlstring XML字符串
 * @return array XML数组
 */
function simplest_xml_to_array($xmlstring)
{
    return json_decode(json_encode((array)simplexml_load_string($xmlstring)), true);
}

