<?php
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule =   [
        'username'  => 'unique:admin', 
    ];

    protected $message  =   [
        'username.unique' => '用户名已存在',  
    ];

}