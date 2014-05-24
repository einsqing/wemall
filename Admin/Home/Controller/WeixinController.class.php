<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;

use Think\Controller;

class WeixinController extends Controller {
	public function index() {
		// $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
		// $this->display();
		$m = M ( 'weixin' );
		$arr = $m->where ( 'id=1' )->select ();
		// dump($arr);
		if ($arr) {
			$this->assign ( 'weixinset', $arr );
		}
		$this->assign('username',$_SESSION['username']);
		$this->display ();
	}
	public function weixinset() {
		if ($_POST ['weixinset']) {
			$m = M ( 'weixin' );
			$weixinarr = array (
					'title' => $_POST ['title'],
					'description' => $_POST ['description'],
					'img' => $_POST ['img'] 
			);
			$m->where ( 'id=1' )->save ( $weixinarr );
			$this->success ( '微信配置成功' );
		}
	}
	public function autoreplay(){
		$this->display();
	}
	public function diynav(){
		$this->display();
	}
}