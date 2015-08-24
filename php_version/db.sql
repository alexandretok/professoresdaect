-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db577241071.db.1and1.com
-- Generation Time: Jul 04, 2015 at 02:35 PM
-- Server version: 5.1.73-log
-- PHP Version: 5.4.41-0+deb7u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db577241071`
--

-- --------------------------------------------------------

--
-- Table structure for table `depoimento`
--

CREATE TABLE IF NOT EXISTS `depoimento` (
  `id_depoimento` int(11) NOT NULL AUTO_INCREMENT,
  `id_professor` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL DEFAULT 'Anônimo',
  `id_disciplina` varchar(10) DEFAULT NULL,
  `depoimento` text NOT NULL,
  `aprovado` int(11) NOT NULL DEFAULT '0',
  `up` int(11) NOT NULL DEFAULT '0',
  `down` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_depoimento`),
  KEY `fk_depoimento_professor1_idx` (`id_professor`),
  KEY `id_disciplina` (`id_disciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1628 ;

-- --------------------------------------------------------

--
-- Table structure for table `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `id_disciplina` varchar(10) NOT NULL,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_disciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `id_professor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `aprovado` int(11) NOT NULL DEFAULT '0',
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_professor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=149 ;

-- --------------------------------------------------------

--
-- Table structure for table `professor_disciplina`
--

CREATE TABLE IF NOT EXISTS `professor_disciplina` (
  `id_professor` int(11) NOT NULL,
  `id_disciplina` varchar(10) NOT NULL,
  KEY `id_disciplina` (`id_disciplina`),
  KEY `id_professor` (`id_professor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sugestoes`
--

CREATE TABLE IF NOT EXISTS `sugestoes` (
  `sugestao` text NOT NULL,
  `id_sugestao` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_sugestao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `voto`
--

CREATE TABLE IF NOT EXISTS `voto` (
  `id_voto` int(11) NOT NULL AUTO_INCREMENT,
  `id_professor` int(11) NOT NULL,
  `voto` int(1) NOT NULL,
  `ip` varchar(45) NOT NULL,
  PRIMARY KEY (`id_voto`),
  KEY `fk_voto_professor1_idx` (`id_professor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3970 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `depoimento`
--
ALTER TABLE `depoimento`
  ADD CONSTRAINT `depoimento_ibfk_1` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_depoimento_professor1` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  ADD CONSTRAINT `professor_disciplina_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `professor_disciplina_ibfk_3` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `fk_voto_professor1` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
