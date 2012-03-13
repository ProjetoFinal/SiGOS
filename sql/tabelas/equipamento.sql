-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 13, 2012 as 04:13 PM
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
-- Estrutura da tabela `equipamento`
--

CREATE TABLE IF NOT EXISTS `equipamento` (
  `idequipamento` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `marcaequip` varchar(200) NOT NULL,
  `modeloequip` varchar(100) NOT NULL,
  `tipoequip` varchar(100) NOT NULL,
  `numserie` varchar(100) NOT NULL,
  PRIMARY KEY (`idequipamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`idequipamento`, `idcliente`, `marcaequip`, `modeloequip`, `tipoequip`, `numserie`) VALUES
(7, 10, 'POSITIVO', 'MONITOR', 'TV', '00000000'),
(6, 10, 'SAMSUNG', 'SyncMaster943BWX', 'TV', '0000000000'),
(5, 10, 'PHILCO', 'ABC4584XS', 'TV', '1235444SX457'),
(8, 10, 'ASUS', 'dsdasdsa', 'DVD', '2222222222222'),
(9, 10, 'CCE', 'dsdsds', 'DVD', '0000000000000'),
(10, 10, 'DELL', 'qqqqqqqq', 'DVD', 'qqqqqqqqqqqqq'),
(11, 10, 'LG', 'sasasa', 'DVD', 'sssssssssss'),
(12, 10, 'Apple', 'dddddddd', 'TV', 'dddddddddddd'),
(13, 10, 'CITIZEN', 'sasasa', 'DVD', 'sasasasa');
