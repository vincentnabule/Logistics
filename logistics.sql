-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 24, 2023 at 11:47 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `system_user`
--

DROP TABLE IF EXISTS `system_user`;
CREATE TABLE IF NOT EXISTS `system_user` (
  `user_id` int(254) NOT NULL AUTO_INCREMENT,
  `user_names` varchar(50) NOT NULL,
  `user_gender` varchar(20) NOT NULL,
  `user_contact` int(20) NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_user`
--

INSERT INTO `system_user` (`user_id`, `user_names`, `user_gender`, `user_contact`, `user_email`, `registration_date`) VALUES
(1, 'Witi Ihimaera', 'Male', 712345678, 'ihimaera@mail.com', '2023-02-22 01:58:09'),
(2, 'Miles Otieno', 'Male', 712345678, 'otienomiles@mail.com', '2023-02-22 09:52:29'),
(3, 'David Okumbo', 'Male', 717896452, 'okumbo@mail.com', '2023-02-22 09:58:25'),
(4, 'Ken Walibora', 'Male', 712365874, 'walibora@mail.com', '2023-02-24 09:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
CREATE TABLE IF NOT EXISTS `trips` (
  `trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `truck` varchar(20) NOT NULL,
  `trip_from` varchar(20) NOT NULL,
  `trip_to` varchar(20) NOT NULL,
  `trip_date` varchar(30) NOT NULL,
  `cargo_description` text NOT NULL,
  `trip_status` varchar(20) NOT NULL DEFAULT 'Loading',
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`trip_id`, `truck`, `trip_from`, `trip_to`, `trip_date`, `cargo_description`, `trip_status`) VALUES
(1, 'KAC 120P', 'Nairobi', 'Kisumu', '2023-02-24', 'Food Stuff', 'Completed'),
(2, 'KAZ 120O', 'Nairobi', 'Mombasa', '2023-02-24', 'Glass products', 'On Route');

-- --------------------------------------------------------

--
-- Table structure for table `trucks`
--

DROP TABLE IF EXISTS `trucks`;
CREATE TABLE IF NOT EXISTS `trucks` (
  `truck_id` int(11) NOT NULL AUTO_INCREMENT,
  `truck_reg` varchar(20) NOT NULL,
  `truck_fuel` varchar(10) NOT NULL,
  `truck_owner` varchar(30) NOT NULL,
  `truck_driver` varchar(30) NOT NULL,
  `truck_status` varchar(20) NOT NULL DEFAULT 'Available',
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`truck_id`),
  UNIQUE KEY `truck_reg` (`truck_reg`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trucks`
--

INSERT INTO `trucks` (`truck_id`, `truck_reg`, `truck_fuel`, `truck_owner`, `truck_driver`, `truck_status`, `added_date`) VALUES
(1, 'KAZ 120O', 'Diesel', 'Miles Otieno', 'David Okumbo', 'Engaged', '2023-02-22 07:18:41'),
(2, 'KAC 120P', 'Petrol', 'Miles Otieno', 'David Okumbo', 'Available', '2023-02-22 07:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

DROP TABLE IF EXISTS `user_login`;
CREATE TABLE IF NOT EXISTS `user_login` (
  `user_id` int(254) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(254) NOT NULL,
  `user_role` varchar(20) NOT NULL,
  `active_user` tinyint(1) NOT NULL,
  `password_changed` bit(1) NOT NULL DEFAULT b'0',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `user_email`, `user_password`, `user_role`, `active_user`, `password_changed`, `modified_at`) VALUES
(1, 'ihimaera@mail.com', '25d55ad283aa400af464c76d713c07ad', 'Admin', 1, b'1', '2023-02-21 22:58:09'),
(2, 'otienomiles@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Truck Owner', 1, b'0', '2023-02-22 06:52:30'),
(3, 'okumbo@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Driver', 0, b'0', '2023-02-22 06:58:25'),
(4, 'walibora@mail.com', '25d55ad283aa400af464c76d713c07ad', 'Admin', 1, b'1', '2023-02-24 06:27:21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
