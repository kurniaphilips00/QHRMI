-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.72-community - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for quantum
CREATE DATABASE IF NOT EXISTS `quantum` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `quantum`;

-- Dumping structure for table quantum.auth_activation_attempts
CREATE TABLE IF NOT EXISTS `auth_activation_attempts` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.auth_groups
CREATE TABLE IF NOT EXISTS `auth_groups` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.auth_groups_permissions
CREATE TABLE IF NOT EXISTS `auth_groups_permissions` (
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `permission_id` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  KEY `group_id_permission_id` (`group_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.auth_groups_users
CREATE TABLE IF NOT EXISTS `auth_groups_users` (
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.auth_permissions
CREATE TABLE IF NOT EXISTS `auth_permissions` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.auth_reset_attempts
CREATE TABLE IF NOT EXISTS `auth_reset_attempts` (
  `id` int(11) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.auth_tokens
CREATE TABLE IF NOT EXISTS `auth_tokens` (
  `id` int(11) unsigned NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.auth_users_permissions
CREATE TABLE IF NOT EXISTS `auth_users_permissions` (
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `permission_id` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_bahasa
CREATE TABLE IF NOT EXISTS `tb_bahasa` (
  `id_bahasa` int(11) NOT NULL AUTO_INCREMENT,
  `bahasa` varchar(25) NOT NULL,
  `nilai` varchar(30) DEFAULT NULL,
  `kode_ta` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL DEFAULT '',
  KEY `Index 1` (`id_bahasa`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_dokumen
CREATE TABLE IF NOT EXISTS `tb_dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namafile` varchar(150) NOT NULL,
  `dokumen` varchar(150) NOT NULL DEFAULT '0',
  `nomor` varchar(50) DEFAULT '0',
  `notaris` varchar(150) DEFAULT '0',
  `tanggal` date DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Akta Perusahaan';

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_exp
CREATE TABLE IF NOT EXISTS `tb_exp` (
  `id_exp` int(11) NOT NULL AUTO_INCREMENT,
  `kode_ta` int(11) NOT NULL,
  `nama_ta` varchar(200) DEFAULT NULL COMMENT 'nama tenaga ahli',
  `kegiatan` varchar(200) DEFAULT NULL COMMENT 'nama kegiatan',
  `lokasi` varchar(255) DEFAULT NULL COMMENT 'lokasi kegiatan',
  `pengguna` varchar(255) DEFAULT NULL COMMENT 'pengguna jasa',
  `pers` varchar(50) DEFAULT NULL COMMENT 'nama perusahaan',
  `referensi` varchar(255) DEFAULT NULL COMMENT 'nomor surat referensi',
  `statuse` varchar(25) DEFAULT NULL COMMENT 'status kepegawaian pada perusahaan',
  `tahun` int(10) DEFAULT NULL COMMENT 'tahun penugasan',
  `posisitugas` varchar(125) DEFAULT NULL COMMENT 'posisi penugasan',
  `uraian` longtext,
  `mulai` date DEFAULT NULL COMMENT 'waktu pelaksanaan',
  `selesai` date DEFAULT NULL,
  `jml_bln` int(11) DEFAULT NULL,
  `inter` varchar(150) DEFAULT NULL,
  KEY `id_exp` (`id_exp`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Tabel pengalaman\r\n';

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_ijin
CREATE TABLE IF NOT EXISTS `tb_ijin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namafile` varchar(150) NOT NULL DEFAULT '',
  `nomor` varchar(150) NOT NULL DEFAULT '',
  `jenis` varchar(150) NOT NULL DEFAULT '',
  `instansi` varchar(150) NOT NULL DEFAULT '',
  `kualifikasi` varchar(50) NOT NULL DEFAULT '',
  `tglkadaluarsa` date DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_jurusan
CREATE TABLE IF NOT EXISTS `tb_jurusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jurusan` varchar(100) NOT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_kategori
CREATE TABLE IF NOT EXISTS `tb_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) NOT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_lampiran
CREATE TABLE IF NOT EXISTS `tb_lampiran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namafile` varchar(250) NOT NULL,
  `tipe` varchar(50) NOT NULL DEFAULT '',
  `ukuran` int(11) unsigned DEFAULT NULL,
  `lampiran` varchar(150) DEFAULT NULL,
  `path` varchar(150) DEFAULT NULL,
  `kode_ta` int(11) DEFAULT '0',
  `nama_ta` varchar(150) DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Lampiran file-file image tenga ahli';

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_pajak
CREATE TABLE IF NOT EXISTS `tb_pajak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namafile` varchar(150) NOT NULL,
  `jenis` varchar(50) NOT NULL DEFAULT '',
  `nomor` varchar(150) NOT NULL DEFAULT '',
  `tglterbit` date DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_posisi
CREATE TABLE IF NOT EXISTS `tb_posisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posisi` varchar(100) NOT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_proyek
CREATE TABLE IF NOT EXISTS `tb_proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instansi` varchar(55) NOT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `ruang_lingkup` varchar(255) DEFAULT NULL,
  `lokasi` varchar(25) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nokontrak` varchar(100) DEFAULT NULL,
  `mulai` date DEFAULT NULL,
  `selesai` date DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_proyek_ta
CREATE TABLE IF NOT EXISTS `tb_proyek_ta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyek` int(11) DEFAULT NULL,
  `nama_proyek` varchar(250) DEFAULT NULL,
  `id_TA` int(11) DEFAULT NULL,
  `nama_TA` varchar(250) DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_sertifikat
CREATE TABLE IF NOT EXISTS `tb_sertifikat` (
  `id_sert` int(11) NOT NULL AUTO_INCREMENT,
  `sertifikat` varchar(200) NOT NULL,
  `kode_ta` int(11) NOT NULL,
  `nama_ta` varchar(150) NOT NULL DEFAULT '',
  `tgl_kadaluarsa` date DEFAULT NULL,
  KEY `Index 1` (`id_sert`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.tb_ta
CREATE TABLE IF NOT EXISTS `tb_ta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(65) NOT NULL,
  `alamat` varchar(85) DEFAULT '',
  `kota` varchar(30) DEFAULT '',
  `tgl` date DEFAULT NULL,
  `usia` int(11) unsigned DEFAULT NULL,
  `no_ktp` varchar(17) DEFAULT '',
  `no_npwp` varchar(22) DEFAULT '',
  `no_telp` varchar(26) DEFAULT '',
  `no_hp` varchar(72) DEFAULT '',
  `email` varchar(65) DEFAULT '',
  `posisi` varchar(25) DEFAULT '',
  `perusahaan` varchar(55) DEFAULT '',
  `kategori` varchar(27) DEFAULT '',
  `ijazahS1` varchar(100) DEFAULT '',
  `s1_univ` varchar(255) DEFAULT '',
  `s1_thn` varchar(4) DEFAULT '',
  `ijazahS2` varchar(100) DEFAULT '',
  `s2_univ` varchar(255) DEFAULT '',
  `s2_thn` varchar(255) DEFAULT '',
  `ijazahS3` varchar(100) DEFAULT '',
  `s3_univ` varchar(255) DEFAULT '',
  `s3_thn` varchar(255) DEFAULT '',
  `sipp` varchar(35) DEFAULT '',
  `sipp_ed` date DEFAULT NULL,
  `str` varchar(255) DEFAULT '',
  `str_ed` date DEFAULT NULL,
  `kta` varchar(200) DEFAULT '',
  `kta_ed` date DEFAULT NULL,
  `asosiasi` varchar(255) DEFAULT '',
  `ref` varchar(255) DEFAULT '',
  `status` varchar(255) DEFAULT '',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table quantum.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
