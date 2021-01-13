/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ikomart_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-12-12 15:09:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id_kategori` int(4) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kelompok` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Beras Putih', '1');
INSERT INTO `categories` VALUES ('2', 'Beras Merah', '1');
INSERT INTO `categories` VALUES ('3', 'Beras Ketan', '1');
INSERT INTO `categories` VALUES ('4', 'Jagung', '1');
INSERT INTO `categories` VALUES ('5', 'Kentang', '1');
INSERT INTO `categories` VALUES ('6', 'Tepung', '1');
INSERT INTO `categories` VALUES ('7', 'Minyak Goreng', '1');
INSERT INTO `categories` VALUES ('8', 'Gula', '1');
INSERT INTO `categories` VALUES ('9', 'Saos', '1');
INSERT INTO `categories` VALUES ('10', 'Telur', '2');
INSERT INTO `categories` VALUES ('11', 'Daging', '2');
INSERT INTO `categories` VALUES ('12', 'Ikan Air Tawar', '2');
INSERT INTO `categories` VALUES ('13', 'Ikan Air Laut', '2');
INSERT INTO `categories` VALUES ('14', 'Ikan Asin', '2');
INSERT INTO `categories` VALUES ('15', 'Seafood', '2');
INSERT INTO `categories` VALUES ('16', 'Tempe', '3');
INSERT INTO `categories` VALUES ('17', 'Tahu', '3');
INSERT INTO `categories` VALUES ('18', 'Kacang-kacangan', '3');
INSERT INTO `categories` VALUES ('19', 'Sayuran Hijau', '4');
INSERT INTO `categories` VALUES ('20', 'Sayuran Lainnya', '4');
INSERT INTO `categories` VALUES ('21', 'Umbi-umbian', '4');
INSERT INTO `categories` VALUES ('22', 'Buah Lokal', '5');
INSERT INTO `categories` VALUES ('23', 'Buah Import', '5');
INSERT INTO `categories` VALUES ('24', 'Rempah-rempah', '6');
INSERT INTO `categories` VALUES ('25', 'Daun-daunan', '6');
INSERT INTO `categories` VALUES ('26', 'Bumbu Siap Saji', '6');
INSERT INTO `categories` VALUES ('27', 'Asam', '6');
INSERT INTO `categories` VALUES ('28', 'Bawang', '6');
INSERT INTO `categories` VALUES ('29', 'Cabai', '6');
INSERT INTO `categories` VALUES ('30', 'Kelapa', '6');
INSERT INTO `categories` VALUES ('31', 'Perawatan dan Pembersih', '7');
INSERT INTO `categories` VALUES ('32', 'Perawatan Gigi dan Mulut', '7');
INSERT INTO `categories` VALUES ('33', 'Perawatan Tubuh', '7');
INSERT INTO `categories` VALUES ('34', 'Perawatan Rambut', '7');
INSERT INTO `categories` VALUES ('35', 'Perawatan Wajah', '7');
INSERT INTO `categories` VALUES ('36', 'Parfum', '7');
INSERT INTO `categories` VALUES ('37', 'Pembalut dan Popok Dewasa', '7');
INSERT INTO `categories` VALUES ('38', 'Anti Nyamuk', '7');
INSERT INTO `categories` VALUES ('39', 'Perlengkapan Ibu Hamil', '8');
INSERT INTO `categories` VALUES ('40', 'Perlengkapan Anak', '8');
INSERT INTO `categories` VALUES ('41', 'Produk Pembersih', '9');
INSERT INTO `categories` VALUES ('42', 'Peralatan Rumah Tangga', '9');
INSERT INTO `categories` VALUES ('43', 'Makanan Ringan', '10');
INSERT INTO `categories` VALUES ('44', 'Roti', '10');
INSERT INTO `categories` VALUES ('45', 'Susu', '10');
INSERT INTO `categories` VALUES ('46', 'Teh', '10');
INSERT INTO `categories` VALUES ('47', 'Sirup', '10');
INSERT INTO `categories` VALUES ('48', 'Kopi', '10');
INSERT INTO `categories` VALUES ('49', 'Makanan Kaleng', '10');
INSERT INTO `categories` VALUES ('50', 'Frozen Food', '10');
INSERT INTO `categories` VALUES ('51', 'Minuman Ringan', '10');
INSERT INTO `categories` VALUES ('52', 'Lainnya', '10');
INSERT INTO `categories` VALUES ('53', 'Pajangan', '11');
INSERT INTO `categories` VALUES ('54', 'Gantungan Kunci', '11');
INSERT INTO `categories` VALUES ('55', 'Produk Rajutan', '11');
INSERT INTO `categories` VALUES ('56', 'Alat Musik', '11');
INSERT INTO `categories` VALUES ('57', 'Aksesoris', '11');
INSERT INTO `categories` VALUES ('58', 'Songket', '12');
INSERT INTO `categories` VALUES ('59', 'Mukena', '12');
INSERT INTO `categories` VALUES ('60', 'Pakaian', '12');
INSERT INTO `categories` VALUES ('61', 'Tas dan Dompet', '13');
INSERT INTO `categories` VALUES ('62', 'Sepatu dan Sandal', '13');
INSERT INTO `categories` VALUES ('63', 'Aksesoris', '13');
INSERT INTO `categories` VALUES ('64', 'Pakaian', '13');
INSERT INTO `categories` VALUES ('65', 'Rempah-Rempah', '14');
INSERT INTO `categories` VALUES ('66', 'Mie', null);
INSERT INTO `categories` VALUES ('67', 'Makanan dan Formula Bayi', null);

