/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : apotik

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 22/06/2021 13:33:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for detailtransaksi
-- ----------------------------
DROP TABLE IF EXISTS `detailtransaksi`;
CREATE TABLE `detailtransaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NULL DEFAULT NULL,
  `id_obat` int(255) NULL DEFAULT NULL,
  `jumlah` decimal(65, 0) NOT NULL,
  `harga` decimal(65, 0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_transaksi`(`id_transaksi`) USING BTREE,
  INDEX `fk_obat`(`id_obat`) USING BTREE,
  CONSTRAINT `fk_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detailtransaksi
-- ----------------------------

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `no_telepon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawan
-- ----------------------------

-- ----------------------------
-- Table structure for obat
-- ----------------------------
DROP TABLE IF EXISTS `obat`;
CREATE TABLE `obat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_obat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `satuan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga` double UNSIGNED NULL DEFAULT NULL,
  `id_pemasok` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_pemasok`(`id_pemasok`) USING BTREE,
  CONSTRAINT `fk_pemasok` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of obat
-- ----------------------------
INSERT INTO `obat` VALUES (2, 'promag', 'Tablet', 756.5, 1);
INSERT INTO `obat` VALUES (3, 'Decolgen', 'kaplet', 1000.56, 2);

-- ----------------------------
-- Table structure for pemasok
-- ----------------------------
DROP TABLE IF EXISTS `pemasok`;
CREATE TABLE `pemasok`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemasok` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `telepon` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pemasok
-- ----------------------------
INSERT INTO `pemasok` VALUES (1, 'Kalbe Farma', 'MM 200 Cikarang Bekasi', '021 0009303');
INSERT INTO `pemasok` VALUES (2, 'dexa', 'Jakarta', '021 09338');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` date NOT NULL,
  `total_transaksi` decimal(65, 0) NULL DEFAULT NULL,
  `id_username` int(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_username`(`id_username`) USING BTREE,
  CONSTRAINT `fk_username` FOREIGN KEY (`id_username`) REFERENCES `username` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------

-- ----------------------------
-- Table structure for username
-- ----------------------------
DROP TABLE IF EXISTS `username`;
CREATE TABLE `username`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_karyawan` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_karyawan`(`id_karyawan`) USING BTREE,
  CONSTRAINT `fk_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of username
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
