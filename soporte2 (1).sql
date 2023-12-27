-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-12-2023 a las 03:38:24
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `soporte2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asignacion`
--

CREATE TABLE `t_asignacion` (
  `id_asignacion` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `marca` varchar(245) DEFAULT NULL,
  `modelo` varchar(245) DEFAULT NULL,
  `color` varchar(245) DEFAULT NULL,
  `descripcion` varchar(245) DEFAULT NULL,
  `memoria` varchar(245) DEFAULT NULL,
  `disco_duro` varchar(245) DEFAULT NULL,
  `procesador` varchar(245) DEFAULT NULL,
  `garantia` int(2) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_asignacion`
--

INSERT INTO `t_asignacion` (`id_asignacion`, `id_persona`, `id_equipo`, `marca`, `modelo`, `color`, `descripcion`, `memoria`, `disco_duro`, `procesador`, `garantia`, `fechaRegistro`) VALUES
(18, 47, 6, 'Marshall', 'willen', 'blanco', 'Los parlantes son equipos de audio que reproducen y maximizan la calidad del sonido del artefacto al cual se encuentre conectado.', 'sin especificar', 'sin especificar', 'sin especificar', 3, '2023-12-26 12:31:57'),
(19, 47, 7, 'Shure ', 'SM58', 'negro', 'Un micrófono para cantar es fundamental si deseas que tu voz suene como tiene que sonar a la hora de grabar o captar vocales.', 'sin especificar', 'sin especificar', 'sin especificar', 12, '2023-12-26 12:31:57'),
(20, 47, 3, 'Logitech ', 'G Pro', 'gris', 'Si vas a jugar en PC, el mouse es un accesorio clave. Para que este elemento se convierta en tu aliado.', 'sin especificar', 'sin especificar', 'sin especificar', 6, '2023-12-26 12:31:57'),
(21, 47, 6, 'xc', 'x', 'x', 'xcx', 'c', 'xc', 'xc', 24, '2023-12-26 12:31:57'),
(22, 48, 7, 'dsfds', 'dfsdf', 'dsfcc', 'cxcz', 'xzxc', 'zxczxc', 'xzc', 1, '2023-12-26 12:31:57'),
(24, 49, 3, 'as', 'sa', 'asd', 'sa', 'sad', 'dsa', 'sa', 1, '2023-12-26 12:31:57'),
(25, 49, 6, 'add', 'add', 'add', 'add', 'add', 'add', 'add', 3, '2023-10-04 00:00:00'),
(26, 48, 1, 'add2', 'add2', 'add2', 'add2', 'add2', 'add2', 'add2', 6, '2022-06-07 15:37:00'),
(27, 47, 8, 'das', 'adsad', 'das', 'ultimo prod', 'sdad', 'asd', 'dsa', 12, '2023-12-20 18:21:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cat_equipo`
--

CREATE TABLE `t_cat_equipo` (
  `id_equipo` int(11) NOT NULL,
  `nombre` varchar(245) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_cat_equipo`
--

INSERT INTO `t_cat_equipo` (`id_equipo`, `nombre`, `descripcion`) VALUES
(1, 'PC', 'fas fa-desktop'),
(2, 'Laptop', 'fas fa-laptop'),
(3, 'Mouse', 'fas fa-mouse'),
(4, 'Teclado', 'fas fa-keyboard'),
(5, 'Monitor', 'fas fa-desktop'),
(6, 'Bocinas', 'fas fa-volume-up'),
(7, 'Micrófono', 'fas fa-microphone'),
(8, 'Proyector', 'fas fa-projector');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cat_roles`
--

CREATE TABLE `t_cat_roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_cat_roles`
--

INSERT INTO `t_cat_roles` (`id_rol`, `nombre`, `descripcion`) VALUES
(1, 'cliente', 'Es un cliente'),
(2, 'admin', 'Es Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_persona`
--

CREATE TABLE `t_persona` (
  `id_persona` int(11) NOT NULL,
  `paterno` varchar(50) NOT NULL,
  `materno` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_nacimiento` varchar(12) NOT NULL,
  `sexo` varchar(2) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `fechaInsert` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_persona`
--

INSERT INTO `t_persona` (`id_persona`, `paterno`, `materno`, `nombre`, `fecha_nacimiento`, `sexo`, `telefono`, `correo`, `fechaInsert`) VALUES
(42, 'Jacinto', 'Chumbes', 'Selene', '1986-12-25', 'F', '935704789', 'sjacinto@isise.edu.pe', '2023-03-31 22:50:44'),
(47, 'Tapia ', 'Arcos', 'Fernando', '1995-08-24', 'M', '935704087', 'ftapia@isise.edu.pe', '2023-04-03 23:01:12'),
(48, 'sadas', 'asdds', 'asdasd', '2023-12-05', 'F', '935704087', 'ftapia@isise.edu.pe', '2023-12-16 23:17:26'),
(49, 'lopez', 'ramos', 'sandra', '2023-12-06', 'F', '935704087', 'laura@example.biz', '2023-12-16 23:49:04'),
(50, 'das', 'dsad', 'sad', '2023-12-14', 'F', '935704087', 'ftapia@isise.edu.pe', '2023-12-23 11:15:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_reportes`
--

CREATE TABLE `t_reportes` (
  `id_reporte` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `id_usuario_tecnico` int(11) NOT NULL,
  `descripcion_problema` text DEFAULT NULL,
  `solucion_problema` text DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_reportes`
--

INSERT INTO `t_reportes` (`id_reporte`, `id_usuario`, `id_equipo`, `id_usuario_tecnico`, `descripcion_problema`, `solucion_problema`, `estatus`, `fecha`) VALUES
(12, 55, 6, 1, 'el sonido se escucha muy bajo\r\n\r\n', 'se reemplazron los condensadoers de las bocinas', 0, '2023-04-03 23:10:33'),
(14, 55, 7, 1, 'no se escucha nada al hablar.', 'sadsd', 0, '2023-04-03 23:24:25'),
(15, 55, 3, 1, 'no encienden los leds del mouse.', 'se reemplazo los leds dañados por unos nuevos.', 0, '2023-04-03 23:24:40'),
(16, 56, 7, 1, 'sadasdas', 'fdfd', 0, '2023-12-16 23:44:45'),
(17, 58, 2, 1, 'lapantalla esta azul', 'asaaaaaaaaaaa', 0, '2023-12-16 23:54:18'),
(18, 58, 3, 1, 'yuyuuyy', 'dsdasasd', 0, '2023-12-17 00:05:33'),
(22, 55, 7, 1, 'sdsadasdasdasdas', 'sssssssssssss', 0, '2023-12-23 11:12:35'),
(23, 55, 6, 2, 'prueba para ver lo del tecnico', NULL, 1, '2023-12-23 11:24:51'),
(24, 55, 6, 2, 'sas', NULL, 1, '2023-12-23 11:25:12'),
(25, 55, 6, 2, 'qqqqqqqqqqqqq', NULL, 1, '2023-12-23 11:41:42'),
(26, 55, 7, 2, 'qqqqqqqqqqqqqqqqq', NULL, 1, '2023-12-23 11:42:48'),
(27, 55, 6, 2, 'rewrerewrweewrwer', NULL, 1, '2023-12-25 20:07:57'),
(28, 55, 6, 2, 'bocinas', NULL, 1, '2023-12-25 20:25:01'),
(29, 55, 3, 1, 'mouses', '123456', 0, '2023-12-25 21:28:34'),
(30, 55, 7, 3, 'fernando', 'reeeeeee', 0, '2023-12-25 21:36:12'),
(31, 55, 6, 3, 'ultima falla', '123', 0, '2023-12-25 23:48:27'),
(32, 55, 7, 2, 'visualizar', NULL, 1, '2023-12-26 18:10:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tecnico`
--

CREATE TABLE `t_tecnico` (
  `id` int(11) NOT NULL,
  `dni` int(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `celular` int(9) NOT NULL,
  `correo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_tecnico`
--

INSERT INTO `t_tecnico` (`id`, `dni`, `nombre`, `apellidos`, `celular`, `correo`) VALUES
(1, 78678987, 'Xamir', 'Salas Palomino', 984783782, 'cieza@gmail.com'),
(2, 76546890, 'Raul', 'Caceres Lopez', 987564344, 'ltorres@isise.edu'),
(3, 76434567, 'Rosa', 'Astengo Palma', 908654278, 'rastengo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ubicacion` text DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT 1,
  `fecha_insert` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`id_usuario`, `id_rol`, `id_persona`, `usuario`, `password`, `ubicacion`, `activo`, `fecha_insert`) VALUES
(50, 2, 42, 'sjacinto', '$2y$10$I8kKhrfoQKlxREhF0Cx0dOpOm2O396H6GjBBNbD6wpJ08C.gZxHUW', 'modulo 1', 1, '2023-03-31 22:50:44'),
(55, 1, 47, 'ftapia', '$2y$10$qjAh5D1BH/j.nyGV/CXJYuBHRgcyVdU5nnxfXQXl7ffm/fgNfY.KK', 'modulo cliente', 1, '2023-04-03 23:01:12'),
(56, 1, 48, 'test', '$2y$10$jTb7KxGRE2kOCUcQ1mg8Q.MDc9VeSd6oXBoEG9Nkio3ZjAD9YTEFq', 'asdas', 0, '2023-12-16 23:17:26'),
(58, 1, 49, 'sandra', '$2y$10$u.NCIvCVOGlWsefaJi4htersfF98/lBRUMB8gpJnE9P6vC0vKEZEC', 'adssa', 1, '2023-12-16 23:49:04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_asignacion`
--
ALTER TABLE `t_asignacion`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `fkPersona_idx` (`id_persona`),
  ADD KEY `fkEquipo_idx` (`id_equipo`);

--
-- Indices de la tabla `t_cat_equipo`
--
ALTER TABLE `t_cat_equipo`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `t_cat_roles`
--
ALTER TABLE `t_cat_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `t_persona`
--
ALTER TABLE `t_persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `t_reportes`
--
ALTER TABLE `t_reportes`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `t_reportes_ibfk_1` (`id_usuario`),
  ADD KEY `t_reportes_ibfk_2` (`id_equipo`);

--
-- Indices de la tabla `t_tecnico`
--
ALTER TABLE `t_tecnico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_persona` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_asignacion`
--
ALTER TABLE `t_asignacion`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `t_cat_equipo`
--
ALTER TABLE `t_cat_equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `t_persona`
--
ALTER TABLE `t_persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `t_reportes`
--
ALTER TABLE `t_reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `t_tecnico`
--
ALTER TABLE `t_tecnico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_asignacion`
--
ALTER TABLE `t_asignacion`
  ADD CONSTRAINT `fkEquipo` FOREIGN KEY (`id_equipo`) REFERENCES `t_cat_equipo` (`id_equipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkPersona` FOREIGN KEY (`id_persona`) REFERENCES `t_persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `t_reportes`
--
ALTER TABLE `t_reportes`
  ADD CONSTRAINT `t_reportes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`),
  ADD CONSTRAINT `t_reportes_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `t_cat_equipo` (`id_equipo`);

--
-- Filtros para la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD CONSTRAINT `t_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `t_cat_roles` (`id_rol`),
  ADD CONSTRAINT `t_usuarios_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `t_persona` (`id_persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
