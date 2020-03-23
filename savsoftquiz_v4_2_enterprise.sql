-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2018 at 09:05 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `savsoftquiz_v4.2_enterprise`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `account_id` int(11) NOT NULL,
  `users` varchar(1000) DEFAULT NULL,
  `quiz` varchar(1000) DEFAULT NULL,
  `results` varchar(1000) DEFAULT NULL,
  `questions` varchar(1000) DEFAULT NULL,
  `account_name` varchar(1000) DEFAULT NULL,
  `setting` varchar(100) DEFAULT NULL,
  `social_group` varchar(1000) NOT NULL,
  `study_material` varchar(1000) NOT NULL,
  `assignment` varchar(1000) NOT NULL,
  `appointment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`account_id`, `users`, `quiz`, `results`, `questions`, `account_name`, `setting`, `social_group`, `study_material`, `assignment`, `appointment`) VALUES
(1, 'Add,Edit,View,List,List_all,Myaccount,Remove', 'Attempt,Add,Edit,View,List,List_all,Remove', 'View,List,List_all,Remove', 'Add,Edit,View,list,List_all,Remove', 'Administrator', 'All', 'Add,Edit,Edit_all,Join,Remove,Remove_all,Invite,Add_other', 'Add,Edit,View,List,List_all,Remove', 'Add,Edit,View,List,List_all,Submit,Remove', 'List,List_all'),
(2, 'Myaccount', 'Attempt,View,List', 'View,List,Remove', '', 'User', NULL, 'Add,Edit,Join,Remove,Invite', 'View,List', 'View,List,Submit', 'List');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_request`
--

