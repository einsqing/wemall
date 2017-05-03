<?php
namespace app\admin\controller\user;
use app\admin\controller\BaseController;

use app\common\model\UserLevel;
class LevelController extends BaseController
{

	//等级列表
	public function index(){
		$levellist = UserLevel::all();

		cookie("prevUrl", $this->request->url());

		$this->assign('levellist', $levellist);
		return view();
	}


	//新增修改等级
	public function add(){
		if (request()->isPost()){
			$data = input('post.');
			if(input('post.id')){
				$result = UserLevel::update($data);
			}else{
				$result = UserLevel::create($data);
			}

			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$id = input('param.id');
			if($id){
				$level = UserLevel::find($id);
				$this->assign('level', $level);
			}
			return view();
		}
	}


}