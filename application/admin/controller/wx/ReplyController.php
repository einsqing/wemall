<?php
namespace app\admin\controller\wx;
use app\admin\controller\BaseController;

class ReplyController extends BaseController
{
	//微信自定义回复
	public function index(){
		$replylist = model('WxReply')->with('file')->select()->toArray();

		cookie("prevUrl", request()->url());

		$this->assign('replylist', $replylist);
		return view();
	}

	//新增修改自定义回复
	public function add(){
		if (request()->isPost()){
			$data = input('post.');

			if(input('post.id')){
				$result = model('WxReply')->update($data);
			}else{
				$result = model('WxReply')->create($data);
			}

			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$id = input('param.id');
			if($id){
				$reply = model('WxReply')->with('file')->find($id);
				$this->assign('reply', $reply);
			}
			return view();
		}
	}

	//删除自定义回复
	public function del(){
		$ids = input('param.id');
		
		$result = model('WxReply')->destroy($ids);
		if($result){
			$this->success("删除成功", cookie("prevUrl"));
		}else{
			$this->error('删除失败', cookie("prevUrl"));
		}
	}



}