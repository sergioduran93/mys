-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-09-2014 a las 21:16:06
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
-- Estructura de tabla para la tabla `reempaques`
--

CREATE TABLE IF NOT EXISTS `reempaques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `negociador` int(11) DEFAULT NULL,
  `representante` int(11) DEFAULT NULL,
  `destinatario` int(11) DEFAULT NULL,
  `origen` int(11) DEFAULT NULL,
  `destino` int(11) DEFAULT NULL,
  `barras` varchar(100) DEFAULT NULL,
  `guias` varchar(100) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `reempaques`
--

INSERT INTO `reempaques` (`id`, `negociador`, `representante`, `destinatario`, `origen`, `destino`, `barras`, `guias`, `valor`) VALUES
(1, 1, 1, 1, 1, 1, '', '["3"]', '-161.67'),
(3, 1, 3, 1, 1, 1, '', '["1","2","3","4"]', '0'),
(4, 1, 1, 1, 1, 1, '', '["1","2"]', '-388.00'),
(5, NULL, 5, NULL, 1, 3, '', '["1","3"]', '11000.00'),
(6, NULL, 5, NULL, 1, 3, '', '["1","3"]', '11000.00'),
(7, 1, 5, NULL, 1, 5, '', '["2"]', '3000.00'),
(8, 1, 5, 15, 1, 3, '', '["4"]', '300.00'),
(9, 2, 1, 1, 1, 1, '', '["5"]', '8000.00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
