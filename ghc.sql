-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 21, 2021 at 03:18 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ghc`
--

-- --------------------------------------------------------

--
-- Table structure for table `datt`
--

CREATE TABLE IF NOT EXISTS `datt` (
  `sn` int(4) NOT NULL AUTO_INCREMENT,
  `snd` int(8) DEFAULT NULL,
  `dd` varchar(4) DEFAULT NULL,
  `ww` varchar(4) DEFAULT NULL,
  `w` varchar(4) DEFAULT NULL,
  `mm` varchar(4) DEFAULT NULL,
  `yy` varchar(4) DEFAULT NULL,
  `day` varchar(10) DEFAULT NULL,
  `date` varchar(16) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ymd` int(8) DEFAULT NULL,
  `x` varchar(25) DEFAULT NULL,
  `y` varchar(25) DEFAULT NULL,
  `z` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `doc`
--

CREATE TABLE IF NOT EXISTS `doc` (
  `sn` int(12) NOT NULL AUTO_INCREMENT,
  `id` varchar(12) DEFAULT NULL,
  `job` int(7) DEFAULT NULL,
  `doc` varchar(200) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `rep` varchar(100) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `sn` int(16) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) DEFAULT NULL,
  `fee` varchar(12) NOT NULL DEFAULT '0',
  `date` varchar(55) DEFAULT NULL,
  `detail` varchar(225) DEFAULT NULL,
  `cat` varchar(12) DEFAULT NULL,
  `ven` varchar(55) DEFAULT NULL,
  `rep` varchar(55) DEFAULT NULL,
  `ymd` varchar(8) DEFAULT NULL,
  `ww` varchar(6) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tno` varchar(16) DEFAULT NULL,
  `status` int(2) DEFAULT '0',
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`sn`, `title`, `fee`, `date`, `detail`, `cat`, `ven`, `rep`, `ymd`, `ww`, `created`, `tno`, `status`) VALUES
(1, 'JoblessBillionaire Opening Ceremony', '4000', '24th August, 2017,  10am ', 'More than 7/10 people planning trips will be hoping to see all the rates and the hotel facilities. Your site will allow them to choose the best available offer without them having to leave the site to find this elsewhere.', '0', NULL, 'Ogbaji Godwin', '170731', '31', '2017-07-31 11:25:37', '7613567340594253', 0),
(2, 'Purchase of Laptop Computer', '48787', '24th August, 2017,  10am ', 'More than 7/10 people planning trips will be hoping to see all the rates and the hotel facilities. Your site will allow them to choose the best available offer without them having to leave the site to find this elsewhere.', '0', NULL, 'Ogbaji Godwin', '170731', '31', '2017-07-31 11:42:18', '7266717112341367', 0),
(3, 'Purchase of Laptop Computer', '0', '24th August, 2017,  10am ', 'More than 7/10 people planning trips will be hoping to see all the rates and the hotel facilities. Your site will allow them to choose the best available offer without them having to leave the site to find this elsewhere.', '1', NULL, 'Ogbaji Godwin', '170731', '31', '2017-07-31 11:35:56', '5778161035596289', 0),
(4, 'Purchase of Laptop Computer', '200', '24th August, 2017,  10am ', 'akure event', '0', 'Awule Church', 'Ogbaji Godwin', '170731', '31', '2017-07-31 11:40:37', '8529577389402306', 1),
(5, 'Purchase of Laptop Computer', '6000', '24th August, 2017,  10am ', 'More than 7/10 people planning trips will be hoping to see all the rates and the hotel facilities. Your site will allow them to choose the best available offer without them having to leave the site to find this elsewhere.', '2', 'Awule Church', 'Ogbaji Godwin', '170731', '31', '2017-07-31 12:18:43', '8261673332064541', 0);

-- --------------------------------------------------------

--
-- Table structure for table `eventp`
--

CREATE TABLE IF NOT EXISTS `eventp` (
  `sn` int(16) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) DEFAULT NULL,
  `fee` varchar(12) NOT NULL DEFAULT '0',
  `date` varchar(55) DEFAULT NULL,
  `name` varchar(55) DEFAULT NULL,
  `id` varchar(12) DEFAULT NULL,
  `eventid` varchar(12) DEFAULT NULL,
  `cat` varchar(12) DEFAULT NULL,
  `ymd` varchar(8) DEFAULT NULL,
  `ww` varchar(6) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tno` varchar(16) DEFAULT NULL,
  `status` int(2) DEFAULT '0',
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `eventp`
--

