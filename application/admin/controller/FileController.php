<?php
namespace app\admin\controller;

class FileController extends BaseController
{
	// 图片列表
	public function index(){
		$filelist = model('File')->order('id', 'desc')->paginate(12);
		$page = $filelist->render();
		cookie("imgUrl", $this->request->url());
		
		$this->assign('filelist', $filelist);
		$this->assign('page', $page);
		// 临时关闭当前模板的布局功能
        $this->view->engine->layout(false);
		return view();
	}
	//上传图片
	public function upload(){
		// 获取表单上传文件
        $files = $this->request->file('image');
        $data = array();
        foreach($files as $file){
        	// 移动到框架应用根目录/public/uploads/ 目录下
	        $info = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'uploads');
	        if ($info) {
	            $item = array();
	            $item['name'] = $info->getInfo('name');
	            $item['type'] = $info->getInfo('type');
	            $item['savename'] = $info->getFilename();
            	$item['savepath'] = date("Ymd") .'/';
            	array_push($data,$item);
	        } else {
	            // 上传失败获取错误信息
	            $this->error($file->getError());
	        }
        }   
        model('File')->saveAll($data);
        $this->success('文件上传成功',cookie("imgUrl"));     
	}


}