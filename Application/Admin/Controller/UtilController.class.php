<?php
namespace Admin\Controller;

class UtilController extends PublicController {
	function _initialize() {
		parent::_initialize ();
	}
	public function index(){
		$this->display();
	}
}