-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2016 a las 09:45:51
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bse_events`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_menu`(IN `ve_opcion` VARCHAR(50), IN `ve_personaID` INT, IN `ve_grupoID` INT)
    NO SQL
BEGIN 

IF ve_opcion = 'opc_mostrargrupos' THEN
	select distinct(g.Gru_nombre), g.Gru_idGrupo
	from rol_usuario ru 
    inner join permiso pe on pe.Rol_idRol = ru.Rol_idRol
    inner join tarea t on t.Tar_idTarea = pe.Tar_idTarea
    inner join grupo g on g.Gru_idGrupo = t.Gru_idGrupo
    where ru.Per_idPersona = ve_personaID 
    		and t.Tar_estado=1 and g.Gru_estado = 1;
END IF;

IF ve_opcion = 'opc_mostrartareas' THEN
	select t.Tar_nombre, t.Tar_URL
		from rol_usuario ru 
	    inner join permiso pe on pe.Rol_idRol = ru.Rol_idRol
	    inner join tarea t on t.Tar_idTarea = pe.Tar_idTarea
	    inner join grupo g on g.Gru_idGrupo = t.Gru_idGrupo
    where ru.Per_idPersona = ve_personaID and g.Gru_idGrupo = ve_grupoID
    		and t.Tar_estado=1 and g.Gru_estado = 1;            
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_usuario`(IN `ve_opcion` VARCHAR(50), IN `ve_usuario` VARCHAR(50), IN `ve_password` VARCHAR(50))
    NO SQL
BEGIN
IF ve_opcion='opc_login_respuesta' THEN
	SET @CORRECTO = (SELECT COUNT(*) 
			FROM  usuario usu 
			WHERE 
				usu.Usu_login = ve_usuario AND
				usu.Usu_pass = ve_password);
			IF @CORRECTO>0 THEN
				SELECT '1' AS 'respuesta';
			ELSE
				SELECT 'Usuario o clave incorrectos' AS 'respuesta';
			END IF;
END IF;

IF ve_opcion='opc_login_listar' THEN
	select u.Per_idPersona, u.Usu_login, pe.Pers_codigo, p.Per_dni, pe.Suc_idSucursal, s.Suc_nombre
    	from usuario u 
        join persona p on p.Per_idPersona = u.Per_idPersona
        join personal pe on pe.Per_idPersona = p.Per_idPersona
        join sucursal s on s.Suc_idSucursal = pe.Suc_idSucursal
        where u.Usu_login = ve_usuario and u.Usu_pass = ve_password;
END IF;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificacion`
--

