-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-09-2014 a las 22:10:03
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
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oficina` varchar(50) DEFAULT NULL,
  `remesa` varchar(100) DEFAULT NULL,
  `facturacion` varchar(100) DEFAULT NULL,
  `documento1` varchar(100) DEFAULT NULL,
  `documento2` varchar(100) DEFAULT NULL,
  `documento3` varchar(100) DEFAULT NULL,
  `tipo` enum('Remisión','Factura','Guía','Planilla','Ninguno','C. Costo') DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `remitente` int(11) DEFAULT NULL,
  `destinatario` int(11) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `contacto_tel` varchar(100) DEFAULT NULL,
  `origen` int(11) DEFAULT NULL,
  `destino` int(11) DEFAULT NULL,
  `barras` int(11) DEFAULT NULL,
  `firmado` enum('Si','No') DEFAULT NULL,
  `observaciones` text,
  `contenido` text,
  `fecha` date DEFAULT NULL,
  `hora` varchar(10) DEFAULT NULL,
  `declarado` varchar(100) DEFAULT NULL,
  `empaque_info` text,
  `kilo_adic` varchar(100) DEFAULT NULL,
  `valor_kilo_adic` varchar(100) DEFAULT NULL,
  `desc_flete` varchar(100) DEFAULT NULL,
  `desc_kilo` varchar(100) DEFAULT NULL,
  `valor_seguro` varchar(100) DEFAULT NULL,
  `valor_devolucion` varchar(100) DEFAULT NULL,
  `valor_total` varchar(100) DEFAULT NULL,
  `kilo_nego` varchar(100) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `recaudador` int(11) DEFAULT NULL,
  `otro_remi` int(2) DEFAULT NULL,
  `faxDest` varchar(100) DEFAULT NULL,
  `emailDest` varchar(100) DEFAULT NULL,
  `telefono2Dest` varchar(100) DEFAULT NULL,
  `telefonoDest` varchar(100) DEFAULT NULL,
  `direccionDest` varchar(100) DEFAULT NULL,
  `nombreDest` varchar(100) DEFAULT NULL,
  `documentoDest` varchar(100) DEFAULT NULL,
  `emailRemi` varchar(100) DEFAULT NULL,
  `celularRemi` varchar(100) DEFAULT NULL,
  `telefonoRemi` varchar(100) DEFAULT NULL,
  `direccionRemi` varchar(100) DEFAULT NULL,
  `nombreRemi` varchar(100) DEFAULT NULL,
  `documentoRemi` varchar(100) DEFAULT NULL,
  `faxClien` varchar(100) DEFAULT NULL,
  `emailClien` varchar(100) DEFAULT NULL,
  `telefono2Clien` varchar(100) DEFAULT NULL,
  `telefonoClien` varchar(100) DEFAULT NULL,
  `direccionClien` varchar(100) DEFAULT NULL,
  `nombreClien` varchar(100) DEFAULT NULL,
  `documentoClien` varchar(100) DEFAULT NULL,
  `clase` enum('Contado','Credito','Contraentrega','Credicontado','Especial') DEFAULT NULL,
  `despachada` varchar(100) DEFAULT NULL,
  `tipo_despacho` varchar(50) DEFAULT NULL,
  `novedad` varchar(100) DEFAULT NULL,
  `cedula_recibio2` varchar(100) DEFAULT NULL,
  `recibido2` varchar(100) DEFAULT NULL,
  `observaciones_recibio` varchar(100) DEFAULT NULL,
  `fecha_recibio` varchar(100) DEFAULT NULL,
  `telefono_recibido` varchar(100) DEFAULT NULL,
  `sello` varchar(10) DEFAULT NULL,
  `cargo_recibido` varchar(100) DEFAULT NULL,
  `cedula_recibio` varchar(100) DEFAULT NULL,
  `recibio` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `oficina`, `remesa`, `facturacion`, `documento1`, `documento2`, `documento3`, `tipo`, `cliente`, `remitente`, `destinatario`, `contacto`, `contacto_tel`, `origen`, `destino`, `barras`, `firmado`, `observaciones`, `contenido`, `fecha`, `hora`, `declarado`, `empaque_info`, `kilo_adic`, `valor_kilo_adic`, `desc_flete`, `desc_kilo`, `valor_seguro`, `valor_devolucion`, `valor_total`, `kilo_nego`, `usuario`, `recaudador`, `otro_remi`, `faxDest`, `emailDest`, `telefono2Dest`, `telefonoDest`, `direccionDest`, `nombreDest`, `documentoDest`, `emailRemi`, `celularRemi`, `telefonoRemi`, `direccionRemi`, `nombreRemi`, `documentoRemi`, `faxClien`, `emailClien`, `telefono2Clien`, `telefonoClien`, `direccionClien`, `nombreClien`, `documentoClien`, `clase`, `despachada`, `tipo_despacho`, `novedad`, `cedula_recibio2`, `recibido2`, `observaciones_recibio`, `fecha_recibio`, `telefono_recibido`, `sello`, `cargo_recibido`, `cedula_recibio`, `recibio`) VALUES
(1, '1', '11-1', '', '', '', '', NULL, 2, NULL, 2, '', '', 1, 1, NULL, 'No', 'NO', 'Sobres navideños', '2014-09-23', '01:13 PM', '100,000', '{"empaques":["1"],"cantidad":["10"],"largo":["0"],"ancho":["0"],"alto":["0"],"peso":["0"],"pesoVol":["0"],"valor":["110"],"kiloAd":["115"],"subtotal":null}', '0', '0', '0', '0', '988.89', '0', '2100', '1150', 1, 1, 0, '456456456456', 'asd@asd.as', '', '4515456', 'cll 3 5 7 8', 'Alejandro  Gomez Torres', '147852369', '', '', '', '', '', '', '545643', 'teban.unal@gmail.com', '1234567890', '1234567890', 'Cll 23 # 54 - 23', 'Esteban Arango Sanchez', '32123123', 'Contado', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '1', '11-2', '', '', '', '', NULL, 2, NULL, 2, '', '', 1, 1, NULL, 'No', 'NO', 'Costales', '2014-09-23', '01:24 PM', '10,000', '{"empaques":["5"],"cantidad":["10"],"largo":["0"],"ancho":["0"],"alto":["0"],"peso":["0"],"pesoVol":["0"],"valor":["115"],"kiloAd":["119"],"subtotal":null}', '0', '0', '0', '0', '88.89', '0', '1200', '1190', 1, 1, 0, '456456456456', 'asd@asd.as', '', '4515456', 'cll 3 5 7 8', 'Alejandro  Gomez Torres', '147852369', '', '', '', '', '', '', '545643', 'teban.unal@gmail.com', '1234567890', '1234567890', 'Cll 23 # 54 - 23', 'Esteban Arango Sanchez', '32123123', 'Contado', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '1', '11-3', '', '', '', '', NULL, 2, NULL, 2, '', '', 1, 1, NULL, 'No', 'NO', 'Nada', '2014-09-23', '01:28 PM', '100,000', '{"empaques":["2"],"cantidad":["10"],"largo":["0"],"ancho":["0"],"alto":["0"],"peso":["0"],"pesoVol":["0"],"valor":["111"],"kiloAd":["116"],"subtotal":null}', '0', '0', '0', '0', '988.89', '0', '2100', '1160', 1, 1, 0, '456456456456', 'asd@asd.as', '', '4515456', 'cll 3 5 7 8', 'Alejandro  Gomez Torres', '147852369', '', '', '', '', '', '', '545643', 'teban.unal@gmail.com', '1234567890', '1234567890', 'Cll 23 # 54 - 23', 'Esteban Arango Sanchez', '32123123', 'Contado', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '1', '11-4', '', '123123', '', '', NULL, 2, NULL, 2, '', NULL, 1, 1, NULL, 'No', 'NO', 'Cajas', '2014-09-23', '01:50 PM', '100,000', '{"empaques":["4"],"cantidad":["1"],"largo":["0"],"ancho":["0"],"alto":["0"],"peso":["0"],"pesoVol":["0"],"valor":["114"],"kiloAd":["118"],"subtotal":null}', '0', '0', '3', '0', '988.89', '0', '1099', '118', 1, 1, 0, '456456456456', 'asd@asd.as', '', '4515456', 'cll 3 5 7 8', 'Alejandro  Gomez Torres', '147852369', '', '', '', '', '', '', '545643', 'teban.unal@gmail.com', '1234567890', '1234567890', 'Cll 23 # 54 - 23', 'Esteban Arango Sanchez', '32123123', 'Credito', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
