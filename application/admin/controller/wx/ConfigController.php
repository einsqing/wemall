<?php
namespace app\admin\controller\wx;
use app\admin\controller\BaseController;

class ConfigController extends BaseController
{
	//微信设置
	public function index(){
		if (request()->isPost()){
			$data = input('post.');

			$result = model('WxConfig')->update($data);
			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$config = model('WxConfig')->find();
			cookie("prevUrl", request()->url());

			$this->assign("url", 'http://' . $_SERVER["HTTP_HOST"] . "/admin/wechat/index");
			$this->assign('config', $config);
			return view();
		}
	}


}