-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2013 at 07:41 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch_master`
--

CREATE TABLE IF NOT EXISTS `batch_master` (
  `batch_id` int(20) NOT NULL AUTO_INCREMENT,
  `batch_name` varchar(255) NOT NULL,
  `feedback_no` int(2) NOT NULL,
  PRIMARY KEY (`batch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `batch_master`
--

INSERT INTO `batch_master` (`batch_id`, `batch_name`, `feedback_no`) VALUES
(1, 'Jun07', 2),
(2, 'Aug08', 1),
(3, 'Feb09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `branch_master`
--

CREATE TABLE IF NOT EXISTS `branch_master` (
  `b_id` int(20) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(255) NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `branch_master`
--

INSERT INTO `branch_master` (`b_id`, `b_name`) VALUES
(1, 'ANT'),
(2, 'AST'),
(3, 'VLSI'),
(4, 'ITM'),
(5, 'BM');

-- --------------------------------------------------------

--
-- Table structure for table `division_master`
--

CREATE TABLE IF NOT EXISTS `division_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `division` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `division_master`
--

INSERT INTO `division_master` (`id`, `division`) VALUES
(1, 'Class A'),
(2, 'Class B'),
(4, 'Class C');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_master`
--

CREATE TABLE IF NOT EXISTS `faculty_master` (
  `f_id` int(20) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `b_id` int(20) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `faculty_master`
--

INSERT INTO `faculty_master` (`f_id`, `f_name`, `l_name`, `b_id`) VALUES
(1, 'Mr. Nilesh', 'Deshmukh', 1),
(2, 'Mr. Rayan', 'Goudar', 1),
(3, 'Ms.Sahana', 'Bhosale', 1),
(4, 'Dr. Bharat', 'Chaudary', 1),
(5, 'Mr. Ravindra', 'Joshi', 1),
(6, 'Ms. Shraddha', 'Kakartkar', 1),
(7, 'Ms. Anagha', 'Komawar', 2);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_master`
--

CREATE TABLE IF NOT EXISTS `feedback_master` (
  `feed_id` int(20) NOT NULL AUTO_INCREMENT,
  `roll_no` varchar(255) NOT NULL,
  `b_id` int(20) NOT NULL,
  `batch_id` int(20) NOT NULL,
  `feedback_no` int(20) NOT NULL,
  `sem_id` int(20) NOT NULL,
  `f_id` int(20) NOT NULL,
  `sub_id` int(20) NOT NULL,
  `division_id` int(10) NOT NULL,
  `ans1` int(20) NOT NULL,
  `ans2` int(20) NOT NULL,
  `ans3` int(20) NOT NULL,
  `ans4` int(20) NOT NULL,
  `ans5` int(20) NOT NULL,
  `ans6` int(20) NOT NULL,
  `ans7` int(20) NOT NULL,
  `ans8` int(20) NOT NULL,
  `ans9` int(20) NOT NULL,
  `ans10` int(20) NOT NULL,
  `remark` text NOT NULL,
  `feed_date` date NOT NULL,
  PRIMARY KEY (`feed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `feedback_master`
--

INSERT INTO `feedback_master` (`feed_id`, `roll_no`, `b_id`, `batch_id`, `feedback_no`, `sem_id`, `f_id`, `sub_id`, `division_id`, `ans1`, `ans2`, `ans3`, `ans4`, `ans5`, `ans6`, `ans7`, `ans8`, `ans9`,`ans10`, `remark`, `feed_date`) VALUES
(1, 'PGI08082255', 1, 2, 1, 2, 1, 2, 1, 8, 7, 6, 9, 5, 7, 5, 4, 6, 'this is test', '2009-03-18'),
(2, 'PGI08082266', 1, 2, 1, 2, 1, 2, 1, 6, 9, 8, 4, 5, 2, 3, 5, 7, 'this is test', '2009-03-18'),
(3, 'pgi08082268', 1, 2, 1, 2, 1, 2, 1, 5, 7, 8, 8, 9, 7, 6, 5, 7, '', '2009-03-18'),
(4, 'pgi08082268', 1, 2, 1, 2, 2, 5, 1, 7, 7, 8, 8, 9, 6, 5, 6, 7, '', '2009-03-18'),
(6, 'PGI08082266', 2, 2, 1, 1, 7, 10, 1, 9, 8, 6, 8, 5, 7, 8, 8, 4, 'this is the test ', '2009-03-18'),
(7, 'PIG08082245', 1, 2, 1, 2, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'this is the test', '2009-03-19'),
(8, 'PGI08082260', 1, 2, 1, 2, 1, 2, 1, 8, 9, 7, 9, 7, 8, 6, 5, 7, '', '2009-04-20'),
(9, 'PGI08082245', 1, 2, 1, 2, 1, 2, 1, 9, 7, 5, 8, 5, 7, 5, 9, 6, '', '2009-04-20'),
(10, 'PGI08082255', 1, 2, 1, 2, 4, 7, 1, 3, 4, 5, 6, 7, 8, 9, 4, 2, '', '2012-05-03'),
(11, 'PGI08082255', 1, 2, 1, 2, 1, 2, 2, 3, 4, 6, 8, 9, 3, 5, 2, 4, 'New division added', '2012-06-06'),
(12, 'PGI08082255', 1, 2, 1, 2, 1, 3, 1, 7, 4, 7, 5, 5, 7, 8, 9, 5, '', '2012-06-06'),
(13, '08082255998', 1, 2, 1, 1, 1, 1, 1, 5, 5, 3, 6, 7, 4, 3, 5, 3, 'test', '2013-01-24'),
(14, '08082255398', 1, 2, 1, 2, 1, 2, 1, 4, 2, 4, 5, 6, 8, 6, 4, 5, '', '2013-06-26'),
(15, '08082255348', 1, 2, 1, 2, 1, 2, 1, 8, 3, 2, 5, 6, 7, 4, 3, 2, '', '2013-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_para`
--

CREATE TABLE IF NOT EXISTS `feedback_para` (
  `para_id` int(1) NOT NULL,
  `batch_id` int(10) NOT NULL,
  `b_id` int(10) NOT NULL,
  `sem_id` int(10) NOT NULL,
  `division_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_para`
--

INSERT INTO `feedback_para` (`para_id`, `batch_id`, `b_id`, `sem_id`, `division_id`) VALUES
(1, 2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_ques_master`
--

CREATE TABLE IF NOT EXISTS `feedback_ques_master` (
  `q_id` int(20) NOT NULL AUTO_INCREMENT,
  `ques` varchar(255) NOT NULL,
  `one_word` varchar(255) NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `feedback_ques_master`
--

INSERT INTO `feedback_ques_master` (`q_id`, `ques`, `one_word`) VALUES
(1, 'Faculty was punctual in class.', 'Punctual '),
(2, 'Faculty was well prepared for the classes.', 'Well_prepared'),
(3, 'Faculty communication skill were good.', 'Communication'),
(4, 'Teaching methodology was good.', 'Methodology '),
(5, 'Faculty had clearly defined objectives for each class.', 'Defined_objectives'),
(6, 'Faculty adequately cleared all my doubts and was helpful in solving queries.', 'Solving_queries'),
(7, 'Faculty treated me with respect and aided in my learning.', 'Respected'),
(8, 'Faculty was instrumental in the value addition process.', 'Instrumental_use'),
(9, 'In my opinion the same faculty should be continued for such subjects.', 'Be_continued');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`username`, `password`) VALUES
('admin', '*00A51F3F48415C7D4E8908980D443C29C69B60C9');

-- --------------------------------------------------------

--
-- Table structure for table `semester_master`
--

CREATE TABLE IF NOT EXISTS `semester_master` (
  `sem_id` int(20) NOT NULL AUTO_INCREMENT,
  `sem_name` varchar(255) NOT NULL,
  PRIMARY KEY (`sem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `semester_master`
--

INSERT INTO `semester_master` (`sem_id`, `sem_name`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III'),
(4, 'IV');

-- --------------------------------------------------------

--
-- Table structure for table `subject_master`
--

CREATE TABLE IF NOT EXISTS `subject_master` (
  `sub_id` int(20) NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(255) NOT NULL,
  `sem_id` int(20) NOT NULL,
  `f_id` int(20) NOT NULL,
  `batch_id` int(20) NOT NULL,
  `division_id` int(10) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `subject_master`
--

INSERT INTO `subject_master` (`sub_id`, `sub_name`, `sem_id`, `f_id`, `batch_id`, `division_id`) VALUES
(1, 'RAP', 1, 1, 2, 1),
(2, 'NMS', 2, 1, 2, 1),
(3, 'Linux Archi.', 2, 1, 2, 1),
(4, 'PM', 1, 2, 2, 1),
(5, 'NP', 2, 2, 2, 2),
(6, 'Wireless Comm.', 1, 4, 2, 1),
(7, 'Wireless LAN', 2, 4, 2, 2),
(8, 'CCN', 1, 5, 2, 1),
(9, 'ND&O', 2, 5, 2, 2),
(10, 'Database', 1, 7, 2, 1);
