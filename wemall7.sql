-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 2017-05-02 11:37:04
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
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '296720094@qq.com', '18053449656', '0', '2017-05-01 10:05:31', '0.0.0.0', 1, '1', '0000-00-00 00:00:00', '2017-05-01 10:05:31'),
(2, 2, '1', 'c4ca4238a0b923820dcc509a6f75849b', '1604583867@qq.com', '18538753627', '0', '2017-05-01 10:03:14', '0.0.0.0', 1, '1', '2017-05-01 09:47:46', '2017-05-01 10:03:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

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
(26, 'admin/config.site/index', '站点设置', 1, 0, 1, NULL, '2017-05-02 02:45:54', '0000-00-00 00:00:00');

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
  `tongji_code` text COMMENT '统计代码',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `config`
--

INSERT INTO `config` (`id`, `title`, `keywords`, `logo_id`, `description`, `copyright`, `tongji_code`, `created_at`, `updated_at`) VALUES
(1, '单用户微商城', 'wemall', 1, '111111', 'Copyright © 2015 wemallshop.com All Rights Reserved 豫ICP备16009619号', '1111121', '2017-01-10 13:30:26', '2017-05-02 03:31:49');

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
(1, 3, 78, NULL, 'wemall', '1', 'c4ca4238a0b923820dcc509a6f75849b', '', 2, 420, 1, 192, '1211', '192.168.0.120', '2017-03-08 03:17:11', '2016-07-26 02:14:20', '2017-05-01 12:38:32'),
(2, 1, 1, '清月曦', '清月曦', '', '', NULL, 0, 0, 1, 0, '1', NULL, '0000-00-00 00:00:00', '2017-05-01 12:40:38', '2017-05-01 12:40:55');

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
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;