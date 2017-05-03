<?php
namespace addons\putong\demo\controller;

use think\addons\Controller;

class Index extends Controller
{
	public function _initialize(){
        //插件资源文件
        $this->view->replace([
                '__CSS__'       =>  request()->root(true).'/addons/putong/demo/view/public/css',
                '__IMG__'       =>  request()->root(true).'/addons/putong/demo/view/public/image',
            ]);
	}
	
    public function index()
    {

        return view('index_index');
    }





}
