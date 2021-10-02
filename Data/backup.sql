-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2021 at 12:12 AM
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
-- Table structure for table `acsessions`
--

CREATE TABLE `acsessions` (
  `id` int(10) NOT NULL,
  `entryby` varchar(20) DEFAULT NULL,
  `entrydate` datetime NOT NULL DEFAULT current_timestamp(),
  `acsession` varchar(10) DEFAULT NULL,
  `acyear` varchar(12) DEFAULT NULL,
  `acsem` varchar(10) DEFAULT NULL,
  `datefrom` date DEFAULT NULL,
  `dateto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'about.jpg', 'CSI SAKEC was formed in the year 2007. From then it\r\n						has successively grown to one of the strongest student\r\n						chapters of SAKEC. CS1 SAKEC has always lived upon\r\n						its motto of:\r\n						“BUILDING TECHNICAL SKILLS PROFESSIONALLY1’\r\n						in the past, CS1 SAKEC has been conducting various\r\n						workshops, seminars and visits with the help of\r\n						technically sound students for the benefit of SAKEC as\r\n						well as Non SAKEC students. Student Council of CS1\r\n						SAKEC includes different teams such as Design,\r\n						Treasury, Registration, Technical, Events,\r\n						Documentation and Publicity. These teams collectively\r\n						work for all the events conducted by CS1 SAKEC under\r\n						the guidance of Staff Coordinators for the benefit of all\r\n						the members');

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
(4, 48, 'ipr'),
(6, 53, 'Computer Department'),
(7, 54, 'Computer Engineering Department'),
(8, 55, 'Computer Engineering Department'),
(9, 56, 'WHITE POCKET EVENTS AND ENTERTAINMENT'),
(10, 57, 'T.G. Lakshmi'),
(11, 57, 'EdTech department of IIT Bombay'),
(12, 58, 'Computer Engineering Department'),
(13, 59, 'Computer Engineering Department');

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
  `confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `confirmed_by` varchar(255) DEFAULT NULL,
  `attend` tinyint(4) NOT NULL DEFAULT 0,
  `externalstudentmembership` varchar(255) DEFAULT NULL
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
(21, 'Rahul Soni', 9999999999, 47, 1),
(22, 'Chintan Chheda', 9699061989, 54, 0),
(23, 'Deepshikha Chaturvedi', 9833507773, 54, 1),
(24, 'Dr. Rekha Ramesh\r\n', 9999999999, 55, 1),
(25, 'Aditya Shah', 9029058845, 55, 0),
(26, 'Pratik Upadhyay ', 9029041585, 55, 0),
(28, 'Dr. Rekha Ramesh\r\n', 9999999999, 57, 1),
(29, 'Yukta Lapsiya', 9420110775, 57, 0),
(30, ' Dhruvi Jain', 9819886760, 57, 0),
(31, 'Vaishali Hirlekar', 9999999999, 58, 1),
(32, 'Kushal Gogri', 9920922557, 58, 0),
(33, 'Deepshika Chaturvedi\r\n', 99999999999, 59, 1),
(34, 'Parth Panchal', 9029225743, 59, 0);

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
  `image` text NOT NULL,
  `preference` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_coordinator`
--

INSERT INTO `csi_coordinator` (`id`, `user_id`, `image`, `preference`) VALUES
(21, 116, '612c8c749c9e81.19804861.jpg', 4),
(22, 127, '612c8ccaba1b50.67879685.jpeg', 1),
(23, 128, '612c8cf3ac7bd5.49763498.jpg', 5),
(24, 129, '612c8d0c0a9e80.97762777.png', 2),
(25, 130, '612c8d1cef83b2.16805083.jpeg', 3),
(26, 131, '612c8d2e796000.38475703.jpg', 6),
(27, 132, '612c8d4d0cf292.12623560.jpg', 7),
(28, 134, '612c8da58b2d12.04980565.jpg', 9),
(29, 135, '612c8dc9e4c868.65604814.jpg', 10),
(30, 136, '612c8ddca00a35.49262497.jpg', 11),
(31, 137, '612c8de98159e9.61380270.jpg', 12),
(32, 138, '612c8dfda34b78.74127775.png', 13),
(33, 139, '612c8e1f428bc4.37358416.jpeg', 14),
(34, 140, '612c8e4135e029.49445529.png', 15),
(35, 141, '612c8e6d140ff4.60642399.jpg', 16),
(36, 142, '612c8f94771a37.31772474.jpg', 17),
(37, 143, '612c8fa68e4030.72145245.jpg', 18),
(38, 133, 'Jainish_Sakhidas_Technical_cohead.JPG', 8);

--
-- Triggers `csi_coordinator`
--
DELIMITER $$
CREATE TRIGGER `insertPreference` AFTER INSERT ON `csi_coordinator` FOR EACH ROW UPDATE `csi_coordinator` SET `preference`='2' WHERE 1
$$
DELIMITER ;

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
(40, 'Tensorflow', 'Introduction To ML with TENSORFLOW 2.0', 'TENSORFLOW.jpg', '2021-12-01', '2019-12-31', '10:00:00', '05:00:00', 'TensorFlow is a symbolic math library and is also used for Machine Learning applications such as image detection, object detection, etc.', 0, 0, 1, 1, 0),
(41, 'Introduction with IOT', 'Introduction with IOT with NODE MCU', ' nodemcu.jpg', '2019-08-30', '2019-08-31', '09:00:00', '05:00:00', 'Topics covered were: Introduction to IoT, Basics of NodeMCU, Configuring LEDs with NodeMCU, using different sensors like DHT11, LDRs, IRs & IR-Remote, NodeMCU as a Server & Google Assistant using NodeMCU. ', 150, 200, 1, 1, 0),
(42, 'Pune Outbound', 'Outbound', 'outbound.jpg', '2019-09-20', '2019-09-21', '06:00:00', '06:00:00', 'On Day 1, We visited Lenze Mechatronics Private Limited. The main parent company is from Germany and all their major operations run from there. We were shown Servo Motors, Gearboxes, AC Drive, PLC, I/O Systems.\nOn Day 2, we visited Vasaya Foods Pvt Ltd which is a company that produces potato chips and snacks.', 2350, 2500, 1, 1, 0),
(43, 'Software Conceptual Design', 'Software Conceptual Design', ' softwaredevelopment.jpg', '2021-07-03', '2021-07-03', '09:00:00', '05:00:00', ' How the design is successful in combining the pros of each separate diagram while overcoming their flaws. The platform was beginner friendly and provided help with a personal assistant of its own for every phase. Students were allowed to explore the platform independently based on a problem statement and they were able to grasp the concepts quickly and designed their own FBS diagrams during the workshop. The feedback interview was like a conversation where students actively took part in to discuss about the difficulties faced as a beginner and provided their opinion on improvements. ', 0, 0, 1, 1, 0),
(47, 'Tensorflow2', 'Introduction To ML with TENSORFLOW 2.0', 'TENSORFLOW.jpg', '2021-09-05', '2021-09-06', '16:00:00', '12:50:00', 'Topics covered were TensorFlow 2.0 framework (TensorFlow is a general purpose high-performance computing library open sourced by Google in 2015), Introduction to machine learning, where it is used and how it is implemented, What is tensor and how the name was given, How to integrate it in code, Hands on tensorflow (Image recognition),Creating neural network & Gathering dataset, Using Jupyter to share code, data cleaning and transformation. ', 0, 0, 1, 1, 0),
(48, 'Tensorflow3', 'Introduction To ML with TENSORFLOW 2.0', 'TENSORFLOW.jpg', '2021-07-05', '2021-07-05', '04:15:00', '03:26:00', 'Topics covered were TensorFlow 2.0 framework (TensorFlow is a general purpose high-performance computing library open sourced by Google in 2015), Introduction to machine learning, where it is used and how it is implemented, What is tensor and how the name was given, How to integrate it in code, Hands on tensorflow (Image recognition),Creating neural network & Gathering dataset, Using Jupyter to share code, data cleaning and transformation. ', 200, 500, 1, 1, 0),
(49, 'Outbound', 'outbound', 'outbound.jpg', '2021-07-20', '2021-07-06', '22:20:00', '03:30:00', 'On Day 1, We visited Lenze Mechatronics Private Limited. The main parent company is from Germany and all their major operations run from there. We were shown Servo Motors, Gearboxes, AC Drive, PLC, I/O Systems.\nOn Day 2, we visited Vasaya Foods Pvt Ltd which is a company that produces potato chips and snacks.', 3000, 5000, 1, 1, 0),
(53, 'ML', 'Learn', ' 6106cbfeaf5c71.72314970.jpg', '2021-08-14', '2021-08-14', '09:58:00', '03:58:00', 'learn ml', 0, 200, 1, 0, 1),
(54, 'Tensorflow 2.0', 'Introduction To ML with TENSORFLOW 2.0', ' 613b2cec66bcc3.49142647.jpg', '2019-08-10', '2019-08-10', '10:00:00', '05:00:00', 'TensorFlow is a symbolic math library and is also used for Machine Learning applications such as image detection, object detection, etc.', 30, 50, 1, 0, 0),
(55, 'Introduction To IOT', 'World of IoT with NodeMCU', ' 613b622f61b460.68162721.jpg', '2019-08-30', '2019-08-31', '10:00:00', '05:00:00', 'The NodeMCU development board is a powerful solution to program microcontrollers and be part of the Internet of Things (IoT).', 150, 200, 1, 0, 0),
(56, 'OUTBOUND', 'CSI Outbound', ' 613d16d7c247a8.13941357.jpg', '2019-09-20', '2019-09-21', '10:00:00', '05:00:00', 'Outbound at Pune MIDC\r\nIndustry Visited:\r\nLenze Mechatronics\r\nVasaya foods Pvt Ltd.\r\n\r\n', 2350, 2500, 1, 0, 0),
(57, 'Software Conceptual Design', 'Software Conceptual Design', ' 613d1dd7e609e2.78731686.jpg', '2019-10-07', '2019-10-07', '01:00:00', '05:00:00', 'How the design is successful in combining the pros of each separate diagram while overcoming their flaws. The platform was beginner friendly and provided help with a personal assistant of its own for every phase. Students were allowed to explore the platform independently based on a problem statement and they were able to grasp the concepts quickly and designed their own FBS diagrams during the workshop. The feedback interview was like a conversation where students actively took part in to discuss about the difficulties faced as a beginner and provided their opinion on improvements.', 0, 0, 1, 0, 0),
(58, 'AWS', 'Guest Lecture on AWS', ' 613d23872f8e77.99585553.jpg', '2020-03-06', '2020-03-06', '01:00:00', '05:00:00', 'Will be Learning about the different services provided by the AWS platform and connection of MongoDb with AWS', 0, 0, 1, 0, 0),
(59, 'Bug Bounty', 'Getting Started with Bug Bounty', ' 613d25d8f0a860.37525180.jpg', '2020-03-11', '2020-03-11', '01:00:00', '04:00:00', 'Topics covered were: What Bug Bounty is? , CSRF - Cross-Site Request Forge, Resources required to get started in Bug Bounty, Various examples of how bug bounty is done.', 0, 0, 1, 0, 0);

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
(102, 43, 89),
(126, 40, 89),
(132, 41, 89),
(133, 42, 89),
(137, 47, 89),
(141, 49, 89),
(142, 53, 89),
(143, 56, 115),
(144, 57, 115),
(145, 58, 115),
(146, 59, 115),
(147, 54, 115),
(148, 55, 115);

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
(27, 41, 'book 3', 'aditya.shah_19@sakec.ac.in', '60c5ab28dcd876.74772786.jpg', 100),
(29, 40, 'book 3', 'c@sakec.ac.in', '6106a127144592.68508798.png', 60);

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
(59, 'gal-1.jpg', 1),
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
(1, 120, '2001-01-23', 'dhiraj.shetty_19@sakec.ac.in', 2019, 2023, 15555, '2029-08-01 00:00:00'),
(2, 116, '2004-08-14', 'ss@mm.jj', 2021, 2025, 2222, NULL);

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
  `no_of_year` int(11) NOT NULL,
  `accepted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_membership_bills`
--

INSERT INTO `csi_membership_bills` (`id`, `membership_id`, `bill_photo`, `amount`, `membership_taken`, `no_of_year`, `accepted`) VALUES
(3, 1, '6106d17e1dbb81.90047817.jpg', 2000, '2021-08-01 00:00:00', 4, 1),
(10, 1, '61175be0a1b920.97555498.jpg', 2000, '2025-08-01 12:08:00', 4, 1);

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
(20, 'lilashah539@gmail.com'),
(21, 'give.away.for.new.age.wanderer@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `csi_password`
--

CREATE TABLE `csi_password` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_password`
--

INSERT INTO `csi_password` (`id`, `user_id`, `password`) VALUES
(1, 89, '$2y$10$iYbhEjuZ9TQGWnziCVNH1.Q0NzwmuFvFyVDybeEgeLIo8VVNymHu2'),
(18, 116, '$2y$10$04zCpeXDJNGdLDFqzF2vAO7USq0aR7DgfXj4SFy0mDtlZoDem6GC.'),
(22, 120, '$2y$10$dhfz0iXDFNQMr2mKcUiNXOc4zJb/xwJOhSvDD4Kd9CXUZSxEJ5p.m'),
(25, 127, '$2y$10$BIg21/3w7osF8oz/Xh4FQOiIQs/MB2AlWNBqc04BX9/n7mms8znDm'),
(26, 128, '$2y$10$M2plVL9VxBwA8vaJttX99e7LM.4aDZ.QhFI3bZb3ylC6QG3Vgh8JS'),
(27, 129, '$2y$10$PGA0N570.TG2T3AlCfl21u4xbyTEol8zxGLPweAAS4gHoOO9aLErS'),
(28, 130, '$2y$10$/g6DDPL4zVaX7RZe43xYme2u8HjND5z3Me./cpKLZdlePWSRnv7NK'),
(29, 131, '$2y$10$rWN6v6EiOfhyfaGgx1rZke3zWppPq6.mcC4pWJG3IJpnScT.yD606'),
(30, 132, '$2y$10$v58CUXZTcp8X1UHfWJWez.3HH.0SfJyGo90ajHgkcope3fFUnKqKO'),
(31, 133, '$2y$10$fQmO1nypuMY3MUjjAOXm/eqMMrjxYMS1zAPZBtKMXKy4cHQolfYJ2'),
(32, 134, '$2y$10$DVU3NtkJMPPOoeiWF3ClLeXQiSZRgOC5TOSXVn4EElYLo8AjiYTrq'),
(33, 135, '$2y$10$rIBQOck9K6sSISbmRhDITOXpCVsfuX.kql2Q0A8DuyGG/5nfCB/yS'),
(34, 136, '$2y$10$xGuUyhlIMA/M7v5cdiOKSeWLskqvJOHOyBUbC/cJfcxrs5Vq16ELm'),
(35, 137, '$2y$10$56QUvxvhdCPCRK24SfE5TO.qtD3dQokJtx5DyxBWh/vBKK9ZnwMGC'),
(36, 138, '$2y$10$gZkDWjDzHmdGxt36g28C6ecShYlY8N1.K3TKeJQxxZBvuxf6oL7jK'),
(37, 139, '$2y$10$56nClqg.lScBikUR7pap6eO72nH4X1YnvZQLQAUEYkpsudkWdfGtG'),
(38, 140, '$2y$10$3cVZidSZ6/aHc4f8adyat.hDX2H2ITMVVJwPD6oaLejYwxPjkw33.'),
(39, 141, '$2y$10$iuHxvApl31pxRivdp77bGuEtWJ.ic7mlHZv6DuhMJop7j2jv.PCca'),
(40, 142, '$2y$10$KyOdX0qrMMkhCrfNj8BpTOts/yj4teHE7H4XzpinPs5koAVPm9cA.'),
(41, 143, '$2y$10$0R8oMfnyRP48OzZG3PuCn.MGydeZDuW.NvvWSBwTo5vSvIQ8bfcpO'),
(42, 144, '$2y$10$D/L/IKVOyrt3RqOpQLc9VOzZCxJPjKvi7OORyHrepTK49bXtx6bMW'),
(43, 115, '$2y$10$uOKCP2nAsM/2HpMF2Qs8Du8TYl5/4n7XDBYB0Zgb4fBUwKrQ.DjFy');

-- --------------------------------------------------------

--
-- Table structure for table `csi_query`
--

CREATE TABLE `csi_query` (
  `id` int(11) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_query` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `csi_reply`
--

CREATE TABLE `csi_reply` (
  `id` int(11) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `c_query` varchar(8000) NOT NULL,
  `reply_subject` text NOT NULL,
  `reply_body` text NOT NULL,
  `replied_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'head coordinator', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'coordinator', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1),
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
(2, 48, 'dhiraj shetty', 'sakec', 'developer', 'xyz', '60d1c3dd082987.01761063.jpeg', 'www.linkedin.com/in/aditya-shah539'),
(3, 48, 'aditya shah', 'sakec', 'programmer', 'abc', '60d1c3dd095b22.38584146.jpg', 'www.linkedin.com/in/aditya-shah539'),
(4, 48, 'israil', 'sakec', 'developer', 'xyz', '613b2cec6a60d6.74455062.jpg', 'www.linkedin.com/in/aditya-shah539'),
(5, 40, 'Deep Mehta', 'Sakec', 'Student', '', '', ''),
(6, 54, 'Deep Mehta', 'sakec', 'Student', 'NA', '613b2cec6a60d6.74455062.jpg', 'https://www.google.com/'),
(7, 54, 'Deep Vira', 'sakec', 'student', 'NA', '613b2cec6b6530.49539855.jpg', 'https://www.google.com/'),
(8, 55, 'Prasanna Limaye', 'Sakec ', 'Student', 'NA', '613b622f63e1a8.86020665.jpg', 'https://www.google.com/'),
(9, 55, 'Vineet Patel', 'sakec', 'Student', 'NA', '613b622f65f6b1.55305235.jpg', 'https://www.google.com/'),
(10, 55, 'Hiten Chawda', 'sakec', 'Student', 'NA', '613b622f637be8.66391684.jpg', 'https://www.google.com/'),
(11, 55, 'Bhavin Goswami.', 'sakec', 'Student', 'NA', '613b622f643de8.06458314.jpeg', 'https://www.google.com/'),
(14, 57, 'Ms. T.G. LAKSHMI', 'UNKNOWN', 'UNKNOWN', 'NA', '613b2cec6a60d6.74455062.jpg', 'https://www.google.com/'),
(15, 57, 'MS. N. SOUMYA', 'UNKNOWN', 'UNKNOWN', 'NA', '613b2cec6a60d6.74455062.jpg', 'https://www.google.com/'),
(17, 58, 'Dr. Bhushan A. Jadav', 'UNKNOWN', 'UNKNOWN', 'NA', '613b2cec6a60d6.74455062.jpg', 'https://www.google.com/'),
(18, 59, 'Mr. Pratik Yadav', 'UNKNOWN', 'UNKNOWN', 'NA', '613b2cec6a60d6.74455062.jpg', 'https://www.google.com/');

-- --------------------------------------------------------

--
-- Table structure for table `csi_userdata`
--

CREATE TABLE `csi_userdata` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` varchar(5) NOT NULL,
  `division` varchar(10) DEFAULT NULL,
  `rollNo` int(10) DEFAULT NULL,
  `emailID` varchar(50) NOT NULL,
  `phonenumber` bigint(10) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `role` int(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `organization` varchar(255) NOT NULL DEFAULT 'sakec'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csi_userdata`
--

INSERT INTO `csi_userdata` (`id`, `name`, `year`, `division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `role`, `gender`, `organization`) VALUES
(89, 'Dhiraj', 'TE', '3', 56, 'c@sakec.ac.in ', 9998887776, 'IT', 1, '', 'sakec'),
(115, 'Aditya Bharat Shah', 'FE', NULL, NULL, 'adityashah539@gmail.com', 9372622462, 'CS', 1, 'male', 'sakec'),
(116, 'ADITYA SHAH', 'FE', 'BE3', 19, 'aditya.shah_19@sakec.ac.in', 9999999981, 'Computers', 23, 'male', 'sakec'),
(120, 'RAHUL SONI', 'FE', 'TE3', 0, 'rahullsoni04@gmail.com', 0, '', 6, 'male', 'sakec'),
(127, 'RITIK MAHAJAN', 'FE', 'TE3', 1, 'ritik.mahajan_19@sakec.ac.in', 9999999999, 'Computers', 8, 'male', 'sakec'),
(128, 'RITIKA BORICHA', 'FE', 'SE3', 16, 'ritika.boricha@sakec.ac.in', 9999999984, 'Computers', 15, 'female', 'sakec'),
(129, 'RUTVIK DESHPANDE', 'FE', 'TE3', 3, 'rutvik.deshpande_19@sakec.ac.in', 9999999997, 'Computers', 9, 'male', 'sakec'),
(130, 'ZARANA DESAI', 'FE', 'TE3', 2, 'zarana.desai_19@sakec.ac.in', 9999999998, 'Computers', 10, 'female', 'sakec'),
(131, 'KRUTIK PATEL', 'FE', 'BE3', 4, 'krutik.patel@sakec.ac.in', 9999999996, 'Computers', 11, 'male', 'sakec'),
(132, 'PRATHAMESH RANE', 'FE', 'SE3', 17, 'prathamesh.rane16006@sakec.ac.in', 9999999983, 'Computers', 16, 'male', 'sakec'),
(133, 'JAINISH SAKHIDAS', 'FE', 'TE3', 10, 'jainish.sakhidas_19@sakec.ac.in', 9999999990, 'Computers', 12, 'male', 'sakec'),
(134, 'SHALIN GUND', 'FE', 'BE3', 5, 'shalin.gund@sakec.ac.in', 9999999995, 'Computers', 12, 'female', 'sakec'),
(135, 'NIDHI PARAB', 'FE', 'TE3', 13, 'nidhi.parab15933@sakec.ac.in', 9999999987, 'Computers', 22, 'female', 'sakec'),
(136, 'HIMANSHU MUKANE', 'FE', 'SE3', 11, 'himanshu.mukane15590@sakec.ac.in', 9999999989, 'Computers', 21, 'male', 'sakec'),
(137, 'EASHWARI NAGARKAR', 'FE', 'TE3', 14, 'eashwari.nagarkar15686@sakec.ac.in', 9999999986, 'Computers', 19, 'female', 'sakec'),
(138, 'KHUSHEETA ATTARDE', 'FE', 'SE3', 18, 'khusheeta.attarde15490@sakec.ac.in', 9999999982, 'Computers', 16, 'female', 'sakec'),
(139, 'SIMRAN JINDAL', 'FE', 'BE3', 6, 'simran.jindal@sakec.ac.in', 9999999994, 'Computers', 17, 'female', 'sakec'),
(140, 'HIMANSHU CHAUDHARI', 'FE', 'TE3', 12, 'himanshu.chaudhari15735@sakec.ac.in', 9999999988, 'Computers', 22, 'male', 'sakec'),
(141, 'PRIYAL KATUDIA', 'FE', 'TE3', 8, 'priyal.katudia_19@sakec.ac.in', 9999999992, 'Computers', 17, 'female', 'sakec'),
(142, 'AAGAM SHETH', 'FE', 'TE3', 9, 'aagam.sheth_19@sakec.ac.in', 9999999991, 'Computers', 13, 'male', 'sakec'),
(143, 'NISHMA KAMAT', 'FE', 'SE3', 7, 'nishma.kamat15494@sakec.ac.in', 9999999993, 'Computers', 18, 'female', 'sakec'),
(144, 'test', 'FE', NULL, NULL, 'guptavan96@gmail.com', 8888888888, 'CS', 6, 'male', 'sakec'),
(147, 'Aditya Bharat Shah', 'FE', '', 0, 'give.away.for.new.age.wanderer@gmail.com', 1111111111, 'CS', 6, 'male', 'Shah & Anchor Kutchhi Engineering College');

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
(1, 47, '4th-Floor Seminar Hall'),
(4, 53, 'SAKEC'),
(5, 54, '701 Lab'),
(6, 54, '702 Lab'),
(7, 55, ' 4th floor Seminar Hall'),
(8, 56, ' MIDC , Pune, Maharashtra'),
(9, 57, 'LAB 209'),
(10, 57, 'lab 210'),
(11, 58, 'LAB 612'),
(12, 58, 'LAB 613'),
(13, 58, 'LAB 614'),
(14, 59, '4th Floor Auditorium');

-- --------------------------------------------------------

--
-- Table structure for table `division_details`
--

CREATE TABLE `division_details` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL COMMENT 'References student_table (std_id)',
  `sem_id` int(4) NOT NULL COMMENT 'References intake (sem_id)',
  `std_roll_no` int(3) NOT NULL,
  `batch` varchar(1) NOT NULL,
  `year` int(5) NOT NULL,
  `session` varchar(10) NOT NULL,
  `date_enter` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division_details`
--

INSERT INTO `division_details` (`id`, `std_id`, `sem_id`, `std_roll_no`, `batch`, `year`, `session`, `date_enter`) VALUES
(1, 201941000, 2, 1, '', 0, '', '2021-07-28 14:19:11'),
(2, 201941001, 2, 2, '', 0, '', '2021-07-28 14:19:11'),
(3, 201941002, 2, 3, '', 0, '', '2021-07-28 14:19:11'),
(4, 201841003, 3, 4, '', 0, '', '2021-07-28 14:19:11'),
(5, 201841004, 3, 5, '', 0, '', '2021-07-28 14:19:11'),
(6, 201841005, 3, 6, '', 0, '', '2021-07-28 14:19:11'),
(7, 202041006, 1, 7, '', 0, '', '2021-07-28 14:19:11'),
(8, 201941007, 2, 8, '', 0, '', '2021-07-28 14:19:11'),
(9, 201941008, 2, 9, '', 0, '', '2021-07-28 14:19:11'),
(10, 201941009, 2, 10, '', 0, '', '2021-07-28 14:19:11'),
(11, 202041010, 1, 11, '', 0, '', '2021-07-28 14:19:11'),
(12, 202041011, 2, 12, '', 0, '', '2021-07-28 14:19:11'),
(13, 202041012, 2, 13, '', 0, '', '2021-07-28 14:19:11'),
(14, 202041013, 2, 14, '', 0, '', '2021-07-28 14:19:11'),
(15, 201841014, 1, 15, '', 0, '', '2021-07-28 14:19:11'),
(16, 201841015, 1, 16, '', 0, '', '2021-07-28 14:19:11'),
(17, 202041016, 1, 17, '', 0, '', '2021-07-28 14:19:11'),
(18, 202041017, 1, 18, '', 0, '', '2021-07-28 14:19:11'),
(19, 201941018, 3, 19, '', 0, '', '2021-07-28 14:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `dloc_subject`
--

CREATE TABLE `dloc_subject` (
  `subject_no` varchar(10) NOT NULL COMMENT 'References subject_table (subject_no)',
  `subject_name` varchar(40) NOT NULL COMMENT 'References subject_table (subject_name)',
  `sem_id` int(4) NOT NULL COMMENT 'References intake (sem_id)',
  `batch1` varchar(1) DEFAULT NULL,
  `batch2` varchar(1) DEFAULT NULL,
  `batch3` varchar(1) DEFAULT NULL,
  `batch4` varchar(1) DEFAULT NULL,
  `ac_year` int(4) NOT NULL,
  `date_enter` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iloc_subject`
--

CREATE TABLE `iloc_subject` (
  `subject_no` varchar(10) NOT NULL COMMENT 'References subject_table (subject_no)',
  `subject_name` varchar(40) NOT NULL COMMENT 'References subject_table (subject_name)',
  `program` varchar(11) NOT NULL,
  `sem_id` int(4) NOT NULL COMMENT 'References intake (sem_id)',
  `std_roll_no` int(3) NOT NULL,
  `ac_year` int(4) NOT NULL,
  `date_enter` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `intake`
--

CREATE TABLE `intake` (
  `program_id` int(1) NOT NULL,
  `program` varchar(30) NOT NULL,
  `year_id` int(2) NOT NULL,
  `year` varchar(11) NOT NULL,
  `div_id` int(6) NOT NULL,
  `division` varchar(11) NOT NULL,
  `sem_id` int(6) NOT NULL,
  `semester` int(11) NOT NULL,
  `program_linked` varchar(30) DEFAULT NULL,
  `used` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intake`
--

INSERT INTO `intake` (`program_id`, `program`, `year_id`, `year`, `div_id`, `division`, `sem_id`, `semester`, `program_linked`, `used`) VALUES
(0, '', 0, '', 0, 'SE3', 1, 0, NULL, 0),
(0, '', 0, '', 0, 'TE3', 2, 0, NULL, 0),
(0, '', 0, '', 0, 'BE3', 3, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `std_id` int(11) NOT NULL,
  `registration_no` int(11) NOT NULL,
  `student_name` varchar(40) NOT NULL,
  `email` varchar(64) NOT NULL,
  `s_phone` varchar(15) DEFAULT NULL,
  `p_phone` varchar(15) DEFAULT NULL,
  `mentor` varchar(60) NOT NULL,
  `smart_card_no` varchar(10) DEFAULT NULL,
  `admission_year` int(5) DEFAULT NULL,
  `program` varchar(30) NOT NULL,
  `admission_type` varchar(10) NOT NULL,
  `date_enter` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_table`
--

INSERT INTO `student_table` (`std_id`, `registration_no`, `student_name`, `email`, `s_phone`, `p_phone`, `mentor`, `smart_card_no`, `admission_year`, `program`, `admission_type`, `date_enter`) VALUES
(201841003, 15003, 'KRUTIK PATEL', 'krutik.patel@sakec.ac.in', '9999999996', NULL, '', NULL, 2018, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201841004, 15004, 'SHALIN GUND', 'shalin.gund@sakec.ac.in', '9999999995', NULL, '', NULL, 2018, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201841005, 15005, 'SIMRAN JINDAL', 'simran.jindal@sakec.ac.in', '9999999994', NULL, '', NULL, 2018, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201841014, 15014, 'BHAVIKA SALSHINGIKAR', 'bhavika.salshingikar_18@sakec.ac.in', '9999999985', NULL, '', NULL, 2018, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201841015, 15015, 'RITIKA BORICHA', 'ritika.boricha@sakec.ac.in', '9999999984', NULL, '', NULL, 2018, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201941000, 15000, 'RITIK MAHAJAN', 'ritik.mahajan_19@sakec.ac.in', '9999999999', NULL, '', NULL, 2019, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201941001, 15001, 'ZARANA DESAI', 'zarana.desai_19@sakec.ac.in', '9999999998', NULL, '', NULL, 2019, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201941002, 15002, 'RUTVIK DESHPANDE', 'rutvik.deshpande_19@sakec.ac.in', '9999999997', NULL, '', NULL, 2019, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201941007, 15007, 'PRIYAL KATUDIA', 'priyal.katudia_19@sakec.ac.in', '9999999992', NULL, '', NULL, 2019, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201941008, 15008, 'AAGAM SHETH', 'aagam.sheth_19@sakec.ac.in', '9999999991', NULL, '', NULL, 2019, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201941009, 15009, 'JAINISH SAKHIDAS', 'jainish.sakhidas_19@sakec.ac.in', '9999999990', NULL, '', NULL, 2019, 'Computers', 'FE', '2021-07-28 14:06:46'),
(201941018, 15018, 'ADITYA SHAH', 'aditya.shah_19@sakec.ac.in', '9999999981', NULL, '', NULL, 2019, 'Computers', 'FE', '2021-07-28 14:06:46'),
(202041006, 15006, 'NISHMA KAMAT', 'nishma.kamat15494@sakec.ac.in', '9999999993', NULL, '', NULL, 2020, 'Computers', 'FE', '2021-07-28 14:06:46'),
(202041010, 15010, 'HIMANSHU MUKANE', 'himanshu.mukane15590@sakec.ac.in', '9999999989', NULL, '', NULL, 2020, 'Computers', 'FE', '2021-07-28 14:06:46'),
(202041011, 15011, 'HIMANSHU CHAUDHARI', 'himanshu.chaudhari15735@sakec.ac.in', '9999999988', NULL, '', NULL, 2020, 'Computers', 'FE', '2021-07-28 14:06:46'),
(202041012, 15012, 'NIDHI PARAB', 'nidhi.parab15933@sakec.ac.in', '9999999987', NULL, '', NULL, 2020, 'Computers', 'FE', '2021-07-28 14:06:46'),
(202041013, 15013, 'EASHWARI NAGARKAR', 'eashwari.nagarkar15686@sakec.ac.in', '9999999986', NULL, '', NULL, 2020, 'Computers', 'FE', '2021-07-28 14:06:46'),
(202041016, 15016, 'PRATHAMESH RANE', 'prathamesh.rane16006@sakec.ac.in', '9999999983', NULL, '', NULL, 2020, 'Computers', 'FE', '2021-07-28 14:06:46'),
(202041017, 15017, 'KHUSHEETA ATTARDE', 'khusheeta.attarde15490@sakec.ac.in', '9999999982', NULL, '', NULL, 2020, 'Computers', 'FE', '2021-07-28 14:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `subject_table`
--

CREATE TABLE `subject_table` (
  `subject_no` varchar(12) NOT NULL,
  `subject_name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `subject_type` varchar(7) NOT NULL DEFAULT 'default',
  `program` varchar(11) NOT NULL,
  `division` varchar(11) NOT NULL,
  `sem_id` int(4) NOT NULL,
  `session` varchar(2) NOT NULL,
  `ac_year` int(5) NOT NULL,
  `examiner_id` varchar(12) DEFAULT NULL COMMENT 'References users(user_name)',
  `examiner_name` varchar(40) NOT NULL COMMENT 'References users(full_name)',
  `teacher1_name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `teacher1_id` varchar(12) DEFAULT NULL COMMENT 'References users(user_name)',
  `teacher2_id` varchar(12) DEFAULT NULL COMMENT 'References users(user_name)',
  `teacher2_name` varchar(40) NOT NULL,
  `teacher3_id` varchar(12) DEFAULT NULL COMMENT 'References users(user_name)',
  `teacher3_name` varchar(40) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `s_login`
--

CREATE TABLE `s_login` (
  `s_name` varchar(35) NOT NULL,
  `smart_card` varchar(35) NOT NULL,
  `password` varchar(200) NOT NULL,
  `reg_no` int(20) NOT NULL,
  `s_contact` int(255) NOT NULL,
  `s_email` varchar(255) NOT NULL,
  `std_id` int(5) DEFAULT NULL,
  `enroll_no` int(100) NOT NULL,
  `PRN` int(100) NOT NULL,
  `dob` date NOT NULL,
  `Blood_grp` varchar(35) NOT NULL,
  `Aadhar` int(100) NOT NULL,
  `Profile Pic` varchar(255) DEFAULT NULL,
  `f_name` varchar(35) NOT NULL DEFAULT 'None',
  `f_quali` varchar(35) NOT NULL,
  `f_occup` varchar(35) NOT NULL,
  `f_office_address` varchar(200) NOT NULL,
  `f_phone` int(100) NOT NULL,
  `f_email` varchar(35) NOT NULL,
  `m_name` varchar(35) NOT NULL,
  `m_quali` varchar(35) NOT NULL,
  `m_occup` varchar(35) NOT NULL,
  `m_office_address` varchar(200) NOT NULL,
  `m_phone` int(35) NOT NULL,
  `m_email` varchar(35) NOT NULL,
  `g_name` varchar(35) NOT NULL,
  `g_quali` varchar(35) NOT NULL,
  `g_occup` varchar(35) NOT NULL,
  `g_office_address` varchar(100) NOT NULL,
  `g_phone` int(11) DEFAULT NULL,
  `g_email` varchar(35) NOT NULL,
  `program` varchar(35) NOT NULL,
  `admission_year` varchar(35) NOT NULL,
  `Mentor` varchar(35) NOT NULL,
  `PAN_no` varchar(255) NOT NULL,
  `Permanant_address` varchar(100) NOT NULL,
  `Residential_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `full_name` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `user_name` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `user_email` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `md5_id` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_level` tinyint(4) NOT NULL DEFAULT 1,
  `pwd` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tel` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `date` date NOT NULL,
  `users_ip` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `approved` int(1) NOT NULL DEFAULT 0,
  `program` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `activation_code` int(10) NOT NULL DEFAULT 0,
  `banned` int(1) NOT NULL DEFAULT 0,
  `ckey` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ctime` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `date_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usershort`
--

CREATE TABLE `usershort` (
  `id` bigint(3) NOT NULL,
  `full_name` varchar(40) COLLATE latin1_general_ci NOT NULL COMMENT 'References users(full_name)',
  `short` varchar(4) COLLATE latin1_general_ci DEFAULT NULL,
  `user_name` varchar(12) COLLATE latin1_general_ci NOT NULL COMMENT 'References users(user__name)',
  `program` varchar(30) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acsessions`
--
ALTER TABLE `acsessions`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `division_details`
--
ALTER TABLE `division_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `s` (`sem_id`,`std_roll_no`,`year`) USING BTREE,
  ADD UNIQUE KEY `std_id` (`std_id`,`sem_id`,`year`,`session`);

--
-- Indexes for table `dloc_subject`
--
ALTER TABLE `dloc_subject`
  ADD PRIMARY KEY (`subject_no`,`sem_id`,`ac_year`);

--
-- Indexes for table `iloc_subject`
--
ALTER TABLE `iloc_subject`
  ADD PRIMARY KEY (`sem_id`,`std_roll_no`,`ac_year`);

--
-- Indexes for table `intake`
--
ALTER TABLE `intake`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`std_id`),
  ADD UNIQUE KEY `std_id` (`std_id`),
  ADD UNIQUE KEY `std_id_2` (`std_id`),
  ADD KEY `std_id_3` (`std_id`),
  ADD KEY `student_name` (`student_name`,`admission_year`);

--
-- Indexes for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD PRIMARY KEY (`subject_no`,`sem_id`,`ac_year`);

--
-- Indexes for table `s_login`
--
ALTER TABLE `s_login`
  ADD PRIMARY KEY (`reg_no`),
  ADD UNIQUE KEY `smart_card` (`smart_card`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `std_id_2` (`std_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `usershort`
--
ALTER TABLE `usershort`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);
ALTER TABLE `usershort` ADD FULLTEXT KEY `idx_search` (`full_name`,`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acsessions`
--
ALTER TABLE `acsessions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_aboutus`
--
ALTER TABLE `csi_aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `csi_collaboration`
--
ALTER TABLE `csi_collaboration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `csi_collection`
--
ALTER TABLE `csi_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `csi_contact`
--
ALTER TABLE `csi_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `csi_contentrepository`
--
ALTER TABLE `csi_contentrepository`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `csi_coordinator`
--
ALTER TABLE `csi_coordinator`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `csi_event`
--
ALTER TABLE `csi_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `csi_event_likes`
--
ALTER TABLE `csi_event_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `csi_expense`
--
ALTER TABLE `csi_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `csi_feedback`
--
ALTER TABLE `csi_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `csi_gallery`
--
ALTER TABLE `csi_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `csi_membership`
--
ALTER TABLE `csi_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `csi_membership_bills`
--
ALTER TABLE `csi_membership_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `csi_newsletter`
--
ALTER TABLE `csi_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `csi_password`
--
ALTER TABLE `csi_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `csi_query`
--
ALTER TABLE `csi_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `csi_reply`
--
ALTER TABLE `csi_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `csi_role`
--
ALTER TABLE `csi_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `csi_speaker`
--
ALTER TABLE `csi_speaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `csi_userdata`
--
ALTER TABLE `csi_userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `csi_venue`
--
ALTER TABLE `csi_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `division_details`
--
ALTER TABLE `division_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usershort`
--
ALTER TABLE `usershort`
  MODIFY `id` bigint(3) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `csi_membership`
--
ALTER TABLE `csi_membership`
  ADD CONSTRAINT `csi_membership_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `csi_userdata` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `csi_speaker`
--
ALTER TABLE `csi_speaker`
  ADD CONSTRAINT `csi_speaker_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `csi_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csi_userdata`
--
ALTER TABLE `csi_userdata`
  ADD CONSTRAINT `csi_userdata_ibfk_1` FOREIGN KEY (`role`) REFERENCES `csi_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `csi_venue`
--
ALTER TABLE `csi_venue`
  ADD CONSTRAINT `csi_venue_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `csi_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
