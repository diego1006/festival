-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2020 a las 03:55:20
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
-- Base de datos: `vallenato`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logistica`
--

CREATE TABLE `logistica` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish2_ci NOT NULL,
  `fechaNacimiento` text COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` text COLLATE utf8_spanish2_ci NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `estatura` text COLLATE utf8_spanish2_ci NOT NULL,
  `grupoSanguineo` text COLLATE utf8_spanish2_ci NOT NULL,
  `genero` text COLLATE utf8_spanish2_ci NOT NULL,
  `formacionAcademica` text COLLATE utf8_spanish2_ci NOT NULL,
  `ocupacion` text COLLATE utf8_spanish2_ci NOT NULL,
  `trabajoAnterior` tinyint(1) DEFAULT NULL,
  `direccion` text COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish2_ci NOT NULL,
  `celular` text COLLATE utf8_spanish2_ci NOT NULL,
  `archivos` text COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `logistica`
--

INSERT INTO `logistica` (`id`, `idUsuario`, `nombre`, `apellido`, `fechaNacimiento`, `ciudad`, `edad`, `estatura`, `grupoSanguineo`, `genero`, `formacionAcademica`, `ocupacion`, `trabajoAnterior`, `direccion`, `telefono`, `celular`, `archivos`, `estado`) VALUES
(1, 27, 'Wilson', 'López Dávila', '1994-05-26', 'Aguachica', 25, '1.75', 'O-', 'Hombre', 'Tecnólogo', 'Ing. Sistemas', 0, 'Carrera 21 #9-137', '565 7142', '314 564 7721', '../img/usuarios/wlopez@gmail.com/n8yfgieRCx.jpeg', 1),
(2, 28, '', '', '0000-00-00 00:00:00', '', NULL, '', '', '', '', '', NULL, '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medios`
--

CREATE TABLE `medios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish2_ci NOT NULL,
  `representante` text COLLATE utf8_spanish2_ci NOT NULL,
  `documento` text COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` text COLLATE utf8_spanish2_ci NOT NULL,
  `correo` text COLLATE utf8_spanish2_ci NOT NULL,
  `tipoMedio` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fechaRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `medios`
--

INSERT INTO `medios` (`id`, `nombre`, `representante`, `documento`, `telefono`, `direccion`, `ciudad`, `correo`, `tipoMedio`, `estado`, `fechaRegistro`) VALUES
(1, 'RCN', 'Juan me le guindo', '123456789', '3127809032', 'calle falsa 123', 'Pereira', 'rcn@rcn.com', 1, 1, '0000-00-00 00:00:00'),
(2, 'CARACOL', 'Juancha', '767676767', '31231231232', 'Calle 980', 'Bogotá', 'caracol@caracol.com', 3, 1, '0000-00-00 00:00:00'),
(3, 'WIN +', 'benito', '909090', '2222222222', 'Era av 5', 'manizales', 'win@win.com', 2, 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `documento` text COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish2_ci NOT NULL,
  `cargo` text COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish2_ci NOT NULL,
  `correo` text COLLATE utf8_spanish2_ci NOT NULL,
  `idMedio` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_medio`
--

CREATE TABLE `tipo_medio` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish2_ci NOT NULL,
  `cupo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_medio`
--

INSERT INTO `tipo_medio` (`id`, `nombre`, `cupo`) VALUES
(1, 'radio', 3),
(2, 'prensa', 2),
(3, 'TV', 2),
(4, 'web', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `documento` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `correoUsuario` text COLLATE utf8_spanish_ci NOT NULL,
  `emailEncriptado` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(3) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fechaIngreso` datetime NOT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `documento`, `usuario`, `correoUsuario`, `emailEncriptado`, `password`, `perfil`, `estado`, `ultimo_login`, `fechaIngreso`, `activo`) VALUES
(1, '0', 'admin', 'dpalacio0242@gmail.com', '', '$2a$07$usesomesillystringforegFOeQOp8RK/V8Yn0LZIZwSlh5IkndD.', 'Administrador', 1, '2020-03-06 21:54:31', '2019-02-20 16:24:42', b'1'),
(26, '123456789', 'juan', 'CEVILLALBA@MISENA.EDU.CO', '', '$2a$07$usesomesillystringforeGsJAIIu7nhlxWq.cvdNluLcR1KdMYnq', 'Medio', 1, '2020-03-06 21:34:15', '2019-12-30 15:44:11', b'1'),
(27, '1065904453', 'wlopez', 'wlopez@gmail.com', '', '$2a$07$usesomesillystringforegFOeQOp8RK/V8Yn0LZIZwSlh5IkndD.', 'Logística', 1, '2020-03-06 21:34:49', '2020-01-02 11:40:44', b'1'),
(28, '18917947', 'cevillalbas', 'cevillalbas@misena.edu.co', '', '$2a$07$usesomesillystringforegFOeQOp8RK/V8Yn0LZIZwSlh5IkndD.', 'Logística', 1, '2020-02-23 13:40:21', '2020-01-02 11:41:26', b'1'),
(29, '767676', 'mega', 'MEGA@MEGA.COM', '$2a$07$usesomesillystringforez8WNsX.JFvkC5jtV/6eRgjkycFhKSlu', '$2a$07$usesomesillystringforegFOeQOp8RK/V8Yn0LZIZwSlh5IkndD.', 'Medio', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', b'1'),
(30, '545454', 'espn', 'ESPN@ESPN.COM', '$2a$07$usesomesillystringforeJlNlB5v2056MonG.mVwIKv6T9AMxB0a', '$2a$07$usesomesillystringforegFOeQOp8RK/V8Yn0LZIZwSlh5IkndD.', 'Medio', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', b'1'),
(31, '212121', 'fox', 'FOX@FOX.COM', '$2a$07$usesomesillystringforeRq7XlRtxzW401jrrq5Cn7nmu0Qttdb2', '$2a$07$usesomesillystringforegFOeQOp8RK/V8Yn0LZIZwSlh5IkndD.', 'Medio', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', b'1'),
(32, '2323', 'hola', 'HOLA@HOLA.COM', '$2a$07$usesomesillystringfore/cOx1vGA9u/fE7Dx1ZABLWVAFCT1zB6', '$2a$07$usesomesillystringforegFOeQOp8RK/V8Yn0LZIZwSlh5IkndD.', 'Medio', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', b'1'),
(33, '333333', 'venus', 'VENUS@VENUS.COM', '$2a$07$usesomesillystringforevBehnnRg61WXZmdY/vwJbqTe3V0q9UO', '$2a$07$usesomesillystringforegFOeQOp8RK/V8Yn0LZIZwSlh5IkndD.', 'Medio', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', b'1'),
(34, '12345', 'parcela', 'PARCELA@PARCELA.COM', '$2a$07$usesomesillystringforeZMjuPl5tEKyTUP.SyASXMQABRfeaLiW', '$2a$07$usesomesillystringforegFOeQOp8RK/V8Yn0LZIZwSlh5IkndD.', 'Medio', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', b'1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `logistica`
--
ALTER TABLE `logistica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medios`
--
ALTER TABLE `medios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_medio`
--
ALTER TABLE `tipo_medio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `logistica`
--
ALTER TABLE `logistica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medios`
--
ALTER TABLE `medios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_medio`
--
ALTER TABLE `tipo_medio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
