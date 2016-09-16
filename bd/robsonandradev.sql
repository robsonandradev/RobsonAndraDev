-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.15-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para robsonandradev
DROP DATABASE IF EXISTS `robsonandradev`;
CREATE DATABASE IF NOT EXISTS `robsonandradev` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `robsonandradev`;


-- Copiando estrutura para tabela robsonandradev.article
DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `idarticle` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `text` longtext NOT NULL,
  `publicdate` varchar(10) NOT NULL,
  PRIMARY KEY (`idarticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela robsonandradev.article: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;


-- Copiando estrutura para tabela robsonandradev.aticletag
DROP TABLE IF EXISTS `aticletag`;
CREATE TABLE IF NOT EXISTS `aticletag` (
  `idarttag` int(11) NOT NULL AUTO_INCREMENT,
  `article` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`idarttag`),
  KEY `FK_ARTICLE` (`article`),
  KEY `FK_TAG` (`tag`),
  CONSTRAINT `FK_TAG` FOREIGN KEY (`tag`) REFERENCES `tag` (`idtag`),
  CONSTRAINT `FK_ARTICLE` FOREIGN KEY (`article`) REFERENCES `article` (`idarticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela robsonandradev.aticletag: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `aticletag` DISABLE KEYS */;
/*!40000 ALTER TABLE `aticletag` ENABLE KEYS */;


-- Copiando estrutura para tabela robsonandradev.tag
DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `idtag` int(11) NOT NULL AUTO_INCREMENT,
  `nametag` varchar(100) NOT NULL,
  PRIMARY KEY (`idtag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela robsonandradev.tag: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
