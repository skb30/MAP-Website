-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2011 at 10:35 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `MAP`
--

-- --------------------------------------------------------

--
-- Table structure for table `menuItems`
--

CREATE TABLE `menuItems` (
  `menuItemID` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(4) NOT NULL,
  `menuName` varchar(40) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `notes` varchar(255) NOT NULL,
  PRIMARY KEY (`menuItemID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `menuItems`
--

INSERT INTO `menuItems` VALUES(2, 2, 'Training', 1, 'We provide the best training this side of the Mississippi!', '');
INSERT INTO `menuItems` VALUES(47, 1, 'ProJCL', 1, 'ProJCL content', '');
INSERT INTO `menuItems` VALUES(61, 1, 'About MAP', 1, '', '');
INSERT INTO `menuItems` VALUES(64, 4, 'Authors', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pageID` int(11) NOT NULL AUTO_INCREMENT,
  `menuItemID` int(11) NOT NULL,
  `menuName` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`pageID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` VALUES(1, 3, 'History', 1, 1, 'Company History');
INSERT INTO `pages` VALUES(2, 3, 'Our Mission', 2, 1, 'Our Mission statement ....');
INSERT INTO `pages` VALUES(3, 2, 'Results Server ', 3, 1, 'MAP Training Links');
INSERT INTO `pages` VALUES(4, 3, 'Our Team', 1, 1, 'Welcome to MAP');
INSERT INTO `pages` VALUES(33, 47, 'Claudie Mercier', 4, 1, 'another page for <h2> Claudie </h2>');
INSERT INTO `pages` VALUES(27, 47, 'Infox', 1, 1, '			<b>Infox Stuff</b> Nothing bold now. 	\r\nand now more stuff\r\n\r\nand a few more lines here.\r\n\r\nand more stuff here <b>With a link to the home page</b> <a href="index.php">Home</a>		');
INSERT INTO `pages` VALUES(9, 2, 'Subversion', 1, 1, '	Subversion Training Page	');
INSERT INTO `pages` VALUES(28, 47, 'scott', 3, 1, 'scotts');
INSERT INTO `pages` VALUES(35, 64, 'Author Names', 1, 1, '	Scott K. Barth	');
INSERT INTO `pages` VALUES(31, 47, 'Test Page', 1, 1, 'stuff more more');
INSERT INTO `pages` VALUES(18, 2, 'CentOS', 4, 1, 'The CentOS Page');
INSERT INTO `pages` VALUES(19, 61, 'Team', 1, 1, '	Name of the Team Members	');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL,
  `hashedPassword` varchar(50) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'skb30', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(2, 'julia', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(3, 'julia', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(4, 'skb30', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(5, 'skb30', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(6, 'skb30', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(7, 'skb30', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(8, 'skb30', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(9, 'skb30', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(10, 'skb30', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(11, 'skb30', 'b7fcead31ad1ea6a238e46db9552032ab2794871');
INSERT INTO `users` VALUES(12, 'scott', '625600233cb3bcab32268c17610882e0fdaed295');
