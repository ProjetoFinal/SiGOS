-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mai 12, 2012 as 02:27 PM
-- Versão do Servidor: 5.1.61
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome`, `identidade`, `orgaoexpedidor`, `cpf`, `nascimento`, `telefone`, `celular`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `email`) VALUES
(1, 'Leonardo Neves', 121488969, 'detran', '112.963.387-03', '2012-04-03', '(21)3331-5441', '', '21820-090', 'Rua Rio da Prata', 1904, '', 'Bangu', 'Rio de Janeiro', 'Rio de Janeiro', ''),
(2, 'Carlos', 2147483647, 'detran', '054.495.587-08', '2012-04-03', '(21)0000-0000', '(21)0000-0000', '21870-002', 'rua carlos', 345, 'ap 10', 'Bangu', 'Rio', 'Rio de Janeiro', 'carlos@ls.com'),
(3, 'dudu', 2147483647, 'ifp', '109.464.907-40', '2012-04-05', '(21)9999-9999', '(21)9999-9999', '21870-002', 'rua dudu', 12, 'ap 09', 'Bangu', 'Rio', 'Rio de Janeiro', 'dudu@dudu.com'),
(4, 'Valdirene ', 2147483647, 'IIRGD', '098.440.167-97', '2012-04-04', '(21)7676-7676', '(21)8787-8787', '87643-245', 'Rua das couves', 90, 'rua y', 'das flores', 'Rio de janeiro', 'Rio de Janeiro', ''),
(5, 'João Fernando', 121488969, 'dic', '484.332.348-97', '2012-05-08', '(21)3331-5441', '', '21820-090', 'rua cap teixeira', 121, '', 'Realengo', 'Rio de Janeiro', 'Rio de Janeiro', ''),
(6, 'joao', 123, 'dic', '455.688.125-00', '2012-05-10', '(21)0000-0000', '', '00000-000', 'aaaa', 123, '', 'bangu', 'rio de jneiro', 'Rio de Janeiro', ''),
(7, 'mariaa', 988908, 'dic', '613.275.625-61', '2012-05-02', '(00)0000-0000', '', '11111-111', '111111111', 1111, '111', '111', '111', 'Acre', ''),
(8, 'mariazinha', 123, 'dic', '809.006.666-68', '2012-05-02', '(11)1111-1111', '', '11111-111', '11111111111111', 1111, '111', '1111', '11111', 'Rio de Janeiro', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comprapeca`
--

