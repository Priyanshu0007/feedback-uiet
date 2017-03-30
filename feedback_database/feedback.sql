-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 03, 2016 at 03:23 PM
-- Server version: 5.5.27
-- PHP Version: 5.3.0

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
(1, 'Jun16', 2),
(2, 'Aug16', 1),
(3, 'Feb16', 1);

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
(1, 'IT'),
(2, 'CSE'),
(3, 'ECE'),
(4, 'MECH'),
(5, 'ELEC');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `faculty_master`
--

INSERT INTO `faculty_master` (`f_id`, `f_name`, `l_name`, `b_id`) VALUES
(1, 'Mr. Ram', 'Kumar', 1),
(2, 'Mr. Ajay', 'Gupta', 1);

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
  `ans11` int(20) NOT NULL,
  `ans12` int(20) NOT NULL,
  `ans13` int(20) NOT NULL,
  `ans14` int(20) NOT NULL,
  `ans15` int(20) NOT NULL,
  `ans16` int(20) NOT NULL,
  `remark` text NOT NULL,
  `feed_date` date NOT NULL,
  PRIMARY KEY (`feed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `feedback_master`
--

INSERT INTO `feedback_master` (`feed_id`, `roll_no`, `b_id`, `batch_id`, `feedback_no`, `sem_id`, `f_id`, `sub_id`, `division_id`, `ans1`, `ans2`, `ans3`, `ans4`, `ans5`, `ans6`, `ans7`, `ans8`, `ans9`, `ans10`, `ans11`, `ans12`, `ans13`, `ans14`, `ans15`, `ans16`, `remark`, `feed_date`) VALUES
(35, 'ue127990', 1, 2, 1, 1, 1, 1, 1, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 0, 0, 0, 0, 0, '', '2016-10-03'),
(36, 'ue127993', 1, 2, 1, 1, 2, 4, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 0, 0, 0, 0, 0, '', '2016-10-03'),
(37, 'ue127989', 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 0, 0, 0, 0, 0, 'mhb', '2016-10-03'),
(38, 'ue127988', 1, 2, 1, 1, 1, 1, 1, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0, 'nklnlknlk', '2016-10-03'),
(39, 'ue127999', 1, 2, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 0, 0, 0, 0, 0, 'gkjbj', '2016-10-03'),
(40, 'ue127954', 1, 2, 1, 1, 1, 1, 1, 1, 2, 3, 4, 3, 2, 2, 3, 3, 3, 2, 0, 0, 0, 0, 0, 'wref', '2016-10-03'),
(41, 'ue127933', 1, 2, 1, 1, 2, 4, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 'vsfv', '2016-10-03'),
(42, 'ue127983', 1, 2, 1, 1, 2, 4, 1, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 2, 2, 2, 2, 2, 1, 'fewag', '2016-10-03');

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
(1, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_ques_master`
--

CREATE TABLE IF NOT EXISTS `feedback_ques_master` (
  `q_id` int(20) NOT NULL AUTO_INCREMENT,
  `ques` varchar(255) NOT NULL,
  `one_word` varchar(255) NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `feedback_ques_master`
--

INSERT INTO `feedback_ques_master` (`q_id`, `ques`, `one_word`) VALUES
(1, 'The teacher completes the entire syllabus in time.', 'InTime'),
(2, 'The teacher has subject knowledge.', 'knowledge'),
(3, 'The teacher communicates clearly and inspires my by his/her teaching.', 'Communication'),
(4, 'The teacher is punctual in class.', 'punctual'),
(5, 'The teacher comes well prepared in class.', 'wellprepared'),
(6, 'The teacher encourages participation and discussion in class.', 'participate'),
(7, 'The teacher uses teaching aids, handouts, gives suitable references, make presentations and conducts seminars/tutorials etc.', 'notes'),
(8, 'The teacher attitude towards students is friendly and helpful.', 'friendly'),
(9, 'The teacher is available and accessible in the department.', 'accessible'),
(10, 'The evaluation process is fair and unbiased', 'fairness');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `semester_master`
--

INSERT INTO `semester_master` (`sem_id`, `sem_name`) VALUES
(1, 'I'),
(2, 'II'),
(5, 'III'),
(6, 'IV');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `subject_master`
--

INSERT INTO `subject_master` (`sub_id`, `sub_name`, `sem_id`, `f_id`, `batch_id`, `division_id`) VALUES
(1, 'WC', 1, 1, 2, 1),
(2, 'OS', 2, 1, 2, 1),
(3, 'Linux', 2, 1, 2, 1),
(4, 'CC', 1, 2, 2, 1),
(5, 'DSP', 2, 2, 2, 2);
