-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-06-2022 a las 18:20:13
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
  MODIFY `id_empleado_visitado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `motivos`
--
ALTER TABLE `motivos`
  MODIFY `id_motivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `id_visitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

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
