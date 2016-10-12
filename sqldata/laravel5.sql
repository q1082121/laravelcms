-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-10-11 17:08:50
-- 服务器版本： 5.5.28
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravel5`
--

-- --------------------------------------------------------

--
-- 表的结构 `classifies`
--

CREATE TABLE IF NOT EXISTS `classifies` (
  `id` int(10) unsigned NOT NULL,
  `modelid` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bcid` int(11) NOT NULL DEFAULT '0',
  `scid` int(11) NOT NULL DEFAULT '0',
  `topid` int(11) NOT NULL DEFAULT '0',
  `grade` tinyint(4) NOT NULL DEFAULT '0',
  `node` text COLLATE utf8_unicode_ci,
  `navflag` tinyint(4) NOT NULL DEFAULT '0',
  `perpage` tinyint(4) NOT NULL DEFAULT '0',
  `attachment` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `orderid` int(11) NOT NULL DEFAULT '0',
  `linkurl` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `classifies`
--

INSERT INTO `classifies` (`id`, `modelid`, `name`, `bcid`, `scid`, `topid`, `grade`, `node`, `navflag`, `perpage`, `attachment`, `orderid`, `linkurl`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '新闻资讯', 1, 0, 0, 1, '', 0, 1, '', 0, '', 1, 0, '2016-10-09 23:43:17', '2016-10-09 23:43:17'),
(2, 2, '产品中心', 2, 0, 0, 1, '', 1, 0, '', 0, '', 1, 0, '2016-10-09 23:44:50', '2016-10-10 19:51:13'),
(3, 1, '行业资讯', 1, 3, 1, 2, '1,3', 0, 0, '', 0, '', 1, 0, '2016-10-10 17:20:44', '2016-10-10 17:20:44'),
(4, 1, '最新资讯', 1, 4, 1, 2, '1,4', 0, 0, '', 0, '', 1, 0, '2016-10-10 17:21:40', '2016-10-10 17:21:40'),
(5, 2, '最新产品', 2, 5, 2, 2, '2,5', 0, 0, '', 0, '', 1, 0, '2016-10-10 17:21:56', '2016-10-10 20:26:55'),
(6, 1, '热门新闻', 4, 6, 4, 3, '1,4,6', 0, 0, '', 0, '', 1, 0, '2016-10-10 18:19:18', '2016-10-10 18:19:18'),
(7, 1, '好新网3', 2, 7, 2, 2, '2,7', 0, 0, '20161011085131.jpg', 0, '', 1, 0, '2016-10-10 18:19:38', '2016-10-11 00:57:27');

-- --------------------------------------------------------

--
-- 表的结构 `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) unsigned NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `logs`
--

INSERT INTO `logs` (`id`, `type`, `user_id`, `name`, `info`, `ip`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'admin', '登录操作行为', '127.0.0.1', '2016-10-09 16:36:53', '2016-10-09 16:36:53'),
(2, 1, 1, 'admin', '登录操作行为', '127.0.0.1', '2016-10-10 16:38:00', '2016-10-10 16:38:00'),
(3, 1, 1, 'admin', '登录操作行为', '127.0.0.1', '2016-10-10 20:51:41', '2016-10-10 20:51:41');

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_08_29_030826_create_userinfos_table', 1),
('2016_09_07_020701_create_logs_table', 1),
('2016_09_29_033513_entrust_setup_tables', 1),
('2016_10_10_020548_create_classify_table', 2);

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'add', '添加', '添加权限', '2016-09-29 20:47:20', '2016-09-29 20:47:20'),
(2, 'edit', '编辑', '编辑操作权限', '2016-09-29 20:47:55', '2016-09-29 20:47:55'),
(3, 'delete', '删除', '删除操作权限的', '2016-09-29 20:48:43', '2016-09-29 20:48:55'),
(4, 'search', '搜索', '搜索权限', '2016-09-29 23:04:25', '2016-09-29 23:04:25'),
(5, 'set_role', '设置角色', '', '2016-10-08 22:48:28', '2016-10-08 23:00:09'),
(6, 'set_lock', '设置用户锁', '', '2016-10-08 22:49:25', '2016-10-08 22:59:59'),
(7, 'get_user_role', '获取用户角色', '', '2016-10-08 22:53:05', '2016-10-08 22:59:00'),
(8, 'cancel_user_role', '取消用户角色', '', '2016-10-08 22:53:43', '2016-10-08 22:59:19'),
(9, 'set_permission', '设置权限', '', '2016-10-08 22:55:52', '2016-10-08 22:59:48'),
(10, 'get_role_permission', '获取角色权限', '', '2016-10-08 22:56:52', '2016-10-08 22:59:38'),
(11, 'cancel_role_permission', '取消角色权限', '', '2016-10-08 22:57:40', '2016-10-08 22:57:40'),
(12, 'model_setting', '模块-系统设置', '', '2016-10-08 23:14:24', '2016-10-08 23:14:24'),
(13, 'model_log', '模块-日志管理', '', '2016-10-08 23:15:17', '2016-10-08 23:15:17'),
(14, 'model_message', '模块-消息管理', '', '2016-10-08 23:17:09', '2016-10-08 23:17:09'),
(15, 'model_role', '模块-用户角色', '', '2016-10-08 23:17:51', '2016-10-08 23:17:51'),
(16, 'model_permission', '模块-角色权限', '', '2016-10-08 23:18:25', '2016-10-08 23:18:25'),
(17, 'model_user', '模块-用户管理', '', '2016-10-08 23:18:59', '2016-10-08 23:18:59'),
(18, 'model_info', '模块-资讯管理', '', '2016-10-08 23:19:30', '2016-10-08 23:19:30'),
(19, 'model_picture', '模块-图片管理', '', '2016-10-08 23:19:59', '2016-10-08 23:19:59'),
(20, 'model_links', '模块-链接管理', '', '2016-10-08 23:20:41', '2016-10-08 23:20:41'),
(21, 'model_wechat', '模块-微信管理', '', '2016-10-08 23:21:21', '2016-10-08 23:21:21'),
(22, 'model_chart', '模块-数据图表', '', '2016-10-08 23:21:49', '2016-10-08 23:21:49'),
(23, 'model_class', '模块-栏目分类', '', '2016-10-08 23:22:45', '2016-10-08 23:26:21');

-- --------------------------------------------------------

--
-- 表的结构 `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 2),
(4, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4);

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', '管理员', '管理员拥有全部权限', '2016-09-29 00:24:53', '2016-09-29 00:24:53'),
(2, 'user', '普通用户组', '普通权限', '2016-09-29 00:44:16', '2016-09-29 00:44:16'),
(3, 'vip', '高级会员', '高级权限可操作', '2016-09-29 00:44:52', '2016-09-29 18:06:01'),
(4, 'subadmin', '子管理员', '部分权限限制的', '2016-09-29 20:33:50', '2016-09-29 20:34:02');

