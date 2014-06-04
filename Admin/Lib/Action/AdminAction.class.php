<?php


Class AdminAction extends Action{
	public function nav(){
		$cate = M('nav');
    	$nav = $cate->select();
    	$this->assign('username',$_SESSION['username']);
    	$this->assign('nav',$nav);
		$this->display();
	}
	public function renav(){
		$nav = M('nav');
		$count = count($_POST);
		// TRUNCATE `wemall_nav`;
		// $sql = 'TRUNCATE '.C(DB_PREFIX).nav;
		// $nav->query('TRUNCATE '.C(DB_PREFIX).nav);

		for ($i=1; $i < $count; $i++) { 
			$data['id'] = $i;
			$data['value'] = $_POST['nav'.$i];
			$nav->data($data)->save();
		}
		
		$this->success('分类修改成功','nav');
	}

	public function addnav(){
		if ($_POST['addnav']) {
			// dump($_POST['addnav']);
			$nav = M('nav');
			$data['value'] = $_POST['addnav'];
			$nav->add($data);
			$this->success('添加分类成功','nav');
		}

		$this->assign('username',$_SESSION['username']);
		$this->display();
	}
	public function product(){
		import('ORG.Util.Page');// 导入分页类
		$prod = M('menu');
    	$count = $prod->count();
    	$Page  = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show  = $Page->show();// 分页显示输出
    	
    	$prodata = $prod->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	// 		dump($prodata);
    	$this->assign('username',$_SESSION['username']);
    	$this->assign('product',$prodata);
    	$this->assign('page',$show);
    	$this->display();
	}
	public function reproduct(){
		$tip = M('nav');
		$tip = $tip->select();
		// dump($tip);
		$reid = $_GET['id'];
		$resel = M('menu');
		$resel = $resel->where('id = '.$reid)->select();

		$this->assign('prosel',$resel);
		
		$this->assign('tip',$tip);
		$this->assign('username',$_SESSION['username']);
		$this->display();
	}
	public function upload(){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/';// 设置附件上传目录
		 if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		 }else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		 }

		 return $info;	
	}
	public function addproduct(){
		if ($_POST['reproduct']) {
			$img = $_POST['noupimg'];
			
			if ($_FILES['img']['name'] !== '') {
				$img = $this->upload();
				$img = $img[0][savename];
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
					'detail' => $_POST['detail'],
					'status' => $_POST['status']
				);

				$prore->where('id='.$_POST['id'])->save($resave);
				$this->success('商品修改成功','product');
			}else{
				$prore = M('menu');
				
				$resave = array(
						'cate_id' => $_POST['cate_id'],
						'title' => $_POST['title'],
						'price' => $_POST['price'],
						'old_price' => $_POST['old_price'],
						'img' => $img,
						'detail' => $_POST['detail'],
						'status' => $_POST['status']
				);
				$prore->add($resave);
				//$prore->data($resave)->add();
				$this->success('商品添加成功','product');
			}
		}else {
			$this->assign('username',$_SESSION['username']);
			$this->display('reproduct');
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
}


?>