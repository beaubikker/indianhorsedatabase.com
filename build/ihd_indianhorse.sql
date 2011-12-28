-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2011 at 10:49 AM
-- Server version: 5.1.56
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ihd_indianhorse`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE IF NOT EXISTS `tbl_admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_login` varchar(20) NOT NULL DEFAULT '',
  `admin_pwd` varchar(80) DEFAULT NULL,
  `admin_email` varchar(200) DEFAULT NULL,
  `admin_first_name` varchar(100) DEFAULT NULL,
  `admin_middle_name` varchar(100) DEFAULT NULL,
  `admin_last_name` varchar(100) DEFAULT NULL,
  `admin_last_login` datetime DEFAULT NULL,
  `super_admin` enum('0','1') DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`id`, `admin_login`, `admin_pwd`, `admin_email`, `admin_first_name`, `admin_middle_name`, `admin_last_name`, `admin_last_login`, `super_admin`, `status`) VALUES
(1, 'reyeng', 'e12d7a0d37bd9ed0e5959053f9ff26f8', 'admin@indianhorsedatabase.com', 'x', 'x', 'x', '2010-09-22 16:48:55', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertisements`
--

CREATE TABLE IF NOT EXISTS `tbl_advertisements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `shortdescription` text,
  `image` varchar(255) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  `url` varchar(255) DEFAULT NULL,
  `page` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_advertisements`
--

