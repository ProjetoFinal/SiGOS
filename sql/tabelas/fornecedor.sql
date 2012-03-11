CREATE TABLE  `sigos`.`fornecedor` (
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1
