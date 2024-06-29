-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2023 a las 02:21:39
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basedatos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mates`
--

CREATE TABLE `mates` (
  `id_mate` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `imagen` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mates`
--

INSERT INTO `mates` (`id_mate`, `nombre`, `precio`, `codigo`, `imagen`) VALUES
(1, 'TORPEDO', 5500, 'T01', 'imgs/torpedo.png'),
(2, 'IMPERIAL', 7000, 'IM01', 'imgs/imperial.png'),
(6, 'Camionero', 6000, 'CAM01', 'imgs/camionero.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(8) UNSIGNED NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `APELLIDO` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `CLAVE` varchar(100) DEFAULT NULL,
  `NIVEL` varchar(100) DEFAULT NULL,
  `FECHA_ALTA` datetime DEFAULT NULL,
  `ESTADO` enum('activo','banneado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `NOMBRE`, `APELLIDO`, `EMAIL`, `CLAVE`, `NIVEL`, `FECHA_ALTA`, `ESTADO`) VALUES
(1, 'Santino', 'Fazio', 'tatofa43@gmail.com', '1234', 'Admin', '2014-11-06 21:35:46', 'activo'),
(7, 'tato', 'FAZIO', 'santino.fazio@davinci.edu.ar', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin', '2022-12-08 11:08:42', 'activo'),
(8, 'tato', 'FAZIO', 'aaa@gm.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin', '2022-12-10 20:46:40', 'banneado'),
(9, 'tato', 'fa', 'tt@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin', '2023-07-09 11:28:31', 'activo'),
(10, 'tati', 'fa', 'tati@g.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin', '2023-08-04 10:39:59', 'activo'),
(12, 'santino', 'fazio', 'santino@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'usuario', '2023-08-09 20:56:09', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mates`
--
ALTER TABLE `mates`
  ADD PRIMARY KEY (`id_mate`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mates`
--
ALTER TABLE `mates`
  MODIFY `id_mate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
