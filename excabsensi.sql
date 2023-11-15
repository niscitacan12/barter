/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - excabsensi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`excabsensi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `excabsensi`;

/*Table structure for table `absensi` */

DROP TABLE IF EXISTS `absensi`;

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tanggal_absen` date NOT NULL,
  `keterangan_izin` varchar(255) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `status` varchar(10) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  PRIMARY KEY (`id_absensi`),
  KEY `fk_user_id` (`id_user`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `absensi` */

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_depan` varchar(255) NOT NULL,
  `nama_belakang` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `fk_superadmin_id` (`id_superadmin`),
  CONSTRAINT `fk_superadmin_id` FOREIGN KEY (`id_superadmin`) REFERENCES `superadmin` (`id_superadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`email`,`username`,`nama_depan`,`nama_belakang`,`password`,`image`,`role`,`id_superadmin`) values 
(1,'fajar@gmail.com','fajar','fajar','cahyo nugroho','25d55ad283aa400af464c76d713c07ad','User.png','admin',1),
(2,'adhi@gmail.com','adhin','Adhi','Nugroho','25d55ad283aa400af464c76d713c07ad','User.png','admin',1),
(3,'anin@gmail.com','anindya','anindya','putri','25d55ad283aa400af464c76d713c07ad','User.png','admin',1),
(5,'ave@gmail.com','ave','ave','aiuiy','25d55ad283aa400af464c76d713c07ad','User.png','admin',1),
(6,'admin@gmail.com','admin','haii','admin','25d55ad283aa400af464c76d713c07ad','User.png','admin',1);

/*Table structure for table `cuti` */

DROP TABLE IF EXISTS `cuti`;

CREATE TABLE `cuti` (
  `id_cuti` int(11) NOT NULL AUTO_INCREMENT,
  `awal_cuti` date NOT NULL,
  `akhir_cuti` date NOT NULL,
  `masuk_kerja` date NOT NULL,
  `keperluan_cuti` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_cuti`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `cuti_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `cuti` */

insert  into `cuti`(`id_cuti`,`awal_cuti`,`akhir_cuti`,`masuk_kerja`,`keperluan_cuti`,`status`,`id_user`) values 
(3,'2023-11-30','2023-12-15','2023-12-16','menikah','disetujui',2);

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) NOT NULL,
  `id_admin` int(11) NOT NULL,
  PRIMARY KEY (`id_jabatan`),
  KEY `id_admin` (`id_admin`),
  CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id_jabatan`,`nama_jabatan`,`id_admin`) values 
(1,'Mahasiswa',2),
(5,'Mahasiswa',2);

/*Table structure for table `lokasi` */

DROP TABLE IF EXISTS `lokasi`;

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_lokasi`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `lokasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `lokasi` */

/*Table structure for table `organisasi` */

DROP TABLE IF EXISTS `organisasi`;

CREATE TABLE `organisasi` (
  `id_organisasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_organisasi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `email_organisasi` varchar(255) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  PRIMARY KEY (`id_organisasi`),
  KEY `fk_admin_id` (`id_admin`),
  CONSTRAINT `fk_admin_id` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `organisasi` */

insert  into `organisasi`(`id_organisasi`,`nama_organisasi`,`alamat`,`nomor_telepon`,`email_organisasi`,`kecamatan`,`kabupaten`,`provinsi`,`id_admin`,`id_superadmin`) values 
(7,'SMK Bina Nusantara','Batursari','08072754980','binus@gmail.com','Mranggen','Demak','Jawa',1,0),
(8,'MTs H M Subandi ','Gandekan','09765544546','subandi@gmail.com','Bawen','Semarang','Jawa',3,0),
(9,'Nesaba','dsaf','123908965','a@gmail.com','dfdfs','fvfvg','fdsaf',0,0),
(12,'SMP N 1 Bawen','Merakmati','098765','nesaba@gmail.com','Bawen','Semarang','Jawa Tengah',2,0),
(13,'SMK','Ambarawa','123','aveganteng@gmail.com','Ambawarawa','Demak','Kalimantan Tengah',5,0);

/*Table structure for table `shift` */

DROP TABLE IF EXISTS `shift`;

CREATE TABLE `shift` (
  `id_shift` int(11) NOT NULL AUTO_INCREMENT,
  `nama_shift` varchar(255) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `id_admin` int(11) NOT NULL,
  PRIMARY KEY (`id_shift`),
  KEY `id_admin` (`id_admin`),
  CONSTRAINT `shift_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `shift` */

insert  into `shift`(`id_shift`,`nama_shift`,`jam_masuk`,`jam_pulang`,`id_admin`) values 
(2,'Normal','07:00:00','16:00:00',2);

/*Table structure for table `superadmin` */

DROP TABLE IF EXISTS `superadmin`;

CREATE TABLE `superadmin` (
  `id_superadmin` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_depan` varchar(255) NOT NULL,
  `nama_belakang` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id_superadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `superadmin` */

insert  into `superadmin`(`id_superadmin`,`email`,`username`,`nama_depan`,`nama_belakang`,`password`,`image`,`role`) values 
(1,'dewi@gmail.com','dewi','dewi','pulung','25d55ad283aa400af464c76d713c07ad','User.png','superadmin'),
(3,'superadmin@gmail.com','developer','super','admin','25d55ad283aa400af464c76d713c07ad','User.png','superadmin');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_depan` varchar(255) NOT NULL,
  `nama_belakang` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_organisasi` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_shift` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_admin` (`id_admin`),
  KEY `id_organisasi` (`id_organisasi`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `id_shift` (`id_shift`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_organisasi`) REFERENCES `organisasi` (`id_organisasi`),
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  CONSTRAINT `user_ibfk_4` FOREIGN KEY (`id_shift`) REFERENCES `shift` (`id_shift`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id_user`,`email`,`username`,`nama_depan`,`nama_belakang`,`password`,`image`,`role`,`id_admin`,`id_organisasi`,`id_jabatan`,`id_shift`) values 
(2,'user@gmail.com','username','depan','last','25d55ad283aa400af464c76d713c07ad','User.png','user',2,12,1,2),
(34,'coba@gmail.com','coba','coba','aja','25d55ad283aa400af464c76d713c07ad','User.png','user',2,12,1,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
