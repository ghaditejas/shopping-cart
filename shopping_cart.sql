-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2017 at 08:06 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_category`(IN `category_name` VARCHAR(50), IN `cat_status` TINYINT(1), IN `cat_parent_id` INT(11), IN `cat_created_on` DATE, IN `cat_created_by` INT(11))
begin
Insert into category (name,status,parent_id,created_on,created_by) values
(category_name,cat_status,cat_parent_id,cat_created_on,cat_created_by);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_category`(IN `cat_name` VARCHAR(50), IN `cat_status` TINYINT(1), IN `cat_parent_id` INT(11), IN `cat_modified_by` INT(11), IN `cat_id` INT(11))
begin
Update category set name=cat_name,status=cat_status,parent_id=cat_parent_id,modified_by=cat_modified_by where category_id=cat_id;
end$$

DELIMITER ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`banner_id`, `banner_path`, `status`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'product1495426674.jpg', 0, '2017-05-05', 1, '2017-05-05 08:47:02', 1),
(2, 'product1495426685.jpg', 1, '2017-05-05', 1, '2017-05-05 10:50:45', 1),
(3, 'product1495426699.jpg', 1, '2017-05-05', 1, '2017-05-05 10:51:02', 1),
(4, 'product1495426710.jpg', 1, '2017-05-08', 1, '2017-05-08 06:13:39', 1),
(5, 'product1495518288.jpg', 1, '2017-05-23', 1, '2017-05-23 05:44:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `parent_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `status`) VALUES
(1, 'Mobiles', 0, 1, '2017-05-09', 1, '2017-05-09 08:00:07', 1),
(2, 'Samsung', 1, 1, '2017-05-09', 1, '2017-05-09 08:18:45', 1),
(3, 'Books', 0, 1, '2017-05-09', NULL, '2017-05-09 08:19:11', 1),
(4, 'Fictional', 3, 1, '2017-05-09', NULL, '2017-05-09 08:26:30', 1),
(5, 'Nokia', 1, 1, '2017-05-09', NULL, '2017-05-09 10:06:17', 1),
(6, 'Motorola', 1, 1, '2017-05-09', NULL, '2017-05-09 10:07:11', 1),
(7, 'Apple', 1, 1, '2017-05-09', NULL, '2017-05-09 10:07:59', 1),
(8, 'Micromax', 1, 1, '2017-05-09', 1, '2017-05-09 10:08:36', 1),
(9, 'Oppo', 1, 1, '2017-05-09', 1, '2017-05-09 10:08:48', 1),
(10, 'Panasonic', 1, 1, '2017-05-09', 1, '2017-05-09 10:11:48', 1),
(11, 'Literature', 3, 1, '2017-05-09', NULL, '2017-05-09 10:14:02', 1),
(12, 'Classic', 3, 1, '2017-05-09', 1, '2017-05-09 10:14:31', 1),
(13, 'CLOTHINGS', 0, 1, '2017-05-23', 1, '2017-05-23 06:16:09', 1);

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
(1, 1, 'host_name', 1, '2017-05-18', '2017-05-03 06:33:46', NULL, 1),
(2, 2, 'admin@gmail.com', 1, '2017-05-03', '2017-05-03 06:33:46', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `percent_off` float(12,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `no_of_uses` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `percent_off`, `created_by`, `created_on`, `modified_by`, `modified_on`, `no_of_uses`) VALUES
(1, 'GRAB500', 40.00, 1, '2017-05-15', 1, '2017-05-15 14:37:37', 100);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `modules` varchar(45) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `modules`) VALUES
(1, 'admin_user'),
(2, 'configuration'),
(3, 'banner'),
(4, 'category'),
(5, 'product'),
(6, 'attribute'),
(7, 'coupon');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `sku` varchar(45) DEFAULT NULL,
  `short_description` varchar(100) DEFAULT NULL,
  `long_description` text,
  `price` float(14,2) DEFAULT NULL,
  `special_price` float(14,2) DEFAULT NULL,
  `special_price_from` date DEFAULT NULL,
  `special_price_to` date DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `meta_title` varchar(45) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `created_by` int(10) NOT NULL,
  `created_on` date NOT NULL,
  `modifed_by` int(10) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_featured` bit(1) DEFAULT NULL COMMENT 'By Default it will be 0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `sku`, `short_description`, `long_description`, `price`, `special_price`, `special_price_from`, `special_price_to`, `status`, `quantity`, `meta_title`, `meta_description`, `meta_keywords`, `created_by`, `created_on`, `modifed_by`, `modified_on`, `is_featured`) VALUES
(3, 'Product1', 'ABCD123', 'MOBILE', '', 15999.99, 14999.99, '2017-05-16', '2017-05-27', '1', 15, 'Oppo Mobile', 'New Oppo Mobile', 'Product Mobile', 1, '2017-05-11', 1, '2017-05-11 07:53:58', b'1'),
(4, 'asd', 'asdsad', 'MOBILE', '', 15.22, 16.23, '0000-00-00', '0000-00-00', '1', 10, 'Oppo Mobile', 'New Oppo Mobile', 'asdasd', 1, '2017-05-11', NULL, '2017-05-11 09:31:53', b'1'),
(5, 'asd', 'asdsad', 'MOBILE', '', 15.22, 16.23, '0000-00-00', '0000-00-00', '1', 10, 'Oppo Mobile', 'New Oppo Mobile', 'asdasd', 1, '2017-05-11', NULL, '2017-05-11 09:39:42', b'1'),
(6, 'asd', 'asdsad', 'MOBILE', '', 15.22, 16.23, '0000-00-00', '0000-00-00', '1', 10, 'Oppo Mobile', 'New Oppo Mobile', 'asdasd', 1, '2017-05-11', NULL, '2017-05-11 09:40:12', b'1'),
(7, 'asd', 'asdsad', 'MOBILE', '', 15.22, 16.23, '0000-00-00', '0000-00-00', '1', 10, 'Oppo Mobile', 'New Oppo Mobile', 'asdasd', 1, '2017-05-11', NULL, '2017-05-11 09:40:27', b'1'),
(8, 'Moto e', 'ABCD123', 'Handset', '', 7999.99, 6999.99, '2017-05-16', '2017-05-16', '1', 15, 'MOTO E3', 'POWER CHARGING', 'MOTO MOBLE', 1, '2017-05-12', 1, '2017-05-12 08:07:07', b'1'),
(9, 'asda', 'agsfdgha', 'asfda', 'FASGHDF', 123.12, 123.12, '2017-05-02', '2017-06-21', '0', 1734, 'SHDFSDAGH', '', '', 1, '2017-05-24', NULL, '2017-05-24 08:06:29', b'1'),
(10, 'asdg', '1231', '1231231', '', 16253.12, 123.99, '2017-05-23', '2017-05-31', '1', 123, '123123', '', '', 1, '2017-05-24', NULL, '2017-05-24 08:07:07', b'1'),
(11, 'adfad', '123123', 'SDFSDFSD', '', 12.00, 12.12, '2017-05-10', '2017-06-07', '1', 123, 'ASDASD', '', 'AHSDAHGSSD', 1, '2017-05-24', 1, '2017-05-24 08:08:41', b'1'),
(12, 'asd', 'asdad', 'asd', '', 50.55, 48.55, '2017-05-31', '2017-06-07', '1', 5, 'asdsad', '', '', 1, '2017-05-24', NULL, '2017-05-24 11:54:21', b'1'),
(13, 'asd', 'asdad', 'asd', '', 50.55, 48.55, '2017-05-31', '2017-06-07', '1', 5, 'asdsad', '', '', 1, '2017-05-24', NULL, '2017-05-24 13:06:24', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE IF NOT EXISTS `product_attributes` (
  `product_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`product_attribute_id`, `name`, `created_by`, `created_on`, `modified_by`, `modified_on`, `status`) VALUES
