-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2016 at 01:45 PM
-- Server version: 5.1.73
-- PHP Version: 5.5.31

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stickman3db`
--
CREATE DATABASE `stickman3db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `stickman3db`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `alias` varchar(50) NOT NULL,
  `postid` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  KEY `alias` (`alias`),
  KEY `postid` (`postid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `postid` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `imagepath` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY (`postid`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `alias` varchar(50) NOT NULL,
  `postid` int(255) NOT NULL,
  `rating` int(11) NOT NULL,
  KEY `alias` (`alias`),
  KEY `postid` (`postid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `alias` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profilepic` varchar(255) NOT NULL DEFAULT 'user_blank.jpg',
  PRIMARY KEY (`alias`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`alias`, `password`, `fname`, `lname`, `email`, `profilepic`) VALUES
('astutzman', 'password', 'austin', 'stutzman', 'stuzguy@gmail.com', 'user_blank.jpg'),
('cmayhew', 'password', 'connor', 'mayhew', 'cm544014@southeast.edu', 'user_blank.jpg'),
('fscott', 'password', 'fred', 'scott', 'FScott@southeast.edu', 'user_blank.jpg'),
('jwelch', 'password', 'james', 'welch', 'jw576608@southeast.edu', 'user_blank.jpg'),
('kallgood', 'password', 'keenan', 'allgood', 'ka454295@southeast.edu', 'user_blank.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`alias`) REFERENCES `user` (`alias`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `post` (`postid`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`alias`) REFERENCES `user` (`alias`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`alias`) REFERENCES `user` (`alias`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `post` (`postid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
