-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 12:25 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csi`
--

-- --------------------------------------------------------

--
-- Table structure for table `csi_aboutus`
--

CREATE TABLE `csi_aboutus` (
  `id` int(11) NOT NULL,
  `photo` varchar(256) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_aboutus`
--

INSERT INTO `csi_aboutus` (`id`, `photo`, `description`) VALUES
(1, '60e7d891592689.54358572.jpg', 'CSI SAKEC was formed in the year 2007. From then it\r\n						has successively grown to one of the strongest student\r\n						chapters of SAKEC. CS1 SAKEC has always lived upon\r\n						its motto of:\r\n						“BUILDING TECHNICAL SKILLS PROFESSIONALLY1’\r\n						in the past, CS1 SAKEC has been conducting various\r\n						workshops, seminars and visits with the help of\r\n						technically sound students for the benefit of SAKEC as\r\n						well as Non SAKEC students. Student Council of CS1\r\n						SAKEC includes different teams such as Design,\r\n						Treasury, Registration, Technical, Events,\r\n						Documentation and Publicity. These teams collectively\r\n						work for all the events conducted by CS1 SAKEC under\r\n						the guidance of Staff Coordinators for the benefit of all\r\n						the members');

-- --------------------------------------------------------

--
-- Table structure for table `csi_collaboration`
--

CREATE TABLE `csi_collaboration` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `collab_body` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_collaboration`
--

INSERT INTO `csi_collaboration` (`id`, `event_id`, `collab_body`) VALUES
(1, 40, 'computer engineering'),
(2, 47, 'ieee'),
(3, 48, 'ieee'),
(4, 48, 'ipr');

-- --------------------------------------------------------

--
-- Table structure for table `csi_collection`
--

CREATE TABLE `csi_collection` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_photo` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `confirmed` tinyint(4) NOT NULL,
  `confirmed_by` varchar(255) NOT NULL,
  `attend` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_collection`
--

INSERT INTO `csi_collection` (`id`, `event_id`, `user_id`, `bill_photo`, `amount`, `confirmed`, `confirmed_by`, `attend`) VALUES
(32, 43, 1, NULL, 0, 1, 'auto', 1),
(34, 43, 16, NULL, 0, 1, 'auto', 1),
(35, 43, 72, NULL, 0, 1, 'auto', 1),
(39, 43, 17, NULL, 0, 1, 'auto', 1),
(40, 43, 18, NULL, 0, 1, 'auto', 1),
(41, 43, 19, NULL, 0, 1, 'auto', 1),
(42, 43, 20, NULL, 0, 1, 'auto', 1),
(43, 43, 21, NULL, 0, 1, 'auto', 0),
(44, 43, 22, NULL, 0, 1, 'auto', 0),
(45, 43, 23, NULL, 0, 1, 'auto', 0),
(46, 43, 24, NULL, 0, 1, 'auto', 0),
(47, 43, 25, NULL, 0, 1, 'auto', 0),
(48, 43, 26, NULL, 0, 1, 'auto', 0),
(49, 43, 27, NULL, 0, 1, 'auto', 0),
(50, 43, 28, NULL, 0, 1, 'auto', 0),
(51, 43, 29, NULL, 0, 1, 'auto', 0),
(52, 43, 30, NULL, 0, 1, 'auto', 0),
(53, 43, 31, NULL, 0, 1, 'auto', 1),
(54, 43, 32, NULL, 0, 1, 'auto', 0),
(55, 43, 33, NULL, 0, 1, 'auto', 0),
(56, 43, 34, NULL, 0, 1, 'auto', 0),
(57, 43, 35, NULL, 0, 1, 'auto', 0),
(58, 43, 36, NULL, 0, 1, 'auto', 0),
(60, 43, 37, NULL, 0, 1, 'auto', 0),
(61, 43, 38, NULL, 0, 1, 'auto', 0),
(62, 43, 39, NULL, 0, 1, 'auto', 1),
(63, 43, 40, NULL, 0, 1, 'auto', 0),
(64, 43, 41, NULL, 0, 1, 'auto', 0),
(65, 43, 57, NULL, 0, 1, 'auto', 0),
(66, 43, 58, NULL, 0, 1, 'auto', 0),
(67, 43, 59, NULL, 0, 1, 'auto', 0),
(68, 43, 60, NULL, 0, 1, 'auto', 0),
(69, 43, 61, NULL, 0, 1, 'auto', 0),
(70, 43, 62, NULL, 0, 1, 'auto', 0),
(71, 43, 63, NULL, 0, 1, 'auto', 0),
(72, 43, 64, NULL, 0, 1, 'auto', 1),
(73, 43, 65, NULL, 0, 1, 'auto', 1),
(74, 43, 66, NULL, 0, 1, 'auto', 0),
(75, 43, 67, NULL, 0, 1, 'auto', 1),
(76, 43, 68, NULL, 0, 1, 'auto', 0),
(77, 43, 69, NULL, 0, 1, 'auto', 1),
(78, 43, 70, NULL, 0, 1, 'auto', 1),
(95, 47, 89, '60df83f2abb561.41638877.png', 50, 1, 'c@sakec.ac.in', 0),
(97, 40, 89, '60e4571e3d71f2.43017541.jpg', 50, 1, 'c@sakec.ac.in', 0),
(98, 49, 89, '60e7e6a67999f1.93009851.png', 3000, 1, 'c@sakec.ac.in', 0);

-- --------------------------------------------------------

--
-- Table structure for table `csi_contact`
--

CREATE TABLE `csi_contact` (
  `id` int(11) NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `c_phonenumber` bigint(11) NOT NULL,
  `event_id` int(250) NOT NULL,
  `c_type` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_contact`
