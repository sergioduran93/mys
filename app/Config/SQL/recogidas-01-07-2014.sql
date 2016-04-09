-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-07-2014 a las 01:04:08
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mys`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recogidas`
--

CREATE TABLE IF NOT EXISTS `recogidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` enum('Registrada','Asignada','Anulada') DEFAULT NULL,
  `clienteTel` varchar(100) DEFAULT NULL,
  `clienteNom` varchar(100) DEFAULT NULL,
  `clienteCc` varchar(100) DEFAULT NULL,
  `clienteDir` varchar(100) DEFAULT NULL,
  `clienteCiu` varchar(100) DEFAULT NULL,
  `remitente` int(11) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `llamo` varchar(100) DEFAULT NULL,
  `preguntar` varchar(100) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `observaciones` text,
  `cantidad` varchar(100) DEFAULT NULL,
  `detalle` text,
  `desde` varchar(100) DEFAULT NULL,
  `hasta` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` varchar(100) DEFAULT NULL,
  `placa` varchar(100) DEFAULT NULL,
  `conductor_id` varchar(100) DEFAULT NULL,
  `conductor_nombre` varchar(100) DEFAULT NULL,
  `hora_asig` varchar(100) DEFAULT NULL,
  `observaciones2` text,
  `usuario_registra` varchar(100) DEFAULT NULL,
  `usuario_asigna` int(11) DEFAULT NULL,
  `usuario_anula` varchar(100) DEFAULT NULL,
  `anulo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `recogidas`
--

INSERT INTO `recogidas` (`id`, `estado`, `clienteTel`, `clienteNom`, `clienteCc`, `clienteDir`, `clienteCiu`, `remitente`, `direccion`, `ciudad`, `llamo`, `preguntar`, `cargo`, `telefono`, `observaciones`, `cantidad`, `detalle`, `desde`, `hasta`, `fecha`, `hora`, `placa`, `conductor_id`, `conductor_nombre`, `hora_asig`, `observaciones2`, `usuario_registra`, `usuario_asigna`, `usuario_anula`, `anulo`) VALUES
(1, 'Anulada', '1234567890', 'Esteban Arango Sanchez', '32123123', 'Cll 23 # 54 - 23', 'MEDELLIN (ANTIOQUIA)', 2, 'Cll 46 79', 1, '', 'jkl', 'kkjkl', '11111111', 'Obs 1', '7', 'Sobres', '03:23 PM', '03:23 PM', '2014-07-18', '03:23 PM', 'bcs234', '1231212312', 'Juan Alberto Gomez Pinzon', '03:26 PM', 'Obs 2', 'Esteban Arango', 0, 'Esteban Arango', 'Esteban'),
(2, 'Anulada', '0987654321', 'Leidy Jimenez', '123456789', 'Cra 23 # 23 - 23', 'ABEJORRAL (ANTIOQUIA)', 11, 'Cra 23 45 67', 18, '', '456456', '4456', '56456456', 'Obs 1.1', '5', 'Cajas', '03:30 PM', '03:33 PM', '2014-07-17', '03:24 PM', NULL, NULL, NULL, NULL, NULL, 'Esteban Arango', NULL, 'Esteban Arango', 'Jose'),
(3, 'Anulada', '1234567890', 'Esteban Arango Sanchez', '32123123', 'Cll 23 # 54 - 23', 'MEDELLIN (ANTIOQUIA)', 11, 'Cra 23 45 67', 18, 'Maria', 'Ana maria', 'Bodega', '56456456', '', '10', '', '06:21 PM', '06:29 PM', '2014-07-17', '06:29 PM', 'bcs234', '546', 'Juan   ', '06:32 PM', 'fgh', 'Esteban Arango', 0, 'Esteban Arango', 'Julian'),
(4, 'Registrada', '1234567890', 'Esteban Arango Sanchez', '32123123', 'Cll 23 # 54 - 23', 'MEDELLIN (ANTIOQUIA)', NULL, 'Cra 23 45 67', 18, 'Maria', 'Ana maria', 'Bodega', '56456456', '', '10', '', '06:21 PM', '06:29 PM', '2014-07-17', '06:29 PM', NULL, NULL, NULL, NULL, NULL, 'Esteban Arango', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
