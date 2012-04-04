-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Abr 03, 2012 as 11:26 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome`, `identidade`, `orgaoexpedidor`, `cpf`, `nascimento`, `telefone`, `celular`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `email`) VALUES
(10, 'Leonardo Neves', 121488969, 'detran', '112.963.387-03', '2012-03-08', '(21)2404-6967', '(21)8186-6154', '21820-090', 'Rua Rio da Prata', 1904, 'fundos', 'Bangu', 'Rio de Janeiro', 'Rio de Janeiro', 'leo.mvhost@hotmail.com'),
(12, 'Teste de Serialize2', 1234566789, 'DIC', '511.512.920-52', '2012-03-01', '(21)2222-2222', '(21)2222-2222', '21820-090', 'Rua Rio da Prata', 1904, 'fds', 'Bangu', 'Rio de Janeiro', 'Rio de Janeiro', 'leo.mvhost@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE IF NOT EXISTS `equipamento` (
  `idequipamento` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `idtiposequipamentos` int(11) NOT NULL,
  `marcaequip` varchar(200) NOT NULL,
  `modeloequip` varchar(100) NOT NULL,
  `numserie` varchar(100) NOT NULL,
  PRIMARY KEY (`idequipamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`idequipamento`, `idcliente`, `idtiposequipamentos`, `marcaequip`, `modeloequip`, `numserie`) VALUES
(7, 10, 1, 'POSITIVO', 'MONITOR', '00000000'),
(6, 10, 1, 'SAMSUNG', 'SyncMaster943BWX', '0000000000'),
(5, 10, 1, 'PHILCO', 'ABC4584XS', '1235444SX457'),
(8, 10, 1, 'ASUS', 'dsdasdsa', '2222222222222'),
(9, 10, 1, 'CCE', 'dsdsds', '0000000000000'),
(10, 10, 1, 'DELL', 'qqqqqqqq', 'qqqqqqqqqqqqq'),
(11, 10, 1, 'LG', 'sasasa', 'sssssssssss'),
(12, 10, 1, 'Apple', 'dddddddd', 'dddddddddddd'),
(13, 10, 1, 'CITIZEN', 'sasasa', 'sasasasa'),
(14, 10, 3, 'HP', 'Pavillion', 'HPPV15665'),
(15, 10, 2, 'LG', 'M5127132', '0000000000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `idfornecedor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `razaosocial` varchar(100) NOT NULL,
  `nomefantasia` varchar(100) DEFAULT NULL,
  `cnpj` varchar(20) NOT NULL,
  `inscest` varchar(20) NOT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `cep` varchar(15) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` int(11) unsigned NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  PRIMARY KEY (`idfornecedor`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`idfornecedor`, `razaosocial`, `nomefantasia`, `cnpj`, `inscest`, `contato`, `telefone`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`) VALUES
