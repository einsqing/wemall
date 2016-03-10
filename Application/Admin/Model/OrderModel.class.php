<?php
namespace Admin\Model;

use Think\Model\RelationModel;

class OrderModel extends RelationModel {
	protected $_link = array(
		'User'=>array(
			'mapping_type'  => self::BELONGS_TO,
//          'class_name'    => 'Users',
			'mapping_name'  => 'user',
			'foreign_key'   => 'user_id',//关联id
		),
	);

    public function getList($condition = array(), $relation = true)
    {
        $data = $this->where($condition);
        if ($relation) {
            $data = $data->relation($relation);
        }
        $data = $data->find();

        return $data;
    }
}