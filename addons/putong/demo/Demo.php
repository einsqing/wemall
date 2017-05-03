<?php
// +----------------------------------------------------------------------
// | thinkphp5 Addons [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.zzstudio.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Byron Sampson <xiaobo.sun@qq.com>
// +----------------------------------------------------------------------
namespace addons\putong\demo;

use think\Addons;

/**
 * 插件测试
 * @author byron sampson
 */
class Demo extends Addons
{
    public $info = [
        'name' => 'test',
        'title' => '插件测试',
        'description' => 'thinkph5插件测试',
        'status' => 0,
        'author' => 'byron sampson',
        'version' => '0.1'
    ];

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        return true;
    }

    /**
     * 实现的testHook钩子方法
     * @return mixed
     */
    public function temphook($param)
    {
        echo '<p><font color="red">开始处理钩子啦</font></p>';
        echo '<p><font color="green">打印传给钩子的参数：</font></p>';
        dump($param);
        echo '<p><font color="green">打印插件配置：</font></p>';
        dump($this->getConfig());

        // 这里可以通过钩子来调用钩子模板
        return $this->fetch('info');
    }

}
