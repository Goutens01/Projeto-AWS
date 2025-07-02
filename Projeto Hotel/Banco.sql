/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.5.29-MariaDB, for Linux (x86_64)
--
-- Host: db-projeto-hotel.cq56pxdmv295.us-east-1.rds.amazonaws.com    Database: HotelDB
-- ------------------------------------------------------
-- Server version	11.4.5-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `quarto`
--

DROP TABLE IF EXISTS `quarto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `quarto` (
  `ID_QUARTO` int(11) NOT NULL AUTO_INCREMENT,
  `TIPO` enum('Confort','Executive','Presidencial') DEFAULT NULL,
  `CAPACIDADE` varchar(2) DEFAULT NULL,
  `VALOR` decimal(10,2) DEFAULT NULL,
  `STATUS` enum('Livre','OCUPADO') DEFAULT NULL,
  PRIMARY KEY (`ID_QUARTO`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quarto`
--

LOCK TABLES `quarto` WRITE;
/*!40000 ALTER TABLE `quarto` DISABLE KEYS */;
INSERT INTO `quarto` VALUES (1,'Confort',2,100.00,'Livre'),(2,'Confort',2,100.00,'Livre'),(3,'Confort',2,100.00,'Livre'),(4,'Confort',2,100.00,'Livre'),(5,'Confort',2,100.00,'Livre'),(6,'Executive',3,200.00,'OCUPADO'),(7,'Executive',3,200.00,'Livre'),(8,'Executive',3,200.00,'Livre'),(9,'Executive',3,200.00,'Livre'),(10,'Executive',3,200.00,'Livre'),(11,'Presidencial',4,400.00,'OCUPADO'),(12,'Presidencial',4,400.00,'Livre'),(13,'Presidencial',4,400.00,'Livre'),(14,'Presidencial',4,400.00,'Livre'),(15,'Presidencial',4,400.00,'Livre');
/*!40000 ALTER TABLE `quarto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reserva` (
  `ID_RESERVA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_QUARTO` int(11) DEFAULT NULL,
  `DT_CHECKIN` date DEFAULT NULL,
  `DT_CHECKOUT` date DEFAULT NULL,
  `STATUS` enum('PENDENTE','CONFIRMADO','CANCELADO') DEFAULT NULL,
  `CLI_NOME` varchar(100) DEFAULT NULL,
  `CLI_TEL` varchar(11) DEFAULT NULL,
  `CLI_NASC` date DEFAULT NULL,
  `CLI_EMAIL` varchar(200) DEFAULT NULL,
  `CLI_CPF` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`ID_RESERVA`),
  KEY `ID_QUARTO` (`ID_QUARTO`),
  CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`ID_QUARTO`) REFERENCES `quarto` (`ID_QUARTO`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
INSERT INTO `reserva` VALUES (1,11,'2024-02-20','2025-02-26','CANCELADO','IndÃ­u MÃ¡rcos da Silva Sauro','21986354986','2002-02-02','indiocosta@gmail.com','56986231957'),(2,6,'2025-07-10','2025-07-20','CONFIRMADO','Gustavo','21972134659','2004-07-09','trindadegustavo99@gmail.com','15151163795');
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-02 22:34:21
