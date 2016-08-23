-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2016 at 03:30 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `location` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `billing_cycle` text NOT NULL,
  `network_details` text NOT NULL,
  `service_type` text NOT NULL,
  `ip_addresses` text NOT NULL,
  `cpe_mac` text NOT NULL,
  `ap_connected` text NOT NULL,
  `execution_code` text NOT NULL,
  `cpe_graph` text NOT NULL,
  `grace_period` int(5) NOT NULL,
  `created` datetime NOT NULL,
  `expiry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `location`, `customer_id`, `billing_cycle`, `network_details`, `service_type`, `ip_addresses`, `cpe_mac`, `ap_connected`, `execution_code`, `cpe_graph`, `grace_period`, `created`, `expiry_date`) VALUES
(7, 'kikuyu area', 14, '12', 'network 4', '2', '12.445.6677.', 'sewfrg', 'vfbtyuio', 'shelldsdfr rgfe4g', 'httpsd', 15, '2016-08-10 21:30:21', '0000-00-00 00:00:00'),
(11, 'csdgr fbeb', 13, '1', 'qaxcvbng', '1', '', '', '', '', '', 0, '2016-08-11 01:09:03', '0000-00-00 00:00:00'),
(12, 'here', 14, '4', 'details', '1', '34.556.778.999', '43.6576.97780.kuk8.', 'none', 'shell', 'http://graph', 0, '2016-08-15 15:31:09', '0000-00-00 00:00:00'),
(13, 'sfrthyumi', 13, '4', '', '1', '343.65.676.878.99', 'gnyum', 'dvrtbnyumi', 'dvt5ynumi,o', 'gtyh6u7ik8ol345', 0, '2016-08-30 00:00:00', '0000-00-00 00:00:00'),
(14, 'xwdvef', 14, '4', '', '1', 'ertyu', 'dcertyumio', 'zscefrty6u7io', 'dwfgt5y6u7i8o9p', 'swefrgtyuio', 0, '2016-08-30 00:00:00', '2016-08-27 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
