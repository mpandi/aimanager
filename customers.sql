-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2016 at 02:25 PM
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
  `email` text NOT NULL,
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

INSERT INTO `customers` (`id`, `name_`, `email`, `address`, `billing_contact_name`, `billing_contact_phone`, `technical_contact_name`, `technical_contact_phone`, `created`) VALUES
(12, 'miceioc matthews', 'pandimoses@gmail.com', '34br46j', 'vfbtrynum', '2345678', 'bgrny5t7k8l', '09097867546354231', '2016-08-11 00:01:24'),
(13, 'vfbr messhy', '', 'qwesdrf', 'vbyt67um76', '24568909', 'vtyn6umibgh', '9897089654', '2016-08-11 00:24:27'),
(14, 'Musa Mutasio', '', 'qwasdt', 'Moses apndi', '123456789', 'meshack', '77865432', '2016-08-15 03:26:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
