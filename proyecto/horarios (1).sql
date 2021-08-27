-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-08-2021 a las 02:49:28
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
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `ADM_CODIGO` int(2) NOT NULL,
  `USU_CODIGO` int(2) NOT NULL,
  `ADM_NOMBRE` varchar(35) NOT NULL,
  `ADM_APELLIDO` varchar(35) NOT NULL,
  `ADM_TELEFONO` int(11) NOT NULL,
  `ADM_CEDULA` varchar(10) NOT NULL,
  `ADM_FNACIMIENTO` date NOT NULL,
  `ADM_DIRECCION` varchar(50) NOT NULL,
  `ADM_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entidad que controla los registros y modificaciones del sism';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `ALU_CODIGO` int(2) NOT NULL,
  `AUL_CODIGO` int(2) NOT NULL,
  `USU_CODIGO` int(2) NOT NULL,
  `ALU_NOMBRE` varchar(35) NOT NULL,
  `ALU_APELLIDO` varchar(35) NOT NULL,
  `ALU_EMAIL` varchar(35) NOT NULL,
  `ALU_TELEFONO` int(10) NOT NULL,
  `ALU_CEDULA` varchar(10) NOT NULL,
  `ALU_FNACIMIENTO` date NOT NULL,
  `ALU_DIRECCION` varchar(50) NOT NULL,
  `ALU_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entidad que representa a los estudiantes de un centro educat';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `AUD_ID` int(2) NOT NULL,
  `USU_CODIGO` int(2) NOT NULL,
  `AUD_IP` char(20) NOT NULL,
  `AUD_EVENTO` varchar(100) NOT NULL,
  `AUD_HORA` time NOT NULL,
  `AUD_FECHA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `DIA_CODIGO` int(1) NOT NULL,
  `DIA_NOMBRE` varchar(25) NOT NULL,
  `DIA_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`DIA_CODIGO`, `DIA_NOMBRE`, `DIA_ESTADO`) VALUES
(1, 'Lunes', 1),
(2, 'Martes', 1),
(3, 'Miercoles', 1),
(4, 'Jueves', 1),
(5, 'Viernes', 1),
(6, 'Sábado', 1),
(7, 'Domingo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `DOC_CODIGO` int(2) NOT NULL,
  `USU_CODIGO` int(2) NOT NULL,
  `DOC_NOMBRE` varchar(35) NOT NULL,
  `DOC_APELLIDO` varchar(35) NOT NULL,
  `DOC_TELEFONO` int(10) NOT NULL,
  `DOC_CEDULA` varchar(10) NOT NULL,
  `DOC_FNACIMIENTO` date NOT NULL,
  `DOC_DIRECCION` varchar(50) NOT NULL,
  `DOC_CARGAHORARIA` int(2) NOT NULL,
  `DOC_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entidad que representa a los docentes del centro educativo';

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`DOC_CODIGO`, `USU_CODIGO`, `DOC_NOMBRE`, `DOC_APELLIDO`, `DOC_TELEFONO`, `DOC_CEDULA`, `DOC_FNACIMIENTO`, `DOC_DIRECCION`, `DOC_CARGAHORARIA`, `DOC_ESTADO`) VALUES
(1, 3, 'Pedro ', 'Gonzales', 998653251, '1725363625', '2015-05-05', 'Quito', 8, 1),
(2, 6, 'Juan', 'Padilla', 999999999, '1725666761', '2019-05-01', 'Av Amazonas', 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `HOR_CODIGO` int(2) NOT NULL,
  `SUP_CODIGO` int(2) NOT NULL,
  `HOR_ALECTIVO` varchar(9) NOT NULL,
  `HOR_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`HOR_CODIGO`, `SUP_CODIGO`, `HOR_ALECTIVO`, `HOR_ESTADO`) VALUES
(1, 1, '2020-2021', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios_materias`
--

CREATE TABLE `horarios_materias` (
  `HMA_CODIGO` int(4) NOT NULL,
  `HOR_CODIGO` int(2) NOT NULL,
  `MAT_CODIGO` int(2) NOT NULL,
  `DIA_CODIGO` int(1) NOT NULL,
  `HMA_HORAINICIO` time NOT NULL,
  `HMA_HORAFIN` time NOT NULL,
  `HMA_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horarios_materias`
--

INSERT INTO `horarios_materias` (`HMA_CODIGO`, `HOR_CODIGO`, `MAT_CODIGO`, `DIA_CODIGO`, `HMA_HORAINICIO`, `HMA_HORAFIN`, `HMA_ESTADO`) VALUES
(1, 1, 1, 1, '07:15:00', '07:55:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `MAT_CODIGO` int(2) NOT NULL,
  `DOC_CODIGO` int(2) DEFAULT NULL,
  `MAT_NOMBRE` varchar(35) NOT NULL,
  `MAT_AREA` varchar(30) NOT NULL,
  `MAT_CARGAHORARIA` int(2) NOT NULL,
  `NIV_CODIGO` int(2) NOT NULL,
  `MAT_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`MAT_CODIGO`, `DOC_CODIGO`, `MAT_NOMBRE`, `MAT_AREA`, `MAT_CARGAHORARIA`, `NIV_CODIGO`, `MAT_ESTADO`) VALUES
