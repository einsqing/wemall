<?php
namespace app\common\model;

use think\Model;

class WxConfig extends Model
{
    protected $resultSetType = 'collection';
    protected $autoWriteTimestamp = 'timestamp';
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    
    public function getJsSign($url = '')
    {
        vendor("dodgepudding.wechat-php-sdk.JSSDK#class");
        $wxConfig = $this->find();
        $jssdk = new \JSSDK($wxConfig["appid"], $wxConfig["appsecret"],$url);

        $result = $jssdk->getSignPackage();

        return $result;
    }
    /**
     * getWeObj
     * @param  integer $type     用户名类型 （1-公众号，2-小程序）
     * @return integer           登录成功-用户ID，登录失败-错误编号
     */
    public function getWeObj($type = 1)
    {
        vendor("dodgepudding.wechat-php-sdk.wechat#class");
        $config = $this->find();

        switch ($type) {
            case 1:
                $options = array(
                    'token' => $config ["token"], //填写你设定的key
                    'encodingaeskey' => $config ["encodingaeskey"], //填写加密用的EncodingAESKey
                    'appid' => $config ["appid"], //填写高级调用功能的app id
                    'appsecret' => $config ["appsecret"] //填写高级调用功能的密钥
                );
                break;
            case 2:
                $options = array(
                    'appid' => $config ["x_appid"], //填写高级调用功能的app id
                    'appsecret' => $config ["x_appsecret"] //填写高级调用功能的密钥
                );
                break;
            default:
                return 0; //参数错误
        }
        $weObj = new \Wechat ($options);
        return $weObj;
    }

}