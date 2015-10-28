/*
SQLyog Professional v10.42 
MySQL - 5.6.12-log : Database - sistem_pakar
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sistem_pakar` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sistem_pakar`;

/*Table structure for table `analisa_hasil` */

DROP TABLE IF EXISTS `analisa_hasil`;

CREATE TABLE `analisa_hasil` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pemilik` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `kelamin_sapi` enum('J','B') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `varietas_sapi` int(1) NOT NULL,
  `jenis_sapi` int(1) NOT NULL,
  `usia` int(2) NOT NULL,
  `lokasi` varchar(128) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `session_id` varchar(128) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `kd_penyakit` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `analisa_hasil` */

insert  into `analisa_hasil`(`id`,`nama_pemilik`,`kelamin_sapi`,`varietas_sapi`,`jenis_sapi`,`usia`,`lokasi`,`session_id`,`tanggal`,`kd_penyakit`) values (6,'dede','B',2,1,21,'w','5e33fa078d77e04825d701b69b7ad013','2015-09-24 12:25:35',11),(7,'dede','J',2,1,21,'wweessss','dabb8a650a121b36469e9cb9bc3aa436','2015-09-24 12:27:06',11),(8,'Dede Gunawan','J',4,2,21,'Cioray','f6bd06d263a7a226feb740102c8d61d1','2015-09-24 14:29:48',0),(9,'Dede Gunawan','J',2,3,12,'Cijantung','47a607fa627caccfeca54c6932e9a5aa','2015-09-24 15:01:11',15);

/*Table structure for table `gejala` */

DROP TABLE IF EXISTS `gejala`;

CREATE TABLE `gejala` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nm_gejala` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `gejala` */

insert  into `gejala`(`id`,`nm_gejala`) values (4,'Keluar air liur terus menerus'),(5,'Kesulitan bernafas (ngorok)'),(6,'Kondisi tubuh lemah dan lesu'),(7,'Suhu tubuh meningkat sampai diatas 41<sup>0</sup> C'),(8,'Tubuh gemetar'),(9,'Selaput lendir kemerahan'),(10,'Keluar getah radang dari hidung dan mata'),(11,'Selaput lendir terlihat menguning'),(12,'Moncong kering dan pecah-pecah terisi nanah'),(13,'Hidung tersumbat kerak sehingga kesulitan bernafas'),(14,'Kondisi badan menurun, lemah dan menjadi kurus'),(15,'Lepuh-lepuh bernanah pada kulit'),(16,'Kerak pada permukaan kulit berwarna keabuan'),(17,'Lieur');

/*Table structure for table `jenis_sapi` */

DROP TABLE IF EXISTS `jenis_sapi`;

CREATE TABLE `jenis_sapi` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(24) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_sapi` */

insert  into `jenis_sapi`(`id`,`nama_jenis`) values (1,'Perah'),(2,'Pedaging'),(3,'Indukan');

/*Table structure for table `meta` */

DROP TABLE IF EXISTS `meta`;

CREATE TABLE `meta` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `meta_name` varchar(64) NOT NULL,
  `meta_caption` varchar(128) NOT NULL,
  `meta_value` longtext NOT NULL,
  `_id` int(6) NOT NULL,
  `_table` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`meta_name`,`_id`,`_table`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `meta` */

/*Table structure for table `penyakit` */

DROP TABLE IF EXISTS `penyakit`;

CREATE TABLE `penyakit` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nm_penyakit` varchar(128) NOT NULL,
  `nm_latin` varchar(128) NOT NULL,
  `definisi` text NOT NULL,
  `solusi` text NOT NULL,
  `other` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `penyakit` */

insert  into `penyakit`(`id`,`nm_penyakit`,`nm_latin`,`definisi`,`solusi`,`other`) values (11,'NGOROK','SEPTICHAEMIA EPIZOOTICA','','',''),(12,'Mubeng','TRYPANOSOMIASIS','','',''),(13,'Ingusan','MALIGNANT CATHARRAL FEVER','','',''),(15,'SCABIES','-','','','');

/*Table structure for table `relasi` */

DROP TABLE IF EXISTS `relasi`;

CREATE TABLE `relasi` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `kd_penyakit` int(6) NOT NULL,
  `kd_gejala` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`kd_penyakit`,`kd_gejala`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `relasi` */

insert  into `relasi`(`id`,`kd_penyakit`,`kd_gejala`) values (7,11,4),(8,11,5),(9,11,6),(10,11,7),(11,11,8),(12,11,9),(14,12,6),(16,12,7),(13,12,10),(17,12,11),(23,13,4),(18,13,7),(19,13,11),(20,13,12),(21,13,13),(22,13,14),(24,15,15),(27,15,16);

/*Table structure for table `tmp_analisa` */

DROP TABLE IF EXISTS `tmp_analisa`;

CREATE TABLE `tmp_analisa` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(128) NOT NULL DEFAULT '',
  `kd_penyakit` longtext NOT NULL,
  `kd_gejala` int(6) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `tmp_analisa` */

