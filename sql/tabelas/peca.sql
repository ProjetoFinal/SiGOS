-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2012 at 12:45 AM
-- Server version: 5.1.61
-- PHP Version: 5.3.2-1ubuntu4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sigos`
--

-- --------------------------------------------------------

--
-- Table structure for table `peca`
--

CREATE TABLE IF NOT EXISTS `peca` (
  `idpeca` int(11) NOT NULL AUTO_INCREMENT,
  `codigopeca` int(11) NOT NULL,
  `nomepeca` varchar(255) NOT NULL,
  `marcapeca` varchar(255) NOT NULL,
  `modelopeca` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `precounidade` double NOT NULL,
  `dataentrada` date NOT NULL,
  PRIMARY KEY (`idpeca`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `peca`
--

INSERT INTO `peca` (`idpeca`, `codigopeca`, `nomepeca`, `marcapeca`, `modelopeca`, `quantidade`, `precounidade`, `dataentrada`) VALUES
(1, 123, 'Transistor m90', 'Phillips', 'P39J', 10, 10, '2012-03-15');