(4, 'sasasa', 'sasasasasa', '28.261.256/0001-71', '121321321', '121231321321321', '(13)1231-3213', '32132-132', '132132132', 1321321, '3213213', '2132132', '1321321321', 'Ac');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE IF NOT EXISTS `orcamento` (
  `idorcamento` int(11) NOT NULL AUTO_INCREMENT,
  `idordemdeservico` int(11) NOT NULL,
  `maodeobra` decimal(8,2) NOT NULL,
  `valorpecasusadas` decimal(8,2) DEFAULT '0.00',
  `comentarios` text,
  PRIMARY KEY (`idorcamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`idorcamento`, `idordemdeservico`, `maodeobra`, `valorpecasusadas`, `comentarios`) VALUES
(1, 11, 150.00, 98.15, 'Comentario 1. Comentario 2. Comentario 3'),
(2, 12, 50.00, 10.00, NULL);

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
  `garantiadeservico` smallint(1) NOT NULL DEFAULT '0',
  `caminhoimpressao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idordemdeservico`),
  KEY `idEquipamento` (`idequipamento`),
  KEY `idFuncionario` (`idusuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `ordemdeservico`
--

INSERT INTO `ordemdeservico` (`idordemdeservico`, `idequipamento`, `idusuario`, `idstatus`, `defeito`, `acompanhamento`, `acessorios`, `solucao`, `entrada`, `iniciomanut`, `fimmanut`, `entrega`, `garantiadeservico`, `caminhoimpressao`) VALUES
(1, 6, 2, 4, 'Tv não liga', NULL, 'Controle', NULL, '2012-03-10', NULL, NULL, NULL, 0, 'impressao/os1331417715.txt'),
(2, 7, 2, 2, 'fdsfdsfd', NULL, 'fdfsdfdsfsd', NULL, '2012-03-13', NULL, NULL, NULL, 0, 'impressao/os1331658192.txt'),
(3, 5, 2, 1, 'fdfds', NULL, 'fdsfdsfdsfsd', NULL, '2012-03-13', NULL, NULL, NULL, 0, 'impressao/os1331658206.txt'),
(4, 8, 2, 3, 'asasasa', NULL, 'sasasasasa', NULL, '2012-03-13', NULL, NULL, NULL, 0, 'impressao/os1331658259.txt'),
(5, 9, 2, 5, 'sasasa', NULL, 'sasasas', NULL, '2012-03-13', NULL, NULL, NULL, 0, 'impressao/os1331658271.txt'),
(6, 10, 2, 6, 'sasasa', NULL, 'sasasasa', NULL, '2012-03-13', NULL, NULL, NULL, 0, 'impressao/os1331658282.txt'),
(7, 11, 2, 7, 'dsdsds', NULL, 'dsdsd', NULL, '2012-03-13', NULL, NULL, NULL, 0, 'impressao/os1331658328.txt'),
(8, 12, 2, 8, 'sdsdsd', NULL, 'dsdsdsds', NULL, '2012-03-13', NULL, NULL, NULL, 0, 'impressao/os1331658338.txt'),
(9, 13, 2, 9, 'dsdsds', NULL, 'dsdasdsads', NULL, '2012-03-13', NULL, NULL, NULL, 0, 'impressao/os1331664718.txt'),
(11, 14, 2, 8, 'Teste para orçamento.', 'Acompanhamento 1; Acompanhamento 2', 'Fonte de Alimentação.', 'Troca de componentes e ressoldagem.', '2012-03-15', NULL, NULL, NULL, 0, 'impressao/os1331836469.txt'),
(12, 15, 2, 3, 'Não Liga.', NULL, '', NULL, '2012-03-28', NULL, NULL, NULL, 0, 'impressao/os1332944145.txt');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `pecasolicitada`
--

INSERT INTO `pecasolicitada` (`idpecasolicitada`, `idos`, `idpeca`, `qtdsolicitada`) VALUES
(2, 12, 2, 1),
(3, 11, 1, 1),
(4, 11, 2, 1),
(5, 11, 3, 1),
(6, 11, 4, 2);

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiposequipamentos`
--

CREATE TABLE IF NOT EXISTS `tiposequipamentos` (
  `idtiposequipamentos` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  `maodeobra` decimal(8,2) NOT NULL,
  PRIMARY KEY (`idtiposequipamentos`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `tiposequipamentos`
--

INSERT INTO `tiposequipamentos` (`idtiposequipamentos`, `tipo`, `maodeobra`) VALUES
(1, 'TV/MONITOR - CRT 14 a 20''', 30.00),
(2, 'TV/MONITOR - CRT 21 a 26''', 50.00),
(3, 'TV/MONITOR - CRT 29 a 32''', 70.00),
(4, 'TV/MONITOR - LCD 14 a 20''', 50.00),
(5, 'TV/MONITOR - LCD 21 a 26''', 70.00),
(6, 'TV/MONITOR - LCD 29 a 32''', 90.00),
(7, 'TV/MONITOR - LCD 40 a 55''', 120.00),
(8, 'TV/MONITOR - LCD 55+''', 150.00),
(9, 'TV/MONITOR - LED 14 a 20''', 60.00),
(10, 'TV/MONITOR - LED 21 a 26''', 80.00),
(11, 'TV/MONITOR - LED 29 a 32''', 100.00),
(12, 'TV/MONITOR - LED 40 a 55''', 130.00),
(13, 'TV/MONITOR - LED 55+''', 160.00),
(14, 'DVD Player', 30.00),
(15, 'Audio - MiniSystem', 20.00),
(16, 'Audio - MicroSystem', 40.00),
(17, 'Audio - System', 60.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `uf`
--

CREATE TABLE IF NOT EXISTS `uf` (
  `id_uf` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` char(2) NOT NULL DEFAULT '',
  `estado` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_uf`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `uf`
--

INSERT INTO `uf` (`id_uf`, `sigla`, `estado`) VALUES
(1, 'AC', 'Acre'),
(2, 'AL', 'Alagoas'),
(3, 'AM', 'Amazonas'),
(4, 'AP', 'Amapá'),
(5, 'BA', 'Bahia'),
(6, 'CE', 'Ceará'),
(7, 'DF', 'Distrito Federal'),
(8, 'ES', 'Espírito Santo'),
(9, 'GO', 'Goiás'),
(10, 'MA', 'Maranhão'),
(11, 'MG', 'Minas Gerais'),
(12, 'MS', 'Mato Grosso do Sul'),
(13, 'MT', 'Mato Grosso'),
(14, 'PA', 'Pará'),
(15, 'PB', 'Paraíba'),
(16, 'PE', 'Pernambuco'),
(17, 'PI', 'Piauí'),
(18, 'PR', 'Paraná'),
(19, 'RJ', 'Rio de Janeiro'),
(20, 'RN', 'Rio Grande do Norte'),
(21, 'RO', 'Rondônia'),
(22, 'RR', 'Roraima'),
(23, 'RS', 'Rio Grande do Sul'),
(24, 'SC', 'Santa Catarina'),
(25, 'SE', 'Sergipe'),
(26, 'SP', 'São Paulo'),
(27, 'TO', 'Tocantins');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `login`, `senha`, `nivel`, `statusUsuario`) VALUES
(1, 'Leonardo Neves', 'leonardo.neves', '4475e4c89ce27fbef987dded4a9143e3b6a738bf', 'balconista', 'ativo'),
(2, 'Tecnico', 'tecnico', 'f776097420388ae66ffbbc41b22cd2424ded1b2a', 'tecnico', 'ativo'),
(3, 'Balconista', 'balconista', '038f6a53562e0f81fe7f7302eef6f67e1d3e029c', 'balconista', 'ativo'),
(4, 'Gerente', 'gerente', '4299478c1f474b8b8a8f8069a39be46b2377597e', 'gerente', 'ativo'),
(5, 'Estoquista', 'estoque', '2d211a1072d7779cbdf018f3b530f731b1111809', 'estoquista', 'ativo');
