-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2016 a las 19:34:59
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examen`
--
CREATE DATABASE IF NOT EXISTS `examen` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `examen`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `aforo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `aforo`) VALUES
(1, 'Evento 1', 100),
(2, 'Evento 2', 101),
(3, 'Evento 3', 102),
(4, 'Evento 4', 103),
(5, 'Evento 5', 104),
(6, 'Evento 6', 105);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventofecha`
--

DROP TABLE IF EXISTS `eventofecha`;
CREATE TABLE IF NOT EXISTS `eventofecha` (
  `id` int(11) NOT NULL,
  `eventoid` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `localizacion` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventofecha`
--

INSERT INTO `eventofecha` (`id`, `eventoid`, `fecha`, `localizacion`) VALUES
(1, 1, '2016-03-02', 'vigo'),
(2, 3, '2016-03-16', 'pontevedra'),
(3, 5, '0000-00-00', 'madrid'),
(4, 5, '2016-03-02', 'marin'),
(5, 5, '2016-03-11', 'coruña');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cif` varchar(9) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `web` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `nombre`, `cif`, `domicilio`, `web`) VALUES
(1, 'grupo 1', 'A00000001', 'calle s/n 1', 'web.dominio.com'),
(2, 'Grupo2', 'A00000002', 'Calle s/n 2', 'web.dominio2.com'),
(3, 'Grupo3', 'A00000003', 'calle s/n 3', 'web.dominio3.com'),
(4, 'Grupo4', 'A00000004', 'calle s/n 4', 'web.dominio4.com'),
(5, 'Grupo5', 'A00000005', 'calle s/n 5', 'web.dominio5.com'),
(6, 'gruponuevo', '99988877A', 'domicilio1', 'unaweb.dominio.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participanteeventofecha`
--

