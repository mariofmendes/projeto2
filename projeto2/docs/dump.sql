-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para db_inventario_projeto
CREATE DATABASE IF NOT EXISTS `db_inventario_projeto` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_inventario_projeto`;


-- Copiando estrutura para tabela db_inventario_projeto.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(50) NOT NULL,
  `sobrenome_usuario` varchar(100) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `senha_usuario` varchar(32) NOT NULL,
  `nivel_usuario` enum('1','2','3') NOT NULL,
  `telefone_usuario` char(10) NOT NULL,
  `celular_usuario` char(11) NOT NULL,
  `cpf_usuario` char(11) NOT NULL,
  `data_cadastro` date NOT NULL COMMENT 'Data que o usuário foi cadastrado',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `email_usuario` (`email_usuario`),
  UNIQUE KEY `cpf_usuario` (`cpf_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_inventario_projeto.usuario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idusuario`, `nome_usuario`, `sobrenome_usuario`, `email_usuario`, `senha_usuario`, `nivel_usuario`, `telefone_usuario`, `celular_usuario`, `cpf_usuario`, `data_cadastro`) VALUES
	(6, 'adm', 'adm', 'adm@gmail.com', '25d55ad283aa400af464c76d713c07ad', '1', '2133334444', '21555888999', '91447031040', '2019-05-14'),
	(7, 'Caio', 'Santos', 'caio@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2', '2133334444', '21555888999', '95352406091', '2019-05-14'),
	(8, 'Mario', 'Sergio', 'mario@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2', '2133334444', '21555888999', '09920128058', '2019-05-14'),
	(9, 'Thiago', 'Viana', 'thiago@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2', '2133334444', '21555888999', '76241966030', '2019-05-14');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
