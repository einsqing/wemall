<?php

	/**
	* 
	*/
	
	Class WeixinAction extends Action{
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
			$img = $_POST['noupimg'];
			
			if ($_FILES['img']['name'] !== '') {
				$img = $this->upload();
				$img = $img[0][savename];
			}
			
			if ($_POST ['weixinset']) {
				$m = M ( 'weixin' );
				$weixinarr = array (
						'title' => $_POST ['title'],
						'description' => $_POST ['description'],
						'img' => $img 
				);


				// dump($weixinarr);
				$m->where ( 'id=1' )->save ( $weixinarr );
				$this->success ( '微信配置成功' );
			}
			// dump($img[0][savename]);
			// dump($_POST);
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
			 // 保存表单数据 包括附件数据
			// $User = M("User"); // 实例化User对象
			// $User->create(); // 创建数据对象
			// $User->photo = $info[0]['savename']; // 保存上传的照片根据需要自行组装
			// $User->add(); // 写入用户数据到数据库
			// $this->success('数据保存成功！');
			 // dump($info);
			 return $info;	
		}
	}
?>