-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2020 a las 21:29:05
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `IdAula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`IdAula`) VALUES
(0),
(108);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `IdReserva` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `IdAula` int(11) NOT NULL,
  `Hora` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `MailProfesor` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`IdReserva`, `IdAula`, `Hora`, `Fecha`, `MailProfesor`) VALUES
('108 1 19 11:00', 108, '11:00', '19/1', 'carlos.furones@iesabastos.org'),
('108 1 6 9:45', 108, '9:45', '6/1', 'carlos.furones@iesabastos.org'),
('108 1 9 11:55', 108, '11:55', '9/1', 'carlos.furones@iesabastos.org');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Mail` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Password` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `DadoAlta` tinyint(1) NOT NULL,
  `Imagen` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Mail`, `Apellido`, `Password`, `Admin`, `DadoAlta`, `Imagen`, `Nombre`) VALUES
('admin.admin@iesabastos.org', 'admin', 'dgwIXdKY4piJ6', 1, 1, 'jpg', 'admin'),
('carlos.furones@iesabastos.org', 'Furones', 'dgYMBp6Y2qzdo', 0, 0, 'png', 'Carlos'),
('heike.bonilla@iesabastos.org', 'Bonilla', 'dgwIXdKY4piJ6', 0, 0, 'jpeg', 'Heike'),
('vicent.tortosa@iesabastos.org', 'Tortosa', 'dgwIXdKY4piJ6', 0, 0, 'gif', 'Vicent');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`IdAula`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`IdReserva`),
  ADD KEY `IdAula` (`IdAula`),
  ADD KEY `MailProfesor` (`MailProfesor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Mail`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`IdAula`) REFERENCES `aula` (`IdAula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`MailProfesor`) REFERENCES `usuario` (`Mail`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
