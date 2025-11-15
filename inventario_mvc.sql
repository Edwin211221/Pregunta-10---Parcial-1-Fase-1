-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2025 a las 02:09:03
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
-- Base de datos: `inventario_mvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventarios`
--

INSERT INTO `inventarios` (`id`, `id_producto`, `cantidad`) VALUES
(1, 1, 12),
(2, 2, 20),
(3, 3, 18),
(4, 4, 15),
(5, 5, 10),
(6, 6, 8),
(7, 7, 25),
(8, 8, 9),
(9, 9, 30),
(10, 10, 50),
(11, 11, 18),
(12, 12, 40),
(13, 13, 15),
(14, 14, 25),
(15, 15, 16),
(16, 16, 25),
(18, 17, 125),
(19, 18, 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `id_proveedor`) VALUES
(1, 'Laptop Dell Inspiron 15\"', 780.00, 1),
(2, 'Monitor LG 24\" IPS Full HD', 180.00, 1),
(3, 'Smartphone Samsung Galaxy A35', 360.00, 2),
(4, 'Tablet Lenovo Tab M10 10.1\"', 220.00, 2),
(5, 'Laptop ASUS VivoBook 14\"', 720.00, 3),
(6, 'Tablet Apple iPad 9ª gen 10.2\"', 430.00, 3),
(7, 'Smartphone Xiaomi Redmi Note 13', 310.00, 4),
(8, 'Monitor Samsung 27\" Curvo', 260.00, 4),
(9, 'Estuche rígido para laptop 15.6\"', 25.00, 5),
(10, 'Mica de vidrio templado para smartphone', 8.50, 5),
(11, 'Cargador USB-C 65W', 35.00, 6),
(12, 'Cable USB-C a USB-C 1.5m', 9.90, 6),
(13, 'Teclado mecánico retroiluminado', 49.99, 7),
(14, 'Mouse inalámbrico ergonómico', 25.50, 7),
(15, 'Barra de luz LED para monitor', 39.90, 8),
(16, 'Tira LED RGB para escritorio (5m)', 28.50, 8),
(17, 'Spray Limpiador de Pantallas', 3.50, 9),
(18, 'Lápiz Óptico para Celular - Tablet', 20.00, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `telefono`, `email`) VALUES
(1, 'Edwin Barrazueta', '0991112233', 'edwin.barrazueta@tecnoedwin.ec'),
(2, 'Katherine Vargas', '0992223344', 'katherine.vargas@ktechmobile.ec'),
(3, 'Abigail Borja', '0993334455', 'abigail.borja@abtechstore.ec'),
(4, 'Sebastian Sánchez', '0994445566', 'sebastian.sanchez@ssdevices.ec'),
(5, 'Alison Ahuayo', '0995556677', 'alison.ahuayo@accesoriosalison.ec'),
(6, 'Anahí Valarezo', '0996667788', 'anahi.valarezo@powercharge.ec'),
(7, 'Kerly Vallejo', '0997778899', 'kerly.vallejo@keymouse.ec'),
(8, 'Renata Salazar', '0998889900', 'renata.salazar@lightbar.ec'),
(9, 'Domenica Arboleda', '0963225988', 'domenica.arboleda@tecnodome.ec');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventario_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD CONSTRAINT `fk_inventario_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
