-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-08-2021 a las 02:20:09
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `horarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ho_roles`
--

CREATE TABLE `ho_roles` (
  `rol_codigo` int(2) NOT NULL,
  `rol_rol` varchar(20) NOT NULL,
  `rol_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ho_roles`
--

INSERT INTO `ho_roles` (`rol_codigo`, `rol_rol`, `rol_estado`) VALUES
(1, 'administrador', 1),
(2, 'supervisor', 1),
(3, 'docente', 1),
(4, 'alumno', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ho_usuarios`
--

CREATE TABLE `ho_usuarios` (
  `usu_codigo` int(5) NOT NULL,
  `usu_user` varchar(100) NOT NULL,
  `usu_clave` varchar(100) NOT NULL,
  `usu_estado` int(1) NOT NULL DEFAULT '1',
  `rol_codigo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ho_usuarios`
--

INSERT INTO `ho_usuarios` (`usu_codigo`, `usu_user`, `usu_clave`, `usu_estado`, `rol_codigo`) VALUES
(1, 'admin', 'admin', 1, 1),
(2, 'supervisor', '1234', 1, 2),
(4, 'docente', '1234', 1, 3),
(5, 'alumno', '1234', 1, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ho_roles`
--
ALTER TABLE `ho_roles`
  ADD PRIMARY KEY (`rol_codigo`);

--
-- Indices de la tabla `ho_usuarios`
--
ALTER TABLE `ho_usuarios`
  ADD PRIMARY KEY (`usu_codigo`),
  ADD KEY `rol_codigo` (`rol_codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ho_roles`
--
ALTER TABLE `ho_roles`
  MODIFY `rol_codigo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ho_usuarios`
--
ALTER TABLE `ho_usuarios`
  MODIFY `usu_codigo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ho_usuarios`
--
ALTER TABLE `ho_usuarios`
  ADD CONSTRAINT `ho_usuarios_ibfk_1` FOREIGN KEY (`rol_codigo`) REFERENCES `ho_roles` (`rol_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
