<?php
//下载地址 http://api.feyin.net/php_doc.zip

include 'HttpClient.class.php';

//使用本测试代码，您需要设置以下3项变量
//@ MEMBER_CODE：商户代码，登录飞印后在“API集成”->“获取API集成信息”获取
//@ FEYIN_KEY：密钥，获取方法同上
//@ DEVICE_NO：打印机设备编码，通过打印机后面的激活按键获取，为16位数字，例如"4600365507768327";
define('MEMBER_CODE', 'ec14c704da9611e387ce00163e02163b');
define('FEYIN_KEY', '0613e5d7');
define('DEVICE_NO', '9280594321972168');


//以下2项是平台相关的设置，您不需要更改
define('FEYIN_HOST','my.feyin.net');
define('FEYIN_PORT', 80);


// $msgNo = testSendFormatedMessage();//格式化输出


// testQueryState($msgNo);

// testListDevice();//设备状态

// testListException();


function testSendFormatedMessage(){
	$msgNo = time()+1;
	/*
	 格式化的打印内容
	*/
	$msgInfo = array (
			'memberCode'=>MEMBER_CODE,  
			'charge'=>'3000',
			'orderNo'=>'11111',  
			'customerName'=>'何青',  //客户姓名
			'customerPhone'=>'15037110261',  //客户姓名
			'customerAddress'=>'河南农业大学',  //送货地址
			'customerMemo'=>'备注',  //备注
			'msgDetail'=>'番茄炒粉@100@2||客家咸香鸡@2000@1',  
			'deviceNo'=>DEVICE_NO,  
			'msgNo'=>$msgNo,
	);

	echo sendFormatedMessage($msgInfo);

	return $msgNo;
}

function testSendFreeMessage($msgDetail){
	$msgNo = time()+1;
	/*
	 自由格式的打印内容
	*/

	$freeMessage = array(
		'memberCode'=>MEMBER_CODE, 
		'msgDetail'=>$msgDetail,
		'deviceNo'=>DEVICE_NO, 
		'msgNo'=>$msgNo,
	);

	echo sendFreeMessage($freeMessage);

	return $msgNo;
}

/*
 * 查询打印状态
 */
function testQueryState($msgNo){
	$result = queryState($msgNo);

	echo $result;

	return $result;
}

/*
 * 测试获取设备列表
 */
function testListDevice(){

	echo listDevice();
}


function testListException(){

	echo listException();
}


//----------------------以下是接口定义实现，第三方应用可根据具体情况直接修改----------------------------

function sendFreeMessage($msg) {
	$msg['reqTime'] = number_format(1000*time(), 0, '', '');
	$content = $msg['memberCode'].$msg['msgDetail'].$msg['deviceNo'].$msg['msgNo'].$msg['reqTime'].FEYIN_KEY;
	$msg['securityCode'] = md5($content);
	$msg['mode']=2;

	return sendMessage($msg);
}

function sendFormatedMessage($msgInfo) {
	$msgInfo['reqTime'] = number_format(1000*time(), 0, '', '');
	$content = $msgInfo['memberCode'].$msgInfo['customerName'].$msgInfo['customerPhone'].$msgInfo['customerAddress'].$msgInfo['customerMemo'].$msgInfo['msgDetail'].$msgInfo['deviceNo'].$msgInfo['msgNo'].$msgInfo['reqTime'].FEYIN_KEY;

	$msgInfo['securityCode'] = md5($content);
	$msgInfo['mode']=1;
	
	return sendMessage($msgInfo);
}


function sendMessage($msgInfo) {
	$client = new HttpClient(FEYIN_HOST,FEYIN_PORT);
	if(!$client->post('/api/sendMsg',$msgInfo)){ //提交失败
		return 'faild';
	}
	else{
		return $client->getContent();
	}
}

function queryState($msgNo){
	$now = number_format(1000*time(), 0, '', '');
	$client = new HttpClient(FEYIN_HOST,FEYIN_PORT);
	if(!$client->get('/api/queryState?memberCode='.MEMBER_CODE.'&reqTime='.$now.'&securityCode='.md5(MEMBER_CODE.$now.FEYIN_KEY.$msgNo).'&msgNo='.$msgNo)){ //请求失败
		return 'faild';
	}
	else{
		return $client->getContent();
	}
}

function listDevice(){
	$now = number_format(1000*time(), 0, '', '');
	$client = new HttpClient(FEYIN_HOST,FEYIN_PORT);
	if(!$client->get('/api/listDevice?memberCode='.MEMBER_CODE.'&reqTime='.$now.'&securityCode='.md5(MEMBER_CODE.$now.FEYIN_KEY))){ //请求失败
		return 'faild';
	}
	else{
		/***************************************************
		解释返回的设备状态
		格式：
		<device id="4600006007272080">	
		<address>广东**</address>
		<since>2010-09-29</since>
		<simCode>135600*****</simCode>
		<lastConnected>2011-03-09  19:39:03</lastConnected>
		<deviceStatus>离线 </deviceStatus>
		<paperStatus></paperStatus>
		</device>
		**************************************************/

		$xml = $client->getContent();
		$sxe = new SimpleXMLElement($xml);
		foreach($sxe->device as $device) {
			$id = $device['id'];
			echo "设备编码：$id    ";
			
			$deviceStatus = $device->deviceStatus;
			echo "状态：$deviceStatus";
			echo '<br>';
		}
	}
}


function listException(){
	$now = number_format(1000*time(), 0, '', '');
	$client = new HttpClient(FEYIN_HOST,FEYIN_PORT);
	if(!$client->get('/api/listException?memberCode='.MEMBER_CODE.'&reqTime='.$now.'&securityCode='.md5(MEMBER_CODE.$now.FEYIN_KEY))){ //请求失败
		return 'faild';
	}
	else{
		return $client->getContent();
	}
}

?>
