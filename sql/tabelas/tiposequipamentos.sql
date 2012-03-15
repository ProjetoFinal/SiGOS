-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 15, 2012 as 03:37 PM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tiposequipamentos`
--

INSERT INTO `tiposequipamentos` (`idtiposequipamentos`, `tipo`, `maodeobra`) VALUES
(1, 'DVD  Player', 30.00),
(2, 'TV 29''''', 50.00),
(3, 'Notebook', 150.00),
(4, 'Desktop', 70.00);
