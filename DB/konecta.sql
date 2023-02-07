-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.31 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

-- Volcando estructura de base de datos para konecta
CREATE DATABASE IF NOT EXISTS `konecta` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `konecta`;

-- Volcando estructura para tabla konecta.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre',
  `referencia` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Referencia',
  `precio` int(255) NOT NULL COMMENT 'Precio',
  `peso` int(255) NOT NULL COMMENT 'Peso',
  `categoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Categoria',
  `stock` int(255) NOT NULL COMMENT 'Stock',
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT 'Estado producto, 0 = Inactivo, 1 = Activo',
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de registro',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para productos.';

-- Volcando datos para la tabla konecta.productos: 2 rows
INSERT INTO `productos` (`id`, `nombre`, `referencia`, `precio`, `peso`, `categoria`, `stock`, `estado`, `fecha_registro`) VALUES
	(1, 'Pastel', '1', 10, 50, 'A', 9, 1, '2023-02-06 20:56:51'),
	(2, 'Jugo', '2', 5, 50, 'B', 5, 1, '2023-02-06 20:56:27');

-- Volcando estructura para tabla konecta.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `id_producto` int(10) NOT NULL COMMENT 'Id producto',
  `cantidad` int(10) NOT NULL COMMENT 'Cantidad de venta',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de venta',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Ventas realizadas de productos.';

-- Volcando datos para la tabla konecta.ventas: 1 rows
INSERT INTO `ventas` (`id`, `id_producto`, `cantidad`, `fecha`) VALUES
	(1, 1, 2, '2023-02-06 20:56:51');

