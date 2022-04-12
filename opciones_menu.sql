-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-04-2022 a las 17:13:26
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
-- Base de datos: `bd_gral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones_menu`
--

CREATE TABLE `opciones_menu` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `descripcion_corta` varchar(50) NOT NULL,
  `tipo_opcion` varchar(6) DEFAULT 'OPCION',
  `url_opcion` varchar(250) DEFAULT NULL,
  `icono_opcion` varchar(250) DEFAULT NULL,
  `rol_minimo` smallint(6) NOT NULL DEFAULT '2',
  `id_opcion_padre` int(11) DEFAULT NULL,
  `secuencia` int(11) DEFAULT NULL,
  `id_aplicacion` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `opciones_menu`
--

INSERT INTO `opciones_menu` (`id`, `descripcion`, `descripcion_corta`, `tipo_opcion`, `url_opcion`, `icono_opcion`, `rol_minimo`, `id_opcion_padre`, `secuencia`, `id_aplicacion`, `activo`) VALUES
(2, 'Usuarios', 'Usuarios', 'OPCION', '/Usuarios', 'fas fa-users', 4, 0, 1, 1, 1),
(3, 'Aplicaciones', 'Aplicaciones', 'OPCION', '/Aplicaciones', 'fas fa-rocket', 4, 0, 2, 1, 1),
(4, 'Rol/Usuario/Modulo', 'Accesos/Modulo', 'OPCION', '/Roles_x_usuario_aplicacion', 'fas fa-key', 4, 0, 3, 1, 1),
(5, 'Procedimientos', 'Procedimientos', 'OPCION', '/Procedimientos', 'fa fa-list-alt', 2, 0, 1, 2, 1),
(6, 'Leyes y Normas', 'Leyes y Normas', 'OPCION', '/Normativas', 'fa fa-gavel', 2, 0, 2, 2, 1),
(7, 'Glosario', 'Glosario', 'OPCION', '/Terminos', 'fa fa-book', 2, 0, 3, 2, 1),
(8, 'Configuracion', 'Configuracion', 'MENU', '', 'fa fa-cog', 4, 0, 4, 2, 1),
(9, 'Catalogo Servicios', 'Catalogo Servicios', 'OPCION', '/Servicios', 'far fa-circle', 4, 8, 1, 2, 1),
(10, 'Cargos', 'Cargos', 'OPCION', '/Cargos', 'far fa-circle', 4, 8, 2, 2, 1),
(11, 'Responsabilidades', 'Responsabilidades', 'OPCION', '/Responsabilidades', 'far fa-circle', 4, 8, 3, 2, 1),
(12, 'Usuarios', 'Usuarios', 'OPCION', '/Usuarios', 'far fa-circle', 4, 8, 4, 2, 1),
(24, 'Submenu', 'Submenu', 'MENU', '', 'fa fa-cog', 8, 0, 4, 1, 0),
(25, 'Opcion 1', 'Opcion1', 'OPCION', '#', 'fas fa-circle', 8, 24, 1, 1, 0),
(26, 'Generar Volantes PDF', 'Generar Volantes PDF', 'OPCION', '/volantes/view_generar_volantes', 'fas fa-file-pdf', 8, 0, 1, 4, 1),
(27, 'Consulta Empleados de la Nomina PDF ', 'Consulta Empleados', 'OPCION', '/volantes/view_employees', 'fas fa-users', 8, 0, 2, 4, 1),
(28, 'Bandeja Documentos', 'Bandeja Documentos', 'OPCION', '/documentos', 'fas fa-folder-open', 9, 0, 1, 5, 1),
(29, 'Registrar Documento', 'Registrar Documento', 'OPCION', '/documentos/new', 'fas fa-file-medical', 9, 0, 2, 5, 1),
(30, 'Documentos Archivados', 'Documentos Archivados', 'OPCION', '/documentos/archivados', 'fas fa-folder', 9, 0, 5, 5, 1),
(31, 'Historial Documentos', 'Historial Documentos', 'OPCION', '/documentos/historial', 'fas fa-history', 9, 0, 6, 5, 1),
(32, 'Reportes', 'Reportes', 'OPCION', '/documentos/menu_reportes', 'far fa-file-pdf', 9, 0, 7, 5, 1),
(33, 'Configuraciones', 'Configuraciones', 'MENU', '', 'fas fa-cog', 9, 0, 8, 5, 1),
(34, 'Estados', 'Estados', 'OPCION', '/clasificacionesestados', 'far fa-circle', 9, 33, 1, 5, 1),
(35, 'Instituciones', 'Instituciones', 'OPCION', '/instituciones', 'far fa-circle', 9, 33, 2, 5, 1),
(36, 'Entrega Diaria Libro', 'Entrega Diaria Libro', 'OPCION', '/documentos/entregadocs', 'fas fa-book', 9, 0, 3, 5, 1),
(37, 'Historial Entrega Libro', 'Historial Entrega Libro', 'OPCION', '/documentos/historial_entrega', 'fas fa-copy', 9, 0, 4, 5, 1),
(38, 'Consulta Documentos', 'Consulta Documentos', 'OPCION', '/docs/search', 'fas fa-folder', 9, 0, 1, 6, 1),
(39, 'Subir Documento Drive', 'Subir Docs. Drive', 'OPCION', '/docs/view_upload_doc', 'fas fa-upload', 9, 0, 2, 6, 1),
(40, 'Agregar Pagina a PDF', 'Agregar Doc. a PDF', 'OPCION', '/docs/add_page_pdf', 'fas fa-file-alt', 9, 0, 3, 6, 1),
(41, 'Configuraciones', 'Configuraciones', 'MENU', '', 'fas fa-cog', 9, 0, 4, 6, 1),
(42, 'Ruta Carpeta', 'Ruta Carpeta', 'OPCION', '/docs/rutaCarpeta', 'fas fa-folder-plus', 9, 41, 1, 6, 1),
(43, 'Catalogo', 'Catálogo', 'MENU', '', 'fas fa-list', 1, 0, 1, 7, 1),
(44, 'Almacenes', 'Almacenes', 'OPCION', '/almacenes', 'far fa-circle', 1, 43, 1, 7, 1),
(45, 'Categorias', 'Categorías', 'OPCION', '/categorias', 'far fa-circle', 1, 43, 2, 7, 1),
(46, 'Empleados', 'Empleados', 'OPCION', '/empleados', 'far fa-circle', 1, 43, 3, 7, 1),
(47, 'Fichas / Camiones', 'Fichas / Camiones', 'OPCION', '/fichas', 'far fa-circle', 1, 43, 4, 7, 1),
(48, 'Grupo Productos', 'Grupo Productos', 'OPCION', '/productosgrupo', 'far fa-circle', 1, 43, 5, 7, 1),
(49, 'Presentación Productos', 'Presentación Productos', 'OPCION', '/productospresentacion', 'far fa-circle', 1, 43, 6, 7, 1),
(50, 'Rutas', 'Rutas', 'OPCION', '/rutas', 'far fa-circle', 1, 43, 7, 7, 1),
(51, 'Suplidores', 'Suplidores', 'OPCION', '/suplidores', 'far fa-circle', 1, 43, 8, 7, 1),
(52, 'Productos', 'Productos', 'OPCION', '/productos', 'fas fa-th-large', 1, 0, 2, 7, 1),
(53, 'Empaques', 'Empaques', 'MENU', '', 'fas fa-boxes', 1, 0, 3, 7, 1),
(54, 'Empacar Productos', 'Empacar Productos', 'OPCION', '/productos/empacar', 'far fa-circle', 1, 53, 1, 7, 1),
(55, 'Historial Empaque Prod.', 'Historial Empaque Prod.', 'OPCION', '/productos/historial_empaques', 'far fa-circle', 1, 53, 2, 7, 1),
(56, 'Combos', 'Combos', 'MENU', '', 'fas fa-box-open', 1, 0, 4, 7, 1),
(57, 'Crear Combos Productos', 'Crear Combos Productos', 'OPCION', '/productos/crear_combos', 'far fa-circle', 1, 56, 1, 7, 1),
(58, 'Historial Combos Prod.', 'Historial Combos Prod.', 'OPCION', '/productos/historial_combos', 'far fa-circle', 1, 56, 2, 7, 1),
(59, 'Entradas', 'Entradas', 'MENU', '', 'fas fa-luggage-cart', 1, 0, 5, 7, 1),
(60, 'Entrada Productos', 'Entrada Productos', 'OPCION', '/entradas/new_entrada_productos', 'far fa-circle', 1, 59, 1, 7, 1),
(61, 'Historial Entr. Productos', 'Historial Entr. Productos', 'OPCION', '/entradas/historial_entrada_productos', 'far fa-circle', 1, 59, 1, 7, 1),
(62, 'Historial Entr. Suministros', 'Historial Entr. Suministros', 'OPCION', '/entradas/historial_entrada_suministros', 'far fa-circle', 1, 59, 1, 7, 1),
(63, 'Salidas', 'Salidas', 'MENU', '', 'fas fa-truck-moving', 1, 0, 6, 7, 1),
(64, 'Bodegas Mov / Esp', 'Bodegas Mov / Esp', 'OPCION', '/salidas/crear_salida_bodegas', 'far fa-circle', 1, 63, 1, 7, 1),
(65, 'Merc. Provincias', 'Merc. Provincias', 'OPCION', '/salidas/crear_salida_mercprov', 'far fa-circle', 1, 63, 1, 7, 1),
(66, 'Suministros Ofic.', 'Suministros Ofic.', 'OPCION', '/salidas/crear_salida_sumin', 'far fa-circle', 1, 63, 1, 7, 1),
(67, 'Autorizar Salidas BM / BE', 'Autorizar Salidas BM / BE', 'OPCION', '/salidas/autorizar_salida_bodegas', 'far fa-circle', 1, 63, 1, 7, 1),
(68, 'Autorizar Salidas MP', 'Autorizar Salidas MP', 'OPCION', '/salidas/autorizar_salida_mercprov', 'far fa-circle', 1, 63, 1, 7, 1),
(69, 'Historial Salidas Productos', 'Historial Salidas Productos', 'OPCION', '/salidas/historial_salidas', 'far fa-circle', 1, 63, 1, 7, 1),
(70, 'Historial Salidas Suministros', 'Historial Salidas Suministros', 'OPCION', '/salidas/historial_salida_suministros', 'far fa-circle', 1, 63, 1, 7, 1),
(71, ' Devoluciones', ' Devoluciones', 'MENU', '', 'fas fa-undo', 1, 0, 7, 7, 1),
(72, 'Devoluciones Bod. Móv.', 'Devoluciones Bod. Móv.', 'OPCION', '/devoluciones/view_dev_bm', 'far fa-circle', 1, 71, 1, 7, 1),
(73, 'Historial Devoluciones', 'Historial Devoluciones', 'OPCION', '/devoluciones/historial', 'far fa-circle', 1, 71, 1, 7, 1),
(74, 'Inventarios', 'Inventarios', 'MENU', '', 'fas fa-clipboard-check', 1, 0, 8, 7, 1),
(75, 'Invent. General Productos', 'Invent. General Productos', 'OPCION', '/inventario/inventario_gp', 'far fa-circle', 1, 74, 1, 7, 1),
(76, 'Invent. Sumin. Oficina', 'Invent. Sumin. Oficina', 'OPCION', '/inventario/inventario_so', 'far fa-circle', 1, 74, 1, 7, 1),
(77, 'Reportes', 'Reportes', 'OPCION', '/reportes', 'far fa-file-pdf', 1, 0, 9, 7, 1),
(78, 'Configuración', 'Configuración', 'OPCION', '/configuracion', 'fas fa-cog', 1, 0, 10, 7, 1),
(79, 'Generar Archivos', 'Generar Archivos', 'OPCION', '/archivos/getviewnominas', 'fas fa-file-alt', 9, 0, 1, 8, 1),
(80, 'Visitas', 'Gestión Visitas', 'OPCION', '/visitas', 'fas fa-sign-out-alt', 9, 0, 2, 9, 1),
(81, 'Configuracion', 'Configuración', 'MENU', '', 'fas fa-tools', 9, 0, 5, 9, 1),
(83, 'Instituciones', 'Instituciones', 'OPCION', '/instituciones', 'far fa-circle', 9, 81, 2, 9, 1),
(84, 'Motivos', 'Motivos', 'OPCION', '/motivos', 'far fa-circle', 9, 81, 3, 9, 1),
(85, 'Registrar Visitas', 'Registrar Visitas', 'OPCION', '/visitas/create', 'fas fa-user-plus', 9, 0, 1, 9, 1),
(86, 'Histórico Visitas', 'Histórico Visitas', 'OPCION', '/visitas/historico', 'fas fa-history', 9, 0, 4, 9, 1),
(87, 'Impresión Etiquetas', 'Impresión Etiquetas', 'OPCION', '/labels', 'fas fa-barcode', 9, 0, 9, 5, 1),
(88, 'Consulta Visitantes', 'Consulta Visitantes', 'OPCION', '/visitantes/consulta_visitantes', 'fa-solid fa-magnifying-glass', 9, 0, 2, 9, 1),
(91, 'Reportes', 'Reportes', 'MENU', '', 'fa-solid fa-file-pdf', 9, 0, 6, 9, 1),
(97, 'Reporte Rango Fechas', 'Rango Fechas', 'OPCION', '/visitas/reporte_fechas', 'far fa-circle', 9, 91, 1, 9, 1),
(98, 'Reporte Personas Visitadas', 'Personas Visitadas', 'OPCION', '/visitas/reporte_personas_visitadas', 'far fa-circle', 9, 91, 2, 9, 1),
(99, 'Reporte Departamentos Visitados', 'Departamentos Visitados', 'OPCION', '/visitas/reporte_departamentos', 'far fa-circle', 9, 91, 3, 9, 1),
(100, 'Consulta Empleados', 'Consulta Empleados', 'OPCION', '/consultas/consulta_empleados', 'fa-solid fa-users', 9, 0, 1, 10, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `opciones_menu`
--
ALTER TABLE `opciones_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aplicacion` (`id_aplicacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `opciones_menu`
--
ALTER TABLE `opciones_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `opciones_menu`
--
ALTER TABLE `opciones_menu`
  ADD CONSTRAINT `opciones_menu_ibfk_1` FOREIGN KEY (`id_aplicacion`) REFERENCES `aplicaciones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
