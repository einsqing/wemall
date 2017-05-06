<?php
namespace addons\putong\demo\controller;

use think\addons\Controller;

class Admin extends Controller
{
	public function _initialize(){
        if ($this->request->isPjax()){
            $this->view->engine->layout(false);
        }else{
            $this->view->engine->layout('./application/admin/view/layout.html');
        }
        
        if (!is_file(ADDON_PATH . '/putong/demo/install.lock')) {
            $this->error('请先安装插件哦', cookie("prevUrl"));
        }
	}
	
    public function index()
    {

    	dump(model('addons\putong\demo\model\Demo')->ceshi());
        $this->assign("ceshi", 'ceshi');
        // return $this->fetch();
        return $this->view();
    }





}
