<?php
namespace app\admin\controller\tpl;
use app\admin\controller\BaseController;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;

class SmsController extends BaseController
{
	//短信模版列表
	public function index(){
		$smslist = model('SmsTpl')->paginate();
		// halt($maillist->toArray());
		cookie("prevUrl", $this->request->url());

		$this->assign('smslist', $smslist);
		return view();
	}

	//新增修改短信模版
	public function add(){
		if (request()->isPost()){
			$data = input('post.');
			if($data['id']){
				$result = model('SmsTpl')->update($data);
			}else{
				$result = model('SmsTpl')->create($data);
			}
			if($result){
				$this->success("保存成功", cookie("prevUrl"));
			}else{
				$this->error('保存失败', cookie("prevUrl"));
			}
		}else{
			$id = input('param.id');
			if($id){
				$sms = model('SmsTpl')->find($id);
				$this->assign('sms', $sms);
			}
			return view();
		}
	}

	//开启关闭短信模版
	public function update(){
		$data = input('param.');
		$result = model('SmsTpl')->where('id','in',$data['id'])->update(['status' => $data['status']]);
		if($result){
			$this->success("修改成功", cookie("prevUrl"));
		}else{
			$this->error('修改失败', cookie("prevUrl"));
		}
	}

	//发送测试短信
    public function send()
    {   
    	$id = input('param.id');
    	$tpl = model('SmsTpl')->find($id);

        $config_sms = model('Sms')->find()->toArray();
        // 配置信息
        $config = [
            'app_key'    => $config_sms['app_key'],
            'app_secret' => $config_sms['app_secret'],
            // 'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];
         
        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend;
        $req->setRecNum($tpl['phone'])
            ->setSmsParam([
                'code' => mt_rand(100000, 999999)
            ])
            ->setSmsFreeSignName($config_sms['sign'])
            ->setSmsTemplateCode($tpl['template_code']);

        $resp = $client->execute($req);
        $result = isset($resp->result->success) ? $resp->result->success : false;
        if($result){
            $this->success("发送成功", cookie("prevUrl"));
        }else{
            $msg = isset($resp->sub_msg) ? $resp->sub_msg : '发送失败,请检查短信配置';
        	$this->error($msg, cookie("prevUrl"));
        }
    }



}