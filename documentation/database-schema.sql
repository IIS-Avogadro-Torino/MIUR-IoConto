-- MySQL dump 10.15  Distrib 10.0.28-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.0.28-MariaDB-0+deb8u1

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
-- Table structure for table `calendario`
--

DROP TABLE IF EXISTS `calendario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendario` (
  `calendario_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calendario_progressivo` int(64) NOT NULL COMMENT 'Se ce ne sono 3 in Torino è 3',
  `calendario_sede` varchar(128) NOT NULL,
  `calendario_indirizzo` varchar(200) NOT NULL,
  `calendario_referente` varchar(128) NOT NULL,
  `calendario_referentetelefono` varchar(64) NOT NULL,
  `modulo_a_esperto` varchar(64) NOT NULL,
  `modulo_a_data` date NOT NULL,
  `modulo_a_ora_inizio` time NOT NULL,
  `modulo_a_ora_fine` time NOT NULL,
  `modulo_b_esperto` varchar(64) NOT NULL,
  `modulo_b_data` date NOT NULL,
  `modulo_b_ora_inizio` time NOT NULL,
  `modulo_b_ora_fine` time NOT NULL,
  `modulo_n_esperto` varchar(64) NOT NULL,
  `modulo_n_data` date NOT NULL,
  `modulo_n_ora_inizio` time NOT NULL,
  `modulo_n_ora_fine` time NOT NULL,
  `provincia_ID` int(10) unsigned NOT NULL,
  `scuola_ID` int(10) unsigned NOT NULL COMMENT 'Scuola polo',
  PRIMARY KEY (`calendario_ID`),
  KEY `scuola_ID` (`scuola_ID`),
  KEY `provincia_ID` (`provincia_ID`),
  KEY `calendario_progressivo` (`calendario_progressivo`),
  CONSTRAINT `calendario_ibfk_2` FOREIGN KEY (`scuola_ID`) REFERENCES `scuola` (`scuola_ID`),
  CONSTRAINT `calendario_ibfk_3` FOREIGN KEY (`provincia_ID`) REFERENCES `provincia` (`provincia_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=323 DEFAULT CHARSET=latin1 COMMENT='Calendario';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `calendarioiscritto`
--

DROP TABLE IF EXISTS `calendarioiscritto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendarioiscritto` (
  `calendarioiscritto_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calendarioiscritto_nome` varchar(64) NOT NULL,
  `calendarioiscritto_cognome` varchar(64) NOT NULL,
  `calendarioiscritto_a` tinyint(4) NOT NULL COMMENT '0 for none',
  `calendarioiscritto_b` tinyint(4) NOT NULL COMMENT '0 for none',
  `calendarioiscritto_n` tinyint(4) NOT NULL COMMENT '0 for none',
  `calendario_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`calendarioiscritto_ID`),
  KEY `corso_ID` (`calendario_ID`),
  CONSTRAINT `calendarioiscritto_ibfk_1` FOREIGN KEY (`calendario_ID`) REFERENCES `calendario` (`calendario_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82110 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comune`
--

DROP TABLE IF EXISTS `comune`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comune` (
  `comune_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comune_old_ID` int(10) unsigned NOT NULL,
  `comune_uid` varchar(32) NOT NULL,
  `comune_name` varchar(32) NOT NULL,
  `provincia_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`comune_ID`),
  UNIQUE KEY `comune_uid` (`comune_uid`),
  KEY `provincia_ID` (`provincia_ID`),
  CONSTRAINT `comune_ibfk_1` FOREIGN KEY (`provincia_ID`) REFERENCES `provincia` (`provincia_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3155 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comune_old`
--

DROP TABLE IF EXISTS `comune_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comune_old` (
  `comune_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comune_nome` varchar(32) NOT NULL,
  PRIMARY KEY (`comune_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=40259 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `movimento`
--

DROP TABLE IF EXISTS `movimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimento` (
  `movimento_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `movimento_type` enum('ENTRATA','USCITA_COMPENSO_ESPERTO','USCITA_SPESE_MISSIONE','USCITA_SPESE_SEGRETERIA','USCITA_ALTRO') NOT NULL,
  `movimento_importo` float(6,2) NOT NULL,
  `movimento_documento_contabile_numero` int(11) NOT NULL COMMENT 'CMSV / Reversale',
  `movimento_data` date NOT NULL,
  `movimento_description` text,
  `scuola_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`movimento_ID`),
  KEY `scuola_ID` (`scuola_ID`),
  CONSTRAINT `movimento_ibfk_1` FOREIGN KEY (`scuola_ID`) REFERENCES `scuola` (`scuola_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
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
  `organico_nomeold` varchar(25) NOT NULL,
  `organico_cognome` varchar(25) NOT NULL,
  `organico_cognomeold` varchar(25) NOT NULL,
  `organico_cf` varchar(18) DEFAULT NULL,
  `organico_cfold` varchar(18) DEFAULT NULL,
  `organico_mail` varchar(45) DEFAULT NULL,
  `organico_token` varchar(44) DEFAULT NULL,
  `organico_lastedit` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `organico_ruolo` enum('DS','DS_EFFETTIVO','DS_REGGENZA','DSGA','DSGA_TITOLARE','DSGA_UTILIZZATO','EX_DS') NOT NULL,
  `organico_note` text,
  `scuola_ID` int(10) unsigned NOT NULL,
  `scuola_IDold` int(10) unsigned NOT NULL,
  PRIMARY KEY (`organico_ID`),
  KEY `scuola_ID` (`scuola_ID`),
  KEY `ruolo` (`organico_ruolo`),
  KEY `scuola_IDnew` (`scuola_IDold`),
  CONSTRAINT `organico_ibfk_1` FOREIGN KEY (`scuola_ID`) REFERENCES `scuola` (`scuola_ID`),
  CONSTRAINT `organico_ibfk_2` FOREIGN KEY (`scuola_IDold`) REFERENCES `scuola` (`scuola_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=190321 DEFAULT CHARSET=latin1 COMMENT='Persone che lavorano nella scuola';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `organico_prenotato`
--

DROP TABLE IF EXISTS `organico_prenotato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organico_prenotato` (
  `organico_ID` int(10) unsigned NOT NULL DEFAULT '0',
  `scuola_polo_ID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`organico_ID`),
  KEY `scuola_polo_ID` (`scuola_polo_ID`),
  CONSTRAINT `organico_prenotato_ibfk_1` FOREIGN KEY (`organico_ID`) REFERENCES `organico` (`organico_ID`) ON DELETE CASCADE,
  CONSTRAINT `organico_prenotato_ibfk_2` FOREIGN KEY (`scuola_polo_ID`) REFERENCES `scuola` (`scuola_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `provincia_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provincia_name` varchar(32) NOT NULL,
  `provincia_uid` varchar(2) NOT NULL,
  `regione_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`provincia_ID`),
  KEY `regione_ID` (`regione_ID`),
  CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`regione_ID`) REFERENCES `regione` (`regione_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1577 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `regione`
--

DROP TABLE IF EXISTS `regione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regione` (
  `regione_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regione_uid` varchar(32) CHARACTER SET utf8 NOT NULL,
  `regione_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`regione_ID`),
  UNIQUE KEY `regione_uid` (`regione_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `regione_old`
--

DROP TABLE IF EXISTS `regione_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regione_old` (
  `regione_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regione_nome` varchar(16) NOT NULL,
  PRIMARY KEY (`regione_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3946 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rel_user_usergroup`
--

DROP TABLE IF EXISTS `rel_user_usergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rel_user_usergroup` (
  `user_ID` int(10) unsigned NOT NULL,
  `usergroup_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_ID`,`usergroup_ID`),
  KEY `usergroup_ID` (`usergroup_ID`),
  CONSTRAINT `rel_user_usergroup_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE,
  CONSTRAINT `rel_user_usergroup_ibfk_2` FOREIGN KEY (`usergroup_ID`) REFERENCES `usergroup` (`usergroup_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rendiconto762`
--

DROP TABLE IF EXISTS `rendiconto762`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rendiconto762` (
  `rendiconto_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rendiconto_readonly` enum('0','1') NOT NULL DEFAULT '0',
  `rendiconto_protocollo` varchar(32) NOT NULL,
  `rendiconto_impegno` float(7,2) NOT NULL,
  `rendiconto_importo_totale_extra_description` text,
  `rendiconto_importo_totale_1` float(7,2) NOT NULL,
  `rendiconto_importo_totale_2` float(7,2) NOT NULL,
  `rendiconto_importo_totale_3` float(7,2) NOT NULL,
  `rendiconto_importo_totale_vinci` float(7,2) NOT NULL,
  `rendiconto_importo_totale_extra` float(7,2) NOT NULL,
  `rendiconto_revisore` varchar(64) NOT NULL,
  `scuola_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`rendiconto_ID`),
  KEY `scuola_ID` (`scuola_ID`),
  CONSTRAINT `rendiconto762_ibfk_1` FOREIGN KEY (`scuola_ID`) REFERENCES `scuola` (`scuola_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rendiconto821`
--

DROP TABLE IF EXISTS `rendiconto821`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rendiconto821` (
  `rendiconto_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rendiconto_readonly` enum('0','1') NOT NULL DEFAULT '0',
  `rendiconto_protocollo` varchar(32) NOT NULL,
  `rendiconto_impegno` float(7,2) NOT NULL,
  `rendiconto_description` varchar(256) NOT NULL,
  `rendiconto_importo_extra_description` text,
  `rendiconto_importo_pagato_1` float(7,2) NOT NULL,
  `rendiconto_importo_pagato_2` float(7,2) NOT NULL,
  `rendiconto_importo_pagato_3` float(7,2) NOT NULL,
  `rendiconto_importo_pagato_leonardo` float(7,2) NOT NULL,
  `rendiconto_importo_pagato_extra` float(7,2) NOT NULL,
  `rendiconto_importo_impegnato_1` float(7,2) NOT NULL,
  `rendiconto_importo_impegnato_2` float(7,2) NOT NULL,
  `rendiconto_importo_impegnato_3` float(7,2) NOT NULL,
  `rendiconto_importo_impegnato_leonardo` float(7,2) NOT NULL,
  `rendiconto_importo_impegnato_extra` float(7,2) NOT NULL,
  `rendiconto_edizioni_previste` int(11) NOT NULL,
  `rendiconto_edizioni_realizzate` int(11) NOT NULL,
  `rendiconto_edizioni_realizzare` int(11) NOT NULL,
  `rendiconto_revisore` varchar(64) NOT NULL,
  `scuola_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`rendiconto_ID`),
  KEY `scuola_ID` (`scuola_ID`),
  CONSTRAINT `rendiconto821_ibfk_1` FOREIGN KEY (`scuola_ID`) REFERENCES `scuola` (`scuola_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
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
  `scuola_polo_responsabile_nome` varchar(32) DEFAULT NULL,
  `scuola_polo_responsabile_cognome` varchar(32) DEFAULT NULL,
  `scuola_polo_responsabile_email` varchar(254) DEFAULT NULL,
  `scuola_polo_responsabile_telefono` varchar(32) DEFAULT NULL,
  `scuola_codice_fiscale` varchar(11) DEFAULT NULL,
  `scuola_tesoreria_codice` varchar(3) DEFAULT NULL,
  `scuola_tesoreria_conto` int(11) DEFAULT NULL,
  `scuola_ambiti_provinciali` text,
  `scuola_numero_corsisti_teorico` int(11) DEFAULT NULL,
  `scuola_voip_type` enum('EKIGA','SKYPE') DEFAULT NULL,
  `scuola_voip_value` varchar(254) DEFAULT NULL,
  `comune_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`scuola_ID`),
  KEY `scuola_polo` (`scuola_polo`),
  KEY `comune_ID` (`comune_ID`),
  CONSTRAINT `scuola_ibfk_1` FOREIGN KEY (`comune_ID`) REFERENCES `comune` (`comune_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=99580 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_active` enum('0','1') NOT NULL,
  `user_role` enum('MANAGE_SINGLE_POLE_SCHOOL','MANAGE_POLE_SCHOOLS') NOT NULL,
  `user_uid` varchar(64) NOT NULL COMMENT 'Meccanografico',
  `user_email` varchar(128) NOT NULL COMMENT 'Email scuola',
  `user_password` varchar(40) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `scuola_ID` int(10) unsigned DEFAULT NULL COMMENT 'What shool this user manage',
  PRIMARY KEY (`user_ID`),
  UNIQUE KEY `user_login` (`user_uid`),
  UNIQUE KEY `user_email` (`user_email`),
  KEY `scuola_ID` (`scuola_ID`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`scuola_ID`) REFERENCES `scuola` (`scuola_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usergroup`
--

DROP TABLE IF EXISTS `usergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usergroup` (
  `usergroup_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usergroup_name` varchar(32) NOT NULL,
  PRIMARY KEY (`usergroup_ID`)
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

-- Dump completed on 2017-02-17 15:11:35
