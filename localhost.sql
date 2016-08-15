-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2016 at 02:34 PM
-- Server version: 5.1.73
-- PHP Version: 5.5.31

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stickman3DB`
--
CREATE DATABASE `stickman3DB` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `stickman3DB`;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `alias` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`alias`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`alias`, `password`, `fname`, `lname`, `email`) VALUES
('jwelch', 'password', 'james', 'welch', 'jw576608@southeast.edu'),
('cmayhew', 'password', 'connor', 'mayhew', 'cm544014@southeast.edu'),
('kallgood', 'password', 'keenan', 'allgood', 'ka454295@southeast.edu'),
('astutzman', 'password', 'austin', 'stutzman', 'stuzguy@gmail.com'),
('fscott', 'password', 'fred', 'scott', 'FScott@southeast.edu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
