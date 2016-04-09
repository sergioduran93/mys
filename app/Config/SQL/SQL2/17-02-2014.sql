-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-02-2014 a las 18:03:42
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
-- Estructura de tabla para la tabla `agencias`
--

CREATE TABLE IF NOT EXISTS `agencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono1` varchar(100) DEFAULT NULL,
  `telefono2` varchar(100) DEFAULT NULL,
  `telefono3` varchar(100) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `municipio` int(11) DEFAULT NULL,
  `transportadora_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `agencias`
--

INSERT INTO `agencias` (`id`, `contacto`, `telefono1`, `telefono2`, `telefono3`, `celular`, `municipio`, `transportadora_id`) VALUES
(15, '5132', '132', '13', '21', '123', 14, 5),
(16, 'Luis Perez', '544841231', '15672451', '12156463156', '30114464564', 1, 3),
(17, 'jose martinez', '456454', '545645645', '4645', '301545644', 2, 3),
(18, 'Abecdf', '54561231', '2123', '156', '2310512', 7, 3),
(19, 'cv', 'xcv', 'xcv', 'xcv', 'xcv', 3, 3),
(23, '32123', '123', '123', '123', '123', 11, 4),
(24, 'juan', '231', '23', '123', '131', 12, 4),
(25, '13', '123', '1', '23123', '2123', 19, 4),
(26, 'carlos torres', '55645', '2222', '333333', '3012156', 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anticipos`
--

CREATE TABLE IF NOT EXISTS `anticipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oficina` int(11) DEFAULT NULL,
  `retiro_no` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` varchar(100) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `transaccion` varchar(100) DEFAULT NULL,
  `realizo` varchar(100) DEFAULT NULL,
  `fecha_digito` date DEFAULT NULL,
  `hora_digito` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `anticipos`
--

INSERT INTO `anticipos` (`id`, `oficina`, `retiro_no`, `fecha`, `hora`, `valor`, `transaccion`, `realizo`, `fecha_digito`, `hora_digito`) VALUES
(8, 1, '1', '2014-02-04', '12:78 0', '12', '45', 'esteban', '2014-02-06', '08:44:07 PM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Clientes','Vendedor','Empleado','Proveedor') DEFAULT NULL,
  `persona` enum('Natural','Juridica') DEFAULT NULL,
  `activo` enum('Si','No') DEFAULT NULL,
  `causal` enum('Activo','Cartera morosa','Politica administrativa') DEFAULT NULL,
  `documento` int(20) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `contacto` text,
  `indicativo` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `telefono2` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `credito` enum('Si','No') DEFAULT NULL,
  `dias_facturacion` varchar(100) DEFAULT NULL,
  `especial` enum('Si','No') DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `numero_guias` int(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cartera_negociable` enum('Si','No') DEFAULT NULL,
  `facturar` varchar(100) DEFAULT NULL,
  `documento_fact` varchar(100) DEFAULT NULL,
  `nombres_fact` varchar(100) DEFAULT NULL,
  `apellidos_fact` varchar(100) DEFAULT NULL,
  `direccion_fact` varchar(100) DEFAULT NULL,
  `telefono_fact` varchar(100) DEFAULT NULL,
  `cupo` float DEFAULT NULL,
  `destinos` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `tipo`, `persona`, `activo`, `causal`, `documento`, `nombres`, `apellidos`, `contacto`, `indicativo`, `telefono`, `telefono2`, `fax`, `direccion`, `credito`, `dias_facturacion`, `especial`, `celular`, `numero_guias`, `email`, `cartera_negociable`, `facturar`, `documento_fact`, `nombres_fact`, `apellidos_fact`, `direccion_fact`, `telefono_fact`, `cupo`, `destinos`) VALUES
