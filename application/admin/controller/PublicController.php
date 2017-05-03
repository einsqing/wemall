<?php
/**
 * 
 * @authors 清月曦 (1604583867@qq.com)
 * @date    2017-05-01 11:29:17
 * @version $Id$
 */
namespace app\admin\controller;
use think\Controller;

use app\common\model\Admin;
class PublicController extends Controller
{
    /**
     * 后台登录
     * @author 清月曦 (1604583867@qq.com)
     * @date    2017-05-01 11:29:18
     * @return   [type]                   [login]
     */
	public function login()
    {
    	if (request()->isPost()){
            $data = input('post.');
            if (!captcha_check($data['verify'])) {
                return json(['status' => 0, 'msg' => '验证码不正确！']);
            }
            $uid = (new Admin)->login($data['username'], $data['password']);

            if($uid > 0){
                /*记录session和cookie*/
                $group_id = Admin::where('id', $uid)->value('group_id');

                $auth = [
                    'uid'=>$uid,
                    'group_id'=>$group_id,
                    'username'=>$data['username'],
                    'last_login_time'=>date("Y-m-d H:i:s"),
                ];
                session('user_auth',$auth);
                session('user_auth_sign', data_auth_sign($auth));
                return json(['status' => 1, 'msg' => '登录成功！']);
            }else{
                switch ($uid) {
                    case '-1':
                        $info = ['status' => 0, 'msg' => '用户不存在或被禁用'];
                        break;
                    case '-2':
                        $info = ['status' => 0, 'msg' => '密码错误'];
                        break;  
                    default:
                        $info = ['status' => 0, 'msg' => '未知错误'];
                        break;
                }
                return json($info);
            }
    	}else{
            // 检测登录状态
            if(session('user_auth') && session('user_auth_sign')){
                $this->redirect('index/index');
            }
    		return view();
    	}
    }
    /**
     * 退出登录状态
     * @author 清月曦 (1604583867@qq.com)
     * @date    2017-05-01 11:29:19
     * @return   [type]                   [out]
     */
    public function loginout(){
        session(null);
        $this->redirect('index/index');
    }
}