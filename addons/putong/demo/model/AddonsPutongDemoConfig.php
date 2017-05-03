<?php
namespace addons\putong\demo\model;
use think\Model;

class AddonsPutongDemoConfig extends Model
{

	protected $resultSetType = 'collection';
	protected $autoWriteTimestamp = 'timestamp';
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

	public function file()
    {
        return $this->hasOne('app\common\model\File','id','file_id');
    }

}