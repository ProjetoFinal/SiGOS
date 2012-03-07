-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 05, 2012 as 09:07 PM
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
-- Estrutura da tabela `cartao`
--

CREATE TABLE IF NOT EXISTS `cartao` (
  `idCartao` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idPagamento` int(11) unsigned NOT NULL,
  `parcelamento` int(11) unsigned NOT NULL,
  `bandeira` varchar(255) NOT NULL,
  `tipoCartao` varchar(255) NOT NULL,
  PRIMARY KEY (`idCartao`),
  KEY `idPagamento` (`idPagamento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `cartao`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `cheque`
--

CREATE TABLE IF NOT EXISTS `cheque` (
  `idCheque` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idPagamento` int(11) unsigned NOT NULL,
  `numeroCheque` varchar(255) NOT NULL,
  `parcelamento` int(11) unsigned NOT NULL,
  `valorParcela` double NOT NULL,
  `dataParcela` date NOT NULL,
  `agencia` int(11) unsigned NOT NULL,
  `conta` int(11) unsigned NOT NULL,
  `banco` int(11) unsigned NOT NULL,
  PRIMARY KEY (`idCheque`),
  KEY `idPagamento` (`idPagamento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `cheque`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome`, `identidade`, `orgaoexpedidor`, `cpf`, `nascimento`, `telefone`, `celular`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `email`) VALUES
(1, 'Leonardo Neves', 121488969, 'DETRAN', '112.963.387-03', '2012-03-08', '(21)3331-5441', '', '21820-090', 'Rio da Prata', 1904, '', 'Bangu', 'Rio de janeiro', 'Rio de Janeiro', ''),
(2, 'Carlos Adean', 2147483647, 'IFP', '054.495.587-08', '1981-03-03', '(21)8689-4532', '', '21765-030', 'Rua Ibitiuva', 10, '', 'Realengo', 'Rio de Janeiro', 'Rio de Janeiro', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `idCompra` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idFornecedor` int(10) unsigned NOT NULL,
  `idPeca` int(11) unsigned NOT NULL,
  `dataCompra` date NOT NULL,
  `valorCompra` double NOT NULL,
  `notaFiscal` int(11) unsigned NOT NULL,
  PRIMARY KEY (`idCompra`),
  KEY `idPeca` (`idPeca`),
  KEY `idFornecedor` (`idFornecedor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `compra`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE IF NOT EXISTS `equipamento` (
  `idEquipamento` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) unsigned NOT NULL,
  `marcaEquip` varchar(255) NOT NULL,
  `modeloEquip` varchar(255) NOT NULL,
  `tipoEquip` varchar(255) NOT NULL,
  `numSerie` varchar(255) NOT NULL,
  PRIMARY KEY (`idEquipamento`),
  KEY `idCliente` (`idCliente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `equipamento`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `idFornecedor` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `razaoSocial` varchar(100) NOT NULL,
  `nomeFantasia` varchar(100) DEFAULT NULL,
  `cnpj` int(15) unsigned NOT NULL,
  `inscEst` int(11) unsigned NOT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `cep` int(9) unsigned NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` int(11) unsigned NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  PRIMARY KEY (`idFornecedor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `fornecedor`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `idFuncionario` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) unsigned NOT NULL,
  `idPessoa` int(11) unsigned NOT NULL,
  `dataAdmissao` date NOT NULL,
  `dataDemissao` date NOT NULL,
  `matricula` int(11) unsigned NOT NULL,
  `funcao` varchar(255) NOT NULL,
  PRIMARY KEY (`idFuncionario`),
  KEY `idPessoa` (`idPessoa`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `funcionario`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `listadepreco`
--

CREATE TABLE IF NOT EXISTS `listadepreco` (
  `idListadePreco` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `valorMaodeObra` double NOT NULL,
  `dataVigencia` date NOT NULL,
  `segmento` varchar(255) NOT NULL,
  PRIMARY KEY (`idListadePreco`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `listadepreco`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE IF NOT EXISTS `orcamento` (
  `idOrcamento` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idListadePreco` int(11) unsigned NOT NULL,
  `dataOrcamento` date NOT NULL,
  `obs` text NOT NULL,
  `valor` double NOT NULL,
  `dataAprovacao` date NOT NULL,
  `statusOrcamento` varchar(255) NOT NULL,
  PRIMARY KEY (`idOrcamento`),
  KEY `idListadePreco` (`idListadePreco`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `orcamento`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `ordemdeservico`
--

CREATE TABLE IF NOT EXISTS `ordemdeservico` (
  `idOrdemdeServico` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(11) unsigned NOT NULL,
  `idOrcamento` int(11) unsigned NOT NULL,
  `idFuncionario` int(11) unsigned NOT NULL,
  `idCliente` int(11) unsigned NOT NULL,
  `idStatus` int(11) NOT NULL,
  `defeitoReclamado` text NOT NULL,
  `acessorios` text NOT NULL,
  `solucao` text NOT NULL,
  `dataEntrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataInicioManut` date NOT NULL,
  `dataFimManut` date NOT NULL,
  `dataEntrega` date NOT NULL,
  `garantiadeServico` tinyint(1) NOT NULL,
  PRIMARY KEY (`idOrdemdeServico`),
  KEY `idCliente` (`idCliente`),
  KEY `idOrcamento` (`idOrcamento`),
  KEY `idEquipamento` (`idEquipamento`),
  KEY `idFuncionario` (`idFuncionario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `ordemdeservico`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE IF NOT EXISTS `pagamento` (
  `idPagamento` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idOrdemdeServico` int(11) unsigned NOT NULL,
  `dataPagamento` date NOT NULL,
  `formaPagamento` varchar(255) NOT NULL,
  `valorPagamento` double NOT NULL,
  PRIMARY KEY (`idPagamento`),
  KEY `idOrdemdeServico` (`idOrdemdeServico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `pagamento`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `peca`
--

CREATE TABLE IF NOT EXISTS `peca` (
  `idPeca` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codigoPeca` int(11) unsigned NOT NULL,
  `nomePeca` varchar(255) NOT NULL,
  `marcaPeca` varchar(255) NOT NULL,
  `modeloPeca` varchar(255) NOT NULL,
  `quantidade` int(11) unsigned NOT NULL,
  `precoUnidade` double NOT NULL,
  `dataEntrada` date NOT NULL,
  PRIMARY KEY (`idPeca`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `peca`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `pecasolicitada`
--

CREATE TABLE IF NOT EXISTS `pecasolicitada` (
  `idPecaSolicitada` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idOrdemdeServico` int(11) unsigned NOT NULL,
  `idPeca` int(11) unsigned NOT NULL,
  `qtdSolicitada` int(11) unsigned NOT NULL,
  `posicao` varchar(255) NOT NULL,
  PRIMARY KEY (`idPecaSolicitada`),
  KEY `idPeca` (`idPeca`),
  KEY `idOrdemdeServico` (`idOrdemdeServico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `pecasolicitada`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `statusos`
--

CREATE TABLE IF NOT EXISTS `statusos` (
  `idStatus` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`idStatus`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci' AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `statusos`
--


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
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` varchar(255) NOT NULL,
  `statusUsuario` int(11) unsigned NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `usuario`
--

