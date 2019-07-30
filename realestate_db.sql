-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2019 at 07:55 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `realestate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addition_features`
--

CREATE TABLE IF NOT EXISTS `addition_features` (
  `feature_id` int(11) NOT NULL DEFAULT '0',
  `property_type` tinyint(2) NOT NULL DEFAULT '0',
  `feature` varchar(100) DEFAULT NULL,
  `data_type` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`feature_id`,`property_type`),
  KEY `feature_id` (`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addition_features`
--

INSERT INTO `addition_features` (`feature_id`, `property_type`, `feature`, `data_type`) VALUES
(1, 1, 'Built in year', 1),
(2, 1, 'View', 2),
(3, 1, 'Furnished', 2),
(4, 1, 'Electricity Meter', 2),
(5, 1, 'Gas Meter', 2),
(6, 1, 'Floor', 2),
(7, 1, 'Business and Communication', 3),
(8, 1, 'Nearby Facilities', 3),
(9, 1, 'Rooms', 2),
(10, 1, 'Washrooms', 2),
(11, 1, 'Kitchens', 2),
(12, 1, 'Other', 3),
(13, 2, 'Plot Features', 3),
(14, 2, 'Nearby Facilities', 3),
(15, 2, 'Other Description', 1),
(16, 1, 'Other Desription', 1);

-- --------------------------------------------------------

--
-- Table structure for table `addition_features_options`
--

CREATE TABLE IF NOT EXISTS `addition_features_options` (
  `option_id` tinyint(2) NOT NULL DEFAULT '0',
  `feature_id` int(11) NOT NULL DEFAULT '0',
  `optionvalue` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_id`,`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addition_features_options`
--

INSERT INTO `addition_features_options` (`option_id`, `feature_id`, `optionvalue`) VALUES
(1, 2, 'Corner'),
(1, 3, 'Semi-Furnished'),
(1, 4, 'Yes'),
(1, 5, 'Yes'),
(1, 6, 'Tiles'),
(1, 7, 'Broadband Internet access'),
(1, 8, 'Schools '),
(1, 9, '1'),
(1, 10, '1'),
(1, 11, '1'),
(1, 12, 'Drawing Room'),
(1, 13, 'Sewerage'),
(1, 14, 'Schools '),
(2, 2, 'Not Corner'),
(2, 3, 'Fully-Furnished'),
(2, 4, 'No'),
(2, 5, 'No'),
(2, 6, 'Marble'),
(2, 7, 'Satellite or Cable TV Ready'),
(2, 8, 'Mosques'),
(2, 9, '2'),
(2, 10, '2'),
(2, 11, '2'),
(2, 12, 'Dininig Room'),
(2, 13, 'Water Supply'),
(2, 14, 'Mosques'),
(3, 3, 'Unfurnished'),
(3, 4, 'Seperate'),
(3, 5, 'Seperate'),
(3, 6, 'Wooden'),
(3, 7, 'Intercom'),
(3, 8, 'Hospitals'),
(3, 9, '3'),
(3, 10, '3'),
(3, 11, '3'),
(3, 12, 'Study Room'),
(3, 13, 'Irrigation'),
(3, 14, 'Hospitals'),
(4, 3, 'Bare'),
(4, 6, 'Chip'),
(4, 8, 'Shopping Malls'),
(4, 9, '4'),
(4, 10, '4'),
(4, 11, '4'),
(4, 12, 'Store Room'),
(4, 13, 'Electricity'),
(4, 14, 'Shopping Malls'),
(5, 6, 'Other'),
(5, 8, 'Public Transport '),
(5, 9, '5'),
(5, 10, '5'),
(5, 11, '5'),
(5, 12, 'Laundary Room'),
(5, 13, 'Sui Gas'),
(5, 14, 'Public Transport '),
(6, 8, 'Restaurants'),
(6, 9, '5+'),
(6, 10, '5+'),
(6, 11, '5+'),
(6, 12, 'Lawn or Garder'),
(6, 13, 'Tube Well'),
(6, 14, 'Restaurants'),
(7, 12, 'Garage'),
(8, 12, 'Parking Space ');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admiin_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admiin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admiin_id`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) DEFAULT NULL,
  `province_id` tinyint(2) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`city_id`),
  KEY `province_id` (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `province_id`, `status`) VALUES