-- --------------------------------------------------------

--
-- 表的结构 `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(3, 2),
(2, 4);

-- --------------------------------------------------------

--
-- 表的结构 `userinfos`
--

CREATE TABLE IF NOT EXISTS `userinfos` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nick` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT '0',
  `birthday` timestamp NULL DEFAULT NULL,
  `qq` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_pid` int(11) NOT NULL DEFAULT '0',
  `area_cid` int(11) NOT NULL DEFAULT '0',
  `area_xid` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `money` decimal(8,2) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `userinfos`
--

INSERT INTO `userinfos` (`id`, `name`, `nick`, `sex`, `birthday`, `qq`, `area_pid`, `area_cid`, `area_xid`, `score`, `money`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, '管理员', 0, NULL, NULL, 0, 0, 0, 0, '0.00', '1', '2016-09-28 21:25:34', '2016-09-28 21:25:34'),
(2, NULL, '子管理员', 0, NULL, NULL, 0, 0, 0, 0, '0.00', '2', '2016-10-09 01:23:42', '2016-10-09 01:23:42'),
(3, NULL, '小呆瓜', 0, NULL, NULL, 0, 0, 0, 0, '0.00', '3', '2016-10-09 01:24:34', '2016-10-09 01:24:34');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_group` tinyint(4) NOT NULL DEFAULT '0',
  `is_lock` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `mobile`, `password`, `role_group`, `is_lock`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL, '$2y$10$U0dVKJBNjQn7lkwCtQjDROGbyURoby0nT/8o30Yr0uhmpyMU3CDb.', 1, 0, 'LT9ywRFzVzMzUVURXsvO7CiqQigDrovNCsW9WpPZKfZP9dXv09Vep187V9np', '2016-09-28 21:25:34', '2016-10-09 00:28:31'),
(2, 'subadmin', NULL, NULL, '$2y$10$B94m7TC01z5yKNaDypV2y.eQCPwXl2YUlf6Ik3mIeHxa1wTAZuo3q', 0, 0, '', '2016-10-09 01:23:42', '2016-10-09 01:23:42'),
(3, 'demo', NULL, NULL, '$2y$10$lGIkegbR0q9S5yIlTPxwfuWsH40vZsP053oqjOcNwuZw9XLdpd.YS', 0, 0, '', '2016-10-09 01:24:34', '2016-10-10 19:40:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classifies`
--
ALTER TABLE `classifies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `userinfos`
--
ALTER TABLE `userinfos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userinfos_user_id_unique` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classifies`
--
ALTER TABLE `classifies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `userinfos`
--
ALTER TABLE `userinfos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