INSERT INTO `eventp` (`sn`, `title`, `fee`, `date`, `name`, `id`, `eventid`, `cat`, `ymd`, `ww`, `created`, `tno`, `status`) VALUES
(1, 'Purchase of Laptop Computer', '6000', '24th August, 2017,  10am ', 'ELIZABETH  GABRIEL', '3', '5', '2', '170731', '31', '2017-07-31 13:04:52', '1507344123222633', 0),
(2, 'JoblessBillionaire Opening Ceremony', '4000', '24th August, 2017,  10am ', 'ELIZABETH  GABRIEL', '3', '1', '0', '170731', '31', '2017-07-31 13:09:03', '2371299212852931', 0),
(3, 'Purchase of Laptop Computer', '200', '24th August, 2017,  10am ', 'ELIZABETH  GABRIEL', '3', '4', '0', '170731', '31', '2017-07-31 13:38:16', '8912593221067511', 0),
(4, 'JoblessBillionaire Opening Ceremony', '4000', '24th August, 2017,  10am ', 'salamatu Bala', '8', '1', '0', '170801', '31', '2017-08-01 09:47:58', '364367451370', 0),
(5, 'Purchase of Laptop Computer', '6000', '24th August, 2017,  10am ', 'Samuel Esther', '1', '5', '2', '170801', '31', '2017-08-01 12:55:24', '217017783511', 0),
(6, 'Purchase of Laptop Computer', '200', '24th August, 2017,  10am ', 'Samuel Esther', '1', '4', '0', '170801', '31', '2017-08-01 13:03:35', '758163231620', 0),
(7, 'JoblessBillionaire Opening Ceremony', '4000', '24th August, 2017,  10am ', 'Samuel Esther', '1', '1', '0', '170802', '31', '2017-08-02 13:02:33', '721462173974', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invacc`
--

CREATE TABLE IF NOT EXISTS `invacc` (
  `sn` int(16) NOT NULL AUTO_INCREMENT,
  `trno` varchar(16) DEFAULT NULL,
  `amount` int(12) DEFAULT '0',
  `tenure` int(2) DEFAULT NULL,
  `roi` varchar(8) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `paydetails` varchar(555) DEFAULT NULL,
  `cos` int(16) DEFAULT '0',
  `tan` int(16) DEFAULT '0',
  `status` int(2) DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `x` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `invacc`
--

INSERT INTO `invacc` (`sn`, `trno`, `amount`, `tenure`, `roi`, `userid`, `paydetails`, `cos`, `tan`, `status`, `created`, `x`) VALUES
(1, '778618352232', 60000, 12, NULL, '3rmy3sji', NULL, 0, 0, NULL, '2019-07-25 08:36:25', NULL),
(2, '167457492236', 60000, 12, '1440', '3rmy3sji', NULL, 0, 0, NULL, '2019-07-25 08:38:42', NULL),
(3, '121197429749', 60000, 24, '1440', '3rmy3sji', NULL, 0, 0, NULL, '2019-07-25 08:39:04', NULL),
(4, '896116682649', 80000, 12, '23040', '3rmy3sji', NULL, 0, 0, NULL, '2019-07-25 08:39:51', NULL),
(5, '435189163821', 60000, 24, '34560', '3rmy3sji', NULL, 0, 0, NULL, '2019-07-25 08:39:59', NULL),
(8, '138489216779', 60000, 9, '12960', '3rmy3sji', NULL, 1564049396, 1587377396, 2, '2019-07-25 10:09:56', NULL),
(10, '875711213824', 50000, 12, '14400', 'btwnmgn4', NULL, 0, 0, 1, '2019-10-17 18:04:06', NULL),
(12, '951878377276', 100000, 6, '14400', 'mnqtf3y2', NULL, 0, 0, 1, '2020-01-18 19:53:20', NULL),
(14, '542952667643', 200000, 12, '57600', 'csy9eua5', NULL, 0, 0, 1, '2020-11-07 07:40:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investini`
--

CREATE TABLE IF NOT EXISTS `investini` (
  `sn` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id` varchar(12) DEFAULT NULL,
  `amount` int(8) DEFAULT NULL,
  `status` int(2) DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code` varchar(65) DEFAULT NULL,
  UNIQUE KEY `sn` (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
  `sn` int(12) NOT NULL AUTO_INCREMENT,
  `trno` varchar(24) DEFAULT NULL,
  `id` varchar(24) DEFAULT NULL,
  `loan` int(12) DEFAULT NULL,
  `interest` int(9) DEFAULT NULL,
  `instalment` int(4) DEFAULT NULL,
  `periodic` int(12) DEFAULT NULL,
  `start` int(12) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`sn`, `trno`, `id`, `loan`, `interest`, `instalment`, `periodic`, `start`, `created`, `status`) VALUES
(1, '573149769673', 'csy9eua5', 48000, 9360, 3, NULL, 1564041164, '2019-07-25 07:52:45', 4),
(2, '663586214526', 'btwnmgn4', 35000, 4550, 2, NULL, 0, '2019-10-17 18:15:37', 2),
(3, '588922241178', 'mnqtf3y2', 30000, 3900, 2, NULL, 0, '2020-06-13 14:21:02', 2),
(4, '943624124547', '5e273uwb', 50000, 9750, 3, NULL, 0, '2020-06-13 14:47:45', 2);

-- --------------------------------------------------------

--
-- Table structure for table `loantranch`
--

CREATE TABLE IF NOT EXISTS `loantranch` (
  `sn` int(12) NOT NULL AUTO_INCREMENT,
  `trno` varchar(24) DEFAULT NULL,
  `id` varchar(24) DEFAULT NULL,
  `instal` int(4) DEFAULT NULL,
  `loan` int(10) DEFAULT NULL,
  `tranch` int(10) DEFAULT NULL,
  `start` int(12) DEFAULT NULL,
  `paid` int(12) NOT NULL DEFAULT '0',
  `reference` varchar(24) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `loantranch`
--

INSERT INTO `loantranch` (`sn`, `trno`, `id`, `instal`, `loan`, `tranch`, `start`, `paid`, `reference`, `created`) VALUES
(1, '573149769673', 'csy9eua5', 1, 48000, 19100, 1569225164, 1564041256, 'csy9eua5', '2019-07-25 07:54:17'),
(2, '573149769673', 'csy9eua5', 2, 48000, 19100, 1571817164, 1564041269, 'csy9eua5', '2019-07-25 07:54:30'),
(3, '573149769673', 'csy9eua5', 3, 48000, 19160, 1574409164, 0, '0', '2019-07-25 07:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `logdraw`
--

CREATE TABLE IF NOT EXISTS `logdraw` (
  `sn` int(16) NOT NULL AUTO_INCREMENT,
  `id` varchar(12) DEFAULT NULL,
  `id2` varchar(55) DEFAULT NULL,
  `inibalance` varchar(12) DEFAULT NULL,
  `amount` varchar(12) DEFAULT NULL,
  `finalbalance` varchar(12) DEFAULT NULL,
  `ymd` varchar(8) DEFAULT NULL,
  `ww` varchar(6) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tno` varchar(16) DEFAULT NULL,
  `status` varchar(55) DEFAULT NULL,
  `type` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `logdraw`
--

INSERT INTO `logdraw` (`sn`, `id`, `id2`, `inibalance`, `amount`, `finalbalance`, `ymd`, `ww`, `created`, `tno`, `status`, `type`) VALUES
(1, '1320', '91a978b5a8e866d4a86e2c4c5dacbb84', '145', '25', '120', '180523', '1821', '2018-05-23 13:08:20', '5453239443907183', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'E-PIN Purchase'),
(2, '2493', '91a978b5a8e866d4a86e2c4c5dacbb84', '120', '54', '66', '180523', '1821', '2018-05-24 12:14:12', '6447246415543634', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'Cash Withdrawal'),
(3, '7774', '91a978b5a8e866d4a86e2c4c5dacbb84', '66', '25', '41', '180529', '1822', '2018-05-29 13:43:42', '8682908976310551', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'E-PIN Purchase'),
(4, '6250', 'qbz6qfpuo2g5jgf8', '2500', '100', '2400', '180531', '1822', '2018-05-31 21:00:14', '6251630753879290', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'Club Wallet Inve'),
(5, '3080', 'qbz6qfpuo2g5jgf8', '2500', '500', '2000', '180531', '1822', '2018-05-31 21:34:25', '7525838009634100', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'Club Wallet Inve'),
(6, '2587', 'qbz6qfpuo2g5jgf8', '2500', '250', '2250', '180531', '1822', '2018-05-31 21:39:09', '8954048850256112', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'Investment Walle'),
(7, '6360', 'qbz6qfpuo2g5jgf8', '2500', '500', '2000', '180531', '1822', '2018-05-31 21:47:56', '6488691452390765', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'Investment Walle'),
(8, '4872', 'qbz6qfpuo2g5jgf8', '2500', '50', '2450', '180531', '1822', '2018-05-31 22:22:49', '2715829530458459', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'Investment Walle'),
(9, '9507', 'qbz6qfpuo2g5jgf8', '2500', '50', '2450', '180531', '1822', '2018-05-31 22:26:06', '1122688261479253', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'Investment Walle'),
(10, '7540', 'qbz6qfpuo2g5jgf8', '2500', '500', '2000', '180601', '1822', '2018-06-01 14:06:42', '6487698195548713', '77de68daecd823babbb58edb1c8e14d7106e83bb', 'Investment Cash '),
(11, '7870', 'qbz6qfpuo2g5jgf8', '2500', '200', '2300', '180601', '1822', '2018-06-01 14:23:09', '0736960024570689', '77de68daecd823babbb58edb1c8e14d7106e83bb', 'Investment Cash '),
(12, '8526', 'qbz6qfpuo2g5jgf8', '2500', '75', '2425', '180601', '1822', '2018-06-01 14:28:11', '4451996851521538', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'E-PIN Purchase'),
(13, '3843', 'qbz6qfpuo2g5jgf8', '2500', '25', '2475', '180601', '1822', '2018-06-01 14:41:05', '3449321476827825', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'E-PIN Purchase f'),
(14, '7943', 'f8f3e3ccea2ee42742c8cf06aa88b8b0', '145', '51', '94', '180613', '1824', '2018-06-13 11:40:01', '7941914346207379', '77de68daecd823babbb58edb1c8e14d7106e83bb', 'Bonus Cash Withd'),
(15, '5610', 'f8f3e3ccea2ee42742c8cf06aa88b8b0', '94', '26.52', '67.48', '180613', '1824', '2018-06-13 14:46:44', '7474125004447783', '77de68daecd823babbb58edb1c8e14d7106e83bb', 'Bonus Cash Withd');

-- --------------------------------------------------------

--
-- Table structure for table `mdata`
--

CREATE TABLE IF NOT EXISTS `mdata` (
  `sn` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `metrix`
--

CREATE TABLE IF NOT EXISTS `metrix` (
  `sn` int(4) NOT NULL AUTO_INCREMENT,
  `pa` varchar(4) DEFAULT '20',
  `pb` varchar(4) DEFAULT '10',
  `pc` varchar(4) DEFAULT '5',
  `pd` varchar(4) DEFAULT '5',
  `fee` varchar(12) DEFAULT '10000',
  `pfee` varchar(10) DEFAULT '100',
  `rep` varchar(55) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `metrix`
--

INSERT INTO `metrix` (`sn`, `pa`, `pb`, `pc`, `pd`, `fee`, `pfee`, `rep`, `created`) VALUES
(1, '20', '10', '5', '5', '10000', '100', 'Ogbaji Godwin', '2017-08-02 14:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE IF NOT EXISTS `msg` (
  `sn` int(12) NOT NULL AUTO_INCREMENT,
  `msg` varchar(5000) NOT NULL,
  `sender` varchar(64) DEFAULT 'admin',
  `rec` varchar(64) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ctime` int(22) NOT NULL DEFAULT '0',
  `subject` varchar(225) NOT NULL,
  `active` int(2) NOT NULL DEFAULT '1',
  `deleted` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`sn`, `msg`, `sender`, `rec`, `created`, `ctime`, `subject`, `active`, `deleted`) VALUES
(1, 'Welcome to believers family network! Join us to rebuild Nigeria', 'admin', '5yziyarrnc3kjxij', '2018-07-18 13:13:34', 1531919613, 'Registration Successful', 1, 0),
(2, 'You have successfully registred with the Believers Family Network. Welcome to the team of people who believe in the vision of rebuilding Nigeria! Join us to rebuild Nigeria and eradicate poverty through business and financial empowerment', 'admin', 'uzyfow1sashixjwn', '2018-07-19 07:24:55', 1531985095, 'Registration Successful', 1, 0),
(3, 'You have successfully registred with the Believers Family Network. Welcome to the team of people who believe in the vision of rebuilding Nigeria! Join us to rebuild Nigeria and eradicate poverty through business and financial empowerment.<br>The Believers Family Network thrives on the principle of equality and firness through stragegic and continuous sharing of resources. The system is not magical neither is it a ponzi. We are simply pulling funds from members and strategically making them available to faithful members who want to invest in profitable ventures or expand their businesses.<br>This platform provides you with an opportunity to attain financial freedom by offering you interest-free loans as many times as you want. With these interest-free loans you will be able to expand your business and investment beyond the limits of financial incapacity and get it to bloom lika a flower in the rain.<br>Faithfulness in the timely repayment of any loan you access is the key accessing the next one which is likely to have a higher potential.<br>You can start accessing loans as soon as you refer 5 people (15 points) to the network and your loan potential continues to grow as your network team refer others. To grow your network faster, ensure you signup people who are likely to actively signup others. We hope to have a fruitful business relationship with you.<br><br>From the President<br><b>Florence Ojogo</b>', 'admin', '9892fojgl5u3zofq', '2018-07-21 11:08:23', 1532171300, 'Welcome to Believers Family', 1, 0),
(4, 'You have successfully registred with the Believers Family Network. Welcome to the team of people who believe in the vision of rebuilding Nigeria! Join us to rebuild Nigeria and eradicate poverty through business and financial empowerment.<br>The Believers Family Network thrives on the principle of equality and firness through stragegic and continuous sharing of resources. The system is not magical neither is it a ponzi. We are simply pulling funds from members and strategically making them available to faithful members who want to invest in profitable ventures or expand their businesses.<br>This platform provides you with an opportunity to attain financial freedom by offering you interest-free loans as many times as you want. With these interest-free loans you will be able to expand your business and investment beyond the limits of financial incapacity and get it to bloom lika a flower in the rain.<br>Faithfulness in the timely repayment of any loan you access is the key accessing the next one which is likely to have a higher potential.<br>You can start accessing loans as soon as you refer 5 people (15 points) to the network and your loan potential continues to grow as your network team refer others. To grow your network faster, ensure you signup people who are likely to actively signup others. We hope to have a fruitful business relationship with you.<br><br>From the President<br><b>Florence Ojogo</b>', 'admin', 'l4h4px4i7qd8qboe', '2018-07-21 11:10:05', 1532171404, 'Welcome to Believers Family', 1, 0),
(5, 'You have successfully registred with the Believers Family Network. Welcome to the team of people who believe in the vision of rebuilding Nigeria! Join us to rebuild Nigeria and eradicate poverty through business and financial empowerment.<br>The Believers Family Network thrives on the principle of equality and firness through stragegic and continuous sharing of resources. The system is not magical neither is it a ponzi. We are simply pulling funds from members and strategically making them available to faithful members who want to invest in profitable ventures or expand their businesses.<br>This platform provides you with an opportunity to attain financial freedom by offering you interest-free loans as many times as you want. With these interest-free loans you will be able to expand your business and investment beyond the limits of financial incapacity and get it to bloom lika a flower in the rain.<br>Faithfulness in the timely repayment of any loan you access is the key accessing the next one which is likely to have a higher potential.<br>You can start accessing loans as soon as you refer 5 people (15 points) to the network and your loan potential continues to grow as your network team refer others. To grow your network faster, ensure you signup people who are likely to actively signup others. We hope to have a fruitful business relationship with you.<br><br>From the President<br><b>Florence Ojogo</b>', 'admin', 'unkcfkf64x3vpvnu', '2018-07-21 11:11:10', 1532171469, 'Welcome to Believers Family', 1, 0),
(6, 'You have successfully registred with the Believers Family Network. Welcome to the team of people who believe in the vision of rebuilding Nigeria! Join us to rebuild Nigeria and eradicate poverty through business and financial empowerment.<br>The Believers Family Network thrives on the principle of equality and firness through stragegic and continuous sharing of resources. The system is not magical neither is it a ponzi. We are simply pulling funds from members and strategically making them available to faithful members who want to invest in profitable ventures or expand their businesses.<br>This platform provides you with an opportunity to attain financial freedom by offering you interest-free loans as many times as you want. With these interest-free loans you will be able to expand your business and investment beyond the limits of financial incapacity and get it to bloom lika a flower in the rain.<br>Faithfulness in the timely repayment of any loan you access is the key accessing the next one which is likely to have a higher potential.<br>You can start accessing loans as soon as you refer 5 people (15 points) to the network and your loan potential continues to grow as your network team refer others. To grow your network faster, ensure you signup people who are likely to actively signup others. We hope to have a fruitful business relationship with you.<br><br>From the President<br><b>Florence Ojogo</b>', 'admin', 'vtjnl2dhayjupjrk', '2018-07-21 11:12:07', 1532171526, 'Welcome to Believers Family', 1, 0),
(7, 'Congrat! You are now qualified to start accessing BFN interest-free loans. Login to your account with username: heh to do it yourself or call 08062495696', 'admin', 'uzyfow1sashixjwn', '2018-07-21 12:09:03', 1532174926, 'Now Qualify for BFN loans', 1, 0),
(8, 'You have successfully registred with the Believers Family Network. Welcome to the team of people who believe in the vision of rebuilding Nigeria! Join us to rebuild Nigeria and eradicate poverty through business and financial empowerment.<br>The Believers Family Network thrives on the principle of equality and firness through stragegic and continuous sharing of resources. The system is not magical neither is it a ponzi. We are simply pulling funds from members and strategically making them available to faithful members who want to invest in profitable ventures or expand their businesses.<br>This platform provides you with an opportunity to attain financial freedom by offering you interest-free loans as many times as you want. With these interest-free loans you will be able to expand your business and investment beyond the limits of financial incapacity and get it to bloom lika a flower in the rain.<br>Faithfulness in the timely repayment of any loan you access is the key accessing the next one which is likely to have a higher potential.<br>You can start accessing loans as soon as you refer 5 people (15 points) to the network and your loan potential continues to grow as your network team refer others. To grow your network faster, ensure you signup people who are likely to actively signup others. We hope to have a fruitful business relationship with you.<br><br>From the President<br><b>Florence Ojogo</b>', 'admin', 'uzyfow1sashixjwn', '2018-07-21 12:09:03', 1532174926, 'Welcome to Believers Family', 1, 0),
(47, 'Thanks my friend', 'btwnmgn4', 'mnqtf3y2', '2019-11-19 11:23:32', 1574810057, '', 2, 0),
(63, 'The best thing is for you to understand yourself and focus on improve on your leaps', 'btwnmgn4', 'mnqtf3y2', '2019-11-19 11:15:10', 1574158799, '', 2, 0),
(65, 'Tell me more', 'mnqtf3y2', 'btwnmgn4', '2019-11-19 10:43:44', 1574163504, '', 2, 0),
(75, 'Help my situation now ', 'btwnmgn4', 'mnqtf3y2', '2019-11-19 11:04:43', 1574160577, '', 2, 0),
(76, 'Thanks so much', 'mnqtf3y2', 'btwnmgn4', '2019-11-19 11:07:57', 1574161517, '', 2, 0),
(77, 'I will see you later', 'mnqtf3y2', 'btwnmgn4', '2019-11-19 11:07:57', 1574161550, '', 2, 0),
(78, 'Thanks for everything', 'mnqtf3y2', 'btwnmgn4', '2019-11-19 11:07:57', 1574161587, '', 2, 0),
(79, 'Ensure yo go to church tomorrow', 'btwnmgn4', 'mnqtf3y2', '2019-11-19 11:13:24', 1574161726, '', 2, 0),
(80, 'see you later', 'btwnmgn4', 'mnqtf3y2', '2019-11-19 11:13:24', 1574161887, '', 2, 0),
(81, 'takecare', 'btwnmgn4', 'mnqtf3y2', '2019-11-19 11:13:24', 1574161915, '', 2, 0),
(82, 'Longest time boss!', 'mnqtf3y2', 'btwnmgn4', '2019-12-01 08:33:38', 1574164255, '', 2, 0),
(83, 'My regard to your family', 'mnqtf3y2', 'btwnmgn4', '2019-12-01 08:33:38', 1575185961, '', 2, 0),
(84, 'what is happening now', 'mnqtf3y2', 'btwnmgn4', '2019-12-01 08:33:38', 1575186031, '', 2, 0),
(85, 'Goodbye!', 'mnqtf3y2', 'btwnmgn4', '2019-12-01 08:33:38', 1575186510, '', 2, 0),
(86, 'Hey', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 03:31:49', 1575195584, '', 2, 0),
(87, 'best', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 03:31:49', 1575241962, '', 2, 0),
(88, 'Am tired', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 03:31:49', 1575244272, '', 2, 0),
(89, 'what happen!', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 03:33:44', 1575257533, '', 2, 0),
(90, 'Is there any problem with mike again', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 03:36:58', 1575257776, '', 2, 0),
(91, 'Just feel like seeing you', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 03:37:59', 1575257853, '', 2, 0),
(92, 'really?', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 20:34:27', 1575257879, '', 2, 0),
(93, 'Yes honey, when are you coming back', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 20:08:22', 1575257931, '', 2, 0),
(94, 'Not know yet i, still got some stuff to deal with and beside, my boss just assain me with anothe contract worth billions in dollas', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 03:42:40', 1575258054, '', 2, 0),
(95, 'But i hope it end soon course, i miss you darling', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 03:42:40', 1575258105, '', 2, 0),
(96, 'just do quick, am having sleepless night already', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 19:26:24', 1575258230, '', 2, 0),
(97, 'dd', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 19:03:24', 1575282193, '', 2, 0),
(98, 'thank god it work', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 20:34:27', 1575317357, '', 2, 0),
(99, 'Fuck off\r\n', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 20:34:27', 1575317519, '', 2, 0),
(100, 'thankyou', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 20:34:27', 1575317608, '', 2, 0),
(101, 'I do not really get you', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 20:48:49', 1575319429, '', 2, 0),
(102, 'I do not really get you', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 20:48:49', 1575319429, '', 2, 0),
(103, 'are u not answring', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 20:52:37', 1575319943, '', 2, 0),
(104, 'Network isssue', 'mnqtf3y2', 'btwnmgn4', '2019-08-15 03:43:17', 1575319980, '', 2, 1),
(105, 'Where are you', 'btwnmgn4', 'mnqtf3y2', '2019-08-15 03:43:17', 1575320007, '', 2, 1),
(106, 'Am still in office trying to wrap things up urgently', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 20:54:45', 1575320069, '', 2, 0),
(107, 'are u still coming home tonight', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 20:56:02', 1575320114, '', 2, 0),
(108, 'i wona cook, i do not know if i should prepare urs', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 20:56:02', 1575320156, '', 2, 0),
(109, 'tell me', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 20:59:09', 1575320333, '', 2, 0),
(110, 'why not dear', 'mnqtf3y2', 'btwnmgn4', '2019-08-15 03:48:36', 1575320366, '', 2, 1),
(111, 'what took you so long before reply my message', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 21:00:09', 1575320402, '', 2, 0),
(112, 'Am kind of busy but i still got you', 'mnqtf3y2', 'btwnmgn4', '2019-08-15 03:48:36', 1575320448, '', 2, 1),
(113, 'you got to understand me', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 21:01:33', 1575320473, '', 2, 0),
(114, 'AM try to understand you but you are bit change of recent', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 21:02:49', 1575320535, '', 2, 0),
(115, 'i still trust you', 'btwnmgn4', 'mnqtf3y2', '2019-12-02 21:02:49', 1575320560, '', 2, 0),
(116, 'baby you know i love you', 'mnqtf3y2', 'btwnmgn4', '2019-12-02 21:03:56', 1575320591, '', 2, 0),
(117, 'i know you do', 'csy9eua5', 'mnqtf3y2', '2019-12-09 14:41:37', 1575320650, '', 2, 0),
(118, 'Good morning dear', 'btwnmgn4', 'mnqtf3y2', '2019-12-09 14:59:31', 1575901986, '', 2, 0),
(119, 'Yes sir.', 'mnqtf3y2', 'csy9eua5', '2019-12-09 14:45:46', 1575902520, '', 2, 0),
(120, 'Pls sir help with that codes.', 'mnqtf3y2', 'csy9eua5', '2019-12-09 15:00:14', 1575903555, '', 2, 0),
(121, 'Morning sweet', 'mnqtf3y2', 'btwnmgn4', '2019-08-15 03:33:37', 1575903588, '', 2, 0),
(122, 'how was ur night', 'mnqtf3y2', 'btwnmgn4', '2019-08-15 03:36:48', 1575903603, '', 2, 0),
(123, 'it was fine and urs dear', 'btwnmgn4', 'mnqtf3y2', '2019-08-15 02:41:48', 1575903637, '', 3, 0),
(124, 'Happy new week', 'mnqtf3y2', 'btwnmgn4', '2019-08-15 03:36:48', 1565812634, '', 2, 0),
(125, 'Same here dear.\r\nhow are you doing?', 'btwnmgn4', 'mnqtf3y2', '2019-08-15 02:50:33', 1565813502, '', 3, 0),
(126, 'Fine, have you got that gift from ur friend', 'mnqtf3y2', 'btwnmgn4', '2019-08-14 20:14:14', 1565813641, '', 2, 0),
(127, 'Not yet!', 'btwnmgn4', 'mnqtf3y2', '2019-08-15 02:40:20', 1565813674, '', 3, 0),
(128, 'What are u doing today', 'mnqtf3y2', 'btwnmgn4', '2019-08-15 03:28:47', 1565814018, '', 2, 0),
(129, 'I planed to sleep', 'mnqtf3y2', 'btwnmgn4', '2019-08-15 03:28:47', 1565819486, '', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `packs`
--

CREATE TABLE IF NOT EXISTS `packs` (
  `sn` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(24) DEFAULT NULL,
  `cost` varchar(10) DEFAULT NULL,
  `indicator` varchar(4) NOT NULL DEFAULT '200',
  `roi` varchar(4) NOT NULL DEFAULT '4',
  `days` varchar(4) NOT NULL DEFAULT '7',
  `duration` varchar(4) NOT NULL DEFAULT '25',
  `active` varchar(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `packs`
--

INSERT INTO `packs` (`sn`, `title`, `cost`, `indicator`, `roi`, `days`, `duration`, `active`) VALUES
(1, 'STARTER', '20000', '200', '4', '7', '25', '1'),
(2, 'BRONZE', '50000', '200', '4', '7', '25', '1'),
(3, 'SILVER', '100000', '200', '4', '7', '25', '1'),
(4, 'GOLD', '250000', '200', '4', '7', '25', '1'),
(5, 'PLATINUM', '500000', '200', '4', '7', '25', '1'),
(6, 'DIAMOND', '1000000', '200', '4', '7', '25', '1'),
(7, 'DOUBLE DIAMOND', '5000000', '200', '4', '7', '25', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pin`
--

CREATE TABLE IF NOT EXISTS `pin` (
  `sn` int(12) NOT NULL AUTO_INCREMENT,
  `pin` varchar(16) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rep` varchar(55) DEFAULT NULL,
  `id` varchar(12) DEFAULT NULL,
  `regno` varchar(24) DEFAULT NULL,
  `name` varchar(55) DEFAULT NULL,
  `mode` int(2) DEFAULT '1' COMMENT '1=pin, 2=card',
  `status` varchar(2) DEFAULT '0',
  `ymd` varchar(12) DEFAULT NULL,
  `investor` varchar(55) DEFAULT '0',
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `propects`
--

CREATE TABLE IF NOT EXISTS `propects` (
  `sn` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `referral` varchar(55) DEFAULT NULL,
  `id` varchar(55) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `returnx`
--

CREATE TABLE IF NOT EXISTS `returnx` (
  `sn` int(16) NOT NULL AUTO_INCREMENT,
  `accno` varchar(16) DEFAULT NULL,
  `userid` varchar(12) DEFAULT NULL,
  `username` varchar(55) DEFAULT NULL,
  `amount` varchar(12) DEFAULT NULL,
  `profit` varchar(12) DEFAULT NULL,
  `wkno` varchar(4) DEFAULT NULL,
  `ymd` varchar(10) DEFAULT NULL,
  `day` varchar(12) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `z` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `returnx`
--

INSERT INTO `returnx` (`sn`, `accno`, `userid`, `username`, `amount`, `profit`, `wkno`, `ymd`, `day`, `created`, `x`, `y`, `z`) VALUES
(1, '86993343', '1', 'Samuel Esther', '500000', '20000', '1', '171005', 'Thu', '2017-10-05 10:05:50', NULL, NULL, NULL),
(2, '1324242', '12', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-29 14:01:03', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

CREATE TABLE IF NOT EXISTS `savings` (
  `sn` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `trno` varchar(16) DEFAULT NULL,
  `userid` varchar(12) DEFAULT NULL,
  `amount` int(8) DEFAULT NULL,
  `period` int(2) DEFAULT NULL,
  `startdate` bigint(12) DEFAULT NULL,
  `enddate` bigint(12) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `sn` (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`sn`, `trno`, `userid`, `amount`, `period`, `startdate`, `enddate`, `created`) VALUES
(5, '378875126257', '3rmy3sji', 4344, 1, 1563318000, 1564441200, '2019-07-25 12:44:08'),
(6, '397619611447', '84u31icf', 6500, 2, 1562626800, 1566428400, '2019-07-25 12:59:19'),
(8, '754939637198', 'mnqtf3y2', 1000, 1, 1579474800, 1580425200, '2020-01-18 19:38:42'),
(13, '128865337541', 'btwnmgn4', 2000, 1, 1582066800, 1582326000, '2020-02-21 09:23:36'),
(21, '481682597597', 'csy9eua5', 5000, 3, 1577833200, 1585609200, '2020-03-08 14:54:49'),
(22, '484974328334', 'btwnmgn4', 1000, 2, 1591657200, 1592175600, '2020-06-13 14:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `savings2`
--

CREATE TABLE IF NOT EXISTS `savings2` (
  `sn` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(12) DEFAULT NULL,
  `trno` varchar(16) DEFAULT NULL,
  `amount` int(8) DEFAULT NULL,
  `date` bigint(12) DEFAULT NULL,
  `paid` bigint(12) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '0',
  UNIQUE KEY `sn` (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=169 ;

--
-- Dumping data for table `savings2`
--

INSERT INTO `savings2` (`sn`, `userid`, `trno`, `amount`, `date`, `paid`, `created`, `status`) VALUES
(5, 'csy9eua5', '', 11000, 1562626800, 1564056050, '2019-07-25 12:00:50', 0),
(6, 'csy9eua5', '', 11000, 1562713200, 1564056050, '2019-07-25 12:00:50', 0),
(7, 'csy9eua5', '', 11000, 1562799600, 1564056050, '2019-07-25 12:00:50', 0),
(8, 'csy9eua5', '', 11000, 1562886000, 1564056050, '2019-07-25 12:00:51', 0),
(9, 'csy9eua5', '', 11000, 1562972400, 1564056050, '2019-07-25 12:00:51', 0),
(15, 'csy9eua5', '', 11000, 1562626800, 1564056646, '2019-07-25 12:10:46', 0),
(16, 'csy9eua5', '', 11000, 1562713200, 1564056646, '2019-07-25 12:10:46', 0),
(17, 'csy9eua5', '', 11000, 1562799600, 1564056646, '2019-07-25 12:10:46', 0),
(18, 'csy9eua5', '', 11000, 1562886000, 1564056646, '2019-07-25 12:10:46', 0),
(19, 'csy9eua5', '', 11000, 1562972400, 1564056646, '2019-07-25 12:10:46', 0),
(20, 'csy9eua5', '', 11000, 1563145200, 1564056815, '2019-07-25 12:13:35', 0),
(21, 'csy9eua5', '', 11000, 1563231600, 1564056815, '2019-07-25 12:13:35', 0),
(22, 'csy9eua5', '', 11000, 1563058800, 1564056963, '2019-07-25 12:16:03', 0),
(23, 'csy9eua5', '', 11000, 1563318000, 1564056963, '2019-07-25 12:16:03', 0),
(24, 'csy9eua5', '', 11000, 1563404400, 1564056963, '2019-07-25 12:16:03', 0),
(25, 'csy9eua5', '', 11000, 1563490800, 1564056963, '2019-07-25 12:16:03', 0),
(26, 'csy9eua5', '', 11000, 1563577200, 1564056963, '2019-07-25 12:16:03', 0),
(27, 'csy9eua5', '', 11000, 1563663600, 1564056963, '2019-07-25 12:16:04', 0),
(28, 'csy9eua5', '', 11000, 1563750000, 1564056963, '2019-07-25 12:16:04', 0),
(29, 'csy9eua5', '', 11000, 1563836400, 1564056974, '2019-07-25 12:16:14', 0),
(30, 'csy9eua5', '', 11000, 1563922800, 1564057490, '2019-07-25 12:24:50', 0),
(31, '3rmy3sji', '', 4344, 1563318000, 1564058867, '2019-07-25 12:47:47', 0),
(32, '3rmy3sji', '', 4344, 1563404400, 1564058867, '2019-07-25 12:47:47', 0),
(33, '3rmy3sji', '', 4344, 1563490800, 1564058867, '2019-07-25 12:47:48', 0),
(34, '84u31icf', '', 6500, 1562626800, 1564059679, '2019-07-25 13:01:19', 0),
(35, '84u31icf', '', 6500, 1563231600, 1564059786, '2019-07-25 13:03:06', 0),
(36, 'csy9eua5', '', 11000, 1570834800, 1571336005, '2019-10-17 18:13:26', 0),
(37, 'csy9eua5', '', 11000, 1570921200, 1571336005, '2019-10-17 18:13:26', 0),
(38, 'csy9eua5', '', 11000, 1571007600, 1571336005, '2019-10-17 18:13:26', 0),
(39, 'csy9eua5', '', 11000, 1571094000, 1571336005, '2019-10-17 18:13:26', 0),
(40, 'csy9eua5', '', 11000, 1571180400, 1571336005, '2019-10-17 18:13:26', 0),
(41, 'csy9eua5', '', 11000, 1571266800, 1571336005, '2019-10-17 18:13:26', 0),
(42, 'csy9eua5', '', 11000, 1570489200, 1571336035, '2019-10-17 18:13:55', 0),
(43, 'csy9eua5', '', 11000, 1570575600, 1571336035, '2019-10-17 18:13:55', 0),
(44, 'csy9eua5', '', 11000, 1570662000, 1571336035, '2019-10-17 18:13:55', 0),
(45, 'csy9eua5', '', 11000, 1570748400, 1571336035, '2019-10-17 18:13:55', 0),
(46, 'btwnmgn4', '', 2000, 1565218800, 1565818214, '2019-08-14 21:30:14', 0),
(47, 'btwnmgn4', '', 2000, 1565305200, 1565818214, '2019-08-14 21:30:14', 0),
(48, 'btwnmgn4', '', 2000, 1565478000, 1565819512, '2019-08-14 21:51:52', 0),
(49, 'btwnmgn4', '', 2000, 1565823600, 1565831845, '2019-08-15 01:17:26', 0),
(50, 'btwnmgn4', '', 2000, 1565391600, 1577734590, '2019-12-30 19:36:30', 0),
(51, 'btwnmgn4', '', 2000, 1565564400, 1577734590, '2019-12-30 19:36:31', 0),
(52, 'btwnmgn4', '', 2000, 1565650800, 1577734590, '2019-12-30 19:36:31', 0),
(53, 'btwnmgn4', '', 2000, 1565737200, 1577734590, '2019-12-30 19:36:31', 0),
(54, 'btwnmgn4', '', 2000, 1565910000, 1577734590, '2019-12-30 19:36:31', 0),
(55, 'btwnmgn4', '', 2000, 1565996400, 1577734590, '2019-12-30 19:36:32', 0),
(56, 'btwnmgn4', '', 2000, 1566082800, 1577734590, '2019-12-30 19:36:32', 0),
(57, 'btwnmgn4', '', 2000, 1566169200, 1577734590, '2019-12-30 19:36:32', 0),
(58, 'btwnmgn4', '', 2000, 1566255600, 1577734590, '2019-12-30 19:36:32', 0),
(59, 'btwnmgn4', '', 2000, 1566342000, 1577734590, '2019-12-30 19:36:33', 0),
(60, 'btwnmgn4', '', 2000, 1566428400, 1577734590, '2019-12-30 19:36:33', 0),
(61, 'btwnmgn4', '', 2000, 1566514800, 1577734590, '2019-12-30 19:36:33', 0),
(62, 'btwnmgn4', '', 2000, 1566601200, 1577734590, '2019-12-30 19:36:33', 0),
(63, 'btwnmgn4', '', 2000, 1566687600, 1577734590, '2019-12-30 19:36:33', 0),
(64, 'btwnmgn4', '', 2000, 1566774000, 1577734590, '2019-12-30 19:36:34', 0),
(65, 'btwnmgn4', '', 2000, 1566860400, 1577734590, '2019-12-30 19:36:34', 0),
(66, 'btwnmgn4', '', 2000, 1566946800, 1577734590, '2019-12-30 19:36:34', 0),
(67, 'btwnmgn4', '', 2000, 1567033200, 1577734590, '2019-12-30 19:36:34', 0),
(68, 'btwnmgn4', '', 2000, 1567119600, 1577734590, '2019-12-30 19:36:35', 0),
(69, 'btwnmgn4', '', 2000, 1567206000, 1577734590, '2019-12-30 19:36:35', 0),
(70, 'btwnmgn4', '', 2000, 1567292400, 1577734590, '2019-12-30 19:36:35', 0),
(71, 'btwnmgn4', '', 2000, 1577055600, 1577734590, '2019-12-30 19:36:35', 0),
(72, 'btwnmgn4', '', 2000, 1577142000, 1577734590, '2019-12-30 19:36:35', 0),
(73, 'btwnmgn4', '', 2000, 1577228400, 1577734590, '2019-12-30 19:36:36', 0),
(74, 'btwnmgn4', '', 2000, 1577314800, 1577734590, '2019-12-30 19:36:36', 0),
(75, 'btwnmgn4', '', 2000, 1577401200, 1577734590, '2019-12-30 19:36:36', 0),
(76, 'btwnmgn4', '', 2000, 1577487600, 1577734590, '2019-12-30 19:36:36', 0),
(77, 'btwnmgn4', '', 2000, 1577574000, 1577734590, '2019-12-30 19:36:37', 0),
(78, 'btwnmgn4', '', 2000, 1577660400, 1577734590, '2019-12-30 19:36:37', 0),
(79, 'btwnmgn4', '', 2000, 1578956400, 1579452140, '2020-01-19 16:42:20', 0),
(80, 'btwnmgn4', '', 2000, 1579042800, 1579452140, '2020-01-19 16:42:20', 0),
(81, 'btwnmgn4', '', 2000, 1579129200, 1579452140, '2020-01-19 16:42:21', 0),
(82, 'btwnmgn4', '', 2000, 1579215600, 1579452140, '2020-01-19 16:42:21', 0),
(83, 'btwnmgn4', '', 2000, 1579302000, 1579452140, '2020-01-19 16:42:21', 0),
(84, 'btwnmgn4', '', 2000, 1579388400, 1579452140, '2020-01-19 16:42:21', 0),
(85, 'btwnmgn4', '', 2000, 1577746800, 1579452184, '2020-01-19 16:43:04', 0),
(86, 'btwnmgn4', '', 2000, 1577833200, 1579452184, '2020-01-19 16:43:05', 0),
(87, 'btwnmgn4', '', 2000, 1577919600, 1579452184, '2020-01-19 16:43:05', 0),
(88, 'btwnmgn4', '', 2000, 1578006000, 1579452184, '2020-01-19 16:43:05', 0),
(89, 'btwnmgn4', '', 2000, 1578092400, 1579452184, '2020-01-19 16:43:05', 0),
(90, 'btwnmgn4', '', 2000, 1578178800, 1579452184, '2020-01-19 16:43:05', 0),
(91, 'btwnmgn4', '', 2000, 1578265200, 1579452184, '2020-01-19 16:43:05', 0),
(92, 'btwnmgn4', '', 2000, 1578351600, 1579452184, '2020-01-19 16:43:05', 0),
(93, 'btwnmgn4', '', 2000, 1578438000, 1579452184, '2020-01-19 16:43:05', 0),
(94, 'btwnmgn4', '', 2000, 1578524400, 1579452184, '2020-01-19 16:43:05', 0),
(95, 'btwnmgn4', '', 2000, 1578610800, 1579452184, '2020-01-19 16:43:05', 0),
(96, 'btwnmgn4', '', 2000, 1578697200, 1579452184, '2020-01-19 16:43:05', 0),
(97, 'btwnmgn4', '', 2000, 1578783600, 1579452184, '2020-01-19 16:43:06', 0),
(98, 'btwnmgn4', '', 2000, 1578870000, 1579452184, '2020-01-19 16:43:06', 0),
(99, 'btwnmgn4', '', 2000, 1567378800, 1579452295, '2020-01-19 16:44:56', 0),
(100, 'btwnmgn4', '', 2000, 1567465200, 1579452295, '2020-01-19 16:44:56', 0),
(101, 'btwnmgn4', '', 2000, 1567551600, 1579452295, '2020-01-19 16:44:56', 0),
(102, 'btwnmgn4', '', 2000, 1567638000, 1579452295, '2020-01-19 16:44:56', 0),
(103, 'btwnmgn4', '', 2000, 1567724400, 1579452295, '2020-01-19 16:44:56', 0),
(104, 'btwnmgn4', '', 2000, 1567810800, 1579452295, '2020-01-19 16:44:56', 0),
(105, 'btwnmgn4', '', 2000, 1567897200, 1579452295, '2020-01-19 16:44:56', 0),
(106, 'btwnmgn4', '', 2000, 1567983600, 1579452295, '2020-01-19 16:44:56', 0),
(107, 'btwnmgn4', '', 2000, 1568070000, 1579452295, '2020-01-19 16:44:56', 0),
(108, 'btwnmgn4', '', 2000, 1568156400, 1579452295, '2020-01-19 16:44:56', 0),
(109, 'btwnmgn4', '', 2000, 1568242800, 1579452295, '2020-01-19 16:44:56', 0),
(110, 'btwnmgn4', '', 2000, 1568329200, 1579452295, '2020-01-19 16:44:57', 0),
(111, 'btwnmgn4', '', 2000, 1568415600, 1579452295, '2020-01-19 16:44:57', 0),
(112, 'btwnmgn4', '', 2000, 1569884400, 1579452399, '2020-01-19 16:46:39', 0),
(113, 'btwnmgn4', '', 2000, 1569970800, 1579452399, '2020-01-19 16:46:40', 0),
(114, 'btwnmgn4', '', 2000, 1570057200, 1579452399, '2020-01-19 16:46:40', 0),
(115, 'btwnmgn4', '', 2000, 1570143600, 1579452399, '2020-01-19 16:46:40', 0),
(116, 'btwnmgn4', '', 2000, 1570230000, 1579452399, '2020-01-19 16:46:40', 0),
(117, 'btwnmgn4', '', 2000, 1570316400, 1579452399, '2020-01-19 16:46:40', 0),
(118, 'btwnmgn4', '', 2000, 1570402800, 1579452399, '2020-01-19 16:46:40', 0),
(119, 'btwnmgn4', '', 2000, 1570489200, 1579452399, '2020-01-19 16:46:41', 0),
(120, 'btwnmgn4', '', 2000, 1570575600, 1579452399, '2020-01-19 16:46:41', 0),
(121, 'btwnmgn4', '', 2000, 1570662000, 1579452399, '2020-01-19 16:46:41', 0),
(122, 'btwnmgn4', '', 2000, 1570748400, 1579452399, '2020-01-19 16:46:41', 0),
(123, 'btwnmgn4', '', 2000, 1570834800, 1579452399, '2020-01-19 16:46:41', 0),
(124, 'btwnmgn4', '', 2000, 1570921200, 1579452399, '2020-01-19 16:46:42', 0),
(125, 'btwnmgn4', '', 2000, 1571007600, 1579452399, '2020-01-19 16:46:42', 0),
(126, 'btwnmgn4', '', 2000, 1571094000, 1579452399, '2020-01-19 16:46:42', 0),
(127, 'btwnmgn4', '', 2000, 1571180400, 1579452399, '2020-01-19 16:46:42', 0),
(128, 'btwnmgn4', '', 2000, 1571266800, 1579452399, '2020-01-19 16:46:42', 0),
(129, 'btwnmgn4', '', 2000, 1571353200, 1579452399, '2020-01-19 16:46:42', 0),
(130, 'btwnmgn4', '', 2000, 1571439600, 1579452399, '2020-01-19 16:46:43', 0),
(131, 'btwnmgn4', '', 2000, 1571526000, 1579452399, '2020-01-19 16:46:43', 0),
(132, 'btwnmgn4', '', 2000, 1571612400, 1579452399, '2020-01-19 16:46:43', 0),
(133, 'btwnmgn4', '', 2000, 1571698800, 1579452399, '2020-01-19 16:46:43', 0),
(134, 'btwnmgn4', '', 2000, 1571785200, 1579452399, '2020-01-19 16:46:43', 0),
(135, 'btwnmgn4', '', 2000, 1571871600, 1579452399, '2020-01-19 16:46:44', 0),
(136, 'btwnmgn4', '', 2000, 1571958000, 1579452399, '2020-01-19 16:46:44', 0),
(137, 'btwnmgn4', '', 2000, 1572044400, 1579452399, '2020-01-19 16:46:44', 0),
(138, 'btwnmgn4', '', 2000, 1572130800, 1579452399, '2020-01-19 16:46:44', 0),
(139, 'btwnmgn4', NULL, 1000, 1582153200, 1582276343, '2020-02-21 09:12:23', 0),
(140, 'btwnmgn4', '128865337541', 2000, 1582239600, 1582277054, '2020-02-21 09:24:14', 0),
(141, 'mnqtf3y2', '', 1000, 1579474800, 1583359035, '2020-03-04 21:57:16', 0),
(142, 'btwnmgn4', '', 2000, 1583103600, 1583359071, '2020-03-04 21:57:52', 0),
(143, 'btwnmgn4', '', 2000, 1583190000, 1583359071, '2020-03-04 21:57:52', 0),
(144, 'btwnmgn4', '', 2000, 1583276400, 1583359071, '2020-03-04 21:57:52', 0),
(145, 'btwnmgn4', '', 2000, 1582930800, 1583359239, '2020-03-04 22:00:39', 0),
(146, 'btwnmgn4', '', 2000, 1583017200, 1583359239, '2020-03-04 22:00:39', 0),
(147, 'btwnmgn4', NULL, 2000, 1582844400, 1583360031, '2020-03-04 22:13:51', 0),
(148, 'csy9eua5', '481682597597', 5000, 1583017200, 1583763634, '2020-03-09 14:20:35', 0),
(149, 'csy9eua5', '481682597597', 5000, 1577833200, 1583767688, '2020-03-09 15:28:08', 0),
(150, 'btwnmgn4', NULL, 2000, 1591743600, 1592057836, '2020-06-13 14:17:16', 0),
(151, 'btwnmgn4', NULL, 2000, 1591830000, 1592057836, '2020-06-13 14:17:16', 0),
(152, 'btwnmgn4', NULL, 2000, 1591916400, 1592057836, '2020-06-13 14:17:16', 0),
(153, 'btwnmgn4', NULL, 2000, 1592002800, 1592057836, '2020-06-13 14:17:16', 0),
(154, 'btwnmgn4', NULL, 2000, 1594162800, 1594483630, '2020-07-11 16:07:10', 0),
(155, 'btwnmgn4', NULL, 2000, 1594249200, 1594483630, '2020-07-11 16:07:10', 0),
(156, 'btwnmgn4', NULL, 2000, 1594335600, 1594483630, '2020-07-11 16:07:10', 0),
(157, 'btwnmgn4', NULL, 2000, 1594422000, 1594483630, '2020-07-11 16:07:11', 0),
(158, 'btwnmgn4', NULL, 2000, 1582066800, 1594483656, '2020-07-11 16:07:36', 0),
(159, 'btwnmgn4', NULL, 2000, 1582326000, 1594483656, '2020-07-11 16:07:36', 0),
(160, 'btwnmgn4', NULL, 2000, 1582412400, 1594483656, '2020-07-11 16:07:36', 0),
(161, 'btwnmgn4', NULL, 2000, 1582498800, 1594483656, '2020-07-11 16:07:36', 0),
(162, 'btwnmgn4', NULL, 2000, 1582585200, 1594483656, '2020-07-11 16:07:37', 0),
(163, 'csy9eua5', NULL, 5000, 1580425200, 1604734927, '2020-11-07 07:42:07', 0),
(164, 'csy9eua5', NULL, 5000, 1585609200, 1604734927, '2020-11-07 07:42:07', 0),
(165, 'csy9eua5', NULL, 5000, 1588201200, 1604734938, '2020-11-07 07:42:18', 0),
(166, 'csy9eua5', NULL, 5000, 1590793200, 1604734938, '2020-11-07 07:42:18', 0),
(167, 'csy9eua5', NULL, 5000, 1593385200, 1608940411, '2020-12-25 23:53:31', 0),
(168, 'csy9eua5', NULL, 5000, 1595977200, 1608940411, '2020-12-25 23:53:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `seminar`
--

CREATE TABLE IF NOT EXISTS `seminar` (
  `sn` int(12) NOT NULL AUTO_INCREMENT,
  `type` varchar(55) NOT NULL,
  `title` varchar(225) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `sn` int(8) NOT NULL AUTO_INCREMENT,
  `id` varchar(64) DEFAULT '0',
  `firstname` varchar(55) DEFAULT NULL,
  `lastname` varchar(55) DEFAULT NULL,
  `sponsor` int(8) NOT NULL DEFAULT '0',
  `a1` int(8) NOT NULL DEFAULT '0',
  `a2` int(8) NOT NULL DEFAULT '0',
  `a3` int(8) NOT NULL DEFAULT '0',
  `a4` int(8) NOT NULL DEFAULT '0',
  `a5` int(8) NOT NULL DEFAULT '0',
  `a6` int(8) NOT NULL DEFAULT '0',
  `a7` int(8) NOT NULL DEFAULT '0',
  `a8` int(8) NOT NULL DEFAULT '0',
  `a9` int(8) NOT NULL DEFAULT '0',
  `a10` int(8) NOT NULL DEFAULT '0',
  `a11` int(8) NOT NULL DEFAULT '0',
  `a12` int(12) NOT NULL DEFAULT '0',
  `a13` int(12) NOT NULL DEFAULT '0',
  `a14` int(12) NOT NULL DEFAULT '0',
  `a15` int(12) NOT NULL DEFAULT '0',
  `a16` int(12) NOT NULL DEFAULT '0',
  `a17` int(12) NOT NULL DEFAULT '0',
  `a18` int(12) NOT NULL DEFAULT '0',
  `a19` int(12) NOT NULL DEFAULT '0',
  `a20` int(12) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(2) NOT NULL DEFAULT '0',
  `email` varchar(55) DEFAULT NULL,
  `sex` varchar(8) DEFAULT NULL,
  `state` varchar(22) DEFAULT NULL,
  `city` varchar(22) DEFAULT NULL,
  `address` varchar(225) NOT NULL,
  `officeaddress` varchar(225) DEFAULT NULL,
  `dob` varchar(55) DEFAULT NULL,
  `accname` varchar(55) DEFAULT NULL,
  `bank` varchar(55) DEFAULT NULL,
  `accountno` varchar(10) DEFAULT NULL,
  `bvn` varchar(12) DEFAULT NULL,
  `user` varchar(55) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `userlevel` int(2) NOT NULL DEFAULT '1',
  `photo` varchar(85) DEFAULT NULL,
  `code` varchar(80) DEFAULT NULL,
  `pin` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`sn`, `id`, `firstname`, `lastname`, `sponsor`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `a13`, `a14`, `a15`, `a16`, `a17`, `a18`, `a19`, `a20`, `created`, `active`, `email`, `sex`, `state`, `city`, `address`, `officeaddress`, `dob`, `accname`, `bank`, `accountno`, `bvn`, `user`, `pass`, `phone`, `status`, `userlevel`, `photo`, `code`, `pin`) VALUES
(1, 'csy9eua5', 'Godwin', 'Ogbaji', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-24 20:41:33', 0, 'ogbajigodwin@gmail.com', 'Male', 'Ondo', 'Akure', 'Alagbaka', '4', '28/07/71', 'Godwin Ogbaji', 'Godwin Ogbaji', '6735867384', '32131231', '08032318588', '$2y$10$Fbyn69HFsDGqCNTAog4Jx.i/XOmsA2yLMAuwe6DvJMBRRErtr5E4.', '08032318588', 1, 1, '0803231858820882172_130511080901419_1212483111595735793_n.jpg', NULL, NULL),
(5, '3rmy3sji', 'Godwin', 'Ogbaji', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-24 21:25:54', 0, 'godwin@gmail.com', 'Male', 'Ondo', 'Akure', 'Alagbaka', '4', '2019-07-18', 'Godwin Ogbaji', 'Uba', '432434', '32131231', '08032318581', '$2y$10$2Ls5.4pPAe7hF6F8YkUBCuavDpz/HkfH.PKaDuicdS7Co/EcJ7Iqi', '08032318588', 1, 1, 'sp08032318581adebusuyi-dada-wole.jpeg', NULL, NULL),
(6, '84u31icf', 'Godwin', 'Ogbaji', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-25 07:42:59', 0, 'ogbajig@gmail.com', 'Male', 'Ondo', 'Akure', 'Alagbaka', '', '2019-07-17', 'Godwin Ogbaji', 'Godwin Ogbaji', '1254367253', '32131231', '08032318998', '$2y$10$xoFeW9j818RiFAc233SuHu9not9GCZKxhg3vQLTObn0q013vE5a/e', '08032318588', 1, 1, 'sp08032318998omojowo-olaniyi.jpeg', NULL, NULL),
(7, '8thhyk5o', 'Oluwamoyewa', 'Moses', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-29 21:29:32', 0, 'moyewatosin@gmail.com', 'Female', 'Ondo', 'Owo', 'Adefarati', '', '2019-07-08', 'Oluwamoyewa Moses', 'Oluwamoyewa Moses', '7575757575', '656575757575', '08161885390', '1234', '08161885390', 1, 2, 'sp0816188539068027c1eb8063dd2ce43a6aae9586cdd.jpg', NULL, NULL),
(8, 'iou3ajhk', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-29 21:41:23', 0, 'mostzak@gmail.com', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '08161885391', '1234', '08161885391', 1, 1, NULL, NULL, NULL),
(9, 'i5zwuxjc', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-29 21:43:49', 0, 'tofd@gmail.com', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '08161885399', '1234', '08161885399', 1, 1, NULL, NULL, NULL),
(13, '0noaawv6', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-29 21:52:24', 0, 'gdg@gmail.com', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '08053745973', '1234', '08053745973', 1, 1, NULL, NULL, NULL),
(14, '2xw3ij8r', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-29 21:55:46', 0, 'hdhdh@gmail.com', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '09065745837', '1234', '09065745837', 1, 1, NULL, NULL, NULL),
(15, 'h9lbedbd', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-29 22:01:01', 0, 'hddh@gmail.com', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '09065745834', '1234', '09065745834', 1, 1, NULL, NULL, NULL),
(16, 'xan9sm8z', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-29 22:41:41', 0, 'today@gmail.com', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '08161885397', '1234', '08161885397', 1, 1, NULL, NULL, NULL),
(17, 'btwnmgn4', 'Olagoke', 'Folashade Odunola', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-07-30 00:22:59', 0, 'gfhf@gmail.com', 'Female', 'Katsina', 'Owo', '22, New Avenue, Off Isijogun Road, Iyere.', '32, Bovas Station', '2019-07-08', 'Oluwamoyewa Moses', 'First Bank', '7575757575', '176358', '08161885380', '1234', '08161885380', 1, 1, 'sp0816188538013775430_634941839996851_400756831524082593_n.jpg', NULL, NULL),
(21, 'mnqtf3y2', 'Denageh', 'Oluwatobi Ayomide', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-10-18 06:17:09', 0, 'ayewa@gmail.com', 'Male', 'Oyo', 'Ibadan', 'Gbajumo Avenue', 'I.m.g, Yemetu', '1993-07-06', 'Denageh Tobi', 'Access', '7575757575', '562345891234', '08168257660', '1234', '08168257660', 1, 1, 'sp08168257660clinton-1.jpg', NULL, NULL),
(22, 'zbsrwkb2', 'Oluwamoyewa', 'Moses', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-08-16 14:05:21', 0, 'tobiflex@yahoo.com', 'Female', 'Ondo', 'Owo', 'Adefarati', '', '2019-08-14', 'Oluwamoyewa Moses', 'Oluwamoyewa Moses', '7575757575', '656575757575', '07034865746', '1234', '07034865746', 1, 1, 'sp0703486574668027c1eb8063dd2ce43a6aae9586cdd.jpg', NULL, NULL),
(23, 'h6eklg57', 'Oluwanife', 'Seunfunmi', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020-01-18 14:58:50', 0, 'ghh@gmail.com', 'Female', 'Oyo', 'Ibadan', '23, Ayeoluwa, Bodija', 'I.m.g', '2019-10-02', '', '', '', '', '08131885390', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '08131885390', 1, 1, NULL, NULL, NULL),
(24, '3987jrra', 'Glory', 'Joseph', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020-01-18 15:11:04', 0, 'fil@gmail.com', 'Male', 'Oyo', 'Ibadan', '32, Bodija Estate', 'I.m.g, Yemetu', '2020-01-15', NULL, NULL, NULL, NULL, '08164885390', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '08164885390', 1, 1, 'sp08164885390IMG_20190809_133539_5 (2).jpg', NULL, NULL),
(25, '5e273uwb', 'Olomosedara', 'Imisioluwa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020-06-13 14:39:44', 0, 'fxfcfc@gmail', 'Male', 'Ondo', 'Owo', 'Adefarati', 'Hdhdhd', '2020-06-02', 'Hdhdhdhd', 'Oluwamoyewa Moses', '7575757575', '6367363', '07032318588', '1234', '07032318588', 1, 1, 'sp07032318588clinton-1.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user2`
--

CREATE TABLE IF NOT EXISTS `user2` (
  `sn` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(8) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `marital` int(2) DEFAULT NULL,
  `kname` varchar(50) DEFAULT NULL,
  `kphone` int(11) DEFAULT NULL,
  `kaddress` varchar(70) DEFAULT NULL,
  `kemail` varchar(50) DEFAULT NULL,
  `krelation` varchar(20) DEFAULT NULL,
  `pob` varchar(30) DEFAULT NULL,
  `lg` varchar(30) DEFAULT NULL,
  `ecategory` int(2) DEFAULT NULL,
  `edate` bigint(15) DEFAULT NULL,
  `position` varchar(25) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `income` int(11) DEFAULT NULL,
  `ename` varchar(20) DEFAULT NULL,
  `eaddress` varchar(70) DEFAULT NULL,
  `omn` int(11) DEFAULT NULL,
  `identification` int(2) DEFAULT NULL,
  `acctname` varchar(50) DEFAULT NULL,
  `acctnum` int(10) DEFAULT NULL,
  `bankname` varchar(20) DEFAULT NULL,
  `staffid` varchar(250) DEFAULT NULL,
  `bill` varchar(250) DEFAULT NULL,
  `statement` varchar(250) DEFAULT NULL,
  `letter` varchar(250) DEFAULT NULL,
  `cheque` varchar(250) DEFAULT NULL,
  UNIQUE KEY `sn` (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `user2`
--

INSERT INTO `user2` (`sn`, `userid`, `state`, `marital`, `kname`, `kphone`, `kaddress`, `kemail`, `krelation`, `pob`, `lg`, `ecategory`, `edate`, `position`, `department`, `level`, `income`, `ename`, `eaddress`, `omn`, `identification`, `acctname`, `acctnum`, `bankname`, `staffid`, `bill`, `statement`, `letter`, `cheque`) VALUES
(4, 'btwnmgn4', 'Ondo', 1, 'Oluwamoyewa Moses', 2147483647, 'Adefarati', 'Moyewatosin@gmail.com', 'Brother', 'Owo', 'Owo', 2, 2019, 'Office Admin', 'Technical Unit', '10', 56434, 'Trenet', 'Bovas', 2147483647, 3, 'Olu Mi', 2147483647, 'Gt Bank', '08161885380IMG-20170617-WA0000.jpg', '08161885380IMS.png', '08161885380csharp_tutorial.pdf', '08161885380ajax_tutorial.pdf', '08161885380new logo 1.png'),
(5, 'iic8zf9q', 'Osun', 2, 'Oluwamoyewa Moses', 2147483647, 'Adefarati', 'Moyewatosin@gmail.com', 'Brother', 'Owo', 'Owo', 4, 2019, 'Ui Designer', 'Technical Unit', '10', 200000, 'Trenet', 'Bovas', 2147483647, 2, 'Olu Mi', 1234567, 'Gt Bank', '08161257660download.jpg', '08161257660images1.jpg', '08161257660download (111).jpg', '08161257660download.png', '0816125766022index.jpg'),
(6, 'gz0nq2jc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'ltwm9x2w', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'mnqtf3y2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'zbsrwkb2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'h6eklg57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '3987jrra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '5e273uwb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usermsg`
--

CREATE TABLE IF NOT EXISTS `usermsg` (
  `sn` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(12) NOT NULL,
  `sub` varchar(70) NOT NULL,
  `msg` text NOT NULL,
  `ctime` bigint(12) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `usermsg`
--

INSERT INTO `usermsg` (`sn`, `id`, `sub`, `msg`, `ctime`, `status`) VALUES
(1, 'mnqtf3y2', 'Successful Registration', 'You have successfully registred with the Believers Family Network. Welcome to the team of people who believe in the vision of rebuilding Nigeria! Join us to rebuild Nigeria and eradicate poverty through business and financial empowerment.<br>The Believers Family Network thrives on the principle of equality and firness through stragegic and continuous sharing of resources. The system is not magical neither is it a ponzi. We are simply pulling funds from members and strategically making them available to faithful members who want to invest in profitable ventures or expand their businesses.<br>This platform provides you with an opportunity to attain financial freedom by offering you interest-free loans as many times as you want. With these interest-free loans you will be able to expand your business and investment beyond the limits of financial incapacity and get it to bloom lika a flower in the rain.<br>Faithfulness in the timely repayment of any loan you access is the key accessing the next one which is likely to have a higher potential.<br>You can start accessing loans as soon as you refer 5 people (15 points) to the network and your loan potential continues to grow as your network team refer others. To grow your network faster, ensure you signup people who are likely to actively signup others. We hope to have a fruitful business relationship with you.<br><br>From the President<br><b>Florence Ojogo</b>', 1571379520, 1),
(2, 'mnqtf3y2', 'Testing', 'We are testing our system', 1574073126, 1),
(3, 'mnqtf3y2', 'Loan Application', 'Loan application successfully submitted for approval. You will be notified as soon as it is approved', 1574073651, 0),
(4, 'zbsrwkb2', 'Successful Registration', 'Your registration is successful. Your username is 07034865746. Thank you for joining the Greater Height. Call 08032318588for more information.', 1565963701, 0),
(5, 'h6eklg57', 'Successful Registration', 'Your registration is successful. Your username is 08131885390. Thank you for joining the Greater Height. Call 08032318588for more information.', 1579359791, 0),
(6, '3987jrra', 'Successful Registration', 'Your registration is successful. Your username is 08164885390. Thank you for joining Save More. Call 08032318588for more information.', 1579360343, 0),
(7, '5e273uwb', 'Successful Registration', 'Your registration is successful. Your username is 07032318588. Thank you for joining the Greater Height. Call 08032318588for more information.', 1592059300, 0),
(8, '5e273uwb', 'Loan Application', 'Loan application successfully submitted for approval. You will be notified as soon as it is approved', 1592059494, 0);

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE IF NOT EXISTS `withdraw` (
  `sn` int(16) NOT NULL AUTO_INCREMENT,
  `id` varchar(32) DEFAULT NULL,
  `id2` varchar(55) DEFAULT NULL,
  `inibalance` varchar(12) DEFAULT NULL,
  `amount` varchar(12) DEFAULT NULL,
  `finalbalance` varchar(12) DEFAULT NULL,
  `ymd` varchar(8) DEFAULT NULL,
  `ww` varchar(6) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tno` varchar(16) DEFAULT NULL,
  `status` varchar(55) DEFAULT NULL,
  `type` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawinv`
--

CREATE TABLE IF NOT EXISTS `withdrawinv` (
  `sn` int(16) NOT NULL AUTO_INCREMENT,
  `id` varchar(12) DEFAULT NULL,
  `id2` varchar(12) DEFAULT NULL,
  `name` varchar(55) DEFAULT NULL,
  `amount` varchar(12) DEFAULT NULL,
  `tamt` varchar(12) DEFAULT NULL,
  `ymd` varchar(8) DEFAULT NULL,
  `ww` varchar(6) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tno` varchar(16) DEFAULT NULL,
  `status` int(2) DEFAULT '0',
  `type` varchar(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
