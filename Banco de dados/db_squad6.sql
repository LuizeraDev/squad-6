-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 02-Nov-2020 às 20:33
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `db_squad6`
--
CREATE DATABASE IF NOT EXISTS `db_squad6` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_squad6`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sala_santos`
--

CREATE TABLE IF NOT EXISTS `tb_sala_santos` (
  `cd_sala_santos` int(11) NOT NULL AUTO_INCREMENT,
  `nm_responsavel_sala` varchar(110) DEFAULT NULL,
  `nm_sala` varchar(20) DEFAULT NULL,
  `cd_senha_sala` varchar(5) DEFAULT NULL,
  `img_sala` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cd_sala_santos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sala_sao_paulo`
--

CREATE TABLE IF NOT EXISTS `tb_sala_sao_paulo` (
  `cd_sala_sao_paulo` int(11) NOT NULL AUTO_INCREMENT,
  `nm_responsavel_sala` varchar(110) DEFAULT NULL,
  `nm_sala` varchar(20) DEFAULT NULL,
  `cd_senha_sala` varchar(5) DEFAULT NULL,
  `img_sala` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cd_sala_sao_paulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `cd_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(30) DEFAULT NULL,
  `cd_fila_usuario` int(11) DEFAULT NULL,
  `cd_sala_santos` int(11) DEFAULT NULL,
  `cd_sala_sao_paulo` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_usuario`),
  KEY `usuario_sala_santos` (`cd_sala_santos`),
  KEY `usuario_sala_sao_paulo` (`cd_sala_sao_paulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `usuario_sala_santos` FOREIGN KEY (`cd_sala_santos`) REFERENCES `tb_sala_santos` (`cd_sala_santos`),
  ADD CONSTRAINT `usuario_sala_sao_paulo` FOREIGN KEY (`cd_sala_sao_paulo`) REFERENCES `tb_sala_sao_paulo` (`cd_sala_sao_paulo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
