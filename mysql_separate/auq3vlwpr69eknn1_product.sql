-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: pwcspfbyl73eccbn.cbetxkdyhwsb.us-east-1.rds.amazonaws.com    Database: auq3vlwpr69eknn1
-- ------------------------------------------------------
-- Server version	5.7.23-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '';

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `buy_place` varchar(255) NOT NULL,
  `product_info` varchar(255) NOT NULL,
  `product_detail` varchar(255) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `FK_index` (`user_id`),
  CONSTRAINT `FK_index` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,'日本、〒606-8205 京都府京都市左京区田中上柳町３２&minus;１','T-シャツ','','35.0304996','135.7732283'),(2,2,'日本、〒556-0005 大阪府大阪市浪速区日本橋４丁目１２','中古のプレステ１','コンディション　悪い','34.6592536','135.5058156'),(2,3,'日本、〒542-0071 大阪府大阪市中央区道頓堀１丁目９','アーガマ','エウーゴの戦艦','34.6687315','135.5012911'),(2,4,'日本、〒604-8301 京都府京都市中京区二条城町','紫の服','中国地方の女性普段着','35.0140901','135.7491371'),(2,5,'日本、〒600-8411 京都府京都市下京区水銀屋町６１２ 四条烏丸ビル','紺色のシャツ','中国風の厚手のシャツ','35.00347560000001','135.7590956'),(2,6,'日本、〒606-0807 京都府京都市左京区下鴨泉川町５９','白いワンピース','白いワンピースモデル','35.03803720000001','135.7727727'),(2,7,'日本、〒556-0005 大阪府大阪市浪速区日本橋','革スカート','白の上着と革スカート','34.65902330000001','135.5057497'),(2,8,'日本、〒542-0086 大阪府大阪市中央区西心斎橋１丁目２&minus;４','アロハスカート','雲南省よくあるのスカート','34.67221','135.4988644');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-04  9:36:54
