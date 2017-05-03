<?php
namespace app\admin\controller;

use think\Controller;

class WechatController extends Controller
{
    public static $weObj;
    public static $appUrl;
    public static $revData;
    public static $revFrom;

    public function _initialize(){
        self::$appUrl = request()->root(true);
    }

    public function init()
    {
        vendor("dodgepudding.wechat-php-sdk.wechat#class");
        $config = model('WxConfig')->find()->toArray();

        $options = array(
            'token' => $config ["token"], //填写你设定的key
            'encodingaeskey' => $config ["encodingaeskey"], //填写加密用的EncodingAESKey
            'appid' => $config ["appid"], //填写高级调用功能的app id
            'appsecret' => $config ["appsecret"] //填写高级调用功能的密钥
        );

        self::$weObj = new \Wechat ($options);
    }

    public function index()
    {
        $this->init();

        if (request()->isGet()) {
            ob_clean();
            self::$weObj->valid();
        } else {
            if (!self::$weObj->valid(true)) {
                die('no access!!!');
            }
        }

        $type = self::$weObj->getRev()->getRevType();
        self::$revData = self::$weObj->getRevData();
        self::$revFrom = self::$weObj->getRevFrom();
        
        $this->check($type);
    }

    public function check($type)
    {
        switch ($type) {
            case \Wechat::MSGTYPE_TEXT:
                $this->checkKeywords();
                break;
            case \Wechat::MSGTYPE_EVENT:
                $this->checkEvents(self::$revData['Event']);
                break;
            case \Wechat::MSGTYPE_IMAGE:
                self::$weObj->text('本系统暂不支持图片信息！')->reply();
                break;
            default:
                self::$weObj->text('本系统暂时无法识别您的指令！')->reply();
        }
    }

    public function checkEvents($event)
    {
        $openId = self::$revData['FromUserName'];
        
        switch ($event) {
            case 'subscribe':
                $this->checkUser($openId);
                $this->checkKeyWords('subscribe');
                break;
            case 'unsubscribe':
                $this->updateUser($openId);
                break;
            case 'CLICK':
                $this->checkKeyWords(self::$revData['EventKey']);
                break;

        }
    }

    public function checkKeyWords($key = '')
    {
        $key = $key ? $key : self::$weObj->getRev()->getRevContent();
        if ($key == 'qqkf') {
            $reply = model('WxReply')->where('key',$key)->find();
            $qq = $reply["remark"];
            $str = "<a href='http://wpa.qq.com/msgrd?v=3&uin=" . $qq . "&site=qq&menu=yes&from=singlemessage'>" . htmlspecialchars_decode('点击联系QQ客服') . "</a>";
            self::$weObj->text($str)->reply();
            exit();
        }

        $reply = model('WxReply')->where('key',$key)->find();
        if ($reply) {
            if ($reply["type"] == "news") {
                $newsArr = array(
                    array(
                        'Title' => $reply["title"],
                        'Description' => $reply["description"],
                        'PicUrl' => self::$appUrl . '/public/uploads/' . $reply["savepath"] . $reply["savename"],
                        'Url' => $reply["url"]
                    )
                );
                self::$weObj->news($newsArr)->reply();
                exit();
            } else {
                self::$weObj->text($reply["title"])->reply();
                exit();
            }
        } else {
            // self::$weObj->text("请核对关键词!")->reply();

            $this->toKeyUnknow($key);
        }
    }

    public function toKeyUnknow($key)
    {
        // self::$weObj->text("未找到此关键词匹配！")->reply();
        //或取所有客服
        $kfList=self::$weObj->getCustomServiceKFlist();
        
        $wx_kefu = model('WxKefu')->find();
        
        $kf_account = '';
        if($wx_kefu['status']){
            foreach ($kfList['kf_list'] as $k => $value) { 
                if($value['kf_wx'] == $wx_kefu['kefu']){
                    $kf_account = $value['kf_account'];
                }
            } 
        }else{
            //随即客服
            $num=rand(0,count($kfList['kf_list'])-1);
            $kf_account = $kfList['kf_list'][$num]['kf_account'];
        }

        //获取用户openid；
        $openid = self::$revData['FromUserName'];
        
        self::$weObj->createKFSession($openid,$kf_account,$key);
    }

    public function checkUser($openId)
    {
        $oauth_wx = model('OauthWx')->where('openid',"$openId")->find();
  
        if ($oauth_wx) {
            model('OauthWx')->update(['id' => $oauth_wx['id'], 'subscribe' => 1]);
        }else{
            $userInfo  = self::$weObj->getUserInfo($openId);
            $avater_id = action('api/PublicController/getavater',['headimgurl' => $userInfo['headimgurl']]);
            $user = model('User')->create([
                'avater_id' => $avater_id,
                'username' => $userInfo['nickname'],
            ]);
            $oauth_wx = model('OauthWx')->create([
                    'user_id' => $user->id,
                    'openid' => $openId,
                    'nickname' => $userInfo['nickname'],
                    'sex' => $userInfo['sex'],
                    'city' => $userInfo['city'],
                    'country' => $userInfo['country'],
                    'province' => $userInfo['province'],
                    'language' => $userInfo['language'],
                    'headimgurl' => $userInfo['headimgurl'],
                    'subscribe_time' => date("Y-m-d h:i:s"),
                    'subscribe' => 1,
                ]);

            model("Analysis")->add(0, 0, 1, 0); //统计
        }
    }

