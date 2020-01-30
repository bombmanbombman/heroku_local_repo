-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: project1
-- ------------------------------------------------------
-- Server version	5.7.29-log

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

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image` (
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_image` datetime DEFAULT NULL,
  `image_info` varchar(255) DEFAULT NULL,
  `image_data` longblob NOT NULL,
  `image_type` varchar(32) CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `FK_index4` (`product_id`),
  KEY `FK_user_image` (`user_id`),
  CONSTRAINT `FK_index4` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `FK_user_image` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `photo` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `imagetype` varchar(32) CHARACTER SET latin1 NOT NULL,
  `imagedata` longblob NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,'æ—¥æœ¬ã€ã€’606-8205 äº¬éƒ½åºœäº¬éƒ½å¸‚å·¦äº¬åŒºç”°ä¸­ä¸ŠæŸ³ç”ºï¼“ï¼’&minus;ï¼‘','T-ã‚·ãƒ£ãƒ„','','35.0304996','135.7732283');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase` (
  `product_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_purchase` datetime NOT NULL,
  `purchase_cost` int(11) NOT NULL,
  `purchase_number` int(11) NOT NULL,
  `purchase_size` varchar(12) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `FK_index2` (`product_id`),
  KEY `FK_user_purchase` (`user_id`),
  CONSTRAINT `FK_index2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_user_purchase` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale`
--

