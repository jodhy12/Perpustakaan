-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for apotik
CREATE DATABASE IF NOT EXISTS `apotik` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `apotik`;

-- Dumping structure for table apotik.obat
CREATE TABLE IF NOT EXISTS `obat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_obat` varchar(50) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga` double unsigned DEFAULT NULL,
  `id_pemasok` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pemasok` (`id_pemasok`),
  CONSTRAINT `fk_pemasok` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table apotik.obat: ~2 rows (approximately)
/*!40000 ALTER TABLE `obat` DISABLE KEYS */;
INSERT INTO `obat` (`id`, `nama_obat`, `satuan`, `harga`, `id_pemasok`) VALUES
	(2, 'promag', 'Tablet', 756.5, 1),
	(3, 'Decolgen', 'kaplet', 1000.56, 2);
/*!40000 ALTER TABLE `obat` ENABLE KEYS */;

-- Dumping structure for table apotik.pemasok
CREATE TABLE IF NOT EXISTS `pemasok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemasok` varchar(50) NOT NULL,
  `alamat` text,
  `telepon` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table apotik.pemasok: ~2 rows (approximately)
/*!40000 ALTER TABLE `pemasok` DISABLE KEYS */;
INSERT INTO `pemasok` (`id`, `nama_pemasok`, `alamat`, `telepon`) VALUES
	(1, 'Kalbe Farma', 'MM 200 Cikarang Bekasi', '021 0009303'),
	(2, 'dexa', 'Jakarta', '021 09338');
/*!40000 ALTER TABLE `pemasok` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
