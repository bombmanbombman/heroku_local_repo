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
INSERT INTO `product` VALUES (1,1,'日本、〒606-8205 京都府京都市左京区田中上柳町３２&minus;１','T-シャツ','','35.0304996','135.7732283');
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
INSERT INTO `user_icon` VALUES (NULL,1,_binary '�\��\�\0JFIF\0\0`\0`\0\0�\�\0\�Exif\0\0II*\0p\0\0\0ApplicationFrameHost\n11/23/2019 , 10:57:12 AM\nScan1.JPG ?- Photos\0`\0\0\0\0\0\0`\0\0\0\0\0\0\0\0�\0\0\0\0\0\0\0\0\0\0\0\0\0Z\0\0\0\0\0B\0\0\0\0\0\0\0\0\0\0\0\0\0\Z\0\0\0\0J\0\0\0\0\0\0\0R\0\0\0(\0\0\0\0\0\0\0\0\0\0\0��\0\0i�\0\0\0\0Z\0\0\0\0\0\0\0�\�\0bPhotoshop 3.0\08BIM\0\0\0\0\0Fx\0AApplicationFrameHost\n11/23/2019 , 10:57:12 AM\nScan1.JPG ?- Photos�\�\0C\0\r	\r\Z#\Z!!!$\'$ & ! �\�\0C                                                   ��\0J\0�\"\0�\�\0\0\0\0\0\0\0\0\0\0\0	\n�\�\0�\0\0\0}\0!1AQa\"q2���#B��R\��$3br�	\n\Z%&\'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz�����������������������������������\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\������������\�\0\0\0\0\0\0\0\0	\n�\�\0�\0\0w\0!1AQaq\"2�B����	#3R�br\�\n$4\�%�\Z&\'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz������������������������������������\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�\�����������\�\0\0\0?\0�G�:�Ǉ��\�\�.\�S��5��7�s�\0�\��\0`\�\��\0�E�?��?±�\�\�xRfd*F��)\��a�+����\�\�\r\���K�\�\'�TM\�O\r;�mO-\��d�\0\nۣ\��E#x[á\nO�=��\0�B\�\n��\���\0� WC�(�r��\�\�\��\��\0\��\��\0�t\��7�\�B�\0aZ\���\�b�]����<�s�N�\0>��Z�|4�b���\�!�\0٫���\�Dq\��\��\�N�\��]����ᗄ��\"\����\�\�]�(\�Dq1�1�`ip\�\�-u!��!�o\�~v\�\\&�r\��\�e�1EÑ;�1�Ӯ\�ڂ��\��\0:ᗇS�ڙ�\�s�\�q�1EÑ3|3\�\�\�\�\Z\�{.� \�D�\0���S\\\�\�\�u\�^�\�Q�.�\�\�\�-4�\0�\0��\'�\��\�܃�\�> _O��Hq�ס\�\\9\��/�Bm�c��~�5㓌v\�/\�k�նx\�]z�1\�\��<Q�.��\��@5\�Ǖ\�\�\\�\��\0\�\���H̀x\��ƣ29-\�yɯI\�-�8<\�[x�\"�\�<\���\�\�\�\��a��,d~���+\��I�|\�\�G�\�\���:%{~\�s��S�x�QD~5\�\�Z\�?»�\n1J\�\��8!��EV$x�\�s�\0|SSG�����E�\��\0�\�\�ތQ!r�\�t��\�C\�kfS\�\�bV#�\0��\�QE\�\�\�s\�)�\0\�TU/o\�镹�\�\Z諗�&	�i�\�\�X��\�r��먤XQE\0QE\0S]�)f8�:�\0E �GB3KE��J(sE%\0�RQ�\0Z>�����J3@E&h\�\0-����(��(���1�zR\�7I,e\"��\'��A?�5�(�G=\�\�i<8\�4-k\�ñ����q�諛�L�?�\�\�{���:�\0�I]1\�\0���ў(�RQ@h\�&y�\'�;4dS	8\�L\�)�䛨\�*��cL�2[�9����v,n\�}r:�\�\�LWR׭�q\��\�\���.�\0���-�ͳ\�\�{�G\�\�S�\�e\��\�\Z7\n�	�i8xz�D�iI�/\�SF�v\�xf�8�4rF\�C�~\�Bu⺞�\0�RSс�W�iߴ�\�v���ry[�\�T�\�t��CX�g�,g2t`�O�\rO��a�\�}N�p�$UE�\\�=\�M�TX\�;\�J\r�1RgҐ\�:�4\�ӳH..ii���b\�H)hR\Z\\\�@��Ef\'�\�\����Qn.9�>{��\�\�j\�>Ks7\�\�*{Ù\�;�1�dc]Q4\�(���\�$63\�@\�\ZL\��\�\�D8���=)�5R��\�N����\�-\�R\�+�*�T�B[\�Yg�s>!�ׅ|1	�[\�-m�e�\�}���W�x\�\�v��<�w�\�\�;�=\��QꝔ{׌\�D�K��晿�F,\�}ry�\�4�9�U�����\�/y)��m�E.\�{w\n��)�My�\��\0k�j\�&��\�\"\�Qq�\���U��+#qj��N$S\�=k>\�\�K/��6�\�tGM�0q��w/��]�廹\�5��Xx\��H9d\�^�,R�\\��G_�j6ؑ\'a\��LT�\�#3\�8\�j0���2c��#M\�̲o\�\�I[�)��9F1\��\�$i�w_��\�G\�P	|�!�ǥJ\���I\�OJ6V#�=ΟG��;�4�\�Cn��B\�$F>�0<}+\�|)�C\�̱Z��\�\�e8V��]\�[�+\�ξu�vF)0*W���\�\"\��s\��}*\ZE&\��O�t�[M\�,\"\�t�\�om$Iap\�Eh\�|?\�\�\Z\�\n\�R\�J��ɜ\�ܐ\���}m\�\�\Z\�~2\�SQ�p	�^<\�\�ކ��;B�zH\�7g�8\Z�OQY������\r���5#\nQIJ(\Z(4P#��\'��\0&�!$\��g��+��_\�\�\�u�\�A��$��(Q\�w\��k��bRR�(���ҞzTM֚$�{w���W2\�A�ǵ|��\'\�7~4��\�+.�a�8b�;wr;�W��h�\�{��~�q��7_Ȝ`��\��9>�\�2I\�8\0\01�1\�޺��\�痾�ءsp�FY����#14�ܯ8�wQ\�#r�\���V���c<S��)B\�F\�\�!\�|\�\�h�B\�6\\�\n��2�,T�����e\�\�c����}	\�4\ZH�g%3\�5YJ/9�^��\�&D)a\�y�\�\�\�a#��\�cK�\�\��7\�\�y��\�&;&]���\�j�\�\���	��		�A\�sj>R�\��\'��\�p\�\�\rú�6\�a\�\�r)\�Aڝ,n��/�Z�\"\�/�\�̧>��ZU(1����\�٢G|��9e\�H.RB`\�{\��\�N�+�\�\�V��\�=c��\�z΁9e�݈\�:0��\�ApN\�\�\�yZ�%\�\�m\�מ�*mr�}�\�?h�;\�R�N�˺�����\�=z\�A\� \��\�\'�u_x��va\�DoF\�\'O\�F��\�_fx\�\Z_�|-��:���wV���\���\�+\�ư�C��GER�I �\�õ0GZz\�f������R�AK@�\�E\�|:�}3ᗇ4\�%�^\�\�(��\�\�(���j\�]���\�\�:�+*\�i��\�@hհ:\�\r��\0\�<V?�5�t-�V������\n\�c\�xo\�\�/�\�:G�`�\��v���\�\�#�\�\�\��\Z�/x\�oM�5\�%�̯4�Ks;\�H\�rY�\�?ΩErY��#�QY\�WL\�Nq�\�ݘ\�\�q�����ٜV��\��T�\�\�h\���4�q�,@��I&�1�g8R{W]g���2��>����\�N�\�&He�YB\�\0z��m\�-g�Z\�Kc�\0r~\\�\�C�/�@\'\�u�\�\�\�)nrQZH��w�}*\�2 ̄�8\�u��nR0	\�)�K*|��lq\�Z�Y�<4V\�\�M\��\�\Z���\�`��\roO�~�\\!S�Ϋ\�i\�n%7#��qʟQZ*�\�T\��ȂL\�\�du�\0\Z��2\"�\�.xb9R{}*\�\��\\� \�\\p~��.g\�\�^�{\�ѝ\�z�\�؞k�!\�:\�YS\�e��\r�J�*���Q2\�xb\'8���hF;���hم��~��-	E\�OUv\��{����@�Vv��/׎{S�\�̪P`g�MH��I���$��;WM�\�ǳ�9�\�\�$\�/v\�jP��S<J=Ԝ�l���.X0Fl?)\�W��0\�\0\';YOJM\\�\�ͥͽ\�7��$�Ӡ�)P\�]O �V�\�_:~̾2�F��|?��\�\�Lcuc�\�u�����$c�e���\�)=��wtu\'�%��T��)-\n)9��9\�\0D`�c\�hJ�)�Z�Q\�b\�J\��r�x\�\��dk�[�\�)pkr�\nJZJ\0c־/�\�\�W\�~*k\�`\�\�i�g\�\��\0��~U�eØ��lg\�R\��\n�\�\�u����b��2\\����m�f�ӹ+���\0j�\��T#<t��I !�8\�&�\nI#	\��e6�\��u┝���c����\�݇a�N��-l�i�\���\ni�V5\�\��쁡ٌt\�y\�\'�\�ѧes��O\r\�vL����\�\�\�D�r?\�]1�E�+\�Ԛ�G\���\0�\�88�]K#�4�\��\�ȹQ\�u\�)�\�h˸\�\�B5\�$`8P[�E2M!v\�\�RS5tY\�\Zhy��1\�5�q��c\�ʽ�zE֔\�\�@��\�\�\�~9\�Z)�7H�;\�/d\�H�78��`]\�O��,rA#��_\��m�\�<�H>\���5\�\\i^toB=G\"��\�i\�<�\� r\�9\�1\�\�P`\�\�\nI\�3]���%��*\�XWL��9o��Һ�R\��\�Re��l�yt��T�s�o,���\�\�,L\���v@c�\�B�OT�2\�H\�L\Z�SS\'I�ݔ\�]�)\0����Z�Һ�pv��}k)T�6A�jŤ�HU���Z3�\�\�x/\�2�;\�\�/��}�\�\\,7c8m)	&~�\r�\0��A�Gz�\��G,9�gS\�־��S�����·sH�\�,#�GrX�F61$�$�Z�\ZéۊZAKY��\�{▊(QE\�x\r&�ᯅ㸌\�2iV�\�z�W �9���tO���q�kO�iPIKHh��f\�\�UFX\��}pk�f\�)k2|�@V�\�W\�k�\�W�\�=|y�\�:��U����T�(\�+zo\�h稽\�\�5���F7�i\�\\^�	�8\��`vp�@�W�V�(\�\��\�+��\�V:�\���s�\���oo\�� 4�q\�*�\�N�Yn�H\�rf�\�<ck\Z\�l\��I\�y\�9\�{7�5�\�O\�D\0�\�Ҷ��_*]����\�/\�\�$�t��]E��m^%q2rq�\�U*,T�1�\�\�$g�oJ��*p�C\\�����\�ʮǫ���\���V\�\�nR\�\�X1-�GJ��^Z\�@\�=�ܚ��w]nG�9\�\�~�[�9��籬+\�\r���<\�;�s\�]$w\�\�$2�\�X�҆4\�L\n.�\�z�C�x^I��咸5\�j��Ks��Q�q^\�j�wH��\�j�֚�\�t\r\��c\�q\�\�<NӮ`�S�\�{���i#\�Ȍmnx\�k�����Y\�o-�\�+���\�6\�HIUɫr�0�b�<e))�\�\�\�U\�B\�\r۹��\�Z��3*��\�X�wFǡ1\�]��̏2�5\ZvO\�H$\�\'�v\�z��\�l2C�K\�\�!��\�=��_\rت&\��c\�_v�\Z�H~xad\�}�J������\���i�g��\�Қ:R�Y�h��QE\0T\�\"H4�8#\�\�\�D\\��\�p!�\�8\�\�U\nO�*J\0(=(������\��\�\�|I�\�\�GM̫��h�T?\�n\�_W\�\���#��J�#tOd\�)\��\�U(ݲ\\\�H�\�\�ɦՒ�9�m�헑f�\n+\�|;`�%\'m��\�^�inc����:ϙ��<�9\�n?�̯+\r�N\�q�\�t�ɖI0xn\rwW\�\�I���&�\�C\�6�|�@�H8�$\�g\�ֈ\�\�8��\�\\hZ\�\�oe)\�AQ\�\�kqH��X\�j.q�\��]����\�\�D�S�]��g\�=�\'�v{\�\�C$r��\�\n�dR;�\�޶|\�^\�/\�\�k�h�/ִ�X/�i�½\�\�Q]��!�\�k����\�=�R?���F�b��z�Wa\�j\�rOtvC�����C���\�ʉ���t\�Y��F\�3Q\�1\�N܁�ՓZ�<\�GR\�\��6\�\�G~�\�k_����\�t��q��1���\����=���V�Ku,\�\�N盜��m��um@ʊY��\�S��\�fq�\�GPG9#�\�mu\�uY\�v\�H\0\0[��k\�x����\�UU;I)�J\�Toh�~\�[\�E+8|ō����rA\�5\�٥ż��G*\�?�\�\\\��r���D���\0)?A޵�`bv��j���cm�\�Zg����k\�\�\�s��sҽ\�_�[`�x\�^G�B�\�\�4�U�t���&7ETC�\�\�\�Q޿C�/��\�\Z>�>�i��W\�~\�ƹ\�͡\�oq�[\�\�O��a�_��\�WL�\���ԣ�%(\�PjQE\0QE\0�Aӭ-\0QE\0��\����\��^^\�-�\�\�dm\��Uk\�Mp�d�\�j���\�\Z��ţZ-��k��ׇ��\��%^��KB\���b�(7��z\��\�f\Z�\�\�G1�3�\�]d�=��\�\�\�\n|�\�.�\���#1�����z�p��\r�7�\�K��d�#ҽqQ�$�J˾��!�\��L\�p�c\�<a����\�S�7��W;Cg�s~�=΋�hܴ(��\�\Z�\�޽\n�MM$` �3Y�����\��\�n\�\�\�\���;��xnA��ם� oܩ\��+��\�DQ�\�\��\�_\����o~Oq\�[�*�������\�Ψ\�VV,i�R<1�ߊ\�\�4\��]Һ�*6e\�k�:Vn�\Z�p\�\�5:\�S^E{Ow���Ak��\��	���m��LpG\�{\�u���$u���J���\�N2f.	ny�<1{��{�:��1�F&3\���Z����i��\�La�\0\"θ$�ny�\�Z�$d��O\�\0ՋVy6��c\�>c]_X}�7���5\�\Z/	\\-��\�\�j��H\��\�\rw�N�}T�\���z\��1��\�Z�Z�ڣ8�yTr{1���\�jzy{f\�\�+¼ai5���S�ø�ך�Nx\�\�x漇\�\�n�\0\��\�6�\�pk��\�qW�Do|\"�><\�m]6F��?�FW�l\n��@���7`_\\\�ub\0\�\�\�q\�.\��\�{B𢶦\�Wg%d��WA\���QE\0QE\0��JZJ(\0��(\05\�|J��o�4h!�y����x����:��z��wc*\�Y�eǾ8��V.\�g�\�@\�\�\�-�h�y�\��\�Z��E�E�<�+`���\��\�\'�p�\�c\�R����aq�1ښf8\'ֱ\�m\�ݪ\�l�\�\Z��j\��+��\�1m�`�\0�\�\�h�\�)\�3�i���L��(\�@�\�}�\�MgM#4\�(y��5v&F�q\�\ZHgY�\�R\��r++X�u̠c֭\�3F���ӊ���	\\�r\�<ե�\�\�\�4�6�����@��j��מI�r{\nv�reYv�\�泾�\�>m=Kn�}qވl� \'�\�B\��\��L`�\�l�T,;\"\\\�M\�\�2�\�.�S\\0=y�\�I+�L�ι\�gOK\�\�r���s�kB	��O\"�\�5��c�\�6\�\�{\�J\�\'�\�~ǧ�!�1�V�}�c��y�UU�a�ѫ\�\Zz\�~���l�e�\0h�Rkk\�d�\�\��I�QEQ!EPEP�\0ZZAޖ�\n(��\nB)h�#Ş:\�\�Q\�dH/\0ë�r:z�\�b\�\�\��KK�\�\��Fk\�s^G�>\�ǫ\�^���G��\� ����\��\�\�E*�IE\�pq!\��(1\�d�\�$\�>\�r\0lW�=x\�\�V\�K#6�R*��\�yo�\\B��\�fn�\�2I�\�sJ~RO�$�&���\�B\�MR\�n�\�\�}+\�/�?t���C!S�\�_Ƶ�n��>S\�?\�!\���g�Γ\�l\�v\������m�o+QГ\�S��\�շ[+�pa�jj*\�\�Z�k\�k+�ڒ+`\���\�d�i{�8�J�M\�:�.��\�nꃖ�O�E��X���jd�i	&j++���I.1�)���q���]ˆ8c޳CnĳI���*�χ�A��\Z\�i\�6H\�MI\ZG\�����\'#[K����+Kt/<\�j\'��z�����r���\"\�t>t�FR6�\'�\�|2\�\�\�ůvFa\�\�,O����mv\�\nڞUj�\� \�:S�)kC�(��\0(��\0(�<\n(\0#4���-\0QE\0�\Z(\rq��\�y\�)�b\\\�fD�\�\�]�z\�{����P\Z9�b9�Cv\��z\\O�⪡;�5j������u��	�$�C��\�\�T��$�	�;\�%us]&\�v;�)�\�\�j0\�e\�\�\� w�U\�.R\"\�L�1\�OY�-٣��G�I�	H\�)�\n\�fp�7���$q�\�(\�t`zւ\�x�b�KI]OhȦ޺\Z\�Z���\�a�a��~�\�}--S޹\�\�mJ\�1\�iב�Jg?�+j���\�\�P���\��Gb�\����\�Q�ڧ�Q\\\�k��\�\�L7 1��\��B.C���\�$�*���N2�ǭ�\0h$��8n\�\�wS�\�~�\�i\Z�^(l2�\��ں1.�\�sY��;���jh�w���w��\�Ns���XϬj��=�a=��a��e��5�\"\�g;+�\��M�/�$\�d\\>�1�s�\��W��\�}Ul�a�����]�\�Ʊ �\0`U�]\�hyMݶ8Qފ(h��(��\0CҊ�\0/�- \�K@%��\ni4dz\�\�Zd�\��������\�&��\�\�\nݸ\�\��ۘ96ё\�`�v�ַ>/�n�\�\�7�|\',wZ�n.1�;\�\�d\�A۩�?(\�O�x�\0B���\�-\�\�LK4�_\�bOr\�Z\�0�\�g<\�wd}!?��>�b\�{\�;P5�\��by�$�\�f-�`pk\�|Ug&�\��F\�71\�s\�z��pG\�_=h:�j�J��	{n\�out�\��2+��l\�zxy�\']�բim4�?4N\��\�RI\'#��7�\0�ӊ\�l��0P��\�\�92�NԂVۂy4ֈH\�#xͯ�|\�L�6��\Z\�\�Np�Z[B\�ک#�1/={\�ѡ�Y�N\'|\�\�)^\�\�A�\�i�v�\�\�H\�#�ORe&\�G�:\�\�Gx�\�ޞ�`H��E$�L�\\ǜ��\�\�B���\�\�\�w-1\�O�3�돆>6�=��\�5�L�\��c�A��w\�3VԗN\�\�\�\�C2�\���:`�G�[��􋕑۩���\�Uwc��iYl\�֙�h�ھ�}\�҇�h\�At�>��+T\Z�\'\�\�\rO\�ֲ�\��B�lj\Zz�n�tc�/R:0\�\�\r}��\�W��+MoD���N�O2\�\�ç\�A\��Һڱ����\�D�\�?\"��\�Ҏ��ijJE���n�Se`}h�WC��ȧSA㞴\� \0�q�Z-�_A\�\�Y��9�\�o�A���\�\�\��W\"\�\���O`q\��&�s�o\�!\��xIk�\��f\�]\��\�T��\���kX\�l\�U��>�\�|U��nѮ�\�b\�N�A9�@	�/S_5�N��\�\�\�fм\�Z[J&\�e]�Ј��G�A_=j����v\�ږ�=\�\��\�\�!w\'\0rOҫ��T\\d�\�=kX\�#7/u���ɷ(�s3nbNK\�\'�5\�|\'�g�š1߈|\�=���Ҹ��r\��pG\0\�m�~U�ⵓ�\�Ɍ��m�����3p1nS\��>\"\�RxK\�\�]�ӵ��\�tY���Q�\0�\�\�Q|�/\"���n\�\�\�\Z�\�\�\�\�tO�\��kC�X\�S�I�\�l�\�@\�r�֭&\� <^{�\��e\�\�u\�1\�@\�9�G���\�\�\\6r3^Z\�G�\�\�K�7dD�\�n�9\\(\���5E/�z��k��psު\�U,i\�2lzT2I��g�\�d�\�R\\q\�4�ls��\�Nh�{C\\�q\�\0��+�p3�\��l{\0Vɨ�\�U\�}\�A\�\r9�#\�b���\�C6\�\0����.L��\�+��Ԧ�U�\0]\�!Q$�J�\�8빦,&�ψ-�3j\�[�Yn\�\��>��[�9�(<!g+/2ƃ��+о�U|5��&L\�\�\�\�s\��^K�A_<W\��=\�I!Ϲ\0*�\�Rj\�O\'UJvG�Y\�*mnNNv���\�\�<~՚I\�<��\0��\�zg�1��Ȝ\�u=3Ү��Ľ2�\�J\�\�\�\�i���<9�R\��k\���8�E�\��\�\��\r{?��/�Ō�\�\�\�P\�7\�\��.O�x?�~}�KJ`��J��6\��\�4�S)NQz��i(*�Hҿ?�#�\�~x\�\�e��O�t�>ju\�	\�~�\�\�?���vh�i\�HQ5��c�\�\�ֱpf���\�\���N&�?��\0\�>)\\h���\��\0\�!&\��\�\�N�*\Z���{	?\�Z*;�|�������&�|\�\�ڊ孚?xhA1,��n\��{�\0��\�<W�{\�^*�\�Ե\�b�|�oi��\�:|���5\�\�LpT��\�]�\�\\f�.�����,�\�*�p>�To:�F�B\���\�&UH�\�\�pq\�\"���\0��\�\�:Z\�\�\��rs�Ԟf�\����T/B�2I\���H�;1��\�R�C\�u\�O\�\��;�6�\04\�w`0+��\�$\�cbG9�\�	I\��\�H|\�n\��Զi�Zqi�kT9\�3W\�\�L�X^\�\�S<�+��P\��\�>r��\�)\"�x�O�\�\0\�f�M\�6*ۑ�W\�:ޗ�\�DXT��+\�xV\�ºםx\�n�dzW����$z�Z\���\�K��2�T�iZq�$�{\�%e��GnK&:\�\�[\�\�2/ �s\\�v\�\�t\�\�n(Ȩ�\�rO�4\�Ԁ1\�Q1U�\�4��\'��\�\�!F2*�\��@�O\��\�*�\�Q\�,3��~[��R�}j\\\�.4��\�Πv��\'\�^��\��2O:x�T���m�?�\\��<s\�=A5+�q�@~Uo�j¾����\�\�T Q�@+�E�vr\�N1#u�\�E|��r�o�-\�c���-\�?S�M}S�_\�gk,�~\�_\�7\�>-ԯؒ\�\\3Oa^��\�Wl��l�FO!�Ո\�˗!OcUVRs�<g�I���X\�\�=l9[r\�]\�O=\�,��1�w\�R�!\�d;�S\0\�\0�\�c\�t�\�\�F\�b\�&\�N쑞�,Sɞq\�v�O\�&\�\�\�F)��V��nx�\�\��6�5\"��)�d��\�F����ҽW\�<y\�\"�k�\�,S\n`�%��\\r8�׍#\�2W\�\�Y�v�fD!w9��\�\��Yj}��~О�f�\�ʦC\�\�VQ�J��\�P(��4\�Q(l\�\�l�\0\�q\�X�4;m\\\�خ\��|�v�W���l�\�b��;s���\�\�P�\�\�Va�ΓƮ\�\0�V\�d�%�0\�9\�Y\�D\�/\�x#ޭ#e	yF\�?\�\�8�h\�b�dg֏�\r�\\��Jk�����E=@!x\�?�1\�+�\�0\�!�k[D;<E�	cq\�=\�3;_�䞆�4�zΘ�<\\\�O�\�3J�Ղ�Ϲ4�j�v\�۩Y@\�Y�6jFq�+y#ÃҶ\�\�\�@%�f�/x^\�ZҦ���rHu=��H\�S�f]č��N*\Z��\�\'t|?\��\0\�\Zܺu\�Ps\�_\\\�H\�\'\�\�O\\���\�~����^\"\�W%$\�O��\0\n�\�^���\�ۯ*\�\�\�+�;����y\�(\�\�z\�q\nj\�ܠ5�\����\�n�^R��͸���SC\���\�\�\��.���br�\���\�����]�\�6�L����\��*_�\�\��_}����iP��%\��쩯�4�\�\�\�+;H\"DQ���t��\��_ȹbA�i6\��[[�\"�%\n�AV�\�c��\n\�d\��\�\\ίs�YA\�z\�⢴<iɽY\��>՚=6\�#~v��+\�e\�]帑�9��<gK�_H\��#c\�ҾmFQ�\�{�}h�\�\�T\��I\��ҏ��L7n{SA!\0n��&���0=k;2�����\�\r�<1R��\\�\�|d�vl��=�0]J�X�׊wd\�\�a�s�1L�s���F\0`w\��Ѓ�8��0*\�8\�B�\��\�\�\0�Fs\�oZ�	].ԕ\�\�<�\�Uԑ���\�F\�!$\0q��ڋ\�W��\��\"�x�P�\��>W�\�**\�\���\0�{]��Jp�\'�lTT\�\�:Y$���\"\��,��ww\'��D�\���\�MI#cH�\\}MB\�?6~lSz]=�$r0@�&X�L	㊁��[��0*U?�$7<g#�Zw!ɵ��\���3\�\�i\�LFv�psQ!�\�F^pN?\Z���\0u\�\'�p��,e��\�\�`���1�2&r�)\���åUf!�\�R\� �\�\�N\n\�\�)\n\���\�\�ӡu\�QO\�[��W)\�ĸ�Ν26�\02\�`\� �\�>!�]\�<n\�\�\�R\�\n����\��s\�V\�֬\�u]kM\�t�/�[ج�c3\�\�\�ھ{�\�+i�a\�5�<���!T�\�O\�^G�x\�\\��,����G\"�m\�Q�����J�\�\�K�;\�`� ��+\�s�\�Pԭ\�b��)\�zg���·zƯ5\�\�\�\�\�QO���_\r]jpi\�i${<`o\�(�x��<;\�Km/Ws*\�4��\�G\\���սO\�\'�u�\�uifO\�&\�\�2:\�q���ci\��S>�\�t�+\����\Z�Ā(�B�\�\��z=�w� ��{�ؒa�P+\��Ʃ�\�\�R\�\�#��\�\�,��\�\�wֺ���1�Ԧ�:\��\0W�\�i�\�.EG��z�}f+K�W�WS�ޫ�D<9yk-��#\��;�u)�����\0�!�^�\r��%��s\�-�\�ǯb=�}/�\�ㅇ�L:��+\rk\0E/ݎ\�\�\�\�դb\�DsFZ�z\��\�4#�rW�\�nf\�\�Mv\ZS����ֱ�!°�\�\�M\�c˼m\Z\��;W��\"\���W\��|�oP3����\�\�\�\��6Վ9`��{���B�ۖ\�:�Φ\�Z\�T`A��GJF<�\�*%%�\�\�5\'\�2�5�CK	�y\�\�珥\"ld]ĀM)9\�\�\��6/�o#6	�+���%Pw0Q�A8\�i�s\�v\�)��m\�1�硡0	E=\�I^\�!�q\���\�\�N����3Ў\0��c�@\0\��:>yQ�``zP�Ի�\�S�dg1���\��\Z+C�w�����w�CC���?h��$�\\ocǜ�\�q���@3Ϡ�\\\'S���n\�0	�\�ͭ�\�Z��AnF9��+|��\0x�\0�1\��d\�\�\�O`=���\�(ϖ���c\�R!j2G@{\�Q\�P4�\�jy9\�9��q�v�\�v��\�\ryd\"�\�C�\�N\�E�%O\0�N�\r%�\�o\�}v?�\�\Z���KT���q��W �\�s6�%\�ؑ��]3�I$�s��I�_����\��\"\�af�A���Im:�&�,�8\�k�	5s6ާ�\��gWӠ]sCtR�Y!�\�8 �JȾ�jW�^��nλfL	f��m\�\�ݕG�(˯`}k\�>\"�m�k�w�q36LGi����\���Ԫ<�\�U\�\�_A�\��e�$\�:�d�?�X\�c�LD>;�WIg�\�ܠ`VIs����?\ZО�TE2y�G	>Q�n�\\̪ї%x\�\��\'�P\�G�#Ϛ2\��G\�zV\�\�}OMJn-ѾX݈h\��\�}:T�z_n\�.2`�\�q\�=~��&Wu`Ac��^�b4Y\�\�\�Vô�#\�F����Ĕ\�\�$��\�\�$Q�>�?\Z�\�\�:[=d\�G�.\�\�6\�2��\�U>\�qe\"_[HVH\�3�n\�Ezn�\��+�\"�\�\�\n��ڳ��d(\��#\���U���\�A�H\��O#���\0��b��\�H���2��!��|�4I㑭����\'�3�\��׌�\�\n}6\�K�h�0�K\���=��qz]7���\�\�G\��\�w`\�ݢ�\�_;��\�\��5\��\0u\�-cH\�[M�K�$��\�pW�\�k\�T�`O�\"���5�\�\�(\�23\�\�f�O\�\�\ZA���9\�Z�����\�\�f�\�\�#R�!]��2)*�ch�\'�jq ��@9�.7r\�jl�t�sӾ)P\0��eb\�8\�F��Q��h�\��\�\�<\�N��\�!$ϐ3��)\�cy�\�nj$rŲ�N	��\�]�W\���#D�=��x��\�\��\�P\�$d\�\�$n\�\� ����|�\0�[��ŀ�\��\0\�x���\���O\�A@A\�Bđ\�s�*YWjd\�w\��1\�\'󤬾FvW\"b6(\'\'8\'ԋ���\�)�BA\��\�$2\�\�\�\�V�W��\�(\�\�I\�ҁ�\'��1�H\0s�\�7��:sRǧP�K0PB\���\�\�`/^&��� \���q\�\�.h�6M����S�\0����K�P�zW�ʛ�\�`0D$���\0\0LN�}\�7�Lzekެ��	\�l\��l�_S.\�VX�\�d!�yŽͩi�\��g\�k\�v��3r񀿝yߏ�h��J\�%��\n�,lc\��a�\Z\�ng+u<��8㌚Զ\�\�\�#-\�E�c�n�\Z����6u5��l\�\�܉c<�Ȭ\�\��[��8\�L\��\n�\�W3���&\�$t����\�y!�\���G\�>��}i\�?�\�zy�a�\�\���U�bs&W�j�g��$,\�3�)9*=��\n�^\�Iա+�\��\����%\�\�\�	�&::W�\�\�`�\\�d~B�O�\�lwZ����\�Ъg�^\�\�˸�v8\�+���R*R\��+\�T\�\�����\�S����\�-�\�¤�\���\�ガ1B&\�vq��lcc\��0\�Z��᷌G�\�Tq����\�.��\�> J[\����\0�m�ی\�(��\�I\��\�,\�\�tCX\�2<c;�䎴�&I$N\�@iʫ\��\0�P�K2�\�8��aeq�\�H\�\�#�9\�5�bCm<�GҦ\��c���\�/\�\�3۽S��@W\r��FR94\�0\"��\�\�RG\�Nq����>Trz{T۫���6�\�$�gޤ�\�b��\�4*�^��\�\�ءّm.�=\��`�:�N\�e�Ud](\�\�&e=��S�\0f[	\��c\�3���#\��27�QE\�RL�9-$�r#m��q\�ҡ��	9\�5�s�i\�{\�\�\�-ؕ\�&%9>�*�\�`\'�E��p#_A\�Bv4\�OS�TYH\�A\\�q\�jF�m\�\�\�9\�_�zV��<\�-�ɅO���hM!-�\�1\�y6\��=6?1�2\�R��\�Jm[8\��\�Z�:_x{���\�\��\n��J�7�|8\�6\�\��\�G\�J����gݸc�\�\�N[W��_�3x[\��|9������\�{UI�%\�R�>\�I\���G\�?٢�S\��\0��\�}c�R �}�w�\�u�LO̶\�IJ�[_�j\�\�e�����ܖ��\�}@���6�\n\�\�\�Vq\�Nv���V񝴱��vxf�g\'\�\�1�\"=\���^e\���\�Ȃ}����-\�`��e`T���RӴ���m��\�\01�3��񆉣9�\�H�g\0ۡ n<t�9�1仱\�\�z߉5˨[H��\�.\�\�77p!�yyW\�=�\�߃�U:�\�\�V�~d�\�\�\�\�g_\��W��y�s�\��L$�=��-�\�\Z\�|t\�\��\0��V{/�\0\�!�棵�\0v>`\0�\�h��\�d|\�ig%��`Y\�[��X\�?^�HZ1��d���Q���}N�Z\�U�\�0@�GJe���Y[�ZB�ѱ$F<����{)\�\�6~\Z@m��%\�\�Q����(�;m]H\�\�<��!�c\�;zv\�ҽ24U��*�\�\�V1f�\�\�H\�\�2z�a@�\�\�J�\0\�V����ρ��\�8\�\0\�f�u��\��K\�\�\�|u\�X�£#��\�Xx#�k�\�	>-\�A9�\0M��\�\�ED.���[�PF\'�\�V\��\�x�n@9�v1\�:Ԉ�������B]K\�c$!N:��*8\�\�,\�pA5���`F>��\�Q\�zRd�(y;K1\� �*��\�PH���U�F\�(7�U\0����6�BKK��B$\�׮)�\�&J�d�\���W�})�T3aGAڥ�3ؿg	d�\�^%�7u_�ۦTu�\�<\�[��x\�(\�6X��\0��R3q��\�');
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
