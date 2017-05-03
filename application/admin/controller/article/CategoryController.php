<?php
namespace app\admin\controller\article;
use app\admin\controller\BaseController;

use app\common\model\ArticleCategory;
use app\common\model\Article;
class CategoryController extends BaseController
{
	//文章分类
	public function index(){
		$categorylist = ArticleCategory::all()->toArray();
		
		cookie("prevUrl", request()->url());

		$tree = list_to_tree($categorylist, 'id', 'pid', 'sub');

		$this->assign('categorylist', $tree);
		return view();
	}

	//新增修改文章分类
	public function add(){
		if (request()->isPost()){
			$data = input('post.');
			$data['status'] = input('?post.status') ? $data['status'] : 0;
			
			if(input('post.id')){
				$result = ArticleCategory::update($data);
			}else{
				$result = ArticleCategory::create($data);
			}

			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$id = input('param.id');
			if($id){
				$category = ArticleCategory::find($id);
				$this->assign('category', $category);
			}
			$parentcategory = ArticleCategory::all(['pid'=>0]);
            $this->assign("parentcategory", $parentcategory);
			return view();
		}
	}

	//改变文章类型状态
	public function update(){
		$data = input('param.');
		$result = ArticleCategory::where('id','in',$data['id'])->update(['status' => $data['status']]);
		Article::where('category_id',$data['id'])->update(['status' => $data['status']]);
		if($result){
			$this->success("修改成功", cookie("prevUrl"));
		}else{
			$this->error('修改失败', cookie("prevUrl"));
		}
	}

	//删除文章分类
	public function del(){
		$ids = input('param.id');
		
		$result = ArticleCategory::destroy($ids);
		if($result){
			$this->success("删除成功", cookie("prevUrl"));
		}else{
			$this->error('删除失败', cookie("prevUrl"));
		}
	}
}