(1, 1, 'Matemática', 'Matemática', 8, 1, 1),
(2, 2, 'Inglés', 'Lengua Extranjera', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `NIV_CODIGO` int(2) NOT NULL,
  `NIV_NOMBRE` varchar(20) NOT NULL,
  `NIV_SUBNIVEL` varchar(20) NOT NULL,
  `NIV_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`NIV_CODIGO`, `NIV_NOMBRE`, `NIV_SUBNIVEL`, `NIV_ESTADO`) VALUES
(1, 'BASICA', 'ELEMENTAL', 1),
(2, 'BASICA', 'MEDIA', 1),
(3, 'BASICA', 'SUPERIOR', 1),
(4, 'BACHILLERATO', 'PRIMERO', 1),
(5, 'BACHILLERATO', 'SEGUNDO', 1),
(6, 'BACHILLERATO', 'TERCERO', 1),
(7, 'BASICA', 'INICIAL', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paralelo`
--

CREATE TABLE `paralelo` (
  `AUL_CODIGO` int(2) NOT NULL,
  `HOR_CODIGO` int(2) DEFAULT NULL,
  `AUL_NOMBRE` varchar(30) NOT NULL,
  `AUL_CURSO` varchar(20) NOT NULL,
  `NIV_CODIGO` int(2) DEFAULT NULL,
  `AUL_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paralelo`
--

INSERT INTO `paralelo` (`AUL_CODIGO`, `HOR_CODIGO`, `AUL_NOMBRE`, `AUL_CURSO`, `NIV_CODIGO`, `AUL_ESTADO`) VALUES
(1, 1, 'A', '2do Básica', 1, 1),
(2, NULL, 'B', '2do Básica', 1, 1),
(3, NULL, 'C', '2do Básica', 1, 1),
(4, NULL, 'A', '3ro Básica', 1, 1),
(5, NULL, 'B', '3ro Básica', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ROL_CODIGO` int(1) NOT NULL,
  `ROL_NOMBRE` varchar(20) NOT NULL,
  `ROL_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ROL_CODIGO`, `ROL_NOMBRE`, `ROL_ESTADO`) VALUES
(1, 'administrador', 1),
(2, 'supervisor', 1),
(3, 'docente', 1),
(4, 'alumno', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervisor`
--

CREATE TABLE `supervisor` (
  `SUP_CODIGO` int(2) NOT NULL,
  `USU_CODIGO` int(2) NOT NULL,
  `SUP_NOMBRE` varchar(35) NOT NULL,
  `SUP_APELLIDO` varchar(35) NOT NULL,
  `SUP_TELEFONO` int(10) NOT NULL,
  `SUP_CEDULA` varchar(10) NOT NULL,
  `SUP_FNACIMIENTO` date NOT NULL,
  `SUP_DIRECCION` varchar(50) NOT NULL,
  `SUP_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entidad que representa a la administracion del centro educat';

--
-- Volcado de datos para la tabla `supervisor`
--

INSERT INTO `supervisor` (`SUP_CODIGO`, `USU_CODIGO`, `SUP_NOMBRE`, `SUP_APELLIDO`, `SUP_TELEFONO`, `SUP_CEDULA`, `SUP_FNACIMIENTO`, `SUP_DIRECCION`, `SUP_ESTADO`) VALUES
(1, 2, 'Jose', 'Marin', 996325148, '1725793965', '2017-12-07', 'Guayakill', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `USU_CODIGO` int(2) NOT NULL,
  `ROL_CODIGO` int(2) NOT NULL,
  `USU_USER` char(35) NOT NULL,
  `USU_CLAVE` varchar(35) NOT NULL,
  `USU_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`USU_CODIGO`, `ROL_CODIGO`, `USU_USER`, `USU_CLAVE`, `USU_ESTADO`) VALUES
(1, 1, 'admin', 'admin', 1),
(2, 2, 'supervisor', '1234', 1),
(3, 3, 'docente', '1234', 1),
(4, 4, 'alumno', '1234', 1),
(5, 1, 'admin2', '123456', 1),
(6, 3, 'docente2', '1234', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ADM_CODIGO`),
  ADD KEY `FK_USUARIO___ADMIN` (`USU_CODIGO`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`ALU_CODIGO`),
  ADD KEY `FK_ESTA` (`AUL_CODIGO`),
  ADD KEY `FK_USUARIO___ALUMNO` (`USU_CODIGO`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`AUD_ID`),
  ADD KEY `FK_REGISTRA` (`USU_CODIGO`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`DIA_CODIGO`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`DOC_CODIGO`),
  ADD KEY `FK_USUARIO___DOCENTE` (`USU_CODIGO`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`HOR_CODIGO`),
  ADD KEY `FK_CREA` (`SUP_CODIGO`);

--
-- Indices de la tabla `horarios_materias`
--
ALTER TABLE `horarios_materias`
  ADD PRIMARY KEY (`HMA_CODIGO`),
  ADD KEY `HOR_CODIGO` (`HOR_CODIGO`),
  ADD KEY `MAT_CODIGO` (`MAT_CODIGO`),
  ADD KEY `DIA_CODIGO` (`DIA_CODIGO`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`MAT_CODIGO`),
  ADD KEY `FK_IMPARTE` (`DOC_CODIGO`),
  ADD KEY `NIV_CODIGO` (`NIV_CODIGO`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`NIV_CODIGO`);

--
-- Indices de la tabla `paralelo`
--
ALTER TABLE `paralelo`
  ADD PRIMARY KEY (`AUL_CODIGO`),
  ADD KEY `FK_PERTENECE` (`HOR_CODIGO`),
  ADD KEY `NIV_CODIGO` (`NIV_CODIGO`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ROL_CODIGO`);

--
-- Indices de la tabla `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`SUP_CODIGO`),
  ADD KEY `FK_USUARIO___SUPERVISOR` (`USU_CODIGO`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`USU_CODIGO`),
  ADD KEY `FK_TIENE` (`ROL_CODIGO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `ADM_CODIGO` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `ALU_CODIGO` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `AUD_ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `DIA_CODIGO` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `DOC_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `HOR_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `horarios_materias`
--
ALTER TABLE `horarios_materias`
  MODIFY `HMA_CODIGO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `MAT_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `NIV_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `paralelo`
--
ALTER TABLE `paralelo`
  MODIFY `AUL_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ROL_CODIGO` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `SUP_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `USU_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `FK_USUARIO___ADMIN` FOREIGN KEY (`USU_CODIGO`) REFERENCES `usuario` (`USU_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `FK_ESTA` FOREIGN KEY (`AUL_CODIGO`) REFERENCES `paralelo` (`AUL_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_USUARIO___ALUMNO` FOREIGN KEY (`USU_CODIGO`) REFERENCES `usuario` (`USU_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `FK_REGISTRA` FOREIGN KEY (`USU_CODIGO`) REFERENCES `usuario` (`USU_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `FK_USUARIO___DOCENTE` FOREIGN KEY (`USU_CODIGO`) REFERENCES `usuario` (`USU_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `FK_CREA` FOREIGN KEY (`SUP_CODIGO`) REFERENCES `supervisor` (`SUP_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `horarios_materias`
--
ALTER TABLE `horarios_materias`
  ADD CONSTRAINT `horarios_materias_ibfk_1` FOREIGN KEY (`HOR_CODIGO`) REFERENCES `horarios` (`HOR_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `horarios_materias_ibfk_2` FOREIGN KEY (`MAT_CODIGO`) REFERENCES `materias` (`MAT_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `horarios_materias_ibfk_3` FOREIGN KEY (`DIA_CODIGO`) REFERENCES `dias` (`DIA_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `FK_IMPARTE` FOREIGN KEY (`DOC_CODIGO`) REFERENCES `docente` (`DOC_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`NIV_CODIGO`) REFERENCES `nivel` (`NIV_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `paralelo`
--
ALTER TABLE `paralelo`
  ADD CONSTRAINT `FK_PERTENECE` FOREIGN KEY (`HOR_CODIGO`) REFERENCES `horarios` (`HOR_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `paralelo_ibfk_1` FOREIGN KEY (`NIV_CODIGO`) REFERENCES `nivel` (`NIV_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `FK_USUARIO___SUPERVISOR` FOREIGN KEY (`USU_CODIGO`) REFERENCES `usuario` (`USU_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_TIENE` FOREIGN KEY (`ROL_CODIGO`) REFERENCES `roles` (`ROL_CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
