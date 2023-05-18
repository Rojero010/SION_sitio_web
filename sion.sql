-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-05-2022 a las 02:08:41
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre_categoria`) VALUES
(1, 'Juguetes'),
(2, 'Didácticos'),
(3, 'Niños');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

DROP TABLE IF EXISTS `cuenta`;
CREATE TABLE IF NOT EXISTS `cuenta` (
  `numCuenta` int(11) NOT NULL AUTO_INCREMENT,
  `idFormaPago` int(11) DEFAULT NULL,
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombreCliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fechaIngreso` date NOT NULL,
  `idDireccion` int(11) DEFAULT NULL,
  PRIMARY KEY (`numCuenta`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`numCuenta`, `idFormaPago`, `correo`, `contrasena`, `nombreCliente`, `fechaIngreso`, `idDireccion`) VALUES
(6, NULL, 'pedro.palacios@oca.com', '01wtIu%F*od*gr', 'Pedro Palacios Gómez', '2022-05-03', NULL),
(7, NULL, 'pedro.palacios@oca.com', 'd1648dbeaa1f984e3e7fa91f9969367c', 'Pedro Palacios Gómez', '2022-05-03', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

DROP TABLE IF EXISTS `direccion`;
CREATE TABLE IF NOT EXISTS `direccion` (
  `idDireccion` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idDireccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(11) NOT NULL,
  `unidad` int(11) NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `img` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `disponibilidad` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nombreProducto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `idCategoria` (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `idCategoria`, `unidad`, `descripcion`, `img`, `precio`, `disponibilidad`, `nombreProducto`) VALUES
(1, 2, 15, 'Enseñe a los niños a nombrar fracciones y decimales, comparando y ordenando fracciones, fracciones inadecuadas, números mixtos y modelando diferentes operaciones que involucran fracciones.', 'https://m.media-amazon.com/images/I/614GBWuttIL._SL1000_.jpg', '100', 'No disponible', 'Rainbow Fraction Tower Cubes'),
(2, 1, 23, 'El Set Cubi-Cubos busca fomentar la imaginación de los niños, ofreciendo formas simplificadas para una comprensión más sencilla de los colores y sus formas.', 'https://m.media-amazon.com/images/I/814+-wgEHfL._AC_SX425_.jpg', '500', 'Disponible', 'Set Cubi-Cubos'),
(3, 2, 4, 'Para aprender colores y formas y ayuda en coordinación ojo-mano. Estas 15 piezas de madera con 3 formas y colores diferentes ofrecen una gran variedad de juego y aprendizaje.', 'https://m.media-amazon.com/images/I/61eSqSxEB1L._AC_SL1500_.jpg', '200', 'Disponible', 'Tablero para Apilar y Clasificar');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;