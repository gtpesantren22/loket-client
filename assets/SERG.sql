-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_loket.antrian
CREATE TABLE IF NOT EXISTS `antrian` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nomor` int unsigned NOT NULL DEFAULT '0',
  `loket` int unsigned NOT NULL DEFAULT '0',
  `tanggal` date DEFAULT '1970-01-01',
  `waktu` time DEFAULT '00:00:00',
  `ket` varchar(15) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `nama` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pelayan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_loket.antrian: ~21 rows (approximately)
INSERT INTO `antrian` (`id`, `nomor`, `loket`, `tanggal`, `waktu`, `ket`, `nama`, `jenis`, `pelayan`) VALUES
	(1, 1, 0, '2025-07-03', '15:03:23', 'menunggu', 'MUHAMMAD AZKA MAULAL KIROM', 'A', NULL),
	(2, 2, 0, '2025-07-03', '15:03:44', 'menunggu', 'FRISMA OKTAVIAPUTRIVHARISY', 'B', NULL),
	(3, 3, 0, '2025-07-03', '15:07:15', 'menunggu', 'SITI AISYAH', 'A', NULL),
	(4, 4, 0, '2025-07-03', '23:55:36', 'menunggu', 'YUSRINA ZAHARANI MALIKA PUTRI', 'A', NULL),
	(5, 1, 1, '2025-07-04', '00:01:24', 'selesai', 'MUHAMMAD SYAIHU FATHURRAHMAN', 'A', '4dd95492-22d0-49eb-8583-0cc2b3633309'),
	(6, 2, 1, '2025-07-04', '00:01:38', 'selesai', 'MOH. AIMAN FAHMI ZAIN', 'A', '4dd95492-22d0-49eb-8583-0cc2b3633309'),
	(7, 3, 2, '2025-07-04', '00:01:53', 'selesai', 'ACH. SIBAWEH FAKHRAUL AL ROSYID', 'A', '8009c420-f820-44d5-86f9-a3bdfba29b61'),
	(8, 4, 3, '2025-07-04', '00:02:08', 'selesai', 'MUHAMMAD IBNU FATEH AR RAYYAN', 'B', '340a9374-8447-4bf4-b11e-5f210b4bc7ab'),
	(10, 5, 1, '2025-07-04', '13:12:46', 'selesai', 'DAFI FIRMANSYAH', 'A', '4dd95492-22d0-49eb-8583-0cc2b3633309'),
	(11, 6, 3, '2025-07-04', '17:02:55', 'selesai', 'SINTIA BELA', 'A', '340a9374-8447-4bf4-b11e-5f210b4bc7ab'),
	(12, 7, 3, '2025-07-04', '17:03:17', 'proses', 'MUHAMMAD SYAIHU FATHURRAHMAN', 'A', '340a9374-8447-4bf4-b11e-5f210b4bc7ab'),
	(13, 8, 2, '2025-07-04', '17:03:47', 'selesai', 'MUHAMMAD HILMAN NAJAH MURTADHO', 'A', '8009c420-f820-44d5-86f9-a3bdfba29b61'),
	(14, 9, 2, '2025-07-04', '17:04:48', 'selesai', 'MUHAMMAD FARKHAN NUR RAMADHAN', 'A', '8009c420-f820-44d5-86f9-a3bdfba29b61'),
	(15, 10, 2, '2025-07-04', '17:05:15', 'selesai', 'YUSRINA ZAHARANI MALIKA PUTRI', 'A', '8009c420-f820-44d5-86f9-a3bdfba29b61'),
	(16, 11, 2, '2025-07-04', '17:06:18', 'proses', 'SALSABILA MIRA ZULKARNAEN', 'A', '8009c420-f820-44d5-86f9-a3bdfba29b61'),
	(17, 12, 1, '2025-07-04', '17:09:22', 'selesai', 'MOH. AIMAN FAHMI ZAIN', 'A', '4dd95492-22d0-49eb-8583-0cc2b3633309'),
	(18, 13, 1, '2025-07-04', '17:12:52', 'selesai', 'SYAQILA HUMAIRA AZZAHRA', 'A', '4dd95492-22d0-49eb-8583-0cc2b3633309'),
	(19, 14, 0, '2025-07-04', '17:18:19', 'menunggu', 'YUSRINA ZAHARANI MALIKA PUTRI', 'A', NULL),
	(20, 15, 0, '2025-07-04', '17:19:25', 'menunggu', 'ACH. SIBAWEH FAKHRAUL AL ROSYID', 'A', NULL),
	(21, 16, 0, '2025-07-04', '17:20:08', 'menunggu', 'MUHAMMED MUJAHID ASFA ALKHOIR', 'A', NULL),
	(23, 17, 0, '2025-07-04', '22:25:04', 'menunggu', 'Ahmad Karomat', 'A', NULL),
	(24, 1, 0, '2025-07-05', '04:59:45', 'menunggu', 'Ahmad Karomat', 'A', NULL);

-- Dumping structure for table db_loket.meja
CREATE TABLE IF NOT EXISTS `meja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomor` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_loket.meja: ~4 rows (approximately)
INSERT INTO `meja` (`id`, `nama`, `nomor`) VALUES
	(1, 'Meja 1', 1),
	(2, 'Meja 2', 2),
	(3, 'Meja 3', 3),
	(4, 'Meja 4', 4);

-- Dumping structure for table db_loket.petugas
CREATE TABLE IF NOT EXISTS `petugas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meja_id` int DEFAULT NULL,
  `user_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_loket.petugas: ~3 rows (approximately)