    public function updateUser($openId)
    {
        $oauth_wx = model('OauthWx')->where('openid',"$openId")->find();
        if ($oauth_wx) {
            model('OauthWx')->update(['id' => $oauth_wx['id'], 'subscribe' => 0]);
        }
    }

    public function getQRCode()
    {
        $this->init();
        $ticket = self::$weObj->getQRCode("1", 1);
        $qrcode = self::$weObj->getQRUrl($ticket["ticket"]);
        if ($qrcode) {
            model('Config')->update(['id' => 1, 'qrcode' => $qrcode]);
            $this->success("生成二维码成功", "admin/config/shop");
        } else {
            $this->error("生成二维码失败", "admin/config/shop");
        }
    }

    public function getMenu()
    {
        $this->init();

        self::$weObj->getMenu();
    }

    public function createWxMenu()
    {
        $this->init();

        $menulist = model('WxMenu')->all()->toArray();
        $menutree = list_to_tree($menulist, 'id', 'pid', 'sub', 'rank', 'desc');

        $newmenu["button"] = array();
        foreach ($menutree as $k => $v) {
            if ($v["type"] == "view") {
                if ($v['sub']) {
                    $sub_button = array();
                    foreach ($v["sub"] as $kk => $sub) {
                        if ($sub["type"] == "view") {
                            array_push($sub_button, array('type' => 'view', 'name' => $sub["name"], 'url' => $sub["url"]));
                        }else{
                            array_push($sub_button, array('type' => 'click', 'name' => $sub["name"], 'key' => $sub["key"]));
                        }
                    }
                    array_push($newmenu["button"], array('name' => $v["name"], 'sub_button' => $sub_button));
                }else{
                    array_push($newmenu["button"], array('type' => 'view', 'name' => $v["name"], 'url' => $v["url"]));
                }
            }else{
                if ($v['sub']) {
                    $sub_button = array();
                    foreach ($v["sub"] as $kk => $sub) {
                        if ($sub["type"] == "view") {
                            array_push($sub_button, array('type' => 'view', 'name' => $sub["name"], 'url' => $sub["url"]));
                        } else {
                            array_push($sub_button, array('type' => 'click', 'name' => $sub["name"], 'key' => $sub["key"]));
                        }
                    }
                    array_push($newmenu["button"], array('name' => $v["name"], 'sub_button' => $sub_button));
                } else {
                    array_push($newmenu["button"], array('type' => 'click', 'name' => $v["name"], 'key' => $v["key"]));
                }
            }
        }

        $result = self::$weObj->createMenu($newmenu);
        if ($result) {
            $this->success("重新创建菜单成功!", "admin/wx/menu");
        } else {
            $this->error("重新创建菜单失败!", "admin/wx/menu");
        }
    }

    public function addTplMessageId($id)
    {
        $this->init();

        $tempMsg = model('WxTplmsg')->where('template_id_short',$id)->find();
        if ($tempMsg["template_id"]) {
            $template_id = $tempMsg["template_id"];
        } else {
            $template_id = self::$weObj->addTemplateMessage($id);
            if ($template_id) {
                model('WxTplmsg')->update(['id' => $tempMsg['id'], 'template_id' => $template_id]);
            }
        }
        $tempMsg = model('WxTplmsg')->where('template_id_short',$id)->find();

        return $tempMsg;
    }

    //新订单通知
    public function sendTplMsgOrder($order_id)
    {
        $this->init();

        $tempMsg = $this->addTplMessageId("OPENTM201785396");
        $order = model('Order')->with('user.wx,contact,delivery,detail')->find($order_id)->toArray();
        
        $msg = array();
        $msg["touser"] = $order['user']['wx']['openid'];
        $msg["template_id"] = $tempMsg['template_id'];
        $msg["url"] = "";
        $msg["topcolor"] = "";
        $msg["data"] = array(
            "first" => array(
                "value" => $tempMsg['title'],
                "color" => "#ff0000"
            ),
            "keyword1" => array(
                "value" => $order["orderid"],
                "color" => "#000000"
            ),
            "keyword2" => array(
                "value" => $order["payment"] . "," . $order["pay_status"],
                "color" => "#000000"
            ),
            "keyword3" => array(
                "value" => $order["totalprice"],
                "color" => "#000000"
            ),
            "keyword4" => array(
                "value" => $order["created_at"],
                "color" => "#000000"
            ),
            "keyword5" => array(
                "value" => "姓名:" . $order["contact"]["name"] . ",电话:" . $order["contact"]["phone"] . ",地址: " . $order["contact"]["province"] . $order["contact"]["city"] . $order["contact"]["address"],
                "color" => "#000000"
            ),
            "remark" => array(
                "value" => $tempMsg['remark'].$order["remark"],
                "color" => "#ff0000"
            ),
        );
        if($tempMsg['status']){
            self::$weObj->sendTemplateMessage($msg);
        }
        // $this->sendTplMessageOrderAdmin($order_id);
    }
    
