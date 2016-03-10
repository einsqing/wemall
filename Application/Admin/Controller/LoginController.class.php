<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {
	public function index() {
		$this->display ( "Public:login" );
	}
	public function login() {
		$result = R ( "Api/Api/login", array (I("post.username"),I("post.password")));
		
		if ($result) {
			session("wadmin",$result);

			$this->success ( "登录成功", U ( "Admin/Index/index" ) );
		} else {
			$this->error ( "登录失败", U ( "Admin/Index/index" ) );
		}
	}
	public function logout() {

		session(null);

		$this->success ( '已注销登录！', U ( "Admin/Login/index" ) );
	}
}