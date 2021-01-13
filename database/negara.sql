/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ikomart_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-12-27 18:45:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for negara
-- ----------------------------
DROP TABLE IF EXISTS `negara`;
CREATE TABLE `negara` (
  `id_negara` int(5) NOT NULL,
  `nm_negara` text,
  `tarif` double DEFAULT NULL,
  `id_kirim` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_negara`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- ----------------------------
-- Records of negara
-- ----------------------------
INSERT INTO `negara` VALUES ('1', 'Afghanistan', '1981350', '6');
INSERT INTO `negara` VALUES ('2', 'Albania', '1981350', '6');
INSERT INTO `negara` VALUES ('3', 'Algeria', '1981350', '6');
INSERT INTO `negara` VALUES ('4', 'American Samoa ', '1981350', '6');
INSERT INTO `negara` VALUES ('5', 'Andorra', '1464210', '6');
INSERT INTO `negara` VALUES ('6', 'Angola', '1981350', '6');
INSERT INTO `negara` VALUES ('7', 'Anguilla', '1981350', '6');
INSERT INTO `negara` VALUES ('8', 'Antigua', '1981350', '6');
INSERT INTO `negara` VALUES ('9', 'Argentina', '1981350', '6');
INSERT INTO `negara` VALUES ('10', 'Armenia', '1981350', '6');
INSERT INTO `negara` VALUES ('11', 'Aruba', '1981350', '6');
INSERT INTO `negara` VALUES ('12', 'Australia', '1049070', '6');
INSERT INTO `negara` VALUES ('13', 'Azerbaijan', '1981350', '6');
INSERT INTO `negara` VALUES ('14', 'Bahamas', '1981350', '6');
INSERT INTO `negara` VALUES ('15', 'Bahrain', '1303560', '6');
INSERT INTO `negara` VALUES ('16', 'Bangladesh', '1303560', '6');
INSERT INTO `negara` VALUES ('17', 'Barbados', '1981350', '6');
INSERT INTO `negara` VALUES ('18', 'Belarus', '1981350', '6');
INSERT INTO `negara` VALUES ('19', 'Belgium', '1464210', '6');
INSERT INTO `negara` VALUES ('20', 'Belize', '1981350', '6');
INSERT INTO `negara` VALUES ('21', 'Benin', '1981350', '6');
INSERT INTO `negara` VALUES ('22', 'Bermuda', '1981350', '6');
INSERT INTO `negara` VALUES ('23', 'Bhutan', '1981350', '6');
INSERT INTO `negara` VALUES ('24', 'Bolivia', '1981350', '6');
INSERT INTO `negara` VALUES ('25', 'Bonaire', '1981350', '6');
INSERT INTO `negara` VALUES ('26', 'Bosnia & Herzegovina', '1981350', '6');
INSERT INTO `negara` VALUES ('27', 'Botswana', '1981350', '6');
INSERT INTO `negara` VALUES ('28', 'Brazil', '1981350', '6');
INSERT INTO `negara` VALUES ('29', 'Brunei', '821610', '6');
INSERT INTO `negara` VALUES ('30', 'Bulgaria', '1464210', '6');
INSERT INTO `negara` VALUES ('31', 'Burkina Faso', '1981350', '6');
INSERT INTO `negara` VALUES ('32', 'Burundi', '1981350', '6');
INSERT INTO `negara` VALUES ('33', 'Cambodia', '821610', '6');
INSERT INTO `negara` VALUES ('34', 'Cameroon', '1981350', '6');
INSERT INTO `negara` VALUES ('35', 'Canada', '1222980', '6');
INSERT INTO `negara` VALUES ('36', 'Canary Islands', '1981350', '6');
INSERT INTO `negara` VALUES ('37', 'Cape Verde', '1981350', '6');
INSERT INTO `negara` VALUES ('38', 'Cayman Islands', '1981350', '6');
INSERT INTO `negara` VALUES ('39', 'Central African Rep', '1981350', '6');
INSERT INTO `negara` VALUES ('40', 'Chad', '1981350', '6');
INSERT INTO `negara` VALUES ('41', 'Chile', '1981350', '6');
INSERT INTO `negara` VALUES ('42', 'China *1', '915450', '6');
INSERT INTO `negara` VALUES ('43', 'China *2', '1049070', '6');
INSERT INTO `negara` VALUES ('44', 'Colombia', '1981350', '6');
INSERT INTO `negara` VALUES ('45', 'Comoros', '1981350', '6');
INSERT INTO `negara` VALUES ('46', 'Congo', '1981350', '6');
INSERT INTO `negara` VALUES ('47', 'Congo, DPR', '1981350', '6');
INSERT INTO `negara` VALUES ('48', 'Cook Islands', '1981350', '6');
INSERT INTO `negara` VALUES ('49', 'Costa Rica', '1981350', '6');
INSERT INTO `negara` VALUES ('50', 'Cote D Ivoire', '1981350', '6');
INSERT INTO `negara` VALUES ('51', 'Croatia', '1464210', '6');
INSERT INTO `negara` VALUES ('52', 'Cuba', '1981350', '6');
INSERT INTO `negara` VALUES ('53', 'Curacao', '1981350', '6');
INSERT INTO `negara` VALUES ('54', 'Cyprus', '1464210', '6');
INSERT INTO `negara` VALUES ('55', 'Czech Rep', '1464210', '6');
INSERT INTO `negara` VALUES ('56', 'Denmark', '1464210', '6');
INSERT INTO `negara` VALUES ('57', 'Djibouti', '1981350', '6');
INSERT INTO `negara` VALUES ('58', 'Dominica', '1981350', '6');
INSERT INTO `negara` VALUES ('59', 'Dominican Rep', '1981350', '6');
INSERT INTO `negara` VALUES ('60', 'Ecuador', '1981350', '6');
INSERT INTO `negara` VALUES ('61', 'Egypt', '1981350', '6');
INSERT INTO `negara` VALUES ('62', 'El Salvador', '1981350', '6');
INSERT INTO `negara` VALUES ('63', 'Eritrea', '1981350', '6');
INSERT INTO `negara` VALUES ('64', 'Estonia', '1981350', '6');
INSERT INTO `negara` VALUES ('65', 'Eswatini', '1981350', '6');
INSERT INTO `negara` VALUES ('66', 'Ethiopia', '1981350', '6');
INSERT INTO `negara` VALUES ('67', 'Falkland Islands', '1981350', '6');
INSERT INTO `negara` VALUES ('68', 'Faroe Islands', '1981350', '6');
INSERT INTO `negara` VALUES ('69', 'Fiji', '1464210', '6');
INSERT INTO `negara` VALUES ('70', 'Finland', '1464210', '6');
INSERT INTO `negara` VALUES ('71', 'France', '1981350', '6');
INSERT INTO `negara` VALUES ('72', 'French Guyana', '1981350', '6');
INSERT INTO `negara` VALUES ('73', 'Gabon', '1981350', '6');
INSERT INTO `negara` VALUES ('74', 'Gambia', '1981350', '6');
INSERT INTO `negara` VALUES ('75', 'Georgia', '1981350', '6');
INSERT INTO `negara` VALUES ('76', 'Germany', '1464210', '6');
INSERT INTO `negara` VALUES ('77', 'Ghana', '1981350', '6');
INSERT INTO `negara` VALUES ('78', 'Gibraltar', '1981350', '6');
INSERT INTO `negara` VALUES ('79', 'Greece', '1464210', '6');
INSERT INTO `negara` VALUES ('80', 'Greenland', '1981350', '6');
INSERT INTO `negara` VALUES ('81', 'Grenada', '1981350', '6');
INSERT INTO `negara` VALUES ('82', 'Guadeloupe', '1981350', '6');
INSERT INTO `negara` VALUES ('83', 'Guam', '1981350', '6');
INSERT INTO `negara` VALUES ('84', 'Guatemala', '1981350', '6');
INSERT INTO `negara` VALUES ('85', 'Guernsey', '1981350', '6');
INSERT INTO `negara` VALUES ('86', 'Guinea Rep', '1981350', '6');
INSERT INTO `negara` VALUES ('87', 'Guinea-Bissau', '1981350', '6');
INSERT INTO `negara` VALUES ('88', 'Guinea-Equatorial', '1981350', '6');
INSERT INTO `negara` VALUES ('89', 'Guyana (British)', '1981350', '6');
INSERT INTO `negara` VALUES ('90', 'Haiti', '1981350', '6');
INSERT INTO `negara` VALUES ('91', 'Honduras', '1981350', '6');
INSERT INTO `negara` VALUES ('92', 'Hong Kong SAR China', '821610', '6');
INSERT INTO `negara` VALUES ('93', 'Hungary', '1464210', '6');
INSERT INTO `negara` VALUES ('94', 'Iceland', '1981350', '6');
INSERT INTO `negara` VALUES ('95', 'India', '1303560', '6');
INSERT INTO `negara` VALUES ('96', 'Indonesia', '0', '0');
INSERT INTO `negara` VALUES ('97', 'Iran', '1981350', '6');
INSERT INTO `negara` VALUES ('98', 'Iraq', '1981350', '6');
INSERT INTO `negara` VALUES ('99', 'Ireland, Rep Of', '1464210', '6');
INSERT INTO `negara` VALUES ('100', 'Israel', '1981350', '6');
INSERT INTO `negara` VALUES ('101', 'Italy', '1464210', '6');
INSERT INTO `negara` VALUES ('102', 'Jamaica', '1981350', '6');
INSERT INTO `negara` VALUES ('103', 'Japan', '915450', '6');
INSERT INTO `negara` VALUES ('104', 'Jersey', '1981350', '6');
INSERT INTO `negara` VALUES ('105', 'Jordan', '1303560', '6');
INSERT INTO `negara` VALUES ('106', 'Kazakhstan', '1981350', '6');
INSERT INTO `negara` VALUES ('107', 'Kenya', '1981350', '6');
INSERT INTO `negara` VALUES ('108', 'Kiribati', '1981350', '6');
INSERT INTO `negara` VALUES ('109', 'Korea, Rep Of', '1049070', '6');
INSERT INTO `negara` VALUES ('110', 'Korea D.P.R Of', '1981350', '6');
INSERT INTO `negara` VALUES ('111', 'Kosovo', '1981350', '6');
INSERT INTO `negara` VALUES ('112', 'Kuwait', '1303560', '6');
INSERT INTO `negara` VALUES ('113', 'Kyrgyzstan', '1981350', '6');
INSERT INTO `negara` VALUES ('114', 'Laos', '821610', '6');
INSERT INTO `negara` VALUES ('115', 'Latvia', '1464210', '6');
INSERT INTO `negara` VALUES ('116', 'Lebanon', '1981350', '6');
INSERT INTO `negara` VALUES ('117', 'Lesotho', '1981350', '6');
INSERT INTO `negara` VALUES ('118', 'Liberia', '1981350', '6');
INSERT INTO `negara` VALUES ('119', 'Libya', '1981350', '6');
INSERT INTO `negara` VALUES ('120', 'Liechtenstein', '1464210', '6');
INSERT INTO `negara` VALUES ('121', 'Lithuania', '1464210', '6');
INSERT INTO `negara` VALUES ('122', 'Luxembourg', '1464210', '6');
INSERT INTO `negara` VALUES ('123', 'Macau SAR China', '821610', '6');
INSERT INTO `negara` VALUES ('124', 'Madagascar', '1981350', '6');
INSERT INTO `negara` VALUES ('125', 'Malawi', '1981350', '6');
INSERT INTO `negara` VALUES ('126', 'Malaysia', '821610', '6');
INSERT INTO `negara` VALUES ('127', 'Maldives', '1303560', '6');
INSERT INTO `negara` VALUES ('128', 'Mali', '1981350', '6');
INSERT INTO `negara` VALUES ('129', 'Malta', '1464210', '6');
INSERT INTO `negara` VALUES ('130', 'Mariana Islands', '1981350', '6');
INSERT INTO `negara` VALUES ('131', 'Marshall Islands', '1981350', '6');
INSERT INTO `negara` VALUES ('132', 'Martinique', '1981350', '6');
INSERT INTO `negara` VALUES ('133', 'Mauritania', '1981350', '6');
INSERT INTO `negara` VALUES ('134', 'Mauritius', '1981350', '6');
INSERT INTO `negara` VALUES ('135', 'Mayotte', '1981350', '6');
INSERT INTO `negara` VALUES ('136', 'Mexico', '1222980', '6');
INSERT INTO `negara` VALUES ('137', 'Micronesia', '1981350', '6');
INSERT INTO `negara` VALUES ('138', 'Moldova, Rep. Of', '1981350', '6');
INSERT INTO `negara` VALUES ('139', 'Monaco', '1464210', '6');
INSERT INTO `negara` VALUES ('140', 'Mongolia', '1981350', '6');
INSERT INTO `negara` VALUES ('141', 'Montenegro, Rep. Of', '1981350', '6');
INSERT INTO `negara` VALUES ('142', 'Montserrat', '1981350', '6');
INSERT INTO `negara` VALUES ('143', 'Morocco', '1981350', '6');
INSERT INTO `negara` VALUES ('144', 'Mozambique', '1981350', '6');
INSERT INTO `negara` VALUES ('145', 'Myanmar', '821610', '6');
INSERT INTO `negara` VALUES ('146', 'Namibia', '1981350', '6');
INSERT INTO `negara` VALUES ('147', 'Nauru, Rep. Of', '1981350', '6');
INSERT INTO `negara` VALUES ('148', 'Nepal', '1303560', '6');
INSERT INTO `negara` VALUES ('149', 'Netherlands, The', '1464210', '6');
INSERT INTO `negara` VALUES ('150', 'Nevis', '1981350', '6');
INSERT INTO `negara` VALUES ('151', 'New Caledonia', '1981350', '6');
INSERT INTO `negara` VALUES ('152', 'Vew Zealand', '1049070', '6');
INSERT INTO `negara` VALUES ('153', 'Nicaragua', '1981350', '6');
INSERT INTO `negara` VALUES ('154', 'Niger', '1981350', '6');
INSERT INTO `negara` VALUES ('155', 'Nigeria', '1981350', '6');
INSERT INTO `negara` VALUES ('156', 'Niue', '1981350', '6');
INSERT INTO `negara` VALUES ('157', 'North Macedonia', '1981350', '6');
INSERT INTO `negara` VALUES ('158', 'Norway', '1464210', '6');
INSERT INTO `negara` VALUES ('159', 'Oman', '1303560', '6');
INSERT INTO `negara` VALUES ('160', 'Pakistan', '1303560', '6');
INSERT INTO `negara` VALUES ('161', 'Palau', '1981350', '6');
INSERT INTO `negara` VALUES ('162', 'Panama', '1981350', '6');
INSERT INTO `negara` VALUES ('163', 'Papua New Guinea', '1049070', '6');
INSERT INTO `negara` VALUES ('164', 'Paraguay', '1981350', '6');
INSERT INTO `negara` VALUES ('165', 'Peru', '1981350', '6');
INSERT INTO `negara` VALUES ('166', 'Philippines', '821610', '6');
INSERT INTO `negara` VALUES ('167', 'Poland', '1464210', '6');
INSERT INTO `negara` VALUES ('168', 'Portugal', '1464210', '6');
INSERT INTO `negara` VALUES ('169', 'Puerto Rico', '1981350', '6');
INSERT INTO `negara` VALUES ('170', 'Qatar', '1303560', '6');
INSERT INTO `negara` VALUES ('171', 'Reunion, Islands Of', '1981350', '6');
INSERT INTO `negara` VALUES ('172', 'Romania', '1464210', '6');
INSERT INTO `negara` VALUES ('173', 'Russian Federation', '1981350', '6');
INSERT INTO `negara` VALUES ('174', 'Rwanda', '1981350', '6');
INSERT INTO `negara` VALUES ('175', 'Saint Helena', '1981350', '6');
INSERT INTO `negara` VALUES ('176', 'Samoa', '1981350', '6');
INSERT INTO `negara` VALUES ('177', 'San Marino', '1464210', '6');
INSERT INTO `negara` VALUES ('178', 'Sao Tome And Principe', '1981350', '6');
INSERT INTO `negara` VALUES ('179', 'Saudi Arabia', '1303560', '6');
INSERT INTO `negara` VALUES ('180', 'Senegal', '1981350', '6');
INSERT INTO `negara` VALUES ('181', 'Serbia', '1981350', '6');
INSERT INTO `negara` VALUES ('182', 'Seychelles', '1981350', '6');
INSERT INTO `negara` VALUES ('183', 'Sierra Leone', '1981350', '6');
INSERT INTO `negara` VALUES ('184', 'Singapore', '754290', '6');
INSERT INTO `negara` VALUES ('185', 'Slovakia', '1464210', '6');
INSERT INTO `negara` VALUES ('186', 'Slovenia', '1464210', '6');
INSERT INTO `negara` VALUES ('187', 'Solomon Islands', '1981350', '6');
INSERT INTO `negara` VALUES ('188', 'Somalia', '1981350', '6');
INSERT INTO `negara` VALUES ('189', 'Somaliland', '1981350', '6');
INSERT INTO `negara` VALUES ('190', 'South Africa', '1464210', '6');
INSERT INTO `negara` VALUES ('191', 'South Sudan', '1981350', '6');
INSERT INTO `negara` VALUES ('192', 'Spain', '1464210', '6');
INSERT INTO `negara` VALUES ('193', 'Sri Lanka', '1303560', '6');
INSERT INTO `negara` VALUES ('194', 'St. Barthelemy', '1981350', '6');
INSERT INTO `negara` VALUES ('195', 'St. Eustatius', '1981350', '6');
INSERT INTO `negara` VALUES ('196', 'St. Kitts', '1981350', '6');
INSERT INTO `negara` VALUES ('197', 'St. Lucia', '1981350', '6');
INSERT INTO `negara` VALUES ('198', 'St. Maarten', '1981350', '6');
INSERT INTO `negara` VALUES ('199', 'St. Vincent', '1981350', '6');
INSERT INTO `negara` VALUES ('200', 'Sudan', '1981350', '6');
INSERT INTO `negara` VALUES ('201', 'Suriname', '1981350', '6');
INSERT INTO `negara` VALUES ('202', 'Sweden', '1464210', '6');
INSERT INTO `negara` VALUES ('203', 'Switzerland', '1464210', '6');
INSERT INTO `negara` VALUES ('204', 'Syria', '1981350', '6');
INSERT INTO `negara` VALUES ('205', 'Thiti', '1981350', '6');
INSERT INTO `negara` VALUES ('206', 'Taiwan', '1049070', '6');
INSERT INTO `negara` VALUES ('207', 'Tajikistan', '1981350', '6');
INSERT INTO `negara` VALUES ('208', 'Tanzania', '1981350', '6');
INSERT INTO `negara` VALUES ('209', 'Thailand', '821610', '6');
INSERT INTO `negara` VALUES ('210', 'Timor-Leste', '754290', '6');
INSERT INTO `negara` VALUES ('211', 'Togo', '1981350', '6');
INSERT INTO `negara` VALUES ('212', 'Tonga', '1981350', '6');
INSERT INTO `negara` VALUES ('213', 'Trinidad And Tobago', '1981350', '6');
INSERT INTO `negara` VALUES ('214', 'Tunisia', '1981350', '6');
INSERT INTO `negara` VALUES ('215', 'Turkey', '1464210', '6');
INSERT INTO `negara` VALUES ('216', 'Turkmenistan', '1981350', '6');
INSERT INTO `negara` VALUES ('217', 'Turks & Caicos', '1981350', '6');
INSERT INTO `negara` VALUES ('218', 'Tuvalu', '1981350', '6');
INSERT INTO `negara` VALUES ('219', 'USA', '1222980', '6');
INSERT INTO `negara` VALUES ('220', 'Uganda', '1981350', '6');
INSERT INTO `negara` VALUES ('221', 'Ukraine', '1981350', '6');
INSERT INTO `negara` VALUES ('222', 'United Arab Emirates', '1303560', '6');
INSERT INTO `negara` VALUES ('223', 'United Kingdom', '1464210', '6');
INSERT INTO `negara` VALUES ('224', 'Uruguay', '1981350', '6');
INSERT INTO `negara` VALUES ('225', 'Uzbekistan', '1981350', '6');
INSERT INTO `negara` VALUES ('226', 'Vanuatu', '1981350', '6');
INSERT INTO `negara` VALUES ('227', 'Vatican City', '1464210', '6');
INSERT INTO `negara` VALUES ('228', 'Venezuele', '1981350', '6');
INSERT INTO `negara` VALUES ('229', 'Vietnam', '821610', '6');
INSERT INTO `negara` VALUES ('230', 'Virgin Islands-British', '1981350', '6');
INSERT INTO `negara` VALUES ('231', 'Virgin Islands-US', '1981350', '6');
INSERT INTO `negara` VALUES ('232', 'Yemen', '1981350', '6');
INSERT INTO `negara` VALUES ('233', 'Zambia', '1981350', '6');
INSERT INTO `negara` VALUES ('234', 'Zimbabwe', '1981350', '6');
