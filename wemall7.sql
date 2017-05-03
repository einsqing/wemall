-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 2017-05-03 18:54:08
-- 服务器版本： 5.5.42
-- PHP Version: 5.5.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- 表的结构 `addons_putong_demo_config`
--

CREATE TABLE `addons_putong_demo_config` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL COMMENT '活动名称',
  `file_id` int(11) NOT NULL COMMENT '活动图片',
  `sub` text NOT NULL COMMENT '活动描述',
  `detail` text NOT NULL COMMENT '活动详情',
  `timerange` text NOT NULL COMMENT '活动时间',
  `remark` text NOT NULL COMMENT '备注',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1:开启0:关闭',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `addons_putong_demo_config`
--

INSERT INTO `addons_putong_demo_config` (`id`, `name`, `file_id`, `sub`, `detail`, `timerange`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(1, '活动名称', 1, '这里是活动描述', '', '2017-05-01 12:00:00 --- 2017-05-25 11:59:59', '', 1, '2017-05-01 10:25:26', '2017-05-01 12:12:04'),
(2, '活动2', 1, '活动描述', '<p>111</p>', '2017-05-01 12:00:00 --- 2017-05-11 11:59:59', '', 1, '2017-05-01 10:37:35', '2017-05-01 12:11:06');

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `group_id` int(11) NOT NULL DEFAULT '1' COMMENT '用户组id',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL DEFAULT '' COMMENT '用户手机',
  `reg_ip` varchar(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `last_login_ip` text COMMENT '最后登录IP',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  `remark` text NOT NULL COMMENT '备注',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `group_id`, `username`, `password`, `email`, `mobile`, `reg_ip`, `last_login_time`, `last_login_ip`, `status`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '296720094@qq.com', '18053449656', '0', '2017-05-03 07:58:17', '0.0.0.0', 1, '1', '0000-00-00 00:00:00', '2017-05-03 07:58:17'),
(2, 2, '1', 'c4ca4238a0b923820dcc509a6f75849b', '1604583867@qq.com', '18538753627', '0', '2017-05-01 10:03:14', '0.0.0.0', 1, '1', '2017-05-01 09:47:46', '2017-05-01 10:03:14');

-- --------------------------------------------------------

--
-- 表的结构 `analysis`
--

CREATE TABLE `analysis` (
  `id` int(10) unsigned NOT NULL,
  `orders` int(11) NOT NULL,
  `trades` float NOT NULL,
  `registers` int(11) NOT NULL,
  `users` int(11) NOT NULL COMMENT '当天购买人数',
  `date` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `analysis`
--

INSERT INTO `analysis` (`id`, `orders`, `trades`, `registers`, `users`, `date`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 1, 0, '2017-05-01', '2017-04-30 23:22:28', NULL),
(2, 0, 0, 1, 0, '2017-05-02', '2017-05-01 21:21:32', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `author` text NOT NULL COMMENT '作者',
  `sub` text NOT NULL,
  `content` text NOT NULL,
  `remark` text,
  `visiter` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL COMMENT '1:开启0:关闭',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `category_id`, `title`, `author`, `sub`, `content`, `remark`, `visiter`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '文章功能测试', '2222', '2222', '<p>22222222</p>', '1', 11, 1, '2016-01-05 14:41:14', '2017-03-02 06:52:09'),
(2, 2, '2222', '222', '222', '<p>222</p>', '1', 2, 1, '2017-01-14 07:06:18', '2017-03-02 06:52:01'),
(3, 1, '121', '12', '122', '<p><img src="http://img.baidu.com/hi/jx2/j_0016.gif"/></p>', '12', 9, 1, '2017-02-17 02:27:38', '2017-05-01 13:29:14');

-- --------------------------------------------------------

--
-- 表的结构 `article_category`
--

CREATE TABLE `article_category` (
  `id` int(11) unsigned NOT NULL,
  `pid` int(11) NOT NULL COMMENT '上级',
  `name` text NOT NULL COMMENT '类型',
  `status` int(11) NOT NULL COMMENT '1:开启0:关闭',
  `remark` text NOT NULL COMMENT '备注',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='文章类型';

--
-- 转存表中的数据 `article_category`
--

INSERT INTO `article_category` (`id`, `pid`, `name`, `status`, `remark`, `created_at`, `updated_at`) VALUES
(1, 0, '类型1', 1, '1211', '2016-12-08 23:17:30', '2017-05-01 13:17:02'),
(2, 0, '类型2', 1, '', '2016-12-10 02:18:40', '2017-01-14 01:44:13'),
(3, 2, '类型3', 1, '233232', '2016-12-11 04:13:00', '2017-03-02 06:51:21'),
(4, 1, '222234', 1, '34444', '2017-03-02 06:50:51', '2017-03-02 06:51:12');

-- --------------------------------------------------------

--
-- 表的结构 `auth_group`
--

CREATE TABLE `auth_group` (
  `id` int(8) unsigned NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1:启用0:禁用',
  `rules` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_group`
--

INSERT INTO `auth_group` (`id`, `title`, `status`, `rules`, `created_at`, `updated_at`) VALUES
(1, '超级管理员', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,', '2017-01-16 01:28:11', '0000-00-00 00:00:00'),
(2, '普通管理员', 1, '1,2,3,4,5,6,7', '2017-01-16 06:59:52', '2017-05-01 09:59:09');

-- --------------------------------------------------------

--
-- 表的结构 `auth_group_access`
--

CREATE TABLE `auth_group_access` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_group_access`
--

INSERT INTO `auth_group_access` (`id`, `uid`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `auth_rule`
--

CREATE TABLE `auth_rule` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '1',
  `rank` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_rule`
--

INSERT INTO `auth_rule` (`id`, `name`, `title`, `type`, `rank`, `status`, `condition`, `created_at`, `updated_at`) VALUES
(1, 'admin/index/index', '系统首页', 1, 0, 1, '', '2017-01-09 08:37:37', '0000-00-00 00:00:00'),
(2, 'admin/auth.group/index', '管理员用户组', 1, 0, 1, NULL, '2017-05-01 07:30:02', '0000-00-00 00:00:00'),
(3, 'admin/auth.group/add', '新增修改用户组', 1, 0, 1, NULL, '2017-05-01 07:31:00', '0000-00-00 00:00:00'),
(4, 'admin/auth.group/del', '删除用户组', 1, 0, 1, NULL, '2017-05-01 07:32:35', '0000-00-00 00:00:00'),
(5, 'admin/auth.group/update', '开启关闭用户组', 1, 0, 1, NULL, '2017-05-01 07:33:01', '0000-00-00 00:00:00'),
(6, 'admin/auth.admin/index', '管理员列表', 1, 0, 1, NULL, '2017-05-01 07:33:38', '0000-00-00 00:00:00'),
(7, 'admin/auth.admin/add', '新增修改管理员', 1, 0, 1, NULL, '2017-05-01 07:34:02', '0000-00-00 00:00:00'),
(8, 'admin/auth.admin/del', '删除管理员', 1, 0, 1, NULL, '2017-05-01 07:34:31', '0000-00-00 00:00:00'),
(9, 'admin/auth.admin/update', '开启关闭管理员', 1, 0, 1, NULL, '2017-05-01 07:34:56', '0000-00-00 00:00:00'),
(10, 'admin/addons/index', '插件管理', 1, 0, 1, NULL, '2017-05-01 10:08:37', '0000-00-00 00:00:00'),
(11, 'admin/addons/shop', '插件商店', 1, 0, 1, NULL, '2017-05-01 10:09:15', '0000-00-00 00:00:00'),
(12, 'admin/file/index', '图片管理', 1, 0, 1, NULL, '2017-05-01 11:07:22', '0000-00-00 00:00:00'),
(13, 'admin/file/upload', '图片上传', 1, 0, 1, NULL, '2017-05-01 11:07:51', '0000-00-00 00:00:00'),
(14, 'admin/user.index/index', '用户列表', 1, 0, 1, NULL, '2017-05-01 12:27:54', '0000-00-00 00:00:00'),
(15, 'admin/user.index/add', '修改用户信息', 1, 0, 1, NULL, '2017-05-01 12:38:14', '0000-00-00 00:00:00'),
(16, 'admin/user.index/update', '更新用户状态', 1, 0, 1, NULL, '2017-05-01 12:42:54', '0000-00-00 00:00:00'),
(17, 'admin/user.index/export', '导出用户信息', 1, 0, 1, NULL, '2017-05-01 12:46:02', '0000-00-00 00:00:00'),
(18, 'admin/user.level/index', '会员等级管理', 1, 0, 1, NULL, '2017-05-01 12:52:42', '0000-00-00 00:00:00'),
(19, 'admin/user.level/add', '新增修改会员等级', 1, 0, 1, NULL, '2017-05-01 12:55:40', '0000-00-00 00:00:00'),
(20, 'admin/article.category/index', '文章分类管理', 1, 0, 1, NULL, '2017-05-01 13:03:30', '0000-00-00 00:00:00'),
(21, 'admin/article.category/add', '新增修改文章分类', 1, 0, 1, NULL, '2017-05-01 13:07:14', '0000-00-00 00:00:00'),
(22, 'admin/article.category/update', '更改文章分类状态', 1, 0, 1, NULL, '2017-05-01 13:21:59', '0000-00-00 00:00:00'),
(23, 'admin/article.index/index', '文章列表', 1, 0, 1, NULL, '2017-05-01 13:25:27', '0000-00-00 00:00:00'),
(24, 'admin/article.index/add', '新增修改文章', 1, 0, 1, NULL, '2017-05-01 13:26:03', '0000-00-00 00:00:00'),
(25, 'admin/article.index/update', '更新文章状态', 1, 0, 1, NULL, '2017-05-01 13:26:24', '0000-00-00 00:00:00'),
(26, 'admin/config.site/index', '站点设置', 1, 0, 1, NULL, '2017-05-02 02:45:54', '0000-00-00 00:00:00'),
(27, 'admin/wx.config/index', '微信配置', 1, 0, 1, NULL, '2017-05-03 08:02:56', '0000-00-00 00:00:00'),
(28, 'admin/wx.menu/index', '微信菜单设置', 1, 0, 1, NULL, '2017-05-03 09:02:06', '0000-00-00 00:00:00'),
(29, 'admin/wx.menu/add', '新增修改微信菜单', 1, 0, 1, NULL, '2017-05-03 09:02:32', '0000-00-00 00:00:00'),
(30, 'admin/wx.menu/del', '删除微信菜单', 1, 0, 1, NULL, '2017-05-03 09:03:02', '0000-00-00 00:00:00'),
(31, 'admin/wx.reply/index', '微信自定义回复设置', 1, 0, 1, NULL, '2017-05-03 09:03:37', '0000-00-00 00:00:00'),
(32, 'admin/wx.reply/add', '新增修改微信自定义回复', 1, 0, 1, NULL, '2017-05-03 09:04:13', '0000-00-00 00:00:00'),
(33, 'admin/wx.reply/del', '删除微信自定义回复', 1, 0, 1, NULL, '2017-05-03 09:04:52', '0000-00-00 00:00:00'),
(34, 'admin/wx.tplmsg/index', '模版消息列表', 1, 0, 1, NULL, '2017-05-03 09:06:01', '0000-00-00 00:00:00'),
(35, 'admin/wx.tplmsg/add', '新增修改模版消息', 1, 0, 1, NULL, '2017-05-03 09:06:25', '0000-00-00 00:00:00'),
(36, 'admin/wx.tplmsg/update', '开启关闭模版消息', 1, 0, 1, NULL, '2017-05-03 09:06:51', '0000-00-00 00:00:00'),
(37, 'admin/wx.kefu/index', '多客服设置', 1, 0, 1, NULL, '2017-05-03 09:07:38', '0000-00-00 00:00:00'),
(38, 'admin/wx.print/index', '微信打印机设置', 1, 0, 1, NULL, '2017-05-03 09:08:02', '0000-00-00 00:00:00'),
(39, 'admin/tpl.shop/index', '模版设置', 1, 0, 1, NULL, '2017-05-03 09:11:42', '0000-00-00 00:00:00'),
(40, 'admin/tpl.mail/index', '邮件模版列表', 1, 0, 1, NULL, '2017-05-03 09:14:42', '0000-00-00 00:00:00'),
(41, 'admin/tpl.mail/add', '新增修改邮件模版', 1, 0, 1, NULL, '2017-05-03 09:15:03', '0000-00-00 00:00:00'),
(42, 'admin/tpl.mail/update', '更新邮件模版状态', 1, 0, 1, NULL, '2017-05-03 09:15:27', '0000-00-00 00:00:00'),
(43, 'admin/tpl.mail/send', '测试邮件模版', 1, 0, 1, NULL, '2017-05-03 09:18:28', '0000-00-00 00:00:00'),
(44, 'admin/tpl.sms/index', '短信模版列表', 1, 0, 1, NULL, '2017-05-03 09:18:55', '0000-00-00 00:00:00'),
(45, 'admin/tpl.sms/add', '编辑短信模版', 1, 0, 1, NULL, '2017-05-03 09:20:38', '0000-00-00 00:00:00'),
(46, 'admin/tpl.sms/update', '开启关闭短信模版', 1, 0, 1, NULL, '2017-05-03 09:21:15', '0000-00-00 00:00:00'),
(47, 'admin/tpl.sms/send', '短信模版测试发送', 1, 0, 1, NULL, '2017-05-03 09:21:41', '0000-00-00 00:00:00'),
(48, 'admin/config.sms/index', '短信配置', 1, 0, 1, NULL, '2017-05-03 09:25:38', '0000-00-00 00:00:00'),
(49, 'admin/config.mail/index', '邮件配置', 1, 0, 1, NULL, '2017-05-03 09:26:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `config`
--

CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL,
  `title` text NOT NULL COMMENT '标题',
  `keywords` text NOT NULL COMMENT '关键词',
  `logo_id` int(11) NOT NULL COMMENT 'Logo',
  `description` text NOT NULL COMMENT '描述',
  `copyright` text NOT NULL COMMENT '版权',
  `theme` text NOT NULL COMMENT '模版',
  `tongji_code` text COMMENT '统计代码',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `config`
--

INSERT INTO `config` (`id`, `title`, `keywords`, `logo_id`, `description`, `copyright`, `theme`, `tongji_code`, `created_at`, `updated_at`) VALUES
(1, '单用户微商城', 'wemall', 1, '111111', 'Copyright © 2015 wemallshop.com All Rights Reserved 豫ICP备16009619号', 'default', '1111121', '2017-01-10 13:30:26', '2017-05-03 10:33:25');

-- --------------------------------------------------------

--
-- 表的结构 `file`
--

CREATE TABLE `file` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `ext` text NOT NULL,
  `type` text NOT NULL,
  `savename` text NOT NULL,
  `savepath` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `file`
--

INSERT INTO `file` (`id`, `name`, `ext`, `type`, `savename`, `savepath`, `time`) VALUES
(1, 'U4530P18DT20110710182825.jpg', '', 'image/jpeg', '8245f8334edabfa0bd90e8b9ab116093.jpg', '20170501/', '2017-05-01 11:10:01');

-- --------------------------------------------------------

--
-- 表的结构 `mail`
--

CREATE TABLE `mail` (
  `id` int(11) unsigned NOT NULL,
  `host` text NOT NULL COMMENT '服务器地址',
  `port` int(11) NOT NULL COMMENT '服务器端口',
  `secure` double NOT NULL COMMENT '1:加密0:不加密',
  `replyTo` text NOT NULL COMMENT '回信地址',
  `user` text NOT NULL COMMENT '发送邮箱',
  `pass` text NOT NULL COMMENT '授权码,通过QQ获取',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `mail`
--

INSERT INTO `mail` (`id`, `host`, `port`, `secure`, `replyTo`, `user`, `pass`, `created_at`, `updated_at`) VALUES
(1, 'smtpdm.aliyun.com', 465, 1, 'koahub@163.com', '1', '1', '2017-02-16 01:52:41', '2017-05-03 10:33:38');

-- --------------------------------------------------------

--
-- 表的结构 `mail_tpl`
--

CREATE TABLE `mail_tpl` (
  `id` int(11) unsigned NOT NULL,
  `type` text NOT NULL COMMENT '类型',
  `name` text NOT NULL COMMENT '模版名',
  `content` text NOT NULL COMMENT '内容',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态1:开启0:关闭',
  `mail` text NOT NULL COMMENT '测试发送邮箱',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mail_tpl`
--

INSERT INTO `mail_tpl` (`id`, `type`, `name`, `content`, `status`, `mail`, `created_at`, `updated_at`) VALUES
(1, 'register', '注册模版', '<p>您好，欢迎您注册wemallshop微信商城，您的验证码是：$code</p>', 1, '1604583867@qq.com', '0000-00-00 00:00:00', '2017-02-18 09:38:44');

-- --------------------------------------------------------

--
-- 表的结构 `sms`
--

CREATE TABLE `sms` (
  `id` int(10) unsigned NOT NULL,
  `app_key` text NOT NULL,
  `app_secret` text NOT NULL,
  `sign` text NOT NULL COMMENT '短信签名',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sms`
--

INSERT INTO `sms` (`id`, `app_key`, `app_secret`, `sign`, `created_at`, `updated_at`) VALUES
(1, '23643041', '17f711feb8fd1a0f3c376d4eaaa2710b', 'tp商城', '2016-07-19 09:38:40', '2017-05-03 10:33:31');

-- --------------------------------------------------------

--
-- 表的结构 `sms_tpl`
--

CREATE TABLE `sms_tpl` (
  `id` int(11) unsigned NOT NULL,
  `type` text NOT NULL COMMENT '类型',
  `name` text NOT NULL COMMENT '模版名',
  `template_code` text NOT NULL COMMENT '模版ID',
  `content` text NOT NULL COMMENT '内容',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态1:开启0:关闭',
  `phone` text NOT NULL COMMENT '测试发送邮箱',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sms_tpl`
--

INSERT INTO `sms_tpl` (`id`, `type`, `name`, `template_code`, `content`, `status`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'register', '短信验证码', 'SMS_47900069', '您的本次验证码${code}，10分钟内输入有效，感谢使用平台', 1, '15238027761', '0000-00-00 00:00:00', '2017-02-18 09:13:21');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL,
  `contact_id` int(11) NOT NULL COMMENT '默认地址',
  `avater_id` int(11) NOT NULL COMMENT '头像',
  `nickname` text,
  `username` text NOT NULL,
  `phone` text,
  `password` text NOT NULL,
  `token` text,
  `money` float NOT NULL DEFAULT '0',
  `score` float NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:启用0:禁用',
  `buy_num` int(11) NOT NULL COMMENT '用户购买量',
  `remark` text,
  `last_login_ip` text,
  `last_login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `contact_id`, `avater_id`, `nickname`, `username`, `phone`, `password`, `token`, `money`, `score`, `status`, `buy_num`, `remark`, `last_login_ip`, `last_login_time`, `created_at`, `updated_at`) VALUES
(1, 3, 78, NULL, 'wemall', '1', 'c4ca4238a0b923820dcc509a6f75849b', '', 2, 420, 1, 192, '1211', '192.168.0.120', '2017-05-02 03:17:11', '2017-05-01 02:14:20', '2017-05-01 12:38:32'),
(2, 1, 1, '清月曦', '清月曦', '', '', NULL, 0, 0, 1, 0, '1', NULL, '2017-05-01 16:00:00', '2017-05-02 12:40:38', '2017-05-01 12:40:55');

-- --------------------------------------------------------

--
-- 表的结构 `user_level`
--

CREATE TABLE `user_level` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `score` float NOT NULL COMMENT '达到积分',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_level`
--

INSERT INTO `user_level` (`id`, `name`, `score`, `created_at`, `updated_at`) VALUES
(1, '基础会员', 0, '2017-02-15 09:58:33', '2017-03-02 09:42:02'),
(2, '初级会员', 50, '2016-12-26 15:53:37', '2017-02-15 10:37:28'),
(3, '白金会员', 100, '2017-01-05 23:03:20', '2017-02-15 10:37:37'),
(4, '铂金会员', 500, '2017-01-05 23:05:46', '2017-02-15 10:37:53'),
(5, '黄金会员', 1000, '2017-03-02 07:12:29', '2017-05-01 12:56:15');

-- --------------------------------------------------------

--
-- 表的结构 `wx_config`
--

CREATE TABLE `wx_config` (
  `id` int(5) NOT NULL,
  `token` text NOT NULL,
  `appid` text NOT NULL,
  `appsecret` text NOT NULL,
  `encodingaeskey` text NOT NULL,
  `x_appid` text NOT NULL COMMENT '小程序',
  `x_appsecret` text NOT NULL COMMENT '小程序',
  `old_id` text NOT NULL COMMENT '原始id',
  `switch` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_config`
--

INSERT INTO `wx_config` (`id`, `token`, `appid`, `appsecret`, `encodingaeskey`, `x_appid`, `x_appsecret`, `old_id`, `switch`, `created_at`, `updated_at`) VALUES
(1, 'wemall', 'wx6d040141df50d2113', '523c93731918e84766114ca8f73133824', 'vkG6JOKy7f2f1nejqJalOJkjJEK5JJlNaJjjSQ6Q2gM', 'wx5f1a51823b8371ae8', '8e157d2823fb72dcb17f9762308b8333', 'gh_6f79b1a839f1', 1, '2016-01-05 02:16:16', '2017-05-03 10:33:43');

-- --------------------------------------------------------

--
-- 表的结构 `wx_kefu`
--

CREATE TABLE `wx_kefu` (
  `id` int(5) NOT NULL,
  `status` int(11) NOT NULL,
  `kefu` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_kefu`
--

INSERT INTO `wx_kefu` (`id`, `status`, `kefu`, `created_at`, `updated_at`) VALUES
(1, 1, 'biyuehun', '0000-00-00 00:00:00', '2017-05-03 10:34:06');

-- --------------------------------------------------------

--
-- 表的结构 `wx_menu`
--

CREATE TABLE `wx_menu` (
  `id` int(5) NOT NULL,
  `pid` int(5) NOT NULL DEFAULT '0',
  `type` text,
  `name` text NOT NULL,
  `key` text NOT NULL,
  `url` text NOT NULL,
  `rank` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `remark` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_menu`
--

INSERT INTO `wx_menu` (`id`, `pid`, `type`, `name`, `key`, `url`, `rank`, `status`, `remark`, `created_at`, `updated_at`) VALUES
(1, 0, 'view', '商业版', '111', 'http://www.wemallshop.com/wemall/index.php/App/Index/index', '1', 0, '2', '2016-02-18 06:46:22', '2017-01-11 10:28:43'),
(2, 1, 'view', '分销版', '', 'http://www.wemallshop.com/wfx/App/Shop/index', '4', 0, '1213', '2015-11-06 09:25:28', '2017-02-16 10:17:00'),
(3, 0, 'click', 'QQ客服', 'qqkf', '', '3', 0, '2034210985', '2015-12-31 08:19:22', '2017-05-03 09:03:10');

-- --------------------------------------------------------

--
-- 表的结构 `wx_print`
--

CREATE TABLE `wx_print` (
  `id` int(11) NOT NULL,
  `apikey` varchar(100) DEFAULT NULL COMMENT 'apikey',
  `mkey` varchar(100) DEFAULT NULL COMMENT '秘钥',
  `partner` varchar(100) DEFAULT NULL COMMENT '用户id',
  `machine_code` varchar(100) DEFAULT NULL COMMENT '机器码',
  `switch` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_print`
--

INSERT INTO `wx_print` (`id`, `apikey`, `mkey`, `partner`, `machine_code`, `switch`, `created_at`, `updated_at`) VALUES
(1, '61', '31', '16', '16', 0, '2016-08-07 11:49:22', '2017-05-03 10:34:09');

-- --------------------------------------------------------

--
-- 表的结构 `wx_reply`
--

CREATE TABLE `wx_reply` (
  `id` int(10) unsigned NOT NULL,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `file_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `key` text NOT NULL,
  `remark` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_reply`
--

INSERT INTO `wx_reply` (`id`, `type`, `title`, `description`, `file_id`, `url`, `key`, `remark`, `created_at`, `updated_at`) VALUES
(1, 'news', '恭喜你加入WeMall，欢迎体验WeMall商业版，WeMall分销版和WeMall开源版。WeMall商业版更新，速度提升30%，致力于打造世界上最快，体验最好的微商城。客服QQ：2034210985', '1111', 29, '', 'subscribe', '1212', '2016-01-05 02:19:53', '2017-03-02 06:49:04'),
(2, 'news', '欢迎来到商业版wemall商城', '欢迎来到商业版wemall商城11111', 103, 'http://www.wemallshop.com/3/App/Index/index', '商城', '', '2016-01-05 02:23:41', '2017-03-02 06:49:49'),
(3, 'news', '2222222', '111', 103, '1111', '11111', '1111', '2017-01-12 09:27:57', '2017-03-02 06:49:41');

-- --------------------------------------------------------

--
-- 表的结构 `wx_tplmsg`
--

CREATE TABLE `wx_tplmsg` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `status` int(11) NOT NULL,
  `remark` text NOT NULL,
  `template_id_short` text NOT NULL,
  `template_id` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_tplmsg`
--

INSERT INTO `wx_tplmsg` (`id`, `name`, `type`, `title`, `status`, `remark`, `template_id_short`, `template_id`, `created_at`, `updated_at`) VALUES
(1, '订单提醒(新订单通知)', 'order', '尊敬的客户,您的订单已成功提交！', 1, '666', 'OPENTM201785396', '', '2016-08-07 11:50:16', '2017-01-12 23:07:32'),
(2, '支付提醒(订单支付成功通知)', 'pay', '您已成功支付', 1, '3333', 'OPENTM207791277', '', '2016-08-07 11:50:16', '2017-01-12 23:07:35'),
(3, '发货提醒(订单发货提醒)', 'delivery', '尊敬的客户,您的订单已发货！', 1, '33312', 'OPENTM207763419', '', '2016-08-07 11:50:16', '2017-02-16 11:04:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons_putong_demo_config`
--
ALTER TABLE `addons_putong_demo_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `analysis`
--
ALTER TABLE `analysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_group`
--
ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_group_access`
--
ALTER TABLE `auth_group_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_tpl`
--
ALTER TABLE `mail_tpl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_tpl`
--
ALTER TABLE `sms_tpl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_config`
--
ALTER TABLE `wx_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_kefu`
--
ALTER TABLE `wx_kefu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_menu`
--
ALTER TABLE `wx_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_print`
--
ALTER TABLE `wx_print`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_reply`
--
ALTER TABLE `wx_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_tplmsg`
--
ALTER TABLE `wx_tplmsg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons_putong_demo_config`
--
ALTER TABLE `addons_putong_demo_config`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `auth_group`
--
ALTER TABLE `auth_group`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `auth_group_access`
--
ALTER TABLE `auth_group_access`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `auth_rule`
--
ALTER TABLE `auth_rule`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mail_tpl`
--
ALTER TABLE `mail_tpl`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sms_tpl`
--
ALTER TABLE `sms_tpl`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `wx_config`
--
ALTER TABLE `wx_config`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wx_kefu`
--
ALTER TABLE `wx_kefu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wx_menu`
--
ALTER TABLE `wx_menu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `wx_print`
--
ALTER TABLE `wx_print`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wx_reply`
--
ALTER TABLE `wx_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `wx_tplmsg`
--
ALTER TABLE `wx_tplmsg`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
