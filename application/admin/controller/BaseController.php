<?php
/**
 * 
 * @authors 清月曦 (1604583867@qq.com)
 * @date    2017-05-01 11:27:23
 * @version $Id$
 */
namespace app\admin\controller;
use think\Controller;

class BaseController extends Controller
{
    public function _initialize(){
        // 判断是否登录，没有登录跳转登录页面
        if(!session('user_auth') || !session('user_auth_sign')){
            $this->redirect('public/login');
        }

        $activeRouter = request()->module() . '/' . request()->controller() . '/' . request()->action();
        // dump(strtolower($activeRouter));
        if(!in_array(strtolower($activeRouter), array("admin/help/index","admin/addons/getfiledownload","admin/addons/compare"))){
            $auth = new \com\Auth();
            if(!$auth->check($activeRouter, session('user_auth')['uid'])){
                return $this->error('你没有权限',cookie("prevUrl"));
            }
        }

        if ($this->request->isPjax()){
			$this->view->engine->layout(false);
		}else{
			$this->view->engine->layout(true);
		}
    }



}