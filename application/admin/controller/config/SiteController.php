<?php
namespace app\admin\controller\config;
use app\admin\controller\BaseController;

use app\common\model\Config;
class SiteController extends BaseController
{ 
    
	//站点设置
	public function index(){
		if (request()->isPost()){
			$data = input('post.');
			$result = Config::update($data);
			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$config = Config::with('logo')->find();

			cookie("prevUrl", request()->url());

			$this->assign('config', $config);
			return view();
		}
	}


}