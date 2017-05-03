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