(1, 'Colour', 1, '2017-05-10', 1, '2017-05-10 07:11:31', 1),
(2, 'Brand', 1, '2017-05-10', NULL, '2017-05-10 07:13:50', 1),
(3, 'Size', 1, '2017-05-10', NULL, '2017-05-10 07:22:54', 1),
(4, 'RAM', 1, '2017-05-10', NULL, '2017-05-10 07:24:55', 1),
(5, 'ISBN', 1, '2017-05-10', NULL, '2017-05-10 07:25:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_assoc`
--

CREATE TABLE IF NOT EXISTS `product_attributes_assoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `product_attribute_id` int(11) DEFAULT NULL,
  `product_attribute_value_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`),
  KEY `product_attribute_id_idx` (`product_attribute_id`),
  KEY `product_attribute_value_id_idx` (`product_attribute_value_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `product_attributes_assoc`
--

INSERT INTO `product_attributes_assoc` (`id`, `product_id`, `product_attribute_id`, `product_attribute_value_id`) VALUES
(1, 7, 1, 9),
(2, 7, 2, 9),
(35, 8, 3, 43),
(36, 8, 1, 44),
(38, 3, 2, 46),
(39, 3, 3, 47),
(45, 11, 2, 56),
(46, 11, 1, 57);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE IF NOT EXISTS `product_attribute_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_attribute_id` int(11) DEFAULT NULL,
  `attribute_value` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modifed_by` int(11) NOT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_attribute_id_idx` (`product_attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`id`, `product_attribute_id`, `attribute_value`, `created_by`, `created_on`, `modifed_by`, `modified_on`) VALUES
(1, 1, 'Black', 1, '2017-05-11', 0, '2017-05-11 09:31:30'),
(2, 2, 'Oppo', 1, '2017-05-11', 0, '2017-05-11 09:31:30'),
(3, 1, 'Black', 1, '2017-05-11', 0, '2017-05-11 09:31:53'),
(4, 2, 'Oppo', 1, '2017-05-11', 0, '2017-05-11 09:31:53'),
(5, 1, 'Black', 1, '2017-05-11', 0, '2017-05-11 09:39:42'),
(6, 2, 'Oppo', 1, '2017-05-11', 0, '2017-05-11 09:39:42'),
(7, 1, 'Black', 1, '2017-05-11', 0, '2017-05-11 09:40:12'),
(8, 2, 'Oppo', 1, '2017-05-11', 0, '2017-05-11 09:40:12'),
(9, 1, 'Black', 1, '2017-05-11', 0, '2017-05-11 09:40:27'),
(10, 2, 'Oppo', 1, '2017-05-11', 0, '2017-05-11 09:40:27'),
(20, 1, 'Black', 1, '2017-05-15', 0, '2017-05-15 07:18:12'),
(21, 2, 'MOTOROLA', 1, '2017-05-15', 0, '2017-05-15 07:18:12'),
(23, 1, 'Black', 1, '2017-05-15', 0, '2017-05-15 07:21:15'),
(24, 2, 'MOTOROLA', 1, '2017-05-15', 0, '2017-05-15 07:21:15'),
(26, 1, 'Black', 1, '2017-05-15', 0, '2017-05-15 07:21:37'),
(43, 3, '5*5inch', 1, '2017-05-15', 0, '2017-05-15 08:56:43'),
(44, 1, 'Black', 1, '2017-05-15', 0, '2017-05-15 08:56:43'),
(46, 2, 'OPPO', 1, '2017-05-15', 0, '2017-05-15 09:31:21'),
(47, 3, '6*6inch', 1, '2017-05-15', 0, '2017-05-15 09:31:21'),
(56, 2, 'OPPO', 1, '2017-05-24', 0, '2017-05-24 13:15:31'),
(57, 1, 'Black', 1, '2017-05-24', 0, '2017-05-24 13:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`),
  KEY `category_id_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`) VALUES
