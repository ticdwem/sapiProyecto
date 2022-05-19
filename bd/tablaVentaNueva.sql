-- --------------------------------------------------------
-- Host:                         192.168.1.20
-- Versión del servidor:         8.0.27 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para sapi
CREATE DATABASE IF NOT EXISTS `sapi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sapi`;

-- Volcando estructura para tabla sapi.ventaterminada
CREATE TABLE IF NOT EXISTS `ventaterminada` (
  `idPeddios` int NOT NULL AUTO_INCREMENT COMMENT 'este es un id solo para control',
  `idnotaPedido` int NOT NULL COMMENT 'este mas el idPedidos conformaran el para los pedidos',
  `idUsuarioVenta` int NOT NULL COMMENT 'id del usuario que ha dado de alta los pedidos',
  `idClientePedido` int NOT NULL COMMENT 'este es la relacion con la tabla cliente',
  `idProductoPedido` int NOT NULL COMMENT 'este es la relacion con la tabla producto',
  `pzProductoPedido` int NOT NULL COMMENT 'este contiene la cantidad de piezas del producto solicitad',
  `loteProductoPedido` int NOT NULL DEFAULT '0' COMMENT 'lote ,este sera llenado una vez que se esta haciendo la venta',
  `pesoProductoPedido` float NOT NULL DEFAULT '0',
  `fechaAltaProductoPedido` date DEFAULT NULL COMMENT 'contiene la fecha que fue dado de alta el pedido',
  `idAlmacenPedidos` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT 'este sera una relacion con almacenes',
  `statusProductoPedido` char(1) DEFAULT NULL COMMENT 'este nos dira cuando fue atendido el pedido',
  `fechaEntregaPedido` date NOT NULL COMMENT 'este dato guarda la fecha de entrega de los pedidos',
  `dateDrop` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPeddios`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sapi.ventaterminada: ~11 rows (aproximadamente)
INSERT INTO `ventaterminada` (`idPeddios`, `idnotaPedido`, `idUsuarioVenta`, `idClientePedido`, `idProductoPedido`, `pzProductoPedido`, `loteProductoPedido`, `pesoProductoPedido`, `fechaAltaProductoPedido`, `idAlmacenPedidos`, `statusProductoPedido`, `fechaEntregaPedido`, `dateDrop`) VALUES
	(1, 6810, 1, 18, 505, 50, 11111, 150, '2022-03-09', '3', '2', '0000-00-00', '2022-05-10 16:55:54'),
	(3, 6810, 1, 18, 502, 15, 45, 85.36, '2022-03-09', '3', '2', '0000-00-00', '2022-05-10 16:55:54'),
	(4, 6810, 1, 18, 498, 125, 563, 115.36, '2022-03-09', '3', '2', '0000-00-00', '2022-05-10 16:55:54'),
	(12, 1021122, 1, 34, 501, 36, 50, 150, '2022-04-12', '3', '2', '2022-04-13', '2022-05-12 19:35:54'),
	(13, 1021122, 1, 34, 500, 14, 25, 250, '2022-04-12', '3', '2', '2022-04-13', '2022-05-12 19:35:54'),
	(24, 1021422, 1, 30, 252, 12, 356, 50, '2022-04-12', '3', '2', '2022-04-13', '2022-05-12 19:49:33'),
	(50, 1121022, 3, 18, 501, 250, 113, 56, '2022-04-22', '3', '2', '2022-04-23', '2022-05-17 22:46:05'),
	(51, 1121022, 3, 18, 200, 25, 123, 56, '2022-04-22', '3', '2', '2022-04-23', '2022-05-17 22:46:05'),
	(52, 1121022, 3, 18, 666, 32, 250, 75, '2022-04-22', '3', '2', '2022-04-23', '2022-05-17 22:46:05'),
	(56, 1271022, 3, 356, 100, 25, 110, 95, '2022-05-07', '3', '2', '2022-05-09', '2022-05-18 19:49:37'),
	(57, 1271022, 3, 356, 101, 41, 111, 15, '2022-05-07', '3', '2', '2022-05-09', '2022-05-18 19:49:37');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
