-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 13, 2012 as 04:14 PM
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
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` varchar(255) NOT NULL,
  `statusUsuario` varchar(255) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `login`, `senha`, `nivel`, `statusUsuario`) VALUES
(1, 'Leonardo Neves', 'leonardo.neves', '4475e4c89ce27fbef987dded4a9143e3b6a738bf', 'balconista', 'ativo'),
(2, 'Tecnico', 'tecnico', 'f776097420388ae66ffbbc41b22cd2424ded1b2a', 'tecnico', 'ativo'),
(3, 'Balconista', 'balconista', '038f6a53562e0f81fe7f7302eef6f67e1d3e029c', 'balconista', 'ativo'),
(4, 'Gerente', 'gerente', '4299478c1f474b8b8a8f8069a39be46b2377597e', 'gerente', 'ativo');
