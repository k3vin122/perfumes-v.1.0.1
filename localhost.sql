-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-08-2025 a las 12:54:27
-- Versión del servidor: 8.0.41-32.1
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `c2850225_ventas`
--
CREATE DATABASE IF NOT EXISTS `c2850225_ventas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `c2850225_ventas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` bigint UNSIGNED NOT NULL,
  `numero_boleta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_orden_compra` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `tienda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto_comprado` decimal(10,2) NOT NULL,
  `valor_despacho` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `archivo_boleta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `compras_personales` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `numero_boleta`, `numero_orden_compra`, `fecha`, `tienda`, `monto_comprado`, `valor_despacho`, `total`, `archivo_boleta`, `categoria`, `created_at`, `updated_at`, `compras_personales`) VALUES
(8, '846314', NULL, '2025-07-02', 'Multimarcas', '365750.00', '7000.00', '372750.00', 'boletas/phX3Y6LKFtaDA5XBc1mepx7NcU0dzjm59PAPR4cY.pdf', 'C', '2025-07-13 03:49:42', '2025-07-17 06:04:59', '24700.00'),
(11, '1986218', 'SKP124027', '2025-06-27', 'Silk', '279360.00', '9189.00', '274559.00', 'boletas/lPPgNoaMMXjgS41q28EPOw1o3z0cHty72o9XQkj4.pdf', 'C', '2025-07-13 03:50:14', '2025-07-18 02:32:29', '13990.00'),
(12, '1998160', 'SKP126939', '2025-07-12', 'Silk', '315850.00', '9189.00', '293059.00', 'compras/snWalHOLsDznCU2jZTPhgpAKj6bw2TYLtgjIGVjA.pdf', 'G', '2025-07-15 05:55:35', '2025-07-18 04:15:07', '31980.00'),
(25, '852479', NULL, '2025-07-17', 'multimarcas', '370500.00', '7000.00', '325250.00', 'boletas/a7YswXmgSvxNsbVLyky2tPfgyxCpZodsSBnKCGyV.pdf', 'G', '2025-07-19 22:34:47', '2025-07-19 22:38:23', '52250.00'),
(26, '9626020', NULL, '2025-08-05', 'https://donweb.com/ HOSTING', '3808.00', '0.00', '3808.00', 'boletas/OrnjpycKFEEgsEZzJp2I5WmozEWuRiMe6lwUteIl.png', 'G', '2025-08-05 15:08:34', '2025-08-05 15:09:39', '0.00'),
(29, '2033258', NULL, '2025-08-09', 'Silk Perfumes', '333288.00', '9372.00', '322670.00', 'boletas/1BKM9Fz1pYVvRGrlTpDKtwSIKn6WFsVfOV4VLhIO.pdf', 'G', '2025-08-15 05:10:24', '2025-08-15 05:11:04', '19990.00'),
(32, '867876', NULL, '2025-08-22', 'Multimarcas', '395200.00', '9000.00', '402300.00', 'boletas/PCNkfIjXAl3RWyNteFB8Dy6yYrDrGv5cnuI88syt.pdf', 'G', '2025-08-25 03:47:10', '2025-08-25 03:47:36', '1900.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta_credito`
--

CREATE TABLE `detalle_venta_credito` (
  `id` bigint UNSIGNED NOT NULL,
  `venta_credito_id` bigint UNSIGNED NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `notas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_venta_credito`
--

INSERT INTO `detalle_venta_credito` (`id`, `venta_credito_id`, `producto_id`, `cantidad`, `precio_unitario`, `subtotal`, `notas`, `created_at`, `updated_at`) VALUES
(8, 35, 26, 1, '22000.00', '22000.00', NULL, '2025-07-17 20:49:52', '2025-07-17 20:49:52'),
(9, 36, 5, 1, '37000.00', '37000.00', NULL, '2025-07-17 20:52:01', '2025-07-17 20:52:01'),
(13, 40, 64, 1, '33990.00', '33990.00', NULL, '2025-07-19 20:35:37', '2025-07-19 20:35:37'),
(16, 43, 73, 1, '21990.00', '21990.00', NULL, '2025-07-21 03:42:12', '2025-07-21 03:42:12'),
(19, 46, 8, 1, '32989.98', '32989.98', NULL, '2025-08-07 17:33:48', '2025-08-07 17:33:48'),
(21, 51, 79, 1, '22990.00', '22990.00', NULL, '2025-08-07 22:19:20', '2025-08-07 22:19:20'),
(24, 51, 67, 1, '24990.00', '24990.00', NULL, '2025-08-07 22:19:20', '2025-08-07 22:19:20'),
(25, 52, 31, 1, '21990.00', '21990.00', NULL, '2025-08-08 01:17:08', '2025-08-08 01:17:08'),
(27, 54, 6, 1, '17990.00', '17990.00', NULL, '2025-08-10 02:04:33', '2025-08-10 02:04:33'),
(30, 57, 65, 1, '22800.00', '22800.00', NULL, '2025-08-11 20:14:39', '2025-08-11 20:14:39'),
(31, 58, 86, 1, '28990.00', '28990.00', NULL, '2025-08-19 15:08:08', '2025-08-19 15:08:08'),
(32, 59, 50, 1, '24990.00', '24990.00', NULL, '2025-08-22 06:27:30', '2025-08-22 06:27:30'),
(35, 62, 96, 1, '27990.00', '27990.00', NULL, '2025-08-22 06:28:59', '2025-08-22 06:28:59'),
(37, 64, 104, 1, '29990.00', '29990.00', NULL, '2025-08-22 21:21:55', '2025-08-22 21:21:55'),
(40, 67, 49, 1, '28990.00', '28990.00', NULL, '2025-08-22 21:23:41', '2025-08-22 21:23:41'),
(41, 68, 82, 1, '20990.00', '20990.00', NULL, '2025-08-25 03:54:14', '2025-08-25 03:54:14'),
(42, 69, 80, 1, '20990.00', '20990.00', NULL, '2025-08-25 03:57:57', '2025-08-25 03:57:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dinerobanco`
--

CREATE TABLE `dinerobanco` (
  `id` bigint UNSIGNED NOT NULL,
  `dinero` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dinerobanco`
--

INSERT INTO `dinerobanco` (`id`, `dinero`, `created_at`, `updated_at`) VALUES
(1, '281834.00', NULL, '2025-08-26 15:16:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_27_230648_create_productos_table', 1),
(5, '2025_06_27_234151_add_cantidad_to_productos_table', 2),
(6, '2025_06_27_235833_create_ventas_table', 3),
(10, '2025_06_29_205030_create_ventas_credito_table', 4),
(11, '2025_06_29_205214_create_detalle_venta_credito_table', 4),
(12, '2025_06_29_210245_create_pagos_ventas_credito_table', 4),
(13, '2025_06_29_223349_create_pago_venta_creditos_table', 5),
(14, '2025_07_02_233944_add_sucursal_to_productos_table', 6),
(15, '2025_07_06_232558_create_ventas_cabecera_table', 7),
(16, '2025_07_06_232641_add_venta_cabecera_id_to_ventas_table', 7),
(17, '2025_07_07_000700_add_notas_to_detalle_venta_credito_table', 8),
(18, '2025_07_07_001237_add_notas_to_ventas_credito_table', 9),
(19, '2025_07_07_004754_create_perfumes_table', 10),
(20, '2025_07_07_013534_create_compras_table', 11),
(21, '2025_07_07_035102_add_categoria_to_nombre_de_tu_tabla', 12),
(22, '2025_07_08_130953_add_notas_to_productos_table', 13),
(23, '2025_07_14_191433_modify_compras_personales_column_in_compras_table', 14),
(25, '2025_07_17_120341_create_dinerobanco_table', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_ventas_credito`
--

CREATE TABLE `pagos_ventas_credito` (
  `id` bigint UNSIGNED NOT NULL,
  `venta_credito_id` bigint UNSIGNED NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_venta_creditos`
--

CREATE TABLE `pago_venta_creditos` (
  `id` bigint UNSIGNED NOT NULL,
  `venta_credito_id` bigint UNSIGNED NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pago_venta_creditos`
--

INSERT INTO `pago_venta_creditos` (`id`, `venta_credito_id`, `fecha_pago`, `monto`, `created_at`, `updated_at`) VALUES
(7, 35, '2025-07-13', '12100.00', '2025-07-17 20:50:17', '2025-07-17 20:50:17'),
(8, 36, '2025-07-11', '21275.00', '2025-07-17 20:53:16', '2025-07-17 20:53:16'),
(14, 40, '2025-07-19', '18695.00', '2025-07-19 20:36:11', '2025-07-19 20:36:11'),
(16, 35, '2025-07-19', '12100.00', '2025-07-21 03:40:30', '2025-07-21 03:40:30'),
(19, 43, '2025-07-20', '12100.00', '2025-07-21 03:42:37', '2025-07-21 03:42:37'),
(20, 36, '2025-07-29', '19425.00', '2025-07-29 18:12:15', '2025-07-29 18:12:15'),
(21, 46, '2025-08-07', '16495.00', '2025-08-07 17:34:33', '2025-08-07 17:34:33'),
(22, 51, '2025-08-07', '25000.00', '2025-08-07 22:19:49', '2025-08-07 22:19:49'),
(24, 52, '2025-08-07', '11000.00', '2025-08-08 01:17:34', '2025-08-08 01:17:34'),
(26, 54, '2025-08-09', '8995.00', '2025-08-10 02:07:03', '2025-08-10 02:07:03'),
(29, 57, '2025-08-11', '11400.00', '2025-08-11 20:15:11', '2025-08-11 20:15:11'),
(31, 58, '2025-08-19', '14495.00', '2025-08-19 15:13:53', '2025-08-19 15:13:53'),
(32, 43, '2025-08-21', '12089.00', '2025-08-21 22:18:05', '2025-08-21 22:18:05'),
(34, 40, '2025-08-21', '18694.00', '2025-08-21 22:23:02', '2025-08-21 22:23:02'),
(35, 51, '2025-08-21', '22980.00', '2025-08-21 22:23:29', '2025-08-21 22:23:29'),
(38, 57, '2025-08-21', '11400.00', '2025-08-21 22:24:38', '2025-08-21 22:24:38'),
(40, 52, '2025-08-21', '10990.00', '2025-08-22 04:42:44', '2025-08-22 04:42:44'),
(43, 54, '2025-08-23', '8995.00', '2025-08-23 20:35:52', '2025-08-23 20:35:52'),
(45, 67, '2025-08-25', '28990.00', '2025-08-25 14:48:57', '2025-08-25 14:48:57'),
(47, 64, '2025-08-25', '29990.00', '2025-08-25 17:24:41', '2025-08-25 17:24:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfumes`
--

CREATE TABLE `perfumes` (
  `id` bigint UNSIGNED NOT NULL,
  `marca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `notas_aroma` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfumes`
--

INSERT INTO `perfumes` (`id`, `marca`, `producto`, `genero`, `precio`, `notas_aroma`, `imagen`, `created_at`, `updated_at`) VALUES
(3, 'Lattafa', 'Khamrah Qahwa EDP 100 ml', 'Unisex', '25990.00', 'c├ílido especiado\r\ndulce\r\navainillado\r\ncanela\r\ncaf├®\r\n├ímbar\r\natalcado', 'imagenes/slbvFXf4XubeQjld9jAYMd79SFuQNsuBZxtaNiX4.jpg', '2025-07-07 19:27:32', '2025-08-26 06:18:15'),
(4, 'Lattafa', 'Lattafa Yara Moi EDP 100 ml', 'Mujer', '21990.00', 'amaderado\r\nfloral blanco\r\npachul├¡\r\ncaramelo\r\nc├ílido especiado\r\natalcado\r\ndulce\r\nafrutados\r\n├ímbar\r\nbals├ímico', 'imagenes/1lEtOyYMu7q5gVpSAx17TB8YlGzCfVznc0g3a7Ca.jpg', '2025-07-08 07:37:31', '2025-08-26 06:18:48'),
(5, 'Yara EDP 100 ml', 'Yara EDP 100 ml', 'Mujer', '23990.00', 'dulce\r\navainillado\r\natalcado\r\ntropical\r\nafrutados\r\nalmizclado\r\nflorales\r\nc├¡trico', 'imagenes/gNn2SP99SFLZ4tX4jgYoxHnstPXdSWVzOzGTFlkk.jpg', '2025-07-08 07:38:48', '2025-08-26 06:19:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint UNSIGNED NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` enum('Hombre','Mujer','Unisex') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_compra` decimal(10,2) NOT NULL,
  `valor_venta_sur` decimal(10,2) NOT NULL,
  `valor_venta_norte` decimal(10,2) NOT NULL,
  `ganancia_sur` decimal(10,2) NOT NULL,
  `ganancia_norte` decimal(10,2) NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sucursal` enum('Rancagua','Puerto Varas') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Rancagua',
  `notas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `sku`, `marca`, `producto`, `genero`, `valor_compra`, `valor_venta_sur`, `valor_venta_norte`, `ganancia_sur`, `ganancia_norte`, `imagen`, `cantidad`, `created_at`, `updated_at`, `sucursal`, `notas`) VALUES
(5, '01', 'ARMAF', 'CLUB DE NUIT INTENSE EDP 105 ML LIMITED EDI', 'Hombre', '28990.00', '37000.00', '35000.00', '8010.00', '6010.00', 'imagenes/q9geBiZ04h7U4eJSmCTBVqXas5k2i5QwEFUXo6iD.png', 0, '2025-07-03 08:39:57', '2025-07-19 03:40:36', 'Puerto Varas', 'Amaderado\r\nafrutados\r\npachulí\r\navainillado\r\ncuero\r\ncítrico\r\ndulce\r\nrosas\r\nahumado\r\nbalsámico'),
(6, '02', 'Maison Alhambra', 'Infini Oud EDP 100 ml', 'Hombre', '17990.00', '17990.00', '17989.99', '0.00', '-0.01', 'imagenes/vZF2K4Vcw6hQPCsqrs6znrXLlUK7289q0bfkO6E1.png', 0, '2025-07-03 08:41:48', '2025-08-10 02:04:34', 'Puerto Varas', 'Fresco especiado\r\noud\r\nlavanda\r\nalmizclado\r\npachulí\r\natalcado\r\namaderado\r\ncálido especiado\r\naromático\r\nterrosos'),
(7, '03', 'Maison Alhambra', 'Yeah EDP 100 ml', 'Hombre', '13990.00', '25990.00', '25990.00', '12000.00', '12000.00', 'imagenes/rOo6FqC5QgavFPsapAW3V3pJzfwCCvIXu5VxqdDY.png', 1, '2025-07-03 08:43:20', '2025-08-10 23:47:02', 'Puerto Varas', 'Fresco especiado\r\naromático\r\namaderado\r\nafrutados\r\nfresco\r\námbar\r\ncítrico\r\nverde\r\nherbal'),
(8, '04', 'AFNAN', 'AFNAN 9PM HOMBRE EDP 100ML AFNAN', 'Hombre', '27990.00', '32989.98', '32990.00', '4999.98', '5000.00', 'imagenes/l8xwy7AREviC7nW3uxSyj7VwFluJ4f95OkJ6KDDh.png', 0, '2025-07-03 08:45:20', '2025-08-07 17:33:48', 'Puerto Varas', 'Avainillado\r\námbar\r\ncálido especiado\r\nafrutados\r\ncanela\r\ndulce\r\nlavanda\r\nfresco\r\natalcado\r\naromático'),
(9, '05', 'Lattafa', 'Now De Rave EDP 100 ml', 'Hombre', '21990.00', '28990.00', '26990.00', '7000.00', '5000.00', 'imagenes/3XrV6tfq10zTxpebDbdOBkzHJ3wufBBau9ItVBVe.png', 0, '2025-07-03 08:47:31', '2025-07-19 21:38:13', 'Puerto Varas', 'Afrutados\r\ndulce\r\ntropical\r\nfresco\r\nalmizclado\r\natalcado\r\namaderado'),
(10, '06', 'Lattafa', 'Asad Zanzibar EDP 100 ml', 'Unisex', '16990.00', '26000.00', '22000.00', '9010.00', '5010.00', 'imagenes/gxmTphpp8vuoe7QoPnB5XaaLfuGoByY5uBAJ0502.png', 0, '2025-07-03 08:49:15', '2025-07-19 03:39:42', 'Puerto Varas', 'Avainillado\r\natalcado\r\niris\r\nlavanda\r\nfresco especiado\r\nsalado\r\nvioleta\r\námbar\r\nbalsámico\r\ncálido especiado'),
(11, '07', 'Lattafa', 'Qimmah Women EDP 100 ml', 'Mujer', '17990.00', '27990.00', '27990.00', '10000.00', '10000.00', 'imagenes/mKbi3SB1wZKGZb75Zp3cxXQXbszl3RWoqyx8Veil.png', 1, '2025-07-03 08:52:18', '2025-08-11 00:03:29', 'Puerto Varas', 'Avainillado\r\nfloral blanco\r\nalmendrado\r\ndulce\r\ncálido especiado\r\nnardos\r\nnueces\r\ncacao\r\natalcado\r\nafrutados'),
(12, '08', 'Lattafa', 'Lattafa Emaan EDP 100 ml', 'Mujer', '21990.00', '30990.00', '30989.98', '9000.00', '8999.98', 'imagenes/X3qmNHrDezzcgpC0v0Evz6JYs0qYebJPVJXnOmED.png', 1, '2025-07-03 08:54:00', '2025-08-10 23:35:08', 'Puerto Varas', 'Floral blanco\r\ncítrico\r\nnardos\r\nanimálico\r\namaderado\r\naromático\r\nafrutados\r\nfresco especiado\r\ndulce\r\nflorales'),
(13, '09', 'Lattafa', 'Ajwad EDP 60 ml', 'Mujer', '16990.00', '22990.00', '24990.00', '6000.00', '8000.00', 'imagenes/4R5IKvUfiFM9QWELINLnDhM8DXJa03xtnDej1a6U.png', 1, '2025-07-03 08:56:00', '2025-08-11 00:02:06', 'Puerto Varas', 'Rosas\r\nafrutados\r\navainillado\r\natalcado\r\nalmizclado\r\ndulce\r\námbar\r\nfloral blanco\r\nflorales\r\namaderado'),
(14, '010', 'Maison Alhambra', 'Leonie EDP 100 ml', 'Mujer', '12490.00', '22000.00', '19000.00', '9510.00', '6510.00', 'imagenes/7IMBz3ZuP3KvkIhNB9XjCyRLJBpQhMASSDoJghqg.png', 0, '2025-07-03 08:57:28', '2025-07-19 03:46:04', 'Puerto Varas', 'Floral blanco\r\ncítrico\r\nlavanda\r\nalmizclado\r\natalcado\r\naromático\r\ndulce\r\navainillado\r\nanimálico\r\namaderado'),
(15, '011', 'Lattafa', 'Fakhar Women EDP 100 ml', 'Mujer', '19990.00', '28990.00', '28990.00', '9000.00', '9000.00', 'imagenes/ThmRynChYUplJeNMiJT7lAwK6oRpg6bN1UDDKX1K.png', 1, '2025-07-03 08:59:32', '2025-08-11 00:01:19', 'Puerto Varas', 'Floral blanco\r\nafrutados\r\nnardos\r\ndulce\r\namaderado\r\nanimálico'),
(16, '012', 'Lattafa', 'Yara Candy EDP 100 ml', 'Mujer', '24990.00', '31990.00', '31989.99', '7000.00', '6999.99', 'imagenes/lXf24ZCVGz9NfRnP7mF4q1KW8EsJYAqiI5GOqyiT.png', 0, '2025-07-03 09:01:20', '2025-07-23 00:13:10', 'Puerto Varas', 'Avainillado\r\nafrutados\r\natalcado\r\nfloral blanco\r\ncítrico\r\naromático\r\namaderado\r\nespeciado suave\r\nalmizclado\r\nanimálico'),
(20, '013', 'Lattafa', 'Qimmah Women EDP 100 ml', 'Mujer', '15200.00', '28000.00', '22990.00', '12800.00', '7790.00', 'imagenes/zuVeFEhXJOq4WdD9tPDf5Q4eLcVsx10X63dMkMiM.jpg', 0, '2025-07-05 09:16:15', '2025-07-19 18:06:18', 'Rancagua', NULL),
(21, '014', 'Lattafa', 'Emaan EDP 100 ml', 'Mujer', '22800.00', '30000.00', '30000.00', '7200.00', '7200.00', 'imagenes/WsxDCZqpk74vD0CM50kozJm3Qpmo0aBijiT62hs0.jpg', 0, '2025-07-05 09:23:07', '2025-07-21 04:31:07', 'Rancagua', NULL),
(22, '015', 'Lattafa', 'Ajwad EDP 60 ml', 'Mujer', '14250.00', '28000.00', '21990.00', '13750.00', '7740.00', 'imagenes/44zDp1D73vhiJeEuX6nUlmRUM2Dl84laktOBomAs.jpg', 1, '2025-07-05 09:24:41', '2025-07-19 17:09:56', 'Rancagua', NULL),
(23, '016', 'Lattafa', 'Fakhar Black EDP 100 ml', 'Hombre', '20900.00', '31000.00', '28990.00', '10100.00', '8090.00', 'imagenes/3OiEBn98q0NZMp2DGrrARkdRfkyl14nQeWhruOrr.jpg', 1, '2025-07-05 09:28:08', '2025-08-24 04:22:12', 'Rancagua', NULL),
(24, '017', 'Lattafa', 'Fakhar Women EDP 100 ml', 'Mujer', '19950.00', '26000.00', '25990.00', '6050.00', '6040.00', 'imagenes/Ig0byXvG4nL5x2BD1oW8JxRK4fG7IaI3UogpL85E.jpg', 0, '2025-07-05 09:29:36', '2025-08-25 04:05:38', 'Rancagua', NULL),
(25, '018', 'Maison Alhambra', 'Yeah Man EDP 100 ml', 'Hombre', '14250.00', '25000.00', '20990.00', '10750.00', '6740.00', 'imagenes/Ih0WgI5EW5t4l8OjCIDtqERXfPDqhclysekrhVm1.jpg', 1, '2025-07-05 09:33:34', '2025-08-24 04:33:07', 'Rancagua', NULL),
(26, '019', 'Rave', 'Now Intense EDP 100 ml', 'Hombre', '15200.00', '0.00', '21990.00', '-15200.00', '6790.00', 'imagenes/zg4F7VitsLW0oZ7X6Ak7xSmjExgaqRlagOast7Zn.jpg', 0, '2025-07-05 09:35:22', '2025-07-22 21:41:36', 'Rancagua', NULL),
(27, '020', 'Armaf', 'Club De Nuit Intense Man EDT 105 ml', 'Hombre', '26600.00', '37000.00', '35000.00', '10400.00', '8400.00', 'imagenes/GVVhwZKpkHCqVVmQKDZN9psY4A5zYnbpReHPghHL.jpg', 0, '2025-07-05 09:38:40', '2025-07-21 04:30:50', 'Rancagua', NULL),
(28, '021', 'Lattafa', 'Asad Zanzibar EDP 100 ml', 'Hombre', '14250.00', '25990.00', '26000.00', '11740.00', '11750.00', 'imagenes/G85XyBW05GeRxYLg2lS1LTYbo99RLpht2Y3yACOa.jpg', 1, '2025-07-05 09:40:13', '2025-08-24 04:17:20', 'Rancagua', NULL),
(29, '022', 'Lattafa', 'Velvet Oud EDP 100 ml', 'Hombre', '11400.00', '0.00', '20000.00', '-11400.00', '8600.00', 'imagenes/mWTr1LkNAih1ecCx9BUy47s6GySvWvBPV8p6T48o.jpg', 0, '2025-07-05 09:42:19', '2025-07-21 04:53:16', 'Rancagua', NULL),
(30, '023', 'Lattafa', 'Mayar EDP 100 ml', 'Mujer', '24700.00', '0.00', '34990.00', '-24700.00', '10290.00', 'imagenes/XViNlHkoOrPMHuAzZvhe6esJUmgUjPwvf8Tm9C0H.jpg', 1, '2025-07-05 09:44:03', '2025-08-24 04:28:58', 'Rancagua', NULL),
(31, '024', 'Lattafa', 'Qaed Al Fursan EDP 90 ml', 'Hombre', '14250.00', '0.00', '21990.00', '-14250.00', '7740.00', 'imagenes/G8eBo8VGhAX6LfN57KNzeBcnGoMOFsCyljAeKhS3.jpg', 0, '2025-07-05 09:45:50', '2025-08-25 03:51:03', 'Rancagua', NULL),
(32, '025', 'Rasasi', 'Hawas For Him EDP 100 ml', 'Hombre', '22800.00', '0.00', '29990.00', '-22800.00', '7190.00', 'imagenes/nqfkyMlLbB6k5P4RGc8JneTKlYvpcj3ETeku5DID.jpg', 1, '2025-07-05 09:47:46', '2025-08-06 03:13:59', 'Rancagua', NULL),
(33, '026', 'Maison Alhambra', 'Leonie EDP 100 ml', 'Mujer', '13300.00', '22000.00', '19000.00', '8700.00', '5700.00', 'imagenes/eOWL7R8NFK3Jc5WjRx5xSQzbgAl5y4VPLFggRLR5.jpg', 0, '2025-07-05 09:49:12', '2025-07-21 04:58:47', 'Rancagua', NULL),
(34, '027', 'Lattafa', 'Yara Candy EDP 100 ml', 'Mujer', '22800.00', '32000.00', '31990.00', '9200.00', '9190.00', 'imagenes/DTR2E9fkRCk3Hpnnxalki72vmvV4yP3Ty9XerxyR.jpg', 1, '2025-07-05 09:50:31', '2025-08-24 04:31:22', 'Rancagua', NULL),
(35, '028', 'Lattafa', 'Yara EDP 100 ml', 'Mujer', '23750.00', '32000.00', '31990.00', '8250.00', '8240.00', 'imagenes/AOa4CRuhoeZL7ORTHsGdSNUG7E4nOS1uI3KFy6xO.jpg', 1, '2025-07-05 09:51:55', '2025-08-24 04:32:14', 'Rancagua', NULL),
(36, '029', 'Hamidi', 'Desire EDP 100 ml', 'Hombre', '16150.00', '0.00', '22990.00', '-16150.00', '6840.00', 'imagenes/OTMoZn8e4n19la8bDkO3FIotJpk4XEQrGCqgwj9o.jpg', 1, '2025-07-05 09:53:59', '2025-08-06 03:33:05', 'Rancagua', NULL),
(44, '030', 'Lattafa', 'Hayaati (Black)', 'Hombre', '16990.00', '28990.00', '28990.00', '12000.00', '12000.00', 'imagenes/MlOKtC561sdeR0H8MOok5ec3IOxFb2GCabz1mbot.png', 0, '2025-07-18 05:48:38', '2025-07-25 23:31:09', 'Puerto Varas', 'Las Notas de Salida son manzana y bergamota; las Notas de Corazón son canela y notas amaderadas; las Notas de Fondo son almizcle y vainilla.'),
(46, '031', 'Lattafa', 'Mayar EDP 100 ml', 'Mujer', '25990.00', '34990.00', '34990.00', '9000.00', '9000.00', 'imagenes/Veuyg0VN1OiNJeMiqoMDQiZCoSecZRqN4s33B9lW.png', 0, '2025-07-18 05:52:46', '2025-08-26 15:16:39', 'Puerto Varas', 'Las Notas de Salida son lichi, frambuesa y hojas de violeta; las Notas de Corazón son rosa blanca, peonía y jazmín; las Notas de Fondo son almizcle y vainilla.'),
(49, '032', 'Lattafa', 'Fakhar Black EDP 100 ml', 'Hombre', '21990.00', '28990.00', '30989.98', '7000.00', '8999.98', 'imagenes/Rnkufxa3muWbkfpgtxjtmN67JcDpnaCMwq7K5tiT.png', 0, '2025-07-18 05:55:18', '2025-08-22 21:23:41', 'Puerto Varas', 'Las Notas de Salida son manzana, bergamota y jengibre; las Notas de Corazón son lavanda, salvia, bayas de enebro y geranio; las Notas de Fondo son haba tonka, cedro, Amberwood y vetiver.'),
(50, '033', 'Lattafa', 'Lattafa Yara EDP 100 ml', 'Mujer', '24990.00', '24990.00', '24989.99', '0.00', '-0.01', 'imagenes/iWG0JsdeyZZykE3ThlEoqkkss888tPCbw8rg0Hbn.png', 0, '2025-07-18 05:59:37', '2025-08-22 06:27:30', 'Puerto Varas', 'Las Notas de Salida son orquídea, heliotropo y naranja tangerina; las Notas de Corazón son Acuerdo goloso y frutas tropicales; las Notas de Fondo son vainilla, almizcle y sándalo.'),
(52, '034', 'Rasasi', 'Hawas For Him EDP 100 ml', 'Hombre', '26990.00', '35990.00', '35990.00', '9000.00', '9000.00', 'imagenes/ovRSItti8MjOcw9yailYXE8LGObWEWs70QmekxC1.png', 0, '2025-07-18 06:03:28', '2025-07-21 14:57:23', 'Puerto Varas', 'Las Notas de Salida son manzana, bergamota, limón (lima ácida) y canela; las Notas de Corazón son notas acuosas, ciruela, flor de azahar del naranjo y cardamomo; las Notas de Fondo son ámbar gris, almizcle, pachulí y trozos de madera a la deriva.'),
(53, '035', 'Lattafa', 'Khamrah Dukhan EDP 100 ml', 'Hombre', '29990.00', '37990.00', '37990.00', '8000.00', '8000.00', 'imagenes/TMBwIk8sz8qBYmCXrElm4zKStA2T1aPDwd57Q88K.png', 0, '2025-07-18 06:07:27', '2025-07-30 19:36:53', 'Puerto Varas', 'Las Notas de Salida son especias, pimiento morrón y mandarina; las Notas de Corazón son incienso, ládano, flor de azahar del naranjo y pachulí; las Notas de Fondo son tabaco, praliné, ámbar, haba tonka y benjuí.'),
(55, '036', 'Lattafa', 'Qaed Al Fursan EDP 90 ml', 'Hombre', '14990.00', '20990.00', '22990.00', '6000.00', '8000.00', 'imagenes/G3TwepJep3d5LFslkEFbs9qz0OuRWlfyewwnO5MI.png', 1, '2025-07-18 06:15:14', '2025-08-25 14:48:25', 'Puerto Varas', 'Las Notas de Salida son piña y azafrán; las Notas de Corazón son abeto balsámico y jazmín; las Notas de Fondo son ámbar, cedro y madera de oud.'),
(61, '037', 'Lattafa', 'Fakhar Extrait EDP 100 ml', 'Hombre', '17100.00', '0.00', '24990.00', '-17100.00', '7890.00', 'imagenes/0HaSqEifxktLB5vqhHXWuXNfMesC4KpTZEvugxtk.jpg', 0, '2025-07-19 17:12:48', '2025-07-22 21:49:44', 'Rancagua', NULL),
(62, '038', 'Lattafa', 'Lattafa Eclaire EDP 100 ml', 'Mujer', '27550.00', '0.00', '35990.00', '-27550.00', '8440.00', 'imagenes/PMEqXrnnztP642PwcJ7tJNefVxj54yybmGelSDrg.jpg', 0, '2025-07-19 17:15:14', '2025-07-29 01:24:08', 'Rancagua', NULL),
(64, '039', 'Lattafa', 'Liam Blue Shine EDP 100 ml', 'Hombre', '23750.00', '0.00', '32990.00', '-23750.00', '9240.00', 'imagenes/1V1tZhWGusEKq4WWT59JhzcqIV5pveoggTw4INAd.jpg', 1, '2025-07-19 17:18:36', '2025-08-24 04:27:21', 'Rancagua', NULL),
(65, '040', 'Lattafa', 'Asad EDP 100 ml', 'Hombre', '22800.00', '0.00', '29990.00', '-22800.00', '7190.00', 'imagenes/N6nIVVBRSsltFBEO4NUOnzanUQfHzsQUf45kYNRT.jpg', 1, '2025-07-19 17:20:55', '2025-08-25 03:43:07', 'Rancagua', NULL),
(67, '041', 'Rasasi', 'Hawas For Her EDP 100 ml', 'Mujer', '17100.00', '0.00', '24990.00', '-17100.00', '7890.00', 'imagenes/nGZSBrAWW46NrnyCxEj4FRPTtV7jOwMzeH0mZ9Vi.jpg', 0, '2025-07-19 17:29:35', '2025-08-07 22:19:20', 'Rancagua', NULL),
(70, '042', 'Maison Alhambra', 'Jorge Di Profumo Aqua EDP 100 ml', 'Hombre', '14250.00', '0.00', '21990.00', '-14250.00', '7740.00', 'imagenes/QRzS3wzk4zZtD9GPBwgT8YfTpvuPpq44eFsIPOp9.jpg', 1, '2025-07-19 17:33:08', '2025-08-06 03:14:29', 'Rancagua', NULL),
(73, '043', 'Maison Alhambra', 'No 2 Men EDP 80 ml', 'Hombre', '13300.00', '0.00', '21990.00', '-13300.00', '8690.00', 'imagenes/VMYczFGFcmwn3PWtRISlxWtJVdrCeEG4Y5U5TFjT.jpg', 0, '2025-07-19 17:34:52', '2025-07-21 03:42:12', 'Rancagua', NULL),
(76, '044', 'World fragance', 'Hayaati EDP 100 ml', 'Hombre', '14250.00', '0.00', '22990.00', '-14250.00', '8740.00', 'imagenes/nO9vwYm9gIJiOt83UHIGEDoFXeyiYQr3bcNoFw5l.jpg', 1, '2025-07-19 17:37:07', '2025-08-24 04:24:33', 'Rancagua', NULL),
(79, '045', 'Maison Alhambra', 'B.A.D. Homme EDP 100 ml', 'Hombre', '16150.00', '0.00', '22990.00', '-16150.00', '6840.00', 'imagenes/udTbN11RVa3UFQaUiVIfiABogBF6uSl4QLsTvsLm.jpg', 1, '2025-07-19 17:39:43', '2025-08-24 04:17:52', 'Rancagua', NULL),
(80, '046', 'Maison Alhambra', 'Salvo EDP 100 ml', 'Hombre', '13300.00', '0.00', '20990.00', '-13300.00', '7690.00', 'imagenes/tAKzmbQP4VXb2jwiqprnIAZ231IosWZixnPivQdX.jpg', 0, '2025-07-19 17:42:26', '2025-08-25 03:57:58', 'Rancagua', NULL),
(82, '047', 'Maison Alhambra', 'Maitre De Blue EDP 100 ml', 'Hombre', '12350.00', '0.00', '20990.00', '-12350.00', '8640.00', 'imagenes/70kh2OXjaHhIfEldouZc6DWtN2cjrEb2SfT7BQan.jpg', 0, '2025-07-19 17:45:59', '2025-08-25 03:54:14', 'Rancagua', NULL),
(83, '048', 'Maison Alhambra', 'Jorge Di Profumo Deep Blue EDP 100 ml', 'Hombre', '14250.00', '0.00', '21990.00', '-14250.00', '7740.00', 'imagenes/QfUgRpo2tkCgwGXRO54nHyxV2r838rgZc4fmuDhN.jpg', 1, '2025-07-19 17:50:53', '2025-08-06 03:15:32', 'Rancagua', NULL),
(85, '049', 'World fragance', 'Oud wonder EDP 80 ml', 'Hombre', '12350.00', '0.00', '19990.00', '-12350.00', '7640.00', 'imagenes/7PTZGuDPm3ZMa1octN1Q0506rpI1E4AF5tkzcRl6.jpg', 0, '2025-07-21 04:09:10', '2025-07-22 05:11:59', 'Rancagua', NULL),
(86, '050', 'Fragrance World', 'Hayaati EDP 100 ml', 'Hombre', '13490.00', '28990.00', '28990.00', '15500.00', '15500.00', 'imagenes/0oHaHJsdXuwK8sOd3nPx9jnD4CmOAzfNMl1Qp7L5.png', 0, '2025-08-10 02:15:11', '2025-08-19 15:08:08', 'Puerto Varas', 'Notas de Salida son melón, manzana y bergamota; las Notas de Corazón son canela y cardamomo; las Notas de Fondo son sándalo, pachulí, cedro, musgo de roble y ámbar.'),
(89, '051', 'Maison Al Hambra', 'Salvo EDP 100 ml', 'Hombre', '13990.00', '22990.00', '22990.00', '9000.00', '9000.00', 'imagenes/i4cJgsmkNRNdX5FeTZJKag4XepO78w3Vux1fuZBb.png', 1, '2025-08-10 23:00:13', '2025-08-11 00:04:58', 'Puerto Varas', 'La Nota de Salida es bergamota; las Notas de Corazón son lavanda, pimienta de Sichuan, anís estrellado y nuez moscada; las Notas de Fondo son ambroxan y vainilla.'),
(90, '052', 'Rasasi', 'Hawas Woman EDP 100 ML', 'Mujer', '17990.00', '26990.00', '26990.00', '9000.00', '9000.00', 'imagenes/yuxea51uKzTuKoYkMKuYvPfopzrx3H5uCe9xCrre.png', 1, '2025-08-10 23:27:02', '2025-08-10 23:27:02', 'Puerto Varas', 'Las Notas de Salida son granada, manzana y toronja (pomelo); las Notas de Corazón son iris, jazmín sambac (sampaguita) y cítricos; las Notas de Fondo son praliné, pachulí y vetiver.'),
(93, '053', 'Lattafa', 'Badee Al Oud Honor & Glory EDP 100 ml', 'Unisex', '23990.00', '32990.00', '32990.00', '9000.00', '9000.00', 'imagenes/hb3NZXaAn0vRBgfMMr9Yjt6gKUl8jyAN6QARFSlk.png', 0, '2025-08-10 23:32:40', '2025-08-19 14:46:41', 'Puerto Varas', 'Las Notas de Salida son piña y créme brulée; las Notas de Corazón son canela, cúrcuma (azafrán de la India), pimienta negra y benjuí; las Notas de Fondo son vainilla, sándalo, cachemira y musgo.'),
(96, '054', 'Rasasi', 'Hawas Elixir Men EDP 100 ml', 'Hombre', '27990.00', '27990.00', '27989.98', '0.00', '-0.02', 'imagenes/ahv3ourHtZdXGcjAOk3u9XQW0Z0Jwc6aMWYWfKcy.png', 0, '2025-08-10 23:40:14', '2025-08-22 06:28:59', 'Puerto Varas', 'Las Notas de Salida son menta, bergamota y abrótano; las Notas de Corazón son lavanda, chocolate oscuro y benjuí; las Notas de Fondo son vainilla, haba tonka y almizcle blanco.'),
(98, '055', 'Lattafa', 'Bade\'e Al Oud Sublime EDP 100 ml', 'Mujer', '23990.00', '32990.00', '32990.00', '9000.00', '9000.00', 'imagenes/OnRaM1Em179egc18jGsrFpJspJFlByWayIwZiC7T.png', 1, '2025-08-10 23:43:17', '2025-08-10 23:57:57', 'Puerto Varas', 'Las Notas de Salida son manzana, lichi y rosa; las Notas de Corazón son ciruela y jazmín; las Notas de Fondo son musgo, vainilla y pachulí.'),
(99, '056', 'Lattafa', 'Badee Al Oud Noble Blush EDP 100 ml', 'Mujer', '23990.00', '32990.00', '32990.00', '9000.00', '9000.00', 'imagenes/p0wdYUgfSroDxyWdtFhBAImPDb6HxhwVseWgOX75.png', 1, '2025-08-10 23:44:49', '2025-08-10 23:59:36', 'Puerto Varas', 'La Nota de Salida es Rose Milk; las Notas de Corazón son merengue y almendra; las Notas de Fondo son vainilla, almizcle y sándalo.'),
(101, '057', 'Lattafa', 'Sakeena EDP 100 ml', 'Mujer', '21990.00', '30990.00', '30990.00', '9000.00', '9000.00', 'imagenes/Ci97TIortOqEZTGJh8CALvAkG37Qb9uUjBbShOoF.png', 1, '2025-08-10 23:49:16', '2025-08-10 23:49:16', 'Puerto Varas', 'Las Notas de Salida son maracuyá (fruta de la pasión), notas ozónicas y mandarina; las Notas de Corazón son frambuesa, rosa, sal de mar y flor de azahar del naranjo; las Notas de Fondo son tófe, praliné, vainilla y almizcle.'),
(104, '058', 'Lattafa', 'Yara Moi EDP 100 ml', 'Mujer', '19990.00', '29990.00', '29990.00', '10000.00', '10000.00', 'imagenes/m9OzJmeDWAV13KveBcV0dbeFItmE6bRbZ0iBJZBt.png', 0, '2025-08-10 23:51:57', '2025-08-22 21:21:55', 'Puerto Varas', 'Las Notas de Salida son jazmín y durazno (melocotón); las Notas de Corazón son caramelo y ámbar; las Notas de Fondo son pachulí y sándalo.'),
(105, '059', 'Lattafa', 'Hayaati Gold Elixir EDP 100 ml', 'Mujer', '15990.00', '24990.00', '24990.00', '9000.00', '9000.00', 'imagenes/K4fS1XWPYvSqTFsWQ701DSV60WJglpEfxopGiLtg.png', 0, '2025-08-10 23:55:37', '2025-08-19 15:13:10', 'Puerto Varas', 'Las Notas de Salida son bergamota, toronja (pomelo) y casis (grosellero negro); las Notas de Corazón son cuero, durazno (melocotón) y azafrán; las Notas de Fondo son vainilla, ámbar, almizcle y vetiver.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lIIyAF33Yppu7zC4DrOOSrXtNGHuD4fuzKMq7dvT', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU003VFBWWWdVeFY3M3Y0aVZ2Z2RwWEpyQ2pETFVramt3Und0cEdQVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MS92ZW50YXNfcGVyZnVtZXMlMjB2LjEuMi4wL3B1YmxpYy9wcm9kdWN0b3MiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1752493992);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `rut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rut`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '19266166-8', 'Kevin Ross', 'kevinrossmartinez1@gmail.com', NULL, '$2y$12$tNTR7FAjmBbGBGVtDIImDO/BcrBNfz.UbQz7/xSCnDDUdbHjz5gS.', NULL, '2025-06-28 06:26:40', '2025-06-28 06:26:40'),
(3, '18348891-0', 'Carlos Gallegos', 'carlosgallegosa.93@hotmail.com', NULL, '$2y$12$IqijpCZehFPcrIPYKRx4.OLCpAdBRmOhVvQPRsP.8zUzhexkt4Fy.', 'qsyTMmAQjW5qdAukc9T0H4p0jfRzcGoH4N3iggtt1CNLMCm9TQYyFkPgtWB9', '2025-07-03 08:08:33', '2025-07-03 04:29:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint UNSIGNED NOT NULL,
  `venta_cabecera_id` bigint UNSIGNED DEFAULT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `zona` enum('Norte','Sur') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_vendida` int NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `venta_cabecera_id`, `producto_id`, `zona`, `cantidad_vendida`, `precio_unitario`, `total`, `created_at`, `updated_at`) VALUES
(2, 1, 31, 'Norte', 1, '22000.00', '22000.00', '2025-07-05 09:56:35', '2025-07-05 09:56:35'),
(3, 2, 20, 'Norte', 1, '23000.00', '23000.00', '2025-07-05 09:57:15', '2025-07-05 09:57:15'),
(4, 3, 27, 'Norte', 1, '35000.00', '35000.00', '2025-07-05 09:57:44', '2025-07-05 09:57:44'),
(5, 4, 32, 'Norte', 1, '32000.00', '32000.00', '2025-07-05 09:58:16', '2025-07-05 09:58:16'),
(6, 5, 28, 'Norte', 1, '26000.00', '26000.00', '2025-07-05 09:59:03', '2025-07-05 09:59:03'),
(7, 6, 35, 'Norte', 1, '32000.00', '32000.00', '2025-07-06 01:25:56', '2025-07-06 01:25:56'),
(8, 7, 24, 'Norte', 1, '26000.00', '26000.00', '2025-07-06 01:26:48', '2025-07-06 01:26:48'),
(11, 10, 32, 'Norte', 1, '32000.00', '32000.00', '2025-07-07 22:02:28', '2025-07-07 22:02:28'),
(26, 20, 10, 'Sur', 1, '26000.00', '26000.00', '2025-07-11 18:40:17', '2025-07-11 18:40:17'),
(30, 24, 15, 'Sur', 1, '26000.00', '26000.00', '2025-07-17 20:36:32', '2025-07-17 20:36:32'),
(31, 25, 12, 'Sur', 1, '30000.00', '30000.00', '2025-07-17 20:36:43', '2025-07-17 20:36:43'),
(32, 26, 14, 'Sur', 1, '22000.00', '22000.00', '2025-07-17 20:36:52', '2025-07-17 20:36:52'),
(33, 27, 9, 'Sur', 2, '29000.00', '58000.00', '2025-07-17 20:37:05', '2025-07-17 20:37:05'),
(34, 28, 16, 'Sur', 1, '32000.00', '32000.00', '2025-07-17 20:37:15', '2025-07-17 20:37:15'),
(35, 29, 7, 'Sur', 1, '25000.00', '25000.00', '2025-07-17 20:37:24', '2025-07-17 20:37:24'),
(36, 30, 22, 'Norte', 1, '22000.00', '22000.00', '2025-07-17 20:43:53', '2025-07-17 20:43:53'),
(37, 31, 21, 'Norte', 1, '30000.00', '30000.00', '2025-07-17 20:44:15', '2025-07-17 20:44:15'),
(38, 32, 23, 'Sur', 1, '31000.00', '31000.00', '2025-07-17 20:44:27', '2025-07-17 20:44:27'),
(39, 33, 33, 'Norte', 1, '19000.00', '19000.00', '2025-07-17 20:44:43', '2025-07-17 20:44:43'),
(40, 34, 30, 'Norte', 1, '35000.00', '35000.00', '2025-07-17 20:44:55', '2025-07-17 20:44:55'),
(41, 35, 29, 'Norte', 1, '20000.00', '20000.00', '2025-07-17 20:45:15', '2025-07-17 20:45:15'),
(42, 36, 34, 'Norte', 1, '32000.00', '32000.00', '2025-07-17 20:45:28', '2025-07-17 20:45:28'),
(43, 37, 25, 'Norte', 1, '21000.00', '21000.00', '2025-07-17 20:46:00', '2025-07-17 20:46:00'),
(73, 67, 9, 'Sur', 1, '28990.00', '28990.00', '2025-07-19 21:38:13', '2025-07-19 21:38:13'),
(76, 70, 11, 'Sur', 1, '28000.00', '28000.00', '2025-07-19 21:43:47', '2025-07-19 21:43:47'),
(79, 73, 15, 'Sur', 1, '28990.00', '28990.00', '2025-07-19 21:46:44', '2025-07-19 21:46:44'),
(80, 74, 46, 'Sur', 1, '34990.00', '34990.00', '2025-07-19 23:18:11', '2025-07-19 23:18:11'),
(82, 76, 76, 'Norte', 1, '22990.00', '22990.00', '2025-07-21 03:43:18', '2025-07-21 03:43:18'),
(85, 79, 49, 'Sur', 1, '28990.00', '28990.00', '2025-07-21 05:14:03', '2025-07-21 05:14:03'),
(86, 80, 52, 'Sur', 1, '35990.00', '35990.00', '2025-07-21 14:57:23', '2025-07-21 14:57:23'),
(89, 83, 7, 'Sur', 1, '24990.00', '24990.00', '2025-07-21 18:19:36', '2025-07-21 18:19:36'),
(91, 85, 85, 'Norte', 1, '19990.00', '19990.00', '2025-07-22 05:11:59', '2025-07-22 05:11:59'),
(94, 88, 61, 'Norte', 1, '24990.00', '24990.00', '2025-07-22 21:49:44', '2025-07-22 21:49:44'),
(95, 89, 46, 'Norte', 1, '34990.00', '34990.00', '2025-07-22 21:50:08', '2025-07-22 21:50:08'),
(98, 92, 16, 'Sur', 1, '31990.00', '31990.00', '2025-07-23 00:13:10', '2025-07-23 00:13:10'),
(100, 94, 46, 'Sur', 1, '34990.00', '34990.00', '2025-07-25 23:27:54', '2025-07-25 23:27:54'),
(103, 97, 44, 'Sur', 1, '28990.00', '28990.00', '2025-07-25 23:31:09', '2025-07-25 23:31:09'),
(106, 100, 50, 'Sur', 1, '33990.00', '33990.00', '2025-07-25 23:33:12', '2025-07-25 23:33:12'),
(107, 101, 62, 'Norte', 1, '35990.00', '35990.00', '2025-07-29 01:24:08', '2025-07-29 01:24:08'),
(109, 103, 53, 'Sur', 1, '37990.00', '37990.00', '2025-07-30 19:36:53', '2025-07-30 19:36:53'),
(112, 106, 35, 'Norte', 1, '31990.00', '31990.00', '2025-08-02 01:22:50', '2025-08-02 01:22:50'),
(115, 109, 93, 'Sur', 1, '32990.00', '32990.00', '2025-08-19 14:46:41', '2025-08-19 14:46:41'),
(118, 112, 105, 'Sur', 1, '24990.00', '24990.00', '2025-08-19 15:13:10', '2025-08-19 15:13:10'),
(120, 114, 31, 'Norte', 1, '21990.00', '21990.00', '2025-08-25 03:51:03', '2025-08-25 03:51:03'),
(122, 116, 24, 'Norte', 1, '25990.00', '25990.00', '2025-08-25 04:05:38', '2025-08-25 04:05:38'),
(123, 117, 55, 'Sur', 1, '20990.00', '20990.00', '2025-08-25 14:48:25', '2025-08-25 14:48:25'),
(126, 120, 46, 'Sur', 1, '34990.00', '34990.00', '2025-08-26 15:16:39', '2025-08-26 15:16:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id` bigint UNSIGNED NOT NULL,
  `zona` enum('Norte','Sur') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id`, `zona`, `total`, `created_at`, `updated_at`) VALUES
(1, 'Norte', '22000.00', '2025-07-05 09:56:35', '2025-07-05 09:56:35'),
(2, 'Norte', '23000.00', '2025-07-05 09:57:15', '2025-07-05 09:57:15'),
(3, 'Norte', '35000.00', '2025-07-05 09:57:44', '2025-07-05 09:57:44'),
(4, 'Norte', '32000.00', '2025-07-05 09:58:16', '2025-07-05 09:58:16'),
(5, 'Norte', '26000.00', '2025-07-05 09:59:03', '2025-07-05 09:59:03'),
(6, 'Norte', '32000.00', '2025-07-06 01:25:56', '2025-07-06 01:25:56'),
(7, 'Norte', '26000.00', '2025-07-06 01:26:48', '2025-07-06 01:26:48'),
(9, 'Sur', '40000.00', '2025-07-07 06:47:28', '2025-07-07 06:47:28'),
(10, 'Norte', '32000.00', '2025-07-07 22:02:28', '2025-07-07 22:02:28'),
(11, 'Norte', '3000.00', '2025-07-10 21:15:28', '2025-07-10 21:15:28'),
(12, 'Norte', '3000.00', '2025-07-10 21:40:56', '2025-07-10 21:40:56'),
(13, 'Sur', '50000.00', '2025-07-10 21:48:19', '2025-07-10 21:48:19'),
(14, 'Sur', '60000.00', '2025-07-10 21:50:27', '2025-07-10 21:50:27'),
(15, 'Norte', '40000.00', '2025-07-10 21:53:57', '2025-07-10 21:53:58'),
(16, 'Sur', '60000.00', '2025-07-10 22:07:31', '2025-07-10 22:07:31'),
(17, 'Sur', '60000.00', '2025-07-10 22:17:50', '2025-07-10 22:17:50'),
(18, 'Sur', '30000.00', '2025-07-10 22:20:55', '2025-07-10 22:20:55'),
(19, 'Norte', '20000.00', '2025-07-10 22:24:28', '2025-07-10 22:24:28'),
(20, 'Sur', '26000.00', '2025-07-11 18:40:17', '2025-07-11 18:40:17'),
(22, 'Sur', '10000.00', '2025-07-17 19:40:06', '2025-07-17 19:40:06'),
(23, 'Sur', '10000.00', '2025-07-17 19:40:52', '2025-07-17 19:40:52'),
(24, 'Sur', '26000.00', '2025-07-17 20:36:32', '2025-07-17 20:36:32'),
(25, 'Sur', '30000.00', '2025-07-17 20:36:43', '2025-07-17 20:36:43'),
(26, 'Sur', '22000.00', '2025-07-17 20:36:52', '2025-07-17 20:36:52'),
(27, 'Sur', '58000.00', '2025-07-17 20:37:05', '2025-07-17 20:37:05'),
(28, 'Sur', '32000.00', '2025-07-17 20:37:15', '2025-07-17 20:37:15'),
(29, 'Sur', '25000.00', '2025-07-17 20:37:24', '2025-07-17 20:37:24'),
(30, 'Norte', '22000.00', '2025-07-17 20:43:53', '2025-07-17 20:43:53'),
(31, 'Norte', '30000.00', '2025-07-17 20:44:15', '2025-07-17 20:44:15'),
(32, 'Sur', '31000.00', '2025-07-17 20:44:27', '2025-07-17 20:44:27'),
(33, 'Norte', '19000.00', '2025-07-17 20:44:43', '2025-07-17 20:44:43'),
(34, 'Norte', '35000.00', '2025-07-17 20:44:55', '2025-07-17 20:44:55'),
(35, 'Norte', '20000.00', '2025-07-17 20:45:15', '2025-07-17 20:45:15'),
(36, 'Norte', '32000.00', '2025-07-17 20:45:28', '2025-07-17 20:45:28'),
(37, 'Norte', '21000.00', '2025-07-17 20:46:00', '2025-07-17 20:46:00'),
(38, 'Sur', '10000.00', '2025-07-17 21:27:48', '2025-07-17 21:27:48'),
(46, 'Norte', '10000.00', '2025-07-18 03:49:47', '2025-07-18 03:49:47'),
(65, 'Sur', '10000.00', '2025-07-18 03:52:24', '2025-07-18 03:52:25'),
(67, 'Sur', '28990.00', '2025-07-19 21:38:13', '2025-07-19 21:38:13'),
(70, 'Sur', '28000.00', '2025-07-19 21:43:47', '2025-07-19 21:43:47'),
(73, 'Sur', '28990.00', '2025-07-19 21:46:44', '2025-07-19 21:46:45'),
(74, 'Sur', '34990.00', '2025-07-19 23:18:11', '2025-07-19 23:18:11'),
(76, 'Norte', '22990.00', '2025-07-21 03:43:18', '2025-07-21 03:43:18'),
(79, 'Sur', '28990.00', '2025-07-21 05:14:03', '2025-07-21 05:14:03'),
(80, 'Sur', '35990.00', '2025-07-21 14:57:22', '2025-07-21 14:57:23'),
(83, 'Sur', '24990.00', '2025-07-21 18:19:36', '2025-07-21 18:19:36'),
(85, 'Norte', '19990.00', '2025-07-22 05:11:59', '2025-07-22 05:12:00'),
(88, 'Norte', '24990.00', '2025-07-22 21:49:44', '2025-07-22 21:49:45'),
(89, 'Norte', '34990.00', '2025-07-22 21:50:08', '2025-07-22 21:50:08'),
(92, 'Sur', '31990.00', '2025-07-23 00:13:09', '2025-07-23 00:13:10'),
(94, 'Sur', '34990.00', '2025-07-25 23:27:54', '2025-07-25 23:27:54'),
(97, 'Sur', '28990.00', '2025-07-25 23:31:09', '2025-07-25 23:31:09'),
(100, 'Sur', '33990.00', '2025-07-25 23:33:12', '2025-07-25 23:33:12'),
(101, 'Norte', '35990.00', '2025-07-29 01:24:07', '2025-07-29 01:24:08'),
(103, 'Sur', '37990.00', '2025-07-30 19:36:53', '2025-07-30 19:36:54'),
(106, 'Norte', '31990.00', '2025-08-02 01:22:50', '2025-08-02 01:22:50'),
(109, 'Sur', '32990.00', '2025-08-19 14:46:41', '2025-08-19 14:46:41'),
(112, 'Sur', '24990.00', '2025-08-19 15:13:10', '2025-08-19 15:13:10'),
(113, 'Sur', '34990.00', '2025-08-22 19:50:09', '2025-08-22 19:50:09'),
(114, 'Norte', '21990.00', '2025-08-25 03:51:03', '2025-08-25 03:51:03'),
(116, 'Norte', '25990.00', '2025-08-25 04:05:38', '2025-08-25 04:05:38'),
(117, 'Sur', '20990.00', '2025-08-25 14:48:25', '2025-08-25 14:48:25'),
(120, 'Sur', '34990.00', '2025-08-26 15:16:38', '2025-08-26 15:16:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_credito`
--

CREATE TABLE `ventas_credito` (
  `id` bigint UNSIGNED NOT NULL,
  `cliente_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `zona` enum('Norte','Sur') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuotas` int NOT NULL,
  `interes` decimal(5,2) NOT NULL DEFAULT '3.00',
  `abono_inicial` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `notas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas_credito`
--

INSERT INTO `ventas_credito` (`id`, `cliente_nombre`, `fecha`, `zona`, `cuotas`, `interes`, `abono_inicial`, `total`, `notas`, `created_at`, `updated_at`) VALUES
(35, 'Pato Canidia', '2025-07-13', 'Norte', 2, '10.00', '0.00', '24200.00', 'Now intense', '2025-07-17 20:49:52', '2025-07-17 20:49:52'),
(36, 'Sergio Tobar', '2025-07-10', 'Sur', 2, '10.00', '0.00', '40700.00', 'Fecha Pago 2da cta 24-07-2025', '2025-07-17 20:52:01', '2025-07-17 20:52:01'),
(40, 'Cristobal espinoza', '2025-07-19', 'Norte', 2, '10.00', '0.00', '37389.00', '2da cuota para el pago de agosto', '2025-07-19 20:35:37', '2025-07-19 20:35:37'),
(43, 'Yimi Barril', '2025-07-19', 'Norte', 2, '10.00', '0.00', '24189.00', 'pago 2da cuota proximo 21 de agosto', '2025-07-21 03:42:12', '2025-07-21 03:42:12'),
(46, 'Eduardo Antonio Castillo', '2025-08-07', 'Sur', 2, '0.00', '0.00', '32989.98', 'Sistemas expertos, fecha de pago 31-08-2025.(+56 9 3684 5082)', '2025-08-07 17:33:48', '2025-08-07 17:33:48'),
(51, 'Jesus Iturra', '2025-08-07', 'Norte', 2, '0.00', '0.00', '47980.00', 'proximo pago de cuota 21/08/2025', '2025-08-07 22:19:20', '2025-08-07 22:19:21'),
(52, 'Pato Candia', '2025-08-07', 'Norte', 2, '0.00', '0.00', '21990.00', 'para el pago del 21 de agosto', '2025-08-08 01:17:08', '2025-08-08 01:17:08'),
(54, 'Kevin Ross', '2025-08-09', 'Sur', 2, '0.00', '0.00', '17990.00', 'Pago segunda cuota 31-08-2025', '2025-08-10 02:04:33', '2025-08-10 02:04:34'),
(57, 'Carlos Gallegos', '2025-08-11', 'Norte', 2, '0.00', '0.00', '22800.00', 'para el pago del 21 de agosto', '2025-08-11 20:14:39', '2025-08-11 20:14:39'),
(58, 'Eduardo Antonio Castillo', '2025-08-19', 'Sur', 2, '0.00', '0.00', '28990.00', '¡Cancela a fin de mes!  31-08-2025', '2025-08-19 15:08:08', '2025-08-19 15:08:08'),
(59, 'Carlos Gallegos', '2025-08-21', 'Sur', 2, '0.00', '0.00', '24990.00', NULL, '2025-08-22 06:27:30', '2025-08-22 06:27:30'),
(62, 'Carlos Gallegos', '2025-08-21', 'Sur', 2, '0.00', '0.00', '27990.00', NULL, '2025-08-22 06:28:59', '2025-08-22 06:28:59'),
(64, 'Denise comunicaciones', '2025-08-22', 'Sur', 1, '0.00', '0.00', '29990.00', 'Cancela 24-08-2025', '2025-08-22 21:21:55', '2025-08-22 21:21:55'),
(67, 'Alejandro Rain Comunicaciónes', '2025-08-22', 'Sur', 1, '0.00', '0.00', '28990.00', 'Cancela el 24-08-2025', '2025-08-22 21:23:41', '2025-08-22 21:23:41'),
(68, 'Manuel castañeda', '2025-05-24', 'Norte', 1, '0.00', '0.00', '20990.00', 'paga el dia 30 de agosto', '2025-08-25 03:54:14', '2025-08-25 03:54:14'),
(69, 'Yimi Barril', '2025-08-22', 'Norte', 1, '0.00', '0.00', '20990.00', 'pago el dia 5 de septiembre completo', '2025-08-25 03:57:57', '2025-08-25 03:57:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_creditos`
--

CREATE TABLE `ventas_creditos` (
  `id` bigint UNSIGNED NOT NULL,
  `cliente_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `zona` enum('Norte','Sur') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuotas` int NOT NULL,
  `interes` decimal(5,2) NOT NULL DEFAULT '3.00',
  `abono_inicial` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_venta_credito`
--
ALTER TABLE `detalle_venta_credito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_venta_credito_venta_credito_id_foreign` (`venta_credito_id`),
  ADD KEY `detalle_venta_credito_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `dinerobanco`
--
ALTER TABLE `dinerobanco`
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
-- Indices de la tabla `pagos_ventas_credito`
--
ALTER TABLE `pagos_ventas_credito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_ventas_credito_venta_credito_id_foreign` (`venta_credito_id`);

--
-- Indices de la tabla `pago_venta_creditos`
--
ALTER TABLE `pago_venta_creditos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pago_venta_creditos_venta_credito_id_foreign` (`venta_credito_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `perfumes`
--
ALTER TABLE `perfumes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productos_sku_unique` (`sku`);

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
  ADD UNIQUE KEY `users_rut_unique` (`rut`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_producto_id_foreign` (`producto_id`),
  ADD KEY `ventas_venta_cabecera_id_foreign` (`venta_cabecera_id`);

--
-- Indices de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_credito`
--
ALTER TABLE `ventas_credito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_creditos`
--
ALTER TABLE `ventas_creditos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `detalle_venta_credito`
--
ALTER TABLE `detalle_venta_credito`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `dinerobanco`
--
ALTER TABLE `dinerobanco`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `pagos_ventas_credito`
--
ALTER TABLE `pagos_ventas_credito`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago_venta_creditos`
--
ALTER TABLE `pago_venta_creditos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `perfumes`
--
ALTER TABLE `perfumes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `ventas_credito`
--
ALTER TABLE `ventas_credito`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `ventas_creditos`
--
ALTER TABLE `ventas_creditos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta_credito`
--
ALTER TABLE `detalle_venta_credito`
  ADD CONSTRAINT `detalle_venta_credito_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_venta_credito_venta_credito_id_foreign` FOREIGN KEY (`venta_credito_id`) REFERENCES `ventas_credito` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagos_ventas_credito`
--
ALTER TABLE `pagos_ventas_credito`
  ADD CONSTRAINT `pagos_ventas_credito_venta_credito_id_foreign` FOREIGN KEY (`venta_credito_id`) REFERENCES `ventas_credito` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pago_venta_creditos`
--
ALTER TABLE `pago_venta_creditos`
  ADD CONSTRAINT `pago_venta_creditos_venta_credito_id_foreign` FOREIGN KEY (`venta_credito_id`) REFERENCES `ventas_credito` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `ventas_venta_cabecera_id_foreign` FOREIGN KEY (`venta_cabecera_id`) REFERENCES `ventas_cabecera` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
