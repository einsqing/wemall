<?php
namespace Admin\Controller;
use Think\Image;
use Think\Upload;

class GoodController extends PublicController {
	function _initialize() {
		parent::_initialize ();
	}
	public function index() {
		$m = M ( "Good" );

		$count = $m->count (); // 查询满足要求的总记录数

		$Page = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");

		$show = $Page->show (); // 分页显示输出

		$result = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		
		for($i = 0; $i < count ( $result ); $i ++) {
			$menu_id = $result [$i] ["menu_id"];
			$result [$i] ["menu"] = R ( "Api/Api/getmenuvalue", array (
					$menu_id 
			) );
		}
		$menu = R ( "Api/Api/getarraymenu" );
		
		$this->assign ( "menu", $menu );
		$this->assign ( "addmenu", $menu );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "result", $result );
		$this->display ();
	}

	public function addgood2() {
		$img = $this->upload ();
		print_r($img);
	}

	public function addgood() {
		$datagood = I("post.");

		if ($datagood["goodid"]) {
			$data ["id"] = $datagood["goodid"];
			$data ["menu_id"] = $datagood["addmenuid"];
			$data ["name"] = $datagood["addname"];
			$data ["price"] = $datagood["addprice"];
			$data ["old_price"] = $datagood["add_old_price"];
			$data ["sort"] = $datagood["addsort"];
			if ($_FILES ['addimage'] ['name'] !== '') {
				$img = $this->upload ();
				$data ["image"] = $img [addimage] [savename];
				$data ["savepath"] = ltrim($img [addimage] [savepath], ".");
			}
			$data ["status"] = $datagood["addstatus"];

			$data ["detail"] = I("post.editorValue",'','stripslashes');

			$result = R ( "Api/Api/addgood", array($data) );
			$this->success ( "修改商品成功！" );
		}else{
			$data ["menu_id"] = $datagood["addmenuid"];
			$data ["name"] = $datagood["addname"];
			$data ["price"] = $datagood["addprice"];
			$data ["old_price"] = $datagood["add_old_price"];
			$data ["sort"] = $datagood["addsort"];
			if ($_FILES ['addimage'] ['name'] !== '') {
				$img = $this->upload ();
				$data ["image"] = $img [addimage] [savename];
				$data ["savepath"] = ltrim($img [addimage] [savepath], ".");
			} else {
				$this->error ( "未上传图片！" );
			}
			$data ["status"] = $datagood["addstatus"];
			$data ["detail"] = I("post.editorValue",'','stripslashes');
			
			$result = R ( "Api/Api/addgood", array($data) );
			$this->success ( "添加商品成功！" );			
		}
	}
	public function delgood() {
		$result = R ( "Api/Api/delgood", array (I("get.id")) );
		$this->success ( "删除商品成功！" );
	}
	public function getgoodid() {

		$id = I("post.id");
		$result = M ( "Good" )->where ( array (
				"id" => $id 
		) )->find ();
		if ($result) {
			$this->ajaxReturn ( $result );
		}
	}
}