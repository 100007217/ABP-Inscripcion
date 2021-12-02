-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2021 a las 17:40:57
-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2021 a las 17:40:57
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

---------------------------------------------------------------------------------
--¡¡¡¡¡COPIAR Y PEGAR EN EL GESTOR DE BASE DE DATOS, LA SINTÁXIS ES CORRECTA!!!!
---------------------------------------------------------------------------------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

create database db2_abp;
use db2_abp;
--
-- Base de datos: `db2_abp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_barrio`
--

CREATE TABLE `tbl_barrio` (
  `id_bar` int(11) NOT NULL,
  `nombre_bar` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_barrio`
--

INSERT INTO `tbl_barrio` (`id_bar`, `nombre_bar`) VALUES
(1, 'L\'Hospitalet de Llobregat'),
(2, 'El Prat de Llobregat'),
(3, 'Sant Boi de Llobregat'),
(4, 'Esplugues de LLobregat');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_eventos`
--

CREATE TABLE `tbl_eventos` (
  `id_eve` int(11) NOT NULL,
  `nombre_eve` varchar(50) DEFAULT NULL,
  `fecha_inicio_eve` date DEFAULT NULL,
  `fecha_fin_eve` date DEFAULT NULL,
  `num_max_pers_eve` int(5) DEFAULT NULL,
  `edad_min_eve` int(2) DEFAULT NULL,
  `barrio_eve_fk` int(11) DEFAULT NULL,
  `img_eve` varchar(100) DEFAULT NULL,
  `descripcion_eve` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_eventos`
--

INSERT INTO `tbl_eventos` (`id_eve`, `nombre_eve`, `fecha_inicio_eve`, `fecha_fin_eve`, `num_max_pers_eve`, `edad_min_eve`, `barrio_eve_fk`, `img_eve`, `descripcion_eve`) VALUES
(1, 'Carrera solidaria contra el Cáncer', '2021-12-15', '2021-12-16', 500, 16, 1, 'cancer.jpg', 'Evento efectuado contra la lucha de nuestros seres queridos/amigos/conocidos... contra el Cáncer.'),
(2, 'Carrera solidaria contra el Parkingson', '2021-12-17', '2021-12-18', 500, 12, 2, 'parkingson.jpg', NULL),
(3, 'Carrera solidaria por el Autismo', '2021-12-03', '2021-12-04', 300, 16, 3, 'autismo.jpeg', NULL),
(4, 'Carrea solidaria contra el Duchenne', '2022-01-14', '2022-01-15', 200, 18, 4, 'duchenne.jpg', NULL),
(5, 'Donación solidaria de Alimentos', '2021-12-06', '2021-12-20', NULL, 16, 1, 'donacion-al.jpg', 'En este evento, nos dedicamos a recolectar el máximo posible de alimentos para las familias desfavorecidas, y más en estas fechas navideñas, intentos que no les falte de nada.'),
(6, 'Donación de sangre', '2021-12-06', '2021-12-27', 1000, 18, 4, 'donante-de-sangre.jpg', NULL),
(7, 'Visita de Santa Claus en el Hospital', '2021-12-24', '2021-12-25', 50, 18, 4, 'santa.png', NULL),
(8, 'Jugando con nuestros mayores', '2021-12-13', '2021-12-20', 30, 16, 2, 'yayos.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_eventos_usuarios`
--

CREATE TABLE `tbl_eventos_usuarios` (
  `id_evento_use` int(11) NOT NULL,
  `id_eve_fk` int(11) DEFAULT NULL,
  `id_use_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_eventos_usuarios`
--

INSERT INTO `tbl_eventos_usuarios` (`id_evento_use`, `id_eve_fk`, `id_use_fk`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipouse`
--

CREATE TABLE `tbl_tipouse` (
  `id_tipo_use` int(11) NOT NULL,
  `tipo_use` enum('Admin','Common') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_tipouse` (`id_tipo_use`, `tipo_use`) VALUES 
(1, 'Admin'),
(2, 'Common');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_use` int(11) NOT NULL,
  `nom_use` varchar(45) NOT NULL,
  `apellido_use` varchar(45) NOT NULL,
  `fecha_nac_use` date NOT NULL,
  `sexo_use` enum('Mujer','Hombre') DEFAULT NULL,
  `num_movil_use` char(9) DEFAULT NULL,
  `dni_use` char(9) DEFAULT NULL,
  `correo_use` varchar(45) NOT NULL,
  `tipo_usuario_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_use`, `nom_use`, `apellido_use`, `fecha_nac_use`, `sexo_use`, `num_movil_use`, `dni_use`, `correo_use`, `tipo_usuario_fk`) VALUES
(1, 'Alfredo', 'Blum', '2000-05-23', 'Hombre', '622622622', '26262626E', 'blum@fje.edu', NULL),
(2, 'Gerard', 'Gomez', '2000-04-20', 'Hombre', '622622622', '26267898E', 'gomez@fje.edu', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_barrio`
--
ALTER TABLE `tbl_barrio`
  ADD PRIMARY KEY (`id_bar`);

--
-- Indices de la tabla `tbl_eventos`
--
ALTER TABLE `tbl_eventos`
  ADD PRIMARY KEY (`id_eve`),
  ADD KEY `fk_barrio_eventos_idx` (`barrio_eve_fk`);

--
-- Indices de la tabla `tbl_eventos_usuarios`
--
ALTER TABLE `tbl_eventos_usuarios`
  ADD PRIMARY KEY (`id_evento_use`),
  ADD KEY `fk_usuario_eventos_usuarios_idx` (`id_use_fk`),
  ADD KEY `fk_eventos_eventos_usuarios_idx` (`id_eve_fk`);

--
-- Indices de la tabla `tbl_tipouse`
--
ALTER TABLE `tbl_tipouse`
  ADD PRIMARY KEY (`id_tipo_use`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_use`),
  ADD KEY `fk_tipousuario_usuario_idx` (`tipo_usuario_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_barrio`
--
ALTER TABLE `tbl_barrio`
  MODIFY `id_bar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_eventos`
--
ALTER TABLE `tbl_eventos`
  MODIFY `id_eve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_eventos_usuarios`
--
ALTER TABLE `tbl_eventos_usuarios`
  MODIFY `id_evento_use` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipouse`
--
ALTER TABLE `tbl_tipouse`
  MODIFY `id_tipo_use` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_use` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_eventos`
--
ALTER TABLE `tbl_eventos`
  ADD CONSTRAINT `fk_barrio_eventos` FOREIGN KEY (`barrio_eve_fk`) REFERENCES `tbl_barrio` (`id_bar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_eventos_usuarios`
--
ALTER TABLE `tbl_eventos_usuarios`
  ADD CONSTRAINT `fk_eventos_eventos_usuarios` FOREIGN KEY (`id_eve_fk`) REFERENCES `tbl_eventos` (`id_eve`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_eventos_usuarios` FOREIGN KEY (`id_use_fk`) REFERENCES `tbl_usuario` (`id_use`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `fk_tipousuario_usuario` FOREIGN KEY (`tipo_usuario_fk`) REFERENCES `tbl_tipouse` (`id_tipo_use`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

