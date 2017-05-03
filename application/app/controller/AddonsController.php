<?php
/**
 * 
 * @authors 清月曦 (1604583867@qq.com)
 * @date    2017-05-02 15:40:06
 * @version $Id$
 */
namespace app\app\controller;
use think\Controller;
use think\View;

class AddonsController extends Controller
{
    protected $v = null;
    protected $addon = null;
    public function _initialize(){
        $this->v = $this->request->param('v', '');
        $this->addon = $this->request->param('addon', '');
    }
    public function index()
    {
        $view = new View();
        if (is_dir('./tpl/addons/'.$this->v.'/'.$this->addon.'/dist/')) {
            return $view->fetch('./tpl/addons/'.$this->v.'/'.$this->addon.'/dist/index.html');
        }else{
            return $view->fetch('./tpl/addons/'.$this->v.'/'.$this->addon.'/index.html');
        }
    }
}