DROP TABLE IF EXISTS `sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sale` (
  `product_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_sold` datetime NOT NULL,
  `price` int(11) NOT NULL,
  `customer_info` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `sold_size` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `FK_index3` (`product_id`),
  KEY `FK_user_sale` (`user_id`),
  CONSTRAINT `FK_index3` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  CONSTRAINT `FK_user_sale` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale`
--

LOCK TABLES `sale` WRITE;
/*!40000 ALTER TABLE `sale` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_datetime`
--

DROP TABLE IF EXISTS `test_datetime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_datetime` (
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_datetime`
--

LOCK TABLES `test_datetime` WRITE;
/*!40000 ALTER TABLE `test_datetime` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_datetime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tester`
--

DROP TABLE IF EXISTS `tester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tester` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_icon` mediumblob NOT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tester`
--

LOCK TABLES `tester` WRITE;
/*!40000 ALTER TABLE `tester` DISABLE KEYS */;
/*!40000 ALTER TABLE `tester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `user_email` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `user_password` varchar(12) CHARACTER SET latin1 NOT NULL,
  `user_phone` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `email` (`user_email`),
  UNIQUE KEY `email_2` (`user_email`),
  UNIQUE KEY `user_phone` (`user_phone`),
  UNIQUE KEY `user_phone_2` (`user_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','bombmanbombmanwork@gmail.com','63079861','08044996800');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_icon`
--

DROP TABLE IF EXISTS `user_icon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_icon` (
  `user_id` int(11) DEFAULT NULL,
  `user_icon_id` int(11) NOT NULL,
  `user_icon` mediumblob,
  KEY `primay_index_user_icon` (`user_icon_id`),
  CONSTRAINT `user_icon_ibfk_1` FOREIGN KEY (`user_icon_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_icon`
--

LOCK TABLES `user_icon` WRITE;
/*!40000 ALTER TABLE `user_icon` DISABLE KEYS */;
INSERT INTO `user_icon` VALUES (NULL,1,_binary 'ÿ\Øÿ\à\0JFIF\0\0`\0`\0\0ÿ\á\0\ÒExif\0\0II*\0p\0\0\0ApplicationFrameHost\n11/23/2019 , 10:57:12 AM\nScan1.JPG ?- Photos\0`\0\0\0\0\0\0`\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0Z\0\0\0\0\0B\0\0\0\0\0\0\0\0\0\0\0\0\0\Z\0\0\0\0J\0\0\0\0\0\0\0R\0\0\0(\0\0\0\0\0\0\0\0\0\0\0ÿÿ\0\0i‡\0\0\0\0Z\0\0\0\0\0\0\0ÿ\í\0bPhotoshop 3.0\08BIM\0\0\0\0\0Fx\0AApplicationFrameHost\n11/23/2019 , 10:57:12 AM\nScan1.JPG ?- Photosÿ\Û\0C\0\r	\r\Z#\Z!!!$\'$ & ! ÿ\Û\0C                                                   ÿÀ\0J\0ö\"\0ÿ\Ä\0\0\0\0\0\0\0\0\0\0\0	\nÿ\Ä\0µ\0\0\0}\0!1AQa\"q2‘¡#B±ÁR\Ñğ$3br‚	\n\Z%&\'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyzƒ„…†‡ˆ‰Š’“”•–—˜™š¢£¤¥¦§¨©ª²³´µ¶·¸¹º\Â\Ã\Ä\Å\Æ\Ç\È\É\Ê\Ò\Ó\Ô\Õ\Ö\×\Ø\Ù\Ú\á\â\ã\ä\å\æ\ç\è\é\êñòóôõö÷øùúÿ\Ä\0\0\0\0\0\0\0\0	\nÿ\Ä\0µ\0\0w\0!1AQaq\"2B‘¡±Á	#3Rğbr\Ñ\n$4\á%ñ\Z&\'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz‚ƒ„…†‡ˆ‰Š’“”•–—˜™š¢£¤¥¦§¨©ª²³´µ¶·¸¹º\Â\Ã\Ä\Å\Æ\Ç\È\É\Ê\Ò\Ó\Ô\Õ\Ö\×\Ø\Ù\Ú\â\ã\ä\å\æ\ç\è\é\êòóôõö÷øùúÿ\Ú\0\0\0?\0úGÁ:•Ç‡®¥\Ô\ì­.\æ—S½5 7’sœ\0•\Óÿ\0`\è\Øÿ\0EŸ?ôÁ?Â±ş\È\ÒxRfd*F©©)\Úöaı+« –“\Ü\É\r\è÷ôKú\Û\'øTM\áO\r;‡mO-\ëödÿ\0\nÛ£\îÁE#x[Ã¡\nOÁ=ºÿ\0…B\Ş\nğ£ò\Ş±ÿ\0¿ WCŠ(¸r¥±\Ì\Â\àı\åÿ\0\á²\Éÿ\0¦t\æğ7„\ÙBÿ\0aZ\ì˜şµ\Òb—]•£ü<ğs’Nƒ\0>¡˜Z„|4ğb“ú\Í!ÿ\0Ù«°¸¢\ìDq\ïğ\ãÁ\ÒN‹\Ç÷]‡õ¨›á—„ıŸ\"\çû³¸\Ç\ë]®(\ÅDq1ü1ğ”`ip\Ü\ç-u!şµ!øo\á~v\Û\\&»r\ãú\×eŠ1EÃ‘;ü1ğÓ®\İÚ‚û­\ä€ÿ\0:á—‡S¤Ú™÷\Òsú\×qŠ1EÃ‘3|3\Ğ\É\Ê\ê\Z\Â{.¡ \ÅDÿ\0ô¢¡S\\\×\ã\Çu\Ô^»\ìQŠ.ˆ\à\Ç\Ã-4ÿ\0ÿ\0®¥\'ø\Ôğ\ÂÜƒ³\Å> _Oø˜Hqú×¡\â“\\9\æ’ü/¸Bmüc®÷~ğ5ã“Œv\æ¬/\Ãk˜Õ¶x\×]zµ1\Ç\ášô<QŠ.ˆó\ßø@5\ÅÇ•\ã\í\\¾\Äÿ\0\ì\ÕŸüHÌ€x\æğÆ£29-\îyÉ¯I\Å-õ8<\â[x™\"ñ”\Ù<\Ğ‘ù\æ«\Â\â\ä¸óañ´±û,d~…ˆı+\ÑñIŠ|\Â\äG\Ç\á«ş:%{~\ásøñSŸxñQD~5\É\îZ\İ?Â»¼\n1J\ã\åó8!¡üEV$x¶\àsÿ\0|SSGø™´‡ñE§\áÿ\0ñ\ß\ãŞŒQ!r¾\çtˆˆ\äC\âkfS\Ï\ïbV#ÿ\0¢»\ÌQE\Ç\Ë\æs\Ş)ÿ\0\ÑTU/o\íé•¹\Ô\Zè«—ğ&	”i„\ê\ÎXœò\×r“üë¨¤XQE\0QE\0S]‚)f8­:Š\0E €GB3KE ŠJ(sE%\0´RQš\0Z>”™¢€ŠJ3@E&h\Í\0-™¥ Š( Š( 1’zR\Ô7I,e\" \'ø•A?¯5( G=\à\×i<8\Ò4-k\ÛÃ±ºô©qšè«›ğL­?„\â•\ß{‹œ¶:ÿ\0¤I]1\Í\0…¢Ñ(´RQ@h\Í&y¤\'š;4dS	8\ëL\Î)Šä›¨\Ü*øšcLª2[€9ö¦•öv,n\æ“}r:¿\Ä\èLWR×­¡q\ÎÀ\Û\Ûò®.ÿ\0öğ-°Í³\Ş\Ş{¤G\ëŠ\ÑS“\èe\í º\È\Z7\nğ	¿i8xzöDõiI¢/\ÚSFóv\Üxfş8û4rF\ÇCŠ~\ÆBuâºÿ\0¼RSÑúWiß´€\ïv‡¾°ry[’\êTš\ít¯øCXúgˆ,g2t`¬O¦\rO³—aª\Ñ}N·p¥$UE•\\¬=\ÅM¼TX\Õ;\ìJ\ró¼1RgÒ\î:—4\ÌÓ³H..ii¹¥ b\ÑH)hR\Z\\\Ñ@¢ƒEf\'…\í\âµğø‚Qn.9õ>{“ú\Ö\ßj\å>Ks7\Ã\Í*{Ã™\å;1’dc]Q4\Ğ(¢™´\î$63\í@\Ç\ZL\Ñø\æŒ\â‚D8¦“‚=)ˆ5Rşş\×N±šöú\á-\í¡R\ï+œ*T—B[\îYg½s>!ñ×…|1	“[\×-m´eò\ì}Œ“ùWƒx\ï\ãv¯¬<šw„\Ø\é¶;Š=\á–Qê”{×Œ\ÊD†K¹æ™¿F,\Î}ry­\Õ4·9¥U¿„÷Ÿş\Ğ/y)²ğm³E.\Ó{w\n·û)ıMy§\âÿ\0k³j\Ş&¾”\ä«\"\ÊQqş\èÀ¬U¸+#qj¹‘N$S\Î=k>\â\äK/š®6‘\ÍtGM´0q»»w/–®]‹å»¹\Í5¶¡Xx\æ©™H9d\Ï^µ,R¡\\¡üG_¹j6Ø‘\'a\Ë·LTğ\Ü#3\î8\èj0ºüÀ2c“Š#M\ÌÌ²o\Ü\éI[ª)§¹9F1\ïÀ\Ş$i¸w_Ÿ±\èG\ãP	|¶!‰Ç¥J\è•ùI\èOJ6V#•=ÎŸGñ·ü;µ4\İCn¼B\ì$F>„0<}+\Ù|)ûC\ØÌ±Zø¾\Å\íe8V»·]\È[¹+\ÔÎ¾uvF)0*W¹§’\Ë\"\í·s\Çñ}*\ZE&\Ò÷O¾t½[M\Ö,\"\Ôt»\Èom$Iap\ÊEh\Í|?\à\ï\Z\ë¾\n\ÔR\ãJ™šÉœ\íÜ\Ï½}m\à\ß\Z\é~2\ÑSQ°p	ù^<\ä\ÆŞ†°”;B£zH\ë7g¥8\ZˆOQY›¥¦ô¥\r¥¤£5#\nQIJ(\Z(4P#™ğ\'•ÿ\0&–!$\Ä‚g®¶+¥®_\á\ì\Ëuğ\ßAº$ö«(Q\Ûw\Íık© bRRš(½©­ÒzTMÖš$«{w•¬—W2\âA’Çµ|—ñ\'\Ç7~4ñ‘\Ç+.‰aº8b;wr;ûW ühñ\Ğ{÷ğ~—q…‰7_Èœ`‘ò\Ä®9>•\á2I\æ8\0\01€1\×Şº¸´\Üç—¾õØ¡sp±FY††¨™#14¬Ü¯8«wQ\ï”#r«\É‰¬Vœ›—c<SŒ¬)B\äF\ç\Ë!\â|\ë\èhûB\Â6\\\nš­2”,TŒœš®ñe\Î\ÙcŸŸŠ®}	\å4\ZH‚g%3\Í5YJ/9÷^£ğª\è&D)a\èy©\ã\Æ\Îa# ©\æcK°\è\ßº7\É\êy©’\î&;&]¯œ©\èj²\çŒ\Æú	§¢		§A\ê´sj>Rò\Ëò\'¹§\Ãp\Ê\Ü\rÃº÷6\Ìa\Ú\Çr)\âAÚ,n£©/ñZô\"\×/ƒ\ÈÌ§> õZU(1­Ÿ–³\ÙÙ¢G|¤ª9e\ïH.RB`\Æ{\Ò\ÕN÷+\Ç\ÔV…\â=cÁú\äzÎ9e·İˆ\î:0şµ\ÍApN\Å\á\êyZ°%\Ø\á¢m\ë×Œ*mr®}­\à?hş;\ĞR÷N“ËºŒº´¿÷\î=z\ìA\ã \×À\Ú\'ˆu_x‚øva\ìDoF\å\'O\âFÁˆ\í_fx\Ç\Z_|-³§:¤£÷wV»²ö\Òª¡\î+\ÆÆ°ŸC­’GER‘I ¼\ÔÃµ0GZz\Öf£¨¢Š’RŠAK@À\ÑE\Ë|:±}3á—‡4\é%ó^\Ú\Æ(Œ˜\Æ\ì(® Ÿj\æ¾]®¡ğ\Ï\Ã:‚+*\İi¶ó€\İ@hÕ°:\é¨\r´”\0\Ö<V?ˆ5ˆt-÷VŸ”¶Ÿ§\n\Øc\Åxo\í\â/±\é:G†`•\ãšşv¹œ¡\Ç\î#ƒ\ì\Ì\Ëù\Z¸/x\ÎoM5\Ó%õÌ¯4’Ks;\ÜH\îrYœ\î?Î©ErY÷–#ğQY\×WL\ÓNqø\Ôİ˜\â\Üqóö•´ÙœV†µ\İÀTœ\È\çh\İ“«4q•,@¥‚I&˜1Ág8R{W]g¥±£2Œ÷>µŒ¦‘\ÑN\Î&He‰YB\ç\0zª‹m\ç-gZ\îKcù\0r~\\ú\ÒC¦/‚@\'\â³uš\Ø\×\Ø)nrQZH‹¹wı}*\à²2 Ì„€8\ã­u‰¥nR0	\î)‡K*|²˜lq\ÇZ…Yš<4V\Ç\åM\Ñƒ\Ô\Z•°\Ä`ôÁ\roO§~õ\\!SÎ«\Ëi\ån%7#™qÊŸQZ*¬\ÎT\ÌöÈ‚L\Ş\Ìduÿ\0\Z®ò2\"‚\ß.xb9R{}*\Ä\Ó›\\† \á\\p~†³.g\ã\æ^€{\ÖÑ\Îz”\ÚØk !\Ë:\ëYS\Üe…\r€J*¬óùQ2\Èxb\'8¨„£hF;¥hÙ…­¹~§ƒ-	E\İOUv\Úó{¨‰²²@¼VvŒŸ/×{S­\çÌªP`g‘MH—¬I„œŒ$€;WMğ\çÇ³ü9ñ\â\ë$\Ò/v\ÛjP’S<J=ÔœŸlŠóø.X0Fl?)\íWŒ‹0\Ş\0\';YOJM\\‡\èÍ¥Í½\í¤7–“$öÓ ’)P\å]O ƒV\é_:~Ì¾2ûF¨|?¾\Ú\çLcuc¼\çu«‘”ı‡$c°e¯¢”\ä)=ù®wtu\'¡%”¼TŠ)-\n)9¢€9\Ï\0D`øc\áhJ„)¥Z©Q\Ğb\âºJ\Ãğr¢x\Ã\édk§[…\ï)pkr€\nJZJ\0cÖ¾/ø\É\âW\Ö~*k\ä¾`\Ò\Âiğg\î\Íÿ\0³~UöeÃ˜ –lg\ËR\Øú\nü\ì\Õu¾šöşb——2\\¹Œ³m£f©Ó¹+»œœ\0j\Ú¥T#<tô¦I !°8\Ï&›\nI#	\Õöe6Œ\äúuâ” ¯c§ğõ›\İİ‡a„N†½-l¶iÀ\ãÀ¬\ni»V5\Û\Ç½ì¡ÙŒt\Åy\Õ\'©\ìÑ§es˜—O\r\åvL©ô© \Ó\Ê\ÜD¸r?\ë]1±E±+\éÔšŸG\ÓÀ¶\0\â88¬]K#ª4®\Ì§\ÛÈ¹Q\å·u\Æ)“\éhË¸\ç\ÌB5\İ$`8P[¶E2M!v\ì\ÃRS5tY\æ—\ZhyŒ1\Ó5—q¥™c\ÊÊ½­zEÖ”\Ñ\È@ö¬\ë\È\Ä~9\éZ)³7Hò;\İ/d\àH»78§½`]\ØO”Á,rA#¨¯_\Ôômö\å<¼H>\éõö5\Ë\\i^toB=G\"µŒ\Îi\Ó<²\â r\Ø9\Æ1\é\ÍP`\ê\Ø\nI\Î3]ş•%¶ö*\éXWL„§9o™Òº£R\èó\êRe„¼l¨ytûúTs†o,úúš\è\í,L\Ñüƒv@c\ÕBóOT’2\ÊH\êL\ZµSS\'Iòİ”\Ö]ñ)\0­´‘Z–Òº–pv²œ}k)T¢6AıjÅ¤¤HUº“ŒZ3š\İ\Úx/\Å2ø;\Ç\Ú/Š¢}‘\Ù\\,7c8m)	&~™\rÿ\0ú¤AGzü\Ò“G,9ùgS\ïÖ¾úøS¨¾§ğƒÂ·sHò\Ê,#†GrX³F61$õ$¯Z‰\ZÃ©ÛŠZAKYš \Æ{â–Š(QE\Îx\r&á¯…ã¸Œ\Ç2iVª\êz«W ş9®³tO†´²q“kO÷iPIKHh­øf\Ó\îUFX\ÄÀ}pkóf\ç)k2|¥@Vù\äW\ék\ÊW±\â¿=|y¡\Æ:¶”Uˆ³¼•T±(\ï’+zo\İhç¨½\ä\Î5”³‚F7ºi\Ò\\^©	»8\É`vp¦@¯WğV’(\İ\ã\Î+š´\ÒV:ğ\Ôù¥s±\Ñôóoo\Æº 4£q\Î*\ÏNµYn¥H\Ğrf°\ï<ck\Z\í³l\ÈıI\Åy\é9\ê{75©\ÑO\îD\0ò\íÒ¶´û_*]¼¢¼\Ê/\Å\Ş$“t„ş]E—‹m^%q2rqÁ\ëU*,Tñ1¹\ß\Ã$gŸoJ¶ö*pñº’C\\µ¾´²ª\ìÊ®Ç«²ª\ØõšV\Ü\ìnR\Õ\ŞX1-œGJ¤¶^Z\ä@\Ú=ªÜš‡šw]nGù9\â\Ò~¥[½9 ç±¬+\Ï\r¤<\È;s\í]$w\Í\í$2÷\ÍXşÒ†4\ÉL\n.ú\ÔzC¬x^IúÁå’¸5\Çj¾ºKsˆ—Q•q^\í©j›wHµ\ÊjšÖš£\Êt\r\Ç­c\Ìq\Õ\ä<NÓ®`˜SÁ\Ã{Šµªi#\ÈÈŒmnx\ìk»´‹¹Y\ào-‰\Ã+÷÷û\Í6\ŞHIUÉ«r’0Œbö<e))‰\Î\Ò\áU\äB\ã\rÛ¹®‡\ÅZ‘¨3*ù³\íXwFÇ¡1\ë]”§Ì2½5\ZvO\æH$\ç\'Œv\Ïzû›\àl2CğK\Ã\É!•™\Æ=òú_\rØª&\äó¼c\é_vü\ZŠH~xad\ç}³J§ı–‘™ñ\Ö¤Œi÷g ”\áÒš:RóY¡h¢ŠQE\0T\Ó\"H4‹8#\Î\È\áD\\ú­\Ôp!\Ş8\É\ÉU\nO®*J\0(=( ô •ò‡\í¤\Û\Û|I‚\ê\ÔGMÌ«ùh®T?\×n\á_W\×\Î´#ø·J½#tOd\Ñ)\î¬Ÿ\ëU(İ²\\\ÚHù\Ö\ÆÉ¦Õ’½9¯mğí—‘fƒ\n+\Ï|;`—%\'m¤‘\é^»inc´ÀÀ®:Ï™«–<·9\ín?´Ì¯+\rªN\Åq÷\Út²É–I0xn\rwW\Ö\ìI‘ğ¹&¸\íC\Ä6º|„@ˆH8ó$\àg\ÛÖˆ\Ê\Û8·¹\È\\hZ\İ\Ëoe)\ÏAQ\Ü\ÙkqH•X\×j.qŠ\éõ]°´†ö\â\ÖD†S„]Š¾g\Ó=«\'ûv{\ë\ï³C$r¹\Ì\n¥dR;ü\ËŞ¶|\í^\Ç/\î\ïk’hş/Ö´¶X/ iûÂ½\Ã\ÅQ]…Á!ˆ\èk†´”\Û=¸R?„ŒşFµbµz˜Wa\Çj\årOtvCš‰÷˜ŠC‘š—\íÊ‰÷ù±t\ëY¤·F\ä3Q\ê1\ÏNÜÕ“Z<\íGR\ä\Úü6\ã\ç‘G~µ\Çk_­­ÁŠ\ßtœqÀª1µÁı\ë¾•‘=†¦V‰Ku,\Ü\â·Nç›œ–†m÷‹um@ÊŠYğ“\ÍSµ¿\Õfq¾\ÖGPG9#Š\ému\ÚuY\âv\ÎH\0\0[ƒ½k\Ûx»Áò¢\ÖUU;I)œJ\ÙTohœ~\Ë[\ÊE+8|Å¼§·rA\Ï5\ĞÙ¥Å¼ ˆG*\İ?ú\Õ\\\è÷r…²¸D‘ùÿ\0)?AŞµ­`bv–ùj¯¡¬cm\ÆZg›œık\Í\ç„\Ås´œsÒ½\Û_°[`®x\ï^GªB‘\Ş\Ï4›U€t™&7ETC\à¹\Ù\ÉQŞ¿Cü/¤\Â\Z>ˆ>Ái² W\Â~\ÓÆ¹\ãÍ¡\ßoq¨[\Æ\êO›Áaù_ ƒ\ïWL\ÇşÔ£¥%(\éPjQE\0QE\0ŠAÓ­-\0QE\0¼·\ã££\è÷^^\é-¯Â“\Û\Ëdm\ÙüUk\ÔMp¤dğ\Üj†“§\Ğ\Z™«Å£Z-ª‘k¹ó×‡ô¸\íş%^„†KB\ê¼ñób½(7 €z\Ö‡\íf\Z›\Ş\ÈG1¾3Ÿ\é]d=«\Ê\ê\ç§\n|®\Æ.£\áù¯#1‹‘¡zµp—\r·7ª\ÏK±·dö#Ò½qQ$‚JË¾‹š!ó\Ö›L\êpc\Î<a¢¶¿¡\ÅS¤7„”W;Cgµs~ğ=Î‹ªhÜ´(‘¡\Ù\Z¾\ì“Ş½\núMM$` 3Y‚û‰¶•\Ú¨\Ín\ë\Í\Ø\äú½;˜ğxnA¬½×‘ oÜ©\É¶+¨±\ÑDQ®\å\äó\Í_\Òô¥€o~Oq\é[*»“‚°”\îÎ¨\ÓVV,išR<1ßŠ\Í\×4\Õò]Òºı*6e\Äk:Vn­\Z—p\Ù\È5:\ÛS^E{Ow£¶®Akš¼\Ğõ	õ…‰m‰´LpG\Ì{\â½u­¹$uõ¬JÁ—¨\íN2f.	ny<1{öû{½:¡µ1ó¡F&3\Ü¼óZ¾ğô‘i—ò\ê–La¹\0\"Î¸$÷ny®\ÉZò$dùO\Ş\0Õ‹Vy6‡´c\Î>c]_X}7„ƒ—5\Î\Z/	\\-û˜\å\ÌjùH\ÎÁ\è\rwšN›}T¹\Ğ•«z\ÎÀ1‚©\ëZşZ Ú£8®yTr{1¦’±\Íjzy{f\Â\ç+Â¼ai5®­‘SûÃ¸ñ×šúNx\Ô\Äxæ¼‡\Æ\Únÿ\0\éó\Ü6ü\Ãpkª‹\êqW‡Do|\"ğ¼—><\Òm]6F²?…FWól\núõ@À¯ø7`_\\\Öub\0\Ú\Ş\Øq\ß.\Çô\Å{Bğ¢¶¦\ÛWg%d”¹WA\âŠ¡QE\0QE\0ƒ§JZJ(\0¢Š(\05\Ã|J¶šoÁ4h!œyƒı’şxü«¹ª:µŒz–“wc*\îY£eÇ¾8¤õV.\å’g\Ù@\Ö\×\Ã-”hğ£y§\Øø\ÏZ­¾E¾E™<£+`ƒŠŠ\íğ\Ù\'¥pò\éc\ÙR÷”¨aq’1Úšf8\'Ö±\Öm\Òİª\ìl¸\Ë\ZÁ«j\Í‘+óŒö\ç½1m”`„\0ú\Õ\ähñ“\Î)\æ3Ši’ ‘LŸ(\ç@©\á}±\äMgM#4\â(yõ5v&Fq\à\ZHgY¡\ÎR\åŒr++X“uÌ cÖ­\Ú3FÁ±“ÓŠ¥«£	\\’r\Ã<Õ¥ \Ú\Ö\æ4®6Œ”«¶@Œıj”¶×Ir{\nvŸreYv¸\àæ³¾¤\î>m=KnŒ}qŞˆlö \'š\ÑB\ØÀ\ÇœL` \ÓlT,;\"\\\ÅM\ç¦\Ò2¨\Ë.ªS\\0=y¢\×I+šL€Î¹\ígOK\é\ãr ˜›sökB	‹¾O\"˜\Æ5¸c—\Ş6\í\È{\×J\Ò\'\ç~Ç§ü!·1øVö}…cñŒy•UUşa«Ñ«\Ã\Zz\é~°²ùl‘eÿ\0hòRkk\×d‘\å\ÍóI°QEQ!EPEPÿ\0ZZAŞ–€\n(¢€\nB)h #Å:\Ä\ãQ\ÓdH/\0Ã«ğ²r:zò\İb\Ö\â\ÂòKK¨\Â\Ï½Fk\ès^Gñ>\ÈÇ«\Û^ª³Gµ±\Ç ¿‡ò¬\ç¦\Ö\çE*­IE\ìpq!\Õô(1\Íd´\Û$\ãŠ>\Ör\0lW“=x\È\İV\í‘K#6¯R*£\îyo­\\B¥\Ífn\Ê2I…\ÔsJ~RO½$&±ˆ«\æB\çšMR\İn­\Ş\å½}+\Í/ü?t’±–C!S•\â_ÆµŒnŒ§>S\Ö?\á!\Û€œgšÎ“\Äl\ášv\É¦¼µ¯¯mño+QĞ“\ÍS»ş\ÑÕ·[+´paÁjj*\äº\×Z¿k\âk+¤Ú’+`\àÀ\Ñd¾i{•8¿JóM\Ã:„.‘¤\ânêƒ–¯O³E·³X— jd¬i	&j++†«I.1€)¡±Œq‚©]Ë†8cŞ³CnÄ³I»Œı*œÏ‡ùAÁ¨\Z\çi\Ã6H\ïMI\ZG\ëÁ­¢Œ\'#[K·šòò+Kt/<\Çj\'÷zŸ…¾®›rš±\"\Ït>tFR6õ\'¹\É|2\Ó\Ş\ïÅ¯vFa\Ó\à,O£¿ú¯mv\Æ\nÚUj\í \Æ:S©)kCœ(¢Š\0(¢Š\0(¤<\n(\0#4´ƒ¥-\0QE\0”\Z(\rqŸ´\ãy\á)®b\\\ÍfD£\Ü\é]z\Õ{ˆ£†P\Z9£b9¦Cv\Ôùz\\O¨âª¡;‡5jş±¿º²Šu¹Š	$™Cª’\Ï\áT„Š$®	«;\Ì%us]&\Æv;)’\ê\è‡j0\Íe\İ\Ş\à w®U\Õ.R\"\ÍL“1\èOY¨-Ù£ªöG¤Iª	H\ç¾)\n\Ëfp¯7¶¿ñ$q\Ö(\Ät`zÖ‚\Üx‚b¦KI]OhÈ¦Şº\Z\ÂZ³¢¹\Ñaºa±²~”\ë}--SŞ¹\Ï\ímJ\Æ1\æi×‘ğJg?•+jº…ò™\Æ\ìP˜’½\ËöGb£\ÉÁõ«\êQ¡Ú§¯Q\\\İk¶À\â\ŞL7 1¬§\ÔüB.CıÁ\ç$ò*–»˜N2Ç­ÿ\0h$‹·8n\Ü\ÔwS“\Ê~µ\Çi\Z«^(l2°\àƒÚº1.ô\ÆsYòõ;¶¢ıjh™wŒ wª™\ÆNsŠ»¥XÏ¬j¶º=™a=óùa‡ğe›ğ5´\"\Ìg;+\ßğ³Mû/…$\Ôd\\>£1•sı\ÅùWùø\×}Ul­a±°·±¶]°\ÛÆ± ô\0`U‘]\ÉhyMİ¶8QŞŠ(h¤´(¢Š\0CÒŠ¥\0/­- \éK@%¢€\ni4dz\Ó\ç§Zdˆ\Íùšù¿öŠø\Ã&…§\Ë\à\nİ¸\Õ\î›Û˜96Ñ‘\Ä`övıÖ·>/ün‡\Â\í7†|\',wZğn.1º;\é\èd\ÇAÛ©ô?(\èO¯xÿ\0B°¸”\Ï-\æ¥\×LK4›_\ÌbOr\ÛZ\Ş0²\æg<\çwd}!?ƒ>øb\È{\Û;P5œ\ï•şbyô$Š\åf-¼`pk\Ü|Ug&»\áıF\Æ71\Ïs\İz«pG\ã_=h:£jºJ½À	{n\íout•\Öü2+‚´l\îzxyó\']Õ¢im4«?4N\è\äRI\'#š–7“\0ÓŠ\ælî††0Pô¨\Ñ\Ò92NÔ‚VÛ‚y4ÖˆH\Í#xÍ¯„|\×L™6©µ\Z\Î\ÛNpôZ[B\á†Ú©#´1/={\ÓÑ¡ûY¦N\'|\É\Î)^\Ú\ÚA·\Êi¡vü\Ø\ÒH\í·#µORe&\ÙGû:\Ö\ÖGx†\ÒŞµ`H±…E$‘L•\\Çœœ\İ\ÅB¡•²\Ô\Ö\æw-1\ÎO­3şë†>6ğ¶±=¸\Ó5§Lª\Ş¨cûAöœw\ë3VÔ—N\Ò\î\ï\àC2ó\ß‹ñ:`øGğ¢[¿šô‹•‘Û©±“ú\×Uwc»iYl\èºÖ™¯höÚ¾}\íÒ‡h\ÎAtö> ò+T\Zø\'\á\Å\rO\áÖ²“\Ä÷B¹lj\Zz·ntc³/R:0\ë\Î\r}¿¡\ëºWˆô+MoD¾÷N»O2\ã\èÃ§\àA\àƒÒºÚ±À¤º¥\ÍD­\Å?\"¤¤\ÇÒ”ÀijJE¢n”Se`}h WC”ƒÈ§SAã´\Ã \0’qZ-¨_A\äŒ\ÓYÀ¯9ñ\ÆoøA¤·½\Õ\Ò\îõW\"\Ö\Ó÷®O`q\Âş&¾sño\í!\âıxIk \Çƒf\Ù]\éó\ÎTú±\à ükX\Ól\ÆU¢´>¶\×|U ønÑ®µ\Íb\ÓN‰A9š@	ú/S_5üNı¡\ç\Õ\ífĞ¼\çZ[J&\Õe]’Ğˆ—¶GñA_=jšµö¯v\×Ú–¡=\í\Ëğ\Ò\Ï!w\'\0rOÒ«ù¹T\\d‘\Ó=kX\Å#7/u–§“É·(‡s3nbNK\ç©\'¹5\Ò|\'gøÅ¡1ßˆ|\É=³´Ò¸«‰r\ãøpG\0\×mğ~Uâµ““\äÉŒö¢m½‚Œû3p1nS\Ïò¯>\"\éRxK\Ç\Ç]€Óµ¦ù\ÔtY€ô÷Qÿ\0\×\ĞQ|ğ/\"¹¿øn\Û\Ä\Ş\Z¹\Ò\î\Ì\ÃtOı\Ç¬kC™X\é¥S’I³\Él®\á¸@\Êr§Ö­&\Ó <^{§\êše\Ô\Úu\è1\Ü@\æ9¶Gô®®\Ğ\á\\6r3^Z\ÓG¹\ì\ßKô7dDò\Ãn…9\\(\ÉÀ÷5E/“z÷¤k€¡psŞª\ÂU,i\É2lzT2I“œg¹\Íd¥\×R\\q\Ç4Ÿlsœ‘\ÇNh°{C\\”q\×\0ô¥+Œp3š\Êûl{\0VÉ¨¤\ÔU\ï}\ÍA\í\r9#\äb±®®\ÑC6\à\0÷ªš£.LÁ\è+›¾Ô¦šU†\0]\å!Q$ŸJ‡\ä8ë¹¦,&ñÏˆ-¼3j\Ä[—Yn\ä\ì±’>§‘[´9(<!g+/2Æƒ ü+Ğ¾øU|5¡™&L\ß\İ\á\æs\Ô³^KûA_<W\áı=\ÌI!Ï¹\0*ô\èRj\İO\'UJvG—Y\İ*mnNNv¾ø\âŸ\Ü<~ÕšI\Ü<–²\0ğ±õ\Úzg¾1šóÈœ\àu=3Ò®‰‹Ä½2§\ïJ\é‹\æ\Ü\ái­¦<9ûR\Ï‹k\â¿¬ƒ8ûEƒ\ãñ\Ø\Ùı\r{?…ş/øÅŒ°\é\Ú\äP\İ7\Ú\ï÷.O¶x?…~}‰KJ`œñJ“²6\Ñò‘†\É4¹S)NQzŸ¨i(*­HÒ¿?¼#ñ£\Ç~x\ã´\Öe»³Oùt½>ju\è	\ä~½\×\Ã?´ö‹vhói\îHQ5©ócú\ã\ïÖ±pf±ª\ç\ÑÀóN&¹?øÿ\0\Â>)\\hšı¥\Ûÿ\0\Ï!&\Ùü\à\×N®*\Z±º’{	?\ÜZ*;’|‘ş÷ô¢„®&®|\Å\âÚŠå­š?xhA1,÷òn\Çü{ÿ\0À«\Ç<Wñ{\Ç^*\âÔµ\Éb¶|ƒoiû”\Æ:|¼‘õ5\Â\ÜLpT•\Ì]ö\î\\fº.–‰¶õ,ù\Í*p>¼To:‰FÀB\çóø\Ô&UH—\ä\äpq\Å\"õµ€\0ô\î\Ù:Z\Ä\å\ÔórsùÔfŸ\â˜¨T/B»2I\äõ¦Hù;1ó®\îR²C\åu\ŞO\È\Ôü;¹6ÿ\04\Ùw`0+õú\×$\ÈcbG9­\Ï	I\äø\ßH|\ín\ÜœÔ¶iªZqi—kT9\ê3W\æ„\ÉLñX^\Ï\ÙS<ğ+ª¶P\é†­\Â>røµ\á)\"˜xŸO‹\é\0\å‡f®M\Õ6*Û‘ºW\Ö:Ş—ö\î’DXTŒ‚+\å¯xV\ãÂº×x\Ón´dzW™ˆ¢ş$z˜Z\éûŒ\ÕKŸ”2¶TiZq·$œ{\×%e©¼GnK&:\Õ\Ğ[\İ\Ã2/ œs\\ªv\Ü\ët\Ö\è²n(È¨ü\àrO¥4\ÇÔ€1\ëQ1Uö\ç4ı¢\'˜\Ì\Ù!F2*•\åò@ªO\Ìø\è*¥\î«Q\â,3ö®~[§šRò}j\\\Û.4º²\İÎ v»±\'\ë^•ğ\ÇÁ2O:x“T‹“ƒmº?½\\÷€<s\â=A5+øq¦@~UoùjÂ¾´²\Ş\ÙT Q€@+«E·vr\â±N1#uò¢\äE|ñrùoş-\ßc•·‰-\Ç?SıM}S­_\Çgk,Œ~\â“_\ë7\Ú>-Ô¯Ø’\Ó\\3Oa^¬¾\ÆWl ’l„FO!ˆÕˆ\ÛË—!OcUVRs–<g¥I¸ùX\çš\É=l9[r\Ñ]\å”O=\ê,—Œ1Œw\íR !\äd;ûS\0\Â\0 \íc\Ütª\Ö\ÚF\Òb\Ç&\ĞNì‘õ,SÉq\Üv¨O\Ï&\ï\â\ÚF)±•Vù‰nx¤\Û\Ù–6»5\"º–)–d‘‘\ÇFŠ°úÒ½W\Â<y\á©\"Škô\Ö,S\n`¾%÷\\r8ú×#\Ú2W\ë\ÍY·v’fD!w9À¢\í\èÁYj}· ~Ğñf½\è—Ê¦C\Ã\ÌVQ€Jºõ\å‡P(¯4\ÄQ(l\â\Ölÿ\0\ßq\ÑX½4;m\\\çØ®\Õ¤| vªW¢Œ¸l‘\Ëb¬–;sƒ¡\í\íPœ\á‘\íVa¡Î“Æ®\É\0óV\Ôd–%”0\Ü9\ëY\ÒD\Ø/\Úx#Ş­#e	yF\â?\Õ\ã8üh\æb²dgÖ›\rŒ\\Ÿ§Jk²˜ö“´E=@!x\ç?1\î+ü\ß0\È!†k[D;<E¥	cq\Ş=\ë3;_Œä†´4‰zÎ˜ù<\\\ÆO°\Ş3JöÕ‚µÏ¹4³jœv\ÒÛ©Y@\íY‹6jFq+y#ÃƒÒ¶\è„\Ç\Ü@%f¸/x^\×ZÒ¦²¹‹rHu=ˆ¯H\ÆSµf]Ä‘‚N*\Zº°\ã\'t|?\âÿ\0\Ã\ZÜºu\â°Ps\ã‡_\\\ÕH\î\'\Ê\ÅO\\Šúƒ\Ç~°ñ˜ñ^\"\ÄW%$\ÎO¨ÿ\0\nù\×^ğ¯\áÛ¯*\â\İ\å¶+º;”£­y\Õ(\Ù\èz\Ôq\nj\ÒÜ 5›\Øø¨¤\Ôn¦^RôªÍ¸œSC\àƒš\ã\ä³\Øô.­¸÷br¹\Éô®\ÇÀºñ]ğ\ê6‹Lˆüòô\Şº*_‡\ß\îü_}ö›ğiP°ó%\Æ¿ì©¯§4­\Ú\Â\Ú+;H\"DQÀ®štœ\ÙÁ_È¹bA¥i6\Ö‘[[À\"†%\nªAV®\ÙcŒóŒ\n\Ôd\ÙÀ\í\\Î¯sµYA\Íz\Ôâ¢´<iÉ½Y\æş>Õš=6\å#~v±ı+\åe\æ]å¸‘‰9¯¤<gK§_H\Ùù#c\ÇÒ¾mFQˆ\Î{}h›\è…\ÜT\ãI\ÛùÒ™L7n{SA!\0nœô&‘Ÿõ0=k;2®ø‘\È\rò<1R‰‰\\Œ\Õ|dœvlŒı=©0]J³X×Šwd\î\ïaşs³1Ls“ô¥F\0`w\ÏùĞƒ¶8ô§0*\Ç8\ÍBó\í¨ğ\Ç\Í\0Fs\ÏoZ’	].Ô•\Ê\í<ı\áUÔ‘œ“À\æ§F\ß!$\0qÚ‹\ÙW³±\Õø\"¶xÁP\Ãû>Wô\Ò**\ï\Ã¼ÿ\0¼{]±¦Jp£\'ılTT\Ü\é‡Â:Y$¹²\"\ê¹,©´ww\'¸ªD¶\Ñóı\âMI#cHÀ\\}MB\Ø?6~lSz]=–$r0@µ&X”L	ãŠ”´[”ò0*U?¼$7<g#­Zw!Éµ ÷\Ü‚ 3\È\èi\ÆLFvpsQ!ı\ØF^pN?\Z‘ˆ†\0u\Å\'©p½µ,eŒ„\ï\à`œŠ’1´2&r²)\ÊõûÃ¥Uf!ø\äR\É \Ñ\äN\n\Ã\ê)\n\Èığ\æ\ÖÓ¡u\èQO\é[§úW)\à»Ä¸ğÎ26ÿ\02\İ`\ç ¨\æ°>!ü]\Ğ<n\Ö\È\ÃR\Ö\n’–œ\í÷s\ØV\İÖ¬\ïu]kM\Ñtù/µ[Ø¬­c3\Ê\Ø\çÚ¾{ñ¿\í+i™a\à»5¸<©¼Ÿ!T\ê½O\ã^G¬x\Ã\\ø,—ºõñG\"m\ÄQŒó…õÁŸJó\Û\ËK‹;\é`” ”†+\İsú\äPÔ­\Íb“—)\ízgˆõŸÂ·zÆ¯5\Û\Ë\Î\Í\ÛQO²Šõ_\r]jpi\ëi${<`o\ä(üx¯š<;\âKm/Ws*\È4ı¥\ÑG\\‹øÕ½O\â\'‹u€\èuifO\Ë&\Å\ì2:\Öq„¦¯ci\Ê÷S>Œ\Ôtû+\Ù­–™\Z‘Ä€(şB¸\Û\Û†z=ôw ¾{Ø’a”P+\ÅôÆ©Š\ï\ÄR\Ú\Ş#ü°\È\Ä,©\Í\ÓwÖºŸ§•1·Ô¦˜:\ïÿ\0Wû\Ëi©\í.EG°’z¡}f+KŸWøWSğŞ«¥D<9yk-²¡#\åü;­u)¯Áµùÿ\0ş!ğ^¥\rş›%œŠs\Ä-˜\äÇ¯b=}/ğ\Ëã…‡ŠL:‰+\rk\0E/İ\ç\Ù\è\ŞÕ¤b\á£DsFZ¦z\åô\Â4#½rW«\ænf\ä\×Mv\ZSµº‡Ö±¯!Â°­\Ö\ÆM\ëcË¼m\Z\Ûø;Wœ¯\"\İñùW\Êğ|…oP3»Šú‹\â\İ\Â\Úü6Õ9`±Œ{°¯˜B¨Û–\è:šÎ¦\ÅZ\ìT`Aù²GJF<\Ì*%%†\ç‘\Ó5\'\Ê2ş5—CK	´y\Ù\çç¥\"ld]Ä€M)9\É\ã\ä¥6/™o#6	¥+ôµ³%Pw0Q€A8\ìi¨s\çv\î)¡m\Ì1Œç¡¡0	E=\çI^\Ö!µq\êû˜\É\ÇN´‘’3Ğ\0÷¤c¶@\0\ä…:>yQŒ``zPöÔ»¶\ÏSødg1¯˜±\æù\Z+Cöw´±¹ø¿wôCCœ‚§?h€$¬\\ocÇœœ\ä€qõ¨”@3Ï ©\\\'S‘õn\Ú0	ù\ÑÍ­„\ÓZ±¹AnF9õ§+|Àÿ\0xÿ\0…1\Éò”d\Û\×\éO`=‡˜´\è(Ï–¬œœc\ïR!j2G@{\ÓQ\ÉP4­\Äjy9\ç9 „q™vƒ\Üv§¸\Ì\ryd\"š\ìC¯\ÌN\æE†%O\0¯Nô\r%¹\íšo\Å}v?ø\Â\Z…¡¸KT¶¹¾q–ùW õ\ã­s6º%\ÄØ‘Œ“]3³I$§s¿®I­_†öö‰\áı\"\éaf–A¿¿¯Im:‘&ò‚Ÿ,±8\êkª	5s6Ş§†\ÜøgWÓ ]sCtR±Y!ş\î8 JÈ¾ŒjW‘^§™nÎ»fL	f½ùm\Â\âİ•G•(Ë¯`}k\Ì>\"Ám£köwñq36LGiõ©ª§\Èı›Ôª<œ\éU\Ø\ä_AŸ\ìşe³$\è:ùd’?µX\ÄcùLD>;ŒWIg¨\ÙÜ `VIsÀ‘¼¹?\ZĞ®TE2y¬G	>Qôn\\ÌªÑ—%x\é\Üö\'•P\ÄGŸ#Ïš2\Í÷G\ÊzV\î™\â}OMJn-Ñ¾Xİˆh\Çû\Ô}:T÷z_n\Í.2`“\åq\î=~¢°&Wu`Ac¡¯^©b4Y\à\Ö\ÂVÃ´ª#\ÑF©¦ø†Ä”\å\Æ$†\Ò\Ç$QÀ>?\Zó\Û\İ:[=d\ÛG¸.\í\Ñ6\ì2¨\ïU>\×qe\"_[HVH\Î3œn\ìEznŸ\á‰õ+±\"\æ\Â\nƒ“Ú³•öd(\Ùó#\ÒşüU¹¶‚\×AñŒ¦H\Â¨O#…“ÿ\0Š¯b½•\ÜHŒ¬2¬§!‡­|¾4Iã‘­¤€º¼\'‚3š\Ùğ×Œõ\Ï\n}6\àK¨h¬0¶K\Ûû¡=½ªqz]7©£ñ\Æ\àG\àˆ\íw`\Üİ¢ó\í“_;û\Ğ\Ïô5\ëÿ\0u\Ë-cH\Ğ[M¸K¨$™¤\ÎpW¸\ìk\ÈT¨`O¯\"±›»5‚\ê\Æ(\Ø23\É\àf—O\Ê\Ä\ZA‚€¯9\ìZ«÷\Ë\Åf¤\Ø\ä´#R¯!]£¾2)*’chÁ\'¯jq ¾‚@9¦.7r\Øjl‹tsÓ¾)P\0û¾eb\Ø8\ïF›¡QhŒ\ÅÀ\è\Ç<\ÒNû“\ä!$Ï3’)\ĞcyÀ\Çnj$rÅ²N	ö©\â]¬W\ãŒö¥#Dš=‹öx·š\ë\âı\äP\Æ$d\Ğ\æ$n\Æ\Ú ¢¦ıœ|ÿ\0ø[šƒÅ€°\äÿ\0\×x¨¦•\Í¨ñ™O\ïA@A\ÅBÄ‘\Îs’*YWjd\äw\æšù1\à·\'ó¤¬¾FvW\"b6(\'\'8\'Ô‹†¶\Æ)„BA\äô\à$2\í\Î\É\ëVŠW¸®\ä(\È\ÎI\ÇÒ–\'ô§1ùH\0sş\Í7Š:sRÇ§P‘K0PB\à…ú\Ó\â`/^&‘€õ \î¨ˆq\Æ\ì.h±6MµğöSÿ\0­ŒÁK¹PûzW®Ê›¬\à`0D$šğÿ\0\0LN}\ì´7‚LzekŞ¬€	\äl\ãğ®¨lŒ_S.\íVX¸\çd!…yÅ½Í©i¡\Úüg\Ôk\×v¡œ3rñ€¿yß´hµJ\É%¼­\n¯,lc\íÁa÷\Z\Õng+u<€¶8ãŒšÔ¶\Ô\î\á#-\çEcn«\Z—…µ½6u5Ÿl\Ù\âÜ‰c<õÈ¬\Ø\Ó÷[³’8\ÏL\Öó¥\n‹\ßW3£ˆ•&\Ü$t¶º­\ây!ô\é§õG\ê>†›}i\â?˜\Çzy„a“\Ù\Ç¨®UÁbs&W¿j¿g«¼$,\Ò3‰)9*=¨¯\n¶^\éIÕ¡+ı\Ê…\ì±¹†•%\çˆ\í\ì	ò™&::W¿\è¶\á`´\\õd~B¸O‡\ÚlwZ´—ŒŠ\ÅĞªg½^\Æ\ÛË¸¶v8\Æ+º”¥R*R\Üó+\ÓT\æ\áˆ ·Œ\ËS˜ˆ”\è­-¿\ÑÂ¤’\ÃîŠµşú\Ôã‚¬1B&\Óvq½…lcc\çˆ0\ÛZø½á·ŒG¹\İTqœö«’\Ü.‘š\ë> J[\âª ÿ\0ªm£ÛŒ\×(Š¤\ÄI\ãú\×,\í\ÎtCX\è2<c;¹ä´­&I$N\Ğ@iÊ«\æ»\0ñŒPûK2\Î8¬ôaeq›\ÙH\Î\à#§9\Å5©bCm<’GÒ¦\Ú˜c¹÷\Å/\İ\è3Û½S’º@W\r¹†FR94\Ï0\"¾Á\É\éRG\ÆNq¸ú÷¦>Trz{TÛ«­¨ˆ6ª\å‰$œgŞ¤ˆ\ïb¾ø\ç4*¯^‚\î\ËØ¡Ù‘m.¶=\ßö`û:üN\ÖeºUd](\İ\Ó&e=¾”Sÿ\0f[	\ïüc\â3ŠŒ#\æô27øQE\ìRLñ9-$‘r#m„œq\ïÒ¡¦	9\ã5ús§i\Ú{\é–\å\ì-Ø•\É&%9>½*•\æŸ`\'™E•¸p#_A\íBv4\äOSóTYH\êA\\’q\ÇjFµm\ä\ß\æ9\é_¦zV“¥<\Ó-‰É…Oô« hM!-¢\Ø1\Úy6\È¥=6?1³2\íR­\ëJm[8\Êó\ÇZı:_x{Ÿø\é\ßø\nŸJ©7†|8\Ò6\ï\é§Œ\ÚG\ÇJ‰ù£ögİ¸c¨\È\ëN[Wƒƒ_¤3x[\Ã|9¥Ÿ”õ³\Ô{UIü%\áR¹>\ÒI\ÏüùG\ê?Ù¢÷S\áÿ\0‡ˆ\Ï}cüR }¯wğ\ìu„LOÌ¶\ÛIJö[_øj\Ş\íe·ğö™›Ü–‘©\Æ}@«–š6\n\Í\ä\éVq\åNvÀ£úVñ´±”¡vxf§g\'\Ù\à1¯\"=\Äúó^e\âŸ¶\âÈ‚}­–€‰-\Ø`œôe`TŠúûRÓ´õ³‹m¸\Â\01ğ3ô¯ñ†‰£9\ÛH²g\0Û¡ n<t­9´1ä»±\á\Özß‰5Ë¨[H¶´\Ó.\í\×77p!yyW\î=ª\Íßƒ–U:\å\äVş~d£\Ù\å\Ã\Şg_\áøW©¯yøs¡\è²øL$º=Œ‹-ø\Ş\Z\İ|t\Ï\â¹ÿ\0ˆ¶V{/ÿ\0\Ñ!ıæ£µÿ\0v>`\0ú\â­hŒ¥\Íd|\Éig%ôŸ`Y\Ñ[ùX\â?^µHZ1˜dŒö¯Q´²³}NıZ\ÒU\È0@ùGJeı•’Y[ºZB¬Ñ±$F<š©¨µ{)\Ş\×6~\Z@m¬­%\ä«\îQ£Šõ(¢;m]H\äš\â<‰ö!´c\í;zv\ÙÒ½24Uµµ* \Í\ĞV1fò\Ø\ÈH\Î\ë2z–a@Œ\â\İJÿ\0\ËV«±ºÏş°\Ñ8\È\0\Ëfşu©’\ÜùK\Å\Û\î|u\âX‹Â£#°Š\ÃXx#¶k£\Ö	>-\ÖA9ÿ\0M“¯\Ô\ÕED.«’[PF\'–\ØV\Èü\èxˆn@9´v1\Ú:Ôˆ‰òü£¯§µB]K\Ûc$!N:úı*8\Ñ\Û,\ÄpA5¶ª¾`F>•—\ÆQ\ÖzRdô(y;K1\ç *¿–\æPHû¤şU¸F\Ü(7¥U\0ùù¿­6µBKK¢€B$\ã×®)ñ\Ç&Jœdø\ÕıŠW•})ÁT3aGAÚ¥3Ø¿g	d‡\Å^%–7u_±Û¦Tuù\ä<\Ñ[³¬x\Ø(\Ú6Xôÿ\0¶ôR3q±ÿ\Ù');
/*!40000 ALTER TABLE `user_icon` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-31  1:00:12
