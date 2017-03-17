-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2017 at 05:30 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jeelani`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pin` int(10) unsigned NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `start_month` int(11) NOT NULL,
  `start_year` int(11) NOT NULL,
  `end_month` int(11) NOT NULL,
  `end_year` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `name`, `address`, `pin`, `phone`, `city`, `district_id`, `state_id`, `user_id`, `start_month`, `start_year`, `end_month`, `end_year`, `created_at`, `updated_at`) VALUES
(1, 'Mufeed Abdulla', 'Munawiras, \r\nKadavu Road,\r\nMattul Central', 670302, '9544748315', 'Kannur', 1, 3, 1, 1, 2017, 12, 2017, '2017-03-14 03:56:25', '2017-03-14 04:02:01'),
(2, 'Jazim CV', 'Khadeeja House,\r\nMattul Central Chaal,', 670302, '0497-2843591', 'Kanuur', 1, 3, 1, 3, 2017, 2, 2018, '2017-03-14 04:01:00', '2017-03-14 04:01:00'),
(3, 'Mufeed Abdulla', '1G Estonia,\r\nOlive Courtyard,\r\nOpposite Carnival Infopark', 682030, '9544748315', 'Kakkanad', 3, 3, 1, 3, 2017, 2, 2018, '2017-03-14 06:06:48', '2017-03-14 06:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `district_user_id_index` (`user_id`),
  KEY `district_state_id_index` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `user_id`, `state_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Kannur', '2017-03-14 03:51:58', '2017-03-14 05:19:59'),
(3, 1, 3, 'Ernakulam', '2017-03-14 04:54:10', '2017-03-14 04:54:10'),
(5, 1, 6, 'Manglore', '2017-03-14 05:26:18', '2017-03-14 05:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_02_20_112909_create_address_table', 1),
('2017_02_20_112920_create_state_table', 1),
('2017_02_21_055233_create_district_table', 1),
('2017_03_01_062524_create_subscription_table', 1),
('2017_03_14_114703_create_options_table', 2),
('2017_03_15_063818_add_soft_delete_to_user', 3);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) DEFAULT NULL,
  `string_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `options_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `value`, `string_value`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 'address_width', 80, NULL, 1, '2017-03-16 22:55:28', '2017-03-17 06:01:04'),
(6, 'page_width', 210, NULL, 1, '2017-03-16 22:57:54', '2017-03-17 05:54:26'),
(7, 'page_height', 297, NULL, 1, '2017-03-16 23:01:54', '2017-03-17 05:47:00'),
(8, 'address_margin_top', 100, NULL, 1, '2017-03-16 23:18:05', '2017-03-17 03:17:06'),
(9, 'address_font_size', 5, NULL, 1, '2017-03-17 01:09:12', '2017-03-17 05:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('cvmufeed@gmail.com', '0d1f4b6e4c628bacf7d01c118fc6577330a7fb5c1f896b4319d742723979404c', '2017-03-16 01:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id_index` (`id`),
  KEY `state_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'Kerala', 1, '2017-03-14 03:51:52', '2017-03-14 23:00:20'),
(6, 'Karnataka', 1, '2017-03-14 05:09:45', '2017-03-14 05:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address_id` int(10) unsigned NOT NULL,
  `start` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_address_id_index` (`address_id`),
  KEY `subscriptions_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('admin','superadmin') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mufeed Abdulla', 'cvmufeed@gmail.com', '$2y$10$2unNwu08TC2Ou8yINrDWeOycj64jDzhrO9NNKm9Eq2wG//tZ/ek/C', 'superadmin', '4kPAVtUfHoSUhqJz1zPmSxh2Amzz7eBN6BvKBM91TmL51QDXeglcLM7HE25Q', '2017-03-14 03:51:03', '2017-03-16 01:47:17', NULL),
(4, 'Muhammed Ali', 'ali@gmail.com', '$2y$10$ELlF958X7ipP5se0OII7b.4lAA/qo0eg56ppNbPlr9yDYl2ZfvSA2', 'admin', '3B43Hf3cKJMB30k6YlIg8IN5QtPZPEQPIeDr9ByO5PyCMxW9SZ2SMNkFrrnV', '2017-03-14 22:59:20', '2017-03-15 06:17:26', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
