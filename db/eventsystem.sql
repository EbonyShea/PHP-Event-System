-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 10:08 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `a_ID` char(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `a_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_ID` char(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_ID` char(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`a_ID`, `a_date`, `event_ID`, `user_ID`) VALUES
('A0001', '2018-02-14 22:49:57', 'E0013', 'U0001'),
('A0001', '2018-02-14 22:50:11', 'E0008', 'U0001'),
('A0001', '2018-02-14 22:50:14', 'E0006', 'U0001'),
('A0001', '2018-02-14 22:51:07', 'E0015', 'U0002'),
('A0001', '2018-02-14 22:51:10', 'E0010', 'U0002'),
('A0001', '2018-02-14 22:51:14', 'E0005', 'U0002'),
('A0001', '2018-02-14 22:51:20', 'E0008', 'U0002'),
('A0001', '2018-02-15 07:43:29', 'E0015', 'U0001'),
('A0001', '2018-02-15 07:43:31', 'E0014', 'U0001'),
('A0001', '2018-02-15 07:43:32', 'E0012', 'U0001'),
('A0001', '2018-02-15 07:43:35', 'E0011', 'U0001'),
('A0001', '2018-02-15 07:43:36', 'E0010', 'U0001'),
('A0001', '2018-02-15 07:43:37', 'E0009', 'U0001'),
('A0001', '2018-02-15 07:43:40', 'E0007', 'U0001'),
('A0001', '2018-02-15 07:43:41', 'E0005', 'U0001'),
('A0001', '2018-02-15 07:45:02', 'E0015', 'U0003'),
('A0001', '2018-02-15 07:45:06', 'E0014', 'U0003'),
('A0001', '2018-02-23 08:20:08', 'E0014', 'U0002'),
('A0001', '2018-02-25 11:15:53', 'E0015', 'U0004'),
('A0001', '2018-02-25 11:18:55', 'E0014', 'U0004');

-- --------------------------------------------------------

--
-- Table structure for table `content_ctr`
--

CREATE TABLE `content_ctr` (
  `Content_Type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Counter` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content_ctr`
--

INSERT INTO `content_ctr` (`Content_Type`, `Counter`) VALUES
('user', 4),
('event', 30),
('attendance', 0);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_ID` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `event_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `event_Desc` longtext COLLATE utf8_unicode_ci NOT NULL,
  `event_Img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `event_Start` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `event_End` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `event_Category` enum('Sport','Music','Art','Social','Miscellaneous') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Miscellaneous',
  `event_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_Organizer` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `event_Venue` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_ID`, `event_Name`, `event_Desc`, `event_Img`, `event_Start`, `event_End`, `event_Category`, `event_Date`, `event_Organizer`, `event_Venue`) VALUES
('E0005', 'Capture Every Moment (iPhone & DSLR Photography)', 'In this workshop we will be showing you how you can shoot and edit your photos by using the only iPhone itself, and get a good and professional looking outcome, or if you are into DSLR, we will be sharing some of the basic tips and tricks as well. :)', 'E0005.jpg', '2018-02-21T20:00', '2018-02-21T21:00', 'Art', '2018-02-15 06:15:43', 'Generic Organizer', 'Kuala Lumpur Center'),
('E0006', 'Make Music with GarageBand iOS Workshop', 'Are you a music lover? Someone who wanted to create your own beat but having limited knowledge on music? Never played an instrument before but having a strong passion and interest towards music and hope someday you can express yourself with at-least one musical instrument? Well this workshop is for you!', 'E0006.jpg', '2018-03-07T20:00', '2018-03-07T21:00', 'Music', '2018-02-15 06:23:06', 'Dahaha Organizer', 'Arc Carpark'),
('E0007', 'Community Workout with Armadas EliteZone ', 'Register and attend the Spartan Community workout lead by Armadas EliteZone to help you #SpartanUp for the upcoming Sprint on 15th April at Semenyih !! #AROO!!', 'E0007.jpg', '2018-03-04T08:00', '2018-03-05T09:00', 'Sport', '2018-02-15 06:28:38', 'Yatta Sdn. Bhd.', 'My house'),
('E0008', 'Jumpstart your Business Online', 'If you\\\\\\\'re planning to start a business, move your existing business online, or explore new opportunities without the need for any technical knowledge, this session is for you.', 'E0008.jpg', '2018-03-08T20:00', '2018-03-09T20:00', 'Miscellaneous', '2018-02-15 06:31:28', 'Me notreally', 'Company Garage'),
('E0009', 'Flip Your Way Property Investment Workshop', 'This 3-Hour Flip Your Way program is perfect for anyone who is determined to create another source of income, grow their wealth and enjoy a better quality of life.', 'E0009.png', '2018-02-28T19:00', '2018-02-28T22:00', 'Social', '2018-02-15 06:33:18', 'Microsoft', 'IOI City Mall'),
('E0010', 'CDR Writing Training Webinar (online)', 'Competency Demonstration Report (CDR) is the skill assessment report, required by the Engineers Australia from those Engineers who want to apply for Permanent Residency in Australia and do not hold an accredited engineering qualification.', 'E0010.png', '2018-03-10T19:00', '2018-03-12T19:00', 'Miscellaneous', '2018-02-15 06:34:35', 'Peh', 'Poof'),
('E0011', 'JB eVARTHAGAR Saathanai MeetUp', 'eVARTHAGAR Saathanai meet up by #myTEC  #eVarthagar4u , ', 'E0011.jpg', '2018-02-18T18:00', '2018-02-18T19:00', 'Social', '2018-02-15 06:35:45', 'The big one', 'The space space one'),
('E0012', 'Olympus Johor Photowalk - Macro Photography', 'Have you always wanted to give Macro Photography a try but do not know where to start? Join us, and we will bring you into the mysterious world of the little critters and bugs.', 'E0012.jpg', '2018-02-25T09:00', '2018-02-25T12:00', 'Art', '2018-02-15 06:36:48', 'Insects overlord', 'Anywhere'),
('E0013', 'Gain 20% ROI in the Stock Market with Options', 'Join our free preview to learn how to use it by clicking on the Register Button.', 'E0013.jpg', '2018-03-24T14:30', '2018-03-25T17:30', 'Miscellaneous', '2018-02-15 06:38:16', 'Stooooocks Sdn. Bhd.', 'Company carpark'),
('E0014', 'Mad in Italy', 'A Mezzotono show is entirely executed by five voices a-cappella with a repertoire of defining Italian music sung in many styles. Whether pop or jazz and bossa nova, mambo or tango, big band or classical music, all the songs have been given a fresh new twist by their arrangements and the inventive contribution of the rhythmic-vocal section.', 'E0014.jpg', '2018-03-12T20:00', '2018-03-12T22:00', 'Music', '2018-02-15 06:39:21', 'DA ITALIANS', 'Queen street'),
('E0015', 'BCI EQUINOX JOHOR BAHRU', 'To see what BCI Equinox is like, click here to see our time lapse video from an Equinox event in Australia.  Registration is free and easy - simply click on the Register button and follow the prompts.', 'E0015.jpg', '2018-04-05T16:00', '2018-04-06T21:00', 'Social', '2018-02-15 06:40:20', 'No idea already', 'Here');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `username`, `password`, `email`, `type`) VALUES
('U0001', 'Admin', '$2y$10$gUs2G3TDChFb6jq4DBIy6.UwQJLKN1vMPIFGQgdGBxmuwkgvsB4W.', 'admin@gmail.com', '1'),
('U0002', 'huisishea', '$2y$10$V8Hp5mMf6HqcODZpIszK..mMiCzCSBqcgZ4wEDM/FSNgDjKLHSqFa', 'huisishea@gmail.com', '0'),
('U0003', 'testing', '$2y$10$Z.QVvsZ/JapYzmO88bsPyepicPa4AlUrXFHFFrHIgoLaWD7IKmKqS', 'testing@gmail.com', '0'),
('U0004', 'sheahuisi', '$2y$10$eX9jt0nD0JoWbnYgHP0eJu.2DsthsIYHQC25GhX8Dz/20mwxaILUq', 'sheahuisi@gmail.com', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD KEY `event_ID` (`event_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_ID`),
  ADD UNIQUE KEY `event_ID` (`event_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `user_ID` (`user_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `event` (`event_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