INSERT INTO `petugas` (`id`, `meja_id`, `user_id`) VALUES
	(1, 1, '4dd95492-22d0-49eb-8583-0cc2b3633309'),
	(2, 2, '8009c420-f820-44d5-86f9-a3bdfba29b61'),
	(3, 3, '');

-- Dumping structure for table db_loket.setting
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kunci` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_loket.setting: ~3 rows (approximately)
INSERT INTO `setting` (`id`, `kunci`, `isi`) VALUES
	(1, 'token', '1106|yz98FaFcBcei3bLYyrfOktR6YrrNDwLzlkAU2lKUd845ef80'),
	(2, 'apiKey', '1120|0IlUklO15xefAag4l98aGewsm0GxOhrwWM5KNMendEa48tbxzGpVOD228WUhSnzx'),
	(3, 'printer', 'POS-58 Printer');

-- Dumping structure for table db_loket.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `aktif` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_loket.user: ~4 rows (approximately)
INSERT INTO `user` (`user_id`, `nama`, `username`, `password`, `aktif`, `level`) VALUES
	('340a9374-8447-4bf4-b11e-5f210b4bc7ab', 'Ust Fauzi', 'meja3', '$2y$10$tafy9txmQMmAmea0flz2uOFgUJLgrCTctidKe24NTlTbQYzdsUOwe', 'Y', 'user'),
	('4dd95492-22d0-49eb-8583-0cc2b3633309', 'Ust Abdul Aziz Zain', 'meja1', '$2y$10$KJN2veT9vNCNZqmzmqPE6.7CHefj8xTpkv6s7nErohg038aYAJCQ.', 'Y', 'user'),
	('8009c420-f820-44d5-86f9-a3bdfba29b61', 'Ust Khofil', 'meja2', '$2y$10$hafO.HaCT8sDMYkraYQ7f.SJta2WAAnDMbXi3NbUE8TDRHCyugFS2', 'Y', 'user'),
	('a8314006-676d-4e97-a522-f1c81d788d5f', 'Admin', 'admin', '$2y$10$x4IfS0lKpqQKXB8MkTYx6.A0o3VjM.pPnpqNw220CsL24efz9RmmK', 'Y', 'admin');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
