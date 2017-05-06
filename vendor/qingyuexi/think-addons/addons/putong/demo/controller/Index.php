<?php
namespace addons\putong\demo\controller;

use think\addons\Controller;

class Index extends Controller
{
	public function _initialize(){
        $this->view->engine->layout(false);
        $this->view->replace([
                '__CSS__'       =>  request()->root(true).'/addons/putong/demo/view/public/css',
                '__IMG__'       =>  request()->root(true).'/addons/putong/demo/view/public/image',
            ]);
	}
	
    public function index()
    {
        // $user_id = action('Api/BaseController/get_user_id',[]);
        // $user_id = (new \app\api\controller\basecontroller)->get_user_id();


        // halt($_SERVER);


        $user_id = 1;
        // $user = model('app\common\model\User')->with('contact,avater')->find($user_id)->toArray();
        // $this->assign("user", $user);

        // dump(model('addons\putong\demo\model\Demo')->ceshi());
        $this->assign("ceshi", 'ceshi');

        return $this->fetch();
    }





}
