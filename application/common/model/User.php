<?php
namespace app\common\model;

use think\Model;

class User extends Model
{
	protected $resultSetType = 'collection';
	protected $autoWriteTimestamp = 'timestamp';
	// 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $type = [
        'money'     =>  'float',
    ];
	public function contact()
    {
        return $this->hasOne('UserContact','id','contact_id');
    }
    public function avater()
    {
        return $this->hasOne('File','id','avater_id');
    }
    public function wx()
    {
        return $this->hasOne('OauthWx','user_id','id');
    }
    public function applet()
    {
        return $this->hasOne('OauthApplet','user_id','id');
    }

	protected $append  = ['level'];
	protected function getLevelAttr($value, $data)
    {
        $score = $data['score'];
        $level = '';
        $levellist = model('app\common\model\UserLevel')->all()->toArray();
        foreach ($levellist as &$v) {
			if($score >= $v['score']){
				$level = $v['name'];
			}
		}
        return $level ? $level : '未知等级';
    }

	/**
	 * 用户登录认证
	 * @param  string  $username 用户名
	 * @param  string  $password 用户密码
	 * @param  integer $type     用户名类型 （1-用户名，2-邮箱，3-手机，4-UID）
	 * @return integer           登录成功-用户ID，登录失败-错误编号
	 */
	public function login($username, $password, $type = 1){
		$map = array();
		switch ($type) {
			case 1:
				$map['username'] = $username;
				break;
			case 2:
				$map['email'] = $username;
				break;
			case 3:
				$map['phone'] = $username;
				break;
			case 4:
				$map['id'] = $username;
				break;
			default:
				return 0; //参数错误
		}
		/* 获取用户数据 */
		$user = $this->get($map);
		if($user){
			/* 验证用户密码 */
			if(md5($password) === $user->password){
				$this->updateLogin($user->id); //更新用户登录信息
				return $user->id; //登录成功，返回用户ID
			} else {
				return -2; //密码错误
			}
		} else {
			return -1; //用户不存在或被禁用
		}
	}

	/**
	 * 更新用户登录信息
	 * @param  integer $uid 用户ID
	 */
	protected function updateLogin($uid){
		$data = array(
			'id'              => $uid,
			'last_login_time' => date("Y-m-d H:i:s"),
			'last_login_ip'   => request()->ip(),
		);
		$this->update($data);
	}





}