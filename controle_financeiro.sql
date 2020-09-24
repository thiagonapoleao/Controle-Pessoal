-- --------------------------------------------------------
-- Servidor:                     10.16.0.79
-- Versão do servidor:           10.1.35-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para controle_financeiro
CREATE DATABASE IF NOT EXISTS `controle_financeiro` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `controle_financeiro`;

-- Copiando estrutura para tabela controle_financeiro.cadastro
CREATE TABLE IF NOT EXISTS `cadastro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  `datanasc` varchar(50) DEFAULT NULL,
  `rg` varchar(50) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cep` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela controle_financeiro.cadastro: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cadastro` DISABLE KEYS */;
/*!40000 ALTER TABLE `cadastro` ENABLE KEYS */;

-- Copiando estrutura para tabela controle_financeiro.despesas
CREATE TABLE IF NOT EXISTS `despesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `categoria` text,
  `descricao` varchar(50) DEFAULT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `conta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela controle_financeiro.despesas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `despesas` DISABLE KEYS */;
/*!40000 ALTER TABLE `despesas` ENABLE KEYS */;

-- Copiando estrutura para tabela controle_financeiro.receita
CREATE TABLE IF NOT EXISTS `receita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `conta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela controle_financeiro.receita: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `receita` DISABLE KEYS */;
/*!40000 ALTER TABLE `receita` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
