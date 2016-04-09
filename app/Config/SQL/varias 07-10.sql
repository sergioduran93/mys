-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-10-2014 a las 20:24:12
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
-- Estructura de tabla para la tabla `despachos`
--

CREATE TABLE IF NOT EXISTS `despachos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `negociador` int(11) DEFAULT NULL,
  `placa` int(11) DEFAULT NULL,
  `conductor` int(11) DEFAULT NULL,
  `origen` int(11) DEFAULT NULL,
  `destino` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `guias` varchar(100) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `valores` varchar(200) DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
--
-- Estructura de tabla para la tabla `nacionales`
--

CREATE TABLE IF NOT EXISTS `nacionales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `negociador` int(11) DEFAULT NULL,
  `representante` int(11) DEFAULT NULL,
  `destinatario` int(11) DEFAULT NULL,
  `origen` int(11) DEFAULT NULL,
  `destino` int(11) DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `guias` varchar(100) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `valores` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos 
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
  `fecha` varchar(100) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `guias` varchar(100) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `valores` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos p------------

--
-- Estructura de tabla para la tabla `traslados`
--

CREATE TABLE IF NOT EXISTS `traslados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `negociador` int(11) DEFAULT NULL,
  `placa` int(11) DEFAULT NULL,
  `conductor` int(11) DEFAULT NULL,
  `origen` int(11) DEFAULT NULL,
  `destino` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `guias` varchar(100) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `valores` varchar(200) DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_escan` int(11) DEFAULT NULL,
  `fecha_escan` varchar(100) DEFAULT NULL,
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
  `reempaque` int(11) DEFAULT NULL,
  `despacho` int(11) DEFAULT NULL,
  `virtual` int(11) DEFAULT NULL,
  `fecha_virtual` varchar(100) DEFAULT NULL,
  `usuario_confirm` int(11) DEFAULT NULL,
  `fecha_confirm` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `usuario_escan`, `fecha_escan`, `oficina`, `remesa`, `facturacion`, `documento1`, `documento2`, `documento3`, `tipo`, `cliente`, `remitente`, `destinatario`, `contacto`, `contacto_tel`, `origen`, `destino`, `barras`, `firmado`, `observaciones`, `contenido`, `fecha`, `hora`, `declarado`, `empaque_info`, `kilo_adic`, `valor_kilo_adic`, `desc_flete`, `desc_kilo`, `valor_seguro`, `valor_devolucion`, `valor_total`, `kilo_nego`, `usuario`, `recaudador`, `otro_remi`, `faxDest`, `emailDest`, `telefono2Dest`, `telefonoDest`, `direccionDest`, `nombreDest`, `documentoDest`, `emailRemi`, `celularRemi`, `telefonoRemi`, `direccionRemi`, `nombreRemi`, `documentoRemi`, `faxClien`, `emailClien`, `telefono2Clien`, `telefonoClien`, `direccionClien`, `nombreClien`, `documentoClien`, `clase`, `despachada`, `tipo_despacho`, `novedad`, `cedula_recibio2`, `recibido2`, `observaciones_recibio`, `fecha_recibio`, `telefono_recibido`, `sello`, `cargo_recibido`, `cedula_recibio`, `recibio`, `reempaque`, `despacho`, `virtual`, `fecha_virtual`, `usuario_confirm`, `fecha_confirm`) VALUES
