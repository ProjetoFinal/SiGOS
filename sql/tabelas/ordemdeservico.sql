-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 10, 2012 as 01:59 PM
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
-- Estrutura da tabela `ordemdeservico`
--

CREATE TABLE IF NOT EXISTS `ordemdeservico` (
  `idordemdeservico` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idequipamento` int(11) unsigned NOT NULL,
  `idfuncionario` int(11) DEFAULT NULL,
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
  PRIMARY KEY (`idordemdeservico`),
  KEY `idEquipamento` (`idequipamento`),
  KEY `idFuncionario` (`idfuncionario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `ordemdeservico`
--

INSERT INTO `ordemdeservico` (`idordemdeservico`, `idequipamento`, `idfuncionario`, `idstatus`, `defeito`, `acompanhamento`, `acessorios`, `solucao`, `entrada`, `iniciomanut`, `fimmanut`, `entrega`, `garantiadeservico`) VALUES
(1, 6, NULL, 1, 'Teste Defeito', NULL, NULL, '', '2012-03-10', NULL, NULL, NULL, NULL);
