<?php
namespace addons\putong\demo\controller;

use think\addons\Controller;

class Init extends Controller
{
	public function _initialize(){
		if ($this->request->isPjax()){
			$this->view->engine->layout(false);
		}else{
			$this->view->engine->layout('./application/admin/view/layout.html');
		}
	}
	//安装
    public function install()
    {
    	$install_sql = './addons/card/data/install.sql';
        if (file_exists($install_sql)) {
            execute_sql_file($install_sql);
        }

        //添加钩子
        $config = config('addons');
        $config['temphook'] = 'addons\putong\demo\demo';
        save_config(APP_PATH . '/extra/addons.php', $config);

    	file_put_contents('./addons/card/install.lock','');
    	$this->success("安装成功", cookie("prevUrl"));
    }
    //卸载
    public function uninstall()
    {
    	$uninstall_sql = './addons/card/data/uninstall.sql';
        if (file_exists($uninstall_sql)) {
            execute_sql_file($uninstall_sql);
        }
        //删除钩子
        $config = config('addons');
        unset($config['temphook']);
        save_config(APP_PATH . '/extra/addons.php', $config);

    	unlink('./addons/card/install.lock');
    	$this->success("卸载成功", cookie("prevUrl"));
    }

    public function ceshi()
    {

    }









}
