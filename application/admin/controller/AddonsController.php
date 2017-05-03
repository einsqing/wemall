<?php
/**
 * 
 * @authors 清月曦 (1604583867@qq.com)
 * @date    2017-05-01 13:21:11
 * @version $Id$
 */
namespace app\admin\controller;
use ZipArchive;
class AddonsController extends BaseController
{
	public $appUrl = "";
    private static $addonUrl = "http://addon.wemallshop.com";

    public function _initialize()
    {
        parent::_initialize();
        $this->appUrl = request()->root(true);
    }
    //插件列表
    public function index()
    {
    	$item = getDir(ADDON_PATH);

        $info = array();
        if($item){
            foreach ($item as $key => $value) {
                if (is_file(ADDON_PATH . '/' . $value . '/' . 'config.php')) {
                    $item_config = require ADDON_PATH . '/' . $value . '/' . 'config.php';
                    $info[$value] = $item_config;
                    $info[$value]['sub'] = array();
                }
                
                $addons = getDir(ADDON_PATH.$value);
                foreach ($addons as $k => $v) {
                    if ($v && is_file(ADDON_PATH . '/' . $value . '/' . $v . '/' . 'config.php')) {
                        $config = require ADDON_PATH . '/' . $value . '/'  . $v . '/' . 'config.php';
                        $config['addons_admin_url'] = addon_url($value . '://'.$v.'/admin/index',[]);
                        $config['addons_img_url'] = $this->appUrl .'/addons/' . $value . '/' . $v . '/' . $v .'.png';
                        
                        if (is_file(ADDON_PATH . '/' . $value . '/' . $v . '/' . 'install.lock')) {
                            $config['lock'] = 1;
                        }else{
                            $config['lock'] = 0;
                        }
                        
                        array_push($info[$value]['sub'], $config);
                    }
                }
            }
        }
        cookie("prevUrl", request()->url());

        $this->assign('item', $info);
        return view();
    }

    //应用商店
    public function shop()
    {
        $domain = request()->domain();
        $this->assign('domain', $domain);
        return view();
    }

    //下载解压插件
    public function getFileDownload()
    {
        $data = input('param.');
        
        $path = $data['path'];
        $uuid = $data['uuid'];
        $type = $data['type'];
        $sort = $data['sort'];
        if($sort == 'install'){
            $filePath = self::$addonUrl . $path . '?order_uuid=' . $uuid . '&type=' . $type;
        }else{
            $filePath = self::$addonUrl . $path . '?uuid=' .$uuid . '&type=' . $type;
        }

        $zipPath = "./addons.zip";
        http_down($filePath, $zipPath);

        $re = unzip($zipPath,'./');
        if($re){
            return json(['data' => false, 'msg' => '恭喜您，下载完成!', 'code' => 1]);
        }else{
            return json(['data' => false, 'msg' => '下载安装失败', 'code' => 0]);
        }
    }
    //自动安装插件
    public function compare()
    {
        $item = getDir(ADDON_PATH);
        if($item){
            foreach ($item as $key => $value) {
                $addons = getDir(ADDON_PATH.$value);
                foreach ($addons as $k => $v) {
                    $addons_path = ADDON_PATH . $value . '/' . $v;
                    //安装sql
                    if (!file_exists($addons_path . '/install.lock')) {
                        $install_sql = $addons_path . '/data/install.sql';
                        try {
                            if (file_exists($install_sql)) {
                                execute_sql_file($install_sql);
                                file_put_contents($addons_path . '/install.lock','');
                                // unlink('./update.sql');
                            }
                        } catch (\Exception $e) {
                            // 这是进行异常捕获
                            return json(['data' => false, 'msg' => $e->getMessage(), 'code' => 0]);
                        }
                    }
                    //升级sql
                    $update_sql = $addons_path . '/update.sql';
                    try {
                        if (file_exists($update_sql)) {
                            execute_sql_file($update_sql);
                            unlink('./update.sql');
                        }
                    } catch (\Exception $e) {
                        // 这是进行异常捕获
                        return json(['data' => false, 'msg' => $e->getMessage(), 'code' => 0]);
                    }
                }
            }
        }
        return json(['data' => false, 'msg' => '恭喜您，安装完成！', 'code' => 1]);
    }





}