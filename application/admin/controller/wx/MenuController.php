<?php
namespace app\admin\controller\wx;
use app\admin\controller\BaseController;

class MenuController extends BaseController
{
	//微信菜单
	public function index(){
		$menulist = model('WxMenu')->all()->toArray();
		cookie("prevUrl", request()->url());

		$tree = list_to_tree($menulist, 'id', 'pid', 'sub', 'rank', 'desc');

		$this->assign('menulist', $tree);
		return view();
	}

	//新增修改微信菜单
	public function add(){
		if (request()->isPost()){
			$data = input('post.');
			if(input('post.id')){
				$result = model('WxMenu')->update($data);
			}else{
				$result = model('WxMenu')->create($data);
			}

			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$id = input('param.id');
			if($id){
				$menu = model('WxMenu')->find($id);
				$this->assign('menu', $menu);
			}
			$parentmenu = model('WxMenu')->all(['pid'=>0]);
            $this->assign("parentmenu", $parentmenu);
			return view();
		}
	}
	//删除微信菜单
	public function del(){
		$ids = input('param.id');
		
		$result = model('WxMenu')->destroy($ids);
		if($result){
			$this->success("删除成功", cookie("prevUrl"));
		}else{
			$this->error('删除失败', cookie("prevUrl"));
		}
	}



}