-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2018 at 06:53 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `widget_corp`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `subject_id`, `menu_name`, `position`, `visible`, `content`) VALUES
(1, 1, 'History', 1, 1, 'This is the company History ... '),
(2, 1, 'Our Mission', 2, 1, 'Our Mission\r\n <b>statement</b> is ....'),
(3, 2, 'widget 2000', 1, 1, 'This is widget for the product .. '),
(4, 3, 'What You buy', 1, 1, 'this what you have'),
(5, 3, 'What You buy ||', 2, 1, 'this second </br>\r\n\r\ntime');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `position` int(11) NOT NULL,
  `visible` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `menu_name`, `position`, `visible`) VALUES
(1, 'About widget crop', 1, 1),
(2, 'Products', 2, 1),
(3, 'Service', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `img` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `img`) VALUES
(1, 'akram', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(2, 'ehab', '6b6277afcb65d33525545904e95c2fa240632660', ''),
(3, 'ehab', '6b6277afcb65d33525545904e95c2fa240632660', ''),
(11, 'kkkjk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(12, 'pe', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(13, 'pe', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(14, 'final', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'C:xampp	mpphp64D2.tmp'),
(15, 'aaa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(16, 'aaa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(17, 'aaa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(18, 'hhhh', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(20, 'hhh', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
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
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
