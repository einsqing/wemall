<?php
namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller {
	function _initialize() {
		if (! $_SESSION ["wadmin"]) {
			$this->redirect ( "Admin/Login/index" );
		}
		// $_GET = $this->_get();
		// $_POST = $this->_post();
	}
	public function upload() {

		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 3145728; // 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      './Public/'; // 设置附件上传根目录
		$upload->savePath  =      './Uploads/'; // 设置附件上传（子）目录
		// 上传文件 
		$info   =   $upload->upload();
		if(!$info) {// 上传错误提示错误信息
		    $this->error($upload->getError());
		}else{// 上传成功 获取上传文件信息
		    foreach($info as $file){
		        // echo $file['savepath'].$file['savename'];
		    }
		}
		return $info;
	}
}