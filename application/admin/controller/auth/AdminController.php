<?php
namespace app\admin\controller\auth;
use app\admin\controller\BaseController;

use app\common\model\Admin;
use app\common\model\AuthGroupAccess;
class AdminController extends BaseController
{ 
    
	//管理员列表
	public function index(){
		$adminlist = Admin::all();

		cookie("prevUrl", request()->url());

		$this->assign('adminlist', $adminlist);
		return view();
	}
	//新增修改用管理员
	public function add(){
		if (request()->isPost()){
			$data = input('post.');
			if($data['password']){
				$data['password'] = md5($data['password']);
			}else{
				unset($data['password']);
			}
			if($data['id']){
				$oid = Admin::where('username', $data['username'])->value('id');
				if ($oid && $oid != $data['id']){
					$this->error('用户名已存在', cookie("prevUrl"));
				}
				if($data['id'] == 1){
					if($data['id'] == session('user_auth.uid')){
						$result = Admin::update($data);
					}else{
						$this->error('非超管不能编辑', cookie("prevUrl"));
					}
				}else{
					$result = Admin::update($data);
					AuthGroupAccess::where('uid',$data['id'])->update(['group_id' => $data['group_id']]);
				}
			}else{
				$Admin = new Admin;
				$result = $Admin->validate(true)->save($data);
				if(false === $result){
				    // 验证失败 输出错误信息
				    $this->error($Admin->getError(), cookie("prevUrl"));
				}
				$uid = $Admin->getLastInsID();
				AuthGroupAccess::create([
					'uid' =>  $uid,
					'group_id' =>  $data['group_id'],
				]);
			}

			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$id = input('param.id');
			if($id){
				$admin = Admin::find($id);
				$this->assign('admin', $admin);
			}
			$group = model("AuthGroup")->all();
            $this->assign("group", $group);
			return view();
		}
	}
	//删除用户组
	public function del(){
		$ids = input('param.id');
		if($ids == 1){
			$this->error('默认管理员不允许删除', cookie("prevUrl"));
		}
		$result = Admin::destroy($ids);
		if($result){
			AuthGroupAccess::where('uid','in',$ids)->delete();
			$this->success("删除成功", cookie("prevUrl"));
		}else{
			$this->error('删除失败', cookie("prevUrl"));
		}
	}

	//改变管理员状态
	public function update(){
		$data = input('param.');
		if($data['id'] == 1){
			$this->error('默认管理员不允许操作', cookie("prevUrl"));
		}
		$result = Admin::where('id', $data['id'])->update(['status' => $data['status']]);
		if($result){
			$this->success("修改成功", cookie("prevUrl"));
		}else{
			$this->error('修改失败', cookie("prevUrl"));
		}
	}




}