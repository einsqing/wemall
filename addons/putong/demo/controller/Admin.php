<?php
namespace addons\putong\demo\controller;

use think\addons\Controller;
use addons\putong\demo\model\AddonsPutongDemoConfig;

class Admin extends Controller
{
	public function _initialize(){
        // 判断是否登录，没有登录跳转登录页面
        if(!session('user_auth') || !session('user_auth_sign')){
            $this->redirect('admin/public/login');
        }
        if ($this->request->isPjax()){
            $this->view->engine->layout(false);
        }else{
            $this->view->engine->layout('./application/admin/view/layout_addons.html');
        }
	}
	
    //活动列表
    public function index()
    {
        $configList = AddonsPutongDemoConfig::with('file')->order('id desc')->paginate();
        // dump($configList->toArray());
        cookie("prevUrl", request()->url());

        $this->assign('configList', $configList);
        return view('admin_index');
    }

    //新增修改活动
    public function add()
    {   
        if (request()->isPost()){
            $data = input('post.');
            $data['status'] = input('?post.status') ? $data['status'] : 0;

            if(input('post.id')){
                $result = AddonsPutongDemoConfig::update($data);
            }else{
                $result = AddonsPutongDemoConfig::create($data);
            }

            if($result){
                $this->success("保存成功", cookie("prevUrl"));
            }else{
                $this->error('保存失败', cookie("prevUrl"));
            }
        }else{
            $id = input('param.id');
            if($id){
                $config = AddonsPutongDemoConfig::with('file')->find($id);
                $this->assign('config', $config);
            }

            return view('admin_add');
        }
    }

    //更新状态
    public function update()
    {
        $data = input('param.');

        $result = AddonsPutongDemoConfig::where('id','in',$data['id'])->update(['status' => $data['status']]);
        if($result){
            $this->success("修改成功", cookie("prevUrl"));
        }else{
            $this->error('修改失败', cookie("prevUrl"));
        }
    }


}
