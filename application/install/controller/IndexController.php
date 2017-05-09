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

        // 缓存数据库配置
        session('db_config', $data['db']);

        // 防止不存在的数据库导致连接数据库失败
        $db_name = $data['db']['database'];
        unset($data['db']['database']);

        // 创建数据库连接
        $db_instance = Db::connect($data['db']);
        // 检测数据库连接
        try{
            $db_instance->execute('select version()');
        }catch(\Exception $e){
            install_show_msg('数据库连接失败，请检查连接信息是否正确！', false);
        }

        $result = $db_instance->execute('SELECT * FROM information_schema.schemata WHERE schema_name="'.$db_name.'"');
        if ($result) {
            install_show_msg('该数据库已存在，请更换名称！', false);
        }

        // 创建数据库
        $sql2 = "CREATE DATABASE IF NOT EXISTS `{$db_name}` DEFAULT CHARACTER SET utf8";
        $db_instance->execute($sql2) || install_show_msg($db_instance->getError(), false);
        //修改数据库配置文件
        write_config(session('db_config'));
        $db_instance2 = Db::connect(session('db_config'));
        // 开始安装
        $file = './wemall7.sql';
        $sqlData = get_mysql_data($file, '', '');
        foreach ($sqlData as $sql) {
            $db_instance2->execute($sql);
        }
        
        //创建超级管理员
        $db_instance2->name('admin')->where('id',1)->update(['username' => $data['username'],'password'=>md5($data['password'])]);
        install_show_msg('超级管理员创建完成...');

        //创建文件锁
        file_put_contents('./data/install.lock', '');

        //安装完毕
        show_msg('安装程序执行完毕！重新安装需要删除./data/install.lock');
        $adminUrl = url('../admin/index/index');
        echo "<script type=\"text/javascript\">insok(\"{$adminUrl}\")</script>";
    }


}