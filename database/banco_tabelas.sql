-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.33 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para titansoftware
CREATE DATABASE IF NOT EXISTS `titansoftware` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `titansoftware`;

-- Copiando estrutura para tabela titansoftware.precos
CREATE TABLE IF NOT EXISTS `precos` (
  `id_preco` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `preco` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id_preco`) USING BTREE,
  KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela titansoftware.precos: ~23 rows (aproximadamente)
/*!40000 ALTER TABLE `precos` DISABLE KEYS */;
INSERT INTO `precos` (`id_preco`, `prod_id`, `preco`) VALUES
	(1, 1, 7.50),
	(2, 2, 899.00),
	(3, 3, 899.00),
	(7, 7, 79.90),
	(8, 8, 2499.00),
	(9, 9, 2593.00),
	(10, 10, 299.00),
	(11, 11, 239.00),
	(12, 12, 1078.80),
	(13, 13, 778.80),
	(14, 14, 499.00),
	(15, 15, 119.00),
	(17, 17, 119.90),
	(18, 18, 999000.00),
	(19, 19, 159.00),
	(20, 20, 3599.00),
	(21, 21, 47.00),
	(22, 22, 18.89),
	(23, 23, 19.79),
	(24, 24, 39.90),
	(25, 25, 39.90),
	(26, 26, 33.90),
	(27, 27, 5.99);
/*!40000 ALTER TABLE `precos` ENABLE KEYS */;

-- Copiando estrutura para tabela titansoftware.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_prod` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` char(50) DEFAULT NULL,
  `cor` char(20) DEFAULT NULL,
  PRIMARY KEY (`id_prod`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela titansoftware.produtos: ~23 rows (aproximadamente)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` (`id_prod`, `nome`, `cor`) VALUES
	(1, 'Roupeiro 6 Portas Paris 2', 'amarelo'),
	(2, 'Sofá de 2 e 3 Lugares', 'vermelho'),
	(3, 'Cama Unibox Casal', 'azul'),
	(7, 'Ferro a Seco', 'azul'),
	(8, 'PS4', 'vermelho'),
	(9, 'PS5', 'azul'),
	(10, 'Batedeira Philco', 'azul'),
	(11, 'Liquidificador Philco', 'vermelho'),
	(12, 'Bicicleta A-24', 'azul'),
	(13, 'Bicicleta A-20', 'vermelho'),
	(14, 'Fritadeira Mallory', 'azul'),
	(15, 'Cafeteira Elétrica Britânia', 'azul'),
	(17, 'Secador de Cabelo', 'vermelho'),
	(18, 'Casa de Luxo', 'azul'),
	(19, 'Liquidificador Diamante Britânia', 'amarelo'),
	(20, 'Roupeiro 3 Portas deCorrer', 'amarelo'),
	(21, 'Caixa de Pirulito Pop', 'vermelho'),
	(22, 'Carvão Mascote Vegetal 5KG', 'vermelho'),
	(23, 'Arroz Campeiro Tipo l - 5KG', 'amarelo'),
	(24, 'Azeiteiro Aço Inox e Vidro Parma 500ml', 'amarelo'),
	(25, 'Azeiteiro Aço Inox e Vidro Parma 500ml', 'amarelo'),
	(26, 'Hambúrguer Congelado', 'azul'),
	(27, 'Banana', 'amarelo');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
