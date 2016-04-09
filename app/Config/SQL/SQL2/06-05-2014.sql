-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-05-2014 a las 20:44:50
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
-- Estructura de tabla para la tabla `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=156 ;

--
-- Volcado de datos para la tabla `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 310),
(2, 1, NULL, NULL, 'Agencias', 2, 13),
(3, 2, NULL, NULL, 'admin_crear', 3, 4),
(4, 2, NULL, NULL, 'crear', 5, 6),
(5, 2, NULL, NULL, 'permisos', 7, 8),
(6, 2, NULL, NULL, 'isAuthorized', 9, 10),
(7, 2, NULL, NULL, 'generateJSON', 11, 12),
(8, 1, NULL, NULL, 'Anticipos', 14, 23),
(9, 8, NULL, NULL, 'crear', 15, 16),
(10, 8, NULL, NULL, 'permisos', 17, 18),
(11, 8, NULL, NULL, 'isAuthorized', 19, 20),
(12, 8, NULL, NULL, 'generateJSON', 21, 22),
(13, 1, NULL, NULL, 'Clientes', 24, 33),
(14, 13, NULL, NULL, 'crear', 25, 26),
(15, 13, NULL, NULL, 'permisos', 27, 28),
(16, 13, NULL, NULL, 'isAuthorized', 29, 30),
(17, 13, NULL, NULL, 'generateJSON', 31, 32),
(18, 1, NULL, NULL, 'Conductores', 34, 43),
(19, 18, NULL, NULL, 'crear', 35, 36),
(20, 18, NULL, NULL, 'permisos', 37, 38),
(21, 18, NULL, NULL, 'isAuthorized', 39, 40),
(22, 18, NULL, NULL, 'generateJSON', 41, 42),
(23, 1, NULL, NULL, 'Datos', 44, 53),
(24, 23, NULL, NULL, 'crear', 45, 46),
(25, 23, NULL, NULL, 'permisos', 47, 48),
(26, 23, NULL, NULL, 'isAuthorized', 49, 50),
(27, 23, NULL, NULL, 'generateJSON', 51, 52),
(28, 1, NULL, NULL, 'Departamentos', 54, 105),
(29, 28, NULL, NULL, 'excelDescargar', 55, 56),
(30, 28, NULL, NULL, 'excelVer', 57, 58),
(31, 28, NULL, NULL, 'excel', 59, 60),
(32, 28, NULL, NULL, 'index', 61, 62),
(33, 28, NULL, NULL, 'editaDep', 63, 64),
(34, 28, NULL, NULL, 'registra', 65, 66),
(35, 28, NULL, NULL, 'listar', 67, 68),
(36, 28, NULL, NULL, 'crearDepartamento', 69, 70),
(37, 28, NULL, NULL, 'crearRegion', 71, 72),
(38, 28, NULL, NULL, 'crearDestino', 73, 74),
(39, 28, NULL, NULL, 'crearEmpaque', 75, 76),
(40, 28, NULL, NULL, 'crearMercancia', 77, 78),
(41, 28, NULL, NULL, 'editarDepartamento', 79, 80),
(42, 28, NULL, NULL, 'editarRegion', 81, 82),
(43, 28, NULL, NULL, 'editarDestino', 83, 84),
(44, 28, NULL, NULL, 'editarEmpaque', 85, 86),
(45, 28, NULL, NULL, 'editarMercancia', 87, 88),
(46, 28, NULL, NULL, 'eliminarDepartamento', 89, 90),
(47, 28, NULL, NULL, 'eliminarRegion', 91, 92),
(48, 28, NULL, NULL, 'eliminarDestino', 93, 94),
(49, 28, NULL, NULL, 'eliminarEmpaque', 95, 96),
(50, 28, NULL, NULL, 'eliminarMercancia', 97, 98),
(51, 28, NULL, NULL, 'permisos', 99, 100),
(52, 28, NULL, NULL, 'isAuthorized', 101, 102),
(53, 28, NULL, NULL, 'generateJSON', 103, 104),
(54, 1, NULL, NULL, 'Descuentos', 106, 119),
(55, 54, NULL, NULL, 'crear', 107, 108),
(56, 54, NULL, NULL, 'excel', 109, 110),
(57, 54, NULL, NULL, 'deshacer', 111, 112),
(58, 54, NULL, NULL, 'permisos', 113, 114),
(59, 54, NULL, NULL, 'isAuthorized', 115, 116),
(60, 54, NULL, NULL, 'generateJSON', 117, 118),
(61, 1, NULL, NULL, 'Destinatarios', 120, 129),
(62, 61, NULL, NULL, 'crear', 121, 122),
(63, 61, NULL, NULL, 'permisos', 123, 124),
(64, 61, NULL, NULL, 'isAuthorized', 125, 126),
(65, 61, NULL, NULL, 'generateJSON', 127, 128),
(66, 1, NULL, NULL, 'Novedades', 130, 139),
(67, 66, NULL, NULL, 'crear', 131, 132),
(68, 66, NULL, NULL, 'permisos', 133, 134),
(69, 66, NULL, NULL, 'isAuthorized', 135, 136),
(70, 66, NULL, NULL, 'generateJSON', 137, 138),
(71, 1, NULL, NULL, 'Oficinas', 140, 149),
(72, 71, NULL, NULL, 'crear', 141, 142),
(73, 71, NULL, NULL, 'permisos', 143, 144),
(74, 71, NULL, NULL, 'isAuthorized', 145, 146),
(75, 71, NULL, NULL, 'generateJSON', 147, 148),
(76, 1, NULL, NULL, 'Pages', 150, 159),
(77, 76, NULL, NULL, 'display', 151, 152),
(78, 76, NULL, NULL, 'permisos', 153, 154),
(79, 76, NULL, NULL, 'isAuthorized', 155, 156),
(80, 76, NULL, NULL, 'generateJSON', 157, 158),
(81, 1, NULL, NULL, 'Planillas', 160, 169),
(82, 81, NULL, NULL, 'actualizar', 161, 162),
(83, 81, NULL, NULL, 'permisos', 163, 164),
(84, 81, NULL, NULL, 'isAuthorized', 165, 166),
(85, 81, NULL, NULL, 'generateJSON', 167, 168),
(86, 1, NULL, NULL, 'Recogidas', 170, 179),
(87, 86, NULL, NULL, 'listar', 171, 172),
(88, 86, NULL, NULL, 'permisos', 173, 174),
(89, 86, NULL, NULL, 'isAuthorized', 175, 176),
(90, 86, NULL, NULL, 'generateJSON', 177, 178),
(91, 1, NULL, NULL, 'Representantes', 180, 189),
(92, 91, NULL, NULL, 'crear', 181, 182),
(93, 91, NULL, NULL, 'permisos', 183, 184),
(94, 91, NULL, NULL, 'isAuthorized', 185, 186),
(95, 91, NULL, NULL, 'generateJSON', 187, 188),
(96, 1, NULL, NULL, 'Tarifas', 190, 211),
(97, 96, NULL, NULL, 'crear', 191, 192),
(98, 96, NULL, NULL, 'convenios', 193, 194),
(99, 96, NULL, NULL, 'otros', 195, 196),
(100, 96, NULL, NULL, 'excel', 197, 198),
(101, 96, NULL, NULL, 'excel2', 199, 200),
(102, 96, NULL, NULL, 'excelDescargar', 201, 202),
(103, 96, NULL, NULL, 'excelVer', 203, 204),
(104, 96, NULL, NULL, 'permisos', 205, 206),
(105, 96, NULL, NULL, 'isAuthorized', 207, 208),
(106, 96, NULL, NULL, 'generateJSON', 209, 210),
(107, 1, NULL, NULL, 'Transportadoras', 212, 221),
(108, 107, NULL, NULL, 'crear', 213, 214),
(109, 107, NULL, NULL, 'permisos', 215, 216),
(110, 107, NULL, NULL, 'isAuthorized', 217, 218),
(111, 107, NULL, NULL, 'generateJSON', 219, 220),
(112, 1, NULL, NULL, 'Users', 222, 257),
(113, 112, NULL, NULL, 'admin_index', 223, 224),
(114, 112, NULL, NULL, 'admin_logout', 225, 226),
(115, 112, NULL, NULL, 'initDB', 227, 228),
(116, 112, NULL, NULL, 'isAuthorized', 229, 230),
(117, 112, NULL, NULL, 'vista', 231, 232),
(118, 112, NULL, NULL, 'buildAcl', 233, 234),
(119, 112, NULL, NULL, 'login', 235, 236),
(120, 112, NULL, NULL, 'recuperar', 237, 238),
(121, 112, NULL, NULL, 'pw', 239, 240),
(122, 112, NULL, NULL, 'logout', 241, 242),
(123, 112, NULL, NULL, 'index', 243, 244),
(124, 112, NULL, NULL, 'view', 245, 246),
(125, 112, NULL, NULL, 'add', 247, 248),
(126, 112, NULL, NULL, 'edit', 249, 250),
(127, 112, NULL, NULL, 'delete', 251, 252),
(128, 112, NULL, NULL, 'permisos', 253, 254),
(129, 112, NULL, NULL, 'generateJSON', 255, 256),
(130, 1, NULL, NULL, 'Vehiculos', 258, 271),
(131, 130, NULL, NULL, 'admin_crear', 259, 260),
(132, 130, NULL, NULL, 'crear', 261, 262),
(133, 130, NULL, NULL, 'asignar', 263, 264),
(134, 130, NULL, NULL, 'permisos', 265, 266),
(135, 130, NULL, NULL, 'isAuthorized', 267, 268),
(136, 130, NULL, NULL, 'generateJSON', 269, 270),
(137, 1, NULL, NULL, 'AclExtras', 272, 273),
(138, 1, NULL, NULL, 'AclManager', 274, 295),
(139, 138, NULL, NULL, 'Acl', 275, 294),
(140, 139, NULL, NULL, 'drop', 276, 277),
(141, 139, NULL, NULL, 'drop_perms', 278, 279),
(142, 139, NULL, NULL, 'index', 280, 281),
(143, 139, NULL, NULL, 'permissions', 282, 283),
(144, 139, NULL, NULL, 'update_acos', 284, 285),
(145, 139, NULL, NULL, 'update_aros', 286, 287),
(146, 139, NULL, NULL, 'permisos', 288, 289),
(147, 139, NULL, NULL, 'isAuthorized', 290, 291),
(148, 139, NULL, NULL, 'generateJSON', 292, 293),
(149, 1, NULL, NULL, 'DebugKit', 296, 309),
(150, 149, NULL, NULL, 'ToolbarAccess', 297, 308),
(151, 150, NULL, NULL, 'history_state', 298, 299),
(152, 150, NULL, NULL, 'sql_explain', 300, 301),
(153, 150, NULL, NULL, 'permisos', 302, 303),
(154, 150, NULL, NULL, 'isAuthorized', 304, 305),
(155, 150, NULL, NULL, 'generateJSON', 306, 307);

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
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `anticipos`
--

