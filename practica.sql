-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2023 a las 04:47:40
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `cod_categoria` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`cod_categoria`, `categoria`) VALUES
(1, 'TARJETA DE VIDEO'),
(2, 'MEMORIA RAM'),
(3, 'DISCO DURO SOLIDO'),
(4, 'DISCO DURO RIGIDO'),
(5, 'PROCESADOR'),
(6, 'VENTILADOR / COOLER'),
(7, 'FUENTES DE ALIMENTACION'),
(8, 'PLACA BASE / MOTHER BOARD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `cod_estado` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`cod_estado`, `estado`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `fecha` date DEFAULT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `nombre`, `apellido`, `correo`, `usuario`, `contrasena`, `fecha`, `imagen`) VALUES
(1, 'Enoc', 'Rubio Paucar', 'Enoc.Rubio06@hotmail.com', 'Enoc06', '319f17489470be3a9a49f31093726da6', '2023-05-20', 'img/Enoc.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codpro` varchar(50) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `fecharegistro` date NOT NULL,
  `codcategoria` int(11) NOT NULL,
  `codestado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codpro`, `codigo`, `nombre`, `cantidad`, `precio`, `fecharegistro`, `codcategoria`, `codestado`) VALUES
('P000', 3, 'MEMORIA RAM KINGSTON FURY', 6, 270.55, '2023-02-04', 2, 1),
('P000', 4, 'PROCESADOR INTEL CORE I3-10105F 3.70GHz/6MB LGA120', 5, 281.85, '2023-05-18', 5, 1),
('P000', 5, 'PROCESADOR AMD RYZEN 5 3600 3.6GHZ 35MB 4CORE AM4 ', 4, 645, '2023-05-05', 5, 1),
('P000', 6, 'MEMORIA 8GB DDR4 KINGSTON FURY BEAST BUS 3200MHZ B', 3, 116.25, '2023-05-05', 2, 1),
('P000', 7, 'MEMORIA 8GB DDR4 T-FORCE VULCAN Z RED BUS 3200MHz ', 4, 105, '2023-05-17', 2, 1),
('P000', 8, 'MEMORIA 8GB DDR4 XPG GAMMIX D30 BLACK RED BUS 3600', 2, 112.5, '2023-05-05', 2, 1),
('P000', 9, 'RTX 1080 VIDEO 128 BITS 10', 6, 1708.12, '2023-05-06', 1, 1),
('P000', 10, 'MICROSONIC RAM 32GB ', 15, 280.09, '2023-05-06', 2, 1),
('P000', 11, 'VENTILADOR LIQUIDO / 165 ML TREX', 5, 168.25, '2023-05-09', 6, 1),
('P000', 19, 'MICROSONIC RAM 32GB ', 6, 280.09, '2023-05-06', 2, 1),
('P000', 24, 'MICROSONIC 3ER GEN 10', 3, 488.3, '2023-05-10', 5, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cod_categoria`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`cod_estado`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_categoria` (`codcategoria`),
  ADD KEY `fk_estado` (`codestado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cod_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `cod_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`codestado`) REFERENCES `estado` (`cod_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`codcategoria`) REFERENCES `categoria` (`cod_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
