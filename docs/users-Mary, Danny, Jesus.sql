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
(null, 'Zenen Peraza', 'peraza@outlook.com', '$2y$12$KcXdyg/Y/IKDEKxzAeUEjO8nkMN1kTEyvDQndKOajybv53ZbMRWmK', NULL, '0000000000', 'Dirección Central', NULL, 'activo', '2025-07-03 03:39:42', '2025-07-03 03:39:42'),
(null, 'monitoreonacional', 'mmelendez@asonacop.org', '$2y$12$h7UDxzcvtGtDfRiotJsYQulO90dkZ2K3e5oufh5ti2k6msB63NBoi', NULL, NULL, NULL, NULL, 'activo', '2025-06-30 22:22:02', '2025-06-30 22:22:02'),
(null, 'Danny', 'dannyprimera@gmail.com', '$2y$12$BF30tYqbYstWE2fD6sBRQemIED.GN9o9VcGys8YscDHfZXqMeBnhO', NULL, NULL, NULL, NULL, 'activo', '2025-06-30 22:46:07', '2025-06-30 22:46:07'),
(null, 'Jesus Villarroel', 'soporteit@asonacop.org', '$2y$12$iclkAkV9w24GkbsEUJVIp.MDvbrj00SrJroKErmDwQ1x435QH9Ksq', NULL, NULL, NULL, NULL, 'activo', '2025-07-03 20:59:51', '2025-07-03 20:59:51');

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
