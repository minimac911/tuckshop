-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: dbtuckshop
-- ------------------------------------------------------
-- Server version	8.0.15

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
-- Table structure for table `invoice_bridge`
--

DROP TABLE IF EXISTS `invoice_bridge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `invoice_bridge` (
  `idInvoice` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  PRIMARY KEY (`idInvoice`,`idOrder`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_bridge`
--

LOCK TABLES `invoice_bridge` WRITE;
/*!40000 ALTER TABLE `invoice_bridge` DISABLE KEYS */;
INSERT INTO `invoice_bridge` VALUES (1,1),(1,2),(2,3),(3,4),(3,5),(4,6),(4,7),(5,8),(6,10),(6,11);
/*!40000 ALTER TABLE `invoice_bridge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_category`
--

DROP TABLE IF EXISTS `item_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `item_category` (
  `idCategory` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`idCategory`),
  UNIQUE KEY `idCategory_UNIQUE` (`idCategory`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_category`
--

LOCK TABLES `item_category` WRITE;
/*!40000 ALTER TABLE `item_category` DISABLE KEYS */;
INSERT INTO `item_category` VALUES (1,'TOASTED SANDWICHES'),(2,'ROLLS'),(3,'TRAMEZZINIS AND WRAPS'),(4,'BURGERS'),(5,'HOTDOGS'),(6,'SNACKS'),(7,'DRINKS'),(8,'ICE CREAM'),(9,'OTHER'),(10,'BREAKFAST');
/*!40000 ALTER TABLE `item_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pwdreset`
--

DROP TABLE IF EXISTS `pwdreset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetExpires` datetime NOT NULL,
  `pwdResetSelector` varchar(255) NOT NULL,
  `pwdResetToken` varchar(255) NOT NULL,
  PRIMARY KEY (`pwdResetId`),
  UNIQUE KEY `pwdResetId_UNIQUE` (`pwdResetId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pwdreset`
--

LOCK TABLES `pwdreset` WRITE;
/*!40000 ALTER TABLE `pwdreset` DISABLE KEYS */;
/*!40000 ALTER TABLE `pwdreset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblchildren`
--

DROP TABLE IF EXISTS `tblchildren`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tblchildren` (
  `idChild` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `firstNameChild` text NOT NULL,
  `lastNameChild` text NOT NULL,
  `classChild` text NOT NULL,
  `gradeChild` text NOT NULL,
  PRIMARY KEY (`idChild`),
  UNIQUE KEY `idChild_UNIQUE` (`idChild`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblchildren`
--

LOCK TABLES `tblchildren` WRITE;
/*!40000 ALTER TABLE `tblchildren` DISABLE KEYS */;
INSERT INTO `tblchildren` VALUES (1,1,'A','B','J','3'),(2,1,'C','D','J','6');
/*!40000 ALTER TABLE `tblchildren` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblinvoice`
--

DROP TABLE IF EXISTS `tblinvoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tblinvoice` (
  `idInvoice` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `datePaid` datetime NOT NULL,
  PRIMARY KEY (`idInvoice`),
  UNIQUE KEY `idInvoice_UNIQUE` (`idInvoice`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblinvoice`
--

LOCK TABLES `tblinvoice` WRITE;
/*!40000 ALTER TABLE `tblinvoice` DISABLE KEYS */;
INSERT INTO `tblinvoice` VALUES (1,1,'2019-03-20 10:00:56'),(2,1,'2019-03-20 11:44:11'),(3,1,'2019-03-20 11:59:45'),(4,1,'2019-03-20 12:00:31'),(5,1,'2019-03-22 12:06:49'),(6,1,'2019-03-22 12:11:53');
/*!40000 ALTER TABLE `tblinvoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblorder_cart`
--

DROP TABLE IF EXISTS `tblorder_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tblorder_cart` (
  `idOrder` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblorder_cart`
--

LOCK TABLES `tblorder_cart` WRITE;
/*!40000 ALTER TABLE `tblorder_cart` DISABLE KEYS */;
INSERT INTO `tblorder_cart` VALUES (1,1,15,1),(1,4,20,1),(2,4,20,1),(2,2,15,1),(3,2,30,2),(3,7,25,1),(4,3,40,2),(4,5,25,1),(5,20,25,1),(5,21,5,1),(6,1,30,2),(6,4,20,1),(7,9,20,1),(7,11,25,1),(7,13,25,1),(7,14,28,1),(8,31,3,1),(8,30,8,1),(10,3,30,2),(10,6,15,1),(11,16,8,1),(11,18,8,1),(11,3,15,1),(12,3,30,2);
/*!40000 ALTER TABLE `tblorder_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblorder_days`
--

DROP TABLE IF EXISTS `tblorder_days`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tblorder_days` (
  `idOrderDay` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(5) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `day` varchar(255) NOT NULL,
  PRIMARY KEY (`idOrderDay`),
  UNIQUE KEY `idOrderDay_UNIQUE` (`idOrderDay`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblorder_days`
--

LOCK TABLES `tblorder_days` WRITE;
/*!40000 ALTER TABLE `tblorder_days` DISABLE KEYS */;
INSERT INTO `tblorder_days` VALUES (1,'RR',NULL,'any'),(2,'R',NULL,'any'),(3,'1',NULL,'any'),(4,'2',NULL,'any'),(5,'3',NULL,'any'),(6,'4',NULL,'any'),(7,'5',NULL,'any'),(8,'6',NULL,'any');
/*!40000 ALTER TABLE `tblorder_days` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblorders`
--

DROP TABLE IF EXISTS `tblorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tblorders` (
  `idOrder` int(11) NOT NULL AUTO_INCREMENT,
  `idChild` int(11) NOT NULL DEFAULT '-1',
  `idParent` int(11) NOT NULL DEFAULT '-1',
  `totalPrice` double NOT NULL DEFAULT '-1',
  `dateOrdered` datetime NOT NULL,
  `dueDate` datetime NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT '0',
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idOrder`),
  UNIQUE KEY `idOrder_UNIQUE` (`idOrder`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblorders`
--

LOCK TABLES `tblorders` WRITE;
/*!40000 ALTER TABLE `tblorders` DISABLE KEYS */;
INSERT INTO `tblorders` VALUES (1,1,1,35,'2019-03-20 10:00:49','2019-03-20 07:00:00',1,1),(2,1,1,35,'2019-03-20 10:00:53','2019-03-22 07:00:00',1,1),(3,1,1,55,'2019-03-20 11:44:08','2019-03-21 07:00:00',1,1),(4,1,1,65,'2019-03-20 11:59:01','2019-03-27 07:00:00',0,1),(5,1,1,30,'2019-03-20 11:59:07','2019-03-25 07:00:00',0,1),(6,2,1,50,'2019-03-20 12:00:18','2019-03-21 07:00:00',1,1),(7,2,1,98,'2019-03-20 12:00:27','2019-03-22 07:00:00',1,1),(8,1,1,11,'2019-03-22 12:06:42','2019-03-26 07:00:00',0,1),(10,2,1,45,'2019-03-22 12:11:26','2019-03-25 07:00:00',0,1),(11,2,1,31,'2019-03-22 12:11:36','2019-03-26 07:00:00',0,1),(12,2,1,30,'2019-03-22 14:40:13','2019-03-27 07:00:00',0,0);
/*!40000 ALTER TABLE `tblorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblshopitems`
--

DROP TABLE IF EXISTS `tblshopitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tblshopitems` (
  `idItem` int(11) NOT NULL AUTO_INCREMENT,
  `nameItem` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Original',
  `category` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sub_category` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `priceItem` double DEFAULT NULL,
  `isGr3AndUpItems` tinyint(4) DEFAULT NULL,
  `isGrRRItems` tinyint(4) DEFAULT NULL,
  `isGrRTo2Items` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idItem`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblshopitems`
--

LOCK TABLES `tblshopitems` WRITE;
/*!40000 ALTER TABLE `tblshopitems` DISABLE KEYS */;
INSERT INTO `tblshopitems` VALUES (1,'Energade green','DRINKS','DRINKS',15,1,NULL,NULL),(2,'Energade red','DRINKS','DRINKS',15,1,NULL,NULL),(3,'Energade blue','DRINKS','DRINKS',15,1,NULL,NULL),(4,'Energade purple','DRINKS','DRINKS',15,1,NULL,NULL),(6,'Graptiser apple','DRINKS','DRINKS',15,1,NULL,NULL),(7,'Graptiser grape','DRINKS','DRINKS',15,1,NULL,NULL),(8,'Coke (bottle)','DRINKS','DRINKS',15,1,NULL,NULL),(9,'Coke zero (bottle)','DRINKS','DRINKS',15,1,NULL,NULL),(10,'Sprite (can)','DRINKS','DRINKS',12,1,NULL,NULL),(11,'Twist granidilla (can)','DRINKS','DRINKS',12,1,NULL,NULL),(12,'twist lemon (can)','DRINKS','DRINKS',12,1,NULL,NULL),(13,'diet coke (can)','DRINKS','DRINKS',12,1,NULL,NULL),(14,'coke zero (can)','DRINKS','DRINKS',12,1,NULL,NULL),(15,'coke (can)','DRINKS','DRINKS',12,1,NULL,NULL),(16,'Lay\'s salted','SNACKS','CHIPS',8,1,NULL,NULL),(17,'Lay\'s salt and vinegar','SNACKS','CHIPS',8,1,NULL,NULL),(18,'Lay\'s Caribbean onion and balsamic','SNACKS','CHIPS',8,1,NULL,NULL),(19,'Lay\'s sour cream and onion','SNACKS','CHIPS',8,1,NULL,NULL),(20,'Lay\'s Italian cheese','SNACKS','CHIPS',8,1,NULL,NULL),(21,'Lay\'s sweet chilli','SNACKS','CHIPS',8,1,NULL,NULL),(22,'Lay\'s spring onion and cheese','SNACKS','CHIPS',8,1,NULL,NULL),(23,'Lay\'s Portuguese prego','SNACKS','CHIPS',8,1,NULL,NULL),(24,'Doritos sweet chilli pepper','SNACKS','CHIPS',8,1,NULL,NULL),(25,'Doritos sweet cheese','SNACKS','CHIPS',8,1,NULL,NULL),(26,'Simba chutney','SNACKS','CHIPS',8,1,NULL,NULL),(27,'Simba beef','SNACKS','CHIPS',8,1,NULL,NULL),(28,'Ghost pops','SNACKS','CHIPS',8,1,NULL,NULL),(29,'Fritos tomato','SNACKS','CHIPS',8,1,NULL,NULL),(30,'Fritos barbeque','SNACKS','CHIPS',8,1,NULL,NULL),(31,'Super C','SNACKS','SWEETS',3,1,NULL,NULL),(32,'wine Gums','SNACKS','SWEETS',8,1,NULL,NULL),(33,'X Rolls Grape','SNACKS','SWEETS',4,1,NULL,NULL),(34,'X Rolls Spearmint','SNACKS','SWEETS',4,1,NULL,NULL),(35,'X Rolls Mint','SNACKS','SWEETS',4,1,NULL,NULL),(36,'Maynard dual magic','SNACKS','SWEETS',10,1,NULL,NULL),(37,'Maynard wine gum duos','SNACKS','SWEETS',10,1,NULL,NULL),(38,'Maynard funky flavour jelly babies','SNACKS','SWEETS',10,1,NULL,NULL),(39,'Maynard jelly beans','SNACKS','SWEETS',10,1,NULL,NULL),(40,'Maynard fruit with','SNACKS','SWEETS',10,1,NULL,NULL),(41,'Maynard jelly jerseys','SNACKS','SWEETS',10,1,NULL,NULL),(42,'Maynard sour jelly babies','SNACKS','SWEETS',10,1,NULL,NULL),(43,'PS','SNACKS','CHOCOLATES',5,1,NULL,NULL),(44,'Smarties','SNACKS','CHOCOLATES',10,1,NULL,NULL),(45,'Astros','SNACKS','CHOCOLATES',10,1,NULL,NULL),(46,'BAR.ONE','SNACKS','CHOCOLATES',10,1,NULL,NULL),(47,'Kit Kat','SNACKS','CHOCOLATES',5,1,NULL,NULL),(48,'Tex','SNACKS','CHOCOLATES',5,1,NULL,NULL),(49,'Flake','SNACKS','CHOCOLATES',10,1,NULL,NULL),(50,'BAR.ONE(Small)','SNACKS','CHOCOLATES',5,1,NULL,NULL),(51,'Wonder Bar Green','SNACKS','CHOCOLATES',5,1,NULL,NULL),(52,'Wonder Bar Blue','SNACKS','CHOCOLATES',5,1,NULL,NULL),(53,'Wonder Bar Orange','SNACKS','CHOCOLATES',5,1,NULL,NULL),(54,'Crunchie','SNACKS','CHOCOLATES',10,1,NULL,NULL),(55,'Astros','SNACKS','CHOCOLATES',10,1,NULL,NULL),(56,'Rolo','SNACKS','CHOCOLATES',10,1,NULL,NULL),(57,'5 Star','SNACKS','CHOCOLATES',10,1,NULL,NULL),(58,'Dairy Milk Caramelized','SNACKS','CHOCOLATES',10,1,NULL,NULL),(59,'Dairy Jelly Poppin Candy','SNACKS','CHOCOLATES',10,1,NULL,NULL),(60,'Jelly Tots','SNACKS','SWEETS',7,1,NULL,NULL),(61,'Energy Bar Strawberry','SNACKS','SWEETS',12,1,NULL,NULL),(62,'Energy Bar Chocolate','SNACKS','SWEETS',12,1,NULL,NULL),(63,'Energy Bar Lemon Lime','SNACKS','SWEETS',12,1,NULL,NULL),(64,'Energy Bar Choc strawberry','SNACKS','SWEETS',12,1,NULL,NULL),(65,'Energy Bar(Small) Choc strawberry','SNACKS','SWEETS',6,1,NULL,NULL),(66,'Energy Bar(Small) strawberry','SNACKS','SWEETS',6,1,NULL,NULL),(67,'Corn Nibs salt and vinegar','SNACKS','SWEETS',5,1,NULL,NULL),(68,'Corn Nibs tomato','SNACKS','SWEETS',5,1,NULL,NULL),(69,'Corn Nibs chutney','SNACKS','SWEETS',5,1,NULL,NULL),(70,'Corn Nibs barbeque','SNACKS','SWEETS',5,1,NULL,NULL),(71,'Oreo golden','SNACKS','SWEETS',8,1,NULL,NULL),(72,'Oreo chocolate','SNACKS','SWEETS',8,1,NULL,NULL),(73,'Jungle Oats Bar Nuts','SNACKS','SWEETS',10,1,NULL,NULL),(74,'Jungle Oats Bar Milk Chocolate','SNACKS','SWEETS',10,1,NULL,NULL),(75,'Jungle Oats Bar Peanut Butter','SNACKS','SWEETS',10,1,NULL,NULL),(76,'Jungle Oats Bar Yoghurt','SNACKS','SWEETS',10,1,NULL,NULL),(77,'M&M\'s Peanut','SNACKS','SWEETS',8,1,NULL,NULL),(78,'M&M\'s Chocolate','SNACKS','SWEETS',8,1,NULL,NULL),(79,'Mints','SNACKS','SWEETS',10,1,NULL,NULL),(80,'All Sorts','SNACKS','SWEETS',10,1,NULL,NULL),(81,'home made fudge','SNACKS','SWEETS',NULL,1,NULL,NULL),(82,'Ceres orange','DRINKS','DRINKS',8,1,NULL,NULL),(83,'Ceres mango','DRINKS','DRINKS',8,1,NULL,NULL),(84,'Ceres hanepoot','DRINKS','DRINKS',8,1,NULL,NULL),(85,'Ceres litchi','DRINKS','DRINKS',8,1,NULL,NULL),(86,'Ceres whispers summer','DRINKS','DRINKS',8,1,NULL,NULL),(87,'Ice Tea SIR FRUIT Cranberry','DRINKS','DRINKS',10,1,NULL,NULL),(88,'Ice Tea SIR FRUIT Lemon and Lime','DRINKS','DRINKS',10,1,NULL,NULL),(89,'Ice Tea SIR FRUIT Apple and Mint','DRINKS','DRINKS',10,1,NULL,NULL),(90,'Ice Tea SIR FRUIT Peach','DRINKS','DRINKS',10,1,NULL,NULL),(91,'Flavoured Water cranberry raspberry','DRINKS','DRINKS',12,1,NULL,NULL),(92,'Flavoured Water passion fruit','DRINKS','DRINKS',12,1,NULL,NULL),(93,'Flavoured Water lemon lime','DRINKS','DRINKS',12,1,NULL,NULL),(94,'Flavoured Water naartjie','DRINKS','DRINKS',12,1,NULL,NULL),(95,'Flavoured Water peach','DRINKS','DRINKS',12,1,NULL,NULL),(96,'Flavoured Water strawberry line','DRINKS','DRINKS',12,1,NULL,NULL),(97,'Water','DRINKS','DRINKS',10,1,NULL,NULL),(98,'Steri Stumpi Cranberry','DRINKS','DRINKS',15,1,NULL,NULL),(99,'Steri Stumpi Chocoloate','DRINKS','DRINKS',15,1,NULL,NULL),(100,'Steri Stumpi Marshmallow','DRINKS','DRINKS',15,1,NULL,NULL),(101,'Steri Stumpi(Small) Strawberry','DRINKS','DRINKS',8,1,NULL,NULL),(102,'Steri Stumpi(Small) Chocolate','DRINKS','DRINKS',8,1,NULL,NULL),(103,'Milo','DRINKS','DRINKS',10,1,NULL,NULL),(104,'Milk','DRINKS','DRINKS',8,1,NULL,NULL),(105,'Ice Tea Lipton Peach','DRINKS','DRINKS',10,1,NULL,NULL),(106,'Ice Tea Lipton Lemon','DRINKS','DRINKS',10,1,NULL,NULL),(107,'Ice Tea BOS Lemon','DRINKS','DRINKS',15,1,NULL,NULL),(108,'Ice Tea BOS Peach','DRINKS','DRINKS',15,1,NULL,NULL),(109,'Ice Tea BOS Berry','DRINKS','DRINKS',15,1,NULL,NULL),(110,'Heart sweets','SNACKS','SWEETS',0.5,1,NULL,NULL),(111,'Sour Bombs','SNACKS','SWEETS',0.5,1,NULL,NULL),(112,'Pengos','SNACKS','SWEETS',0.5,1,NULL,NULL),(113,'Eclairs','SNACKS','SWEETS',0.5,1,NULL,NULL),(114,'Sour Pengos','SNACKS','SWEETS',1,1,NULL,NULL),(115,'Choki Choki','SNACKS','SWEETS',1,1,NULL,NULL),(116,'Sour Bombs(Big)','SNACKS','SWEETS',1,1,NULL,NULL),(117,'Mini Fizzers','SNACKS','SWEETS',1,1,NULL,NULL),(118,'Champion Toffees','SNACKS','SWEETS',1,1,NULL,NULL),(119,'Gummy Snakes/Watches','SNACKS','SWEETS',1.5,1,NULL,NULL),(120,'Strips','SNACKS','SWEETS',2,1,NULL,NULL),(121,'Apricots','SNACKS','SWEETS',2,1,NULL,NULL),(122,'Big Fizzers','SNACKS','SWEETS',2,1,NULL,NULL),(123,'Lolliops','SNACKS','SWEETS',2,1,NULL,NULL),(124,'Smarties(Small)','SNACKS','CHOCOLATES',5,1,NULL,NULL),(125,'Cheese','HOT FOOD','TOASTED SANDWICHES',15,1,NULL,NULL),(126,'Cheese and Tomato','HOT FOOD','TOASTED SANDWICHES',15,1,NULL,NULL),(127,'Cheese and Ham','HOT FOOD','TOASTED SANDWICHES',20,1,NULL,NULL),(128,'Cheese, Ham and Tomato','HOT FOOD','TOASTED SANDWICHES',20,1,NULL,NULL),(129,'Tuna Mayo','HOT FOOD','TOASTED SANDWICHES',25,1,NULL,NULL),(130,'Chicken Mayo','HOT FOOD','TOASTED SANDWICHES',25,1,NULL,NULL),(131,'Mince and Cheese','HOT FOOD','TOASTED SANDWICHES',25,1,NULL,NULL),(132,'Egg Mayo','HOT FOOD','ROLLS',20,1,NULL,NULL),(133,'Salad and Cheese','HOT FOOD','ROLLS',20,1,NULL,NULL),(134,'Chicken Mayo','HOT FOOD','ROLLS',25,1,NULL,NULL),(135,'Tuna Mayo and Gherkins','HOT FOOD','ROLLS',25,1,NULL,NULL),(136,'Cheese and Tomato','HOT FOOD','TRAMEZZINIS AND WRAPS',20,1,NULL,NULL),(137,'Chicken','HOT FOOD','TRAMEZZINIS AND WRAPS',25,1,NULL,NULL),(138,'Mince and Cheese','HOT FOOD','TRAMEZZINIS AND WRAPS',28,1,NULL,NULL),(139,'Chicken Mayo and Salad','HOT FOOD','TRAMEZZINIS AND WRAPS',25,1,NULL,NULL),(140,'Chicken Burger','HOT FOOD','BURGERS',20,1,NULL,NULL),(141,'Vegetarian Burger','HOT FOOD','BURGERS',20,1,NULL,NULL),(142,'Chicken Hotdog','HOT FOOD','HOTDOGS',15,1,NULL,NULL),(143,'Vegetarian Hotdog','HOT FOOD','HOTDOGS',15,1,NULL,NULL),(144,'Chicken Nuggets','OTHER','OTHER',25,1,NULL,NULL),(145,'Hard Boiled Egg','OTHER','OTHER',5,1,NULL,NULL),(146,'Crazy Pops','ICE CREAM','ICE CREAM',2,1,NULL,NULL),(147,'Fruit Lollies','ICE CREAM','ICE CREAM',3,1,NULL,NULL),(148,'Milk Lollies','ICE CREAM','ICE CREAM',5,1,NULL,NULL),(149,'Ice Cream Tubs','ICE CREAM','ICE CREAM',12,1,NULL,NULL),(150,'Ice Cream Cones','ICE CREAM','ICE CREAM',12,1,NULL,NULL),(151,'Fruit','BREAKFAST','BREAKFAST',3,1,NULL,NULL),(152,'Peanut Butter Toast','BREAKFAST','BREAKFAST',3,1,NULL,NULL),(153,'Yoghurt Pot','BREAKFAST','BREAKFAST',5,1,NULL,NULL),(154,'Jungle Oats Porridge','BREAKFAST','BREAKFAST',6,1,NULL,NULL),(155,'Cheese Wedges','BREAKFAST','BREAKFAST',6,1,NULL,NULL),(156,'Fresh Popcorn','SNACKS','SAVOURY',6,1,NULL,NULL),(157,'Peanut Snack','SNACKS','SAVOURY',7,1,NULL,NULL),(158,'Peanut & Raisins','SNACKS','SAVOURY',6,1,NULL,NULL),(159,'Fruit Sticks','SNACKS','SAVOURY',5,1,NULL,NULL),(160,'Brownies','SNACKS','SWEET',8,1,NULL,NULL),(161,'Big Biscut','SNACKS','SWEET',8,1,NULL,NULL),(162,'Rascals Fruity','SNACKS','SWEET',10,1,NULL,NULL),(163,'Rascals Sours','SNACKS','SWEET',10,1,NULL,NULL),(164,'Rascals Wild Berry','SNACKS','SWEET',10,1,NULL,NULL);
/*!40000 ALTER TABLE `tblshopitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_items`
--

DROP TABLE IF EXISTS `temp_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `temp_items` (
  `idItem` int(11) NOT NULL AUTO_INCREMENT,
  `nameItem` varchar(255) NOT NULL,
  `priceItem` double NOT NULL,
  `idCategory` int(11) NOT NULL,
  `isGr3AndUpItems` tinyint(4) NOT NULL,
  `isGrRRItem` tinyint(4) NOT NULL,
  `isGrRTo2Items` tinyint(4) NOT NULL,
  PRIMARY KEY (`idItem`),
  UNIQUE KEY `idItem_UNIQUE` (`idItem`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_items`
--

LOCK TABLES `temp_items` WRITE;
/*!40000 ALTER TABLE `temp_items` DISABLE KEYS */;
INSERT INTO `temp_items` VALUES (1,'Cheese',15,1,1,0,0),(2,'Cheese and Tomato',15,1,1,0,0),(3,'Cheese and Ham',20,1,1,0,0),(4,'Cheese, Ham and Tomato',20,1,1,0,0),(5,'Tuna Mayo',25,1,1,0,0),(6,'Chicken Mayo',25,1,1,0,0),(7,'Mince and Cheese',25,1,1,0,0),(8,'Egg Mayo',20,2,1,0,0),(9,'Salad and Cheese',20,2,1,0,0),(10,'Chicken Mayo',25,2,1,0,0),(11,'Tuna Mayo and Gherkins',25,2,1,0,0),(12,'Cheese and Tomato',20,3,1,0,0),(13,'Chicken',25,3,1,0,0),(14,'Mince and Cheese',28,3,1,0,0),(15,'Chicken Mayo and Salad',25,3,1,0,0),(16,'Chicken Burger',20,4,1,0,0),(17,'Vegetarian Burger',20,4,1,0,0),(18,'Chicken Hotdog',15,5,1,0,0),(19,'Vegetarian Hotdog',15,5,1,0,0),(20,'Chicken Nuggets',25,9,1,0,0),(21,'Hard Boiled Egg',5,9,1,0,0),(22,'Crisps',8,6,1,0,0),(23,'Fresh Popcorn',6,6,1,0,0),(24,'Peanut Snack',7,6,1,0,0),(25,'Peanuts & Raisins',6,6,1,0,0),(26,'Corn Nibs',5,6,1,0,0),(27,'Fruit Sticks',5,6,1,0,0),(28,'Chocolates',10,6,1,0,0),(29,'Mini Chocolates',5,6,1,0,0),(30,'Energy Bar',12,6,1,0,0),(31,'Mini Energy Bar',6,6,1,0,0),(32,'Jungle Oats Bar',10,6,1,0,0),(33,'Brownies',8,6,1,0,0),(34,'Big Biscuit',8,6,1,0,0),(35,'Oreos',8,6,1,0,0),(36,'Maynards Gums',10,6,1,0,0),(37,'Rascals',10,6,1,0,0),(38,'Wine Gums',8,6,1,0,0),(39,'Jelly Tots',7,6,1,0,0),(40,'X-Rolls',4,6,1,0,0),(41,'Mini Super C',3,6,1,0,0),(42,'Lollipops',2,6,1,0,0),(43,'Fizzers',2,6,1,0,0),(44,'Mini Fizzers',1,6,1,0,0),(45,'Sour Strips',2,6,1,0,0),(46,'Zour Bombs',1,6,1,0,0);
/*!40000 ALTER TABLE `temp_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `usernameUsers` varchar(255) NOT NULL DEFAULT '0',
  `emailUsers` varchar(255) NOT NULL DEFAULT '0',
  `numChildren` int(11) NOT NULL DEFAULT '0',
  `pwdUsers` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'a','thomasmcalpine77@gmail.com',2,'$2y$10$Cn9zDJBVrRN0yAG73FsYYe0mKcXUtU36cRhzIgb2Ty.aK/yjaDUGu');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-22 15:42:22