CREATE TABLE IF NOT EXISTS `comprapeca` (
  `idcomprapeca` int(11) NOT NULL AUTO_INCREMENT,
  `idpeca` int(11) NOT NULL,
  `qtd` int(11) DEFAULT '0',
  `status` varchar(30) NOT NULL,
  `datapedido` date NOT NULL,
  PRIMARY KEY (`idcomprapeca`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `comprapeca`
--

INSERT INTO `comprapeca` (`idcomprapeca`, `idpeca`, `qtd`, `status`, `datapedido`) VALUES
(1, 5, 0, 'aberta', '2012-05-12');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`idequipamento`, `idcliente`, `idtiposequipamentos`, `marcaequip`, `modeloequip`, `numserie`) VALUES
(1, 3, 3, 'CCE', 'TV1310', 'HCR2980'),
(2, 4, 1, 'AOC', 'PT2000', 'XB909090'),
(3, 2, 4, 'SONY', 'JPA2003', 'XBP2012'),
(4, 1, 13, 'Zenity', 'APOSTI', 'ZEN2012'),
(5, 3, 16, 'MITSUBISH', 'MIT2012', 'MITXVA3000'),
(6, 1, 9, 'AAAAAAA', '1234', '1234'),
(7, 8, 16, 'aaaaa', 'aaaaaaaaa', 'aaaaaaaaa');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`idorcamento`, `idordemdeservico`, `maodeobra`, `valorpecasusadas`, `comentarios`) VALUES
(1, 1, '70.00', '43.21', 'Foda-se'),
(2, 2, '30.00', '1.73', 'teste'),
(3, 3, '70.00', '1.23', NULL),
(4, 4, '50.00', '56.17', 'Whatever'),
(5, 5, '160.00', '1.23', NULL),
(6, 6, '30.00', '0.00', 'whatever'),
(7, 7, '40.00', '0.00', NULL),
(8, 8, '60.00', '0.00', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `ordemdeservico`
--

INSERT INTO `ordemdeservico` (`idordemdeservico`, `idequipamento`, `idusuario`, `idstatus`, `defeito`, `acompanhamento`, `acessorios`, `solucao`, `entrada`, `iniciomanut`, `fimmanut`, `entrega`, `garantiadeservico`, `caminhoimpressao`) VALUES
(1, 1, 2, 10, 'Desligando', NULL, 'Controle Remoto', 'fuck you', '2012-04-04', NULL, NULL, NULL, 0, 'impressao/os1333583497.txt'),
(2, 2, 2, 10, 'Tela preta', 'teste', 'Cabo   controle', 'bbvbvbvbvbvvbvbvbvbv', '2012-04-04', NULL, NULL, NULL, 0, 'impressao/os1333584140.txt'),
(3, 1, 2, 7, 'Parado', NULL, 'Nenhum', NULL, '2012-04-14', NULL, NULL, NULL, 0, 'impressao/os1334411626.txt'),
(4, 3, 2, 4, 'Linha em branco na tela', NULL, 'Cabos', NULL, '2012-04-14', NULL, NULL, NULL, 0, 'impressao/os1334417163.txt'),
(5, 4, 2, 8, 'Não liga', NULL, '', 'teste', '2012-04-14', NULL, NULL, NULL, 0, 'impressao/os1334418658.txt'),
(6, 2, 2, 4, 'Não exibe imagem', NULL, '', NULL, '2012-04-14', NULL, NULL, NULL, 0, 'impressao/os1334418713.txt'),
(7, 5, 2, 2, 'Sem som', NULL, '', NULL, '2012-04-14', NULL, NULL, NULL, 0, 'impressao/os1334418901.txt'),
(8, 6, 2, 10, '1234', NULL, '1234', 'troca', '2012-05-12', '2012-05-12', '2012-05-12', '2012-05-12', 0, 'impressao/os1336834935.txt');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `pecasolicitada`
--

INSERT INTO `pecasolicitada` (`idpecasolicitada`, `idos`, `idpeca`, `qtdsolicitada`) VALUES
(1, 1, 4, 1),
(3, 2, 3, 1),
(4, 2, 1, 1),
(8, 3, 3, 1),
(9, 4, 3, 2),
(10, 4, 4, 1),
(11, 4, 2, 1),
(12, 4, 1, 1),
(13, 5, 3, 1);

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
(1, 'TV/MONITOR - CRT 14 a 20''', '30.00'),
(2, 'TV/MONITOR - CRT 21 a 26''', '50.00'),
(3, 'TV/MONITOR - CRT 29 a 32''', '70.00'),
(4, 'TV/MONITOR - LCD 14 a 20''', '50.00'),
(5, 'TV/MONITOR - LCD 21 a 26''', '70.00'),
(6, 'TV/MONITOR - LCD 29 a 32''', '90.00'),
(7, 'TV/MONITOR - LCD 40 a 55''', '120.00'),
(8, 'TV/MONITOR - LCD 55+''', '150.00'),
(9, 'TV/MONITOR - LED 14 a 20''', '60.00'),
(10, 'TV/MONITOR - LED 21 a 26''', '80.00'),
(11, 'TV/MONITOR - LED 29 a 32''', '100.00'),
(12, 'TV/MONITOR - LED 40 a 55''', '130.00'),
(13, 'TV/MONITOR - LED 55+''', '160.00'),
(14, 'DVD Player', '30.00'),
(15, 'Audio - MiniSystem', '20.00'),
(16, 'Audio - MicroSystem', '40.00'),
(17, 'Audio - System', '60.00');

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