(1, NULL, NULL, '1', '11-1', 'OC-1153', '131231321', '', '', NULL, 2, NULL, 1, '', '', 1, 1, NULL, 'No', 'NO', 'Dinero', '2014-10-07', '12:20 PM', '100,000', '{"empaques":["1"],"cantidad":["10"],"largo":["10"],"ancho":["10"],"alto":["10"],"peso":["100.00"],"pesoVol":["4"],"valor":["110"],"kiloAd":["115"],"subtotal":null}', '0', '0', '0', '0', '988.89', '0', '2100', '1150', 1, 1, 0, '', '', '', '23123123', 'CLL 12 # 34 - 56', 'Esteban  Arango Sanchez', '123456789', '', '', '', '', '', '', '545643', 'teban.unal@gmail.com', '1234567890', '1234567890', 'Cll 23 # 54 - 23', 'Esteban Arango Sanchez', '32123123', 'Contado', 'Despachada', 'Vehiculo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(2, NULL, NULL, '1', '11-2', '', '1212', '', '', NULL, 2, NULL, 1, '', NULL, 1, 1, NULL, 'No', 'NO', 'Tarjetas', '2014-10-07', '12:38 PM', '545,464', '{"empaques":["1"],"cantidad":["10"],"largo":["10"],"ancho":["20"],"alto":["50"],"peso":["100.00"],"pesoVol":["40"],"valor":["110"],"kiloAd":["115"],"subtotal":null}', '0', '0', '0', '0', '5443,53', '0', '6544', '1150', 1, 1, 0, '', '', '', '1231321', 'CLL 12 # 34 - 56', 'Esteban  Arango Sanchez', '123456789', '', '', '', '', '', '', '545643', 'teban.unal@gmail.com', '1234567890', '1234567890', 'Cll 23 # 54 - 23', 'Esteban Arango Sanchez', '32123123', 'Credito', 'Despachada', 'Vehiculo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(3, NULL, NULL, '1', '11-3', '', '12312323', '', '', NULL, 2, NULL, 1, '', NULL, 1, 1, NULL, 'No', 'NO', 'caja', '2014-10-07', '01:28 PM', '54,545,656', '{"empaques":["3"],"cantidad":["10"],"largo":["10"],"ancho":["10"],"alto":["10"],"peso":["100.00"],"pesoVol":["4"],"valor":["112"],"kiloAd":["117"],"subtotal":null}', '0', '0', '0', '0', '545445,45', '0', '546565', '1170', 1, 1, 0, '', '', '', '', 'CLL 12 # 34 - 56', 'Esteban  Arango Sanchez', '123456789', '', '', '', '', '', '', '545643', 'teban.unal@gmail.com', '1234567890', '1234567890', 'Cll 23 # 54 - 23', 'Esteban Arango Sanchez', '32123123', 'Credito', 'Despachada', 'Representante', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, '1', '11-4', '', '12312323', '', '', NULL, 2, NULL, 1, '', NULL, 1, 1, NULL, 'No', 'NO', 'caja', '2014-10-07', '01:28 PM', '54,545,656', '{"empaques":["3"],"cantidad":["10"],"largo":["10"],"ancho":["10"],"alto":["10"],"peso":["100.00"],"pesoVol":["4"],"valor":["112"],"kiloAd":["117"],"subtotal":null}', '0', '0', '0', '0', '545445,45', '0', '546565', '1170', 1, 1, 0, '', '', '', '4357674583478', 'CLL 12 # 34 - 56', 'Esteban  Arango Sanchez', '123456789', '', '', '', '', '', '', '545643', 'teban.unal@gmail.com', '1234567890', '1234567890', 'Cll 23 # 54 - 23', 'Esteban Arango Sanchez', '32123123', 'Credito', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, '1', '11-5', '', '54645', '', '', NULL, 2, NULL, 1, '', NULL, 1, 1, NULL, 'No', 'NO', 'Sobres', '2014-10-07', '01:44 PM', '1,231,321', '{"empaques":["1"],"cantidad":["5"],"largo":["5"],"ancho":["5"],"alto":["5"],"peso":["25.00"],"pesoVol":["0"],"valor":["110"],"kiloAd":["115"],"subtotal":null}', '0', '0', '0', '0', '12302.1', '0', '12852', '575', 1, 1, 0, '', '', '', '54654', 'CLL 12 # 34 - 56', 'Esteban  Arango Sanchez', '123456789', '', '', '', '', '', '', '545643', 'teban.unal@gmail.com', '1234567890', '1234567890', 'Cll 23 # 54 - 23', 'Esteban Arango Sanchez', '32123123', 'Credito', 'Despachada', 'Representante', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
