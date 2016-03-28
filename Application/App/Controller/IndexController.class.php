<?php
namespace App\Controller;
use Think\Controller;

// 本类由系统自动生成，仅供测试用途
class IndexController extends Controller {
	function _initialize() {
		// $_GET = I("get.");
		// $_POST = I("post.");
	}

	public function index() {
		if (I("get.uid")) {
			$info = R ( "Api/Api/gettheme" );
			C ( "DEFAULT_THEME", $info ["theme"] );
			$this->assign ( "info", $info );
			
			$menuresult = R ( "Api/Api/getmenu" );
			$this->assign ( "menu", $menuresult );
			
			$goodsresult = R ( "Api/Api/getgood" );
			$this->assign ( "goods", $goodsresult );
			
			$uid = I("get.uid");
			$usersresult = R ( "Api/Api/getuser",array($uid));
			
			$alipay = M ( "Alipay" )->find ();
			if ($alipay) {
				$this->assign ( "alipay", 1 );
			}
			
			$this->assign ( "users", $usersresult );
			$this->display ();
		} else {
			echo '请使用微信访问!';
		}
	}
	public function fetchgooddetail() {
		$where ["id"] = I("post.id");
		$result = M ( "Good" )->where ( $where )->find ();
		if ($result) {
			$this->ajaxReturn ( $result );
		}
	}

	public function getorders() {
		$uid = I("post.uid");
		$user_id = M ( "User" )->where ( array (
				"uid" => $uid 
		) )->find ();
		$result = M ( "Order" )->where ( array (
				"user_id" => $user_id ["id"] 
		) )->order ( 'id desc' )->select ();
		$this->ajaxReturn ( $result );
	}
	public function addorder() {
		$uid = htmlspecialchars ( I("post.uid"));

		$userData = I("post.userData");
		$username = $userData [0] [value];
		$phone = $userData [1] [value];
		$pay = $userData [2] [value];
		$address = $userData [3] [value];
		$note = $userData [4] [value];
		
		$totalprice = I("post.totalPrice");
		$cartdata = stripslashes ( I("post.cartData") );
		
		$orderid = date ( "ymdhis" ) . mt_rand ( 1, 9 );
		$time = date ( "Y/m/d H:i:s" );
		switch ($pay) {
			case 0 :
				$pay_style = "货到付款";
				break;
			case 1 :
				$pay_style = "微信支付";
				break;
		}
		
		$data ["orderid"] = $orderid;
		$data ["totalprice"] = $totalprice;
		$data ["pay_style"] = $pay_style;
		$data ["pay_status"] = "0";
		$data ["note"] = $note;
		$data ["order_status"] = '0';
		$data ["time"] = $time;
		$data ["cartdata"] = $cartdata;
		
		$userdata = M ( "User" )->where ( array (
				"uid" => $uid 
		) )->find ();
		if ($userdata) {
			$user_id = $userdata ["id"];
			$user ["id"] = $user_id;
			$user ["username"] = $username;
			$user ["phone"] = $phone;
			$user ["address"] = $address;
			M ( "User" )->save ( $user );
			
			$data ["user_id"] = $user_id;
			M ( "Order" )->add ( $data );
		} else {
			$user ["uid"] = $uid;
			$user ["username"] = $username;
			$user ["phone"] = $phone;
			$user ["address"] = $address;
			$user_id = M ( "User" )->add ( $user );
			$data ["user_id"] = $user_id;
			M ( "Order" )->add ( $data );
		}
		
        $config = M("Wxconfig")->find();
        if ($pay == 1) {
            echo 'http://' . $_SERVER ['SERVER_NAME'] . __ROOT__ . '/Api/wxPay/js_api_call.php?body=' . $config ['num'] . '&orderid=' . $orderid . '&totalprice=' . floatval($totalprice) * 100 . '&url=' . U("App/Index/index") . '&uid=' . $uid;
        }

	}
	
