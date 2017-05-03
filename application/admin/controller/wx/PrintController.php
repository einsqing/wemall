<?php
namespace app\admin\controller\wx;
use app\admin\controller\BaseController;

class PrintController extends BaseController
{
	//微信打印机设置
	public function index(){
		if (request()->isPost()){
			$data = input('post.');

			$result = model('WxPrint')->update($data);
			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$print = model('WxPrint')->find();
			cookie("prevUrl", request()->url());

			$this->assign('print', $print);
			return view();
		}
	}


}