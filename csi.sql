-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 12:52 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

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
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `id` int(11) NOT NULL,
  `photo` varchar(256) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`id`, `photo`, `description`) VALUES
(1, '60d7956a2448e8.30133895.jpg', 'CSI SAKEC was formed in the year 2007. From then it\r\n						has successively grown to one of the strongest student\r\n						chapters of SAKEC. CS1 SAKEC has always lived upon\r\n						its motto of:\r\n						“BUILDING TECHNICAL SKILLS PROFESSIONALLY1’\r\n						in the past, CS1 SAKEC has been conducting various\r\n						workshops, seminars and visits with the help of\r\n						technically sound students for the benefit of SAKEC as\r\n						well as Non SAKEC students. Student Council of CS1\r\n						SAKEC includes different teams such as Design,\r\n						Treasury, Registration, Technical, Events,\r\n						Documentation and Publicity. These teams collectively\r\n						work for all the events conducted by CS1 SAKEC under\r\n						the guidance of Staff Coordinators for the benefit of all\r\n						the members.');

-- --------------------------------------------------------

--
-- Table structure for table `collaboration`
--

CREATE TABLE `collaboration` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `collab_body` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collaboration`
--

INSERT INTO `collaboration` (`id`, `event_id`, `collab_body`) VALUES
(1, 40, 'computer engineering'),
(2, 47, 'ieee'),
(3, 48, 'ieee'),
(4, 48, 'ipr');

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_photo` varchar(255) DEFAULT NULL,
  `confirmed` tinyint(4) NOT NULL,
  `confirmed_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`id`, `event_id`, `user_id`, `bill_photo`, `confirmed`, `confirmed_by`) VALUES
(30, 40, 89, '60aa91916eb673.27003707.jpg', 1, 'c@sakec.ac.in'),
(32, 43, 1, NULL, 1, 'auto'),
(34, 43, 16, NULL, 1, 'auto'),
(35, 43, 72, NULL, 1, 'auto'),
(39, 43, 17, NULL, 1, 'auto'),
(40, 43, 18, NULL, 1, 'auto'),
(41, 43, 19, NULL, 1, 'auto'),
(42, 43, 20, NULL, 1, 'auto'),
(43, 43, 21, NULL, 1, 'auto'),
(44, 43, 22, NULL, 1, 'auto'),
(45, 43, 23, NULL, 1, 'auto'),
(46, 43, 24, NULL, 1, 'auto'),
(47, 43, 25, NULL, 1, 'auto'),
(48, 43, 26, NULL, 1, 'auto'),
(49, 43, 27, NULL, 1, 'auto'),
(50, 43, 28, NULL, 1, 'auto'),
(51, 43, 29, NULL, 1, 'auto'),
(52, 43, 30, NULL, 1, 'auto'),
(53, 43, 31, NULL, 1, 'auto'),
(54, 43, 32, NULL, 1, 'auto'),
(55, 43, 33, NULL, 1, 'auto'),
(56, 43, 34, NULL, 1, 'auto'),
(57, 43, 35, NULL, 1, 'auto'),
(58, 43, 36, NULL, 1, 'auto'),
(60, 43, 37, NULL, 1, 'auto'),
(61, 43, 38, NULL, 1, 'auto'),
(62, 43, 39, NULL, 1, 'auto'),
(63, 43, 40, NULL, 1, 'auto'),
(64, 43, 41, NULL, 1, 'auto'),
(65, 43, 57, NULL, 1, 'auto'),
(66, 43, 58, NULL, 1, 'auto'),
(67, 43, 59, NULL, 1, 'auto'),
(68, 43, 60, NULL, 1, 'auto'),
(69, 43, 61, NULL, 1, 'auto'),
(70, 43, 62, NULL, 1, 'auto'),
(71, 43, 63, NULL, 1, 'auto'),
(72, 43, 64, NULL, 1, 'auto'),
(73, 43, 65, NULL, 1, 'auto'),
(74, 43, 66, NULL, 1, 'auto'),
(75, 43, 67, NULL, 1, 'auto'),
(76, 43, 68, NULL, 1, 'auto'),
(77, 43, 69, NULL, 1, 'auto'),
(78, 43, 70, NULL, 1, 'auto');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `c_phonenumber` bigint(11) NOT NULL,
  `event_id` int(250) NOT NULL,
  `c_type` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `c_name`, `c_phonenumber`, `event_id`, `c_type`) VALUES
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
-- Table structure for table `contentrepository`
--

CREATE TABLE `contentrepository` (
  `id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contentrepository`
--

INSERT INTO `contentrepository` (`id`, `eventid`, `image`) VALUES
(17, 40, '60c5e787b52877.83501876.jpeg'),
(18, 40, '60c5e787b64315.82547545.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `duty` varchar(50) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`id`, `name`, `duty`, `image`) VALUES
(1, 'Dhruvi Jain', 'GENERAL SECRETARY', 'Dhruvi-jain.jpg'),
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
-- Table structure for table `event`
--

CREATE TABLE `event` (
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
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `subtitle`, `banner`, `e_from_date`, `e_to_date`, `e_from_time`, `e_to_time`, `e_description`, `fee_m`, `fee`, `live`, `feedback`, `selfie`) VALUES
(40, 'Tensorflow', 'Introduction To ML with TENSORFLOW 2.0', 'TENSORFLOW.jpg', '2019-08-23', '2019-08-10', '09:00:00', '05:00:00', 'Topics covered were TensorFlow 2.0 framework (TensorFlow is a general purpose high-performance computing library open sourced by Google in 2015), Introduction to machine learning, where it is used and how it is implemented, What is tensor and how the name was given, How to integrate it in code, Hands on tensorflow (Image recognition),Creating neural network & Gathering dataset, Using Jupyter to share code, data cleaning and transformation. ', 50, 50, 1, 1, 1),
(41, 'Introduction with IOT', 'Introduction with IOT with NODE MCU', ' nodemcu.jpg', '2019-08-30', '2019-08-31', '09:00:00', '05:00:00', 'Topics covered were: Introduction to IoT, Basics of NodeMCU, Configuring LEDs with NodeMCU, using different sensors like DHT11, LDRs, IRs & IR-Remote, NodeMCU as a Server & Google Assistant using NodeMCU. ', 150, 200, 1, 0, 0),
(42, 'Pune Outbound', 'Outbound', 'outbound.jpg', '2019-09-20', '2019-09-21', '06:00:00', '06:00:00', 'On Day 1, We visited Lenze Mechatronics Private Limited. The main parent company is from Germany and all their major operations run from there. We were shown Servo Motors, Gearboxes, AC Drive, PLC, I/O Systems.\nOn Day 2, we visited Vasaya Foods Pvt Ltd which is a company that produces potato chips and snacks.', 2350, 2500, 1, 0, 0),
(43, 'Software Conceptual Design', 'Software Conceptual Design', ' softwaredevelopment.jpg', '2021-06-27', '2021-06-27', '09:00:00', '05:00:00', ' How the design is successful in combining the pros of each separate diagram while overcoming their flaws. The platform was beginner friendly and provided help with a personal assistant of its own for every phase. Students were allowed to explore the platform independently based on a problem statement and they were able to grasp the concepts quickly and designed their own FBS diagrams during the workshop. The feedback interview was like a conversation where students actively took part in to discuss about the difficulties faced as a beginner and provided their opinion on improvements. ', 0, 0, 1, 0, 0),
(47, 'Tensorflow2', 'Introduction To ML with TENSORFLOW 2.0', 'TENSORFLOW.jpg', '2021-06-28', '2021-06-28', '10:50:00', '12:50:00', 'Topics covered were TensorFlow 2.0 framework (TensorFlow is a general purpose high-performance computing library open sourced by Google in 2015), Introduction to machine learning, where it is used and how it is implemented, What is tensor and how the name was given, How to integrate it in code, Hands on tensorflow (Image recognition),Creating neural network & Gathering dataset, Using Jupyter to share code, data cleaning and transformation. ', 50, 200, 1, 0, 0),
(48, 'Tensorflow3', 'Introduction To ML with TENSORFLOW 2.0', 'TENSORFLOW.jpg', '2021-06-29', '2021-06-29', '22:15:00', '03:26:00', 'Topics covered were TensorFlow 2.0 framework (TensorFlow is a general purpose high-performance computing library open sourced by Google in 2015), Introduction to machine learning, where it is used and how it is implemented, What is tensor and how the name was given, How to integrate it in code, Hands on tensorflow (Image recognition),Creating neural network & Gathering dataset, Using Jupyter to share code, data cleaning and transformation. ', 200, 500, 1, 0, 0),
(49, 'Outbound', 'outbound', 'outbound.jpg', '2021-06-30', '2021-06-30', '22:20:00', '03:30:00', 'On Day 1, We visited Lenze Mechatronics Private Limited. The main parent company is from Germany and all their major operations run from there. We were shown Servo Motors, Gearboxes, AC Drive, PLC, I/O Systems.\nOn Day 2, we visited Vasaya Foods Pvt Ltd which is a company that produces potato chips and snacks.', 3000, 5000, 1, 0, 0),
(50, 'tensorflow 4.6', 'Introduction To ML with TENSORFLOW 2.0', ' 60dec27b053f73.67977106.jpg', '2021-07-02', '2021-07-02', '04:08:00', '02:08:00', 'vhcgf', 50, 200, 1, 0, 0),
(51, 'test 4.1', 'Introduction To ML with TENSORFLOW 2.0', ' 60dec608a65261.75093828.jpg', '2021-07-14', '2021-07-13', '05:23:00', '01:23:00', 'test 1', 50, 200, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `spent_on` varchar(256) NOT NULL,
  `by` varchar(256) NOT NULL,
  `bill_photo` text NOT NULL,
  `bill_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `event_id`, `spent_on`, `by`, `bill_photo`, `bill_amount`) VALUES
