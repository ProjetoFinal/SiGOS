-- phpMyAdmin SQL Dump

-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 22, 2012 as 09:57 AM
-- Versão do Servidor: 5.1.49
-- Versão do PHP: 5.3.3-1ubuntu9.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `sigos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiposequipamentos`
--

CREATE TABLE IF NOT EXISTS `tiposequipamentos` (
  `idtiposequipamentos` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  `maodeobra` decimal(8,2) NOT NULL,
  PRIMARY KEY (`idtiposequipamentos`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `tiposequipamentos`
--

INSERT INTO `tiposequipamentos` (`idtiposequipamentos`, `tipo`, `maodeobra`) VALUES
(1, 'TV/MONITOR - CRT 14 a 20''', '30.00'),
(2, 'TV/MONITOR - CRT 21 a 26''', '50.00'),
(3, 'TV/MONITOR - CRT 29 a 32''', '70.00'),
(4, 'TV/MONITOR - LCD 14 a 20''', '50.00'),
(5, 'TV/MONITOR - LCD 21 a 26''', '70.00'),
(6, 'TV/MONITOR - LCD 29 a 32''', '90.00'),
(7, 'TV/MONITOR - LCD 40 a 55''', '120.00'),
(8, 'TV/MONITOR - LCD 55+''', '150.00'),
(9, 'TV/MONITOR - LED 14 a 20''', '60.00'),
(10, 'TV/MONITOR - LED 21 a 26''', '80.00'),
(11, 'TV/MONITOR - LED 29 a 32''', '100.00'),
(12, 'TV/MONITOR - LED 40 a 55''', '130.00'),
(13, 'TV/MONITOR - LED 55+''', '160.00'),
(14, 'DVD Player', '30.00'),
(15, 'Audio - MiniSystem', '20.00'),
(16, 'Audio - MicroSystem', '40.00'),
(17, 'Audio - System', '60.00');

