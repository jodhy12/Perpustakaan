/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : perpustakaan

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 01/07/2021 21:29:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_anggota` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  INDEX `fk_admin_anggota`(`id_anggota`) USING BTREE,
  CONSTRAINT `fk_admin_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', 'admin', 1);

-- ----------------------------
-- Table structure for anggota
-- ----------------------------
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota`  (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sex` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_anggota`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of anggota
-- ----------------------------
INSERT INTO `anggota` VALUES (1, 'Administrator', 'P', '0891281111', 'Bandung', 'admin@gmail.com', '2021-05-11 04:00:00');
INSERT INTO `anggota` VALUES (2, 'Pelita', 'P', '087821505412', 'Gunung Batu, Bandung', 'pelita@gmail.com', '2021-05-28 10:39:20');
INSERT INTO `anggota` VALUES (3, 'Ayu', 'P', '08112121222', 'Sukawarna, Bandung', 'ayu@gmail.com', '2021-05-28 10:39:46');
INSERT INTO `anggota` VALUES (4, 'Fadhli', 'L', '08133613111', 'Cilandak, Jakarta', 'fadhli@gmail.com', '2021-05-28 10:40:13');
INSERT INTO `anggota` VALUES (5, 'Nur', 'P', '08212221311', 'Sunter, Jakarta', 'nur@gmail.com', '2021-05-28 10:40:49');
INSERT INTO `anggota` VALUES (6, 'Bagus', 'L', '0827379111', 'Sarijadi, Bandung', 'bagus@gmail.com\r\n', '2021-05-28 10:46:35');
INSERT INTO `anggota` VALUES (7, 'Mahendra', 'P', '08772191811', 'Sariwangi, Bandung', 'mahendra@gmail.com', '2021-05-28 10:46:35');
INSERT INTO `anggota` VALUES (8, 'Najmin', 'P', '08712911991', 'Sukaraja, Bandung', 'najmina@gmail.com', '2021-05-28 10:47:01');
INSERT INTO `anggota` VALUES (9, 'Putri', 'P', '0827191811', 'Cimahi', 'putri@gmail.com', '2021-06-03 00:00:42');
INSERT INTO `anggota` VALUES (10, 'Ridwan', 'L', '0898188191', 'Baros, Cimahi', 'ridwan@gmail.com', '2021-06-03 00:01:58');
INSERT INTO `anggota` VALUES (11, 'Feby', 'P', '08991717711', 'Sukajadi, Bandung', 'feby@gmail.com\r\n', '2021-06-03 00:01:58');
INSERT INTO `anggota` VALUES (12, 'Cindy', 'P', '08272772791', 'Sentral, Cimahi', 'cindy@gmail.com', '2021-06-03 00:03:16');
INSERT INTO `anggota` VALUES (13, 'Farid', 'P', '0876637911', 'Buah Batu, Bandung', 'farid@gmail.com', '2021-06-03 00:03:16');
INSERT INTO `anggota` VALUES (14, 'Bayu', 'L', '0887639199', 'Sunter, Jakarta', 'bayu@gmail.com', '2021-06-03 00:04:09');
INSERT INTO `anggota` VALUES (15, 'Deni', 'L', '0876619111', 'Cikutra, Subang', 'deni@gmail.com', '2021-06-03 01:30:32');

-- ----------------------------
-- Table structure for buku
-- ----------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku`  (
  `isbn` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tahun` int(11) NULL DEFAULT NULL,
  `id_penerbit` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_pengarang` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_katalog` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `qty_stok` int(11) NULL DEFAULT 0,
  `harga_pinjam` int(11) NOT NULL,
  PRIMARY KEY (`isbn`) USING BTREE,
  INDEX `penerbit`(`id_penerbit`) USING BTREE,
  INDEX `pengarang`(`id_pengarang`) USING BTREE,
  INDEX `katalog`(`id_katalog`) USING BTREE,
  CONSTRAINT `katalog` FOREIGN KEY (`id_katalog`) REFERENCES `katalog` (`id_katalog`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `penerbit` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pengarang` FOREIGN KEY (`id_pengarang`) REFERENCES `pengarang` (`id_pengarang`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buku
-- ----------------------------
INSERT INTO `buku` VALUES ('002-291', 'Lancar Javascript', 2018, 'PN02', 'PG05', 'KG2', 8, 5000);
INSERT INTO `buku` VALUES ('009-281', 'Basic PHP', 2021, 'PN04', 'PG01', 'KG1', 19, 7500);
INSERT INTO `buku` VALUES ('092-111', 'Belajar PHP', 2010, 'PN01', 'PG01', 'KG0', 12, 12000);
INSERT INTO `buku` VALUES ('377-482', 'MySQL Dasar', 2020, 'PN04', 'PG04', 'KG0', 20, 4000);
INSERT INTO `buku` VALUES ('381-561', 'Basic Vue.js', 2014, 'PN03', 'PG01', 'KG2', 5, 5000);
INSERT INTO `buku` VALUES ('774-210', 'Laravel Master', 2021, 'PN03', 'PG05', 'KG1', 7, 6500);
INSERT INTO `buku` VALUES ('774-211', 'Laravel Part 1', 2018, 'PN03', 'PG05', 'KG1', 5, 4500);
INSERT INTO `buku` VALUES ('777-380', 'Mongo DB Lanjut', 2020, 'PN01', 'PG03', 'KG2', 7, 10000);
INSERT INTO `buku` VALUES ('777-381', 'MySQL Lanjut', 2021, 'PN01', 'PG04', 'KG0', 9, 8000);
INSERT INTO `buku` VALUES ('882-191', 'Belajar CSS', 2020, 'PN03', 'PG05', 'KG0', 8, 12000);
INSERT INTO `buku` VALUES ('882-291', 'Belajar Laravel', 2020, 'PN03', 'PG05', 'KG1', 3, 11500);
INSERT INTO `buku` VALUES ('902-191', 'CSS Part 2', 2020, 'PN04', 'PG05', 'KG0', 8, 15000);
INSERT INTO `buku` VALUES ('929-181', 'Basic JQuery', 2019, NULL, 'PG05', 'KG0', 11, 5500);
INSERT INTO `buku` VALUES ('977-381', 'CSS Part 1', 2018, 'PN01', 'PG01', 'KG0', 9, 8000);
INSERT INTO `buku` VALUES ('999-281', 'Laravel Part 2', 2020, 'PN04', 'PG05', 'KG1', 11, 13000);

-- ----------------------------
-- Table structure for detail_peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `detail_peminjaman`;
CREATE TABLE `detail_peminjaman`  (
  `id_pinjam` int(11) NOT NULL DEFAULT 0,
  `isbn` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `qty` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pinjam`, `isbn`) USING BTREE,
  INDEX `id_pinjam`(`id_pinjam`) USING BTREE,
  INDEX `isbn`(`isbn`) USING BTREE,
  CONSTRAINT `id_pinjam` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjaman` (`id_pinjam`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `isbn` FOREIGN KEY (`isbn`) REFERENCES `buku` (`isbn`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_peminjaman
-- ----------------------------
INSERT INTO `detail_peminjaman` VALUES (1, '092-111', 1);
INSERT INTO `detail_peminjaman` VALUES (1, '777-381', 3);
INSERT INTO `detail_peminjaman` VALUES (1, '999-281', 1);
INSERT INTO `detail_peminjaman` VALUES (2, '777-381', 1);
INSERT INTO `detail_peminjaman` VALUES (3, '009-281', 1);
INSERT INTO `detail_peminjaman` VALUES (3, '381-561', 1);
INSERT INTO `detail_peminjaman` VALUES (3, '777-381', 2);
INSERT INTO `detail_peminjaman` VALUES (3, '882-291', 1);
INSERT INTO `detail_peminjaman` VALUES (4, '009-281', 1);
INSERT INTO `detail_peminjaman` VALUES (4, '377-482', 1);
INSERT INTO `detail_peminjaman` VALUES (5, '381-561', 1);
INSERT INTO `detail_peminjaman` VALUES (5, '999-281', 2);
INSERT INTO `detail_peminjaman` VALUES (6, '002-291', 1);
INSERT INTO `detail_peminjaman` VALUES (6, '377-482', 2);
INSERT INTO `detail_peminjaman` VALUES (6, '777-381', 1);
INSERT INTO `detail_peminjaman` VALUES (6, '902-191', 1);
INSERT INTO `detail_peminjaman` VALUES (7, '882-291', 1);
INSERT INTO `detail_peminjaman` VALUES (8, '777-380', 2);
INSERT INTO `detail_peminjaman` VALUES (8, '929-181', 1);
INSERT INTO `detail_peminjaman` VALUES (9, '009-281', 1);
INSERT INTO `detail_peminjaman` VALUES (9, '377-482', 1);
INSERT INTO `detail_peminjaman` VALUES (9, '929-181', 1);
INSERT INTO `detail_peminjaman` VALUES (10, '381-561', 1);
INSERT INTO `detail_peminjaman` VALUES (10, '882-291', 1);
INSERT INTO `detail_peminjaman` VALUES (10, '902-191', 1);
INSERT INTO `detail_peminjaman` VALUES (10, '977-381', 2);

-- ----------------------------
-- Table structure for katalog
-- ----------------------------
DROP TABLE IF EXISTS `katalog`;
CREATE TABLE `katalog`  (
  `id_katalog` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_katalog`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of katalog
-- ----------------------------
INSERT INTO `katalog` VALUES ('KG0', 'Buku Dewasa');
INSERT INTO `katalog` VALUES ('KG1', 'Buku Anak');
INSERT INTO `katalog` VALUES ('KG2', 'Buku Belajar');
INSERT INTO `katalog` VALUES ('KG3', 'Buku Belajar Agama');
INSERT INTO `katalog` VALUES ('KG4', 'Buku Kesehatan');

-- ----------------------------
-- Table structure for peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman`  (
  `id_pinjam` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) NULL DEFAULT NULL,
  `tgl_pinjam` date NULL DEFAULT NULL,
  `tgl_kembali` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_pinjam`) USING BTREE,
  INDEX `anggota`(`id_anggota`) USING BTREE,
  CONSTRAINT `anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of peminjaman
-- ----------------------------
INSERT INTO `peminjaman` VALUES (1, 4, '2021-05-26', '2021-05-31');
INSERT INTO `peminjaman` VALUES (2, 2, '2021-05-27', '2021-05-29');
INSERT INTO `peminjaman` VALUES (3, 3, '2021-05-10', '2021-05-12');
INSERT INTO `peminjaman` VALUES (4, 7, '2021-05-27', '2021-05-31');
INSERT INTO `peminjaman` VALUES (5, 5, '2021-06-01', '2021-06-05');
INSERT INTO `peminjaman` VALUES (6, 10, '2021-06-01', '2021-06-03');
INSERT INTO `peminjaman` VALUES (7, 3, '2021-05-04', '2021-05-06');
INSERT INTO `peminjaman` VALUES (8, 4, '2021-06-03', '2021-06-09');
INSERT INTO `peminjaman` VALUES (9, 11, '2021-06-02', '2021-06-08');
INSERT INTO `peminjaman` VALUES (10, 5, '2021-05-25', '2021-06-02');

-- ----------------------------
-- Table structure for penerbit
-- ----------------------------
DROP TABLE IF EXISTS `penerbit`;
CREATE TABLE `penerbit`  (
  `id_penerbit` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_penerbit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telp` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_penerbit`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penerbit
-- ----------------------------
INSERT INTO `penerbit` VALUES ('PN01', 'Penerbit 01', 'penerbit@perpus.co.id', '0219999333', 'Surabaya');
INSERT INTO `penerbit` VALUES ('PN02', 'Penerbit 02', 'penerbit2@gmail.com', '08765158111', 'Bandung');
INSERT INTO `penerbit` VALUES ('PN03', 'Penerbit 03', 'penerbit3@gmail.com', NULL, 'Jakarta Barat');
INSERT INTO `penerbit` VALUES ('PN04', 'Penerbit 04', 'penerbit4@gmail.com', '08972017209', 'Jakarta Selatan');
INSERT INTO `penerbit` VALUES ('PN05', 'Penerbit 05', 'penerbit5@gmail.com', '08972187209', 'Jakarta Selatan');
INSERT INTO `penerbit` VALUES ('PN06', 'Penerbit 06', 'penerbit6@gmail.com', '08112187209', 'Jakarta Barat');

-- ----------------------------
-- Table structure for pengarang
-- ----------------------------
DROP TABLE IF EXISTS `pengarang`;
CREATE TABLE `pengarang`  (
  `id_pengarang` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pengarang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telp` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengarang`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengarang
-- ----------------------------
INSERT INTO `pengarang` VALUES ('PG01', 'Pengarang 01', 'pengarang1@perpus.co.id', '0929211', 'Bandung');
INSERT INTO `pengarang` VALUES ('PG02', 'Pengarang 02', 'pengarang2@perpus.co.id', '0929211222', 'Yogyakarta');
INSERT INTO `pengarang` VALUES ('PG03', 'Pengarang 03', 'pengarang3@perpus.co.id', '092921199', 'Banten');
INSERT INTO `pengarang` VALUES ('PG04', 'Pengarang 04', 'pengarang4@perpus.co.id', '93938199', 'Jakarta');
INSERT INTO `pengarang` VALUES ('PG05', 'Pengarang 05', 'pengarang5@perpus.co.id', '93938199', 'Cimahi');
INSERT INTO `pengarang` VALUES ('PG06', 'Pengarang 06', 'pengarang6@perpus.co.id', '0818176111', 'Cimahi');
INSERT INTO `pengarang` VALUES ('PG07', 'Pengarang 07', 'pengarang7@perpus.co.id', '08181762291', 'Semarang');

SET FOREIGN_KEY_CHECKS = 1;
