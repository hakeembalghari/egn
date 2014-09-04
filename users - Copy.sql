-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2013 at 12:43 AM
-- Server version: 5.5.32-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ncms_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(124) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `old_salt` varchar(42) NOT NULL,
  `email` text NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `birthdate` varchar(32) NOT NULL,
  `secretquestion` varchar(84) NOT NULL,
  `secretanswer` varchar(32) NOT NULL,
  `ip` text NOT NULL,
  `timestamp` text NOT NULL,
  `page` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `old_salt`, `email`, `fullname`, `birthdate`, `secretquestion`, `secretanswer`, `ip`, `timestamp`, `page`) VALUES
(1, 'necro', 'cd917b8a7feef9cd6f3ddd5a0b12c71a9d977b13e907507ce4341f5669bad3a8', '1f6bf1104f62489b', '', 'necrohhh@gmail.com', '', '', '', '', '24.164.167.106', 'July 23, 2013, 6:15 pm', ''),
(2, 'test', '9bddcda7222c050005144753bcf892157e253d3c295abe51eeb646e5b45c4c6d', '1e24bd2e3a3132f', 'ekmZ+ix:4K|Xki&EyUgz0#hxfcNv65', 'test@test.com', '', '', '', '', '69.206.161.57', 'February 5, 2013, 11:09 pm', ''),
(18, 'herp', '3fc4b4180e2e5f3f76ab69d08457901b6b18ecc811780dd615b738406d33a5c1', '5c733abc608691c0', '', 'derp@derp.com', '', '', '', '', '', '', ''),
(29, 'Herp', '018bd86921c4357aef488b0d43832f4209cdf754d3fe2d54f9233ea983d6df70', '7a6544c41bf8b4d8', '', 'test@test.com', '', 'January 1, ', 'null', '098f6bcd4621d373cade4e832627b4f6', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
