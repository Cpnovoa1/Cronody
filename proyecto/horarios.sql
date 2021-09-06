-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-09-2021 a las 16:02:21
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

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`ADM_CODIGO`, `USU_CODIGO`, `ADM_NOMBRE`, `ADM_APELLIDO`, `ADM_TELEFONO`, `ADM_CEDULA`, `ADM_FNACIMIENTO`, `ADM_DIRECCION`, `ADM_ESTADO`) VALUES
(1, 1, 'Jose', 'Ramirez', 2236554, '1725698563', '1995-07-07', 'Quito', 1);

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

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`ALU_CODIGO`, `AUL_CODIGO`, `USU_CODIGO`, `ALU_NOMBRE`, `ALU_APELLIDO`, `ALU_EMAIL`, `ALU_TELEFONO`, `ALU_CEDULA`, `ALU_FNACIMIENTO`, `ALU_DIRECCION`, `ALU_ESTADO`) VALUES
(1, 5, 4, 'Juan', 'Lopez', 'julopez1@gmail.com', 993656965, '1785596695', '2018-03-22', 'Loja', 1),
(2, 4, 8, 'Christian', 'Novoa', 'cnovoa@hotmail.com', 995210841, '1725793390', '2021-09-01', 'Pedro Pinto', 1);

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

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`AUD_ID`, `USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES
(1, 1, '::1', 'ENTRO', '17:14:38', '2021-09-05'),
(2, 3, '::1', 'ENTRO', '18:05:32', '2021-09-05'),
(3, 1, '::1', 'ENTRO', '18:05:44', '2021-09-05'),
(4, 1, '::1', 'Modifico Estado Docente', '18:06:00', '2021-09-05'),
(5, 1, '::1', 'ENTRO', '20:37:51', '2021-09-05'),
(6, 2, '::1', 'ENTRO', '20:38:17', '2021-09-05'),
(7, 1, '::1', 'ENTRO', '20:39:43', '2021-09-05'),
(8, 1, '::1', 'Modifico Estado Docente', '20:40:02', '2021-09-05'),
(9, 2, '::1', 'ENTRO', '20:40:12', '2021-09-05'),
(10, 1, '::1', 'ENTRO', '21:54:50', '2021-09-05'),
(11, 2, '::1', 'ENTRO', '21:58:30', '2021-09-05'),
(12, 1, '::1', 'ENTRO', '01:52:25', '2021-09-06'),
(13, 3, '::1', 'ENTRO', '01:52:31', '2021-09-06'),
(14, 3, '::1', 'ENTRO', '02:02:25', '2021-09-06'),
(15, 3, '::1', 'ENTRO', '02:07:30', '2021-09-06'),
(16, 3, '::1', 'ENTRO', '02:08:41', '2021-09-06'),
(17, 3, '::1', 'ENTRO', '02:42:57', '2021-09-06'),
(18, 3, '::1', 'ENTRO', '02:52:43', '2021-09-06'),
(19, 1, '::1', 'ENTRO', '02:53:00', '2021-09-06'),
(20, 1, '::1', 'ENTRO', '03:06:06', '2021-09-06'),
(21, 4, '::1', 'Actualizo Registro', '03:06:28', '2021-09-06'),
(22, 4, '::1', 'ENTRO', '03:06:45', '2021-09-06'),
(23, 1, '::1', 'ENTRO', '03:07:59', '2021-09-06'),
(24, 1, '::1', 'Actualizo Alumno', '03:08:09', '2021-09-06'),
(25, 4, '::1', 'ENTRO', '03:08:23', '2021-09-06'),
(26, 1, '::1', 'ENTRO', '03:16:34', '2021-09-06'),
(27, 1, '::1', 'Actualizo Alumno', '03:18:17', '2021-09-06'),
(28, 4, '::1', 'ENTRO', '03:18:26', '2021-09-06'),
(29, 1, '::1', 'ENTRO', '03:18:42', '2021-09-06'),
(30, 1, '::1', 'Actualizo Alumno', '03:18:50', '2021-09-06'),
(31, 4, '::1', 'ENTRO', '03:19:08', '2021-09-06'),
(32, 1, '::1', 'ENTRO', '03:19:27', '2021-09-06'),
(33, 2, '::1', 'ENTRO', '03:23:31', '2021-09-06'),
(34, 1, '::1', 'Modifico Estado Docente', '03:23:39', '2021-09-06'),
(35, 1, '::1', 'ENTRO', '03:23:47', '2021-09-06'),
(36, 1, '::1', 'ENTRO', '03:24:26', '2021-09-06'),
(37, 1, '::1', 'Actualizo Alumno', '03:38:52', '2021-09-06'),
(38, 1, '::1', 'ENTRO', '03:50:13', '2021-09-06'),
(39, 2, '::1', 'ENTRO', '04:04:20', '2021-09-06'),
(40, 1, '::1', 'ENTRO', '09:04:56', '2021-09-06'),
(41, 1, '::1', 'Actualizo Materia', '09:24:17', '2021-09-06'),
(42, 1, '::1', 'Actualizo Materia', '09:24:29', '2021-09-06'),
(43, 1, '::1', 'Actualizo Materia', '09:26:21', '2021-09-06'),
(44, 2, '::1', 'ENTRO', '09:26:38', '2021-09-06'),
(45, 1, '::1', 'ENTRO', '09:27:04', '2021-09-06'),
(46, 1, '::1', 'Modifico Estado Materia', '09:28:57', '2021-09-06'),
(47, 1, '::1', 'ENTRO', '09:36:43', '2021-09-06'),
(48, 1, '::1', 'ENTRO', '09:43:01', '2021-09-06'),
(49, 4, '::1', 'ENTRO', '09:47:32', '2021-09-06'),
(50, 1, '::1', 'ENTRO', '09:48:23', '2021-09-06'),
(51, 1, '::1', 'Actualizo Alumno', '09:48:42', '2021-09-06'),
(52, 4, '::1', 'ENTRO', '09:48:51', '2021-09-06'),
(53, 1, '::1', 'ENTRO', '09:49:17', '2021-09-06'),
(54, 2, '::1', 'ENTRO', '09:51:09', '2021-09-06'),
(55, 1, '::1', 'ENTRO', '09:51:40', '2021-09-06'),
(56, 2, '::1', 'ENTRO', '10:28:44', '2021-09-06'),
(57, 1, '::1', 'ENTRO', '10:29:05', '2021-09-06'),
(58, 1, '::1', 'ENTRO', '10:48:02', '2021-09-06'),
(59, 1, '::1', 'Actualizo Aula', '10:51:24', '2021-09-06'),
(60, 1, '::1', 'Actualizo Aula', '10:51:49', '2021-09-06'),
(61, 1, '::1', 'Actualizo Aula', '10:52:28', '2021-09-06'),
(62, 1, '::1', 'Actualizo Aula', '10:52:36', '2021-09-06'),
(63, 1, '::1', 'Actualizo Aula', '10:52:46', '2021-09-06'),
(64, 1, '::1', 'Actualizo Aula', '10:52:55', '2021-09-06'),
(65, 1, '::1', 'Actualizo Aula', '10:53:37', '2021-09-06'),
(66, 1, '::1', 'Actualizo Aula', '10:53:46', '2021-09-06'),
(67, 1, '::1', 'Actualizo Aula', '10:53:53', '2021-09-06');

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
  `DOC_CARGAHORARIA` int(2) DEFAULT NULL,
  `DOC_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entidad que representa a los docentes del centro educativo';

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`DOC_CODIGO`, `USU_CODIGO`, `DOC_NOMBRE`, `DOC_APELLIDO`, `DOC_TELEFONO`, `DOC_CEDULA`, `DOC_FNACIMIENTO`, `DOC_DIRECCION`, `DOC_CARGAHORARIA`, `DOC_ESTADO`) VALUES
(1, 3, 'Pedro ', 'Gonzales', 998653251, '1725363625', '2015-05-05', 'Quito', 30, 1),
(2, 6, 'Juan', 'Padilla', 999999999, '1725666761', '2012-01-17', 'Av Amazonas', 30, 1),
(3, 7, 'Josefina', 'Alcado', 963252453, '1725469632', '2019-08-15', 'Cuenca', 30, 1),
(4, 9, 'Jose', 'Castro', 996521452, '1754993143', '1993-02-10', '6 de diciembre', 30, 1),
(5, 10, 'Maria', 'Montaño', 996557815, '1722074778', '1990-06-22', '12 de octubre', 30, 1);

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
(1, 1, '2020-2021', 0),
(2, 1, '2021-2022', 0),
(3, 1, '2021-2022', 0),
(6, 1, '2021-2022', 0),
(7, 1, '2021-2022', 0),
(8, 1, '2021-2022', 0),
(9, 1, '2021-2022', 0),
(10, 1, '2021-2022', 0),
(11, 1, '2021-2022', 0),
(12, 1, '2021-2022', 0),
(13, 1, '2021-2022', 1);

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
(1, 1, 1, 1, '07:15:00', '07:55:00', 0),
(2, 1, 1, 1, '07:15:00', '07:55:00', 0),
(3, 1, 3, 4, '08:35:00', '09:15:00', 0),
(4, 2, 2, 1, '07:15:00', '07:55:00', 1),
(5, 2, 7, 5, '08:35:00', '09:15:00', 1),
(6, 2, 1, 3, '10:15:00', '10:55:00', 1),
(7, 2, 1, 3, '09:35:00', '10:15:00', 1),
(8, 2, 1, 1, '11:55:00', '12:35:00', 1),
(9, 3, 3, 1, '07:15:00', '07:55:00', 1),
(10, 3, 16, 5, '07:15:00', '07:55:00', 1),
(11, 3, 3, 1, '07:55:00', '08:35:00', 1),
(12, 3, 4, 2, '07:15:00', '07:55:00', 1),
(13, 3, 4, 2, '07:55:00', '08:35:00', 1),
(14, 3, 15, 3, '07:15:00', '07:55:00', 1),
(15, 3, 16, 3, '07:55:00', '08:35:00', 1),
(16, 6, 2, 1, '07:55:00', '08:35:00', 1),
(17, 6, 7, 5, '07:55:00', '08:35:00', 1),
(18, 6, 4, 2, '09:35:00', '10:15:00', 1),
(19, 7, 3, 1, '07:15:00', '07:55:00', 1),
(20, 7, 16, 1, '09:35:00', '10:15:00', 1),
(21, 7, 16, 2, '07:15:00', '07:55:00', 1),
(22, 7, 16, 2, '07:55:00', '08:35:00', 1),
(23, 7, 3, 3, '07:15:00', '07:55:00', 1),
(24, 7, 15, 5, '07:15:00', '07:55:00', 1),
(25, 7, 4, 5, '07:55:00', '08:35:00', 1),
(26, 8, 2, 2, '07:55:00', '08:35:00', 1),
(27, 8, 2, 4, '07:55:00', '08:35:00', 1),
(28, 8, 2, 1, '09:35:00', '10:15:00', 1),
(29, 8, 4, 4, '09:35:00', '10:15:00', 1),
(30, 8, 4, 3, '09:35:00', '10:15:00', 1),
(31, 9, 6, 1, '07:55:00', '08:35:00', 1),
(32, 9, 6, 3, '07:55:00', '08:35:00', 1),
(33, 9, 5, 2, '09:35:00', '10:15:00', 1),
(34, 9, 14, 2, '10:15:00', '10:55:00', 1),
(35, 10, 2, 3, '08:35:00', '09:15:00', 1),
(36, 11, 7, 1, '07:15:00', '07:55:00', 1),
(37, 11, 7, 1, '07:55:00', '08:35:00', 1),
(38, 11, 2, 3, '07:15:00', '07:55:00', 1),
(39, 12, 2, 2, '07:55:00', '08:35:00', 1),
(40, 12, 7, 2, '08:35:00', '09:15:00', 1),
(41, 12, 2, 1, '08:35:00', '09:15:00', 1),
(42, 13, 4, 2, '07:55:00', '08:35:00', 1),
(43, 13, 4, 2, '07:15:00', '07:55:00', 1),
(44, 13, 7, 1, '07:55:00', '08:35:00', 1),
(45, 13, 7, 3, '07:15:00', '07:55:00', 1),
(46, 13, 7, 3, '07:55:00', '08:35:00', 1);

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
(2, 2, 'Inglés', 'Lengua Extranjera', 3, 1, 1),
(3, 2, 'Ciencias Naturales', 'Ciencias Naturales', 5, 2, 1),
(4, 1, 'Matemática', 'Matemática', 7, 2, 1),
(5, 2, 'Física', 'Ciencias Naturales', 3, 4, 1),
(6, 1, 'Química', 'Ciencias Naturales', 2, 4, 1),
(7, 3, 'Inglés', 'Lengua Extranjera', 3, 1, 1),
(14, 3, 'Física', 'Ciencias Naturales', 3, 4, 1),
(15, 2, 'Matemática', 'Matemática', 7, 2, 1),
(16, 3, 'Ciencias Naturales', 'Ciencias Naturales', 5, 2, 1),
(18, 3, 'Lengua y Literatura', 'Lengua y Literatura', 10, 1, 1),
(19, NULL, 'Currículo Integrador por Ámbitos  d', 'Currículo Integrador por Ámbit', 25, 7, 1),
(20, NULL, 'Educación Cultural y Artística', 'Educación Cultural y Artística', 3, 7, 1),
(21, NULL, 'Educación Física', 'Educación Física', 5, 7, 1),
(22, NULL, 'Proyectos Escolares', 'Proyectos Escolares', 1, 7, 1),
(23, NULL, 'Estudios Sociales', 'Ciencias Sociales', 2, 1, 1),
(24, NULL, 'Ciencias Naturales', 'Ciencias Naturales', 3, 1, 1),
(25, NULL, 'Educación Cultural y Artística', 'Educación Cultural y Artística', 2, 1, 1),
(26, NULL, 'Educación Física', 'Educación Física', 5, 1, 1),
(27, NULL, 'Proyectos Escolares', 'Proyectos Escolares', 1, 1, 1),
(28, NULL, 'Desarrollo Humano Integral', 'Desarrollo Humano Integral', 1, 1, 1),
(29, NULL, 'Lengua y Literatura', 'Lengua y Literatura', 8, 2, 1),
(30, NULL, 'Lengua y Literatura', 'Lengua y Literatura', 6, 3, 1),
(31, NULL, 'Lengua y Literatura', 'Lengua y Literatura', 5, 4, 1),
(32, NULL, 'Lengua y Literatura', 'Lengua y Literatura', 5, 5, 1),
(33, NULL, 'Lengua y Literatura', 'Lengua y Literatura', 2, 6, 1),
(34, NULL, 'Matemática', 'Matemática', 6, 3, 1),
(35, NULL, 'Matemática', 'Matemática', 5, 4, 1),
(36, NULL, 'Matemática', 'Matemática', 4, 5, 1),
(37, NULL, 'Matemática', 'Matemática', 3, 6, 1),
(38, NULL, 'Estudios Sociales', 'Ciencias Sociales', 3, 2, 1),
(39, NULL, 'Estudios Sociales', 'Ciencias Sociales', 4, 3, 1),
(40, NULL, 'Ciencias Naturales', 'Ciencias Naturales', 4, 3, 1),
(41, NULL, 'Educación Cultural y Artística', 'Educación Cultural y Artística', 2, 2, 1),
(42, NULL, 'Educación Cultural y Artística', 'Educación Cultural y Artística', 2, 3, 1),
(43, NULL, 'Educación Cultural y Artística', 'Educación Cultural y Artística', 2, 4, 1),
(44, NULL, 'Educación Cultural y Artística', 'Educación Cultural y Artística', 2, 5, 1),
(45, NULL, 'Educación Física', 'Educación Física', 5, 2, 1),
(46, NULL, 'Educación Física', 'Educación Física', 5, 3, 1),
(47, NULL, 'Educación Física', 'Educación Física', 2, 4, 1),
(48, NULL, 'Educación Física', 'Educación Física', 2, 5, 1),
(49, NULL, 'Educación Física', 'Educación Física', 2, 6, 1),
(50, NULL, 'Inglés', 'Lengua Extranjera', 3, 2, 1),
(51, NULL, 'Lengua Extranjera', 'Lengua Extranjera', 5, 3, 1),
(52, NULL, 'Inglés', 'Lengua Extranjera', 5, 4, 1),
(53, NULL, 'Inglés', 'Lengua Extranjera', 5, 5, 1),
(54, NULL, 'Inglés', 'Lengua Extranjera', 3, 6, 1),
(55, NULL, 'Proyectos Escolares', 'Proyectos Escolares', 1, 2, 1),
(56, NULL, 'Proyectos Escolares', 'Proyectos Escolares', 2, 3, 1),
(57, NULL, 'Desarrollo Humano Integral', 'Desarrollo Humano Integral', 1, 2, 1),
(58, NULL, 'Desarrollo Humano Integral', 'Desarrollo Humano Integral', 1, 3, 1),
(59, NULL, 'Física', 'Ciencias Naturales', 3, 4, 1),
(60, NULL, 'Física', 'Ciencias Naturales', 3, 5, 1),
(61, NULL, 'Física', 'Ciencias Naturales', 2, 6, 1),
(62, NULL, 'Química', 'Ciencias Naturales', 3, 5, 1),
(63, NULL, 'Química', 'Ciencias Naturales', 2, 6, 1),
(64, NULL, 'Biología', 'Ciencias Naturales', 2, 4, 1),
(65, NULL, 'Biología', 'Ciencias Naturales', 2, 5, 1),
(66, NULL, 'Biología', 'Ciencias Naturales', 2, 6, 1),
(67, NULL, 'Historia', 'Ciencias Sociales', 3, 4, 1),
(68, NULL, 'Historia', 'Ciencias Sociales', 3, 5, 1),
(69, NULL, 'Historia', 'Ciencias Sociales', 2, 6, 1),
(70, NULL, 'Educación para la Ciudadanía', 'Ciencias Sociales', 2, 4, 1),
(71, NULL, 'Educación para la Ciudadanía', 'Ciencias Sociales', 2, 5, 1),
(72, NULL, 'Filosofía', 'Ciencias Sociales', 2, 4, 1),
(73, NULL, 'Filosofía', 'Ciencias Sociales', 2, 5, 1),
(74, NULL, 'Emprendimiento y Gestión', 'Módulo Interdisciplinar', 2, 4, 1),
(75, NULL, 'Emprendimiento y Gestión', 'Módulo Interdisciplinar', 2, 5, 1),
(76, NULL, 'Emprendimiento y Gestión', 'Módulo Interdisciplinar', 2, 6, 1);

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
(7, 'PREPARATORIA', 'INICIAL', 1);

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
(1, 2, 'A', '2do Básica', 1, 1),
(2, 6, 'B', '2do Básica', 1, 1),
(3, 8, 'C', '2do Básica', 1, 1),
(4, 12, 'A', '3ro Básica', 1, 1),
(5, 13, 'B', '3ro Básica', 1, 1),
(6, 7, 'A', '5to Básica', 2, 1),
(7, 3, 'B', '5to Básica', 2, 1),
(8, 9, 'A', '1ro BGU', 4, 1),
(9, NULL, 'A', 'Inicial', 7, 1),
(10, NULL, 'B', '4to Básica', 1, 1),
(11, NULL, 'A', '6to Básica', 2, 1),
(12, NULL, 'A', '4to Básica', 2, 1),
(13, NULL, 'A', '8vo Básica', 3, 1),
(14, NULL, 'A', '9no Básica', 3, 1),
(15, NULL, 'A', '10mo Básica', 3, 1),
(16, NULL, 'A', '2do BGU', 5, 1),
(17, NULL, 'A', '3ro BGU', 6, 1),
(18, NULL, 'A', '7mo Básica', 3, 1);

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
(1, 2, 'Jose', 'Marin', 996325149, '1725793965', '2017-12-07', 'Guayaquil', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `USU_CODIGO` int(2) NOT NULL,
  `ROL_CODIGO` int(2) NOT NULL,
  `USU_USER` char(35) NOT NULL,
  `USU_CLAVE` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `USU_ESTADO` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`USU_CODIGO`, `ROL_CODIGO`, `USU_USER`, `USU_CLAVE`, `USU_ESTADO`) VALUES