CREATE TABLE IF NOT EXISTS `certificacion` (
  `Cert_idCertificacion` int(11) NOT NULL AUTO_INCREMENT,
  `Cert_descripcion` varchar(200) NOT NULL,
  `Cert_institucion` varchar(200) NOT NULL,
  `Pon_idPonente` int(11) NOT NULL,
  `Cert_fechaCertificacion` date DEFAULT NULL,
  `Cert_paisCertificacion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Cert_idCertificacion`),
  KEY `Pon_idPonente` (`Pon_idPonente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `Emp_idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `Emp_RUC` char(11) NOT NULL,
  `Emp_razonSocial` varchar(100) NOT NULL,
  `Emp_direccionPrincipal` varchar(150) NOT NULL,
  `Emp_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Emp_idEmpresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`Emp_idEmpresa`, `Emp_RUC`, `Emp_razonSocial`, `Emp_direccionPrincipal`, `Emp_estado`) VALUES
(1, '12345678901', 'Business Solution Enterprise S.A.C.', 'Dirección de BSE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especializacion`
--

CREATE TABLE IF NOT EXISTS `especializacion` (
  `Espec_idEspecializacion` int(11) NOT NULL AUTO_INCREMENT,
  `Pon_idPonente` int(11) NOT NULL,
  `Espec_nombreEspecializacion` varchar(200) NOT NULL,
  `Espec_institutoEspecializacion` varchar(200) NOT NULL,
  `Espec_fechaEspecializacion` date DEFAULT NULL,
  `Espec_paisEspecializacion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Espec_idEspecializacion`),
  KEY `Pon_idPonente` (`Pon_idPonente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `Even_idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `Suc_idSucursal` int(11) NOT NULL,
  `Even_nombre` varchar(200) NOT NULL,
  `Even_descripcion` varchar(500) NOT NULL,
  `Even_duracion` varchar(100) NOT NULL,
  `Even_fechaInicio` date NOT NULL,
  `Even_fechaFin` date NOT NULL,
  `Even_precioTotal` double NOT NULL,
  `Even_estado` int(11) NOT NULL,
  PRIMARY KEY (`Even_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `Gru_idGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `Gru_nombre` varchar(50) NOT NULL,
  `Gru_descripcion` varchar(100) NOT NULL,
  `Gru_orden` int(11) DEFAULT NULL,
  `Gru_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Gru_idGrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`Gru_idGrupo`, `Gru_nombre`, `Gru_descripcion`, `Gru_orden`, `Gru_estado`) VALUES
(1, 'Parametros Generales', 'Modulo de parametros generales del sistema', 1, 1),
(2, 'Acceso y Seguridad', 'Modulo para el control de accesos y seguridad del sistema', 2, 1),
(3, 'Auditoria', 'Modulo para la realizacion de la auditoria del sistema', 3, 1),
(4, 'Mantenedores', 'Modulo para las tablas maestras del sistema', 4, 1),
(5, 'Gestion de Eventos', 'Modulo para la gestion de eventos realizados por BSE', 5, 1),
(6, 'Facturacion', 'Modulo para la realizacion de las facturaciones de cada evento', 6, 1),
(7, 'Reportes', 'Modulo para la generacion de los reportes necesarios para la toma de decisiones.', 7, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `Mod_idModulo` int(11) NOT NULL AUTO_INCREMENT,
  `Mod_descripcion` varchar(50) NOT NULL,
  `Mod_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Mod_idModulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`Mod_idModulo`, `Mod_descripcion`, `Mod_estado`) VALUES
(1, 'Sistema', 1),
(2, 'Mantenedores', 1),
(3, 'Eventos', 1),
(4, 'Facturacion', 1),
(5, 'Reportes', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE IF NOT EXISTS `participante` (
  `Par_idParticipante` int(11) NOT NULL AUTO_INCREMENT,
  `Per_idPersona` int(11) NOT NULL,
  `Par_nivel` varchar(50) NOT NULL,
  `Par_carreraProfesional` varchar(50) NOT NULL,
  `Par_centroTrabajo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Par_idParticipante`),
  KEY `Per_idPersona` (`Per_idPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
  `Pso_idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `Rol_idRol` int(11) NOT NULL,
  `Tar_idTarea` int(11) NOT NULL,
  `Pso_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Pso_idPermiso`),
  KEY `Rol_idRol` (`Rol_idRol`),
  KEY `Tar_idTarea` (`Tar_idTarea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`Pso_idPermiso`, `Rol_idRol`, `Tar_idTarea`, `Pso_estado`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `Per_idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `Per_nombres` varchar(100) NOT NULL,
  `Per_apellidos` varchar(100) NOT NULL,
  `Per_dni` char(8) NOT NULL,
  `Per_direccion` varchar(150) DEFAULT NULL,
  `Per_fechaNacimiento` date DEFAULT NULL,
  `Per_telefonoFijo` varchar(15) DEFAULT NULL,
  `Per_telefonoMovil` varchar(15) DEFAULT NULL,
  `Per_email` varchar(50) DEFAULT NULL,
  `Per_estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Per_idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`Per_idPersona`, `Per_nombres`, `Per_apellidos`, `Per_dni`, `Per_direccion`, `Per_fechaNacimiento`, `Per_telefonoFijo`, `Per_telefonoMovil`, `Per_email`, `Per_estado`) VALUES
(1, 'Alberto', 'Mendoza de los Santos', '12345678', 'Direccion del ing. Mendoza', '2016-11-03', '044192837', '949147839', 'amds@yahoo.es', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `Per_idPersona` int(11) NOT NULL,
  `Pers_codigo` varchar(15) NOT NULL,
  `Pers_fechaIngreso` date NOT NULL,
  `Pers_fechaSalida` date DEFAULT NULL,
  `Suc_idSucursal` int(11) NOT NULL,
  `Pers_estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Per_idPersona`),
  KEY `Suc_idSucursal` (`Suc_idSucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`Per_idPersona`, `Pers_codigo`, `Pers_fechaIngreso`, `Pers_fechaSalida`, `Suc_idSucursal`, `Pers_estado`) VALUES
(1, 'AMDS01', '2016-11-03', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ponente`
--

CREATE TABLE IF NOT EXISTS `ponente` (
  `Pon_idPonente` int(11) NOT NULL AUTO_INCREMENT,
  `Pon_nombre` varchar(100) NOT NULL,
  `Pon_apellidos` varchar(100) NOT NULL,
  `TipoDocId_idTipoDocumentoIdentidad` int(11) NOT NULL,
  `Pon_numeroDocumentoIdentidad` varchar(20) DEFAULT NULL,
  `Pon_carreraProfesional` varchar(50) DEFAULT NULL,
  `Pon_fechaNacimiento` date DEFAULT NULL,
  `Pon_nacionalidad` varchar(50) DEFAULT NULL,
  `Pon_estadoLaboral` varchar(50) DEFAULT NULL,
  `Pon_hojaVida` varchar(500) DEFAULT NULL,
  `Pon_centroTrabajoActual` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Pon_idPonente`),
  KEY `TipoDocId_idTipoDocumentoIdentidad` (`TipoDocId_idTipoDocumentoIdentidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `Rol_idRol` int(11) NOT NULL AUTO_INCREMENT,
  `Rol_nombre` varchar(50) NOT NULL,
  `Rol_descripcion` varchar(100) NOT NULL,
  `Rol_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Rol_idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Rol_idRol`, `Rol_nombre`, `Rol_descripcion`, `Rol_estado`) VALUES
(1, 'Administrador', 'Rol que se le asignara al administrador del sistema', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE IF NOT EXISTS `rol_usuario` (
  `RolUs_idRolUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Rol_idRol` int(11) NOT NULL,
  `Per_idPersona` int(11) NOT NULL,
  `RolUs_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`RolUs_idRolUsuario`),
  KEY `Rol_idRol` (`Rol_idRol`),
  KEY `Per_idPersona` (`Per_idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`RolUs_idRolUsuario`, `Rol_idRol`, `Per_idPersona`, `RolUs_estado`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE IF NOT EXISTS `sucursal` (
  `Suc_idSucursal` int(11) NOT NULL AUTO_INCREMENT,
  `Suc_nombre` varchar(100) NOT NULL,
  `Suc_direccion` varchar(150) NOT NULL,
  `Suc_estado` tinyint(1) NOT NULL,
  `Emp_idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`Suc_idSucursal`),
  KEY `Emp_idEmpresa` (`Emp_idEmpresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`Suc_idSucursal`, `Suc_nombre`, `Suc_direccion`, `Suc_estado`, `Emp_idEmpresa`) VALUES
(1, 'BSE Events', 'Dirección de BSE', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE IF NOT EXISTS `tarea` (
  `Tar_idTarea` int(11) NOT NULL AUTO_INCREMENT,
  `Mod_idModulo` int(11) NOT NULL,
  `Gru_idGrupo` int(11) NOT NULL,
  `Tar_nombre` varchar(50) NOT NULL,
  `Tar_descripcion` varchar(100) NOT NULL,
  `Tar_orden` int(11) DEFAULT NULL,
  `Tar_url` varchar(50) NOT NULL,
  `Tar_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Tar_idTarea`),
  KEY `Mod_idModulo` (`Mod_idModulo`),
  KEY `Gru_idGrupo` (`Gru_idGrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`Tar_idTarea`, `Mod_idModulo`, `Gru_idGrupo`, `Tar_nombre`, `Tar_descripcion`, `Tar_orden`, `Tar_url`, `Tar_estado`) VALUES
(1, 1, 1, 'Grupos', 'Grupos', 1, '../param_generales/grupos.php', 1),
(2, 1, 1, 'Opciones', 'Opciones', 2, '../param_generales/opciones.php', 1),
(3, 1, 1, 'Roles', 'Roles', 3, '../param_generales/roles.php', 1),
(4, 1, 1, 'Multitabla', 'Multitabla', 4, '../param_generales/multitabla.php', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumentoidentidad`
--

CREATE TABLE IF NOT EXISTS `tipodocumentoidentidad` (
  `TipoDocId_idTipoDocumentoIdentidad` int(11) NOT NULL AUTO_INCREMENT,
  `TipoDocId_descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`TipoDocId_idTipoDocumentoIdentidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `Per_idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `Usu_login` varchar(30) NOT NULL,
  `Usu_pass` varchar(32) NOT NULL,
  `Usu_estado` tinyint(1) NOT NULL,
  `Usu_fechaCese` date DEFAULT NULL,
  `Suc_idSucursal` int(11) NOT NULL,
  PRIMARY KEY (`Per_idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Per_idPersona`, `Usu_login`, `Usu_pass`, `Usu_estado`, `Usu_fechaCese`, `Suc_idSucursal`) VALUES
(1, 'amds', '202cb962ac59075b964b07152d234b70', 1, NULL, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `certificacion`
--
ALTER TABLE `certificacion`
  ADD CONSTRAINT `certificacion_ibfk_1` FOREIGN KEY (`Pon_idPonente`) REFERENCES `ponente` (`Pon_idPonente`);

--
-- Filtros para la tabla `especializacion`
--
ALTER TABLE `especializacion`
  ADD CONSTRAINT `especializacion_ibfk_1` FOREIGN KEY (`Pon_idPonente`) REFERENCES `ponente` (`Pon_idPonente`);

--
-- Filtros para la tabla `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `participante_ibfk_1` FOREIGN KEY (`Per_idPersona`) REFERENCES `persona` (`Per_idPersona`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`Rol_idRol`) REFERENCES `rol` (`Rol_idRol`),
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`Tar_idTarea`) REFERENCES `tarea` (`Tar_idTarea`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`Per_idPersona`) REFERENCES `persona` (`Per_idPersona`),
  ADD CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`Suc_idSucursal`) REFERENCES `sucursal` (`Suc_idSucursal`);

--
-- Filtros para la tabla `ponente`
--
ALTER TABLE `ponente`
  ADD CONSTRAINT `ponente_ibfk_1` FOREIGN KEY (`TipoDocId_idTipoDocumentoIdentidad`) REFERENCES `tipodocumentoidentidad` (`TipoDocId_idTipoDocumentoIdentidad`);

--
-- Filtros para la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD CONSTRAINT `rol_usuario_ibfk_1` FOREIGN KEY (`Rol_idRol`) REFERENCES `rol` (`Rol_idRol`),
  ADD CONSTRAINT `rol_usuario_ibfk_2` FOREIGN KEY (`Per_idPersona`) REFERENCES `usuario` (`Per_idPersona`);

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`Emp_idEmpresa`) REFERENCES `empresa` (`Emp_idEmpresa`);

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`Mod_idModulo`) REFERENCES `modulo` (`Mod_idModulo`),
  ADD CONSTRAINT `tarea_ibfk_2` FOREIGN KEY (`Gru_idGrupo`) REFERENCES `grupo` (`Gru_idGrupo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Per_idPersona`) REFERENCES `personal` (`Per_idPersona`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
