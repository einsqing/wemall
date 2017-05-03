<?php
namespace app\admin\controller\tpl;
use app\admin\controller\BaseController;

class MailController extends BaseController
{
	//邮件模版列表
	public function index(){
		$maillist = model('MailTpl')->paginate();
		// halt($maillist->toArray());
		cookie("prevUrl", $this->request->url());

		$this->assign('maillist', $maillist);
		return view();
	}

	//新增修改邮件模版
	public function add(){
		if (request()->isPost()){
			$data = input('post.');
			if($data['id']){
				$result = model('MailTpl')->update($data);
			}else{
				$result = model('MailTpl')->create($data);
			}
			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$id = input('param.id');
			if($id){
				$mail = model('MailTpl')->find($id);
				$this->assign('mail', $mail);
			}
			return view();
		}
	}

	//改变邮件模版状态
	public function update(){
		$data = input('param.');
		$result = model('MailTpl')->where('id','in',$data['id'])->update(['status' => $data['status']]);
		if($result){
			$this->success("修改成功", cookie("prevUrl"));
		}else{
			$this->error('修改失败', cookie("prevUrl"));
		}
	}

	//发送测试邮件
    public function send()
    {
    	$id = input('param.id');
    	$mail_tpl = model('MailTpl')->find($id);

    	$toemail = $mail_tpl['mail'];  
		$name = $mail_tpl['mail'];//收件人昵称
		$subject='邮件测试';
		$code = mt_rand(100000, 999999);//验证码
		// $mail_tpl = model('MailTpl')->where('type', 'register')->find()->toArray();
		$content = str_replace("\$code",$code,$mail_tpl['content']);
		$result = send_mail($toemail,$name,$subject,$content);
		if($result){
            $this->success("发送成功", cookie("prevUrl"));
        }else{
        	$this->success("发送失败", cookie("prevUrl"));
        }
    }









}