insert  into `tmp_analisa`(`id`,`session_id`,`kd_penyakit`,`kd_gejala`,`status`) values (6,'deb9ff027f0f2ed5d05fd6b0d6532fdb','[11,12,13]',7,'Y'),(7,'deb9ff027f0f2ed5d05fd6b0d6532fdb','[11,13]',4,'Y'),(8,'deb9ff027f0f2ed5d05fd6b0d6532fdb','[13]',5,'N'),(9,'8638279a8a8b9f2f4d2bdb19ab04d8bb','[11,12,13]',7,'Y'),(10,'8638279a8a8b9f2f4d2bdb19ab04d8bb','[11,13]',4,'Y'),(11,'8638279a8a8b9f2f4d2bdb19ab04d8bb','[11]',5,'Y'),(12,'8638279a8a8b9f2f4d2bdb19ab04d8bb','[11]',6,'Y'),(13,'8638279a8a8b9f2f4d2bdb19ab04d8bb','[11]',8,'Y'),(14,'d07e49428806d86cd2c4ab10dc1c72bf','[11,12,13]',7,'Y'),(15,'d07e49428806d86cd2c4ab10dc1c72bf','[11,13]',4,'Y'),(16,'d07e49428806d86cd2c4ab10dc1c72bf','[11]',5,'Y'),(17,'d07e49428806d86cd2c4ab10dc1c72bf','[11]',6,'Y'),(18,'d07e49428806d86cd2c4ab10dc1c72bf','[11]',8,'Y'),(19,'5e33fa078d77e04825d701b69b7ad013','[11,12,13]',7,'Y'),(20,'5e33fa078d77e04825d701b69b7ad013','[11,13]',4,'Y'),(21,'5e33fa078d77e04825d701b69b7ad013','[11]',5,'Y'),(22,'5e33fa078d77e04825d701b69b7ad013','[11]',6,'Y'),(23,'5e33fa078d77e04825d701b69b7ad013','[11]',8,'Y'),(24,'dabb8a650a121b36469e9cb9bc3aa436','[11,12,13]',7,'Y'),(25,'dabb8a650a121b36469e9cb9bc3aa436','[11,13]',4,'Y'),(26,'dabb8a650a121b36469e9cb9bc3aa436','[11]',5,'Y'),(27,'dabb8a650a121b36469e9cb9bc3aa436','[11]',6,'Y'),(28,'dabb8a650a121b36469e9cb9bc3aa436','[11]',8,'Y'),(29,'47a607fa627caccfeca54c6932e9a5aa','[15]',7,'N'),(30,'47a607fa627caccfeca54c6932e9a5aa','[15]',15,'Y');

/*Table structure for table `tmp_gejala` */

DROP TABLE IF EXISTS `tmp_gejala`;

CREATE TABLE `tmp_gejala` (
  `kd_gejala` int(6) NOT NULL,
  `session_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmp_gejala` */

/*Table structure for table `tmp_pasien` */

DROP TABLE IF EXISTS `tmp_pasien`;

CREATE TABLE `tmp_pasien` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pemilik` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `kelamin_sapi` enum('J','B') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `varietas_sapi` int(1) NOT NULL,
  `jenis_sapi` int(1) NOT NULL,
  `usia` int(2) NOT NULL,
  `lokasi` varchar(128) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `session_id` varchar(128) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `tmp_pasien` */

insert  into `tmp_pasien`(`id`,`nama_pemilik`,`kelamin_sapi`,`varietas_sapi`,`jenis_sapi`,`usia`,`lokasi`,`session_id`,`tanggal`) values (17,'Dede Gunawan','J',2,3,12,'Cijantung','47a607fa627caccfeca54c6932e9a5aa','2015-09-24 15:01:11');

/*Table structure for table `tmp_penyakit` */

DROP TABLE IF EXISTS `tmp_penyakit`;

CREATE TABLE `tmp_penyakit` (
  `kd_penyakit` int(6) NOT NULL,
  `session_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmp_penyakit` */

/*Table structure for table `tmp_relasi` */

DROP TABLE IF EXISTS `tmp_relasi`;

CREATE TABLE `tmp_relasi` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `kd_penyakit` int(6) NOT NULL,
  `kd_gejala` int(6) NOT NULL,
  `session_id` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`kd_penyakit`,`kd_gejala`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmp_relasi` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `user_nama` varchar(64) NOT NULL,
  `user_password` varchar(128) NOT NULL,
  `user_level` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`user_nama`,`user_password`,`user_level`) values (1,'gunawanassanusi1@gmail.com','$2y$10$yrOPB1xac8WOdWqENqXvWuRYOUqw3HNQj.b0yOiti29ywTBfO57y2','admin'),(2,'dede@pakar.com','$2y$10$viKzEnFSVjWIRJFma35Em.0AJrvJDo0oO8PSggcCULULuowVaJL16','pakar');

/*Table structure for table `varietas_sapi` */

DROP TABLE IF EXISTS `varietas_sapi`;

CREATE TABLE `varietas_sapi` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(24) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `varietas_sapi` */

insert  into `varietas_sapi`(`id`,`nama_jenis`) values (1,'Brahman'),(2,'Limosin'),(3,'Simental'),(4,'Bali'),(5,'Lainnya');

/* Procedure structure for procedure `getDetailRekaman` */

/*!50003 DROP PROCEDURE IF EXISTS  `getDetailRekaman` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailRekaman`(id INT(6))
BEGIN
SELECT ah.id, IF(UPPER(ah.`kelamin_sapi`) = 'J', "Jantan", "Betina") AS kelamin_sapi, 
ah.`nama_pemilik`, p.`nm_penyakit`, p.nm_latin, p.definisi, p.solusi, p.other,
IF(j.`nama_jenis` IS NOT NULL, j.`nama_jenis`, "")  AS jenis_sapi,
IF(v.nama_jenis IS NOT NULL, v.nama_jenis, "") AS varietas_sapi, 
ah.kd_penyakit,
CONCAT(ah.usia, " Bulan") AS usia, ah.`lokasi`
FROM analisa_hasil ah 
LEFT OUTER JOIN penyakit p ON ah.`kd_penyakit` = p.`id`
LEFT OUTER JOIN jenis_sapi j ON ah.`jenis_sapi` = j.`id`
LEFT OUTER JOIN varietas_sapi v ON ah.`varietas_sapi` = v.`id`
WHERE ah.id = id;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
