<?php
namespace app\admin\controller\auth;
use app\admin\controller\BaseController;

use app\common\model\AuthGroup;
use app\common\model\AuthRule;
class GroupController extends BaseController
{
	//用户组列表
	public function index(){
		$grouplist = AuthGroup::all();

		cookie("prevUrl", request()->url());

		$this->assign('grouplist', $grouplist);
		return view();
	}

	//新增修改用户组
	public function add(){
		if (request()->isPost()){
			$data = input('post.');
			$data['rules'] = implode(',',$data['rules']);

			if(input('post.id')){
				if(input('post.id') == 1){
					$this->error('默认用户组不允许修改', cookie("prevUrl"));
				}else{
					$result = AuthGroup::update($data);
				}
			}else{
				$result = AuthGroup::create($data);
			}

			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$id = input('param.id');
			if($id){
				$group = AuthGroup::find($id);
				$this->assign('group', $group);
			}
			$rule = AuthRule::all();
            $this->assign("rule", $rule);
			return view();
		}
	}
	//删除用户组
	public function del(){
		$ids = input('param.id');
		if($ids == 1){
			$this->error('默认用户组不允许删除', cookie("prevUrl"));
		}
		$result = AuthGroup::destroy($ids);
		if($result){
			$this->success("删除成功", cookie("prevUrl"));
		}else{
			$this->error('删除失败', cookie("prevUrl"));
		}
	}
	//改变用户组状态
	public function update(){
		$data = input('param.');
		if($data['id'] == 1){
			$this->error('默认用户组不允许操作', cookie("prevUrl"));
		}
		$result = AuthGroup::where('id', $data['id'])->update(['status' => $data['status']]);
		if($result){
			$this->success("修改成功", cookie("prevUrl"));
		}else{
			$this->error('修改失败', cookie("prevUrl"));
		}
	}


}