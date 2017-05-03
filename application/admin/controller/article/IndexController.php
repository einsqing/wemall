<?php
namespace app\admin\controller\article;
use app\admin\controller\BaseController;

use app\common\model\Article;
use app\common\model\ArticleCategory;
class IndexController extends BaseController
{
	//文章列表
	public function index(){
		$articlelist = Article::with('category')->order('id desc')->paginate();
		
		cookie("prevUrl", request()->url());

		$this->assign('articlelist', $articlelist);
		return view();
	}

	//新增修改文章
	public function add(){
		if (request()->isPost()){
			$data = input('post.');
			$data['status'] = input('?post.status') ? $data['status'] : 0;
			
			if(input('post.id')){
				$result = Article::update($data);
			}else{
				$result = Article::create($data);
			}

			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$id = input('param.id');
			if($id){
				$article = Article::find($id);
				$this->assign('article', $article);
			}
			$category = ArticleCategory::all()->toArray();
			$tree = list_to_tree($category, 'id', 'pid', 'sub');
            $this->assign("category", $tree);
			return view();
		}
	}

	//改变文章状态
	public function update(){
		$data = input('param.');
		$result = Article::where('id','in',$data['id'])->update(['status' => $data['status']]);
		if($result){
			$this->success("修改成功", cookie("prevUrl"));
		}else{
			$this->error('修改失败', cookie("prevUrl"));
		}
	}

	//删除文章
	public function del(){
		$ids = input('param.id');
		
		$result = Article::destroy($ids);
		if($result){
			$this->success("删除成功", cookie("prevUrl"));
		}else{
			$this->error('删除失败', cookie("prevUrl"));
		}
	}


}