<?php
namespace app\admin\controller\wx;
use app\admin\controller\BaseController;

class TplmsgController extends BaseController
{

	//微信模版消息
	public function index(){
		$tplmsglist = model('WxTplmsg')->all();
		// halt($tplmsglist->toArray());
		cookie("prevUrl", request()->url());

		$this->assign('tplmsglist', $tplmsglist);
		return view();
	}

	//新增编辑模版消息
	public function add(){
		if (request()->isPost()){
			$data = input('post.');
			$data['status'] = input('?post.status') ? $data['status'] : 0;
			if($data['id']){
				$result = model('WxTplmsg')->update($data);
			}else{
				$result = model('WxTplmsg')->create($data);
			}
			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$id = input('param.id');
			if($id){
				$tplmsg = model('WxTplmsg')->find($id);
				$this->assign('tplmsg', $tplmsg);
			}
			return view();
		}
	}

	//改变模版消息状态
	public function update(){
		$data = input('param.');
		$result = model('WxTplmsg')->where('id','in',$data['id'])->update(['status' => $data['status']]);
		if($result){
			$this->success("修改成功", cookie("prevUrl"));
		}else{
			$this->error('修改失败', cookie("prevUrl"));
		}
	}



}