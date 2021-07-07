-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 05-07-2021 a las 06:48:52
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_hnf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idPersonaD` int(11) NOT NULL,
  `idPersonaP` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `idEspecialidad` int(11) NOT NULL,
  `estado` binary(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idPersonaD`, `idPersonaP`, `id`, `fecha`, `hora`, `idEspecialidad`, `estado`) VALUES
(12, 13, 1, '2021-07-15', '10:00:00', 6, 0x30),
(27, 16, 2, '2021-08-04', '10:00:00', 6, 0x31),
(13, 12, 4, '2021-08-04', '10:00:00', 6, 0x31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `id` int(11) NOT NULL,
  `idCita` int(11) NOT NULL,
  `sintomas` varchar(200) NOT NULL,
  `tratamiento` varchar(200) NOT NULL,
  `peso` decimal(3,0) NOT NULL,
  `estatura` decimal(3,2) NOT NULL,
  `presión_arterial` varchar(100) NOT NULL,
  `anamnesis` varchar(250) DEFAULT NULL,
  `diagnostico` varchar(200) NOT NULL,
  `fecha_proximo_control` date NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `imc` decimal(10,0) NOT NULL,
  `hemoglucotest` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consulta`
--

INSERT INTO `consulta` (`id`, `idCita`, `sintomas`, `tratamiento`, `peso`, `estatura`, `presión_arterial`, `anamnesis`, `diagnostico`, `fecha_proximo_control`, `fecha`, `hora`, `imc`, `hemoglucotest`) VALUES
(1, 1, 'deterorio de memoria, dificultad para concentrarse', '1 pastilla Aricept diaria', '120', '1.51', '120/80', NULL, 'Alzheimer', '2021-06-13', '2021-06-07', '10:00:00', '20', '80 mg/dL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `estado` binary(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id`, `nombre`, `estado`) VALUES
(1, 'Cardiología', 0x31),
(2, 'Radiología', 0x31),
(3, 'Neurología', 0x31),
(4, 'Psiquiatría', 0x31),
(5, 'Ginecología', 0x31),
(6, 'Pediatría', 0x31),
(7, 'Gastroenterología', 0x31),
(8, 'Odontología', 0x30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `telefono` varchar(13) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `ciudadResi` varchar(50) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `genero` varchar(100) NOT NULL,
  `estado` binary(1) NOT NULL,
  `idTipoPersona` int(11) NOT NULL,
  `idPersona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `cedula`, `email`, `telefono`, `direccion`, `ciudadResi`, `fechaNacimiento`, `genero`, `estado`, `idTipoPersona`, `idPersona`) VALUES
(2, 'Alisson Maria', 'Mera Cantos', '1316894231', 'correo2@correo.com', '0994521786', 'Av 24 Calle 16 y 17', 'Manta', '1998-03-05', 'Femenino', 0x31, 2, NULL),
(3, 'Juan Carlos', 'Cevallos Reyes', '1305487262', 'correo@correo.com', '0945289421', 'Av 24 Calle 16 y 17', 'Manta', '1998-03-05', 'Masculino', 0x31, 3, 2),
(4, 'Carlos Luis', 'Poveda Palacios', '1314895210', 'correo17@correo.com', '0948261791', 'Av 24 Calle 16 y 17', 'Manta', '1998-03-05', 'Masculino', 0x31, 4, NULL),
(11, 'sfsdfasdfsd', 'dfvsdvsdva', '1304521062', 'cdsvfdvf@correo.com', '0981166521', 'Av ## Calle ##', 'Manta', '1998-03-05', 'Femenino', 0x31, 2, NULL),
(12, 'Roberto Carlos', 'Cevallos Villavicencio', '1312654820', 'cliente4@cliente4.com', '0926418532', '0926418532', 'Manta', '1998-03-05', 'Masculino', 0x31, 2, NULL),
(13, 'Alisson Maria', 'Zúñiga Palacios', '1304852165', 'medico@medico.com', '0963217502', 'Av ## Calle ##', 'Manta', '2021-06-04', 'Femenino', 0x31, 4, NULL),
(14, 'Anahí Elisa', 'Lucas Rivera', '1316589423', 'medico1@medico.com', '098521623754', 'Av ## Calle ##', 'Manta', '2021-06-13', 'Femenino', 0x30, 4, NULL),
(15, 'Diana', 'Torres', '1104154743', 'datorres@utpl.edu.ec', '0987526482', 'Av ## Calle ##', 'Loga', '1993-06-17', 'Femenino', 0x31, 4, NULL),
(16, 'Diego Fernando', 'Utreras Villavicencio', '1312245671', 'clienteD@cliente.com', '0980283969', '0980283969', 'Manta', '1998-03-05', 'Masculino', 0x31, 2, NULL),
(27, 'Frank Dereck', 'Fulano Sultano', '1316621448', 'medico8@medico.com', '0984518967', 'Av ## Calle ##', 'Portoviejo', '2004-08-15', 'Masculino', 0x31, 4, NULL),
(28, 'Rolando Raul', 'Lopez Cedeño', '1316621460', 'medico9@medico.com', '0984518980', 'Av ## Calle ##', 'Portoviejo', '2004-08-17', 'Masculino', 0x31, 4, NULL),
(29, 'Pedro Jaime', 'Palacios Saltos', '1304852691', 'Pedro@correo.com', '0984361970', 'Av ## Calle ##', 'Manta', '1999-07-06', 'Masculino', 0x31, 2, NULL),
(30, 'María Emilia', 'Arteaga Parrales', '1316982640', 'Maria@correo.com', '0945269721', 'Av ## Calle ##', 'Manta', '2000-06-12', 'Femenino', 0x31, 2, NULL),
(31, 'Francisco', 'Saldarriaga', '1319821934', 'Francisco@correo.com', '0942597361', 'Av ## Calle ##', 'Manta', '1993-09-15', 'Masculino', 0x31, 4, NULL),
(32, 'Juan', 'Lopez', '1305486200', 'Juan@correo.com', '0987521694', 'Av ## Calle ##', 'Manta', '1990-11-05', 'Masculino', 0x31, 4, NULL),
(33, 'Pablo', 'Zurita', '1309426872', 'Zurita@correo.com', '0987523641', 'Av ## Calle ##', 'Manta', '2000-07-12', 'Masculino', 0x31, 2, NULL),
(34, 'Sebastian', 'Pineda', '1316854291', 'Sebastian@correo.com', '0964826513', 'Av ## Calle ##', 'Manta', '1999-10-25', 'Masculino', 0x31, 3, NULL),
(35, 'Kevin', 'Rodriguez', '1304862190', 'Kevin@correo.com', '0984513642', 'Av ## Calle ##', 'Manta', '1997-12-15', 'Masculino', 0x31, 3, NULL),
(36, 'Antonio', 'Barriga', '1304981264', 'Antonio@correo.com', '0987562413', 'Av ## Calle ##', 'Manta', '1996-08-16', 'Masculino', 0x31, 3, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_especialidad`
--

CREATE TABLE `persona_especialidad` (
  `idEspecialidad` int(3) NOT NULL,
  `idPersona` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona_especialidad`
--

INSERT INTO `persona_especialidad` (`idEspecialidad`, `idPersona`) VALUES
(3, 4),
(3, 31),
(7, 31),
(4, 32),
(6, 32),
(6, 27),
(7, 15),
(6, 28),
(6, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_examen`
--

CREATE TABLE `solicitud_examen` (
  `id` int(11) NOT NULL,
  `idConsulta` int(11) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  `idTipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitud_examen`
--

INSERT INTO `solicitud_examen` (`id`, `idConsulta`, `detalle`, `idTipo`) VALUES
(1, 1, 'hemograma completo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_examen`
--

CREATE TABLE `tipos_examen` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos_examen`
--

INSERT INTO `tipos_examen` (`id`, `nombre`) VALUES
(1, 'Sangre'),
(2, 'Heces'),
(3, 'Orina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_personas`
--

CREATE TABLE `tipo_personas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_personas`
--

INSERT INTO `tipo_personas` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'Paciente'),
(4, 'Médico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `idPersona` int(11) DEFAULT NULL,
  `estado` binary(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `created_at`, `updated_at`, `remember_token`, `idPersona`, `estado`) VALUES
(7, 'cliente', 'clienteUser', 'cdsvfdvf@correo.com', '$2y$10$yORLHOYrabxRj51zGL0tmuXlKfPZDJ8oej4Y5NOuzuq0dT2BPt7wG', '2021-06-23 17:19:46', '2021-06-23 17:19:46', 'S1qADYfGCr8w4n4m0uaS7N6N7xfOJ7wW8aCQWTZYoOOmYN6HwLm6OHCpKUMv', 11, 0x31),
(8, 'cliente', 'C1312654820', 'cliente4@cliente4.com', '$2y$10$EGLlKGzuND83.RLaJ.L2uOYmFvbqfROyq5zzWu0jhsj4uHefpbLA2', '2021-06-28 17:43:11', '2021-06-28 17:43:11', 'bWGiH2PyJlWr0ZcfpVNbhkekzponuBfwGN15B0Z75WSfDexPypKn2SMoneKK', 12, 0x31),
(9, 'medico', 'D1304852165', 'medico@medico.com', '$2y$10$S3Oz6Bi8EfqlQ05mYWo0w.yWo4W.N2sqcfJv4p4ODUrwP9OT2cpAy', '2021-06-29 23:44:07', '2021-06-29 23:44:07', NULL, 13, 0x31),
(10, 'medico', 'D1316589423', 'medico1@medico.com', '$2y$10$2FBjv5p9fDwzVS.dSRpd3eeazRycOYoxCSMAKRLxxXOQnz.sGNJyK', '2021-06-29 23:57:31', '2021-06-30 04:31:17', NULL, 14, 0x30),
(11, 'medico', 'D1104154743', 'datorres@utpl.edu.ec', '$2y$10$k6ZawkAi1K/6aq7zhzYsgeb3OsYJapjhzkCkPABePOgqCPs0hyZrm', '2021-06-30 15:00:31', '2021-06-30 15:00:31', NULL, 15, 0x31),
(12, 'cliente', 'C1312245671', 'clienteD@cliente.com', '$2y$10$27MEupa/TFvXavIsnouB5.5eiRS9B63ncZZtLXwqfvtOkqo3l32zO', '2021-07-01 03:56:37', '2021-07-01 03:56:37', NULL, 16, 0x31),
(13, 'medico', 'D1314895210', 'correo17@correo.com', '12345678', NULL, NULL, NULL, 4, 0x31),
(14, 'medico', 'D1316621448', 'medico8@medico.com', '$2y$10$UuaOq9UbLrXSZ1o507VTj.l.3Zcg5quqJ3.EXHk.bFXfeKXlaRt9q', '2021-07-04 00:30:33', '2021-07-04 00:30:33', NULL, 27, 0x31),
(25, 'medico', 'D1316621460', 'medico9@medico.com', '12345678', '2021-07-04 03:29:13', '2021-07-04 03:29:13', NULL, 28, 0x31),
(26, 'cliente', 'C1304852691', 'Pedro@correo.com', '$2y$10$92dDfchVgCsGvtXAf9zUR.hNaW8W9Tvu4nGF4c/.ecoN0P1MZeC4q', '2021-07-04 03:40:20', '2021-07-04 03:40:20', NULL, 29, 0x31),
(27, 'cliente', 'C1316982640', 'Maria@correo.com', '$2y$10$TouSYdfViifRKGPLmQLvru/8upc4N9a7d7P8So02ANCBbTiWK8lJC', '2021-07-04 03:42:30', '2021-07-04 03:42:30', NULL, 30, 0x31),
(28, 'medico', 'D1319821934', 'Francisco@correo.com', '$2y$10$Ezpsc7R7lnTprMFxFtmJ6.SLBV7QA..qvpF.wxI/JJ6GJEg1y2EOq', '2021-07-04 22:24:13', '2021-07-04 22:24:13', NULL, 31, 0x31),
(29, 'medico', 'D1305486200', 'Juan@correo.com', '$2y$10$TKvYJsiNXKbaSs5CHZUjjebflL/1HqLfEOmT5ZF6IYTugTU5ViJhW', '2021-07-04 22:30:35', '2021-07-04 22:30:35', NULL, 32, 0x31),
(30, 'cliente', 'C1309426872', 'Zurita@correo.com', '$2y$10$Xf/D2xaQcoLMhVqkgjfKFuRGuDQ6xIL/41kv4eYWsFYIsOQTgfMiC', '2021-07-04 22:50:53', '2021-07-04 22:50:53', NULL, 33, 0x31);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `citas_FK` (`idPersonaD`),
  ADD KEY `citas_FK_1` (`idPersonaP`),
  ADD KEY `citas_FK_2` (`idEspecialidad`);

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consulta_FK` (`idCita`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personas_FK` (`idTipoPersona`),
  ADD KEY `personas_FK_1` (`idPersona`);

--
-- Indices de la tabla `persona_especialidad`
--
ALTER TABLE `persona_especialidad`
  ADD KEY `personaEspecialidad_FK` (`idEspecialidad`),
  ADD KEY `personaEspecialidad_FK_1` (`idPersona`);

--
-- Indices de la tabla `solicitud_examen`
--
ALTER TABLE `solicitud_examen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_examen_FK_1` (`idTipo`),
  ADD KEY `solicitud_examen_FK` (`idConsulta`);

--
-- Indices de la tabla `tipos_examen`
--
ALTER TABLE `tipos_examen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_personas`
--
ALTER TABLE `tipo_personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_FK` (`idPersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `solicitud_examen`
--
ALTER TABLE `solicitud_examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipos_examen`
--
ALTER TABLE `tipos_examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_personas`
--
ALTER TABLE `tipo_personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_FK` FOREIGN KEY (`idPersonaD`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `citas_FK_1` FOREIGN KEY (`idPersonaP`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `citas_FK_2` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`id`);

--
-- Filtros para la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_FK` FOREIGN KEY (`idCita`) REFERENCES `citas` (`id`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_FK` FOREIGN KEY (`idTipoPersona`) REFERENCES `tipo_personas` (`id`),
  ADD CONSTRAINT `personas_FK_1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`id`);

--
-- Filtros para la tabla `persona_especialidad`
--
ALTER TABLE `persona_especialidad`
  ADD CONSTRAINT `personaEspecialidad_FK` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`id`),
  ADD CONSTRAINT `personaEspecialidad_FK_1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`id`);

--
-- Filtros para la tabla `solicitud_examen`
--
ALTER TABLE `solicitud_examen`
  ADD CONSTRAINT `solicitud_examen_FK` FOREIGN KEY (`idConsulta`) REFERENCES `consulta` (`id`),
  ADD CONSTRAINT `solicitud_examen_FK_1` FOREIGN KEY (`idTipo`) REFERENCES `tipos_examen` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_FK` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