INSERT INTO `tbl_advertisements` (`id`, `name`, `shortdescription`, `image`, `posted_date`, `status`, `url`, `page`) VALUES
(13, 'Adsense', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "ca-pub-0839435290336560";\r\n/* IHD Main */\r\ngoogle_ad_slot = "2713479439";\r\ngoogle_ad_width = 120;\r\ngoogle_ad_height = 240;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', '', '2011-06-14', 'Y', '', ',home,content,horse,User,Help,Stable');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_breeds`
--

CREATE TABLE IF NOT EXISTS `tbl_breeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `breed` varchar(255) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_breeds`
--

INSERT INTO `tbl_breeds` (`id`, `breed`, `posted_date`, `status`) VALUES
(1, 'Marwari', '2010-11-08', 'Y'),
(3, 'Kathiawari', NULL, 'Y'),
(7, 'Manipuri', '2010-12-22', 'Y'),
(5, 'Spiti', '2010-12-22', 'Y'),
(6, 'Zaniskari', '2010-12-22', 'Y'),
(8, 'Bhutia', '2010-12-22', 'Y'),
(9, 'Thoroughbred', '2010-12-22', 'Y'),
(10, 'Thoroughbred/Marwari', '2011-01-04', 'Y'),
(11, 'Marwari/Kathiawari', '2011-01-04', 'Y'),
(12, 'Thoroughbred/Kathiawari', '2011-01-04', 'Y'),
(13, 'Kathiawari mix', '2011-06-10', 'Y'),
(14, 'Marwari mix', '2011-06-10', 'Y'),
(15, 'Sindhi', '2011-06-15', 'Y'),
(16, 'unknown', '2011-06-15', 'Y'),
(17, 'Desi', '2011-06-15', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_changeeditrequestnotifications`
--

CREATE TABLE IF NOT EXISTS `tbl_changeeditrequestnotifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horse_id` int(11) DEFAULT NULL,
  `accept_stat` enum('Y','N') DEFAULT 'N',
  `notified_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=167 ;

--
-- Dumping data for table `tbl_changeeditrequestnotifications`
--

INSERT INTO `tbl_changeeditrequestnotifications` (`id`, `horse_id`, `accept_stat`, `notified_date`) VALUES
(1, 60, 'N', '2011-06-15'),
(2, 62, 'N', '2011-06-15'),
(3, 100, 'N', '2011-06-17'),
(4, 62, 'N', '2011-06-20'),
(5, 63, 'N', '2011-06-20'),
(6, 105, 'N', '2011-06-20'),
(7, 105, 'N', '2011-06-20'),
(8, 105, 'N', '2011-06-20'),
(9, 103, 'N', '2011-06-21'),
(10, 108, 'N', '2011-06-21'),
(11, 81, 'N', '2011-06-21'),
(12, 3, 'N', '2011-06-21'),
(13, 81, 'N', '2011-06-21'),
(14, 63, 'N', '2011-06-21'),
(15, 63, 'N', '2011-06-21'),
(16, 105, 'N', '2011-06-21'),
(17, 105, 'N', '2011-06-21'),
(18, 63, 'N', '2011-06-21'),
(19, 112, 'N', '2011-06-22'),
(20, 111, 'N', '2011-06-23'),
(21, 95, 'N', '2011-06-23'),
(22, 111, 'N', '2011-06-24'),
(23, 62, 'N', '2011-06-24'),
(24, 112, 'N', '2011-06-24'),
(25, 62, 'N', '2011-06-27'),
(26, 63, 'N', '2011-06-28'),
(27, 111, 'N', '2011-06-28'),
(28, 89, 'N', '2011-06-28'),
(29, 88, 'N', '2011-06-28'),
(30, 111, 'N', '2011-06-28'),
(31, 88, 'N', '2011-06-28'),
(32, 89, 'N', '2011-06-28'),
(33, 19, 'N', '2011-06-28'),
(34, 89, 'N', '2011-06-29'),
(35, 122, 'N', '2011-06-29'),
(36, 63, 'N', '2011-06-29'),
(37, 88, 'N', '2011-06-29'),
(38, 62, 'N', '2011-06-29'),
(39, 89, 'N', '2011-06-30'),
(40, 89, 'N', '2011-06-30'),
(41, 89, 'N', '2011-06-30'),
(42, 126, 'N', '2011-06-30'),
(43, 121, 'N', '2011-06-30'),
(44, 111, 'N', '2011-06-30'),
(45, 127, 'N', '2011-07-01'),
(46, 111, 'N', '2011-07-01'),
(47, 98, 'N', '2011-07-01'),
(48, 8, 'N', '2011-07-01'),
(49, 99, 'N', '2011-07-01'),
(50, 60, 'N', '2011-07-01'),
(51, 5, 'N', '2011-07-01'),
(52, 24, 'N', '2011-07-01'),
(53, 133, 'N', '2011-07-01'),
(54, 143, 'N', '2011-07-04'),
(55, 89, 'N', '2011-07-10'),
(56, 88, 'N', '2011-07-10'),
(57, 19, 'N', '2011-07-11'),
(58, 19, 'N', '2011-07-11'),
(59, 151, 'N', '2011-07-12'),
(60, 63, 'N', '2011-07-12'),
(61, 63, 'N', '2011-07-12'),
(62, 151, 'N', '2011-07-13'),
(63, 33, 'N', '2011-07-13'),
(64, 59, 'N', '2011-07-13'),
(65, 59, 'N', '2011-07-13'),
(66, 59, 'N', '2011-07-13'),
(67, 59, 'N', '2011-07-13'),
(68, 59, 'N', '2011-07-13'),
(69, 59, 'N', '2011-07-13'),
(70, 59, 'N', '2011-07-13'),
(71, 20, 'N', '2011-07-13'),
(72, 88, 'N', '2011-07-15'),
(73, 89, 'N', '2011-07-17'),
(74, 88, 'N', '2011-07-17'),
(75, 151, 'N', '2011-07-18'),
(76, 63, 'N', '2011-07-22'),
(77, 97, 'N', '2011-07-22'),
(78, 89, 'N', '2011-07-23'),
(79, 88, 'N', '2011-07-23'),
(80, 63, 'N', '2011-07-23'),
(81, 151, 'N', '2011-07-26'),
(82, 87, 'N', '2011-07-26'),
(83, 63, 'N', '2011-07-26'),
(84, 95, 'N', '2011-07-26'),
(85, 82, 'N', '2011-07-26'),
(86, 151, 'N', '2011-07-26'),
(87, 86, 'N', '2011-07-26'),
(88, 98, 'N', '2011-07-26'),
(89, 89, 'N', '2011-07-26'),
(90, 88, 'N', '2011-07-26'),
(91, 88, 'N', '2011-07-26'),
(92, 95, 'N', '2011-09-21'),
(93, 95, 'N', '2011-09-21'),
(94, 60, 'N', '2011-09-21'),
(95, 103, 'N', '2011-09-28'),
(96, 95, 'N', '2011-09-28'),
(97, 102, 'N', '2011-09-28'),
(98, 191, 'N', '2011-10-21'),
(99, 191, 'N', '2011-10-21'),
(100, 191, 'N', '2011-10-21'),
(101, 191, 'N', '2011-10-21'),
(102, 198, 'N', '2011-10-22'),
(103, 191, 'N', '2011-10-22'),
(104, 198, 'N', '2011-10-22'),
(105, 190, 'N', '2011-10-22'),
(106, 197, 'N', '2011-10-22'),
(107, 190, 'N', '2011-10-22'),
(108, 196, 'N', '2011-10-22'),
(109, 199, 'N', '2011-10-22'),
(110, 198, 'N', '2011-10-22'),
(111, 197, 'N', '2011-10-22'),
(112, 195, 'N', '2011-10-22'),
(113, 187, 'N', '2011-10-22'),
(114, 190, 'N', '2011-10-24'),
(115, 197, 'N', '2011-10-24'),
(116, 198, 'N', '2011-10-24'),
(117, 196, 'N', '2011-10-24'),
(118, 197, 'N', '2011-10-24'),
(119, 194, 'N', '2011-10-24'),
(120, 192, 'N', '2011-10-24'),
(121, 199, 'N', '2011-10-24'),
(122, 198, 'N', '2011-10-24'),
(123, 194, 'N', '2011-10-24'),
(124, 193, 'N', '2011-10-24'),
(125, 191, 'N', '2011-10-24'),
(126, 196, 'N', '2011-10-24'),
(127, 197, 'N', '2011-10-25'),
(128, 187, 'N', '2011-10-25'),
(129, 198, 'N', '2011-10-25'),
(130, 198, 'N', '2011-10-25'),
(131, 198, 'N', '2011-10-25'),
(132, 198, 'N', '2011-10-25'),
(133, 198, 'N', '2011-10-25'),
(134, 197, 'N', '2011-10-25'),
(135, 194, 'N', '2011-10-25'),
(136, 195, 'N', '2011-10-25'),
(137, 195, 'N', '2011-10-25'),
(138, 195, 'N', '2011-10-25'),
(139, 195, 'N', '2011-10-25'),
(140, 189, 'N', '2011-10-25'),
(141, 189, 'N', '2011-10-25'),
(142, 193, 'N', '2011-10-25'),
(143, 190, 'N', '2011-10-25'),
(144, 201, 'N', '2011-10-25'),
(145, 198, 'N', '2011-10-25'),
(146, 206, 'N', '2011-10-25'),
(147, 194, 'N', '2011-10-25'),
(148, 207, 'N', '2011-11-04'),
(149, 187, 'N', '2011-11-05'),
(150, 210, 'N', '2011-11-11'),
(151, 192, 'N', '2011-11-11'),
(152, 193, 'N', '2011-11-11'),
(153, 200, 'N', '2011-11-18'),
(154, 212, 'N', '2011-12-01'),
(155, 212, 'N', '2011-12-01'),
(156, 191, 'N', '2011-12-01'),
(157, 241, 'N', '2011-12-09'),
(158, 241, 'N', '2011-12-09'),
(159, 241, 'N', '2011-12-09'),
(160, 241, 'N', '2011-12-09'),
(161, 243, 'N', '2011-12-09'),
(162, 243, 'N', '2011-12-09'),
(163, 242, 'N', '2011-12-09'),
(164, 243, 'N', '2011-12-09'),
(165, 243, 'N', '2011-12-09'),
(166, 2, 'N', '2011-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_changerequesthorseimages`
--

CREATE TABLE IF NOT EXISTS `tbl_changerequesthorseimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horse_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `tbl_changerequesthorseimages`
--

INSERT INTO `tbl_changerequesthorseimages` (`id`, `horse_id`, `image`) VALUES
(58, 151, '452281Sunset.jpg'),
(57, 63, '69244Koda2.jpg'),
(56, 63, '125101koda5.jpg'),
(55, 63, '214127koda4.jpg'),
(54, 63, '34981Koda1.jpg'),
(16, 33, '383059Rajanigandha2.jpg'),
(17, 33, '58682Rajanigandha1.jpg'),
(23, 59, '246059248749_164044370327043_100001644444698_409097_4147702_n.jpg'),
(24, 20, '338854Dilraj2.jpg'),
(25, 20, '162476Dilraj3.jpg'),
(26, 20, '26012Dilraj4.jpg'),
(68, 88, '28646845210_1592088724472_1303511245_31631666_3392740_n.jpg'),
(67, 88, '32380114531_1288519335427_1303511245_30836760_4280510_n.jpg'),
(64, 89, '458090250514_2078965176079_1303511245_32479959_4771728_n.jpg'),
(63, 89, '218870250184_2078956935873_1303511245_32479944_7241431_n.jpg'),
(62, 89, '84367247029_2078961895997_1303511245_32479952_7540592_n.jpg'),
(51, 87, '9199629122_1451396367251_1303511245_31262533_1576462_n.jpg'),
(52, 87, '432391248918_2079028617665_1303511245_32480019_230051_n.jpg'),
(53, 87, '21190640426_1588350551020_1303511245_31622806_4890896_n.jpg'),
(59, 86, '34690229122_1451396567256_1303511245_31262535_6713368_n.jpg'),
(60, 86, '79600250503_2079023577539_1303511245_32480011_6256516_n.jpg'),
(61, 86, '238423250758_2079026017600_1303511245_32480015_1750564_n.jpg'),
(69, 102, '251420154232_176830482333120_100000185076430_659741_1661352_n.jpg'),
(70, 102, '4573722.png'),
(95, 198, '1298878124_1235999815551_1095877496_747267_3196720_n.jpg'),
(94, 198, '3343369029_1247498065970_1184977551_30741651_2131897_n-1.jpg'),
(93, 198, '4005826 marwari india horse.jpg'),
(92, 198, '1984289029_1243542887093_1184977551_30730165_6140235_n-1.jpg'),
(100, 193, '1321004755_black_hrs.jpg'),
(101, 193, '138680horse2.jpg'),
(102, 193, '470905horse_sub_box1.jpg'),
(103, 193, '81062horse4.jpg'),
(104, 200, '1320740733_1.jpg'),
(105, 200, '915833.jpg'),
(109, 212, '285862horse_sub_box.jpg'),
(108, 212, '104775horse2.jpg'),
(141, 242, '358674horse4.jpg'),
(140, 242, '34155horse4.jpg'),
(135, 241, '259624black_hrs.jpg'),
(134, 241, '41645horse2.jpg'),
(133, 241, '329464horse4.jpg'),
(132, 241, '412101horse5.jpg'),
(142, 242, '143735horse2.jpg'),
(149, 243, '345957horse5.jpg'),
(148, 243, '162186horse1.jpg'),
(151, 2, '95466alishaan2.jpg'),
(152, 2, '470658Alishaan1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_changerequesthorses`
--

CREATE TABLE IF NOT EXISTS `tbl_changerequesthorses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horse_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `utube_link` varchar(255) DEFAULT NULL,
  `ownerid` int(11) DEFAULT NULL,
  `ownername` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` float(6,2) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `breed_id` int(11) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `yearofdeath` varchar(255) DEFAULT NULL,
  `deathstat` enum('Y','N') NOT NULL DEFAULT 'N',
  `sire_id` int(11) DEFAULT NULL,
  `sire` varchar(255) DEFAULT NULL,
  `dam` varchar(255) DEFAULT NULL,
  `dam_id` int(11) DEFAULT NULL,
  `height_id` int(11) DEFAULT NULL,
  `stable_id` int(11) DEFAULT NULL,
  `stablename` varchar(255) DEFAULT NULL,
  `bred_id` int(11) DEFAULT NULL,
  `bred_name` varchar(255) DEFAULT NULL,
  `coatcolor_id` int(11) DEFAULT NULL,
  `bloodline` varchar(255) DEFAULT NULL,
  `breeder` varchar(255) DEFAULT NULL,
  `breeder_id` int(11) DEFAULT NULL,
  `prize_won` text,
  `town_id` int(255) DEFAULT NULL,
  `countryid` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `other_details` text,
  `posted_date` date DEFAULT NULL,
  `edited_date` date DEFAULT NULL,
  `sales_status` enum('S','Stud','Notsale') DEFAULT NULL,
  `putforsale` enum('Y','N') DEFAULT 'N',
  `nameunknownoption` varchar(255) DEFAULT 'N',
  `sireunknowoption` varchar(255) DEFAULT NULL,
  `damunknownoption` varchar(255) DEFAULT NULL,
  `approve_status` enum('Y','N') DEFAULT 'N',
  `requestedby_id` int(11) DEFAULT NULL,
  `changed_date` date DEFAULT NULL,
  `acceptedordeny` varchar(255) DEFAULT NULL,
  `acceptedbyid` int(11) DEFAULT NULL,
  `revert_status` enum('Y','N') DEFAULT 'N',
  `registered` varchar(255) DEFAULT NULL,
  `registration_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=163 ;

--
-- Dumping data for table `tbl_changerequesthorses`
--

INSERT INTO `tbl_changerequesthorses` (`id`, `horse_id`, `image`, `video`, `utube_link`, `ownerid`, `ownername`, `name`, `price`, `gender`, `breed_id`, `year`, `yearofdeath`, `deathstat`, `sire_id`, `sire`, `dam`, `dam_id`, `height_id`, `stable_id`, `stablename`, `bred_id`, `bred_name`, `coatcolor_id`, `bloodline`, `breeder`, `breeder_id`, `prize_won`, `town_id`, `countryid`, `state_id`, `other_details`, `posted_date`, `edited_date`, `sales_status`, `putforsale`, `nameunknownoption`, `sireunknowoption`, `damunknownoption`, `approve_status`, `requestedby_id`, `changed_date`, `acceptedordeny`, `acceptedbyid`, `revert_status`, `registered`, `registration_code`) VALUES
(162, 2, '', '', '', 96, 'owner -', 'B-Horse', NULL, '3', 1, '', '', 'N', NULL, '', '', NULL, 1, NULL, '', NULL, '', 1, '', 'Breeder -', NULL, '', 1, 2, 1, 'Offspring:\r\nC\r\nH\r\nE', '2011-12-11', NULL, NULL, 'N', 'N', 'Y', 'Y', 'Y', 103, '2011-12-11', NULL, NULL, 'N', 'N', ''),
(144, 187, '1319531672_260365009 - Shaandaar (2).jpg', '', '', 96, 'owner -', 'A-Horse', NULL, '4', 1, '', '', 'N', 189, 'D-Horse', 'B-Horse', 188, 12, NULL, '', NULL, '', 9, '', 'Breeder -', NULL, '', 29, 2, 22, 'Offspring:\r\nF\r\nG\r\nC\r\nJ\r\nL\r\nM\r\n\r\nchange', '2011-11-05', NULL, NULL, 'N', 'N', 'N', 'N', 'Y', 103, '2011-11-05', 'Y', 96, 'N', 'N', ''),
(145, 210, NULL, '', '', NULL, NULL, 'koda sire', NULL, '2', 3, '', '', 'N', NULL, '', '', NULL, 3, NULL, '', NULL, '', 2, '', '', NULL, '', 56, 1, 3, 'test', '2011-11-11', NULL, NULL, 'N', 'N', 'Y', 'Y', 'N', 129, NULL, NULL, NULL, 'N', 'N', ''),
(147, 192, '', '', '', 96, 'Owner - ', 'C-Horse', NULL, '2', 3, '2001', '2010', 'Y', 189, 'D-Horse', 'G-Horse', 191, 17, NULL, '', NULL, '', 3, 'test', 'Breeder - ', NULL, 'alls', 31, 2, 24, 'Offspring:\r\nH\r\nI\r\n\r\nSiblings:\r\nF\r\nL\r\nM\r\nG\r\nJ\r\nE\r\nH', '2011-11-11', NULL, NULL, 'N', 'N', 'N', 'N', 'Y', 129, '2011-11-11', NULL, NULL, 'N', 'Y', 'test'),
(148, 193, '27181horse1.jpg', '', '', 91, 'Beau Bikker', 'E-Horse', NULL, '4', 1, '', '', 'N', 189, 'D-Horse', 'B-Horse', 188, 4, NULL, 'Feature stable', 6, 'Feature stable', 1, '', 'Beau Bikker', NULL, '', 64, 1, 21, 'Siblings:\r\nK\r\nH\r\nC', '2011-11-11', NULL, NULL, 'N', 'N', 'N', 'N', 'Y', 128, '2011-11-11', 'Y', 91, 'N', 'N', ''),
(149, 200, '4146842.jpg', '', '', 96, 'owner -', 'H-sire', NULL, '2', 1, '', '2001', 'Y', NULL, '', '', NULL, 1, NULL, '', NULL, '', 1, '', 'Breeder - ', NULL, '', 40, 1, 8, 'unknown', '2011-11-18', NULL, NULL, 'N', 'N', 'Y', 'Y', 'Y', 91, '2011-11-18', 'N', 96, 'N', 'N', ''),
(150, 212, '1321000630_horse2.jpg', '', '', NULL, '', 'P-horse', NULL, '3', 6, '2005', '', 'N', NULL, '', '', NULL, 3, NULL, '', NULL, '', 11, 'Blood', 'Soumavo Chatterjee', NULL, '', 57, 1, 30, 'Test', '2011-12-01', NULL, NULL, 'N', 'N', NULL, NULL, 'Y', 90, '2011-12-01', 'Y', 96, 'N', 'N', ''),
(151, 212, '1321000630_horse2.jpg', '', '', 96, 'owner -', 'P-horse', NULL, '3', 6, '2005', '', 'N', NULL, '', '', NULL, 3, NULL, '', NULL, '', 11, 'Blood', 'Breeder -', NULL, '', 57, 1, 30, 'Test', '2011-12-01', NULL, NULL, 'N', 'N', 'N', 'N', 'Y', 103, '2011-12-01', NULL, NULL, 'N', 'N', ''),
(161, 243, '1323425990_horse3.jpg', '', '', 91, 'Beau Bikker', '4596', NULL, '2', 15, '2001', '', 'N', NULL, '', '', NULL, 9, NULL, '', NULL, '', 17, '', 'Soumavo Chatterjee', NULL, '', 42, 1, 4, 'test', '2011-12-09', NULL, NULL, 'N', 'N', 'N', 'N', 'Y', 130, '2011-12-09', 'N', 91, 'N', 'N', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coatcolors`
--

CREATE TABLE IF NOT EXISTS `tbl_coatcolors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(255) DEFAULT NULL,
  `posteddate` date DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tbl_coatcolors`
--

INSERT INTO `tbl_coatcolors` (`id`, `color`, `posteddate`, `status`) VALUES
(1, 'Unknown', '2011-06-10', 'Y'),
(2, 'Albino (red eyes)', '2011-06-10', 'Y'),
(3, 'Bay', '2011-06-10', 'Y'),
(4, 'Bay (Dark)', '2011-06-10', 'Y'),
(5, 'Black', '2011-06-10', 'Y'),
(6, 'Black Brown', '2011-06-10', 'Y'),
(7, 'Brown', '2011-06-10', 'Y'),
(8, 'Buckskin', '2011-06-10', 'Y'),
(9, 'Chestnut', '2011-06-10', 'Y'),
(10, 'Chestnut (Liver)', '2011-06-10', 'Y'),
(11, 'Cremello (Nukra)', '2011-06-10', 'Y'),
(12, 'Dun', '2011-06-10', 'Y'),
(13, 'Dun (Yellow)', '2011-06-10', 'Y'),
(14, 'Dun (Grey)', '2011-06-10', 'Y'),
(15, 'Grey (Dapple)', '2011-06-10', 'Y'),
(16, 'Grey', '2011-06-10', 'Y'),
(17, 'Grey (Flea Bitten)', '2011-06-10', 'Y'),
(18, 'Grulla (Blue Dun)', '2011-06-10', 'Y'),
(19, 'Palomino', '2011-06-10', 'Y'),
(20, 'Piebald', '2011-06-10', 'Y'),
(21, 'Roan (Bay)', '2011-06-10', 'Y'),
(22, 'Roan (Blue)', '2011-06-10', 'Y'),
(23, 'Roan (Strawberry)', '2011-06-10', 'Y'),
(24, 'Skewbald', '2011-06-10', 'Y'),
(25, 'Tri-Colored', '2011-06-10', 'Y'),
(26, 'White', '2011-06-10', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contents`
--

CREATE TABLE IF NOT EXISTS `tbl_contents` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tbl_contents`
--

INSERT INTO `tbl_contents` (`id`, `pagename`, `content`) VALUES
(1, 'Home', '<p><span style="font-size: large; "><strong>Welcome to the Indian Horse Database</strong></span></p>\r\n<p>&nbsp;</p>\r\n<p>This is the database of Indian horses sustained by horse owners, breeders and enthausiasts like you.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Join us for free and you can:</strong><b><br type="_moz" />\r\n</b></p>\r\n<p>\r\n<meta charset="utf-8">    </meta>\r\n</p>\r\n<p style="margin-left:40px;"><strong>Browse</strong> detailed profiles, pedigrees, pictures &amp; information about Indian breed horses.<br style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; " />\r\n<strong>A</strong><strong>dd</strong>&nbsp;your own horses and link them to already excisting pedigrees.<br />\r\n<strong>Request</strong> to change existing horses.<br />\r\n&nbsp;&nbsp;</p>\r\n<p><strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">Become a premium member and gain extra access to features such as:</strong></p>\r\n<p style="margin-left: 40px;&gt;View detailed pedigrees, pictures &amp; information about Indian breed horses.&lt;br /&gt;\r\nJoin the community and upload your own horses and request to change existing horses.&lt;/p&gt;\r\n&lt;p&gt;&nbsp;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Become a premium member and gain extra access to features such as:&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style="><strong>Promote</strong> your stable by creating a profile page that links your stable to your horses in the IHD.<br />\r\n<strong>Advertise</strong> your horses for sale &amp; stud.<br />\r\n<strong>Subscribe</strong> to horses, stables so you will always know about new changes.</p>'),
(2, 'Terms', '<p>Terms Of&nbsp; Usage Content Coming soon............</p>'),
(3, 'Faq', '<p>Help Center</p>'),
(7, 'Privacy Policy', '<p>Privacy Policy Content........ Privacy Policy Content..Privacy Policy Content..Privacy Policy Content..</p>'),
(9, 'CANCELLATION POLICY', '<p>CANCELLATION POLICY..................................................</p>'),
(15, 'updatesucess', '<p>You have successfully upgraded to a premium membership!</p>\r\n<p>Log in to &nbsp;see and set up your new features.</p>'),
(16, 'extendsuccess', '<p>You have successfully extended your membership</p>'),
(8, 'Contact Us', '<h3>By Email / Skype:</h3>\r\n<div style="padding: 10px 0pt 10px 20px;">To get in contact with one of our personel please send us a message or try contacting us through our skype line.<br />\r\n<span class="fox55">Skype: indianhorsedatabase</span></div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<p>&nbsp;</p>'),
(11, 'Welcomepremiumuser', '<p><strong><span style="font-size: larger; ">These are your Notifications</span></strong></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>Vivamus eget metus vitae nibh tincidunt facilisis vitae quis risus.</p>\r\n<p>Suspendisse commodo, tellus at mattis lobortis, orci dolor sollicitudin purus, in dictum diam orci eu urna.</p>\r\n<p>\r\n<meta charset="utf-8" /></p>'),
(12, 'Horsepostsuccess', '<p>You have successfully posted horse information. Please wait for admin approval</p>'),
(14, 'Deactivate Account', '<p>You have successfully deactivated your account.</p>\r\n<p>To activate your account you must contact the site admin at admin@in...</p>'),
(17, 'Log In', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit amet tellus eros, quis mollis dolor. Suspendisse turpis diam, venenatis id tincidunt sit amet, pulvinar et orci.</p>'),
(18, 'Premium Home', '<p>Thank you for your continued support of our features!</p>\r\n<p>Here is how you can help expanding the IHD</p>\r\n<ul>\r\n    <li>Spread the word! Letting people in on the information is the #1 step to take!</li>\r\n    <li>Keep adding &amp; updating information. Making sure information is up to date will benefit all users, and prospective partners/buyers are more likely to return and view your horses for sale.</li>\r\n    <li>Don''t forget to ''like'' your favorite horses, breeders &amp; stables!</li>\r\n</ul>\r\n<p>Enjoy the site!&nbsp;</p>\r\n<p><a style="color: rgb(153, 51, 51);" class="big91" href="http://indianhorsedatabase.com/help/showall">Need help?</a></p>'),
(19, 'Free user home', '<p>This a home page for free user</p>'),
(20, 'Advertise', '<p>AdvertiseAdvertise AdvertiseAdvertise</p>'),
(21, 'DISCLAIMER', '<p>Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer Disclamer&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE IF NOT EXISTS `tbl_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `posted_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=315 ;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `country`, `status`, `posted_date`) VALUES
(1, 'India', 'Y', '2011-06-13'),
(3, 'France', 'Y', '2011-06-13'),
(4, 'Spain', 'Y', '2011-06-13'),
(5, 'United States', 'Y', '2011-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_genders`
--

CREATE TABLE IF NOT EXISTS `tbl_genders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_genders`
--

INSERT INTO `tbl_genders` (`id`, `gender`) VALUES
(3, 'Mare'),
(2, 'Stallion'),
(4, 'Gelding');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_heights`
--

CREATE TABLE IF NOT EXISTS `tbl_heights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `height` varchar(255) DEFAULT NULL,
  `posteddate` date DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tbl_heights`
--

INSERT INTO `tbl_heights` (`id`, `height`, `posteddate`, `status`) VALUES
(1, 'unknown ', '2011-06-10', 'Y'),
(2, '12.5 hh - 127 cm - 50" ', '2010-12-22', 'Y'),
(3, '12.6 hh - 128 cm - 50.4"', '2010-12-22', 'Y'),
(4, '12.7 hh - 129 cm - 50.8" ', '2010-12-22', 'Y'),
(5, '12.8 hh - 130 cm - 51.2"', '2010-12-22', 'Y'),
(6, '12.9 hh - 133 cm - 51.6"', '2010-12-22', 'Y'),
(7, '13.0   hh - 134 cm - 52"', '2010-12-22', 'Y'),
(8, '13.1 hh - 135 cm - 52.4"', '2010-12-22', 'Y'),
(9, '13.2 hh - 136 cm - 52.8"', '2010-12-22', 'Y'),
(10, '13.3 hh - 137 cm - 53.2" ', '2010-12-22', 'Y'),
(11, '13.4 hh - 138 cm - 53.6"', '2010-12-22', 'Y'),
(12, '13.5 hh - 139 cm - 54"', '2010-12-22', 'Y'),
(13, '13.6 hh - 140 cm - 54.4"', '2010-12-22', 'Y'),
(14, '13.7 hh - 141 cm - 54.8"', '2010-12-22', 'Y'),
(15, '13.8 hh - 142 cm - 55.2"', '2010-12-22', 'Y'),
(16, '13.9 hh - 143 cm - 55.6"', '2010-12-22', 'Y'),
(17, '14.0 hh - 144 cm - 56"', '2010-12-22', 'Y'),
(18, '14.1 hh - 145 cm - 56.4"', '2010-12-22', 'Y'),
(19, '14.2 hh - 146 cm - 56.8"', '2010-12-22', 'Y'),
(20, '14.3 hh - 147 cm - 57.2"', '2010-12-22', 'Y'),
(21, '14.4 hh - 148 cm - 57.6"', '2010-12-22', 'Y'),
(22, '14.5 hh - 149 cm - 58"', '2010-12-22', 'Y'),
(24, '14.6 hh - 150 cm - 58.4''''', NULL, 'Y'),
(25, '14.7 hh - 151 cm - 58.8''''', NULL, 'Y'),
(26, '14.8 hh - 152 cm - 59.2''''', NULL, 'Y'),
(27, '14.9 hh - 153 cm - 59.6''''', NULL, 'Y'),
(28, '15.0 hh - 154 cm - 60''''', NULL, 'Y'),
(29, '15.1 hh - 155 cm - 60.4''''', NULL, 'Y'),
(30, '15.2 hh - 156 cm - 60.8'''' ', NULL, 'Y'),
(31, '15.3 hh - 157 cm - 61.2''''', NULL, 'Y'),
(32, '15.4 hh - 158 cm - 61.6''''', NULL, 'Y'),
(33, '15.5 hh - 159 cm - 62''''', NULL, 'Y'),
(34, '15.6 hh - 160 cm - 62.4''''', NULL, 'Y'),
(35, '15.7 hh - 161 cm - 62.8''''', NULL, 'Y'),
(36, '15.8 hh - 162 cm - 63.2'''' ', NULL, 'Y'),
(37, '15.9 hh - 163 cm - 63.6''''', NULL, 'Y'),
(38, '16.0 hh - 164 cm - 64''''', NULL, 'Y'),
(39, '16.1 hh - 165 cm - 64.4''''', NULL, 'Y'),
(40, '16.2 hh - 166 cm - 64.8''''', NULL, 'Y'),
(41, '16.3 hh - 167 cm - 65.2''''', NULL, 'Y'),
(42, '16.4 hh - 168 cm - 65.6''''', NULL, 'Y'),
(43, '16.5 hh - 169 cm - 66''''', NULL, 'Y'),
(44, '16.6 hh - 170 cm - 66.4"', NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_helps`
--

CREATE TABLE IF NOT EXISTS `tbl_helps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hlpname` varchar(255) DEFAULT NULL,
  `helptext` text,
  `posted_date` date DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_helps`
--

INSERT INTO `tbl_helps` (`id`, `hlpname`, `helptext`, `posted_date`, `status`) VALUES
(1, 'All about becoming a member', '<p><a href="http://indianhorsedatabase.com/user/selectmembership"><input name="Signup" type="button" value="Sign Up" /></a>&nbsp;to join us as a member.</p>\r\n<p>You can choose to be a free or a premium member, listed below are the features:</p>\r\n<p>Premium:</p>\r\n<ul>\r\n    <li>Full access to all horses, stables and member profiles</li>\r\n    <li>Add unlimited horses</li>\r\n    <li>Request to change any existing horse in the IHD</li>\r\n    <li>Create a profile for you Horse (breeding) stables, and have your horses for sale listed</li>\r\n    <li>Advertise an unlimited horses for sale or stud</li>\r\n    <li>Subscribe to horses, stables and member profiles, so you always know what''s new.</li>\r\n</ul>\r\n<p>Free:</p>\r\n<ul>\r\n    <li>Full access to all horses, stables and member profiles</li>\r\n    <li>Add unlimited horses</li>\r\n    <li>Request to change any exisitng horse in the IHD</li>\r\n</ul>', '2011-06-10', 'Y'),
(2, 'I''ve added my horse, now what?', '<p>First of all thanks for expanding the IHD!<br />\r\n<br />\r\n<br />\r\nYou can put your horse for sale or stud<br />\r\n<br />\r\n<br />\r\n&nbsp;</p>', '2011-06-10', 'Y'),
(7, 'How do I determine the Height of your horse?', '<p>\r\n<meta charset="utf-8">       </meta>\r\n</p>\r\n<div style="background-color: transparent; margin-top: 0px; margin-left: 0px; margin-bottom: 0px; margin-right: 0px; ">\r\n<h2 id="internal-source-marker_0.4666834913659841">Measuring your horse''s height&nbsp;</h2>\r\n<p>&nbsp;<br />\r\n<span style="font-size: medium; "><strong>Location:</strong></span></p>\r\n<p>A flat hard surface</p>\r\n<p>&nbsp;</p>\r\n<meta charset="utf-8">\r\n<p><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">A flat hard surface </span></span></p>\r\n<p><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">A place where the horse is calm &amp; at ease</span></span></p>\r\n<h4>&nbsp;</h4>\r\n<h4><span style="font-size: medium; ">Tools needed:</span></h4>\r\n<p>&nbsp;</p>\r\n<meta charset="utf-8">\r\n<p><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Measuring Stick </span></span></p>\r\n<p><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Alternative: </span></span></p>\r\n<p><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Long straight stick at least 6 feet long. </span></span></p>\r\n<p><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Short stick about 3 feet long. </span></span></p>\r\n<p><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Someone to help you.</span><br type="_moz" />\r\n</span></p>\r\n<p>&nbsp;</p>\r\n<h4><span style="font-size: medium; ">Steps:&nbsp;</span></h4>\r\n<h4><a id="fck_paste_padding">\r\n<meta charset="utf-8">\r\n<div style="background-color: transparent; margin-top: 0px; margin-left: 0px; margin-bottom: 0px; margin-right: 0px; display: inline !important; ">\r\n<p style="display: inline !important; "><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Get the horse to stand square on the flat surface.</span></span></p>\r\n<p style="display: inline !important; ">&nbsp;</p>\r\n<p style="display: inline !important; ">&nbsp;</p>\r\n</div>\r\n</meta>\r\n</a><a id="fck_paste_padding">\r\n<meta charset="utf-8">\r\n<div style="background-color: transparent; margin-top: 0px; margin-left: 0px; margin-bottom: 0px; margin-right: 0px; display: inline !important; ">\r\n<p style="display: inline !important; "><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Have someone hold the horse and make sure it is calm, don&rsquo;t tie the horse up for safety.</span></span></p>\r\n<p style="display: inline !important; ">&nbsp;</p>\r\n<p style="display: inline !important; ">&nbsp;</p>\r\n</div>\r\n</meta>\r\n</a><a id="fck_paste_padding">\r\n<meta charset="utf-8">\r\n<div style="background-color: transparent; margin-top: 0px; margin-left: 0px; margin-bottom: 0px; margin-right: 0px; display: inline !important; ">\r\n<p style="display: inline !important; "><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Find the withers of the horse, this is the bump in the back right in front of where the saddle would sit.</span></span></p>\r\n<p style="display: inline !important; ">&nbsp;</p>\r\n<p style="display: inline !important; ">&nbsp;</p>\r\n</div>\r\n</meta>\r\n</a><a id="fck_paste_padding">\r\n<meta charset="utf-8">\r\n<div style="background-color: transparent; margin-top: 0px; margin-left: 0px; margin-bottom: 0px; margin-right: 0px; display: inline !important; ">\r\n<p style="display: inline !important; "><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Place your measuring stick beside the withers on the ground and make sure it is straight.</span></span></p>\r\n<p style="display: inline !important; ">&nbsp;</p>\r\n<p style="display: inline !important; ">&nbsp;</p>\r\n</div>\r\n</meta>\r\n</a><a id="fck_paste_padding">\r\n<meta charset="utf-8">\r\n<div style="background-color: transparent; margin-top: 0px; margin-left: 0px; margin-bottom: 0px; margin-right: 0px; display: inline !important; ">\r\n<p style="display: inline !important; "><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Place the shorter stick on the highest point of the horse&rsquo;s withers and against your long measuring stick. Then have someone mark the long stick with a pen right under the horizontal stick.</span></span></p>\r\n<p style="display: inline !important; ">&nbsp;</p>\r\n<p style="display: inline !important; ">&nbsp;</p>\r\n</div>\r\n</meta>\r\n</a><a id="fck_paste_padding">\r\n<meta charset="utf-8">\r\n<div style="background-color: transparent; margin-top: 0px; margin-left: 0px; margin-bottom: 0px; margin-right: 0px; display: inline !important; ">\r\n<p style="display: inline !important; "><span style="font-size: larger; "><span style="font-family: ''Trebuchet MS''; color: rgb(0, 0, 0); background-color: transparent; font-weight: normal; font-style: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap; ">Measure the long stick in inches and publish your result to the IHD.</span></span></p>\r\n</div>\r\n</meta>\r\n</a></h4>\r\n<h4><a id="fck_paste_padding">\r\n<p style="font-family: Arial, Verdana, sans-serif; font-size: 12px; white-space: normal; display: inline !important; ">&nbsp;</p>\r\n</a><a>&#65279;</a></h4>\r\n<h4>&nbsp;</h4>\r\n</meta>\r\n</meta>\r\n</div>', '2011-06-11', 'Y'),
(3, 'I added a horse, but it''s not in the my horses page!', '<p>Your horse will only appear in the ''My horses page'' if you are listed as the owner, thus allowing only the owner to have full access over changing horse information, for sale and for stud status.</p>\r\n<p>If you are still having problems, please&nbsp;<a href="http://indianhorsedatabase.com/content/contact/"><input name="contact" type="button" value="contact us" /></a></p>', '2011-06-10', 'Y'),
(4, 'Requesting to change an existing horse', '<p>The IHD has an unique feature called: Change Requests</p>\r\n<p>&nbsp;</p>\r\n<p>How does it work?</p>\r\n<p>As an owner of a horse on the IHD, you have as either a free or premium member, full access to change your horse''s information.</p>\r\n<p>However if another member knows additional information about your horse they can file for a change request.</p>\r\n<p>Their change request is sent to the Admin of the IHD.</p>\r\n<p>Once the admin has approved of the changes, the owner, the breeder and the person who has added the horse are all requested to additionally verify the change request made. They will all get a notification on their Dashboard, asking them if they approve or disapprove of the change. If as a owner, breeder or adder, disapprove you will be asked to state a reason which will be sent back to the admin for reconsideration, the admin then has the final word.</p>\r\n<p>In the case that you approve, well, the IHD will have gotten more detailed and can better serve it''s purpose!</p>\r\n<p>&nbsp;</p>\r\n<p>If you are still not happy with the admin''s final choice please write us a detailed response through email so the admin can best address the situation.\r\n<meta charset="utf-8">    </meta>\r\n</p>\r\n<p align="justify" id="aeaoofnhgocdbnbeljkmbjdmhbcokfdb-mousedown" style="color: rgb(0, 0, 0); font-size: 12px; font-family: arial, helvetica, sans-serif; margin-bottom: 0px; ">&nbsp;</p>\r\n<p>&nbsp;</p>', '2011-06-10', 'Y'),
(5, 'How do I remove my horse?', '<p>It is not possible to remove your horse, as it contributes to the IHD. If you still want to get your horse removed, please contact the admin:&nbsp;<a href="http://indianhorsedatabase.com/content/contact/"><input name="contact" type="button" value="Contact" /></a></p>', '2011-06-10', 'Y'),
(6, 'All about advertising your horse for sale and/or stud', '<p>&nbsp;As a premium member you are able to put your horse for sale.<br />\r\n<br />\r\nThis means you are asked to provide details about:&nbsp;</p>\r\n<ul>\r\n    <li>How to contact you</li>\r\n    <li>Price</li>\r\n    <li>Additional info about the sale or stud service</li>\r\n</ul>\r\n<p>Now your horse will be listed on our: Horse for sale &amp; stud page, also a banner will appear on your horse''s profile page, advertising the sale or stud service.<br />\r\n<br />\r\nOn our home page is a banner of horses recenly put up for sale, this includes the latest 6 horses.</p>', '2011-06-10', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_horseforstuds`
--

CREATE TABLE IF NOT EXISTS `tbl_horseforstuds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horse_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `contact_details` text,
  `stud_details` text,
  `pricerange_fromid` int(11) DEFAULT NULL,
  `pricerange_toid` int(11) NOT NULL,
  `posted_date` date NOT NULL,
  `studstatus` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_horseforstuds`
--

INSERT INTO `tbl_horseforstuds` (`id`, `horse_id`, `user_id`, `contact_details`, `stud_details`, `pricerange_fromid`, `pricerange_toid`, `posted_date`, `studstatus`) VALUES
(2, 111, 1, 'test', 'test', 8, 11, '2011-06-22', 'Y'),
(5, 147, 1, 'Test', 'Test', 6, 6, '2011-07-06', 'Y'),
(6, 125, 1, 'Test data', 'Test data', 6, 13, '2011-07-06', 'Y'),
(8, 95, 1, 'Beau Bikker', 'This horse is for stud', 22, 36, '2011-09-28', 'Y'),
(9, 167, 97, 'Soumavo chatterjee own breeding firm', 'This is the horse which is also for stud', 21, 37, '2011-10-15', 'Y'),
(10, 168, 97, 'soumavo chatterjees own firm ', 'This is another just for stud', 23, 108, '2011-10-15', 'Y'),
(11, 199, 96, 'sadgdfsg', 'sdgsdf', 22, 23, '2011-10-25', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_horseimages`
--

CREATE TABLE IF NOT EXISTS `tbl_horseimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horse_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `changed_from` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=395 ;

--
-- Dumping data for table `tbl_horseimages`
--

INSERT INTO `tbl_horseimages` (`id`, `horse_id`, `image`, `changed_from`) VALUES
(6, 1, '461269Dilshaan4.jpg', NULL),
(5, 1, '28764Dilshaan3.jpg', NULL),
(4, 1, '198709Dilshaan2.jpg', NULL),
(7, 5, '425679rajhans2.jpg', NULL),
(8, 5, '288160rajhans2.jpg.jpg', NULL),
(9, 9, '213818Swraj2.jpg', NULL),
(10, 9, '7572Swraj3.jpg', NULL),
(11, 9, '281827Swraj4.jpg', NULL),
(12, 10, '218891Dara2.jpg', NULL),
(13, 11, '92627Shaandar2.jpg', NULL),
(14, 11, '13232Shaandar3.jpg', NULL),
(15, 11, '361490Shaandar4.jpg', NULL),
(16, 12, '384870Karan2.jpg', NULL),
(17, 12, '379066Karan3.jpg', NULL),
(193, 19, '62335Adam2.jpg', NULL),
(19, 20, '338854Dilraj2.jpg', NULL),
(20, 20, '162476Dilraj3.jpg', NULL),
(21, 20, '26012Dilraj4.jpg', NULL),
(22, 21, '201290Gajraj.jpg', NULL),
(23, 22, '245508Champagane2.jpg', NULL),
(24, 23, '379196Pyari.jpg', NULL),
(25, 24, '13443Shyamla2.jpg', NULL),
(26, 24, '248590Shyamla3.jpg', NULL),
(27, 25, '97139Gunguru1.jpg', NULL),
(28, 25, '27320Gunguru2.jpg', NULL),
(29, 26, '56059Gunguru2.jpg', NULL),
(30, 26, '343145Gunguru1.jpg', NULL),
(31, 28, '243450Tallulah2.jpg', NULL),
(32, 29, '159881Bahadurshah2.jpg', NULL),
(33, 30, '262164Mehrunissa2.jpg', NULL),
(34, 30, '110814Mehrunissa1.jpg', NULL),
(35, 31, '293449Shanti2.jpg', NULL),
(36, 32, '358991Rajrana1.jpg', NULL),
(37, 33, '383059Rajanigandha2.jpg', NULL),
(38, 33, '58682Rajanigandha1.jpg', NULL),
(39, 35, '6210Alamguman2.jpg', NULL),
(40, 37, '118476Diwanna2.jpg', NULL),
(41, 37, '306035Diwanna.jpg', NULL),
(42, 41, '179806Diler2.jpg', NULL),
(43, 53, '105496Pari1.jpg', NULL),
(44, 54, '22541Gajkesri2.jpg', NULL),
(45, 55, '396763Prabhat3.jpg', NULL),
(46, 55, '372435Prabhat1.jpg', NULL),
(47, 56, '180953Gulmastan2.JPG', NULL),
(48, 56, '413530Gulmastan3.JPG', NULL),
(49, 57, '353281Apsara1.jpg', NULL),
(50, 57, '270075Apsara3.jpg', NULL),
(152, 62, '396798Majura.jpg', NULL),
(151, 62, '437777DSCF1758.jpg', NULL),
(150, 62, '19177DSCF1595.jpg', NULL),
(149, 62, '344623DSCF1556.jpg', NULL),
(231, 63, '69244Koda2.jpg', NULL),
(230, 63, '125101koda5.jpg', NULL),
(229, 63, '214127koda4.jpg', NULL),
(228, 63, '34981Koda1.jpg', NULL),
(63, 64, '294265hero2.jpg', NULL),
(64, 68, '270989170744_1738783904839_1095877496_1979608_5531035_o.jpg', NULL),
(65, 70, '80520199350_194026337304272_100000907200632_482861_2278220_n.jpg', NULL),
(66, 70, '179464133933_172356702804569_100000907200632_353079_3579310_o.jpg', NULL),
(67, 70, '249722200310_196198213753751_100000907200632_495322_4360222_n.jpg', NULL),
(68, 69, '252681marebyadam.jpg', NULL),
(69, 69, '357360169759_172893439417562_100000907200632_356864_728108_o.jpg', NULL),
(70, 71, '388555169759_172893439417562_100000907200632_356864_728108_o.jpg', NULL),
(71, 72, '45549244482_1522528578591_1095877496_1521628_1456694_n.jpg', NULL),
(72, 73, '110857dam2.jpg', NULL),
(73, 77, '21520238886_1502687282571_1095877496_1469729_6952915_n.jpg', NULL),
(74, 21, '228520Gajraj.jpg', NULL),
(75, 21, '323738gajraj2.jpg', NULL),
(394, 2, '4777628112011208.jpg', 'N'),
(78, 86, '34690229122_1451396567256_1303511245_31262535_6713368_n.jpg', NULL),
(79, 86, '79600250503_2079023577539_1303511245_32480011_6256516_n.jpg', NULL),
(80, 86, '238423250758_2079026017600_1303511245_32480015_1750564_n.jpg', NULL),
(81, 87, '9199629122_1451396367251_1303511245_31262533_1576462_n.jpg', NULL),
(82, 87, '432391248918_2079028617665_1303511245_32480019_230051_n.jpg', NULL),
(83, 87, '21190640426_1588350551020_1303511245_31622806_4890896_n.jpg', NULL),
(239, 88, '28646845210_1592088724472_1303511245_31631666_3392740_n.jpg', NULL),
(238, 88, '32380114531_1288519335427_1303511245_30836760_4280510_n.jpg', NULL),
(235, 89, '458090250514_2078965176079_1303511245_32479959_4771728_n.jpg', NULL),
(234, 89, '218870250184_2078956935873_1303511245_32479944_7241431_n.jpg', NULL),
(233, 89, '84367247029_2078961895997_1303511245_32479952_7540592_n.jpg', NULL),
(89, 90, '292724250754_2078913014775_1303511245_32479907_6907123_n.jpg', NULL),
(90, 90, '213501249459_2078916774869_1303511245_32479912_5902608_n.jpg', NULL),
(91, 90, '315817249824_2078903334533_1303511245_32479894_7742209_n.jpg', NULL),
(92, 38, '366406babbu.jpg', NULL),
(93, 38, '465571babbu2.jpg', NULL),
(94, 94, '317653ashva-adhiraj.jpg', NULL),
(95, 94, '324306ashva-adhiraj4.jpg', NULL),
(96, 94, '367086ashva-adhiraj2.jpg', NULL),
(97, 75, '274420Banka_Yaar.jpg', NULL),
(98, 102, '251420154232_176830482333120_100000185076430_659741_1661352_n.jpg', NULL),
(99, 102, '4573722.png', NULL),
(208, 59, '246059248749_164044370327043_100001644444698_409097_4147702_n.jpg', NULL),
(153, 127, '39808Qxmas2.jpg', NULL),
(154, 127, '316315Qxmas3.jpg', NULL),
(155, 127, '419810Photoshop_Diver_submariner_013476_.jpg', NULL),
(156, 127, '335984Photoshop_Joe_the_Plumber_-_fish_011221_.jpg', NULL),
(166, 111, '4581816530_98666744290_848969290_1878659_1975047_n-1.jpg', NULL),
(167, 111, '3671866530_98666844290_848969290_1878678_4594117_n-1.jpg', NULL),
(168, 111, '28495n848969290_546657_9389.jpg', NULL),
(169, 111, '2223536530_98666789290_848969290_1878668_962979_n-1.jpg', NULL),
(170, 141, '27842916 chetak horse india .JPG', NULL),
(171, 141, '35421921 marwari india horse.jpg', NULL),
(172, 141, '14388221 marwari india horse.jpg', NULL),
(173, 126, '111851picture-3.jpg', NULL),
(174, 142, '387442Qxmas1.jpg', NULL),
(175, 142, '106730Qxmas2.jpg', NULL),
(176, 142, '382127Qxmas3.jpg', NULL),
(177, 142, '67323School.jpg', NULL),
(178, 143, '193350istockphoto_1242009-chess-composition.jpg', NULL),
(179, 143, '210085istockphoto_10172423-smiling-businessman-with-colleagues-in-the-background.jpg', NULL),
(180, 143, '396870istockphoto_11223787-chess.jpg', NULL),
(181, 143, '239988istockphoto_13178019-solved-maze-puzzle.jpg', NULL),
(182, 147, '40412401 Flipper france horse.JPG', NULL),
(183, 147, '25981801 idow france horse.JPG', NULL),
(184, 150, '145196hack.txt', NULL),
(185, 150, '221670super-horse.jpg', NULL),
(186, 150, '161746horse05wallpaper1.jpg', NULL),
(232, 151, '452281Sunset.jpg', NULL),
(240, 165, '13341872629dil2.jpg', NULL),
(241, 165, '459266157050Diwanna.jpg', NULL),
(273, 208, '', NULL),
(243, 167, '6121945419dil1.jpg', NULL),
(244, 167, '461600234514dil1.jpg', NULL),
(245, 167, '15213175413dil3.jpg', NULL),
(246, 168, '36344472629dil2.jpg', NULL),
(247, 168, '185597240320dil1.jpg', NULL),
(248, 168, '119031177033dil.jpg', NULL),
(249, 169, '26000307847dil.jpg', NULL),
(250, 169, '91561157050Diwanna.jpg', NULL),
(272, 208, '', NULL),
(288, 208, '333800shan.jpg', NULL),
(271, 198, '15949310320_1232096557972_1095877496_734662_2103133_n.jpg', NULL),
(269, 198, '40277310528_1230059787054_1095877496_727250_7878670_n.jpg', NULL),
(274, 208, '313047dil2.jpg', NULL),
(278, 208, '1320746748_2.jpg', NULL),
(281, 207, '275502011-11-01 10.19.23.jpg', NULL),
(279, 200, '1320740733_1.jpg', NULL),
(280, 200, '915833.jpg', NULL),
(282, 207, '3309132011-10-31 17.32.06.jpg', NULL),
(283, 207, '1837302011-10-28 14.22.27.jpg', NULL),
(284, 207, '727632011-11-01 10.21.55.jpg', NULL),
(285, 207, '1320406561_197575dil1.jpg', NULL),
(286, 207, '761902011-11-01 10.29.37.jpg', NULL),
(287, 207, '88769HPIM0044.JPG', NULL),
(289, 208, '4080773.jpg', NULL),
(290, 210, '9508DSC03122.JPG', NULL),
(291, 210, '22784DSC03120.JPG', NULL),
(292, 192, '157102DSC03122.JPG', NULL),
(293, 192, '475670DSC03119.JPG', NULL),
(351, 212, '285862horse_sub_box.jpg', NULL),
(350, 212, '104775horse2.jpg', NULL),
(296, 213, '371647horse5.jpg', NULL),
(297, 213, '324403horse5.jpg', NULL),
(298, 214, '1321000895_horse1.jpg', NULL),
(299, 214, '1321000895_horse1.jpg', NULL),
(304, 214, '', NULL),
(301, 214, '1321001535_horse2.jpg', NULL),
(305, 214, '', NULL),
(303, 214, '1321001535_horse2.jpg', NULL),
(306, 214, '', NULL),
(307, 214, '', NULL),
(308, 214, '', NULL),
(316, 193, '27181horse1.jpg', NULL),
(323, 198, '1319522963_5600_1221074845406_1184977551_30655814_8249356_n-1.jpg', NULL),
(313, 187, '1321004618_horse_sub_box.jpg', NULL),
(380, 241, '', NULL),
(381, 241, '338649horse4.jpg', NULL),
(379, 241, '414094horse2.jpg', NULL),
(318, 193, '138680horse2.jpg', NULL),
(388, 242, '195871black_hrs.jpg', 'N'),
(320, 215, '1321005970_horse4.jpg', NULL),
(321, 215, '1321006023_horse1.jpg', NULL),
(322, 215, '225784horse_sub_box.jpg', NULL),
(378, 241, '36548horse3.jpg', NULL),
(377, 241, '205550horse2.jpg', NULL),
(376, 241, '', NULL),
(375, 241, '', NULL),
(393, 243, '464770horse5.jpg', 'N'),
(392, 243, '10808horse4.jpg', 'N'),
(391, 243, '339810horse1.jpg', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_horseinfoaccept`
--

CREATE TABLE IF NOT EXISTS `tbl_horseinfoaccept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `horse_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `typeofuser` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tbl_horseinfoaccept`
--

INSERT INTO `tbl_horseinfoaccept` (`id`, `request_id`, `user_id`, `horse_id`, `date`, `typeofuser`) VALUES
(1, 81, 1, 95, '2011-09-28', 'owner'),
(2, 89, 91, 191, '2011-10-22', 'adder'),
(3, 93, 91, 190, '2011-10-22', 'owner'),
(4, 95, 91, 199, '2011-10-22', 'adder'),
(5, 95, 91, 199, '2011-10-22', 'adder'),
(6, 96, 96, 198, '2011-10-22', 'owner'),
(7, 96, 91, 198, '2011-10-22', 'adder'),
(8, 96, 110, 198, '2011-10-22', 'breeder'),
(9, 97, 96, 197, '2011-10-22', 'owner'),
(10, 97, 91, 197, '2011-10-22', 'adder'),
(11, 97, 110, 197, '2011-10-22', 'breeder'),
(12, 101, 110, 197, '2011-10-24', 'breeder'),
(13, 104, 110, 197, '2011-10-24', 'breeder'),
(14, 107, 96, 199, '2011-10-24', 'owner'),
(15, 104, 96, 197, '2011-10-24', 'owner'),
(16, 103, 96, 196, '2011-10-24', 'owner'),
(17, 129, 96, 195, '2011-10-25', 'owner'),
(18, 130, 96, 195, '2011-10-25', 'owner'),
(19, 144, 96, 187, '2011-11-05', 'owner'),
(20, 148, 91, 193, '2011-11-11', 'owner'),
(21, 150, 96, 212, '2011-12-01', 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_horserequestreject`
--

CREATE TABLE IF NOT EXISTS `tbl_horserequestreject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requestid` int(11) DEFAULT NULL,
  `horse_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reason` text,
  `typeofuser` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_horserequestreject`
--

INSERT INTO `tbl_horserequestreject` (`id`, `requestid`, `horse_id`, `user_id`, `reason`, `typeofuser`) VALUES
(1, 92, 197, 91, '', 'adder'),
(2, 95, 199, 96, 'That''s not the name sorry', 'owner'),
(3, 95, 199, 110, 'i don''t see any change', 'breeder'),
(4, 102, 198, 110, '', 'breeder'),
(5, 103, 196, 110, 'testing with this', 'breeder'),
(6, 114, 196, 96, 'sdfsdfsd', 'owner'),
(7, 149, 200, 96, 'Test\r\n', 'owner'),
(8, 161, 243, 91, 'Did not like', 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_horses`
--

CREATE TABLE IF NOT EXISTS `tbl_horses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `utube_link` varchar(255) DEFAULT NULL,
  `addedby` int(11) DEFAULT NULL,
  `ownerid` int(11) DEFAULT NULL,
  `ownername` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` float(6,2) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `breed_id` int(11) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `yearofdeath` varchar(255) DEFAULT NULL,
  `deathstat` enum('Y','N') DEFAULT 'N',
  `sire_id` int(11) DEFAULT NULL,
  `sire` varchar(255) DEFAULT NULL,
  `Offspring` varchar(255) DEFAULT NULL,
  `dam_id` int(11) DEFAULT NULL,
  `dam` varchar(255) DEFAULT NULL,
  `height_id` int(11) DEFAULT NULL,
  `stable_id` int(11) DEFAULT NULL,
  `stablename` varchar(255) DEFAULT NULL,
  `bred_id` int(11) DEFAULT NULL,
  `bred_name` varchar(255) DEFAULT NULL,
  `coatcolor_id` int(11) DEFAULT NULL,
  `bloodline` varchar(255) DEFAULT NULL,
  `breeder_id` int(11) DEFAULT NULL,
  `breeder` varchar(255) DEFAULT NULL,
  `prize_won` text,
  `town_id` int(255) DEFAULT NULL,
  `countryid` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `other_details` text,
  `posted_date` date DEFAULT NULL,
  `edited_date` date DEFAULT NULL,
  `approve_stat` enum('Y','N') DEFAULT 'N',
  `sales_status` enum('S','Stud','Notsale') DEFAULT NULL,
  `putforsale` enum('Y','N') DEFAULT 'N',
  `nameunknownoption` varchar(255) DEFAULT NULL,
  `sireunknowoption` varchar(255) DEFAULT NULL,
  `damunknownoption` varchar(255) DEFAULT NULL,
  `registered` varchar(255) DEFAULT NULL,
  `registration_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=247 ;

--
-- Dumping data for table `tbl_horses`
--

INSERT INTO `tbl_horses` (`id`, `image`, `video`, `utube_link`, `addedby`, `ownerid`, `ownername`, `name`, `price`, `gender`, `breed_id`, `year`, `yearofdeath`, `deathstat`, `sire_id`, `sire`, `Offspring`, `dam_id`, `dam`, `height_id`, `stable_id`, `stablename`, `bred_id`, `bred_name`, `coatcolor_id`, `bloodline`, `breeder_id`, `breeder`, `prize_won`, `town_id`, `countryid`, `state_id`, `other_details`, `posted_date`, `edited_date`, `approve_stat`, `sales_status`, `putforsale`, `nameunknownoption`, `sireunknowoption`, `damunknownoption`, `registered`, `registration_code`) VALUES
(241, '343153horse1.jpg', '', '', 91, 91, 'Beau Bikker', 'My test', NULL, '3', 15, '2005', '', 'N', NULL, 'G-horse', NULL, NULL, 'A-horse', 9, NULL, '', NULL, '', 17, '', 130, 'Soumavo Chatterjee', '', 70, 1, 5, 'Test', '2011-12-09', '2011-12-09', 'Y', '', 'N', 'N', 'N', 'N', 'N', ''),
(242, '1323418511_horse2.jpg', '', '', 91, 91, 'Beau Bikker', 'thisisaridiculouslylongnamemadefortesting', NULL, '2', 14, '2001', '', 'N', NULL, '', NULL, NULL, '', 7, NULL, '', NULL, '', 8, '', NULL, 'Breeder -', '', 44, 1, 2, 'test', '2011-12-09', '2011-12-12', 'Y', 'S', 'N', 'N', 'N', 'N', 'N', ''),
(1, '', '', '', 91, 96, 'owner - ', 'A-Horse', NULL, '4', 1, '', '', 'N', 3, 'D-Horse', NULL, 188, 'B-Horse', 12, NULL, '', NULL, '', 9, '', 110, 'Breeder -', 'change', 66, 1, 21, 'Offspring:\r\nF\r\nG\r\nC\r\nJ\r\nL\r\nM\r\n\r\nchange', '2011-10-19', '2011-11-30', 'Y', NULL, 'N', 'N', 'N', 'N', 'N', ''),
(2, '', '', '', 91, 96, 'owner -', 'B-Horse', NULL, '3', 1, '', '', 'N', NULL, '', NULL, NULL, '', 1, NULL, '', NULL, '', 1, '', 91, 'Beau Bikker', '', 1, 1, 1, 'Offspring:\r\nC\r\nH\r\nE', '2011-10-19', '2011-12-11', 'Y', NULL, 'N', 'N', 'Y', 'Y', 'N', ''),
(3, '', '', '', 91, 96, 'owner -', 'C-Horse', NULL, '2', 3, '2001', '2010', 'Y', 189, 'D-Horse', NULL, 191, 'G-Horse', 17, NULL, '', NULL, '', 3, 'test', 110, 'Breeder - ', 'alls', 46, 1, 26, 'Offspring:\r\nH\r\nI\r\n\r\nSiblings:\r\nF\r\nL\r\nM\r\nG\r\nJ\r\nE\r\nH', '2011-10-19', '2011-11-11', 'Y', NULL, 'N', 'N', 'N', 'N', 'Y', 'test'),
(246, '', '', '', 91, 91, 'Beau Bikker', 'test', NULL, '3', 3, '', '', 'N', NULL, NULL, NULL, NULL, NULL, 2, NULL, '', NULL, '', 2, '', NULL, '', 'test', 75, 1, 4, 'test', '2011-12-27', NULL, 'Y', NULL, 'N', NULL, 'Y', 'Y', 'N', NULL),
(245, '', '', '', 91, NULL, '', 'pratham', NULL, '2', 1, '2005', '', 'N', 3, 'C-Horse', NULL, NULL, NULL, 1, 7, 'awesome stable', NULL, '', 1, '', NULL, '', '6y', 46, 1, 26, '44y', '2011-12-23', NULL, 'Y', NULL, 'N', NULL, NULL, 'Y', 'Y', NULL),
(244, '', '', '', 91, 91, 'Beau Bikker', 'new form test', NULL, '3', 1, '1991', '2011', 'Y', NULL, '', NULL, 2, 'B-Horse', 2, NULL, '', NULL, '', 2, '', NULL, '', 'test', 46, 1, 26, 'test', '2011-12-13', '2011-12-13', 'Y', NULL, 'N', 'N', 'Y', 'N', 'N', ''),
(243, '1323425990_horse3.jpg', '', '', 91, NULL, 'owner -', '4596', NULL, '2', 15, '2001', '', 'N', NULL, '', NULL, NULL, '', 9, NULL, '', NULL, '', 17, '', NULL, 'Breeder -', '', 42, 1, 4, 'test', '2011-12-09', '2011-12-09', 'Y', NULL, 'N', 'N', 'N', 'N', 'N', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_horsesales`
--

CREATE TABLE IF NOT EXISTS `tbl_horsesales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `horse_id` int(11) DEFAULT NULL,
  `pricerange_fromid` int(11) DEFAULT NULL,
  `pricerange_toid` int(11) NOT NULL,
  `posted_date` date DEFAULT NULL,
  `sales_status` enum('Y','N') DEFAULT 'N',
  `contactdetails` text,
  `salesdescription` text,
  `pricerangeto` varchar(255) NOT NULL,
  `salesfor` enum('Stud','Sale') DEFAULT NULL,
  PRIMARY KEY (`id`,`pricerangeto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_horsesales`
--

INSERT INTO `tbl_horsesales` (`id`, `user_id`, `horse_id`, `pricerange_fromid`, `pricerange_toid`, `posted_date`, `sales_status`, `contactdetails`, `salesdescription`, `pricerangeto`, `salesfor`) VALUES
(1, 1, 62, 123, 121, '2011-06-15', 'Y', 'E-mail: beaubikker@gmail.com\r\n', 'For sale, together with my other horse: Koda', '', 'Sale'),
(2, 1, 63, 123, 121, '2011-06-15', 'Y', 'e-mail: beaubikker@gmail.com', 'For sale together with my other horse: Majura', '', 'Sale'),
(11, 97, 167, 22, 68, '2011-10-15', 'Y', 'soumavo chatterjee his own firm', 'This is the best horse for racing', '', 'Sale'),
(12, 96, 196, 22, 40, '2011-10-24', 'Y', 'asfas', 'asgfdsaf', '', 'Sale'),
(13, 96, 199, 39, 118, '2011-10-25', 'Y', 'My stable', 'My stable', '', 'Sale');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_horsesubscriptions`
--

CREATE TABLE IF NOT EXISTS `tbl_horsesubscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `horse_id` int(11) DEFAULT NULL,
  `yesstatus` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=208 ;

--
-- Dumping data for table `tbl_horsesubscriptions`
--

INSERT INTO `tbl_horsesubscriptions` (`id`, `user_id`, `horse_id`, `yesstatus`) VALUES
(43, 1, 143, 'Y'),
(181, 90, 158, 'Y'),
(26, 1, 134, 'Y'),
(9, 17, 62, 'Y'),
(10, 3, 77, 'Y'),
(54, 1, 111, 'Y'),
(13, 17, 63, 'Y'),
(14, 31, 62, 'Y'),
(15, 31, 63, 'Y'),
(16, 31, 112, 'Y'),
(17, 31, 111, 'Y'),
(67, 1, 148, 'Y'),
(178, 1, 98, 'Y'),
(50, 1, 146, 'Y'),
(149, 3, 88, 'Y'),
(130, 1, 147, 'Y'),
(180, 1, 102, 'N'),
(118, 1, 150, 'Y'),
(182, 96, 166, 'Y'),
(183, 97, 168, 'Y'),
(160, 3, 63, 'Y'),
(162, 3, 62, 'Y'),
(194, 97, 189, 'Y'),
(187, 96, 198, 'Y'),
(192, 97, 197, 'Y'),
(191, 97, 203, 'Y'),
(193, 97, 208, 'Y'),
(195, 97, 207, 'Y'),
(203, 130, 209, 'Y'),
(206, 91, 214, 'Y'),
(207, 91, 187, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_listingfrees`
--

CREATE TABLE IF NOT EXISTS `tbl_listingfrees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contentname` varchar(255) DEFAULT NULL,
  `content` text,
  `posted_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_listingpaids`
--

CREATE TABLE IF NOT EXISTS `tbl_listingpaids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contentname` varchar(255) DEFAULT NULL,
  `content` text,
  `posted_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_memberships`
--

CREATE TABLE IF NOT EXISTS `tbl_memberships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advantagename` varchar(765) COLLATE utf8_unicode_ci DEFAULT NULL,
  `advantagedescription` blob,
  `posteddate` date DEFAULT NULL,
  `status` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_memberships`
--

INSERT INTO `tbl_memberships` (`id`, `advantagename`, `advantagedescription`, `posteddate`, `status`) VALUES
(1, 'Create breeding stable', 0x437265617465206272656564696e6720737461626c65, '2011-01-04', 'N'),
(2, 'Add unlimited horses', 0x41646420756e6c696d6974656420686f72736573, '2011-01-04', 'Y'),
(3, 'Detailed pedigree', 0x44657461696c6564207065646967726565, '2011-01-04', 'Y'),
(4, 'Advertise your horses for sale', 0x41647665727469736520796f757220686f7273657320666f722073616c65, '2011-01-04', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE IF NOT EXISTS `tbl_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `notification_title` varchar(255) DEFAULT NULL,
  `notificationdetails` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`id`, `user_id`, `posted_date`, `notification_title`, `notificationdetails`) VALUES
(20, 97, '2011-10-24', 'test', '<p>tests</p>'),
(21, 75, '2011-10-24', 'test', '<p>tests</p>'),
(11, 68, '2011-10-24', 'test', '<p>tests</p>'),
(12, 51, '2011-10-24', 'test', '<p>tests</p>'),
(15, 111, '2011-10-24', 'test', '<p>tests</p>'),
(16, 103, '2011-10-24', 'test', '<p>tests</p>'),
(18, 95, '2011-10-24', 'test', '<p>tests</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_priceranges`
--

CREATE TABLE IF NOT EXISTS `tbl_priceranges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pricefrom` varchar(255) DEFAULT NULL,
  `pricetoo` varchar(255) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `tbl_priceranges`
--

INSERT INTO `tbl_priceranges` (`id`, `pricefrom`, `pricetoo`, `posted_date`, `status`) VALUES
(21, 'RS 1.000', '10.000', '2011-07-09', 'Y'),
(22, 'RS 10.000', '20.000', '2011-07-09', 'Y'),
(23, 'RS 20.000', '30.000', '2011-07-09', 'Y'),
(24, 'RS 30.000', '40.000', '2011-07-09', 'Y'),
(25, 'RS 40.000', '50.000', '2011-07-09', 'Y'),
(26, 'RS 50.000', '60.000', '2011-07-09', 'Y'),
(27, 'RS 60.000', '70.000', '2011-07-09', 'Y'),
(28, 'RS 70.000', '80.000', '2011-07-09', 'Y'),
(29, 'RS 80.000', '90.000', '2011-07-09', 'Y'),
(30, 'RS 90.000', '100.000 (1 lakh)', '2011-07-09', 'Y'),
(31, 'RS 100.000 (1 lakh)', '110.000', '2011-07-09', 'Y'),
(32, 'RS 110.000', '120.000', '2011-07-09', 'Y'),
(33, 'RS 120.000', '130.000', '2011-07-09', 'Y'),
(34, 'RS 130.000', '140.000', '2011-07-09', 'Y'),
(35, 'RS 140.000', '150.000', '2011-07-09', 'Y'),
(36, 'RS 150.000', '160.000', '2011-07-09', 'Y'),
(37, 'RS 160.000', '170.000', '2011-07-09', 'Y'),
(39, 'RS 170.000', '180.000', '2011-07-09', 'Y'),
(40, 'RS 180.000', '190.000', NULL, 'Y'),
(41, 'RS 190.000', '200.000 (2 lakh)', NULL, 'Y'),
(42, 'RS 200.000 (2 lakh)', '210.000', NULL, 'Y'),
(43, 'RS 210.000', '220.000', NULL, 'Y'),
(44, 'RS 220.000', '230.000', NULL, 'Y'),
(45, 'RS 230.000', '240.000', NULL, 'Y'),
(46, 'RS 240.000', '250.000', NULL, 'Y'),
(47, 'RS 250.000', '260.000', NULL, 'Y'),
(48, 'RS 260.000', '270.000', NULL, 'Y'),
(49, 'RS 270.000', '280.000', NULL, 'Y'),
(50, 'RS 290.000', '300.000 (3 lakh)', NULL, 'Y'),
(51, 'RS 300.000 (3 lakh)', '310.000', NULL, 'Y'),
(52, 'RS 310.000', '320.000', NULL, 'Y'),
(53, 'RS 320.000', '330.000', NULL, 'Y'),
(54, 'RS 330.000', '340.000', NULL, 'Y'),
(55, 'RS 340.000', '350.000', NULL, 'Y'),
(56, 'RS 350.000', '360.000', NULL, 'Y'),
(57, 'RS 370.000', '380.000', NULL, 'Y'),
(58, 'RS 380.000', '390.000', NULL, 'Y'),
(59, 'RS 390.000', '400.000 (4 lakh)', NULL, 'Y'),
(60, 'RS 400.000 (4 lakh)', '410.000', NULL, 'Y'),
(61, 'RS 410.000', '420.000', NULL, 'Y'),
(62, 'RS 420.000', '430.000', NULL, 'Y'),
(63, 'RS 430.000', '440.000', NULL, 'Y'),
(64, 'RS 440.000', '450.000', NULL, 'Y'),
(65, 'RS 450.000', '460.000', NULL, 'Y'),
(66, 'RS 460.000', '470.000', NULL, 'Y'),
(67, 'RS 470.000', '480.000', NULL, 'Y'),
(68, 'RS 480.000', '490.000', NULL, 'Y'),
(69, 'RS 490.000', '500.000 (5 lakh)', NULL, 'Y'),
(70, 'RS 500.000 (5 lakh)', '510.000', NULL, 'Y'),
(71, 'RS 510.000', '520.000', NULL, 'Y'),
(72, 'RS 520.000', '530.000', NULL, 'Y'),
(73, 'RS 530.000', '540.000', NULL, 'Y'),
(74, 'RS 540.000', '550.000', NULL, 'Y'),
(75, 'RS 550.000', '560.000', NULL, 'Y'),
(76, 'RS 560.000', '570.000', NULL, 'Y'),
(77, 'RS 570.000', '580.000', NULL, 'Y'),
(78, 'RS 580.000', '590.000', NULL, 'Y'),
(79, 'RS 590.000', '600.000 (6 lakh)', NULL, 'Y'),
(80, 'RS 600.000 (6 lakh)', '610.000', NULL, 'Y'),
(81, 'RS 610.000', '620.000', NULL, 'Y'),
(82, 'RS 620.000', '630.000', NULL, 'Y'),
(83, 'RS 630.000', '640.000', NULL, 'Y'),
(84, 'RS 640.000', '650.000', NULL, 'Y'),
(85, 'RS 650.000', '660.000', NULL, 'Y'),
(86, 'RS 660.000', '670.000', NULL, 'Y'),
(87, 'RS 670.000', '680.000', NULL, 'Y'),
(88, 'RS 690.000', '700.000 (7 lakh)', NULL, 'Y'),
(89, 'RS 700.000 (7 lakh)', '710.000', NULL, 'Y'),
(90, 'RS 710.000', '720.000', NULL, 'Y'),
(91, 'RS 720.000', '730.000', NULL, 'Y'),
(92, 'RS 730.000', '740.000', NULL, 'Y'),
(93, 'RS 740.000', '750.000', NULL, 'Y'),
(94, 'RS 750.000', '760.000', NULL, 'Y'),
(95, 'RS 760.000', '770.000', NULL, 'Y'),
(96, 'RS 770.000', '780.000', NULL, 'Y'),
(97, 'RS 780.000', '790.000', NULL, 'Y'),
(98, 'RS 790.000', '800.000 (8 lakh)', NULL, 'Y'),
(99, 'RS 800.000 (8 lakh)', '810.000', NULL, 'Y'),
(100, 'RS 810.000', '820.000', NULL, 'Y'),
(101, 'RS 820.000', '830.000', NULL, 'Y'),
(102, 'RS 830.000', '840.000', NULL, 'Y'),
(103, 'RS 840.000', '850.000', NULL, 'Y'),
(104, 'RS 850.000', '860.000', NULL, 'Y'),
(105, 'RS 860.000', '870.000', NULL, 'Y'),
(106, 'RS 870.000', '880.000', NULL, 'Y'),
(107, 'RS 880.000', '890.000', NULL, 'Y'),
(108, 'RS 890.000', '900.000 (9 lakh)', NULL, 'Y'),
(109, 'RS 900.000 (9 lakh)', '910.000', NULL, 'Y'),
(110, 'RS 910.000', '920.000', NULL, 'Y'),
(111, 'RS 920.000', '930.000', NULL, 'Y'),
(112, 'RS 930.000', '940.000', NULL, 'Y'),
(113, 'RS 940.000', '950.000', NULL, 'Y'),
(114, 'RS 950.000', '960.000', NULL, 'Y'),
(115, 'RS 960.000', '970.000', NULL, 'Y'),
(116, 'RS 970.000', '980.000', NULL, 'Y'),
(117, 'RS 980.000', '990.000', NULL, 'Y'),
(118, 'RS 990.000', '1.000.000 (10 lakh)', NULL, 'Y'),
(119, ' ', ' ', NULL, 'Y'),
(120, 'Free', 'Free', NULL, 'Y'),
(121, 'To be discussed', 'To be discussed', NULL, 'Y'),
(122, 'See description', 'See description', NULL, 'Y'),
(123, 'Not applicable ', 'Not applicable ', NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rems`
--

CREATE TABLE IF NOT EXISTS `tbl_rems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `tbl_rems`
--

INSERT INTO `tbl_rems` (`id`, `ip`, `username`, `password`) VALUES
(1, '202.142.113.21', 'beaubikker@gmail.com', 'letmein'),
(2, '81.231.174.171', 'beaubikker@gmail.com', 'letmein'),
(26, '202.142.113.160', 'beaubikker@gmail.com', 'letmein'),
(25, '92.159.149.102', 'beaubikker@gmail.com', 'letmein'),
(8, '202.142.113.221', 'soumavo123@gmail.com', 'soumavo'),
(19, '59.97.176.248', 'beaubikker@gmail.com', 'letmein'),
(20, '202.142.112.34', 'soumavo123@gmail.com', 'soumavo'),
(23, '202.142.113.127', 'beaubikker@gmail.com', 'letmein'),
(28, '92.159.232.68', 'beaubikker@gmail.com', 'letmein'),
(30, '202.142.121.11', 'beaubikker@gmail.com', 'letmein'),
(31, '90.84.146.153', 'beaubikker@gmail.com', 'letmein'),
(34, '86.163.156.221', 'isastewart@gmail.com', 'letmein'),
(35, '83.58.38.95', 'isairis99@gmail.com', 'letmein'),
(36, '81.32.132.112', 'beaubikker@gmail.com', 'letmein'),
(37, '81.47.138.208', 'isa.stewart@gmail.com', 'letmein'),
(39, '88.15.2.64', 'beaubikker@gmail.com', 'letmein'),
(40, '79.151.249.24', 'beaubikker@gmail.com', 'letmein'),
(42, '79.144.227.27', 'beau@majixmarwari.com', 'letmein'),
(43, '81.32.135.53', 'admin@indianhorsedatabase.com', 'letmein'),
(44, '82.145.211.8', 'admin@indianhorsedatabase.com', 'letmein'),
(45, '79.152.172.6', 'beaubikker@gmail.com', 'letmein'),
(46, '83.58.36.207', 'majixgirl@gmail.com', 'letmein'),
(48, '79.154.20.70', 'admin@indianhorsedatabase.com', 'letmein'),
(49, '87.111.40.7', 'beaubikker@gmail.com', 'letmein'),
(50, '117.241.208.236', 'beaubikker@gmail.com', 'letmein'),
(51, '117.241.208.231', 'majixgirl@gmail.com', 'letmein'),
(54, '117.241.210.34', 'beaubikker@facebook.com', 'letmein'),
(53, '117.241.208.212', 'beaubikker@gmail.com', 'letmein'),
(55, '117.241.208.235', 'majixgirl@gmail.com', 'letmein'),
(56, '117.241.208.145', 'Beaubikker@facebook.com', 'letmein'),
(57, '49.203.50.158', 'Postvoorbeau@yahoo.com', 'letmein'),
(58, '27.107.44.139', 'beaubikker@gmail.com', 'letmein'),
(59, '49.200.166.71', 'beaubikker@gmail.com', 'letmein'),
(60, '117.241.208.70', 'admin@indianhorsedatabase.com', 'letmein'),
(62, '117.241.209.148', 'isa.stewart@gmail.com', 'letmein'),
(63, '117.241.208.226', 'beaubikker@gmail.com', 'letmein'),
(64, '117.241.209.163', 'isa.stewart@gmail.com', 'letmein'),
(65, '117.241.209.136', 'isa.stewart@gmail.com', 'letmein'),
(66, '117.199.113.121', 'beaubikker@gmail.com', 'letmein'),
(67, '117.199.112.212', 'beaubikker@gmail.com', 'letmein');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_remove_horse`
--

CREATE TABLE IF NOT EXISTS `tbl_sale_remove_horse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `horse_id` int(11) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `reason_remove_sale` varchar(255) DEFAULT NULL,
  `reason` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_sale_remove_horse`
--

INSERT INTO `tbl_sale_remove_horse` (`id`, `user_id`, `horse_id`, `sales_id`, `reason_remove_sale`, `reason`) VALUES
(1, 1, 111, 3, 'otherreason', 'nothing'),
(2, 1, 126, 9, 'otherreason', 'this was a test horse'),
(3, 1, 111, 6, 'otherreason', 'test horse'),
(4, 1, 147, 8, 'otherreason', 'test horse'),
(5, 91, 193, 14, 'otherreason', 'sold'),
(6, 91, 242, 15, 'Sold', ''),
(7, 91, 242, 16, 'Sold', ''),
(8, 91, 242, 17, 'otherreason', 'mind set off');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) DEFAULT NULL,
  `headerimage` varchar(255) DEFAULT NULL,
  `paypal_account_id` varchar(255) DEFAULT NULL,
  `payment_mode` enum('0','1') DEFAULT '0',
  `6_months_proce` float(8,2) DEFAULT NULL,
  `1_year_price` float(8,2) DEFAULT NULL,
  `1_half_year_price` float(8,2) DEFAULT NULL,
  `2_year_price` float(8,2) DEFAULT NULL,
  `6_month_price_rs` varchar(255) DEFAULT NULL,
  `1_year_price_rs` varchar(255) DEFAULT NULL,
  `1and_half_year_price_rs` varchar(255) DEFAULT NULL,
  `2_year_price_price_rs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `logo`, `headerimage`, `paypal_account_id`, `payment_mode`, `6_months_proce`, `1_year_price`, `1_half_year_price`, `2_year_price`, `6_month_price_rs`, `1_year_price_rs`, `1and_half_year_price_rs`, `2_year_price_price_rs`) VALUES
(1, '1307821381_IHD-Logo(final)beta.png', '1308595783_horse1underconstruction.png', 'admin@indianhorsedatabase.com', '1', 0.01, 5.00, 0.01, 0.01, 'rs 225 per month', 'Offer! rs 180 per month!', 'rs 210 per month', 'rs 200 per month');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_showaddiotionalimage`
--

CREATE TABLE IF NOT EXISTS `tbl_showaddiotionalimage` (
  `id` int(11) NOT NULL,
  `horse_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_showaddiotionalimage`
--

INSERT INTO `tbl_showaddiotionalimage` (`id`, `horse_id`, `image`) VALUES
(0, 241, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stableimages`
--

CREATE TABLE IF NOT EXISTS `tbl_stableimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stable_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_stableimages`
--

INSERT INTO `tbl_stableimages` (`id`, `stable_id`, `image`) VALUES
(4, 6, '4176531291892735_horse5.jpg'),
(5, 6, '2033661291181272_horse3.jpg'),
(6, 6, '1693071291181272_horse3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stables`
--

CREATE TABLE IF NOT EXISTS `tbl_stables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `stable_name` varchar(255) DEFAULT NULL,
  `stabledesc` text,
  `stable_image` varchar(255) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `edited_date` date DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  `website` varchar(255) DEFAULT NULL,
  `about` text,
  `services` text,
  `town_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_stables`
--

INSERT INTO `tbl_stables` (`id`, `userid`, `stable_name`, `stabledesc`, `stable_image`, `posted_date`, `edited_date`, `status`, `website`, `about`, `services`, `town_id`, `state_id`, `country_id`) VALUES
(7, 90, 'awesome stable', NULL, '', '2011-12-13', NULL, 'Y', '', 'test', 'TEST', 46, 26, 1),
(6, 96, 'Feature stable', NULL, '1318669618_1292416700_horse3.jpg', '2011-10-21', '2011-10-15', 'Y', '', 'This is another feature horse stable.', 'This is another feature horse stable.', 31, 24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stablesubscriptions`
--

CREATE TABLE IF NOT EXISTS `tbl_stablesubscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `stable_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_stablesubscriptions`
--

INSERT INTO `tbl_stablesubscriptions` (`id`, `user_id`, `stable_id`) VALUES
(3, 31, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_states`
--

CREATE TABLE IF NOT EXISTS `tbl_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `statename` varchar(255) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tbl_states`
--

INSERT INTO `tbl_states` (`id`, `country_id`, `statename`, `posted_date`, `status`) VALUES
(1, 1, ' unknown', '0000-00-00', 'Y'),
(2, 1, 'Andhra Pradesh', '0000-00-00', 'Y'),
(3, 1, 'Arunachal Pradesh', '0000-00-00', 'Y'),
(4, 1, 'Assam', '0000-00-00', 'Y'),
(5, 1, 'Bihar', '0000-00-00', 'Y'),
(6, 1, 'Chhattisgarh', '0000-00-00', 'Y'),
(7, 1, 'Goa', '0000-00-00', 'Y'),
(8, 1, 'Gujarat', '0000-00-00', 'Y'),
(9, 1, 'Haryana', '0000-00-00', 'Y'),
(10, 1, 'Himachal Pradesh', '0000-00-00', 'Y'),
(11, 1, 'Jammu and Kashmir', '0000-00-00', 'Y'),
(12, 1, 'Jharkhand', '0000-00-00', 'Y'),
(13, 1, 'Karnataka', '0000-00-00', 'Y'),
(14, 1, 'Kerala', '0000-00-00', 'Y'),
(15, 1, 'Madhya Pradesh', '0000-00-00', 'Y'),
(16, 1, 'Maharashtra', '0000-00-00', 'Y'),
(17, 1, 'Manipur', '0000-00-00', 'Y'),
(18, 1, 'Meghalaya', '0000-00-00', 'Y'),
(19, 1, 'Mizoram', '0000-00-00', 'Y'),
(20, 1, 'Nagaland', '0000-00-00', 'Y'),
(21, 1, 'Orissa', '0000-00-00', 'Y'),
(22, 1, 'Ponicherry', '0000-00-00', 'Y'),
(23, 1, 'Punjab', '0000-00-00', 'Y'),
(24, 1, 'Rajasthan', '0000-00-00', 'Y'),
(25, 1, 'Sikkim', '0000-00-00', 'Y'),
(26, 1, 'Tamil Nadu', '0000-00-00', 'Y'),
(27, 1, 'Tripura', '0000-00-00', 'Y'),
(28, 1, 'Uttar Pradesh', '0000-00-00', 'Y'),
(29, 1, 'Uttarakhand', '0000-00-00', 'Y'),
(30, 1, 'West Bengal', '0000-00-00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_towns`
--

CREATE TABLE IF NOT EXISTS `tbl_towns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `town` varchar(255) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  `state_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `tbl_towns`
--

INSERT INTO `tbl_towns` (`id`, `town`, `posted_date`, `status`, `state_id`) VALUES
(34, 'Imphal', '2011-10-28', 'Y', 17),
(33, 'Chan', '2011-10-28', 'Y', 9),
(32, 'Tordera', '2011-06-15', 'Y', 25),
(31, 'Jodhpur', '2011-06-15', 'Y', 24),
(30, 'Skogsberg', '2011-06-13', 'Y', 23),
(1, 'unknown', '2011-06-10', 'Y', 1),
(26, 'Palanpur', '2011-06-10', 'Y', 21),
(25, 'Ahemdabad', '2011-06-10', 'Y', 21),
(24, 'Marthas Vineyard', '2011-06-10', 'Y', 20),
(23, 'Chantilly', '2011-06-10', 'Y', 19),
(29, 'Tiruvannamalai', '2011-06-10', 'Y', 22),
(35, 'Bhopal', '2011-10-28', 'Y', 15),
(36, 'Imphal', '2011-10-28', 'Y', 18),
(37, 'Hello', '2011-10-28', 'Y', 5),
(38, 'Patna', '2011-10-28', 'Y', 5),
(39, 'Mumbai', '2011-10-28', 'Y', 16),
(40, 'Baroda', '2011-10-28', 'Y', 8),
(41, 'Chandigarh', '2011-10-28', 'Y', 23),
(42, 'Gauhati', '2011-10-28', 'Y', 4),
(43, 'Dibrugarh', '2011-10-28', 'Y', 4),
(44, 'Hyderabad', '2011-10-28', 'Y', 2),
(45, 'Ahmedadbad', '2011-10-28', 'Y', 8),
(46, 'Tiruvannamalai', '2011-10-28', 'Y', 26),
(47, 'Kolkata', '2011-10-28', 'Y', 30),
(48, 'kharagpur', '2011-10-28', 'Y', 30),
(49, 'Trivandrum', '2011-10-28', 'Y', 14),
(50, 'Town', '2011-11-04', 'Y', 28),
(51, 'Srinagar', '2011-11-04', 'Y', 11),
(52, 'Bangalore', '2011-11-05', 'Y', 13),
(53, 'Gandhinagar', '2011-11-05', 'Y', 8),
(54, 'Vishakapatnaam', '2011-11-05', 'Y', 2),
(55, 'Tatanagar', '2011-11-06', 'Y', 12),
(56, 'test', '2011-11-11', 'Y', 3),
(57, 'Haldia', '2011-11-11', 'Y', 30),
(58, 'Purulia', '2011-11-11', 'Y', 30),
(59, 'Bankura', '2011-11-11', 'Y', 30),
(60, 'Gantok', '2011-11-11', 'Y', 25),
(61, 'Jammu', '2011-11-11', 'Y', 11),
(62, 'Vilai', '2011-11-11', 'Y', 6),
(63, 'Bikaner', '2011-11-11', 'Y', 24),
(64, 'Cuttack', '2011-11-11', 'Y', 21),
(65, 'Bhubaneshwar', '2011-11-11', 'Y', 21),
(66, 'Balasore', '2011-11-11', 'Y', 21),
(67, 'Lucknow', '2011-11-30', 'Y', 28),
(68, 'Agartala', '2011-11-30', 'Y', 27),
(69, 'Mugalsarai', '2011-11-30', 'Y', 28),
(70, 'Bhagalpur', '2011-12-09', 'Y', 5),
(71, 'Panaji', '2011-12-09', 'Y', 7),
(72, 'new town', '2011-12-13', 'Y', 5),
(73, 'new town', '2011-12-13', 'Y', 6),
(74, 'yay', '2011-12-27', 'Y', 6),
(75, 'hometown', '2011-12-27', 'Y', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_updatemembership`
--

CREATE TABLE IF NOT EXISTS `tbl_updatemembership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usertype` varchar(255) CHARACTER SET latin1 DEFAULT 'F',
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cropeed_image` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `registered_date` date DEFAULT NULL,
  `login_stat` enum('Y','N') DEFAULT 'N',
  `expiration_time_periode` varchar(255) DEFAULT NULL,
  `membership_exipre_date` date DEFAULT NULL,
  `payment_option` varchar(255) DEFAULT NULL,
  `payment_status` enum('Y','N') DEFAULT 'N',
  `login_counter` int(11) DEFAULT '0',
  `website` varchar(255) DEFAULT NULL,
  `about_me` text,
  `facebook_url` varchar(255) DEFAULT NULL,
  `town_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `countryid` int(11) DEFAULT NULL,
  `logoutdate` date DEFAULT NULL,
  `edited_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=141 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `usertype`, `firstname`, `lastname`, `email_address`, `image`, `cropeed_image`, `password`, `registered_date`, `login_stat`, `expiration_time_periode`, `membership_exipre_date`, `payment_option`, `payment_status`, `login_counter`, `website`, `about_me`, `facebook_url`, `town_id`, `state_id`, `countryid`, `logoutdate`, `edited_date`) VALUES
(135, 'P', 'Beau', 'Bikker', 'Beaubikker@facebook.com', NULL, NULL, 'bGV0bWVpbg==', '2011-11-12', 'Y', '2 Years', '2013-11-12', NULL, 'Y', 4, NULL, NULL, NULL, NULL, NULL, NULL, '2011-11-12', NULL),
(68, 'F', 'sahil', 'kapahi', 'sahilkapahi@yahoo.co.in', NULL, NULL, 'ZGVuaXNtcDA0bmE5MjMz', '2011-07-01', 'Y', NULL, NULL, NULL, 'N', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'F', 'suman', 'dutta', 'suman121069@gmail.com', '1309350718_suman12.png', NULL, 'ZGlnaXRhbA==', '2011-06-29', 'Y', NULL, NULL, NULL, 'N', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2011-06-29', NULL),
(137, 'P', 'Lisa', 'Mare', 'Postvoorbeau@yahoo.com', NULL, NULL, 'bGV0bWVpbg==', '2011-11-14', 'Y', '2 Years', '2014-05-14', 'Paypal', 'Y', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2011-11-14', NULL),
(90, 'P', 'Isa', 'Stewart', 'isa.stewart@gmail.com', '1317323665_profile square.jpg', NULL, 'bGV0bWVpbg==', '2011-09-29', 'Y', '6 months', '2012-03-29', '', 'Y', 59, '', '', 'www.facebook.com/isa.stewart/', 46, 26, 1, '2011-12-14', '2011-11-29'),
(128, 'F', 'soumavo', 'chatterjee', 'soumavo.chattaraj@massoftind.com', '1321005806_black_hrs.jpg', NULL, 'MTIzNDU2', '2011-11-04', 'Y', '6 months', '2012-05-04', NULL, 'Y', 10, '', '', '', NULL, NULL, NULL, '2011-11-11', '2011-11-11'),
(110, 'P', 'Breeder', '-', 'admin@indianhorsedatabase.com', NULL, NULL, 'bGV0bWVpbg==', '2011-10-21', 'Y', '6 months', '2012-05-11', NULL, 'Y', 74, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-11', NULL),
(111, 'F', 'venky', 'goteti', 'vgoteti@gmail.com', NULL, NULL, 'dGVzdGVyMQ==', '2011-10-21', 'Y', NULL, NULL, NULL, 'N', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 'F', 'Changer', '-', 'beau@majixmarwari.com', '', NULL, 'bGV0bWVpbg==', '2011-10-21', 'Y', NULL, NULL, NULL, 'N', 44, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-11', NULL),
(130, 'P', 'Soumavo', 'Chatterjee', 'soumavo123@gmail.com', '1323413678_horse5.jpg', NULL, 'MTIzNDU2', '2011-11-11', 'Y', '1 Year', '2012-11-11', NULL, 'Y', 14, '', '', '', 70, 5, 1, '2011-12-09', '2011-12-09'),
(91, 'P', 'Beau', 'Bikker', 'beaubikker@gmail.com', '1321000713_owner2.jpg', NULL, 'bGV0bWVpbg==', '2011-09-29', 'Y', '6 months', '2012-05-04', '', 'Y', 257, '', '', '', 44, 2, 1, '2011-12-27', '2011-11-11'),
(139, 'F', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-13', NULL),
(140, 'F', 'Kiran', 'Kandhimalla', 'kandhimalla@yahoo.com', NULL, NULL, 'YzAwbGNhdA==', '2011-12-20', 'Y', NULL, NULL, NULL, 'N', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-20', NULL),
(96, 'P', 'owner', '-', 'majixgirl@gmail.com', NULL, NULL, 'bGV0bWVpbg==', '2011-10-12', 'Y', '6 months', '2012-04-12', 'Paypal', 'Y', 82, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-11', '2011-10-21'),
(75, 'F', 'Rakesh', 'Picholiya', 'rakeshpicholiya@gmail.com', '1312627713_03.jpg', NULL, 'ZGluZXNo', '2011-08-06', 'Y', NULL, NULL, NULL, 'N', 3, NULL, NULL, NULL, NULL, NULL, NULL, '2011-09-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usersubscriptions`
--

CREATE TABLE IF NOT EXISTS `tbl_usersubscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `usrid` int(11) DEFAULT NULL,
  `yesstatus` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `tbl_usersubscriptions`
--

INSERT INTO `tbl_usersubscriptions` (`id`, `user_id`, `usrid`, `yesstatus`) VALUES
(9, 48, 19, 'Y'),
(4, 22, 1, 'Y'),
(5, 17, 1, 'Y'),
(6, 31, 1, 'Y'),
(13, 37, 48, 'Y'),
(22, 48, 1, 'Y'),
(14, 37, 1, 'Y'),
(15, 1, 37, 'N'),
(30, 95, 91, 'Y'),
(35, 97, 91, 'Y'),
(34, 96, 97, 'N'),
(36, 96, 68, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_accountdeactivate`
--

CREATE TABLE IF NOT EXISTS `tbl_user_accountdeactivate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `deactivation_reason` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_user_accountdeactivate`
--

INSERT INTO `tbl_user_accountdeactivate` (`id`, `user_id`, `deactivation_reason`) VALUES
(1, '90', 'Mucho mucho ass lick.'),
(2, '91', 'so for stuffz');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_horse_image_upload`
--

CREATE TABLE IF NOT EXISTS `tmp_horse_image_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_stable_image_upload`
--

CREATE TABLE IF NOT EXISTS `tmp_stable_image_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
