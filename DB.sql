-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2018 at 09:27 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easyture`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `id` int(250) NOT NULL,
  `sender` int(20) NOT NULL,
  `conversation_id` int(100) NOT NULL,
  `message` text NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`id`, `sender`, `conversation_id`, `message`, `time`, `file`, `type`) VALUES
(1, 18, 1, 'Start Conversation with Tutor 1', '2018-09-03 10:38:52', '', 'text'),
(2, 18, 2, 'Start Conversation with Student 1', '2018-09-03 10:39:27', '', 'text'),
(3, 9, 1, 'stesdf', '2018-09-03 10:41:27', '', 'text'),
(4, 9, 2, 'hi', '2018-09-04 06:38:53', '', 'text'),
(5, 9, 2, 'chag', '2018-09-04 07:33:27', '', 'text'),
(6, 18, 2, 'asdfsfds', '2018-09-04 07:33:46', '', 'text'),
(7, 9, 2, 'Hi i am from another', '2018-09-04 07:34:09', '', 'text'),
(8, 17, 3, 'dsfsf', '2018-09-05 09:31:18', '', 'text'),
(9, 17, 3, 'Hello', '2018-09-05 09:31:27', '', 'text'),
(10, 17, 4, 'sfsdfsf', '2018-09-05 09:39:55', '', 'text'),
(11, 17, 5, 'sdfdsf', '2018-09-05 09:40:03', '', 'text'),
(12, 17, 3, 'sdfdsf', '2018-09-05 09:40:28', '', 'text'),
(13, 17, 6, 'dsfdsf', '2018-09-05 09:40:35', '', 'text'),
(14, 17, 3, 'Hi I am New One', '2018-09-05 09:40:49', '', 'text'),
(15, 17, 3, 'Try to new Conversation', '2018-09-05 09:41:03', '', 'text'),
(16, 17, 6, 'sfddf', '2018-09-05 09:42:10', '', 'text'),
(17, 9, 6, 'Hello', '2018-09-05 09:42:19', '', 'text'),
(18, 9, 2, 'tess', '2018-09-05 09:42:40', '', 'text'),
(19, 18, 2, 'Hi', '2018-09-05 09:43:00', '', 'text'),
(20, 18, 6, 'Hello', '2018-09-05 09:43:09', '', 'text'),
(21, 18, 7, 'teste', '2018-09-05 09:43:30', '', 'text'),
(22, 17, 6, 'test', '2018-09-05 09:43:38', '', 'text'),
(23, 9, 2, 'sfdsf', '2018-09-05 09:44:09', '', 'text'),
(24, 18, 2, 'sdfdsf', '2018-09-05 09:44:25', '', 'text'),
(25, 18, 2, 'sdfdsf', '2018-09-05 09:44:31', '', 'text'),
(26, 9, 2, '', '2018-09-05 10:58:01', '', 'text'),
(27, 9, 2, 'Admin/chat_fileschat_files/2018/09/05/5b90491523124Database.docx', '2018-09-05 11:22:29', 'chat_files/2018/09/05/5b90491523124Database.docx', 'file'),
(28, 9, 2, 'Admin/chat_files/2018/09/05/5b9049acdd978CRISPDM.pdf', '2018-09-05 11:25:00', 'chat_files/2018/09/05/5b9049acdd978CRISPDM.pdf', 'file'),
(29, 9, 2, 'admin/chat_files/2018/09/05/5b904aa9befd001.jpg', '2018-09-05 11:29:13', 'chat_files/2018/09/05/5b904aa9befd001.jpg', 'file'),
(30, 9, 2, '/chat_files/2018/09/05/5b904b3958b9ebtn_img.png', '2018-09-05 11:31:37', 'chat_files/2018/09/05/5b904b3958b9ebtn_img.png', 'file'),
(31, 9, 2, 'chat_files/2018/09/05/5b904c8893b1001.jpg', '2018-09-05 11:37:12', 'chat_files/2018/09/05/5b904c8893b1001.jpg', 'file'),
(32, 9, 2, 'chat_files/2018/09/05/5b904eb71f604BUBT Android à¦…à§à¦¯à¦¾à¦ª à¦à¦° à¦­à¦¾à¦°à§à¦¸à¦¨ à§¨.docx', '2018-09-05 11:46:31', 'chat_files/2018/09/05/5b904eb71f604BUBT Android à¦…à§à¦¯à¦¾à¦ª à¦à¦° à¦­à¦¾à¦°à§à¦¸à¦¨ à§¨.docx', 'file'),
(33, 9, 2, 'chat_files/2018/09/05/5b904ed128092f.sql', '2018-09-05 11:46:57', 'chat_files/2018/09/05/5b904ed128092f.sql', 'file'),
(34, 9, 2, 'chat_files/2018/09/05/5b904f1b3240c01.jpg', '2018-09-05 11:48:11', 'chat_files/2018/09/05/5b904f1b3240c01.jpg', 'file'),
(35, 9, 2, 'chat_files/2018/09/05/5b904faeb6d70Complete_ CV.pdf', '2018-09-05 11:50:38', 'chat_files/2018/09/05/5b904faeb6d70Complete_ CV.pdf', 'file'),
(36, 18, 2, 'chat_files/2018/09/06/5b905321b2376Ajax.php', '2018-09-06 12:05:21', 'chat_files/2018/09/06/5b905321b2376Ajax.php', 'file'),
(37, 18, 2, 'chat_files/2018/09/06/5b905f22cee17index.html', '2018-09-06 12:56:34', 'chat_files/2018/09/06/5b905f22cee17index.html', 'file'),
(38, 18, 2, 'chat_files/2018/09/06/5b905f374f26dLogin.php', '2018-09-06 12:56:55', 'chat_files/2018/09/06/5b905f374f26dLogin.php', 'file'),
(39, 18, 2, 'chat_files/2018/09/06/5b906038abb6bNews.php', '2018-09-06 01:01:12', 'chat_files/2018/09/06/5b906038abb6bNews.php', 'file'),
(40, 18, 2, 'chat_files/2018/09/06/5b90606d051b4Plant.php', '2018-09-06 01:02:05', 'chat_files/2018/09/06/5b90606d051b4Plant.php', 'file'),
(41, 18, 2, 'chat_files/2018/09/06/5b9060a3019b1Plant.php', '2018-09-06 01:02:59', 'chat_files/2018/09/06/5b9060a3019b1Plant.php', 'file'),
(42, 18, 2, 'chat_files/2018/09/06/5b9060bd61f96Upload.php', '2018-09-06 01:03:25', 'chat_files/2018/09/06/5b9060bd61f96Upload.php', 'file'),
(43, 18, 2, '', '2018-09-06 01:05:23', '', 'file'),
(44, 18, 2, '', '2018-09-06 01:06:10', '', 'file'),
(45, 18, 2, 'chat_files/2018/09/06/5b906168a8ce5Admin.xlsx', '2018-09-06 01:06:16', 'chat_files/2018/09/06/5b906168a8ce5Admin.xlsx', 'file'),
(46, 18, 2, '', '2018-09-06 01:06:26', '', 'file');

-- --------------------------------------------------------

--
-- Table structure for table `msg_conversation`
--

CREATE TABLE `msg_conversation` (
  `id` int(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(20) NOT NULL,
  `send_to` int(20) NOT NULL,
  `last_activity` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg_conversation`
