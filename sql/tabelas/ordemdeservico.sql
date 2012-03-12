-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 12, 2012 as 03:03 PM
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
-- Estrutura da tabela `ordemdeservico`
--

CREATE TABLE IF NOT EXISTS `ordemdeservico` (
  `idordemdeservico` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idequipamento` int(11) unsigned NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idstatus` int(11) NOT NULL,
  `defeito` text NOT NULL,
  `acompanhamento` text,
  `acessorios` text,
  `solucao` text,
  `entrada` date NOT NULL,
  `iniciomanut` date DEFAULT NULL,
  `fimmanut` date DEFAULT NULL,
  `entrega` date DEFAULT NULL,
  `garantiadeservico` smallint(1) DEFAULT NULL,
  `caminhoimpressao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idordemdeservico`),
  KEY `idEquipamento` (`idequipamento`),
  KEY `idFuncionario` (`idusuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `ordemdeservico`
--

INSERT INTO `ordemdeservico` (`idordemdeservico`, `idequipamento`, `idusuario`, `idstatus`, `defeito`, `acompanhamento`, `acessorios`, `solucao`, `entrada`, `iniciomanut`, `fimmanut`, `entrega`, `garantiadeservico`, `caminhoimpressao`) VALUES
(1, 6, NULL, 1, 'Tv não liga', NULL, 'Controle', NULL, '2012-03-10', NULL, NULL, NULL, NULL, 'impressao/os1331417715.txt');
