/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50715
Source Host           : localhost:3306
Source Database       : aryana_warehouse_db

Target Server Type    : MYSQL
Target Server Version : 50715
File Encoding         : 65001

Date: 2016-12-14 16:42:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `history`
-- ----------------------------
DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_stockin` bigint(11) NOT NULL,
  `id_stockout` bigint(11) NOT NULL,
  `subqty` decimal(19,0) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of history
-- ----------------------------

-- ----------------------------
-- Table structure for `kategori`
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kategori
-- ----------------------------

-- ----------------------------
-- Table structure for `lokasi`
-- ----------------------------
DROP TABLE IF EXISTS `lokasi`;
CREATE TABLE `lokasi` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lokasi
-- ----------------------------
INSERT INTO `lokasi` VALUES ('1', 'Gudang Mesin');

-- ----------------------------
-- Table structure for `permission`
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(11) NOT NULL,
  `checkdata` int(1) NOT NULL DEFAULT '0',
  `employee` int(1) NOT NULL DEFAULT '0',
  `complain` int(1) NOT NULL DEFAULT '0',
  `users` int(1) NOT NULL DEFAULT '0',
  `project` int(1) NOT NULL DEFAULT '0',
  `warehouse` int(1) NOT NULL DEFAULT '0',
  `workshop` int(1) NOT NULL DEFAULT '0',
  `reset` int(1) NOT NULL DEFAULT '0',
  `add` int(1) NOT NULL DEFAULT '0',
  `proses1` int(1) NOT NULL DEFAULT '0',
  `proses2` int(1) NOT NULL DEFAULT '0',
  `delete` int(1) NOT NULL DEFAULT '0',
  `download` int(1) NOT NULL DEFAULT '0',
  `print` int(1) NOT NULL DEFAULT '0',
  `price` int(1) NOT NULL DEFAULT '0',
  `flag` int(1) NOT NULL DEFAULT '0',
  `lokasi` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permission
-- ----------------------------

-- ----------------------------
-- Table structure for `stockin`
-- ----------------------------
DROP TABLE IF EXISTS `stockin`;
CREATE TABLE `stockin` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_unit` bigint(11) NOT NULL,
  `id_lokasi` bigint(11) NOT NULL,
  `asal_proyek` varchar(100) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `lokasi_simpan` varchar(100) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `kondisi` varchar(20) NOT NULL DEFAULT '',
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stockin
-- ----------------------------
INSERT INTO `stockin` VALUES ('1', '0', '0', 'MBI', '2016-06-10', 'Gudang Mesin', '', '400 WATT', '15', 'Buah', 'Bekas', '');
INSERT INTO `stockin` VALUES ('2', '0', '0', 'MBI', '2016-06-10', 'Gudang A1', '', 'Kabel iterna 3x2,5 mm', '2', 'Roll', 'Bekas', '');
INSERT INTO `stockin` VALUES ('3', '0', '0', 'MBI', '2016-06-10', 'Gudang Mesin', '', 'kabel NYM 2x2,5', '29', 'Roll', 'Bagus', '');
INSERT INTO `stockin` VALUES ('4', '0', '0', 'MBI', '2016-07-17', 'Gudang Atas', '', 'Pipa Maspion AW 3/4\"', '175', 'Btng', 'Bekas', '');

-- ----------------------------
-- Table structure for `stockout`
-- ----------------------------
DROP TABLE IF EXISTS `stockout`;
CREATE TABLE `stockout` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_stock_in` bigint(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `no_memo_ovb` varchar(20) NOT NULL,
  `no_surat_jalan` varchar(20) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `jumlah_diambil` int(50) NOT NULL,
  `total` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stockout
-- ----------------------------
INSERT INTO `stockout` VALUES ('1', '3', '2016-08-22', '19/VII/OVB/2016', '1234567890', 'Hotel Cleo', '2', '27');
INSERT INTO `stockout` VALUES ('2', '1', '2016-08-06', '', '1/VIII/OVB/2014', 'Panverta', '15', '0');
INSERT INTO `stockout` VALUES ('3', '4', '2016-02-20', '', '123456789', 'Kantor Pusat Aryana', '116', '59');

-- ----------------------------
-- Table structure for `unit`
-- ----------------------------
DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of unit
-- ----------------------------
INSERT INTO `unit` VALUES ('1', 'Marmer Motifss');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `usrid` int(4) NOT NULL AUTO_INCREMENT,
  `id_employee` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `oauth` enum('yes','no') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `last_login` varchar(200) NOT NULL,
  PRIMARY KEY (`usrid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '1', 'admin', 'ptac5051010', 'yes', 'active', '14 Dec 2016 - 16:15:56');
INSERT INTO `user` VALUES ('2', '2', 'direksi', 'direksi', 'yes', 'active', '');
INSERT INTO `user` VALUES ('3', '3', 'chintya', 'chintya', 'yes', 'active', '');
INSERT INTO `user` VALUES ('4', '4', 'ulfah', 'ulfah', 'yes', 'active', '');
INSERT INTO `user` VALUES ('6', '6', 'yudi', '08153090854', 'yes', 'active', '');
INSERT INTO `user` VALUES ('7', '7', 'hamka', '081553090846', 'yes', 'active', '');
INSERT INTO `user` VALUES ('8', '8', 'ali', '081615002004', 'yes', 'active', '');
INSERT INTO `user` VALUES ('9', '9', 'david', '081615002003', 'yes', 'active', '');
INSERT INTO `user` VALUES ('10', '10', 'setiaadji', '081615002003', 'yes', 'active', '');
INSERT INTO `user` VALUES ('11', '11', 'yahnny', '081615002001', 'yes', 'active', '');
INSERT INTO `user` VALUES ('12', '15', 'niramas', 'niramas', 'yes', 'active', '');
INSERT INTO `user` VALUES ('13', '16', 'amaris', 'amaris', 'yes', 'active', '');
INSERT INTO `user` VALUES ('14', '17', 'wahju', 'wahjul', 'yes', 'active', '');
INSERT INTO `user` VALUES ('15', '18', 'ningsih', 'ningsih', 'yes', 'active', '');
