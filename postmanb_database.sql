-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015-04-30 18:48:16
-- 服务器版本: 5.5.40-cll
-- PHP 版本: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `postmanb_database`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `name`, `content`, `datetime`, `type`, `user`) VALUES
(1, 'The first post', '感谢<em>CW</em>同学的支持和帮助~ ', '2015-04-04 22:55:09', 0, 1),
(4, '内部讨论', '@posman\n两件事\n1.用我写出搜索功能吗？\n2.今天（2015-4-6）我14:20 - 20:30不在家，手头也没有电脑。\n\nThis is an private post.', '2015-04-06 11:57:56', 1, 1),
(5, '评教啦~', '嗯，电子阅览室的360浏览器真是难用爆了~不过pb还是正常访问~', '2015-04-22 14:08:27', 0, 1),
(6, '最后的体育模拟', '高中部最后一次体育中考模拟，篮球跑了12秒，差0.1啊啊啊！最后29.5分，有点遗憾。不过应该说有进步吧\n顺便提一点，CenterBrain备案完成啦！！！！！！！！！！！！！！！！有点小兴奋哈。。。', '2015-04-24 18:38:03', 0, 1),
(7, '一模第一天', '听说一模很重要啊～搞得很紧张的样子，今天是一模第一天，考语文和物理。\r\n物理已经错了一个多选呜呜，还有目测语文作文也得挂。\r\n顺便提一句，为什么物理的大试验删掉了？', '2015-04-27 20:36:41', 0, 1),
(8, '一模第二天', '数学貌似正常发挥 \n化学：1、 你说只是把前面的物质投料到后面叫循环么 \n                2、360mL集气瓶排水法收集80%的氧气，请问加多少水~\n                3、计算题忘答题了，啊啊啊（不过数算对了不容易恩恩）\n昨天的物理：刘HZ98 丁ZP97 黄RQ99 丁HH99 \n               。。。然后。。。我 96 。。。我去。。。。。。。我吐槽。。。。啊啊啊。。。。啊啊啊\n明天英语政治，恩政治。\n', '2015-04-28 17:35:00', 0, 1),
(10001, '【置顶】版本更新', '1.0.1更新内容\n    解决需要刷新页面才能看到增加的评论\n    细节优化\n\n1.1.1 更新内容\n    文章页美化\n\n1.1.2 更新内容\n    解决bug\n\n1.2.1 更新内容\n    页面美化\n    增加登陆界面\n\n1.2.3 更新内容\n    增加管理员功能\n    新用户注册将在五一更换服务器后开放\n', '2015-04-05 11:13:09', 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

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
(22, 'CW', '目前一切正常，所有bug已解决', '2015-04-06 21:13:36', 0, '::1', 4),
(23, 'CW', 'Hey postman, I''m waiting for you next update man!!!!!\r\nBy the way I think that we should try another web hosting website.', '2015-04-08 21:15:14', 0, '114.246.77.14', 2),
(24, 'CW', 'Hey postman, I''m still waiting for you next update man!!!!!\r\nBy the way I clearly think that we should try another web hosting website.', '2015-04-08 21:21:34', 0, '114.246.77.14', 4),
(25, 'lc', 'don''t hurry    and I think sevencloud is good enough because it''s free ', '2015-04-08 21:28:04', 0, '101.36.77.35', 4),
(26, 'lc', '对了,cb 的文章要能分页,否则太长的不好翻(尤其on kindle )', '2015-04-08 21:52:46', 0, '101.36.77.35', 4),
(27, 'CW', 'All right, I''ll do it after I''m fine.', '2015-04-09 12:40:41', 0, '123.123.108.92', 4),
(28, 'lc', '你不就感冒么...不能写代码了?', '2015-04-09 17:47:34', 0, '123.150.208.142', 4),
(29, 'CW', '现在挂得很惨&hellip;&hellip;38.4&hellip;&hellip;也只能和你语音聊聊天儿了&hellip;&hellip;', '2015-04-09 17:58:33', 0, '114.246.78.249', 4),
(30, 'lc', '恩 看起来是挺惨的 加油吧', '2015-04-10 21:13:46', 0, '59.109.104.166', 4),
(31, 'CW', 'MacBook Pro用得很爽~\r\n配置：\r\nMacBook Pro（Retina 显示屏，13 英寸，2015 年初期）2.7 GHz Intel Core i5  8 GB 1867 MHz DDR3  256GB SSD', '2015-04-10 22:42:14', 0, '114.252.44.207', 4),
(32, 'lc', 'good ', '2015-04-11 14:59:17', 0, '59.109.104.160', 4),
(33, 'CW', '对了，你有苹果开发者证书吗？', '2015-04-11 20:25:51', 0, '106.187.38.35', 4),
(34, 'CW', '呵呵我们在第一机房&hellip;&hellip;pb访问正常，不过cb访问速度快得想狗一样！备案后换阿里云服务器就是不一样！畅哥加油~', '2015-04-24 16:21:46', 0, '114.242.249.131', 5),
(35, 'p', '我会告诉你 阿里云的服务器 有广告么。。。', '2015-04-24 18:32:39', 0, '123.150.208.140', 5),
(36, 'CW', '不过目测好像大概没有', '2015-04-25 10:13:23', 0, '222.129.239.95', 5),
(37, 'CW', '不错', '2015-04-26 15:01:30', 0, '114.253.36.13', 6),
(38, 'CW', '额。。。。', '2015-04-28 17:36:25', 0, '123.122.64.189', 7),
(39, 'CW', '加油。。', '2015-04-28 17:38:07', 0, '123.122.64.189', 8);

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
(1, 'Postman', 'liuchang62166@hotmail.com', '1f820598d2f4393da2bf457a4853126e', 0),
(2, 'CW', 'chenwei2000121@163.com', 'e9982ec5ca981bd365603623cf4b2277', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
