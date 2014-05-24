-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- 生成日期: 2014 年 05 月 21 日 21:49

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `bKnrGDXVdkvwSJfeatWj`
--

-- --------------------------------------------------------

--
-- 表的结构 `wemall_admin`
--

CREATE TABLE IF NOT EXISTS `wemall_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `wemall_admin`
--

INSERT INTO `wemall_admin` (`id`, `username`, `password`, `time`) VALUES
(1, 'wemall', 'wemall', '2014-05-24 01:56:07');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_menu`
--

CREATE TABLE IF NOT EXISTS `wemall_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `price` text NOT NULL,
  `old_price` text NOT NULL,
  `img` text NOT NULL,
  `detail` text NOT NULL,
  `goods_stock` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `wemall_menu`
--

INSERT INTO `wemall_menu` (`id`, `cate_id`, `title`, `price`, `old_price`, `img`, `detail`, `goods_stock`) VALUES
(1, 1, '橙子', '10', '10', 'item/chengzi.jpg', '橙子相当不错哦！！！', '100'),
(7, 1, '草莓', '10', '10', 'item/caomei.jpg', '香甜可口', '100'),
(8, 1, '芒果', '10', '10', 'item/mangguo.jpg', '香甜可口', '100'),
(9, 1, '苹果', '10', '10', 'item/pingguo.jpg', '', ''),
(10, 1, '菠萝', '10', '10', 'item/boluo.jpg', '', ''),
(11, 1, '香蕉', '10', '10', 'item/xiangjiao.jpg', '', ''),
(12, 2, '麻婆豆腐', '10', '10', 'item/mapodoufu.jpg', '', ''),
(13, 2, '炒蒜薹', '10', '10', 'item/chaosuanrong.jpg', '', ''),
(14, 2, '清炒莴笋丝', '10', '10', 'item/qingchaowojunsi.jpg', '', ''),
(15, 2, '上汤娃娃菜', '10', '10', 'item/shangtangwawacai.jpg', '', ''),
(16, 2, '蒜蓉西兰花', '10', '10', 'item/suanrongxilanhua.jpg', '', ''),
(17, 2, '土豆丝炒胡萝卜丝', '10', '10', 'item/tudousichaohuluobusi.jpg', '', ''),
(19, 3, 'php mvc', '72', '98', '2014-05-09/536cd80b32179.jpg', 'php mvc', '');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_nav`
--

CREATE TABLE IF NOT EXISTS `wemall_nav` (
  `id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wemall_nav`
--

INSERT INTO `wemall_nav` (`id`, `value`) VALUES
(1, '水果'),
(2, '蔬菜'),
(3, '图书'),
(4, '外卖');

-- --------------------------------------------------------

--
-- 表的结构 `wemall_orders`
--

CREATE TABLE IF NOT EXISTS `wemall_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `orderid` text NOT NULL,
  `username` text NOT NULL,
  `mobile` text NOT NULL,
  `address` text NOT NULL,
  `totalprice` text NOT NULL,
  `note` text NOT NULL,
  `status` text NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `wemall_orders`
--

--
-- 表的结构 `wemall_orders_detail`
--

CREATE TABLE IF NOT EXISTS `wemall_orders_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `orderid` text NOT NULL,
  `title` text NOT NULL,
  `price` text NOT NULL,
  `quantity` text NOT NULL,
  `totalprice` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wemall_weixin`
--

CREATE TABLE IF NOT EXISTS `wemall_weixin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `wemall_weixin`
--

INSERT INTO `wemall_weixin` (`id`, `title`, `description`, `img`) VALUES
(1, '欢迎来到微商城', '欢迎来到微信商城', 'http://wemall.duapp.com/Uploads/wemall.jpg');

