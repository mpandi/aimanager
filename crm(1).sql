-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2016 at 01:51 AM
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
  `billing_contact` text NOT NULL,
  `technical_contact` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name_`, `address`, `billing_contact`, `technical_contact`, `created`) VALUES
(7, 'Moses Pandi', 'box 345', '467689', 'ykliuijj', '2016-08-10 20:54:02'),
(12, 'miceioc 0qqcijw0', '34br46j', 'vfbtrynum', 'bgrny5t7k8l', '2016-08-11 00:01:24'),
(13, 'vfbr messhy', 'qwesdrf', 'vbyt67um76', 'vtyn6umiy,', '2016-08-11 00:24:27');

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
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `location`, `customer_id`, `billing_cycle`, `network_details`, `service_type`, `created`) VALUES
(7, 'kikuyu', 7, '12', 'network', '2', '2016-08-10 21:30:21'),
(11, 'csdgr fbeb', 13, '1', 'qaxcvbng', '1', '2016-08-11 01:09:03');

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
(1, 'admin', 'pavmoses@yahoo.com', 'a029d0df84eb5549c641e04a9ef389e5', '0000-00-00 00:00:00', '2016-05-05 18:24:06', 2, 1),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
