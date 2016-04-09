-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-08-2014 a las 13:10:27
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
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE IF NOT EXISTS `recibos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documento` varchar(100) DEFAULT NULL,
  `razon` varchar(100) DEFAULT NULL,
  `negociador` varchar(100) DEFAULT NULL,
  `negociador_nom` varchar(100) DEFAULT NULL,
  `numero` varchar(100) DEFAULT NULL,
  `seguro` varchar(100) DEFAULT NULL,
  `flete` varchar(100) DEFAULT NULL,
  `forma_pago` enum('Contado','Credito') DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  `provisional` tinyint(1) DEFAULT NULL,
  `tipo` enum('Natural','Juridica') DEFAULT NULL,
  `guia_id` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `recibos`
--

INSERT INTO `recibos` (`id`, `documento`, `razon`, `negociador`, `negociador_nom`, `numero`, `seguro`, `flete`, `forma_pago`, `fecha`, `provisional`, `tipo`, `guia_id`, `usuario`) VALUES
(3, '23-1442123', 'Coonorte', '2222', 'Carlos Gomez', '654564', '0', '10000', 'Credito', '2014-08-08 03:28 PM', 0, 'Juridica', 1, 1),
(4, 'bcs234', NULL, '1231212312', 'Juan Alberto Gomez Pinzon', '4464654', '0', '10000', 'Contado', '2014-08-08 03:30 PM', NULL, 'Natural', 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
