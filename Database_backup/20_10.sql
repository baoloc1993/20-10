-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2015 at 09:17 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `20_10`
--

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `id` int(10) unsigned NOT NULL COMMENT 'Auto increasing',
  `email` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blacklist`
--

INSERT INTO `blacklist` (`id`, `email`) VALUES
(2, 'nhat002@e.ntu.edu.sg'),
(3, 'nguyenhu002@e.ntu.edu.sg'),
(10, 'lebaoloc001@e.ntu.edu.sg'),
(11, 'lebaotru001@e.ntu.edu.sg'),
(12, 'anhvinh001@e.ntu.edu.sg'),
(13, 'leph0002@e.ntu.edu.sg'),
(14, 'khanh001@e.ntu.edu.sg'),
(15, 'minh11@e.ntu.edu.sg'),
(16, 'nghia002@e.ntu.edu.sg'),
(17, 'honghai001@e.ntu.edu.sg');

-- --------------------------------------------------------

--
-- Table structure for table `ladies`
--

CREATE TABLE IF NOT EXISTS `ladies` (
  `id` int(10) unsigned NOT NULL COMMENT 'Auto increasing',
  `name` text,
  `email` text NOT NULL,
  `actcode` text NOT NULL,
  `spin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Store the info of female participants';

--
-- Dumping data for table `ladies`
--

INSERT INTO `ladies` (`id`, `name`, `email`, `actcode`, `spin`) VALUES
(2, 'Thao', 'pthao@e.ntu.edu.sg', '8C29176CFB80348100FD670', 0),
(6, 'Phuong Potter', 'nhat002@e.ntu.edu.sg', '4D34137E6638560000CD44B', 0),
(8, 'Tho Mit', 'phuongth001@e.ntu.edu.sg', 'C98807061449876100D9EC4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `male_particiant`
--

CREATE TABLE IF NOT EXISTS `male_particiant` (
  `id` int(11) NOT NULL COMMENT 'Auto increasing',
  `name` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `male_particiant`
--

INSERT INTO `male_particiant` (`id`, `name`, `email`) VALUES
(1, 'Ngo Le Bao Trung', 'lebaotru001@e.ntu.edu.sg'),
(3, 'Ngo Le Bao Loc', 'lebaoloc001@e.ntu.edu.sg'),
(4, 'Tran Vu Xuan Nhat', 'nhat002@e.ntu.edu.sg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ladies`
--
ALTER TABLE `ladies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `male_particiant`
--
ALTER TABLE `male_particiant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto increasing',AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ladies`
--
ALTER TABLE `ladies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto increasing',AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `male_particiant`
--
ALTER TABLE `male_particiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increasing',AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
