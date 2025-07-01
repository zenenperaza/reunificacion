-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-07-2025 a las 13:03:18
-- Versión del servidor: 10.11.10-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sist_reunificacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('atencion_programa_rlf_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:23:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"Dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:14:\"dashboard-user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:13:\"Gestion casos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"crear casos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:9:\"ver casos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"editar casos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"eliminar casos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:13:\"Gestion roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:9:\"ver roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"editar roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:11:\"crear roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:14:\"eliminar roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:16:\"Gestion usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:12:\"ver usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"editar usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:14:\"crear usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:17:\"eliminar usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:16:\"Gestion permisos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:21:\"Gestion configuracion\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:12:\"ver bitacora\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:15:\"cierre atencion\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:20:\"ver casos eliminados\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:26:\"restaurar casos eliminados\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"Administrador\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"Usuario\";s:1:\"c\";s:3:\"web\";}}}', 1751320648);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casos`
--

CREATE TABLE `casos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `periodo` varchar(255) DEFAULT NULL,
  `fecha_atencion` date DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `municipio_id` bigint(20) UNSIGNED NOT NULL,
  `parroquia_id` bigint(20) UNSIGNED NOT NULL,
  `elaborado_por` varchar(255) DEFAULT NULL,
  `numero_caso` varchar(255) DEFAULT NULL,
  `organizacion_programa` varchar(255) DEFAULT NULL,
  `organizacion_solicitante` varchar(255) DEFAULT NULL,
  `otras_organizaciones` varchar(255) DEFAULT NULL,
  `tipo_atencion_programa` varchar(255) DEFAULT NULL,
  `tipo_atencion` varchar(255) DEFAULT NULL,
  `beneficiario` varchar(255) DEFAULT NULL,
  `estado_mujer` varchar(255) DEFAULT NULL,
  `edad_beneficiario` int(11) DEFAULT NULL,
  `poblacion_lgbti` varchar(255) DEFAULT NULL,
  `acompanante` varchar(255) DEFAULT NULL,
  `representante_legal` varchar(255) DEFAULT NULL,
  `pais_procedencia` varchar(255) DEFAULT NULL,
  `otro_pais` varchar(255) DEFAULT NULL,
  `nacionalidad_solicitante` varchar(255) DEFAULT NULL,
  `pais_nacimiento` varchar(255) DEFAULT NULL,
  `otro_pais_nacimiento` varchar(255) DEFAULT NULL,
  `tipo_documento` varchar(255) DEFAULT NULL,
  `etnia_indigena` varchar(255) DEFAULT NULL,
  `otra_etnia` varchar(255) DEFAULT NULL,
  `discapacidad` varchar(255) DEFAULT NULL,
  `educacion` varchar(255) DEFAULT NULL,
  `nivel_educativo` varchar(255) DEFAULT NULL,
  `tipo_institucion` varchar(255) DEFAULT NULL,
  `servicio_brindado_cosude` text DEFAULT NULL,
  `servicio_brindado_unicef` text DEFAULT NULL,
  `estado_destino_id` bigint(20) UNSIGNED DEFAULT NULL,
  `municipio_destino_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parroquia_destino_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direccion_domicilio` varchar(255) DEFAULT NULL,
  `numero_contacto` varchar(255) DEFAULT NULL,
  `tipo_actuacion` varchar(255) DEFAULT NULL,
  `otro_tipo_actuacion` varchar(255) DEFAULT NULL,
  `vulnerabilidades` longtext DEFAULT NULL,
  `derechos_vulnerados` longtext DEFAULT NULL,
  `identificacion_violencia` longtext DEFAULT NULL,
  `tipos_violencia_vicaria` longtext DEFAULT NULL,
  `remisiones` longtext DEFAULT NULL,
  `otras_remisiones` varchar(255) DEFAULT NULL,
  `fotos` longtext DEFAULT NULL,
  `archivos` longtext DEFAULT NULL,
  `fecha_actual` date DEFAULT NULL,
  `estatus` varchar(255) DEFAULT NULL,
  `indicadores` text DEFAULT NULL,
  `observaciones` longtext DEFAULT NULL,
  `verificador` int(11) DEFAULT NULL,
  `condicion` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `casos`
--

