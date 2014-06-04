<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	public function index(){
	// $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
		$this->display('Login:index');
	}
	public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
	public function admin(){
		if (!isset( $_SESSION['username'] )) {
			if($_SESSION['verify'] == md5($_POST['verify'])) {

				$username = $_POST['username'];
		    	$pwd = $_POST['password'];
		    	 
		    	$m = M('admin');
		    	$arr = $m->where("username='$username' AND password='$pwd'")->select();
		    	
		    	if ($arr) {
		    		$_SESSION['username']=$username;
		    		$_SESSION['id']=$arr['id'];
		    	}else{
	    			$this->error('登录失败，请重新登录');
	    		}
	    		
	    	}else{
				$this->error('验证码错误！');
			}
		}


		if (isset( $_SESSION['username'] )) {

			import('ORG.Util.Page');// 导入分页类
			$orders = M('orders');

			$count      = $orders->count();// 查询满足要求的总记录数
			$Page       = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出

			$orders = $orders->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			// $orders = $orders->order('id desc')->select();

			for ($i=0; $i < count($orders); $i++) { 
				$uid = $orders[$i][uid];
				$users = M('users')->where('uid='.$uid)->select();
				// dump($users);
				if ($users) {//如果用户存在时
					$orders[$i] = array_merge($orders[$i] , $users);
					// array_push(array, var)
				}

				$orderid = $orders[$i][orderid];
				$orderdetail = M('orders_detail')->where('orderid='.$orderid)->select();
				// dump($orderdetail);
				if ($orderdetail) {
					$orders[$i] = array_merge($orders[$i] , $orderdetail);
				}
				$orders[$i]['length'] = count($orderdetail)+1;

			}
			
			// dump($orders);
			$this->assign('page',$show);// 赋值分页输出
			$this->assign('username',$_SESSION['username']);
			$this->assign('orders',$orders);
			$this->display('Admin/index');
		}
	}
	public function quit(){
		unset($_SESSION['username']);
		$this->success('已注销登录！','index');
	}
}