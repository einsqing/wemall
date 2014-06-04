
--
-- 数据库: `wemall`
--

-- --------------------------------------------------------

--
-- 表的结构 `dbprefix_admin`
--

CREATE TABLE IF NOT EXISTS `dbprefix_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 表的结构 `dbprefix_menu`
--

CREATE TABLE IF NOT EXISTS `dbprefix_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `price` text NOT NULL,
  `old_price` text NOT NULL,
  `img` text NOT NULL,
  `detail` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- 表的结构 `dbprefix_nav`
--

CREATE TABLE IF NOT EXISTS `dbprefix_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- 表的结构 `dbprefix_orders`
--

CREATE TABLE IF NOT EXISTS `dbprefix_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `orderid` text NOT NULL,
  `totalprice` text NOT NULL,
  `pay_status` text NOT NULL,
  `note` text NOT NULL,
  `status` text NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- 表的结构 `dbprefix_orders_detail`
--

CREATE TABLE IF NOT EXISTS `dbprefix_orders_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` text NOT NULL,
  `title` text NOT NULL,
  `price` text NOT NULL,
  `quantity` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- 表的结构 `dbprefix_users`
--

CREATE TABLE IF NOT EXISTS `dbprefix_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `username` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `balance` text NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- 表的结构 `dbprefix_weixin`
--

CREATE TABLE IF NOT EXISTS `dbprefix_weixin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `dbprefix_weixin`
--

INSERT INTO `dbprefix_weixin` (`id`, `title`, `description`, `img`) VALUES
(1, '欢迎来到微信商城', '欢迎来到微信商城，关注微信号:iwemall', '538bfe0727865.jpg');