	// app start
	public function appregister() {
		$username = I("post.username");
		$password = I("post.password");
		$phone = I("post.phone");
		
		if ($username && $password && $phone) {
			$find = M ( "User" )->where ( array (
					"phone" => $phone 
			) )->select ();
			if (! $find) {
				$data ["username"] = $username;
				$data ["phone"] = $phone;
				$data ["password"] = md5 ( $password );
				$data ["uid"] = date ( "His" ) . mt_rand ( 1, 9 );
				$data ["time"] = date ( "Y/m/d H:i:s" );
				
				$result = M ( "User" )->add ( $data );
				if ($result) {
					$this->ajaxReturn ( $result );
				}
			}
		}
	}
	public function applogin() {
		$phone = I("post.phone");
		$password = md5 ( I("post.password") );
		
		if ($phone && $password) {
			$result = M ( "User" )->where ( array (
					"phone" => $phone,
					"password" => $password 
			) )->find ();
			if ($result) {
				$this->ajaxReturn ( $result );
			}
		}
	}
	public function appgetgood() {
		$result = M ( "Good" )->select ();
		if ($result) {
			$this->ajaxReturn ( $result );
		}
	}
	public function appdoaddress() {
		$do = I("post.do");
		$uid = I("post.uid");
		
		switch ($do) {
			case 1 :
				$result = M ( "User" )->where ( array (
						"uid" => $uid 
				) )->find ();
				if ($result) {
					$this->ajaxReturn ( $result );
				}
				break;
			case 2 :
				$address = I("post.address");
				$data ["address"] = $address;
				$result = M ( "User" )->where ( array (
						"uid" => $uid 
				) )->save ( $data );
				if ($result) {
					$this->ajaxReturn ( $result );
				}
				break;
			default :
				;
				break;
		}
	}
	public function appdoorder() {
		$do = I("post.do");
		$uid = I("post.uid");
		
		switch ($do) {
			case 1 :
				$cartdata = I("post.cartdata");
				$note = I("post.note");
				$cartarray = json_decode ( $cartdata, true );
				$totalprice = 0;
				for($i = 0; $i < count ( $cartarray ); $i ++) {
					unset ( $cartarray [$i] ["id"] );
					unset ( $cartarray [$i] ["image"] );
					$totalprice += $cartarray [$i] ["num"] * $cartarray [$i] ["price"];
				}
				$cartdata = json_encode ( $cartarray );
				$orderid = date ( "YmdHis" ) . mt_rand ( 1, 9 );
				$time = date ( "Y/m/d H:i:s" );
				$user = M ( "User" )->where ( array (
						"uid" => $uid 
				) )->find ();
				
				$data ["orderid"] = $orderid;
				$data ["totalprice"] = $totalprice;
				$data ["pay_style"] = "货到付款";
				$data ["pay_status"] = "0";
				$data ["note"] = $note;
				$data ["order_status"] = '0';
				$data ["time"] = $time;
				$data ["cartdata"] = $cartdata;
				$data ["user_id"] = $user ["id"];
				
				$result = M ( "Order" )->add ( $data );
				if ($result) {
					$this->ajaxReturn ( $result );
				}
				
				break;
			case 2 :
				$id = M ( "User" )->where ( array (
						"uid" => $uid 
				) )->find ();
				$id = $id ["id"];
				
				$result = M ( "Order" )->where ( array (
						"user_id" => $id 
				) )->select ();
				if ($result) {
					$this->ajaxReturn ( $result );
				}
				break;
			case 3 :
				$orderid = I("post.orderid");
				$result = M ( "Order" )->where ( array (
						"orderid" => $orderid 
				) )->find ();
				
				$user = M ( "User" )->where ( array (
						"uid" => $uid 
				) )->find ();
				
				$result = array_merge ( $result, $user );
				
				if ($result) {
					$this->ajaxReturn ( $result );
				}
				
				break;
			default :
				;
				break;
		}
	}
}