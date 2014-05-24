<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function index(){
// 	$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
//     $this->display();
    	if ($_POST['username'] && $this->check_verify($_POST['verify'])) {
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
    	}
    	
  
    	if (isset($_SESSION['username'])) {
    			$m = M('orders');
    			$count = $m->count();
    			$page = new \Think\Page($count, 10);
    			 
    			$page->setConfig('header','页');
    			$page->setConfig('prev',"上一页");
    			$page->setConfig('next','下一页');
    			$page->setConfig('first','首页');
    			$page->setConfig('last','尾页');
    			$page->setConfig('theme','共%TOTAL_PAGE%页  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    			 
    			$show = $page->show();
    			 
    			$list = $m->order('id DESC')->limit($page->firstRow.','.$page->listRows)->select();
    			$this->assign('list',$list);
    			$this->assign('page',$show);
    			$marr = M('orders_detail');
    			$arrdetail = $marr->select();
    			 
    			$this->assign('listdetail',$arrdetail);
    			$this->assign('username',$_SESSION['username']);
    			 
    			$this->display();
    			 
    		}else {
    			$this->redirect('Index/index');
    		}
    }
    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    function check_verify($code, $id = ''){
    	$verify = new \Think\Verify();
    	return $verify->check($code, $id);
    }
    
    public function product() {
    	
    	$prod = M('menu');
    	$count = $prod->count();
    	$page = new \Think\Page($count, 10);
    		
    	$page->setConfig('header','页');
    	$page->setConfig('prev',"上一页");
    	$page->setConfig('next','下一页');
    	$page->setConfig('first','首页');
    	$page->setConfig('last','尾页');
    	$page->setConfig('theme','共%TOTAL_PAGE%页  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    		
    	$show = $page->show();
    	
    	$prodata = $prod->limit($page->firstRow.','.$page->listRows)->select();
    	// 		dump($prodata);
    	$this->assign('username',$_SESSION['username']);
    	$this->assign('product',$prodata);
    	$this->assign('page',$show);
    	$this->display();
    }
    public function productcate() {
    	$cate = M('nav');
    	$nav = $cate->select();
    	$this->assign('username',$_SESSION['username']);
    	$this->assign('nav',$nav);
    	$this->display();
    }
    public function reproductcate() {
    	
    	$nav1 = $_POST['nav1'];
		$nav2 = $_POST['nav2'];
		$nav3 = $_POST['nav3'];
		$nav4 = $_POST['nav4'];
		
		$nav = M("nav"); // 实例化User对象
		// 要修改的数据对象属性赋值
		$nav->value = $nav1;
		$nav->where('id=1')->save();
		
		$nav->value = $nav2;
		$nav->where('id=2')->save();
		
		$nav->value = $nav3;
		$nav->where('id=3')->save();
		
		$nav->value = $nav4;
		$nav->where('id=4')->save();
		
		$this->success('导航栏修改成功','index');
    }
    public function quit(){
    	if ($_SESSION['username']) {
    		unset($_SESSION['username']);
    	}
    	$this->success('已注销登录！','index');
    }
	public function reproduct(){
		if ($_GET['id']) {
			
			$reid = $_GET['id'];
			$resel = M('menu');
			$resel = $resel->where('id = '.$reid)->select();

			$this->assign('prosel',$resel);
			$this->assign('username',$_SESSION['username']);
			$this->display();
		}
	}
	public function delproduct(){
		if ($_GET['id']) {
			$id = $_GET['id'];
			$menu = M('menu');
			$menu->delete($id);
			$this->success('删除成功');
		}
	}
	public function addproduct(){
		if ($_POST['reproduct']) {
			$img = $_POST['noupimg'];
			
			if ($_FILES['img']['name'] !== '') {
				$img = $this->upload();
			}
			
			if ($_POST['id']) {
				$prore = M('menu');
				$resave = array(
					'id' => $_POST['id'],
					'cate_id' => $_POST['cate_id'],
					'title' => $_POST['title'],
					'price' => $_POST['price'],
					'old_price' => $_POST['old_price'],
					'img' => $img,
					'detail' => $_POST['detail']
				);

				$prore->where('id='.$_POST['id'])->save($resave);
				$this->success('商品修改成功',__CONTROLLER__.'/product');
			}else{
				$prore = M('menu');
				
				$resave = array(
						'cate_id' => $_POST['cate_id'],
						'title' => $_POST['title'],
						'price' => $_POST['price'],
						'old_price' => $_POST['old_price'],
						'img' => $img,
						'detail' => $_POST['detail']
				);
				$prore->add($resave);
				//$prore->data($resave)->add();
				$this->success('商品添加成功',__CONTROLLER__.'/product');
			}
		}else {
			$this->assign('username',$_SESSION['username']);
			$this->display('Admin:reproduct');
		}
	}
	
	public function upload(){
	    $upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     209715;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
	    $upload->thumb     = 	true;

	    // 上传单个文件 
	    $info   =   $upload->uploadOne($_FILES['img']);
	    if(!$info) {// 上传错误提示错误信息
	        $this->error($upload->getError());
	    }else{// 上传成功 获取上传文件信息
	         return  $info['savepath'].$info['savename'];
	    }
	}
}