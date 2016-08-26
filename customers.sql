-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2016 at 03:20 AM
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
  `billing_contact_email` text NOT NULL,
  `technical_contact_email` text NOT NULL,
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

INSERT INTO `customers` (`id`, `name_`, `billing_contact_email`, `technical_contact_email`, `address`, `billing_contact_name`, `billing_contact_phone`, `technical_contact_name`, `technical_contact_phone`, `created`) VALUES
(15, 'LIVING WORD OF FAITH', 'admin@lwfomi.org', 'technical@email.com', '5 & 7 VICTORIA STREET', 'RODERICKA TAYLOR-SMITH', '23276620116', 'JIM DAVIES', '23277644946', '2016-08-24 16:48:22'),
(16, 'STANDARD CHARTERED BANK', 'aloysious.bindi@sc.com', '', '9 & 11 LIGHTFOOT-BOSTON STREET', 'CRIMILDA COLE', '23276635380', 'ALOYSIOUS BINDI', '23276603871', '2016-08-24 16:49:50'),
(17, 'MARIE STOPES SIERRA LEONE', 'justice.anthony@mariestopes.org.sl', '', 'ABERDEEN ROAD', 'SARAH-ROSE MARAH', '23276613666', 'JUSTICE ANTHONY', '23278130607', '2016-08-24 16:51:22');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
