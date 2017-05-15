-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: mysql.itisavogadro.org    Database: ioconto
-- ------------------------------------------------------
-- Server version	5.6.34-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comune`
--

DROP TABLE IF EXISTS `comune`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comune` (
  `comune_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comune_nome` varchar(32) NOT NULL,
  PRIMARY KEY (`comune_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `curriculum`
--

DROP TABLE IF EXISTS `curriculum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curriculum` (
  `organico_ID` int(10) unsigned NOT NULL,
  `curriculum_surname` varchar(40) NOT NULL,
  `curriculum_name` varchar(40) NOT NULL,
  `curriculum_role` enum('ds','dsga') NOT NULL,
  `curriculum_status` enum('titolare','reggente','altro') NOT NULL,
  `curriculum_city` varchar(40) NOT NULL,
  `curriculum_cap` varchar(5) NOT NULL,
  `curriculum_phone` varchar(40) NOT NULL,
  `curriculum_email` varchar(40) NOT NULL,
  `curriculum_years` enum('5','10','15','20') NOT NULL COMMENT 'Anni di anzianità di servizio continuativi nel ruolo di DS o DSGA',
  `curriculum_years_desc` text NOT NULL,
  `curriculum_study` enum('3','5','8','10','15') NOT NULL COMMENT 'Titolo di studio',
  `curriculum_study_desc` text NOT NULL,
  `curriculum_courses_followed` enum('0','2','4','6','8','10') NOT NULL COMMENT 'N. corsi di formazione seguiti in qualità di discente su tematiche attinenti alle materie amministrativo contabili (Bilancio, obblighi normativi, acquisizione di beni e servizi)',
  `curriculum_courses_followed_desc` text NOT NULL,
  `curriculum_publications` enum('0','3','5','10') NOT NULL COMMENT 'N. pubblicazioni su tematiche attinenti alle materie del percorso di aggiornamento professionale Io Conto',
  `curriculum_publications_desc` text NOT NULL,
  `curriculum_coursesorganized_specialized` enum('0','5','10','15','20') NOT NULL COMMENT 'N. corsi di formazione organizzati e/o erogati in qualità di docente su tematiche attinenti alle materie amministrativo contabili (Bilancio, obblighi normativi, acquisizione di beni e servizi)',
  `curriculum_coursesorganized_specialized_desc` text NOT NULL,
  `curriculum_coursesorganized_generic` enum('0','4','6','8','10') NOT NULL COMMENT 'N. corsi di formazione organizzati e/o erogati in qualità di docente su tematiche NON attinenti alle materie attinenti alle materie amministrativo contabili (Bilancio, obblighi normativi, acquisizione di beni e servizi)',
  `curriculum_coursesorganized_generic_desc` text NOT NULL,
  `curriculum_usrmiurtasks` enum('3','5') NOT NULL COMMENT 'incarichi ispettivi per conto USR / MIUR',
  `curriculum_usrmiurtasks_desc` text NOT NULL,
  `curriculum_regionaltask` enum('3','5') NOT NULL COMMENT 'E40 appartenenza a gruppi di lavoro istituzionali regionali e/o centrali gruppo di lavoro, cabine di regia, comitati paritetici (indicare nome ed estremi)',
  `curriculum_regionaltask_desc` text NOT NULL,
  `curriculum_nationaltask` enum('3','5') NOT NULL,
  `curriculum_nationaltask_desc` text NOT NULL,
  `curriculum_ecdl` tinyint(1) NOT NULL,
  `curriculum_expertioconto` tinyint(1) NOT NULL,
  PRIMARY KEY (`organico_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `option`
--

DROP TABLE IF EXISTS `option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option` (
  `option_name` varchar(32) NOT NULL,
  `option_value` text NOT NULL,
  `option_autoload` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`option_name`),
  KEY `option_autoload` (`option_autoload`) COMMENT 'To speed up filtering by autoload'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Associative informations';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `organico`
--

DROP TABLE IF EXISTS `organico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organico` (
  `organico_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organico_nome` varchar(25) NOT NULL,
  `organico_cognome` varchar(25) NOT NULL,
  `organico_ruolo` enum('DS','DSGA') NOT NULL,
  `scuola_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`organico_ID`),
  KEY `scuola_ID` (`scuola_ID`),
  KEY `ruolo` (`organico_ruolo`),
  CONSTRAINT `organico_ibfk_1` FOREIGN KEY (`scuola_ID`) REFERENCES `2017_scuola` (`scuola_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Persone che lavorano nella scuola';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `provincia_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provincia_nome` varchar(32) NOT NULL,
  `provincia_uid` varchar(2) NOT NULL,
  PRIMARY KEY (`provincia_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `regione`
--

DROP TABLE IF EXISTS `regione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regione` (
  `regione_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regione_nome` varchar(16) NOT NULL,
  PRIMARY KEY (`regione_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `scuola`
--

DROP TABLE IF EXISTS `scuola`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scuola` (
  `scuola_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scuola_meccanografico` varchar(11) NOT NULL,
  `scuola_nome` varchar(128) NOT NULL,
  `scuola_email` varchar(32) DEFAULT NULL,
  `scuola_telefono` varchar(32) DEFAULT NULL,
  `scuola_indirizzo` varchar(128) DEFAULT NULL,
  `scuola_sededir` enum('0','1') DEFAULT NULL,
  `scuola_polo` tinyint(4) NOT NULL DEFAULT '0',
  `scuola_codice_fiscale` varchar(11) DEFAULT NULL,
  `comune_ID` int(10) unsigned NOT NULL,
  `provincia_ID` int(10) unsigned NOT NULL,
  `regione_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`scuola_ID`),
  KEY `comune_ID` (`comune_ID`),
  KEY `provincia_ID` (`provincia_ID`),
  KEY `regione_ID` (`regione_ID`),
  KEY `scuola_polo` (`scuola_polo`),
  CONSTRAINT `scuola_ibfk_1` FOREIGN KEY (`comune_ID`) REFERENCES `2017_comune` (`comune_ID`),
  CONSTRAINT `scuola_ibfk_2` FOREIGN KEY (`provincia_ID`) REFERENCES `2017_provincia` (`provincia_ID`),
  CONSTRAINT `scuola_ibfk_3` FOREIGN KEY (`regione_ID`) REFERENCES `2017_regione` (`regione_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_active` tinyint(1) NOT NULL,
  `user_role` enum('user','supervisor','admin') NOT NULL,
  `user_uid` varchar(64) NOT NULL COMMENT 'Meccanografico',
  `user_firm` enum('ds','dsga') NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_email_official` varchar(64) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `scuola_ID` int(10) unsigned DEFAULT NULL COMMENT 'is related to a school?',
  `organico_ID` int(10) unsigned DEFAULT NULL,
  `user_token` varchar(40) NOT NULL,
  PRIMARY KEY (`user_ID`),
  UNIQUE KEY `user_uid` (`user_uid`) USING BTREE,
  UNIQUE KEY `organico_ID` (`organico_ID`),
  KEY `scuola_ID` (`scuola_ID`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`scuola_ID`) REFERENCES `2017_scuola` (`scuola_ID`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`organico_ID`) REFERENCES `2017_organico` (`organico_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-15  8:27:55
