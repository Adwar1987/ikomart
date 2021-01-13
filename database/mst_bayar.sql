/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ikomart_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-12-25 01:41:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mst_bayar
-- ----------------------------
DROP TABLE IF EXISTS `mst_bayar`;
CREATE TABLE `mst_bayar` (
  `id_bayar` int(4) NOT NULL,
  `nama_bayar` varchar(50) NOT NULL,
  `qris` text,
  `no_rek` varchar(30) DEFAULT NULL,
  `nama_bank` varchar(30) DEFAULT NULL,
  `kode_bank` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_bayar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mst_bayar
-- ----------------------------
INSERT INTO `mst_bayar` VALUES ('1', 'Tunai', null, null, null, null);
INSERT INTO `mst_bayar` VALUES ('2', 'Scan Qris LinkAja', '2_qris_linkaja.jpeg', 'ID2020036673123A01', 'LinkAja', null);
INSERT INTO `mst_bayar` VALUES ('3', 'Scan Qris Bank Nagari', '3_qris_nagari.jpeg', 'ID2020036901193A01', 'Bank Nagari', null);
INSERT INTO `mst_bayar` VALUES ('4', 'Transfer Bank Mandiri ', '', '111 00 220220 12', 'PT. Iko Minang Ritel', '008');
INSERT INTO `mst_bayar` VALUES ('5', 'Transfer Bank Nagari', '', '0201 0230 220220', 'Iko Minang Ritel. PT', '118');
