-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-05-2022 a las 10:56:53
-- Versión del servidor: 10.5.12-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id18956578_tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `nombre`, `email`, `direccion`, `total`) VALUES
(1, 'PrimerUsu', 'asd@gmail.com', 'Madrid las rozas 22 4x', 340.00),
(2, 'segunda compra', 'seg@gmail.com', 'seg sef seg seg ', 180.00),
(3, 'TerceraCompra', 'terc@gmail.com', 'ter ter ter ter', 220.00),
(4, 'Cuarta compra', 'Cuart@gmail.com', 'cuarta cuart acuart a', 288.00),
(5, 'Cuarta compra', 'Cuart@gmail.com', 'cuarta cuart acuart a', 288.00),
(6, 'quinta', 'quinta@gmail.com', 'quita quita quinta', 70.00),
(7, 'ult', 'ult@gmail.com', 'ultultukly', 400.00),
(8, 'UsuariodedeAndroid', 'androis@gmail.com', 'Sjjxdhbdid', 98.00),
(9, 'PKOGG', 'ALS@GMAIL.COM', 'HGLG', 290.00),
(10, 'Quevedo', 'quevedo@gmail.com', 'Calle falsa 123 Primero F', 58.00),
(11, 'Sergio', 's.montoro.hernandez@gmail.com', 'Calle Cáceres, Nº30, 3ºA', 200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 1, 'Sega mega drive', 40.00, 1),
(2, 1, 3, 'Nintendo Entertainment System', 70.00, 3),
(3, 1, 2, 'PlayStation 2', 90.00, 1),
(4, 2, 2, 'PlayStation 2', 90.00, 2),
(5, 3, 1, 'Sega mega drive', 40.00, 1),
(6, 3, 2, 'PlayStation 2', 90.00, 2),
(7, 4, 3, 'Nintendo Entertainment System', 70.00, 2),
(8, 4, 2, 'PlayStation 2', 90.00, 1),
(9, 4, 5, 'PlayStation 3', 58.00, 1),
(10, 6, 3, 'Nintendo Entertainment System', 70.00, 1),
(11, 7, 1, 'Sega mega drive', 40.00, 10),
(12, 8, 1, 'Sega mega drive', 40.00, 1),
(13, 8, 5, 'PlayStation 3', 58.00, 1),
(14, 9, 1, 'Sega mega drive', 40.00, 1),
(15, 9, 2, 'PlayStation 2', 90.00, 2),
(16, 9, 3, 'Nintendo Entertainment System', 70.00, 1),
(17, 10, 5, 'PlayStation 3', 58.00, 1),
(18, 11, 1, 'Sega mega drive', 40.00, 1),
(19, 11, 2, 'PlayStation 2', 90.00, 1),
(20, 11, 3, 'Nintendo Entertainment System', 70.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(4) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
(1, 'Sega mega drive', 'Mega Drive, conocida en diversos territorios de América como Genesis, es una clásica videoconsola de sobremesa de 16 bits desarrollada por Sega Enterprises, Ltd. Mega Drive fue la tercera consola de Sega y la sucesora de Master System. Compitió contra la SNES de Nintendo, como parte de las videoconsolas de cuarta generación.', 40.00, 0, 1, 1),
(2, 'PlayStation 2', 'La PlayStation 2 (Japonés: プレイステーション2 Pureisutēshon Tsu, oficialmente abreviada como PS2) es la segunda videoconsola de sobremesa producida por Sony Computer Entertainment, y la tercera consola de Sony en ser diseñada por Ken Kutaragi. Además de ser la sucesora de la PlayStation. Fue lanzada por primera vez el 4 de marzo del año 2000 en Japón, y unos meses después en el resto del mundo. Es la videoconsola más vendida de la historia, con más de 155 millones de unidades vendidas\r\n', 90.00, 0, 1, 1),
(3, 'Nintendo Entertainment System', 'Nintendo Entertainment System (también conocida como Nintendo NES o simplemente NES)6​ es la segunda consola de sobremesa de Nintendo, y es una videoconsola de ocho bits perteneciente a la tercera generación en la industria de los videojuegos. Fue lanzada por Nintendo en Norteamérica, Europa y Australia entre 1985 y 1987.\r\n', 70.00, 0, 1, 1),
(4, 'Atari', ' La Atari 2600 es una videoconsola lanzada al mercado en 1977 bajo el nombre de Atari VCS (Video Computer System), convirtiéndose en el primer sistema de videojuegos en tener gran éxito, e hizo popular los cartuchos intercambiables.', 90.00, 0, 1, 1),
(5, 'PlayStation 3', 'PlayStation 3 (プレイステーション3 Pureisutēshon Surī?, oficialmente abreviada como PS3)4​ es la tercera videoconsola del modelo PlayStation de Sony Computer Entertainment. Es la quinta y última consola de Sony en ser diseñada por Ken Kutaragi y forma parte de las videoconsolas de séptima generación y sus competidores son la Xbox 360 de Microsoft y la Wii de Nintendo\r\n', 58.00, 0, 1, 1),
(6, 'PlayStation', 'PlayStation (プレイステーション Pureisutēshon, oficialmente abreviada como PS1) es la primera videoconsola de Sony, y la primera de dicha compañía en ser diseñada por Ken Kutaragi, y es una videoconsola de sobremesa de 32 bits lanzada por Sony Computer Entertainment el 3 de diciembre de 1994 en Japón. Se considera la videoconsola más exitosa de la quinta generación tanto en ventas como en popularidad.\r\n', 123.00, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gmail` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
