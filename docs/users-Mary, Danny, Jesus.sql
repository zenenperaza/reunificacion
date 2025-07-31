-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-07-2025 a las 01:42:45
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reunificacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `estatus` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `phone`, `address`, `photo`, `estatus`, `created_at`, `updated_at`) VALUES
(4, 'monitoreonacional', 'mmelendez@asonacop.org', '$2y$12$h7UDxzcvtGtDfRiotJsYQulO90dkZ2K3e5oufh5ti2k6msB63NBoi', NULL, NULL, NULL, NULL, 0, 'activo', NULL, NULL, 0, '2025-07-01 02:22:02', '2025-07-28 09:46:17'),
(5, 'Danny', 'dannyprimera@gmail.com', '$2y$12$BF30tYqbYstWE2fD6sBRQemIED.GN9o9VcGys8YscDHfZXqMeBnhO', NULL, NULL, NULL, NULL, 0, 'activo', NULL, NULL, 0, '2025-07-01 02:46:07', '2025-07-21 18:25:13'),
(6, 'Jesus Villarroel', 'soporteit@asonacop.org', '$2y$12$ErrIN7bMOZcLxlqR4NglFeho4RdI5kRnPuWBYqsws71jQ/3zzGCUa', NULL, NULL, NULL, NULL, 0, 'activo', NULL, NULL, 0, '2025-07-04 00:59:51', '2025-07-21 18:25:32'),
(7, 'Lily Torres', 'lilytorres@asonacop.org', '$2y$12$yKORccprRj8xV/Ev22Db2uPtTYtim22WKlR4kpkhdoiT6Nc6GWeVa', NULL, NULL, NULL, NULL, 0, 'activo', NULL, NULL, 0, '2025-07-28 09:44:16', '2025-07-28 09:45:59'),
(8, 'Yohana Moros', 'pocha2207@hotmail.com', '$2y$12$BdnrOCTNs75pFKusLQGhhe1dcim57HCo52svDgOUWqNhSuT3mQSN6', NULL, NULL, NULL, NULL, 0, 'activo', NULL, NULL, 0, '2025-07-30 09:25:59', '2025-07-30 09:29:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
