-- MySQL dump 10.13  Distrib 8.4.11, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	8.4.11

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
-- Table structure for table `aktivitas`
--

DROP TABLE IF EXISTS `aktivitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aktivitas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL,
  `tipe` enum('materi','quiz','praktikum','evaluasi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `durasi` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aktivitas_folder_slug_unique` (`folder`,`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aktivitas`
--

LOCK TABLES `aktivitas` WRITE;
/*!40000 ALTER TABLE `aktivitas` DISABLE KEYS */;
INSERT INTO `aktivitas` VALUES (1,'Sorting','pendahuluan','sorting',1,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(2,'Kompleksitas','pendahuluan','kompleksitas',2,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(3,'Kuis Sorting','pendahuluan','quiz',3,'quiz',5,'2026-03-06 21:57:01','2026-06-04 07:12:13'),(4,'Materi Bubble Sort','bubble','materi',1,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(5,'Simulasi Bubble Sort','bubble','simulasi',2,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(6,'Kode Program Bubble Sort','bubble','program',3,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(7,'Kuis Bubble Sort','bubble','quiz',4,'quiz',1,'2026-03-06 21:57:01','2026-06-04 05:23:59'),(8,'Praktikum Bubble Sort','bubble','praktikum',5,'praktikum',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(9,'Materi Selection Sort','selection','materi',1,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(10,'Simulasi Selection Sort','selection','simulasi',2,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(11,'Kode Program Selection Sort','selection','program',3,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(12,'Kuis Selection Sort','selection','quiz',4,'quiz',10,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(13,'Praktikum Selection Sort','selection','praktikum',5,'praktikum',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(14,'Materi Insertion Sort','insertion','materi',1,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(15,'Simulasi Insertion Sort','insertion','simulasi',2,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(16,'Kode Program Insertion Sort','insertion','program',3,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(17,'Kuis Insertion Sort','insertion','quiz',4,'quiz',10,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(18,'Praktikum Insertion Sort','insertion','praktikum',5,'praktikum',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(19,'Materi Merge Sort','merge','materi',1,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(20,'Simulasi Merge Sort','merge','simulasi',2,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(21,'Kode Program Merge Sort','merge','program',3,'materi',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(22,'Kuis Merge Sort','merge','quiz',4,'quiz',1,'2026-03-06 21:57:01','2026-06-04 05:33:03'),(23,'Praktikum Merge Sort','merge','praktikum',5,'praktikum',NULL,'2026-03-06 21:57:01','2026-03-06 21:57:01'),(24,'Evaluasi Akhir','evaluasi','quiz',1,'evaluasi',20,NULL,'2026-06-04 05:32:56');
/*!40000 ALTER TABLE `aktivitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `butir_soal`
--

DROP TABLE IF EXISTS `butir_soal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `butir_soal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_aktivitas` bigint unsigned NOT NULL,
  `tipe` enum('pilgan','essay','truefalse','dragdrop') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` int NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pilihan_a` text COLLATE utf8mb4_unicode_ci,
  `pilihan_b` text COLLATE utf8mb4_unicode_ci,
  `pilihan_c` text COLLATE utf8mb4_unicode_ci,
  `pilihan_d` text COLLATE utf8mb4_unicode_ci,
  `pilihan_e` text COLLATE utf8mb4_unicode_ci,
  `jawaban_benar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `butir_soal_id_aktivitas_nomor_unique` (`id_aktivitas`,`nomor`),
  CONSTRAINT `butir_soal_id_aktivitas_foreign` FOREIGN KEY (`id_aktivitas`) REFERENCES `aktivitas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `butir_soal`
--

LOCK TABLES `butir_soal` WRITE;
/*!40000 ALTER TABLE `butir_soal` DISABLE KEYS */;
INSERT INTO `butir_soal` VALUES (93,3,'pilgan',1,'Tujuan utama dari proses sorting dalam struktur data adalah ???','Menghapus data yang tidak diperlukan','menyusun data agar lebih mudah dicari dan diproses','mengamankan data di dalam memori komputer','menjumlahkan seluruh nilai dalam suatu daftar data','memperbesar kapasitas penyimpanan data dalam sistem','B','2026-05-11 05:11:54','2026-05-11 05:11:54'),(94,3,'pilgan',2,'Contoh susunan data yang menunjukkan proses pengurutan secara ascending adalah ...','[9, 7, 5, 3]','[20, 15, 10, 5]','[1, 4, 7, 9]','[12, 10, 8, 6]','[30, 25, 20, 15]','C','2026-05-11 05:11:54','2026-05-11 05:11:54'),(95,3,'pilgan',3,'Dalam proses sorting, sort key adalah???','jumlah total elemen yang terdapat pada data','atribut atau nilai yang dijadikan dasar dalam proses pengurutan','indeks pertama yang terdapat pada array','nilai yang selalu ditempatkan pada posisi akhir setelah pengurutan','elemen yang memiliki nilai terbesar dalam kumpulan data','B','2026-05-11 05:11:54','2026-05-11 05:11:54'),(96,3,'pilgan',4,'Jika data [7, 4, 6] diurutkan secara ascending, maka susunan data setelah satu kali pertukaran (swap) pertama adalah ...','[7, 4, 6]','[4, 7, 6]','[4, 6, 7]','[6, 4, 7]','[7, 6, 4]','B','2026-05-11 05:11:54','2026-05-11 05:11:54'),(97,3,'pilgan',5,'Urutan langkah utama dalam proses sorting yang benar adalah ???','Menukar elemen - Membandingkan elemen - Data terurut','Membandingkan elemen - Data terurut - Menukar elemen','Data terurut - Membandingkan elemen - Menukar elemen','Membandingkan elemen - Menukar elemen - Data terurut','menyalin data - menghapus data - data terurut   ','D','2026-05-11 05:11:54','2026-05-11 05:11:54'),(98,3,'essay',6,'Pengurutan data dari nilai terbesar ke terkecil disebut pengurutan __________.',NULL,NULL,NULL,NULL,NULL,'descending','2026-05-11 05:11:54','2026-05-11 05:11:54'),(99,3,'essay',7,'Dua operasi utama yang sering dianalisis dalam algoritma sorting adalah __________ dan pertukaran.',NULL,NULL,NULL,NULL,NULL,'perbandingan','2026-05-11 05:11:54','2026-05-11 05:11:54'),(100,3,'dragdrop',8,'Jika terdapat data [5,2,8], setelah 1 swap pertama menjadi...',NULL,NULL,NULL,NULL,NULL,'{\"source\":[5,2,8],\"correct\":[2,5,8]}','2026-05-11 05:11:54','2026-05-11 05:11:54'),(101,3,'truefalse',9,'Bubble Sort memiliki kompleksitas ruang O(1) karena tidak membutuhkan memori tambahan.','Benar','Salah',NULL,NULL,NULL,'Benar','2026-05-11 05:11:54','2026-05-11 05:11:54'),(102,3,'truefalse',10,'Algoritma dengan kompleksitas O(n??) sangat efisien untuk data berukuran besar.','Benar','Salah',NULL,NULL,NULL,'Salah','2026-05-11 05:11:54','2026-05-11 05:11:54'),(103,7,'pilgan',1,'Prinsip utama kerja algoritma Bubble Sort adalah ...','Membagi data menjadi dua bagian','Membandingkan elemen yang bersebelahan dan menukarnya jika salah urut','Memilih elemen terkecil lalu memindahkannya ke depan','Menggunakan struktur data pohon dalam proses pengurutan','menyisipkan elemen ke posisi yang sesuai pada bagian data yang telah terurut','B','2026-05-11 05:50:38','2026-05-11 05:50:38'),(104,7,'pilgan',2,'Pada Bubble Sort, setelah satu iterasi penuh, elemen yang pasti berada pada posisi yang benar adalah ...','Elemen terkecil','Elemen dengan posisi acak','Elemen Terbesar','Seluruh elemen langsung terurut sempurna','Elemen yang pertama kali dibandingkan','c','2026-05-11 05:50:38','2026-05-11 05:50:38'),(105,7,'pilgan',3,'Perhatikan potongan kode berikut:\n\nfor j in range(0, i):\n    if data[j] > data[j+1]:\n        data[j], data[j+1] = data[j+1], data[j]\n\nKode tersebut berfungsi untuk...','Menentukan batas jumlah iterasi pada proses pengurutan','Membandingkan dan menukar elemen bersebelahan','Mengurutkan seluruh elemen list secara langsung tanpa perbandingan','Mencetak hasil pengurutan pada setiap iterasi','Membagi list menjadi dua bagian yang lebih kecil secara otomatis','B','2026-05-11 05:50:38','2026-05-11 05:50:38'),(106,7,'dragdrop',4,'Urutkan deret bilangan [4, 2, 5, 1, 6] pada iterasi pertama menggunakan Bubble Sort (Ascending).',NULL,NULL,NULL,NULL,NULL,'{\"source\":[4,2,5,1,6],\"correct\":[2,4,1,5,6]}','2026-05-11 05:50:38','2026-05-11 05:50:38'),(107,7,'dragdrop',5,'Urutkan deret bilangan [3, 6, 2, 5] pada iterasi kedua menggunakan Bubble Sort (Descending).',NULL,NULL,NULL,NULL,NULL,'{\"source\":[3,6,2,5],\"correct\":[6,5,3,2]}','2026-05-11 05:50:38','2026-05-11 05:50:38'),(108,7,'essay',6,'Lengkapilah potongan kode berikut agar proses pertukaran (swap) berjalan dengan benar:\r\n\r\ntemp = ______\r\ndata[j] = data[j+1]\r\ndata[j+1] = temp',NULL,NULL,NULL,NULL,NULL,'data[j]','2026-05-11 05:50:38','2026-05-11 05:50:38'),(109,7,'essay',7,'Lengkapilah operator perbandingan berikut agar Bubble Sort mengurutkan data secara ascending:\r\n\r\nif data[j] ______ data[j+1]:',NULL,NULL,NULL,NULL,NULL,'>','2026-05-11 05:50:38','2026-05-11 05:50:38'),(110,7,'truefalse',8,'Bubble Sort tetap melakukan perbandingan meskipun data sudah terurut.','Benar','Salah',NULL,NULL,NULL,'Benar','2026-05-11 05:50:38','2026-05-11 05:50:38'),(111,7,'truefalse',9,'Bubble Sort sangat efisien untuk data berukuran besar karena memiliki kompleksitas O(n log n).','Benar','Salah',NULL,NULL,NULL,'Salah','2026-05-11 05:50:38','2026-05-11 05:50:38'),(112,7,'essay',10,'Setiap satu kali pemeriksaan seluruh elemen data pada Bubble Sort disebut satu ________.',NULL,NULL,NULL,NULL,NULL,'iterasi','2026-05-11 05:50:38','2026-05-11 05:50:38'),(113,12,'pilgan',1,'Prinsip utama algoritma Selection Sort adalah ...','Menukar elemen yang bersebelahan secara berulang','Memilih elemen terkecil atau terbesar dari data yang belum terurut dan menempatkannya di posisi yang sesuai','Membagi data menjadi dua bagian yang sama besar','Mengurutkan data menggunakan rekursi secara penuh','menyisipkan elemen ke bagian data yang telah terurut','B','2026-05-11 06:01:23','2026-05-11 06:01:23'),(114,12,'pilgan',2,'Pada Selection Sort (ascending), elemen yang dipilih pada setiap iterasi adalah ...','Elemen terbesar dari seluruh data','Elemen tengah dari kumpulan data','Elemen terkecil dari bagian data yang belum terurut','Elemen terakhir dari kumpulan data','elemen pertama yang dibandingkan pada se    tiap iterasi    ','C','2026-05-11 06:01:23','2026-05-11 06:01:23'),(115,12,'pilgan',3,'Kompleksitas waktu algoritma Selection Sort adalah ...','O(n)','O(log n)','O(n??)','O(n log n)','O(1)','C','2026-05-11 06:01:23','2026-05-11 06:01:23'),(116,12,'dragdrop',4,'Diberikan data awal:\n\n[7, 3, 5, 2]\n\nSusun hasil data setelah iterasi ke-1 algoritma Selection Sort (ascending).',NULL,NULL,NULL,NULL,NULL,'{\"source\":[7,3,5,2],\"correct\":[2,3,5,7]}','2026-05-11 06:01:23','2026-05-11 06:01:23'),(117,12,'dragdrop',5,'Diberikan data awal:\n\n[6, 4, 9, 1, 5]\n\nSusun hasil data setelah iterasi ke-3 algoritma Selection Sort (descending).',NULL,NULL,NULL,NULL,NULL,'{\"source\":[6,4,9,1,5],\"correct\":[9,6,5,1,4]}','2026-05-11 06:01:23','2026-05-11 06:01:23'),(118,12,'essay',6,'Selection Sort dinamakan demikian karena pada setiap iterasi melakukan proses ______ terhadap suatu elemen.',NULL,NULL,NULL,NULL,NULL,'seleksi','2026-05-11 06:01:23','2026-05-11 06:01:23'),(119,12,'essay',7,'Jumlah maksimum pertukaran (swap) pada algoritma Selection Sort untuk n data adalah sebanyak ______.',NULL,NULL,NULL,NULL,NULL,'n - 1','2026-05-11 06:01:23','2026-05-11 06:01:23'),(120,12,'essay',8,'Lengkapilah potongan kode Python berikut agar Selection Sort dapat berjalan dengan benar (ascending).\n\nfor i in range(len(data)):\n    ______\n    for j in range(i+1, len(data)):\n        if data[j] < data[min_idx]:\n            min_idx = j\n    data[i], data[min_idx] = data[min_idx], data[i]',NULL,NULL,NULL,NULL,NULL,'min_idx=i','2026-05-11 06:01:23','2026-05-11 06:01:23'),(121,12,'essay',9,'Lengkapilah potongan kode Python berikut agar Selection Sort dapat berjalan dengan benar (ascending).\n\nfor i in range(len(data)):\n    min_idx = i\n    for j in range(i+1, len(data)):\n        if data[j] ______ data[min_idx]:\n            min_idx = j\n    data[i], data[min_idx] = data[min_idx], data[i]',NULL,NULL,NULL,NULL,NULL,'<','2026-05-11 06:01:23','2026-05-11 06:01:23'),(122,12,'truefalse',10,'Selection Sort melakukan lebih sedikit pertukaran dibanding Bubble Sort, tetapi tetap memiliki kompleksitas waktu O(n??).','Benar','Salah',NULL,NULL,NULL,'Benar','2026-05-11 06:01:23','2026-05-11 06:01:23'),(123,17,'pilgan',1,'Prinsip utama kerja algoritma Insertion Sort adalah ...','Menukar elemen yang bersebelahan secara berulang','Memilih elemen terkecil dari seluruh kumpulan data','menyisipkan elemen ke posisi yang tepat pada bagian data yang telah terurut','Membagi data menjadi dua bagian yang lebih kecil','menggabungkan dua bagian data yang telah terurut menjadi satu kesatuan','C','2026-05-11 06:14:31','2026-05-11 06:14:31'),(124,17,'pilgan',2,'Pada algoritma Insertion Sort, bagian data yang selalu dijaga dalam kondisi terurut adalah ...','Bagian akhir list','Bagian awal list','Bagian tengah list','Seluruh list secara bersamaan','Bagian data yang memiliki nilai terbesar','B','2026-05-11 06:14:31','2026-05-11 06:14:31'),(125,17,'pilgan',3,'Algoritma Insertion Sort cenderung lebih efisien digunakan pada data yang ...','Berukuran sangat besar','Tersusun secara acak sepenuhnya','Sudah hampir terurut','Berbentuk struktur pohon','Memiliki jumlah elemen yang selalu genap','C','2026-05-11 06:14:31','2026-05-11 06:14:31'),(126,17,'dragdrop',4,'Diberikan data awal:\n\n[8, 3, 5, 2]\n\nSusun hasil data setelah iterasi ke-1 algoritma Insertion Sort (ascending).',NULL,NULL,NULL,NULL,NULL,'{\"source\":[8,3,5,2],\"correct\":[3,8,5,2]}','2026-05-11 06:14:31','2026-05-11 06:14:31'),(127,17,'dragdrop',5,'Diberikan data awal:\n\n[7, 4, 6, 1]\n\nSusun hasil data setelah iterasi ke-1 algoritma Insertion Sort (ascending).',NULL,NULL,NULL,NULL,NULL,'{\"source\":[7,4,6,1],\"correct\":[4,7,6,1]}','2026-05-11 06:14:31','2026-05-11 06:14:31'),(128,17,'essay',6,'Pada Insertion Sort, elemen pertama dianggap sudah berada pada posisi yang ______.',NULL,NULL,NULL,NULL,NULL,'benar','2026-05-11 06:14:31','2026-05-11 06:14:31'),(129,17,'essay',7,'Proses utama pada Insertion Sort adalah melakukan ______ elemen ke posisi yang sesuai.',NULL,NULL,NULL,NULL,NULL,'penyisipan','2026-05-11 06:14:31','2026-05-11 06:14:31'),(130,17,'essay',8,'Lengkapilah potongan kode berikut agar proses pergeseran elemen pada Insertion Sort dapat berjalan dengan benar.\n\nwhile j >= 0 and data[j] > ______ :\n    data[j+1] = data[j]\n    j = j - 1',NULL,NULL,NULL,NULL,NULL,'key','2026-05-11 06:14:31','2026-05-11 06:14:31'),(131,17,'essay',9,'Lengkapilah potongan fungsi Insertion Sort berikut.\n\ndef insertion_sort(data):\n    for i in range(1, len(data)):\n        key = data[i]\n        j = i - 1\n\n        while j >= 0 and data[j] > key:\n            data[j+1] = data[j]\n            j -= 1\n\n        data[ ______ ] = key',NULL,NULL,NULL,NULL,NULL,'j+1','2026-05-11 06:14:31','2026-05-11 06:14:31'),(132,17,'truefalse',10,'Insertion Sort memiliki kompleksitas waktu O(n??), tetapi dapat bekerja lebih cepat pada data yang hampir terurut.','Benar','Salah',NULL,NULL,NULL,'Benar','2026-05-11 06:14:31','2026-05-11 06:14:31'),(153,22,'pilgan',1,'Strategi utama yang digunakan oleh algoritma Merge Sort adalah ...','Greedy','Brute Force','Divide and Conquer','Dynamic Programming','Backtracking','C','2026-05-11 06:32:38','2026-05-11 06:32:38'),(154,22,'pilgan',2,'Proses utama yang menjadi ciri khas Merge Sort adalah ...','Penukaran elemen bersebelahan','Penyisipan elemen ke posisi tertentu','Penggabungan dua sublist yang sudah terurut','Pemilihan elemen minimum dari kumpulan data','Pemindahan elemen terbesar ke posisi akhir secara bertahap','C','2026-05-11 06:32:38','2026-05-11 06:32:38'),(155,22,'pilgan',3,'Kompleksitas waktu utama pada algoritma Merge Sort adalah ...','O(n)','O(n??)','O(n log n)','O(log n)','O(1)','C','2026-05-11 06:32:38','2026-05-11 06:32:38'),(156,22,'dragdrop',4,'Diberikan dua sublist yang sudah terurut:\n\n[2, 5] dan [1, 3, 4]\n\nSusun hasil penggabungan (merge) yang benar menjadi satu daftar terurut.',NULL,NULL,NULL,NULL,NULL,'{\"source\":[2,5,1,3,4],\"correct\":[1,2,3,4,5]}','2026-05-11 06:32:38','2026-05-11 06:32:38'),(157,22,'dragdrop',5,'Diberikan dua sublist terurut:\n\n[3, 8] dan [2, 6]\n\nSusun hasil penggabungan (merge) yang benar.',NULL,NULL,NULL,NULL,NULL,'{\"source\":[3,8,2,6],\"correct\":[2,3,6,8]}','2026-05-11 06:32:38','2026-05-11 06:32:38'),(158,22,'essay',6,'Proses penggabungan dua sublist terurut pada algoritma Merge Sort disebut tahap ______.',NULL,NULL,NULL,NULL,NULL,'merge','2026-05-11 06:32:38','2026-05-11 06:32:38'),(159,22,'essay',7,'Lengkapilah bagian kode berikut agar pembagian list pada Merge Sort dapat berjalan dengan benar.\n\nmid = len(data) // 2\nleft = data[:______]',NULL,NULL,NULL,NULL,NULL,'mid','2026-05-11 06:32:38','2026-05-11 06:32:38'),(160,22,'essay',8,'Lengkapilah bagian kode penggabungan (merge) berikut.\n\nwhile i < len(left) and j < len(right):\n    if left[i] ______ right[j]:\n        result.append(left[i])\n        i += 1\n    else:\n        result.append(right[j])\n        j += 1',NULL,NULL,NULL,NULL,NULL,'<','2026-05-11 06:32:38','2026-05-11 06:32:38'),(161,22,'essay',9,'Merge Sort termasuk algoritma pengurutan yang ______ karena tidak mengubah urutan relatif elemen yang bernilai sama.',NULL,NULL,NULL,NULL,NULL,'stabil','2026-05-11 06:32:38','2026-05-11 06:32:38'),(162,22,'truefalse',10,'Merge Sort memiliki kompleksitas waktu yang efisien O(n log n), tetapi membutuhkan memori tambahan untuk proses penggabungan data.','Benar','Salah',NULL,NULL,NULL,'Benar','2026-05-11 06:32:38','2026-05-11 06:32:38'),(163,24,'pilgan',1,'Sorting merupakan proses menyusun data berdasarkan kunci tertentu agar data lebih mudah dianalisis dan diproses. Pernyataan yang paling tepat terkait tujuan utama sorting adalah ???','Mempercepat proses pencarian dan pengolahan data','Menghilangkan data yang tidak diperlukan','Menambah ukuran data agar lebih lengkap','Mengamankan data dari kesalahan pengguna','Menyembunyikan struktur data dari sistem','A','2026-05-11 10:37:28','2026-05-11 10:37:28'),(164,24,'pilgan',2,'Dalam proses sorting, operasi yang paling berpengaruh terhadap efisiensi algoritma adalah ???','Input dan output data','Perbandingan dan pertukaran elemen','Penyimpanan data sementara','Penghapusan elemen duplikat','Pencetakan hasil pengurutan','B','2026-05-11 10:37:28','2026-05-11 10:37:28'),(165,24,'pilgan',3,'Data yang disusun dari nilai terbesar ke terkecil disebut sebagai urutan ???','Ascending','Linear','Rekursif','Acak','Descending','E','2026-05-11 10:37:28','2026-05-11 10:37:28'),(166,24,'pilgan',4,'Beberapa algoritma pencarian tidak dapat bekerja tanpa data terurut. Pernyataan ini menunjukkan bahwa sorting berperan penting karena ???','Mengurangi ukuran data','Menghindari penggunaan perulangan','Menghilangkan kebutuhan algoritma lain','Menjadi prasyarat bagi algoritma tertentu seperti Binary Search','Memperbesar kapasitas penyimpanan data','D','2026-05-11 10:37:28','2026-05-11 10:37:28'),(167,24,'pilgan',5,'Perhatikan data berikut: [5, 1, 4, 2]. Setelah 1 iterasi penuh Bubble Sort (ascending), susunan data menjadi ???','[1, 5, 4, 2]','[1, 4, 2, 5]','[5, 1, 2, 4]','[1, 2, 4, 5]','[2, 1, 4, 5]','B','2026-05-11 10:37:28','2026-05-11 10:37:28'),(168,24,'pilgan',6,'Pada algoritma Bubble Sort, kondisi yang menunjukkan bahwa data telah terurut sempurna adalah ???','Jumlah iterasi mencapai n','Elemen terkecil berada di awal','Tidak terjadi pertukaran pada satu iterasi','Semua elemen dibandingkan','Jumlah data terus berkurang','C','2026-05-11 10:37:28','2026-05-11 10:37:28'),(169,24,'pilgan',7,'Jika terdapat n data, maka dalam satu iterasi Bubble Sort jumlah perbandingan maksimum adalah ???','n','n - 1','n??','n log n','log n','B','2026-05-11 10:37:28','2026-05-11 10:37:28'),(170,24,'pilgan',8,'Diberikan data [6, 3, 8, 2]. Setelah iterasi pertama Selection Sort (ascending), hasilnya adalah ???','[2, 3, 8, 6]','[2, 3, 6, 8]','[3, 6, 8, 2]','[2, 6, 8, 3]','[6, 2, 3, 8]','A','2026-05-11 10:37:28','2026-05-11 10:37:28'),(171,24,'pilgan',9,'Selection Sort hanya melakukan satu kali pertukaran pada setiap siklus. Hal ini menyebabkan algoritma tersebut ???','Lebih cepat dari Merge Sort','Tidak menggunakan perbandingan','Memiliki jumlah swap yang relatif sedikit','Selalu bekerja dalam O(n)','Tidak memerlukan iterasi','C','2026-05-11 10:37:28','2026-05-11 10:37:28'),(172,24,'pilgan',10,'Kompleksitas waktu Selection Sort pada kondisi best case, average case, dan worst case adalah ???','O(n)','O(n log n)','O(log n)','O(n??)','O(1)','D','2026-05-11 10:37:28','2026-05-11 10:37:28'),(173,24,'pilgan',11,'Insertion Sort bekerja dengan asumsi bahwa ???','Seluruh data belum terurut','Elemen terakhir selalu terbesar','Seluruh data langsung dibandingkan sekaligus','Data harus berukuran kecil','Bagian awal data sudah berada dalam kondisi terurut','E','2026-05-11 10:37:28','2026-05-11 10:37:28'),(174,24,'pilgan',12,'Perhatikan potongan kode berikut:\r\n\r\nwhile j >= 0 and data[j] > key:\r\n    data[j+1] = data[j]\r\n    j -= 1\r\n\r\nProses ini dilakukan berulang karena ???','Untuk menukar elemen secara langsung','Untuk mencari nilai minimum','Untuk memberi ruang penyisipan elemen pada posisi yang tepat','Untuk menghentikan perulangan','Untuk membagi data menjadi dua bagian','C','2026-05-11 10:37:28','2026-05-11 10:37:28'),(175,24,'pilgan',13,'Insertion Sort lebih efisien digunakan pada data yang ???','Hampir terurut','Terbalik sepenuhnya','Berukuran sangat besar','Mengandung banyak duplikasi','Memiliki nilai acak seluruhnya','A','2026-05-11 10:37:28','2026-05-11 10:37:28'),(176,24,'pilgan',14,'Jika terdapat data berukuran besar dan tidak terurut, algoritma yang paling efisien digunakan karena memiliki kompleksitas O(n log n) adalah ???','Bubble Sort','Selection Sort','Insertion Sort','Merge Sort','Linear Sort','D','2026-05-11 10:37:28','2026-05-11 10:37:28'),(177,24,'pilgan',15,'Merge Sort disebut sebagai algoritma Divide and Conquer karena ???','Mengurutkan data secara langsung','Menggabungkan data tanpa perbandingan','Melakukan pertukaran elemen secara berulang','Menghindari penggunaan rekursi','Membagi data, mengurutkan secara rekursif, lalu menggabungkannya','E','2026-05-11 10:37:28','2026-05-11 10:37:28'),(178,24,'pilgan',16,'Perhatikan potongan kode berikut:\r\n        \r\ntengah = len(data) // 2\r\nbagian_kiri = data[:tengah]\r\nbagian_kanan = data[tengah:]\r\n\r\nPernyataan yang paling tepat mengenai kode tersebut adalah ???','Membagi data menjadi dua sublist','Menggabungkan dua data','Mengurutkan data','Menukar elemen terbesar','Memindahkan elemen terkecil ke awal','A','2026-05-11 10:37:28','2026-05-11 10:37:28'),(179,24,'pilgan',17,'Mengapa proses pengurutan pada Merge Sort terjadi pada tahap merge, bukan saat pembagian?','Karena data sudah diurutkan sebelum dibagi','Karena proses merge tidak menggunakan perbandingan','Karena pembagian hanya memecah data tanpa mengubah urutan','Karena pembagian lebih cepat','Karena merge hanya dilakukan satu kali','C','2026-05-11 10:37:28','2026-05-11 10:37:28'),(180,24,'pilgan',18,'Kelemahan utama Merge Sort dibandingkan algoritma sorting sederhana adalah ???','Tidak stabil','Tidak menggunakan rekursi','Membutuhkan waktu lebih lama','Memerlukan memori tambahan','Tidak dapat mengurutkan data besar','D','2026-05-11 10:37:28','2026-05-11 10:37:28'),(181,24,'pilgan',19,'Sebuah aplikasi e-commerce harus mengurutkan jutaan data produk secara konsisten dan stabil. Algoritma yang paling tepat digunakan adalah ???','Bubble Sort','Merge Sort','Insertion Sort','Selection Sort','Sequential Sort','B','2026-05-11 10:37:28','2026-05-11 10:37:28'),(182,24,'pilgan',20,'Seorang mahasiswa mengamati bahwa Merge Sort menggunakan memori lebih besar dibanding Bubble Sort. Berdasarkan analisis kode, penyebab utama kondisi tersebut adalah ???','Banyaknya perbandingan','Proses pertukaran','Penggunaan perulangan','Penggunaan operator logika pada rekursi','Pembuatan sublist baru saat proses pembagian dan penggabungan','E','2026-05-11 10:37:28','2026-05-11 10:37:28');
/*!40000 ALTER TABLE `butir_soal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dosen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint unsigned NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dosen_nip_unique` (`nip`),
  KEY `dosen_id_user_foreign` (`id_user`),
  CONSTRAINT `dosen_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen`
--

LOCK TABLES `dosen` WRITE;
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
INSERT INTO `dosen` VALUES (1,1,'1987654321','1776743626_1.png','2026-03-06 21:57:01','2026-04-21 02:53:46');
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jawaban_mahasiswa`
--

DROP TABLE IF EXISTS `jawaban_mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jawaban_mahasiswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` bigint unsigned NOT NULL,
  `id_aktivitas` bigint unsigned NOT NULL,
  `skor` int NOT NULL,
  `status_lulus` tinyint(1) NOT NULL,
  `attempt` int DEFAULT '1',
  `detail_jawaban` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `waktu_mulai` timestamp NULL DEFAULT NULL,
  `waktu_selesai` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jawaban_mahasiswa_id_mahasiswa_foreign` (`id_mahasiswa`),
  KEY `jawaban_mahasiswa_id_aktivitas_foreign` (`id_aktivitas`),
  CONSTRAINT `jawaban_mahasiswa_id_aktivitas_foreign` FOREIGN KEY (`id_aktivitas`) REFERENCES `aktivitas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jawaban_mahasiswa_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jawaban_mahasiswa_chk_1` CHECK (json_valid(`detail_jawaban`))
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jawaban_mahasiswa`
--

LOCK TABLES `jawaban_mahasiswa` WRITE;
/*!40000 ALTER TABLE `jawaban_mahasiswa` DISABLE KEYS */;
INSERT INTO `jawaban_mahasiswa` VALUES (36,2,3,90,1,1,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"C\",\"is_correct\":true},\"q3\":{\"jawaban\":\"B\",\"is_correct\":true},\"q4\":{\"jawaban\":\"B\",\"is_correct\":true},\"q5\":{\"jawaban\":\"D\",\"is_correct\":true},\"q6\":{\"jawaban\":\"descending\",\"is_correct\":true},\"q7\":{\"jawaban\":\"pertukaran\",\"is_correct\":false},\"q8\":{\"jawaban\":\"[2,5,8]\",\"is_correct\":true},\"q9\":{\"jawaban\":\"Benar\",\"is_correct\":true},\"q10\":{\"jawaban\":\"Salah\",\"is_correct\":true}}','2026-05-11 14:03:44','2026-05-11 14:04:56','2026-05-11 14:04:56','2026-07-10 15:36:40'),(37,2,22,90,1,1,'{\"q1\":{\"jawaban\":\"C\",\"is_correct\":true},\"q2\":{\"jawaban\":\"C\",\"is_correct\":true},\"q3\":{\"jawaban\":\"C\",\"is_correct\":true},\"q4\":{\"jawaban\":\"[1,2,3,4,5]\",\"is_correct\":true},\"q5\":{\"jawaban\":\"[2,3,6,8]\",\"is_correct\":true},\"q6\":{\"jawaban\":\"merge\",\"is_correct\":true},\"q7\":{\"jawaban\":\"mid\",\"is_correct\":true},\"q8\":{\"jawaban\":\"<\",\"is_correct\":true},\"q9\":{\"jawaban\":\"yak\",\"is_correct\":false},\"q10\":{\"jawaban\":\"Benar\",\"is_correct\":true}}','2026-05-20 11:45:56','2026-05-20 11:49:43','2026-05-20 11:49:43','2026-07-10 15:36:40'),(38,2,22,50,0,2,'{\"q1\":{\"jawaban\":\"C\",\"is_correct\":true},\"q2\":{\"jawaban\":\"C\",\"is_correct\":true},\"q3\":{\"jawaban\":\"D\",\"is_correct\":false},\"q4\":{\"jawaban\":\"[2,5,1,4,3]\",\"is_correct\":false},\"q5\":{\"jawaban\":\"[3,8,6,2]\",\"is_correct\":false},\"q6\":{\"jawaban\":\"merge\",\"is_correct\":true},\"q7\":{\"jawaban\":\"mid\",\"is_correct\":true},\"q8\":{\"jawaban\":\"<\",\"is_correct\":true},\"q9\":{\"jawaban\":\"ree\",\"is_correct\":false},\"q10\":{\"jawaban\":\"Salah\",\"is_correct\":false}}','2026-05-29 05:28:24','2026-05-29 05:30:23','2026-05-29 05:30:23','2026-07-10 15:36:40'),(39,2,24,15,0,1,'{\"q1\":{\"jawaban\":\"D\",\"is_correct\":false},\"q2\":{\"jawaban\":\"C\",\"is_correct\":false},\"q3\":{\"jawaban\":\"D\",\"is_correct\":false},\"q4\":{\"jawaban\":\"B\",\"is_correct\":false},\"q5\":{\"jawaban\":\"D\",\"is_correct\":false},\"q6\":{\"jawaban\":\"C\",\"is_correct\":true},\"q7\":{\"jawaban\":\"B\",\"is_correct\":true},\"q8\":{\"jawaban\":\"E\",\"is_correct\":false},\"q9\":{\"jawaban\":\"D\",\"is_correct\":false},\"q10\":{\"jawaban\":\"E\",\"is_correct\":false},\"q11\":{\"jawaban\":\"C\",\"is_correct\":false},\"q12\":{\"jawaban\":\"A\",\"is_correct\":false},\"q13\":{\"jawaban\":\"A\",\"is_correct\":true},\"q14\":{\"jawaban\":\"E\",\"is_correct\":false},\"q15\":{\"jawaban\":\"C\",\"is_correct\":false},\"q16\":{\"jawaban\":\"B\",\"is_correct\":false},\"q17\":{\"jawaban\":\"D\",\"is_correct\":false},\"q18\":{\"jawaban\":\"E\",\"is_correct\":false},\"q19\":{\"jawaban\":\"C\",\"is_correct\":false},\"q20\":{\"jawaban\":\"C\",\"is_correct\":false}}','2026-05-29 06:51:10','2026-05-29 06:51:53','2026-05-29 06:51:53','2026-07-10 15:36:40'),(42,2,24,15,0,3,'{\"q1\":{\"jawaban\":\"C\",\"is_correct\":false},\"q2\":{\"jawaban\":\"C\",\"is_correct\":false},\"q3\":{\"jawaban\":\"C\",\"is_correct\":false},\"q4\":{\"jawaban\":\"D\",\"is_correct\":true},\"q5\":{\"jawaban\":\"E\",\"is_correct\":false},\"q6\":{\"jawaban\":\"E\",\"is_correct\":false},\"q7\":{\"jawaban\":\"D\",\"is_correct\":false},\"q8\":{\"jawaban\":\"D\",\"is_correct\":false},\"q9\":{\"jawaban\":\"C\",\"is_correct\":true},\"q10\":{\"jawaban\":\"C\",\"is_correct\":false},\"q11\":{\"jawaban\":\"A\",\"is_correct\":false},\"q12\":{\"jawaban\":\"B\",\"is_correct\":false},\"q13\":{\"jawaban\":\"D\",\"is_correct\":false},\"q14\":{\"jawaban\":\"A\",\"is_correct\":false},\"q15\":{\"jawaban\":\"C\",\"is_correct\":false},\"q16\":{\"jawaban\":\"B\",\"is_correct\":false},\"q17\":{\"jawaban\":\"C\",\"is_correct\":true},\"q18\":{\"jawaban\":\"B\",\"is_correct\":false},\"q19\":{\"jawaban\":\"D\",\"is_correct\":false},\"q20\":{\"jawaban\":\"D\",\"is_correct\":false}}','2026-05-29 09:34:31','2026-05-29 09:35:12','2026-05-29 09:35:12','2026-07-10 15:36:40'),(43,2,3,50,0,2,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"A\",\"is_correct\":false},\"q3\":{\"jawaban\":\"A\",\"is_correct\":false},\"q4\":{\"jawaban\":\"B\",\"is_correct\":true},\"q5\":{\"jawaban\":\"C\",\"is_correct\":false},\"q6\":{\"jawaban\":\"descending\",\"is_correct\":true},\"q7\":{\"jawaban\":\"perbandingan\",\"is_correct\":true},\"q8\":{\"jawaban\":\"[2,5,8]\",\"is_correct\":true},\"q9\":{\"jawaban\":\"Salah\",\"is_correct\":false},\"q10\":{\"jawaban\":\"Benar\",\"is_correct\":false}}','2026-06-03 07:14:41','2026-06-03 07:19:44','2026-06-03 07:19:44','2026-07-10 15:36:40'),(44,2,7,40,0,1,'{\"q1\":{\"jawaban\":\"A\",\"is_correct\":false},\"q2\":{\"jawaban\":\"D\",\"is_correct\":false},\"q3\":{\"jawaban\":\"C\",\"is_correct\":false},\"q4\":{\"jawaban\":\"[4,2,5,1,6]\",\"is_correct\":false},\"q5\":{\"jawaban\":\"[3,6,2,5]\",\"is_correct\":false},\"q6\":{\"jawaban\":\"swap\",\"is_correct\":false},\"q7\":{\"jawaban\":\">\",\"is_correct\":true},\"q8\":{\"jawaban\":\"Benar\",\"is_correct\":true},\"q9\":{\"jawaban\":\"Salah\",\"is_correct\":true},\"q10\":{\"jawaban\":\"iterasi\",\"is_correct\":true}}','2026-06-03 07:33:31','2026-06-03 07:35:00','2026-06-03 07:35:00','2026-07-10 15:36:40'),(45,2,7,10,0,2,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"\",\"is_correct\":false},\"q3\":{\"jawaban\":\"\",\"is_correct\":false},\"q4\":{\"jawaban\":\"\",\"is_correct\":false},\"q5\":{\"jawaban\":\"\",\"is_correct\":false},\"q6\":{\"jawaban\":\"\",\"is_correct\":false},\"q7\":{\"jawaban\":\"\",\"is_correct\":false},\"q8\":{\"jawaban\":\"\",\"is_correct\":false},\"q9\":{\"jawaban\":\"\",\"is_correct\":false},\"q10\":{\"jawaban\":\"\",\"is_correct\":false}}','2026-06-03 22:52:32','2026-06-03 23:02:54','2026-06-03 23:02:54','2026-07-10 15:36:40'),(46,2,3,60,0,3,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"A\",\"is_correct\":false},\"q3\":{\"jawaban\":\"B\",\"is_correct\":true},\"q4\":{\"jawaban\":\"A\",\"is_correct\":false},\"q5\":{\"jawaban\":\"C\",\"is_correct\":false},\"q6\":{\"jawaban\":\"descending\",\"is_correct\":true},\"q7\":{\"jawaban\":\"perbandingan\",\"is_correct\":true},\"q8\":{\"jawaban\":\"[5,2,8]\",\"is_correct\":false},\"q9\":{\"jawaban\":\"Benar\",\"is_correct\":true},\"q10\":{\"jawaban\":\"Salah\",\"is_correct\":true}}','2026-06-04 02:45:44','2026-06-04 02:46:23','2026-06-04 02:46:23','2026-07-10 15:36:40'),(47,2,3,10,0,4,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"\",\"is_correct\":false},\"q3\":{\"jawaban\":\"\",\"is_correct\":false},\"q4\":{\"jawaban\":\"\",\"is_correct\":false},\"q5\":{\"jawaban\":\"\",\"is_correct\":false},\"q6\":{\"jawaban\":\"\",\"is_correct\":false},\"q7\":{\"jawaban\":\"\",\"is_correct\":false},\"q8\":{\"jawaban\":\"\",\"is_correct\":false},\"q9\":{\"jawaban\":\"\",\"is_correct\":false},\"q10\":{\"jawaban\":\"\",\"is_correct\":false}}','2026-06-04 05:10:27','2026-06-04 05:12:45','2026-06-04 05:12:45','2026-07-10 15:36:40'),(48,2,7,20,0,3,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"C\",\"is_correct\":true},\"q3\":{\"jawaban\":\"\",\"is_correct\":false},\"q4\":{\"jawaban\":\"\",\"is_correct\":false},\"q5\":{\"jawaban\":\"\",\"is_correct\":false},\"q6\":{\"jawaban\":\"\",\"is_correct\":false},\"q7\":{\"jawaban\":\"\",\"is_correct\":false},\"q8\":{\"jawaban\":\"\",\"is_correct\":false},\"q9\":{\"jawaban\":\"\",\"is_correct\":false},\"q10\":{\"jawaban\":\"\",\"is_correct\":false}}','2026-06-04 05:24:13','2026-06-04 05:25:21','2026-06-04 05:25:21','2026-07-10 15:36:40'),(49,2,22,10,0,3,'{\"q1\":{\"jawaban\":\"C\",\"is_correct\":true},\"q2\":{\"jawaban\":\"\",\"is_correct\":false},\"q3\":{\"jawaban\":\"\",\"is_correct\":false},\"q4\":{\"jawaban\":\"\",\"is_correct\":false},\"q5\":{\"jawaban\":\"\",\"is_correct\":false},\"q6\":{\"jawaban\":\"\",\"is_correct\":false},\"q7\":{\"jawaban\":\"\",\"is_correct\":false},\"q8\":{\"jawaban\":\"\",\"is_correct\":false},\"q9\":{\"jawaban\":\"\",\"is_correct\":false},\"q10\":{\"jawaban\":\"\",\"is_correct\":false}}','2026-06-04 05:33:56','2026-06-04 05:35:07','2026-06-04 05:35:07','2026-07-10 15:36:40'),(50,2,3,20,0,5,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"C\",\"is_correct\":true},\"q3\":{\"jawaban\":\"\",\"is_correct\":false},\"q4\":{\"jawaban\":\"\",\"is_correct\":false},\"q5\":{\"jawaban\":\"\",\"is_correct\":false},\"q6\":{\"jawaban\":\"\",\"is_correct\":false},\"q7\":{\"jawaban\":\"\",\"is_correct\":false},\"q8\":{\"jawaban\":\"\",\"is_correct\":false},\"q9\":{\"jawaban\":\"\",\"is_correct\":false},\"q10\":{\"jawaban\":\"\",\"is_correct\":false}}','2026-06-04 07:08:37','2026-06-04 07:09:44','2026-06-04 07:09:44','2026-07-10 15:36:40'),(51,2,3,80,1,6,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"C\",\"is_correct\":true},\"q3\":{\"jawaban\":\"B\",\"is_correct\":true},\"q4\":{\"jawaban\":\"B\",\"is_correct\":true},\"q5\":{\"jawaban\":\"D\",\"is_correct\":true},\"q6\":{\"jawaban\":\"descending\",\"is_correct\":true},\"q7\":{\"jawaban\":\"perbandingan\",\"is_correct\":true},\"q8\":{\"jawaban\":\"[2,5,8]\",\"is_correct\":true},\"q9\":{\"jawaban\":\"Salah\",\"is_correct\":false},\"q10\":{\"jawaban\":\"Benar\",\"is_correct\":false}}','2026-06-04 07:12:19','2026-06-04 07:13:25','2026-06-04 07:13:25','2026-07-10 15:36:40'),(54,2,17,100,1,1,'{\"q1\":{\"jawaban\":\"C\",\"is_correct\":true},\"q2\":{\"jawaban\":\"B\",\"is_correct\":true},\"q3\":{\"jawaban\":\"C\",\"is_correct\":true},\"q4\":{\"jawaban\":\"[3,8,5,2]\",\"is_correct\":true},\"q5\":{\"jawaban\":\"[4,7,6,1]\",\"is_correct\":true},\"q6\":{\"jawaban\":\"benar\",\"is_correct\":true},\"q7\":{\"jawaban\":\"penyisipan\",\"is_correct\":true},\"q8\":{\"jawaban\":\"key\",\"is_correct\":true},\"q9\":{\"jawaban\":\"j+1\",\"is_correct\":true},\"q10\":{\"jawaban\":\"Benar\",\"is_correct\":true}}','2026-06-04 15:21:26','2026-06-04 15:27:11','2026-06-04 15:27:11','2026-07-10 15:36:40'),(55,3,3,10,0,1,'{\"q1\":{\"jawaban\":\"A\",\"is_correct\":false},\"q2\":{\"jawaban\":\"A\",\"is_correct\":false},\"q3\":{\"jawaban\":\"A\",\"is_correct\":false},\"q4\":{\"jawaban\":\"A\",\"is_correct\":false},\"q5\":{\"jawaban\":\"A\",\"is_correct\":false},\"q6\":{\"jawaban\":\"fwe\",\"is_correct\":false},\"q7\":{\"jawaban\":\"fwege\",\"is_correct\":false},\"q8\":{\"jawaban\":\"[5,2,8]\",\"is_correct\":false},\"q9\":{\"jawaban\":\"Benar\",\"is_correct\":true},\"q10\":{\"jawaban\":\"Benar\",\"is_correct\":false}}','2026-06-04 15:34:42','2026-06-04 15:35:18','2026-06-04 15:35:18','2026-06-04 15:35:18'),(58,2,7,0,0,4,'{\"q1\":{\"jawaban\":\"C\",\"is_correct\":false},\"q2\":{\"jawaban\":\"A\",\"is_correct\":false},\"q3\":{\"jawaban\":\"A\",\"is_correct\":false},\"q4\":{\"jawaban\":\"\",\"is_correct\":false},\"q5\":{\"jawaban\":\"\",\"is_correct\":false},\"q6\":{\"jawaban\":\"\",\"is_correct\":false},\"q7\":{\"jawaban\":\"\",\"is_correct\":false},\"q8\":{\"jawaban\":\"\",\"is_correct\":false},\"q9\":{\"jawaban\":\"\",\"is_correct\":false},\"q10\":{\"jawaban\":\"\",\"is_correct\":false}}','2026-06-08 02:12:04','2026-06-08 02:13:09','2026-06-08 02:13:09','2026-07-10 15:36:40'),(59,3,3,50,0,2,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"B\",\"is_correct\":false},\"q3\":{\"jawaban\":\"D\",\"is_correct\":false},\"q4\":{\"jawaban\":\"C\",\"is_correct\":false},\"q5\":{\"jawaban\":\"D\",\"is_correct\":true},\"q6\":{\"jawaban\":\"tet\",\"is_correct\":false},\"q7\":{\"jawaban\":\"ete\",\"is_correct\":false},\"q8\":{\"jawaban\":\"[2,5,8]\",\"is_correct\":true},\"q9\":{\"jawaban\":\"Benar\",\"is_correct\":true},\"q10\":{\"jawaban\":\"Salah\",\"is_correct\":true}}','2026-06-14 05:28:20','2026-06-14 05:29:11','2026-06-14 05:29:11','2026-06-14 05:29:11'),(60,3,3,100,1,3,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"C\",\"is_correct\":true},\"q3\":{\"jawaban\":\"B\",\"is_correct\":true},\"q4\":{\"jawaban\":\"B\",\"is_correct\":true},\"q5\":{\"jawaban\":\"D\",\"is_correct\":true},\"q6\":{\"jawaban\":\"descending\",\"is_correct\":true},\"q7\":{\"jawaban\":\"perbandingan\",\"is_correct\":true},\"q8\":{\"jawaban\":\"[2,5,8]\",\"is_correct\":true},\"q9\":{\"jawaban\":\"Benar\",\"is_correct\":true},\"q10\":{\"jawaban\":\"Salah\",\"is_correct\":true}}','2026-06-14 05:31:58','2026-06-14 05:34:15','2026-06-14 05:34:15','2026-06-14 05:34:15'),(69,2,12,100,1,1,'{\"q1\":{\"jawaban\":\"B\",\"is_correct\":true},\"q2\":{\"jawaban\":\"C\",\"is_correct\":true},\"q3\":{\"jawaban\":\"C\",\"is_correct\":true},\"q4\":{\"jawaban\":\"[2,3,5,7]\",\"is_correct\":true},\"q5\":{\"jawaban\":\"[9,6,5,1,4]\",\"is_correct\":true},\"q6\":{\"jawaban\":\"seleksi\",\"is_correct\":true},\"q7\":{\"jawaban\":\"n - 1\",\"is_correct\":true},\"q8\":{\"jawaban\":\"min_idx= i\",\"is_correct\":true},\"q9\":{\"jawaban\":\"<\",\"is_correct\":true},\"q10\":{\"jawaban\":\"Benar\",\"is_correct\":true}}','2026-06-25 13:57:53','2026-06-25 13:58:55','2026-06-25 13:58:55','2026-07-10 15:36:40'),(71,2,24,15,0,4,'{\"q1\":{\"jawaban\":\"D\",\"is_correct\":false},\"q2\":{\"jawaban\":\"B\",\"is_correct\":true},\"q3\":{\"jawaban\":\"A\",\"is_correct\":false},\"q4\":{\"jawaban\":\"C\",\"is_correct\":false},\"q5\":{\"jawaban\":\"A\",\"is_correct\":false},\"q6\":{\"jawaban\":\"B\",\"is_correct\":false},\"q7\":{\"jawaban\":\"B\",\"is_correct\":true},\"q8\":{\"jawaban\":\"D\",\"is_correct\":false},\"q9\":{\"jawaban\":\"B\",\"is_correct\":false},\"q10\":{\"jawaban\":\"A\",\"is_correct\":false},\"q11\":{\"jawaban\":\"C\",\"is_correct\":false},\"q12\":{\"jawaban\":\"A\",\"is_correct\":false},\"q13\":{\"jawaban\":\"A\",\"is_correct\":true},\"q14\":{\"jawaban\":\"A\",\"is_correct\":false},\"q15\":{\"jawaban\":\"A\",\"is_correct\":false},\"q16\":{\"jawaban\":\"B\",\"is_correct\":false},\"q17\":{\"jawaban\":\"A\",\"is_correct\":false},\"q18\":{\"jawaban\":\"C\",\"is_correct\":false},\"q19\":{\"jawaban\":\"A\",\"is_correct\":false},\"q20\":{\"jawaban\":\"A\",\"is_correct\":false}}','2026-06-26 00:17:37','2026-06-26 00:18:12','2026-06-26 00:18:12','2026-07-10 15:36:40'),(72,3,3,75,1,4,'{\"q1\":{\"id_soal\":93,\"nomor_soal\":1,\"pertanyaan\":\"Tujuan utama dari proses sorting dalam struktur data adalah ???\",\"opsi_a\":\"Menghapus data yang tidak diperlukan\",\"opsi_b\":\"menyusun data agar lebih mudah dicari dan diproses\",\"opsi_c\":\"mengamankan data di dalam memori komputer\",\"opsi_d\":\"menjumlahkan seluruh nilai dalam suatu daftar data\",\"opsi_e\":\"memperbesar kapasitas penyimpanan data dalam sistem\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q2\":{\"id_soal\":94,\"nomor_soal\":2,\"pertanyaan\":\"Contoh susunan data yang menunjukkan proses pengurutan secara ascending adalah ...\",\"opsi_a\":\"[9, 7, 5, 3]\",\"opsi_b\":\"[20, 15, 10, 5]\",\"opsi_c\":\"[1, 4, 7, 9]\",\"opsi_d\":\"[12, 10, 8, 6]\",\"opsi_e\":\"[30, 25, 20, 15]\",\"jawaban\":\"C\",\"jawaban_benar\":\"C\",\"is_correct\":true},\"q3\":{\"id_soal\":95,\"nomor_soal\":3,\"pertanyaan\":\"Dalam proses sorting, sort key adalah???\",\"opsi_a\":\"jumlah total elemen yang terdapat pada data\",\"opsi_b\":\"atribut atau nilai yang dijadikan dasar dalam proses pengurutan\",\"opsi_c\":\"indeks pertama yang terdapat pada array\",\"opsi_d\":\"nilai yang selalu ditempatkan pada posisi akhir setelah pengurutan\",\"opsi_e\":\"elemen yang memiliki nilai terbesar dalam kumpulan data\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q4\":{\"id_soal\":96,\"nomor_soal\":4,\"pertanyaan\":\"Jika data [7, 4, 6] diurutkan secara ascending, maka susunan data setelah satu kali pertukaran (swap) pertama adalah ...\",\"opsi_a\":\"[7, 4, 6]\",\"opsi_b\":\"[4, 7, 6]\",\"opsi_c\":\"[4, 6, 7]\",\"opsi_d\":\"[6, 4, 7]\",\"opsi_e\":\"[7, 6, 4]\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q5\":{\"id_soal\":97,\"nomor_soal\":5,\"pertanyaan\":\"Urutan langkah utama dalam proses sorting yang benar adalah ???\",\"opsi_a\":\"Menukar elemen - Membandingkan elemen - Data terurut\",\"opsi_b\":\"Membandingkan elemen - Data terurut - Menukar elemen\",\"opsi_c\":\"Data terurut - Membandingkan elemen - Menukar elemen\",\"opsi_d\":\"Membandingkan elemen - Menukar elemen - Data terurut\",\"opsi_e\":\"menyalin data - menghapus data - data terurut   \",\"jawaban\":\"D\",\"jawaban_benar\":\"D\",\"is_correct\":true},\"q6\":{\"id_soal\":98,\"nomor_soal\":6,\"pertanyaan\":\"Pengurutan data dari nilai terbesar ke terkecil disebut pengurutan __________.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"descending\",\"jawaban_benar\":\"descending\",\"is_correct\":true},\"q7\":{\"id_soal\":99,\"nomor_soal\":7,\"pertanyaan\":\"Dua operasi utama yang sering dianalisis dalam algoritma sorting adalah __________ dan pertukaran.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"perbandingan\",\"jawaban_benar\":\"perbandingan\",\"is_correct\":true},\"q8\":{\"id_soal\":100,\"nomor_soal\":8,\"pertanyaan\":\"Jika terdapat data [5,2,8], setelah 1 swap pertama menjadi...\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[2,5,8]\",\"jawaban_benar\":\"{\\\"source\\\":[5,2,8],\\\"correct\\\":[2,5,8]}\",\"is_correct\":true},\"q9\":{\"id_soal\":101,\"nomor_soal\":9,\"pertanyaan\":\"Bubble Sort memiliki kompleksitas ruang O(1) karena tidak membutuhkan memori tambahan.\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Salah\",\"jawaban_benar\":\"Benar\",\"is_correct\":false},\"q10\":{\"id_soal\":102,\"nomor_soal\":10,\"pertanyaan\":\"Algoritma dengan kompleksitas O(n??) sangat efisien untuk data berukuran besar.\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Benar\",\"jawaban_benar\":\"Salah\",\"is_correct\":false}}','2026-06-26 18:40:27','2026-06-26 18:41:32','2026-06-26 18:41:32','2026-06-26 18:41:32'),(73,2,7,30,0,5,'{\"q1\":{\"id_soal\":103,\"nomor_soal\":1,\"pertanyaan\":\"Prinsip utama kerja algoritma Bubble Sort adalah ...\",\"opsi_a\":\"Membagi data menjadi dua bagian\",\"opsi_b\":\"Membandingkan elemen yang bersebelahan dan menukarnya jika salah urut\",\"opsi_c\":\"Memilih elemen terkecil lalu memindahkannya ke depan\",\"opsi_d\":\"Menggunakan struktur data pohon dalam proses pengurutan\",\"opsi_e\":\"menyisipkan elemen ke posisi yang sesuai pada bagian data yang telah terurut\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q2\":{\"id_soal\":104,\"nomor_soal\":2,\"pertanyaan\":\"Pada Bubble Sort, setelah satu iterasi penuh, elemen yang pasti berada pada posisi yang benar adalah ...\",\"opsi_a\":\"Elemen terkecil\",\"opsi_b\":\"Elemen dengan posisi acak\",\"opsi_c\":\"Elemen Terbesar\",\"opsi_d\":\"Seluruh elemen langsung terurut sempurna\",\"opsi_e\":\"Elemen yang pertama kali dibandingkan\",\"jawaban\":\"C\",\"jawaban_benar\":\"c\",\"is_correct\":true},\"q3\":{\"id_soal\":105,\"nomor_soal\":3,\"pertanyaan\":\"Perhatikan potongan kode berikut:\\n\\nfor j in range(0, i):\\n    if data[j] > data[j+1]:\\n        data[j], data[j+1] = data[j+1], data[j]\\n\\nKode tersebut berfungsi untuk...\",\"opsi_a\":\"Menentukan batas jumlah iterasi pada proses pengurutan\",\"opsi_b\":\"Membandingkan dan menukar elemen bersebelahan\",\"opsi_c\":\"Mengurutkan seluruh elemen list secara langsung tanpa perbandingan\",\"opsi_d\":\"Mencetak hasil pengurutan pada setiap iterasi\",\"opsi_e\":\"Membagi list menjadi dua bagian yang lebih kecil secara otomatis\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q4\":{\"id_soal\":106,\"nomor_soal\":4,\"pertanyaan\":\"Urutkan deret bilangan [4, 2, 5, 1, 6] pada iterasi pertama menggunakan Bubble Sort (Ascending).\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[2,4,5,1,6]\",\"jawaban_benar\":\"{\\\"source\\\":[4,2,5,1,6],\\\"correct\\\":[2,4,1,5,6]}\",\"is_correct\":false},\"q5\":{\"id_soal\":107,\"nomor_soal\":5,\"pertanyaan\":\"Urutkan deret bilangan [3, 6, 2, 5] pada iterasi kedua menggunakan Bubble Sort (Descending).\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[3,6,2,5]\",\"jawaban_benar\":\"{\\\"source\\\":[3,6,2,5],\\\"correct\\\":[6,5,3,2]}\",\"is_correct\":false},\"q6\":{\"id_soal\":108,\"nomor_soal\":6,\"pertanyaan\":\"Lengkapilah potongan kode berikut agar proses pertukaran (swap) berjalan dengan benar:\\r\\n\\r\\ntemp = ______\\r\\ndata[j] = data[j+1]\\r\\ndata[j+1] = temp\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"\",\"jawaban_benar\":\"data[j]\",\"is_correct\":false},\"q7\":{\"id_soal\":109,\"nomor_soal\":7,\"pertanyaan\":\"Lengkapilah operator perbandingan berikut agar Bubble Sort mengurutkan data secara ascending:\\r\\n\\r\\nif data[j] ______ data[j+1]:\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"\",\"jawaban_benar\":\">\",\"is_correct\":false},\"q8\":{\"id_soal\":110,\"nomor_soal\":8,\"pertanyaan\":\"Bubble Sort tetap melakukan perbandingan meskipun data sudah terurut.\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"\",\"jawaban_benar\":\"Benar\",\"is_correct\":false},\"q9\":{\"id_soal\":111,\"nomor_soal\":9,\"pertanyaan\":\"Bubble Sort sangat efisien untuk data berukuran besar karena memiliki kompleksitas O(n log n).\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"\",\"jawaban_benar\":\"Salah\",\"is_correct\":false},\"q10\":{\"id_soal\":112,\"nomor_soal\":10,\"pertanyaan\":\"Setiap satu kali pemeriksaan seluruh elemen data pada Bubble Sort disebut satu ________.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"\",\"jawaban_benar\":\"iterasi\",\"is_correct\":false}}','2026-06-29 02:26:09','2026-06-29 02:27:13','2026-06-29 02:27:13','2026-07-10 15:36:40'),(74,2,12,75,1,2,'{\"q1\":{\"id_soal\":113,\"nomor_soal\":1,\"pertanyaan\":\"Prinsip utama algoritma Selection Sort adalah ...\",\"opsi_a\":\"Menukar elemen yang bersebelahan secara berulang\",\"opsi_b\":\"Memilih elemen terkecil atau terbesar dari data yang belum terurut dan menempatkannya di posisi yang sesuai\",\"opsi_c\":\"Membagi data menjadi dua bagian yang sama besar\",\"opsi_d\":\"Mengurutkan data menggunakan rekursi secara penuh\",\"opsi_e\":\"menyisipkan elemen ke bagian data yang telah terurut\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q2\":{\"id_soal\":114,\"nomor_soal\":2,\"pertanyaan\":\"Pada Selection Sort (ascending), elemen yang dipilih pada setiap iterasi adalah ...\",\"opsi_a\":\"Elemen terbesar dari seluruh data\",\"opsi_b\":\"Elemen tengah dari kumpulan data\",\"opsi_c\":\"Elemen terkecil dari bagian data yang belum terurut\",\"opsi_d\":\"Elemen terakhir dari kumpulan data\",\"opsi_e\":\"elemen pertama yang dibandingkan pada se    tiap iterasi    \",\"jawaban\":\"C\",\"jawaban_benar\":\"C\",\"is_correct\":true},\"q3\":{\"id_soal\":115,\"nomor_soal\":3,\"pertanyaan\":\"Kompleksitas waktu algoritma Selection Sort adalah ...\",\"opsi_a\":\"O(n)\",\"opsi_b\":\"O(log n)\",\"opsi_c\":\"O(n??)\",\"opsi_d\":\"O(n log n)\",\"opsi_e\":\"O(1)\",\"jawaban\":\"C\",\"jawaban_benar\":\"C\",\"is_correct\":true},\"q4\":{\"id_soal\":116,\"nomor_soal\":4,\"pertanyaan\":\"Diberikan data awal:\\n\\n[7, 3, 5, 2]\\n\\nSusun hasil data setelah iterasi ke-1 algoritma Selection Sort (ascending).\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[2,7,3,5]\",\"jawaban_benar\":\"{\\\"source\\\":[7,3,5,2],\\\"correct\\\":[2,3,5,7]}\",\"is_correct\":false},\"q5\":{\"id_soal\":117,\"nomor_soal\":5,\"pertanyaan\":\"Diberikan data awal:\\n\\n[6, 4, 9, 1, 5]\\n\\nSusun hasil data setelah iterasi ke-3 algoritma Selection Sort (descending).\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[1,4,5,6,9]\",\"jawaban_benar\":\"{\\\"source\\\":[6,4,9,1,5],\\\"correct\\\":[9,6,5,1,4]}\",\"is_correct\":false},\"q6\":{\"id_soal\":118,\"nomor_soal\":6,\"pertanyaan\":\"Selection Sort dinamakan demikian karena pada setiap iterasi melakukan proses ______ terhadap suatu elemen.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"seleksi\",\"jawaban_benar\":\"seleksi\",\"is_correct\":true},\"q7\":{\"id_soal\":119,\"nomor_soal\":7,\"pertanyaan\":\"Jumlah maksimum pertukaran (swap) pada algoritma Selection Sort untuk n data adalah sebanyak ______.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"n-1\",\"jawaban_benar\":\"n - 1\",\"is_correct\":true},\"q8\":{\"id_soal\":120,\"nomor_soal\":8,\"pertanyaan\":\"Lengkapilah potongan kode Python berikut agar Selection Sort dapat berjalan dengan benar (ascending).\\n\\nfor i in range(len(data)):\\n    ______\\n    for j in range(i+1, len(data)):\\n        if data[j] < data[min_idx]:\\n            min_idx = j\\n    data[i], data[min_idx] = data[min_idx], data[i]\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"min_idx = i\",\"jawaban_benar\":\"min_idx=i\",\"is_correct\":true},\"q9\":{\"id_soal\":121,\"nomor_soal\":9,\"pertanyaan\":\"Lengkapilah potongan kode Python berikut agar Selection Sort dapat berjalan dengan benar (ascending).\\n\\nfor i in range(len(data)):\\n    min_idx = i\\n    for j in range(i+1, len(data)):\\n        if data[j] ______ data[min_idx]:\\n            min_idx = j\\n    data[i], data[min_idx] = data[min_idx], data[i]\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"<\",\"jawaban_benar\":\"<\",\"is_correct\":true},\"q10\":{\"id_soal\":122,\"nomor_soal\":10,\"pertanyaan\":\"Selection Sort melakukan lebih sedikit pertukaran dibanding Bubble Sort, tetapi tetap memiliki kompleksitas waktu O(n??).\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Benar\",\"jawaban_benar\":\"Benar\",\"is_correct\":true}}','2026-07-03 22:34:03','2026-07-03 22:35:47','2026-07-03 22:35:47','2026-07-10 15:36:40'),(75,2,12,75,1,3,'{\"q1\":{\"id_soal\":113,\"nomor_soal\":1,\"pertanyaan\":\"Prinsip utama algoritma Selection Sort adalah ...\",\"opsi_a\":\"Menukar elemen yang bersebelahan secara berulang\",\"opsi_b\":\"Memilih elemen terkecil atau terbesar dari data yang belum terurut dan menempatkannya di posisi yang sesuai\",\"opsi_c\":\"Membagi data menjadi dua bagian yang sama besar\",\"opsi_d\":\"Mengurutkan data menggunakan rekursi secara penuh\",\"opsi_e\":\"menyisipkan elemen ke bagian data yang telah terurut\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q2\":{\"id_soal\":114,\"nomor_soal\":2,\"pertanyaan\":\"Pada Selection Sort (ascending), elemen yang dipilih pada setiap iterasi adalah ...\",\"opsi_a\":\"Elemen terbesar dari seluruh data\",\"opsi_b\":\"Elemen tengah dari kumpulan data\",\"opsi_c\":\"Elemen terkecil dari bagian data yang belum terurut\",\"opsi_d\":\"Elemen terakhir dari kumpulan data\",\"opsi_e\":\"elemen pertama yang dibandingkan pada se    tiap iterasi    \",\"jawaban\":\"C\",\"jawaban_benar\":\"C\",\"is_correct\":true},\"q3\":{\"id_soal\":115,\"nomor_soal\":3,\"pertanyaan\":\"Kompleksitas waktu algoritma Selection Sort adalah ...\",\"opsi_a\":\"O(n)\",\"opsi_b\":\"O(log n)\",\"opsi_c\":\"O(n??)\",\"opsi_d\":\"O(n log n)\",\"opsi_e\":\"O(1)\",\"jawaban\":\"C\",\"jawaban_benar\":\"C\",\"is_correct\":true},\"q4\":{\"id_soal\":116,\"nomor_soal\":4,\"pertanyaan\":\"Diberikan data awal:\\n\\n[7, 3, 5, 2]\\n\\nSusun hasil data setelah iterasi ke-1 algoritma Selection Sort (ascending).\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[2,3,5,7]\",\"jawaban_benar\":\"{\\\"source\\\":[7,3,5,2],\\\"correct\\\":[2,3,5,7]}\",\"is_correct\":true},\"q5\":{\"id_soal\":117,\"nomor_soal\":5,\"pertanyaan\":\"Diberikan data awal:\\n\\n[6, 4, 9, 1, 5]\\n\\nSusun hasil data setelah iterasi ke-3 algoritma Selection Sort (descending).\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[9,6,5,1,4]\",\"jawaban_benar\":\"{\\\"source\\\":[6,4,9,1,5],\\\"correct\\\":[9,6,5,1,4]}\",\"is_correct\":true},\"q6\":{\"id_soal\":118,\"nomor_soal\":6,\"pertanyaan\":\"Selection Sort dinamakan demikian karena pada setiap iterasi melakukan proses ______ terhadap suatu elemen.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"seleksi\",\"jawaban_benar\":\"seleksi\",\"is_correct\":true},\"q7\":{\"id_soal\":119,\"nomor_soal\":7,\"pertanyaan\":\"Jumlah maksimum pertukaran (swap) pada algoritma Selection Sort untuk n data adalah sebanyak ______.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"n-1\",\"jawaban_benar\":\"n - 1\",\"is_correct\":true},\"q8\":{\"id_soal\":120,\"nomor_soal\":8,\"pertanyaan\":\"Lengkapilah potongan kode Python berikut agar Selection Sort dapat berjalan dengan benar (ascending).\\n\\nfor i in range(len(data)):\\n    ______\\n    for j in range(i+1, len(data)):\\n        if data[j] < data[min_idx]:\\n            min_idx = j\\n    data[i], data[min_idx] = data[min_idx], data[i]\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"min_idx = i\",\"jawaban_benar\":\"min_idx=i\",\"is_correct\":true},\"q9\":{\"id_soal\":121,\"nomor_soal\":9,\"pertanyaan\":\"Lengkapilah potongan kode Python berikut agar Selection Sort dapat berjalan dengan benar (ascending).\\n\\nfor i in range(len(data)):\\n    min_idx = i\\n    for j in range(i+1, len(data)):\\n        if data[j] ______ data[min_idx]:\\n            min_idx = j\\n    data[i], data[min_idx] = data[min_idx], data[i]\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"<\",\"jawaban_benar\":\"<\",\"is_correct\":true},\"q10\":{\"id_soal\":122,\"nomor_soal\":10,\"pertanyaan\":\"Selection Sort melakukan lebih sedikit pertukaran dibanding Bubble Sort, tetapi tetap memiliki kompleksitas waktu O(n??).\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Benar\",\"jawaban_benar\":\"Benar\",\"is_correct\":true}}','2026-07-05 13:25:20','2026-07-05 13:26:34','2026-07-05 13:26:34','2026-07-10 15:36:40'),(76,2,12,40,0,4,'{\"q1\":{\"id_soal\":113,\"nomor_soal\":1,\"pertanyaan\":\"Prinsip utama algoritma Selection Sort adalah ...\",\"opsi_a\":\"Menukar elemen yang bersebelahan secara berulang\",\"opsi_b\":\"Memilih elemen terkecil atau terbesar dari data yang belum terurut dan menempatkannya di posisi yang sesuai\",\"opsi_c\":\"Membagi data menjadi dua bagian yang sama besar\",\"opsi_d\":\"Mengurutkan data menggunakan rekursi secara penuh\",\"opsi_e\":\"menyisipkan elemen ke bagian data yang telah terurut\",\"jawaban\":\"D\",\"jawaban_benar\":\"B\",\"is_correct\":false},\"q2\":{\"id_soal\":114,\"nomor_soal\":2,\"pertanyaan\":\"Pada Selection Sort (ascending), elemen yang dipilih pada setiap iterasi adalah ...\",\"opsi_a\":\"Elemen terbesar dari seluruh data\",\"opsi_b\":\"Elemen tengah dari kumpulan data\",\"opsi_c\":\"Elemen terkecil dari bagian data yang belum terurut\",\"opsi_d\":\"Elemen terakhir dari kumpulan data\",\"opsi_e\":\"elemen pertama yang dibandingkan pada se    tiap iterasi    \",\"jawaban\":\"A\",\"jawaban_benar\":\"C\",\"is_correct\":false},\"q3\":{\"id_soal\":115,\"nomor_soal\":3,\"pertanyaan\":\"Kompleksitas waktu algoritma Selection Sort adalah ...\",\"opsi_a\":\"O(n)\",\"opsi_b\":\"O(log n)\",\"opsi_c\":\"O(n??)\",\"opsi_d\":\"O(n log n)\",\"opsi_e\":\"O(1)\",\"jawaban\":\"A\",\"jawaban_benar\":\"C\",\"is_correct\":false},\"q4\":{\"id_soal\":116,\"nomor_soal\":4,\"pertanyaan\":\"Diberikan data awal:\\n\\n[7, 3, 5, 2]\\n\\nSusun hasil data setelah iterasi ke-1 algoritma Selection Sort (ascending).\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[7,3,5,2]\",\"jawaban_benar\":\"{\\\"source\\\":[7,3,5,2],\\\"correct\\\":[2,3,5,7]}\",\"is_correct\":false},\"q5\":{\"id_soal\":117,\"nomor_soal\":5,\"pertanyaan\":\"Diberikan data awal:\\n\\n[6, 4, 9, 1, 5]\\n\\nSusun hasil data setelah iterasi ke-3 algoritma Selection Sort (descending).\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[4,6,9,1,5]\",\"jawaban_benar\":\"{\\\"source\\\":[6,4,9,1,5],\\\"correct\\\":[9,6,5,1,4]}\",\"is_correct\":false},\"q6\":{\"id_soal\":118,\"nomor_soal\":6,\"pertanyaan\":\"Selection Sort dinamakan demikian karena pada setiap iterasi melakukan proses ______ terhadap suatu elemen.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"swap\",\"jawaban_benar\":\"seleksi\",\"is_correct\":false},\"q7\":{\"id_soal\":119,\"nomor_soal\":7,\"pertanyaan\":\"Jumlah maksimum pertukaran (swap) pada algoritma Selection Sort untuk n data adalah sebanyak ______.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"n-1\",\"jawaban_benar\":\"n - 1\",\"is_correct\":true},\"q8\":{\"id_soal\":120,\"nomor_soal\":8,\"pertanyaan\":\"Lengkapilah potongan kode Python berikut agar Selection Sort dapat berjalan dengan benar (ascending).\\n\\nfor i in range(len(data)):\\n    ______\\n    for j in range(i+1, len(data)):\\n        if data[j] < data[min_idx]:\\n            min_idx = j\\n    data[i], data[min_idx] = data[min_idx], data[i]\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"min_idx = i\",\"jawaban_benar\":\"min_idx=i\",\"is_correct\":true},\"q9\":{\"id_soal\":121,\"nomor_soal\":9,\"pertanyaan\":\"Lengkapilah potongan kode Python berikut agar Selection Sort dapat berjalan dengan benar (ascending).\\n\\nfor i in range(len(data)):\\n    min_idx = i\\n    for j in range(i+1, len(data)):\\n        if data[j] ______ data[min_idx]:\\n            min_idx = j\\n    data[i], data[min_idx] = data[min_idx], data[i]\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"<\",\"jawaban_benar\":\"<\",\"is_correct\":true},\"q10\":{\"id_soal\":122,\"nomor_soal\":10,\"pertanyaan\":\"Selection Sort melakukan lebih sedikit pertukaran dibanding Bubble Sort, tetapi tetap memiliki kompleksitas waktu O(n??).\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Benar\",\"jawaban_benar\":\"Benar\",\"is_correct\":true}}','2026-07-05 13:27:14','2026-07-05 13:28:01','2026-07-05 13:28:01','2026-07-10 15:36:40'),(77,25,3,30,0,1,'{\"q1\":{\"id_soal\":93,\"nomor_soal\":1,\"pertanyaan\":\"Tujuan utama dari proses sorting dalam struktur data adalah ???\",\"opsi_a\":\"Menghapus data yang tidak diperlukan\",\"opsi_b\":\"menyusun data agar lebih mudah dicari dan diproses\",\"opsi_c\":\"mengamankan data di dalam memori komputer\",\"opsi_d\":\"menjumlahkan seluruh nilai dalam suatu daftar data\",\"opsi_e\":\"memperbesar kapasitas penyimpanan data dalam sistem\",\"jawaban\":\"A\",\"jawaban_benar\":\"B\",\"is_correct\":false},\"q2\":{\"id_soal\":94,\"nomor_soal\":2,\"pertanyaan\":\"Contoh susunan data yang menunjukkan proses pengurutan secara ascending adalah ...\",\"opsi_a\":\"[9, 7, 5, 3]\",\"opsi_b\":\"[20, 15, 10, 5]\",\"opsi_c\":\"[1, 4, 7, 9]\",\"opsi_d\":\"[12, 10, 8, 6]\",\"opsi_e\":\"[30, 25, 20, 15]\",\"jawaban\":\"C\",\"jawaban_benar\":\"C\",\"is_correct\":true},\"q3\":{\"id_soal\":95,\"nomor_soal\":3,\"pertanyaan\":\"Dalam proses sorting, sort key adalah???\",\"opsi_a\":\"jumlah total elemen yang terdapat pada data\",\"opsi_b\":\"atribut atau nilai yang dijadikan dasar dalam proses pengurutan\",\"opsi_c\":\"indeks pertama yang terdapat pada array\",\"opsi_d\":\"nilai yang selalu ditempatkan pada posisi akhir setelah pengurutan\",\"opsi_e\":\"elemen yang memiliki nilai terbesar dalam kumpulan data\",\"jawaban\":\"E\",\"jawaban_benar\":\"B\",\"is_correct\":false},\"q4\":{\"id_soal\":96,\"nomor_soal\":4,\"pertanyaan\":\"Jika data [7, 4, 6] diurutkan secara ascending, maka susunan data setelah satu kali pertukaran (swap) pertama adalah ...\",\"opsi_a\":\"[7, 4, 6]\",\"opsi_b\":\"[4, 7, 6]\",\"opsi_c\":\"[4, 6, 7]\",\"opsi_d\":\"[6, 4, 7]\",\"opsi_e\":\"[7, 6, 4]\",\"jawaban\":\"A\",\"jawaban_benar\":\"B\",\"is_correct\":false},\"q5\":{\"id_soal\":97,\"nomor_soal\":5,\"pertanyaan\":\"Urutan langkah utama dalam proses sorting yang benar adalah ???\",\"opsi_a\":\"Menukar elemen - Membandingkan elemen - Data terurut\",\"opsi_b\":\"Membandingkan elemen - Data terurut - Menukar elemen\",\"opsi_c\":\"Data terurut - Membandingkan elemen - Menukar elemen\",\"opsi_d\":\"Membandingkan elemen - Menukar elemen - Data terurut\",\"opsi_e\":\"menyalin data - menghapus data - data terurut   \",\"jawaban\":\"C\",\"jawaban_benar\":\"D\",\"is_correct\":false},\"q6\":{\"id_soal\":98,\"nomor_soal\":6,\"pertanyaan\":\"Pengurutan data dari nilai terbesar ke terkecil disebut pengurutan __________.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"tet\",\"jawaban_benar\":\"descending\",\"is_correct\":false},\"q7\":{\"id_soal\":99,\"nomor_soal\":7,\"pertanyaan\":\"Dua operasi utama yang sering dianalisis dalam algoritma sorting adalah __________ dan pertukaran.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"u5\",\"jawaban_benar\":\"perbandingan\",\"is_correct\":false},\"q8\":{\"id_soal\":100,\"nomor_soal\":8,\"pertanyaan\":\"Jika terdapat data [5,2,8], setelah 1 swap pertama menjadi...\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[5,2,8]\",\"jawaban_benar\":\"{\\\"source\\\":[5,2,8],\\\"correct\\\":[2,5,8]}\",\"is_correct\":false},\"q9\":{\"id_soal\":101,\"nomor_soal\":9,\"pertanyaan\":\"Bubble Sort memiliki kompleksitas ruang O(1) karena tidak membutuhkan memori tambahan.\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Benar\",\"jawaban_benar\":\"Benar\",\"is_correct\":true},\"q10\":{\"id_soal\":102,\"nomor_soal\":10,\"pertanyaan\":\"Algoritma dengan kompleksitas O(n??) sangat efisien untuk data berukuran besar.\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Salah\",\"jawaban_benar\":\"Salah\",\"is_correct\":true}}','2026-07-10 14:58:07','2026-07-10 14:58:29','2026-07-10 14:58:29','2026-07-10 15:36:40'),(78,25,3,75,1,2,'{\"q1\":{\"id_soal\":93,\"nomor_soal\":1,\"pertanyaan\":\"Tujuan utama dari proses sorting dalam struktur data adalah ???\",\"opsi_a\":\"Menghapus data yang tidak diperlukan\",\"opsi_b\":\"menyusun data agar lebih mudah dicari dan diproses\",\"opsi_c\":\"mengamankan data di dalam memori komputer\",\"opsi_d\":\"menjumlahkan seluruh nilai dalam suatu daftar data\",\"opsi_e\":\"memperbesar kapasitas penyimpanan data dalam sistem\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q2\":{\"id_soal\":94,\"nomor_soal\":2,\"pertanyaan\":\"Contoh susunan data yang menunjukkan proses pengurutan secara ascending adalah ...\",\"opsi_a\":\"[9, 7, 5, 3]\",\"opsi_b\":\"[20, 15, 10, 5]\",\"opsi_c\":\"[1, 4, 7, 9]\",\"opsi_d\":\"[12, 10, 8, 6]\",\"opsi_e\":\"[30, 25, 20, 15]\",\"jawaban\":\"C\",\"jawaban_benar\":\"C\",\"is_correct\":true},\"q3\":{\"id_soal\":95,\"nomor_soal\":3,\"pertanyaan\":\"Dalam proses sorting, sort key adalah???\",\"opsi_a\":\"jumlah total elemen yang terdapat pada data\",\"opsi_b\":\"atribut atau nilai yang dijadikan dasar dalam proses pengurutan\",\"opsi_c\":\"indeks pertama yang terdapat pada array\",\"opsi_d\":\"nilai yang selalu ditempatkan pada posisi akhir setelah pengurutan\",\"opsi_e\":\"elemen yang memiliki nilai terbesar dalam kumpulan data\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q4\":{\"id_soal\":96,\"nomor_soal\":4,\"pertanyaan\":\"Jika data [7, 4, 6] diurutkan secara ascending, maka susunan data setelah satu kali pertukaran (swap) pertama adalah ...\",\"opsi_a\":\"[7, 4, 6]\",\"opsi_b\":\"[4, 7, 6]\",\"opsi_c\":\"[4, 6, 7]\",\"opsi_d\":\"[6, 4, 7]\",\"opsi_e\":\"[7, 6, 4]\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q5\":{\"id_soal\":97,\"nomor_soal\":5,\"pertanyaan\":\"Urutan langkah utama dalam proses sorting yang benar adalah ???\",\"opsi_a\":\"Menukar elemen - Membandingkan elemen - Data terurut\",\"opsi_b\":\"Membandingkan elemen - Data terurut - Menukar elemen\",\"opsi_c\":\"Data terurut - Membandingkan elemen - Menukar elemen\",\"opsi_d\":\"Membandingkan elemen - Menukar elemen - Data terurut\",\"opsi_e\":\"menyalin data - menghapus data - data terurut   \",\"jawaban\":\"D\",\"jawaban_benar\":\"D\",\"is_correct\":true},\"q6\":{\"id_soal\":98,\"nomor_soal\":6,\"pertanyaan\":\"Pengurutan data dari nilai terbesar ke terkecil disebut pengurutan __________.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"descending\",\"jawaban_benar\":\"descending\",\"is_correct\":true},\"q7\":{\"id_soal\":99,\"nomor_soal\":7,\"pertanyaan\":\"Dua operasi utama yang sering dianalisis dalam algoritma sorting adalah __________ dan pertukaran.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"perbandingan\",\"jawaban_benar\":\"perbandingan\",\"is_correct\":true},\"q8\":{\"id_soal\":100,\"nomor_soal\":8,\"pertanyaan\":\"Jika terdapat data [5,2,8], setelah 1 swap pertama menjadi...\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[2,5,8]\",\"jawaban_benar\":\"{\\\"source\\\":[5,2,8],\\\"correct\\\":[2,5,8]}\",\"is_correct\":true},\"q9\":{\"id_soal\":101,\"nomor_soal\":9,\"pertanyaan\":\"Bubble Sort memiliki kompleksitas ruang O(1) karena tidak membutuhkan memori tambahan.\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Benar\",\"jawaban_benar\":\"Benar\",\"is_correct\":true},\"q10\":{\"id_soal\":102,\"nomor_soal\":10,\"pertanyaan\":\"Algoritma dengan kompleksitas O(n??) sangat efisien untuk data berukuran besar.\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Salah\",\"jawaban_benar\":\"Salah\",\"is_correct\":true}}','2026-07-10 15:14:59','2026-07-10 15:15:57','2026-07-10 15:15:57','2026-07-10 15:36:40'),(79,2,7,40,0,6,'{\"q1\":{\"id_soal\":103,\"nomor_soal\":1,\"pertanyaan\":\"Prinsip utama kerja algoritma Bubble Sort adalah ...\",\"opsi_a\":\"Membagi data menjadi dua bagian\",\"opsi_b\":\"Membandingkan elemen yang bersebelahan dan menukarnya jika salah urut\",\"opsi_c\":\"Memilih elemen terkecil lalu memindahkannya ke depan\",\"opsi_d\":\"Menggunakan struktur data pohon dalam proses pengurutan\",\"opsi_e\":\"menyisipkan elemen ke posisi yang sesuai pada bagian data yang telah terurut\",\"jawaban\":\"A\",\"jawaban_benar\":\"B\",\"is_correct\":false},\"q2\":{\"id_soal\":104,\"nomor_soal\":2,\"pertanyaan\":\"Pada Bubble Sort, setelah satu iterasi penuh, elemen yang pasti berada pada posisi yang benar adalah ...\",\"opsi_a\":\"Elemen terkecil\",\"opsi_b\":\"Elemen dengan posisi acak\",\"opsi_c\":\"Elemen Terbesar\",\"opsi_d\":\"Seluruh elemen langsung terurut sempurna\",\"opsi_e\":\"Elemen yang pertama kali dibandingkan\",\"jawaban\":\"C\",\"jawaban_benar\":\"c\",\"is_correct\":true},\"q3\":{\"id_soal\":105,\"nomor_soal\":3,\"pertanyaan\":\"Perhatikan potongan kode berikut:\\n\\nfor j in range(0, i):\\n    if data[j] > data[j+1]:\\n        data[j], data[j+1] = data[j+1], data[j]\\n\\nKode tersebut berfungsi untuk...\",\"opsi_a\":\"Menentukan batas jumlah iterasi pada proses pengurutan\",\"opsi_b\":\"Membandingkan dan menukar elemen bersebelahan\",\"opsi_c\":\"Mengurutkan seluruh elemen list secara langsung tanpa perbandingan\",\"opsi_d\":\"Mencetak hasil pengurutan pada setiap iterasi\",\"opsi_e\":\"Membagi list menjadi dua bagian yang lebih kecil secara otomatis\",\"jawaban\":\"B\",\"jawaban_benar\":\"B\",\"is_correct\":true},\"q4\":{\"id_soal\":106,\"nomor_soal\":4,\"pertanyaan\":\"Urutkan deret bilangan [4, 2, 5, 1, 6] pada iterasi pertama menggunakan Bubble Sort (Ascending).\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[4,2,5,1,6]\",\"jawaban_benar\":\"{\\\"source\\\":[4,2,5,1,6],\\\"correct\\\":[2,4,1,5,6]}\",\"is_correct\":false},\"q5\":{\"id_soal\":107,\"nomor_soal\":5,\"pertanyaan\":\"Urutkan deret bilangan [3, 6, 2, 5] pada iterasi kedua menggunakan Bubble Sort (Descending).\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"[6,3,2,5]\",\"jawaban_benar\":\"{\\\"source\\\":[3,6,2,5],\\\"correct\\\":[6,5,3,2]}\",\"is_correct\":false},\"q6\":{\"id_soal\":108,\"nomor_soal\":6,\"pertanyaan\":\"Lengkapilah potongan kode berikut agar proses pertukaran (swap) berjalan dengan benar:\\r\\n\\r\\ntemp = ______\\r\\ndata[j] = data[j+1]\\r\\ndata[j+1] = temp\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"seleksi\",\"jawaban_benar\":\"data[j]\",\"is_correct\":false},\"q7\":{\"id_soal\":109,\"nomor_soal\":7,\"pertanyaan\":\"Lengkapilah operator perbandingan berikut agar Bubble Sort mengurutkan data secara ascending:\\r\\n\\r\\nif data[j] ______ data[j+1]:\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"hi\",\"jawaban_benar\":\">\",\"is_correct\":false},\"q8\":{\"id_soal\":110,\"nomor_soal\":8,\"pertanyaan\":\"Bubble Sort tetap melakukan perbandingan meskipun data sudah terurut.\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Benar\",\"jawaban_benar\":\"Benar\",\"is_correct\":true},\"q9\":{\"id_soal\":111,\"nomor_soal\":9,\"pertanyaan\":\"Bubble Sort sangat efisien untuk data berukuran besar karena memiliki kompleksitas O(n log n).\",\"opsi_a\":\"Benar\",\"opsi_b\":\"Salah\",\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"Salah\",\"jawaban_benar\":\"Salah\",\"is_correct\":true},\"q10\":{\"id_soal\":112,\"nomor_soal\":10,\"pertanyaan\":\"Setiap satu kali pemeriksaan seluruh elemen data pada Bubble Sort disebut satu ________.\",\"opsi_a\":null,\"opsi_b\":null,\"opsi_c\":null,\"opsi_d\":null,\"opsi_e\":null,\"jawaban\":\"\",\"jawaban_benar\":\"iterasi\",\"is_correct\":false}}','2026-07-13 01:33:59','2026-07-13 01:35:03','2026-07-13 01:35:03','2026-07-13 01:35:03');
/*!40000 ALTER TABLE `jawaban_mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_dosen` bigint unsigned NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ajaran` int DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelas_id_dosen_foreign` (`id_dosen`),
  CONSTRAINT `kelas_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` VALUES (2,1,'Struktur Data - A1',2026,'A1STD','2026-03-06 21:57:01','2026-03-06 21:57:01'),(3,1,'Struktur Data - A2',2025,'KDKFMK','2026-03-08 20:12:00','2026-03-08 21:10:57'),(4,1,'Struktur Data - A4',NULL,'00C0R3','2026-03-08 20:12:53','2026-07-12 16:28:37'),(6,1,'Struktur Data - A5',2027,'160FF7','2026-07-12 16:29:03','2026-07-12 16:29:03');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mahasiswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint unsigned NOT NULL,
  `id_kelas` bigint unsigned NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `angkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mahasiswa_nim_unique` (`nim`),
  KEY `mahasiswa_id_user_foreign` (`id_user`),
  KEY `mahasiswa_id_kelas_foreign` (`id_kelas`),
  CONSTRAINT `mahasiswa_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mahasiswa_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mahasiswa`
--

LOCK TABLES `mahasiswa` WRITE;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` VALUES (2,2,2,'2210131210012','2022','1778511458_2.jpg','2026-03-09 06:50:14','2026-05-11 13:57:38'),(3,5,3,'2210131210016','2020',NULL,'2026-03-12 07:27:55','2026-03-12 07:27:55'),(6,10,2,'221013121002','2022',NULL,'2026-06-04 12:36:52','2026-06-04 12:36:52'),(7,11,2,'221013121003','2022',NULL,'2026-06-04 12:36:52','2026-06-04 12:36:52'),(8,12,2,'221013121004','2022',NULL,'2026-06-04 12:36:52','2026-06-04 12:36:52'),(9,13,2,'221013121005','2022',NULL,'2026-06-04 12:36:53','2026-06-04 12:36:53'),(10,14,2,'221013121006','2022',NULL,'2026-06-04 12:36:53','2026-06-04 12:36:53'),(11,15,2,'221013121007','2022',NULL,'2026-06-04 12:36:53','2026-06-04 12:36:53'),(12,16,2,'221013121008','2022',NULL,'2026-06-04 12:36:53','2026-06-04 12:36:53'),(13,17,2,'221013121009','2022',NULL,'2026-06-04 12:36:54','2026-06-04 12:36:54'),(14,18,2,'221013121010','2022',NULL,'2026-06-04 12:36:54','2026-06-04 12:36:54'),(15,20,3,'221013121011','2022',NULL,'2026-06-04 12:39:51','2026-06-04 12:39:51'),(16,21,3,'221013121012','2022',NULL,'2026-06-04 12:39:52','2026-06-04 12:39:52'),(17,22,3,'221013121013','2022',NULL,'2026-06-04 12:39:52','2026-06-04 12:39:52'),(18,23,3,'221013121014','2022',NULL,'2026-06-04 12:39:52','2026-06-04 12:39:52'),(19,24,3,'221013121015','2022',NULL,'2026-06-04 12:39:52','2026-06-04 12:39:52'),(20,25,3,'221013121016','2022',NULL,'2026-06-04 12:39:53','2026-06-04 12:39:53'),(21,26,3,'221013121017','2022',NULL,'2026-06-04 12:39:53','2026-06-04 12:39:53'),(22,27,3,'221013121018','2022',NULL,'2026-06-04 12:39:53','2026-06-04 12:39:53'),(23,28,3,'221013121019','2022',NULL,'2026-06-04 12:39:53','2026-06-04 12:39:53'),(24,29,3,'221013121020','2022',NULL,'2026-06-04 12:39:54','2026-06-04 12:39:54'),(25,30,2,'2210131110012','2025',NULL,'2026-07-10 12:16:05','2026-07-10 12:16:05');
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_02_13_062023_create_dosen_table',1),(5,'2026_02_13_062043_create_kelas_table',1),(6,'2026_02_13_062121_create_mahasiswa_table',1),(7,'2026_02_24_032604_create_aktivitas_table',1),(8,'2026_02_24_061130_create_butir_soal_table',1),(9,'2026_02_24_061603_crete_jawaban_mahasiswa_table',1),(10,'2026_02_24_061618_crete_setting_table',1),(12,'2026_03_03_144105_create_praktikum_table',1),(15,'2026_03_03_144258_create_pengumpulan_praktikum_table',2),(16,'2026_04_05_231810_create_setting_table',3),(18,'2026_03_01_034817_create_progres_mahasiswa_table',4),(19,'2026_04_18_125846_add_tahun_columns_to_tables',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('fiz@gmail.com','uVtaavmGZJc4JM3iqaHvye556onamrcWH9c2THfBPAqY9gSzE63soSGiAgkR2DfP','2026-05-02 05:19:31'),('hadfizaiza@gmail.com','T8xjcNMAOZ8eddWez7rafrmHvyZiit7FoMqbP8hOo5EP3Nh9KITntbpFtovrYnzD','2026-05-02 06:44:27');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengumpulan_praktikum`
--

DROP TABLE IF EXISTS `pengumpulan_praktikum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengumpulan_praktikum` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_praktikum` bigint unsigned NOT NULL,
  `id_mahasiswa` bigint unsigned NOT NULL,
  `kode_program` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `output` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjelasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int DEFAULT NULL,
  `feedback_dosen` text COLLATE utf8mb4_unicode_ci,
  `status` enum('submitted','dinilai','revisi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengumpulan_praktikum_id_praktikum_id_mahasiswa_unique` (`id_praktikum`,`id_mahasiswa`),
  KEY `pengumpulan_praktikum_id_mahasiswa_foreign` (`id_mahasiswa`),
  CONSTRAINT `pengumpulan_praktikum_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengumpulan_praktikum_id_praktikum_foreign` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengumpulan_praktikum`
--

LOCK TABLES `pengumpulan_praktikum` WRITE;
/*!40000 ALTER TABLE `pengumpulan_praktikum` DISABLE KEYS */;
INSERT INTO `pengumpulan_praktikum` VALUES (2,2,3,'def selection_sort(data):\n    n = len(data)\n    for i in range(n-1):\n        min_index = i  # anggap elemen pertama sebagai nilai terkecil\n        for j in range(i+1, n):\n            if data[j] < data[min_index]:\n                min_index = j\n        # tukar elemen terkecil dengan elemen di posisi i\n        data[i], data[min_index] = data[min_index], data[i]\n        print(f\"Hasil setelah siklus ke-{i+1}: {data}\")\n\n# Contoh penggunaan\nangka = [4, 2, 5, 1, 3]\nprint(\"Sebelum sorting:\", angka)\nselection_sort(angka)\nprint(\"Setelah sorting:\", angka)','Sebelum sorting: [4, 2, 5, 1, 3]\nHasil setelah siklus ke-1: [1, 2, 5, 4, 3]\nHasil setelah siklus ke-2: [1, 2, 5, 4, 3]\nHasil setelah siklus ke-3: [1, 2, 3, 4, 5]\nHasil setelah siklus ke-4: [1, 2, 3, 4, 5]\nSetelah sorting: [1, 2, 3, 4, 5]','efwefwrrgwrg',80,'alhamdulillah lancar','dinilai','2026-03-26 13:01:57','2026-06-03 07:42:58'),(3,1,2,'def bubblesort(list):\n    for i in range(len(list)-1, 0, -1):\n        for j in range(0, i, 1):\n            if list[j] > list[j+1]:\n                temp = list[j+1]\n                list[j+1] = list[j]\n                list[j] = temp\n        print(f\"Hasil setelah iterasi ke-{len(list)-i}: {list}\")\n\nangka = [4, 2, 5, 1, 3]\nprint(\"Sebelum sorting:\", angka)\nbubblesort(angka)\nprint(\"Setelah sorting:\", angka)','Sebelum sorting: [4, 2, 5, 1, 3]\nHasil setelah iterasi ke-1: [2, 4, 1, 3, 5]\nHasil setelah iterasi ke-2: [2, 1, 3, 4, 5]\nHasil setelah iterasi ke-3: [1, 2, 3, 4, 5]\nHasil setelah iterasi ke-4: [1, 2, 3, 4, 5]\nSetelah sorting: [1, 2, 3, 4, 5]','Pengurutan data merupakan salah satu konsep penting dalam ilmu komputer yang sering digunakan untuk mengatur data agar lebih mudah dipahami dan dianalisis. Dalam kehidupan sehari-hari, proses pengurutan sebenarnya sering kita lakukan tanpa disadari, misalnya saat menyusun buku di rak berdasarkan abjad, mengurutkan nilai dari yang tertinggi hingga terendah, atau menata kartu permainan agar lebih rapi. Dalam pemrograman, proses ini dikenal dengan istilah sorting. Sorting bertujuan untuk mengatur elemen-elemen dalam suatu kumpulan data sehingga mengikuti urutan tertentu, seperti urutan menaik atau menurun.\n\nTerdapat berbagai algoritma sorting yang dapat digunakan untuk mengurutkan data. Setiap algoritma memiliki cara kerja, kelebihan, dan kekurangan masing-masing. Beberapa algoritma yang sering dipelajari dalam pemrograman dasar antara lain Bubble Sort, Selection Sort, Insertion Sort, dan Merge Sort. Algoritma-algoritma ini digunakan sebagai dasar untuk memahami bagaimana komputer melakukan pengolahan data secara sistematis.\n\nBubble Sort merupakan algoritma yang bekerja dengan cara membandingkan dua elemen yang berdekatan, kemudian menukarnya jika urutannya tidak sesuai. Proses ini dilakukan secara berulang hingga seluruh data berada pada posisi yang benar. Meskipun mudah dipahami, algoritma ini kurang efisien untuk data dalam jumlah besar karena membutuhkan banyak perbandingan.\n\nSelection Sort memiliki pendekatan yang berbeda. Pada setiap langkah, algoritma ini mencari elemen terkecil dari bagian data yang belum terurut, kemudian menukarnya dengan elemen pada posisi yang sedang diproses. Proses ini dilakukan berulang hingga semua data berada pada urutan yang benar.\n\nInsertion Sort bekerja dengan cara mengambil satu elemen dari data yang belum terurut, kemudian menyisipkannya ke posisi yang tepat pada bagian data yang sudah terurut. Algoritma ini sering dianalogikan seperti proses menyusun kartu permainan di tangan, di mana setiap kartu baru dimasukkan ke posisi yang sesuai.\n\nMerge Sort menggunakan pendekatan yang lebih kompleks namun efisien. Algoritma ini membagi data menjadi beberapa bagian kecil, kemudian mengurutkan bagian tersebut dan menggabungkannya kembali hingga menghasilkan urutan yang benar. Metode ini dikenal dengan teknik divide and conquer.\n\nDengan mempelajari berbagai algoritma sorting, mahasiswa dapat memahami bagaimana komputer memproses data secara logis dan sistematis. Pemahaman ini menjadi dasar penting dalam pengembangan perangkat lunak, analisis data, serta berbagai aplikasi teknologi informasi lainnya. Proses belajar algoritma tidak hanya melatih kemampuan berpikir logis, tetapi juga membantu memahami bagaimana solusi yang efisien dapat dirancang untuk menyelesaikan suatu permasalahan komputasi.',80,'baik','dinilai','2026-03-27 00:11:59','2026-03-27 00:42:29'),(4,3,2,'def insertion_sort(data):\n    n = len(data)\n    for i in range(1, n):  # mulai dari elemen kedua\n        key = data[i]      # elemen yang akan disisipkan\n        j = i - 1\n        # geser elemen yang lebih besar ke kanan\n        while j >= 0 and data[j] > key:\n            data[j + 1] = data[j]\n            j -= 1\n        # sisipkan elemen pada posisi yang benar\n        data[j + 1] = key\n        print(f\"Hasil setelah langkah ke-{i}: {data}\")\n\n\nangka = [4, 2, 5, 1, 3]\nprint(\"Sebelum sorting:\", angka)\ninsertion_sort(angka)\nprint(\"Setelah sorting:\", angka)','Sebelum sorting: [4, 2, 5, 1, 3]\nHasil setelah langkah ke-1: [2, 4, 5, 1, 3]\nHasil setelah langkah ke-2: [2, 4, 5, 1, 3]\nHasil setelah langkah ke-3: [1, 2, 4, 5, 3]\nHasil setelah langkah ke-4: [1, 2, 3, 4, 5]\nSetelah sorting: [1, 2, 3, 4, 5]','ini penjelasan',90,NULL,'dinilai','2026-04-05 10:32:10','2026-05-11 12:08:10'),(5,1,3,'def bubblesort(list,index):\n    for i in range(len(list)-1,0,-1):\n        for j in range(0,i,1):\n            if list[j][index]>list[j+1][index]:\n                temp=list[j+1]\n                list[j+1]=list[j]\n                list[j]=temp\n\nmahasiswa = [\n    {\'nama\': \'Yogie\',\'nim\': 12345678, \'uas\':100},\n    {\'nama\': \'Aziza\',\'nim\': 23456789, \'uas\':90},\n    {\'nama\': \'Anisa\',\'nim\': 34567890, \'uas\':80},\n    {\'nama\': \'Dani\',\'nim\': 45678901, \'uas\':95},\n]\n\nprint(mahasiswa)\nbubblesort(mahasiswa,\'uas\')\nprint(\'Hasil nilai uas dari nilai terendah sampai ke yang tertinggi:\')\nfor i in mahasiswa:\n    print(i)','[{\'nama\': \'Yogie\', \'nim\': 12345678, \'uas\': 100}, {\'nama\': \'Aziza\', \'nim\': 23456789, \'uas\': 90}, {\'nama\': \'Anisa\', \'nim\': 34567890, \'uas\': 80}, {\'nama\': \'Dani\', \'nim\': 45678901, \'uas\': 95}]\nHasil nilai uas dari nilai terendah sampai ke yang tertinggi:\n{\'nama\': \'Anisa\', \'nim\': 34567890, \'uas\': 80}\n{\'nama\': \'Aziza\', \'nim\': 23456789, \'uas\': 90}\n{\'nama\': \'Dani\', \'nim\': 45678901, \'uas\': 95}\n{\'nama\': \'Yogie\', \'nim\': 12345678, \'uas\': 100}','ya',NULL,NULL,'submitted','2026-04-28 04:06:38','2026-04-28 04:06:38'),(6,4,2,'def merge_sort_dict(arr, key=\"value\"):\n    if len(arr) > 1:\n        mid = len(arr) // 2\n        left_half = arr[:mid]\n        right_half = arr[mid:]\n\n        # Rekursif sorting\n        merge_sort_dict(left_half, key)\n        merge_sort_dict(right_half, key)\n\n        i = j = k = 0\n\n        # Merge proses\n        while i < len(left_half) and j < len(right_half):\n            if left_half[i][key] < right_half[j][key]:\n                arr[k] = left_half[i]\n                i += 1\n            else:\n                arr[k] = right_half[j]\n                j += 1\n            k += 1\n\n        # Sisa elemen dari left half\n        while i < len(left_half):\n            arr[k] = left_half[i]\n            i += 1\n            k += 1\n\n        # Sisa elemen di kanan\n        while j < len(right_half):\n            arr[k] = right_half[j]\n            j += 1\n            k += 1\n\n\n# Contoh data\ndata = [\n    {\"value\": 6},\n    {\"value\": 5},\n    {\"value\": 12},\n    {\"value\": 10},\n    {\"value\": 9},\n    {\"value\": 1}\n]\n\nprint(\"Sebelum diurutkan:\", data)\nmerge_sort_dict(data)\nprint(\"Setelah diurutkan:\", data)','Sebelum diurutkan: [{\'value\': 6}, {\'value\': 5}, {\'value\': 12}, {\'value\': 10}, {\'value\': 9}, {\'value\': 1}]\nSetelah diurutkan: [{\'value\': 1}, {\'value\': 5}, {\'value\': 6}, {\'value\': 9}, {\'value\': 10}, {\'value\': 12}]','oisjapwoejtrpweotjor',95,NULL,'dinilai','2026-05-11 12:41:42','2026-05-11 12:42:08'),(7,2,2,'print(\"fiza\")','fiza','percobaan print',NULL,NULL,'submitted','2026-07-13 01:41:32','2026-07-13 01:41:32');
/*!40000 ALTER TABLE `pengumpulan_praktikum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `praktikum`
--

DROP TABLE IF EXISTS `praktikum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `praktikum` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_aktivitas` bigint unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_soal` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batas_waktu` datetime DEFAULT NULL,
  `bobot` int NOT NULL DEFAULT '100',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `praktikum_id_aktivitas_foreign` (`id_aktivitas`),
  CONSTRAINT `praktikum_id_aktivitas_foreign` FOREIGN KEY (`id_aktivitas`) REFERENCES `aktivitas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `praktikum`
--

LOCK TABLES `praktikum` WRITE;
/*!40000 ALTER TABLE `praktikum` DISABLE KEYS */;
INSERT INTO `praktikum` VALUES (1,8,'Bubble Sort','Implementasi algoritma Bubble Sort','1782368717_Praktikum_Bubble_Sort.pdf','2026-03-31 23:59:00',20,1,'2026-03-09 18:45:12','2026-06-25 05:25:17'),(2,13,'Selection Sort','Implementasi algoritma Selection Sort','1782370399_Praktikum_Selection_Sort.pdf','2026-04-20 23:59:00',25,1,'2026-03-26 04:33:03','2026-06-25 05:53:19'),(3,18,'Insertion Sort','Implementasi algoritma Insertion Sort','1782370409_Praktikum_Insertion_Sort.pdf','2026-04-20 23:59:00',25,1,'2026-03-26 04:33:03','2026-06-25 05:53:29'),(4,23,'Merge Sort','Implementasi algoritma Merge Sort','1782370416_Praktikum_Merge_Sort.pdf','2026-04-20 23:59:00',25,1,'2026-03-26 04:33:03','2026-06-25 05:53:36');
/*!40000 ALTER TABLE `praktikum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progres_mahasiswa`
--

DROP TABLE IF EXISTS `progres_mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progres_mahasiswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` bigint unsigned NOT NULL,
  `id_aktivitas` bigint unsigned NOT NULL,
  `status` enum('belum','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `nilai` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `progres_mahasiswa_id_mahasiswa_id_aktivitas_unique` (`id_mahasiswa`,`id_aktivitas`),
  KEY `progres_mahasiswa_id_aktivitas_foreign` (`id_aktivitas`),
  CONSTRAINT `progres_mahasiswa_id_aktivitas_foreign` FOREIGN KEY (`id_aktivitas`) REFERENCES `aktivitas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `progres_mahasiswa_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progres_mahasiswa`
--

LOCK TABLES `progres_mahasiswa` WRITE;
/*!40000 ALTER TABLE `progres_mahasiswa` DISABLE KEYS */;
INSERT INTO `progres_mahasiswa` VALUES (1,2,1,'selesai',NULL,'2026-04-12 01:07:06','2026-04-12 01:07:06'),(2,2,2,'selesai',NULL,'2026-04-12 01:07:19','2026-04-12 01:07:19'),(3,2,3,'selesai',NULL,'2026-04-12 01:08:47','2026-04-12 01:08:47'),(4,3,1,'selesai',NULL,'2026-04-20 03:16:15','2026-04-20 03:16:15'),(5,3,2,'selesai',NULL,'2026-04-20 04:36:47','2026-04-20 04:36:47'),(14,2,24,'selesai',NULL,'2026-05-11 12:03:45','2026-05-11 12:03:45'),(15,2,23,'selesai',NULL,'2026-05-11 12:41:44','2026-05-11 12:41:44'),(16,2,22,'selesai',NULL,'2026-05-20 11:49:43','2026-05-20 11:49:43'),(18,2,10,'selesai',NULL,'2026-05-30 06:17:22','2026-05-30 06:17:22'),(19,2,15,'selesai',NULL,'2026-05-30 06:28:50','2026-05-30 06:28:50'),(20,2,20,'selesai',NULL,'2026-05-30 06:33:54','2026-05-30 06:33:54'),(21,2,5,'selesai',NULL,'2026-05-30 06:41:01','2026-05-30 06:41:01'),(22,2,6,'selesai',NULL,'2026-06-03 07:33:05','2026-06-03 07:33:05'),(23,2,17,'selesai',NULL,'2026-06-04 15:27:11','2026-06-04 15:27:11'),(24,2,11,'selesai',NULL,'2026-06-06 13:57:59','2026-06-06 13:57:59'),(26,2,16,'selesai',NULL,'2026-06-06 14:48:14','2026-06-06 14:48:14'),(27,2,21,'selesai',NULL,'2026-06-06 14:56:48','2026-06-06 14:56:48'),(28,2,4,'selesai',NULL,'2026-06-07 07:57:12','2026-06-07 07:57:12'),(29,2,9,'selesai',NULL,'2026-06-07 08:16:52','2026-06-07 08:16:52'),(33,3,3,'selesai',NULL,'2026-06-14 05:34:15','2026-06-14 05:34:15'),(34,3,4,'selesai',NULL,'2026-06-14 05:40:19','2026-06-14 05:40:19'),(35,3,5,'selesai',NULL,'2026-06-14 06:02:55','2026-06-14 06:02:55'),(36,2,12,'selesai',NULL,'2026-06-20 11:33:03','2026-06-20 11:33:03'),(37,2,14,'selesai',NULL,'2026-06-25 02:23:24','2026-06-25 02:23:24'),(38,2,19,'selesai',NULL,'2026-06-25 04:09:38','2026-06-25 04:09:38'),(39,25,1,'selesai',NULL,'2026-07-10 12:31:13','2026-07-10 12:31:13'),(40,25,2,'selesai',NULL,'2026-07-10 14:47:31','2026-07-10 14:47:31'),(41,25,3,'selesai',NULL,'2026-07-10 15:15:57','2026-07-10 15:15:57'),(42,2,13,'selesai',NULL,'2026-07-13 01:41:34','2026-07-13 01:41:34');
/*!40000 ALTER TABLE `progres_mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('5gcTMOaUw669cevPFBaqODLRYfImrui9xuGa6IEt',5,'172.19.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUDBZNHlTNXhBNThxdmRSVkF2YXNuRmtqNUE3Z3lKcDJPbklkRXA1ZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tYWhhc2lzd2EvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjE5OiJtYWhhc2lzd2EuZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9',1785906932),('cs12E8fmMKpBpNxgxHl8x6tmvPDSSZ1AEPeZEwaa',1,'172.19.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaTlaN1Q1MFFTd0VObm53dTFMamNDZHpJNFByb3REMElTUmtscWl2aSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kb3Nlbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImRvc2VuLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1785850220),('SWlYUED0FNBI5Ccgpqp9sYK188RBMGw9er3LhX0a',NULL,'172.19.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1hkM0t2VjU2Rk5wc3dWZDRQVDFqS0VhOFlzTHR1aWNZMTBoUE90YyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1785852944);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setting` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_dosen` bigint unsigned NOT NULL,
  `id_aktivitas` bigint unsigned NOT NULL,
  `tahun` int DEFAULT NULL,
  `kkm` int NOT NULL DEFAULT '75',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `setting_id_dosen_foreign` (`id_dosen`),
  KEY `setting_id_aktivitas_foreign` (`id_aktivitas`),
  CONSTRAINT `setting_id_aktivitas_foreign` FOREIGN KEY (`id_aktivitas`) REFERENCES `aktivitas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `setting_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (24,1,3,2026,75,'2026-05-12 01:13:46','2026-06-04 13:42:01'),(25,1,7,2026,85,'2026-05-12 01:13:46','2026-07-10 15:36:40'),(26,1,12,2026,75,'2026-05-12 01:13:46','2026-05-12 01:13:46'),(27,1,17,2026,75,'2026-05-12 01:13:46','2026-05-12 01:13:46'),(28,1,22,2026,75,'2026-05-12 01:13:46','2026-05-12 01:13:46'),(29,1,24,2026,75,'2026-05-12 01:13:46','2026-05-12 01:13:46'),(30,1,3,2022,80,'2026-05-12 01:14:17','2026-05-12 01:14:17'),(31,1,7,2022,75,'2026-05-12 01:14:17','2026-07-04 03:17:25'),(32,1,12,2022,75,'2026-05-12 01:14:17','2026-05-12 01:14:17'),(33,1,17,2022,75,'2026-05-12 01:14:17','2026-05-12 01:14:17'),(34,1,22,2022,75,'2026-05-12 01:14:17','2026-05-12 01:14:17'),(35,1,24,2022,75,'2026-05-12 01:14:17','2026-05-12 01:14:17'),(36,1,3,2023,80,'2026-06-03 07:48:24','2026-06-03 07:48:24'),(37,1,7,2023,80,'2026-06-03 07:48:24','2026-06-03 07:48:24'),(38,1,12,2023,75,'2026-06-03 07:48:24','2026-06-03 07:48:24'),(39,1,17,2023,75,'2026-06-03 07:48:24','2026-06-03 07:48:24'),(40,1,22,2023,75,'2026-06-03 07:48:24','2026-06-03 07:48:24'),(41,1,24,2023,75,'2026-06-03 07:48:24','2026-06-03 07:48:24');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('dosen','mahasiswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'dosen','Rifqi Azmi','dosen@gmail.com','$2y$12$0U0motXsDd5ZUV5nvpLq0e58heXrmqgiKox9ZwtUnk3JRKwJe1gBm','2026-03-06 21:57:01',NULL,'2026-03-06 21:57:01','2026-04-21 02:54:09'),(2,'mahasiswa','Fiza','fiza@gmail.com','$2y$12$bKV11zEhSBDoRj/Y.kO7P.ZGbXJInc8sgd.VOsGyJrnWW6q8kAeo6','2026-03-06 21:57:01',NULL,'2026-03-06 21:57:01','2026-05-20 11:44:49'),(5,'mahasiswa','habibi','habibi@gmail.com','$2y$12$FiJu2prEye3k1hinkyHMv.DexwcufgEtJtAheRaSfNNi/Ce99w6kq',NULL,NULL,'2026-03-12 07:27:55','2026-03-12 07:27:55'),(6,'mahasiswa','Hadri','kosong@gmail.com','$2y$12$0s7CPV8D7Pu1fHx7tMmzVO0Xtu7Hnice2OmER4VcYZNxCcQcyTHnK',NULL,NULL,'2026-04-09 12:26:06','2026-04-09 12:26:06'),(7,'mahasiswa','hadi','hadfizaiza@gmail.com','$2y$12$Dt7uSiDy4xhuW2J.FaM01OG2mAEzBgJ526kBUTrhqPicdZOIAtJCa',NULL,NULL,'2026-05-02 05:23:04','2026-05-02 13:47:17'),(10,'mahasiswa','Ahmad Fauzi','ahmad@gmail.com','$2y$12$eNyisnIMsMNuqVnQlz/Us.i/RVt1D2C1LJqKapQ9KFmA9wgpR3Kai','2026-06-04 12:36:52',NULL,'2026-06-04 12:36:52','2026-06-04 12:36:52'),(11,'mahasiswa','Siti Rahma','siti@gmail.com','$2y$12$/npxY90ePlc.zoCwVY/XN.RvtBDGPq5I9Kte4pob9IyWgja7AwdvO','2026-06-04 12:36:52',NULL,'2026-06-04 12:36:52','2026-06-04 12:36:52'),(12,'mahasiswa','Budi Santoso','budi@gmail.com','$2y$12$NO.pEv18am7LZaLZ7X50lOvvbRz6Vw4u9fsi/iC2htggz18OZUcCq','2026-06-04 12:36:52',NULL,'2026-06-04 12:36:52','2026-06-04 12:36:52'),(13,'mahasiswa','Dewi Lestari','dewi@gmail.com','$2y$12$Bc3dSSq5hQko1kdN5z8A7.NsIgCThrP.cb2RqxEDLBQ5lZn982Zkq','2026-06-04 12:36:53',NULL,'2026-06-04 12:36:53','2026-06-04 12:36:53'),(14,'mahasiswa','Andi Pratama','andi@gmail.com','$2y$12$2EiIxEdJFW0BSDOwJ3nGyO095WUtxX69FavXbvmrnUxCz6tPgFoEm','2026-06-04 12:36:53',NULL,'2026-06-04 12:36:53','2026-06-04 12:36:53'),(15,'mahasiswa','Nabila Putri','nabila@gmail.com','$2y$12$J5D0v2MFVF1y9JykORWLIu/0CXLLeH5Km7Og9nhFZU1.65f1r8FlG','2026-06-04 12:36:53',NULL,'2026-06-04 12:36:53','2026-06-04 12:36:53'),(16,'mahasiswa','Rizky Maulana','rizky@gmail.com','$2y$12$mug1IKo/6ypd3krcDlz85uUADv4ZluRLIx0P1mYBltzsXuKmSt0wG','2026-06-04 12:36:53',NULL,'2026-06-04 12:36:53','2026-06-04 12:36:53'),(17,'mahasiswa','Aulia Rahman','aulia@gmail.com','$2y$12$zY7fUowo8yt.OQ5HuV/mUOf3.LqmhNbEFcTibv8N9bgEfVOJtqnrO','2026-06-04 12:36:54',NULL,'2026-06-04 12:36:54','2026-06-04 12:36:54'),(18,'mahasiswa','Fajar Hidayat','fajar@gmail.com','$2y$12$.Fz1tKiHQykOhNkD6NoUJumVrN0del0qZLvAqJTIjuFlJFHEgXESG','2026-06-04 12:36:54',NULL,'2026-06-04 12:36:54','2026-06-04 12:36:54'),(20,'mahasiswa','Nur Aisyah','aisyah@gmail.com','$2y$12$hTXPuTAJmGuwbsHG09F3auN3pOIQGgtAksBcrl93GWtDUSUJAdndK','2026-06-04 12:39:51',NULL,'2026-06-04 12:39:51','2026-06-04 12:39:51'),(21,'mahasiswa','Muhammad Arif','arif@gmail.com','$2y$12$dfmf66PKug59lzoLThpBqeD3BRH/cRXzp0o6fte3MtLvAHxmfCwNu','2026-06-04 12:39:52',NULL,'2026-06-04 12:39:52','2026-06-04 12:39:52'),(22,'mahasiswa','Rina Oktavia','rina@gmail.com','$2y$12$65d79GCYyS/7CSHIWwPkkukvVeOWBffMZrASCmxcepqDd2YmvouGq','2026-06-04 12:39:52',NULL,'2026-06-04 12:39:52','2026-06-04 12:39:52'),(23,'mahasiswa','Dimas Saputra','dimas@gmail.com','$2y$12$N0.2QohO5hCwyEL7eLres.Ti261n65m5XsZrWQ91PX70FeSDLTXoG','2026-06-04 12:39:52',NULL,'2026-06-04 12:39:52','2026-06-04 12:39:52'),(24,'mahasiswa','Putri Maharani','putri@gmail.com','$2y$12$684aRUqGNwTZ8Iel9TTRTOxUQe1GCaqOoxYLUX7wj5CZiDc0dmx6.','2026-06-04 12:39:52',NULL,'2026-06-04 12:39:52','2026-06-04 12:39:52'),(25,'mahasiswa','Yoga Pratama','yoga@gmail.com','$2y$12$wktoyW0MtagATOuWztx4vusuJRhuqLW5QqKTjep40EzGAZYI5NhYG','2026-06-04 12:39:53',NULL,'2026-06-04 12:39:53','2026-06-04 12:39:53'),(26,'mahasiswa','Nanda Sari','nanda@gmail.com','$2y$12$DEW64EcL/8UIkcxM855.n.gVCXHjHG2RqwfIJ86YC9EoGlhR1xlNW','2026-06-04 12:39:53',NULL,'2026-06-04 12:39:53','2026-06-04 12:39:53'),(27,'mahasiswa','Fikri Ramadhan','fikri@gmail.com','$2y$12$CKdy4FH.kqgLVbhMjzJuEOSHrorPvtG1Hbk.DmSJApNxq8ZHt38qW','2026-06-04 12:39:53',NULL,'2026-06-04 12:39:53','2026-06-04 12:39:53'),(28,'mahasiswa','Salsa Putri','salsa@gmail.com','$2y$12$VZeZ6W1uhbVjAhHYvu2P2uZLR.AvMggRtQeuVVgSZ6GNqedVqwAK2','2026-06-04 12:39:53',NULL,'2026-06-04 12:39:53','2026-06-04 12:39:53'),(29,'mahasiswa','Reza Maulana','reza@gmail.com','$2y$12$URUL1Mmq2EGFamf4jRJCsu3SA4iGgzCxcT43F2cz.XR6lBo.F55ma','2026-06-04 12:39:54',NULL,'2026-06-04 12:39:54','2026-06-04 12:39:54'),(30,'mahasiswa','Joko','joko@gmail.com','$2y$12$2il6TRycRJgvrxBbfh3bs.bkYif6Ajh5lani5v0Z1jPoUfUfNsyMy',NULL,NULL,'2026-07-10 12:16:05','2026-07-10 12:16:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-05 22:15:10
