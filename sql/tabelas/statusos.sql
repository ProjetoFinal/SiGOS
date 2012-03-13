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
-- Estrutura da tabela `statusos`
--

CREATE TABLE IF NOT EXISTS `statusos` (
  `idStatus` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`idStatus`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `statusos`
--

INSERT INTO `statusos` (`idStatus`, `status`) VALUES
(1, 'Em Aberto'),
(2, 'Em Análise Técnica'),
(3, 'Aguardando Aprovação'),
(4, 'Orçamento Aprovado'),
(5, 'Orçamento Reprovado'),
(6, 'Em Manutenção'),
(7, 'Aguardando Peça(s)'),
(8, 'Pronto para Entrega'),
(9, 'Reaberta'),
(10, 'Finalizada');
