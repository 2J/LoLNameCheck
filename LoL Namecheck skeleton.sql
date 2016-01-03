CREATE DATABASE  IF NOT EXISTS `lolnamecheck` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lolnamecheck`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: lolnamecheck
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

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
-- Table structure for table `banned_list`
--

DROP TABLE IF EXISTS `banned_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banned_list` (
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `idbanned_list_UNIQUE` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banned_list`
--

LOCK TABLES `banned_list` WRITE;
/*!40000 ALTER TABLE `banned_list` DISABLE KEYS */;
INSERT INTO `banned_list` VALUES ('aatrox'),('ahri'),('akali'),('alistar'),('amumu'),('anivia'),('annie'),('ashe'),('azir'),('blitzcrank'),('brand'),('braum'),('caitlyn'),('cassiopeia'),('chogath'),('corki'),('darius'),('diana'),('draven'),('drmundo'),('elise'),('evelynn'),('ezreal'),('fiddlesticks'),('fiora'),('fizz'),('galio'),('gangplank'),('garen'),('gnar'),('gragas'),('graves'),('hecarim'),('heimerdinger'),('irelia'),('janna'),('jarvan'),('jarvaniv'),('jax'),('jayce'),('jinx'),('kalista'),('karma'),('karthus'),('kassadin'),('katarina'),('kayle'),('kennen'),('khazix'),('kogmaw'),('leblanc'),('leesin'),('leona'),('lissandra'),('lucian'),('lulu'),('lux'),('malphite'),('malzahar'),('maokai'),('masteryi'),('missfortune'),('mordekaiser'),('morgana'),('nami'),('nasus'),('nautilus'),('nidalee'),('nocturne'),('nunu'),('olaf'),('orianna'),('pantheon'),('poppy'),('quinn'),('rammus'),('reksai'),('renekton'),('rengar'),('riven'),('rumble'),('ryze'),('sejuani'),('shaco'),('shen'),('shyvana'),('singed'),('sion'),('sivir'),('skarner'),('sona'),('soraka'),('swain'),('syndra'),('talon'),('taric'),('teemo'),('thresh'),('tristana'),('trundle'),('tryndamere'),('twisted fate'),('twitch'),('udyr'),('urgot'),('varus'),('vayne'),('veigar'),('velkoz'),('vi'),('viktor'),('vladimir'),('volibear'),('warwick'),('wukong'),('xerath'),('xinzhao'),('yasuo'),('yorick'),('zac'),('zed'),('ziggs'),('zilean'),('zyra');
/*!40000 ALTER TABLE `banned_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured`
--

DROP TABLE IF EXISTS `featured`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `featured` (
  `name` varchar(100) NOT NULL,
  `server` varchar(10) NOT NULL DEFAULT 'na',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` varchar(10) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `free_date` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ipaddr` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1210211 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `region_index`
--

DROP TABLE IF EXISTS `region_index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_code` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `timezone` varchar(45) NOT NULL,
  `timezone_code` varchar(45) NOT NULL,
  `regex` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region_index`
--

LOCK TABLES `region_index` WRITE;
/*!40000 ALTER TABLE `region_index` DISABLE KEYS */;
INSERT INTO `region_index` VALUES (1,'na','NA','','','/^[0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz]+$/'),(2,'eune','EUNE','','','/^[0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzàâÇçèÉéÊêëîïÔôœùûĄąĘęÓóĆćŁłŃńŚśŹźŻżÄäÉéÖöÜüßÁáÉéÍíÑñÓóÚúÜüΑαΒβΓγΔδΕεΖζΗηΘθΙιΚκΛλΜμΝνΞξΟοΠπΡρΣσςΤτΥυΦφΧχΨψΩωΆΈΉΊΌΎΏάέήόίύώΪΫϊϋΰΐĂăÂâÎîȘșŞşȚțŢţÀàÈèÉéÌìÍíÒòÓóÙùÚúÁáĄąÄäÉéĘęĚěÍíÓóÔôÚúŮůÝýČčďťĹĺŇňŔŕŘřŠšŽž]+$/'),(3,'euw','EUW','','','/^[0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzàâÇçèÉéÊêëîïÔôœùûĄąĘęÓóĆćŁłŃńŚśŹźŻżÄäÉéÖöÜüßÁáÉéÍíÑñÓóÚúÜüΑαΒβΓγΔδΕεΖζΗηΘθΙιΚκΛλΜμΝνΞξΟοΠπΡρΣσςΤτΥυΦφΧχΨψΩωΆΈΉΊΌΎΏάέήόίύώΪΫϊϋΰΐĂăÂâÎîȘșŞşȚțŢţÀàÈèÉéÌìÍíÒòÓóÙùÚúÁáĄąÄäÉéĘęĚěÍíÓóÔôÚúŮůÝýČčďťĹĺŇňŔŕŘřŠšŽž]+$/'),(4,'br','BR','','','/^[0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzÀÁÂÃÇÉÊÍÓÔÕÚàáâãçéêíóôõú]+$/'),(5,'lan','LAN','','','/^[0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚÜabcdefghijklmnñopqrstuvwxyzáéíóúü]+$/'),(6,'las','LAS','','','/^[0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚÜabcdefghijklmnñopqrstuvwxyzáéíóúü]+$/'),(7,'oce','OCE','','','/^[0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz]+$/'),(8,'ru','RU','','','/^[\\.0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ\\_abcdefghijklmnopqrstuvwxyzАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэю]+$/'),(9,'tr','TR','','','/^[\\.0123456789ABCÇDEFGHIİJKLMNOÖPQRSŞTUÜVWXYZ\\_abcçdefghıijklmnoöpqrsştuüvwxyz]+$/');
/*!40000 ALTER TABLE `region_index` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-09 19:41:11