(24, 40, 'pen', 'aditya.shah_19@sakec.ac.in', 'bill PO.png', 150),
(25, 40, 'book', 'aditya.shah_19@sakec.ac.in', '60c5aabd20e615.59719138.png', 10),
(26, 40, 'book 2', 'aditya.shah_19@sakec.ac.in', '60c5ab28dab3f2.82965889.png', 50),
(27, 41, 'book 3', 'aditya.shah_19@sakec.ac.in', '60c5ab28dcd876.74772786.jpg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `Q1` int(11) NOT NULL,
  `Q2` int(11) NOT NULL,
  `Q3` int(11) NOT NULL,
  `Q4` int(11) NOT NULL,
  `Q5` int(11) NOT NULL,
  `Q6` int(11) NOT NULL,
  `Q7` int(11) NOT NULL,
  `any_queries` varchar(255) NOT NULL,
  `selfie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `collection_id`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `any_queries`, `selfie`) VALUES
(19, 30, 1, 5, 3, 3, 5, 2, 5, 'test 19', '60ded961db7fd8.81904065.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `status`) VALUES
(59, 'gal-1.jpg', 1),
(60, 'gal-2.jpg', 1),
(61, 'gal-3.jpg', 1),
(62, 'gal-4.jpg', 1),
(63, 'gal-5.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dob` date DEFAULT NULL,
  `primaryEmail` varchar(50) NOT NULL,
  `startingYear` year(4) DEFAULT NULL,
  `passingYear` year(4) DEFAULT NULL,
  `ammount` int(11) NOT NULL,
  `membershipbill` text NOT NULL,
  `smartcard` text NOT NULL,
  `confirmation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `userid`, `dob`, `primaryEmail`, `startingYear`, `passingYear`, `ammount`, `membershipbill`, `smartcard`, `confirmation`, `status`) VALUES
(11, 90, NULL, '', NULL, NULL, 3232323, '60cadefcea89a1.18331541.jpg', '60cadefceba240.61221115.jpg', '2021-06-24 11:31:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `emailid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `emailid`) VALUES
(1, 'aditya.shah_19@sakec.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` int(11) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_query` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`id`, `c_email`, `c_query`) VALUES
(6, 'israil.alam_19@sakec.ac.in', 'How to upload the photos'),
(15, 'aditya.shah_19@sakec.ac.in', 'how to login');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `c_query` varchar(8000) NOT NULL,
  `reply` varchar(8000) NOT NULL,
  `replied_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `c_email`, `c_query`, `reply`, `replied_by`) VALUES
(14, 'aditya.shah_19@sakec.ac.in', 'hello', 'ok', 'aditya.shah_19@sakec.ac.in'),
(15, 'aditya.shah_19@sakec.ac.in', 'how to login', 'test123', 'aditya.shah_19@sakec.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'head coordinator'),
(3, 'coordinator'),
(4, 'teacher'),
(5, 'member'),
(6, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `speaker`
--

CREATE TABLE `speaker` (
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
-- Dumping data for table `speaker`
--

INSERT INTO `speaker` (`id`, `event_id`, `name`, `organisation`, `profession`, `description`, `photo`, `linkedIn`, `facebook`, `instagram`) VALUES
(1, 47, 'dhiraj', 'sakec', 'developer', 'abc', 'Planet9_3840x2160.jpg', '', '', ''),
(2, 48, 'dhiraj shetty', 'sakec', 'developer', 'xyz', '60c5e787b52877.83501876.jpeg', '', '', ''),
(3, 48, 'aditya shah', 'sakec', 'programmer', 'abc', '60c5e787b64315.82547545.jpg', '', '', ''),
(4, 48, 'israil', 'sakec', 'developer', 'xyz', '60c5e787b52877.83501876.jpeg', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
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
  `class` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `r_number` int(10) NOT NULL,
  `role` int(15) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `firstName`, `middleName`, `lastName`, `year`, `division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `class`, `password`, `r_number`, `role`, `gender`) VALUES