INSERT INTO `anticipos` (`id`, `oficina`, `retiro_no`, `fecha`, `hora`, `valor`, `transaccion`, `realizo`, `fecha_digito`, `hora_digito`, `user_id`) VALUES
(8, 1, '1', '2014-02-04', '12:78 0', '12', '45', 'esteban', '2014-02-06', '08:44:07 PM', 1),
(9, 1, 'sdfsd', '2014-03-04', '124645456 PM', 'sdfsdf', 'ssdfsdf', 'esteban', '2014-03-07', '05:11 PM', 1),
(10, 1, '5', '2014-03-01', '7:50 PM', '564564', '44654', 'esteban', '2014-03-07', '05:23 PM', 1),
(11, 1, '78', '2014-03-03', '12:00 AM', '3435464', '2121', 'Esteban', '2014-03-12', '02:13 PM', 1),
(12, 1, '5', '2014-03-04', '12:00 AM', '546', '54', 'Esteban', '2014-03-12', '02:20 PM', 1),
(13, 1, '12', '2014-03-04', '12:00 AM', '1', '21', 'Leidy', '2014-03-12', '02:22 PM', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Role', 1, 'Admin', 1, 4),
(2, NULL, 'Role', 2, 'Consultor', 5, 10),
(3, NULL, 'Role', 3, NULL, 11, 14),
(4, 1, 'User', 1, NULL, 2, 3),
(5, 2, 'User', 2, NULL, 6, 7),
(6, 3, 'User', 3, NULL, 12, 13),
(7, 2, 'User', 3, '', 8, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL DEFAULT '0',
  `_read` char(2) NOT NULL DEFAULT '0',
  `_update` char(2) NOT NULL DEFAULT '0',
  `_delete` char(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 2, 1, '-1', '-1', '-1', '-1'),
(3, 2, 130, '1', '1', '1', '1'),
(4, 2, 2, '1', '1', '1', '1'),
(5, 3, 1, '-1', '-1', '-1', '-1'),
(6, 3, 131, '1', '1', '1', '1'),
(7, 3, 3, '1', '1', '1', '1'),
(8, 3, 122, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audits`
--

CREATE TABLE IF NOT EXISTS `audits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `entity_id` varchar(36) NOT NULL,
  `json_object` text NOT NULL,
  `source_id` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created` (`created`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `audits`
--

INSERT INTO `audits` (`id`, `event`, `model`, `entity_id`, `json_object`, `source_id`, `created`) VALUES
(1, 'CREADO', 'Region', '6', '{"0":{"id":"6","codigo":"5","nombre":"Cali y Nevia","departamento_id":"1"},"Region":{"id":"6"}}', 'Esteban Arango', '2014-05-06 14:36:05'),
(2, 'EDITADO', 'Region', '1', '{"0":{"id":"1","codigo":"1","nombre":"Medellin_Bogota","departamento_id":"18"},"Region":{"id":"1"}}', 'Esteban Arango', '2014-05-06 15:03:38'),
(3, 'EDITADO', 'Destino', '1', '{"0":{"id":"1","codigo":"5001","nombre":"MEDELLINN","region_id":"1","departamento_id":"1","listNombre":"MEDELLINN (ANTIOQUIA)"},"Destino":{"id":"1"}}', 'Esteban Arango', '2014-05-06 15:06:02'),
(4, 'EDITADO', 'Destino', '1', '{"0":{"id":"1","codigo":"5001","nombre":"MEDELLIN","region_id":"1","departamento_id":"1","listNombre":"MEDELLIN (ANTIOQUIA)"},"Destino":{"id":"1"}}', 'Esteban Arango', '2014-05-06 15:06:30'),
(5, 'CREADO', 'Region', '7', '{"0":{"id":"7","codigo":"6","nombre":"asdasd","departamento_id":"1"},"Region":{"id":"7"}}', 'Esteban Arango', '2014-05-06 15:13:18'),
(6, 'EDITADO', 'Region', '1', '{"0":{"id":"1","codigo":"1","nombre":"Medellin_Bogota","departamento_id":"18"},"Region":{"id":"1"}}', 'Esteban Arango', '2014-05-06 15:14:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_deltas`
--

CREATE TABLE IF NOT EXISTS `audit_deltas` (
  `id` varchar(36) NOT NULL,
  `audit_id` varchar(36) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `old_value` text,
  `new_value` text,
  PRIMARY KEY (`id`),
  KEY `audit_id` (`audit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `tipo`, `persona`, `activo`, `causal`, `documento`, `nombres`, `apellidos`, `contacto`, `indicativo`, `telefono`, `telefono2`, `fax`, `direccion`, `credito`, `dias_facturacion`, `especial`, `celular`, `numero_guias`, `email`, `cartera_negociable`, `facturar`, `documento_fact`, `nombres_fact`, `apellidos_fact`, `direccion_fact`, `telefono_fact`, `cupo`, `destinos`) VALUES
(1, 'Clientes', 'Juridica', 'Si', 'Activo', 1234567890, 'Mandar y Servir S.A.S.', '', '[{"cargo":"","nombre":"","telefono":""}]', '', '', '', '', '', 'Si', '', 'Si', '', NULL, '', 'Si', '0', '', '', '', '', '', NULL, '["1"]'),
(5, 'Clientes', 'Natural', 'Si', 'Activo', 32123123, 'Esteban', 'Arango Sanchez', '[{"cargo":"Secretaria","nombre":"Ana Perez Gonzalez","telefono":"2334455"},{"cargo":"Gerente","nombre":"Luis Ruiz Ruiz","telefono":"123456"}]', '04', '1234567890', '1234567890', '545643', 'Cll 23 # 54 - 23', 'Si', '30', 'Si', '3001234567', 2, 'teban@gmail.com', 'No', '0', '11111111', 'Leidy', 'Jimenez Pinzon', 'Cra 45 # 45 - 45', '6778899', 500000, '["1","7"]'),
(10, 'Clientes', 'Natural', 'Si', 'Activo', 123456789, 'Leidy', 'Jimenez', '[{"cargo":"Empleado","nombre":"Jose Alvarez","telefono":"564564"}]', '4', '0987654321', '0987654321', '54546544', 'Cra 23 # 23 - 23', 'Si', '32', 'Si', '3001545465', 4, 'lj@gmail.com', 'Si', '1', '23123121', 'Esteban', 'Arango', 'Cll 15 15 15', '54654654', 100000, '["1"]');

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
  `tipoP` enum('Juridica','Natural') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `conductores`
--

INSERT INTO `conductores` (`id`, `conductor`, `propietario`, `tenedor`, `identificacion`, `tipo_doc`, `dv`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `email`, `direccion`, `telefono`, `celular`, `ciudad`, `pase`, `fecha`, `tipoP`) VALUES
(1, 0, 0, 1, 1231212312, 'NIT', 1, 'Juan', 'Alberto', 'Gomez', 'Pinzon', 'ja@gmail.com', 'Cll 12 # 45 - 45', '12545615', '3000124545', 6, '231564', '2013-10-01', 'Natural'),
(2, 0, 1, 0, 54646541, 'RUT', NULL, 'Luis', 'Alberto', 'Garcia', 'Torres', '', 'Cll 12 # 45 - 46', '12545616', '3000124546', 16, '231565', '2013-10-26', 'Natural'),
(4, 1, 1, 0, 546, 'RUT', 1, 'Juan', '', '', '', '', '', '', '', 561, '232', '2013-10-03', 'Juridica');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `unidad_inicial`, `unidad_final`, `unidad_porcentaje`, `kilo_inicial`, `kilo_final`, `kilo_porcentaje`, `origen`, `destino`, `cliente_id`) VALUES
(1, 2, 5, 5.00000, NULL, NULL, NULL, 1, 1, 10),
(2, 6, 10, 10.00000, NULL, NULL, NULL, 1, 1, 10),
(3, 11, 2000, 15.00000, NULL, NULL, NULL, 1, 1, 10),
(4, NULL, NULL, NULL, 10, 20, 5.00000, 1, 1, 10),
(5, NULL, NULL, NULL, 21, 30, 10.00000, 1, 1, 10),
(6, NULL, NULL, NULL, 31, 2000, 15.00000, 1, 1, 10),
(7, 2, 5, 5.00000, NULL, NULL, NULL, 1, 149, 10),
(8, 6, 10, 10.00000, NULL, NULL, NULL, 1, 149, 10),
(9, 11, 2000, 15.00000, NULL, NULL, NULL, 1, 149, 10),
(10, NULL, NULL, NULL, 10, 20, 5.00000, 1, 149, 10),
(11, NULL, NULL, NULL, 21, 30, 10.00000, 1, 149, 10),
(12, NULL, NULL, NULL, 31, 2000, 15.00000, 1, 149, 10),
(13, 5, 7000, 8.00000, NULL, NULL, NULL, 1, 1, 10),
(14, NULL, NULL, NULL, 7, 5000, 9.00000, 1, 1, 10),
(15, 5, 7000, 8.00000, NULL, NULL, NULL, 1, 149, 10),
(16, NULL, NULL, NULL, 7, 5000, 9.00000, 1, 149, 10);

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
(1, 5001, 'MEDELLIN', 1, 1),
(2, 5002, 'ABEJORRAL', 0, 1),
(3, 5004, 'ABRIAQUI', 4, 1),
(4, 5021, 'ALEJANDRIA', 4, 1),
(5, 5030, 'AMAGA', 4, 1),
(6, 5031, 'AMALFI', 4, 1),
(7, 5034, 'ANDES', 4, 1),
(8, 5036, 'ANGELOPOLIS', 4, 1),
(9, 5038, 'ANGOSTURA', 4, 1),
(10, 5040, 'ANORI', 4, 1),
(11, 5042, 'SANTAFE DE ANTIOQUIA', 4, 1),
(12, 5044, 'ANZA', 4, 1),
(13, 5045, 'APARTADO', 4, 1),
(14, 5051, 'ARBOLETES', 4, 1),
(15, 5055, 'ARGELIA', 4, 1),
(16, 5059, 'ARMENIA', 4, 1),
(17, 5079, 'BARBOSA', 4, 1),
(18, 5086, 'BELMIRA', 4, 1),
(19, 5088, 'BELLO', 4, 1),
(20, 5091, 'BETANIA', 4, 1),
(21, 5093, 'BETULIA', 4, 1),
(22, 5101, 'CIUDAD BOLIVAR', 4, 1),
(23, 5107, 'BRICEÑO', 4, 1),
(24, 5113, 'BURITICA', 4, 1),
(25, 5120, 'CACERES', 4, 1),
(26, 5125, 'CAICEDO', 4, 1),
(27, 5129, 'CALDAS', 4, 1),
(28, 5134, 'CAMPAMENTO', 4, 1),
(29, 5138, 'CAÑASGORDAS', 4, 1),
(30, 5142, 'CARACOLI', 4, 1),
(31, 5145, 'CARAMANTA', 4, 1),
(32, 5147, 'CAREPA', 4, 1),
(33, 5148, 'EL CARMEN DE VIBORAL', 4, 1),
(34, 5150, 'CAROLINA', 4, 1),
(35, 5154, 'CAUCASIA', 4, 1),
(36, 5172, 'CHIGORODO', 4, 1),
(37, 5190, 'CISNEROS', 4, 1),
(38, 5197, 'COCORNA', 4, 1),
(39, 5206, 'CONCEPCION', 4, 1),
(40, 5209, 'CONCORDIA', 4, 1),
(41, 5212, 'COPACABANA', 4, 1),
(42, 5234, 'DABEIBA', 4, 1),
(43, 5237, 'DON MATIAS', 4, 1),
(44, 5240, 'EBEJICO', 4, 1),
(45, 5250, 'EL BAGRE', 4, 1),
(46, 5264, 'ENTRERRIOS', 4, 1),
(47, 5266, 'ENVIGADO', 4, 1),
(48, 5282, 'FREDONIA', 4, 1),
(49, 5284, 'FRONTINO', 4, 1),
(50, 5306, 'GIRALDO', 4, 1),
(51, 5308, 'GIRARDOTA', 4, 1),
(52, 5310, 'GOMEZ PLATA', 4, 1),
(53, 5313, 'GRANADA', 4, 1),
(54, 5315, 'GUADALUPE', 4, 1),
(55, 5318, 'GUARNE', 4, 1),
(56, 5321, 'GUATAPE', 4, 1),
(57, 5347, 'HELICONIA', 4, 1),
(58, 5353, 'HISPANIA', 4, 1),
(59, 5360, 'ITAGUI', 4, 1),
(60, 5361, 'ITUANGO', 4, 1),
(61, 5364, 'JARDIN', 4, 1),
(62, 5368, 'JERICO', 4, 1),
(63, 5376, 'LA CEJA', 4, 1),
(64, 5380, 'LA ESTRELLA', 4, 1),
(65, 5390, 'LA PINTADA', 4, 1),
(66, 5400, 'LA UNION', 4, 1),
(67, 5411, 'LIBORINA', 4, 1),
(68, 5425, 'MACEO', 4, 1),
(69, 5440, 'MARINILLA', 4, 1),
(70, 5467, 'MONTEBELLO', 4, 1),
(71, 5475, 'MURINDO', 4, 1),
(72, 5480, 'MUTATA', 4, 1),
(73, 5483, 'NARIÑO', 4, 1),
(74, 5490, 'NECOCLI', 4, 1),
(75, 5495, 'NECHI', 4, 1),
(76, 5501, 'OLAYA', 4, 1),
(77, 5541, 'PEÐOL', 4, 1),
(78, 5543, 'PEQUE', 4, 1),
(79, 5576, 'PUEBLORRICO', 4, 1),
(80, 5579, 'PUERTO BERRIO', 4, 1),
(81, 5585, 'PUERTO NARE', 4, 1),
(82, 5591, 'PUERTO TRIUNFO', 4, 1),
(83, 5604, 'REMEDIOS', 4, 1),
(84, 5607, 'RETIRO', 4, 1),
(85, 5615, 'RIONEGRO', 4, 1),
(86, 5628, 'SABANALARGA', 4, 1),
(87, 5631, 'SABANETA', 4, 1),
(88, 5642, 'SALGAR', 4, 1),
(89, 5647, 'SAN ANDRES DE CUERQUIA', 4, 1),
(90, 5649, 'SAN CARLOS', 4, 1),
(91, 5652, 'SAN FRANCISCO', 4, 1),
(92, 5656, 'SAN JERONIMO', 4, 1),
(93, 5658, 'SAN JOSE DE LA MONTAÑA', 4, 1),
(94, 5659, 'SAN JUAN DE URABA', 4, 1),
(95, 5660, 'SAN LUIS', 4, 1),
(96, 5664, 'SAN PEDRO', 4, 1),
(97, 5665, 'SAN PEDRO DE URABA', 4, 1),
(98, 5667, 'SAN RAFAEL', 4, 1),
(99, 5670, 'SAN ROQUE', 4, 1),
(100, 5674, 'SAN VICENTE', 4, 1),
(101, 5679, 'SANTA BARBARA', 4, 1),
(102, 5686, 'SANTA ROSA DE OSOS', 4, 1),
(103, 5690, 'SANTO DOMINGO', 4, 1),
(104, 5697, 'EL SANTUARIO', 4, 1),
(105, 5736, 'SEGOVIA', 4, 1),
(106, 5756, 'SONSON', 4, 1),
(107, 5761, 'SOPETRAN', 4, 1),
(108, 5789, 'TAMESIS', 4, 1),
(109, 5790, 'TARAZA', 4, 1),
(110, 5792, 'TARSO', 4, 1),
(111, 5809, 'TITIRIBI', 4, 1),
(112, 5819, 'TOLEDO', 4, 1),
(113, 5837, 'TURBO', 4, 1),
(114, 5842, 'URAMITA', 4, 1),
(115, 5847, 'URRAO', 4, 1),
(116, 5854, 'VALDIVIA', 4, 1),
(117, 5856, 'VALPARAISO', 4, 1),
(118, 5858, 'VEGACHI', 4, 1),
(119, 5861, 'VENECIA', 4, 1),
(120, 5873, 'VIGIA DEL FUERTE', 4, 1),
(121, 5885, 'YALI', 4, 1),
(122, 5887, 'YARUMAL', 4, 1),
(123, 5890, 'YOLOMBO', 4, 1),
(124, 5893, 'YONDO', 4, 1),
(125, 5895, 'ZARAGOZA', 4, 1),
(126, 8001, 'BARRANQUILLA', 4, 2),
(127, 8078, 'BARANOA', 4, 2),
(128, 8137, 'CAMPO DE LA CRUZ', 4, 2),
(129, 8141, 'CANDELARIA', 4, 2),
(130, 8296, 'GALAPA', 4, 2),
(131, 8372, 'JUAN DE ACOSTA', 4, 2),
(132, 8421, 'LURUACO', 4, 2),
(133, 8433, 'MALAMBO', 4, 2),
(134, 8436, 'MANATI', 4, 2),
(135, 8520, 'PALMAR DE VARELA', 4, 2),
(136, 8549, 'PIOJO', 4, 2),
(137, 8558, 'POLONUEVO', 4, 2),
(138, 8560, 'PONEDERA', 4, 2),
(139, 8573, 'PUERTO COLOMBIA', 4, 2),
(140, 8606, 'REPELON', 4, 2),
(141, 8634, 'SABANAGRANDE', 4, 2),
(142, 8638, 'SABANALARGA', 4, 2),
(143, 8675, 'SANTA LUCIA', 4, 2),
(144, 8685, 'SANTO TOMAS', 4, 2),
(145, 8758, 'SOLEDAD', 4, 2),
(146, 8770, 'SUAN', 4, 2),
(147, 8832, 'TUBARA', 4, 2),
(148, 8849, 'USIACURI', 4, 2),
(149, 11001, 'BOGOTA, D.C.', 1, 3),
(150, 13001, 'CARTAGENA', 4, 4),
(151, 13006, 'ACHI', 4, 4),
(152, 13030, 'ALTOS DEL ROSARIO', 4, 4),
(153, 13042, 'ARENAL', 4, 4),
(154, 13052, 'ARJONA', 4, 4),
(155, 13062, 'ARROYOHONDO', 4, 4),
(156, 13074, 'BARRANCO DE LOBA', 4, 4),
(157, 13140, 'CALAMAR', 4, 4),
(158, 13160, 'CANTAGALLO', 4, 4),
(159, 13188, 'CICUCO', 4, 4),
(160, 13212, 'CORDOBA', 4, 4),
(161, 13222, 'CLEMENCIA', 4, 4),
(162, 13244, 'EL CARMEN DE BOLIVAR', 4, 4),
(163, 13248, 'EL GUAMO', 4, 4),
(164, 13268, 'EL PEÑON', 4, 4),
(165, 13300, 'HATILLO DE LOBA', 4, 4),
(166, 13430, 'MAGANGUE', 4, 4),
(167, 13433, 'MAHATES', 4, 4),
(168, 13440, 'MARGARITA', 4, 4),
(169, 13442, 'MARIA LA BAJA', 4, 4),
(170, 13458, 'MONTECRISTO', 4, 4),
(171, 13468, 'MOMPOS', 4, 4),
(172, 13490, 'NOROSI', 4, 4),
(173, 13473, 'MORALES', 4, 4),
(174, 13549, 'PINILLOS', 4, 4),
(175, 13580, 'REGIDOR', 4, 4),
(176, 13600, 'RIO VIEJO', 4, 4),
(177, 13620, 'SAN CRISTOBAL', 4, 4),
(178, 13647, 'SAN ESTANISLAO', 4, 4),
(179, 13650, 'SAN FERNANDO', 4, 4),
(180, 13654, 'SAN JACINTO', 4, 4),
(181, 13655, 'SAN JACINTO DEL CAUCA', 4, 4),
(182, 13657, 'SAN JUAN NEPOMUCENO', 4, 4),
(183, 13667, 'SAN MARTIN DE LOBA', 4, 4),
(184, 13670, 'SAN PABLO', 4, 4),
(185, 13673, 'SANTA CATALINA', 4, 4),
(186, 13683, 'SANTA ROSA', 4, 4),
(187, 13688, 'SANTA ROSA DEL SUR', 4, 4),
(188, 13744, 'SIMITI', 4, 4),
(189, 13760, 'SOPLAVIENTO', 4, 4),
(190, 13780, 'TALAIGUA NUEVO', 4, 4),
(191, 13810, 'TIQUISIO', 4, 4),
(192, 13836, 'TURBACO', 4, 4),
(193, 13838, 'TURBANA', 4, 4),
(194, 13873, 'VILLANUEVA', 4, 4),
(195, 13894, 'ZAMBRANO', 4, 4),
(196, 15001, 'TUNJA', 4, 5),
(197, 15022, 'ALMEIDA', 4, 5),
(198, 15047, 'AQUITANIA', 4, 5),
(199, 15051, 'ARCABUCO', 4, 5),
(200, 15087, 'BELEN', 4, 5),
(201, 15090, 'BERBEO', 4, 5),
(202, 15092, 'BETEITIVA', 4, 5),
(203, 15097, 'BOAVITA', 4, 5),
(204, 15104, 'BOYACA', 4, 5),
(205, 15106, 'BRICEÑO', 4, 5),
(206, 15109, 'BUENAVISTA', 4, 5),
(207, 15114, 'BUSBANZA', 4, 5),
(208, 15131, 'CALDAS', 4, 5),
(209, 15135, 'CAMPOHERMOSO', 4, 5),
(210, 15162, 'CERINZA', 4, 5),
(211, 15172, 'CHINAVITA', 4, 5),
(212, 15176, 'CHIQUINQUIRA', 4, 5),
(213, 15180, 'CHISCAS', 4, 5),
(214, 15183, 'CHITA', 4, 5),
(215, 15185, 'CHITARAQUE', 4, 5),
(216, 15187, 'CHIVATA', 4, 5),
(217, 15189, 'CIENEGA', 4, 5),
(218, 15204, 'COMBITA', 4, 5),
(219, 15212, 'COPER', 4, 5),
(220, 15215, 'CORRALES', 4, 5),
(221, 15218, 'COVARACHIA', 4, 5),
(222, 15223, 'CUBARA', 4, 5),
(223, 15224, 'CUCAITA', 4, 5),
(224, 15226, 'CUITIVA', 4, 5),
(225, 15232, 'CHIQUIZA', 4, 5),
(226, 15236, 'CHIVOR', 4, 5),
(227, 15238, 'DUITAMA', 4, 5),
(228, 15244, 'EL COCUY', 4, 5),
(229, 15248, 'EL ESPINO', 4, 5),
(230, 15272, 'FIRAVITOBA', 4, 5),
(231, 15276, 'FLORESTA', 4, 5),
(232, 15293, 'GACHANTIVA', 4, 5),
(233, 15296, 'GAMEZA', 4, 5),
(234, 15299, 'GARAGOA', 4, 5),
(235, 15317, 'GUACAMAYAS', 4, 5),
(236, 15322, 'GUATEQUE', 4, 5),
(237, 15325, 'GUAYATA', 4, 5),
(238, 15332, 'GsICAN', 4, 5),
(239, 15362, 'IZA', 4, 5),
(240, 15367, 'JENESANO', 4, 5),
(241, 15368, 'JERICO', 4, 5),
(242, 15377, 'LABRANZAGRANDE', 4, 5),
(243, 15380, 'LA CAPILLA', 4, 5),
(244, 15401, 'LA VICTORIA', 4, 5),
(245, 15403, 'LA UVITA', 4, 5),
(246, 15407, 'VILLA DE LEYVA', 4, 5),
(247, 15425, 'MACANAL', 4, 5),
(248, 15442, 'MARIPI', 4, 5),
(249, 15455, 'MIRAFLORES', 4, 5),
(250, 15464, 'MONGUA', 4, 5),
(251, 15466, 'MONGUI', 4, 5),
(252, 15469, 'MONIQUIRA', 4, 5),
(253, 15476, 'MOTAVITA', 4, 5),
(254, 15480, 'MUZO', 4, 5),
(255, 15491, 'NOBSA', 4, 5),
(256, 15494, 'NUEVO COLON', 4, 5),
(257, 15500, 'OICATA', 4, 5),
(258, 15507, 'OTANCHE', 4, 5),
(259, 15511, 'PACHAVITA', 4, 5),
(260, 15514, 'PAEZ', 4, 5),
(261, 15516, 'PAIPA', 4, 5),
(262, 15518, 'PAJARITO', 4, 5),
(263, 15522, 'PANQUEBA', 4, 5),
(264, 15531, 'PAUNA', 4, 5),
(265, 15533, 'PAYA', 4, 5),
(266, 15537, 'PAZ DE RIO', 4, 5),
(267, 15542, 'PESCA', 4, 5),
(268, 15550, 'PISBA', 4, 5),
(269, 15572, 'PUERTO BOYACA', 4, 5),
(270, 15580, 'QUIPAMA', 4, 5),
(271, 15599, 'RAMIRIQUI', 4, 5),
(272, 15600, 'RAQUIRA', 4, 5),
(273, 15621, 'RONDON', 4, 5),
(274, 15632, 'SABOYA', 4, 5),
(275, 15638, 'SACHICA', 4, 5),
(276, 15646, 'SAMACA', 4, 5),
(277, 15660, 'SAN EDUARDO', 4, 5),
(278, 15664, 'SAN JOSE DE PARE', 4, 5),
(279, 15667, 'SAN LUIS DE GACENO', 4, 5),
(280, 15673, 'SAN MATEO', 4, 5),
(281, 15676, 'SAN MIGUEL DE SEMA', 4, 5),
(282, 15681, 'SAN PABLO DE BORBUR', 4, 5),
(283, 15686, 'SANTANA', 4, 5),
(284, 15690, 'SANTA MARIA', 4, 5),
(285, 15693, 'SANTA ROSA DE VITERBO', 4, 5),
(286, 15696, 'SANTA SOFIA', 4, 5),
(287, 15720, 'SATIVANORTE', 4, 5),
(288, 15723, 'SATIVASUR', 4, 5),
(289, 15740, 'SIACHOQUE', 4, 5),
(290, 15753, 'SOATA', 4, 5),
(291, 15755, 'SOCOTA', 4, 5),
(292, 15757, 'SOCHA', 4, 5),
(293, 15759, 'SOGAMOSO', 4, 5),
(294, 15761, 'SOMONDOCO', 4, 5),
(295, 15762, 'SORA', 4, 5),
(296, 15763, 'SOTAQUIRA', 4, 5),
(297, 15764, 'SORACA', 4, 5),
(298, 15774, 'SUSACON', 4, 5),
(299, 15776, 'SUTAMARCHAN', 4, 5),
(300, 15778, 'SUTATENZA', 4, 5),
(301, 15790, 'TASCO', 4, 5),
(302, 15798, 'TENZA', 4, 5),
(303, 15804, 'TIBANA', 4, 5),
(304, 15806, 'TIBASOSA', 4, 5),
(305, 15808, 'TINJACA', 4, 5),
(306, 15810, 'TIPACOQUE', 4, 5),
(307, 15814, 'TOCA', 4, 5),
(308, 15816, 'TOGsI', 4, 5),
(309, 15820, 'TOPAGA', 4, 5),
(310, 15822, 'TOTA', 4, 5),
(311, 15832, 'TUNUNGUA', 4, 5),
(312, 15835, 'TURMEQUE', 4, 5),
(313, 15837, 'TUTA', 4, 5),
(314, 15839, 'TUTAZA', 4, 5),
(315, 15842, 'UMBITA', 4, 5),
(316, 15861, 'VENTAQUEMADA', 4, 5),
(317, 15879, 'VIRACACHA', 4, 5),
(318, 15897, 'ZETAQUIRA', 4, 5),
(319, 17001, 'MANIZALES', 4, 6),
(320, 17013, 'AGUADAS', 4, 6),
(321, 17042, 'ANSERMA', 4, 6),
(322, 17050, 'ARANZAZU', 4, 6),
(323, 17088, 'BELALCAZAR', 4, 6),
(324, 17174, 'CHINCHINA', 4, 6),
(325, 17272, 'FILADELFIA', 4, 6),
(326, 17380, 'LA DORADA', 4, 6),
(327, 17388, 'LA MERCED', 4, 6),
(328, 17433, 'MANZANARES', 4, 6),
(329, 17442, 'MARMATO', 4, 6),
(330, 17444, 'MARQUETALIA', 4, 6),
(331, 17446, 'MARULANDA', 4, 6),
(332, 17486, 'NEIRA', 4, 6),
(333, 17495, 'NORCASIA', 4, 6),
(334, 17513, 'PACORA', 4, 6),
(335, 17524, 'PALESTINA', 4, 6),
(336, 17541, 'PENSILVANIA', 4, 6),
(337, 17614, 'RIOSUCIO', 4, 6),
(338, 17616, 'RISARALDA', 4, 6),
(339, 17653, 'SALAMINA', 4, 6),
(340, 17662, 'SAMANA', 4, 6),
(341, 17665, 'SAN JOSE', 4, 6),
(342, 17777, 'SUPIA', 4, 6),
(343, 17867, 'VICTORIA', 4, 6),
(344, 17873, 'VILLAMARIA', 4, 6),
(345, 17877, 'VITERBO', 4, 6),
(346, 18001, 'FLORENCIA', 4, 7),
(347, 18029, 'ALBANIA', 4, 7),
(348, 18094, 'BELEN DE LOS ANDAQUIES', 4, 7),
(349, 18150, 'CARTAGENA DEL CHAIRA', 4, 7),
(350, 18205, 'CURILLO', 4, 7),
(351, 18247, 'EL DONCELLO', 4, 7),
(352, 18256, 'EL PAUJIL', 4, 7),
(353, 18410, 'LA MONTAÑITA', 4, 7),
(354, 18460, 'MILAN', 4, 7),
(355, 18479, 'MORELIA', 4, 7),
(356, 18592, 'PUERTO RICO', 4, 7),
(357, 18610, 'SAN JOSE DEL FRAGUA', 4, 7),
(358, 18753, 'SAN VICENTE DEL CAGUAN', 4, 7),
(359, 18756, 'SOLANO', 4, 7),
(360, 18785, 'SOLITA', 4, 7),
(361, 18860, 'VALPARAISO', 4, 7),
(362, 19001, 'POPAYAN', 4, 8),
(363, 19022, 'ALMAGUER', 4, 8),
(364, 19050, 'ARGELIA', 4, 8),
(365, 19075, 'BALBOA', 4, 8),
(366, 19100, 'BOLIVAR', 4, 8),
(367, 19110, 'BUENOS AIRES', 4, 8),
(368, 19130, 'CAJIBIO', 4, 8),
(369, 19137, 'CALDONO', 4, 8),
(370, 19142, 'CALOTO', 4, 8),
(371, 19212, 'CORINTO', 4, 8),
(372, 19256, 'EL TAMBO', 4, 8),
(373, 19290, 'FLORENCIA', 4, 8),
(374, 19300, 'GUACHENE', 4, 8),
(375, 19318, 'GUAPI', 4, 8),
(376, 19355, 'INZA', 4, 8),
(377, 19364, 'JAMBALO', 4, 8),
(378, 19392, 'LA SIERRA', 4, 8),
(379, 19397, 'LA VEGA', 4, 8),
(380, 19418, 'LOPEZ', 4, 8),
(381, 19450, 'MERCADERES', 4, 8),
(382, 19455, 'MIRANDA', 4, 8),
(383, 19473, 'MORALES', 4, 8),
(384, 19513, 'PADILLA', 4, 8),
(385, 19517, 'PAEZ', 4, 8),
(386, 19532, 'PATIA', 4, 8),
(387, 19533, 'PIAMONTE', 4, 8),
(388, 19548, 'PIENDAMO', 4, 8),
(389, 19573, 'PUERTO TEJADA', 4, 8),
(390, 19585, 'PURACE', 4, 8),
(391, 19622, 'ROSAS', 4, 8),
(392, 19693, 'SAN SEBASTIAN', 4, 8),
(393, 19698, 'SANTANDER DE QUILICHAO', 4, 8),
(394, 19701, 'SANTA ROSA', 4, 8),
(395, 19743, 'SILVIA', 4, 8),
(396, 19760, 'SOTARA', 4, 8),
(397, 19780, 'SUAREZ', 4, 8),
(398, 19785, 'SUCRE', 4, 8),
(399, 19807, 'TIMBIO', 4, 8),
(400, 19809, 'TIMBIQUI', 4, 8),
(401, 19821, 'TORIBIO', 4, 8),
(402, 19824, 'TOTORO', 4, 8),
(403, 19845, 'VILLA RICA', 4, 8),
(404, 20001, 'VALLEDUPAR', 4, 9),
(405, 20011, 'AGUACHICA', 4, 9),
(406, 20013, 'AGUSTIN CODAZZI', 4, 9),
(407, 20032, 'ASTREA', 4, 9),
(408, 20045, 'BECERRIL', 4, 9),
(409, 20060, 'BOSCONIA', 4, 9),
(410, 20175, 'CHIMICHAGUA', 4, 9),
(411, 20178, 'CHIRIGUANA', 4, 9),
(412, 20228, 'CURUMANI', 4, 9),
(413, 20238, 'EL COPEY', 4, 9),
(414, 20250, 'EL PASO', 4, 9),
(415, 20295, 'GAMARRA', 4, 9),
(416, 20310, 'GONZALEZ', 4, 9),
(417, 20383, 'LA GLORIA', 4, 9),
(418, 20400, 'LA JAGUA DE IBIRICO', 4, 9),
(419, 20443, 'MANAURE', 4, 9),
(420, 20517, 'PAILITAS', 4, 9),
(421, 20550, 'PELAYA', 4, 9),
(422, 20570, 'PUEBLO BELLO', 4, 9),
(423, 20614, 'RIO DE ORO', 4, 9),
(424, 20621, 'LA PAZ', 4, 9),
(425, 20710, 'SAN ALBERTO', 4, 9),
(426, 20750, 'SAN DIEGO', 4, 9),
(427, 20770, 'SAN MARTIN', 4, 9),
(428, 20787, 'TAMALAMEQUE', 4, 9),
(429, 23001, 'MONTERIA', 4, 10),
(430, 23068, 'AYAPEL', 4, 10),
(431, 23079, 'BUENAVISTA', 4, 10),
(432, 23090, 'CANALETE', 4, 10),
(433, 23162, 'CERETE', 4, 10),
(434, 23168, 'CHIMA', 4, 10),
(435, 23182, 'CHINU', 4, 10),
(436, 23189, 'CIENAGA DE ORO', 4, 10),
(437, 23300, 'COTORRA', 4, 10),
(438, 23350, 'LA APARTADA', 4, 10),
(439, 23417, 'LORICA', 4, 10),
(440, 23419, 'LOS CORDOBAS', 4, 10),
(441, 23464, 'MOMIL', 4, 10),
(442, 23466, 'MONTELIBANO', 4, 10),
(443, 23500, 'MOÑITOS', 4, 10),
(444, 23555, 'PLANETA RICA', 4, 10),
(445, 23570, 'PUEBLO NUEVO', 4, 10),
(446, 23574, 'PUERTO ESCONDIDO', 4, 10),
(447, 23580, 'PUERTO LIBERTADOR', 4, 10),
(448, 23586, 'PURISIMA', 4, 10),
(449, 23660, 'SAHAGUN', 4, 10),
(450, 23670, 'SAN ANDRES SOTAVENTO', 4, 10),
(451, 23672, 'SAN ANTERO', 4, 10),
(452, 23675, 'SAN BERNARDO DEL VIENTO', 4, 10),
(453, 23678, 'SAN CARLOS', 4, 10),
(454, 23686, 'SAN PELAYO', 4, 10),
(455, 23807, 'TIERRALTA', 4, 10),
(456, 23855, 'VALENCIA', 4, 10),
(457, 25001, 'AGUA DE DIOS', 4, 11),
(458, 25019, 'ALBAN', 4, 11),
(459, 25035, 'ANAPOIMA', 4, 11),
(460, 25040, 'ANOLAIMA', 4, 11),
(461, 25053, 'ARBELAEZ', 4, 11),
(462, 25086, 'BELTRAN', 4, 11),
(463, 25095, 'BITUIMA', 4, 11),
(464, 25099, 'BOJACA', 4, 11),
(465, 25120, 'CABRERA', 4, 11),
(466, 25123, 'CACHIPAY', 4, 11),
(467, 25126, 'CAJICA', 4, 11),
(468, 25148, 'CAPARRAPI', 4, 11),
(469, 25151, 'CAQUEZA', 4, 11),
(470, 25154, 'CARMEN DE CARUPA', 4, 11),
(471, 25168, 'CHAGUANI', 4, 11),
(472, 25175, 'CHIA', 4, 11),
(473, 25178, 'CHIPAQUE', 4, 11),
(474, 25181, 'CHOACHI', 4, 11),
(475, 25183, 'CHOCONTA', 4, 11),
(476, 25200, 'COGUA', 4, 11),
(477, 25214, 'COTA', 4, 11),
(478, 25224, 'CUCUNUBA', 4, 11),
(479, 25245, 'EL COLEGIO', 4, 11),
(480, 25258, 'EL PEÑON', 4, 11),
(481, 25260, 'EL ROSAL', 4, 11),
(482, 25269, 'FACATATIVA', 4, 11),
(483, 25279, 'FOMEQUE', 4, 11),
(484, 25281, 'FOSCA', 4, 11),
(485, 25286, 'FUNZA', 4, 11),
(486, 25288, 'FUQUENE', 4, 11),
(487, 25290, 'FUSAGASUGA', 4, 11),
(488, 25293, 'GACHALA', 4, 11),
(489, 25295, 'GACHANCIPA', 4, 11),
(490, 25297, 'GACHETA', 4, 11),
(491, 25299, 'GAMA', 4, 11),
(492, 25307, 'GIRARDOT', 4, 11),
(493, 25312, 'GRANADA', 4, 11),
(494, 25317, 'GUACHETA', 4, 11),
(495, 25320, 'GUADUAS', 4, 11),
(496, 25322, 'GUASCA', 4, 11),
(497, 25324, 'GUATAQUI', 4, 11),
(498, 25326, 'GUATAVITA', 4, 11),
(499, 25328, 'GUAYABAL DE SIQUIMA', 4, 11),
(500, 25335, 'GUAYABETAL', 4, 11),
(501, 25339, 'GUTIERREZ', 4, 11),
(502, 25368, 'JERUSALEN', 4, 11),
(503, 25372, 'JUNIN', 4, 11),
(504, 25377, 'LA CALERA', 4, 11),
(505, 25386, 'LA MESA', 4, 11),
(506, 25394, 'LA PALMA', 4, 11),
(507, 25398, 'LA PEÑA', 4, 11),
(508, 25402, 'LA VEGA', 4, 11),
(509, 25407, 'LENGUAZAQUE', 4, 11),
(510, 25426, 'MACHETA', 4, 11),
(511, 25430, 'MADRID', 4, 11),
(512, 25436, 'MANTA', 4, 11),
(513, 25438, 'MEDINA', 4, 11),
(514, 25473, 'MOSQUERA', 4, 11),
(515, 25483, 'NARIÑO', 4, 11),
(516, 25486, 'NEMOCON', 4, 11),
(517, 25488, 'NILO', 4, 11),
(518, 25489, 'NIMAIMA', 4, 11),
(519, 25491, 'NOCAIMA', 4, 11),
(520, 25506, 'VENECIA', 4, 11),
(521, 25513, 'PACHO', 4, 11),
(522, 25518, 'PAIME', 4, 11),
(523, 25524, 'PANDI', 4, 11),
(524, 25530, 'PARATEBUENO', 4, 11),
(525, 25535, 'PASCA', 4, 11),
(526, 25572, 'PUERTO SALGAR', 4, 11),
(527, 25580, 'PULI', 4, 11),
(528, 25592, 'QUEBRADANEGRA', 4, 11),
(529, 25594, 'QUETAME', 4, 11),
(530, 25596, 'QUIPILE', 4, 11),
(531, 25599, 'APULO', 4, 11),
(532, 25612, 'RICAURTE', 4, 11),
(533, 25645, 'SAN ANTONIO DEL TEQUENDAMA', 4, 11),
(534, 25649, 'SAN BERNARDO', 4, 11),
(535, 25653, 'SAN CAYETANO', 4, 11),
(536, 25658, 'SAN FRANCISCO', 4, 11),
(537, 25662, 'SAN JUAN DE RIO SECO', 4, 11),
(538, 25718, 'SASAIMA', 4, 11),
(539, 25736, 'SESQUILE', 4, 11),
(540, 25740, 'SIBATE', 4, 11),
(541, 25743, 'SILVANIA', 4, 11),
(542, 25745, 'SIMIJACA', 4, 11),
(543, 25754, 'SOACHA', 4, 11),
(544, 25758, 'SOPO', 4, 11),
(545, 25769, 'SUBACHOQUE', 4, 11),
(546, 25772, 'SUESCA', 4, 11),
(547, 25777, 'SUPATA', 4, 11),
(548, 25779, 'SUSA', 4, 11),
(549, 25781, 'SUTATAUSA', 4, 11),
(550, 25785, 'TABIO', 4, 11),
(551, 25793, 'TAUSA', 4, 11),
(552, 25797, 'TENA', 4, 11),
(553, 25799, 'TENJO', 4, 11),
(554, 25805, 'TIBACUY', 4, 11),
(555, 25807, 'TIBIRITA', 4, 11),
(556, 25815, 'TOCAIMA', 4, 11),
(557, 25817, 'TOCANCIPA', 4, 11),
(558, 25823, 'TOPAIPI', 4, 11),
(559, 25839, 'UBALA', 4, 11),
(560, 25841, 'UBAQUE', 4, 11),
(561, 25843, 'UBATE', 4, 11),
(562, 25845, 'UNE', 4, 11),
(563, 25851, 'UTICA', 4, 11),
(564, 25862, 'VERGARA', 4, 11),
(565, 25867, 'VIANI', 4, 11),
(566, 25871, 'VILLAGOMEZ', 4, 11),
(567, 25873, 'VILLAPINZON', 4, 11),
(568, 25875, 'VILLETA', 4, 11),
(569, 25878, 'VIOTA', 4, 11),
(570, 25885, 'YACOPI', 4, 11),
(571, 25898, 'ZIPACON', 4, 11),
(572, 25899, 'ZIPAQUIRA', 4, 11),
(573, 27001, 'QUIBDO', 4, 12),
(574, 27006, 'ACANDI', 4, 12),
(575, 27025, 'ALTO BAUDO', 4, 12),
(576, 27050, 'ATRATO', 4, 12),
(577, 27073, 'BAGADO', 4, 12),
(578, 27075, 'BAHIA SOLANO', 4, 12),
(579, 27077, 'BAJO BAUDO', 4, 12),
(580, 27099, 'BOJAYA', 4, 12),
(581, 27135, 'EL CANTON DEL SAN PABLO', 4, 12),
(582, 27150, 'CARMEN DEL DARIEN', 4, 12),
(583, 27160, 'CERTEGUI', 4, 12),
(584, 27205, 'CONDOTO', 4, 12),
(585, 27245, 'EL CARMEN DE ATRATO', 4, 12),
(586, 27250, 'EL LITORAL DEL SAN JUAN', 4, 12),
(587, 27361, 'ISTMINA', 4, 12),
(588, 27372, 'JURADO', 4, 12),
(589, 27413, 'LLORO', 4, 12),
(590, 27425, 'MEDIO ATRATO', 4, 12),
(591, 27430, 'MEDIO BAUDO', 4, 12),
(592, 27450, 'MEDIO SAN JUAN', 4, 12),
(593, 27491, 'NOVITA', 4, 12),
(594, 27495, 'NUQUI', 4, 12),
(595, 27580, 'RIO IRO', 4, 12),
(596, 27600, 'RIO QUITO', 4, 12),
(597, 27615, 'RIOSUCIO', 4, 12),
(598, 27660, 'SAN JOSE DEL PALMAR', 4, 12),
(599, 27745, 'SIPI', 4, 12),
(600, 27787, 'TADO', 4, 12),
(601, 27800, 'UNGUIA', 4, 12),
(602, 27810, 'UNION PANAMERICANA', 4, 12),
(603, 41001, 'NEIVA', 4, 13),
(604, 41006, 'ACEVEDO', 4, 13),
(605, 41013, 'AGRADO', 4, 13),
(606, 41016, 'AIPE', 4, 13),
(607, 41020, 'ALGECIRAS', 4, 13),
(608, 41026, 'ALTAMIRA', 4, 13),
(609, 41078, 'BARAYA', 4, 13),
(610, 41132, 'CAMPOALEGRE', 4, 13),
(611, 41206, 'COLOMBIA', 4, 13),
(612, 41244, 'ELIAS', 4, 13),
(613, 41298, 'GARZON', 4, 13),
(614, 41306, 'GIGANTE', 4, 13),
(615, 41319, 'GUADALUPE', 4, 13),
(616, 41349, 'HOBO', 4, 13),
(617, 41357, 'IQUIRA', 4, 13),
(618, 41359, 'ISNOS', 4, 13),
(619, 41378, 'LA ARGENTINA', 4, 13),
(620, 41396, 'LA PLATA', 4, 13),
(621, 41483, 'NATAGA', 4, 13),
(622, 41503, 'OPORAPA', 4, 13),
(623, 41518, 'PAICOL', 4, 13),
(624, 41524, 'PALERMO', 4, 13),
(625, 41530, 'PALESTINA', 4, 13),
(626, 41548, 'PITAL', 4, 13),
(627, 41551, 'PITALITO', 4, 13),
(628, 41615, 'RIVERA', 4, 13),
(629, 41660, 'SALADOBLANCO', 4, 13),
(630, 41668, 'SAN AGUSTIN', 4, 13),
(631, 41676, 'SANTA MARIA', 4, 13),
(632, 41770, 'SUAZA', 4, 13),
(633, 41791, 'TARQUI', 4, 13),
(634, 41797, 'TESALIA', 4, 13),
(635, 41799, 'TELLO', 4, 13),
(636, 41801, 'TERUEL', 4, 13),
(637, 41807, 'TIMANA', 4, 13),
(638, 41872, 'VILLAVIEJA', 4, 13),
(639, 41885, 'YAGUARA', 4, 13),
(640, 44001, 'RIOHACHA', 4, 14),
(641, 44035, 'ALBANIA', 4, 14),
(642, 44078, 'BARRANCAS', 4, 14),
(643, 44090, 'DIBULLA', 4, 14),
(644, 44098, 'DISTRACCION', 4, 14),
(645, 44110, 'EL MOLINO', 4, 14),
(646, 44279, 'FONSECA', 4, 14),
(647, 44378, 'HATONUEVO', 4, 14),
(648, 44420, 'LA JAGUA DEL PILAR', 4, 14),
(649, 44430, 'MAICAO', 4, 14),
(650, 44560, 'MANAURE', 4, 14),
(651, 44650, 'SAN JUAN DEL CESAR', 4, 14),
(652, 44847, 'URIBIA', 4, 14),
(653, 44855, 'URUMITA', 4, 14),
(654, 44874, 'VILLANUEVA', 4, 14),
(655, 47001, 'SANTA MARTA', 4, 15),
(656, 47030, 'ALGARROBO', 4, 15),
(657, 47053, 'ARACATACA', 4, 15),
(658, 47058, 'ARIGUANI', 4, 15),
(659, 47161, 'CERRO SAN ANTONIO', 4, 15),
(660, 47170, 'CHIBOLO', 4, 15),
(661, 47189, 'CIENAGA', 4, 15),
(662, 47205, 'CONCORDIA', 4, 15),
(663, 47245, 'EL BANCO', 4, 15),
(664, 47258, 'EL PIÑON', 4, 15),
(665, 47268, 'EL RETEN', 4, 15),
(666, 47288, 'FUNDACION', 4, 15),
(667, 47318, 'GUAMAL', 4, 15),
(668, 47460, 'NUEVA GRANADA', 4, 15),
(669, 47541, 'PEDRAZA', 4, 15),
(670, 47545, 'PIJIÑO DEL CARMEN', 4, 15),
(671, 47551, 'PIVIJAY', 4, 15),
(672, 47555, 'PLATO', 4, 15),
(673, 47570, 'PUEBLOVIEJO', 4, 15),
(674, 47605, 'REMOLINO', 4, 15),
(675, 47660, 'SABANAS DE SAN ANGEL', 4, 15),
(676, 47675, 'SALAMINA', 4, 15),
(677, 47692, 'SAN SEBASTIAN DE BUENAVISTA', 4, 15),
(678, 47703, 'SAN ZENON', 4, 15),
(679, 47707, 'SANTA ANA', 4, 15),
(680, 47720, 'SANTA BARBARA DE PINTO', 4, 15),
(681, 47745, 'SITIONUEVO', 4, 15),
(682, 47798, 'TENERIFE', 4, 15),
(683, 47960, 'ZAPAYAN', 4, 15),
(684, 47980, 'ZONA BANANERA', 4, 15),
(685, 50001, 'VILLAVICENCIO', 4, 16),
(686, 50006, 'ACACIAS', 4, 16),
(687, 50110, 'BARRANCA DE UPIA', 4, 16),
(688, 50124, 'CABUYARO', 4, 16),
(689, 50150, 'CASTILLA LA NUEVA', 4, 16),
(690, 50223, 'CUBARRAL', 4, 16),
(691, 50226, 'CUMARAL', 4, 16),
(692, 50245, 'EL CALVARIO', 4, 16),
(693, 50251, 'EL CASTILLO', 4, 16),
(694, 50270, 'EL DORADO', 4, 16),
(695, 50287, 'FUENTE DE ORO', 4, 16),
(696, 50313, 'GRANADA', 4, 16),
(697, 50318, 'GUAMAL', 4, 16),
(698, 50325, 'MAPIRIPAN', 4, 16),
(699, 50330, 'MESETAS', 4, 16),
(700, 50350, 'LA MACARENA', 4, 16),
(701, 50370, 'URIBE', 4, 16),
(702, 50400, 'LEJANIAS', 4, 16),
(703, 50450, 'PUERTO CONCORDIA', 4, 16),
(704, 50568, 'PUERTO GAITAN', 4, 16),
(705, 50573, 'PUERTO LOPEZ', 4, 16),
(706, 50577, 'PUERTO LLERAS', 4, 16),
(707, 50590, 'PUERTO RICO', 4, 16),
(708, 50606, 'RESTREPO', 4, 16),
(709, 50680, 'SAN CARLOS DE GUAROA', 4, 16),
(710, 50683, 'SAN JUAN DE ARAMA', 4, 16),
(711, 50686, 'SAN JUANITO', 4, 16),
(712, 50689, 'SAN MARTIN', 4, 16),
(713, 50711, 'VISTAHERMOSA', 4, 16),
(714, 52001, 'PASTO', 4, 17),
(715, 52019, 'ALBAN', 4, 17),
(716, 52022, 'ALDANA', 4, 17),
(717, 52036, 'ANCUYA', 4, 17),
(718, 52051, 'ARBOLEDA', 4, 17),
(719, 52079, 'BARBACOAS', 4, 17),
(720, 52083, 'BELEN', 4, 17),
(721, 52110, 'BUESACO', 4, 17),
(722, 52203, 'COLON', 4, 17),
(723, 52207, 'CONSACA', 4, 17),
(724, 52210, 'CONTADERO', 4, 17),
(725, 52215, 'CORDOBA', 4, 17),
(726, 52224, 'CUASPUD', 4, 17),
(727, 52227, 'CUMBAL', 4, 17),
(728, 52233, 'CUMBITARA', 4, 17),
(729, 52240, 'CHACHAGsI', 4, 17),
(730, 52250, 'EL CHARCO', 4, 17),
(731, 52254, 'EL PEÑOL', 4, 17),
(732, 52256, 'EL ROSARIO', 4, 17),
(733, 52258, 'EL TABLON DE GOMEZ', 4, 17),
(734, 52260, 'EL TAMBO', 4, 17),
(735, 52287, 'FUNES', 4, 17),
(736, 52317, 'GUACHUCAL', 4, 17),
(737, 52320, 'GUAITARILLA', 4, 17),
(738, 52323, 'GUALMATAN', 4, 17),
(739, 52352, 'ILES', 4, 17),
(740, 52354, 'IMUES', 4, 17),
(741, 52356, 'IPIALES', 4, 17),
(742, 52378, 'LA CRUZ', 4, 17),
(743, 52381, 'LA FLORIDA', 4, 17),
(744, 52385, 'LA LLANADA', 4, 17),
(745, 52390, 'LA TOLA', 4, 17),
(746, 52399, 'LA UNION', 4, 17),
(747, 52405, 'LEIVA', 4, 17),
(748, 52411, 'LINARES', 4, 17),
(749, 52418, 'LOS ANDES', 4, 17),
(750, 52427, 'MAGsI', 4, 17),
(751, 52435, 'MALLAMA', 4, 17),
(752, 52473, 'MOSQUERA', 4, 17),
(753, 52480, 'NARIÑO', 4, 17),
(754, 52490, 'OLAYA HERRERA', 4, 17),
(755, 52506, 'OSPINA', 4, 17),
(756, 52520, 'FRANCISCO PIZARRO', 4, 17),
(757, 52540, 'POLICARPA', 4, 17),
(758, 52560, 'POTOSI', 4, 17),
(759, 52565, 'PROVIDENCIA', 4, 17),
(760, 52573, 'PUERRES', 4, 17),
(761, 52585, 'PUPIALES', 4, 17),
(762, 52612, 'RICAURTE', 4, 17),
(763, 52621, 'ROBERTO PAYAN', 4, 17),
(764, 52678, 'SAMANIEGO', 4, 17),
(765, 52683, 'SANDONA', 4, 17),
(766, 52685, 'SAN BERNARDO', 4, 17),
(767, 52687, 'SAN LORENZO', 4, 17),
(768, 52693, 'SAN PABLO', 4, 17),
(769, 52694, 'SAN PEDRO DE CARTAGO', 4, 17),
(770, 52696, 'SANTA BARBARA', 4, 17),
(771, 52699, 'SANTACRUZ', 4, 17),
(772, 52720, 'SAPUYES', 4, 17),
(773, 52786, 'TAMINANGO', 4, 17),
(774, 52788, 'TANGUA', 4, 17),
(775, 52835, 'SAN ANDRES DE TUMACO', 4, 17),
(776, 52838, 'TUQUERRES', 4, 17),
(777, 52885, 'YACUANQUER', 4, 17),
(778, 54001, 'CUCUTA', 4, 18),
(779, 54003, 'ABREGO', 4, 18),
(780, 54051, 'ARBOLEDAS', 4, 18),
(781, 54099, 'BOCHALEMA', 4, 18),
(782, 54109, 'BUCARASICA', 4, 18),
(783, 54125, 'CACOTA', 4, 18),
(784, 54128, 'CACHIRA', 4, 18),
(785, 54172, 'CHINACOTA', 4, 18),
(786, 54174, 'CHITAGA', 4, 18),
(787, 54206, 'CONVENCION', 4, 18),
(788, 54223, 'CUCUTILLA', 4, 18),
(789, 54239, 'DURANIA', 4, 18),
(790, 54245, 'EL CARMEN', 4, 18),
(791, 54250, 'EL TARRA', 4, 18),
(792, 54261, 'EL ZULIA', 4, 18),
(793, 54313, 'GRAMALOTE', 4, 18),
(794, 54344, 'HACARI', 4, 18),
(795, 54347, 'HERRAN', 4, 18),
(796, 54377, 'LABATECA', 4, 18),
(797, 54385, 'LA ESPERANZA', 4, 18),
(798, 54398, 'LA PLAYA', 4, 18),
(799, 54405, 'LOS PATIOS', 4, 18),
(800, 54418, 'LOURDES', 4, 18),
(801, 54480, 'MUTISCUA', 4, 18),
(802, 54498, 'OCAÑA', 4, 18),
(803, 54518, 'PAMPLONA', 4, 18),
(804, 54520, 'PAMPLONITA', 4, 18),
(805, 54553, 'PUERTO SANTANDER', 4, 18),
(806, 54599, 'RAGONVALIA', 4, 18),
(807, 54660, 'SALAZAR', 4, 18),
(808, 54670, 'SAN CALIXTO', 4, 18),
(809, 54673, 'SAN CAYETANO', 4, 18),
(810, 54680, 'SANTIAGO', 4, 18),
(811, 54720, 'SARDINATA', 4, 18),
(812, 54743, 'SILOS', 4, 18),
(813, 54800, 'TEORAMA', 4, 18),
(814, 54810, 'TIBU', 4, 18),
(815, 54820, 'TOLEDO', 4, 18),
(816, 54871, 'VILLA CARO', 4, 18),
(817, 54874, 'VILLA DEL ROSARIO', 4, 18),
(818, 63001, 'ARMENIA', 4, 19),
(819, 63111, 'BUENAVISTA', 4, 19),
(820, 63130, 'CALARCA', 4, 19),
(821, 63190, 'CIRCASIA', 4, 19),
(822, 63212, 'CORDOBA', 4, 19),
(823, 63272, 'FILANDIA', 4, 19),
(824, 63302, 'GENOVA', 4, 19),
(825, 63401, 'LA TEBAIDA', 4, 19),
(826, 63470, 'MONTENEGRO', 4, 19),
(827, 63548, 'PIJAO', 4, 19),
(828, 63594, 'QUIMBAYA', 4, 19),
(829, 63690, 'SALENTO', 4, 19),
(830, 66001, 'PEREIRA', 4, 20),
(831, 66045, 'APIA', 4, 20),
(832, 66075, 'BALBOA', 4, 20),
(833, 66088, 'BELEN DE UMBRIA', 4, 20),
(834, 66170, 'DOSQUEBRADAS', 4, 20),
(835, 66318, 'GUATICA', 4, 20),
(836, 66383, 'LA CELIA', 4, 20),
(837, 66400, 'LA VIRGINIA', 4, 20),
(838, 66440, 'MARSELLA', 4, 20),
(839, 66456, 'MISTRATO', 4, 20),
(840, 66572, 'PUEBLO RICO', 4, 20),
(841, 66594, 'QUINCHIA', 4, 20),
(842, 66682, 'SANTA ROSA DE CABAL', 4, 20),
(843, 66687, 'SANTUARIO', 4, 20),
(844, 68001, 'BUCARAMANGA', 4, 21),
(845, 68013, 'AGUADA', 4, 21),
(846, 68020, 'ALBANIA', 4, 21),
(847, 68051, 'ARATOCA', 4, 21),
(848, 68077, 'BARBOSA', 4, 21),
(849, 68079, 'BARICHARA', 4, 21),
(850, 68081, 'BARRANCABERMEJA', 4, 21),
(851, 68092, 'BETULIA', 4, 21),
(852, 68101, 'BOLIVAR', 4, 21),
(853, 68121, 'CABRERA', 4, 21),
(854, 68132, 'CALIFORNIA', 4, 21),
(855, 68147, 'CAPITANEJO', 4, 21),
(856, 68152, 'CARCASI', 4, 21),
(857, 68160, 'CEPITA', 4, 21),
(858, 68162, 'CERRITO', 4, 21),
(859, 68167, 'CHARALA', 4, 21),
(860, 68169, 'CHARTA', 4, 21),
(861, 68176, 'CHIMA', 4, 21),
(862, 68179, 'CHIPATA', 4, 21),
(863, 68190, 'CIMITARRA', 4, 21),
(864, 68207, 'CONCEPCION', 4, 21),
(865, 68209, 'CONFINES', 4, 21),
(866, 68211, 'CONTRATACION', 4, 21),
(867, 68217, 'COROMORO', 4, 21),
(868, 68229, 'CURITI', 4, 21),
(869, 68235, 'EL CARMEN DE CHUCURI', 4, 21),
(870, 68245, 'EL GUACAMAYO', 4, 21),
(871, 68250, 'EL PEÑON', 4, 21),
(872, 68255, 'EL PLAYON', 4, 21),
(873, 68264, 'ENCINO', 4, 21),
(874, 68266, 'ENCISO', 4, 21),
(875, 68271, 'FLORIAN', 4, 21),
(876, 68276, 'FLORIDABLANCA', 4, 21),
(877, 68296, 'GALAN', 4, 21),
(878, 68298, 'GAMBITA', 4, 21),
(879, 68307, 'GIRON', 4, 21),
(880, 68318, 'GUACA', 4, 21),
(881, 68320, 'GUADALUPE', 4, 21),
(882, 68322, 'GUAPOTA', 4, 21),
(883, 68324, 'GUAVATA', 4, 21),
(884, 68327, 'GsEPSA', 4, 21),
(885, 68344, 'HATO', 4, 21),
(886, 68368, 'JESUS MARIA', 4, 21),
(887, 68370, 'JORDAN', 4, 21),
(888, 68377, 'LA BELLEZA', 4, 21),
(889, 68385, 'LANDAZURI', 4, 21),
(890, 68397, 'LA PAZ', 4, 21),
(891, 68406, 'LEBRIJA', 4, 21),
(892, 68418, 'LOS SANTOS', 4, 21),
(893, 68425, 'MACARAVITA', 4, 21),
(894, 68432, 'MALAGA', 4, 21),
(895, 68444, 'MATANZA', 4, 21),
(896, 68464, 'MOGOTES', 4, 21),
(897, 68468, 'MOLAGAVITA', 4, 21),
(898, 68498, 'OCAMONTE', 4, 21),
(899, 68500, 'OIBA', 4, 21),
(900, 68502, 'ONZAGA', 4, 21),
(901, 68522, 'PALMAR', 4, 21),
(902, 68524, 'PALMAS DEL SOCORRO', 4, 21),
(903, 68533, 'PARAMO', 4, 21),
(904, 68547, 'PIEDECUESTA', 4, 21),
(905, 68549, 'PINCHOTE', 4, 21),
(906, 68572, 'PUENTE NACIONAL', 4, 21),
(907, 68573, 'PUERTO PARRA', 4, 21),
(908, 68575, 'PUERTO WILCHES', 4, 21),
(909, 68615, 'RIONEGRO', 4, 21),
(910, 68655, 'SABANA DE TORRES', 4, 21),
(911, 68669, 'SAN ANDRES', 4, 21),
(912, 68673, 'SAN BENITO', 4, 21),
(913, 68679, 'SAN GIL', 4, 21),
(914, 68682, 'SAN JOAQUIN', 4, 21),
(915, 68684, 'SAN JOSE DE MIRANDA', 4, 21),
(916, 68686, 'SAN MIGUEL', 4, 21),
(917, 68689, 'SAN VICENTE DE CHUCURI', 4, 21),
(918, 68705, 'SANTA BARBARA', 4, 21),
(919, 68720, 'SANTA HELENA DEL OPON', 4, 21),
(920, 68745, 'SIMACOTA', 4, 21),
(921, 68755, 'SOCORRO', 4, 21),
(922, 68770, 'SUAITA', 4, 21),
(923, 68773, 'SUCRE', 4, 21),
(924, 68780, 'SURATA', 4, 21),
(925, 68820, 'TONA', 4, 21),
(926, 68855, 'VALLE DE SAN JOSE', 4, 21),
(927, 68861, 'VELEZ', 4, 21),
(928, 68867, 'VETAS', 4, 21),
(929, 68872, 'VILLANUEVA', 4, 21),
(930, 68895, 'ZAPATOCA', 4, 21),
(931, 70001, 'SINCELEJO', 4, 22),
(932, 70110, 'BUENAVISTA', 4, 22),
(933, 70124, 'CAIMITO', 4, 22),
(934, 70204, 'COLOSO', 4, 22),
(935, 70215, 'COROZAL', 4, 22),
(936, 70221, 'COVEÑAS', 4, 22),
(937, 70230, 'CHALAN', 4, 22),
(938, 70233, 'EL ROBLE', 4, 22),
(939, 70235, 'GALERAS', 4, 22),
(940, 70265, 'GUARANDA', 4, 22),
(941, 70400, 'LA UNION', 4, 22),
(942, 70418, 'LOS PALMITOS', 4, 22),
(943, 70429, 'MAJAGUAL', 4, 22),
(944, 70473, 'MORROA', 4, 22),
(945, 70508, 'OVEJAS', 4, 22),
(946, 70523, 'PALMITO', 4, 22),
(947, 70670, 'SAMPUES', 4, 22),
(948, 70678, 'SAN BENITO ABAD', 4, 22),
(949, 70702, 'SAN JUAN DE BETULIA', 4, 22),
(950, 70708, 'SAN MARCOS', 4, 22),
(951, 70713, 'SAN ONOFRE', 4, 22),
(952, 70717, 'SAN PEDRO', 4, 22),
(953, 70742, 'SAN LUIS DE SINCE', 4, 22),
(954, 70771, 'SUCRE', 4, 22),
(955, 70820, 'SANTIAGO DE TOLU', 4, 22),
(956, 70823, 'TOLU VIEJO', 4, 22),
(957, 73001, 'IBAGUE', 4, 23),
(958, 73024, 'ALPUJARRA', 4, 23),
(959, 73026, 'ALVARADO', 4, 23),
(960, 73030, 'AMBALEMA', 4, 23),
(961, 73043, 'ANZOATEGUI', 4, 23),
(962, 73055, 'ARMERO', 4, 23),
(963, 73067, 'ATACO', 4, 23),
(964, 73124, 'CAJAMARCA', 4, 23),
(965, 73148, 'CARMEN DE APICALA', 4, 23),
(966, 73152, 'CASABIANCA', 4, 23),
(967, 73168, 'CHAPARRAL', 4, 23),
(968, 73200, 'COELLO', 4, 23),
(969, 73217, 'COYAIMA', 4, 23),
(970, 73226, 'CUNDAY', 4, 23),
(971, 73236, 'DOLORES', 4, 23),
(972, 73268, 'ESPINAL', 4, 23),
(973, 73270, 'FALAN', 4, 23),
(974, 73275, 'FLANDES', 4, 23),
(975, 73283, 'FRESNO', 4, 23),
(976, 73319, 'GUAMO', 4, 23),
(977, 73347, 'HERVEO', 4, 23),
(978, 73349, 'HONDA', 4, 23),
(979, 73352, 'ICONONZO', 4, 23),
(980, 73408, 'LERIDA', 4, 23),
(981, 73411, 'LIBANO', 4, 23),
(982, 73443, 'MARIQUITA', 4, 23),
(983, 73449, 'MELGAR', 4, 23),
(984, 73461, 'MURILLO', 4, 23),
(985, 73483, 'NATAGAIMA', 4, 23),
(986, 73504, 'ORTEGA', 4, 23),
(987, 73520, 'PALOCABILDO', 4, 23),
(988, 73547, 'PIEDRAS', 4, 23),
(989, 73555, 'PLANADAS', 4, 23),
(990, 73563, 'PRADO', 4, 23),
(991, 73585, 'PURIFICACION', 4, 23),
(992, 73616, 'RIOBLANCO', 4, 23),
(993, 73622, 'RONCESVALLES', 4, 23),
(994, 73624, 'ROVIRA', 4, 23),
(995, 73671, 'SALDAÑA', 4, 23),
(996, 73675, 'SAN ANTONIO', 4, 23),
(997, 73678, 'SAN LUIS', 4, 23),
(998, 73686, 'SANTA ISABEL', 4, 23),
(999, 73770, 'SUAREZ', 4, 23),
(1000, 73854, 'VALLE DE SAN JUAN', 4, 23),
(1001, 73861, 'VENADILLO', 4, 23),
(1002, 73870, 'VILLAHERMOSA', 4, 23),
(1003, 73873, 'VILLARRICA', 4, 23),
(1004, 76001, 'CALI', 0, 24),
(1005, 76020, 'ALCALA', 4, 24),
(1006, 76036, 'ANDALUCIA', 4, 24),
(1007, 76041, 'ANSERMANUEVO', 4, 24),
(1008, 76054, 'ARGELIA', 4, 24),
(1009, 76100, 'BOLIVAR', 4, 24),
(1010, 76109, 'BUENAVENTURA', 4, 24),
(1011, 76111, 'GUADALAJARA DE BUGA', 4, 24),
(1012, 76113, 'BUGALAGRANDE', 4, 24),
(1013, 76122, 'CAICEDONIA', 4, 24),
(1014, 76126, 'CALIMA', 4, 24),
(1015, 76130, 'CANDELARIA', 4, 24),
(1016, 76147, 'CARTAGO', 4, 24),
(1017, 76233, 'DAGUA', 4, 24),
(1018, 76243, 'EL AGUILA', 4, 24),
(1019, 76246, 'EL CAIRO', 4, 24),
(1020, 76248, 'EL CERRITO', 4, 24),
(1021, 76250, 'EL DOVIO', 4, 24),
(1022, 76275, 'FLORIDA', 4, 24),
(1023, 76306, 'GINEBRA', 4, 24),
(1024, 76318, 'GUACARI', 4, 24),
(1025, 76364, 'JAMUNDI', 4, 24),
(1026, 76377, 'LA CUMBRE', 4, 24),
(1027, 76400, 'LA UNION', 4, 24),
(1028, 76403, 'LA VICTORIA', 4, 24),
(1029, 76497, 'OBANDO', 4, 24),
(1030, 76520, 'PALMIRA', 4, 24),
(1031, 76563, 'PRADERA', 4, 24),
(1032, 76606, 'RESTREPO', 4, 24),
(1033, 76616, 'RIOFRIO', 4, 24),
(1034, 76622, 'ROLDANILLO', 4, 24),
(1035, 76670, 'SAN PEDRO', 4, 24),
(1036, 76736, 'SEVILLA', 4, 24),
(1037, 76823, 'TORO', 4, 24),
(1038, 76828, 'TRUJILLO', 4, 24),
(1039, 76834, 'TULUA', 4, 24),
(1040, 76845, 'ULLOA', 4, 24),
(1041, 76863, 'VERSALLES', 4, 24),
(1042, 76869, 'VIJES', 4, 24),
(1043, 76890, 'YOTOCO', 4, 24),
(1044, 76892, 'YUMBO', 4, 24),
(1045, 76895, 'ZARZAL', 4, 24),
(1046, 81001, 'ARAUCA', 4, 25),
(1047, 81065, 'ARAUQUITA', 4, 25),
(1048, 81220, 'CRAVO NORTE', 4, 25),
(1049, 81300, 'FORTUL', 4, 25),
(1050, 81591, 'PUERTO RONDON', 4, 25),
(1051, 81736, 'SARAVENA', 4, 25),
(1052, 81794, 'TAME', 4, 25),
(1053, 85001, 'YOPAL', 4, 26),
(1054, 85010, 'AGUAZUL', 4, 26),
(1055, 85015, 'CHAMEZA', 4, 26),
(1056, 85125, 'HATO COROZAL', 4, 26),
(1057, 85136, 'LA SALINA', 4, 26),
(1058, 85139, 'MANI', 4, 26),
(1059, 85162, 'MONTERREY', 4, 26),
(1060, 85225, 'NUNCHIA', 4, 26),
(1061, 85230, 'OROCUE', 4, 26),
(1062, 85250, 'PAZ DE ARIPORO', 4, 26),
(1063, 85263, 'PORE', 4, 26),
(1064, 85279, 'RECETOR', 4, 26),
(1065, 85300, 'SABANALARGA', 4, 26),
(1066, 85315, 'SACAMA', 4, 26),
(1067, 85325, 'SAN LUIS DE PALENQUE', 4, 26),
(1068, 85400, 'TAMARA', 4, 26),
(1069, 85410, 'TAURAMENA', 4, 26),
(1070, 85430, 'TRINIDAD', 4, 26),
(1071, 85440, 'VILLANUEVA', 4, 26),
(1072, 86001, 'MOCOA', 4, 27),
(1073, 86219, 'COLON', 4, 27),
(1074, 86320, 'ORITO', 4, 27),
(1075, 86568, 'PUERTO ASIS', 4, 27),
(1076, 86569, 'PUERTO CAICEDO', 4, 27),
(1077, 86571, 'PUERTO GUZMAN', 4, 27),
(1078, 86573, 'LEGUIZAMO', 4, 27),
(1079, 86749, 'SIBUNDOY', 4, 27),
(1080, 86755, 'SAN FRANCISCO', 4, 27),
(1081, 86757, 'SAN MIGUEL', 4, 27),
(1082, 86760, 'SANTIAGO', 4, 27),
(1083, 86865, 'VALLE DEL GUAMUEZ', 4, 27),
(1084, 86885, 'VILLAGARZON', 4, 27),
(1085, 88001, 'SAN ANDRES', 4, 28),
(1086, 88564, 'PROVIDENCIA', 4, 28),
(1087, 91001, 'LETICIA', 4, 29),
(1088, 91263, 'EL ENCANTO', 4, 29),
(1089, 91405, 'LA CHORRERA', 4, 29),
(1090, 91407, 'LA PEDRERA', 4, 29),
(1091, 91430, 'LA VICTORIA', 4, 29),
(1092, 91460, 'MIRITI - PARANA', 4, 29),
(1093, 91530, 'PUERTO ALEGRIA', 4, 29),
(1094, 91536, 'PUERTO ARICA', 4, 29),
(1095, 91540, 'PUERTO NARIÑO', 4, 29),
(1096, 91669, 'PUERTO SANTANDER', 4, 29),
(1097, 91798, 'TARAPACA', 4, 29),
(1098, 94001, 'INIRIDA', 4, 30),
(1099, 94343, 'BARRANCO MINAS', 4, 30),
(1100, 94663, 'MAPIRIPANA', 4, 30),
(1101, 94883, 'SAN FELIPE', 4, 30),
(1102, 94884, 'PUERTO COLOMBIA', 4, 30),
(1103, 94885, 'LA GUADALUPE', 4, 30),
(1104, 94886, 'CACAHUAL', 4, 30),
(1105, 94887, 'PANA PANA', 4, 30),
(1106, 94888, 'MORICHAL', 4, 30),
(1107, 95001, 'SAN JOSE DEL GUAVIARE', 4, 31),
(1108, 95015, 'CALAMAR', 4, 31),
(1109, 95025, 'EL RETORNO', 4, 31),
(1110, 95200, 'MIRAFLORES', 4, 31),
(1111, 97001, 'MITU', 4, 32),
(1112, 97161, 'CARURU', 4, 32),
(1113, 97511, 'PACOA', 4, 32),
(1114, 97666, 'TARAIRA', 4, 32),
(1115, 97777, 'PAPUNAUA', 4, 32),
(1116, 97889, 'YAVARATE', 4, 32),
(1117, 99001, 'PUERTO CARREÑO', 4, 33),
(1118, 99524, 'LA PRIMAVERA', 4, 33),
(1119, 99624, 'SANTA ROSALIA', 4, 33),
(1120, 99773, 'CUMARIBO', 4, 33);

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
(4, 4, 'Devolución'),
(6, 6, 'Bicicletas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquidares`
--

CREATE TABLE IF NOT EXISTS `liquidares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firmado` enum('Si','No') DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `origen` int(11) DEFAULT NULL,
  `destino` int(11) DEFAULT NULL,
  `declarado` varchar(100) DEFAULT NULL,
  `empaque_info` text,
  `valKilo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `liquidares`
--

INSERT INTO `liquidares` (`id`, `firmado`, `cliente_id`, `origen`, `destino`, `declarado`, `empaque_info`, `valKilo`) VALUES
(3, 'Si', 5, 2, 2, '15000', '{"empaques":["1","2","3"],"cantidad":["11","21","31"],"largo":["12","22","32"],"ancho":["13","23","33"],"alto":["14","24","34"],"peso":["2","6","11"],"pesoVol":["0.87","4.86","14.36"],"valor":["500.00","1000.00","5000.00"],"kiloAd":["1.00","5.00","10.00"],"subtotal":["5600.00","21100.00","155436.00"]}', '100.00');

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
  `tipo` enum('Entrega','Recogida','Otro') DEFAULT NULL,
  `novedad` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `novedades`
--

INSERT INTO `novedades` (`id`, `codigo`, `tipo`, `novedad`) VALUES
(1, '1', 'Entrega', 'El destinatario no se encontraba en el domicilio'),
(2, '2', 'Recogida', 'Otra novedad');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `oficinas`
--

INSERT INTO `oficinas` (`id`, `nit`, `codigo`, `nombre`, `desde`, `hasta`, `direccion`, `telefono`, `ext`, `resolucion`, `barras`, `imprimir`, `destinos`) VALUES
(1, '65448-4', 1, 'Central', '100', '1000', 'Cll 48 98 1', '444654', '56', '456-4546-7', 'No', 'Si', '["3","7"]'),
(2, '56498-4', 2, 'Terminal', '122', '123', 'Cra 15 - 48 a 12', '541564', '12', '31354', 'No', 'No', '["1"]');

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
  `direccion` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
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
  `observaciones2` text,
  `usuario_registra` varchar(100) DEFAULT NULL,
  `usuario_asigna` int(11) DEFAULT NULL,
  `usuario_anula` varchar(100) DEFAULT NULL,
  `anulo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `recogidas`
--

INSERT INTO `recogidas` (`id`, `estado`, `clienteTel`, `clienteNom`, `clienteCc`, `clienteDir`, `clienteCiu`, `direccion`, `ciudad`, `llamo`, `preguntar`, `cargo`, `telefono`, `observaciones`, `cantidad`, `detalle`, `desde`, `hasta`, `fecha`, `hora`, `observaciones2`, `usuario_registra`, `usuario_asigna`, `usuario_anula`, `anulo`) VALUES
(1, 'Anulada', '6112233', 'Esteban Arango Sanchez', '32123123', 'Cll 23 # 54 - 23', 'MEDELLIN (ANTIOQUIA)', 'asdasdas', 'MEDELLIN (ANTIOQUIA)', 'asdasd', 'asdasd', 'asdasd', 'dasdasd', 'dasdasd', 'dasdas', 'dsadasd', '05:11 AM', '05:18 PM', '2014-03-27', '05:18 PM', 'asdasdasdasd', 'Esteban Arango', 0, 'Esteban Arango', 'maria juan'),
(2, 'Anulada', '6112233', 'Esteban Arango Sanchez', '32123123', 'Cll 23 # 54 - 23', 'MEDELLIN (ANTIOQUIA)', 'sadasd', 'ANORI (ANTIOQUIA)', 'sadas', 'dasd', 'asds', 'sdasda', 'sdasd', 'asda', 'sdasd', '05:23 PM', '05:22 PM', '2014-03-27', '05:22 PM', NULL, 'Esteban Arango', NULL, 'Esteban Arango', ''),
(3, 'Anulada', '6112233', 'Esteban Arango Sanchez', '32123123', 'Cll 23 # 54 - 23', 'MEDELLIN (ANTIOQUIA)', 'cl564', 'MEDELLIN (ANTIOQUIA)', '54564', '546', '54', '4564', '56454', '45456', '456465', '04:37 PM', '04:37 PM', '2014-04-09', '04:37 PM', 'adgadgasjd', 'Esteban Arango', 0, 'Esteban Arango', 'julian'),
(6, 'Asignada', '6112233', 'Esteban Arango Sanchez', '32123123', 'Cll 23 # 54 - 23', 'MEDELLIN (ANTIOQUIA)', 'Cll 15 13 87', 'MEDELLIN (ANTIOQUIA)', '2131', '44', '256456', '56456', '4564654', '4', '46545645', '05:33 PM', '05:09 PM', '2014-04-02', '05:10 PM', '', 'Esteban Arango', 0, NULL, NULL),
(8, 'Asignada', '0987654321', 'Leidy Jimenez', '123456789', 'Cra 23 # 23 - 23', 'MEDELLIN (ANTIOQUIA)', 'Cll 45 - 45 45', 'MEDELLIN (ANTIOQUIA)', 'Leidy', 'Leidy', '', '0987654321', 'NA', '2', 'Cajas', '01:30 PM', '01:30 PM', '2014-04-23', '01:15 PM', 'NA', 'Esteban Arango', 0, NULL, NULL),
(11, 'Anulada', '0987654321', 'Leidy Jimenez', '123456789', 'Cra 23 # 23 - 23', 'MEDELLIN (ANTIOQUIA)', 'Cll 464', 'ARBOLETES (ANTIOQUIA)', '56', '4', '564', '6', '456', '4', '6', '01:22 PM', '01:22 PM', '0000-00-00', '01:22 PM', 'NA', 'Esteban Arango', 0, 'Esteban Arango', 'Jose'),
(12, 'Asignada', '1234567890', 'Esteban Arango Sanchez', '32123123', 'Cll 23 # 54 - 23', 'MEDELLIN (ANTIOQUIA)', 'sdfsdf', 'ANZA (ANTIOQUIA)', 'hjg', 'hjg', 'hjg', 'jh', 'gjh', 'ghjgj', 'gjgjg', '02:55 PM', '02:55 PM', '2014-03-01', '02:55 PM', 'sdfsdfsdfsdf', ' ', 0, NULL, NULL),
(13, 'Asignada', '1234567890', 'Esteban Arango Sanchez', '32123123', 'Cll 23 # 54 - 23', 'MEDELLIN (ANTIOQUIA)', 'fffffff', 'AMALFI (ANTIOQUIA)', 'fffffffff', 'fffffffffff', 'ffffffffff', '234234', 'sdfsdf', '2', 'asdasdasd', '08:30 PM', '08:28 AM', '2014-04-26', '03:43 PM', 'sdfsdfsdf', 'Esteban Arango', 0, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id`, `codigo`, `nombre`, `departamento_id`) VALUES
(1, 1, 'Medellin_Bogota', 18),
(2, 2, 'Region B', 2),
(4, 4, 'TodasMenosMedallo', 1),
(5, 3, 'SUR CERCANO', 1),
(6, 5, 'Cali con Nevia', 1),
(7, 6, 'asdasd', 1);

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
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `order`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'Admin', 1, '2012-07-13 15:33:48', 0, '2012-07-13 15:33:48', NULL),
(2, 'Representante', 20, '2012-07-13 15:35:43', 0, '2012-07-13 15:35:43', NULL);

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
  `largo` double(20,2) DEFAULT NULL,
  `ancho` double(20,2) DEFAULT NULL,
  `alto` double(20,2) DEFAULT NULL,
  `peso` double(20,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `tarifa`, `max_kilo`, `empaque_id`, `cliente_id`, `origen`, `destino`, `valor_adicional`, `declarado`, `porcen_declarado`, `largo`, `ancho`, `alto`, `peso`) VALUES
(50, 5.00000, 564.00000, 1, 10, 1, 1, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(52, 4.00000, 56.00000, 2, 10, 1, 1, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(54, 564.00000, 456.00000, 3, 10, 1, 1, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(56, 65.00000, 456.00000, 4, 10, 1, 1, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(57, 5.00000, 564.00000, 1, 10, 1, 149, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(58, 5.00000, 564.00000, 1, 10, 149, 1, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(59, 4.00000, 56.00000, 2, 10, 1, 149, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(60, 4.00000, 56.00000, 2, 10, 149, 1, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(61, 564.00000, 456.00000, 3, 10, 1, 149, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(62, 564.00000, 456.00000, 3, 10, 149, 1, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(63, 65.00000, 456.00000, 4, 10, 1, 149, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00),
(64, 65.00000, 456.00000, 4, 10, 149, 1, 456.00000, 4.00000, 564.00000, 0.00, 0.00, 0.00, 0.00);

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
  `role_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oficina` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `cookie` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `name`, `lastname`, `email`, `telefono`, `oficina`, `created`, `cookie`, `modified`) VALUES
(1, 1, 'esteban', 'a938dfdfbaa1f25ccbc39e16060f73c44e5ef0dd', 'Esteban', 'Arango', 'john@alaxos.com', NULL, 1, '2012-09-21 15:28:38', '1399408778', '2012-09-21 15:28:38'),
(2, 2, 'leidy', 'a938dfdfbaa1f25ccbc39e16060f73c44e5ef0dd', 'Leidy', 'Jimenez', 'john@alaxos.com', NULL, 1, '2012-09-21 15:28:38', '1394652043', '2012-09-21 15:28:38'),
(3, 2, 'juancho', 'a938dfdfbaa1f25ccbc39e16060f73c44e5ef0dd', 'Juan alberto', 'Alvarez gomez', 'ja@gmail.com', '4654646454', 1, '2014-03-11 17:06:08', NULL, '2014-03-11 17:06:08');

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
