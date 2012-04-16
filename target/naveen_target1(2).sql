-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2011 at 07:45 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kindlebit_target1`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `arrival_status` enum('present','absent','late_coming','leave') NOT NULL,
  `late_arrived_time` varchar(255) NOT NULL,
  `leave_status` enum('approved','not_approved') NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `leave_type` set('shortleave','halfday','fullday') NOT NULL DEFAULT 'fullday',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_id_created_at` (`user_id`,`created_at`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `arrival_status`, `late_arrived_time`, `leave_status`, `created_at`, `updated_at`, `leave_type`) VALUES
(1, 18, 'absent', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(2, 20, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(3, 26, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(4, 34, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(5, 37, 'leave', '', 'approved', '2011-12-06', '2011-12-07 00:25:01', 'fullday'),
(6, 40, 'absent', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(7, 41, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(8, 42, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(9, 43, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(10, 44, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(11, 46, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(12, 48, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(13, 51, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(14, 52, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(15, 54, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(16, 56, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(17, 63, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(18, 76, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(19, 77, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(20, 7, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(21, 8, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(22, 10, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(23, 12, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(24, 13, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(25, 14, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(26, 22, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(27, 32, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(28, 45, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(29, 47, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(30, 57, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(31, 61, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(32, 24, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(33, 33, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(34, 50, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(35, 62, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(36, 39, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(37, 60, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(38, 64, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(39, 59, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(40, 78, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(41, 11, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(42, 15, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(43, 16, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(44, 19, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(45, 21, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(46, 27, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(47, 28, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(48, 29, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(49, 30, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(50, 31, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(51, 35, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(52, 38, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(53, 49, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(54, 55, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(55, 58, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(56, 65, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(57, 66, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(58, 9, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(59, 17, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(60, 23, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(61, 25, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(62, 36, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(63, 53, 'present', '', '', '2011-12-06', '2011-12-07 00:25:01', ''),
(64, 18, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(65, 26, 'leave', '10:25', 'approved', '2011-12-12', '2011-12-12 22:54:39', 'shortleave'),
(66, 34, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(67, 37, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(68, 40, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(69, 41, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(70, 42, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(71, 44, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(72, 46, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(73, 51, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(74, 52, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(75, 54, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(76, 56, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(77, 63, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(78, 76, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(79, 77, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(80, 7, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(81, 10, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(82, 12, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(83, 13, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(84, 14, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(85, 22, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(86, 32, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(87, 45, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(88, 47, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(89, 57, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(90, 61, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(91, 24, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(92, 33, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(93, 50, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(94, 62, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(95, 39, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(96, 60, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(97, 64, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(98, 59, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(99, 78, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(100, 11, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(101, 15, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(102, 16, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(103, 19, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(104, 21, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(105, 27, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(106, 28, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(107, 29, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(108, 31, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(109, 35, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(110, 38, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(111, 49, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(112, 55, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(113, 58, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(114, 65, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(115, 66, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(116, 9, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(117, 17, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(118, 23, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(119, 25, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(120, 30, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(121, 36, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', ''),
(122, 53, 'present', '', '', '2011-12-12', '2011-12-12 22:54:39', '');

-- --------------------------------------------------------

--
-- Table structure for table `daily_status`
--

CREATE TABLE IF NOT EXISTS `daily_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_type` enum('odesk','fixed','other') DEFAULT NULL,
  `project_description` text,
  `odesk_id` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `free_hour` float(11,2) NOT NULL,
  `hour_billed` float(11,2) NOT NULL,
  `estimated_hour` float(11,2) NOT NULL,
  `working_hour` float(11,2) NOT NULL,
  `created_at` date NOT NULL,
  `time_at` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `daily_status`
--

INSERT INTO `daily_status` (`id`, `user_id`, `project_name`, `project_type`, `project_description`, `odesk_id`, `client_name`, `company_name`, `free_hour`, `hour_billed`, `estimated_hour`, `working_hour`, `created_at`, `time_at`) VALUES
(124, 1, 'fdfd', 'other', 'dfdfdf<br>', '', '', '', 8.00, 0.00, 0.00, 0.00, '2011-12-03', '03:22:22'),
(125, 42, 'gjg', 'fixed', 'ffghf', '', '', '', 0.00, 0.00, 0.00, 8.00, '2011-12-04', '03:22:22'),
(126, 42, 'gg', 'other', 'sdsd', '', '', '', 7.00, 0.00, 0.00, 0.00, '2011-12-05', '10:58:58'),
(127, 1, 'ggfg', 'fixed', 'gffg<br>', '', '', '', 0.00, 0.00, 0.00, 7.00, '2011-12-06', '03:22:22'),
(128, 1, 'dasda', 'other', 'gdfgdfggdfg<br>', '', '', '', 6.00, 0.00, 0.00, 0.00, '2011-12-06', '03:22:22'),
(129, 42, 'zadasd', 'other', 'dfsfsdfdsf<br>', '', '', '', 8.00, 0.00, 0.00, 0.00, '2011-12-08', '03:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dept_name`, `created_at`, `updated_at`) VALUES
(1, 'php', '2011-12-03', '2011-12-03 13:56:33'),
(2, '.net', '2011-12-03', '2011-12-03 13:56:33'),
(3, 'iphone', '2011-12-03', '2011-12-03 13:56:33'),
(4, 'BD', '2011-12-03', '2011-12-03 13:56:33'),
(5, 'HR', '2011-12-03', '2011-12-03 13:56:33'),
(6, 'seo', '2011-12-03', '2011-12-03 13:56:33'),
(7, 'design', '2011-12-03', '2011-12-03 13:56:33'),
(8, 'testing', '2011-12-03', '2011-12-03 13:56:33'),
(9, 'networking', '2011-12-03', '2011-12-03 13:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `leave_app`
--

CREATE TABLE IF NOT EXISTS `leave_app` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name_employe` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `curent_project` varchar(255) NOT NULL,
  `leave_type` enum('halfday','fullday','other') NOT NULL,
  `leave_session` varchar(255) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `total_days` float(11,2) NOT NULL,
  `reason_for_leave` text NOT NULL,
  `approve_status` enum('1','0','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `mailsend_to` varchar(255) NOT NULL,
  `cc_to` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_fk` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `leave_app`
--

INSERT INTO `leave_app` (`id`, `user_id`, `name_employe`, `designation`, `curent_project`, `leave_type`, `leave_session`, `leave_from`, `leave_to`, `total_days`, `reason_for_leave`, `approve_status`, `created_at`, `mailsend_to`, `cc_to`, `comment`) VALUES
(1, 1, 'admin', 'dasd', 'dasd', 'fullday', '', '2011-12-06', '0000-00-00', 1.00, 'dasdd<br>', '2', '2011-12-07 04:17:58', 'charanjit.singh@kindlebit.com', '', ''),
(2, 37, 'Anil Kumar', 'pm', 'target', 'fullday', '', '2011-12-06', '0000-00-00', 1.00, 'fdsfsdfds<br>', '2', '2011-12-07 04:25:35', 'biri.singh@kindlebit.com', 'chander.paul@kindlebit.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_type` enum('odesk','fixed') DEFAULT NULL,
  `site_url` varchar(255) NOT NULL,
  `odesk_id` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `project_detail` text NOT NULL,
  `project_description` text NOT NULL,
  `total_hours` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('open','closed','onhold') DEFAULT NULL,
  `modified_user_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dept_id` (`dept_id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `dept_id`, `client_name`, `project_name`, `project_type`, `site_url`, `odesk_id`, `company_name`, `project_detail`, `project_description`, `total_hours`, `start_date`, `end_date`, `status`, `modified_user_id`, `created_at`, `updated_at`) VALUES
(1, 37, 1, '', 'saddsads', 'odesk', 'dasdasdasd', 'dasddasd', 'dasdsd', 'dasdsd<br>', '', '3444', '2011-12-01', '2011-12-01', 'open', 0, '2011-12-13', '0000-00-00 00:00:00'),
(2, 11, 1, 'sa', 'sa', 'odesk', '', '', '', '', '', '', NULL, NULL, 'open', 0, '0000-00-00', '0000-00-00 00:00:00'),
(3, 11, 1, 'sa', 'sa', 'odesk', '', '', '', '', '', '', NULL, NULL, 'open', 0, '0000-00-00', '0000-00-00 00:00:00'),
(4, 11, 1, 'sa', 'sa', 'odesk', '', '', '', '', '', '', NULL, NULL, 'open', 0, '0000-00-00', '0000-00-00 00:00:00'),
(5, 11, 1, 'sa', 'sa', 'odesk', '', '', '', '', '', '', NULL, NULL, 'open', 0, '0000-00-00', '0000-00-00 00:00:00'),
(6, 11, 1, 'sa', 'sa', 'odesk', '', '', '', '', '', '', NULL, NULL, 'open', 0, '0000-00-00', '0000-00-00 00:00:00'),
(7, 11, 1, 'sa', 'sa', 'odesk', '', '', '', '', '', '', NULL, NULL, 'open', 0, '0000-00-00', '0000-00-00 00:00:00'),
(8, 11, 1, 'sa', 'sa', 'odesk', '', '', '', '', '', '', NULL, NULL, 'open', 0, '0000-00-00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `department` int(11) NOT NULL,
  `dept_head` tinyint(1) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` enum('admin') NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `time_at` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `department`, `dept_head`, `email`, `password`, `type`, `status`, `created_at`, `time_at`) VALUES
(1, 'admin', 0, 0, 'admin@kindlebit.com', 'b62a0dc0a988ac6748c1e182c0b12f7b', 'admin', 1, '0000-00-00 00:00:00', '05:23:38'),
(7, 'Komal Kumar', 2, 0, 'Komal.kumar@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '05:38:49'),
(8, 'Dipak kumar', 2, 1, 'dipak.kumar@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', 1, '0000-00-00 00:00:00', '06:17:22'),
(9, 'Parvesh Kumar', 7, 0, 'parvesh.kumar@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '05:45:46'),
(10, 'Sunny', 2, 0, 'sunny.kumar@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(11, 'Satbir Kaur', 6, 0, 'satbir.kaur@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(12, 'Ramesh Chader Bhatt', 2, 0, 'ramesh.bhatt@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '05:45:10'),
(13, '', 2, 0, 'virender.dhanda@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '05:45:10'),
(14, 'Dhiraj Dev', 2, 0, 'dhiraj.dev@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(15, 'Surinder Kumar', 6, 0, 'surinder.kumar@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '05:47:08'),
(16, 'Gurwinder Singh', 6, 0, 'gurwinder.singh@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:47:03'),
(17, 'Lakshmi Rana', 7, 0, 'lakshmi.rana@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '05:48:20'),
(18, 'Lucky Sharma', 0, 0, 'lucky.sharma@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '05:48:20'),
(19, 'Damanpreet Singh', 6, 0, 'damanpreet.singh@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '05:49:32'),
(20, 'Chander Paul', 1, 0, 'chander.paul@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 0, '0000-00-00 00:00:00', '06:17:22'),
(21, 'Yograj Sharma', 6, 0, 'yograj.sharma@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(22, 'Satbir Singh', 2, 0, 'satbir.singh@kindlebit.com', '514c783a3961805b6880b379af75d60e', '', 1, '0000-00-00 00:00:00', '06:46:12'),
(23, 'Rajvir Singh', 7, 0, 'rajvir.singh@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(24, 'Wasif Saood', 3, 0, 'wasif.saood@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(25, 'Sushil pal', 7, 0, 'sushil.pal@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(26, 'Charanjit Singh Saggu', 1, 0, 'charanjit.singh@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:25:16'),
(27, 'Manish Sharma', 6, 0, 'manish.sharma@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(28, 'GianDeep Singh', 6, 0, 'giandeep.singh@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(29, 'Vishal Kumar Yadav', 6, 0, 'vishal.yadav@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(30, 'Charanjit Singh Saggu1', 7, 0, 'charanjit.singh1@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(31, 'Vishal Sahi', 6, 0, 'vishal.sahi@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(32, 'Amit', 2, 0, 'amit.kamal@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(33, 'Amar Deep Singh Sandhu', 3, 0, 'amardeep.singh@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(34, 'biri singh', 1, 0, 'biri.singh@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(35, 'Manjinder Grewal', 6, 0, 'manjinder.kaur@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(36, 'Mamta sharma', 7, 0, 'mamta.sharma@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(37, 'Anil Kumar', 1, 1, 'anil.kumar@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(38, 'Anil kumar Sharma', 6, 0, 'anil.sharma@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(39, 'Vartika Kashyap', 4, 0, 'vartika.kashyap@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:31:06'),
(40, 'Dharmender Singh', 1, 0, 'dharmender.singh@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(41, 'Richa tejpal111', 1, 0, 'richa.tejpal@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(42, 'Naveen Kumar', 1, 0, 'naveen.kumar@kindlebit.com', '4f8d51754e39a433e690a8ea4b7b9e0b', '', 1, '0000-00-00 00:00:00', '06:00:59'),
(43, 'Jasmeet Kaur', 1, 1, 'jasmeet.kaur@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', 1, '0000-00-00 00:00:00', '06:17:22'),
(44, 'Harpreet Kaur', 1, 0, 'harpreet.kaur@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(45, 'Vijay rana', 2, 0, 'vijay.rana@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:28:56'),
(46, 'kirti kaushal', 1, 0, 'kirti.kaushal@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(47, 'DeshRaj Sharma1', 2, 0, 'deshraj.sharma@kindlebit.com', '38ae31d28db7b55c65b11ae56f2bbdae', '', 1, '0000-00-00 00:00:00', '06:19:57'),
(48, 'Vivek Sharma', 1, 1, 'vivek.sharma@kindlebit.com', 'c5789c0584eba1c267bb6d507f9532de', 'admin', 1, '0000-00-00 00:00:00', '06:42:24'),
(49, 'Vishal Pathania', 6, 0, 'vishal.pathania@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(50, 'prasenjit mallick', 3, 0, 'prasenjit.mallick@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(51, 'joseph christopher', 1, 0, 'joseph.christopher@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(52, 'arvind verma', 1, 0, 'arvind.verma@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(53, 'partap singh', 8, 0, 'partap.singh@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '07:18:42'),
(54, 'nishant chawla', 1, 0, 'nishant.chawla@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(55, 'parshant kumar', 6, 0, 'parshant.kumar@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(56, 'Anil gautam', 1, 0, 'anil.gautam@kindlebit.com', 'dd8f0a3a5fdb3f72aa0fc901e493dec8', '', 1, '0000-00-00 00:00:00', '06:41:23'),
(57, 'yogesh duggal', 2, 0, 'yogesh.duggal@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(58, 'amandeep kaur', 6, 0, 'amandeep.kaur@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(59, 'richa parmar', 5, 0, 'richa.parmar@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(60, 'richa naidu', 4, 0, 'richa.naidu@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(61, 'ram chand', 2, 0, 'ram.chand@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(62, 'namarta chhabra', 3, 0, 'namarta.chhabra@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '0000-00-00 00:00:00', '06:17:22'),
(63, 'krishna sharma', 1, 0, 'krishna.sharma@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '2011-11-16 00:00:00', '05:15:51'),
(64, 'sumit saini', 4, 0, 'sumit.saini@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '2011-11-16 00:00:00', '05:18:38'),
(65, 'grifon jyoti', 6, 0, 'griffen.jyoti@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '2011-11-16 00:00:00', '01:04:51'),
(66, 'navneet', 6, 0, 'navneet.singh@kindlebit.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', 1, '2011-11-16 00:00:00', '05:20:24'),
(76, 'hii', 1, 0, 'nvnkumar58@gmail.com', 'cee669f4a71ffa4fa78f1dd49994c35b', '', 1, '2011-12-05 11:07:06', '11:07:06'),
(77, 'hii', 1, 0, 'nvnkuma1r58@gmail.com', '3d8fd109f062133ca4156609cecb9fa0', '', 1, '2011-12-05 11:09:09', '11:09:09'),
(78, 'fd', 5, 0, 'hr@kindlebit.com', '21232f297a57a5a743894a0e4a801fc3', '', 1, '2011-12-06 01:44:50', '01:44:50');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_dept_id` FOREIGN KEY (`dept_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
