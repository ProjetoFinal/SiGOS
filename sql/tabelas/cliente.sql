-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 12/05/2012 às 20h11min
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
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `identidade` int(11) NOT NULL,
  `orgaoexpedidor` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `nascimento` date NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `celular` varchar(13) DEFAULT NULL,
  `cep` varchar(9) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome`, `identidade`, `orgaoexpedidor`, `cpf`, `nascimento`, `telefone`, `celular`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `email`) VALUES
(1, 'Leonardo Neves', 121488969, 'detran', '112.963.387-03', '2012-04-03', '(21)3331-5441', '', '21820-090', 'Rua Rio da Prata', 1904, '', 'Bangu', 'Rio de Janeiro', 'Rio de Janeiro', ''),
(2, 'Carlos Adean', 2147483647, 'detran', '054.495.587-08', '2012-04-03', '(21)0000-0000', '(21)0000-0000', '21870-002', 'rua carlos', 345, 'ap 10', 'Bangu', 'Rio', 'Rio de Janeiro', 'carlos@ls.com'),
(3, 'Eduardo dos Reis', 2147483647, 'ifp', '109.464.907-40', '2012-04-05', '(21)9999-9999', '(21)9999-9999', '21870-002', 'rua dudu', 12, 'ap 09', 'Bangu', 'Rio', 'Rio de Janeiro', 'efernandes@gmail.com'),
(4, 'Valdirene Villa', 2147483647, 'IIRGD', '098.440.167-97', '2012-04-04', '(21)7676-7676', '(21)8787-8787', '87643-245', 'Rua das couves', 90, 'rua y', 'das flores', 'Rio de janeiro', 'Rio de Janeiro', ''),
(5, 'Maria José', 987898, 'PMRJ', '622.855.025-08', '1973-05-10', '(21)2401-9226', '(21)7657-2312', '23045-120', 'Rua Mirador', 62, 'Casa 01', 'Realengo', 'Rio de Janeiro', 'Rio de Janeiro', ''),
(6, 'Romário de Souza', 90876921, 'IFP', '808.826.519-35', '1974-05-03', '(11)4324-0989', '(11)9878-8445', '43209-010', 'Rua Vasco da Gama', 100, '', 'Centro', 'São Paulo', 'São Paulo', ''),
(7, 'Neymar dos Santos', 76678289, 'IIRGD', '431.681.275-07', '1990-05-09', '(21)3333-4444', '(21)9999-8888', '12092-010', 'Rua da praia', 100, '', 'Centro', 'Rio de Janeiro', 'Rio de Janeiro', 'neymar@santos.com.br');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
