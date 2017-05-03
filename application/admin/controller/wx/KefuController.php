<?php
namespace app\admin\controller\wx;
use app\admin\controller\BaseController;

class KefuController extends BaseController
{
	//微信客服设置
	public function index(){
		if (request()->isPost()){
			$data = input('post.');

			$result = model('WxKefu')->update($data);
			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$kefu = model('WxKefu')->find();
			cookie("prevUrl", request()->url());

			$this->assign('kefu', $kefu);
			return view();
		}
	}


}