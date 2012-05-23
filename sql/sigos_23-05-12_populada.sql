-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mai 23, 2012 as 02:28 PM
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome`, `identidade`, `orgaoexpedidor`, `cpf`, `nascimento`, `telefone`, `celular`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `email`) VALUES
(1, 'carlos adean de souza', 121488969, 'detran', '724.542.554-05', '1986-05-01', '(21)1234-5678', '', '21820-090', 'rua ibitiuva', 152, '', 'padre miguel', 'rio de janeiro', 'Rio de Janeiro', ''),
(2, 'eduardo dos reis fernandes', 121488969, 'detran', '069.801.422-75', '1982-05-11', '(21)1234-5678', '', '21820-090', 'rua ibitiuva', 152, '', 'padre miguel', 'rio de janeiro', 'Rio de Janeiro', ''),
(3, 'joão fernando de siqueira', 121488969, 'detran', '525.634.696-27', '1981-05-01', '(21)5877-8884', '', '21820-090', 'rua ibitiuva', 142, '', 'padre miguel', 'rio de janeiro', 'Rio de Janeiro', ''),
(4, 'leonardo neves de souza', 121488969, 'detran', '112.963.387-03', '1987-08-07', '(21)2404-6967', '(21)8186-6154', '21820-093', 'rua rio da prata', 1904, 'fundos', 'bangu', 'rio de janeiro', 'Rio de Janeiro', 'leo.mvhost@hotmail.com'),
(5, 'jessica da rocha dos santos', 121488969, 'detran', '932.406.724-99', '1983-05-12', '(21)2404-9697', '', '21715-400', 'rua ibitiuva', 152, 'fundos', 'padre miguel', 'rio de janeiro', 'Rio de Janeiro', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `comprapeca`
--

INSERT INTO `comprapeca` (`idcomprapeca`, `idpeca`, `qtd`, `status`, `datapedido`) VALUES
(1, 17, 0, 'aberta', '2012-05-23'),
(2, 11, 0, 'aberta', '2012-05-23');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`idequipamento`, `idcliente`, `idtiposequipamentos`, `marcaequip`, `modeloequip`, `numserie`) VALUES
(1, 4, 4, 'samsung', 'syncmaster 943 bwx', 'my19hqbqa00543h'),
(2, 4, 16, 'philips', 'hds70', 'adfnph70100201'),
(3, 1, 7, 'lg', 'lgscarlet55px', 'lgbrsc45663587'),
(4, 1, 1, 'positivo', 'psmn21', '084303'),
(5, 2, 13, 'samsung', 'ssled21115', 'ssldbr112666658dds445'),
(6, 2, 14, 'tectoy', 'tct454654', '4654541424'),
(7, 2, 17, 'tectoy', 'ht44566', '44544874'),
(8, 5, 11, 'lg', 'lgld1504', 'lgbr645542'),
(9, 5, 16, 'sony', 'soundblaster', 'snsb3320'),
(10, 3, 7, 'booster', 'mx4400', 'br4445778ds44'),
(11, 3, 17, 'cce', 'audio2000', '00000');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`idfornecedor`, `razaosocial`, `nomefantasia`, `cnpj`, `inscest`, `contato`, `telefone`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`) VALUES
(1, 'eletrodex eletrônica me', '', '80.291.990/0001-01', '154.548.789.654', 'thiago correia', '(21)2454-6658', '21200-000', 'Rua do acre', 145, 'loja 3', 'centro', 'rio de janeiro', 'Ri');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`idorcamento`, `idordemdeservico`, `maodeobra`, `valorpecasusadas`, `comentarios`) VALUES
(1, 1, '120.00', '0.00', NULL),
(2, 2, '30.00', '0.00', NULL),
(3, 3, '160.00', '0.00', NULL),
(4, 4, '30.00', '1.50', NULL),
(5, 5, '60.00', '0.00', NULL),
(6, 6, '40.00', '0.00', NULL),
(7, 7, '50.00', '2.00', NULL),
(8, 8, '100.00', '0.00', NULL),
(9, 9, '40.00', '1.90', NULL),
(10, 10, '60.00', '15.20', NULL),
(11, 11, '120.00', '0.00', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `ordemdeservico`
--

INSERT INTO `ordemdeservico` (`idordemdeservico`, `idequipamento`, `idusuario`, `idstatus`, `defeito`, `acompanhamento`, `acessorios`, `solucao`, `entrada`, `iniciomanut`, `fimmanut`, `entrega`, `garantiadeservico`, `caminhoimpressao`) VALUES
(1, 3, 2, 8, 'volume abaixa sozinho.', NULL, 'controle remoto.', 'sujeira travando o botão de diminuir o volume.', '2012-05-23', '2012-05-23', '2012-05-23', NULL, 0, 'impressao/os_1_1337778543.txt'),
(2, 4, 2, 4, 'botão de liga e desliga não funciona.', NULL, '', NULL, '2012-05-23', NULL, NULL, NULL, 0, 'impressao/os_2_1337778599.txt'),
(3, 5, 2, 10, 'não liga.', NULL, 'controle remoto.', 'solda do cabo de energia junto a placa.', '2012-05-23', '2012-05-23', '2012-05-23', '2012-05-23', 0, 'impressao/os_3_1337778665.txt'),
(4, 6, 2, 4, 'não lê mídias.', NULL, 'controle remoto.', NULL, '2012-05-23', NULL, NULL, NULL, 0, 'impressao/os_4_1337778839.txt'),
(5, 7, 2, 4, 'sem áudio.', NULL, '', NULL, '2012-05-23', NULL, NULL, NULL, 0, 'impressao/os_5_1337778897.txt'),
(6, 2, 2, 4, 'radio am/fm não funciona.', NULL, '', NULL, '2012-05-23', NULL, NULL, NULL, 0, 'impressao/os_6_1337779031.txt'),
(7, 1, 2, 7, 'não recebe informação do controle remoto.', NULL, 'controle remoto.', NULL, '2012-05-23', NULL, NULL, NULL, 0, 'impressao/os_7_1337779130.txt'),
(8, 8, NULL, 1, 'sem imagem, apenas com som.', NULL, '', NULL, '2012-05-23', NULL, NULL, NULL, 0, 'impressao/os_8_1337779286.txt'),
(9, 9, 2, 7, 'cd não funciona.', NULL, '', NULL, '2012-05-23', NULL, NULL, NULL, 0, 'impressao/os_9_1337779361.txt'),
(10, 11, 2, 3, 'vinil não funciona.', NULL, '', NULL, '2012-05-23', NULL, NULL, NULL, 0, 'impressao/os_10_1337779441.txt'),
(11, 10, 2, 11, 'entrada av não funciona.', NULL, '', NULL, '2012-05-23', NULL, NULL, NULL, 0, 'impressao/os_11_1337779524.txt');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `idpagos` int(11) NOT NULL AUTO_INCREMENT,
  `idos` int(11) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `valorpago` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`idpagos`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `pagos`
--

INSERT INTO `pagos` (`idpagos`, `idos`, `tipo`, `total`, `valorpago`) VALUES
(1, 3, 3, '160.00', '200.00');

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
  `idfornecedor` int(11) NOT NULL,
  `dataentrada` date NOT NULL,
  PRIMARY KEY (`idpeca`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `peca`
--

INSERT INTO `peca` (`idpeca`, `codigopeca`, `nomepeca`, `marcapeca`, `modelopeca`, `quantidade`, `precounidade`, `idfornecedor`, `dataentrada`) VALUES
(1, 1506400, 'CORREIA AIWA HVTR1', 'AIWA', 'KAW0002', 10, 1, 1, '2012-05-11'),
(2, 1506410, 'CORREIA CCE 74X', 'CCE', 'KCE0002', 9, 1, 0, '2012-05-04'),
(3, 1506412, 'CORREIA CCE9X', 'CCE', 'KCE0003', 10, 1.2, 0, '2012-05-04'),
(4, 1506426, 'CORREIA DAEWOD DVK 525N', 'DAEWOD', 'KDA0001', 10, 1.3, 0, '2012-05-04'),
(5, 1506436, 'CORREIA GRADIENTE SV850', 'GRADIENTE', 'KGD0003', 5, 1, 0, '2012-05-04'),
(6, 1506458, 'CORREIA JVCJ421', 'JVC', 'KJV0002', 10, 1.15, 0, '2012-05-04'),
(7, 1506480, 'CORREIA PHILIPS VR 31', 'PHILIPS', 'KP0003', 5, 1.4, 0, '2012-05-05'),
(8, 191523, 'DIODO MBR 1545', 'BRASIL', 'MBR 1545', 5, 2, 0, '2012-05-05'),
(9, 193372, 'DIODO MBR 3045', 'BRASIL', 'MBR 3045', 4, 1.5, 0, '2012-05-05'),
(10, 195456, 'DIODO MBR 20100 ', 'BRASIL', 'MBR 20100 ', 3, 1.5, 0, '2012-05-05'),
(11, 238015, 'DIODO MBR 735', 'BRASIL', 'MBR 735', 5, 2.9, 0, '2012-05-05'),
(12, 598682, 'DIODO MUR 620 ', 'BRASIL', 'MUR 620 ', 5, 3.1, 0, '2012-05-05'),
(13, 598712, 'DIODO MUR 1100 ', 'BRASIL', 'MUR 1100 ', 4, 5, 0, '2012-05-05'),
(14, 604402, 'DIODO MUR 4100 ', 'BRASIL', 'MUR 4100 ', 5, 1.9, 0, '2012-05-05'),
(15, 1500726, 'FLYBACK TAT 1402A', 'CCE', 'HPS 1465 Z, 1470 B/Z/ZJ, 1485 B/G/ZG, 1490 B/H', 3, 13.95, 0, '2012-05-12'),
(16, 1500730, 'FLYBACK TAT 1405A', 'CCE', 'HPS 14R, 1470 AA/BB/DD/EE, 1480 D/C, 1481 B', 2, 13.95, 0, '2012-05-12'),
(17, 1500732, 'FLYBACK TAT 1406A', 'CCE', 'HPS 1470V, 1481E', 2, 14, 0, '2012-05-12'),
(18, 1500800, 'FLYBACK AT 2078/SO', 'PHILIPS', '14GL 1010,1310,1410 - 16GL 1030,1330, - 20GL 1040,1340,1440', 5, 13.95, 0, '2012-05-12');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `pecasolicitada`
--

INSERT INTO `pecasolicitada` (`idpecasolicitada`, `idos`, `idpeca`, `qtdsolicitada`) VALUES
(1, 10, 3, 1),
(2, 10, 17, 1),
(3, 4, 10, 1),
(4, 9, 14, 1),
(5, 7, 8, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `statusos`
--

CREATE TABLE IF NOT EXISTS `statusos` (
  `idStatus` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`idStatus`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=12 ;

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
(10, 'Finalizada'),
(11, 'Cancelada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipopagamento`
--

CREATE TABLE IF NOT EXISTS `tipopagamento` (
  `idtipopagamento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  `desconto` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipopagamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tipopagamento`
--

INSERT INTO `tipopagamento` (`idtipopagamento`, `tipo`, `desconto`) VALUES
(1, 'C.CRÉDITO', 0),
(2, 'C.DÉBITO', 0),
(3, 'DINHEIRO', 3);

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
  PRIMARY KEY (`id_uf`),
  UNIQUE KEY `sigla` (`sigla`)
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
(2, 'Tecnico', 'tecnico', 'f776097420388ae66ffbbc41b22cd2424ded1b2a', 'tecnico', 'ativo'),
(3, 'Balconista', 'balconista', '038f6a53562e0f81fe7f7302eef6f67e1d3e029c', 'balconista', 'ativo'),
(4, 'Gerente', 'gerente', '4299478c1f474b8b8a8f8069a39be46b2377597e', 'gerente', 'ativo'),
(5, 'Estoquista', 'estoque', '2d211a1072d7779cbdf018f3b530f731b1111809', 'estoquista', 'ativo');
