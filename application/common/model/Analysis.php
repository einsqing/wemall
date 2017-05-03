<?php
namespace app\common\model;

use think\Model;

class Analysis extends Model
{
	protected $resultSetType = 'collection';
	protected $autoWriteTimestamp = 'timestamp';
	// 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';


     /**
     * @param int $orders 新订单
     * @param int $trades 新交易额
     * @param int $registers 新注册量
     * @param int $users 新购买用户
     */
    public function add($orders = 0, $trades = 0, $registers = 0, $users = 0)
    {
    	$data = $this->whereTime('created_at', 'today')->find();

    	if ($data) {
    		$this->where('id',$data["id"])->setInc("orders", $orders);
            $this->where('id',$data["id"])->setInc("trades", $trades);
            $this->where('id',$data["id"])->setInc("registers", $registers);
            $this->where('id',$data["id"])->setInc("users", $users);
    	}else{
    		parent::create([
                'date'  	 =>  date("Y-m-d"),
                'orders'  	 =>  $orders,
                'trades' 	 =>  $trades,
                'registers'  =>  $registers,
                'users'      =>  $users
            ]);
    	}
    }
}