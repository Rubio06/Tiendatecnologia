-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2023 a las 18:27:34
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
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `codcliente` varchar(50) NOT NULL,
  `cliente_codigo` int(11) NOT NULL,
  `cliente_nombre` varchar(50) NOT NULL,
  `cliente_apellido` varchar(50) NOT NULL,
  `cliente_sexo` varchar(50) NOT NULL,
  `cliente_correo` varchar(100) NOT NULL,
  `cliente_telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`codcliente`, `cliente_codigo`, `cliente_nombre`, `cliente_apellido`, `cliente_sexo`, `cliente_correo`, `cliente_telefono`) VALUES
('CL000', 1, 'No existe', 'No existe', 'No existe', 'No existe', 0),
('CL000', 9, 'Samuel', 'Rubio Paucar', 'Masculino', '155', 947204863);

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
-- Estructura de tabla para la tabla `listar_productos`
--

CREATE TABLE `listar_productos` (
  `listar_id` int(11) NOT NULL,
  `listar_nombre` varchar(50) NOT NULL,
  `listar_cantidad` int(11) NOT NULL,
  `listar_precio` float NOT NULL,
  `listar_fecharegistro` date NOT NULL,
  `listar_categoria` varchar(50) NOT NULL,
  `listar_estado` varchar(50) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fk_productos` int(11) NOT NULL,
  `fk_codcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `listar_productos`
--

INSERT INTO `listar_productos` (`listar_id`, `listar_nombre`, `listar_cantidad`, `listar_precio`, `listar_fecharegistro`, `listar_categoria`, `listar_estado`, `fecha_registro`, `fk_productos`, `fk_codcliente`) VALUES
(1, 'Enoc Rubio', 3, 2.55, '0000-00-00', 'MEMORIA RAM', 'INACTIVO', '2023-07-19 18:51:14', 50, 1),
(2, 'PROCE. I310400 Hz 16', 2, 145, '0000-00-00', 'MEMORIA RAM', 'INACTIVO', '2023-07-19 22:52:46', 46, 1),
(3, 'PROCE. I310400 Hz 16', 2, 145, '0000-00-00', 'MEMORIA RAM', 'INACTIVO', '2023-07-19 22:52:53', 51, 1);

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
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `codcategoria` int(11) NOT NULL,
  `codestado` int(11) NOT NULL,
  `fk_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codpro`, `codigo`, `nombre`, `cantidad`, `precio`, `fecha_registro`, `codcategoria`, `codestado`, `fk_cliente`) VALUES
('P000', 45, 'RTX1650 Ti', 16, 168.66, '2023-07-19 18:13:44', 1, 2, 1),
('P000', 46, 'PROCE. I310400 Hz 16', 181, 145, '2023-07-19 18:14:12', 2, 2, 1),
('P000', 50, 'Enoc Rubio', 27, 2.55, '2023-07-19 18:16:16', 2, 2, 1),
('P00046', 51, 'PROCE. I310400 Hz 16', 16, 145, '2023-07-19 18:50:36', 2, 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cod_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_codigo`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`cod_estado`);

--
-- Indices de la tabla `listar_productos`
--
ALTER TABLE `listar_productos`
  ADD PRIMARY KEY (`listar_id`),
  ADD KEY `fk_productos` (`fk_productos`),
  ADD KEY `fk_cliente` (`fk_codcliente`);

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
  ADD KEY `fk_estado` (`codestado`),
  ADD KEY `fk_cliente` (`fk_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cod_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `cod_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `listar_productos`
--
ALTER TABLE `listar_productos`
  MODIFY `listar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `listar_productos`
--
ALTER TABLE `listar_productos`
  ADD CONSTRAINT `listar_productos_ibfk_1` FOREIGN KEY (`fk_productos`) REFERENCES `producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `listar_productos_ibfk_2` FOREIGN KEY (`fk_codcliente`) REFERENCES `cliente` (`cliente_codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`codestado`) REFERENCES `estado` (`cod_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`codcategoria`) REFERENCES `categoria` (`cod_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`fk_cliente`) REFERENCES `cliente` (`cliente_codigo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