(1, 'Sahiwal', 1, 1),
(2, 'Karachi', 2, 1),
(3, 'Lahore', 1, 1),
(4, 'Okara', 1, 1),
(5, 'Faisalabad', 1, 1),
(6, 'Hyderabad', 2, 1),
(7, 'Larkana', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `friends_list`
--

CREATE TABLE IF NOT EXISTS `friends_list` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `friend_id` int(11) NOT NULL DEFAULT '0',
  `request_status` tinyint(2) NOT NULL DEFAULT '2' COMMENT '2 request sent, 1 friends, 0 blocked',
  PRIMARY KEY (`user_id`,`friend_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends_list`
--

INSERT INTO `friends_list` (`user_id`, `friend_id`, `request_status`) VALUES
(3, 7, 2),
(7, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `meauring_units`
--

CREATE TABLE IF NOT EXISTS `meauring_units` (
  `meauring_unit` tinyint(2) NOT NULL DEFAULT '0',
  `unit_name` varchar(50) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`meauring_unit`),
  UNIQUE KEY `unit_name` (`unit_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meauring_units`
--

INSERT INTO `meauring_units` (`meauring_unit`, `unit_name`, `status`) VALUES
(1, 'Sq.ft', 1),
(2, 'Sq. yard', 1),
(3, 'Sq. meters', 1),
(4, 'Marla', 1),
(5, 'Kanal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL DEFAULT '0',
  `notice_for` int(11) NOT NULL DEFAULT '0',
  `notice_by` int(11) NOT NULL DEFAULT '0',
  `notification` varchar(1000) DEFAULT NULL,
  `notification_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notification_id`,`notice_for`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `notice_for`, `notice_by`, `notification`, `notification_time`, `status`) VALUES
(1, 4, 3, 'Share Property with you.<a href="property_detail.php?id=5">View Property</a>', '2019-05-24 01:11:26', 0),
(1, 7, 3, 'Sent you Friend request.<a href="accept.php?id=7">Friend Request</a>', '2019-06-14 09:49:22', 0),
(1, 8, 3, 'Sent you Friend request.<a href="accept.php?id=8">Friend Request</a>', '2019-06-14 09:42:38', 0),
(2, 4, 3, 'Share Property with you.<a href="property_detail.php?id=6">View Property</a>', '2019-05-24 10:51:58', 0),
(3, 4, 3, 'Share Property with you.<a href="property_detail.php?id=19">View Property</a>', '2019-06-14 09:39:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `postadd`
--

CREATE TABLE IF NOT EXISTS `postadd` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_by` varchar(50) NOT NULL,
  `post_text` varchar(50) NOT NULL,
  `post_time` datetime(6) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `postadd`
--

INSERT INTO `postadd` (`post_id`, `post_by`, `post_text`, `post_time`) VALUES
(1, '3', 'farah', '2019-06-13 12:42:28.000000');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `property_id` int(11) NOT NULL DEFAULT '0',
  `submitted_by` int(11) NOT NULL DEFAULT '0',
  `property_title` varchar(500) DEFAULT NULL,
  `property_type` tinyint(2) NOT NULL DEFAULT '0',
  `property_sub_type` tinyint(2) NOT NULL DEFAULT '0',
  `property_for` tinyint(2) NOT NULL DEFAULT '0',
  `property_price` double NOT NULL DEFAULT '0',
  `area` float NOT NULL DEFAULT '0',
  `meauring_unit` tinyint(2) NOT NULL DEFAULT '0',
  `address` varchar(200) DEFAULT NULL,
  `city_id` int(11) NOT NULL DEFAULT '0',
  `property_description` varchar(5000) DEFAULT NULL,
  `submit_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approved_by` tinyint(2) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `date_time` date NOT NULL,
  PRIMARY KEY (`property_id`),
  KEY `submitted_by` (`submitted_by`),
  KEY `approved_by` (`approved_by`),
  KEY `city_id` (`city_id`),
  KEY `meauring_unit` (`meauring_unit`),
  KEY `property_sub_type` (`property_sub_type`),
  KEY `property_type` (`property_type`),
  KEY `property_for` (`property_for`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `submitted_by`, `property_title`, `property_type`, `property_sub_type`, `property_for`, `property_price`, `area`, `meauring_unit`, `address`, `city_id`, `property_description`, `submit_date`, `approved_by`, `status`, `date_time`) VALUES
(1, 4, 'asd', 2, 0, 1, 80000000, 12, 1, 'djsdh', 1, '', '2019-05-23 23:44:27', 0, 0, '2019-05-23'),
(2, 3, 'asd', 2, 0, 2, 500, 12, 1, 'djsdh', 4, '', '2019-05-23 23:49:13', 0, 0, '2019-05-23'),
(3, 3, 'asd', 1, 3, 1, 8, 12, 2, 'djsdh', 4, '', '2019-05-23 23:59:08', 0, 0, '2019-05-23'),
(4, 3, 'asd', 1, 3, 1, 8, 66, 1, 'djsdh', 1, '', '2019-05-24 00:03:34', 0, 0, '2019-05-24'),
(5, 3, '5 Marla House', 1, 3, 2, 500000000, 5, 4, 'House No.400/A , Farid Town', 1, '<p>Well furnsihed with good location!</p>', '2019-05-24 01:10:25', 0, 0, '2019-05-24'),
(7, 3, 'amna', 2, 0, 2, 8, 12, 1, 'djsdh', 3, '', '2019-06-09 15:40:18', 0, 0, '2019-06-09'),
(14, 3, 'image testing', 1, 4, 2, 500, 12, 4, 'djsdh', 3, '', '2019-06-09 16:27:47', 0, 0, '2019-06-09'),
(17, 3, 'last image test', 2, 0, 2, 500000, 12, 1, 'djsdh', 4, '', '2019-06-09 17:21:06', 0, 0, '2019-06-09'),
(18, 3, 'image testttttt', 2, 0, 4, 777777777777, 12, 1, 'djsdh', 1, '', '2019-06-13 11:09:16', 0, 0, '2019-06-13'),
(19, 3, 'test', 1, 3, 3, 666666666, 12, 4, 'farid town', 1, '', '2019-06-14 09:38:31', 0, 0, '2019-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `property_additional_features`
--

CREATE TABLE IF NOT EXISTS `property_additional_features` (
  `property_id` int(11) NOT NULL DEFAULT '0',
  `feature_id` int(11) NOT NULL DEFAULT '0',
  `feature` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`property_id`,`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_additional_features`
--

INSERT INTO `property_additional_features` (`property_id`, `feature_id`, `feature`) VALUES
(5, 1, '2017'),
(5, 2, 'Not Corner'),
(5, 3, 'Fully-Furnished'),
(5, 4, 'Yes'),
(5, 5, 'Yes'),
(5, 6, 'Tiles'),
(5, 7, 'Broadband Internet access,Satellite or Cable TV Ready,Intercom'),
(5, 8, 'Schools ,Mosques,Hospitals,Shopping Malls,Restaurants'),
(5, 9, '5'),
(5, 10, '3'),
(5, 11, '2'),
(5, 12, 'Drawing Room,Dininig Room,Study Room,Store Room,Lawn or Garder,Garage,Parking Space '),
(14, 1, '2014'),
(14, 2, 'Corner'),
(14, 3, 'Semi-Furnished'),
(14, 4, 'Yes'),
(14, 5, 'Yes'),
(14, 6, 'Tiles'),
(14, 7, 'Broadband Internet access,Satellite or Cable TV Ready,Intercom'),
(14, 8, 'Schools ,Mosques,Hospitals,Shopping Malls,Public Transport ,Restaurants'),
(14, 9, '5'),
(14, 10, '4'),
(14, 11, '3'),
(14, 12, 'Drawing Room,Dininig Room,Study Room,Store Room,Laundary Room,Lawn or Garder,Garage'),
(17, 13, 'Sewerage,Water Supply,Irrigation,Electricity,Sui Gas,Tube Well'),
(17, 14, 'Schools ,Mosques,Hospitals,Shopping Malls,Public Transport ,Restaurants'),
(18, 13, 'Irrigation'),
(18, 14, 'Hospitals'),
(19, 2, 'Corner'),
(19, 3, 'Semi-Furnished'),
(19, 4, 'Yes'),
(19, 5, 'No'),
(19, 7, 'Satellite or Cable TV Ready'),
(19, 8, 'Public Transport '),
(19, 9, '5'),
(19, 10, '2'),
(19, 11, '3'),
(19, 12, 'Laundary Room,Garage');

-- --------------------------------------------------------

--
-- Table structure for table `property_share`
--

CREATE TABLE IF NOT EXISTS `property_share` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `friend_id` int(11) NOT NULL DEFAULT '0',
  `property_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`friend_id`,`property_id`),
  KEY `friend_id` (`friend_id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_share`
--

INSERT INTO `property_share` (`user_id`, `friend_id`, `property_id`) VALUES
(3, 0, 14),
(3, 0, 17),
(3, 0, 18),
(3, 4, 5),
(3, 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE IF NOT EXISTS `property_types` (
  `property_type` tinyint(2) NOT NULL DEFAULT '0',
  `property_subtype` tinyint(2) NOT NULL DEFAULT '0',
  `types` varchar(50) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`property_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`property_type`, `property_subtype`, `types`, `status`) VALUES
(0, 0, 'No Sub Type', 0),
(1, 0, 'Home', 1),
(2, 0, 'Plot', 1),
(3, 1, 'House', 1),
(4, 1, 'Flat', 1),
(5, 1, 'Apartment', 1),
(6, 1, 'Upper Portion', 1),
(7, 1, 'Lower Portion', 1);

-- --------------------------------------------------------

--
-- Table structure for table `propert_sale_rent`
--

CREATE TABLE IF NOT EXISTS `propert_sale_rent` (
  `property_for` tinyint(2) NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`property_for`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `propert_sale_rent`
--

INSERT INTO `propert_sale_rent` (`property_for`, `type`) VALUES
(1, 'Rent'),
(2, 'Sale'),
(3, 'Sold out'),
(4, 'Rent out');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE IF NOT EXISTS `provinces` (
  `province_id` tinyint(2) NOT NULL DEFAULT '0',
  `province_name` varchar(50) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`province_id`, `province_name`, `status`) VALUES
(1, 'Punjab', 1),
(2, 'Sindh', 1),
(3, 'Balochistan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `p_images`
--

CREATE TABLE IF NOT EXISTS `p_images` (
  `property_id` int(11) NOT NULL,
  `img_no` int(3) NOT NULL,
  `images` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_images`
--

INSERT INTO `p_images` (`property_id`, `img_no`, `images`) VALUES
(12, 1, '12-1.PNG'),
(12, 2, '12-2.PNG'),
(13, 1, '13-1.jpg'),
(13, 2, '13-2.jpg'),
(14, 1, '14-1.jpg'),
(14, 2, '14-2.jpg'),
(14, 3, '14-3.jpg'),
(14, 4, '14-4.jpg'),
(14, 5, '14-5.jpg'),
(14, 6, '14-6.jpg'),
(15, 1, '15-1.jpg'),
(15, 2, '15-2.jpg'),
(15, 3, '15-3.jpg'),
(15, 4, '15-4.jpg'),
(15, 5, '15-5.jpg'),
(15, 6, '15-6.jpg'),
(16, 1, '16-1.jpg'),
(16, 2, '16-2.jpg'),
(16, 3, '16-3.jpg'),
(16, 4, '16-4.jpg'),
(16, 5, '16-5.jpg'),
(16, 6, '16-6.jpg'),
(17, 1, '17-1.jpg'),
(17, 2, '17-2.jpg'),
(17, 3, '17-3.jpg'),
(17, 4, '17-4.jpg'),
(17, 5, '17-5.jpg'),
(17, 1, '17-1.jpg'),
(17, 2, '17-2.jpg'),
(17, 3, '17-3.jpg'),
(18, 1, '18-1.jpg'),
(18, 2, '18-2.jpg'),
(18, 3, '18-3.jpg'),
(19, 1, '19-1.jpg'),
(19, 2, '19-2.jpg'),
(19, 3, '19-3.jpg'),
(19, 4, '19-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `city` int(11) NOT NULL DEFAULT '0',
  `company` varchar(100) DEFAULT NULL,
  `registration_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastedit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `confirmcode` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`, `phone`, `address`, `city`, `company`, `registration_date`, `lastedit`, `status`, `confirmcode`) VALUES
(0, 'All', NULL, NULL, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0'),
(3, 'Amna', 'Nasrullah', 'amnashykh881@gmail.com', 'amna1897', '93239587558', '420/A Faizabad', 1, 'Royal Orchards', '2019-04-01 19:23:46', '2019-04-09 10:11:37', 1, '0'),
(4, 'Farah', 'Jabeen', 'farah.jabeen@yahoo.com', '123', '03217845678', '752/L Farid Town', 1, '', '2019-04-06 12:09:50', '2019-04-06 12:09:50', 1, '0'),
(6, 'Farah', 'Sheikh', 'farah011997@gmail.com', '123', '03217818617', '752/L Farid Town', 2, 'al razaq royals', '2019-04-09 11:37:05', '2019-04-09 11:37:05', 1, '0'),
(7, 'Ali', 'Salman', 'alisalman@gmail.com', '123', '03214515615', '752/L Farid Town', 3, '', '2019-04-09 11:45:45', '2019-04-09 11:45:45', 1, '0'),
(8, 'Ahmad', 'Khan', 'ahmadkhan12@gmail.com', 'qwerty123', '03217818517', '42/A farid Town', 1, 'al razaq royals', '2019-05-11 14:28:41', '2019-05-11 14:28:41', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_company_details`
--

CREATE TABLE IF NOT EXISTS `user_company_details` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `company_name` varchar(100) DEFAULT NULL,
  `fax_number` varchar(20) DEFAULT NULL,
  `registered` tinyint(2) NOT NULL DEFAULT '0',
  `registeredin` tinyint(2) NOT NULL DEFAULT '0',
  `registration_number` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_company_details`
--

INSERT INTO `user_company_details` (`user_id`, `company_name`, `fax_number`, `registered`, `registeredin`, `registration_number`) VALUES
(8, 'al razaq royals', '12', 2, 0, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`province_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `friends_list`
--
ALTER TABLE `friends_list`
  ADD CONSTRAINT `friends_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `friends_list_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`property_type`) REFERENCES `property_types` (`property_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_ibfk_2` FOREIGN KEY (`property_sub_type`) REFERENCES `property_types` (`property_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_ibfk_3` FOREIGN KEY (`meauring_unit`) REFERENCES `meauring_units` (`meauring_unit`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_ibfk_4` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_ibfk_5` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_ibfk_6` FOREIGN KEY (`approved_by`) REFERENCES `admins` (`admiin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_ibfk_7` FOREIGN KEY (`property_for`) REFERENCES `propert_sale_rent` (`property_for`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `property_additional_features`
--
ALTER TABLE `property_additional_features`
  ADD CONSTRAINT `property_additional_features_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `property_share`
--
ALTER TABLE `property_share`
  ADD CONSTRAINT `property_share_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_share_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_share_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_company_details`
--
ALTER TABLE `user_company_details`
  ADD CONSTRAINT `user_company_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