    //员工通知
    public function sendTplMessageOrderAdmin($order_id)
    {
       
        $this->init();
         
        $order = model('Order')->with('user.wx,contact,delivery,detail.product')->find($order_id)->toArray();
       
        $tempMsg = $this->addTplMessageId("OPENTM201785396");

        $shop = model("Config")->find();
       
        $employee = explode(',', $shop["employee"]);
      
        foreach ($employee as $key => $value) {
            if(!$value){
                continue;
            }
        
            $openid = model('OauthWx')->where('user_id',$value)->value('openid');
            $data = '{
                "touser":"' . $openid . '",
                "template_id":"' . $tempMsg['template_id'] . '",
                "url":"' . "http://" . I("server.HTTP_HOST") . U("App/Admin/order",array("id"=>$order_id)).'",
                "topcolor":"#FF0000",
                "data":{
                    "first": {
                        "value":"客户新订单提醒",
                        "color":"#FF0000"
                        },
                    "keyword1":{
                        "value":"' . $order["orderid"] . '",
                        "color":"#0000ff"
                        },
                    "keyword2":{
                        "value":"' . $order["payment"] . '",
                        "color":"#0000ff"
                        },
                    "keyword3":{
                        "value":"' . $order["totalprice"] . '",
                        "color":"#0000ff"
                        },
                    "keyword4":{
                        "value":"' . $order["create_time"] . '",
                        "color":"#0000ff"
                        },
                    "keyword5":{
                        "value":"' . $order["contact"]["name"] . '-' . $order["contact"]["phone"] . '-' . $order["contact"]["province"] . $order["contact"]["city"] . $order["contact"]["address"] . '",
                        "color":"#0000ff"
                        },
                    "remark":{
                        "value":"配送时间：' .$order["delivery_time"]."备注：". $order["remark"] . '",
                        "color":"#0000ff"
                        }
                }
            }';

            $data = json_decode($data, true);
            self::$weObj->sendTemplateMessage($data);
        }
    }
    //订单支付成功通知
    public function sendTplMsgPay($order_id)
    {
        $this->init();

        $tempMsg = $this->addTplMessageId("OPENTM207791277");
        $order = model('Order')->with('user.wx')->find($order_id)->toArray();

        $msg = array();
        $msg["touser"] = $order["user"]['wx']["openid"];
        $msg["template_id"] = $tempMsg['template_id'];
        $msg["url"] = "";
        $msg["topcolor"] = "";
        $msg["data"] = array(
            "first" => array(
                "value" => $tempMsg['title'],
                "color" => "#ff0000"
            ),
            "keyword1" => array(
                "value" => $order["orderid"],
                "color" => "#000000"
            ),
            "keyword2" => array(
                "value" => $order["totalprice"].'元',
                "color" => "#000000"
            ),
            "remark" => array(
                "value" => $tempMsg["remark"],
                "color" => "#ff0000"
            ),
        );
        
        if($tempMsg['status']){
            self::$weObj->sendTemplateMessage($msg);
        }
    }

    //订单发货提醒
    public function sendTplMsgOrderPublish($order_id)
    {
        $this->init();
        $tempMsg = $this->addTplMessageId("OPENTM207763419");
        $order = model('Order')->with('user.wx,detail.product')->find($order_id)->toArray();
        
        $detail = '';
        foreach ($order['detail'] as $key => $value) {
            if($value['sku_name']){
                $detail .= '【'.$value['name'].'('.$value['sku_name'].')'.$value['price'].'元x'.$value['num'].'份】';
            }else{
                $detail .= '【'.$value['name'].$value['price'].'元x'.$value['num'].'份】';
            }
        }

        $msg = array();
        $msg["touser"] = $order['user']['wx']["openid"];
        $msg["template_id"] = $tempMsg['template_id'];
        $msg["url"] = "";
        $msg["topcolor"] = "";
        $msg["data"] = array(
            "first" => array(
                "value" => $tempMsg['title'],
                "color" => "#ff0000"
            ),
            "keyword1" => array(
                "value" => '合计'.$order["totalprice"].'元',
                "color" => "#000000"
            ),
            "keyword2" => array(
                "value" => $detail,
                "color" => "#000000"
            ),
            "remark" => array(
                "value" => $tempMsg["remark"].'|'.$order["remark"],
                "color" => "#ff0000"
            ),
        );

        if($tempMsg['status']){
            self::$weObj->sendTemplateMessage($msg);
        }
    }



}