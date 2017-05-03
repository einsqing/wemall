<?php
namespace app\admin\controller\config;
use app\admin\controller\BaseController;

class SmsController extends BaseController
{
	//邮件配置
	public function index(){
		if (request()->isPost()){
			$data = input('post.');

			$result = model('Sms')->update($data);
			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$sms = model('Sms')->find();

			cookie("prevUrl", request()->url());

			$this->assign('sms', $sms);
			return view();
		}
	}

}