-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2015 at 07:54 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blacklist`
--

INSERT INTO `blacklist` (`id`, `email`) VALUES
(2, 'nhat002@e.ntu.edu.sg'),
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
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(10) unsigned NOT NULL COMMENT 'Auto increasing',
  `job` text NOT NULL,
  `descr` text NOT NULL COMMENT 'Description of the job'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `job`, `descr`) VALUES
(2, 'Lam ban trai', 'Lam ban trai tam thoi trong vong mot ngay'),
(3, 'Giat do', 'Giat quan ao cho ban');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='Store the info of female participants';

--
-- Dumping data for table `ladies`
--

INSERT INTO `ladies` (`id`, `name`, `email`, `actcode`, `spin`) VALUES
(2, 'Thao', 'pthao@e.ntu.edu.sg', '8C29176CFB80348100FD670', 0),
(6, 'Nhat', 'nguyenhu002@e.ntu.edu.sg', '4D34137E6638560000CD44B', 0),
(8, 'Tho Mit', 'phuongth001@e.ntu.edu.sg', 'C98807061449876100D9EC4', 0),
(9, 'Xuan Nhat', 'lailanhatday@e.ntu.edu.sg', 'C98807061449876100D9EC6', 0),
(10, 'hihiihi', 'hihihi@e.ntu.edu.sg', 'C66761430798301300AF583', 0);

-- --------------------------------------------------------

--
-- Table structure for table `male_participant`
--

CREATE TABLE IF NOT EXISTS `male_participant` (
  `id` int(11) NOT NULL COMMENT 'Auto increasing',
  `name` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `male_participant`
--

INSERT INTO `male_participant` (`id`, `name`, `email`) VALUES
(1, 'Ngo Le Bao Trung', 'lebaotru001@e.ntu.edu.sg'),
(3, 'Ngo Le Bao Loc', 'lebaoloc001@e.ntu.edu.sg'),
(4, 'Thai Nguyen Hung', 'nguyenhu002@e.ntu.edu.sg'),
(6, 'Nguyen Phan Huy', 'huy002@e.ntu.edu.sg');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `id` int(11) NOT NULL COMMENT 'Auto increasing',
  `femaleid` int(11) NOT NULL,
  `maleid` int(11) NOT NULL,
  `jobid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `femaleid`, `maleid`, `jobid`) VALUES
(1, 6, 4, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ladies`
--
ALTER TABLE `ladies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `male_participant`
--
ALTER TABLE `male_participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto increasing',AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto increasing',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ladies`
--
ALTER TABLE `ladies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Auto increasing',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `male_participant`
--
ALTER TABLE `male_participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increasing',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increasing',AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
