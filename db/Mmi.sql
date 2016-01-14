-- MySQL dump 10.11
--
-- Host: localhost    Database: Mmi
-- ------------------------------------------------------
-- Server version	5.0.45

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
-- Table structure for table `Cat_Comp`
--

DROP TABLE IF EXISTS `Cat_Comp`;
CREATE TABLE `Cat_Comp` (
  `CompId` int(11) NOT NULL default '0',
  `SCat_Id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`CompId`,`SCat_Id`),
  KEY `SCat_Id` (`SCat_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cat_Comp`
--

LOCK TABLES `Cat_Comp` WRITE;
/*!40000 ALTER TABLE `Cat_Comp` DISABLE KEYS */;
INSERT INTO `Cat_Comp` VALUES (101,301),(101,302),(102,303),(102,307),(102,308),(103,309),(103,310),(103,312),(104,304),(104,305),(104,306),(104,311),(104,312),(105,313),(105,314),(106,303),(106,310);
/*!40000 ALTER TABLE `Cat_Comp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
CREATE TABLE `Category` (
  `CatId` int(11) NOT NULL,
  `CatName` varchar(32) default NULL,
  PRIMARY KEY  (`CatId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
INSERT INTO `Category` VALUES (200,'Events'),(201,'Sports'),(202,'Offers'),(203,'Competitions'),(204,'Movies'),(205,'Others');
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Company`
--

DROP TABLE IF EXISTS `Company`;
CREATE TABLE `Company` (
  `CompId` int(11) NOT NULL,
  `Name` varchar(64) default NULL,
  PRIMARY KEY  (`CompId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Company`
--

LOCK TABLES `Company` WRITE;
/*!40000 ALTER TABLE `Company` DISABLE KEYS */;
INSERT INTO `Company` VALUES (101,'Company1'),(102,'Company2'),(103,'Company3'),(104,'Company4'),(105,'Company5'),(106,'Company6');
/*!40000 ALTER TABLE `Company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notification`
--

DROP TABLE IF EXISTS `Notification`;
CREATE TABLE `Notification` (
  `CatId` int(11) default NULL,
  `Message` varchar(256) default NULL,
  `Priority` int(11) default NULL,
  `CompId` int(11) default NULL,
  `MId` int(11) NOT NULL auto_increment,
  `Time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`MId`),
  KEY `CatId` (`CatId`),
  KEY `CompId` (`CompId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Notification`
--

LOCK TABLES `Notification` WRITE;
/*!40000 ALTER TABLE `Notification` DISABLE KEYS */;
INSERT INTO `Notification` VALUES (313,'Hey BigFoot!! :D',0,105,5,'2015-11-24 01:11:34');
/*!40000 ALTER TABLE `Notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SubCat`
--

DROP TABLE IF EXISTS `SubCat`;
CREATE TABLE `SubCat` (
  `ParCatId` int(11) NOT NULL,
  `SubCat_id` int(11) NOT NULL,
  `Name` varchar(32) default NULL,
  PRIMARY KEY  (`SubCat_id`),
  KEY `ParCatId` (`ParCatId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SubCat`
--

LOCK TABLES `SubCat` WRITE;
/*!40000 ALTER TABLE `SubCat` DISABLE KEYS */;
INSERT INTO `SubCat` VALUES (200,301,'Hackathon'),(200,302,'Workshop'),(200,303,'Concert'),(201,304,'Cricket'),(201,305,'Football'),(201,306,'Basketball'),(202,307,'Hotel Booking'),(202,308,'Flight Reservation'),(203,309,'Song'),(203,310,'Music'),(204,311,'Reviews'),(204,312,'Release News'),(205,313,'Horoscope'),(205,314,'Beauty Tips');
/*!40000 ALTER TABLE `SubCat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Subscribers`
--

DROP TABLE IF EXISTS `Subscribers`;
CREATE TABLE `Subscribers` (
  `PhoneNo` bigint(10) NOT NULL default '0',
  `CompId` int(11) NOT NULL default '0',
  `CatId` int(11) NOT NULL default '0',
  `Priority` int(11) default NULL,
  `currlim` int(11) default NULL,
  `lim` int(11) default NULL,
  PRIMARY KEY  (`PhoneNo`,`CompId`,`CatId`),
  KEY `CompId` (`CompId`),
  KEY `CatId` (`CatId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Subscribers`
--

LOCK TABLES `Subscribers` WRITE;
/*!40000 ALTER TABLE `Subscribers` DISABLE KEYS */;
INSERT INTO `Subscribers` VALUES (7411476831,101,301,0,5,5),(7411476831,104,304,1,100,100),(7259856058,101,301,0,5,5),(7259856058,105,313,0,5,5),(7259856058,105,314,1,1,1),(7259166120,101,301,2,55,55),(7259166120,103,312,1,5,5);
/*!40000 ALTER TABLE `Subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `PhoneNo` bigint(10) NOT NULL,
  `Address` varchar(240) default NULL,
  `Password` varchar(64) default NULL,
  `Name` varchar(64) default NULL,
  PRIMARY KEY  (`PhoneNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (7259856058,'Bangalore','Ibrahim','Ibrahim'),(7411476831,'Haryan','Mandeep','Mandeep'),(7259166120,'Mumbai','Nandy','Nandy');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-24  1:16:53
