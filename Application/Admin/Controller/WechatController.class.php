<?php
namespace Admin\Controller;

use Think\Controller;

class WechatController extends Controller {
	public function init() {
		Vendor("Wechat.wechat#class");
		 
		$config = M ( "Wxconfig" )->where ( array (
				"id" => "1" 
		) )->find ();
		
		$options = array (
				'token' => $config ["token"], // 填写你设定的key
				'encodingaeskey' => $config ["encodingaeskey"], // 填写加密用的EncodingAESKey
				'appid' => $config ["appid"], // 填写高级调用功能的app id
				'appsecret' => $config ["appsecret"], // 填写高级调用功能的密钥
				);
		$weObj = new \Wechat ( $options );
		return $weObj;
	}
	public function index() {
		$weObj = $this->init ();
		$weObj->valid ();
		$type = $weObj->getRev ()->getRevType ();
		switch ($type) {
			case \Wechat::MSGTYPE_TEXT :
				$key = $weObj->getRev()->getRevContent();
				$replay = M("Wxmessage")->where(array("key"=>$key))->select();
				
				for ($i = 0; $i < count($replay); $i++) {
					if ($replay[$i]["type"]==0) {
						$appUrl = "http://" . I("server.HTTP_HOST") . __ROOT__;
						$newsArr[$i] = array(
								'Title' => $replay[$i]["title"],
								'Description' => $replay[$i]["description"],
								'PicUrl' => $appUrl . '/Public'.$replay[$i]["savepath"].$replay[$i]["picurl"],
								'Url' => $replay[$i]["url"].'&uid=' . $weObj->getRevFrom ()
						);
					}else{
						$weObj->text ( $replay[$i]["title"] )->reply ();
						exit ();
					}
				}
				$weObj->getRev ()->news ( $newsArr )->reply ();
				exit ();
				break;
			case \Wechat::MSGTYPE_EVENT :

				$eventype = $weObj->getRev ()->getRevEvent ();
				file_put_contents("123.txt",$eventype);
				if ($eventype ['event'] == "CLICK") {
					$appUrl = "http://" . I("server.HTTP_HOST") . __ROOT__;
					
					$news = M ( "Wxmessage" )->where ( array (
							"key" => $eventype ['key'],
							"type" => 0 
					) )->select ();
					
					if ($news) {
						for($i = 0; $i < count ( $news ); $i ++) {
							$newsArr[$i] = array(
								'Title' => $news[$i]["title"],
								'Description' => $news[$i]["description"],
								'PicUrl' => $appUrl . '/Public'.$news[$i]["savepath"].$news[$i]["picurl"],
								'Url' => $news[$i]["url"].'&uid=' . $weObj->getRevFrom ()
							);
						}

						$weObj->getRev ()->news ( $newsArr )->reply ();
					}
					
				}elseif ($eventype['event'] == "subscribe") {
    				$weObj->text ( "欢迎您关注wemall商城！" )->reply ();
				}
				exit ();
				break;
			default :
				$weObj->text ( "help info" )->reply ();
		}
	}
	public function createMenu() {
        $menu = M("Wxmenu")->select();

        $newmenu["button"] = array();
        for($i = 0; $i < count($menu); $i++){
            if($menu[$i]["type"] == "view"){
                array_push($newmenu["button"] , array('type'=>'view','name'=>$menu[$i]["name"],'url'=>$menu[$i]["url"]));
            }else{
                array_push($newmenu["button"] , array('type'=>'click','name'=>$menu[$i]["name"],'key'=>$menu[$i]["key"]));
            }
        }

        $weObj = $this->init();
        $weObj->createMenu($newmenu);
        $this->success("重新创建菜单成功!");
	}
}