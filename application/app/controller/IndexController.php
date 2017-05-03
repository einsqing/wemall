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

class IndexController extends Controller
{
    public function index()
    {
        $theme = model('Config')->where('id',1)->value('theme');

        $view = new View();
        if (is_dir('./tpl/theme/'.$theme.'/dist/')) {
            return $view->fetch('./tpl/theme/'.$theme.'/dist/index.html');
        }else{
            return $view->fetch('./tpl/theme/'.$theme.'/index.html');
        }
    }
    
    public function themeStatic()
    {
        $referer = request()->header('referer');
        if(strpos($referer, '/addons/')){
            $referers = explode('/',$referer);
            if(strpos($referer, '/tpl/addons/')){
                if (is_dir('./tpl/addons/'.$referers[5].'/'.$referers[6].'/dist/')) {
                    $source = request()->root(true).'/tpl/addons/'.$referers[5].'/'.$referers[6].'/dist/'.request()->pathinfo();
                }else{
                    $source = request()->root(true).'/tpl/addons/'.$referers[5].'/'.$referers[6].'/'.request()->pathinfo();
                }
            }else{
                if (is_dir('./tpl/addons/'.$referers[4].'/'.$referers[5].'/dist/')) {
                    $source = request()->root(true).'/tpl/addons/'.$referers[4].'/'.$referers[5].'/dist/'.request()->pathinfo();
                }else{
                    $source = request()->root(true).'/tpl/addons/'.$referers[4].'/'.$referers[5].'/'.request()->pathinfo();
                }
            }

            $this->redirect($source);
        }else{
            $theme = model('Config')->where('id',1)->value('theme');
            if (is_dir('./tpl/theme/'.$theme.'/dist/')) {
                $this->redirect(request()->root(true).'/tpl/theme/'.$theme.'/dist/'. request()->pathinfo());  
            }else{
                $this->redirect(request()->root(true).'/tpl/theme/'.$theme.'/'. request()->pathinfo());  
            }
        }
    }

    public function source(){
        
        $file = request()->url(true);
        if (file_exists($file)) {
             $this->redirect($file);
        }else{
            return json('资源不存在', 404);
        }
    }
}
