-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: taster
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `file` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `size` varchar(20) NOT NULL,
  `type` varchar(200) NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mahasiswaNRP` varchar(10) NOT NULL,
  `tugasID` int NOT NULL,
  `path` varchar(200) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(15) NOT NULL,
  `nilai` int DEFAULT NULL,
  `saran` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` VALUES (18,'1 D4 ITA'),(19,'1 D4 ITB');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mata_kuliah`
--

DROP TABLE IF EXISTS `mata_kuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mata_kuliah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `dosenNIP` varchar(18) NOT NULL,
  `kelasID` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mata_kuliah`
--

LOCK TABLES `mata_kuliah` WRITE;
/*!40000 ALTER TABLE `mata_kuliah` DISABLE KEYS */;
INSERT INTO `mata_kuliah` VALUES (4,'Programan  Web','198609262015051001',5),(5,'Tes lagi','198609262015051001',5),(6,'Praktikum Algoritma dan Struktur Data','198609262015051001',1),(7,'Lagi dong','198609262015051001',1),(8,'ini untuk tes','198609262015051013',5),(9,'Ini tes lagi kan','198609262015051001',5),(10,'Arga tes dong','198609262015051001',5),(11,'Praktikum Algoritma dan Struktur Data','198609262015051001',9),(12,'Praktikum Pemrograman Web','198609262015051001',9),(13,'Praktikum Basis Data','198609262015051001',9),(14,'Praktikum Pemrograman Web','198609262015051001',12),(15,'Pemrograman Web','198609262015051001',12),(16,'Praktikum Algoritma dan Sturktur Data','198609262015051002',12),(17,'Algoritma dan Struktur Data','198609262015051002',12),(18,'Agama','123434545678909868',18),(19,'Matematika','123434545678909868',18);
/*!40000 ALTER TABLE `mata_kuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tugas`
--

DROP TABLE IF EXISTS `tugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tugas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text,
  `batas` timestamp NOT NULL,
  `mataKuliahID` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tugas`
--

LOCK TABLES `tugas` WRITE;
/*!40000 ALTER TABLE `tugas` DISABLE KEYS */;
INSERT INTO `tugas` VALUES (22,'Akidah Islam','','2022-09-12 15:59:00',18),(23,'Sholat','','2021-06-28 09:05:00',18);
/*!40000 ALTER TABLE `tugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `nrp_nip` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jenisKelamin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `agama` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kelasID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nrp_nip`),
  UNIQUE KEY `user_un` (`email`),
  KEY `user_nrp_nip_IDX` (`nrp_nip`,`nama`,`email`,`password`,`kelasID`,`jenisKelamin`,`agama`,`kota`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('123434545678909868','lecture@lecture.com','lecture@lecture.com','$2y$10$S9SPl8R0QDpt4KzPnLzr0O87h5SvX9zSTK3MEHxbmEUpRwrwDALOO','Laki - Laki','Islam','Enrekang',NULL,'Dosen',''),('3120600001','Mahasiswa Baru','student@student.com','$2y$10$qIJdYBnxoghb8ztDdjEXf.HN8H8Yn3VXAgCgzeNzJEjMRF5AhiLYy','Laki - Laki','Islam','Enrekang','18','Mahasiswa',''),('3120699999','Amar Ma\'ruf','amartest@student.com','$2y$10$RU36R7PtitmHsG2oYyVs7uYm34Sftv7RZJG9bBI3eFa1eAbG4d9/C','Laki - Laki','Islam','Enrekang','19','Mahasiswa',''),('9999999999','admin','admin@admin.com','$2y$10$TRRjKn/shs7OvtrYNBL3Hex/31mQv8RNMHMh8xu/MhDwJ2Cxm2/Ym','Laki - Laki','Islam','Enrekang',NULL,'Admin',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'taster'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-28 19:57:25
