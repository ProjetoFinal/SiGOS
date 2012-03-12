-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 10, 2012 as 01:16 PM
-- Versão do Servidor: 5.1.41
-- Versão do PHP: 5.3.2-1ubuntu4.14

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
  `marcaequip` varchar(255) NOT NULL,
  `modeloequip` varchar(255) NOT NULL,
  `tipoequip` varchar(255) NOT NULL,
  `numserie` varchar(255) NOT NULL,
  PRIMARY KEY (`idequipamento`),
  KEY `idCliente` (`idcliente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`idequipamento`, `idcliente`, `marcaequip`, `modeloequip`, `tipoequip`, `numserie`) VALUES
(1, 1, 'Teste', 'Teste2', 'DVD', 'TESTE12324HS'),
(2, 1, 'ABC', 'DEF', 'DVD', 'ABC8w98e'),
(3, 2, 'LG', 'M227WAP', 'DVD', 'LGBR1473XD'),
(4, 3, 'XBOX', '360', 'DVD', 'XBOXBR12u3yy4'),
(5, 3, 'Phillips', 'Blue sky', 'DVD', 'ajx241012'),
(6, 4, 'Sony', 'XT-350', 'TV', '123310834');
