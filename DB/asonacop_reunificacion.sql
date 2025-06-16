-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2025 a las 18:53:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asonacop_reunificacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_administrador` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text DEFAULT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `perfil` text NOT NULL,
  `foto` text DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_administrador`, `nombre`, `apellido`, `email`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'ZENEN', 'PERAZA', 'peraza@outlook.com', '123456', 'Administrador', 'vistas/img/administradores/peraza@outlook.com/999.jpg', 1, '2022-03-30 13:32:38', '2025-06-13 21:28:51'),
(79, 'SOPORTEIT ASONACOP', NULL, 'soporteit@asonacop.com', '$2a$07$asxx54ahjppf45sd87a5auHNBctDGBFEQbq9t8vAIaXHel0aSRhKC', 'Administrador', 'vistas/img/administradores/default/anonymous.png', 1, NULL, '2022-04-11 17:33:52'),
(82, 'CAROLINA', 'MARTINEZ', 'lina_es@hotmail.com', '$2a$07$asxx54ahjppf45sd87a5au3Kroq0ubTQSEp/bMApc089h.SJNKO5S', 'Administrador', 'vistas/img/administradores/lina_es@hotmail.com/678.png', 1, NULL, '2022-05-27 17:05:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casos`
--

CREATE TABLE `casos` (
  `id_caso` int(11) NOT NULL,
  `tipo` text DEFAULT NULL,
  `cedula_solicitante` text DEFAULT NULL,
  `nombre_solicitante` text DEFAULT NULL,
  `apellido_solicitante` text DEFAULT NULL,
  `fecha_nacimiento_solicitante` text DEFAULT NULL,
  `edad_solicitante` text DEFAULT NULL,
  `sexo_solicitante` text DEFAULT NULL,
  `nacionalidad_solicitante` text DEFAULT NULL,
  `estado_solicitante` text DEFAULT NULL,
  `municipio_solicitante` text DEFAULT NULL,
  `direccion_solicitante` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `cedula_nna` text DEFAULT NULL,
  `nombre_nna` text DEFAULT NULL,
  `apellido_nna` text DEFAULT NULL,
  `fecha_nacimiento_nna` text DEFAULT NULL,
  `edad_nna` text DEFAULT NULL,
  `sexo_nna` text DEFAULT NULL,
  `nacionalidad_nna` text DEFAULT NULL,
  `direccion_nna` text DEFAULT NULL,
  `derecho_vulnerado` text DEFAULT NULL,
  `cedula_denunciado` text DEFAULT NULL,
  `nombre_denunciado` text DEFAULT NULL,
  `apellido_denunciado` text DEFAULT NULL,
  `nacionalidad_denunciado` text DEFAULT NULL,
  `direccion_denunciado` text DEFAULT NULL,
  `fecha_nacimiento_denunciado` text DEFAULT NULL,
  `edad_denunciado` text DEFAULT NULL,
  `sexo_denunciado` text DEFAULT NULL,
  `estado_denunciado` text DEFAULT NULL,
  `municipio_denunciado` text DEFAULT NULL,
  `medidas` text DEFAULT NULL,
  `ministerio` text DEFAULT NULL,
  `cedula_segundo_representante` text DEFAULT NULL,
  `nombre_segundo_representante` text DEFAULT NULL,
  `apellido_segundo_representante` text DEFAULT NULL,
  `fecha_nacimiento_segundo_representante` text DEFAULT NULL,
  `edad_segundo_representante` text DEFAULT NULL,
  `sexo_segundo_representante` text DEFAULT NULL,
  `nacionalidad_segundo_representante` text DEFAULT NULL,
  `direccion_segundo_representante` text DEFAULT NULL,
  `cedula_nna_viaje` text DEFAULT NULL,
  `nombre_nna_viaje` text DEFAULT NULL,
  `apellido_nna_viaje` text DEFAULT NULL,
  `fecha_nacimiento_nna_viaje` text DEFAULT NULL,
  `edad_nna_viaje` text DEFAULT NULL,
  `sexo_nna_viaje` text DEFAULT NULL,
  `nacionalidad_nna_viaje` text DEFAULT NULL,
  `direccion_nna_viaje` text DEFAULT NULL,
  `tipo_viaje` text DEFAULT NULL,
  `destino_viaje` text DEFAULT NULL,
  `pasaporte` text DEFAULT NULL,
  `visa` text DEFAULT NULL,
  `cedula_trabajo` text DEFAULT NULL,
  `nombre_trabajo` text DEFAULT NULL,
  `apellido_trabajo` text DEFAULT NULL,
  `fecha_nacimiento_trabajo` text DEFAULT NULL,
  `edad_trabajo` text DEFAULT NULL,
  `sexo_trabajo` text DEFAULT NULL,
  `direccion_trabajo` text DEFAULT NULL,
  `escuela_estudio` text DEFAULT NULL,
  `grado_estudio` text DEFAULT NULL,
  `horario_estudio` text DEFAULT NULL,
  `lugar_trabajo` text DEFAULT NULL,
  `tipo_trabajo` text DEFAULT NULL,
  `horario_trabajo` text DEFAULT NULL,
  `fecha_ingreso_trabajo` text DEFAULT NULL,
  `indicacion_patrono` text DEFAULT NULL,
  `constancia_medica` text DEFAULT NULL,
  `tipo_orientacion` text DEFAULT NULL,
  `nombre_organismo` text DEFAULT NULL,
  `fecha_creacion_caso` text DEFAULT NULL,
  `fecha_actualizacion_caso` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `casos`
--

INSERT INTO `casos` (`id_caso`, `tipo`, `cedula_solicitante`, `nombre_solicitante`, `apellido_solicitante`, `fecha_nacimiento_solicitante`, `edad_solicitante`, `sexo_solicitante`, `nacionalidad_solicitante`, `estado_solicitante`, `municipio_solicitante`, `direccion_solicitante`, `observaciones`, `cedula_nna`, `nombre_nna`, `apellido_nna`, `fecha_nacimiento_nna`, `edad_nna`, `sexo_nna`, `nacionalidad_nna`, `direccion_nna`, `derecho_vulnerado`, `cedula_denunciado`, `nombre_denunciado`, `apellido_denunciado`, `nacionalidad_denunciado`, `direccion_denunciado`, `fecha_nacimiento_denunciado`, `edad_denunciado`, `sexo_denunciado`, `estado_denunciado`, `municipio_denunciado`, `medidas`, `ministerio`, `cedula_segundo_representante`, `nombre_segundo_representante`, `apellido_segundo_representante`, `fecha_nacimiento_segundo_representante`, `edad_segundo_representante`, `sexo_segundo_representante`, `nacionalidad_segundo_representante`, `direccion_segundo_representante`, `cedula_nna_viaje`, `nombre_nna_viaje`, `apellido_nna_viaje`, `fecha_nacimiento_nna_viaje`, `edad_nna_viaje`, `sexo_nna_viaje`, `nacionalidad_nna_viaje`, `direccion_nna_viaje`, `tipo_viaje`, `destino_viaje`, `pasaporte`, `visa`, `cedula_trabajo`, `nombre_trabajo`, `apellido_trabajo`, `fecha_nacimiento_trabajo`, `edad_trabajo`, `sexo_trabajo`, `direccion_trabajo`, `escuela_estudio`, `grado_estudio`, `horario_estudio`, `lugar_trabajo`, `tipo_trabajo`, `horario_trabajo`, `fecha_ingreso_trabajo`, `indicacion_patrono`, `constancia_medica`, `tipo_orientacion`, `nombre_organismo`, `fecha_creacion_caso`, `fecha_actualizacion_caso`) VALUES
(1, 'Denuncia', '14695963', 'Zenen', 'Peraza', '1980-01-12', '42', 'Masculino', 'V', NULL, NULL, 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'prueba', '14695963', 'Zenen', 'Peraza', '1980-01-12', '42', 'Masculino', 'V', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '91', '14695963', 'Zenen', 'Peraza', 'E', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '1980-02-01', '34', 'Femenino', NULL, NULL, 'SI', 'SI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Zenen', 'Peraza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-02', '2022-05-02 16:44:55'),
(2, 'Denuncia', '15265074', 'Iraima', 'Escalona', '1979-07-31', '43', 'Masculino', 'v', NULL, NULL, 'el triunfo', 'el vecino le oega a os ninos', '15265074', 'Isabelis', 'Escalona', '2014-09-24', '6', 'on', 'v', 'el triunfo', 'art 34', '10268987', 'jose', 'mendoza', 'v', 'la antena', '2015-06-21', '45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-02', '2022-05-02 18:10:14'),
(3, 'Denuncia', '15265074', 'IRAIMA', 'ESCALONA', '2022-05-03', '42', 'Femenino', 'Venezolana', 'Lara', 'San Antonio', 'Barrio las verits', 'el vecino le pega al nene', '20658789', 'jose', 'peraza', '2022-05-08', '6', 'Masculino', 'Venezolano', 'el triunfo', 'art 16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2022-05-02 18:32:13'),
(5, 'Denuncia', '15265074', 'IRAIMA', 'ESCALONA', '2022-05-03', '42', 'Femenino', 'Venezolana', 'Lara', 'San Antonio', 'Barrio las verits', 'el vecino le pega al nene', '20658789', 'jose', 'peraza', '2022-05-08', '6', 'Masculino', 'Venezolano', 'el triunfo', 'art 16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2022-05-02 18:42:19'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014', '2022-05-02 18:42:19'),
(7, 'Denuncia', '15265074', '', '', '', '', NULL, '', NULL, NULL, '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-02 14:44:55', '2022-05-02 18:44:55'),
(8, 'Permiso viaje', '15467364', 'Zenen', 'Peraza', '1980-01-12', '43', 'Masculino', 'V', NULL, NULL, 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'viajando al terminal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40345678', 'Zenen', 'Peraza', NULL, NULL, NULL, NULL, NULL, 'Interior', 'duaca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-02 15:18:44', '2022-05-02 19:18:44'),
(9, 'Credencial trabajo', '14256987', 'Zenen', 'Peraza', '1980-01-12', '42', 'Masculino', 'V', NULL, NULL, 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'trabajando ando', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20987456', 'Augusto', 'Peraza', '2020-05-01', '12', 'Masculino', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'las veritas', '6to', '12 am 01 pm', 'daka', 'cajero', '7:00 a 15:00', '2020-06-12', 'trabando mucho', 'SI', NULL, NULL, '2022-05-02 15:48:59', '2022-05-02 19:48:59'),
(10, 'Remision', '13675098', 'Zenen', 'Peraza', '2018-05-21', '35', 'Masculino', 'V', NULL, NULL, 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'el nino se remitio al Tribunal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TSJ', '2022-05-02 16:00:35', '2022-05-02 20:00:35'),
(11, 'Orientacion', '23453098', 'Zenen', 'Peraza', '2019-12-30', '42', 'Masculino', 'V', NULL, NULL, 'Barrio el Triunfo. Carrera 12 entre 3A y 4. Sector las Mercedes', 'el menor se oriento', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'orientacion sicologica', NULL, '2022-05-02 16:05:28', '2022-05-02 20:05:28'),
(12, 'Denuncia', '20456098', 'Zenen', 'Peraza', '2020-12-22', '42', 'Masculino', 'v', NULL, NULL, 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'son observaciones', '39484848', 'Zenen', 'Peraza', '2020-12-22', '42', 'on', 'v', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'art 54', '', 'jose ', 'cabrera', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-03 09:48:59', '2022-05-03 13:48:59'),
(13, 'Denuncia', '', '', '', '', '', NULL, '', NULL, NULL, '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'on', 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-03 11:06:37', '2022-05-03 15:06:37'),
(14, 'Denuncia', '', '', '', '', '', NULL, '', NULL, NULL, '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-03 11:09:02', '2022-05-03 15:09:02'),
(15, 'Denuncia', '', '', '', '', '', NULL, '', NULL, NULL, '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-03 11:10:16', '2022-05-03 15:10:16'),
(16, 'Denuncia', '', '', '', '', '', NULL, '', NULL, NULL, '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-03 11:12:26', '2022-05-03 15:12:26'),
(17, 'Denuncia', '', '', '', '', '', NULL, '', NULL, NULL, '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-03 11:13:20', '2022-05-03 15:13:20'),
(18, 'Denuncia', '', '', '', '', '', NULL, '', NULL, NULL, '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'SI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-03 11:13:49', '2022-05-03 15:13:49'),
(19, 'Denuncia', '14695963', 'Zenen', 'Peraza', '12/01/1980', '42', 'Masculino', 'V', 'Tachira', 'San Antonio', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '', '14695963', 'Zenen', 'Peraza', '12/01/1980', '42', 'Masculino', 'V', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '', '14695963', 'Zenen', 'Peraza', 'V', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '12/01/1980', '42', 'Masculino', NULL, NULL, 'SI', 'SI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-03 11:15:02', '2022-05-03 15:15:02'),
(20, 'Permiso viaje', '14695963', 'Zenen', 'Peraza', '1980-01-12', '42', 'Masculino', 'V', NULL, NULL, 'Barrio el Triunfo. Carrera 12 entre 3A y 4. Sector las Mercedes', 'SIN OBS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15265074', 'Zenen', 'Peraza', '1979-07-31', '42', 'Femenino', 'V', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '18200369', 'Zenen', 'Peraza', '1980-05-22', '40', 'on', 'v', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'Interior', 'colombia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-09 15:28:32', '2022-05-09 19:28:32'),
(21, 'Denuncia', '15272516', 'Caro Caro', 'Martinez', '12/05/1986', '36', 'Femenino', 'V', 'Tachira', 'San Antonio', 'Calle Miranda, carrera 15, casa 55', '', '', 'Willesis', 'Marquez', '2017-12-22', '5', NULL, 'V', 'Calle Miranda, carrera 15, casa 59', 'A ser protegido contra abuso y explotaciÃ³n sexual y a la integridad personal', '', 'William ', 'MÃ¡rquez ', '', 'Calle Miranda, carrera 15, casa 59 ', '1975-03-28', '47', NULL, NULL, NULL, 'SI', 'SI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-12 09:50:08', '2022-05-12 13:50:08'),
(22, 'Permiso viaje', '15272516', 'Carolina', 'Martinez', '1986-05-12', '36', 'Femenino', 'V', NULL, NULL, 'Calle Miranda, carrera 15, casa 55', 'Solicita permiso de viaje internacional a su hijo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14936152', 'Pedro', 'Perez', '1991-05-12', '41', 'Masculino', 'V', 'Valencia, Av BolÃ­var, calle 34, Apto 56', '0', 'Sinai', 'Perez', '2013-05-10', '9', 'on', 'V', '', 'Exterior', 'Chile', 'SI', 'SI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-12 13:23:16', '2022-05-12 17:23:16'),
(23, 'Denuncia', '14695963', 'Zenen', 'Peraza', '1980-01-12', '42', 'Masculino', 'V', NULL, NULL, 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'son observaciobnes', '14695963', 'Zenen', 'Peraza', '1980-01-12', '42', 'Masculino', 'V', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '', '15265074', 'jose', 'mendoza', 'v', 'la antena', '2015-06-21', '45', 'Masculino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-17 14:00:34', '2022-05-17 18:00:34'),
(24, 'Denuncia', '14695963', 'Zenen', 'Peraza', '1980-01-12', '42', 'Masculino', 'V', NULL, NULL, 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'con observaciones', '14695963', 'Zenen', 'Peraza', '1980-01-12', '42', 'Masculino', 'V', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '', '15265074', 'jose', 'mendoza', 'v', 'la antena', '2015-06-21', '45', 'Masculino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-17 14:04:58', '2022-05-17 18:04:58'),
(25, 'Denuncia', '14695963', 'Zenen', 'Peraza', '1980-01-12', '42', 'Masculino', 'V', 'Tachira', 'San Antonio', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'estas observaciones son para probar la adecion', '14695963', 'Zenen', 'Peraza', '1980-01-12', '42', 'Masculino', 'V', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '', '15265074', 'jose', 'mendoza', 'V', 'la antena', '2015-06-21', '45', 'Masculino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-17 14:32:41', '2022-05-17 18:32:41'),
(26, 'Denuncia', '15272516', 'Carolina', 'Martinez', '1986-05-12', '36', 'Femenino', 'V', NULL, NULL, 'Calle Miranda, carrera 15, casa 55', 'prueba caro', '15272516', 'Carolina', 'Martinez', '1986-05-12', '36', 'Masculino', 'V', 'Calle Miranda, carrera 15, casa 55', '', '14695963', 'Zenen', 'Peraza', 'E', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '1980-02-01', '34', 'Masculino', NULL, NULL, 'SI', 'SI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-17', '2022-05-17 18:34:36'),
(27, 'Denuncia', '20348274', 'MARISELA', 'GUEDEZ', '29/05/1989', '32', 'Femenino', 'V', NULL, NULL, 'Barrio Rafael linarez', 'el vecino abuso del hjo', '20348274', 'MARISELA', 'GUEDEZ', '29/05/1989', '32', 'Masculino', 'V', 'Barrio Rafael linarez', '', '7407050', 'Wilman', 'Mendoza', 'V', 'La ruezga sur', '04/08/1968', '53', 'Masculino', NULL, NULL, 'SI', 'SI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-19 11:04:22', '2022-05-19 15:04:22'),
(28, 'Denuncia', '3317397', 'Juana Bautista', 'Gil', '20/10/1944', '77', 'Femenino', 'V', 'Tachira', 'San Antonio', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', '', '20245078', 'Marlene', 'Palmera', '01/01/2009', '13', 'Masculino', 'V', 'CARRERA 12 CALLE 4', 'art 34', '10177265', 'Ramon', 'arvajal', 'V', 'La rinconada', '24/05/1980', '42', 'Masculino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-25', '2022-05-25 13:57:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula` text DEFAULT NULL,
  `nombre` text DEFAULT NULL,
  `apellido` text DEFAULT NULL,
  `fecha_nacimiento` text DEFAULT NULL,
  `sexo` text DEFAULT NULL,
  `nacionalidad` text DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `estado` text DEFAULT NULL,
  `municipio` text DEFAULT NULL,
  `telefono_fijo` text DEFAULT NULL,
  `telefono_movil` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cedula`, `nombre`, `apellido`, `fecha_nacimiento`, `sexo`, `nacionalidad`, `direccion`, `estado`, `municipio`, `telefono_fijo`, `telefono_movil`, `email`, `foto`, `fecha`) VALUES
(1, NULL, 'ZENEN', 'PERAZA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'peraza@outlook.com', 'vistas/img/usuarios/peraza@outlook.com/348.jpg', '2022-04-05 18:25:32'),
(79, NULL, 'SOPORTEIT ASONACOP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'soporteit@asonacop.com', 'vistas/img/usuarios/default/anonymous.png', '2022-04-05 17:02:57'),
(82, NULL, 'CAROLINA', 'MARTINEZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'lina_es@hotmail.com', 'vistas/img/usuarios/lina_es@hotmail.com/678.png', '2022-04-08 17:03:48'),
(86, '14695963', 'Zenen', 'Peraza', '1980-01-12', 'Masculino', 'V', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-17 18:32:41'),
(87, '15265074', 'jose', 'mendoza', '2015-06-21', 'Masculino', 'v', 'la antena', NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-17 18:32:41'),
(88, '15272516', 'Carolina', 'Martinez', '1986-05-12', 'Femenino', 'V', 'Calle Miranda, carrera 15, casa 55', NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-17 18:34:36'),
(89, '20348274', 'MARISELA', 'GUEDEZ', '29/05/1989', 'Femenino', 'V', 'Barrio Rafael linarez', NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-19 15:04:22'),
(90, '7407050', 'Wilman', 'Mendoza', '04/08/1968', 'Masculino', 'V', 'La ruezga sur', NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-19 15:04:22'),
(91, '3317397', 'Juana', 'Gil', '20/10/1944', 'Masculino', 'V', 'Barrio El triunfo. Carrera 12 entre 3 y 3a', 'Tachira', 'San Antonio', NULL, NULL, NULL, NULL, '2022-05-25 13:57:34'),
(92, '20245078', 'Marlene', 'Palmera', '01/01/2009', 'Femenino', 'V', 'CARRERA 12 CALLE 4', 'Tachira', 'San Antonio', NULL, NULL, NULL, NULL, '2022-05-25 13:57:34'),
(93, '10177265', 'Ramon', 'arvajal', '24/05/1980', 'Masculino', 'E', 'La rinconada', 'Tachira', 'San Antonio', '02512732840', '04245034999', 'peraza@outlook.com', NULL, '2022-05-31 18:00:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_administrador`);

--
-- Indices de la tabla `casos`
--
ALTER TABLE `casos`
  ADD PRIMARY KEY (`id_caso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `casos`
--
ALTER TABLE `casos`
  MODIFY `id_caso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
