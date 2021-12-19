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
-- Table structure for table `unidadesplans`
--

DROP TABLE IF EXISTS `unidadesplans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `unidadesplans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unidads_id` int(11) NOT NULL,
  `planAnual_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_unidadesPlans_unidads1_idx` (`unidads_id`),
  KEY `fk_unidadesPlans_planAnual1_idx` (`planAnual_id`),
  CONSTRAINT `fk_unidadesPlans_planAnual1` FOREIGN KEY (`planAnual_id`) REFERENCES `plananuals` (`id`),
  CONSTRAINT `fk_unidadesPlans_unidads1` FOREIGN KEY (`unidads_id`) REFERENCES `unidads` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=314 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidadesplans`
--

LOCK TABLES `unidadesplans` WRITE;
/*!40000 ALTER TABLE `unidadesplans` DISABLE KEYS */;
INSERT INTO `unidadesplans` VALUES (289,'juego2lkj',' ','2021-09-18 18:46:06','2021-09-22 04:01:58',1,37),(290,'historia2jj',' ','2021-09-18 18:46:07','2021-09-22 04:01:58',2,37),(291,'letenda2',' ','2021-09-18 18:46:07','2021-09-22 04:01:58',3,37),(292,'estudio3',' ','2021-09-18 18:46:07','2021-09-22 04:01:59',4,37),(293,'lectura',' ','2021-09-18 18:46:07','2021-09-22 04:01:59',5,37),(294,'matey',' ','2021-09-18 18:46:07','2021-09-22 04:01:59',6,37),(295,'rexoiyy',' ','2021-09-18 18:46:07','2021-09-22 04:01:59',7,37),(296,'razonamiento',' ','2021-09-18 18:46:07','2021-09-22 04:01:59',8,37),(297,'dsdfsdf',' ','2021-09-29 17:33:08','2021-09-29 17:33:08',1,38),(298,'sf',' ','2021-09-29 17:33:08','2021-09-29 17:33:08',2,38),(299,'fas',' ','2021-09-29 17:33:08','2021-09-29 17:33:08',3,38),(300,'fsdaf',' ','2021-09-29 17:33:08','2021-09-29 17:33:08',4,38),(301,'fddf',' ','2021-09-29 17:33:08','2021-09-29 17:33:08',5,38),(302,'sdfgf',' ','2021-09-29 17:33:08','2021-09-29 17:33:08',6,38),(303,'sdgf',' ','2021-09-29 17:33:08','2021-09-29 17:33:08',7,38),(304,'sdgsd',' ','2021-09-29 17:33:09','2021-09-29 17:33:09',8,38),(305,'dfgdfg',' ','2021-09-29 17:33:09','2021-09-29 17:33:09',9,38),(306,'jknhjk',' ','2021-10-02 16:13:55','2021-10-02 16:13:55',1,39),(307,'njkn',' ','2021-10-02 16:13:55','2021-10-02 16:13:55',2,39),(308,'nkjnkj',' ','2021-10-02 16:13:55','2021-10-02 16:13:55',3,39),(309,'nkjnk',' ','2021-10-02 16:13:55','2021-10-02 16:13:55',4,39),(310,'nkjnjk',' ','2021-10-02 16:13:55','2021-10-02 16:13:55',5,39),(311,'njknlñk',' ','2021-10-02 16:13:55','2021-10-02 16:13:55',6,39),(312,'klm',' ','2021-10-02 16:13:55','2021-10-02 16:13:55',7,39),(313,'m',' ','2021-10-02 16:13:55','2021-10-02 16:13:55',8,39);
/*!40000 ALTER TABLE `unidadesplans` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-03 19:29:53
