-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2020 a las 19:37:57
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `store_locator`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `storeName` varchar(100) DEFAULT NULL,
  `phoneFormatted` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postalCode` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stores`
--

INSERT INTO `stores` (`id`, `storeName`, `phoneFormatted`, `address`, `city`, `country`, `postalCode`, `latitude`, `longitude`) VALUES
(1, 'Vidrí San Miguel', '(503) 2210-0000', 'Calle el delirio. Urbanización jardines del río.', 'San Miguel', 'El Salvador', '20005', '13.4542469', '-88.1610564'),
(2, 'Almacenes Vidrí Venezuela', '(503) 2278-3033', '21 Avenida sur entre 12 y 14 calle poniente', 'San Salvador', 'El Salvador', '20037', '13.6940612', '-89.2051787'),
(3, 'Vidrí Merliot', '(503) 2278-3033', 'Bulevard Merliot y carretera al puerto de la libertad', 'La Libertad', 'El Salvador', '20037', '13.6759777', '-89.2665569'),
(4, 'Vidrí Santa Ana', '(503) 2448-1122', '4 Ave. sur #5 entre 1a y 3a calle poniente', 'Santa Ana', 'El Salvador', '20037', '13.9938217', '-89.5608017'),
(5, 'Vidrí Ejercito', '(503) 2277-7333', 'Km. 6 Bulevard del Ejercito', 'San Salvador', 'El Salvador', '20037', '13.6973159', '-89.1462172'),
(6, 'Vidrí San Miguelito', '(503) 2277-7333', '29 calle poniente y 1a. Ave. norte No. 207', 'San Salvador', 'El Salvador', '20037', '13.713037', '-89.1935422'),
(7, 'Vidrí Soyapango', '(503) 2277-7333', 'Calle a Tonacatepeque y ciudadela Don Bosco', 'Soyapango', 'El Salvador', '20037', '13.7168524', '-89.1439835'),
(8, 'Vidrí Centro', '(503) 2271-3033', '1a calle poniente y avenida España', 'San Salvador', 'El Salvador', '20037', '13.6999626', '-89.1936537'),
(9, 'Vidrí San Benito', '(503) 2264-3033', 'Bulevard El Hipodromo y calle Circunvalacion No. 428 Colonia San Benito', 'San Salvador', 'El Salvador', '20037', '13.6894234', '-89.2436391');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
