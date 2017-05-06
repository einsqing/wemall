<?php
namespace app\install\controller;
use think\Controller;
use think\Db;

class IndexController extends Controller
{
    public function _initialize()
    {
        //资源加载
        if(strstr(request()->baseFile(), 'public')){
            $this->view->replace([
                '__PUBLIC__'       =>  request()->root(true),
            ]);
        }else{
            $this->view->replace([
                '__PUBLIC__'       =>  request()->root(true).'/public',
            ]);
        }
    }

    /**
     * 主页
     */
    public function index()
    {
        return view();
    }

    /**
     * 安装环境检测
     */
    public function setup1()
    {
        $this->assign('check_env', check_env());
        $this->assign('check_func', check_func());
        $this->assign('check_dirfile', check_dirfile());

        return view();
    }

    /**
     * 安装程序
     */
    public function setup2()
    {
        return view();
    }

    /**
     * 开始安装
     */
    public function setup3()
    {
        echo $this->fetch();

        //检测信息
        $data = input('post.');
      
        if (!$data['db']['hostname']) {
            install_show_msg('请填写数据库地址！', false);
        }
        if (!$data['db']['hostport']) {
            install_show_msg('请填写数据库端口！', false);
        }
        if (!$data['db']['database']) {
            install_show_msg('请填写数据库名称！', false);
        }
        if (!$data['db']['username']) {
            install_show_msg('请填写数据库用户名！', false);
        }
        if (!$data['username']) {
            install_show_msg('请填写用户名/邮箱！', false);
        }
        if (!$data['password']) {
            install_show_msg('请填写密码！', false);
        }
        if (!$data['password2']) {
            install_show_msg('请填写重复密码！', false);
        }
        if ($data['password'] != $data['password2']) {
            install_show_msg('重复密码不匹配！', false);
        }
        //检查数据库
        $link = @mysql_connect($data['db']['hostname'] . ':' . $data['db']['hostport'], $data['db']['username'], $data['db']['password']);
        if (!$link) {
            install_show_msg('数据库连接失败，请检查连接信息是否正确！', false);
        }
        $mysqlInfo = mysql_get_server_info($link);
        if ($mysqlInfo < '5.1.0') {
            install_show_msg('mysql版本低于5.1，无法继续安装！', false);
        }

        $status = @mysql_select_db($data['db']['database'], $link);
        if (!$status) {
            //尝试创建数据库
            $sql = "CREATE DATABASE IF NOT EXISTS `" . $data['db']['database'] . "` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
            if (!mysql_query($sql)) {
                install_show_msg('数据库' . $data['db']['database'] . '自动创建失败，请手动建立数据库！', false);
            }
            mysql_select_db($data['db']['database'], $link);
        }
        install_show_msg('数据库检查创建完成...');

        //修改数据库配置文件
        write_config($data['db']);
        //安装数据库
        $file = './wemall7.sql';
        $sqlData = get_mysql_data($file, '', '');
        foreach ($sqlData as $sql) {
            $rst = mysql_query($sql);

            if ($rst === false) {
                install_show_msg(mysql_error(), false);
            }
        }
        //连接数据库
        Db::connect($data['db']);
        //创建超级管理员
        Db::name('admin')->where('id',1)->update(['username' => $data['username'],'password'=>md5($data['password'])]);
        install_show_msg('超级管理员创建完成...');

        //创建文件锁
        file_put_contents('./data/install.lock', '');

        //安装完毕
        show_msg('安装程序执行完毕！重新安装需要删除./data/install.lock');
        $adminUrl = url('../admin/index/index');
        echo "<script type=\"text/javascript\">insok(\"{$adminUrl}\")</script>";
    }


}