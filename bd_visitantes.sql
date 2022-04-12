-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-04-2022 a las 17:14:41
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_visitantes`
--
CREATE DATABASE IF NOT EXISTS `bd_visitantes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_visitantes`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `getVisitasxMes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getVisitasxMes` ()  select ELT(Month(`fecha`),'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre') as mes_espanol, Month(`fecha`) as num_mes, count(*) as total, MonthName(`fecha`) as mes from visitas where year(`fecha`) = year(curdate()) group by num_mes, mes, mes_espanol$$

DROP PROCEDURE IF EXISTS `ObtenerTotalDocumentosMeses`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerTotalDocumentosMeses` ()  select ELT(Month(`doc_femision`),'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre') as mes_espanol, Month(`doc_femision`) as num_mes, count(*) as total, MonthName(`doc_femision`) as mes from documentos where year(`doc_femision`) = year(curdate()) group by num_mes, mes, mes_espanol$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_visitados`
--

DROP TABLE IF EXISTS `empleados_visitados`;
CREATE TABLE `empleados_visitados` (
  `id_empleado_visitado` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `departamento` text,
  `extension` varchar(8) DEFAULT NULL,
  `puesto` text,
  `email` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados_visitados`
--

INSERT INTO `empleados_visitados` (`id_empleado_visitado`, `codigo`, `nombre`, `departamento`, `extension`, `puesto`, `email`, `status`, `created_at`, `updated_at`) VALUES
(11, 107013, 'AARON  MARTE HERNANDEZ', 'TECNOLOGIA DE LA INFORMACION Y COMUNICACION', '2595', 'ADMINISTRADOR DE REDES Y COMUNICACIONES', 'amarte@inespre.gob.do', 1, '2022-04-08 14:18:12', '2022-04-08 14:18:12'),
(12, 207296, 'ALEX YONSON PEÑA ALCANTARA', 'TECNOLOGIA DE LA INFORMACION Y COMUNICACION', '2593', 'ADMINISTRADOR DE REDES Y COMUNICACIONES', 'apena@inespre.gob.do', 1, '2022-04-08 14:19:00', '2022-04-08 14:19:00'),
(13, 206283, 'BIENVENIDO  FELIZ SUERO', 'TECNOLOGIA DE LA INFORMACION Y COMUNICACION', '2594', 'ENC. DIV. DESARROLLO E IMPLEMENTACIÓN DE SISTEMAS TIC', 'bfeliz@inespre.gob.do', 1, '2022-04-08 14:54:16', '2022-04-08 14:54:16'),
(14, 206282, 'BERNARDO JUNIOR DEL CARMEN PEÑA', 'TECNOLOGIA DE LA INFORMACION Y COMUNICACION', '2596', 'ENC. DIV. DE ADMINISTRACION DE SERVICIOS TICS', 'bjdelcarmen@inespre.gob.do', 1, '2022-04-08 14:56:28', '2022-04-08 14:56:28'),
(15, 22922, 'KENT WYNN SANCHEZ ', 'TECNOLOGIA DE LA INFORMACION Y COMUNICACION', '2595', 'ADMINISTRADOR DE REDES Y COMUNICACIONES', 'ksanchez@inespre.gob.do', 1, '2022-04-08 15:04:12', '2022-04-08 15:04:12'),
(16, 207295, 'ALVARO  VASQUEZ VILLANUEVA', 'TECNOLOGIA DE LA INFORMACION Y COMUNICACION', '', 'SOPORTE MESA DE AYUDA / HELP DESK', 'avasquez@inespre.gob.do', 1, '2022-04-08 15:06:57', '2022-04-08 15:06:57'),
(17, 207358, 'KELVIN JASSEL DE LOS SANTOS VENTURA', 'TECNOLOGIA DE LA INFORMACION Y COMUNICACION', '', 'SOPORTE TECNICO INFORMATICO', '', 1, '2022-04-11 13:38:14', '2022-04-11 13:38:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

DROP TABLE IF EXISTS `instituciones`;
CREATE TABLE `instituciones` (
  `id_institucion` int(11) NOT NULL,
  `nombre_institucion` varchar(255) NOT NULL,
  `telefono_institucion` varchar(30) DEFAULT NULL,
  `status_institucion` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `instituciones`
--

INSERT INTO `instituciones` (`id_institucion`, `nombre_institucion`, `telefono_institucion`, `status_institucion`, `created_at`, `updated_at`) VALUES
(27, 'INAGUJA', '809-555-5455', 1, '2022-03-28 14:16:48', '2022-03-28 14:17:45'),
(29, 'IAD', '809-555-5555', 1, '2022-03-28 14:17:22', '2022-03-28 14:17:22'),
(30, 'IDECOOP', '809-555-5555', 1, '2022-03-28 14:17:36', '2022-03-28 14:17:36'),
(32, 'Prueba', '', 2, '2022-04-04 11:20:00', '2022-04-04 11:20:04'),
(33, 'Otra Empresa', '3434334', 1, '2022-04-05 10:57:34', '2022-04-05 10:57:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos`
--

DROP TABLE IF EXISTS `motivos`;
CREATE TABLE `motivos` (
  `id_motivo` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `usuario_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `motivos`
--

INSERT INTO `motivos` (`id_motivo`, `descripcion`, `status`, `created_at`, `updated_at`, `usuario_id`) VALUES
(1, 'Visita Rutina', 1, '2022-03-10 18:33:44', '2022-03-10 18:33:44', '1'),
(2, 'Visita Departamento', 1, '2022-03-10 18:34:11', '2022-03-10 18:34:11', '5'),
(3, 'Negocios', 1, '2022-03-10 18:34:11', '2022-03-10 18:34:11', '5'),
(4, 'Instalacion de Equipos informaticos', 0, '2022-03-18 13:27:00', '2022-03-18 13:29:19', '0'),
(48, 'Otros Motivos', 1, '2022-03-28 18:18:05', '2022-03-28 18:18:05', '0'),
(49, 'Otros Motivos 2', 1, '2022-04-05 14:57:24', '2022-04-05 14:57:24', '0'),
(50, 'Otros Motivos 3', 1, '2022-04-08 17:13:30', '2022-04-08 17:13:30', '0'),
(51, 'Nuevo', 1, '2022-04-11 13:38:03', '2022-04-11 13:38:03', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

DROP TABLE IF EXISTS `visitantes`;
CREATE TABLE `visitantes` (
  `id_visitante` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `tipo_identidad` enum('Cedula','Pasaporte','Licencia') DEFAULT NULL,
  `identidad` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`id_visitante`, `nombres`, `apellidos`, `tipo_identidad`, `identidad`, `telefono`, `status`, `created_at`, `updated_at`) VALUES
(29, 'Juancito', 'Trucupey', 'Cedula', '00115723108', '809-593-3647', 1, '2022-04-08 12:00:48', '2022-04-08 12:00:48'),
(30, 'Lebron', 'James', 'Cedula', '123456789', '', 1, '2022-04-08 15:03:46', '2022-04-08 15:03:46'),
(31, 'Kyrie Alejandro', 'Irving Mendoza', 'Cedula', '987654321', '8095698745', 1, '2022-04-08 17:13:06', '2022-04-08 17:13:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

DROP TABLE IF EXISTS `visitas`;
CREATE TABLE `visitas` (
  `id_visita` int(11) NOT NULL,
  `visitante_id` int(11) NOT NULL,
  `no_gafete` varchar(10) DEFAULT NULL,
  `motivo_id` int(11) NOT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `fecha_programada` date DEFAULT NULL,
  `total_visitantes` varchar(2) DEFAULT NULL,
  `equipos` text,
  `hora_entrada` time NOT NULL,
  `hora_salida` time DEFAULT NULL,
  `foto` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_visita`, `visitante_id`, `no_gafete`, `motivo_id`, `institucion_id`, `empleado_id`, `fecha`, `fecha_programada`, `total_visitantes`, `equipos`, `hora_entrada`, `hora_salida`, `foto`, `status`, `created_at`, `updated_at`, `usuario_id`) VALUES
(199, 29, NULL, 1, NULL, 107013, '2022-04-08', NULL, NULL, NULL, '11:17:00', NULL, NULL, 1, '2022-04-08 19:09:10', '2022-04-08 14:18:13', '0'),
(200, 29, NULL, 1, NULL, 207296, '2022-04-08', NULL, NULL, NULL, '11:18:00', NULL, NULL, 1, '2022-04-11 13:37:15', '2022-04-11 12:37:15', '0'),
(201, 29, NULL, 2, 29, 107013, '2022-04-08', NULL, NULL, NULL, '11:51:00', NULL, NULL, 1, '2022-04-08 14:51:49', '2022-04-08 14:51:49', '0'),
(202, 29, NULL, 1, NULL, 206283, '2022-04-08', NULL, NULL, NULL, '11:52:00', NULL, NULL, 1, '2022-04-08 14:54:16', '2022-04-08 14:54:16', '0'),
(203, 29, '55', 3, NULL, 207296, '2022-04-08', NULL, NULL, NULL, '11:55:00', NULL, NULL, 1, '2022-04-11 14:36:37', '2022-04-11 13:36:37', 'admin'),
(204, 29, NULL, 1, NULL, 207296, '2022-04-08', NULL, NULL, NULL, '11:55:00', NULL, NULL, 1, '2022-04-11 14:41:09', '2022-04-11 13:41:09', 'admin'),
(205, 31, '6', 3, NULL, 206282, '2022-04-08', NULL, '5', NULL, '11:56:00', NULL, 'fotos/29/205.jpg', 2, '2022-04-11 14:26:14', '2022-04-11 13:26:14', '0'),
(206, 29, NULL, 1, NULL, 207296, '2022-04-08', NULL, NULL, NULL, '11:57:00', '09:41:00', NULL, 3, '2022-04-11 13:41:55', '2022-04-11 12:41:55', '0'),
(207, 30, '45', 48, 29, 22922, '2022-04-08', NULL, '3', 'dasfsad', '12:03:00', '15:57:00', 'fotos/30/207.jfif', 3, '2022-04-08 19:58:01', '2022-04-08 18:58:01', '0'),
(208, 30, NULL, 2, NULL, 207296, '2022-04-08', NULL, NULL, NULL, '12:05:00', '12:10:00', NULL, 3, '2022-04-08 16:10:06', '2022-04-08 15:10:06', '0'),
(209, 29, NULL, 2, NULL, 207295, '2022-04-08', NULL, NULL, NULL, '12:06:00', '12:08:00', NULL, 3, '2022-04-08 16:09:58', '2022-04-08 15:09:58', '0'),
(210, 31, '6', 2, 29, 107013, '2022-04-11', NULL, '4', 'laptop', '08:58:00', NULL, NULL, 1, '2022-04-11 13:30:16', '2022-04-11 12:30:16', '0'),
(211, 31, '55', 51, 33, 207358, '2022-04-11', NULL, '4', NULL, '10:37:00', NULL, 'fotos/31/211.jpg', 1, '2022-04-11 15:39:27', '2022-04-11 14:36:33', 'admin'),
(212, 31, '44', 3, 27, 207296, '2022-04-11', NULL, '3', NULL, '13:31:00', '14:02:00', 'fotos/31/212.jpg', 3, '2022-04-11 18:02:28', '2022-04-11 17:02:28', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados_visitados`
--
ALTER TABLE `empleados_visitados`
  ADD PRIMARY KEY (`id_empleado_visitado`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD PRIMARY KEY (`id_institucion`);

--
-- Indices de la tabla `motivos`
--
ALTER TABLE `motivos`
  ADD PRIMARY KEY (`id_motivo`);

--
-- Indices de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`id_visitante`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id_visita`),
  ADD KEY `institucion_id` (`institucion_id`),
  ADD KEY `motivo_id` (`motivo_id`),
  ADD KEY `visitante_id` (`visitante_id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados_visitados`
--
ALTER TABLE `empleados_visitados`
  MODIFY `id_empleado_visitado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `motivos`
--
ALTER TABLE `motivos`
  MODIFY `id_motivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `id_visitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_2` FOREIGN KEY (`institucion_id`) REFERENCES `instituciones` (`id_institucion`),
  ADD CONSTRAINT `visitas_ibfk_5` FOREIGN KEY (`motivo_id`) REFERENCES `motivos` (`id_motivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `visitas_ibfk_6` FOREIGN KEY (`visitante_id`) REFERENCES `visitantes` (`id_visitante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `visitas_ibfk_7` FOREIGN KEY (`empleado_id`) REFERENCES `empleados_visitados` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
