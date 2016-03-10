<?php
namespace Admin\Controller;

class WeixinController extends PublicController {
	function _initialize() {
		parent::_initialize ();
	}
	public function index() {
		$config = M ( "Wxconfig" )->find ();
		$this->assign ( "config", $config );
		$this->assign ( "url", 'http://' . $_SERVER ['HTTP_HOST'] . U('Admin/Wechat/index') );
		
		$menu = M ( "Wxmenu" )->select ();
		$this->assign ( "menu", $menu );
		
		$message = M ( "Wxmessage" )->select ();
		$this->assign ( "message", $message );
		$this->display ();
	}
	public function setconfig() {
		$result = M ( "Wxconfig" )->where ( array (
				"id" => "1" 
		) )->save ( I("post.") );
		$this->success ( "配置成功!" );
	}
	public function addmenu() {
		$data = I("post.");

		if ( $data["id"]) {
			$data["status"] = '1';
			$result = M ( "Wxmenu" )->save ( $data );
			if ($result) {
				$this->success ( "修改菜单成功!" );
			}
		} else {
			$data["status"] = '1';
			unset ( $data["id"] );
			$result = M ( "Wxmenu" )->add ( $data );
			if ($result) {
				$this->success ( "添加菜单成功!" );
			}
		}
	}
	public function delmenu() {
		$id = I("get.id");
		$result = M ( "Wxmenu" )->where ( array (
				"id" => $id 
		) )->delete ();
		if ($result) {
			$this->success ( "删除菜单成功!" );
		}
	}
	public function addmessage() {
		$data = I("post.");
		if ($_FILES ['picurl'] ['name'] !== '') {
			$img = $this->upload ();

			$data ["picurl"] = $img [picurl] [savename];
			$data ["savepath"] = ltrim($img [picurl] [savepath], ".");
		}
		
		if (I("post.message_id") == 0) {
			unset ( $data ["message_id"] );
			$result = M ( "Wxmessage" )->add ( $data );
		} else {
			$data ["id"] = $data ["message_id"];
			unset ( $data ["message_id"] );
			$result = M ( "Wxmessage" )->save ( $data );
		}
		
		if ($result) {
			$this->success ( "操作成功!" );
		}
	}
	public function delmessage(){
		$result = M("Wxmessage")->where(array("id"=>I("get.id")))->delete();
		if ($result) {
			$this->success("删除成功!");
		}
	}
}
