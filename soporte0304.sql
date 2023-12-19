-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2023 a las 06:29:59
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
-- Base de datos: `soporte`
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
  `procesador` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_asignacion`
--

INSERT INTO `t_asignacion` (`id_asignacion`, `id_persona`, `id_equipo`, `marca`, `modelo`, `color`, `descripcion`, `memoria`, `disco_duro`, `procesador`) VALUES
(18, 47, 6, 'Marshall', 'willen', 'blanco', 'Los parlantes son equipos de audio que reproducen y maximizan la calidad del sonido del artefacto al cual se encuentre conectado.', 'sin especificar', 'sin especificar', 'sin especificar'),
(19, 47, 7, 'Shure ', 'SM58', 'negro', 'Un micrófono para cantar es fundamental si deseas que tu voz suene como tiene que sonar a la hora de grabar o captar vocales.', 'sin especificar', 'sin especificar', 'sin especificar'),
(20, 47, 3, 'Logitech ', 'G Pro', 'gris', 'Si vas a jugar en PC, el mouse es un accesorio clave. Para que este elemento se convierta en tu aliado.', 'sin especificar', 'sin especificar', 'sin especificar');

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
(47, 'Tapia ', 'Arcos', 'Fernando', '1995-08-24', 'M', '935704087', 'ftapia@isise.edu.pe', '2023-04-03 23:01:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_reportes`
--

CREATE TABLE `t_reportes` (
  `id_reporte` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `id_usuario_tecnico` int(11) DEFAULT NULL,
  `descripcion_problema` text DEFAULT NULL,
  `solucion_problema` text DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_reportes`
--

INSERT INTO `t_reportes` (`id_reporte`, `id_usuario`, `id_equipo`, `id_usuario_tecnico`, `descripcion_problema`, `solucion_problema`, `estatus`, `fecha`) VALUES
(12, 55, 6, NULL, 'el sonido se escucha muy bajo\r\n\r\n', NULL, 1, '2023-04-03 23:10:33'),
(14, 55, 7, NULL, 'no se escucha nada al hablar.', NULL, 1, '2023-04-03 23:24:25'),
(15, 55, 3, NULL, 'no encienden los leds del mouse.', NULL, 1, '2023-04-03 23:24:40');

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
(55, 1, 47, 'ftapia', '$2y$10$qjAh5D1BH/j.nyGV/CXJYuBHRgcyVdU5nnxfXQXl7ffm/fgNfY.KK', 'modulo cliente', 1, '2023-04-03 23:01:12');

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
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `t_cat_equipo`
--
ALTER TABLE `t_cat_equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `t_persona`
--
ALTER TABLE `t_persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `t_reportes`
--
ALTER TABLE `t_reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
