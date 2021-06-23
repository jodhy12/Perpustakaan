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

 Date: 23/06/2021 14:29:58
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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detailtransaksi
-- ----------------------------
INSERT INTO `detailtransaksi` VALUES (1, 1, 11, 1, 11000);
INSERT INTO `detailtransaksi` VALUES (2, 2, 10, 2, 10000);
INSERT INTO `detailtransaksi` VALUES (3, 3, 9, 3, 9000);
INSERT INTO `detailtransaksi` VALUES (4, 4, 8, 4, 8000);
INSERT INTO `detailtransaksi` VALUES (5, 5, 10, 3, 10000);
INSERT INTO `detailtransaksi` VALUES (6, 6, 10, 2, 10000);
INSERT INTO `detailtransaksi` VALUES (7, 7, 2, 10, 2000);
INSERT INTO `detailtransaksi` VALUES (8, 8, 3, 3, 3000);
INSERT INTO `detailtransaksi` VALUES (9, 9, 6, 4, 6000);
INSERT INTO `detailtransaksi` VALUES (10, 10, 7, 5, 7000);

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
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES (4, 'Mochamad', 'Cikarang', '02192992');
INSERT INTO `karyawan` VALUES (5, 'Agus', 'Ciakarang', '021323392');
INSERT INTO `karyawan` VALUES (6, 'Rifqi', 'Bekasi', '9839832932');
INSERT INTO `karyawan` VALUES (7, 'Rijal', 'Jakarta', '09320320');
INSERT INTO `karyawan` VALUES (8, 'Effendi', 'Bogor', '93292');
INSERT INTO `karyawan` VALUES (9, 'Jhon', 'Tangerang', '039038832');
INSERT INTO `karyawan` VALUES (10, 'Hasan', 'Depok', '02933');
INSERT INTO `karyawan` VALUES (11, 'Husein', 'Bandung', '039230923');
INSERT INTO `karyawan` VALUES (12, 'Zakaria', 'Bogor', '093323');
INSERT INTO `karyawan` VALUES (13, 'Yahya', 'Serang', '0923232');

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
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of obat
-- ----------------------------
INSERT INTO `obat` VALUES (2, 'promag', 'Tablet', 2000, 1);
INSERT INTO `obat` VALUES (3, 'Decolgen', 'kaplet', 3000, 2);
INSERT INTO `obat` VALUES (4, 'Tolakangin', 'Bks', 4000, 6);
INSERT INTO `obat` VALUES (5, 'Bodrex', 'Tablet', 5000, 10);
INSERT INTO `obat` VALUES (6, 'Ultraflu', 'Kapsul', 6000, 9);
INSERT INTO `obat` VALUES (7, 'Komix', 'Bks', 7000, 7);
INSERT INTO `obat` VALUES (8, 'Bipro', 'Botol', 8000, 3);
INSERT INTO `obat` VALUES (9, 'Kibat', 'Kapsul', 9000, 8);
INSERT INTO `obat` VALUES (10, 'Puyer 19', 'Bks', 10000, 7);
INSERT INTO `obat` VALUES (11, 'Viostin DS', 'Bks', 11000, 5);

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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pemasok
-- ----------------------------
INSERT INTO `pemasok` VALUES (1, 'Kalbe Farma', 'MM 200 Cikarang Bekasi', '021 0009303');
INSERT INTO `pemasok` VALUES (2, 'dexa', 'Jakarta', '021 09338');
INSERT INTO `pemasok` VALUES (3, 'Bio', 'Bandung', '030232');
INSERT INTO `pemasok` VALUES (4, 'Delcom', 'Bekasi', '30293290');
INSERT INTO `pemasok` VALUES (5, 'Sinovac', 'Cina', '0292392');
INSERT INTO `pemasok` VALUES (6, 'Sidomuncul', 'Semarang', '0203903');
INSERT INTO `pemasok` VALUES (7, 'Bintangtujuh', 'Jakarta', '0029923');
INSERT INTO `pemasok` VALUES (8, 'Kimiafarma', 'Bandung', '0972963');
INSERT INTO `pemasok` VALUES (9, 'Ultra', 'Jakarta', '8728729');
INSERT INTO `pemasok` VALUES (10, 'Tempo', 'Bandung', '9819791');

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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (1, '2021-06-21', 11000, 3);
INSERT INTO `transaksi` VALUES (2, '2021-06-21', 20000, 3);
INSERT INTO `transaksi` VALUES (3, '2021-06-22', 27000, 2);
INSERT INTO `transaksi` VALUES (4, '2021-06-22', 24000, 3);
INSERT INTO `transaksi` VALUES (5, '2021-06-22', 30000, 8);
INSERT INTO `transaksi` VALUES (6, '2021-06-22', 20000, 7);
INSERT INTO `transaksi` VALUES (7, '2021-06-23', 20000, 8);
INSERT INTO `transaksi` VALUES (8, '2021-06-23', 9000, 7);
INSERT INTO `transaksi` VALUES (9, '2021-06-23', 24000, 2);
INSERT INTO `transaksi` VALUES (10, '2021-06-23', 35000, 3);

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
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of username
-- ----------------------------
INSERT INTO `username` VALUES (2, 'MCH', '1111', 'KASIR', 4);
INSERT INTO `username` VALUES (3, 'AGS', '222', 'KASIR', 5);
INSERT INTO `username` VALUES (4, 'RFQ', '333', 'MANAGER', 6);
INSERT INTO `username` VALUES (5, 'RJL', '444', 'MANAGER', 7);
INSERT INTO `username` VALUES (6, 'EFD', '555', 'APOTEKER', 8);
INSERT INTO `username` VALUES (7, 'JOHN', '6666', 'KASIR', 9);
INSERT INTO `username` VALUES (8, 'HSN', '7777', 'KASIR', 10);
INSERT INTO `username` VALUES (9, 'HSI', '888', 'KASIR', 11);
INSERT INTO `username` VALUES (10, 'ZKR', '999', 'APOTEKER', 12);
INSERT INTO `username` VALUES (11, 'YHY', '1010', 'APOTEKER', 13);

SET FOREIGN_KEY_CHECKS = 1;
