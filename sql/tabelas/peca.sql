-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 28, 2012 as 04:53 PM
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
-- Estrutura da tabela `peca`
--

CREATE TABLE IF NOT EXISTS `peca` (
  `idpeca` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codigopeca` int(11) unsigned NOT NULL,
  `nomepeca` varchar(255) NOT NULL,
  `marcapeca` varchar(255) NOT NULL,
  `modelopeca` varchar(255) NOT NULL,
  `quantidade` int(11) unsigned NOT NULL,
  `precounidade` double NOT NULL,
  `dataentrada` date NOT NULL,
  PRIMARY KEY (`idpeca`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `peca`
--

INSERT INTO `peca` (`idpeca`, `codigopeca`, `nomepeca`, `marcapeca`, `modelopeca`, `quantidade`, `precounidade`, `dataentrada`) VALUES
(1, 1245, 'teste descrucao', 'teste Marca', 'teste Modelo', 20, 0.5, '2012-03-13'),
(2, 32132, 'dsdas', 'dsadasd', 'asdasd', 30, 10, '2012-03-15'),
(3, 321, '123', '123', '123', 123, 1.23, '2012-03-07'),
(4, 43212, '4321', '4321', '4321', 4321, 43.21, '2012-03-07');