(2, 3, 9),
(3, 4, 10),
(4, 5, 10),
(5, 6, 10),
(6, 7, 10),
(7, 8, 6),
(8, 9, 4),
(9, 10, 4),
(10, 11, 4),
(11, 12, 8),
(12, 13, 8);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(100) DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `image_name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`, `product_id`) VALUES
(1, 'product1494489238.jpg', '1', 1, '2017-05-11', 1, '2017-05-11 07:53:58', 3),
(2, 'product1494495113.jpg', '1', 1, '2017-05-11', NULL, '2017-05-11 09:31:53', 4),
(3, 'product1494495582.jpg', '1', 1, '2017-05-11', NULL, '2017-05-11 09:39:42', 5),
(4, 'product1494495612.jpg', '1', 1, '2017-05-11', NULL, '2017-05-11 09:40:12', 6),
(5, 'product1494495627.jpg', '1', 1, '2017-05-11', NULL, '2017-05-11 09:40:27', 7),
(6, 'product1494576427.png', '1', 1, '2017-05-12', 1, '2017-05-12 08:07:07', 8),
(7, 'product1495613189.jpg', '0', 1, '2017-05-24', NULL, '2017-05-24 08:06:29', 9),
(8, 'product1495613227.jpg', '1', 1, '2017-05-24', NULL, '2017-05-24 08:07:07', 10),
(9, 'product1495613321.jpg', '1', 1, '2017-05-24', 1, '2017-05-24 08:08:41', 11),
(10, 'product1495626861.jpg', '1', 1, '2017-05-24', NULL, '2017-05-24 11:54:21', 12),
(11, 'product1495631184.jpg', '1', 1, '2017-05-24', NULL, '2017-05-24 13:06:24', 13);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_permission_id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(4, 1, 2),
(6, 1, 3),
(7, 1, 4),
(8, 1, 5),
(9, 1, 6),
(10, 1, 7),
(2, 2, 2),
(3, 2, 3),
(11, 2, 4),
(12, 2, 5),
(13, 2, 6),
(14, 2, 7),
(15, 3, 5),
(17, 3, 6),
(16, 4, 5),
(18, 4, 6);

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
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `email`, `password`, `status`, `created_date`, `fb_token`, `twitter_token`, `google_token`, `registration_method`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '1', NULL, NULL, NULL, NULL, NULL),
(2, 'Suraj', 'Gavahane', 'suraj@gmail.com', '8127a1ad276367223d9d0a2d264e4b2e', '1', NULL, NULL, NULL, NULL, NULL),
(6, 'rahul', 'patil', 'rahul@gmail.com', '2acb7811397a5c3bea8cba57b0388b79', '1', NULL, NULL, NULL, NULL, NULL),
(10, 'Tejas', 'Ghadi', 'tejas@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '1', NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

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
(22, 6, 3),
(23, 6, 4),
(24, 10, 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `configuration_value`
--
ALTER TABLE `configuration_value`
  ADD CONSTRAINT `config type to config value` FOREIGN KEY (`config_type_id`) REFERENCES `configuration_type` (`config_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_assoc`
--
ALTER TABLE `product_attributes_assoc`
  ADD CONSTRAINT `product id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Product_attribute values` FOREIGN KEY (`product_attribute_value_id`) REFERENCES `product_attribute_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Product_attribute_id` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`product_attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD CONSTRAINT `poduct_attribute` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`product_attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
