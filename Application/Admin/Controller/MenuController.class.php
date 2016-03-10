<?php
namespace Admin\Controller;

class MenuController extends PublicController {
	function _initialize() {
		parent::_initialize ();
	}
	public function index() {
		$result = R ( "Api/Api/getarraymenu" );
		$this->assign ( "menu", $result );
		$this->assign ( "menulist", $result );
		$this->display ();
	}
	public function addmenu() {
		$result = R ( "Api/Api/addmenu", array (I("post.parent"),I("post.name"),I("post.addmenu")) );
		$this->success ( "操作成功" );
	}
	public function del() {
		$result = R ( "Api/Api/delmenu", array (I("get.id")) );
		$this->success ( "删除成功" );
	}
}