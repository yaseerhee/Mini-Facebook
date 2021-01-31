-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-12-2020 a las 14:03:05
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `MiniFb`
--
CREATE DATABASE IF NOT EXISTS `MiniFb` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `MiniFb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Publicacion`
--

CREATE TABLE `Publicacion` (
                               `id` int(11) NOT NULL,
                               `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
                               `emisorId` int(11) NOT NULL,
                               `destinatarioId` int(11) DEFAULT NULL,
                               `destacadaHasta` timestamp NULL DEFAULT NULL,
                               `asunto` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
                               `contenido` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `Publicacion`
--

INSERT INTO `Publicacion` (`id`, `fecha`, `emisorId`, `destinatarioId`, `destacadaHasta`, `asunto`, `contenido`) VALUES
(1, '2020-12-10 12:37:54', 1, NULL, NULL, 'Hola a todos', '¡Hola!\r\nSoy nuevo en el Minifacebook y quiero hacer amigüitos.\r\nUn saludete.\r\nJavi'),
(2, '2020-12-10 12:37:54', 2, 1, NULL, '¡Hola Javi!', 'Bienvenido, aquí estamos, aprendiendo PHP.'),
(3, '2020-12-10 12:38:40', 3, NULL, NULL, 'Me abuuuurroo', 'Lorem ipsum lorem ipsum lorem ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
                           `id` int(11) NOT NULL,
                           `identificador` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
                           `contrasenna` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
                           `codigoCookie` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
                           `caducidadCodigoCookie` timestamp NULL DEFAULT NULL,
                           `tipoUsuario` int(11) NOT NULL,
                           `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
                           `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `identificador`, `contrasenna`, `codigoCookie`, `caducidadCodigoCookie`, `tipoUsuario`, `nombre`, `apellidos`) VALUES
(1, 'jlopez', 'j', NULL, NULL, 0, 'José', 'López'),
(2, 'mgarcia', 'm', NULL, NULL, 0, 'María', 'García'),
(3, 'fpi', 'f', NULL, NULL, 0, 'Felipe', 'Pi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Publicacion`
--
ALTER TABLE `Publicacion`
    ADD PRIMARY KEY (`id`),
    ADD KEY `destinatarioId` (`destinatarioId`),
    ADD KEY `emisorId` (`emisorId`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `identificador` (`identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Publicacion`
--
ALTER TABLE `Publicacion`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Publicacion`
--
ALTER TABLE `Publicacion`
    ADD CONSTRAINT `Publicacion_ibfk_1` FOREIGN KEY (`destinatarioId`) REFERENCES `Usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `Publicacion_ibfk_2` FOREIGN KEY (`emisorId`) REFERENCES `Usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;