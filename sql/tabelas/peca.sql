-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 12/05/2012 às 20h08min
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `peca`
--

INSERT INTO `peca` (`idpeca`, `codigopeca`, `nomepeca`, `marcapeca`, `modelopeca`, `quantidade`, `precounidade`, `dataentrada`) VALUES
(1, 1506400, 'CORREIA AIWA HVTR1', 'AIWA', 'KAW0002', 10, 1, '2012-05-11'),
(2, 1506410, 'CORREIA CCE 74X', 'CCE', 'KCE0002', 10, 1, '2012-05-04'),
(3, 1506412, 'CORREIA CCE9X', 'CCE', 'KCE0003', 10, 1.2, '2012-05-04'),
(4, 1506426, 'CORREIA DAEWOD DVK 525N', 'DAEWOD', 'KDA0001', 10, 1.3, '2012-05-04'),
(5, 1506436, 'CORREIA GRADIENTE SV850', 'GRADIENTE', 'KGD0003', 5, 1, '2012-05-04'),
(6, 1506458, 'CORREIA JVCJ421', 'JVC', 'KJV0002', 10, 1.15, '2012-05-04'),
(7, 1506480, 'CORREIA PHILIPS VR 31', 'PHILIPS', 'KP0003', 5, 1.4, '2012-05-05'),
(8, 191523, 'DIODO MBR 1545', 'BRASIL', 'MBR 1545', 5, 2, '2012-05-05'),
(9, 193372, 'DIODO MBR 3045', 'BRASIL', 'MBR 3045', 4, 1.5, '2012-05-05'),
(10, 195456, 'DIODO MBR 20100 ', 'BRASIL', 'MBR 20100 ', 4, 1.5, '2012-05-05'),
(11, 238015, 'DIODO MBR 735', 'BRASIL', 'MBR 735', 5, 2.9, '2012-05-05'),
(12, 598682, 'DIODO MUR 620 ', 'BRASIL', 'MUR 620 ', 5, 3.1, '2012-05-05'),
(13, 598712, 'DIODO MUR 1100 ', 'BRASIL', 'MUR 1100 ', 4, 5, '2012-05-05'),
(14, 604402, 'DIODO MUR 4100 ', 'BRASIL', 'MUR 4100 ', 5, 1.9, '2012-05-05'),
(15, 1500726, 'FLYBACK TAT 1402A', 'CCE', 'HPS 1465 Z, 1470 B/Z/ZJ, 1485 B/G/ZG, 1490 B/H', 4, 13.95, '2012-05-12'),
(16, 1500730, 'FLYBACK TAT 1405A', 'CCE', 'HPS 14R, 1470 AA/BB/DD/EE, 1480 D/C, 1481 B', 2, 13.95, '2012-05-12'),
(17, 1500732, 'FLYBACK TAT 1406A', 'CCE', 'HPS 1470V, 1481E', 2, 14, '2012-05-12'),
(18, 1500800, 'FLYBACK AT 2078/SO', 'PHILIPS', '14GL 1010,1310,1410 - 16GL 1030,1330, - 20GL 1040,1340,1440', 5, 13.95, '2012-05-12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
