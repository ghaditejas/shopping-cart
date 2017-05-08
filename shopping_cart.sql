-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2017 at 03:48 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_path` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active0 - InactiveOnly active banners will get visible on fron end',
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`banner_id`, `banner_path`, `status`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'product1493976184.jpg', 1, '2017-05-05', 1, '2017-05-05 08:47:02', 1),
(2, 'product1493981445.jpg', 1, '2017-05-05', 1, '2017-05-05 10:50:45', NULL),
(3, 'product1493981462.png', 1, '2017-05-05', 1, '2017-05-05 10:51:02', NULL),
(4, 'product1494224019.png', 1, '2017-05-08', 1, '2017-05-08 06:13:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `configuration_type`
--

CREATE TABLE IF NOT EXISTS `configuration_type` (
  `config_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_type` varchar(45) NOT NULL,
  PRIMARY KEY (`config_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `configuration_type`
--

INSERT INTO `configuration_type` (`config_type_id`, `config_type`) VALUES
(1, 'smtp_host'),
(2, 'admin_email');

-- --------------------------------------------------------

--
-- Table structure for table `configuration_value`
--

CREATE TABLE IF NOT EXISTS `configuration_value` (
  `config_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_type_id` int(11) NOT NULL,
  `config_value` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`config_value_id`),
  KEY `config_type_id` (`config_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `configuration_value`
--

INSERT INTO `configuration_value` (`config_value_id`, `config_type_id`, `config_value`, `created_by`, `created_on`, `modified_on`, `modified_by`, `status`) VALUES
(1, 1, 'host_name', 0, '2017-05-03', '2017-05-03 06:33:46', NULL, 1),
(2, 2, 'admin@gmail.com', 1, '2017-05-03', '2017-05-03 06:33:46', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `modules` varchar(45) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `modules`) VALUES
(1, 'admin_user'),
(2, 'configuration'),
(3, 'banner');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'inventory manager'),
(4, 'order manager'),
(5, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE IF NOT EXISTS `role_permission` (
  `role_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_permission_id`),
  KEY `role_id` (`role_id`,`permission_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_permission_id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(4, 1, 2),
(6, 1, 3),
(2, 2, 2),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_date` date DEFAULT NULL,
  `fb_token` varchar(100) DEFAULT NULL,
  `twitter_token` varchar(100) DEFAULT NULL,
  `google_token` varchar(100) DEFAULT NULL,
  `registration_method` enum('N','F','T','G') DEFAULT NULL COMMENT 'N- Normal\nF- facebook\nT- Twitter\nG- Google',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `email`, `password`, `status`, `created_date`, `fb_token`, `twitter_token`, `google_token`, `registration_method`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '1', NULL, NULL, NULL, NULL, NULL),
(2, 'Suraj', 'Gavahane', 'suraj@gmail.com', '8127a1ad276367223d9d0a2d264e4b2e', '1', NULL, NULL, NULL, NULL, NULL),
(6, 'rahul', 'patil', 'rahul@gmail.com', '2acb7811397a5c3bea8cba57b0388b79', '1', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_role_id`),
  KEY `user_id` (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(8, 1, 2),
(2, 1, 3),
(3, 1, 4),
(9, 1, 5),
(4, 2, 2),
(5, 2, 3),
(6, 2, 4),
(7, 2, 5),
(18, 6, 3),
(19, 6, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `configuration_value`
--
ALTER TABLE `configuration_value`
  ADD CONSTRAINT `config type to config value` FOREIGN KEY (`config_type_id`) REFERENCES `configuration_type` (`config_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `assign permission` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role to permission` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `assign role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User to role` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
