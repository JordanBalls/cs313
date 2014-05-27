-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2014 at 02:34 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `address` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `address`) VALUES
(1, 'McDonalds', '111 main street'),
(2, 'Shake Out', '123 Smith Street'),
(3, 'AppleBees', '56 Big Road'),
(4, 'Frontier Pies', '3412 Yellowstone'),
(5, 'Ramirez', 'Somewhere on Main Street');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `restaurantID` int(10) unsigned NOT NULL,
  `review` blob,
  PRIMARY KEY (`id`),
  KEY `userID` (`userID`),
  KEY `review_ibfk_2` (`restaurantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `userID`, `restaurantID`, `review`) VALUES
(1, 1, 1, 0x43616e742062656174206d63646f6e616c647321),
(2, 2, 2, 0x486967686c79205265636f6d6d656e642e204772656174207175616c69747920677265617420707269636521),
(3, 3, 3, 0x446f204e4f54206561742068657265207468652073657276696365206973207465727269626c6521),
(4, 1, 4, 0x477265617420706c61636520746f2065617420736f6d652064657373657274),
(5, 2, 1, 0x4c6f772070726963652c206c6f77207175616c697479),
(6, 2, 5, 0x546865206265737420627265616b66617374206275727269746f732061726f756e6421);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`) VALUES
(1, 'jordan', 'hello'),
(2, 'bigguy121', 'goodbye'),
(3, 'amurica', 'oyeah');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`restaurantID`) REFERENCES `restaurant` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
