WeMall商城 7.0 (不含商城)
===============



​	wemall7.0 开源系统，基于thinkphp5开发，支持composer，优化核心，减少依赖，基于全新的架构思想和命名空间。



### thinkphp5.0特性

- 基于命名空间和众多PHP新特性
- 核心功能组件化
- 强化路由功能
- 更灵活的控制器
- 重构的模型和数据库类
- 配置文件可分离
- 重写的自动验证和完成
- 简化扩展机制
- API支持完善
- 改进的Log类
- 命令行访问支持
- REST支持
- 引导文件支持
- 方便的自动生成定义
- 真正惰性加载
- 分布式环境支持
- 更多的社交类库

> ThinkPHP5的运行环境要求PHP5.4以上。



### wemall7.0特性

- 基于TP5，性能优越
- 前后分离，简单方便
- 插件扩展，功能丰富
- 钩子机制，高度扩展
- 自动升级，维护简单
- 使用pjax，体验提升
- rest架构，耦合度低


> ##### 功能列表
>
> 1. 首页=》系统首页
>
> 2. 设置=》站点设置，短信配置，邮件配置
>
> 3. 微信=》微信配置，微信菜单，自定义回复，模版消息，多客服设置，微信打印机
>
> 4. 内容=》文章分类，文章列表
>
> 5. 模版=》模版设置，邮件模版，短信模版
>
> 6. 用户=》管理员用户组，管理员列表，用户列表，会员列表
>
> 7. 插件=》插件管理，插件商店
>
> 8. 帮助=》使用帮助
>
>    ...




## 插件钩子机制

### 安装

> composer require qingyuexi/think-addons

### 配置

#### 公共配置

```
'addons'=>[
    // 可以定义多个钩子
    'testhook'=>'putong\demo\demo' // 键为钩子名称，用于在业务中自定义钩子处理，值为实现该钩子的插件，
                    // 多个插件可以用数组也可以用逗号分割
]

```

或者在application\extra目录中新建`addons.php`,内容为：

```
<?php
return [
    // 可以定义多个钩子
    'testhook'=>'putong\demo\demo' // 键为钩子名称，用于在业务中自定义钩子处理，值为实现该钩子的插件，
                    // 多个插件可以用数组也可以用逗号分割
]

```

### 创建插件

> 创建的插件可以在view视图中使用，也可以在php业务中使用

安装完成后访问系统时会在项目根目录生成名为`addons`的目录，在该目录中创建需要的插件。

下面写一个例子：

#### 创建putong分类插件

> 在addons目录中创建putong目录

#### 创建插件分类配置文件

> 在putong目录中创建config.php类文件，插件配置文件可以省略。

```
<?php
return [
    'name' => 'putong',
    'title' => 'putong',
    'description' => 'putong类插件',
    'status' => 1,
    'author' => '清月曦'
];

```

#### 在putong分类下创建demo插件

> 在addons目录下的putong目录下创建demo目录

#### 创建钩子实现类

> 在test目录中创建Demo.php类文件。注意：类文件首字母需大写

```
<?php
namespace addons\putong\demo;   // 注意命名空间规范

use think\Addons;

/**
 * 插件测试
 * @author byron sampson
 */
class Demo extends Addons   // 需继承think\addons\Addons类
{
    // 该插件的基础信息
    public $info = [
        'name' => 'test',   // 插件标识
        'title' => '插件测试',  // 插件名称
        'description' => 'thinkph5插件测试',    // 插件简介
        'status' => 0,  // 状态
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
     * 实现的testhook钩子方法
     * @return mixed
     */
    public function testhook($param)
    {
        // 调用钩子时候的参数信息
        print_r($param);
        // 当前插件的配置信息，配置信息存在当前目录的config.php文件中，见下方
        print_r($this->getConfig());
        // 可以返回模板，模板文件默认读取的为插件目录中的文件。模板名不能为空！
        return $this->fetch('info');
    }

}

```

#### 创建插件配置文件

> 在test目录中创建config.php类文件，插件配置文件可以省略。

```
<?php
return [
    'name' => 'demo',
    'title' => 'demo',
    'description' => 'demo插件',
    'status' => 1,
    'url' => true,
    'author' => '清月曦',
    'version' => '0.1'
];

```

#### 创建钩子模板文件

> 在demo目录中创建info.html模板文件，钩子在使用fetch方法时对应的模板文件。

```
<h1>hello tpl</h1>

如果插件中需要有链接或提交数据的业务，可以在插件中创建controller业务文件，
要访问插件中的controller时使用addon_url生成url链接。
如下：
<a href="{:addon_url('putong://demo/admin/index')}">link demo</a>
格式为：
demo为插件名，admin为controller中的类名，index为controller中的方法

```

#### 创建插件的controller文件

> 在test目录中创建controller目录，在controller目录中创建Action.php文件 controller类的用法与tp5中的controller一致

```
<?php
namespace addons\putong\demo\controller;

class Admin
{
    public function index()
    {
        echo 'hello link';
    }
}

```

> 如果需要使用view模板则需要继承`\think\addons\Controller`类 模板文件所在位置为插件目录的view中，规则与模块中的view规则一致

```
<?php
namespace addons\putong\demo\controller;

use think\addons\Controller;

class Admin extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}

```

### 使用钩子

> 创建好插件后就可以在正常业务中使用该插件中的钩子了 使用钩子的时候第二个参数可以省略

#### 模板中使用钩子

```
<div>{:hook('testhook', ['id'=>1])}</div>

```

#### php业务中使用

> 只要是thinkphp5正常流程中的任意位置均可以使用

```
hook('testhook', ['id'=>1])

```

### 插件目录结构

#### 最终生成的目录结构为

```
tp5
 - addons
 -- putong
 --- demo
 ---- controller
 ----- Admin.php
 ---- view
 ---- action
 ----- link.html
 --- config.php
 --- info.html
 --- Demo.php
 - application
 - thinkphp
 - extend
 - vendor
 - public
```



## 版权信息

wemall7开源版遵循Apache2开源协议发布，并提供免费使用。本项目包含的第三方源码和二进制文件之版权信息另行标注。版权所有Copyright © 2016-2017 by wemallshop.com ([http://www.wemallshop.com](http://www.wemallshop.com)) All rights reserved。