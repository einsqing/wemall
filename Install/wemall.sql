-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-09 03:22:16
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wemall2.3`
--

-- --------------------------------------------------------

--
-- 表的结构 `wemall_access`
--

CREATE TABLE `wemall_access` (
  `role_id` smallint(6) UNSIGNED NOT NULL,
  `node_id` smallint(6) UNSIGNED NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_admin`
--

CREATE TABLE `wemall_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wemall_admin`
--

INSERT INTO `wemall_admin` (`id`, `username`, `password`, `time`) VALUES
-- (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2016-03-03 07:21:15');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_alipay`
--

CREATE TABLE `wemall_alipay` (
  `id` int(11) NOT NULL,
  `alipayname` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '支付宝名称',
  `partner` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '合作身份者id',
  `key` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '安全检验码'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `wemall_alipay`
--

INSERT INTO `wemall_alipay` (`id`, `alipayname`, `partner`, `key`) VALUES
(1, '1', '2', '3');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_good`
--

CREATE TABLE `wemall_good` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` text NOT NULL,
  `old_price` text NOT NULL,
  `savepath` text NOT NULL,
  `image` text NOT NULL,
  `detail` text NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wemall_good`
--

INSERT INTO `wemall_good` (`id`, `menu_id`, `sort`, `name`, `price`, `old_price`, `savepath`, `image`, `detail`, `status`, `time`) VALUES
(1, 1, 1, '苹果', '5', '8', '/Uploads/2016-03-07/', '56dd498f8a25f.jpg', '<p>好吃不贵1</p>', 1, '2016-03-08 07:54:30'),
(2, 3, 1, '番茄', '3', '5', '/Uploads/2016-03-07/', '56dd4a7c8a8a3.jpg', '', 1, '2016-03-09 01:37:58');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_info`
--

CREATE TABLE `wemall_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `notification` text NOT NULL,
  `theme` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wemall_info`
--

INSERT INTO `wemall_info` (`id`, `name`, `notification`, `theme`) VALUES
(1, 'wemall', '欢迎来到wemall世界！！！', 'default');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_mail`
--

CREATE TABLE `wemall_mail` (
  `id` int(10) UNSIGNED NOT NULL,
  `smtp` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `on` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_menu`
--

CREATE TABLE `wemall_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wemall_menu`
--

INSERT INTO `wemall_menu` (`id`, `name`, `pid`) VALUES
(1, ' 水果', 0),
(3, '蔬菜', 0);

-- --------------------------------------------------------

--
-- 表的结构 `wemall_node`
--

CREATE TABLE `wemall_node` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) UNSIGNED DEFAULT NULL,
  `pid` smallint(6) UNSIGNED NOT NULL,
  `level` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_order`
--

CREATE TABLE `wemall_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `orderid` text NOT NULL,
  `totalprice` text NOT NULL,
  `pay_style` text NOT NULL,
  `pay_status` text NOT NULL,
  `note` text NOT NULL,
  `order_status` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cartdata` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wemall_order`
--

INSERT INTO `wemall_order` (`id`, `user_id`, `orderid`, `totalprice`, `pay_style`, `pay_status`, `note`, `order_status`, `time`, `cartdata`) VALUES
(1, 1, '1603070532392', '5.00', '货到付款', '1', '哈哈', '1', '2016-03-07 09:32:52', '[{"name":"苹果","num":"1","price":"5"}]');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_role`
--

CREATE TABLE `wemall_role` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) UNSIGNED DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_role_user`
--

CREATE TABLE `wemall_role_user` (
  `role_id` mediumint(9) UNSIGNED DEFAULT NULL,
  `admin_id` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_user`
--

CREATE TABLE `wemall_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` text NOT NULL,
  `username` text NOT NULL,
  `phone` text NOT NULL,
  `password` text DEFAULT NULL,
  `address` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wemall_user`
--

INSERT INTO `wemall_user` (`id`, `uid`, `username`, `phone`, `password`, `address`, `time`) VALUES
(1, '1', '何先生', '15378708792', '', '郑州市金水区', '2016-03-04 07:35:45');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_wxconfig`
--

CREATE TABLE `wemall_wxconfig` (
  `id` int(5) NOT NULL,
  `num` text NOT NULL,
  `token` text NOT NULL,
  `appid` text NOT NULL,
  `appsecret` text NOT NULL,
  `encodingaeskey` text NOT NULL,
  `mchid` text NOT NULL,
  `key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wemall_wxconfig`
--

INSERT INTO `wemall_wxconfig` (`id`, `num`, `token`, `appid`, `appsecret`, `encodingaeskey`, `mchid`, `key`) VALUES
(1, 'wemall', 'wemall', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_wxmenu`
--

CREATE TABLE `wemall_wxmenu` (
  `id` int(5) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `name` varchar(10) NOT NULL,
  `key` varchar(200) NOT NULL,
  `url` varchar(300) NOT NULL,
  `pid` int(5) NOT NULL DEFAULT '0',
  `listorder` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wemall_wxmenu`
--

INSERT INTO `wemall_wxmenu` (`id`, `type`, `name`, `key`, `url`, `pid`, `listorder`, `status`) VALUES
(1, 'click', '进入商城', 'BUY', '', 0, '', 1),
(2, 'view', '关于我们', '', 'http://m.baidu.com', 0, '3', 1);

-- --------------------------------------------------------

--
-- 表的结构 `wemall_wxmessage`
--

CREATE TABLE `wemall_wxmessage` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `savepath` text NOT NULL,
  `picurl` text NOT NULL,
  `url` text NOT NULL,
  `key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wemall_wxmessage`
--

INSERT INTO `wemall_wxmessage` (`id`, `type`, `title`, `description`, `savepath`, `picurl`, `url`, `key`) VALUES
(1, '0', 'wemall', '欢迎来到wemall1', '/Uploads/2016-03-07/', '56dd51a3ed4df.jpg', 'http://www.xxx.com/index.php?m=App&amp;c=Index&amp;a=index', 'BUY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wemall_access`
--
ALTER TABLE `wemall_access`
  ADD KEY `groupId` (`role_id`),
  ADD KEY `nodeId` (`node_id`);

--
-- Indexes for table `wemall_admin`
--
ALTER TABLE `wemall_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_alipay`
--
ALTER TABLE `wemall_alipay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_good`
--
ALTER TABLE `wemall_good`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_info`
--
ALTER TABLE `wemall_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_mail`
--
ALTER TABLE `wemall_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_menu`
--
ALTER TABLE `wemall_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_node`
--
ALTER TABLE `wemall_node`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level` (`level`),
  ADD KEY `pid` (`pid`),
  ADD KEY `status` (`status`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `wemall_order`
--
ALTER TABLE `wemall_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_role`
--
ALTER TABLE `wemall_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `wemall_role_user`
--
ALTER TABLE `wemall_role_user`
  ADD KEY `group_id` (`role_id`),
  ADD KEY `user_id` (`admin_id`);

--
-- Indexes for table `wemall_user`
--
ALTER TABLE `wemall_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_wxconfig`
--
ALTER TABLE `wemall_wxconfig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_wxmenu`
--
ALTER TABLE `wemall_wxmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wemall_wxmessage`
--
ALTER TABLE `wemall_wxmessage`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `wemall_admin`
--
ALTER TABLE `wemall_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `wemall_alipay`
--
ALTER TABLE `wemall_alipay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `wemall_good`
--
ALTER TABLE `wemall_good`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `wemall_info`
--
ALTER TABLE `wemall_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `wemall_mail`
--
ALTER TABLE `wemall_mail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `wemall_menu`
--
ALTER TABLE `wemall_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `wemall_node`
--
ALTER TABLE `wemall_node`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `wemall_order`
--
ALTER TABLE `wemall_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `wemall_role`
--
ALTER TABLE `wemall_role`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `wemall_user`
--
ALTER TABLE `wemall_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `wemall_wxconfig`
--
ALTER TABLE `wemall_wxconfig`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `wemall_wxmenu`
--
ALTER TABLE `wemall_wxmenu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `wemall_wxmessage`
--
ALTER TABLE `wemall_wxmessage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
