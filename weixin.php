<?php
/**
  * wechat php test
  */
include './App/config.php';
$sql = "select * from ".DB_PREFIX."weixin where id = '1'";
$weixin = mysql_fetch_assoc(mysql_query($sql));
// print_r($weixin);
// echo $sql;
//define your token
define("TOKEN", "wemall");
$wechatObj = new wechatCallbackapiTest($weixin['title'] , $weixin['img'] , $weixin['description']);

if (! isset ( $_GET ['echostr'] )) {
	$wechatObj->responseMsg ();
} else {
	$wechatObj->valid();
}

class wechatCallbackapiTest
{	
	public $title;
	public $picurl;
	public $description;
	
	public function __construct( $title , $picurl , $description){
		$this->title = $title;
		$this->picurl = $picurl;
		$this->description = $description;
	}

	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
	
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){ 
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $event = $postObj->Event;
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
                  
                $newsTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[%s]]></Title>
							<Description><![CDATA[%s]]></Description>
							<PicUrl><![CDATA[%s]]></PicUrl>
							<Url><![CDATA[%s]]></Url>
							</item>
							</Articles>
							</xml>";
				if(!empty( $keyword ))
                {
              		if (preg_match("/\w*商城\w*/i",$keyword) || preg_match("/\w*店\w*/i",$keyword) || preg_match("/\w*买\w*/i",$keyword) || preg_match("/\w*页\w*/i",$keyword)) {
              			$msgType = "news";
	                	$Url = "http://wemall.duapp.com/App/index.php?uid=".$fromUsername;
	                	$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $this->title,  $this->description, $this->picurl, $Url);
	                	echo $resultStr;
              		}elseif(preg_match("/\w*活动\w*/i",$keyword) || preg_match("/\w*优惠\w*/i",$keyword)){
              			$msgType = "news";
              			$Url = "http://wemall.duapp.com/App/index.php?uid=".$fromUsername;
              			$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $this->title,  $this->description, $this->picurl, $Url);
              			echo $resultStr;
              		}else{
              			$msgType = "text";
              			$contentStr = "回复'商城'即可查看最新的商品信息,回复'活动'即可体验最新的优惠活动";
              			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
              			echo $resultStr;
              		}
                	
                }else{
                	if($event=="subscribe"){//首次关注
                     $msgType = "news";
	                 $Url = "http://wemall.duapp.com/App/index.php?uid=".$fromUsername;
                	 $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $this->title,  $this->description, $this->picurl, $Url);
                	 echo $resultStr;
                     }
                	 echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature() {
		$signature = $_GET ["signature"];
		$timestamp = $_GET ["timestamp"];
		$nonce = $_GET ["nonce"];
		
		$token = TOKEN;
		$tmpArr = array (
				$token,
				$timestamp,
				$nonce 
		);
		sort ( $tmpArr, SORT_STRING );
		$tmpStr = implode ( $tmpArr );
		$tmpStr = sha1 ( $tmpStr );
		
		if ($tmpStr == $signature) {
			return true;
		} else {
			return false;
		}
	}
}

?>