(1, 1, 'admin', '$2y$10$9Qu2FBaX/46ZTAPSqALOUOsURaV.i1YV.Fa9V2u2HdBXXrWNiGB3O', 1),
(2, 2, 'supervisor', '$2y$10$3Cx/7jFxccFVZpmpJf75wurDgFMzDszRb/SqJQet4uiAShtJl/a/u', 1),
(3, 3, 'docente', '$2y$10$KIU8vAlXvs.VTD.UgmtxQe7Gv2UX7Ph8RJpDzKBvYJnNxr2hLWwoa', 1),
(4, 4, 'alumno', '$2y$10$m842ZEceXREo91L7fzYFqunl/NpoklC6oGNQqTrqu7JHJ0PJI8Mdu', 1),
(5, 1, 'admin2', '$2y$10$gP3zWVT1ynDhh/ahF54nCuzw6daomJeHOTz9zzpb2RGcfWG21.BXu', 1),
(6, 3, 'docente3', '$2y$10$TDaAgUA2Y2x1WaNrt2M.6egf.kFsla8NiAoLYxiXV5mjOZ2szZOFW', 1),
(7, 3, 'docente2', '$2y$10$j9pUnviOBF0bLK.4paxpoeTU22HFK.RGEhqzxVOwqwq3r4NVlkxTq', 1),
(8, 4, 'chnovoa', '$2y$10$V7Y43rluuHGGUvdHQTDjvOs0w/c4nP8MMuIwNVetfJu7MeV34StZC', 1),
(9, 3, 'jocastro', '$2y$10$cfBlg2wDIEVVfecBWbrli.yUAh20xa5BAOdeHWfiHu4eaeUjr0wqe', 1),
(10, 3, 'mamontaño', '$2y$10$rhF8E2Q81hBmiQ65Or/YyevcClvFG22WjiDsWms26cfo3oDOW.LhG', 1);

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
  MODIFY `ADM_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `ALU_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `AUD_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `DIA_CODIGO` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `DOC_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `HOR_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `horarios_materias`
--
ALTER TABLE `horarios_materias`
  MODIFY `HMA_CODIGO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `MAT_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `NIV_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `paralelo`
--
ALTER TABLE `paralelo`
  MODIFY `AUL_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `USU_CODIGO` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
