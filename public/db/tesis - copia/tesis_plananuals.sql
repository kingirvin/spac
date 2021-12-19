-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: tesis
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `plananuals`
--

DROP TABLE IF EXISTS `plananuals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `plananuals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `docente` text,
  `nombre_ie` text,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nivels_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `users_personas_id` int(11) NOT NULL,
  `grados_id` int(11) NOT NULL,
  `seccions_id` int(11) NOT NULL,
  `periodos_id` int(11) NOT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_planAnual_nivels1_idx` (`nivels_id`),
  KEY `fk_planAnual_users1_idx` (`users_id`,`users_personas_id`),
  KEY `fk_planAnual_grados1_idx` (`grados_id`),
  KEY `fk_planAnual_seccions1_idx` (`seccions_id`),
  KEY `fk_planAnual_periodos1_idx` (`periodos_id`),
  CONSTRAINT `fk_planAnual_grados1` FOREIGN KEY (`grados_id`) REFERENCES `grados` (`id`),
  CONSTRAINT `fk_planAnual_nivels1` FOREIGN KEY (`nivels_id`) REFERENCES `nivels` (`id`),
  CONSTRAINT `fk_planAnual_periodos1` FOREIGN KEY (`periodos_id`) REFERENCES `periodos` (`id`),
  CONSTRAINT `fk_planAnual_seccions1` FOREIGN KEY (`seccions_id`) REFERENCES `seccions` (`id`),
  CONSTRAINT `fk_planAnual_users1` FOREIGN KEY (`users_id`, `users_personas_id`) REFERENCES `users` (`id`, `personas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plananuals`
--

LOCK TABLES `plananuals` WRITE;
/*!40000 ALTER TABLE `plananuals` DISABLE KEYS */;
INSERT INTO `plananuals` VALUES (37,'primer planjjjj','Irvin Contrerasr',NULL,' ','2021-09-18 18:46:06','2021-09-22 04:01:58',1,1,1,4,6,1,'18/09/2021'),(38,'plan 3','Irvin Contrerasr',NULL,' ','2021-09-29 17:33:08','2021-09-29 17:33:08',1,1,1,1,1,2,'29/09/2021'),(39,'pla 4','Irvin Contrerasr',NULL,' ','2021-10-02 16:13:55','2021-10-02 16:13:55',1,1,1,1,1,1,'02/10/2021');
/*!40000 ALTER TABLE `plananuals` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-03 19:29:52
