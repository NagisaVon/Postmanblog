-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-04-08 13:06:23
-- 服务器版本： 5.1.63
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `postmanb_database`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `name` text NOT NULL,
  `content` text NOT NULL,
  `datetime` datetime NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `name`, `content`, `datetime`, `type`, `user`) VALUES
(1, 'The first post', '感谢<em>CW</em>同学的支持和帮助~ ', '2015-04-04 22:55:09', 0, 2),
(2, '版本更新', '1.0.1更新内容\n    解决需要刷新页面才能看到增加的评论\n    细节优化\n\n1.1.1 更新内容\n    文章页美化\n\n1.1.2 更新内容\n    解决bug\n\n1.2.1 更新内容\n    页面美化\n    增加登陆界面\n', '2015-04-05 11:13:09', 0, 2),
(4, '内部讨论', '@posman\n两件事\n1.用我写出搜索功能吗？\n2.今天（2015-4-6）我14:20 - 20:30不在家，手头也没有电脑。\n\nThis is an private post.', '2015-04-06 11:57:56', 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `name` tinytext NOT NULL COMMENT '文章名',
  `content` text NOT NULL COMMENT '评论内容',
  `datetime` datetime NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `ip` tinytext NOT NULL,
  `article` int(10) unsigned NOT NULL COMMENT '评论哪个文章',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `name`, `content`, `datetime`, `type`, `ip`, `article`) VALUES
(1, 'CW', 'Looks good', '2015-04-04 22:55:33', 0, '123.122.68.216', 1),
(2, '感谢cw', '感谢cw 提供帮助合支持', '2015-04-05 00:46:34', 0, '106.120.178.11', 1),
(3, 'CW', 'Ur vlcom:)', '2015-04-05 11:07:51', 0, '123.116.59.235', 1),
(4, 'CW', '又解决了一个bug，关于评论功能。具体：评论以后刷新才可见自己最新的评论。状态：已解决。', '2015-04-05 11:11:13', 0, '123.116.59.235', 1),
(6, 'CW', 'How''s you doing right now? @posman, everything working fine?', '2015-04-05 12:58:59', 0, '123.116.59.235', 2),
(9, 'CW', 'Working just fine.', '2015-04-05 14:30:24', 0, '211.100.51.59', 2),
(18, 'CW', 'Looks like you did some serious work @postman :) Now you know than where "head.php", "header.php" and "footer.php" work. It''s really helpful:)', '2015-04-05 18:07:59', 0, '123.122.64.43', 3),
(19, 'CW', 'ok我解决了个bug。现在评论文章后马上就能看到新评论看。我本来早就改过去了，但你可能又把article.php给覆盖了。现在版本号是1.2。', '2015-04-05 18:19:54', 0, '123.122.64.43', 3),
(21, 'lc', '不用 剩下的我来 不会的再问你', '2015-04-06 16:15:06', 0, '175.25.189.35', 4),
(22, 'CW', '目前一切正常，所有bug已解决', '2015-04-06 21:13:36', 0, '::1', 4);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` tinytext NOT NULL COMMENT '用户名',
  `email` text NOT NULL COMMENT '用户邮箱',
  `password` text NOT NULL COMMENT '用户的密码',
  `type` tinyint(3) unsigned NOT NULL COMMENT '用户类型',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `type`) VALUES
(1, 'Postman', 'admin@postmanblog.com', '1f820598d2f4393da2bf457a4853126e', 0),
(2, 'CW', 'chenwei2000121@163.com', 'e9982ec5ca981bd365603623cf4b2277', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
