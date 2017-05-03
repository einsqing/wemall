<?php
/**
 * 
 * @authors 清月曦 (1604583867@qq.com)
 * @date    2017-04-12 10:03:28
 * @version $Id$
 */
namespace app\common\behavior;

class Config {
    /**
     * 执行行为 run方法是Behavior唯一的接口
     * @access public
     * @param mixed $params  行为参数
     * @return void
     */
    public function run(&$params)
    {        
    	// 获取入口目录
        $base_file = request()->baseFile();
        $base_dir  = preg_replace(['/\/index.php$/', '/admin.php$/'], ['', ''], $base_file);
        defined('PUBLIC_PATH') or define('PUBLIC_PATH', '');
        // 视图输出字符串内容替换
        $view_replace_str = [
            // 静态资源目录
        	'__PUBLIC__'    => $base_dir.PUBLIC_PATH,
            '__STATIC__'    => $base_dir.PUBLIC_PATH. '/static',
            // 文件上传目录
            '__UPLOADS__'   => $base_dir.PUBLIC_PATH. '/uploads'
        ];
        config('view_replace_str', $view_replace_str);

    }



}