--

INSERT INTO `csi_contact` (`id`, `c_name`, `c_phonenumber`, `event_id`, `c_type`) VALUES
(11, 'Dhruvi Jain', 2147483647, 40, 0),
(12, 'Pratik Upadhyay', 2147483647, 41, 0),
(13, 'Bhavya Haria', 2147483647, 42, 0),
(14, 'Yukta Lapsiya', 2147483647, 43, 0),
(18, 'Aditya Shah', 999999999, 47, 0),
(19, 'dhiraj', 2147483647, 48, 0),
(20, 'israil', 9999999998, 49, 0),
(21, 'Rahul Soni', 9999999999, 47, 1);

-- --------------------------------------------------------

--
-- Table structure for table `csi_contentrepository`
--

CREATE TABLE `csi_contentrepository` (
  `id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_contentrepository`
--

INSERT INTO `csi_contentrepository` (`id`, `eventid`, `image`) VALUES
(17, 40, '60c5e787b52877.83501876.jpeg'),
(18, 40, '60c5e787b64315.82547545.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `csi_coordinator`
--

CREATE TABLE `csi_coordinator` (
  `id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `duty` varchar(50) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_coordinator`
--

INSERT INTO `csi_coordinator` (`id`, `name`, `duty`, `image`) VALUES
(1, 'Dhruvi Jain', 'General Secreatary', 'Dhruvi-jain.jpg'),
(2, 'Yukta Lapsiya', 'GENERAL COORDINATOR', 'Yukta Lapsiya.jpg'),
(3, 'Pratik upadhyay', 'STUDENT COORDINATOR', 'Pratik-upadhyaya.jpg'),
(4, 'Aagam Sheth', 'Events Team Head', 'Aagam-sheth.jpeg'),
(5, 'Krutik Patel', 'EVENTS TEAM CO-HEAD', 'Krutik-patel.jpg'),
(6, 'Preet Karia', 'TECHNICAL TEAM HEAD', 'Preet-karia.jpg'),
(7, 'Rutvik Deshpande', 'technical team CO-HEAD', 'Rutvik-dashpande.jpg'),
(8, 'Ritik Mahajan', 'publicity team head', 'Ritik Mahajan.jpg'),
(9, 'Ridhi Dagha', 'REGISTRATION AND TREASURE TEAM treasurer', 'Ridhhi-dagha.jpeg'),
(10, 'Shalin Gund', 'REGISTRATION AND TREASURE TEAM head1', 'Shalini-gund.jpg'),
(11, 'Simran Jindal', 'REGISTRATION AND TREASURE TEAM head1', 'Simran-jindal.jpg'),
(12, 'Zarana Desai', 'Documentation team head', 'Zarana-desai.jpg'),
(13, 'Parth Panchal', 'design team head1', 'Parth-panchal.jpg'),
(14, 'Atharva Juikar', 'design team head2', 'Atharva Juikar.jpg'),
(15, 'Bhavika Salshingikar', 'Design team co-head1', 'Bhavika-salshingikar.jpg'),
(16, 'Ritika Boricha', 'Design team co-head2', 'Ritika-boricha.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `csi_event`
--

CREATE TABLE `csi_event` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `banner` varchar(256) NOT NULL,
  `e_from_date` date NOT NULL,
  `e_to_date` date NOT NULL,
  `e_from_time` time NOT NULL,
  `e_to_time` time NOT NULL,
  `e_description` text NOT NULL,
  `fee_m` int(5) NOT NULL,
  `fee` int(5) NOT NULL,
  `live` tinyint(1) NOT NULL,
  `feedback` tinyint(4) NOT NULL,
  `selfie` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_event`
--

INSERT INTO `csi_event` (`id`, `title`, `subtitle`, `banner`, `e_from_date`, `e_to_date`, `e_from_time`, `e_to_time`, `e_description`, `fee_m`, `fee`, `live`, `feedback`, `selfie`) VALUES
(40, 'Tensorflow', 'Introduction To ML with TENSORFLOW 2.0', 'TENSORFLOW.jpg', '2019-08-23', '2019-08-10', '09:00:00', '05:00:00', 'Topics covered were TensorFlow 2.0 framework (TensorFlow is a general purpose high-performance computing library open sourced by Google in 2015), Introduction to machine learning, where it is used and how it is implemented, What is tensor and how the name was given, How to integrate it in code, Hands on tensorflow (Image recognition),Creating neural network & Gathering dataset, Using Jupyter to share code, data cleaning and transformation. ', 50, 50, 1, 1, 0),
(41, 'Introduction with IOT', 'Introduction with IOT with NODE MCU', ' nodemcu.jpg', '2019-08-30', '2019-08-31', '09:00:00', '05:00:00', 'Topics covered were: Introduction to IoT, Basics of NodeMCU, Configuring LEDs with NodeMCU, using different sensors like DHT11, LDRs, IRs & IR-Remote, NodeMCU as a Server & Google Assistant using NodeMCU. ', 150, 200, 1, 1, 0),
(42, 'Pune Outbound', 'Outbound', 'outbound.jpg', '2019-09-20', '2019-09-21', '06:00:00', '06:00:00', 'On Day 1, We visited Lenze Mechatronics Private Limited. The main parent company is from Germany and all their major operations run from there. We were shown Servo Motors, Gearboxes, AC Drive, PLC, I/O Systems.\nOn Day 2, we visited Vasaya Foods Pvt Ltd which is a company that produces potato chips and snacks.', 2350, 2500, 1, 1, 0),
(43, 'Software Conceptual Design', 'Software Conceptual Design', ' softwaredevelopment.jpg', '2021-07-03', '2021-07-03', '09:00:00', '05:00:00', ' How the design is successful in combining the pros of each separate diagram while overcoming their flaws. The platform was beginner friendly and provided help with a personal assistant of its own for every phase. Students were allowed to explore the platform independently based on a problem statement and they were able to grasp the concepts quickly and designed their own FBS diagrams during the workshop. The feedback interview was like a conversation where students actively took part in to discuss about the difficulties faced as a beginner and provided their opinion on improvements. ', 0, 0, 1, 1, 0),
(47, 'Tensorflow2', 'Introduction To ML with TENSORFLOW 2.0', 'TENSORFLOW.jpg', '2021-07-04', '2021-07-04', '10:50:00', '12:50:00', 'Topics covered were TensorFlow 2.0 framework (TensorFlow is a general purpose high-performance computing library open sourced by Google in 2015), Introduction to machine learning, where it is used and how it is implemented, What is tensor and how the name was given, How to integrate it in code, Hands on tensorflow (Image recognition),Creating neural network & Gathering dataset, Using Jupyter to share code, data cleaning and transformation. ', 50, 200, 1, 1, 0),
(48, 'Tensorflow3', 'Introduction To ML with TENSORFLOW 2.0', 'TENSORFLOW.jpg', '2021-07-05', '2021-07-05', '22:15:00', '03:26:00', 'Topics covered were TensorFlow 2.0 framework (TensorFlow is a general purpose high-performance computing library open sourced by Google in 2015), Introduction to machine learning, where it is used and how it is implemented, What is tensor and how the name was given, How to integrate it in code, Hands on tensorflow (Image recognition),Creating neural network & Gathering dataset, Using Jupyter to share code, data cleaning and transformation. ', 200, 500, 1, 1, 0),
(49, 'Outbound', 'outbound', 'outbound.jpg', '2021-08-06', '2021-08-06', '22:20:00', '03:30:00', 'On Day 1, We visited Lenze Mechatronics Private Limited. The main parent company is from Germany and all their major operations run from there. We were shown Servo Motors, Gearboxes, AC Drive, PLC, I/O Systems.\nOn Day 2, we visited Vasaya Foods Pvt Ltd which is a company that produces potato chips and snacks.', 3000, 5000, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `csi_expense`
--

CREATE TABLE `csi_expense` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `spent_on` varchar(256) NOT NULL,
  `by` varchar(256) NOT NULL,
  `bill_photo` text NOT NULL,
  `bill_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_expense`
--

INSERT INTO `csi_expense` (`id`, `event_id`, `spent_on`, `by`, `bill_photo`, `bill_amount`) VALUES
(24, 40, 'pen', 'aditya.shah_19@sakec.ac.in', 'bill PO.png', 150),
(25, 40, 'book', 'aditya.shah_19@sakec.ac.in', '60c5aabd20e615.59719138.png', 10),
(26, 40, 'book 2', 'aditya.shah_19@sakec.ac.in', '60c5ab28dab3f2.82965889.png', 50),
(27, 41, 'book 3', 'aditya.shah_19@sakec.ac.in', '60c5ab28dcd876.74772786.jpg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `csi_feedback`
--

CREATE TABLE `csi_feedback` (
  `id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `Q1` int(11) NOT NULL,
  `Q2` int(11) NOT NULL,
  `Q3` int(11) NOT NULL,
  `Q4` int(11) NOT NULL,
  `Q5` int(11) NOT NULL,
  `Q6` int(11) NOT NULL,
  `Q7` varchar(10) NOT NULL,
  `any_queries` varchar(255) NOT NULL,
  `selfie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_feedback`
--

INSERT INTO `csi_feedback` (`id`, `collection_id`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `any_queries`, `selfie`) VALUES
(34, 98, 3, 4, 3, 3, 3, 2, 'slow', 'NO', '');

-- --------------------------------------------------------

--
-- Table structure for table `csi_gallery`
--

CREATE TABLE `csi_gallery` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_gallery`
--

INSERT INTO `csi_gallery` (`id`, `image`, `status`) VALUES
(59, 'gal-1.jpg', 1),
(60, 'gal-2.jpg', 1),
(61, 'gal-3.jpg', 1),
(62, 'gal-4.jpg', 1),
(63, 'gal-5.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `csi_membership`
--

CREATE TABLE `csi_membership` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dob` date DEFAULT NULL,
  `primaryEmail` varchar(50) NOT NULL,
  `startingYear` year(4) DEFAULT NULL,
  `passingYear` year(4) DEFAULT NULL,
  `r_number` int(11) NOT NULL,
  `duration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_membership`
--

INSERT INTO `csi_membership` (`id`, `userid`, `dob`, `primaryEmail`, `startingYear`, `passingYear`, `r_number`, `duration`) VALUES
(11, 90, NULL, '', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `csi_membership_bills`
--

CREATE TABLE `csi_membership_bills` (
  `id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `bill_photo` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `membership_taken` datetime NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `csi_newsletter`
--

CREATE TABLE `csi_newsletter` (
  `id` int(11) NOT NULL,
  `emailid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_newsletter`
--

INSERT INTO `csi_newsletter` (`id`, `emailid`) VALUES
(1, 'aditya.shah_19@sakec.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `csi_query`
--

CREATE TABLE `csi_query` (
  `id` int(11) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_query` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_query`
--

INSERT INTO `csi_query` (`id`, `c_email`, `c_query`) VALUES
(18, 'c@sakec.ac.in', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `csi_reply`
--

CREATE TABLE `csi_reply` (
  `id` int(11) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `c_query` varchar(8000) NOT NULL,
  `reply` varchar(8000) NOT NULL,
  `replied_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_reply`
--

INSERT INTO `csi_reply` (`id`, `c_email`, `c_query`, `reply`, `replied_by`) VALUES
(1, 'aditya.shah_19@sakec.ac.in', 'how to login', 'signup first', 'c@sakec.ac.in'),
(14, 'aditya.shah_19@sakec.ac.in', 'hello', 'ok', 'aditya.shah_19@sakec.ac.in'),
(15, 'aditya.shah_19@sakec.ac.in', 'how to login', 'test123', 'aditya.shah_19@sakec.ac.in'),
(16, 'c@sakec.ac.in', 'Hello', 'hi', 'c@sakec.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `csi_role`
--

CREATE TABLE `csi_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_role`
--

INSERT INTO `csi_role` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'head coordinator'),
(3, 'coordinator'),
(4, 'teacher'),
(5, 'member'),
(6, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `csi_speaker`
--

CREATE TABLE `csi_speaker` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `organisation` varchar(50) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `linkedIn` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_speaker`
--

INSERT INTO `csi_speaker` (`id`, `event_id`, `name`, `organisation`, `profession`, `description`, `photo`, `linkedIn`, `facebook`, `instagram`) VALUES
(1, 47, 'dhiraj', 'sakec', 'developer', 'abc', '60d1c3dd095b22.38584146.jpg', 'https://www.linkedin.com/in/aditya-shah539/', '', ''),
(2, 48, 'dhiraj shetty', 'sakec', 'developer', 'xyz', '60c5e787b52877.83501876.jpeg', 'www.linkedin.com/in/aditya-shah539', '', ''),
(3, 48, 'aditya shah', 'sakec', 'programmer', 'abc', '60c5e787b64315.82547545.jpg', 'www.linkedin.com/in/aditya-shah539', '', ''),
(4, 48, 'israil', 'sakec', 'developer', 'xyz', '60c5e787b52877.83501876.jpeg', 'www.linkedin.com/in/aditya-shah539', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `csi_userdata`
--

CREATE TABLE `csi_userdata` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `year` varchar(5) NOT NULL,
  `division` varchar(10) NOT NULL,
  `rollNo` int(10) NOT NULL,
  `emailID` varchar(50) NOT NULL,
  `phonenumber` bigint(10) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `csi_role` int(15) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_userdata`
--

INSERT INTO `csi_userdata` (`id`, `firstName`, `middleName`, `lastName`, `year`, `division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `password`, `csi_role`, `gender`) VALUES
(1, 'Aditya', 'asa', 'Shah', 'SE', '3', 60, 'aditya.shah_19@sakec.ac.in', 9372622462, 'IT', '123', 1, ''),
(2, 'rahul', '', 'soni', '', '', 0, 'rahul.soni_19@sakec.ac.in', 1234567890, 'CS', '456', 6, ''),
(10, 'israil', '', 'alam', '', '', 0, 'mo.israil.alam_19@sakec.ac.in', 7894561239, 'CS', '753', 2, ''),
(16, 'anand', '', 'tiwari', '', '', 0, 'anand.tiwari_19@sakec.ac.in ', 999999995, 'AI', '123', 6, ''),
(17, 'shubham', '', 'shah', '', '', 0, 'shubham.shah_19@sakec.ac.in ', 999999994, 'ECS', '123', 6, ''),
(18, 'saivighnesh', '', 'shetty', '', '', 0, 'saivighnesh.shetty_19@sakec.ac.in ', 999999993, 'CYBER', '123', 6, ''),
(19, 'agam', '', 'alam', '', '', 0, 'agam.alam_19@sakec.ac.in ', 999999992, 'EXTER', '123', 6, ''),
(20, 'rohan', '', 'soni', '', '', 0, 'rohan.soni_19@sakec.ac.in ', 999999991, 'CS', '123', 6, ''),
(21, 'abhishekh', '', 'tiwari', '', '', 0, 'abhishekh.tiwari_19@sakec.ac.in ', 999999990, 'IT', '123', 6, ''),
(22, 'darshit', '', 'shah', '', '', 0, 'darshit.shah_19@sakec.ac.in ', 999999989, 'ELEC', '123', 6, ''),
(23, 'omprateek', '', 'shetty', '', '', 0, 'omprateek.shetty_19@sakec.ac.in ', 999999988, 'EXTC', '123', 6, ''),
(24, 'anant', '', 'alam', '', '', 0, 'anant.alam_19@sakec.ac.in ', 999999987, 'AI', '123', 6, ''),
(25, 'stuti', '', 'soni', '', '', 0, 'stuti.soni_19@sakec.ac.in ', 999999986, 'ECS', '123', 6, ''),
(26, 'shweta', '', 'tiwari', '', '', 0, 'shweta.tiwari_19@sakec.ac.in ', 999999985, 'CYBER', '123', 6, ''),
(27, 'ameya', '', 'shah', '', '', 0, 'ameya.shah_19@sakec.ac.in ', 999999984, 'EXTER', '123', 6, ''),
(28, 'virat', '', 'shetty', '', '', 0, 'virat.shetty_19@sakec.ac.in ', 999999983, 'CS', '123', 6, ''),
(29, 'rohit', '', 'alam', '', '', 0, 'rohit.alam_19@sakec.ac.in ', 999999982, 'IT', '123', 6, ''),
(30, 'sikhar', '', 'soni', '', '', 0, 'sikhar.soni_19@sakec.ac.in ', 999999981, 'ELEC', '123', 6, ''),
(31, 'ashwin', '', 'tiwari', '', '', 0, 'ashwin.tiwari_19@sakec.ac.in ', 999999980, 'EXTC', '123', 6, ''),
(32, 'mahendra', '', 'shah', '', '', 0, 'mahendra.shah_19@sakec.ac.in ', 999999979, 'AI', '123', 6, ''),
(33, 'umesh', '', 'shetty', '', '', 0, 'umesh.shetty_19@sakec.ac.in ', 999999978, 'ECS', '123', 6, ''),
(34, 'messi', '', 'alam', '', '', 0, 'messi.alam_19@sakec.ac.in ', 999999977, 'CYBER', '123', 6, ''),
(35, 'bhuvenshwer', '', 'soni', '', '', 0, 'bhuvenshwer.soni_19@sakec.ac.in ', 999999976, 'EXTER', '123', 6, ''),
(36, 'shreyas', '', 'tiwari', '', '', 0, 'shreyas.tiwari_19@sakec.ac.in ', 999999975, 'CS', '123', 6, ''),
(37, 'bharat', '', 'shah', '', '', 0, 'bharat.shah_19@sakec.ac.in ', 999999974, 'IT', '123', 6, ''),
(38, 'harsh', '', 'shetty', '', '', 0, 'harsh.shetty_19@sakec.ac.in ', 999999973, 'ELECTRONIC', '123', 6, ''),
(39, 'hardik', '', 'alam', '', '', 0, 'hardik.alam_19@sakec.ac.in ', 999999972, 'EXTC', '123', 6, ''),
(40, 'krunal', '', 'soni', '', '', 0, 'krunal.soni_19@sakec.ac.in ', 999999971, 'AI', '123', 6, ''),
(41, 'abraham', '', 'tiwari', '', '', 0, 'abraham.tiwari_19@sakec.ac.in ', 999999970, 'ECS', '123', 6, ''),
(57, 'Dhruvi', '', 'Jain', '', '', 0, 'dhruvi.jain_17@sakec.ac.in', 9999999999, 'CS', '123', 2, ''),
(58, 'Yukta', '', 'Lapsiya', '', '', 0, 'yukta.lapsiya_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(59, 'Pratik', '', 'Upadhyay', '', '', 0, 'pratik.upadhyay_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(60, 'Aagam', '', 'Sheth', '', '', 0, 'aagam.sheth_19@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(61, 'Krutik', '', 'Patel', '', '', 0, 'krutik.patel_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(62, 'Preet', '', 'Karia', '', '', 0, 'preet.karia_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(63, 'Rutvik', '', 'Deshpande', '', '', 0, 'rutvik.deshpande_19@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(64, 'Ritik', '', 'Mahajan', '', '', 0, 'rutvik.mahajan_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(65, 'Ridhi', '', 'Dagha', '', '', 0, 'ridhi.dagha_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(66, 'Shalin', '', 'Gund', '', '', 0, 'shalin.gund_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(67, 'Simran ', '', 'Jindal', '', '', 0, 'simran.jindal_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(68, 'Zarana ', '', 'Desai', '', '', 0, 'zarana.desai_19@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(69, 'Parth ', '', 'Panchal', '', '', 0, 'parth.panchal_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(70, 'Atharva ', '', 'Juikar', '', '', 0, 'atharva.juikar_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(71, 'Bhavika ', '', 'Salshingikar', '', '', 0, 'bhavika.salshingikar_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(72, 'Ritika ', '', 'Boricha', '', '', 0, 'ritika.boricha_17@sakec.ac.in', 9999999999, 'CS', '123', 3, ''),
(89, 'Dhiraj', 'harish', 'shetty', 'TE', '3', 56, 'c@sakec.ac.in ', 9998887776, 'IT', '$2y$10$iYbhEjuZ9TQGWnziCVNH1.Q0NzwmuFvFyVDybeEgeLIo8VVNymHu2', 1, ''),
(90, 'Rahul', '', 'Lit', '', '', 0, 'sixnine@sakec.ac.in ', 6969696969, 'CS', '$2y$10$dt8CQgxhc1AZTHHGOXKblu188qhrcYadG2bmBPYTNdY5hUfaK886S', 6, ''),
(93, 'Dhiraj', 'Harish', 'Shetty', 'FE', '1', 57, 'dhiraj.shetty_19@sakec.ac.in', 1111111111, 'CS', '$2y$10$MPo.Gaz9dI2WZeuf7dcF7eGRn4AG7jKrqfjdC1R2vU5berY1TyEne', 6, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `csi_venue`
--

CREATE TABLE `csi_venue` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_venue`
--

INSERT INTO `csi_venue` (`id`, `event_id`, `location`) VALUES
(1, 47, '4th-Floor Seminar Hall');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `csi_aboutus`
--
ALTER TABLE `csi_aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csi_collaboration`
--
ALTER TABLE `csi_collaboration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `csi_collection`
--
ALTER TABLE `csi_collection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `csi_contact`
--
ALTER TABLE `csi_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `csi_contentrepository`
--
ALTER TABLE `csi_contentrepository`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eventid` (`eventid`);

--
-- Indexes for table `csi_coordinator`
--
ALTER TABLE `csi_coordinator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csi_event`
--
ALTER TABLE `csi_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csi_expense`
--
ALTER TABLE `csi_expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `csi_feedback`
--
ALTER TABLE `csi_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_id` (`collection_id`);

--
-- Indexes for table `csi_gallery`
--
ALTER TABLE `csi_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csi_membership`
--
ALTER TABLE `csi_membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `csi_membership_bills`
--
ALTER TABLE `csi_membership_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_id` (`membership_id`);

--
-- Indexes for table `csi_newsletter`
--
ALTER TABLE `csi_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csi_query`
--
ALTER TABLE `csi_query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csi_reply`
--
ALTER TABLE `csi_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csi_role`
--
ALTER TABLE `csi_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csi_speaker`
--
ALTER TABLE `csi_speaker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `csi_userdata`
--
ALTER TABLE `csi_userdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `csi_role` (`csi_role`);

--
-- Indexes for table `csi_venue`
--
ALTER TABLE `csi_venue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `csi_aboutus`
--
ALTER TABLE `csi_aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `csi_collaboration`
--
ALTER TABLE `csi_collaboration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `csi_collection`
--
ALTER TABLE `csi_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `csi_contact`
--
ALTER TABLE `csi_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `csi_contentrepository`
--
ALTER TABLE `csi_contentrepository`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `csi_coordinator`
--
ALTER TABLE `csi_coordinator`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `csi_event`
--
ALTER TABLE `csi_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `csi_expense`
--
ALTER TABLE `csi_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `csi_feedback`
--
ALTER TABLE `csi_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `csi_gallery`
--
ALTER TABLE `csi_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `csi_membership`
--
ALTER TABLE `csi_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `csi_membership_bills`
--
ALTER TABLE `csi_membership_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_newsletter`
--
ALTER TABLE `csi_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `csi_query`
--
ALTER TABLE `csi_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `csi_reply`
--
ALTER TABLE `csi_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `csi_role`
--
ALTER TABLE `csi_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `csi_speaker`
--
ALTER TABLE `csi_speaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `csi_userdata`
--
ALTER TABLE `csi_userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `csi_venue`
--
ALTER TABLE `csi_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `csi_collaboration`
--
ALTER TABLE `csi_collaboration`
  ADD CONSTRAINT `collaboration_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `csi_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_collection`
--
ALTER TABLE `csi_collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `csi_userdata` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `collection_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `csi_event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `csi_contact`
--
ALTER TABLE `csi_contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `csi_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_contentrepository`
--
ALTER TABLE `csi_contentrepository`
  ADD CONSTRAINT `contentrepository_ibfk_1` FOREIGN KEY (`eventid`) REFERENCES `csi_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_expense`
--
ALTER TABLE `csi_expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `csi_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_feedback`
--
ALTER TABLE `csi_feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `csi_collection` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_membership`
--
ALTER TABLE `csi_membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `csi_userdata` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_membership_bills`
--
ALTER TABLE `csi_membership_bills`
  ADD CONSTRAINT `csi_membership_bills_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `csi_membership` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_speaker`
--
ALTER TABLE `csi_speaker`
  ADD CONSTRAINT `speaker_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `csi_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_userdata`
--
ALTER TABLE `csi_userdata`
  ADD CONSTRAINT `userdata_ibfk_1` FOREIGN KEY (`csi_role`) REFERENCES `csi_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `csi_venue`
--
ALTER TABLE `csi_venue`
  ADD CONSTRAINT `venue_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `csi_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