--

INSERT INTO `msg_conversation` (`id`, `created_date`, `created_by`, `send_to`, `last_activity`) VALUES
(1, '2018-09-03 10:38:51', 18, 11, '2018-09-03 10:41:27'),
(2, '2018-09-03 10:39:27', 18, 9, '2018-09-06 01:06:26'),
(3, '2018-09-05 09:31:18', 17, 1, '2018-09-05 09:41:03'),
(4, '2018-09-05 09:39:55', 17, 1, '2018-09-05 09:39:56'),
(5, '2018-09-05 09:40:03', 17, 1, '2018-09-05 09:40:03'),
(6, '2018-09-05 09:40:35', 17, 9, '2018-09-05 09:43:38'),
(7, '2018-09-05 09:43:29', 18, 1, '2018-09-05 09:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `msg_participants`
--

CREATE TABLE `msg_participants` (
  `id` int(100) NOT NULL,
  `user_id` int(20) NOT NULL,
  `conversation_id` int(100) NOT NULL,
  `join_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_by` int(20) NOT NULL,
  `is_unread` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg_participants`
--

INSERT INTO `msg_participants` (`id`, `user_id`, `conversation_id`, `join_time`, `added_by`, `is_unread`) VALUES
(1, 9, 1, '2018-09-03 20:38:57', 18, 0),
(2, 1, 1, '2018-09-03 20:41:27', 18, 2),
(3, 18, 1, '2018-09-03 21:05:10', 18, 0),
(4, 11, 1, '2018-09-03 20:41:27', 18, 2),
(5, 18, 2, '2018-09-05 21:50:38', 18, 0),
(6, 9, 2, '2018-09-05 23:06:26', 18, 11),
(7, 17, 3, '2018-09-05 03:31:18', 17, 0),
(8, 1, 3, '2018-09-05 19:41:03', 17, 5),
(9, 17, 4, '2018-09-05 03:39:55', 17, 0),
(10, 1, 4, '2018-09-05 19:39:55', 17, 1),
(11, 17, 5, '2018-09-05 03:40:03', 17, 0),
(12, 1, 5, '2018-09-05 19:40:03', 17, 1),
(13, 18, 6, '2018-09-05 19:43:44', 17, 0),
(14, 17, 6, '2018-09-05 19:43:11', 17, 0),
(15, 9, 6, '2018-09-05 19:43:59', 17, 0),
(16, 18, 7, '2018-09-05 03:43:29', 18, 0),
(17, 1, 7, '2018-09-05 19:43:30', 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(20) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_activity` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `f_name`, `l_name`, `user_name`, `password`, `email`, `picture`, `user_role`, `created_date`, `last_activity`) VALUES
(1, 'STD 2', 'Shekhst', 'std2', '25f9e794323b453885f5181f1b624d0b', 'std2@gmail.com', 'https://simpleisbetterthancomplex.com/img/picture.jpg', 'subscriber', '0000-00-00 00:00:00', '2018-09-01 02:34:47'),
(9, 'STD 1', 'STD L N', 'std1', 'e10adc3949ba59abbe56e057f20f883e', 'std1@gmail.com', 'https://connectedinvestors.com/uploads/user/506326/img_596bc2bd1d16e.jpg', 'student', '0000-00-00 00:00:00', '2018-09-01 03:10:38'),
(10, 'Md Rukon', 'Shekh', 'rukonf', 'e10adc3949ba59abbe56e057f20f883e', 'asad@gmail.com', 'http://www.venmond.com/demo/vendroid/img/avatar/big.jpg', 'subscriber', '0000-00-00 00:00:00', '2018-09-01 03:14:34'),
(11, 'Tutor 1', '', 'tutor1', 'e10adc3949ba59abbe56e057f20f883e', 'tutor1@gmail.com', 'http://www.venmond.com/demo/vendroid/img/avatar/big.jpg', 'tutor', '0000-00-00 00:00:00', '2018-09-01 03:17:21'),
(12, 'Mother Of Std 1', ' Teswt', 'fa', 'e10adc3949ba59abbe56e057f20f883e', 'mother1@gmail.com', 'http://www.venmond.com/demo/vendroid/img/avatar/big.jpg', 'parent', '0000-00-00 00:00:00', '2018-09-01 03:18:32'),
(13, 'Parent 2', 'Shekh', 'parent2', 'e10adc3949ba59abbe56e057f20f883e', 'parent2@gmail.com', 'http://www.venmond.com/demo/vendroid/img/avatar/big.jpg', 'parent', '0000-00-00 00:00:00', '2018-09-01 03:20:51'),
(14, 'Md Rukondd', 'Shekhfadddddddddd', 'rukonee', 'bab2a051939c5972f9acaee6c3fb439f', 'asaeed@gmail.com', '', 'student', '0000-00-00 00:00:00', '2018-09-01 03:21:57'),
(15, 'Md Rukon', 'sdfdsf', 'sfsfddsf', '28da0e7d022e1f46aca63a15bb298dbc', 'dfsaf@gmailc.om', '', 'student', '0000-00-00 00:00:00', '2018-09-01 03:24:05'),
(16, 'Md Rukonsdfaf', 'Shekhds', 'rukonsad', 'a39bb7bca298e5ea5b99e952a8b0b488', '56ae85df6b86f', '', 'tutor', '0000-00-00 00:00:00', '2018-09-01 03:25:17'),
(17, 'Adminstrator', 'ad', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com', '', 'admin', '0000-00-00 00:00:00', '2018-09-01 03:26:00'),
(18, 'Parent 1', 'Shekh', 'aparent1', 'e10adc3949ba59abbe56e057f20f883e', 'parent1@gmail.com', 'https://i1.social.s-msft.com/profile/u/avatar.jpg?displayname=vesa+juvonen&size=extralarge&version=7f0318a7-1fa1-4bc3-bad3-8e87311d99c6', 'parent', '0000-00-00 00:00:00', '2018-09-01 10:04:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msg_conversation`
--
ALTER TABLE `msg_conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msg_participants`
--
ALTER TABLE `msg_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `msg_conversation`
--
ALTER TABLE `msg_conversation`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `msg_participants`
--
ALTER TABLE `msg_participants`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
