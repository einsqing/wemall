<?php
namespace Admin\Controller;

class UserController extends PublicController {
	function _initialize() {
		parent::_initialize ();
	}
	public function index() {
		$m = M ( "User" );
		
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new \Think\Page($count, 12);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig('theme', "<ul class='pagination no-margin pull-right'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
		
		$result = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		
		$this->assign ( "result", $result );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->display ();
	}
}