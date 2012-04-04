-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 28, 2012 as 04:52 PM
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
-- Estrutura da tabela `pecasolicitada`
--

CREATE TABLE IF NOT EXISTS `pecasolicitada` (
  `idpecasolicitada` int(11) NOT NULL AUTO_INCREMENT,
  `idos` int(11) NOT NULL,
  `idpeca` int(11) NOT NULL,
  `qtdsolicitada` int(11) NOT NULL,
  PRIMARY KEY (`idpecasolicitada`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `pecasolicitada`
--

INSERT INTO `pecasolicitada` (`idpecasolicitada`, `idos`, `idpeca`, `qtdsolicitada`) VALUES
(1, 12, 1, 1);
