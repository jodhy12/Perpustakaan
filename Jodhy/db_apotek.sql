-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_apotek
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `detailobat`
--

DROP TABLE IF EXISTS `detailobat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detailobat` (
  `efeksamping` mediumtext,
  `keterangan` mediumtext,
  `detail_id_obat` int(11) NOT NULL,
  PRIMARY KEY (`detail_id_obat`),
  KEY `fk_detailobat_obat1_idx` (`detail_id_obat`),
  CONSTRAINT `fk_detailobat_obat1` FOREIGN KEY (`detail_id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detailobat`
--

LOCK TABLES `detailobat` WRITE;
/*!40000 ALTER TABLE `detailobat` DISABLE KEYS */;
INSERT INTO `detailobat` VALUES ('Ngantuk','Obat Batuk Alami',1),('Letih','Obat Migren',2),('Pegel','Obat Demam',3),('Lapar','Obat Sakit Gigi',4);
/*!40000 ALTER TABLE `detailobat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'Kategori Satu'),(2,'Kategori Dua'),(3,'Kategori Tiga');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obat`
--

DROP TABLE IF EXISTS `obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL AUTO_INCREMENT,
  `nama_obat` varchar(30) NOT NULL,
  `category_id` int(11) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `harga` double NOT NULL,
  PRIMARY KEY (`id_obat`),
  KEY `fk_kategori` (`category_id`),
  CONSTRAINT `fk_kategori` FOREIGN KEY (`category_id`) REFERENCES `kategori` (`category_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obat`
--

LOCK TABLES `obat` WRITE;
/*!40000 ALTER TABLE `obat` DISABLE KEYS */;
INSERT INTO `obat` VALUES (1,'Obat Satu',1,'Pcs',10,15000),(2,'Obat Dua',3,'Botol',15,35000),(3,'Obat Tiga',2,'Botol',5,50000),(4,'Obat Empat',3,'Pcs',10,25000);
/*!40000 ALTER TABLE `obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penjualan` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` datetime NOT NULL,
  `total_trx` double NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualan`
--

LOCK TABLES `penjualan` WRITE;
/*!40000 ALTER TABLE `penjualan` DISABLE KEYS */;
INSERT INTO `penjualan` VALUES (1,'2022-05-18 00:49:47',100000),(2,'2022-05-18 00:49:47',125000);
/*!40000 ALTER TABLE `penjualan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penjualan_detail`
--

DROP TABLE IF EXISTS `penjualan_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penjualan_detail` (
  `id_tx_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jmlh_obat` int(11) NOT NULL,
  `harga` double NOT NULL,
  PRIMARY KEY (`id_tx_detail`),
  KEY `fk_penjualan_detail_obat1_idx` (`id_obat`),
  KEY `fk_idtransaksi_idx` (`id_transaksi`),
  CONSTRAINT `fk_idtransaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `penjualan` (`id_transaksi`) ON UPDATE CASCADE,
  CONSTRAINT `fk_penjualan_detail_obat1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualan_detail`
--
--

LOCK TABLES `penjualan_detail` WRITE;
/*!40000 ALTER TABLE `penjualan_detail` DISABLE KEYS */;
INSERT INTO `penjualan_detail` VALUES (1,1,1,2,30000),(2,1,2,2,70000),(3,2,4,3,75000),(4,2,3,1,50000);
/*!40000 ALTER TABLE `penjualan_detail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-18  1:00:29
