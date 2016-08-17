-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1 
-- Generation Time: Jul 27, 2016 at 09:38 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4
 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; 
SET time_zone = "+00:00"; 


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */; 

--
-- Database: `stickman3db`
--

-- --------------------------------------------------------
 
--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `alias` varchar(50) NOT NULL,
  `postid` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(11) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `imagepath` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `alias` varchar(50) NOT NULL,
  `postid` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `alias` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`alias`, `password`, `fname`, `lname`, `email`) VALUES
('jwelch', 'password', 'james', 'welch', 'jw576608@southeast.edu'),
('cmayhew', 'password', 'connor', 'mayhew', 'cm544014@southeast.edu'),
('kallgood', 'password', 'keenan', 'allgood', 'ka454295@southeast.edu'),
('astutzman', 'password', 'austin', 'stutzman', 'stuzguy@gmail.com'),
('fscott', 'password', 'fred', 'scott', 'FScott@southeast.edu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `alias` (`alias`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`alias`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