(1, 'Aditya', 'asa', 'Shah', 'SE', '3', 60, 'aditya.shah_19@sakec.ac.in', 9372622462, 'IT', 'SE', '123', 0, 1, ''),
(2, 'rahul', '', 'soni', '', '', 0, 'rahul.soni_19@sakec.ac.in', 1234567890, 'CS', 'SE', '456', 1552, 6, ''),
(3, 'dhiraj', '', 'shetty', '', '', 0, 'dhiraj.shetty_19@sakec.ac.in', 1598753264, 'CS', 'SE', '789', 1587, 3, ''),
(10, 'israil', '', 'alam', '', '', 0, 'mo.israil.alam_19@sakec.ac.in', 7894561239, 'CS', 'SE', '753', 1575, 2, ''),
(16, 'anand', '', 'tiwari', '', '', 0, 'anand.tiwari_19@sakec.ac.in ', 999999995, 'AI', 'FE4', '123', 10004, 6, ''),
(17, 'shubham', '', 'shah', '', '', 0, 'shubham.shah_19@sakec.ac.in ', 999999994, 'ECS', 'SE5', '123', 10005, 6, ''),
(18, 'saivighnesh', '', 'shetty', '', '', 0, 'saivighnesh.shetty_19@sakec.ac.in ', 999999993, 'CYBER', 'TE6', '123', 10006, 6, ''),
(19, 'agam', '', 'alam', '', '', 0, 'agam.alam_19@sakec.ac.in ', 999999992, 'EXTER', 'BE7', '123', 10007, 6, ''),
(20, 'rohan', '', 'soni', '', '', 0, 'rohan.soni_19@sakec.ac.in ', 999999991, 'CS', 'FE0', '123', 10008, 6, ''),
(21, 'abhishekh', '', 'tiwari', '', '', 0, 'abhishekh.tiwari_19@sakec.ac.in ', 999999990, 'IT', 'SE1', '123', 10009, 6, ''),
(22, 'darshit', '', 'shah', '', '', 0, 'darshit.shah_19@sakec.ac.in ', 999999989, 'ELEC', 'TE2', '123', 10010, 6, ''),
(23, 'omprateek', '', 'shetty', '', '', 0, 'omprateek.shetty_19@sakec.ac.in ', 999999988, 'EXTC', 'BE3', '123', 10011, 6, ''),
(24, 'anant', '', 'alam', '', '', 0, 'anant.alam_19@sakec.ac.in ', 999999987, 'AI', 'FE4', '123', 10012, 6, ''),
(25, 'stuti', '', 'soni', '', '', 0, 'stuti.soni_19@sakec.ac.in ', 999999986, 'ECS', 'SE5', '123', 10013, 6, ''),
(26, 'shweta', '', 'tiwari', '', '', 0, 'shweta.tiwari_19@sakec.ac.in ', 999999985, 'CYBER', 'TE6', '123', 10014, 6, ''),
(27, 'ameya', '', 'shah', '', '', 0, 'ameya.shah_19@sakec.ac.in ', 999999984, 'EXTER', 'BE7', '123', 10015, 6, ''),
(28, 'virat', '', 'shetty', '', '', 0, 'virat.shetty_19@sakec.ac.in ', 999999983, 'CS', 'FE0', '123', 10016, 6, ''),
(29, 'rohit', '', 'alam', '', '', 0, 'rohit.alam_19@sakec.ac.in ', 999999982, 'IT', 'SE1', '123', 10017, 6, ''),
(30, 'sikhar', '', 'soni', '', '', 0, 'sikhar.soni_19@sakec.ac.in ', 999999981, 'ELEC', 'TE2', '123', 10018, 6, ''),
(31, 'ashwin', '', 'tiwari', '', '', 0, 'ashwin.tiwari_19@sakec.ac.in ', 999999980, 'EXTC', 'BE3', '123', 10019, 6, ''),
(32, 'mahendra', '', 'shah', '', '', 0, 'mahendra.shah_19@sakec.ac.in ', 999999979, 'AI', 'FE4', '123', 10020, 6, ''),
(33, 'umesh', '', 'shetty', '', '', 0, 'umesh.shetty_19@sakec.ac.in ', 999999978, 'ECS', 'SE5', '123', 10021, 6, ''),
(34, 'messi', '', 'alam', '', '', 0, 'messi.alam_19@sakec.ac.in ', 999999977, 'CYBER', 'TE6', '123', 10022, 6, ''),
(35, 'bhuvenshwer', '', 'soni', '', '', 0, 'bhuvenshwer.soni_19@sakec.ac.in ', 999999976, 'EXTER', 'BE7', '123', 10023, 6, ''),
(36, 'shreyas', '', 'tiwari', '', '', 0, 'shreyas.tiwari_19@sakec.ac.in ', 999999975, 'CS', 'FE0', '123', 10024, 6, ''),
(37, 'bharat', '', 'shah', '', '', 0, 'bharat.shah_19@sakec.ac.in ', 999999974, 'IT', 'SE1', '123', 10025, 6, ''),
(38, 'harsh', '', 'shetty', '', '', 0, 'harsh.shetty_19@sakec.ac.in ', 999999973, 'ELECTRONIC', 'TE2', '123', 10026, 6, ''),
(39, 'hardik', '', 'alam', '', '', 0, 'hardik.alam_19@sakec.ac.in ', 999999972, 'EXTC', 'BE3', '123', 10027, 6, ''),
(40, 'krunal', '', 'soni', '', '', 0, 'krunal.soni_19@sakec.ac.in ', 999999971, 'AI', 'FE4', '123', 10028, 6, ''),
(41, 'abraham', '', 'tiwari', '', '', 0, 'abraham.tiwari_19@sakec.ac.in ', 999999970, 'ECS', 'SE5', '123', 10029, 6, ''),
(57, 'Dhruvi', '', 'Jain', '', '', 0, 'dhruvi.jain_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 2, ''),
(58, 'Yukta', '', 'Lapsiya', '', '', 0, 'yukta.lapsiya_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(59, 'Pratik', '', 'Upadhyay', '', '', 0, 'pratik.upadhyay_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(60, 'Aagam', '', 'Sheth', '', '', 0, 'aagam.sheth_19@sakec.ac.in', 9999999999, 'CS', 'SE', '123', 54545, 3, ''),
(61, 'Krutik', '', 'Patel', '', '', 0, 'krutik.patel_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(62, 'Preet', '', 'Karia', '', '', 0, 'preet.karia_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(63, 'Rutvik', '', 'Deshpande', '', '', 0, 'rutvik.deshpande_19@sakec.ac.in', 9999999999, 'CS', 'SE', '123', 54545, 3, ''),
(64, 'Ritik', '', 'Mahajan', '', '', 0, 'rutvik.mahajan_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(65, 'Ridhi', '', 'Dagha', '', '', 0, 'ridhi.dagha_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(66, 'Shalin', '', 'Gund', '', '', 0, 'shalin.gund_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(67, 'Simran ', '', 'Jindal', '', '', 0, 'simran.jindal_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(68, 'Zarana ', '', 'Desai', '', '', 0, 'zarana.desai_19@sakec.ac.in', 9999999999, 'CS', 'SE', '123', 54545, 3, ''),
(69, 'Parth ', '', 'Panchal', '', '', 0, 'parth.panchal_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(70, 'Atharva ', '', 'Juikar', '', '', 0, 'atharva.juikar_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(71, 'Bhavika ', '', 'Salshingikar', '', '', 0, 'bhavika.salshingikar_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(72, 'Ritika ', '', 'Boricha', '', '', 0, 'ritika.boricha_17@sakec.ac.in', 9999999999, 'CS', 'BE', '123', 54545, 3, ''),
(89, 'Dhiraj', 'harish', 'shetty', 'TE', '3', 56, 'c@sakec.ac.in ', 9998887776, 'IT', 'FE', '$2y$10$iYbhEjuZ9TQGWnziCVNH1.Q0NzwmuFvFyVDybeEgeLIo8VVNymHu2', 12345, 1, ''),
(90, 'Rahul', '', 'Lit', '', '', 0, 'sixnine@sakec.ac.in ', 6969696969, 'CS', 'TE', '$2y$10$dt8CQgxhc1AZTHHGOXKblu188qhrcYadG2bmBPYTNdY5hUfaK886S', 11111, 6, '');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `event_id`, `location`) VALUES
(1, 47, '4th-Floor Seminar Hall');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaboration`
--
ALTER TABLE `collaboration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `contentrepository`
--
ALTER TABLE `contentrepository`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eventid` (`eventid`);

--
-- Indexes for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speaker`
--
ALTER TABLE `speaker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collaboration`
--
ALTER TABLE `collaboration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `contentrepository`
--
ALTER TABLE `contentrepository`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `speaker`
--
ALTER TABLE `speaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collaboration`
--
ALTER TABLE `collaboration`
  ADD CONSTRAINT `collaboration_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userdata` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `collection_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contentrepository`
--
ALTER TABLE `contentrepository`
  ADD CONSTRAINT `contentrepository_ibfk_1` FOREIGN KEY (`eventid`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `userdata` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `speaker`
--
ALTER TABLE `speaker`
  ADD CONSTRAINT `speaker_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userdata`
--
ALTER TABLE `userdata`
  ADD CONSTRAINT `userdata_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `venue`
--
ALTER TABLE `venue`
  ADD CONSTRAINT `venue_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
