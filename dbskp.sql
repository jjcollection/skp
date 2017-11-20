/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.25-MariaDB-1~xenial : Database - skp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`skp` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `skp`;

/*Table structure for table `aspek` */

DROP TABLE IF EXISTS `aspek`;

CREATE TABLE `aspek` (
  `idAspek` int(11) NOT NULL AUTO_INCREMENT,
  `namaAspek` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idAspek`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `aspek` */

insert  into `aspek`(`idAspek`,`namaAspek`) values 
(1,'Orientasi Pelayanan'),
(2,'Integritas'),
(3,'Komitmen'),
(4,'Disiplin'),
(5,'Kerjasama'),
(6,'Kepemimpinan');

/*Table structure for table `aturan` */

DROP TABLE IF EXISTS `aturan`;

CREATE TABLE `aturan` (
  `IdAturan` int(11) NOT NULL AUTO_INCREMENT,
  `IdGolongan` int(11) DEFAULT NULL,
  `IdKriteria` int(11) DEFAULT NULL,
  `AK` double DEFAULT NULL,
  PRIMARY KEY (`IdAturan`),
  KEY `IdKriteria` (`IdKriteria`),
  KEY `IdGolongan` (`IdGolongan`),
  CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`IdKriteria`) REFERENCES `kriteria` (`IdKriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`IdGolongan`) REFERENCES `golongan` (`idGolongan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `aturan` */

insert  into `aturan`(`IdAturan`,`IdGolongan`,`IdKriteria`,`AK`) values 
(11,13,2,29.75),
(12,14,2,29.75),
(13,15,2,29),
(14,16,2,42.5),
(15,9,2,10.5),
(16,11,2,20.25),
(17,12,2,19.5),
(18,14,2,29.75),
(19,15,2,29),
(20,16,2,42.5);

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values 
('admin',76,NULL),
('guru',69,2147483647),
('guru',74,2147483647),
('guru',75,2147483647),
('guru',77,2147483647),
('kasek',70,2147483647);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values 
('/site/signup/*',1,NULL,NULL,NULL,NULL,NULL),
('admin',1,NULL,NULL,NULL,NULL,NULL),
('create-formulir',1,NULL,NULL,NULL,NULL,NULL),
('fmaster-kasek',1,NULL,NULL,NULL,NULL,NULL),
('guru',1,NULL,NULL,NULL,NULL,NULL),
('kasek',1,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_3` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values 
('admin','/site/signup/*'),
('admin','admin'),
('guru','create-formulir'),
('kasek','create-formulir'),
('kasek','fmaster-kasek');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_rule` */

insert  into `auth_rule`(`name`,`data`,`created_at`,`updated_at`) values 
('create-formulir',NULL,NULL,NULL);

/*Table structure for table `formulir` */

DROP TABLE IF EXISTS `formulir`;

CREATE TABLE `formulir` (
  `IdFormulir` int(11) NOT NULL AUTO_INCREMENT,
  `Kuantitas` int(11) NOT NULL,
  `Output` varchar(200) NOT NULL,
  `Mutu` int(11) NOT NULL,
  `Waktu` float NOT NULL,
  `Biaya` float NOT NULL,
  `AK` float NOT NULL,
  `IdUnsur` int(11) NOT NULL,
  `idFormulirMaster` int(11) DEFAULT NULL,
  `jenisForm` enum('FG','FK') DEFAULT NULL,
  PRIMARY KEY (`IdFormulir`),
  KEY `IdUnsur` (`IdUnsur`),
  KEY `idFormulirMaster` (`idFormulirMaster`),
  CONSTRAINT `formulir_ibfk_2` FOREIGN KEY (`IdUnsur`) REFERENCES `unsur` (`IdUnsur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `formulir_ibfk_3` FOREIGN KEY (`idFormulirMaster`) REFERENCES `formulir_master` (`idFormulirMaster`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=latin1;

/*Data for the table `formulir` */

insert  into `formulir`(`IdFormulir`,`Kuantitas`,`Output`,`Mutu`,`Waktu`,`Biaya`,`AK`,`IdUnsur`,`idFormulirMaster`,`jenisForm`) values 
(195,4,'Sertifikat',3,2,0,40,108,19,'FG'),
(196,3,'Laporan',100,3,0,10.5,95,19,'FG'),
(197,2,'Sertifikat',100,2,0,0.21,96,19,'FG'),
(198,7,'Laporan',100,12,0,29.75,95,22,'FG'),
(199,3,'Laporan',100,12,0,1.49,96,22,'FG'),
(200,1,'Laporan',100,12,0,1,112,22,'FG'),
(201,1,'Laporan',99,12,0,4,110,22,'FG'),
(202,1,'Sertifikat',100,12,0,0.75,113,22,'FG'),
(203,1,'Sertifikat',100,12,0,1,114,22,'FG');

/*Table structure for table `formulir_master` */

DROP TABLE IF EXISTS `formulir_master`;

CREATE TABLE `formulir_master` (
  `idFormulirMaster` int(11) NOT NULL AUTO_INCREMENT,
  `tanggalBuat` date DEFAULT NULL,
  `tahun` varchar(20) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `rataAK` float NOT NULL,
  `idKriteria` int(11) NOT NULL,
  `rataCapaian` float DEFAULT NULL,
  PRIMARY KEY (`idFormulirMaster`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `formulir_master_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `formulir_master` */

insert  into `formulir_master`(`idFormulirMaster`,`tanggalBuat`,`tahun`,`idUser`,`rataAK`,`idKriteria`,`rataCapaian`) values 
(19,'2017-08-24','2017',74,50.71,2,NULL),
(20,NULL,'',75,0,2,NULL),
(21,'2017-08-24','2017',75,0,2,NULL),
(22,'2017-11-08','2017',69,37.99,2,NULL);

/*Table structure for table `formulir_nilai` */

DROP TABLE IF EXISTS `formulir_nilai`;

CREATE TABLE `formulir_nilai` (
  `idFormulirFg` int(11) NOT NULL AUTO_INCREMENT,
  `idFormulir` int(11) DEFAULT NULL,
  `penghitungan` float DEFAULT NULL,
  `nilaiCapaian` float DEFAULT NULL,
  PRIMARY KEY (`idFormulirFg`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `formulir_nilai` */

insert  into `formulir_nilai`(`idFormulirFg`,`idFormulir`,`penghitungan`,`nilaiCapaian`) values 
(1,141,NULL,NULL),
(2,141,NULL,NULL),
(3,141,NULL,NULL),
(4,141,NULL,NULL),
(5,141,NULL,NULL),
(6,141,NULL,NULL),
(7,142,NULL,NULL),
(8,144,NULL,NULL),
(9,142,NULL,NULL),
(10,163,NULL,NULL),
(11,164,NULL,NULL),
(12,174,NULL,NULL),
(13,175,NULL,NULL),
(14,176,NULL,NULL),
(15,176,NULL,NULL),
(16,177,NULL,NULL),
(17,178,NULL,NULL),
(18,179,NULL,NULL),
(19,188,NULL,NULL),
(20,188,NULL,NULL),
(21,189,NULL,NULL),
(22,190,NULL,NULL);

/*Table structure for table `golongan` */

DROP TABLE IF EXISTS `golongan`;

CREATE TABLE `golongan` (
  `idGolongan` int(11) NOT NULL AUTO_INCREMENT,
  `KodeGolongan` varchar(50) NOT NULL,
  `NamaGolongan` varchar(200) NOT NULL,
  PRIMARY KEY (`idGolongan`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `golongan` */

insert  into `golongan`(`idGolongan`,`KodeGolongan`,`NamaGolongan`) values 
(9,'III/A','Penata Muda'),
(10,'III/B','Penata Muda Tingkat I'),
(11,'III/C','Penata'),
(12,'III/D','Penata Tingkat I'),
(13,'IV/A','Pembina'),
(14,'IV/B','Pembina Tingkat I'),
(15,'IV/C','Pembina Utama Muda'),
(16,'IV/D','Pembina Utama Madya'),
(17,'IV/E','Pembina Utama');

/*Table structure for table `indikator` */

DROP TABLE IF EXISTS `indikator`;

CREATE TABLE `indikator` (
  `idIndikator` int(11) NOT NULL AUTO_INCREMENT,
  `namaIndikator` text,
  `idAspek` int(11) DEFAULT NULL,
  PRIMARY KEY (`idIndikator`),
  KEY `idAspek` (`idAspek`),
  CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`idAspek`) REFERENCES `aspek` (`idAspek`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `indikator` */

insert  into `indikator`(`idIndikator`,`namaIndikator`,`idAspek`) values 
(1,'Guru bertingkah laku sopan dan ramah terhadap semua peserta didik, orang tua dan teman sejawat',1),
(2,'Guru ramah dalam berkomunikasi terhadap semua peserta didik, orang tua, dan teman sejawat',1),
(3,'Guru berpenampilan rapi dan sopan',1),
(4,'Guru melaksanakan pembelajaran sesuai dengan kebutauhan peserta didik\r\n',1),
(5,'Guru memberikan kesempatan kepada peserta didik untuk berpartisipasi dalam proses pembelajaran',1),
(6,'Guru memperlakukan semua peserta didik secara adil, memberikan perhatian dan bantuan sesuai kebutuhan masing-masing tanpa memperdulikaan faktor personal',1),
(7,'Guru mau membagi pengalamannya dengan koleganya, termasuk mengundang mereka untuk mengobservasi cara mengajar dan memberikan masukan',1),
(8,' Guru menyediakan layanan informasi terkait dengan perkembangan prestasi dan potensi peserta didik kepada orang tua',1),
(9,'Guru berprilaku baik dalam menjalankan profesinay sesuai dengan kode etik sebagai guru',2),
(10,'Guru memanfaatkan waktu luang secara produktif terkait dengan tugasny',2),
(11,'Guru memberikan kontribusi positif terhadap peningkatan prestasi belajar peserta didik',2),
(12,'Guru memberikan kontribusi positif terhadap pengembangan sekolah',2),
(13,'Guru bangga terhadap profesinya',2),
(14,'Guru konsisten antara perkataan dan perbuatan',2),
(15,'Guru bersungguh-sungguh dalam melaksanakan tugas jabatannya',2),
(16,'Guru bersedia menanggung segala resiko dari pekerjaann yang dilakukannya',2),
(17,'Guru bersedia memperbaiki kesalahan',2),
(18,'Guru memberikan teladan dalam bersikap, berprilaku, dan bertutur akata',2),
(19,'Guru melaksanakan prinsi-prinsip Pancasila sebagai dasar ideologi',3),
(20,'Guru menjunjung tinggi persatuan dan kesatuan NKRI',3),
(21,'Guru menunjukkan apresiasi terhadap keberagaman budaya, suku, ras dan agama',3),
(22,'Guru mengutamakan kepentingan tugas jabatan diatas kepentingan pribadi dan/golongan',3),
(23,'Guru bekerja keras untuk meningkatkan prestasi belajar peserta didik',3),
(24,'Guru bekerja keras tanpa diminta untuk kemajuan satuan pendidikan',3),
(25,'Guru melakukan tugas jabatannya dan menerima tanggungjawab lebih dari yang seharusnya diemban',3),
(26,'Guru melaksanakan tugas jabatan (menyusun, merencanakan, melaksanakan pembelajaran, menilai, dan membuat laporan) tepat waktu',4),
(27,'Guru melaksanakan proses pembelajaran tepat waktu sesuai dengan beben kerjanya',4),
(28,'Guru meminta izin dan memberi tahu lebih awal, dengan memberikan alasan dan bukti yang sah jika tidak dapat melaksanakan tugas jabatannya',4),
(29,'Guru menyelesaikan tugas lain diluar pelaksanaan pembelajaran dengan tepat waktu',4),
(30,'Guru memiliki rasa kebermilikan dan memelihara sarana dan prasarana sekolah untuk kepentingan pelaksanaan tugas',4),
(31,'Guru mengembangkan kerjasama dan membina kebersamaan dengan teman sejawat',5),
(32,'Guru menghormati dan menghargai teman sejawat sesuai dengan kondisi dan keberadaan masing-masing',5),
(33,'Guru mendiskusikan data dan informasi tentang kemajuan, kesulitand an potensi peserta didik baik dalam pertemuan formal maupun tidak formal kepada teman sejawat ',5),
(34,'Guru berkomunikasi dengan masyarakat sekitar untuk kemajuan sekolah, dna berperan serta secara aktif dalam kegiatan sosial dimasyarakat',5),
(35,'Guru bersedia menerima masukan dari peserta didik, orang tua, teman sejawat, untuk kemajuan prestasi belajar peserta didik, dan perkembangan sekolah',5),
(36,'Guru menerima dan melaksanakan keputusan yang telah disepakati terkait dengan bidang tugas jabatan',5);

/*Table structure for table `indikator_nilai` */

DROP TABLE IF EXISTS `indikator_nilai`;

CREATE TABLE `indikator_nilai` (
  `idIndikatorNilai` int(11) NOT NULL AUTO_INCREMENT,
  `idFormulirMaster` int(11) DEFAULT NULL,
  `idIndikator` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  PRIMARY KEY (`idIndikatorNilai`),
  KEY `idFormulirMaster` (`idFormulirMaster`),
  KEY `idIndikator` (`idIndikator`),
  CONSTRAINT `indikator_nilai_ibfk_1` FOREIGN KEY (`idFormulirMaster`) REFERENCES `formulir_master` (`idFormulirMaster`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `indikator_nilai_ibfk_2` FOREIGN KEY (`idIndikator`) REFERENCES `indikator` (`idIndikator`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `indikator_nilai` */

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `IdJabatan` int(11) NOT NULL AUTO_INCREMENT,
  `NamaJabatan` varchar(200) NOT NULL,
  PRIMARY KEY (`IdJabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `jabatan` */

insert  into `jabatan`(`IdJabatan`,`NamaJabatan`) values 
(1,'Kepala Sekolah'),
(2,'Guru Mapel');

/*Table structure for table `jenisformulir` */

DROP TABLE IF EXISTS `jenisformulir`;

CREATE TABLE `jenisformulir` (
  `IdJenis` int(11) NOT NULL,
  `NamaJenis` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jenisformulir` */

/*Table structure for table `jenisunsur` */

DROP TABLE IF EXISTS `jenisunsur`;

CREATE TABLE `jenisunsur` (
  `IdJenisUnsur` int(11) NOT NULL AUTO_INCREMENT,
  `NamaUnsur` varchar(200) NOT NULL,
  PRIMARY KEY (`IdJenisUnsur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `jenisunsur` */

insert  into `jenisunsur`(`IdJenisUnsur`,`NamaUnsur`) values 
(1,'Utama'),
(2,'Penunjang');

/*Table structure for table `kredit` */

DROP TABLE IF EXISTS `kredit`;

CREATE TABLE `kredit` (
  `No` int(10) NOT NULL AUTO_INCREMENT,
  `Kode` varchar(10) NOT NULL,
  `Kegiatan` mediumtext NOT NULL,
  `Keterangan` varchar(30) NOT NULL,
  `NIlai` float NOT NULL,
  PRIMARY KEY (`No`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `kredit` */

insert  into `kredit`(`No`,`Kode`,`Kegiatan`,`Keterangan`,`NIlai`) values 
(1,'01','Doktor (S-3)','200',0),
(9,'02','Magister  (S-2)','150',0),
(25,'04','Pelatihan prajabatan fungsional bagi Guru Calon Pegawai\r\nNegeri Sipil / program induksi','3',0),
(33,'05','Merencanakan dan Melaksanakan Pembelajaran Mengevaluasi dan Menilai Hasil Pembelajaran Menganalisis ','Paket',0),
(41,'06','Merencanakan dan Melaksanakan Pembimbingan Mengevaluasi dan Menilai Hasil Pembimbingan Menganalisis ','Paket',0),
(49,'08','Menjadi Wakil Kepala Sekolah/Madrasah per tahun','Paket',0),
(57,'10','Menjadi kepala perpustakaan','Paket',0),
(65,'11','Menjadi kepala laboratorium, bengkel, unit produksi atau yang\r\nsejenisnya','Paket',0),
(73,'12','Menjadi pembimbing khusus pada satuan pendidikan yang\r\nmenyelenggarakan pendidikan inklusi, pendidik','Paket',0),
(81,'13','Menjadi wali kelas','Paket',0),
(89,'14','Menyusun kurikulum pada satuan pendidikannya','Paket',0),
(97,'15','Menjadi pengawas penilaian dan evaluasi terhadap  proses\r\ndan hasil belajar.','Paket',0),
(105,'15A','Membimbing guru pemula dalam program induksi','Paket',0),
(113,'16','Membimbing siswa dalam kegiatan ekstrakurikuler\r\n','Paket',0),
(121,'17','Menjadi pembimbing pada penyusunan publikasi ilmiah dan\r\nkarya inovatif','Paket',0),
(129,'18','Melaksanakan pembimbingan pada kelas yang menjadi\ntanggungjawabnya (khusus Guru Kelas)','Paket',0),
(137,'22','Lamanya antara 181 s.d  480 jam','Paket',0),
(145,'23','Lamanya antara 81 s.d  180 jam','Paket',0),
(153,'24','Lamanya antara 30 s.d  80 jam','Paket',0);

/*Table structure for table `kriteria` */

DROP TABLE IF EXISTS `kriteria`;

CREATE TABLE `kriteria` (
  `IdKriteria` int(11) NOT NULL AUTO_INCREMENT,
  `NamaKriteria` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`IdKriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kriteria` */

insert  into `kriteria`(`IdKriteria`,`NamaKriteria`) values 
(1,'Amat Baik'),
(2,'Baik'),
(3,'Cukup'),
(4,'Sedang'),
(5,'Kurang');

/*Table structure for table `session` */

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `session` */

/*Table structure for table `unsur` */

DROP TABLE IF EXISTS `unsur`;

CREATE TABLE `unsur` (
  `IdUnsur` int(11) NOT NULL AUTO_INCREMENT,
  `NamaUnsur` text NOT NULL,
  `Nilai` double NOT NULL,
  `IdJenisUnsur` int(11) NOT NULL,
  `Keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdUnsur`),
  KEY `IdJenisUnsur` (`IdJenisUnsur`),
  CONSTRAINT `fk_jenis_unsur` FOREIGN KEY (`IdJenisUnsur`) REFERENCES `jenisunsur` (`IdJenisUnsur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

/*Data for the table `unsur` */

insert  into `unsur`(`IdUnsur`,`NamaUnsur`,`Nilai`,`IdJenisUnsur`,`Keterangan`) values 
(95,'Merencanakan dan melaksanakan pembelajaran,mengevaluasi dan menilai hasil pembelajaran,menganalisis hasil pembelajaran, melaksanakan tindak lanjut hasil',0,1,'Paket'),
(96,'Wali Kelas (Daftar kelas, Leger Tengah Semester, Leger Semester)',0,1,'Paket'),
(97,'Menjadi Kepala Sekolah/Madrasah per tahun',0,1,'Paket'),
(98,'Menjadi Wakil Kepala Sekolah/Madrasah per tahun',0,1,'Paket'),
(99,'Menjadi ketua program keahlian/program studi atau yang sejenisnya',0,1,'Paket'),
(100,'Menjadi kepala perpustakaan',0,1,'Paket'),
(101,'Menjadi kepala laboratorium, bengkel, unit produksi atau yang sejenisnya',0,1,'Paket'),
(102,'Membimbing guru pemula dalam program induksi',0,1,'Paket'),
(103,'Menjadi pembimbing khusus pada satuan pendidikan yang menyelenggarakan pendidikan inklusi, pendidikan terpadu atau yang sejenisnya.',0,1,'Paket'),
(105,'Menyusun kurikulum pada satuan pendidikannya',0,1,'Paket'),
(106,'Menjadi pengawas penilaian dan evaluasi terhadap proses\r\ndan hasil belajar.\r\n',0,1,'Paket'),
(108,'Membimbing siswa dalam kegiatan ekstrakurikuler',40,2,'Non Paket'),
(110,'Melaksanakan Publikasi Ilmiah (Membuat karya tulis berupa Laporan Hasil Penelitian pada bidang pendidikan di sekolahnya, diseminarkan disekolahnya, disimpan diperpustakaan)',4,1,'Paket'),
(111,'Wali Kelas (Daftar kelas, Leger Tengah Semester, Leger Semester)',0,1,'Paket'),
(112,'Mengikuti Diklat Fungsional (30-80 jam)',1,1,'Paket'),
(113,'Anggota organisasi profesi ( PGRI )',0.75,2,'Non Paket'),
(114,'Memperoleh Penghargaan/Tanda Jasa Satya Lencana Karya Satya (10 Th)',1,2,'Non Paket');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `NIP` int(11) DEFAULT NULL,
  `Nama` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Agama` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Alamat` text COLLATE utf8_unicode_ci,
  `UnitKerja` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idGolongan` int(11) DEFAULT NULL,
  `IdJabatan` int(11) DEFAULT NULL,
  `PejabatPenilai` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `IdJabatan` (`IdJabatan`),
  KEY `idGolongan` (`idGolongan`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idGolongan`) REFERENCES `golongan` (`idGolongan`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`IdJabatan`) REFERENCES `jabatan` (`IdJabatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`,`NIP`,`Nama`,`Agama`,`Telp`,`Alamat`,`UnitKerja`,`idGolongan`,`IdJabatan`,`PejabatPenilai`) values 
(69,'nuril','sG2sqnJuitd3iPqlgaLW3tBYjFU_Lr56','$2y$13$ZSWxgxb5Ln39dpbh5G0Yn.5dN/622S933H40JkMfZ1xQepRe1nfeK',NULL,'nuril@mail.com',10,1496146723,1496146723,8423,'Nuril','Islam','081231228888',NULL,'SMPN 8 TANJUNGPINANG',13,2,0),
(70,'erny','aq17WWkpm4KjGKgfwKFBMa2UHJiQs3pR','$2y$13$uDFixWYSXO8O3qjj9Kw9FuVC8eTZMwwUfIl/lekjgx0rKhVuDv5T6',NULL,'erny@gmail.com',10,1497148653,1497148653,19671110,'Erny Yusnita','Islam','081204337777',NULL,'SMPN 8 TANJUNGPINANG',13,1,1),
(71,'agus','83RpwdjP3Ev5rRFY-s7uS2GvbwJDedut','$2y$13$EooR.egAxbNgL2MR8kJd9eCKa01zvEEWQ6VPMliXFsojEX5.O5bf2',NULL,'agus@mail.com',10,1497150122,1497150122,4323229,'Agus Setiawan','Islam','08174222867',NULL,'SMPN 8 TANJUNGPINANG',13,2,0),
(72,'azis','zvVqe4tz8OEVUndqiN-zxwpL61DhoaAV','$2y$13$x.AhOrp1oQjDeW9qPiKHeugKJORB1EXMA0aLZELe89mW4ppI5GkZC',NULL,'azis@mail.com',10,1497188573,1497188573,13242,'azis','Islam','082323232222',NULL,'SMPN 8 TANJUNGPINANG',13,2,0),
(74,'karno','JU2jrAqKchAqzsjO8tXezVdEyvM2DvYT','$2y$13$BTvCQvFss/dJmXT.26JpFeG35gTdrbpeUGu.vzJSgzVsypvy3UQcW',NULL,'karno@gmail.com',10,1503559107,1503559107,1212428,'karno','Islam','6565465',NULL,'SMPN 8 TANJUNGPINANG',9,2,0),
(75,'joni','YbmU5ojpaZ2byIa94AVrF3GrJChV1OPn','$2y$13$8LYb6TPzFHEte1bRJeHIcOCSRI5cPKowc2MyODiur4fln546rITry',NULL,'joni@mail.com',10,1503561065,1503561065,42343,'Joni','Islam','0831232122',NULL,'SMKN 4 TPI',17,2,0),
(76,'admin','sG2sqnJuitd3iPqlgaLW3tBYjFU_Lr56','$2y$13$ZSWxgxb5Ln39dpbh5G0Yn.5dN/622S933H40JkMfZ1xQepRe1nfeK',NULL,'',10,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),
(77,'heri','R9yTWkqFbxE3Jpq2AfcS0pZxIx89NxW_','$2y$13$62HLDl6/RT4yJu3Cm0BBVu0MvGO35e2fhOxmELdwUIrZZ7IywTZyi',NULL,'heru@mail.com',10,1511174326,1511174326,2147483647,'Heri Sapitri','Islam','082312222',NULL,'TPI',12,2,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
