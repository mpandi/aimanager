-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2016 at 04:43 AM
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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name_` text NOT NULL,
  `address` text NOT NULL,
  `billing_contact_name` text NOT NULL,
  `billing_contact_phone` text NOT NULL,
  `technical_contact_name` text NOT NULL,
  `technical_contact_phone` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name_`, `address`, `billing_contact_name`, `billing_contact_phone`, `technical_contact_name`, `technical_contact_phone`, `created`) VALUES
(12, 'miceioc matthews', '34br46j', 'vfbtrynum', '2345678', 'bgrny5t7k8l', '09097867546354231', '2016-08-11 00:01:24'),
(13, 'vfbr messhy', 'qwesdrf', 'vbyt67um76', '24568909', 'vtyn6umibgh', '9897089654', '2016-08-11 00:24:27'),
(14, 'Musa Mutasio', 'qwasdt', 'Moses apndi', '123456789', 'meshack', '77865432', '2016-08-15 03:26:34');

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
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `location`, `customer_id`, `billing_cycle`, `network_details`, `service_type`, `ip_addresses`, `cpe_mac`, `ap_connected`, `execution_code`, `cpe_graph`, `grace_period`, `created`) VALUES
(7, 'kikuyu area', 14, '12', 'network 4', '2', '12.445.6677.', 'sewfrg', 'vfbtyuio', 'shelldsdfr rgfe4g', 'httpsd', 15, '2016-08-10 21:30:21'),
(11, 'csdgr fbeb', 13, '1', 'qaxcvbng', '1', '', '', '', '', '', 0, '2016-08-11 01:09:03'),
(12, 'here', 14, '4', 'details', '1', '34.556.778.999', '43.6576.97780.kuk8.', 'none', 'shell', 'http://graph', 0, '2016-08-15 15:31:09'),
(13, 'sfrthyumi', 13, '4', '', '1', '343.65.676.878.99', 'gnyum', 'dvrtbnyumi', 'dvt5ynumi,o', 'gtyh6u7ik8ol345', 0, '2016-08-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` mediumtext NOT NULL,
  `password` text NOT NULL,
  `created` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created`, `lastlogin`, `status`, `level`) VALUES
(1, 'admin', 'moses@yahoo.com', 'a029d0df84eb5549c641e04a9ef389e5', '0000-00-00 00:00:00', '2016-05-05 18:24:06', 2, 1),
(33, 'musa', 'musa@gmail.com', 'moses', '0000-00-00 00:00:00', '2016-05-08 20:44:19', 1, 2),
(34, 'derguitgit', 'moses@yahoo.com', 'cvtrtyhyuju', '2016-05-05 17:42:13', '0000-00-00 00:00:00', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
