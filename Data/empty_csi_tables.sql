-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2021 at 12:28 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `csi_collaboration`
--

CREATE TABLE `csi_collaboration` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `collab_body` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `csi_contentrepository`
--

CREATE TABLE `csi_contentrepository` (
  `id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `csi_event_likes`
--

CREATE TABLE `csi_event_likes` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `csi_newsletter`
--

CREATE TABLE `csi_newsletter` (
  `id` int(11) NOT NULL,
  `emailid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 1, '$2y$10$OH/Ozhyki4Spazla9ojC5ucBUwbGgM.uKfJgpigTHRNbLN0PIesX2');

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
(1, 'admin', '', NULL, NULL, 'admin@sakec.ac.in ', 9999999999, '', 1, '', 'sakec');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_collaboration`
--
ALTER TABLE `csi_collaboration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_collection`
--
ALTER TABLE `csi_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_contact`
--
ALTER TABLE `csi_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_contentrepository`
--
ALTER TABLE `csi_contentrepository`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_coordinator`
--
ALTER TABLE `csi_coordinator`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_event`
--
ALTER TABLE `csi_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_event_likes`
--
ALTER TABLE `csi_event_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_expense`
--
ALTER TABLE `csi_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_feedback`
--
ALTER TABLE `csi_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_gallery`
--
ALTER TABLE `csi_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_membership`
--
ALTER TABLE `csi_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_membership_bills`
--
ALTER TABLE `csi_membership_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_newsletter`
--
ALTER TABLE `csi_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_password`
--
ALTER TABLE `csi_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `csi_query`
--
ALTER TABLE `csi_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_reply`
--
ALTER TABLE `csi_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_role`
--
ALTER TABLE `csi_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `csi_speaker`
--
ALTER TABLE `csi_speaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `csi_userdata`
--
ALTER TABLE `csi_userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `csi_venue`
--
ALTER TABLE `csi_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
