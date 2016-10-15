<?php
namespace App\Controller;
use Think\Controller;
use \Firebase\JWT\JWT;

// 本类由系统自动生成，仅供测试用途
class JwtController extends Controller {
	public $key = "http://www.wemallshop.com";
	public function login(){
		$phone = I("post.phone");
		$password = md5(I("post.password"));

		$user = M("User")->where(array('phone' => $phone, 'password' => $password))->find();
		if($user){
			$jwt = JWT::encode($user, $this->key);
			echo $jwt;
		}else{
			echo "登录失败";
		}
	}

	public function isLogin($jwt){
		$decoded = JWT::decode($jwt, $this->key, array('HS256'));
		return $decoded;
	}
}