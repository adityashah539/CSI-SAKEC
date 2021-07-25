-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 01:13 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

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
(1, '60e55ac3bcfe36.74441960.jpg', 'CSI SAKEC was formed in the year 2007. From then it\r\n						has successively grown to one of the strongest student\r\n						chapters of SAKEC. CS1 SAKEC has always lived upon\r\n						its motto of:\r\n						“BUILDING TECHNICAL SKILLS PROFESSIONALLY1’\r\n						in the past, CS1 SAKEC has been conducting various\r\n						workshops, seminars and visits with the help of\r\n						technically sound students for the benefit of SAKEC as\r\n						well as Non SAKEC students. Student Council of CS1\r\n						SAKEC includes different teams such as Design,\r\n						Treasury, Registration, Technical, Events,\r\n						Documentation and Publicity. These teams collectively\r\n						work for all the events conducted by CS1 SAKEC under\r\n						the guidance of Staff Coordinators for the benefit of all\r\n						the members.');

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
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(49, 'Outbound', 'outbound', 'outbound.jpg', '2021-07-20', '2021-07-06', '22:20:00', '03:30:00', 'On Day 1, We visited Lenze Mechatronics Private Limited. The main parent company is from Germany and all their major operations run from there. We were shown Servo Motors, Gearboxes, AC Drive, PLC, I/O Systems.\nOn Day 2, we visited Vasaya Foods Pvt Ltd which is a company that produces potato chips and snacks.', 3000, 5000, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `csi_event_likes`
--

CREATE TABLE `csi_event_likes` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_event_likes`
--

INSERT INTO `csi_event_likes` (`id`, `event_id`, `user_id`) VALUES
(60, 48, 89),
(74, 47, 91),
(75, 43, 91),
(76, 48, 91),
(78, 49, 91),
(100, 47, 89),
(102, 43, 89),
(126, 40, 89),
(130, 49, 89),
(132, 41, 89),
(133, 42, 89);

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
(59, 'gal-1.jpg', 0),
(60, 'gal-2.jpg', 1),
(61, 'gal-3.jpg', 1),
(62, 'gal-4.jpg', 1),
(63, 'gal-5.jpg', 0);

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
  `no_of_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `csi_newsletter`
--

CREATE TABLE `csi_newsletter` (
  `id` int(11) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `vKey` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_newsletter`
--

INSERT INTO `csi_newsletter` (`id`, `emailid`, `vKey`, `status`) VALUES
(1, 'aditya.shah_19@sakec.ac.in', '', 0),
(4, 'dhirajshetty91@yahoo.com', 'd283254e5f77cd901791fcc03b3f64f8', 0),
(6, 'saivignesh.adepu_19@sakec.ac.in', 'c10c2574aab1d83b0d67c0258e8ce4b1', 0),
(8, 'rahul.soni_19@sakec.ac.in', '4aa1f530a47d879a4db718fdf10aff8a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `csi_password`
--

CREATE TABLE `csi_password` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(6, 'israil.alam_19@sakec.ac.in', 'How to upload the photos'),
(15, 'aditya.shah_19@sakec.ac.in', 'how to login');

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
(14, 'aditya.shah_19@sakec.ac.in', 'hello', 'ok', 'aditya.shah_19@sakec.ac.in'),
(15, 'aditya.shah_19@sakec.ac.in', 'how to login', 'test123', 'aditya.shah_19@sakec.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `csi_role`
--

CREATE TABLE `csi_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(256) NOT NULL,
  `main_page_edit` tinyint(4) NOT NULL DEFAULT 0,
  `user_data` tinyint(4) NOT NULL DEFAULT 0,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `add_event` tinyint(4) NOT NULL DEFAULT 0,
  `budget` tinyint(4) NOT NULL DEFAULT 0,
  `manage_event` tinyint(4) NOT NULL DEFAULT 0,
  `edit_attendance` tinyint(4) NOT NULL DEFAULT 0,
  `permission_letter` tinyint(4) NOT NULL DEFAULT 0,
  `report` tinyint(4) NOT NULL DEFAULT 0,
  `confirm_event_registration` tinyint(4) NOT NULL DEFAULT 0,
  `content_repository` tinyint(4) NOT NULL DEFAULT 0,
  `feedback_response` tinyint(4) NOT NULL DEFAULT 0,
  `query` tinyint(4) NOT NULL DEFAULT 0,
  `reply_log` tinyint(4) NOT NULL DEFAULT 0,
  `audit` tinyint(4) NOT NULL DEFAULT 0,
  `confirm_membership` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_role`
--

INSERT INTO `csi_role` (`id`, `role_name`, `main_page_edit`, `user_data`, `role`, `add_event`, `budget`, `manage_event`, `edit_attendance`, `permission_letter`, `report`, `confirm_event_registration`, `content_repository`, `feedback_response`, `query`, `reply_log`, `audit`, `confirm_membership`) VALUES
(1, 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'head coordinator', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'coordinator', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'teacher', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'member', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'student', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'General Secretary', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(9, 'Student Coordinator', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(10, 'General Coordinator', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1),
(11, 'Event Team Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 'Event Team Co-Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 'Technical Team Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 'Technical Team Co-Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 'Design Team Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 'Design Team Co-Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 'Registration & Treasure Team Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 'Registration & Treasure Team Co-Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 'Documentation Team Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 'Documentation Team Co-Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 'Social Media Team Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(22, 'Social Media Team Co-Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, 'Website Team Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 'Website Team Co-Head', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
  `linkedIn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_speaker`
--

INSERT INTO `csi_speaker` (`id`, `event_id`, `name`, `organisation`, `profession`, `description`, `photo`, `linkedIn`) VALUES
(1, 47, 'dhiraj', 'sakec', 'developer', 'abc', '60d1c3dd095b22.38584146.jpg', 'https://www.linkedin.com/in/aditya-shah539/'),
(2, 48, 'dhiraj shetty', 'sakec', 'developer', 'xyz', '60c5e787b52877.83501876.jpeg', 'www.linkedin.com/in/aditya-shah539'),
(3, 48, 'aditya shah', 'sakec', 'programmer', 'abc', '60c5e787b64315.82547545.jpg', 'www.linkedin.com/in/aditya-shah539'),
(4, 48, 'israil', 'sakec', 'developer', 'xyz', '60c5e787b52877.83501876.jpeg', 'www.linkedin.com/in/aditya-shah539');

-- --------------------------------------------------------

--
-- Table structure for table `csi_userdata`
--

CREATE TABLE `csi_userdata` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` varchar(5) NOT NULL,
  `division` varchar(10) NOT NULL,
  `rollNo` int(10) NOT NULL,
  `emailID` varchar(50) NOT NULL,
  `phonenumber` bigint(10) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `role` int(15) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_userdata`
--

INSERT INTO `csi_userdata` (`id`, `name`, `year`, `division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `role`, `gender`) VALUES
(89, 'Dhiraj', 'TE', '3', 56, 'c@sakec.ac.in ', 9998887776, 'IT', 1, ''),
(91, 'Dhiraj', 'TE', '3', 75, 'dhiraj.shetty_19@sakec.ac.in', 8779633138, 'CS', 11, 'male');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `csi_event`
--
ALTER TABLE `csi_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csi_event_likes`
--
ALTER TABLE `csi_event_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `csi_password`
--
ALTER TABLE `csi_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `csi_role` (`role`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `csi_event`
--
ALTER TABLE `csi_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `csi_event_likes`
--
ALTER TABLE `csi_event_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `csi_expense`
--
ALTER TABLE `csi_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `csi_feedback`
--
ALTER TABLE `csi_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `csi_password`
--
ALTER TABLE `csi_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_query`
--
ALTER TABLE `csi_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `csi_reply`
--
ALTER TABLE `csi_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `csi_role`
--
ALTER TABLE `csi_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `csi_speaker`
--
ALTER TABLE `csi_speaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `csi_userdata`
--
ALTER TABLE `csi_userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

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
  ADD CONSTRAINT `collection_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `csi_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `csi_collection_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `csi_userdata` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `csi_coordinator`
--
ALTER TABLE `csi_coordinator`
  ADD CONSTRAINT `csi_coordinator_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `csi_userdata` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_event_likes`
--
ALTER TABLE `csi_event_likes`
  ADD CONSTRAINT `csi_event_likes_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `csi_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `csi_event_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `csi_userdata` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `csi_membership_bills`
--
ALTER TABLE `csi_membership_bills`
  ADD CONSTRAINT `csi_membership_bills_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `csi_membership` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_password`
--
ALTER TABLE `csi_password`
  ADD CONSTRAINT `csi_password_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `csi_userdata` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_userdata`
--
ALTER TABLE `csi_userdata`
  ADD CONSTRAINT `csi_userdata_ibfk_1` FOREIGN KEY (`role`) REFERENCES `csi_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
