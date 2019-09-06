-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2019 at 08:01 AM
-- Server version: 5.7.15
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matchdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ID` int(15) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `EVENTDATE` varchar(20) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID`, `USERNAME`, `EVENTDATE`, `DESCRIPTION`) VALUES
(5, 'User1', '2019 4 22', 'asd ads'),
(6, 'User1', '2019 4 8', 'ds as'),
(10, 'User1', '2019 4 17', 'fgd'),
(13, 'User1', '2019 4 11', 'sdfg sfg'),
(20, 'User1', '2019 4 31', 'as'),
(25, 'User1', '2019 4 27', 'ex: Soccer at 18:00'),
(28, 'User1', '2019 2 6', 'ex: Soccer at 18:00'),
(31, 'User1', '2019 7 15', 'ex: Soccer at 18:00'),
(32, 'User1', '2019 8 12', 'ex: Soccer at 18:00'),
(46, 'User1', '2019 4 6', 'ex: Soccer at 18:00'),
(49, 'user1', '2019 5 15', 'no plans at 6'),
(51, 'user1', '2019 6 11', 'exam lol');

-- --------------------------------------------------------

--
-- Table structure for table `matchboard`
--

CREATE TABLE `matchboard` (
  `id` int(8) NOT NULL,
  `owner` varchar(30) NOT NULL,
  `gametype` varchar(20) NOT NULL,
  `sportstype` varchar(20) NOT NULL,
  `teamtype` varchar(20) NOT NULL,
  `userlimit` int(8) DEFAULT '0',
  `currentusers` int(8) NOT NULL,
  `views` int(8) DEFAULT '0',
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(256) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matchboard`
--

INSERT INTO `matchboard` (`id`, `owner`, `gametype`, `sportstype`, `teamtype`, `userlimit`, `currentusers`, `views`, `createdate`, `description`, `title`) VALUES
(1, 'user2', 'BATTLEGROUND', 'ESPORT', 'SINGLE', 1, 1, 19, '2019-06-11 02:08:47', 'hehe\r\n', 'lets battle'),
(2, 'user2', 'TENNIS', 'SPORT', 'TEAM', 0, 11, 9, '2019-06-11 02:11:24', 'call me:', 'for anyone'),
(3, 'user1', 'BATTLEGROUND', 'ESPORT', 'TEAM', 2, 4, 8, '2019-06-11 02:12:28', 'join us', 'pubg team'),
(4, 'user1', 'SOCCER', 'SPORT', 'TEAM', 1, 4, 5, '2019-06-11 02:13:16', 'hehe', 'team super'),
(5, 'user5', 'OVERWATCH', 'ESPORT', 'SINGLE', 0, 1, 3, '2019-06-11 02:14:07', 'come', 'wanna overwatch'),
(6, 'user5', 'SOCCER', 'SPORT', 'TEAM', 1, 10, 4, '2019-06-11 02:14:33', 'asd', 'soccer team'),
(7, 'user4', 'BASEBALL', 'SPORT', 'TEAM', 0, 16, 1, '2019-06-11 02:16:53', 'sad', 'nevergiveup'),
(8, 'user4', 'SOCCER', 'SPORT', 'TEAM', 0, 21, 3, '2019-06-11 02:17:26', 'as', 'soccerlover'),
(9, 'user4', 'LOL', 'ESPORT', 'TEAM', 0, 4, 3, '2019-06-11 02:18:01', 'come here babe', 'lol lol'),
(10, 'user1', 'OVERWATCH', 'ESPORT', 'TEAM', 0, 2, 1, '2019-06-11 02:32:12', 'afffffffffadsf', 'new'),
(11, 'user1', 'OVERWATCH', 'ESPORT', 'SINGLE', 2, 3, 5, '2019-06-11 02:42:07', 'letsplay', 'newteam'),
(27, 'user1', 'SOCCER', 'SPORT', 'Single', 12, 0, 0, '2019-07-26 11:52:16', 'test', 'test'),
(28, 'user1', 'BASEBALL', 'SPORT', 'SINGLE', 2, 2, 5, '2019-07-26 11:56:53', 'come on come on babe', 'dsfkl'),
(29, 'user1', 'BATTLEGROUND', 'ESPORT', 'TEAM', 4, 0, 2, '2019-07-26 12:03:53', 'ads', '818'),
(30, 'user1', 'SOCCER', 'SPORT', 'SINGLE', 2, 0, 0, '2019-07-26 12:46:46', 'asdsdfa', 'yeahlol'),
(31, 'user1', 'SOCCER', 'SPORT', 'SINGLE', 23, 0, 0, '2019-07-26 12:47:19', 'asd', 'asdf'),
(32, 'user1', 'OVERWATCH', 'ESPORT', 'TEAM', 22, 1, 2, '2019-07-26 14:39:30', 'asdfdsa\nasd', 'fds'),
(33, 'user1', 'ROCKET', 'ESPORT', 'TEAM', 11111, 2, 6, '2019-09-06 15:50:10', 'dsafdsa', 'gruppa');

-- --------------------------------------------------------

--
-- Table structure for table `messagetable`
--

CREATE TABLE `messagetable` (
  `userid` varchar(30) DEFAULT NULL,
  `boardid` int(8) DEFAULT NULL,
  `content` varchar(50) DEFAULT NULL,
  `isread` int(8) DEFAULT '0',
  `receiveDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messagetable`
--

INSERT INTO `messagetable` (`userid`, `boardid`, `content`, `isread`, `receiveDate`) VALUES
('user4', 19, '참가 신청했습니다.', 0, '2019-06-11 02:18:17'),
('user1', 19, '참가 신청이 왔습니다.', 0, '2019-06-11 02:18:17'),
('user1', 21, '참가 신청했습니다.', 0, '2019-06-11 02:33:16'),
('user5', 21, '참가 신청이 왔습니다.', 0, '2019-06-11 02:33:16'),
('user5', 18, '참가 신청했습니다.', 0, '2019-06-11 02:33:57'),
('user1', 18, '참가 신청이 왔습니다.', 0, '2019-06-11 02:33:57'),
('user4', 18, '참가 신청했습니다.', 0, '2019-06-11 02:34:25'),
('user1', 18, '참가 신청이 왔습니다.', 0, '2019-06-11 02:34:25'),
('user1', 18, '매칭이 확정되었습니다', 0, '2019-06-11 02:35:14'),
('user5', 18, '매칭이 확정되었습니다', 0, '2019-06-11 02:35:14'),
('user4', 18, '매칭이 확정되었습니다', 0, '2019-06-11 02:35:14'),
('user1', 16, '참가 신청했습니다.', 0, '2019-06-11 02:43:27'),
('user2', 16, '참가 신청이 왔습니다.', 0, '2019-06-11 02:43:27'),
('user2', 16, '매칭이 확정되었습니다', 0, '2019-06-11 02:44:13'),
('user1', 16, '매칭이 확정되었습니다', 0, '2019-06-11 02:44:13'),
('user2', 16, '매칭이 확정되었습니다', 0, '2019-06-11 02:44:26'),
('user1', 16, '매칭이 확정되었습니다', 0, '2019-06-11 02:44:26'),
('user2', 16, '매칭이 확정되었습니다', 0, '2019-06-11 02:44:44'),
('user1', 16, '매칭이 확정되었습니다', 0, '2019-06-11 02:44:44'),
('user2', 16, '매칭이 확정되었습니다', 0, '2019-06-11 02:45:03'),
('user1', 16, '매칭이 확정되었습니다', 0, '2019-06-11 02:45:03'),
('user2', 26, '참가 신청했습니다.', 0, '2019-06-11 02:45:37'),
('user1', 26, '참가 신청이 왔습니다.', 0, '2019-06-11 02:45:37'),
('user5', 26, '참가 신청했습니다.', 0, '2019-06-11 02:45:58'),
('user1', 26, '참가 신청이 왔습니다.', 0, '2019-06-11 02:45:58'),
('user1', 26, '매칭이 확정되었습니다', 0, '2019-06-11 02:47:15'),
('user2', 26, '매칭이 확정되었습니다', 0, '2019-06-11 02:47:15'),
('user5', 26, '매칭이 되지 않았습니다.', 0, '2019-06-11 02:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `boardid` int(8) DEFAULT NULL,
  `groupname` varchar(30) NOT NULL,
  `req_from` varchar(30) DEFAULT NULL,
  `req_to` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`boardid`, `groupname`, `req_from`, `req_to`) VALUES
(8, '', 'user', 'user4'),
(2, '', 'user', 'user2'),
(7, '', 'user', 'user4'),
(11, 'newteam', 'user', 'user1'),
(11, 'newteam', 'user', 'user1'),
(28, 'dsfkl', 'user', 'user1'),
(28, 'dsfkl', 'user', 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userid` varchar(30) NOT NULL,
  `userpassword` varchar(30) DEFAULT NULL,
  `kakao` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userid`, `userpassword`, `kakao`) VALUES
('user1', 'user1', 'kakao1'),
('user2', 'user2', 'kakao2'),
('user3', 'user3', 'kakao3'),
('user4', 'user4', 'kakao4'),
('user5', 'user5', 'kakao5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `matchboard`
--
ALTER TABLE `matchboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `matchboard`
--
ALTER TABLE `matchboard`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