CREATE TABLE `appointment_request` (
  `appointment_id` int(11) NOT NULL,
  `request_by` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `appointment_timing` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `appointment_time_zone` varchar(100) NOT NULL DEFAULT 'Asia/Kolkata',
  `appointment_status` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_request`
--

INSERT INTO `appointment_request` (`appointment_id`, `request_by`, `to_id`, `appointment_timing`, `appointment_time_zone`, `appointment_status`) VALUES
(2, 9, 1, '2017-08-30 07:53:57', 'Asia/Kolkata', 'Accepted'),
(3, 1, 1, '2017-12-27 08:43:25', 'Asia/Kolkata', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class_coment`
--

CREATE TABLE `class_coment` (
  `content_id` int(11) NOT NULL,
  `generated_time` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `content_by` int(11) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class_gid`
--

CREATE TABLE `class_gid` (
  `clgid` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `gid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_gid`
--

INSERT INTO `class_gid` (`clgid`, `class_id`, `gid`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 1, 1),
(7, 2, 1),
(8, 2, 3),
(9, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `group_invitation`
--

CREATE TABLE `group_invitation` (
  `invitation_id` int(11) NOT NULL,
  `sg_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `custom_message` varchar(100) NOT NULL,
  `invitation_status` varchar(100) NOT NULL DEFAULT 'Pending',
  `invitation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invited_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_invitation`
--

INSERT INTO `group_invitation` (`invitation_id`, `sg_id`, `uid`, `custom_message`, `invitation_status`, `invitation_date`, `invited_by`) VALUES
(1, 1, 9, 'Hey! join this group pls..', 'Rejected', '2017-08-27 17:43:23', 1),
(3, 1, 9, 'Hey! join this group pls..', 'Rejected', '2017-08-27 18:54:21', 1),
(4, 1, 9, 'Hey! join this group pls..', 'Accepted', '2017-08-27 18:56:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `live_class`
--

CREATE TABLE `live_class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(1000) NOT NULL,
  `initiated_by` int(11) NOT NULL,
  `initiated_time` int(11) NOT NULL,
  `closed_time` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `SQLc_session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `live_class`
--

INSERT INTO `live_class` (`class_id`, `class_name`, `initiated_by`, `initiated_time`, `closed_time`, `content`, `SQLc_session_id`) VALUES
(2, 'ABCD', 1, 1514485800, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE `news_feed` (
  `feed_id` int(11) NOT NULL,
  `sg_id` int(11) NOT NULL,
  `feed` varchar(1000) NOT NULL,
  `feed_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_feed`
--

INSERT INTO `news_feed` (`feed_id`, `sg_id`, `feed`, `feed_date`) VALUES
(1, 1, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-11-23 04:51:41'),
(2, 2, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-11-23 04:51:41'),
(3, 3, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-11-23 04:51:41'),
(4, 1, 'Admin Admin attempted quiz ''IBPS 1'' and obtained 0% ', '2017-11-23 05:02:20'),
(5, 2, 'Admin Admin attempted quiz ''IBPS 1'' and obtained 0% ', '2017-11-23 05:02:20'),
(6, 3, 'Admin Admin attempted quiz ''IBPS 1'' and obtained 0% ', '2017-11-23 05:02:20'),
(7, 1, 'Admin Admin attempted quiz ''IBPS 1'' and obtained 0% ', '2017-11-23 05:03:03'),
(8, 2, 'Admin Admin attempted quiz ''IBPS 1'' and obtained 0% ', '2017-11-23 05:03:03'),
(9, 3, 'Admin Admin attempted quiz ''IBPS 1'' and obtained 0% ', '2017-11-23 05:03:03'),
(10, 1, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-12-22 05:12:32'),
(11, 2, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-12-22 05:12:33'),
(12, 3, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-12-22 05:12:33'),
(13, 1, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-12-26 08:24:08'),
(14, 2, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-12-26 08:24:08'),
(15, 3, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-12-26 08:24:08'),
(16, 1, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-12-26 08:25:35'),
(17, 2, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-12-26 08:25:35'),
(18, 3, 'Admin Admin attempted quiz ''Default Quiz'' and obtained 0% ', '2017-12-26 08:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `savsoftquiz_custom_form`
--

CREATE TABLE `savsoftquiz_custom_form` (
  `field_id` int(11) NOT NULL,
  `field_title` varchar(100) NOT NULL,
  `field_type` varchar(100) NOT NULL DEFAULT 'text',
  `field_validate` varchar(1000) NOT NULL DEFAULT 'pattern="[A-Za-z0-9]{1,100}"',
  `field_value` varchar(100) DEFAULT NULL,
  `display_at` varchar(100) NOT NULL DEFAULT 'Registration'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savsoftquiz_custom_form`
--

INSERT INTO `savsoftquiz_custom_form` (`field_id`, `field_title`, `field_type`, `field_validate`, `field_value`, `display_at`) VALUES
(1, 'School Name', 'text', 'pattern="[A-Za-z0-9]{1,100}"', '', 'Registration'),
(2, 'Registration Number', 'text', 'pattern="[A-Za-z0-9]{1,100}"', '', 'Registration'),
(3, 'Mobile No', 'text', 'pattern="[0-9]{1,11}"', '', 'Result');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_add`
--

CREATE TABLE `savsoft_add` (
  `add_id` int(11) NOT NULL,
  `advertisement_code` text NOT NULL,
  `banner` varchar(1000) NOT NULL,
  `banner_link` varchar(1000) DEFAULT NULL,
  `position` varchar(100) NOT NULL,
  `add_status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savsoft_add`
--

INSERT INTO `savsoft_add` (`add_id`, `advertisement_code`, `banner`, `banner_link`, `position`, `add_status`) VALUES
(1, '', '1501084226.jpg', 'https://savsoftquiz.com', 'Top', 'Inactive'),
(2, '	', '1501084206.jpg', 'https://savsoftquiz.com', 'Bottom', 'Active'),
(3, '', '1501084197.jpg', 'https://savsoftquiz.com', 'Center_Result', 'Active'),
(4, '', '1501084258.jpg', 'https://savsoftquiz.com', 'During_Quiz', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_answers`
--

CREATE TABLE `savsoft_answers` (
  `aid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `q_option` text NOT NULL,
  `uid` int(11) NOT NULL,
  `score_u` float NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_answers`
--

INSERT INTO `savsoft_answers` (`aid`, `qid`, `q_option`, `uid`, `score_u`, `rid`) VALUES
(8, 79, '300', 1, 1, 1),
(9, 80, '304', 1, 1, 1),
(10, 81, '317', 1, 0.5, 1),
(11, 81, '319', 1, 0.5, 1),
(15, 81, '317', 1, 0.5, 3),
(16, 79, '302', 1, 0, 3),
(24, 79, '300', 1, 1, 4),
(25, 80, '304', 1, 1, 4),
(26, 81, '317', 1, 0.5, 4),
(27, 81, '319', 1, 0.5, 4),
(34, 79, '300', 1, 1, 5),
(35, 80, '305', 1, 0, 5),
(36, 81, '317', 1, 0.5, 5),
(43, 79, '300', 1, 1, 6),
(44, 80, '305', 1, 0, 6),
(45, 81, '317', 1, 0.5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_assignment`
--

CREATE TABLE `savsoft_assignment` (
  `assignment_id` int(11) NOT NULL,
  `assignment_title` varchar(100) NOT NULL,
  `assignment_description` text NOT NULL,
  `due_date` datetime NOT NULL,
  `attachments` text NOT NULL,
  `gids` varchar(1000) NOT NULL,
  `cid` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savsoft_assignment`
--

INSERT INTO `savsoft_assignment` (`assignment_id`, `assignment_title`, `assignment_description`, `due_date`, `attachments`, `gids`, `cid`, `created_by`, `created_date`) VALUES
(4, 'Assignment -1 -AUG 17', 'Submit report on make in india', '2017-09-12 00:00:00', '1503947911.pdf', '1,3,4', 1, 1, '2017-08-28 19:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_category`
--

CREATE TABLE `savsoft_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_category`
--

INSERT INTO `savsoft_category` (`cid`, `category_name`) VALUES
(1, 'General knowledge'),
(2, 'Math');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_group`
--

CREATE TABLE `savsoft_group` (
  `gid` int(11) NOT NULL,
  `group_name` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `valid_for_days` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_group`
--

INSERT INTO `savsoft_group` (`gid`, `group_name`, `price`, `valid_for_days`, `description`) VALUES
(1, 'Free', 0, 0, '10 Free quiz'),
(3, 'Premium-1', 100, 90, '100 Quizzes'),
(4, 'Group 3', 2500, 90, '<p>Unlimites quizzes.</p>\r\n<p>Phone support</p>');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_level`
--

CREATE TABLE `savsoft_level` (
  `lid` int(11) NOT NULL,
  `level_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_level`
--

INSERT INTO `savsoft_level` (`lid`, `level_name`) VALUES
(1, 'Easy'),
(2, 'Difficult');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_notification`
--

CREATE TABLE `savsoft_notification` (
  `nid` int(11) NOT NULL,
  `notification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(100) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `click_action` varchar(100) DEFAULT NULL,
  `notification_to` varchar(1000) DEFAULT NULL,
  `response` text,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_options`
--

CREATE TABLE `savsoft_options` (
  `oid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `q_option` text NOT NULL,
  `q_option_match` varchar(1000) DEFAULT NULL,
  `q_option1` text NOT NULL,
  `score` float NOT NULL DEFAULT '0',
  `q_option_match1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_options`
--

INSERT INTO `savsoft_options` (`oid`, `qid`, `q_option`, `q_option_match`, `q_option1`, `score`, `q_option_match1`) VALUES
(46, 6, 'Good Morning', 'Good Night', '', 0.25, ''),
(47, 6, 'Honda', 'BMW', '', 0.25, ''),
(48, 6, 'Keyboard', 'CPU', '', 0.25, ''),
(49, 6, 'Red', 'Green', '', 0.25, ''),
(51, 7, 'Blue, Sky Blue', NULL, '', 1, ''),
(52, 3, '4', NULL, '', 0.5, ''),
(53, 3, '5', NULL, '', 0, ''),
(54, 3, 'Four', NULL, '', 0.5, ''),
(55, 3, 'Six', NULL, '', 0, ''),
(56, 1, 'Patiala', NULL, '', 0, ''),
(57, 1, 'New Delhi', NULL, '', 1, ''),
(58, 1, 'Chandigarh', NULL, '', 0, ''),
(59, 1, 'Mumbai', NULL, '', 0, ''),
(76, 14, 'A', 'B', '', 0.25, ''),
(77, 14, 'C', 'D', '', 0.25, ''),
(78, 14, 'E', 'F', '', 0.25, ''),
(79, 14, 'G', 'H', '', 0.25, ''),
(81, 15, 'Washington, Washington D.C', NULL, '', 1, ''),
(82, 13, '<p>five</p>', NULL, '', 0, ''),
(83, 13, '<p>40</p>', NULL, '', 0.5, ''),
(84, 13, '<p>fourty</p>', NULL, '', 0.5, ''),
(85, 13, '<p>six</p>', NULL, '', 0, ''),
(86, 12, '<p>five</p>', NULL, '', 0, ''),
(87, 12, '<p>14</p>', NULL, '', 1, ''),
(88, 12, '<p>three</p>', NULL, '', 0, ''),
(89, 12, '<p>six</p>', NULL, '', 0, ''),
(90, 17, '<p>5</p>', NULL, '', 1, ''),
(91, 17, '<p>6</p>', NULL, '', 0, ''),
(92, 17, '<p>7</p>', NULL, '', 0, ''),
(93, 17, '<p>9</p>', NULL, '', 0, ''),
(98, 19, '<p>sasa</p>', NULL, '', 1, ''),
(99, 19, '<p>asasas</p>', NULL, '', 0, ''),
(100, 19, '<p>sasas</p>', NULL, '', 0, ''),
(101, 19, '<p>asasas</p>', NULL, '', 0, ''),
(102, 20, '<p>dfgfgfg</p>', NULL, '', 1, ''),
(103, 20, '<p>jhjhj</p>', NULL, '', 0, ''),
(104, 20, '<p>lklklk</p>', NULL, '', 0, ''),
(105, 20, '<p>hghgh</p>', NULL, '', 0, ''),
(106, 21, '<p>fgdfgfdg</p>', NULL, '', 1, ''),
(107, 21, '<p>gfdgfdg</p>', NULL, '', 0, ''),
(108, 21, '<p>deasdsad</p>', NULL, '', 0, ''),
(109, 21, '<p>gfdgfdgfdg</p>', NULL, '', 0, ''),
(114, 34, '<p>eop1</p>', NULL, '<p>hop1</p>', 1, ''),
(115, 34, '', NULL, '', 0, ''),
(116, 34, '', NULL, '', 0, ''),
(117, 34, '', NULL, '', 0, ''),
(158, 22, '<p>Eop1</p>', NULL, '<p>Hop1</p>', 0, ''),
(159, 22, '', NULL, '', 1, ''),
(160, 22, '', NULL, '', 0, ''),
(161, 22, '', NULL, '', 0, ''),
(162, 22, '<p>Eop2</p>', NULL, '<p>Hop2</p>', 0, ''),
(163, 22, '', NULL, '', 0, ''),
(164, 22, '<p>Hop2</p>', NULL, '', 0, ''),
(165, 22, '', NULL, '', 0, ''),
(166, 22, '<p>Eop3</p>', NULL, '', 0, ''),
(167, 22, '', NULL, '', 0, ''),
(168, 22, '', NULL, '', 0, ''),
(169, 22, '', NULL, '', 0, ''),
(170, 22, '<p>Eop4</p>', NULL, '', 0, ''),
(171, 22, '', NULL, '', 0, ''),
(172, 22, '', NULL, '', 0, ''),
(173, 22, '', NULL, '', 0, ''),
(174, 35, ' 4', NULL, '', 1, ''),
(175, 35, ' 5', NULL, '', 0, ''),
(176, 35, ' 6', NULL, '', 0, ''),
(177, 35, ' 3', NULL, '', 0, ''),
(178, 36, ' 4', NULL, '', 0, ''),
(179, 36, ' 8', NULL, '', 0.5, ''),
(180, 36, ' 6', NULL, '', 0, ''),
(181, 36, ' Eight', NULL, '', 0.5, ''),
(182, 37, ' Osama', NULL, '', 0, ''),
(183, 37, ' Obama', NULL, '', 1, ''),
(184, 37, ' Arvind', NULL, '', 0, ''),
(185, 37, ' Anil', NULL, '', 0, ''),
(186, 38, ' 4', NULL, '', 1, ''),
(187, 38, ' 5', NULL, '', 0, ''),
(188, 38, ' 6', NULL, '', 0, ''),
(189, 38, ' 3', NULL, '', 0, ''),
(190, 39, ' 4', NULL, '', 0, ''),
(191, 39, ' 8', NULL, '', 0.5, ''),
(192, 39, ' 6', NULL, '', 0, ''),
(193, 39, ' Eight', NULL, '', 0.5, ''),
(194, 40, ' Osama', NULL, '', 0, ''),
(195, 40, ' Obama', NULL, '', 1, ''),
(196, 40, ' Arvind', NULL, '', 0, ''),
(197, 40, ' Anil', NULL, '', 0, ''),
(198, 41, ' 4', NULL, ' 4', 1, ''),
(199, 41, ' 5', NULL, ' 5', 0, ''),
(200, 41, ' 6', NULL, ' 6', 0, ''),
(201, 41, ' 3', NULL, ' 3', 0, ''),
(202, 42, ' 4', NULL, '', 1, ''),
(203, 42, ' 5', NULL, '', 0, ''),
(204, 42, ' 6', NULL, '', 0, ''),
(205, 42, ' 3', NULL, '', 0, ''),
(206, 43, ' 4', NULL, '', 0, ''),
(207, 43, ' 8', NULL, '', 0.5, ''),
(208, 43, ' 6', NULL, '', 0, ''),
(209, 43, ' Eight', NULL, '', 0.5, ''),
(210, 44, ' Osama', NULL, '', 0, ''),
(211, 44, ' Obama', NULL, '', 1, ''),
(212, 44, ' Arvind', NULL, '', 0, ''),
(213, 44, ' Anil', NULL, '', 0, ''),
(214, 45, 'five', NULL, '', 0, ''),
(215, 45, 'four', NULL, '', 0.5, ''),
(216, 45, 'four', NULL, '', 0.5, ''),
(217, 45, 'six', NULL, '', 0, ''),
(218, 46, 'A', 'B', '', 0.25, ''),
(219, 46, 'C', 'D', '', 0.25, ''),
(220, 46, 'E', 'F', '', 0.25, ''),
(221, 46, 'G', 'H', '', 0.25, ''),
(222, 47, 'Blue, Sky blue', NULL, '', 0.25, ''),
(223, 49, 'five', NULL, '', 0, ''),
(224, 49, 'four', NULL, '', 0.5, ''),
(225, 49, 'four', NULL, '', 0.5, ''),
(226, 49, 'six', NULL, '', 0, ''),
(227, 50, 'A', 'B', '', 0.25, ''),
(228, 50, 'C', 'D', '', 0.25, ''),
(229, 50, 'E', 'F', '', 0.25, ''),
(230, 50, 'G', 'H', '', 0.25, ''),
(231, 51, 'Blue, Sky blue', NULL, '', 0.25, ''),
(232, 53, 'five', NULL, '', 0, ''),
(233, 53, 'four', NULL, '', 0.5, ''),
(234, 53, 'four', NULL, '', 0.5, ''),
(235, 53, 'six', NULL, '', 0, ''),
(236, 54, 'A', 'B', '', 0.25, ''),
(237, 54, 'C', 'D', '', 0.25, ''),
(238, 54, 'E', 'F', '', 0.25, ''),
(239, 54, 'G', 'H', '', 0.25, ''),
(240, 55, 'Blue, Sky blue', NULL, '', 0.25, ''),
(241, 57, 'five', NULL, '', 0, ''),
(242, 57, 'four', NULL, '', 1, ''),
(243, 57, 'three', NULL, '', 0, ''),
(244, 57, 'six', NULL, '', 0, ''),
(245, 58, 'five', NULL, '', 0, ''),
(246, 58, 'four', NULL, '', 0.5, ''),
(247, 58, 'four', NULL, '', 0.5, ''),
(248, 58, 'six', NULL, '', 0, ''),
(249, 59, 'A', 'B', '', 0.25, ''),
(250, 59, 'C', 'D', '', 0.25, ''),
(251, 59, 'E', 'F', '', 0.25, ''),
(252, 59, 'G', 'H', '', 0.25, ''),
(253, 60, 'Blue, Sky blue', NULL, '', 0.25, ''),
(254, 62, 'five', NULL, '', 0, ''),
(255, 62, 'four', NULL, '', 1, ''),
(256, 62, 'three', NULL, '', 0, ''),
(257, 62, 'six', NULL, '', 0, ''),
(258, 63, 'five', NULL, '', 0, ''),
(259, 63, 'four', NULL, '', 1, ''),
(260, 63, 'three', NULL, '', 0, ''),
(261, 63, 'six', NULL, '', 0, ''),
(262, 66, 'five', NULL, '', 0, ''),
(263, 66, 'four', NULL, '', 1, ''),
(264, 66, 'three', NULL, '', 0, ''),
(265, 66, 'six', NULL, '', 0, ''),
(266, 67, 'five', NULL, '', 0, ''),
(267, 67, 'four', NULL, '', 0.5, ''),
(268, 67, 'four', NULL, '', 0.5, ''),
(269, 67, 'six', NULL, '', 0, ''),
(270, 68, 'A', 'B', '', 0.25, ''),
(271, 68, 'C', 'D', '', 0.25, ''),
(272, 68, 'E', 'F', '', 0.25, ''),
(273, 68, 'G', 'H', '', 0.25, ''),
(274, 69, 'Blue, Sky blue', NULL, '', 0.25, ''),
(275, 71, 'five', NULL, '', 0, ''),
(276, 71, 'four', NULL, '', 1, ''),
(277, 71, 'three', NULL, '', 0, ''),
(278, 71, 'six', NULL, '', 0, ''),
(279, 72, 'five', NULL, '', 0, ''),
(280, 72, 'four', NULL, '', 1, ''),
(281, 72, 'three', NULL, '', 0, ''),
(282, 72, 'six', NULL, '', 0, ''),
(283, 73, 'five', NULL, '', 0, ''),
(284, 73, 'four', NULL, '', 1, ''),
(285, 73, 'three', NULL, '', 0, ''),
(286, 73, 'six', NULL, '', 0, ''),
(287, 74, 'five', NULL, 'five', 0, ''),
(288, 74, 'four', NULL, 'four', 1, ''),
(289, 74, 'three', NULL, 'three', 0, ''),
(290, 74, 'six', NULL, 'six', 0, ''),
(291, 75, 'five', NULL, '', 0, ''),
(292, 75, 'four', NULL, '', 0.5, ''),
(293, 75, 'four', NULL, '', 0.5, ''),
(294, 75, 'six', NULL, '', 0, ''),
(295, 76, 'A', 'B', '', 0.25, ''),
(296, 76, 'C', 'D', '', 0.25, ''),
(297, 76, 'E', 'F', '', 0.25, ''),
(298, 76, 'G', 'H', '', 0.25, ''),
(299, 77, 'Blue, Sky blue', NULL, '', 0.25, ''),
(300, 79, ' 4', NULL, ' 4  second language', 1, ''),
(301, 79, ' 5', NULL, ' 5 second language', 0, ''),
(302, 79, ' 6', NULL, ' 6 second language', 0, ''),
(303, 79, ' 3', NULL, ' 3 second language', 0, ''),
(304, 80, ' 4  second language', NULL, '', 1, ''),
(305, 80, ' 5 second language', NULL, '', 0, ''),
(306, 80, ' 6 second language', NULL, '', 0, ''),
(307, 80, ' 3 second language', NULL, '', 0, ''),
(312, 82, ' Osama', NULL, '', 0, ''),
(313, 82, ' Obama', NULL, '', 1, ''),
(314, 82, ' Arvind', NULL, '', 0, ''),
(315, 82, ' Anil', NULL, '', 0, ''),
(316, 81, ' 4', NULL, '', 0, ''),
(317, 81, ' 8', NULL, '', 0.5, ''),
(318, 81, ' 6', NULL, '', 0, ''),
(319, 81, ' Eight', NULL, '', 0.5, ''),
(448, 111, ' 4', NULL, ' 4  second language', 1, ''),
(449, 111, ' 5', NULL, ' 5 second language', 0, ''),
(450, 111, ' 6', NULL, ' 6 second language', 0, ''),
(451, 111, ' 3', NULL, ' 3 second language', 0, ''),
(452, 112, ' 4  second language', NULL, '', 1, ''),
(453, 112, ' 5 second language', NULL, '', 0, ''),
(454, 112, ' 6 second language', NULL, '', 0, ''),
(455, 112, ' 3 second language', NULL, '', 0, ''),
(456, 113, ' 4', NULL, '', 0, ''),
(457, 113, ' 8', NULL, '', 0.5, ''),
(458, 113, ' 6', NULL, '', 0, ''),
(459, 113, ' Eight', NULL, '', 0.5, ''),
(460, 114, ' Osama', NULL, '', 0, ''),
(461, 114, ' Obama', NULL, '', 1, ''),
(462, 114, ' Arvind', NULL, '', 0, ''),
(463, 114, ' Anil', NULL, '', 0, ''),
(464, 115, ' 4', NULL, ' 4  second language', 1, ''),
(465, 115, ' 5', NULL, ' 5 second language', 0, ''),
(466, 115, ' 6', NULL, ' 6 second language', 0, ''),
(467, 115, ' 3', NULL, ' 3 second language', 0, ''),
(468, 116, ' 4  second language', NULL, '', 1, ''),
(469, 116, ' 5 second language', NULL, '', 0, ''),
(470, 116, ' 6 second language', NULL, '', 0, ''),
(471, 116, ' 3 second language', NULL, '', 0, ''),
(472, 117, ' 4', NULL, '', 0, ''),
(473, 117, ' 8', NULL, '', 0.5, ''),
(474, 117, ' 6', NULL, '', 0, ''),
(475, 117, ' Eight', NULL, '', 0.5, ''),
(476, 118, ' Osama', NULL, '', 0, ''),
(477, 118, ' Obama', NULL, '', 1, ''),
(478, 118, ' Arvind', NULL, '', 0, ''),
(479, 118, ' Anil', NULL, '', 0, ''),
(480, 119, ' 4', NULL, ' 4  second language', 1, ''),
(481, 119, ' 5', NULL, ' 5 second language', 0, ''),
(482, 119, ' 6', NULL, ' 6 second language', 0, ''),
(483, 119, ' 3', NULL, ' 3 second language', 0, ''),
(484, 120, ' 4  second language', NULL, '', 1, ''),
(485, 120, ' 5 second language', NULL, '', 0, ''),
(486, 120, ' 6 second language', NULL, '', 0, ''),
(487, 120, ' 3 second language', NULL, '', 0, ''),
(488, 121, ' 4', NULL, '', 0, ''),
(489, 121, ' 8', NULL, '', 0.5, ''),
(490, 121, ' 6', NULL, '', 0, ''),
(491, 121, ' Eight', NULL, '', 0.5, ''),
(492, 122, ' Osama', NULL, '', 0, ''),
(493, 122, ' Obama', NULL, '', 1, ''),
(494, 122, ' Arvind', NULL, '', 0, ''),
(495, 122, ' Anil', NULL, '', 0, ''),
(496, 123, ' 4', NULL, ' 4  second language', 1, ''),
(497, 123, ' 5', NULL, ' 5 second language', 0, ''),
(498, 123, ' 6', NULL, ' 6 second language', 0, ''),
(499, 123, ' 3', NULL, ' 3 second language', 0, ''),
(500, 124, ' 4  second language', NULL, '', 1, ''),
(501, 124, ' 5 second language', NULL, '', 0, ''),
(502, 124, ' 6 second language', NULL, '', 0, ''),
(503, 124, ' 3 second language', NULL, '', 0, ''),
(504, 125, ' 4', NULL, '', 0, ''),
(505, 125, ' 8', NULL, '', 0.5, ''),
(506, 125, ' 6', NULL, '', 0, ''),
(507, 125, ' Eight', NULL, '', 0.5, ''),
(508, 126, ' Osama', NULL, '', 0, ''),
(509, 126, ' Obama', NULL, '', 1, ''),
(510, 126, ' Arvind', NULL, '', 0, ''),
(511, 126, ' Anil', NULL, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_payment`
--

CREATE TABLE `savsoft_payment` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `amount` float NOT NULL,
  `paid_date` int(11) NOT NULL,
  `payment_gateway` varchar(100) NOT NULL DEFAULT 'Paypal',
  `payment_status` varchar(100) NOT NULL DEFAULT 'Pending',
  `transaction_id` varchar(1000) NOT NULL,
  `other_data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_qbank`
--

CREATE TABLE `savsoft_qbank` (
  `qid` int(11) NOT NULL,
  `question_type` varchar(100) NOT NULL DEFAULT 'Multiple Choice Single Answer',
  `question` text NOT NULL,
  `description` text NOT NULL,
  `question1` text,
  `description1` text,
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `no_time_served` int(11) NOT NULL DEFAULT '0',
  `no_time_corrected` int(11) NOT NULL DEFAULT '0',
  `no_time_incorrected` int(11) NOT NULL DEFAULT '0',
  `no_time_unattempted` int(11) NOT NULL DEFAULT '0',
  `inserted_by` int(11) NOT NULL,
  `inserted_by_name` varchar(100) DEFAULT NULL,
  `paragraph` text,
  `paragraph1` text,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_qbank`
--

INSERT INTO `savsoft_qbank` (`qid`, `question_type`, `question`, `description`, `question1`, `description1`, `cid`, `lid`, `no_time_served`, `no_time_corrected`, `no_time_incorrected`, `no_time_unattempted`, `inserted_by`, `inserted_by_name`, `paragraph`, `paragraph1`, `parent_id`) VALUES
(79, 'Multiple Choice Single Answer', ' what is 2+2 =?', '  description here', ' what is 2+2 =? &ndash; This is second language question Note &ndash; keep question number same as its primary language question', '  description here', 1, 1, 43, 13, 7, 23, 0, NULL, NULL, NULL, 0),
(80, 'Multiple Choice Single Answer', ' what is 2+2 =? &ndash; This is second language question Note &ndash; keep question number same as its primary language question', '  description here', NULL, NULL, 1, 1, 12, 2, 4, 6, 0, NULL, NULL, NULL, 0),
(81, 'Multiple Choice Multiple Answer', ' what is 2+6 =?', '  ', NULL, NULL, 2, 1, 36, 12, 13, 11, 0, NULL, NULL, NULL, 0),
(82, 'Multiple Choice Single Answer', ' Who is in the picture?<img src=&#34;http://localhost/savsoftquiz_v4.0_enterprise/upload/word_images/15090303561.jpeg&#34;>', '  ', NULL, NULL, 1, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0),
(111, 'Multiple Choice Single Answer', ' what is 2+2 =?', '  description here', ' what is 2+2 =? &ndash; This is second language question Note &ndash; keep question number same as its primary language question', '  description here', 2, 1, 0, 0, 0, 0, 0, NULL, '', NULL, 0),
(112, 'Multiple Choice Single Answer', ' what is 2+2 =? &ndash; This is second language question Note &ndash; keep question number same as its primary language question', '  description here', NULL, NULL, 2, 1, 0, 0, 0, 0, 0, NULL, '', NULL, 0),
(113, 'Multiple Choice Multiple Answer', ' what is 2+6 =?', '  ', NULL, NULL, 2, 1, 0, 0, 0, 0, 0, NULL, '', NULL, 0),
(114, 'Multiple Choice Single Answer', ' Who is in the picture?<img src=&#34;http://localhost/savsoftquiz_v4.0_enterprise/upload/word_images/15091000591.jpeg&#34;>', '  ', NULL, NULL, 2, 1, 0, 0, 0, 0, 0, NULL, '', NULL, 0),
(115, 'Multiple Choice Single Answer', ' what is 2+2 =?', '  description here', ' what is 2+2 =? &ndash; This is second language question Note &ndash; keep question number same as its primary language question', '  description here', 2, 1, 1, 0, 0, 1, 0, NULL, ' Paragraph here', ' Paragraph here', 0),
(116, 'Multiple Choice Single Answer', ' what is 2+2 =? &ndash; This is second language question Note &ndash; keep question number same as its primary language question', '  description here', NULL, NULL, 2, 1, 0, 0, 0, 0, 0, NULL, ' Paragraph here', NULL, 0),
(117, 'Multiple Choice Multiple Answer', ' what is 2+6 =?', '  ', NULL, NULL, 2, 1, 1, 0, 0, 1, 0, NULL, '', NULL, 0),
(118, 'Multiple Choice Single Answer', ' Who is in the picture?<img src=&#34;http://localhost/savsoftquiz_v4.0_enterprise/upload/word_images/15091002001.jpeg&#34;>', '  ', NULL, NULL, 2, 1, 1, 0, 0, 1, 0, NULL, '', NULL, 0),
(119, 'Multiple Choice Single Answer', ' what is 2+2 =?', '  description here', ' what is 2+2 =? &ndash; This is second language question Note &ndash; keep question number same as its primary language question', '  description here', 2, 1, 0, 0, 0, 0, 0, NULL, ' Paragraph here', ' Paragraph here', 0),
(120, 'Multiple Choice Single Answer', ' what is 2+2 =? &ndash; This is second language question Note &ndash; keep question number same as its primary language question', '  description here', NULL, NULL, 2, 1, 0, 0, 0, 0, 0, NULL, ' Paragraph here', NULL, 0),
(121, 'Multiple Choice Multiple Answer', ' what is 2+6 =?', '  ', NULL, NULL, 2, 1, 0, 0, 0, 0, 0, NULL, '', NULL, 0),
(122, 'Multiple Choice Single Answer', ' Who is in the picture?<img src=&#34;http://localhost/savsoftquiz_v4.2_enterprise/upload/word_images/15146297791.jpeg&#34;>', '  ', NULL, NULL, 2, 1, 0, 0, 0, 0, 0, NULL, '', NULL, 0),
(123, 'Multiple Choice Single Answer', ' what is 2+2 =?', '  description here', ' what is 2+2 =? &ndash; This is second language question Note &ndash; keep question number same as its primary language question', '  description here', 2, 1, 0, 0, 0, 0, 0, NULL, ' Paragraph here', ' Paragraph here', 0),
(124, 'Multiple Choice Single Answer', ' what is 2+2 =? &ndash; This is second language question Note &ndash; keep question number same as its primary language question', '  description here', NULL, NULL, 2, 1, 0, 0, 0, 0, 0, NULL, ' Paragraph here', NULL, 0),
(125, 'Multiple Choice Multiple Answer', ' what is 2+6 =?', '  ', NULL, NULL, 2, 1, 0, 0, 0, 0, 0, NULL, '', NULL, 0),
(126, 'Multiple Choice Single Answer', ' Who is in the picture?<img src=&#34;http://localhost/savsoftquiz_v4.2_enterprise/upload/word_images/15146297931.jpeg&#34;>', '  ', NULL, NULL, 2, 1, 0, 0, 0, 0, 0, NULL, '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_qcl`
--

CREATE TABLE `savsoft_qcl` (
  `qcl_id` int(11) NOT NULL,
  `quid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `noq` int(11) NOT NULL,
  `i_correct` text NOT NULL,
  `i_incorrect` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_qcl`
--

INSERT INTO `savsoft_qcl` (`qcl_id`, `quid`, `cid`, `lid`, `noq`, `i_correct`, `i_incorrect`) VALUES
(80, 2, 1, 1, 3, '1', '0'),
(81, 2, 0, 1, 1, '1', '0'),
(82, 2, 2, 1, 1, '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_quiz`
--

CREATE TABLE `savsoft_quiz` (
  `quid` int(11) NOT NULL,
  `quiz_name` varchar(1000) NOT NULL,
  `description` text NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `gids` text NOT NULL,
  `qids` text NOT NULL,
  `noq` int(11) NOT NULL,
  `correct_score` text NOT NULL,
  `incorrect_score` text NOT NULL,
  `ip_address` text NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '10',
  `maximum_attempts` int(11) NOT NULL DEFAULT '1',
  `pass_percentage` float NOT NULL DEFAULT '50',
  `view_answer` int(11) NOT NULL DEFAULT '1',
  `camera_req` int(11) NOT NULL DEFAULT '1',
  `question_selection` int(11) NOT NULL DEFAULT '1',
  `gen_certificate` int(11) NOT NULL DEFAULT '0',
  `certificate_text` text,
  `with_login` int(11) NOT NULL DEFAULT '1',
  `quiz_template` varchar(100) NOT NULL DEFAULT 'Default',
  `uids` varchar(1000) DEFAULT NULL,
  `inserted_by` int(11) NOT NULL DEFAULT '1',
  `inserted_by_name` varchar(100) DEFAULT 'Admin',
  `show_chart_rank` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_quiz`
--

INSERT INTO `savsoft_quiz` (`quid`, `quiz_name`, `description`, `start_date`, `end_date`, `gids`, `qids`, `noq`, `correct_score`, `incorrect_score`, `ip_address`, `duration`, `maximum_attempts`, `pass_percentage`, `view_answer`, `camera_req`, `question_selection`, `gen_certificate`, `certificate_text`, `with_login`, `quiz_template`, `uids`, `inserted_by`, `inserted_by_name`, `show_chart_rank`) VALUES
(6, '1BPS', '<p>Description here</p>', 1509030367, 1540566367, '1', '81,79', 2, '1,1', '0,0', '', 100, 100, 50, 1, 0, 0, 0, NULL, 1, 'IN', NULL, 1, 'Admin Admin', 1),
(7, 'Quiz - Proctor Plugin', '', 1511412289, 1542948289, '1', '115,117,118', 3, '1,1,1', '0,0,0', '', 10, 10, 50, 1, 0, 0, 0, NULL, 1, 'Default_PROCTOR', NULL, 1, 'Admin Admin', 1),
(8, 'Default Quiz', '', 1511412326, 1542948326, '1', '79,80,81', 3, '1,1,1', '-1,-1,-0.5', '', 10, 10, 50, 1, 0, 0, 0, NULL, 1, 'Default', NULL, 1, 'Admin Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_result`
--

CREATE TABLE `savsoft_result` (
  `rid` int(11) NOT NULL,
  `quid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `result_status` varchar(100) NOT NULL DEFAULT 'Open',
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `categories` text NOT NULL,
  `category_range` text NOT NULL,
  `r_qids` text NOT NULL,
  `individual_time` text NOT NULL,
  `total_time` int(11) NOT NULL DEFAULT '0',
  `score_obtained` float NOT NULL DEFAULT '0',
  `percentage_obtained` float NOT NULL DEFAULT '0',
  `attempted_ip` varchar(100) NOT NULL,
  `score_individual` text NOT NULL,
  `photo` varchar(100) NOT NULL,
  `manual_valuation` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_result`
--

INSERT INTO `savsoft_result` (`rid`, `quid`, `uid`, `result_status`, `start_time`, `end_time`, `categories`, `category_range`, `r_qids`, `individual_time`, `total_time`, `score_obtained`, `percentage_obtained`, `attempted_ip`, `score_individual`, `photo`, `manual_valuation`) VALUES
(1, 8, 1, 'Pass', 1511412687, 1511412701, 'General knowledge,Math', '2,1', '79,80,81', '0,6,0', 6, 3, 100, '::1', '1,1,1', '', 0),
(2, 6, 1, 'Fail', 1511413331, 1511413340, 'Math,General knowledge', '1,1', '81,79', '5,0', 5, 0, 0, '::1', '0,0', '', 0),
(3, 6, 1, 'Fail', 1511413356, 1511413383, 'Math,General knowledge', '1,1', '81,79', '0,5', 5, 0, 0, '::1', '2,2', '', 0),
(4, 8, 1, 'Pass', 1513919539, 1513919552, 'General knowledge,Math', '2,1', '79,80,81', '0,4,0', 4, 3, 100, '::1', '1,1,1', '', 0),
(5, 8, 1, 'Fail', 1514276635, 1514276648, 'General knowledge,Math', '2,1', '79,80,81', '0,5,4', 9, 0.5, 5.55556, '::1', '1,2,2', '', 0),
(6, 8, 1, 'Fail', 1514276724, 1514276735, 'General knowledge,Math', '2,1', '79,80,81', '0,5,3', 8, -0.5, -5.55556, '::1', '1,2,2', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_users`
--

CREATE TABLE `savsoft_users` (
  `uid` int(11) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `contact_no` varchar(1000) DEFAULT NULL,
  `connection_key` varchar(1000) DEFAULT NULL,
  `gid` int(11) NOT NULL DEFAULT '1',
  `su` int(11) NOT NULL DEFAULT '0',
   `inserted_by` int(11) NOT NULL DEFAULT '0',
  `subscription_expired` int(11) NOT NULL DEFAULT '0',
  `verify_code` int(11) NOT NULL DEFAULT '0',
  `wp_user` varchar(100) DEFAULT NULL,
  `registered_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(1000) DEFAULT NULL,
  `user_status` varchar(100) NOT NULL DEFAULT 'Active',
  `web_token` varchar(1000) DEFAULT NULL,
  `android_token` varchar(1000) DEFAULT NULL,
  `skype_id` varchar(100) DEFAULT NULL,
  `time_zone` varchar(100) DEFAULT 'Asia/Kolkata'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_users`
--

INSERT INTO `savsoft_users` (`uid`, `password`, `email`, `first_name`, `last_name`, `contact_no`, `connection_key`, `gid`, `su`, `subscription_expired`, `verify_code`, `wp_user`, `registered_date`, `photo`, `user_status`, `web_token`, `android_token`, `skype_id`, `time_zone`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'admin@example.com', 'Admin', 'Admin', '1234567890', NULL, 1, 1, 1776277800, 0, '', '2017-04-20 11:22:38', NULL, 'Active', 'dnwIpQWkxyA:APA91bFZLhdxZnPcNareTyHnJRikJGqaT7qh9DF4jSmyKSOq1rv6k7uwgmaQ4_K7jT3WNNUeKRdRQYsNf_OZaQZ7i5nKI_CjA6QGPwPsL5_D7ShPTtsuIwTkr0CuGx0RS7oAVNg_bImc', NULL, 'sandhu4222', 'Asia/Kolkata'),
(5, 'e10adc3949ba59abbe56e057f20f883e', 'user@example.com', 'Userss', 'User', '1234567890', '123', 1, 2, 2122569000, 0, '', '2017-04-20 11:22:38', NULL, 'Active', NULL, NULL, NULL, 'Asia/Kolkata'),
(6, '21232f297a57a5a743894a0e4a801fc3', 'subadmin@example.com', 'Subadmin', 'Admin', '1234567890', NULL, 1, 1, 1818873000, 0, NULL, '2017-08-24 05:50:57', NULL, 'Active', NULL, NULL, NULL, 'Asia/Kolkata'),
(9, 'e10adc3949ba59abbe56e057f20f883e', 'user2@example.com', 'user2', 'user2', '1234567890', NULL, 1, 2, 0, 0, NULL, '2017-08-25 10:20:10', NULL, 'Active', NULL, NULL, 'sandhu4222', 'Asia/Kolkata');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_users_custom`
--

CREATE TABLE `savsoft_users_custom` (
  `c_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `field_values` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savsoft_users_custom`
--

INSERT INTO `savsoft_users_custom` (`c_id`, `field_id`, `uid`, `field_values`) VALUES
(10, 3, 5, '1234567890'),
(17, 1, 9, 'DAV'),
(18, 2, 9, '8529637410'),
(19, 3, 9, '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `social_group`
--

CREATE TABLE `social_group` (
  `sg_id` int(11) NOT NULL,
  `sg_name` varchar(30) NOT NULL,
  `about` varchar(1000) NOT NULL,
  `sg_status` varchar(100) NOT NULL DEFAULT 'Public',
  `no_member` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_group`
--

INSERT INTO `social_group` (`sg_id`, `sg_name`, `about`, `sg_status`, `no_member`, `created_date`, `created_by`) VALUES
(1, 'Quiz Star', 'Join masters and compare your ranking', 'Public', 3, '2017-08-27 06:45:45', 1),
(3, 'Genius Group', 'Group of genius.. JOIN NOW', 'Public', 3, '2017-08-27 08:11:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `social_group_joined`
--

CREATE TABLE `social_group_joined` (
  `join_id` int(11) NOT NULL,
  `sg_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `joined_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_group_joined`
--

INSERT INTO `social_group_joined` (`join_id`, `sg_id`, `uid`, `joined_date`) VALUES
(3, 1, 1, '2017-08-27 08:06:39'),
(4, 2, 1, '2017-08-27 08:10:20'),
(5, 3, 1, '2017-08-27 08:11:45'),
(9, 3, 9, '2017-08-27 18:29:19'),
(11, 1, 9, '2017-08-27 18:57:03'),
(12, 3, 5, '2017-08-27 19:39:54'),
(14, 1, 5, '2017-08-27 20:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `study_material`
--

CREATE TABLE `study_material` (
  `stid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `study_description` text NOT NULL,
  `gids` varchar(100) NOT NULL,
  `cid` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `attachment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_material`
--

INSERT INTO `study_material` (`stid`, `title`, `study_description`, `gids`, `cid`, `created_date`, `created_by`, `attachment`) VALUES
(8, 'GitHub', '<p><strong>GitHub</strong> is a web-based <a title="Git" href="https://en.wikipedia.org/wiki/Git">Git</a> or <a title="Repository (version control)" href="https://en.wikipedia.org/wiki/Repository_(version_control)">version control repository</a> and <a title="Internet hosting service" href="https://en.wikipedia.org/wiki/Internet_hosting_service">Internet hosting service</a>. It is mostly used for code. It offers all of the <a title="Distributed version control" href="https://en.wikipedia.org/wiki/Distributed_version_control">distributed version control</a> and <a class="mw-redirect" title="Source code management" href="https://en.wikipedia.org/wiki/Source_code_management">source code management</a> (SCM) functionality of Git as well as adding its own features. It provides <a title="Access control" href="https://en.wikipedia.org/wiki/Access_control">access control</a> and several collaboration features such as <a title="Bug tracking system" href="https://en.wikipedia.org/wiki/Bug_tracking_system">bug tracking</a>, <a title="Software feature" href="https://en.wikipedia.org/wiki/Software_feature">feature requests</a>, <a title="Task management" href="https://en.wikipedia.org/wiki/Task_management">task management</a>, and<a title="Wiki" href="https://en.wikipedia.org/wiki/Wiki">wikis</a> for every project.<sup id="cite_ref-hugeinvestment_3-0" class="reference"><a href="https://en.wikipedia.org/wiki/GitHub#cite_note-hugeinvestment-3">[3]</a></sup></p>\r\n<p>GitHub offers both plans for private and free <a title="Repository (version control)" href="https://en.wikipedia.org/wiki/Repository_(version_control)">repositories</a> on the same account<sup id="cite_ref-4" class="reference"><a href="https://en.wikipedia.org/wiki/GitHub#cite_note-4">[4]</a></sup> which are commonly used to host <a class="mw-redirect" title="Open-source" href="https://en.wikipedia.org/wiki/Open-source">open-source</a> software projects.<sup id="cite_ref-5" class="reference"><a href="https://en.wikipedia.org/wiki/GitHub#cite_note-5">[5]</a></sup> As of April 2017, GitHub reports having almost 20 million users and 57 million repositories,<sup id="cite_ref-6" class="reference"><a href="https://en.wikipedia.org/wiki/GitHub#cite_note-6">[6]</a></sup>making it the largest host of <a title="Source code" href="https://en.wikipedia.org/wiki/Source_code">source code</a> in the world.<sup id="cite_ref-7" class="reference"><a href="https://en.wikipedia.org/wiki/GitHub#cite_note-7">[7]</a></sup></p>\r\n<p>GitHub has a <a title="Mascot" href="https://en.wikipedia.org/wiki/Mascot">mascot</a> called Octocat, a cat with five tentacles and a human-like face.<sup id="cite_ref-Octodex_FAQ_8-0" class="reference"><a href="https://en.wikipedia.org/wiki/GitHub#cite_note-Octodex_FAQ-8">[8]</a></sup><sup id="cite_ref-Jaramillo_9-0" class="reference"><a href="https://en.wikipedia.org/wiki/GitHub#cite_note-Jaramillo-9">[9]</a></sup></p>', '1,3,4', 1, '2017-08-28 19:49:57', 1, '1503949797.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_assignment_reports`
--

CREATE TABLE `user_assignment_reports` (
  `report_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `user_attachment` varchar(1000) NOT NULL,
  `score` float NOT NULL,
  `reported_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `evaluated` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_assignment_reports`
--

INSERT INTO `user_assignment_reports` (`report_id`, `assignment_id`, `uid`, `user_attachment`, `score`, `reported_date`, `evaluated`) VALUES
(1, 4, 9, '1503953035.pdf', 100, '2017-08-28 20:43:55', 'Evaluated');

-- --------------------------------------------------------

--
-- Table structure for table `warning_message`
--

CREATE TABLE `warning_message` (
  `wid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `warning_time` int(11) NOT NULL,
  `warning_message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `appointment_request`
--
ALTER TABLE `appointment_request`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_coment`
--
ALTER TABLE `class_coment`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `class_gid`
--
ALTER TABLE `class_gid`
  ADD PRIMARY KEY (`clgid`);

--
-- Indexes for table `group_invitation`
--
ALTER TABLE `group_invitation`
  ADD PRIMARY KEY (`invitation_id`);

--
-- Indexes for table `live_class`
--
ALTER TABLE `live_class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `news_feed`
--
ALTER TABLE `news_feed`
  ADD PRIMARY KEY (`feed_id`);

--
-- Indexes for table `savsoftquiz_custom_form`
--
ALTER TABLE `savsoftquiz_custom_form`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `savsoft_add`
--
ALTER TABLE `savsoft_add`
  ADD PRIMARY KEY (`add_id`);

--
-- Indexes for table `savsoft_answers`
--
ALTER TABLE `savsoft_answers`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `savsoft_assignment`
--
ALTER TABLE `savsoft_assignment`
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `savsoft_category`
--
ALTER TABLE `savsoft_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `savsoft_group`
--
ALTER TABLE `savsoft_group`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `savsoft_level`
--
ALTER TABLE `savsoft_level`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `savsoft_notification`
--
ALTER TABLE `savsoft_notification`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `savsoft_options`
--
ALTER TABLE `savsoft_options`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `savsoft_payment`
--
ALTER TABLE `savsoft_payment`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `savsoft_qbank`
--
ALTER TABLE `savsoft_qbank`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `savsoft_qcl`
--
ALTER TABLE `savsoft_qcl`
  ADD PRIMARY KEY (`qcl_id`);

--
-- Indexes for table `savsoft_quiz`
--
ALTER TABLE `savsoft_quiz`
  ADD PRIMARY KEY (`quid`);

--
-- Indexes for table `savsoft_result`
--
ALTER TABLE `savsoft_result`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `savsoft_users`
--
ALTER TABLE `savsoft_users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `savsoft_users_custom`
--
ALTER TABLE `savsoft_users_custom`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `social_group`
--
ALTER TABLE `social_group`
  ADD PRIMARY KEY (`sg_id`);

--
-- Indexes for table `social_group_joined`
--
ALTER TABLE `social_group_joined`
  ADD PRIMARY KEY (`join_id`);

--
-- Indexes for table `study_material`
--
ALTER TABLE `study_material`
  ADD PRIMARY KEY (`stid`);

--
-- Indexes for table `user_assignment_reports`
--
ALTER TABLE `user_assignment_reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `warning_message`
--
ALTER TABLE `warning_message`
  ADD PRIMARY KEY (`wid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `appointment_request`
--
ALTER TABLE `appointment_request`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `class_coment`
--
ALTER TABLE `class_coment`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class_gid`
--
ALTER TABLE `class_gid`
  MODIFY `clgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `group_invitation`
--
ALTER TABLE `group_invitation`
  MODIFY `invitation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `live_class`
--
ALTER TABLE `live_class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `feed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `savsoftquiz_custom_form`
--
ALTER TABLE `savsoftquiz_custom_form`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `savsoft_add`
--
ALTER TABLE `savsoft_add`
  MODIFY `add_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `savsoft_answers`
--
ALTER TABLE `savsoft_answers`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `savsoft_assignment`
--
ALTER TABLE `savsoft_assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `savsoft_category`
--
ALTER TABLE `savsoft_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `savsoft_group`
--
ALTER TABLE `savsoft_group`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `savsoft_level`
--
ALTER TABLE `savsoft_level`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `savsoft_notification`
--
ALTER TABLE `savsoft_notification`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `savsoft_options`
--
ALTER TABLE `savsoft_options`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=512;
--
-- AUTO_INCREMENT for table `savsoft_payment`
--
ALTER TABLE `savsoft_payment`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `savsoft_qbank`
--
ALTER TABLE `savsoft_qbank`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `savsoft_qcl`
--
ALTER TABLE `savsoft_qcl`
  MODIFY `qcl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `savsoft_quiz`
--
ALTER TABLE `savsoft_quiz`
  MODIFY `quid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `savsoft_result`
--
ALTER TABLE `savsoft_result`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `savsoft_users`
--
ALTER TABLE `savsoft_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `savsoft_users_custom`
--
ALTER TABLE `savsoft_users_custom`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `social_group`
--
ALTER TABLE `social_group`
  MODIFY `sg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `social_group_joined`
--
ALTER TABLE `social_group_joined`
  MODIFY `join_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `study_material`
--
ALTER TABLE `study_material`
  MODIFY `stid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_assignment_reports`
--
ALTER TABLE `user_assignment_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `warning_message`
--
ALTER TABLE `warning_message`
  MODIFY `wid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