DROP TABLE IF EXISTS `participanteeventofecha`;
CREATE TABLE IF NOT EXISTS `participanteeventofecha` (
  `id` int(11) NOT NULL,
  `idparticipante` int(11) NOT NULL,
  `ideventofecha` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `participanteeventofecha`
--

INSERT INTO `participanteeventofecha` (`id`, `idparticipante`, `ideventofecha`) VALUES
(1, 1, 3),
(2, 1, 5),
(3, 2, 5),
(4, 3, 1),
(5, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantesproducto`
--

DROP TABLE IF EXISTS `participantesproducto`;
CREATE TABLE IF NOT EXISTS `participantesproducto` (
  `id` int(11) NOT NULL,
  `participanteid` int(11) NOT NULL,
  `productoid` int(11) NOT NULL,
  `unidades` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `participantesproducto`
--

INSERT INTO `participantesproducto` (`id`, `participanteid`, `productoid`, `unidades`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 1),
(3, 3, 2, 1),
(4, 3, 3, 1),
(5, 3, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `telefono` int(9) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `idgrupo` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `mail`, `nif`, `telefono`, `direccion`, `idgrupo`) VALUES
(1, 'paco', 'mimail@gmail.com', '00000001A', 0, 's/n', 1),
(2, 'paco2', 'mimail@gmail.com', '00000001B', 0, 's/n', 2),
(3, 'paco3', 'mimail3@gmail.com', '00000004C', 0, 's/n', 3),
(4, 'paco4', 'mimail4@gmail.com', '00000004E', 0, 's/n', 4),
(5, 'pepe', 'mimail5@gmail.com', '00000005D', 0, 's/n', 5),
(6, 'personanueva', 'unmail@email.com', '01234568A', 123456789, 's/n', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` float NOT NULL,
  `categoria` int(11) NOT NULL,
  `caducidad` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `tiendaRecogida` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `descripcion`, `stock`, `precio`, `categoria`, `caducidad`, `estado`, `tiendaRecogida`) VALUES
(1, 'comida', 12, 1, 5, '2016-03-23', 1, 1),
(2, 'bebida', 2, 2, 5, '2016-03-16', 1, 2),
(3, 'consumible', 2, 1, 5, '2016-03-16', 1, 2),
(4, 'martillo', 2, 2, 5, '2016-03-16', 1, 1),
(5, 'mechero', 2, 2, 5, '2016-03-16', 1, 2),
(6, 'taladro', 2, 2, 5, '2016-03-16', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productocategoría`
--

DROP TABLE IF EXISTS `productocategoría`;
CREATE TABLE IF NOT EXISTS `productocategoría` (
  `id` int(11) NOT NULL,
  `categoría` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productocategoría`
--

INSERT INTO `productocategoría` (`id`, `categoría`) VALUES
(1, 'Muebles'),
(2, 'Comida'),
(3, 'Consumibles'),
(4, 'Herramientas'),
(5, 'Varios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoestado`
--

DROP TABLE IF EXISTS `productoestado`;
CREATE TABLE IF NOT EXISTS `productoestado` (
  `id` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productoestado`
--

INSERT INTO `productoestado` (`id`, `estado`) VALUES
(1, 'Propuesto'),
(2, 'Aceptado'),
(3, 'Sin existencias'),
(4, 'Retirado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

DROP TABLE IF EXISTS `tienda`;
CREATE TABLE IF NOT EXISTS `tienda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `codigoPostal` int(5) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `fax` int(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id`, `nombre`, `direccion`, `codigoPostal`, `ciudad`, `mail`, `fax`) VALUES
(1, 'tienda 1', 's/n', 22222, 'vigo', 'pontevedra', 999000555),
(2, 'tienda 2', 's/n', 22222, 'vigo', 'pontevedra', 999000555),
(3, 'tienda 3', 's/n', 22222, 'vigo', 'pontevedra', 999000555),
(4, 'tienda 4', 's/n', 22222, 'vigo', 'pontevedra', 999000555),
(5, 'tienda 5', 's/n', 22222, 'vigo', 'pontevedra', 999000555);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventofecha`
--
ALTER TABLE `eventofecha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eventoid` (`eventoid`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `participanteeventofecha`
--
ALTER TABLE `participanteeventofecha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idparticipante` (`idparticipante`),
  ADD KEY `ideventofecha` (`ideventofecha`);

--
-- Indices de la tabla `participantesproducto`
--
ALTER TABLE `participantesproducto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participanteid` (`participanteid`,`productoid`),
  ADD KEY `fk_productoid` (`productoid`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idgrupo` (`idgrupo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tiendaRecogida` (`tiendaRecogida`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `productocategoría`
--
ALTER TABLE `productocategoría`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productoestado`
--
ALTER TABLE `productoestado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `eventofecha`
--
ALTER TABLE `eventofecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `participanteeventofecha`
--
ALTER TABLE `participanteeventofecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `participantesproducto`
--
ALTER TABLE `participantesproducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `productocategoría`
--
ALTER TABLE `productocategoría`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `productoestado`
--
ALTER TABLE `productoestado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventofecha`
--
ALTER TABLE `eventofecha`
  ADD CONSTRAINT `fk_evento2` FOREIGN KEY (`eventoid`) REFERENCES `evento` (`id`);

--
-- Filtros para la tabla `participanteeventofecha`
--
ALTER TABLE `participanteeventofecha`
  ADD CONSTRAINT `fk_eventofecha` FOREIGN KEY (`ideventofecha`) REFERENCES `eventofecha` (`eventoid`),
  ADD CONSTRAINT `fk_participante` FOREIGN KEY (`idparticipante`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `participantesproducto`
--
ALTER TABLE `participantesproducto`
  ADD CONSTRAINT `fk_participanteid` FOREIGN KEY (`participanteid`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `fk_productoid` FOREIGN KEY (`productoid`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_grupopersona` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_productoestado` FOREIGN KEY (`estado`) REFERENCES `productoestado` (`id`),
  ADD CONSTRAINT `fk_tiendaid` FOREIGN KEY (`tiendaRecogida`) REFERENCES `tienda` (`id`),
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `productocategoría` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