INSERT INTO `casos` (`id`, `user_id`, `periodo`, `fecha_atencion`, `estado_id`, `municipio_id`, `parroquia_id`, `elaborado_por`, `numero_caso`, `organizacion_programa`, `organizacion_solicitante`, `otras_organizaciones`, `tipo_atencion_programa`, `tipo_atencion`, `beneficiario`, `estado_mujer`, `edad_beneficiario`, `poblacion_lgbti`, `acompanante`, `representante_legal`, `pais_procedencia`, `otro_pais`, `nacionalidad_solicitante`, `pais_nacimiento`, `otro_pais_nacimiento`, `tipo_documento`, `etnia_indigena`, `otra_etnia`, `discapacidad`, `educacion`, `nivel_educativo`, `tipo_institucion`, `servicio_brindado_cosude`, `servicio_brindado_unicef`, `estado_destino_id`, `municipio_destino_id`, `parroquia_destino_id`, `direccion_domicilio`, `numero_contacto`, `tipo_actuacion`, `otro_tipo_actuacion`, `vulnerabilidades`, `derechos_vulnerados`, `identificacion_violencia`, `tipos_violencia_vicaria`, `remisiones`, `otras_remisiones`, `fotos`, `archivos`, `fecha_actual`, `estatus`, `indicadores`, `observaciones`, `verificador`, `condicion`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:24:44', '2025-06-30 18:24:44'),
(2, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:24:55', '2025-06-30 18:24:55'),
(3, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:25:01', '2025-06-30 18:25:01'),
(4, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:25:01', '2025-06-30 18:25:01'),
(5, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:25:01', '2025-06-30 18:25:01'),
(6, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:25:02', '2025-06-30 18:25:02'),
(7, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:25:03', '2025-06-30 18:25:03'),
(8, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:25:04', '2025-06-30 18:25:04'),
(9, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:25:05', '2025-06-30 18:25:05'),
(10, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:25:10', '2025-06-30 18:25:10'),
(11, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:26:00', '2025-06-30 18:26:00'),
(12, 3, '2025-06', NULL, 20, 75, 37, 'monitoreonacional', 'RLF-TAC-001', NULL, NULL, NULL, NULL, 'Grupo familiar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', '[]', '2025-06-30', NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 18:26:38', '2025-06-30 18:26:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Amazonas', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(2, 'Anzoátegui', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(3, 'Apure', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(4, 'Aragua', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(5, 'Barinas', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(6, 'Bolívar', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(7, 'Carabobo', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(8, 'Cojedes', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(9, 'Delta Amacuro', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(10, 'Distrito Capital', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(11, 'Falcón', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(12, 'Guárico', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(13, 'Lara', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(14, 'Mérida', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(15, 'Miranda', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(16, 'Monagas', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(17, 'Nueva Esparta', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(18, 'Portuguesa', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(19, 'Sucre', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(20, 'Táchira', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(21, 'Trujillo', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(22, 'La Guaira', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(23, 'Yaracuy', '2025-06-30 01:51:55', '2025-06-30 01:51:55'),
(24, 'Zulia', '2025-06-30 01:51:55', '2025-06-30 01:51:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_06_16_175037_create_estados_table', 1),
(4, '2025_06_16_175037_create_municipios_table', 1),
(5, '2025_06_16_175037_create_parroquias_table', 1),
(6, '2025_06_16_175037_create_users_table', 1),
(7, '2025_06_16_175042_create_casos_table', 1),
(8, '2025_06_26_201303_create_permission_tables', 1),
(9, '2025_06_27_173033_create_activity_log_table', 1),
(10, '2025_06_27_173034_add_event_column_to_activity_log_table', 1),
(11, '2025_06_27_173035_add_batch_uuid_column_to_activity_log_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `estado_id`, `created_at`, `updated_at`) VALUES
(1, 'Atabapo', 1, NULL, NULL),
(2, 'Atures', 1, NULL, NULL),
(3, 'Autana', 1, NULL, NULL),
(4, 'Manapiare', 1, NULL, NULL),
(5, 'Maroa', 1, NULL, NULL),
(6, 'Río Negro', 1, NULL, NULL),
(7, 'Anaco', 2, NULL, NULL),
(8, 'Aragua', 2, NULL, NULL),
(9, 'Fernando de Peñalver', 2, NULL, NULL),
(10, 'Francisco de Miranda', 2, NULL, NULL),
(11, 'Francisco del Carmen Carvajal', 2, NULL, NULL),
(12, 'Guanta', 2, NULL, NULL),
(13, 'Independencia', 2, NULL, NULL),
(14, 'José Gregorio Monagas', 2, NULL, NULL),
(15, 'Juan Antonio Sotillo', 2, NULL, NULL),
(16, 'Juan Manuel Cajigal', 2, NULL, NULL),
(17, 'Libertad', 2, NULL, NULL),
(18, 'Manuel Ezequiel Bruzual', 2, NULL, NULL),
(19, 'Pedro María Freites', 2, NULL, NULL),
(20, 'Píritu', 2, NULL, NULL),
(21, 'San José de Guanipa', 2, NULL, NULL),
(22, 'San Juan de Capistrano', 2, NULL, NULL),
(23, 'Santa Ana', 2, NULL, NULL),
(24, 'Simón Bolívar', 2, NULL, NULL),
(25, 'Simón Rodríguez', 2, NULL, NULL),
(26, 'Achaguas', 3, NULL, NULL),
(27, 'Biruaca', 3, NULL, NULL),
(28, 'Muñoz', 3, NULL, NULL),
(29, 'Páez', 3, NULL, NULL),
(30, 'Pedro Camejo', 3, NULL, NULL),
(31, 'Rómulo Gallegos', 3, NULL, NULL),
(32, 'San Fernando', 3, NULL, NULL),
(33, 'Bolívar', 4, NULL, NULL),
(34, 'Camatagua', 4, NULL, NULL),
(35, 'Francisco Linares Alcántara', 4, NULL, NULL),
(36, 'Girardot', 4, NULL, NULL),
(37, 'José Ángel Lamas', 4, NULL, NULL),
(38, 'José Félix Ribas', 4, NULL, NULL),
(39, 'José Rafael Revenga', 4, NULL, NULL),
(40, 'Libertador', 4, NULL, NULL),
(41, 'Mario Briceño Iragorry', 4, NULL, NULL),
(42, 'Ocumare de la Costa de Oro', 4, NULL, NULL),
(43, 'San Casimiro', 4, NULL, NULL),
(44, 'San Sebastián', 4, NULL, NULL),
(45, 'Santiago Mariño', 4, NULL, NULL),
(46, 'Santos Michelena', 4, NULL, NULL),
(47, 'Sucre', 4, NULL, NULL),
(48, 'Tovar', 4, NULL, NULL),
(49, 'Urdaneta', 4, NULL, NULL),
(50, 'Zamora', 4, NULL, NULL),
(51, 'Alberto Arvelo Torrealba', 5, NULL, NULL),
(52, 'Andrés Eloy Blanco', 5, NULL, NULL),
(53, 'Antonio José de Sucre', 5, NULL, NULL),
(54, 'Arismendi', 5, NULL, NULL),
(55, 'Barinas', 5, NULL, NULL),
(56, 'Bolívar', 5, NULL, NULL),
(57, 'Cruz Paredes', 5, NULL, NULL),
(58, 'Ezequiel Zamora', 5, NULL, NULL),
(59, 'Obispos', 5, NULL, NULL),
(60, 'Pedraza', 5, NULL, NULL),
(61, 'Rojas', 5, NULL, NULL),
(62, 'Sosa', 5, NULL, NULL),
(63, 'Andrés Bello', 20, NULL, NULL),
(64, 'Antonio Rómulo Costa', 20, NULL, NULL),
(65, 'Ayacucho', 20, NULL, NULL),
(66, 'Bolívar', 20, NULL, NULL),
(67, 'Cárdenas', 20, NULL, NULL),
(68, 'Córdoba', 20, NULL, NULL),
(69, 'Fernández Feo', 20, NULL, NULL),
(70, 'Francisco de Miranda', 20, NULL, NULL),
(71, 'García de Hevia', 20, NULL, NULL),
(72, 'Guásimos', 20, NULL, NULL),
(73, 'Independencia', 20, NULL, NULL),
(74, 'Jáuregui', 20, NULL, NULL),
(75, 'José María Vargas', 20, NULL, NULL),
(76, 'Junín', 20, NULL, NULL),
(77, 'Libertad', 20, NULL, NULL),
(78, 'Libertador', 20, NULL, NULL),
(79, 'Lobatera', 20, NULL, NULL),
(80, 'Michelena', 20, NULL, NULL),
(81, 'Panamericano', 20, NULL, NULL),
(82, 'Pedro María Ureña', 20, NULL, NULL),
(83, 'Rafael Urdaneta', 20, NULL, NULL),
(84, 'Samuel Darío Maldonado', 20, NULL, NULL),
(85, 'San Cristóbal', 20, NULL, NULL),
(86, 'Seboruco', 20, NULL, NULL),
(87, 'Simón Rodríguez', 20, NULL, NULL),
(88, 'Sucre', 20, NULL, NULL),
(89, 'Torbes', 20, NULL, NULL),
(90, 'Uribante', 20, NULL, NULL),
(91, 'San Judas Tadeo', 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `municipio_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parroquias`
--

INSERT INTO `parroquias` (`id`, `nombre`, `municipio_id`, `created_at`, `updated_at`) VALUES
(1, 'San Fernando de Atabapo', 1, NULL, NULL),
(2, 'Ucata', 1, NULL, NULL),
(3, 'Yapacana', 1, NULL, NULL),
(4, 'Luis Alberto Gómez', 2, NULL, NULL),
(5, 'Parhueña', 2, NULL, NULL),
(6, 'San José de Maipures', 2, NULL, NULL),
(7, 'Virgen del Carmen', 2, NULL, NULL),
(8, 'Sipapo', 3, NULL, NULL),
(9, 'Munduapo', 3, NULL, NULL),
(10, 'Guayapo', 3, NULL, NULL),
(11, 'Alto Ventuari', 4, NULL, NULL),
(12, 'Medio Ventuari', 4, NULL, NULL),
(13, 'Bajo Ventuari', 4, NULL, NULL),
(14, 'Victorino', 5, NULL, NULL),
(15, 'Casiquiare', 5, NULL, NULL),
(16, 'La Palmita', 63, NULL, NULL),
(17, 'Las Mesas', 64, NULL, NULL),
(18, 'Colón', 65, NULL, NULL),
(19, 'Rivas Berti', 65, NULL, NULL),
(20, 'San Pedro del Río', 65, NULL, NULL),
(21, 'San Antonio del Táchira', 66, NULL, NULL),
(22, 'Isaías Medina Angarita', 66, NULL, NULL),
(23, 'Amenodoro Rangel Lamus', 67, NULL, NULL),
(24, 'La Florida', 67, NULL, NULL),
(25, 'Táriba', 67, NULL, NULL),
(26, 'Santa Ana', 68, NULL, NULL),
(27, 'Alberto Adriani', 69, NULL, NULL),
(28, 'Santo Domingo', 69, NULL, NULL),
(29, 'San Rafael de El Piñal', 69, NULL, NULL),
(30, 'San José de Bolívar', 70, NULL, NULL),
(31, 'Boca de Grita', 71, NULL, NULL),
(32, 'José Antonio Páez', 71, NULL, NULL),
(33, 'La Fría', 71, NULL, NULL),
(34, 'Palmira', 72, NULL, NULL),
(35, 'Capacho Nuevo', 73, NULL, NULL),
(36, 'La Grita', 74, NULL, NULL),
(37, 'El Cobre', 75, NULL, NULL),
(38, 'Rubio', 76, NULL, NULL),
(39, 'Bramón', 76, NULL, NULL),
(40, 'Capacho Viejo', 77, NULL, NULL),
(41, 'Abejales', 78, NULL, NULL),
(42, 'Lobatera', 79, NULL, NULL),
(43, 'Constitución', 79, NULL, NULL),
(44, 'Michelena', 80, NULL, NULL),
(45, 'Coloncito', 81, NULL, NULL),
(46, 'Ureña', 82, NULL, NULL),
(47, 'Delicias', 83, NULL, NULL),
(48, 'La Tendida', 84, NULL, NULL),
(49, 'La Concordia', 85, NULL, NULL),
(50, 'San Juan Bautista', 85, NULL, NULL),
(51, 'Pedro María Morantes', 85, NULL, NULL),
(52, 'San Sebastián', 85, NULL, NULL),
(53, 'Francisco Romero Lobo', 85, NULL, NULL),
(54, 'Seboruco', 86, NULL, NULL),
(55, 'San Simón', 87, NULL, NULL),
(56, 'Queniquea', 88, NULL, NULL),
(57, 'San Josecito', 89, NULL, NULL),
(58, 'Pregonero', 90, NULL, NULL),
(59, 'Umuquena', 91, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(2, 'dashboard-user', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(3, 'Gestion casos', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(4, 'crear casos', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(5, 'ver casos', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(6, 'editar casos', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(7, 'eliminar casos', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(8, 'Gestion roles', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(9, 'ver roles', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(10, 'editar roles', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(11, 'crear roles', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(12, 'eliminar roles', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(13, 'Gestion usuarios', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(14, 'ver usuarios', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(15, 'editar usuarios', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(16, 'crear usuarios', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(17, 'eliminar usuarios', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(18, 'Gestion permisos', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(19, 'Gestion configuracion', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(20, 'ver bitacora', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(21, 'cierre atencion', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(22, 'ver casos eliminados', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(23, 'restaurar casos eliminados', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54'),
(2, 'Usuario', 'web', '2025-06-30 01:51:54', '2025-06-30 01:51:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4VUTTdssEAyN13pq3oHlOf6RYiZnyTZJdZpend7n', 4, '38.248.175.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM0tmVmd5UGRkZElJV254dDVQaWZnVzYzMzN5cDZsV29XRWxETGVwdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vc2lzdGVtYS50b2RheS9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1751309167),
('9fo0zQCgY3uaCbgGvrFmNXg9seWGRG4aewZTGEXF', NULL, '66.249.68.69', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWhoZnc0ZzFSTmNxMVBEczBuYzJPaVd5ZEpWMVI1V3B4WTRMWTBqSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9zaXN0ZW1hLnRvZGF5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1751346947),
('ER0x4ZXRGJgoMivzUybZ0Q0BQpE1iLr6dyfrsCVb', NULL, '66.249.68.65', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.7151.103 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUxLcGNrS0s5ejBsZmRZMHprWXNQdTFJSGpnUURSbFNobEF2OEJUcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vc2lzdGVtYS50b2RheSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751344411),
('F9sJmPzHPZIeNhF4Lo9BlAkbaWczLUyxAGBEIdns', NULL, '5.255.231.42', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGt4S1Qzb1JhbVFWOFJLU3JXMnhjamFNOXdFN05Bc2pyakVwNXdLOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9zaXN0ZW1hLnRvZGF5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1751371062),
('hQ4YSXE8PgCAr1JAYNbQ23SVYinaIVRIb4O8NPYz', NULL, '66.249.79.70', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.7151.103 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUw0bHVDcE1sS0MxSXZCd3VJODU0cEoydkhBenF3RFFJdGV6WExMeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly93d3cuc2lzdGVtYS50b2RheSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751344952),
('iiatuW5aewCLG4se7cVmmkGVqZx6f0qvA7CgFhW4', NULL, '66.249.68.69', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZU1yRGRDbk00ZlZhREhUSVFWSlNqbnNSVTA2aERrWk9hYWZYV24xbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9zaXN0ZW1hLnRvZGF5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1751346948),
('Jl8RKiFftCr51w0TNsUACJdbwyeVIsxIUTlsYcON', 4, '38.248.175.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSDhTQU9YR0dXc1ZSRGZ4alZ2aHNjM0dJVG1iS3JIbnZKbFN4UzJJdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vc2lzdGVtYS50b2RheS9jYXNvcy8xMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1751309483),
('NCsiRsKcm7blR4DvOb2F5SZtHQ6p966VgHjEv6hP', NULL, '66.249.68.65', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialMzNEZyRGY1TnBXM2gzUFpqYnBZM3JNYmx3NEh2YWlKRVlHZzVFdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vc2lzdGVtYS50b2RheSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751349041),
('p4x9dgxCL3XRbZne6oNq5CE2BQXhM2a5Jf5nfoLs', NULL, '66.249.79.76', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.7151.103 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnNDd2NacmFVeVNBWUxiVDd4MUhHU1hLVmlPeXBZNkZCVEpSd0JZeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vd3d3LnNpc3RlbWEudG9kYXkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751350106),
('sCv7gMcpYXbIgF4vINAmQxnjjR2RFkl1IFdWhQzQ', NULL, '2a02:6ea0:c041:2384::11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0RMeTlXbWhvNjR5N2JIY3lPc1RqRjJFd2U3S3RnQ2lVdkJscks0ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vc2lzdGVtYS50b2RheSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751373396),
('SjFzuFfAaL5r50v9ENunyYCGzTHHLhpBgXKeGYvh', NULL, '66.249.79.70', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.7151.103 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2pIRU1Xd29HUTk1cWlrSUE3MFVLNm53TTk1Q2Qzc05JVkpieG1seiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly93d3cuc2lzdGVtYS50b2RheS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751360668),
('tE77kg9rwqwfZrCOdWXuaBc8zpHfQ2Iuet4BFEOH', 1, '149.40.62.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRU5XUnM2N2xjZW9GaW5HMTdJdmxKOXdXc2ZZS0FkUXMxODBNVEg4MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vc2lzdGVtYS50b2RheS91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1751309356),
('v1P4Q8VCvdzhMsiv9FeAs5J0oAkS4aEUg4pBSKJs', NULL, '66.249.68.71', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia2RoZzY5THdwakF6THdxSERSVjNQUUNXSnpHQXE0cjgxRWxkbThBSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vc2lzdGVtYS50b2RheSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751349041),
('Vr8OmK1uTnBFqJocdaCcIAkX8Nq6a3w1ywvpX9sn', 3, '38.248.175.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWXZGQlB4d0EyaUQ2NUl3RzR4ZXEySDRnRWVINzdZaVNqMXRiekxTNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vc2lzdGVtYS50b2RheS9jYXNvcy9jb250YWRvci1lc3RhZG8vMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1751308046),
('z4O2Av8ByG5FquwhiZzsezp0LbLijNTSZ5L12TYQ', NULL, '66.249.68.70', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.7151.103 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzBIcGFQMFE2WXlPWUhQM1ViRUxkd2FGbTRSdWNTZlZNc2QxUXhrSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9zaXN0ZW1hLnRvZGF5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1751339010);

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
(1, 'Zenen Peraza', 'peraza@outlook.com', '$2y$12$96LCvmhtsVSmUYmhQ2QTQeorbsVr2HWQAuBQhY.c8ZjagNYH57/s2', NULL, '0000000000', 'Dirección Central', 'usuarios/OXstj3SNLROQqXJl3NJig0Hnaq3RYnZksM3X0BWM.png', 'activo', '2025-06-30 01:51:54', '2025-06-30 05:17:37'),
(3, 'monitoreonacional', 'mmelendez@asonacop.org', '$2y$12$h7UDxzcvtGtDfRiotJsYQulO90dkZ2K3e5oufh5ti2k6msB63NBoi', NULL, NULL, NULL, NULL, 'activo', '2025-06-30 18:22:02', '2025-06-30 18:22:02'),
(4, 'Danny', 'dannyprimera@gmail.com', '$2y$12$BF30tYqbYstWE2fD6sBRQemIED.GN9o9VcGys8YscDHfZXqMeBnhO', NULL, NULL, NULL, NULL, 'activo', '2025-06-30 18:46:07', '2025-06-30 18:46:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `casos`
--
ALTER TABLE `casos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `casos_user_id_foreign` (`user_id`),
  ADD KEY `casos_estado_id_foreign` (`estado_id`),
  ADD KEY `casos_municipio_id_foreign` (`municipio_id`),
  ADD KEY `casos_parroquia_id_foreign` (`parroquia_id`),
  ADD KEY `casos_estado_destino_id_foreign` (`estado_destino_id`),
  ADD KEY `casos_municipio_destino_id_foreign` (`municipio_destino_id`),
  ADD KEY `casos_parroquia_destino_id_foreign` (`parroquia_destino_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipios_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parroquias_municipio_id_foreign` (`municipio_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT de la tabla `casos`
--
ALTER TABLE `casos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `casos`
--
ALTER TABLE `casos`
  ADD CONSTRAINT `casos_estado_destino_id_foreign` FOREIGN KEY (`estado_destino_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `casos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `casos_municipio_destino_id_foreign` FOREIGN KEY (`municipio_destino_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `casos_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `casos_parroquia_destino_id_foreign` FOREIGN KEY (`parroquia_destino_id`) REFERENCES `parroquias` (`id`),
  ADD CONSTRAINT `casos_parroquia_id_foreign` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquias` (`id`),
  ADD CONSTRAINT `casos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD CONSTRAINT `parroquias_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