(1, 'Clientes', 'Juridica', 'Si', 'Activo', NULL, 'Mandar y Servir S.A.S.', '', '[{"cargo":"","nombre":"","telefono":""}]', '', '', '', '', '', 'Si', '', 'Si', '', NULL, '', 'Si', '0', '', '', '', '', '', NULL, '["1"]'),
(9, 'Clientes', 'Natural', 'Si', 'Activo', 32123123, 'Esteban', 'Arango Sanchez', '[{"cargo":"Secretaria","nombre":"Ana Perez Gonzalez","telefono":"2334455"},{"cargo":"Gerente","nombre":"Luis Ruiz Ruiz","telefono":"123456"}]', '04', '6112233', '147823', '545643', 'Cll 23 # 54 - 23', 'Si', '30', 'Si', '3001234567', 2, 'teban@gmail.com', 'No', '0', '11111111', 'Leidy', 'Jimenez Pinzon', 'Cra 45 # 45 - 45', '6778899', 500000, '["1","7"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores`
--

CREATE TABLE IF NOT EXISTS `conductores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conductor` tinyint(1) DEFAULT NULL,
  `propietario` tinyint(1) DEFAULT NULL,
  `tenedor` tinyint(1) DEFAULT NULL,
  `identificacion` int(20) DEFAULT NULL,
  `tipo_doc` enum('RUT','CC','NIT','Otros') DEFAULT NULL,
  `dv` int(5) DEFAULT NULL,
  `nombre1` varchar(100) DEFAULT NULL,
  `nombre2` varchar(100) DEFAULT NULL,
  `apellido1` varchar(100) DEFAULT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `pase` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `conductores`
--

INSERT INTO `conductores` (`id`, `conductor`, `propietario`, `tenedor`, `identificacion`, `tipo_doc`, `dv`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `email`, `direccion`, `telefono`, `celular`, `ciudad`, `pase`, `fecha`) VALUES
(1, 0, 0, 1, 1231212312, 'NIT', 1, 'Juan', 'Alberto', 'Gomez', 'Pinzon', 'ja@gmail.com', 'Cll 12 # 45 - 45', '12545615', '3000124545', 6, '231564', '2013-10-01'),
(2, 0, 1, 0, 54646541, 'RUT', NULL, 'Luis', 'Alberto', 'Garcia', 'Torres', '', 'Cll 12 # 45 - 46', '12545616', '3000124546', 16, '231565', '2013-10-26'),
(4, 1, 1, 0, 546, 'RUT', 1, 'Juan', '', 'Ruiz', '', '', '', '', '', 561, '232', '2013-10-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE IF NOT EXISTS `datos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nit` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `fecha_habilitada` date DEFAULT NULL,
  `fecha_expiracion` date DEFAULT NULL,
  `poliza_aseguradora` varchar(100) DEFAULT NULL,
  `poliza_nit` varchar(100) DEFAULT NULL,
  `poliza_no` varchar(100) DEFAULT NULL,
  `poliza_vencimiento` date DEFAULT NULL,
  `poliza_inicio` date DEFAULT NULL,
  `manifiestos_no` varchar(100) DEFAULT NULL,
  `manifiestos_autorizacion` date DEFAULT NULL,
  `manifiestos_rango` text,
  `despachar` enum('Manifiestos','Planillas') DEFAULT NULL,
  `otro` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id`, `nit`, `nombre`, `ciudad`, `direccion`, `telefono`, `codigo`, `fecha_habilitada`, `fecha_expiracion`, `poliza_aseguradora`, `poliza_nit`, `poliza_no`, `poliza_vencimiento`, `poliza_inicio`, `manifiestos_no`, `manifiestos_autorizacion`, `manifiestos_rango`, `despachar`, `otro`) VALUES
(1, '111111111', 'Mandar y Servir S.A.S.', NULL, 'Cll 24 A 54 - 78', '4565644', '456', '2014-02-05', '2014-02-11', '456646', '4567-778', '4565456', '2014-02-25', '2014-02-14', '45645', '2014-02-08', '564', 'Manifiestos', '56456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `codigo`, `nombre`) VALUES
(1, 5, 'ANTIOQUIA'),
(2, 8, 'ATLANTICO'),
(3, 11, 'BOGOTÁ'),
(4, 13, 'BOLIVAR'),
(5, 15, 'BOYACA'),
(6, 17, 'CALDAS'),
(7, 18, 'CAQUETA'),
(8, 19, 'CAUCA'),
(9, 20, 'CESAR'),
(10, 23, 'CORDOBA'),
(11, 25, 'CUNDINAMARCA'),
(12, 27, 'CHOCO'),
(13, 41, 'HUILA'),
(14, 44, 'LA GUAJIRA'),
(15, 47, 'MAGDALENA'),
(16, 50, 'META'),
(17, 52, 'NARIÑO'),
(18, 54, 'NORTE DE SANTANDER'),
(19, 63, 'QUINDIO'),
(20, 66, 'RISARALDA'),
(21, 68, 'SANTANDER'),
(22, 70, 'SUCRE'),
(23, 73, 'TOLIMA'),
(24, 76, 'VALLE DEL CAUCA'),
(25, 81, 'ARAUCA'),
(26, 85, 'CASANARE'),
(27, 86, 'PUTUMAYO'),
(28, 88, 'SAN ANDRES'),
(29, 91, 'AMAZONAS'),
(30, 94, 'GUAINIA'),
(31, 95, 'GUAVAIRE'),
(32, 97, 'VAUPES'),
(33, 99, 'VICHADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE IF NOT EXISTS `descuentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_inicial` int(11) DEFAULT NULL,
  `unidad_final` int(11) DEFAULT NULL,
  `unidad_porcentaje` double(20,5) DEFAULT NULL,
  `kilo_inicial` int(11) DEFAULT NULL,
  `kilo_final` int(11) DEFAULT NULL,
  `kilo_porcentaje` double(20,5) DEFAULT NULL,
  `origen` int(11) DEFAULT NULL,
  `destino` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `unidad_inicial`, `unidad_final`, `unidad_porcentaje`, `kilo_inicial`, `kilo_final`, `kilo_porcentaje`, `origen`, `destino`, `cliente_id`) VALUES
(1, 1, 2, 3.00000, NULL, NULL, NULL, 1, 1, 9),
(2, NULL, NULL, NULL, 4, 5, 6.00000, 1, 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinatarios`
--

CREATE TABLE IF NOT EXISTS `destinatarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documento` varchar(100) DEFAULT NULL,
  `nombre1` varchar(100) DEFAULT NULL,
  `nombre2` varchar(100) DEFAULT NULL,
  `apellido1` varchar(100) DEFAULT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `tipo` enum('Natural','Juridica') DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `ext` varchar(50) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `contacto` text,
  `destinos` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `destinatarios`
--

INSERT INTO `destinatarios` (`id`, `documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `tipo`, `direccion`, `telefono`, `ext`, `celular`, `email`, `fax`, `contacto`, `destinos`) VALUES
(1, '11111', 'Cocacola', '', '', '', 'Juridica', 'Cll 65 - 5 8 ', '456', '4', '64', 'coca@gmail.com', '56', '[{"nombre":"Juancho Zuleta","telefono":"qwe"},{"nombre":"sdf","telefono":"sf"}]', '["3","6"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

CREATE TABLE IF NOT EXISTS `destinos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `region_id` int(11) NOT NULL,
  `departamento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1121 ;

--
-- Volcado de datos para la tabla `destinos`
--

INSERT INTO `destinos` (`id`, `codigo`, `nombre`, `region_id`, `departamento_id`) VALUES
(1, 5001, 'MEDELLIN', 0, 1),
(2, 5002, 'ABEJORRAL', 0, 1),
(3, 5004, 'ABRIAQUI', 1, 1),
(4, 5021, 'ALEJANDRIA', 1, 1),
(5, 5030, 'AMAGA', 1, 1),
(6, 5031, 'AMALFI', 3, 1),
(7, 5034, 'ANDES', 0, 1),
(8, 5036, 'ANGELOPOLIS', 1, 1),
(9, 5038, 'ANGOSTURA', 0, 1),
(10, 5040, 'ANORI', 0, 1),
(11, 5042, 'SANTAFE DE ANTIOQUIA', 0, 1),
(12, 5044, 'ANZA', 0, 1),
(13, 5045, 'APARTADO', 0, 1),
(14, 5051, 'ARBOLETES', 0, 1),
(15, 5055, 'ARGELIA', 0, 1),
(16, 5059, 'ARMENIA', 0, 1),
(17, 5079, 'BARBOSA', 0, 1),
(18, 5086, 'BELMIRA', 0, 1),
(19, 5088, 'BELLO', 0, 1),
(20, 5091, 'BETANIA', 0, 1),
(21, 5093, 'BETULIA', 0, 1),
(22, 5101, 'CIUDAD BOLIVAR', 0, 1),
(23, 5107, 'BRICEÑO', 0, 1),
(24, 5113, 'BURITICA', 0, 1),
(25, 5120, 'CACERES', 0, 1),
(26, 5125, 'CAICEDO', 0, 1),
(27, 5129, 'CALDAS', 0, 1),
(28, 5134, 'CAMPAMENTO', 0, 1),
(29, 5138, 'CAÑASGORDAS', 0, 1),
(30, 5142, 'CARACOLI', 0, 1),
(31, 5145, 'CARAMANTA', 0, 1),
(32, 5147, 'CAREPA', 0, 1),
(33, 5148, 'EL CARMEN DE VIBORAL', 0, 1),
(34, 5150, 'CAROLINA', 0, 1),
(35, 5154, 'CAUCASIA', 0, 1),
(36, 5172, 'CHIGORODO', 0, 1),
(37, 5190, 'CISNEROS', 0, 1),
(38, 5197, 'COCORNA', 0, 1),
(39, 5206, 'CONCEPCION', 0, 1),
(40, 5209, 'CONCORDIA', 0, 1),
(41, 5212, 'COPACABANA', 0, 1),
(42, 5234, 'DABEIBA', 0, 1),
(43, 5237, 'DON MATIAS', 0, 1),
(44, 5240, 'EBEJICO', 0, 1),
(45, 5250, 'EL BAGRE', 0, 1),
(46, 5264, 'ENTRERRIOS', 0, 1),
(47, 5266, 'ENVIGADO', 0, 1),
(48, 5282, 'FREDONIA', 0, 1),
(49, 5284, 'FRONTINO', 0, 1),
(50, 5306, 'GIRALDO', 0, 1),
(51, 5308, 'GIRARDOTA', 0, 1),
(52, 5310, 'GOMEZ PLATA', 0, 1),
(53, 5313, 'GRANADA', 0, 1),
(54, 5315, 'GUADALUPE', 0, 1),
(55, 5318, 'GUARNE', 0, 1),
(56, 5321, 'GUATAPE', 0, 1),
(57, 5347, 'HELICONIA', 0, 1),
(58, 5353, 'HISPANIA', 0, 1),
(59, 5360, 'ITAGUI', 0, 1),
(60, 5361, 'ITUANGO', 0, 1),
(61, 5364, 'JARDIN', 0, 1),
(62, 5368, 'JERICO', 0, 1),
(63, 5376, 'LA CEJA', 0, 1),
(64, 5380, 'LA ESTRELLA', 0, 1),
(65, 5390, 'LA PINTADA', 0, 1),
(66, 5400, 'LA UNION', 0, 1),
(67, 5411, 'LIBORINA', 0, 1),
(68, 5425, 'MACEO', 0, 1),
(69, 5440, 'MARINILLA', 0, 1),
(70, 5467, 'MONTEBELLO', 0, 1),
(71, 5475, 'MURINDO', 0, 1),
(72, 5480, 'MUTATA', 0, 1),
(73, 5483, 'NARIÑO', 0, 1),
(74, 5490, 'NECOCLI', 0, 1),
(75, 5495, 'NECHI', 0, 1),
(76, 5501, 'OLAYA', 0, 1),
(77, 5541, 'PEÐOL', 0, 1),
(78, 5543, 'PEQUE', 0, 1),
(79, 5576, 'PUEBLORRICO', 0, 1),
(80, 5579, 'PUERTO BERRIO', 0, 1),
(81, 5585, 'PUERTO NARE', 0, 1),
(82, 5591, 'PUERTO TRIUNFO', 0, 1),
(83, 5604, 'REMEDIOS', 0, 1),
(84, 5607, 'RETIRO', 0, 1),
(85, 5615, 'RIONEGRO', 0, 1),
(86, 5628, 'SABANALARGA', 0, 1),
(87, 5631, 'SABANETA', 0, 1),
(88, 5642, 'SALGAR', 0, 1),
(89, 5647, 'SAN ANDRES DE CUERQUIA', 0, 1),
(90, 5649, 'SAN CARLOS', 0, 1),
(91, 5652, 'SAN FRANCISCO', 0, 1),
(92, 5656, 'SAN JERONIMO', 0, 1),
(93, 5658, 'SAN JOSE DE LA MONTAÑA', 0, 1),
(94, 5659, 'SAN JUAN DE URABA', 0, 1),
(95, 5660, 'SAN LUIS', 0, 1),
(96, 5664, 'SAN PEDRO', 0, 1),
(97, 5665, 'SAN PEDRO DE URABA', 0, 1),
(98, 5667, 'SAN RAFAEL', 0, 1),
(99, 5670, 'SAN ROQUE', 0, 1),
(100, 5674, 'SAN VICENTE', 0, 1),
(101, 5679, 'SANTA BARBARA', 0, 1),
(102, 5686, 'SANTA ROSA DE OSOS', 0, 1),
(103, 5690, 'SANTO DOMINGO', 0, 1),
(104, 5697, 'EL SANTUARIO', 0, 1),
(105, 5736, 'SEGOVIA', 0, 1),
(106, 5756, 'SONSON', 0, 1),
(107, 5761, 'SOPETRAN', 0, 1),
(108, 5789, 'TAMESIS', 0, 1),
(109, 5790, 'TARAZA', 0, 1),
(110, 5792, 'TARSO', 0, 1),
(111, 5809, 'TITIRIBI', 0, 1),
(112, 5819, 'TOLEDO', 0, 1),
(113, 5837, 'TURBO', 0, 1),
(114, 5842, 'URAMITA', 0, 1),
(115, 5847, 'URRAO', 0, 1),
(116, 5854, 'VALDIVIA', 0, 1),
(117, 5856, 'VALPARAISO', 0, 1),
(118, 5858, 'VEGACHI', 0, 1),
(119, 5861, 'VENECIA', 0, 1),
(120, 5873, 'VIGIA DEL FUERTE', 0, 1),
(121, 5885, 'YALI', 0, 1),
(122, 5887, 'YARUMAL', 0, 1),
(123, 5890, 'YOLOMBO', 0, 1),
(124, 5893, 'YONDO', 0, 1),
(125, 5895, 'ZARAGOZA', 0, 1),
(126, 8001, 'BARRANQUILLA', 0, 2),
(127, 8078, 'BARANOA', 0, 2),
(128, 8137, 'CAMPO DE LA CRUZ', 0, 2),
(129, 8141, 'CANDELARIA', 0, 2),
(130, 8296, 'GALAPA', 0, 2),
(131, 8372, 'JUAN DE ACOSTA', 0, 2),
(132, 8421, 'LURUACO', 0, 2),
(133, 8433, 'MALAMBO', 0, 2),
(134, 8436, 'MANATI', 0, 2),
(135, 8520, 'PALMAR DE VARELA', 0, 2),
(136, 8549, 'PIOJO', 0, 2),
(137, 8558, 'POLONUEVO', 0, 2),
(138, 8560, 'PONEDERA', 0, 2),
(139, 8573, 'PUERTO COLOMBIA', 0, 2),
(140, 8606, 'REPELON', 0, 2),
(141, 8634, 'SABANAGRANDE', 0, 2),
(142, 8638, 'SABANALARGA', 0, 2),
(143, 8675, 'SANTA LUCIA', 0, 2),
(144, 8685, 'SANTO TOMAS', 0, 2),
(145, 8758, 'SOLEDAD', 0, 2),
(146, 8770, 'SUAN', 0, 2),
(147, 8832, 'TUBARA', 0, 2),
(148, 8849, 'USIACURI', 0, 2),
(149, 11001, 'BOGOTA, D.C.', 0, 3),
(150, 13001, 'CARTAGENA', 0, 4),
(151, 13006, 'ACHI', 0, 4),
(152, 13030, 'ALTOS DEL ROSARIO', 0, 4),
(153, 13042, 'ARENAL', 0, 4),
(154, 13052, 'ARJONA', 0, 4),
(155, 13062, 'ARROYOHONDO', 0, 4),
(156, 13074, 'BARRANCO DE LOBA', 0, 4),
(157, 13140, 'CALAMAR', 0, 4),
(158, 13160, 'CANTAGALLO', 0, 4),
(159, 13188, 'CICUCO', 0, 4),
(160, 13212, 'CORDOBA', 0, 4),
(161, 13222, 'CLEMENCIA', 0, 4),
(162, 13244, 'EL CARMEN DE BOLIVAR', 0, 4),
(163, 13248, 'EL GUAMO', 0, 4),
(164, 13268, 'EL PEÑON', 0, 4),
(165, 13300, 'HATILLO DE LOBA', 0, 4),
(166, 13430, 'MAGANGUE', 0, 4),
(167, 13433, 'MAHATES', 0, 4),
(168, 13440, 'MARGARITA', 0, 4),
(169, 13442, 'MARIA LA BAJA', 0, 4),
(170, 13458, 'MONTECRISTO', 0, 4),
(171, 13468, 'MOMPOS', 0, 4),
(172, 13490, 'NOROSI', 0, 4),
(173, 13473, 'MORALES', 0, 4),
(174, 13549, 'PINILLOS', 0, 4),
(175, 13580, 'REGIDOR', 0, 4),
(176, 13600, 'RIO VIEJO', 0, 4),
(177, 13620, 'SAN CRISTOBAL', 0, 4),
(178, 13647, 'SAN ESTANISLAO', 0, 4),
(179, 13650, 'SAN FERNANDO', 0, 4),
(180, 13654, 'SAN JACINTO', 0, 4),
(181, 13655, 'SAN JACINTO DEL CAUCA', 0, 4),
(182, 13657, 'SAN JUAN NEPOMUCENO', 0, 4),
(183, 13667, 'SAN MARTIN DE LOBA', 0, 4),
(184, 13670, 'SAN PABLO', 0, 4),
(185, 13673, 'SANTA CATALINA', 0, 4),
(186, 13683, 'SANTA ROSA', 0, 4),
(187, 13688, 'SANTA ROSA DEL SUR', 0, 4),
(188, 13744, 'SIMITI', 0, 4),
(189, 13760, 'SOPLAVIENTO', 0, 4),
(190, 13780, 'TALAIGUA NUEVO', 0, 4),
(191, 13810, 'TIQUISIO', 0, 4),
(192, 13836, 'TURBACO', 0, 4),
(193, 13838, 'TURBANA', 0, 4),
(194, 13873, 'VILLANUEVA', 0, 4),
(195, 13894, 'ZAMBRANO', 0, 4),
(196, 15001, 'TUNJA', 0, 5),
(197, 15022, 'ALMEIDA', 0, 5),
(198, 15047, 'AQUITANIA', 0, 5),
(199, 15051, 'ARCABUCO', 0, 5),
(200, 15087, 'BELEN', 0, 5),
(201, 15090, 'BERBEO', 0, 5),
(202, 15092, 'BETEITIVA', 0, 5),
(203, 15097, 'BOAVITA', 0, 5),
(204, 15104, 'BOYACA', 0, 5),
(205, 15106, 'BRICEÑO', 0, 5),
(206, 15109, 'BUENAVISTA', 0, 5),
(207, 15114, 'BUSBANZA', 0, 5),
(208, 15131, 'CALDAS', 0, 5),
(209, 15135, 'CAMPOHERMOSO', 0, 5),
(210, 15162, 'CERINZA', 0, 5),
(211, 15172, 'CHINAVITA', 0, 5),
(212, 15176, 'CHIQUINQUIRA', 0, 5),
(213, 15180, 'CHISCAS', 0, 5),
(214, 15183, 'CHITA', 0, 5),
(215, 15185, 'CHITARAQUE', 0, 5),
(216, 15187, 'CHIVATA', 0, 5),
(217, 15189, 'CIENEGA', 0, 5),
(218, 15204, 'COMBITA', 0, 5),
(219, 15212, 'COPER', 0, 5),
(220, 15215, 'CORRALES', 0, 5),
(221, 15218, 'COVARACHIA', 0, 5),
(222, 15223, 'CUBARA', 0, 5),
(223, 15224, 'CUCAITA', 0, 5),
(224, 15226, 'CUITIVA', 0, 5),
(225, 15232, 'CHIQUIZA', 0, 5),
(226, 15236, 'CHIVOR', 0, 5),
(227, 15238, 'DUITAMA', 0, 5),
(228, 15244, 'EL COCUY', 0, 5),
(229, 15248, 'EL ESPINO', 0, 5),
(230, 15272, 'FIRAVITOBA', 0, 5),
(231, 15276, 'FLORESTA', 0, 5),
(232, 15293, 'GACHANTIVA', 0, 5),
(233, 15296, 'GAMEZA', 0, 5),
(234, 15299, 'GARAGOA', 0, 5),
(235, 15317, 'GUACAMAYAS', 0, 5),
(236, 15322, 'GUATEQUE', 0, 5),
(237, 15325, 'GUAYATA', 0, 5),
(238, 15332, 'GsICAN', 0, 5),
(239, 15362, 'IZA', 0, 5),
(240, 15367, 'JENESANO', 0, 5),
(241, 15368, 'JERICO', 0, 5),
(242, 15377, 'LABRANZAGRANDE', 0, 5),
(243, 15380, 'LA CAPILLA', 0, 5),
(244, 15401, 'LA VICTORIA', 0, 5),
(245, 15403, 'LA UVITA', 0, 5),
(246, 15407, 'VILLA DE LEYVA', 0, 5),
(247, 15425, 'MACANAL', 0, 5),
(248, 15442, 'MARIPI', 0, 5),
(249, 15455, 'MIRAFLORES', 0, 5),
(250, 15464, 'MONGUA', 0, 5),
(251, 15466, 'MONGUI', 0, 5),
(252, 15469, 'MONIQUIRA', 0, 5),
(253, 15476, 'MOTAVITA', 0, 5),
(254, 15480, 'MUZO', 0, 5),
(255, 15491, 'NOBSA', 0, 5),
(256, 15494, 'NUEVO COLON', 0, 5),
(257, 15500, 'OICATA', 0, 5),
(258, 15507, 'OTANCHE', 0, 5),
(259, 15511, 'PACHAVITA', 0, 5),
(260, 15514, 'PAEZ', 0, 5),
(261, 15516, 'PAIPA', 0, 5),
(262, 15518, 'PAJARITO', 0, 5),
(263, 15522, 'PANQUEBA', 0, 5),
(264, 15531, 'PAUNA', 0, 5),
(265, 15533, 'PAYA', 0, 5),
(266, 15537, 'PAZ DE RIO', 0, 5),
(267, 15542, 'PESCA', 0, 5),
(268, 15550, 'PISBA', 0, 5),
(269, 15572, 'PUERTO BOYACA', 0, 5),
(270, 15580, 'QUIPAMA', 0, 5),
(271, 15599, 'RAMIRIQUI', 0, 5),
(272, 15600, 'RAQUIRA', 0, 5),
(273, 15621, 'RONDON', 0, 5),
(274, 15632, 'SABOYA', 0, 5),
(275, 15638, 'SACHICA', 0, 5),
(276, 15646, 'SAMACA', 0, 5),
(277, 15660, 'SAN EDUARDO', 0, 5),
(278, 15664, 'SAN JOSE DE PARE', 0, 5),
(279, 15667, 'SAN LUIS DE GACENO', 0, 5),
(280, 15673, 'SAN MATEO', 0, 5),
(281, 15676, 'SAN MIGUEL DE SEMA', 0, 5),
(282, 15681, 'SAN PABLO DE BORBUR', 0, 5),
(283, 15686, 'SANTANA', 0, 5),
(284, 15690, 'SANTA MARIA', 0, 5),
(285, 15693, 'SANTA ROSA DE VITERBO', 0, 5),
(286, 15696, 'SANTA SOFIA', 0, 5),
(287, 15720, 'SATIVANORTE', 0, 5),
(288, 15723, 'SATIVASUR', 0, 5),
(289, 15740, 'SIACHOQUE', 0, 5),
(290, 15753, 'SOATA', 0, 5),
(291, 15755, 'SOCOTA', 0, 5),
(292, 15757, 'SOCHA', 0, 5),
(293, 15759, 'SOGAMOSO', 0, 5),
(294, 15761, 'SOMONDOCO', 0, 5),
(295, 15762, 'SORA', 0, 5),
(296, 15763, 'SOTAQUIRA', 0, 5),
(297, 15764, 'SORACA', 0, 5),
(298, 15774, 'SUSACON', 0, 5),
(299, 15776, 'SUTAMARCHAN', 0, 5),
(300, 15778, 'SUTATENZA', 0, 5),
(301, 15790, 'TASCO', 0, 5),
(302, 15798, 'TENZA', 0, 5),
(303, 15804, 'TIBANA', 0, 5),
(304, 15806, 'TIBASOSA', 0, 5),
(305, 15808, 'TINJACA', 0, 5),
(306, 15810, 'TIPACOQUE', 0, 5),
(307, 15814, 'TOCA', 0, 5),
(308, 15816, 'TOGsI', 0, 5),
(309, 15820, 'TOPAGA', 0, 5),
(310, 15822, 'TOTA', 0, 5),
(311, 15832, 'TUNUNGUA', 0, 5),
(312, 15835, 'TURMEQUE', 0, 5),
(313, 15837, 'TUTA', 0, 5),
(314, 15839, 'TUTAZA', 0, 5),
(315, 15842, 'UMBITA', 0, 5),
(316, 15861, 'VENTAQUEMADA', 0, 5),
(317, 15879, 'VIRACACHA', 0, 5),
(318, 15897, 'ZETAQUIRA', 0, 5),
(319, 17001, 'MANIZALES', 0, 6),
(320, 17013, 'AGUADAS', 0, 6),
(321, 17042, 'ANSERMA', 0, 6),
(322, 17050, 'ARANZAZU', 0, 6),
(323, 17088, 'BELALCAZAR', 0, 6),
(324, 17174, 'CHINCHINA', 0, 6),
(325, 17272, 'FILADELFIA', 0, 6),
(326, 17380, 'LA DORADA', 0, 6),
(327, 17388, 'LA MERCED', 0, 6),
(328, 17433, 'MANZANARES', 0, 6),
(329, 17442, 'MARMATO', 0, 6),
(330, 17444, 'MARQUETALIA', 0, 6),
(331, 17446, 'MARULANDA', 0, 6),
(332, 17486, 'NEIRA', 0, 6),
(333, 17495, 'NORCASIA', 0, 6),
(334, 17513, 'PACORA', 0, 6),
(335, 17524, 'PALESTINA', 0, 6),
(336, 17541, 'PENSILVANIA', 0, 6),
(337, 17614, 'RIOSUCIO', 0, 6),
(338, 17616, 'RISARALDA', 0, 6),
(339, 17653, 'SALAMINA', 0, 6),
(340, 17662, 'SAMANA', 0, 6),
(341, 17665, 'SAN JOSE', 0, 6),
(342, 17777, 'SUPIA', 0, 6),
(343, 17867, 'VICTORIA', 0, 6),
(344, 17873, 'VILLAMARIA', 0, 6),
(345, 17877, 'VITERBO', 0, 6),
(346, 18001, 'FLORENCIA', 0, 7),
(347, 18029, 'ALBANIA', 0, 7),
(348, 18094, 'BELEN DE LOS ANDAQUIES', 0, 7),
(349, 18150, 'CARTAGENA DEL CHAIRA', 0, 7),
(350, 18205, 'CURILLO', 0, 7),
(351, 18247, 'EL DONCELLO', 0, 7),
(352, 18256, 'EL PAUJIL', 0, 7),
(353, 18410, 'LA MONTAÑITA', 0, 7),
(354, 18460, 'MILAN', 0, 7),
(355, 18479, 'MORELIA', 0, 7),
(356, 18592, 'PUERTO RICO', 0, 7),
(357, 18610, 'SAN JOSE DEL FRAGUA', 0, 7),
(358, 18753, 'SAN VICENTE DEL CAGUAN', 0, 7),
(359, 18756, 'SOLANO', 0, 7),
(360, 18785, 'SOLITA', 0, 7),
(361, 18860, 'VALPARAISO', 0, 7),
(362, 19001, 'POPAYAN', 0, 8),
(363, 19022, 'ALMAGUER', 0, 8),
(364, 19050, 'ARGELIA', 0, 8),
(365, 19075, 'BALBOA', 0, 8),
(366, 19100, 'BOLIVAR', 0, 8),
(367, 19110, 'BUENOS AIRES', 0, 8),
(368, 19130, 'CAJIBIO', 0, 8),
(369, 19137, 'CALDONO', 0, 8),
(370, 19142, 'CALOTO', 0, 8),
(371, 19212, 'CORINTO', 0, 8),
(372, 19256, 'EL TAMBO', 0, 8),
(373, 19290, 'FLORENCIA', 0, 8),
(374, 19300, 'GUACHENE', 0, 8),
(375, 19318, 'GUAPI', 0, 8),
(376, 19355, 'INZA', 0, 8),
(377, 19364, 'JAMBALO', 0, 8),
(378, 19392, 'LA SIERRA', 0, 8),
(379, 19397, 'LA VEGA', 0, 8),
(380, 19418, 'LOPEZ', 0, 8),
(381, 19450, 'MERCADERES', 0, 8),
(382, 19455, 'MIRANDA', 0, 8),
(383, 19473, 'MORALES', 0, 8),
(384, 19513, 'PADILLA', 0, 8),
(385, 19517, 'PAEZ', 0, 8),
(386, 19532, 'PATIA', 0, 8),
(387, 19533, 'PIAMONTE', 0, 8),
(388, 19548, 'PIENDAMO', 0, 8),
(389, 19573, 'PUERTO TEJADA', 0, 8),
(390, 19585, 'PURACE', 0, 8),
(391, 19622, 'ROSAS', 0, 8),
(392, 19693, 'SAN SEBASTIAN', 0, 8),
(393, 19698, 'SANTANDER DE QUILICHAO', 0, 8),
(394, 19701, 'SANTA ROSA', 0, 8),
(395, 19743, 'SILVIA', 0, 8),
(396, 19760, 'SOTARA', 0, 8),
(397, 19780, 'SUAREZ', 0, 8),
(398, 19785, 'SUCRE', 0, 8),
(399, 19807, 'TIMBIO', 0, 8),
(400, 19809, 'TIMBIQUI', 0, 8),
(401, 19821, 'TORIBIO', 0, 8),
(402, 19824, 'TOTORO', 0, 8),
(403, 19845, 'VILLA RICA', 0, 8),
(404, 20001, 'VALLEDUPAR', 0, 9),
(405, 20011, 'AGUACHICA', 0, 9),
(406, 20013, 'AGUSTIN CODAZZI', 0, 9),
(407, 20032, 'ASTREA', 0, 9),
(408, 20045, 'BECERRIL', 0, 9),
(409, 20060, 'BOSCONIA', 0, 9),
(410, 20175, 'CHIMICHAGUA', 0, 9),
(411, 20178, 'CHIRIGUANA', 0, 9),
(412, 20228, 'CURUMANI', 0, 9),
(413, 20238, 'EL COPEY', 0, 9),
(414, 20250, 'EL PASO', 0, 9),
(415, 20295, 'GAMARRA', 0, 9),
(416, 20310, 'GONZALEZ', 0, 9),
(417, 20383, 'LA GLORIA', 0, 9),
(418, 20400, 'LA JAGUA DE IBIRICO', 0, 9),
(419, 20443, 'MANAURE', 0, 9),
(420, 20517, 'PAILITAS', 0, 9),
(421, 20550, 'PELAYA', 0, 9),
(422, 20570, 'PUEBLO BELLO', 0, 9),
(423, 20614, 'RIO DE ORO', 0, 9),
(424, 20621, 'LA PAZ', 0, 9),
(425, 20710, 'SAN ALBERTO', 0, 9),
(426, 20750, 'SAN DIEGO', 0, 9),
(427, 20770, 'SAN MARTIN', 0, 9),
(428, 20787, 'TAMALAMEQUE', 0, 9),
(429, 23001, 'MONTERIA', 0, 10),
(430, 23068, 'AYAPEL', 0, 10),
(431, 23079, 'BUENAVISTA', 0, 10),
(432, 23090, 'CANALETE', 0, 10),
(433, 23162, 'CERETE', 0, 10),
(434, 23168, 'CHIMA', 0, 10),
(435, 23182, 'CHINU', 0, 10),
(436, 23189, 'CIENAGA DE ORO', 0, 10),
(437, 23300, 'COTORRA', 0, 10),
(438, 23350, 'LA APARTADA', 0, 10),
(439, 23417, 'LORICA', 0, 10),
(440, 23419, 'LOS CORDOBAS', 0, 10),
(441, 23464, 'MOMIL', 0, 10),
(442, 23466, 'MONTELIBANO', 0, 10),
(443, 23500, 'MOÑITOS', 0, 10),
(444, 23555, 'PLANETA RICA', 0, 10),
(445, 23570, 'PUEBLO NUEVO', 0, 10),
(446, 23574, 'PUERTO ESCONDIDO', 0, 10),
(447, 23580, 'PUERTO LIBERTADOR', 0, 10),
(448, 23586, 'PURISIMA', 0, 10),
(449, 23660, 'SAHAGUN', 0, 10),
(450, 23670, 'SAN ANDRES SOTAVENTO', 0, 10),
(451, 23672, 'SAN ANTERO', 0, 10),
(452, 23675, 'SAN BERNARDO DEL VIENTO', 0, 10),
(453, 23678, 'SAN CARLOS', 0, 10),
(454, 23686, 'SAN PELAYO', 0, 10),
(455, 23807, 'TIERRALTA', 0, 10),
(456, 23855, 'VALENCIA', 0, 10),
(457, 25001, 'AGUA DE DIOS', 0, 11),
(458, 25019, 'ALBAN', 0, 11),
(459, 25035, 'ANAPOIMA', 0, 11),
(460, 25040, 'ANOLAIMA', 0, 11),
(461, 25053, 'ARBELAEZ', 0, 11),
(462, 25086, 'BELTRAN', 0, 11),
(463, 25095, 'BITUIMA', 0, 11),
(464, 25099, 'BOJACA', 0, 11),
(465, 25120, 'CABRERA', 0, 11),
(466, 25123, 'CACHIPAY', 0, 11),
(467, 25126, 'CAJICA', 0, 11),
(468, 25148, 'CAPARRAPI', 0, 11),
(469, 25151, 'CAQUEZA', 0, 11),
(470, 25154, 'CARMEN DE CARUPA', 0, 11),
(471, 25168, 'CHAGUANI', 0, 11),
(472, 25175, 'CHIA', 0, 11),
(473, 25178, 'CHIPAQUE', 0, 11),
(474, 25181, 'CHOACHI', 0, 11),
(475, 25183, 'CHOCONTA', 0, 11),
(476, 25200, 'COGUA', 0, 11),
(477, 25214, 'COTA', 0, 11),
(478, 25224, 'CUCUNUBA', 0, 11),
(479, 25245, 'EL COLEGIO', 0, 11),
(480, 25258, 'EL PEÑON', 0, 11),
(481, 25260, 'EL ROSAL', 0, 11),
(482, 25269, 'FACATATIVA', 0, 11),
(483, 25279, 'FOMEQUE', 0, 11),
(484, 25281, 'FOSCA', 0, 11),
(485, 25286, 'FUNZA', 0, 11),
(486, 25288, 'FUQUENE', 0, 11),
(487, 25290, 'FUSAGASUGA', 0, 11),
(488, 25293, 'GACHALA', 0, 11),
(489, 25295, 'GACHANCIPA', 0, 11),
(490, 25297, 'GACHETA', 0, 11),
(491, 25299, 'GAMA', 0, 11),
(492, 25307, 'GIRARDOT', 0, 11),
(493, 25312, 'GRANADA', 0, 11),
(494, 25317, 'GUACHETA', 0, 11),
(495, 25320, 'GUADUAS', 0, 11),
(496, 25322, 'GUASCA', 0, 11),
(497, 25324, 'GUATAQUI', 0, 11),
(498, 25326, 'GUATAVITA', 0, 11),
(499, 25328, 'GUAYABAL DE SIQUIMA', 0, 11),
(500, 25335, 'GUAYABETAL', 0, 11),
(501, 25339, 'GUTIERREZ', 0, 11),
(502, 25368, 'JERUSALEN', 0, 11),
(503, 25372, 'JUNIN', 0, 11),
(504, 25377, 'LA CALERA', 0, 11),
(505, 25386, 'LA MESA', 0, 11),
(506, 25394, 'LA PALMA', 0, 11),
(507, 25398, 'LA PEÑA', 0, 11),
(508, 25402, 'LA VEGA', 0, 11),
(509, 25407, 'LENGUAZAQUE', 0, 11),
(510, 25426, 'MACHETA', 0, 11),
(511, 25430, 'MADRID', 0, 11),
(512, 25436, 'MANTA', 0, 11),
(513, 25438, 'MEDINA', 0, 11),
(514, 25473, 'MOSQUERA', 0, 11),
(515, 25483, 'NARIÑO', 0, 11),
(516, 25486, 'NEMOCON', 0, 11),
(517, 25488, 'NILO', 0, 11),
(518, 25489, 'NIMAIMA', 0, 11),
(519, 25491, 'NOCAIMA', 0, 11),
(520, 25506, 'VENECIA', 0, 11),
(521, 25513, 'PACHO', 0, 11),
(522, 25518, 'PAIME', 0, 11),
(523, 25524, 'PANDI', 0, 11),
(524, 25530, 'PARATEBUENO', 0, 11),
(525, 25535, 'PASCA', 0, 11),
(526, 25572, 'PUERTO SALGAR', 0, 11),
(527, 25580, 'PULI', 0, 11),
(528, 25592, 'QUEBRADANEGRA', 0, 11),
(529, 25594, 'QUETAME', 0, 11),
(530, 25596, 'QUIPILE', 0, 11),
(531, 25599, 'APULO', 0, 11),
(532, 25612, 'RICAURTE', 0, 11),
(533, 25645, 'SAN ANTONIO DEL TEQUENDAMA', 0, 11),
(534, 25649, 'SAN BERNARDO', 0, 11),
(535, 25653, 'SAN CAYETANO', 0, 11),
(536, 25658, 'SAN FRANCISCO', 0, 11),
(537, 25662, 'SAN JUAN DE RIO SECO', 0, 11),
(538, 25718, 'SASAIMA', 0, 11),
(539, 25736, 'SESQUILE', 0, 11),
(540, 25740, 'SIBATE', 0, 11),
(541, 25743, 'SILVANIA', 0, 11),
(542, 25745, 'SIMIJACA', 0, 11),
(543, 25754, 'SOACHA', 0, 11),
(544, 25758, 'SOPO', 0, 11),
(545, 25769, 'SUBACHOQUE', 0, 11),
(546, 25772, 'SUESCA', 0, 11),
(547, 25777, 'SUPATA', 0, 11),
(548, 25779, 'SUSA', 0, 11),
(549, 25781, 'SUTATAUSA', 0, 11),
(550, 25785, 'TABIO', 0, 11),
(551, 25793, 'TAUSA', 0, 11),
(552, 25797, 'TENA', 0, 11),
(553, 25799, 'TENJO', 0, 11),
(554, 25805, 'TIBACUY', 0, 11),
(555, 25807, 'TIBIRITA', 0, 11),
(556, 25815, 'TOCAIMA', 0, 11),
(557, 25817, 'TOCANCIPA', 0, 11),
(558, 25823, 'TOPAIPI', 0, 11),
(559, 25839, 'UBALA', 0, 11),
(560, 25841, 'UBAQUE', 0, 11),
(561, 25843, 'UBATE', 0, 11),
(562, 25845, 'UNE', 0, 11),
(563, 25851, 'UTICA', 0, 11),
(564, 25862, 'VERGARA', 0, 11),
(565, 25867, 'VIANI', 0, 11),
(566, 25871, 'VILLAGOMEZ', 0, 11),
(567, 25873, 'VILLAPINZON', 0, 11),
(568, 25875, 'VILLETA', 0, 11),
(569, 25878, 'VIOTA', 0, 11),
(570, 25885, 'YACOPI', 0, 11),
(571, 25898, 'ZIPACON', 0, 11),
(572, 25899, 'ZIPAQUIRA', 0, 11),
(573, 27001, 'QUIBDO', 0, 12),
(574, 27006, 'ACANDI', 0, 12),
(575, 27025, 'ALTO BAUDO', 0, 12),
(576, 27050, 'ATRATO', 0, 12),
(577, 27073, 'BAGADO', 0, 12),
(578, 27075, 'BAHIA SOLANO', 0, 12),
(579, 27077, 'BAJO BAUDO', 0, 12),
(580, 27099, 'BOJAYA', 0, 12),
(581, 27135, 'EL CANTON DEL SAN PABLO', 0, 12),
(582, 27150, 'CARMEN DEL DARIEN', 0, 12),
(583, 27160, 'CERTEGUI', 0, 12),
(584, 27205, 'CONDOTO', 0, 12),
(585, 27245, 'EL CARMEN DE ATRATO', 0, 12),
(586, 27250, 'EL LITORAL DEL SAN JUAN', 0, 12),
(587, 27361, 'ISTMINA', 0, 12),
(588, 27372, 'JURADO', 0, 12),
(589, 27413, 'LLORO', 0, 12),
(590, 27425, 'MEDIO ATRATO', 0, 12),
(591, 27430, 'MEDIO BAUDO', 0, 12),
(592, 27450, 'MEDIO SAN JUAN', 0, 12),
(593, 27491, 'NOVITA', 0, 12),
(594, 27495, 'NUQUI', 0, 12),
(595, 27580, 'RIO IRO', 0, 12),
(596, 27600, 'RIO QUITO', 0, 12),
(597, 27615, 'RIOSUCIO', 0, 12),
(598, 27660, 'SAN JOSE DEL PALMAR', 0, 12),
(599, 27745, 'SIPI', 0, 12),
(600, 27787, 'TADO', 0, 12),
(601, 27800, 'UNGUIA', 0, 12),
(602, 27810, 'UNION PANAMERICANA', 0, 12),
(603, 41001, 'NEIVA', 0, 13),
(604, 41006, 'ACEVEDO', 0, 13),
(605, 41013, 'AGRADO', 0, 13),
(606, 41016, 'AIPE', 0, 13),
(607, 41020, 'ALGECIRAS', 0, 13),
(608, 41026, 'ALTAMIRA', 0, 13),
(609, 41078, 'BARAYA', 0, 13),
(610, 41132, 'CAMPOALEGRE', 0, 13),
(611, 41206, 'COLOMBIA', 0, 13),
(612, 41244, 'ELIAS', 0, 13),
(613, 41298, 'GARZON', 0, 13),
(614, 41306, 'GIGANTE', 0, 13),
(615, 41319, 'GUADALUPE', 0, 13),
(616, 41349, 'HOBO', 0, 13),
(617, 41357, 'IQUIRA', 0, 13),
(618, 41359, 'ISNOS', 0, 13),
(619, 41378, 'LA ARGENTINA', 0, 13),
(620, 41396, 'LA PLATA', 0, 13),
(621, 41483, 'NATAGA', 0, 13),
(622, 41503, 'OPORAPA', 0, 13),
(623, 41518, 'PAICOL', 0, 13),
(624, 41524, 'PALERMO', 0, 13),
(625, 41530, 'PALESTINA', 0, 13),
(626, 41548, 'PITAL', 0, 13),
(627, 41551, 'PITALITO', 0, 13),
(628, 41615, 'RIVERA', 0, 13),
(629, 41660, 'SALADOBLANCO', 0, 13),
(630, 41668, 'SAN AGUSTIN', 0, 13),
(631, 41676, 'SANTA MARIA', 0, 13),
(632, 41770, 'SUAZA', 0, 13),
(633, 41791, 'TARQUI', 0, 13),
(634, 41797, 'TESALIA', 0, 13),
(635, 41799, 'TELLO', 0, 13),
(636, 41801, 'TERUEL', 0, 13),
(637, 41807, 'TIMANA', 0, 13),
(638, 41872, 'VILLAVIEJA', 0, 13),
(639, 41885, 'YAGUARA', 0, 13),
(640, 44001, 'RIOHACHA', 0, 14),
(641, 44035, 'ALBANIA', 0, 14),
(642, 44078, 'BARRANCAS', 0, 14),
(643, 44090, 'DIBULLA', 0, 14),
(644, 44098, 'DISTRACCION', 0, 14),
(645, 44110, 'EL MOLINO', 0, 14),
(646, 44279, 'FONSECA', 0, 14),
(647, 44378, 'HATONUEVO', 0, 14),
(648, 44420, 'LA JAGUA DEL PILAR', 0, 14),
(649, 44430, 'MAICAO', 0, 14),
(650, 44560, 'MANAURE', 0, 14),
(651, 44650, 'SAN JUAN DEL CESAR', 0, 14),
(652, 44847, 'URIBIA', 0, 14),
(653, 44855, 'URUMITA', 0, 14),
(654, 44874, 'VILLANUEVA', 0, 14),
(655, 47001, 'SANTA MARTA', 0, 15),
(656, 47030, 'ALGARROBO', 0, 15),
(657, 47053, 'ARACATACA', 0, 15),
(658, 47058, 'ARIGUANI', 0, 15),
(659, 47161, 'CERRO SAN ANTONIO', 0, 15),
(660, 47170, 'CHIBOLO', 0, 15),
(661, 47189, 'CIENAGA', 0, 15),
(662, 47205, 'CONCORDIA', 0, 15),
(663, 47245, 'EL BANCO', 0, 15),
(664, 47258, 'EL PIÑON', 0, 15),
(665, 47268, 'EL RETEN', 0, 15),
(666, 47288, 'FUNDACION', 0, 15),
(667, 47318, 'GUAMAL', 0, 15),
(668, 47460, 'NUEVA GRANADA', 0, 15),
(669, 47541, 'PEDRAZA', 0, 15),
(670, 47545, 'PIJIÑO DEL CARMEN', 0, 15),
(671, 47551, 'PIVIJAY', 0, 15),
(672, 47555, 'PLATO', 0, 15),
(673, 47570, 'PUEBLOVIEJO', 0, 15),
(674, 47605, 'REMOLINO', 0, 15),
(675, 47660, 'SABANAS DE SAN ANGEL', 0, 15),
(676, 47675, 'SALAMINA', 0, 15),
(677, 47692, 'SAN SEBASTIAN DE BUENAVISTA', 0, 15),
(678, 47703, 'SAN ZENON', 0, 15),
(679, 47707, 'SANTA ANA', 0, 15),
(680, 47720, 'SANTA BARBARA DE PINTO', 0, 15),
(681, 47745, 'SITIONUEVO', 0, 15),
(682, 47798, 'TENERIFE', 0, 15),
(683, 47960, 'ZAPAYAN', 0, 15),
(684, 47980, 'ZONA BANANERA', 0, 15),
(685, 50001, 'VILLAVICENCIO', 0, 16),
(686, 50006, 'ACACIAS', 0, 16),
(687, 50110, 'BARRANCA DE UPIA', 0, 16),
(688, 50124, 'CABUYARO', 0, 16),
(689, 50150, 'CASTILLA LA NUEVA', 0, 16),
(690, 50223, 'CUBARRAL', 0, 16),
(691, 50226, 'CUMARAL', 0, 16),
(692, 50245, 'EL CALVARIO', 0, 16),
(693, 50251, 'EL CASTILLO', 0, 16),
(694, 50270, 'EL DORADO', 0, 16),
(695, 50287, 'FUENTE DE ORO', 0, 16),
(696, 50313, 'GRANADA', 0, 16),
(697, 50318, 'GUAMAL', 0, 16),
(698, 50325, 'MAPIRIPAN', 0, 16),
(699, 50330, 'MESETAS', 0, 16),
(700, 50350, 'LA MACARENA', 0, 16),
(701, 50370, 'URIBE', 0, 16),
(702, 50400, 'LEJANIAS', 0, 16),
(703, 50450, 'PUERTO CONCORDIA', 0, 16),
(704, 50568, 'PUERTO GAITAN', 0, 16),
(705, 50573, 'PUERTO LOPEZ', 0, 16),
(706, 50577, 'PUERTO LLERAS', 0, 16),
(707, 50590, 'PUERTO RICO', 0, 16),
(708, 50606, 'RESTREPO', 0, 16),
(709, 50680, 'SAN CARLOS DE GUAROA', 0, 16),
(710, 50683, 'SAN JUAN DE ARAMA', 0, 16),
(711, 50686, 'SAN JUANITO', 0, 16),
(712, 50689, 'SAN MARTIN', 0, 16),
(713, 50711, 'VISTAHERMOSA', 0, 16),
(714, 52001, 'PASTO', 0, 17),
(715, 52019, 'ALBAN', 0, 17),
(716, 52022, 'ALDANA', 0, 17),
(717, 52036, 'ANCUYA', 0, 17),
(718, 52051, 'ARBOLEDA', 0, 17),
(719, 52079, 'BARBACOAS', 0, 17),
(720, 52083, 'BELEN', 0, 17),
(721, 52110, 'BUESACO', 0, 17),
(722, 52203, 'COLON', 0, 17),
(723, 52207, 'CONSACA', 0, 17),
(724, 52210, 'CONTADERO', 0, 17),
(725, 52215, 'CORDOBA', 0, 17),
(726, 52224, 'CUASPUD', 0, 17),
(727, 52227, 'CUMBAL', 0, 17),
(728, 52233, 'CUMBITARA', 0, 17),
(729, 52240, 'CHACHAGsI', 0, 17),
(730, 52250, 'EL CHARCO', 0, 17),
(731, 52254, 'EL PEÑOL', 0, 17),
(732, 52256, 'EL ROSARIO', 0, 17),
(733, 52258, 'EL TABLON DE GOMEZ', 0, 17),
(734, 52260, 'EL TAMBO', 0, 17),
(735, 52287, 'FUNES', 0, 17),
(736, 52317, 'GUACHUCAL', 0, 17),
(737, 52320, 'GUAITARILLA', 0, 17),
(738, 52323, 'GUALMATAN', 0, 17),
(739, 52352, 'ILES', 0, 17),
(740, 52354, 'IMUES', 0, 17),
(741, 52356, 'IPIALES', 0, 17),
(742, 52378, 'LA CRUZ', 0, 17),
(743, 52381, 'LA FLORIDA', 0, 17),
(744, 52385, 'LA LLANADA', 0, 17),
(745, 52390, 'LA TOLA', 0, 17),
(746, 52399, 'LA UNION', 0, 17),
(747, 52405, 'LEIVA', 0, 17),
(748, 52411, 'LINARES', 0, 17),
(749, 52418, 'LOS ANDES', 0, 17),
(750, 52427, 'MAGsI', 0, 17),
(751, 52435, 'MALLAMA', 0, 17),
(752, 52473, 'MOSQUERA', 0, 17),
(753, 52480, 'NARIÑO', 0, 17),
(754, 52490, 'OLAYA HERRERA', 0, 17),
(755, 52506, 'OSPINA', 0, 17),
(756, 52520, 'FRANCISCO PIZARRO', 0, 17),
(757, 52540, 'POLICARPA', 0, 17),
(758, 52560, 'POTOSI', 0, 17),
(759, 52565, 'PROVIDENCIA', 0, 17),
(760, 52573, 'PUERRES', 0, 17),
(761, 52585, 'PUPIALES', 0, 17),
(762, 52612, 'RICAURTE', 0, 17),
(763, 52621, 'ROBERTO PAYAN', 0, 17),
(764, 52678, 'SAMANIEGO', 0, 17),
(765, 52683, 'SANDONA', 0, 17),
(766, 52685, 'SAN BERNARDO', 0, 17),
(767, 52687, 'SAN LORENZO', 0, 17),
(768, 52693, 'SAN PABLO', 0, 17),
(769, 52694, 'SAN PEDRO DE CARTAGO', 0, 17),
(770, 52696, 'SANTA BARBARA', 0, 17),
(771, 52699, 'SANTACRUZ', 0, 17),
(772, 52720, 'SAPUYES', 0, 17),
(773, 52786, 'TAMINANGO', 0, 17),
(774, 52788, 'TANGUA', 0, 17),
(775, 52835, 'SAN ANDRES DE TUMACO', 0, 17),
(776, 52838, 'TUQUERRES', 0, 17),
(777, 52885, 'YACUANQUER', 0, 17),
(778, 54001, 'CUCUTA', 0, 18),
(779, 54003, 'ABREGO', 0, 18),
(780, 54051, 'ARBOLEDAS', 0, 18),
(781, 54099, 'BOCHALEMA', 0, 18),
(782, 54109, 'BUCARASICA', 0, 18),
(783, 54125, 'CACOTA', 0, 18),
(784, 54128, 'CACHIRA', 0, 18),
(785, 54172, 'CHINACOTA', 0, 18),
(786, 54174, 'CHITAGA', 0, 18),
(787, 54206, 'CONVENCION', 0, 18),
(788, 54223, 'CUCUTILLA', 0, 18),
(789, 54239, 'DURANIA', 0, 18),
(790, 54245, 'EL CARMEN', 0, 18),
(791, 54250, 'EL TARRA', 0, 18),
(792, 54261, 'EL ZULIA', 0, 18),
(793, 54313, 'GRAMALOTE', 0, 18),
(794, 54344, 'HACARI', 0, 18),
(795, 54347, 'HERRAN', 0, 18),
(796, 54377, 'LABATECA', 0, 18),
(797, 54385, 'LA ESPERANZA', 0, 18),
(798, 54398, 'LA PLAYA', 0, 18),
(799, 54405, 'LOS PATIOS', 0, 18),
(800, 54418, 'LOURDES', 0, 18),
(801, 54480, 'MUTISCUA', 0, 18),
(802, 54498, 'OCAÑA', 0, 18),
(803, 54518, 'PAMPLONA', 0, 18),
(804, 54520, 'PAMPLONITA', 0, 18),
(805, 54553, 'PUERTO SANTANDER', 0, 18),
(806, 54599, 'RAGONVALIA', 0, 18),
(807, 54660, 'SALAZAR', 0, 18),
(808, 54670, 'SAN CALIXTO', 0, 18),
(809, 54673, 'SAN CAYETANO', 0, 18),
(810, 54680, 'SANTIAGO', 0, 18),
(811, 54720, 'SARDINATA', 0, 18),
(812, 54743, 'SILOS', 0, 18),
(813, 54800, 'TEORAMA', 0, 18),
(814, 54810, 'TIBU', 0, 18),
(815, 54820, 'TOLEDO', 0, 18),
(816, 54871, 'VILLA CARO', 0, 18),
(817, 54874, 'VILLA DEL ROSARIO', 0, 18),
(818, 63001, 'ARMENIA', 0, 19),
(819, 63111, 'BUENAVISTA', 0, 19),
(820, 63130, 'CALARCA', 0, 19),
(821, 63190, 'CIRCASIA', 0, 19),
(822, 63212, 'CORDOBA', 0, 19),
(823, 63272, 'FILANDIA', 0, 19),
(824, 63302, 'GENOVA', 0, 19),
(825, 63401, 'LA TEBAIDA', 0, 19),
(826, 63470, 'MONTENEGRO', 0, 19),
(827, 63548, 'PIJAO', 0, 19),
(828, 63594, 'QUIMBAYA', 0, 19),
(829, 63690, 'SALENTO', 0, 19),
(830, 66001, 'PEREIRA', 0, 20),
(831, 66045, 'APIA', 0, 20),
(832, 66075, 'BALBOA', 0, 20),
(833, 66088, 'BELEN DE UMBRIA', 0, 20),
(834, 66170, 'DOSQUEBRADAS', 0, 20),
(835, 66318, 'GUATICA', 0, 20),
(836, 66383, 'LA CELIA', 0, 20),
(837, 66400, 'LA VIRGINIA', 0, 20),
(838, 66440, 'MARSELLA', 0, 20),
(839, 66456, 'MISTRATO', 0, 20),
(840, 66572, 'PUEBLO RICO', 0, 20),
(841, 66594, 'QUINCHIA', 0, 20),
(842, 66682, 'SANTA ROSA DE CABAL', 0, 20),
(843, 66687, 'SANTUARIO', 0, 20),
(844, 68001, 'BUCARAMANGA', 0, 21),
(845, 68013, 'AGUADA', 0, 21),
(846, 68020, 'ALBANIA', 0, 21),
(847, 68051, 'ARATOCA', 0, 21),
(848, 68077, 'BARBOSA', 0, 21),
(849, 68079, 'BARICHARA', 0, 21),
(850, 68081, 'BARRANCABERMEJA', 0, 21),
(851, 68092, 'BETULIA', 0, 21),
(852, 68101, 'BOLIVAR', 0, 21),
(853, 68121, 'CABRERA', 0, 21),
(854, 68132, 'CALIFORNIA', 0, 21),
(855, 68147, 'CAPITANEJO', 0, 21),
(856, 68152, 'CARCASI', 0, 21),
(857, 68160, 'CEPITA', 0, 21),
(858, 68162, 'CERRITO', 0, 21),
(859, 68167, 'CHARALA', 0, 21),
(860, 68169, 'CHARTA', 0, 21),
(861, 68176, 'CHIMA', 0, 21),
(862, 68179, 'CHIPATA', 0, 21),
(863, 68190, 'CIMITARRA', 0, 21),
(864, 68207, 'CONCEPCION', 0, 21),
(865, 68209, 'CONFINES', 0, 21),
(866, 68211, 'CONTRATACION', 0, 21),
(867, 68217, 'COROMORO', 0, 21),
(868, 68229, 'CURITI', 0, 21),
(869, 68235, 'EL CARMEN DE CHUCURI', 0, 21),
(870, 68245, 'EL GUACAMAYO', 0, 21),
(871, 68250, 'EL PEÑON', 0, 21),
(872, 68255, 'EL PLAYON', 0, 21),
(873, 68264, 'ENCINO', 0, 21),
(874, 68266, 'ENCISO', 0, 21),
(875, 68271, 'FLORIAN', 0, 21),
(876, 68276, 'FLORIDABLANCA', 0, 21),
(877, 68296, 'GALAN', 0, 21),
(878, 68298, 'GAMBITA', 0, 21),
(879, 68307, 'GIRON', 0, 21),
(880, 68318, 'GUACA', 0, 21),
(881, 68320, 'GUADALUPE', 0, 21),
(882, 68322, 'GUAPOTA', 0, 21),
(883, 68324, 'GUAVATA', 0, 21),
(884, 68327, 'GsEPSA', 0, 21),
(885, 68344, 'HATO', 0, 21),
(886, 68368, 'JESUS MARIA', 0, 21),
(887, 68370, 'JORDAN', 0, 21),
(888, 68377, 'LA BELLEZA', 0, 21),
(889, 68385, 'LANDAZURI', 0, 21),
(890, 68397, 'LA PAZ', 0, 21),
(891, 68406, 'LEBRIJA', 0, 21),
(892, 68418, 'LOS SANTOS', 0, 21),
(893, 68425, 'MACARAVITA', 0, 21),
(894, 68432, 'MALAGA', 0, 21),
(895, 68444, 'MATANZA', 0, 21),
(896, 68464, 'MOGOTES', 0, 21),
(897, 68468, 'MOLAGAVITA', 0, 21),
(898, 68498, 'OCAMONTE', 0, 21),
(899, 68500, 'OIBA', 0, 21),
(900, 68502, 'ONZAGA', 0, 21),
(901, 68522, 'PALMAR', 0, 21),
(902, 68524, 'PALMAS DEL SOCORRO', 0, 21),
(903, 68533, 'PARAMO', 0, 21),
(904, 68547, 'PIEDECUESTA', 0, 21),
(905, 68549, 'PINCHOTE', 0, 21),
(906, 68572, 'PUENTE NACIONAL', 0, 21),
(907, 68573, 'PUERTO PARRA', 0, 21),
(908, 68575, 'PUERTO WILCHES', 0, 21),
(909, 68615, 'RIONEGRO', 0, 21),
(910, 68655, 'SABANA DE TORRES', 0, 21),
(911, 68669, 'SAN ANDRES', 0, 21),
(912, 68673, 'SAN BENITO', 0, 21),
(913, 68679, 'SAN GIL', 0, 21),
(914, 68682, 'SAN JOAQUIN', 0, 21),
(915, 68684, 'SAN JOSE DE MIRANDA', 0, 21),
(916, 68686, 'SAN MIGUEL', 0, 21),
(917, 68689, 'SAN VICENTE DE CHUCURI', 0, 21),
(918, 68705, 'SANTA BARBARA', 0, 21),
(919, 68720, 'SANTA HELENA DEL OPON', 0, 21),
(920, 68745, 'SIMACOTA', 0, 21),
(921, 68755, 'SOCORRO', 0, 21),
(922, 68770, 'SUAITA', 0, 21),
(923, 68773, 'SUCRE', 0, 21),
(924, 68780, 'SURATA', 0, 21),
(925, 68820, 'TONA', 0, 21),
(926, 68855, 'VALLE DE SAN JOSE', 0, 21),
(927, 68861, 'VELEZ', 0, 21),
(928, 68867, 'VETAS', 0, 21),
(929, 68872, 'VILLANUEVA', 0, 21),
(930, 68895, 'ZAPATOCA', 0, 21),
(931, 70001, 'SINCELEJO', 0, 22),
(932, 70110, 'BUENAVISTA', 0, 22),
(933, 70124, 'CAIMITO', 0, 22),
(934, 70204, 'COLOSO', 0, 22),
(935, 70215, 'COROZAL', 0, 22),
(936, 70221, 'COVEÑAS', 0, 22),
(937, 70230, 'CHALAN', 0, 22),
(938, 70233, 'EL ROBLE', 0, 22),
(939, 70235, 'GALERAS', 0, 22),
(940, 70265, 'GUARANDA', 0, 22),
(941, 70400, 'LA UNION', 0, 22),
(942, 70418, 'LOS PALMITOS', 0, 22),
(943, 70429, 'MAJAGUAL', 0, 22),
(944, 70473, 'MORROA', 0, 22),
(945, 70508, 'OVEJAS', 0, 22),
(946, 70523, 'PALMITO', 0, 22),
(947, 70670, 'SAMPUES', 0, 22),
(948, 70678, 'SAN BENITO ABAD', 0, 22),
(949, 70702, 'SAN JUAN DE BETULIA', 0, 22),
(950, 70708, 'SAN MARCOS', 0, 22),
(951, 70713, 'SAN ONOFRE', 0, 22),
(952, 70717, 'SAN PEDRO', 0, 22),
(953, 70742, 'SAN LUIS DE SINCE', 0, 22),
(954, 70771, 'SUCRE', 0, 22),
(955, 70820, 'SANTIAGO DE TOLU', 0, 22),
(956, 70823, 'TOLU VIEJO', 0, 22),
(957, 73001, 'IBAGUE', 0, 23),
(958, 73024, 'ALPUJARRA', 0, 23),
(959, 73026, 'ALVARADO', 0, 23),
(960, 73030, 'AMBALEMA', 0, 23),
(961, 73043, 'ANZOATEGUI', 0, 23),
(962, 73055, 'ARMERO', 0, 23),
(963, 73067, 'ATACO', 0, 23),
(964, 73124, 'CAJAMARCA', 0, 23),
(965, 73148, 'CARMEN DE APICALA', 0, 23),
(966, 73152, 'CASABIANCA', 0, 23),
(967, 73168, 'CHAPARRAL', 0, 23),
(968, 73200, 'COELLO', 0, 23),
(969, 73217, 'COYAIMA', 0, 23),
(970, 73226, 'CUNDAY', 0, 23),
(971, 73236, 'DOLORES', 0, 23),
(972, 73268, 'ESPINAL', 0, 23),
(973, 73270, 'FALAN', 0, 23),
(974, 73275, 'FLANDES', 0, 23),
(975, 73283, 'FRESNO', 0, 23),
(976, 73319, 'GUAMO', 0, 23),
(977, 73347, 'HERVEO', 0, 23),
(978, 73349, 'HONDA', 0, 23),
(979, 73352, 'ICONONZO', 0, 23),
(980, 73408, 'LERIDA', 0, 23),
(981, 73411, 'LIBANO', 0, 23),
(982, 73443, 'MARIQUITA', 0, 23),
(983, 73449, 'MELGAR', 0, 23),
(984, 73461, 'MURILLO', 0, 23),
(985, 73483, 'NATAGAIMA', 0, 23),
(986, 73504, 'ORTEGA', 0, 23),
(987, 73520, 'PALOCABILDO', 0, 23),
(988, 73547, 'PIEDRAS', 0, 23),
(989, 73555, 'PLANADAS', 0, 23),
(990, 73563, 'PRADO', 0, 23),
(991, 73585, 'PURIFICACION', 0, 23),
(992, 73616, 'RIOBLANCO', 0, 23),
(993, 73622, 'RONCESVALLES', 0, 23),
(994, 73624, 'ROVIRA', 0, 23),
(995, 73671, 'SALDAÑA', 0, 23),
(996, 73675, 'SAN ANTONIO', 0, 23),
(997, 73678, 'SAN LUIS', 0, 23),
(998, 73686, 'SANTA ISABEL', 0, 23),
(999, 73770, 'SUAREZ', 0, 23),
(1000, 73854, 'VALLE DE SAN JUAN', 0, 23),
(1001, 73861, 'VENADILLO', 0, 23),
(1002, 73870, 'VILLAHERMOSA', 0, 23),
(1003, 73873, 'VILLARRICA', 0, 23),
(1004, 76001, 'CALI', 0, 24),
(1005, 76020, 'ALCALA', 0, 24),
(1006, 76036, 'ANDALUCIA', 0, 24),
(1007, 76041, 'ANSERMANUEVO', 0, 24),
(1008, 76054, 'ARGELIA', 0, 24),
(1009, 76100, 'BOLIVAR', 0, 24),
(1010, 76109, 'BUENAVENTURA', 0, 24),
(1011, 76111, 'GUADALAJARA DE BUGA', 0, 24),
(1012, 76113, 'BUGALAGRANDE', 0, 24),
(1013, 76122, 'CAICEDONIA', 0, 24),
(1014, 76126, 'CALIMA', 0, 24),
(1015, 76130, 'CANDELARIA', 0, 24),
(1016, 76147, 'CARTAGO', 0, 24),
(1017, 76233, 'DAGUA', 0, 24),
(1018, 76243, 'EL AGUILA', 0, 24),
(1019, 76246, 'EL CAIRO', 0, 24),
(1020, 76248, 'EL CERRITO', 0, 24),
(1021, 76250, 'EL DOVIO', 0, 24),
(1022, 76275, 'FLORIDA', 0, 24),
(1023, 76306, 'GINEBRA', 0, 24),
(1024, 76318, 'GUACARI', 0, 24),
(1025, 76364, 'JAMUNDI', 0, 24),
(1026, 76377, 'LA CUMBRE', 0, 24),
(1027, 76400, 'LA UNION', 0, 24),
(1028, 76403, 'LA VICTORIA', 0, 24),
(1029, 76497, 'OBANDO', 0, 24),
(1030, 76520, 'PALMIRA', 0, 24),
(1031, 76563, 'PRADERA', 0, 24),
(1032, 76606, 'RESTREPO', 0, 24),
(1033, 76616, 'RIOFRIO', 0, 24),
(1034, 76622, 'ROLDANILLO', 0, 24),
(1035, 76670, 'SAN PEDRO', 0, 24),
(1036, 76736, 'SEVILLA', 0, 24),
(1037, 76823, 'TORO', 0, 24),
(1038, 76828, 'TRUJILLO', 0, 24),
(1039, 76834, 'TULUA', 0, 24),
(1040, 76845, 'ULLOA', 0, 24),
(1041, 76863, 'VERSALLES', 0, 24),
(1042, 76869, 'VIJES', 0, 24),
(1043, 76890, 'YOTOCO', 0, 24),
(1044, 76892, 'YUMBO', 0, 24),
(1045, 76895, 'ZARZAL', 0, 24),
(1046, 81001, 'ARAUCA', 0, 25),
(1047, 81065, 'ARAUQUITA', 0, 25),
(1048, 81220, 'CRAVO NORTE', 0, 25),
(1049, 81300, 'FORTUL', 0, 25),
(1050, 81591, 'PUERTO RONDON', 0, 25),
(1051, 81736, 'SARAVENA', 0, 25),
(1052, 81794, 'TAME', 0, 25),
(1053, 85001, 'YOPAL', 0, 26),
(1054, 85010, 'AGUAZUL', 0, 26),
(1055, 85015, 'CHAMEZA', 0, 26),
(1056, 85125, 'HATO COROZAL', 0, 26),
(1057, 85136, 'LA SALINA', 0, 26),
(1058, 85139, 'MANI', 0, 26),
(1059, 85162, 'MONTERREY', 0, 26),
(1060, 85225, 'NUNCHIA', 0, 26),
(1061, 85230, 'OROCUE', 0, 26),
(1062, 85250, 'PAZ DE ARIPORO', 0, 26),
(1063, 85263, 'PORE', 0, 26),
(1064, 85279, 'RECETOR', 0, 26),
(1065, 85300, 'SABANALARGA', 0, 26),
(1066, 85315, 'SACAMA', 0, 26),
(1067, 85325, 'SAN LUIS DE PALENQUE', 0, 26),
(1068, 85400, 'TAMARA', 0, 26),
(1069, 85410, 'TAURAMENA', 0, 26),
(1070, 85430, 'TRINIDAD', 0, 26),
(1071, 85440, 'VILLANUEVA', 0, 26),
(1072, 86001, 'MOCOA', 0, 27),
(1073, 86219, 'COLON', 0, 27),
(1074, 86320, 'ORITO', 0, 27),
(1075, 86568, 'PUERTO ASIS', 0, 27),
(1076, 86569, 'PUERTO CAICEDO', 0, 27),
(1077, 86571, 'PUERTO GUZMAN', 0, 27),
(1078, 86573, 'LEGUIZAMO', 0, 27),
(1079, 86749, 'SIBUNDOY', 0, 27),
(1080, 86755, 'SAN FRANCISCO', 0, 27),
(1081, 86757, 'SAN MIGUEL', 0, 27),
(1082, 86760, 'SANTIAGO', 0, 27),
(1083, 86865, 'VALLE DEL GUAMUEZ', 0, 27),
(1084, 86885, 'VILLAGARZON', 0, 27),
(1085, 88001, 'SAN ANDRES', 0, 28),
(1086, 88564, 'PROVIDENCIA', 0, 28),
(1087, 91001, 'LETICIA', 0, 29),
(1088, 91263, 'EL ENCANTO', 0, 29),
(1089, 91405, 'LA CHORRERA', 0, 29),
(1090, 91407, 'LA PEDRERA', 0, 29),
(1091, 91430, 'LA VICTORIA', 0, 29),
(1092, 91460, 'MIRITI - PARANA', 0, 29),
(1093, 91530, 'PUERTO ALEGRIA', 0, 29),
(1094, 91536, 'PUERTO ARICA', 0, 29),
(1095, 91540, 'PUERTO NARIÑO', 0, 29),
(1096, 91669, 'PUERTO SANTANDER', 0, 29),
(1097, 91798, 'TARAPACA', 0, 29),
(1098, 94001, 'INIRIDA', 0, 30),
(1099, 94343, 'BARRANCO MINAS', 0, 30),
(1100, 94663, 'MAPIRIPANA', 0, 30),
(1101, 94883, 'SAN FELIPE', 0, 30),
(1102, 94884, 'PUERTO COLOMBIA', 0, 30),
(1103, 94885, 'LA GUADALUPE', 0, 30),
(1104, 94886, 'CACAHUAL', 0, 30),
(1105, 94887, 'PANA PANA', 0, 30),
(1106, 94888, 'MORICHAL', 0, 30),
(1107, 95001, 'SAN JOSE DEL GUAVIARE', 0, 31),
(1108, 95015, 'CALAMAR', 0, 31),
(1109, 95025, 'EL RETORNO', 0, 31),
(1110, 95200, 'MIRAFLORES', 0, 31),
(1111, 97001, 'MITU', 0, 32),
(1112, 97161, 'CARURU', 0, 32),
(1113, 97511, 'PACOA', 0, 32),
(1114, 97666, 'TARAIRA', 0, 32),
(1115, 97777, 'PAPUNAUA', 0, 32),
(1116, 97889, 'YAVARATE', 0, 32),
(1117, 99001, 'PUERTO CARREÑO', 0, 33),
(1118, 99524, 'LA PRIMAVERA', 0, 33),
(1119, 99624, 'SANTA ROSALIA', 0, 33),
(1120, 99773, 'CUMARIBO', 0, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empaques`
--

CREATE TABLE IF NOT EXISTS `empaques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `empaques`
--

INSERT INTO `empaques` (`id`, `codigo`, `nombre`) VALUES
(1, 1, 'Sobre'),
(2, 2, 'Paquete'),
(3, 3, 'Caja'),
(4, 4, 'Bicicletas'),
(5, 5, 'Neveras'),
(6, 6, 'Devolución');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mercancias`
--

CREATE TABLE IF NOT EXISTS `mercancias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `mercancias`
--

INSERT INTO `mercancias` (`id`, `codigo`, `nombre`) VALUES
(1, 1, 'Pañales'),
(2, 2, 'Electrodomestico'),
(4, 100, 'CASíóá'),
(5, 101, 'casa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negociaciones`
--

CREATE TABLE IF NOT EXISTS `negociaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desde` varchar(100) DEFAULT NULL,
  `hasta` varchar(100) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `representante_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `negociaciones`
--

INSERT INTO `negociaciones` (`id`, `desde`, `hasta`, `valor`, `representante_id`) VALUES
(11, '12', '12', '12', 3),
(12, '10', '20', '1000', 1),
(13, '21', '30', '2000', 1),
(14, '5', '10', '150', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

CREATE TABLE IF NOT EXISTS `novedades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) DEFAULT NULL,
  `novedad` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `novedades`
--

INSERT INTO `novedades` (`id`, `codigo`, `novedad`) VALUES
(1, '1', 'El destinatario no se encontraba en el domicilio'),
(2, '2', 'Otra novedad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficinas`
--

CREATE TABLE IF NOT EXISTS `oficinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nit` varchar(100) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `desde` varchar(100) DEFAULT NULL,
  `hasta` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `ext` varchar(100) DEFAULT NULL,
  `resolucion` varchar(100) DEFAULT NULL,
  `barras` enum('Si','No') DEFAULT NULL,
  `imprimir` enum('Si','No') DEFAULT NULL,
  `destinos` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `oficinas`
--

INSERT INTO `oficinas` (`id`, `nit`, `codigo`, `nombre`, `desde`, `hasta`, `direccion`, `telefono`, `ext`, `resolucion`, `barras`, `imprimir`, `destinos`) VALUES
(1, '65448-4', 1, 'Central', '100', '1000', 'Cll 48 98 1', '444654', '56', '456-4546-7', 'No', 'Si', '["3","7"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `codigo`, `nombre`, `usuario_id`, `user_id`) VALUES
(1, 1, 'listar gestion', 1, 1),
(2, 2, 'crear departamento', 1, 1),
(3, 3, 'crear region', 1, 1),
(4, 4, 'crear destino', 1, 1),
(5, 5, 'crear empaque', 1, 1),
(6, 6, 'crear mercancia', 1, 1),
(7, 7, 'editar departamento', 1, 1),
(8, 8, 'editar region', 1, 1),
(9, 9, 'editar destino', 1, 1),
(10, 10, 'editar empaque', 1, 1),
(11, 11, 'editar mercancia', 1, 1),
(12, 12, 'eliminar departamento', 1, 1),
(13, 13, 'eliminar region', 1, 1),
(14, 14, 'eliminar destino', 1, 1),
(15, 15, 'eliminar empaque', 1, 1),
(16, 16, 'eliminar mercancia', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planillas`
--

CREATE TABLE IF NOT EXISTS `planillas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `identificacion` int(11) DEFAULT NULL,
  `tipo` enum('Representante','Vehiculo') DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `concepto` varchar(100) DEFAULT NULL,
  `guia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `planillas`
--

INSERT INTO `planillas` (`id`, `fecha`, `identificacion`, `tipo`, `valor`, `codigo`, `concepto`, `guia`) VALUES
(7, '2013-11-14', 132123231, 'Vehiculo', '25000', 'bcs234', 'Peaje', NULL),
(8, '2013-11-01', 14454645, 'Representante', '71500', 'oriente1', 'Prestamo', NULL),
(9, '2013-11-14', 132123231, 'Vehiculo', '25,000', 'bcs234', 'Peaje', '12313');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE IF NOT EXISTS `regiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `departamento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id`, `codigo`, `nombre`, `departamento_id`) VALUES
(1, 1, 'Region1', 18),
(2, 2, 'Region B', 2),
(3, 3, 'Region C', 3),
(4, 4, 'Region D', 1),
(5, 5, 'SUR CERCANO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

CREATE TABLE IF NOT EXISTS `representantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` int(11) DEFAULT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `nombre1` varchar(100) DEFAULT NULL,
  `nombre2` varchar(100) DEFAULT NULL,
  `apellido1` varchar(100) DEFAULT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `telefono1` varchar(100) DEFAULT NULL,
  `telefono2` varchar(100) DEFAULT NULL,
  `telefono3` varchar(100) DEFAULT NULL,
  `telefono4` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `banco` enum('BANCO AGRAGRIO','BANCOLOMBIA','BANCO DE BOGOTÁ','COOPETRABAN','BANCO DE OCCIDENTE','BANCO CAJA SOCIAL','DAVIVIENDA','COLPATRIA','CITY BANK','HELM BANK','CORPBANCA','C.F.A.','CONFIAR') DEFAULT NULL,
  `cuenta` varchar(100) DEFAULT NULL,
  `tipo` enum('Ahorro','Corriente') DEFAULT NULL,
  `giro` enum('Si','No') DEFAULT NULL,
  `oficina` enum('Centro','Terminal del norte','Terminal del sur','Monteria','Santa Fe de Antioquia') DEFAULT NULL,
  `contraentrega` enum('Si','No') DEFAULT NULL,
  `servicio` enum('Si','No') DEFAULT NULL,
  `sobreespecial` varchar(100) DEFAULT NULL,
  `digitar` varchar(100) DEFAULT NULL,
  `escanear` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`id`, `identificacion`, `codigo`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `celular`, `telefono1`, `telefono2`, `telefono3`, `telefono4`, `direccion`, `email`, `banco`, `cuenta`, `tipo`, `giro`, `oficina`, `contraentrega`, `servicio`, `sobreespecial`, `digitar`, `escanear`) VALUES
(1, 112712453, 'oriente1', 'jose', 'dario', 'alvarez', 'ruiz', '300124356', '1111111', '222222', '333333', '444444', 'Cll 23 66 87', 'jd@gmail.com', 'BANCOLOMBIA', '008-4871-10146', 'Corriente', 'No', 'Terminal del norte', 'No', 'No', '500', '250', '350'),
(3, 1128388888, 'urrao1', 'maria', '', 'lopez', 'lopez', '31146545', '545654', '213212', '5456454', '21321231', 'Cll 24 45', '4jd@gmail.com', 'BANCO AGRAGRIO', '045-4546-546', 'Corriente', 'No', 'Centro', 'No', 'Si', '211', '222', '228'),
(4, 1128396442, 'urrao2', 'Rafael', 'Esteban', 'Arango', 'Sanchez', '3012445654', '5787484', '21547545', '', '', 'Cra 12 # 45 - 76', 'reas@gmail.com', 'BANCO AGRAGRIO', '008-4845-5464', 'Ahorro', 'Si', 'Terminal del norte', 'No', 'No', '500', '300', '150');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantexdestinos`
--

CREATE TABLE IF NOT EXISTS `representantexdestinos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `representante_id` int(11) DEFAULT NULL,
  `destino_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `representantexdestinos`
--

INSERT INTO `representantexdestinos` (`id`, `representante_id`, `destino_id`) VALUES
(22, 3, 7),
(23, 1, 1),
(24, 1, 2),
(25, 1, 3),
(26, 1, 5),
(27, 1, 9),
(28, 4, 1),
(29, 4, 63);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE IF NOT EXISTS `tarifas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarifa` double(50,5) DEFAULT NULL,
  `max_kilo` double(50,5) DEFAULT NULL,
  `empaque_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `origen` int(11) DEFAULT NULL,
  `destino` int(11) DEFAULT NULL,
  `valor_adicional` double(50,5) DEFAULT NULL,
  `declarado` double(20,5) DEFAULT NULL,
  `porcen_declarado` double(20,5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `tarifa`, `max_kilo`, `empaque_id`, `cliente_id`, `origen`, `destino`, `valor_adicional`, `declarado`, `porcen_declarado`) VALUES
(2, 10.00000, 11.00000, 1, 9, 1, 1, 40.00000, 41.00000, 5.00000),
(4, 20.00000, 21.00000, 2, 9, 1, 1, 40.00000, 41.00000, 5.00000),
(6, 30.00000, 31.00000, 3, 9, 1, 1, 40.00000, 41.00000, 5.00000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportadoras`
--

CREATE TABLE IF NOT EXISTS `transportadoras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nit` varchar(100) DEFAULT NULL,
  `dv` varchar(100) DEFAULT NULL,
  `razon` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono1` varchar(100) DEFAULT NULL,
  `telefono2` varchar(100) DEFAULT NULL,
  `telefono3` varchar(100) DEFAULT NULL,
  `telefono4` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `credito` enum('Si','No') DEFAULT NULL,
  `activo` enum('Si','No') DEFAULT NULL,
  `destinos` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `transportadoras`
--

INSERT INTO `transportadoras` (`id`, `nit`, `dv`, `razon`, `direccion`, `contacto`, `telefono1`, `telefono2`, `telefono3`, `telefono4`, `fax`, `celular`, `email`, `credito`, `activo`, `destinos`) VALUES
(2, '23-1442123', '2', 'Coonorte', '132', 'Juan martinez', '123', '123', '1', '231', '321', '123', '32', 'No', 'Si', '["1","7","9"]'),
(3, '23', '3', 'Bolivariano', '132', 'Maria Cardona', '123', '123', '1', '231', '321', '123', '32', 'No', 'Si', NULL),
(4, '23', '5', 'Ninguna', '132', 'Pablo Restrepo', '123', '123', '1', '231', '321', '123', '32', 'No', 'Si', '["2","6"]'),
(5, '132123123', '34', 'Otro', '54', 'Luis gonzalez', '4', '564', '564', '56', '456', '456', '4', 'No', 'Si', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` enum('admin','regular') NOT NULL,
  `pw` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role`, `pw`) VALUES
(1, 'esteban', 'esteban', 'e@g.com', 'a938dfdfbaa1f25ccbc39e16060f73c44e5ef0dd', 'regular', 'zxc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE IF NOT EXISTS `vehiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(100) DEFAULT NULL,
  `tipo` enum('BUS','BUSETA','CAMION','CAMIONETA','FURGON','MOTO','PARTICULAR','TAXI') DEFAULT NULL,
  `marca` enum('CHEVROLET','DAHIASUT','DAEWOOD','HYUNDAI','MAZDA','TOYOTA','FOTON','JAC','HINO','NISSAN','KIA','SUSUKI','HONDA','YAMAHA','AKT','KAWASAKI','AUTECO','KIMKO') DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `numero_motor` varchar(100) DEFAULT NULL,
  `numero_chasis` varchar(100) DEFAULT NULL,
  `soat` date DEFAULT NULL,
  `tecnomecanica` date DEFAULT NULL,
  `observaciones` text,
  `conductor_id` int(11) DEFAULT NULL,
  `destinos` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `placa`, `tipo`, `marca`, `modelo`, `numero_motor`, `numero_chasis`, `soat`, `tecnomecanica`, `observaciones`, `conductor_id`, `destinos`) VALUES
(7, 'bcs234', 'TAXI', 'DAEWOOD', '2000', '123', '465', '2013-10-01', '2013-10-02', 'juan alberto gomez -> Luis alberto garcia\r\nLuis alberto garcia -> Juan ruiz', 4, '["1","9"]'),
(8, 'aaa111', 'BUS', 'CHEVROLET', '89', '12', '3', '2014-02-06', '2014-02-25', 'NA', 2, '""');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
