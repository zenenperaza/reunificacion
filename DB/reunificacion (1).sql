-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2025 a las 15:08:47
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
-- Base de datos: `reunificacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('atencion_programa_rlf_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:25:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"Dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:14:\"dashboard-user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:13:\"Gestion casos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"crear casos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:9:\"ver casos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"editar casos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"eliminar casos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:13:\"aprobar casos\";s:1:\"c\";s:3:\"web\";}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"clonar casos\";s:1:\"c\";s:3:\"web\";}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"cierre atencion\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:13:\"Gestion roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:9:\"ver roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"editar roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:11:\"crear roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:14:\"eliminar roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:16:\"Gestion usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:12:\"ver usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:15:\"editar usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:14:\"crear usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:17:\"eliminar usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:16:\"Gestion permisos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:21:\"Gestion configuracion\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"ver bitacora\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:20:\"ver casos eliminados\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:26:\"restaurar casos eliminados\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"Administrador\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"Usuario\";s:1:\"c\";s:3:\"web\";}}}', 1751460446);

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
(1, 'Amazonas', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(2, 'Anzoátegui', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(3, 'Apure', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(4, 'Aragua', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(5, 'Barinas', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(6, 'Bolívar', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(7, 'Carabobo', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(8, 'Cojedes', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(9, 'Delta Amacuro', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(10, 'Distrito Capital', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(11, 'Falcón', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(12, 'Guárico', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(13, 'Lara', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(14, 'Mérida', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(15, 'Miranda', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(16, 'Monagas', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(17, 'Nueva Esparta', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(18, 'Portuguesa', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(19, 'Sucre', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(20, 'Táchira', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(21, 'Trujillo', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(22, 'La Guaira', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(23, 'Yaracuy', '2025-07-01 16:42:34', '2025-07-01 16:42:34'),
(24, 'Zulia', '2025-07-01 16:42:34', '2025-07-01 16:42:34');

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
(1, 'App\\Models\\User', 2);

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
(3, 'Alto Orinoco', 1, NULL, NULL),
(4, 'Autana', 1, NULL, NULL),
(5, 'Manapiare', 1, NULL, NULL),
(6, 'Maroa', 1, NULL, NULL),
(7, 'Río Negro', 1, NULL, NULL),
(8, 'Anaco', 2, NULL, NULL),
(9, 'Aragua', 2, NULL, NULL),
(10, 'Diego Bautista Urbaneja', 2, NULL, NULL),
(11, 'Fernando de Peñalver', 2, NULL, NULL),
(12, 'Francisco de Miranda', 2, NULL, NULL),
(13, 'Francisco del Carmen Carvajal', 2, NULL, NULL),
(14, 'Guanta', 2, NULL, NULL),
(15, 'Independencia', 2, NULL, NULL),
(16, 'José Gregorio Monagas', 2, NULL, NULL),
(17, 'Juan Antonio Sotillo', 2, NULL, NULL),
(18, 'Juan Manuel Cajigal', 2, NULL, NULL),
(19, 'Libertad', 2, NULL, NULL),
(20, 'Manuel Ezequiel Bruzual', 2, NULL, NULL),
(21, 'Pedro María Freites', 2, NULL, NULL),
(22, 'Píritu', 2, NULL, NULL),
(23, 'San José de Guanipa', 2, NULL, NULL),
(24, 'San Juan de Capistrano', 2, NULL, NULL),
(25, 'Santa Ana', 2, NULL, NULL),
(26, 'Simón Bolívar', 2, NULL, NULL),
(27, 'Simón Rodríguez', 2, NULL, NULL),
(28, 'Sotillo', 2, NULL, NULL),
(29, 'Achaguas', 3, NULL, NULL),
(30, 'Biruaca', 3, NULL, NULL),
(31, 'Muñoz', 3, NULL, NULL),
(32, 'Páez', 3, NULL, NULL),
(33, 'Pedro Camejo', 3, NULL, NULL),
(34, 'Rómulo Gallegos', 3, NULL, NULL),
(35, 'San Fernando', 3, NULL, NULL),
(36, 'Bolívar', 4, NULL, NULL),
(37, 'Camatagua', 4, NULL, NULL),
(38, 'Francisco Linares Alcántara', 4, NULL, NULL),
(39, 'Girardot', 4, NULL, NULL),
(40, 'José Ángel Lamas', 4, NULL, NULL),
(41, 'José Félix Ribas', 4, NULL, NULL),
(42, 'José Rafael Revenga', 4, NULL, NULL),
(43, 'Libertador', 4, NULL, NULL),
(44, 'Mario Briceño Iragorry', 4, NULL, NULL),
(45, 'Ocumare de la Costa de Oro', 4, NULL, NULL),
(46, 'San Casimiro', 4, NULL, NULL),
(47, 'San Sebastián', 4, NULL, NULL),
(48, 'Santiago Mariño', 4, NULL, NULL),
(49, 'Santos Michelena', 4, NULL, NULL),
(50, 'Sucre', 4, NULL, NULL),
(51, 'Tovar', 4, NULL, NULL),
(52, 'Urdaneta', 4, NULL, NULL),
(53, 'Zamora', 4, NULL, NULL),
(54, 'Alberto Arvelo Torrealba', 5, NULL, NULL),
(55, 'Andrés Eloy Blanco', 5, NULL, NULL),
(56, 'Antonio José de Sucre', 5, NULL, NULL),
(57, 'Arismendi', 5, NULL, NULL),
(58, 'Barinas', 5, NULL, NULL),
(59, 'Bolívar', 5, NULL, NULL),
(60, 'Cruz Paredes', 5, NULL, NULL),
(61, 'Ezequiel Zamora', 5, NULL, NULL),
(62, 'Obispos', 5, NULL, NULL),
(63, 'Pedraza', 5, NULL, NULL),
(64, 'Rojas', 5, NULL, NULL),
(65, 'Sosa', 5, NULL, NULL),
(66, 'José Antonio Páez', 5, NULL, NULL),
(67, 'Caroní', 6, NULL, NULL),
(68, 'Cedeño', 6, NULL, NULL),
(69, 'El Callao', 6, NULL, NULL),
(70, 'Gran Sabana', 6, NULL, NULL),
(71, 'Heres', 6, NULL, NULL),
(72, 'Piar', 6, NULL, NULL),
(73, 'Raúl Leoni', 6, NULL, NULL),
(74, 'Roscio', 6, NULL, NULL),
(75, 'Sifontes', 6, NULL, NULL),
(76, 'Sucre', 6, NULL, NULL),
(77, 'Padre Pedro Chien', 6, NULL, NULL),
(78, 'Bejuma', 7, NULL, NULL),
(79, 'Carlos Arvelo', 7, NULL, NULL),
(80, 'Diego Ibarra', 7, NULL, NULL),
(81, 'Guacara', 7, NULL, NULL),
(82, 'Juan José Mora', 7, NULL, NULL),
(83, 'Libertador', 7, NULL, NULL),
(84, 'Los Guayos', 7, NULL, NULL),
(85, 'Miranda', 7, NULL, NULL),
(86, 'Montalbán', 7, NULL, NULL),
(87, 'Naguanagua', 7, NULL, NULL),
(88, 'Puerto Cabello', 7, NULL, NULL),
(89, 'San Diego', 7, NULL, NULL),
(90, 'San Joaquín', 7, NULL, NULL),
(91, 'Valencia', 7, NULL, NULL),
(92, 'Anzoátegui', 8, NULL, NULL),
(93, 'Falcón', 8, NULL, NULL),
(94, 'Girardot', 8, NULL, NULL),
(95, 'Lima Blanco', 8, NULL, NULL),
(96, 'Pao de San Juan Bautista', 8, NULL, NULL),
(97, 'Ricaurte', 8, NULL, NULL),
(98, 'Rómulo Gallegos', 8, NULL, NULL),
(99, 'San Carlos', 8, NULL, NULL),
(100, 'Tinaco', 8, NULL, NULL),
(101, 'Antonio Díaz', 9, NULL, NULL),
(102, 'Casacoima', 9, NULL, NULL),
(103, 'Pedernales', 9, NULL, NULL),
(104, 'Tucupita', 9, NULL, NULL),
(105, 'Libertador', 10, NULL, NULL),
(106, 'Acosta', 11, NULL, NULL),
(107, 'Bolívar', 11, NULL, NULL),
(108, 'Buchivacoa', 11, NULL, NULL),
(109, 'Cacique Manaure', 11, NULL, NULL),
(110, 'Carirubana', 11, NULL, NULL),
(111, 'Colina', 11, NULL, NULL),
(112, 'Dabajuro', 11, NULL, NULL),
(113, 'Democracia', 11, NULL, NULL),
(114, 'Falcón', 11, NULL, NULL),
(115, 'Federación', 11, NULL, NULL),
(116, 'Jacura', 11, NULL, NULL),
(117, 'Los Taques', 11, NULL, NULL),
(118, 'Mauroa', 11, NULL, NULL),
(119, 'Miranda', 11, NULL, NULL),
(120, 'Monseñor Iturriza', 11, NULL, NULL),
(121, 'Palmasola', 11, NULL, NULL),
(122, 'Petit', 11, NULL, NULL),
(123, 'Píritu', 11, NULL, NULL),
(124, 'San Francisco', 11, NULL, NULL),
(125, 'Silva', 11, NULL, NULL),
(126, 'Sucre', 11, NULL, NULL),
(127, 'Tocópero', 11, NULL, NULL),
(128, 'Unión', 11, NULL, NULL),
(129, 'Urumaco', 11, NULL, NULL),
(130, 'Zamora', 11, NULL, NULL),
(131, 'Camaguán', 12, NULL, NULL),
(132, 'Chaguaramas', 12, NULL, NULL),
(133, 'El Socorro', 12, NULL, NULL),
(134, 'Francisco de Miranda', 12, NULL, NULL),
(135, 'José Félix Ribas', 12, NULL, NULL),
(136, 'José Tadeo Monagas', 12, NULL, NULL),
(137, 'Juan Germán Roscio', 12, NULL, NULL),
(138, 'Julián Mellado', 12, NULL, NULL),
(139, 'Las Mercedes', 12, NULL, NULL),
(140, 'Leonardo Infante', 12, NULL, NULL),
(141, 'Pedro Zaraza', 12, NULL, NULL),
(142, 'Ortíz', 12, NULL, NULL),
(143, 'San Gerónimo de Guayabal', 12, NULL, NULL),
(144, 'San José de Guaribe', 12, NULL, NULL),
(145, 'Santa María de Ipire', 12, NULL, NULL),
(146, 'Sebastián Francisco de Miranda', 12, NULL, NULL),
(147, 'Andrés Eloy Blanco', 13, NULL, NULL),
(148, 'Crespo', 13, NULL, NULL),
(149, 'Iribarren', 13, NULL, NULL),
(150, 'Jiménez', 13, NULL, NULL),
(151, 'Morán', 13, NULL, NULL),
(152, 'Palavecino', 13, NULL, NULL),
(153, 'Simón Planas', 13, NULL, NULL),
(154, 'Torres', 13, NULL, NULL),
(155, 'Urdaneta', 13, NULL, NULL),
(156, 'Alberto Adriani', 14, NULL, NULL),
(157, 'Andrés Bello', 14, NULL, NULL),
(158, 'Antonio Pinto Salinas', 14, NULL, NULL),
(159, 'Aricagua', 14, NULL, NULL),
(160, 'Arzobispo Chacón', 14, NULL, NULL),
(161, 'Campo Elías', 14, NULL, NULL),
(162, 'Caracciolo Parra Olmedo', 14, NULL, NULL),
(163, 'Cardenal Quintero', 14, NULL, NULL),
(164, 'Guaraque', 14, NULL, NULL),
(165, 'Julio César Salas', 14, NULL, NULL),
(166, 'Justo Briceño', 14, NULL, NULL),
(167, 'Libertador', 14, NULL, NULL),
(168, 'Miranda', 14, NULL, NULL),
(169, 'Obispo Ramos de Lora', 14, NULL, NULL),
(170, 'Padre Noguera', 14, NULL, NULL),
(171, 'Pueblo Llano', 14, NULL, NULL),
(172, 'Rangel', 14, NULL, NULL),
(173, 'Rivas Dávila', 14, NULL, NULL),
(174, 'Santos Marquina', 14, NULL, NULL),
(175, 'Sucre', 14, NULL, NULL),
(176, 'Tovar', 14, NULL, NULL),
(177, 'Tulio Febres Cordero', 14, NULL, NULL),
(178, 'Zea', 14, NULL, NULL),
(179, 'Acevedo', 15, NULL, NULL),
(180, 'Andrés Bello', 15, NULL, NULL),
(181, 'Baruta', 15, NULL, NULL),
(182, 'Brión', 15, NULL, NULL),
(183, 'Buroz', 15, NULL, NULL),
(184, 'Carrizal', 15, NULL, NULL),
(185, 'Chacao', 15, NULL, NULL),
(186, 'Cristóbal Rojas', 15, NULL, NULL),
(187, 'El Hatillo', 15, NULL, NULL),
(188, 'Guaicaipuro', 15, NULL, NULL),
(189, 'Independencia', 15, NULL, NULL),
(190, 'Lander', 15, NULL, NULL),
(191, 'Los Salias', 15, NULL, NULL),
(192, 'Páez', 15, NULL, NULL),
(193, 'Paz Castillo', 15, NULL, NULL),
(194, 'Pedro Gual', 15, NULL, NULL),
(195, 'Plaza', 15, NULL, NULL),
(196, 'Simón Bolívar', 15, NULL, NULL),
(197, 'Sucre', 15, NULL, NULL),
(198, 'Urdaneta', 15, NULL, NULL),
(199, 'Zamora', 15, NULL, NULL),
(200, 'Acosta', 16, NULL, NULL),
(201, 'Aguasay', 16, NULL, NULL),
(202, 'Bolívar', 16, NULL, NULL),
(203, 'Caripe', 16, NULL, NULL),
(204, 'Cedeño', 16, NULL, NULL),
(205, 'Ezequiel Zamora', 16, NULL, NULL),
(206, 'Libertador', 16, NULL, NULL),
(207, 'Maturín', 16, NULL, NULL),
(208, 'Piar', 16, NULL, NULL),
(209, 'Punceres', 16, NULL, NULL),
(210, 'Santa Bárbara', 16, NULL, NULL),
(211, 'Sotillo', 16, NULL, NULL),
(212, 'Uracoa', 16, NULL, NULL),
(213, 'Antolín del Campo', 17, NULL, NULL),
(214, 'Arismendi', 17, NULL, NULL),
(215, 'Díaz', 17, NULL, NULL),
(216, 'García', 17, NULL, NULL),
(217, 'Gómez', 17, NULL, NULL),
(218, 'Maneiro', 17, NULL, NULL),
(219, 'Marcano', 17, NULL, NULL),
(220, 'Mariño', 17, NULL, NULL),
(221, 'Peninsula de Macanao', 17, NULL, NULL),
(222, 'Tubores', 17, NULL, NULL),
(223, 'Villalba', 17, NULL, NULL),
(224, 'Agua Blanca', 18, NULL, NULL),
(225, 'Araure', 18, NULL, NULL),
(226, 'Esteller', 18, NULL, NULL),
(227, 'Guanare', 18, NULL, NULL),
(228, 'Guanarito', 18, NULL, NULL),
(229, 'Monseñor José Vicente de Unda', 18, NULL, NULL),
(230, 'Ospino', 18, NULL, NULL),
(231, 'Páez', 18, NULL, NULL),
(232, 'Papelón', 18, NULL, NULL),
(233, 'San Genaro de Boconoíto', 18, NULL, NULL),
(234, 'San Rafael de Onoto', 18, NULL, NULL),
(235, 'Santa Rosalía', 18, NULL, NULL),
(236, 'Sucre', 18, NULL, NULL),
(237, 'Turén', 18, NULL, NULL),
(238, 'Andrés Eloy Blanco', 19, NULL, NULL),
(239, 'Andrés Mata', 19, NULL, NULL),
(240, 'Arismendi', 19, NULL, NULL),
(241, 'Benítez', 19, NULL, NULL),
(242, 'Bermúdez', 19, NULL, NULL),
(243, 'Bolívar', 19, NULL, NULL),
(244, 'Cajigal', 19, NULL, NULL),
(245, 'Cruz Salmerón Acosta', 19, NULL, NULL),
(246, 'Libertador', 19, NULL, NULL),
(247, 'Mariño', 19, NULL, NULL),
(248, 'Mejía', 19, NULL, NULL),
(249, 'Montes', 19, NULL, NULL),
(250, 'Ribero', 19, NULL, NULL),
(251, 'Sucre', 19, NULL, NULL),
(252, 'Valdez', 19, NULL, NULL),
(253, 'Andrés Bello', 20, NULL, NULL),
(254, 'Antonio Rómulo Costa', 20, NULL, NULL),
(255, 'Ayacucho', 20, NULL, NULL),
(256, 'Bolívar', 20, NULL, NULL),
(257, 'Cárdenas', 20, NULL, NULL),
(258, 'Córdoba', 20, NULL, NULL),
(259, 'Fernández Feo', 20, NULL, NULL),
(260, 'Francisco de Miranda', 20, NULL, NULL),
(261, 'García de Hevia', 20, NULL, NULL),
(262, 'Guásimos', 20, NULL, NULL),
(263, 'Independencia', 20, NULL, NULL),
(264, 'Jáuregui', 20, NULL, NULL),
(265, 'José María Vargas', 20, NULL, NULL),
(266, 'Junín', 20, NULL, NULL),
(267, 'Libertad', 20, NULL, NULL),
(268, 'Libertador', 20, NULL, NULL),
(269, 'Lobatera', 20, NULL, NULL),
(270, 'Michelena', 20, NULL, NULL),
(271, 'Panamericano', 20, NULL, NULL),
(272, 'Pedro María Ureña', 20, NULL, NULL),
(273, 'Rafael Urdaneta', 20, NULL, NULL),
(274, 'Samuel Darío Maldonado', 20, NULL, NULL),
(275, 'San Cristóbal', 20, NULL, NULL),
(276, 'Seboruco', 20, NULL, NULL),
(277, 'Simón Rodríguez', 20, NULL, NULL),
(278, 'Sucre', 20, NULL, NULL),
(279, 'Torbes', 20, NULL, NULL),
(280, 'Uribante', 20, NULL, NULL),
(281, 'San Judas Tadeo', 20, NULL, NULL),
(282, 'Andrés Bello', 21, NULL, NULL),
(283, 'Boconó', 21, NULL, NULL),
(284, 'Bolívar', 21, NULL, NULL),
(285, 'Candelaria', 21, NULL, NULL),
(286, 'Carache', 21, NULL, NULL),
(287, 'Escuque', 21, NULL, NULL),
(288, 'José Felipe Márquez Cañizales', 21, NULL, NULL),
(289, 'Juan Vicente Campo Elías', 21, NULL, NULL),
(290, 'La Ceiba', 21, NULL, NULL),
(291, 'Miranda', 21, NULL, NULL),
(292, 'Monte Carmelo', 21, NULL, NULL),
(293, 'Motatán', 21, NULL, NULL),
(294, 'Pampán', 21, NULL, NULL),
(295, 'Pampanito', 21, NULL, NULL),
(296, 'Rafael Rangel', 21, NULL, NULL),
(297, 'San Rafael de Carvajal', 21, NULL, NULL),
(298, 'Sucre', 21, NULL, NULL),
(299, 'Trujillo', 21, NULL, NULL),
(300, 'Urdaneta', 21, NULL, NULL),
(301, 'Valera', 21, NULL, NULL),
(302, 'Vargas', 22, NULL, NULL),
(303, 'Arístides Bastidas', 23, NULL, NULL),
(304, 'Bolívar', 23, NULL, NULL),
(305, 'Bruzual', 23, NULL, NULL),
(306, 'Cocorote', 23, NULL, NULL),
(307, 'Independencia', 23, NULL, NULL),
(308, 'José Antonio Páez', 23, NULL, NULL),
(309, 'La Trinidad', 23, NULL, NULL),
(310, 'Manuel Monge', 23, NULL, NULL),
(311, 'Nirgua', 23, NULL, NULL),
(312, 'Peña', 23, NULL, NULL),
(313, 'San Felipe', 23, NULL, NULL),
(314, 'Sucre', 23, NULL, NULL),
(315, 'Urachiche', 23, NULL, NULL),
(316, 'Veroes', 23, NULL, NULL),
(317, 'Almirante Padilla', 24, NULL, NULL),
(318, 'Baralt', 24, NULL, NULL),
(319, 'Cabimas', 24, NULL, NULL),
(320, 'Catatumbo', 24, NULL, NULL),
(321, 'Colón', 24, NULL, NULL),
(322, 'Francisco Javier Pulgar', 24, NULL, NULL),
(323, 'Guajira', 24, NULL, NULL),
(324, 'Jesús Enrique Lossada', 24, NULL, NULL),
(325, 'Jesús María Semprún', 24, NULL, NULL),
(326, 'La Cañada de Urdaneta', 24, NULL, NULL),
(327, 'Lagunillas', 24, NULL, NULL),
(328, 'Machiques de Perijá', 24, NULL, NULL),
(329, 'Mara', 24, NULL, NULL),
(330, 'Maracaibo', 24, NULL, NULL),
(331, 'Miranda', 24, NULL, NULL),
(332, 'Rosario de Perijá', 24, NULL, NULL),
(333, 'San Francisco', 24, NULL, NULL),
(334, 'Santa Rita', 24, NULL, NULL),
(335, 'Simón Bolívar', 24, NULL, NULL),
(336, 'Sucre', 24, NULL, NULL),
(337, 'Valmore Rodríguez', 24, NULL, NULL);

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
(1, 'Atabapo', 1, NULL, NULL),
(2, 'San Fernando de Atabapo', 1, NULL, NULL),
(3, 'Ucata', 1, NULL, NULL),
(4, 'Yapacana', 1, NULL, NULL),
(5, 'Caname', 1, NULL, NULL),
(6, 'Fernando Girón Tovar', 2, NULL, NULL),
(7, 'Luis Alberto Gómez', 2, NULL, NULL),
(8, 'Parhueña', 2, NULL, NULL),
(9, 'Platanillal', 2, NULL, NULL),
(10, 'La Esmeralda', 3, NULL, NULL),
(11, 'Marawaka', 3, NULL, NULL),
(12, 'Mavaca', 3, NULL, NULL),
(13, 'Sierra Parima', 3, NULL, NULL),
(14, 'Samariapo', 4, NULL, NULL),
(15, 'Sipapo', 4, NULL, NULL),
(16, 'Munduapo', 4, NULL, NULL),
(17, 'Guayapo', 4, NULL, NULL),
(18, 'Isla Ratón', 4, NULL, NULL),
(19, 'Alto Ventuari', 5, NULL, NULL),
(20, 'Medio Ventuari', 5, NULL, NULL),
(21, 'Bajo Ventuari', 5, NULL, NULL),
(22, 'Maroa', 6, NULL, NULL),
(23, 'Victorino', 6, NULL, NULL),
(24, 'La Comunidad', 6, NULL, NULL),
(25, 'Casiquiare', 7, NULL, NULL),
(26, 'Cocuy', 7, NULL, NULL),
(27, 'San Carlos de Río Negro', 7, NULL, NULL),
(28, 'Solano', 7, NULL, NULL),
(29, 'Anaco', 8, NULL, NULL),
(30, 'Buena Vista', 8, NULL, NULL),
(31, 'San Joaquín', 8, NULL, NULL),
(32, 'Aragua de Barcelona', 9, NULL, NULL),
(33, 'Cachipo', 9, NULL, NULL),
(34, 'Lechería', 10, NULL, NULL),
(35, 'El Morro', 10, NULL, NULL),
(36, 'Puerto Píritu', 11, NULL, NULL),
(37, 'San Miguel', 11, NULL, NULL),
(38, 'Sucre', 11, NULL, NULL),
(39, 'Cantaura', 12, NULL, NULL),
(40, 'Santa Rosa', 12, NULL, NULL),
(41, 'Urica', 12, NULL, NULL),
(42, 'Libertador', 12, NULL, NULL),
(43, 'Valle de Guanape', 13, NULL, NULL),
(44, 'Santa Bárbara', 13, NULL, NULL),
(45, 'Guanta', 14, NULL, NULL),
(46, 'Chorrerón', 14, NULL, NULL),
(47, 'Pertigalete', 14, NULL, NULL),
(48, 'Soledad', 15, NULL, NULL),
(49, 'Carapa', 15, NULL, NULL),
(50, 'El Mamo', 15, NULL, NULL),
(51, 'Palital', 15, NULL, NULL),
(52, 'Guanipa', 16, NULL, NULL),
(53, 'Puerto La Cruz', 17, NULL, NULL),
(54, 'Pozuelos', 17, NULL, NULL),
(55, 'La Cruz', 17, NULL, NULL),
(56, 'Hugo Chávez Frías', 17, NULL, NULL),
(57, 'Onoto', 18, NULL, NULL),
(58, 'San Pablo', 18, NULL, NULL),
(59, 'Guaribe', 18, NULL, NULL),
(60, 'El Carito', 19, NULL, NULL),
(61, 'San Mateo', 19, NULL, NULL),
(62, 'Santa Inés', 19, NULL, NULL),
(63, 'Clarines', 20, NULL, NULL),
(64, 'Guanape', 20, NULL, NULL),
(65, 'Sabana de Uchire', 20, NULL, NULL),
(66, 'Cantaura', 21, NULL, NULL),
(67, 'Santa Rosa', 21, NULL, NULL),
(68, 'Urica', 21, NULL, NULL),
(69, 'Libertador', 21, NULL, NULL),
(70, 'Hugo Chávez Frías', 21, NULL, NULL),
(71, 'Píritu', 22, NULL, NULL),
(72, 'San Francisco', 22, NULL, NULL),
(73, 'San José de Guanipa', 23, NULL, NULL),
(74, 'Boca de Uchire', 24, NULL, NULL),
(75, 'Boca de Chávez', 24, NULL, NULL),
(76, 'Santa Ana', 25, NULL, NULL),
(77, 'Pueblo Nuevo', 25, NULL, NULL),
(78, 'Edmundo Barrios', 26, NULL, NULL),
(79, 'Miguel Otero Silva', 26, NULL, NULL),
(80, 'El Tigre', 27, NULL, NULL),
(81, 'La Cruz', 28, NULL, NULL),
(82, 'Pozuelos', 28, NULL, NULL),
(83, 'Hugo Chávez Frías', 28, NULL, NULL),
(84, 'Achaguas', 29, NULL, NULL),
(85, 'Apurito', 29, NULL, NULL),
(86, 'El Yagual', 29, NULL, NULL),
(87, 'Guachara', 29, NULL, NULL),
(88, 'Mucuritas', 29, NULL, NULL),
(89, 'Queseras del Medio', 29, NULL, NULL),
(90, 'Biruaca', 30, NULL, NULL),
(91, 'Bruzal', 31, NULL, NULL),
(92, 'San Juan de Payara', 31, NULL, NULL),
(93, 'Guasdualito', 32, NULL, NULL),
(94, 'El Amparo', 32, NULL, NULL),
(95, 'Pedro Camejo', 33, NULL, NULL),
(96, 'Elorza', 34, NULL, NULL),
(97, 'La Trinidad de Orichuna', 34, NULL, NULL),
(98, 'San Fernando', 35, NULL, NULL),
(99, 'El Recreo', 35, NULL, NULL),
(100, 'Peñalver', 35, NULL, NULL),
(101, 'San Rafael de Atamaica', 35, NULL, NULL),
(102, 'San Mateo', 36, NULL, NULL),
(103, 'Camatagua', 37, NULL, NULL),
(104, 'Ollas de Caramacate', 37, NULL, NULL),
(105, 'Valle Morín', 37, NULL, NULL),
(106, 'Carmen de Cura', 37, NULL, NULL),
(107, 'Santa Rita', 38, NULL, NULL),
(108, 'Pedro José Ovalles', 39, NULL, NULL),
(109, 'Joaquín Crespo', 39, NULL, NULL),
(110, 'José Casanova Godoy', 39, NULL, NULL),
(111, 'Madre María de San José', 39, NULL, NULL),
(112, 'Andrés Eloy Blanco', 39, NULL, NULL),
(113, 'Los Tacarigua', 39, NULL, NULL),
(114, 'Las Delicias', 39, NULL, NULL),
(115, 'Choroní', 39, NULL, NULL),
(116, 'Santa Cruz', 40, NULL, NULL),
(117, 'Tovar', 40, NULL, NULL),
(118, 'José Félix Ribas', 41, NULL, NULL),
(119, 'La Mora', 41, NULL, NULL),
(120, 'Las Peñitas', 41, NULL, NULL),
(121, 'San Francisco de Asís', 41, NULL, NULL),
(122, 'Taguay', 41, NULL, NULL),
(123, 'Zuata', 41, NULL, NULL),
(124, 'Magdaleno', 42, NULL, NULL),
(125, 'José Rafael Revenga', 42, NULL, NULL),
(126, 'San Francisco de Asís', 42, NULL, NULL),
(127, 'Valles de Tucutunemo', 42, NULL, NULL),
(128, 'Palo Negro', 43, NULL, NULL),
(129, 'San Martín de Porres', 43, NULL, NULL),
(130, 'El Limón', 44, NULL, NULL),
(131, 'Caña de Azúcar', 44, NULL, NULL),
(132, 'Ocumare de la Costa de Oro', 45, NULL, NULL),
(133, 'San Casimiro', 46, NULL, NULL),
(134, 'San Sebastián', 47, NULL, NULL),
(135, 'Francisco de Miranda', 48, NULL, NULL),
(136, 'Turmero', 48, NULL, NULL),
(137, 'Monseñor Feliciano González', 48, NULL, NULL),
(138, 'Chuao', 48, NULL, NULL),
(139, 'Samán de Güere', 48, NULL, NULL),
(140, 'José Casanova Godoy', 49, NULL, NULL),
(141, 'Madre María de San José', 49, NULL, NULL),
(142, 'Santos Michelena', 49, NULL, NULL),
(143, 'Cagua', 50, NULL, NULL),
(144, 'Las Delicias', 50, NULL, NULL),
(145, 'Tovar', 51, NULL, NULL),
(146, 'Barbacoas', 52, NULL, NULL),
(147, 'Zamora', 53, NULL, NULL),
(148, 'Sabaneta', 54, NULL, NULL),
(149, 'Juan Antonio Rodríguez Domínguez', 54, NULL, NULL),
(150, 'El Cantón', 55, NULL, NULL),
(151, 'Santa Cruz de Guacas', 55, NULL, NULL),
(152, 'Puerto Vivas', 55, NULL, NULL),
(153, 'Ticoporo', 56, NULL, NULL),
(154, 'Nicolás Pulido', 56, NULL, NULL),
(155, 'Andrés Bello', 56, NULL, NULL),
(156, 'Arismendi', 57, NULL, NULL),
(157, 'Guadarrama', 57, NULL, NULL),
(158, 'La Unión', 57, NULL, NULL),
(159, 'San Antonio', 57, NULL, NULL),
(160, 'Barinas', 58, NULL, NULL),
(161, 'Alberto Arvelo Larriva', 58, NULL, NULL),
(162, 'San Silvestre', 58, NULL, NULL),
(163, 'Santa Inés', 58, NULL, NULL),
(164, 'Santa Lucía', 58, NULL, NULL),
(165, 'Torunos', 58, NULL, NULL),
(166, 'El Carmen', 58, NULL, NULL),
(167, 'Rómulo Betancourt', 58, NULL, NULL),
(168, 'Corazón de Jesús', 58, NULL, NULL),
(169, 'Ramón Ignacio Méndez', 58, NULL, NULL),
(170, 'Alto Barinas', 58, NULL, NULL),
(171, 'Manuel Palacio Fajardo', 58, NULL, NULL),
(172, 'Barinitas', 59, NULL, NULL),
(173, 'Altamira de Cáceres', 59, NULL, NULL),
(174, 'Calderas', 59, NULL, NULL),
(175, 'Barrancas', 60, NULL, NULL),
(176, 'El Socorro', 60, NULL, NULL),
(177, 'Masparrito', 60, NULL, NULL),
(178, 'Santa Bárbara', 61, NULL, NULL),
(179, 'Pedro Briceño Méndez', 61, NULL, NULL),
(180, 'Ramón Ignacio Méndez', 61, NULL, NULL),
(181, 'José Ignacio del Pumar', 61, NULL, NULL),
(182, 'Obispos', 62, NULL, NULL),
(183, 'Los Guasimitos', 62, NULL, NULL),
(184, 'El Real', 62, NULL, NULL),
(185, 'La Luz', 62, NULL, NULL),
(186, 'Ciudad Bolivia', 63, NULL, NULL),
(187, 'José Ignacio Briceño', 63, NULL, NULL),
(188, 'José Félix Ribas', 63, NULL, NULL),
(189, 'Páez', 63, NULL, NULL),
(190, 'Libertad', 64, NULL, NULL),
(191, 'Dolores', 64, NULL, NULL),
(192, 'Santa Rosa', 64, NULL, NULL),
(193, 'Palacio Fajardo', 64, NULL, NULL),
(194, 'Simón Rodríguez', 64, NULL, NULL),
(195, 'Ciudad de Nutrias', 65, NULL, NULL),
(196, 'El Regalo', 65, NULL, NULL),
(197, 'Puerto Nutrias', 65, NULL, NULL),
(198, 'Santa Catalina', 65, NULL, NULL),
(199, 'Simón Bolívar', 65, NULL, NULL),
(200, 'Ticoporo', 66, NULL, NULL),
(201, 'Caroní', 67, NULL, NULL),
(202, 'Cedeño', 68, NULL, NULL),
(203, 'El Callao', 69, NULL, NULL),
(204, 'Gran Sabana', 70, NULL, NULL),
(205, 'Heres', 71, NULL, NULL),
(206, 'Piar', 72, NULL, NULL),
(207, 'Raúl Leoni', 73, NULL, NULL),
(208, 'Roscio', 74, NULL, NULL),
(209, 'Sifontes', 75, NULL, NULL),
(210, 'Sucre', 76, NULL, NULL),
(211, 'Padre Pedro Chien', 77, NULL, NULL),
(212, 'Bejuma', 78, NULL, NULL),
(213, 'Carlos Arvelo', 79, NULL, NULL),
(214, 'Diego Ibarra', 80, NULL, NULL),
(215, 'Guacara', 81, NULL, NULL),
(216, 'Juan José Mora', 82, NULL, NULL),
(217, 'Libertador', 83, NULL, NULL),
(218, 'Los Guayos', 84, NULL, NULL),
(219, 'Miranda', 85, NULL, NULL),
(220, 'Montalbán', 86, NULL, NULL),
(221, 'Naguanagua', 87, NULL, NULL),
(222, 'Puerto Cabello', 88, NULL, NULL),
(223, 'San Diego', 89, NULL, NULL),
(224, 'San Joaquín', 90, NULL, NULL),
(225, 'Valencia', 91, NULL, NULL),
(226, 'Cojedes', 92, NULL, NULL),
(227, 'Juan de Mata Suárez', 92, NULL, NULL),
(228, 'El Baúl', 94, NULL, NULL),
(229, 'Sucre', 94, NULL, NULL),
(230, 'El Amparo', 97, NULL, NULL),
(231, 'Libertad de Cojedes', 97, NULL, NULL),
(232, 'Caño Hondo', 97, NULL, NULL),
(233, 'San Carlos de Austria', 99, NULL, NULL),
(234, 'Manuel Manrique', 99, NULL, NULL),
(235, 'Juan Ángel Bravo', 99, NULL, NULL),
(236, 'Camoruco', 99, NULL, NULL),
(237, 'Mapurite', 99, NULL, NULL),
(238, 'El Pao', 96, NULL, NULL),
(239, 'Macapo', 95, NULL, NULL),
(240, 'La Aguadita', 95, NULL, NULL),
(241, 'José Laurencio Silva', 100, NULL, NULL),
(242, 'Las Vegas', 98, NULL, NULL),
(243, 'Curiapo', 101, NULL, NULL),
(244, 'Almirante Luis Brión', 101, NULL, NULL),
(245, 'Manuel Renaud', 101, NULL, NULL),
(246, 'Capure', 101, NULL, NULL),
(247, 'Sierra Imataca', 101, NULL, NULL),
(248, 'Casacoima', 102, NULL, NULL),
(249, 'Pedernales', 103, NULL, NULL),
(250, 'Tucupita', 104, NULL, NULL),
(251, '23 de Enero', 105, NULL, NULL),
(252, 'Altagracia', 105, NULL, NULL),
(253, 'Antímano', 105, NULL, NULL),
(254, 'Candelaria', 105, NULL, NULL),
(255, 'Caricuao', 105, NULL, NULL),
(256, 'Catedral', 105, NULL, NULL),
(257, 'Coche', 105, NULL, NULL),
(258, 'El Junquito', 105, NULL, NULL),
(259, 'El Paraíso', 105, NULL, NULL),
(260, 'El Recreo', 105, NULL, NULL),
(261, 'El Valle', 105, NULL, NULL),
(262, 'La Pastora', 105, NULL, NULL),
(263, 'La Vega', 105, NULL, NULL),
(264, 'Macarao', 105, NULL, NULL),
(265, 'San Agustín', 105, NULL, NULL),
(266, 'San Bernardino', 105, NULL, NULL),
(267, 'San José', 105, NULL, NULL),
(268, 'San Juan', 105, NULL, NULL),
(269, 'San Pedro', 105, NULL, NULL),
(270, 'Santa Rosalía', 105, NULL, NULL),
(271, 'Santa Teresa', 105, NULL, NULL),
(272, 'Sucre', 105, NULL, NULL),
(273, 'San Juan de los Cayos', 106, NULL, NULL),
(274, 'Capadare', 106, NULL, NULL),
(275, 'La Soledad', 106, NULL, NULL),
(276, 'El Charal', 106, NULL, NULL),
(277, 'Santa Ana', 106, NULL, NULL),
(278, 'San Luis', 107, NULL, NULL),
(279, 'Aracua', 107, NULL, NULL),
(280, 'La Peña', 107, NULL, NULL),
(281, 'Santa Cruz de Bucaral', 107, NULL, NULL),
(282, 'Capatárida', 108, NULL, NULL),
(283, 'Guajiro', 108, NULL, NULL),
(284, 'Zazárida', 108, NULL, NULL),
(285, 'Puerto Cumarebo', 108, NULL, NULL),
(286, 'Yaracal', 109, NULL, NULL),
(287, 'Punta Cardón', 110, NULL, NULL),
(288, 'Carirubana', 110, NULL, NULL),
(289, 'Judibana', 110, NULL, NULL),
(290, 'Urbana Norte', 110, NULL, NULL),
(291, 'La Vela de Coro', 111, NULL, NULL),
(292, 'La Vela Sur', 111, NULL, NULL),
(293, 'Dabajuro', 112, NULL, NULL),
(294, 'Pedregal', 113, NULL, NULL),
(295, 'Pueblo Nuevo', 114, NULL, NULL),
(296, 'Adícora', 114, NULL, NULL),
(297, 'Churuguara', 115, NULL, NULL),
(298, 'Jacura', 116, NULL, NULL),
(299, 'Los Taques', 117, NULL, NULL),
(300, 'Judibana', 117, NULL, NULL),
(301, 'Mene de Mauroa', 118, NULL, NULL),
(302, 'San Félix', 118, NULL, NULL),
(303, 'Coro', 119, NULL, NULL),
(304, 'San Antonio', 119, NULL, NULL),
(305, 'Guzmán Guillermo', 119, NULL, NULL),
(306, 'Mitare', 119, NULL, NULL),
(307, 'Río Seco', 119, NULL, NULL),
(308, 'Curimagua', 119, NULL, NULL),
(309, 'Chichiriviche', 120, NULL, NULL),
(310, 'Boca de Tocuyo', 120, NULL, NULL),
(311, 'Palmasola', 121, NULL, NULL),
(312, 'Cabure', 122, NULL, NULL),
(313, 'Píritu', 123, NULL, NULL),
(314, 'Mirimire', 124, NULL, NULL),
(315, 'Tucacas', 125, NULL, NULL),
(316, 'Boca de Aroa', 125, NULL, NULL),
(317, 'La Cruz de Taratara', 126, NULL, NULL),
(318, 'Tocópero', 127, NULL, NULL),
(319, 'Santa Cruz de Bucaral', 128, NULL, NULL),
(320, 'Urumaco', 129, NULL, NULL),
(321, 'Puerto Cumarebo', 130, NULL, NULL),
(322, 'Camaguán', 131, NULL, NULL),
(323, 'Puerto Miranda', 131, NULL, NULL),
(324, 'Uverito', 131, NULL, NULL),
(325, 'Chaguaramas', 132, NULL, NULL),
(326, 'El Socorro', 133, NULL, NULL),
(327, 'Calabozo', 134, NULL, NULL),
(328, 'El Rastro', 134, NULL, NULL),
(329, 'Guardatinajas', 134, NULL, NULL),
(330, 'Uverito', 134, NULL, NULL),
(331, 'Tucupido', 135, NULL, NULL),
(332, 'Altagracia de Orituco', 136, NULL, NULL),
(333, 'San Juan de los Morros', 137, NULL, NULL),
(334, 'El Sombrero', 138, NULL, NULL),
(335, 'Las Mercedes', 139, NULL, NULL),
(336, 'Valle de la Pascua', 140, NULL, NULL),
(337, 'Espino', 140, NULL, NULL),
(338, 'Zaraza', 141, NULL, NULL),
(339, 'Ortíz', 142, NULL, NULL),
(340, 'Guayabal', 143, NULL, NULL),
(341, 'San José de Guaribe', 144, NULL, NULL),
(342, 'Santa María de Ipire', 145, NULL, NULL),
(343, 'Calabozo', 146, NULL, NULL),
(344, 'Sanare', 147, NULL, NULL),
(345, 'Pueblo Nuevo', 147, NULL, NULL),
(346, 'Quíbor', 147, NULL, NULL),
(347, 'Duaca', 148, NULL, NULL),
(348, 'Catedral', 149, NULL, NULL),
(349, 'Concepción', 149, NULL, NULL),
(350, 'El Cují', 149, NULL, NULL),
(351, 'Juárez', 149, NULL, NULL),
(352, 'Santa Rosa', 149, NULL, NULL),
(353, 'Tamaca', 149, NULL, NULL),
(354, 'Unión', 149, NULL, NULL),
(355, 'Quíbor', 150, NULL, NULL),
(356, 'El Tocuyo', 151, NULL, NULL),
(357, 'Cabudare', 152, NULL, NULL),
(358, 'Sarare', 153, NULL, NULL),
(359, 'Carora', 154, NULL, NULL),
(360, 'Siquisique', 155, NULL, NULL),
(361, 'El Vigía', 156, NULL, NULL),
(362, 'La Azulita', 157, NULL, NULL),
(363, 'Santa Cruz de Mora', 158, NULL, NULL),
(364, 'Aricagua', 159, NULL, NULL),
(365, 'Canaguá', 160, NULL, NULL),
(366, 'Ejido', 161, NULL, NULL),
(367, 'Tucaní', 162, NULL, NULL),
(368, 'Santo Domingo', 163, NULL, NULL),
(369, 'Guaraque', 164, NULL, NULL),
(370, 'Arapuey', 165, NULL, NULL),
(371, 'Torondoy', 166, NULL, NULL),
(372, 'Mérida', 167, NULL, NULL),
(373, 'Timotes', 168, NULL, NULL),
(374, 'Santa Elena de Arenales', 169, NULL, NULL),
(375, 'Santa María de Caparo', 170, NULL, NULL),
(376, 'Pueblo Llano', 171, NULL, NULL),
(377, 'Mucuchíes', 172, NULL, NULL),
(378, 'Bailadores', 173, NULL, NULL),
(379, 'Tabay', 174, NULL, NULL),
(380, 'Lagunillas', 175, NULL, NULL),
(381, 'Tovar', 176, NULL, NULL),
(382, 'Nueva Bolivia', 177, NULL, NULL),
(383, 'Zea', 178, NULL, NULL),
(384, 'Caucagua', 179, NULL, NULL),
(385, 'San José de Barlovento', 180, NULL, NULL),
(386, 'Baruta', 181, NULL, NULL),
(387, 'Higuerote', 182, NULL, NULL),
(388, 'Mamporal', 183, NULL, NULL),
(389, 'Carrizal', 184, NULL, NULL),
(390, 'Chacao', 185, NULL, NULL),
(391, 'Charallave', 186, NULL, NULL),
(392, 'El Hatillo', 187, NULL, NULL),
(393, 'Los Teques', 188, NULL, NULL),
(394, 'Santa Teresa del Tuy', 189, NULL, NULL),
(395, 'Ocumare del Tuy', 190, NULL, NULL),
(396, 'San Antonio de los Altos', 191, NULL, NULL),
(397, 'Rio Chico', 192, NULL, NULL),
(398, 'Santa Lucía', 193, NULL, NULL),
(399, 'Cúpira', 194, NULL, NULL),
(400, 'Guarenas', 195, NULL, NULL),
(401, 'San Francisco de Yare', 196, NULL, NULL),
(402, 'Petare', 197, NULL, NULL),
(403, 'Cúa', 198, NULL, NULL),
(404, 'Guatire', 199, NULL, NULL),
(405, 'San Antonio de Capayacuar', 200, NULL, NULL),
(406, 'San Francisco de Guayapero', 200, NULL, NULL),
(407, 'Aguasay', 201, NULL, NULL),
(408, 'Caripito', 202, NULL, NULL),
(409, 'Caripe', 203, NULL, NULL),
(410, 'Areo', 204, NULL, NULL),
(411, 'Caicara', 204, NULL, NULL),
(412, 'Punta de Mata', 205, NULL, NULL),
(413, 'El Tejero', 205, NULL, NULL),
(414, 'Temblador', 206, NULL, NULL),
(415, 'San Simón', 207, NULL, NULL),
(416, 'Aragua de Maturín', 208, NULL, NULL),
(417, 'Quiriquire', 209, NULL, NULL),
(418, 'Santa Bárbara', 210, NULL, NULL),
(419, 'Barrancas del Orinoco', 211, NULL, NULL),
(420, 'Uracoa', 212, NULL, NULL),
(421, 'Agua Blanca', 224, NULL, NULL),
(422, 'Araure', 225, NULL, NULL),
(423, 'Río Acarigua', 225, NULL, NULL),
(424, 'Píritu', 226, NULL, NULL),
(425, 'Uveral', 226, NULL, NULL),
(426, 'Cordova', 227, NULL, NULL),
(427, 'Guanare', 227, NULL, NULL),
(428, 'San José de la Montaña', 227, NULL, NULL),
(429, 'San Juan de Guanaguanare', 227, NULL, NULL),
(430, 'Virgen de Coromoto', 227, NULL, NULL),
(431, 'Guanarito', 228, NULL, NULL),
(432, 'Trinidad de la Capilla', 228, NULL, NULL),
(433, 'Divina Pastora', 228, NULL, NULL),
(434, 'Chabasquén', 229, NULL, NULL),
(435, 'Peña Blanca', 229, NULL, NULL),
(436, 'Aparición', 230, NULL, NULL),
(437, 'La Estación', 230, NULL, NULL),
(438, 'Ospino', 230, NULL, NULL),
(439, 'Acarigua', 231, NULL, NULL),
(440, 'Payara', 231, NULL, NULL),
(441, 'Pimpinela', 231, NULL, NULL),
(442, 'Ramón Peraza', 231, NULL, NULL),
(443, 'Caño Delgadito', 232, NULL, NULL),
(444, 'Papelón', 232, NULL, NULL),
(445, 'Antolín Tovar Aquino', 233, NULL, NULL),
(446, 'Boconoíto', 233, NULL, NULL),
(447, 'Santa Fé', 234, NULL, NULL),
(448, 'San Rafael de Onoto', 234, NULL, NULL),
(449, 'Thelmo Morles', 234, NULL, NULL),
(450, 'Florida', 235, NULL, NULL),
(451, 'El Playón', 235, NULL, NULL),
(452, 'Biscucuy', 236, NULL, NULL),
(453, 'Concepción', 236, NULL, NULL),
(454, 'San Rafael de Palo Alzado', 236, NULL, NULL),
(455, 'San José de Saguaz', 236, NULL, NULL),
(456, 'Uvencio Antonio Velásquez', 236, NULL, NULL),
(457, 'Villa Rosa', 236, NULL, NULL),
(458, 'Villa Bruzual', 237, NULL, NULL),
(459, 'Canelones', 237, NULL, NULL),
(460, 'Santa Cruz', 237, NULL, NULL),
(461, 'San Isidro Labrador la Colonia', 237, NULL, NULL),
(462, 'Casanay', 238, NULL, NULL),
(463, 'San José de Aerocuar', 239, NULL, NULL),
(464, 'Río Caribe', 240, NULL, NULL),
(465, 'El Pilar', 241, NULL, NULL),
(466, 'Carúpano', 242, NULL, NULL),
(467, 'Marigüitar', 243, NULL, NULL),
(468, 'Yaguaraparo', 244, NULL, NULL),
(469, 'Araya', 245, NULL, NULL),
(470, 'Tunapuy', 246, NULL, NULL),
(471, 'Irapa', 247, NULL, NULL),
(472, 'San Antonio del Golfo', 248, NULL, NULL),
(473, 'Cumanacoa', 249, NULL, NULL),
(474, 'Cariaco', 250, NULL, NULL),
(475, 'Cumaná', 251, NULL, NULL),
(476, 'Güiria', 252, NULL, NULL),
(477, 'La Palmita', 253, NULL, NULL),
(478, 'Las Mesas', 254, NULL, NULL),
(479, 'Colón', 255, NULL, NULL),
(480, 'San Antonio del Táchira', 256, NULL, NULL),
(481, 'Táriba', 257, NULL, NULL),
(482, 'Santa Ana del Táchira', 258, NULL, NULL),
(483, 'El Piñal', 259, NULL, NULL),
(484, 'San José de Bolívar', 260, NULL, NULL),
(485, 'La Fría', 261, NULL, NULL),
(486, 'Palmira', 262, NULL, NULL),
(487, 'Capacho Nuevo', 263, NULL, NULL),
(488, 'La Grita', 264, NULL, NULL),
(489, 'El Cobre', 265, NULL, NULL),
(490, 'Rubio', 266, NULL, NULL),
(491, 'Capacho Viejo', 267, NULL, NULL),
(492, 'Abejales', 268, NULL, NULL),
(493, 'Lobatera', 269, NULL, NULL),
(494, 'Michelena', 270, NULL, NULL),
(495, 'Coloncito', 271, NULL, NULL),
(496, 'Ureña', 272, NULL, NULL),
(497, 'Delicias', 273, NULL, NULL),
(498, 'La Tendida', 274, NULL, NULL),
(499, 'San Cristóbal', 275, NULL, NULL),
(500, 'Seboruco', 276, NULL, NULL),
(501, 'San Simón', 277, NULL, NULL),
(502, 'Queniquea', 278, NULL, NULL),
(503, 'San Josecito', 279, NULL, NULL),
(504, 'Pregonero', 280, NULL, NULL),
(505, 'Umuquena', 281, NULL, NULL),
(506, 'Santa Isabel', 282, NULL, NULL),
(507, 'Boconó', 283, NULL, NULL),
(508, 'Sabana Grande', 284, NULL, NULL),
(509, 'Chejendé', 285, NULL, NULL),
(510, 'Carache', 286, NULL, NULL),
(511, 'Escuque', 287, NULL, NULL),
(512, 'El Paradero', 288, NULL, NULL),
(513, 'Campo Elías', 289, NULL, NULL),
(514, 'La Ceiba', 290, NULL, NULL),
(515, 'El Dividive', 291, NULL, NULL),
(516, 'Monte Carmelo', 292, NULL, NULL),
(517, 'Motatán', 293, NULL, NULL),
(518, 'Pampán', 294, NULL, NULL),
(519, 'Pampanito', 295, NULL, NULL),
(520, 'Betijoque', 296, NULL, NULL),
(521, 'Carvajal', 297, NULL, NULL),
(522, 'Sabana de Mendoza', 298, NULL, NULL),
(523, 'Trujillo', 299, NULL, NULL),
(524, 'La Quebrada', 300, NULL, NULL),
(525, 'Valera', 301, NULL, NULL),
(526, 'La Guaira', 302, NULL, NULL),
(527, 'Maiquetía', 302, NULL, NULL),
(528, 'Macuto', 302, NULL, NULL),
(529, 'Naiguatá', 302, NULL, NULL),
(530, 'Caraballeda', 302, NULL, NULL),
(531, 'Carayaca', 302, NULL, NULL),
(532, 'El Junko', 302, NULL, NULL),
(533, 'La Sabana', 302, NULL, NULL),
(534, 'Catia La Mar', 302, NULL, NULL),
(535, 'Caruao', 302, NULL, NULL),
(536, 'Caricuao', 302, NULL, NULL),
(537, 'San Pablo', 303, NULL, NULL),
(538, 'Aroa', 304, NULL, NULL),
(539, 'Chivacoa', 305, NULL, NULL),
(540, 'Cocorote', 306, NULL, NULL),
(541, 'Independencia', 307, NULL, NULL),
(542, 'Sabana de Parra', 308, NULL, NULL),
(543, 'Boraure', 309, NULL, NULL),
(544, 'Yumare', 310, NULL, NULL),
(545, 'Nirgua', 311, NULL, NULL),
(546, 'Yaritagua', 312, NULL, NULL),
(547, 'San Felipe', 313, NULL, NULL),
(548, 'Guama', 314, NULL, NULL),
(549, 'Urachiche', 315, NULL, NULL),
(550, 'Farriar', 316, NULL, NULL),
(551, 'Isla de Toas', 317, NULL, NULL),
(552, 'San Timoteo', 318, NULL, NULL),
(553, 'Cabimas', 319, NULL, NULL),
(554, 'Encontrados', 320, NULL, NULL),
(555, 'San Carlos del Zulia', 321, NULL, NULL),
(556, 'Pueblo Nuevo El Chivo', 322, NULL, NULL),
(557, 'Sinamaica', 323, NULL, NULL),
(558, 'La Concepción', 324, NULL, NULL),
(559, 'Casigua El Cubo', 325, NULL, NULL),
(560, 'Concepción', 326, NULL, NULL),
(561, 'Ciudad Ojeda', 327, NULL, NULL),
(562, 'Machiques', 328, NULL, NULL),
(563, 'San Rafael del Moján', 329, NULL, NULL),
(564, 'Maracaibo', 330, NULL, NULL),
(565, 'Los Puertos de Altagracia', 331, NULL, NULL),
(566, 'La Villa del Rosario', 332, NULL, NULL),
(567, 'San Francisco', 333, NULL, NULL),
(568, 'Santa Rita', 334, NULL, NULL),
(569, 'Tía Juana', 335, NULL, NULL),
(570, 'Bobures', 336, NULL, NULL),
(571, 'Bachaquero', 337, NULL, NULL);

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
(1, 'Dashboard', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(2, 'dashboard-user', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(3, 'Gestion casos', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(4, 'crear casos', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(5, 'ver casos', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(6, 'editar casos', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(7, 'eliminar casos', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(8, 'aprobar casos', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(9, 'clonar casos', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(10, 'cierre atencion', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(11, 'Gestion roles', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(12, 'ver roles', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(13, 'editar roles', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(14, 'crear roles', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(15, 'eliminar roles', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(16, 'Gestion usuarios', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(17, 'ver usuarios', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(18, 'editar usuarios', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(19, 'crear usuarios', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(20, 'eliminar usuarios', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(21, 'Gestion permisos', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(22, 'Gestion configuracion', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(23, 'ver bitacora', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(24, 'ver casos eliminados', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(25, 'restaurar casos eliminados', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33');

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
(1, 'Administrador', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(2, 'Usuario', 'web', '2025-07-01 16:42:33', '2025-07-01 16:42:33');

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
(23, 1),
(24, 1),
(25, 1);

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
('aMfpnrmXZ4uCXtGrfAHunIzu1Y5UA3N9ofwE1E59', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibEZXQ3RYVFJSYjc0S015dWY2R0xrekJKc1pneHpBeHJyN2pIQzRFQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXNvcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1751374053);

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
(1, 'Zenen Peraza', 'peraza@outlook.com', '$2y$12$YfPGhU.s7zMdplvhY4n4a.4RHQKMk8kTYGnI.D7p6Y6wtHXxlF5He', NULL, '0000000000', 'Dirección Central', NULL, 'activo', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(2, 'Mary Melendez', 'mmelendesz@asonacop.org', '$2y$12$iMg1W6vGrWS9XXOScjysf.Sfd0B90YOlYm4oGNButliNAK059UMUa', NULL, NULL, NULL, NULL, 'activo', '2025-07-01 16:42:33', '2025-07-01 16:42:33'),
(3, 'monitoreonacional', 'mmelendez@asonacop.org', '$2y$12$h7UDxzcvtGtDfRiotJsYQulO90dkZ2K3e5oufh5ti2k6msB63NBoi', NULL, NULL, NULL, NULL, 'activo', '2025-06-30 22:22:02', '2025-06-30 22:22:02'),
(4, 'Danny', 'dannyprimera@gmail.com', '$2y$12$BF30tYqbYstWE2fD6sBRQemIED.GN9o9VcGys8YscDHfZXqMeBnhO', NULL, NULL, NULL, NULL, 'activo', '2025-06-30 22:46:07', '2025-06-30 22:46:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

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
-- AUTO_INCREMENT de la tabla `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `casos`
--
ALTER TABLE `casos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=572;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