-- ----------------------------
-- Table structure for kelompok
-- ----------------------------
DROP TABLE IF EXISTS `kelompok`;
CREATE TABLE `kelompok` (
  `id_kelompok` int(4) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(100) NOT NULL,
  `deskripsi_kelompok` text,
  PRIMARY KEY (`id_kelompok`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kelompok
-- ----------------------------
INSERT INTO `kelompok` VALUES ('1', 'Sembako', '<p>Kebutuhan pangan yang rutin dikonsumsi sehari-hari</p>\r\n');
INSERT INTO `kelompok` VALUES ('2', 'Lauk Hewani', '<p>Sumber protein yang kaya akan asam amino esensial dan tidak dapat disintesis dalam tubuh. Lauk hewani berfungsi untuk pertumbuhan dan perkembangan organ</p>\r\n');
INSERT INTO `kelompok` VALUES ('3', 'Lauk Nabati', '<p>Bahan pangan asal tumbuhan yang biasanya mengandung kadar air tinggi dan dikonsumsi dalam keadaan segar atau setelah diolah secara minimal</p>\r\n');
INSERT INTO `kelompok` VALUES ('4', 'Sayuran', '<p>Bahan pangan asal tumbuhan yang biasanya mengandung kadar air tinggi dan dikonsumsi dalam keadaan segar atau setelah diolah secara minimal</p>\r\n');
INSERT INTO `kelompok` VALUES ('5', 'Buah', '<p>Buah merupakan sumber berbagai vitamin (Vit A, B, B1, B6, C), mineral, dan serat pangan. Berperan sebagai antioksidan dalam tubuh.</p>\r\n');
INSERT INTO `kelompok` VALUES ('6', 'Bumbu Dapur', '<p>Bahan kebutuhan dapur sebagai pelengkap, penambah cita rasa dan aroma masakan</p>\r\n');
INSERT INTO `kelompok` VALUES ('7', 'Kesehatan dan Kecantikan', '<p>Perlengkapan untuk perawatan kesehatan dan kecantikan yang menunjang penampilan</p>\r\n');
INSERT INTO `kelompok` VALUES ('8', 'Perlengkapan Ibu dan Anak', '<p>Perlengkapan khusus ibu dan anak yang ideal untuk memberikan kenyamanan dan kemudahan beraktivitas.</p>\r\n');
INSERT INTO `kelompok` VALUES ('9', 'Perlengkapan Rumah Tangga', '<p>Peralatan rumah tangga yang ideal untuk memberikan kenyamanan dan kemudahan beraktivitas di rumah.</p>\r\n');
INSERT INTO `kelompok` VALUES ('10', 'Makanan dan Minuman', '<p>Segala jenis produk makanan dan minuman yang bersifat tidak pokok untuk dikonsumsi.</p>');
INSERT INTO `kelompok` VALUES ('11', 'Kerajinan Tangan', '<p>Produk buatan tangan yang diproduksi oleh UMKM asal Sumatera Barat.</p>');
INSERT INTO `kelompok` VALUES ('12', 'Sulaman dan Bordir', '<p>Produk hasil sulaman dan bordiran yang diproduksi oleh UMKM asal Sumatera Barat.</p>');
INSERT INTO `kelompok` VALUES ('13', 'Fashion', '<p>Segala jenis produk yang menunjang penampilan, diproduksi oleh UMKM asal Sumatera Barat.</p>');
INSERT INTO `kelompok` VALUES ('14', 'Rempah', '<p>Segala jenis rempah-rempah untuk keperluan rumah tangga hingga ekspor.</p>');

-- ----------------------------
-- Table structure for mst_kirim
-- ----------------------------
DROP TABLE IF EXISTS `mst_kirim`;
CREATE TABLE `mst_kirim` (
  `id_kirim` int(4) NOT NULL,
  `nama_kirim` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kirim`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mst_kirim
-- ----------------------------
INSERT INTO `mst_kirim` VALUES ('1', 'Ikomart kurir');
INSERT INTO `mst_kirim` VALUES ('2', 'SAP Express');
INSERT INTO `mst_kirim` VALUES ('3', 'J&T');
INSERT INTO `mst_kirim` VALUES ('6', 'DHL Express');

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id_produk` int(5) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `stok` varchar(3) NOT NULL,
  `views` int(11) NOT NULL,
  `ukuran` varchar(20) DEFAULT NULL,
  `berat` int(10) DEFAULT NULL,
  `id_group` text,
  `id_kelompok` int(4) DEFAULT NULL,
  `id_kategori` int(4) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `gambar` text,
  `alias` text,
  `sts_promo` varchar(1) DEFAULT NULL,
  `tgl_awal_promo` date DEFAULT NULL,
  `tgl_akhir_promo` date DEFAULT NULL,
  `id_upload` varchar(10) DEFAULT NULL,
  `id_approver` varchar(10) DEFAULT NULL,
  `sts_aktif` varchar(1) DEFAULT NULL,
  `dikirim` varchar(100) DEFAULT NULL,
  `dijual` varchar(100) DEFAULT NULL,
  `id_penjual` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=MyISAM AUTO_INCREMENT=306 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES ('1', 'BERAS KURIAK KUSUIK KAMANG', '<p align=\"justify\">Beras Super Ampek Angkek merupakan beras lokal asal Sumatera Barat yang memiliki butiran beras tidak terlalu besar berwarna putih dan alami. Tekstur nasi yang dihasilkan pun sangat lembut dan wangi. Kualitas terjamin, higienis, sehat dan alami.</p>\r\n', '9', '0', '10 KG', '10000', '3,1,', '1', '1', 'Beras Super Ampek Angkek', 'beras_kuriak_kusuik_kamang_1.jpeg', 'beras_kuriak_kusuik_kamang', null, null, null, null, null, '1', 'Petani Kamang', 'Ikomart', '1');
INSERT INTO `produk` VALUES ('2', 'BERAS SOLOK', '<p align=\"justify\">Beras Solok merupakan beras lokal asal daerah Solok Sumatera Barat yang memiliki butiran beras agak besar berwarna putih dan alami. Tekstur nasi yang dihasilkan pun sangat lembut dan wangi. Kualitas terjamin, higienis, sehat dan alami.</p>\r\n', '1', '0', '10 KG', '10000', '1,', '1', '1', 'BERAS SOLOK', 'beras_solok_2.jpeg', 'beras_solok', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('3', 'BERAS SOKAN', '', '1', '0', '10 KG', '10000', '1', '1', '1', null, null, 'beras_sokan', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('4', 'BERAS KETAN PUTIH', '', '1', '0', '1 LITER', '1000', '1,', '1', '3', '-', '', 'beras_ketan_putih', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('5', 'BERAS KETAN HITAM', '', '', '0', '1 LITER', '1000', '1', '1', '3', null, null, 'beras_ketan_hitam', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('6', 'KENTANG RENDANG 1 Kg', '<p align=\"justify\">Kentang yang cocok untuk bahan pembuatan rendang</p>\r\n', '1', '0', '1 Kg', '1000', '1,', '1', '5', '-', 'KENTANG_RENDANG_1_Kg_6.JPG', 'KENTANG_RENDANG_1_Kg', null, null, null, null, null, '1', 'Pedagang Pasar Bawah', 'Ikomart', ' ');
INSERT INTO `produk` VALUES ('7', 'KENTANG SEDANG', '', '1', '0', '200 GRAM', '200', '1,', '1', '5', '-', 'kentang_sedang_7.JPG', 'kentang_sedang', null, null, null, null, null, '1', 'Pedagang Pasar Bawah', 'Ikomart', ' ');
INSERT INTO `produk` VALUES ('8', 'KENTANG CIPANAS', '', '', '0', '200 GRAM', '200', '1', '1', '5', null, null, 'kentang_cipanas', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('9', 'JAGUNG KUNING', '', '10', '0', '200 GRAM', '200', '3,1,', '1', '4', '-', 'jagung_kuning_9.jpg', 'jagung_kuning', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('10', 'IKAN TUNA', '<p align=\"justify\">Ikan tuna adalah salah satu jenis ikan laut dengan ukuran tubuh yang terbilang besar. Ikan ini menjadi favorit sebagian besar orang karena mudah diolah dan mempunyai daging yang tebal dengan tekstur lembut saat dimakan. Manfaat mengkonsumsi ikan tuna diantaranya adalah sebagai sumber protein, menyehatkan jantung, kaya akan vitamin B6, dan sebagai sumber mineral yang baik.</p>\r\n', '1', '0', '1 KG', '1000', '1,', '2', '13', '-', 'ikan_tuna_10.jpg', 'ikan_tuna', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('11', 'IKAN TONGKOL', '', '1', '0', '1 KG', '1000', '1,', '2', '13', '-', 'ikan_tongkol_11.jpg', 'ikan_tongkol', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('12', 'IKAN KEMBUNG', '', '10', '0', '1 KG', '1000', '1,', '2', '13', '-', 'ikan_kembung_12.JPG', 'ikan_kembung', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('13', 'IKAN TENGGIRI', '', '0', '0', '1 KG', '1000', '1,', '2', '12', '-', '', 'ikan_tenggiri', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('14', 'IKAN DENCIS', '', '', '0', '1 KG', '1000', '1', '2', '12', null, null, 'ikan_dencis', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('15', 'IKAN NILA', '', '10', '0', '1 KG', '1000', '3,1,', '2', '12', '-', 'ikan_nila_15.JPG', 'ikan_nila', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('16', 'IKAN MAS', '', '10', '0', '1 KG', '1000', '3,1,', '2', '12', '-', 'ikan_mas_16.JPG', 'ikan_mas', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('17', 'IKAN MUJAIR', '', '', '0', '1 KG', '1000', '1,3', '2', '12', null, null, 'ikan_mujair', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('18', 'IKAN GURAME', '', '', '0', '1 KG', '1000', '1,3', '2', '12', null, null, 'ikan_gurame', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('19', 'IKAN LELE', '', '', '0', '1 KG', '1000', '1,3', '2', '12', null, null, 'ikan_lele', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('20', 'BELUT', '', '', '0', '1 KG', '1000', '1,3', '2', '12', null, null, 'belut', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('21', 'MACO SEPAT', '', '0', '0', '200 GRAM', '200', '1,', '2', '14', '-', '', 'maco_sepat', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('22', 'IKAN TERI MEDAN', '', '10', '0', '200 GRAM', '200', '1,', '2', '14', '-', 'ikan_teri_medan_22.jpg', 'ikan_teri_medan', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('23', 'MACO ARAI', '', '10', '0', '200 GRAM', '200', '1,', '2', '14', '-', 'maco_arai_23.jpg', 'maco_arai', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('24', 'MACO GABUA', '', '', '0', '200 GRAM', '200', '1', '2', '14', null, null, 'maco_gabua', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('25', 'MACO ABUIH', '', '', '0', '200 GRAM', '200', '1', '2', '14', null, null, 'maco_abuih', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('26', 'IKAN TERI BIASA', '', '', '0', '200 GRAM', '200', '1', '2', '14', null, null, 'ikan_teri_biasa', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('27', 'UDANG', '', '10', '0', '1 KG', '1000', '1,', '2', '15', '-', 'udang_27.JPG', 'udang', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('28', 'CUMI', '', '10', '0', '1 KG', '1000', '1,', '2', '15', '-', 'cumi_28.jpg', 'cumi', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('29', 'KERANG DARA', '', '', '0', '1 KG', '1000', '1', '2', '15', null, null, 'kerang_dara', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('30', 'DAGING SAPI PADAT', '', '10', '0', '1 KG', '1000', '1,', '2', '11', '-', 'daging_sapi_padat_30.JPG', 'daging_sapi_padat', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('31', 'DAGING SAPI LOLO', '', '', '0', '1 KG', '1000', '1', '2', '11', null, null, 'daging_sapi_lolo', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('32', 'DAGING SAPI KAKI', '', '', '0', '1 KG', '1000', '1', '2', '11', null, null, 'daging_sapi_kaki', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('33', 'DAGING SAPI DENDENG', '', '', '0', '1 KG', '1000', '1', '2', '11', null, null, 'daging_sapi_dendeng', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('34', 'TUNJANG SAPI', '', '', '0', '1 KG', '1000', '1', '2', '11', null, null, 'tunjang_sapi', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('35', 'DAGING AYAM NEGERI BESAR', '', '', '0', '1 EKOR', '0', '1', '2', '11', null, null, 'daging_ayam_negeri_besar', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('36', 'DAGING AYAM NEGERI SEDANG', '', '', '0', '1 EKOR', '0', '1', '2', '11', null, null, 'daging_ayam_negeri_sedang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('37', 'DAGING AYAM KAMPUNG BESAR', '', '', '0', '1 EKOR', '0', '1', '2', '11', null, null, 'daging_ayam_kampung_besar', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('38', 'DAGING AYAM KAMPUNG SEDANG', '', '', '0', '1 EKOR', '0', '1', '2', '11', null, null, 'daging_ayam_kampung_sedang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('39', 'TELUR AYAM NEGERI BESAR', '', '10', '0', '1 LAPIAK', '0', '3,1,', '2', '10', '-', '', 'telur_ayam_negeri_besar', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('40', 'TELUR AYAM NEGERI SEDANG', '', '', '0', '1 LAPIAK', '0', '1,3', '2', '10', null, null, 'telur_ayam_negeri_sedang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('41', 'TELUR AYAM KAMPUNG', '', '', '0', '1 LAPIAK', '0', '1,3', '2', '10', null, null, 'telur_ayam_kampung', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('42', 'TELUR ITIK', '', '', '0', '1 LAPIAK', '0', '1,3', '2', '10', null, null, 'telur_itik', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('43', 'TELUR PUYUH', '', '', '0', '1 LAPIAK', '0', '1,3', '2', '10', null, null, 'telur_puyuh', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('44', 'TEMPE PUTIH DAUN', '', '10', '0', '1 POTONG', '0', '1,', '3', '16', '-', 'tempe_putih_daun_44.jpg', 'tempe_putih_daun', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('45', 'TEMPE PUTIH PLASTIK', '', '', '0', '1 BUNGKUS', '0', '1', '3', '16', null, null, 'tempe_putih_plastik', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('46', 'TAHU PUTIH', '', '8', '0', '4 POTONG', '0', '1,', '3', '17', '-', 'tahu_putih_46.jpg', 'tahu_putih', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('47', 'TAHU KUNING', '', '', '0', '4 POTONG', '0', '1', '3', '17', null, null, 'tahu_kuning', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('48', 'KACANG HIJAU', '', '0', '0', '1 LITER', '1000', '1,', '3', '18', '-', '', 'kacang_hijau', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('49', 'KACANG TANAH', '', '', '0', '1 LITER', '1000', '1', '3', '18', null, null, 'kacang_tanah', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('50', 'KACANG MERAH', '', '', '0', '1 LITER', '1000', '1', '3', '18', null, null, 'kacang_merah', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('51', 'KACANG RENDANG', '', '', '0', '1 LITER', '1000', '1', '3', '18', null, null, 'kacang_rendang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('52', 'KELAPA BULAT', '', '0', '0', '1 BUAH', '0', '1,', '3', '30', '-', '', 'kelapa_bulat', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('53', 'SANTAN KENTAL', '', '', '0', '1 KG', '1000', '1', '3', '30', null, null, 'Santan_kental', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('54', 'SANTAN ENCER', '', '', '0', '1 KG', '1000', '1', '3', '30', null, null, 'Santan_encer', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('55', 'SAYUR BAYAM', '', '10', '0', '1 IKAT', '400', '3,1,', '4', '19', '-', 'Sayur_bayam_55.jpg', 'Sayur_bayam', null, null, null, null, null, '1', 'Ikomart', 'Pedagang Pasar Banto', ' ');
INSERT INTO `produk` VALUES ('56', 'SAYUR KANGKUNG', '', '10', '0', '1 IKAT', '600', '3,1,', '4', '19', '-', 'Sayur_kangkung_56.jpg', 'Sayur_kangkung', null, null, null, null, null, '1', 'Ikomart', 'Pedagang Pasar Banto', ' ');
INSERT INTO `produk` VALUES ('57', 'SAYUR SAWI HIJAU', '', '10', '0', '200 GRAM', '200', '3,1,', '4', '19', '-', 'Sayur_sawi_hijau_57.JPG', 'Sayur_sawi_hijau', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('58', 'SAYUR LOBAK PUTIH ( KOL )', '', '10', '0', '200 GRAM', '200', '3,1,', '4', '19', '-', 'SAYUR_LOBAK_PUTIH_(_KOL_)_58.jpg', 'SAYUR_LOBAK_PUTIH_(_KOL_)', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('59', 'SAYUR DAUN UBI', '', '', '0', '200 GRAM', '200', '1,3', '4', '19', null, null, 'Sayur_daun_ubi', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('60', 'SAYUR PAKIS', '', '', '0', '200 GRAM', '200', '1,3', '4', '19', null, null, 'Sayur_pakis', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('61', 'SAYUR BROKOLI', '', '8', '0', '200 GRAM', '200', '3,1,', '4', '19', '-', 'Sayur_brokoli_61.jpg', 'Sayur_brokoli', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('62', 'SAYUR SELADA', '', '10', '0', '200 GRAM', '200', '3,1,', '4', '19', '-', '', 'Sayur_selada', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('63', 'BUNCIS', '', '8', '0', '200 GRAM', '200', '3,1,', '4', '20', '-', 'buncis_63.jpg', 'buncis', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('64', 'TOGE', '', '8', '0', '200 GRAM', '200', '3,1,', '4', '20', '-', 'toge_64.jpg', 'toge', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('65', 'KACANG PANJANG', '', '8', '0', '200 GRAM', '200', '3,1,', '4', '20', '-', 'kacang_panjang_65.jpg', 'kacang_panjang', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('66', 'WORTEL', '', '10', '0', '200 GRAM', '200', '3,1,', '4', '20', '-', 'wortel_66.jpg', 'wortel', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('67', 'KEMBANG KOL', '', '15', '0', '200 GRAM', '200', '3,1,', '4', '20', '-', 'kembang_kol_67.jpg', 'kembang_kol', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('68', 'LABU SIAM', '', '', '0', '200 GRAM', '200', '1,3', '4', '20', null, null, 'labu_siam', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('69', 'TERONG', '', '10', '0', '200 GRAM', '200', '3,1,', '4', '20', '-', 'terong_69.jpg', 'terong', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('70', 'TIMUN', '', '', '0', '200 GRAM', '200', '1,3', '4', '20', null, null, 'timun', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('71', 'PETAI', '', '10', '0', '200 GRAM', '200', '3,1,', '4', '20', '-', 'petai_71.jpg', 'petai', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('72', 'JENGKOL', '', '10', '0', '200 GRAM', '200', '3,1,', '4', '20', '-', 'jengkol_72.jpg', 'jengkol', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('73', 'RIMBANG', '', '', '0', '200 GRAM', '200', '1', '4', '20', null, null, 'rimbang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('74', 'CABE MERAH KERITING', '', '7', '0', '200 GRAM', '200', '3,1,', '4', '29', '-', 'cabe_merah_keriting_74.JPG', 'cabe_merah_keriting', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('75', 'CABE HIJAU KERITING', '', '8', '0', '200 GRAM', '200', '3,1,', '4', '29', '-', 'cabe_hijau_keriting_75.jpg', 'cabe_hijau_keriting', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('76', 'CABE RAWIT', '', '8', '0', '200 GRAM', '200', '3,1,', '4', '29', '-', 'cabe_rawit_76.JPG', 'cabe_rawit', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('77', 'CABE RAWIT SETAN', '', '', '0', '200 GRAM', '200', '1,3', '4', '29', null, null, 'cabe_rawit_setan', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('78', 'TOMAT MERAH', '', '7', '0', '200 GRAM', '200', '3,1,', '4', '19', '-', 'tomat_merah_78.jpg', 'tomat_merah', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('79', 'TOMAT HIAU', '', '10', '0', '200 GRAM', '200', '3,1,', '4', '19', '-', 'tomat_hiau_79.jpg', 'tomat_hiau', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('80', 'BAWANG MERAH BESAR', '', '9', '0', '200 GRAM', '200', '3,1,', '4', '28', '-', 'bawang_merah_besar_80.jpg', 'bawang_merah_besar', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('81', 'BAWANG MERAH SEDANG', '', '8', '0', '200 GRAM', '200', '3,1,', '4', '28', '-', 'bawang_merah_sedang_81.jpg', 'bawang_merah_sedang', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('82', 'BAWANG PUTIH', '', '8', '0', '200 GRAM', '200', '1,', '4', '28', '-', 'bawang_putih_82.jpg', 'bawang_putih', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('83', 'BAWANG BOMBAI', '', '10', '0', '200 GRAM', '200', '1,', '4', '28', '-', 'bawang_bombai_83.JPG', 'bawang_bombai', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('84', 'JERUK MANIS', '', '10', '0', '1 KG', '1000', '3,1,', '5', '22', '-', '', 'jeruk_manis', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('85', 'JERUK LEMON', '', '', '0', '1 KG', '1000', '1,3', '5', '22', null, null, 'jeruk_lemon', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('86', 'PISANG RAJA SUSU', '', '', '0', '1 SISIR', '0', '1', '5', '22', null, null, 'pisang_raja_susu', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('87', 'PISANG RAJA ULI', '', '', '0', '1 SISIR', '0', '1', '5', '22', null, null, 'pisang_raja_uli', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('88', 'PISANG GADANG', '', '', '0', '1 SISIR', '0', '1,3', '5', '22', null, null, 'pisang_gadang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('89', 'PISANG BATU', '', '', '0', '1 SISIR', '0', '1,3', '5', '22', null, null, 'pisang_batu', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('90', 'SEMANGKA MERAH', '', '', '0', '1 KG', '1000', '1,3', '5', '22', null, null, 'Semangka_merah', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('91', 'SEMANGKA KUNING', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'Semangka_kuning', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('92', 'PEPAYA MADU', '', '', '0', '1 KG', '1000', '1,3', '5', '22', null, null, 'pepaya_madu', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('93', 'PEPAYA BIASA', '', '', '0', '1 KG', '1000', '1,3', '5', '22', null, null, 'pepaya_biasa', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('94', 'APEL MALANG', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'apel_malang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('95', 'APEL MERAH', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'apel_merah', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('96', 'ANGGUR', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'anggur', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('97', 'ALPUKAT', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'alpukat', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('98', 'NENAS', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'nenas', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('99', 'JAMBU BIJI', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'jambu_biji', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('100', 'SAWO', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'Sawo', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('101', 'NANGKA', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'nangka', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('102', 'BENGKUANG', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'bengkuang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('103', 'MANGGIS', '', '', '0', '1 KG', '1000', '1', '5', '22', null, null, 'manggis', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('104', 'BUMBU RANDANG', '', '0', '0', '100 GRAM', '100', '1,', '6', '26', '-', '', 'bumbu_randang', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('105', 'BUMBU GULAI', '', '', '0', '100 GRAM', '100', '1', '6', '26', null, null, 'bumbu_gulai', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('106', 'BUMBU SUP', '', '', '0', '100 GRAM', '100', '1', '6', '26', null, null, 'bumbu_sup', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('107', 'BUMBU CANCANG', '', '', '0', '100 GRAM', '100', '1', '6', '26', null, null, 'bumbu_cancang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('108', 'BUMBU KALIO', '', '', '0', '100 GRAM', '100', '1', '6', '26', null, null, 'bumbu_kalio', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('109', 'BUMBU ASAM PADEH', '', '', '0', '100 GRAM', '100', '1', '6', '26', null, null, 'bumbu_asam_padeh', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('110', 'BUMBU TAUCO', '', '', '0', '100 GRAM', '100', '1', '6', '26', null, null, 'bumbu_tauco', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('111', 'DAUN SERAI', '', '10', '0', '1 IKAT', '0', '1,', '6', '25', '-', 'daun_serai_111.jpg', 'daun_serai', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('112', 'DAUN KUNYIT', '', '10', '0', '1 IKAT', '0', '1,', '6', '25', '-', 'daun_kunyit_112.jpg', 'daun_kunyit', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('113', 'DAUN JERUK', '', '', '0', '1 IKAT', '0', '1', '6', '25', null, null, 'daun_jeruk', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('114', 'DAUN BAWANG', '', '10', '0', '1 IKAT', '0', '3,1,', '6', '25', '-', 'daun_bawang_114.jpg', 'daun_bawang', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('115', 'DAUN SELEDRI', '', '10', '0', '1 IKAT', '0', '3,1,', '6', '25', '-', 'daun_seledri_115.jpg', 'daun_seledri', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('116', 'LENGKUAS', '', '10', '0', '100 GRAM', '100', '3,1,', '6', '65', '-', 'lengkuas_116.jpg', 'lengkuas', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('117', 'JAHE', '', '10', '0', '100 GRAM', '100', '3,1,', '6', '65', '-', 'jahe_117.jpg', 'jahe', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('118', 'KENCUR', '', '10', '0', '100 GRAM', '100', '3,1,', '6', '65', '-', 'kencur_118.jpg', 'kencur', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('119', 'KUNYIT', '', '10', '0', '100 GRAM', '100', '3,1,', '6', '65', '-', 'kunyit_119.jpg', 'kunyit', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('120', 'SIPADEH', '', '', '0', '100 GRAM', '100', '1,3', '6', '65', null, null, 'Sipadeh', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('121', 'KETUMBAR', '', '', '0', '100 GRAM', '100', '1', '6', '65', null, null, 'ketumbar', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('122', 'KAPULAGA', '', '', '0', '100 GRAM', '100', '1', '6', '65', null, null, 'kapulaga', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('123', 'DAMA', '', '', '0', '100 GRAM', '100', '1', '6', '65', null, null, 'dama', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('124', 'ASAM SUNDAI', '', '0', '0', '100 GRAM', '100', '1,', '6', '27', '-', '', 'asam_sundai', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('125', 'ASAM JAWA', '', '', '0', '100 GRAM', '100', '1', '6', '27', null, null, 'asam_jawa', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('126', 'ASAM KAPEH', '', '', '0', '100 GRAM', '100', '1', '6', '27', null, null, 'asam_kapeh', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('127', 'ASAM KANDIS', '', '', '0', '100 GRAM', '100', '1', '6', '27', null, null, 'asam_kandis', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('128', 'ASAM KASTURI', '', '', '0', '100 GRAM', '100', '1', '6', '27', null, null, 'asam_kasturi', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('129', 'JERUK NIPIS', '', '10', '0', '100 GRAM', '100', '3,1,', '6', '27', '-', 'jeruk_nipis_129.jpg', 'jeruk_nipis', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('130', 'UBI KAYU', '', '0', '0', '1 KG', '1000', '3,1,', '1', '21', '-', '', 'ubi_kayu', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('131', 'UBI JALAR MERAH', '', '', '0', '1 KG', '1000', '1,3', '1', '21', null, null, 'ubi_jalar_merah', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('132', 'UBI JALAR PUTIH', '', '', '0', '1 KG', '1000', '1', '1', '21', null, null, 'ubi_jalar_putih', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('133', 'MIE KUNING BASAH', '', '0', '0', '1 BUNGKUS', '0', '1,', '1', '66', '-', '', 'mie_kuning_basah', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('134', 'BIHUN/LASA', '', '', '0', '1 BUNGKUS', '0', '1', '1', '66', null, null, 'bihun/lasa', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('135', 'CENDOL HIJAU', '', '0', '0', '200 GRAM', '200', '1,', '10', '52', '-', '', 'cendol_hijau', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('136', 'CENDOL COKLAT', '', '', '0', '200 GRAM', '200', '1', '10', '52', null, null, 'cendol_coklat', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('137', 'CINCAU HITAM', '', '', '0', '200 GRAM', '200', '1', '10', '52', null, null, 'cincau_hitam', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('138', 'KOLANG KALING', '', '', '0', '200 GRAM', '200', '1', '10', '52', null, null, 'kolang_kaling', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('139', 'KERUPUK UDANG', '', '0', '0', '200 GRAM', '200', '1,', '10', '43', '-', '', 'kerupuk_udang', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('140', 'KERUPUK MERAH', '', '', '0', '200 GRAM', '200', '1', '10', '43', null, null, 'kerupuk_merah', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('141', 'KERUPUK JANGEK', '', '10', '0', '200 GRAM', '200', '1,', '10', '43', '-', 'kerupuk_jangek_141.jpg', 'kerupuk_jangek', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('142', 'KERUPUK UBI KOIN', '', '', '0', '200 GRAM', '200', '1', '10', '43', null, null, 'kerupuk_ubi_koin', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('143', 'KERUPUK MAMA', '', '', '0', '200 GRAM', '200', '1', '10', '43', null, null, 'kerupuk_mama', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('144', 'KERUPUK BELINJO/EMPING', '', '', '0', '200 GRAM', '200', '1', '10', '43', null, null, 'kerupuk_belinjo/emping', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('145', 'GULA PASIR KILOAN', '', '10', '0', '500 GRAM', '200', '1,', '1', '8', '-', 'gula_pasir_kiloan_145.jpeg', 'gula_pasir_kiloan', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('146', 'GULA MERAH', '', '', '0', '200 GRAM', '200', '1', '1', '8', null, null, 'gula_merah', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('147', 'GULA AREN ( GULO SAKA)', '', '', '0', '200 GRAM', '200', '1', '1', '8', null, null, 'gula_aren_(_gulo_saka)', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('148', 'GARAM KASAR', '', '0', '0', '1 BUNGKUS', '0', '1,', '1', '52', '-', '', 'garam_kasar', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('149', 'GARAM HALUS', '', '', '0', '1 BUNGKUS', '0', '1', '1', '52', null, null, 'garam_halus', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('150', 'KUAH KACANG SINTI', '', '', '0', '1 BUNGKUS', '0', '1', '1', '38', null, null, 'kuah_kacang_sinti', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('151', 'INDOMIE GORENG SAMBAL RICA-RICA 85G', '', '0', '0', ' -', '0', '2,', '1', '66', '-', '', 'indomie_goreng_sambal_rica-rica_85g', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('152', 'SEDAAP MIE GORENG 90G - KARTON', '', '10', '0', ' -', '0', '2,', '1', '66', '-', 'Sedaap_mie_goreng_90g_-_karton_152.jpg', 'Sedaap_mie_goreng_90g_-_karton', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('153', 'INDOMIE GORENG JUMBO AYAM PANGGANG 127G - KARTON', '', '', '0', ' -', '0', '2', '1', '66', null, null, 'indomie_goreng_jumbo_ayam_panggang_127g_-_karton', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('154', 'SUKSES\'S MI GORENG AYAM KREMEES ISI 2 133G', '', '', '0', ' -', '0', '2', '1', '66', null, null, 'Sukses\'s_mi_goreng_ayam_kremees_isi_2_133g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('155', 'LEMONILO MIE KARI AYAM 70G', '', '', '0', ' -', '0', '2', '1', '66', null, null, 'lemonilo_mie_kari_ayam_70g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('156', 'CHOCOLATOS DRINK - CHOCO LATTE - 10X28G', '', '0', '0', ' -', '0', '2,', '10', '51', '-', '', 'chocolatos_drink_-_choco_latte_-_10x28g', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('157', 'GOOD DAY CAPPUCCINO BAG 30X25G', '', '', '0', ' -', '0', '2', '10', '51', null, null, 'good_day_cappuccino_bag_30x25g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('158', 'SARIWANGI TEH MELATI 25 TEH CELUP', '', '10', '0', ' -', '0', '2,', '10', '51', '-', 'Sariwangi_teh_melati_25_teh_celup_158.jpg', 'Sariwangi_teh_melati_25_teh_celup', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('159', 'NESCAFE - CLASSIC PRO - 120G DALGONA', '', '', '0', ' -', '0', '2', '10', '51', null, null, 'nescafe_-_classic_pro_-_120g_dalgona', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('160', 'LUWAK WHITE KOFFIE ORIGINAL 10X20G', '', '', '0', ' -', '0', '2', '10', '51', null, null, 'luwak_white_koffie_original_10x20g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('161', 'SO GOOD CHICKEN STICK ORIGINAL 200G', '', '0', '0', ' -', '0', '2,', '10', '43', '-', '', 'So_good_chicken_stick_original_200g', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('162', 'HOME SARDINE', '', '', '0', ' -', '0', '2', '10', '43', null, null, 'home_sardine', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('163', 'TELUR AYAM NEGERI 2KG', '', '', '0', ' -', '0', '2', '10', '43', null, null, 'telur_ayam_negeri_2kg', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('164', 'PRONAS CORNED BEEF 198G', '', '', '0', ' -', '0', '2', '10', '43', null, null, 'pronas_corned_beef_198g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('165', 'CHAMP CHICKEN NUGGET 500G', '', '', '0', ' -', '0', '2', '10', '43', null, null, 'champ_chicken_nugget_500g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('166', 'MILNA NATURE PUFFS ORGANIC APPLE & MIX BERRIES 15G', '', '0', '0', ' -', '0', '2,', '8', '67', '-', '', 'milna_nature_puffs_organic_apple_&_mix_berries_15g', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('167', 'PROMINA BUBUR BERGIZI BERAS MERAH 120G', '', '', '0', '120Gr', '120', '2', '8', '67', '-', '', 'promina_bubur_bergizi_beras_merah_120g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('168', 'CERELAC NUTRIPUFFS BANANA & STRAWBERRY 50G', '', '', '0', '  -', '0', '2', '8', '67', null, null, 'cerelac_nutripuffs_banana_&_strawberry_50g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('169', 'SUN BUBUR SUSU BERAS MERAH EKONOMIS 120G', '', '', '0', '120Gr', '120', '2', '8', '67', 'SUN', '', 'Sun_bubur_susu_beras_merah_ekonomis_120g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('170', 'MILNA BISKUIT BAYI BERAS MERAH 130G', '', '', '0', '130Gr', '120', '2', '8', '67', '-', '', 'milna_biskuit_bayi_beras_merah_130g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('171', 'CHOCO PIE MARSHMALLOW 2 X 28G', '', '', '0', ' -', '0', '2', '10', '43', null, null, 'choco_pie_marshmallow_2_x_28g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('172', 'NISSIN LEMONIA COOKIES 130G', '', '', '0', ' -', '0', '2', '10', '43', null, null, 'nissin_lemonia_cookies_130g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('173', 'GOOD TIME COOKIES COFFEE 72G', '', '', '0', ' -', '0', '2', '10', '43', null, null, 'good_time_cookies_coffee_72g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('174', 'SARI ROTI TAWAR JUMBO 555 Gr', '', '0', '0', '555 Gr', '555', '2,', '10', '44', 'SARI ROTI', '', 'SARI_ROTI_TAWAR_JUMBO_555_Gr', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('175', 'SARI ROTI ROTI ISI COKELAT KEJU 70GR', '', '', '0', ' -', '0', '2', '10', '43', null, null, 'Sari_roti_roti_isi_cokelat_keju_70gr', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('176', 'CHOCOLATOS CLASSIC WAFER ROLL - ISI 24 PCS', '', '', '0', ' -', '0', '2', '10', '44', null, null, 'chocolatos_classic_wafer_roll_-_isi_24_pcs', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('177', 'MENTOS COOL GEL CHERRY 132G', '', '', '0', ' -', '0', '2', '10', '44', null, null, 'mentos_cool_gel_cherry_132g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('178', 'NYAMNYAM MOO MILKY VANILLA 28G', '', '', '0', ' -', '0', '2', '10', '44', null, null, 'nyamnyam_moo_milky_vanilla_28g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('179', 'GARUDA PILUS PEDAS 95G', '', '', '0', ' -', '0', '2', '10', '44', null, null, 'garuda_pilus_pedas_95g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('180', 'REBO KUACI BIJI BUNGA MATAHARI MILK 150G', '', '', '0', ' -', '0', '2', '10', '44', null, null, 'rebo_kuaci_biji_bunga_matahari_milk_150g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('181', 'FRUIT TEA APPLE PET 350ML', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'fruit_tea_apple_pet_350ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('182', 'TEHBOTOL SOSRO ORIGINAL PET 350ML', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'tehbotol_sosro_original_pet_350ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('183', 'GOOD DAY FUNTASTIC MOCACINNO 6X250ML', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'good_day_funtastic_mocacinno_6x250ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('184', 'SINDE LARUTAN PENYEGAR CAP BADAK ORANGE 320ML', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'Sinde_larutan_penyegar_cap_badak_orange_320ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('185', 'ULTRA TEH KOTAK 200ML', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'ultra_teh_kotak_200ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('186', 'SGM EKSPLOR 1+ VANILLA 400G', '', '0', '0', '400G', '400', '2,', '8', '67', 'SGM', '', 'Sgm_eksplor_1+_vanilla_400g', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('187', 'DANCOW ADVANCED EXCELNUTRI 1+ MADU 800G', '', '', '0', ' -', '0', '2', '8', '67', null, null, 'dancow_advanced_excelnutri_1+_madu_800g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('188', 'FRISIAN BABY LANGKAH 800G', '', '', '0', ' -', '0', '2', '8', '67', null, null, 'frisian_baby_langkah_800g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('189', 'MILO COMPLETE MIX 960G', '', '0', '0', '960G', '960', '2,', '10', '45', 'MILO', '', 'milo_complete_mix_960g', null, null, null, null, null, '1', '0', '0', ' ');
INSERT INTO `produk` VALUES ('190', 'DIABETASOL VANILLA 180G', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'diabetasol_vanilla_180g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('191', 'FRISIAN FLAG UHT PUREFARM COCONUT DELIGHT 225ML', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'frisian_flag_uht_purefarm_coconut_delight_225ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('192', 'ULTRA MIMI SUSU UHT FULL CREAM 125ML', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'ultra_mimi_susu_uht_full_cream_125ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('193', 'INDOMILK KRIMER KENTAL MANIS COKELAT KALENG 370G', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'indomilk_krimer_kental_manis_cokelat_kaleng_370g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('194', 'BEAR BRAND GOLD MALT PUTIH KALENG 140ML', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'bear_brand_gold_malt_putih_kaleng_140ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('195', 'NARAYA SOYA BOTOL 320ML', '', '', '0', ' -', '0', '2', '10', '45', null, null, 'naraya_soya_botol_320ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('196', 'DAIA + SOFTENER DETERJEN PINK 850G', '', '0', '0', '850G', '850', '2,', '9', '31', 'DAIA', '', 'daia_+_softener_deterjen_pink_850g', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('197', 'KISPRAY FINE PERFUME GLAMOROUS GOLD REFILL 300ML', '', '', '0', ' -', '0', '2', '9', '31', null, null, 'kispray_fine_perfume_glamorous_gold_refill_300ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('198', 'VANISH CAIR REFILL 750ML', '', '', '0', ' -', '0', '2', '9', '31', null, null, 'vanish_cair_refill_750ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('199', 'DOWNY PELEMBUT & PEWANGI SUNRISE FRESH REFILL 800M', '', '', '0', ' -', '0', '2', '9', '31', null, null, 'downy_pelembut_&_pewangi_sunrise_fresh_refill_800ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('200', 'EKONOMI SABUN CREAM LEMON 480G', '', '', '0', ' -', '0', '2', '9', '31', null, null, 'ekonomi_sabun_cream_lemon_480g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('201', 'PASEO ELEGANT TOWEL NAPKIN 1 ROLL', '', '', '0', ' -', '0', '2', '9', '31', null, null, 'paseo_elegant_towel_napkin_1_roll', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('202', 'VIXAL PEMBERSIH PORSELEN KAMAR MANDI EKSTRA KUAT 7', '', '', '0', ' -', '0', '2', '9', '31', null, null, 'vixal_pembersih_porselen_kamar_mandi_ekstra_kuat_780ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('203', 'GLADE AUTOMATIC 3 IN 1 SPRAY SHANDY', '', '', '0', ' -', '0', '2', '9', '31', null, null, 'glade_automatic_3_in_1_spray_shandy', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('204', 'SUPER SOL KARBOL WANGI REFILL 800ML', '', '', '0', ' -', '0', '2', '9', '31', null, null, 'Super_sol_karbol_wangi_refill_800ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('205', 'CLEAN MATIC 2 IN 1 BROOM BIRU', '', '', '0', ' -', '0', '2', '9', '31', null, null, 'clean_matic_2_in_1_broom_biru', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('206', 'FORMULA SIKAT GIGI SENSITIVE ACTION CARE 3S', '', '0', '0', ' -', '0', '2,', '7', '32', 'FORMULA', '', 'formula_sikat_gigi_sensitive_action_care_3s', null, null, null, null, null, '1', '0', '0', ' ');
INSERT INTO `produk` VALUES ('207', 'LISTERINE NATUR GREEN TEA 250 ML - 2 BOTOL', '', '0', '0', '250 Ml', '250', '2,', '7', '32', 'LISTERINE', '', 'listerine_natur_green_tea_250_ml_-_2_botol', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('208', 'PEPSODENT STANDARD 25G', '', '10', '0', ' -', '0', '2,', '7', '32', '-', '', 'PEPSODENT_STANDARD_25G', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('209', 'PEPSODENT MOUTH WASH SENSITIVE EXPERT 300ML', '', '', '0', ' -', '0', '2', '7', '32', null, null, 'pepsodent_mouth_wash_sensitive_expert_300ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('210', 'ORAL-B SIKAT GIGI ALL ROUNDER 123 CLEAN SOFT 40', '', '', '0', ' -', '0', '2', '7', '32', null, null, 'oral-b_sikat_gigi_all_rounder_123_clean_soft_40', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('211', 'NATUR-E HAND & BODY LOTION NOURISHING REVITALIZING', '', '0', '0', ' -', '0', '2,', '7', '33', 'NATUR-E', '', 'natur-e_hand_&_body_lotion_nourishing_revitalizing_245ml', null, null, null, null, null, '1', '0', '0', ' ');
INSERT INTO `produk` VALUES ('212', 'LIFEBUOY BAR SOAP LEMON FRESH 75G', '', '', '0', ' -', '0', '2', '7', '33', null, null, 'lifebuoy_bar_soap_lemon_fresh_75g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('213', 'DETTOL LIQUID ANTISEPTIC BOTOL 245ML', '', '', '0', ' -', '0', '2', '7', '33', null, null, 'dettol_liquid_antiseptic_botol_245ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('214', 'DOVE DEODORANT ROLL ON ULTIMATE WHITE 40ML', '', '', '0', ' -', '0', '2', '7', '33', null, null, 'dove_deodorant_roll_on_ultimate_white_40ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('215', 'SHINZU\'I BODY SCRUB MATSU 200G', '', '', '0', ' -', '0', '2', '7', '33', null, null, 'Shinzu\'i_body_scrub_matsu_200g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('216', 'PANTENE SHAMPOO HAIR FALL NEW 70ML', '', '', '0', ' -', '0', '2', '7', '34', null, null, 'pantene_shampoo_hair_fall_new_70ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('217', 'SUNSILK CONDITIONER BLACK SHINE 170ML', '<p align=\"justify\">Sunsilk Black Shine merupakan salah satu varian sampo dari Sunsilk yang mengandung urang aring dan Anti UV Active. Sunsilk Black Shine akan membuat rambut menjadi kuat hingga ke akar rambut dan hitam berkilau.</p>\r\n', '9', '0', '1 botol', '170', '2,', '7', '34', 'SUNSILK', 'Sunsilk_conditioner_black_shine_170ml_217.jpeg', 'Sunsilk_conditioner_black_shine_170ml', null, null, null, null, null, '1', 'ikomart', 'ikomart', ' ');
INSERT INTO `produk` VALUES ('218', 'GATSBY STYLING POMADE SUPREME HOLD 75G', '', '', '0', ' -', '0', '2', '7', '34', null, null, 'gatsby_styling_pomade_supreme_hold_75g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('219', 'ELLIPS HAIR MASK TREATMENT 20G', '', '', '0', ' -', '0', '2', '7', '34', null, null, 'ellips_hair_mask_treatment_20g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('220', 'GARNIER HAIR COLOR NATURALS BLACK SACHET 20ML', '', '', '0', ' -', '0', '2', '7', '34', null, null, 'garnier_hair_color_naturals_black_sachet_20ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('221', 'SELECTION KAPAS MINI SIZE 35G', '', '0', '0', ' -', '0', '2,', '7', '35', 'SELECTION', '', 'Selection_kapas_mini_size_35g', null, null, null, null, null, '1', '0', '0', ' ');
INSERT INTO `produk` VALUES ('222', 'VASELINE LIP THERAPY ROSY LIPS 7G', '', '', '0', ' -', '0', '2', '7', '35', null, null, 'vaseline_lip_therapy_rosy_lips_7g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('223', 'MUSTIKA RATU MASKER WAJAH BENGKOANG 15G', '', '', '0', ' -', '0', '2', '7', '35', null, null, 'mustika_ratu_masker_wajah_bengkoang_15g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('224', 'POND\'S DAY CREAM WHITE BEAUTY NORMAL SKIN 20G', '', '', '0', ' -', '0', '2', '7', '35', null, null, 'pond\'s_day_cream_white_beauty_normal_skin_20g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('225', 'WARDAH LIGHTENING GENTLE WASH 60ML', '', '', '0', ' -', '0', '2', '7', '35', null, null, 'wardah_lightening_gentle_wash_60ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('226', 'CLEAR SHAMPOO ICE COOL MENTHOL 160ML', '', '', '0', ' -', '0', '2', '7', '35', null, null, 'clear_shampoo_ice_cool_menthol_160ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('227', 'VASELINE MEN FACE WASH HEALTHY WHITE 100G', '', '', '0', ' -', '0', '2', '7', '35', null, null, 'vaseline_men_face_wash_healthy_white_100g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('228', 'GILLETTE BLUE 3', '', '', '0', ' -', '0', '2', '7', '35', null, null, 'gillette_blue_3', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('229', 'GATSBY BODY SHOWER GEL REFRESH REFILL 500ML', '', '', '0', ' -', '0', '2', '7', '36', null, null, 'gatsby_body_shower_gel_refresh_refill_500ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('230', 'AXE DEODORANT BODY SPRAY ANARCHY FOR HIM 150ML', '', '', '0', ' -', '0', '2', '7', '36', null, null, 'axe_deodorant_body_spray_anarchy_for_him_150ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('231', 'VITALIS EAU DE COLOGNE FEMME CHIC 100ML', '', '', '0', ' -', '0', '2', '7', '36', null, null, 'vitalis_eau_de_cologne_femme_chic_100ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('232', 'CHRISTIAN JORNALD COMMAND EDT PRIA 60ML', '', '', '0', ' -', '0', '2', '7', '36', null, null, 'christian_jornald_command_edt_pria_60ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('233', 'MARINA CARRIBEAN BREEZE 100ML', '', '0', '0', '100ML', '100', '2,', '7', '36', 'MARINA', '', 'marina_carribean_breeze_100ml', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('234', 'MUSK LILIAN B.SPRAY BLACK 200ML', '', '', '0', ' -', '0', '2', '7', '36', null, null, 'musk_lilian_b.spray_black_200ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('235', 'IMPERIAL LEATHER BODY MIST WHITE PRINCESS 100ML', '', '0', '0', '100ML', '100', '2,', '7', '37', 'IMPERIAL', '', 'imperial_leather_body_mist_white_princess_100ml', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('236', 'SUPREME ADULT DIAPERS M', '', '', '0', ' -', '0', '2', '7', '37', null, null, 'Supreme_adult_diapers_m', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('237', 'SOFTEX PANTYLINERS DAUN SIRIH 50S', '', '', '0', ' -', '0', '2', '7', '37', null, null, 'Softex_pantyliners_daun_sirih_50s', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('238', 'CHARM BODY FIT EXTRA MAXI 30S', '', '', '0', ' -', '0', '2', '7', '37', null, null, 'charm_body_fit_extra_maxi_30s', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('239', 'LIFREE POPOK CELANA DEWASA EKSTRA SERAP XL-6', '', '', '0', ' -', '0', '2', '7', '37', null, null, 'lifree_popok_celana_dewasa_ekstra_serap_xl-6', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('240', 'LAURIER ACTIVE DAY SUPER MAXI NON WING 30PCS', '', '', '0', ' -', '0', '2', '7', '37', null, null, 'laurier_active_day_super_maxi_non_wing_30pcs', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('241', 'SOFFELL GERANIUM 80G', '', '0', '0', '80G', '80', '2,', '7', '38', 'SOFFELL', '', 'Soffell_geranium_80g', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('242', 'AUTAN ALL NIGHT TUBE 50ML', '', '', '0', ' -', '0', '2', '7', '38', null, null, 'autan_all_night_tube_50ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('243', 'GELANG ANTI NYAMUK | MOSQUITO BRACELET ', '', '', '0', ' -', '0', '2', '7', '38', null, null, 'gelang_anti_nyamuk_|_mosquito_bracelet_', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('244', 'DUPA MELAVSU SANDAL WOOD INCENSE SPIRAL', '', '', '0', ' -', '0', '2', '7', '38', null, null, 'dupa_melavsu_sandal_wood_incense_spiral', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('245', 'SOFFELL KULIT JERUK BOTOL 80G', '', '', '0', ' -', '0', '2', '7', '38', null, null, 'Soffell_kulit_jeruk_botol_80g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('246', 'CUSSONS BABY COLOGNE SOFT TOUCH 100ML', '', '0', '0', '100ML', '100', '2,', '8', '40', 'CUSSONS', '', 'cussons_baby_cologne_soft_touch_100ml', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('247', 'PIGEON COTTON BALL / KAPAS BULAT / KAPAS BAYI', '', '0', '0', ' -', '0', '2,', '8', '39', 'PIGEON', '', 'pigeon_cotton_ball_/_kapas_bulat_/_kapas_bayi', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('248', 'JOHNSON\'S BABY CREAM 50G', '', '', '0', ' -', '0', '2', '8', '40', null, null, 'johnson\'s_baby_cream_50g', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('249', 'MY BABY MINYAK TELON PLUS EUCALYPTUS 60ML', '', '', '0', ' -', '0', '2', '8', '40', null, null, 'my_baby_minyak_telon_plus_eucalyptus_60ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('250', 'DEE-DEE PASTA GIGI + SIKAT GIGI GIFT PACK', '', '', '0', ' -', '0', '2', '8', '40', null, null, 'dee-dee_pasta_gigi_+_sikat_gigi_gift_pack', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('251', 'YY DISPOSABLE BABY BIBS - 20\'S', '', '', '0', ' -', '0', '2', '8', '40', null, null, 'yy_disposable_baby_bibs_-_20\'S', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('252', 'PIGEON BREAST PUMP MANUAL / POMPA ASI MANUAL', '', '0', '0', ' -', '0', '2,', '8', '39', 'PIGEON', '', 'pigeon_breast_pump_manual_/_pompa_asi_manual', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('253', 'HUKI BREASTPAD ISI 12PCS / HUKI BABY', '', '', '0', ' -', '0', '2', '8', '39', null, null, 'huki_breastpad_isi_12pcs_/_huki_baby', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('254', 'DODO BOTOL SUSU PENGUIN 8OZ 250ML', '', '', '0', ' -', '0', '2', '8', '39', null, null, 'dodo_botol_susu_penguin_8oz_250ml', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('255', 'BABY SAFE BREAST PAD 12PC/ DISPOSABLE BREATPAD', '', '', '0', ' -', '0', '2', '8', '39', null, null, 'baby_safe_breast_pad_12pc/_disposable_breatpad', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('256', 'Kacang Barandang Pak Datuak', '<p align=\"justify\">Kacang rendang yang gurih dan renyah.</p>\r\n', '10', '0', '1 Bungkus', '250', '5,4,', '10', '43', 'Pak Datuak', 'Kacang_Barandang_Pak_Datuak_256.png', 'Kacang_Barandang_Pak_Datuak', null, null, null, null, null, '1', 'Ikomart', 'Ikomart', ' ');
INSERT INTO `produk` VALUES ('257', 'Ikan Bilih Singkarak', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'ikan_bilih_singkarak', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('258', 'Galamai', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'galamai', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('259', 'Kerupuak Cancang Kuning', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'kerupuak_cancang_kuning', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('260', 'Kerupuak Jangek Mentah', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'kerupuak_jangek_mentah', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('261', 'Kerupuak Jangek Siap Makan', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'kerupuak_jangek_siap_makan', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('262', 'Kerupuak Karak Kaliang', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'kerupuak_karak_kaliang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('263', 'Kerupuak Katam', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'kerupuak_katam', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('264', 'Kerupuak Sanjai', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'kerupuak_sanjai', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('265', 'Frozen Food Risoles', '', '10', '0', ' -', '0', '5,4,', '10', '43', '-', 'frozen_food_risoles_265.jpg', 'frozen_food_risoles', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('266', 'Keju Lasi', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'keju_lasi', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('267', 'Kue Kacang', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'kue_kacang', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('268', 'Kue Sapik', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'kue_sapik', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('269', 'Sagun Bakar', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'Sagun_bakar', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('270', 'Kopi Sachet Bukik Apik', '', '0', '0', ' -', '0', '5,4,', '10', '43', 'Bukik Apik', '', 'kopi_sachet_bukik_apik', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('271', 'Kopi Kopigo', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'kopi_kopigo', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('272', 'Kopi Kawa Daun', '', '', '0', ' -', '0', '4,5', '10', '43', null, null, 'kopi_kawa_daun', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('273', 'Baju Bukittinggi', '', '0', '0', ' -', '0', '6,5,4,', '13', '60', '-', '', 'baju_bukittinggi', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('274', 'Peci Kopiah', '', '0', '0', ' -', '0', '6,5,4,', '13', '57', '-', '', 'peci_kopiah', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('275', 'Tas pandai sikek', '', '', '0', ' -', '0', '6,5,4,', '13', '57', null, null, 'tas_pandai_sikek', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('276', 'Mukena Motif', '', '0', '0', ' -', '0', '6,5,4,', '13', '59', '-', '', 'mukena_motif', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('277', 'Baju Kuruang Bukik', '', '', '0', ' -', '0', '4,5', '13', '60', null, null, 'baju_kuruang_bukik', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('278', 'Kalung ', '', '', '0', ' -', '0', '4,5', '13', '57', null, null, 'kalung_', null, null, null, null, null, '1', null, null, null);
INSERT INTO `produk` VALUES ('279', 'Gantungan Kunci', '', '0', '0', ' -', '0', '6,5,4,', '11', '54', '-', '', 'gantungan_kunci', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('280', 'Songket Silungkang', '', '0', '0', ' -', '0', '6,5,4,', '12', '58', '-', '', 'Songket_silungkang', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('281', 'ABC Kecap Manis Botol 275ml', '<p align=\"justify\">ABC kecap manis dibuat dengan kedelai, gandum dan gula merah pilihan sehingga menghasilkan kecap manis dengan citarasa khas, hitam dan kental.</p>\r\n', '1', '0', '275ml', '275', '2,', '1', '52', 'ABC', 'ABC_Kecap_Manis_Botol_275ml_281.png', 'ABC_Kecap_Manis_Botol_275ml', null, null, null, null, null, '1', 'Ikomart', 'Ikomart', '1');
INSERT INTO `produk` VALUES ('282', 'souvenir gelang', '<p align=\"justify\">-</p>\r\n', '1', '0', '-', '0', '5,4,', '13', '57', '-', 'souvenir_gelang_282.jpeg', 'souvenir_gelang', null, null, null, null, null, '', 'Hotel California', 'Hotel California', '3');
INSERT INTO `produk` VALUES ('283', 'buah kiwi', '<p align=\"justify\">buah kiwi</p>\r\n', '1', '0', '1 Kg', '1000', '2,', '18', '26', '-', '', 'buah_kiwi', null, null, null, null, null, '1', 'Ikomart', 'Ikomart', ' ');
INSERT INTO `produk` VALUES ('284', 'Cengkeh solok', '<p align=\"justify\">Cengkeh merupakan salah satu bahan rempah-rempah dari Indonesia yang memiliki rasa manis dan aroma yang khas. Selain sebagai bumbu rempah, cengkeh memiliki banyak manfaat bagi kesehatan, seperti, membunuh bakteri penyebab penyakit, mengobati sakit...</p>\r\n', '10', '0', '1 Kg', '1000', '6,', '14', '24', '-', 'Cengkeh_solok_284.jpeg', 'Cengkeh_solok', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('286', 'Kacang Goreng Pak Datuak', '<p align=\"justify\">Kacang Goreng Pak Datuak merupakan salah satu olahan kacang tanah yang disangrai (marandang). Ini merupakan salah satu olahan yang berasal dari Batusangkar, Bukittinggi. Kacang Goreng Pak Datuak merupakan produk lokal.</p>\r\n', '9', '0', '1 kantong', '600', '5,4,', '13', '77', 'Pak Datuak', 'Kacang_Goreng_Pak_Datuak_286.png', 'Kacang_Goreng_Pak_Datuak', null, null, null, null, null, '1', 'Ikomart', 'Ikomart', ' ');
INSERT INTO `produk` VALUES ('287', 'Kopi Hitam Aqsa', '<p align=\"justify\">Kopi Hitam Bubuk Aqsa Instan.</p>\r\n', '10', '0', '1 kotak', '249', '2,', '10', '51', 'Aqsa', 'Kopi_Hitam_Aqsa_287.png', 'Kopi_Hitam_Aqsa', null, null, null, null, null, '1', 'Ikomart', 'Ikomart', ' ');
INSERT INTO `produk` VALUES ('288', 'paket sembako murah', '<p align=\"justify\">Paket Sembako Murah</p>\r\n', '5', '0', '1 kantong', '1200', '2,', '1', '52', 'Ikomart', 'paket_sembako_murah_.jpg', 'paket_sembako_murah', null, null, null, null, null, '1', 'Ikomart', 'Ikomart', ' ');
INSERT INTO `produk` VALUES ('289', 'Indomie Mi Instan Rasa Kari Ayam', '<p align=\"justify\">Indomie Mi Instan rasa kari ayam yang gurih dan nikmat berpadu dengan mi yang lembut, membuat Indomie kari ayam pilihan yang tepat untuk teman penghilang lapar bahkan ketika dikala cuaca yang dingin atau hujan. Dengan cara pengolahannya yang mudah dan tidak memakan waktu lama.</p>\r\n', '10', '0', '72 gram', '72', '2,', '10', '66', 'indomie', 'Indomie_Mi_Instan_Rasa_Kari_Ayam_289.jpg', 'Indomie_Mi_Instan_Rasa_Kari_Ayam', null, null, null, null, null, '1', 'Ikomart', 'Ikomart', ' ');
INSERT INTO `produk` VALUES ('290', 'Kepiting Rajungan', '<p align=\"justify\">Kepiting rajungan merupakan salah satu makanan laut yang juga dikonsumsi oleh masyarakat di Indonesia. Meskipun dagingnya lebih sedikit dibanding dengan kepiting biasa tetapi kandungan protein didalam kepiting rajungan lebih tinggi dari kepiting biasa, serta rendah kalori. Manfaat dari mengkonsumsi rajungan dapat membantu dalam menurunkan berat badan, meningkatkan kesehatan mata, mencegah kerusakan pada sel tubuh, dan mengurangi resiko terkena penyakit jantung.</p>\r\n', '10', '0', '-', '1000', '1,', '2', '15', '-', 'Kepiting_Rajungan_.jpg', 'Kepiting_Rajungan', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('291', 'Daun Salam', '<p align=\"justify\">Daun Salam adalah salah satu jenis rempah yang sering digunakan dalam keadaan kering. Daun salam yang dikeringkan punya cita rasa yang lebih kaya dan menambah rasa sedap berlebih terhadap masakan. Selain sebagai penyedap rasa masakan, daun salam memiliki banyak manfaat diantaranya, dapat mengatasi masalah pencernaan, meringankan rasa nyeri, mengurangi migrain hingga dapat mencegah pertumbuhan uban.</p>\r\n', '10', '0', '-', '1', '1,', '4', '25', '-', 'Daun_Salam_.jpg', 'Daun_Salam', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('292', 'Bansi', '<p align=\"justify\">Seruling dengang ukuran kecil khas Sumatera Barat yang terbuat dari bambu, disebut Bansi.</p>\r\n', '10', '0', '-', '0', '5,', '11', '56', '-', 'Bansi_.png', 'Bansi', null, null, null, null, null, '1', '-', '--', ' ');
INSERT INTO `produk` VALUES ('293', 'Cocoa Powder', '<p align=\"justify\">Cokelat Bubuk Malibou Instan.</p>\r\n', '10', '0', '-', '0', '5,', '10', '51', 'Cokelat Malibou Cocoa Powder', 'Cocoa_Powder_.png', 'Cocoa_Powder', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('294', 'coklat malibou', '<p align=\"justify\">Cokelat Malibou Instan Three in One.</p>\r\n', '10', '0', '-', '0', '5,', '10', '43', 'Cokelat Malibou Three in One', 'coklat_malibou_.png', 'coklat_malibou', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('295', 'Dompet Motif Bordiran', '<p align=\"justify\">Dompet yang bermotif bordiran.</p>\r\n', '10', '0', '-', '0', '6,5,4,', '12', '61', '-', 'Dompet_.png', 'Dompet_Motif_Bordiran', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('296', 'Dompet Motif Rumah Gadang (Code DR001)', '<p align=\"justify\">Dompet motif Rumah Gadang berbahan dasar beludru.</p>\r\n', '10', '0', '-', '0', '6,5,4,', '12', '61', '-', 'Dompet_Motif_Rumah_Gadang_(Code_DR001)_.png', 'Dompet_Motif_Rumah_Gadang_(Code_DR001)', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('297', 'Dompet Motif Rumah Gadang (Code DR002) ', '<p align=\"justify\">Dompet motif Rumah Gadang berbahan dasar beludru.</p>\r\n', '10', '0', '-', '0', '6,5,4,', '12', '61', '-', 'Dompet_Motif_Rumah_Gadang_(Code_DR002)__297.png', 'Dompet_Motif_Rumah_Gadang_(Code_DR002)_', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('298', 'Dompet Motif Rumah Gadang (Code DR003)', '<p align=\"justify\">Dompet motif Rumah Gadang berbahan dasar strimin.</p>\r\n', '10', '0', '-', '0', '6,5,4,', '12', '61', '-', 'Dompet_Motif_Rumah_Gadang_(Code_DR003)_.png', 'Dompet_Motif_Rumah_Gadang_(Code_DR003)', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('299', 'Dompet Motif Sulaman (code AA11)', '<p align=\"justify\">Dompet ukuran besar yang bermotif sulaman.</p>\r\n', '10', '0', '-', '0', '6,5,4,', '12', '61', '-', 'Dompet_Motif_Sulaman_(code_AA11)_.png', 'Dompet_Motif_Sulaman_(code_AA11)', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('300', 'Dompet Motif Sulaman (code AA12)', '<p align=\"justify\">Dompet ukuran sedang yang bermotif sulaman.</p>\r\n', '10', '0', '-', '0', '6,5,4,', '12', '61', '-', 'Dompet_Motif_Sulaman_(code_AA12)_.png', 'Dompet_Motif_Sulaman_(code_AA12)', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('301', 'Dompet Motif Sulaman (code AA13)', '<p align=\"justify\">Dompet ukuran kecil yang bermotif sulaman</p>\r\n', '10', '0', '-', '0', '6,5,4,', '12', '61', '-', 'Dompet_Motif_Sulaman_(code_AA13)_.png', 'Dompet_Motif_Sulaman_(code_AA13)', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('302', 'Keripik Bayam', '<p align=\"justify\">Keripik bayam yang gurih dan renyah.</p>\r\n', '10', '0', '-', '0', '6,5,4,', '10', '43', 'Erina Keripik Bayam', 'Keripik_Bayam_.png', 'Keripik_Bayam', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('303', 'Keripik Kentang', '<p align=\"justify\">Keripik kentang yang gurih dan renyah.</p>\r\n', '10', '0', '-', '0', '6,5,4,', '10', '43', 'Erina Keripik Kentang', 'Keripik_Kentang_.png', 'Keripik_Kentang', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('304', 'Keripik pisang', '<p align=\"justify\">Keripik pisang yang gurih dan renyah.</p>\r\n', '10', '0', '-', '0', '5,', '10', '43', 'Erina Keripik Sabana', 'Keripik_pisang_.png', 'Keripik_pisang', null, null, null, null, null, '1', '-', '-', ' ');
INSERT INTO `produk` VALUES ('305', 'Pisang Sale', '<p align=\"justify\">Pisang Sale yang dibumbui oleh bubuk coklat manis.</p>\r\n', '10', '0', '-', '0', '5,', '10', '43', 'Erina Pisang Sale Cokelat', 'Pisang_Sale_.png', 'Pisang_Sale', null, null, null, null, null, '1', '-', '-', ' ');
