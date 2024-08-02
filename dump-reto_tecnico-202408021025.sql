-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 192.168.56.56    Database: reto_tecnico
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.20.04.2

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
-- Table structure for table `pedido_estado`
--

DROP TABLE IF EXISTS `pedido_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_estado` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `position` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_status_IDX` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_estado`
--

LOCK TABLES `pedido_estado` WRITE;
/*!40000 ALTER TABLE `pedido_estado` DISABLE KEYS */;
INSERT INTO `pedido_estado` VALUES (1,'Por atender',1,1),(2,'En proceso',1,2),(3,'En delivery',1,3),(4,'Recibido',1,4);
/*!40000 ALTER TABLE `pedido_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nro_pedido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `recepcion_at` datetime DEFAULT NULL,
  `despacho_at` datetime DEFAULT NULL,
  `entrega_at` datetime DEFAULT NULL,
  `vendedor_id` bigint unsigned DEFAULT NULL,
  `repartidor_id` bigint unsigned DEFAULT NULL,
  `estado_id` int unsigned DEFAULT NULL,
  `pedido_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_pedido_estado_FK` (`estado_id`) USING BTREE,
  KEY `pedidos_users_FK` (`vendedor_id`) USING BTREE,
  KEY `pedidos_users_FK_1` (`repartidor_id`) USING BTREE,
  KEY `roles_status_IDX` (`status`) USING BTREE,
  KEY `pedidos_created_at_IDX` (`created_at`) USING BTREE,
  CONSTRAINT `pedidos_pedido_estado_FK` FOREIGN KEY (`estado_id`) REFERENCES `pedido_estado` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pedidos_users_FK` FOREIGN KEY (`vendedor_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pedidos_users_FK_1` FOREIGN KEY (`repartidor_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,'00022',1,'2024-08-02 11:22:56','2024-08-02 13:15:03','2024-08-02 13:13:24','2024-08-02 13:14:39','2024-08-02 13:15:03',1,4,4,'2024-08-02 13:11:24'),(2,'00023',1,'2024-08-02 11:24:35','2024-08-02 11:24:35',NULL,NULL,NULL,1,NULL,1,NULL),(3,'00024',1,'2024-08-02 11:24:52','2024-08-02 11:24:52',NULL,NULL,NULL,1,NULL,1,NULL),(4,'00025',1,'2024-08-02 11:26:02','2024-08-02 11:26:02',NULL,NULL,NULL,1,NULL,1,NULL),(5,'00026',1,'2024-08-02 11:26:27','2024-08-02 11:26:27',NULL,NULL,NULL,1,NULL,1,NULL),(6,'00027',1,'2024-08-02 14:18:02','2024-08-02 14:18:02',NULL,NULL,NULL,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos_detail`
--

DROP TABLE IF EXISTS `pedidos_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos_detail` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `producto_id` bigint unsigned DEFAULT NULL,
  `pedido_id` bigint unsigned DEFAULT NULL,
  `cantidad` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_detail_pedidos_FK` (`pedido_id`) USING BTREE,
  KEY `pedidos_detail_producto_FK` (`producto_id`) USING BTREE,
  KEY `roles_status_IDX` (`status`) USING BTREE,
  CONSTRAINT `pedidos_detail_pedidos_FK` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pedidos_detail_producto_FK` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_detail`
--

LOCK TABLES `pedidos_detail` WRITE;
/*!40000 ALTER TABLE `pedidos_detail` DISABLE KEYS */;
INSERT INTO `pedidos_detail` VALUES (1,1,NULL,NULL,1,4,2),(2,1,NULL,NULL,2,4,3),(6,1,NULL,NULL,1,6,2),(7,1,NULL,NULL,2,6,5);
/*!40000 ALTER TABLE `pedidos_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `sku` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tags` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` double unsigned DEFAULT NULL,
  `unidad` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_sku_IDX` (`sku`) USING BTREE,
  KEY `roles_status_IDX` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Crema hidratante manos',1,'000222','hidratante piel','cuidados, tratamiento, piel',12.5,'l','2024-08-02 09:59:34','2024-08-02 10:12:38'),(2,'Crema hidratante',1,'00022','hidratante','cuidados, tratamiento',10.5,'ml','2024-08-02 11:18:57','2024-08-02 11:18:57');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `roles_status_IDX` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Encargado',1),(2,'Vendedor',1),(3,'Delivery',1),(4,'Repartidor',1);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cod` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `puesto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rol_id` int unsigned DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_roles_FK` (`rol_id`) USING BTREE,
  KEY `users_status_IDX` (`status`) USING BTREE,
  CONSTRAINT `users_roles_FK` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'0001','user encargado','encargado@mail.com','999990010','Encargado',1,1,NULL,NULL,'$2y$10$IFfb8ehddUPSCFqACdXff.mFtYvWRmH20Zx/wha.Et3U/jnQfv.HO'),(2,'0002','user vendedor','vendedor@mail.com','999990010','Vendedor',2,1,NULL,NULL,'$2y$10$IFfb8ehddUPSCFqACdXff.mFtYvWRmH20Zx/wha.Et3U/jnQfv.HO'),(3,'0003','user delivery','delivery@mail.com','999990010','Delivery',3,1,NULL,NULL,'$2y$10$IFfb8ehddUPSCFqACdXff.mFtYvWRmH20Zx/wha.Et3U/jnQfv.HO'),(4,'0004','user repartidor','repartidor@mail.com','999990010','Repartidor',4,1,NULL,NULL,'$2y$10$IFfb8ehddUPSCFqACdXff.mFtYvWRmH20Zx/wha.Et3U/jnQfv.HO'),(6,'00333','ivan alvarado','ivan.alvarado@mail.com','99990000','Empleado',4,1,'2024-08-01 19:37:49','2024-08-01 21:48:59','$2y$10$YBvdH4gpwnQ8Dnbg8KuRAO62wfXwxmvSaSm30OOkiolUYSQvXgwdG');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_token`
--

DROP TABLE IF EXISTS `users_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_token` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_token_token_IDX` (`token`) USING BTREE,
  KEY `users_token_users_FK` (`users_id`) USING BTREE,
  CONSTRAINT `users_token_users_FK` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_token`
--

LOCK TABLES `users_token` WRITE;
/*!40000 ALTER TABLE `users_token` DISABLE KEYS */;
INSERT INTO `users_token` VALUES (8,'19e96cdae1fe0a9c2d86ee0231bc0b1d1a91b14e541','2024-08-02 10:41:22','2024-08-02 10:41:22',1);
/*!40000 ALTER TABLE `users_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'reto_tecnico'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-02 10:25:45
