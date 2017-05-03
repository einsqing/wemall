<?php
namespace app\admin\controller\tpl;
use app\admin\controller\BaseController;

class ShopController extends BaseController
{
	//商城模版设置
	public function index(){
		if (input('param.theme')){
			$theme = input('param.theme');
			
			model('Config')->where('id',1)->setField('theme', $theme);
			$this->success("设置成功", cookie("prevUrl"));
		}else{
			$config = model('Config')->find();
			cookie("prevUrl", $this->request->url());

			$themedir = getDir("./tpl/theme");

			$this->assign("rootUrl", request()->root(true));
			$this->assign("theme", $themedir);
			$this->assign("settheme", $config["theme"]);
			return view();
		}
	}
}