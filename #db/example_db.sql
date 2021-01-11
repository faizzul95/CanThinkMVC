-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 07, 2021 at 02:32 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_role`
--

DROP TABLE IF EXISTS `master_role`;
CREATE TABLE IF NOT EXISTS `master_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `redirect_url` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_role`
--

INSERT INTO `master_role` (`role_id`, `role_name`, `redirect_url`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', NULL, '2021-01-07 06:31:21', NULL),
(2, 'Administrator', NULL, '2021-01-07 06:31:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_status`
--

DROP TABLE IF EXISTS `master_status`;
CREATE TABLE IF NOT EXISTS `master_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) DEFAULT NULL,
  `status_type` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`status_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_status`
--

INSERT INTO `master_status` (`status_id`, `status_name`, `status_type`, `created_at`, `updated_at`) VALUES
(1, 'Active', 1, '2021-01-07 06:31:46', NULL),
(2, 'Not Active', 1, '2021-01-07 06:31:52', NULL),
(3, 'Blocked', 1, '2021-01-07 06:31:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `school_info`
--

DROP TABLE IF EXISTS `school_info`;
CREATE TABLE IF NOT EXISTS `school_info` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(255) DEFAULT NULL,
  `school_address` varchar(255) DEFAULT NULL,
  `school_postal_code` int(11) DEFAULT NULL,
  `school_city` varchar(50) DEFAULT NULL,
  `school_state` varchar(50) DEFAULT NULL,
  `school_country_id` int(11) DEFAULT NULL,
  `school_contact_no` varchar(15) DEFAULT NULL,
  `school_fax_no` varchar(15) DEFAULT NULL,
  `school_website` varchar(255) DEFAULT NULL,
  `school_logo` varchar(255) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`school_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `school_info`
--

INSERT INTO `school_info` (`school_id`, `school_name`, `school_address`, `school_postal_code`, `school_city`, `school_state`, `school_country_id`, `school_contact_no`, `school_fax_no`, `school_website`, `school_logo`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Nama Sekolah Anda', 'Alamat Sekolah Anda', 11000, 'Kajang', 'Selangor', 131, '12345', '12345', '', 'default/user.jpg', 1, '2020-10-12 09:28:00', '2020-10-16 06:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default/user.jpg',
  `status_id` int(11) DEFAULT 1,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  KEY `user_status` (`status_id`) USING BTREE,
  KEY `role_id` (`role_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
