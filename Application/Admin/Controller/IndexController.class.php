<?php
namespace Admin\Controller;

// 本类由系统自动生成，仅供测试用途
class IndexController extends PublicController {
	function _initialize() {
		parent::_initialize ();
	}
	public function index() {
		$this->display ();
	}
	public function setting() {
		$result = R ( "Api/Api/setting", array (I("post.name"),I("post.notification")));
		$this->success ( "修改成功");
	}
	public function set() {
		if (session("wadmin")) {
			$result = R ( "Api/Api/getsetting" );
			$this->assign ( "info", $result );
			
			$themedir = getDir("./Theme/");
			
			for ($i = 0; $i < count($themedir); $i++) {
				$theme[$i] = simplexml_load_file("./Theme/".$themedir[$i]."/config.xml");
				if (isset($theme[$i])) {
					$theme[$i]->dir = $themedir[$i];
				}
			}
			$this->assign("theme",$theme);
			$this->assign("settheme",$result["theme"]);
			$payresult = R ( "Api/Api/getalipay" );
			$this->assign ( "alipay", $payresult );
			$this->display ();
		}
	}
	public function settheme(){
		
		$name = I("get.name");

		$data = array("id"=>1,"theme"=>$name[0]);
		$result = M("Info")->save($data);
		$this->success("操作成功");
	}

}