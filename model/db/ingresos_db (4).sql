-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2016 a las 00:41:05
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ingresos_db`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`ecs1`@`localhost` PROCEDURE `sp_control_cliente`(IN `ve_opcion` VARCHAR(50), IN `ve_cliDNI` CHAR(8), IN `ve_cliNombre` VARCHAR(50), IN `ve_cliApellidoPaterno` VARCHAR(50), IN `ve_cliDireccion` VARCHAR(100), IN `ve_cliFijo` CHAR(9), IN `ve_cliCelular` CHAR(9), IN `ve_cliCorreo` VARCHAR(50), IN `ve_cliFeNacimiento` DATE, IN `ve_cliFeAniversario` DATE, IN `ve_cliLugarNacimiento` VARCHAR(50), IN `ve_cliMotivoAniversario` VARCHAR(100), IN `ve_cliApellidoMaterno` VARCHAR(50))
    NO SQL
BEGIN
IF ve_opcion = 'opc_grabar' THEN
	insert into persona(PERSO_dni,
                        PERSO_nombres,
                        PERSO_apellidoPaterno,
                        PERSO_apellidoMaterno,
                        PERSO_direccion,
                        PERSO_telefonoFijo,
                        PERSO_telefonoCelular,
                        PERSO_correo,
                        PERSO_fechaNacimiento)
                        values (ve_cliDNI,
                                ve_cliNombre,
                                ve_cliApellidoPaterno,
                                ve_cliApellidoMaterno,
                                ve_cliDireccion,
                                ve_cliFijo,
                                ve_cliCelular,
                                ve_cliCorreo,
                                ve_cliFeNacimiento);
    SET @variable = lower(concat(substring(ve_cliNombre,1,1),
                           ve_cliApellidoPaterno,
                           substring(ve_cliApellidoMaterno,1,1)));	
    insert into usuario(USU_login, USU_password) 
    		values (@variable, MD5(@variable));
    SET @usuario_ID = (select usu_id 
                       from usuario order by usu_id desc limit 1);
    insert into cliente(PERSO_dni,                          
                         CLI_fechaAniversario, 
                         CLI_motivoAniversario, 
                         CLI_tipoCliente, 
                         USU_id)
                        values (ve_cliDNI,
                                ve_cliFeAniversario,
                                ve_cliMotivoAniversario,
                                'Activo',                                
                                @usuario_ID);
END IF;

IF ve_opcion = 'opc_contar' THEN
	SELECT count(*) as total from cliente;
END IF;

IF ve_opcion='opc_listar' then	
	select c.CLI_id as codigo,     		
            concat(pe.PERSO_nombres,
            		' ',
                    pe.PERSO_apellidoPaterno,
                    ' ',
                    pe.PERSO_apellidoMaterno) as nombres, 
            pe.PERSO_correo as correo, 
            pe.PERSO_telefonoCelular as celular,
            c.CLI_tipoCliente as tipo,
            c.CLI_fechaAniversario as fechaAniversario,
            c.CLI_motivoAniversario as motivoAniversario
	from cliente c    
    join persona pe on pe.PERSO_dni=c.PERSO_dni;
END IF;
END$$

CREATE DEFINER=`ecs1`@`localhost` PROCEDURE `sp_control_documentoVenta`(IN `ve_opcion` VARCHAR(50), IN `ve_sucursal` INT)
    NO SQL
BEGIN
IF ve_opcion='opc_contarClientes' THEN
		SELECT 
			COUNT(*) AS total 
		FROM cliente;
END IF;
IF ve_opcion = 'opc_listarClientes' THEN
	select c.PERSO_dni as dni, 
    		concat(p.PERSO_nombres,' ',
                   PERSO_apellidoPaterno,' ',
                   PERSO_apellidoMaterno) as cliente 
     from persona p 
     join cliente c on c.PERSO_dni=p.PERSO_dni;
END IF;


IF ve_opcion='opc_contarPersonal' THEN
		SELECT 
			COUNT(*) AS total 
		FROM Personal where PERS_estado = 1;
END IF;
IF ve_opcion = 'opc_listarPersonal' THEN
	select pe.PERS_id as codigo, 
    		concat(p.PERSO_nombres,' ',
                   PERSO_apellidoPaterno,' ',
                   PERSO_apellidoMaterno) as personal
     from persona p 
     join personal pe on pe.PERSO_dni=p.PERSO_dni
     where pe.SUC_codigo = ve_sucursal and pe.PERS_estado=1
     order by pe.PERS_id;
END IF;


IF ve_opcion='opc_contarProductos' THEN
		SELECT 
			COUNT(*) AS total 
		FROM producto;
END IF;
IF ve_opcion = 'opc_listarProductos' THEN
	select 	p.PROD_codigoInterno as codigo, 
    		p.PROD_descripcion as producto,
            p.PROD_stock as stock,
            p.PROD_precioVenta as precio
     from producto p
     where p.SUC_codigo = ve_sucursal;
END IF;

IF ve_opcion='opc_contarServicios' THEN
		SELECT 
			COUNT(*) AS total 
		FROM servicio;
END IF;
IF ve_opcion = 'opc_listarServicios' THEN
	select 	se.SER_id as codigo, 
    		se.SER_descripcion as servicio,
            se.SER_precioBase as precioBase            
     from servicio se
     where se.SUC_codigo = ve_sucursal;
END IF;
END$$

CREATE DEFINER=`ecs1`@`localhost` PROCEDURE `sp_control_linea`(IN `ve_opcion` VARCHAR(50), IN `ve_lineaDescripcion` VARCHAR(50))
    NO SQL
BEGIN
IF ve_opcion='opc_grabar' THEN
	INSERT into linea(LIN_descripcion) values (ve_lineaDescripcion);
END IF;


IF ve_opcion='opc_contar' THEN
		SELECT 
			COUNT(*) AS total 
		FROM linea;
END IF;
IF ve_opcion='opc_listar' then	
		select 
			LIN_id as codigo, 
			LIN_descripcion as descripcion			 
	from linea;
END IF;
END$$

CREATE DEFINER=`ecs1`@`localhost` PROCEDURE `sp_control_marca`(IN `ve_opcion` VARCHAR(50), IN `ve_marcaDescripcion` VARCHAR(50))
    NO SQL
BEGIN
IF ve_opcion='opc_grabar' THEN
	INSERT into marca(MAR_descripcion) values (ve_MarcaDescripcion);
END IF;


IF ve_opcion='opc_contar' THEN
		SELECT 
			COUNT(*) AS total 
		FROM marca;
END IF;
IF ve_opcion='opc_listar' then	
		select 
			MAR_id as codigo, 
			MAR_descripcion as descripcion			 
	from marca;
END IF;
END$$

CREATE DEFINER=`ecs1`@`localhost` PROCEDURE `sp_control_personal`(IN `ve_opcion` VARCHAR(50), IN `ve_personDNI` CHAR(8), IN `ve_personNombre` VARCHAR(50), IN `ve_personApellidoPaterno` VARCHAR(50), IN `ve_personDireccion` VARCHAR(50), IN `ve_personFijo` CHAR(9), IN `ve_personCelular` CHAR(9), IN `ve_personCorreo` VARCHAR(50), IN `ve_personFeNacimiento` DATE, IN `ve_personFeIngreso` DATE, IN `ve_personLugarNacimiento` VARCHAR(30), IN `ve_personSucural` INT, IN `ve_personUsuario` VARCHAR(50), IN `ve_personPassword` VARCHAR(50), IN `ve_personApellidoMaterno` VARCHAR(50))
    NO SQL
BEGIN
IF ve_opcion = 'opc_grabar' THEN
	insert into persona(PERSO_dni,
                        PERSO_nombres,
                        PERSO_apellidoPaterno,
                        PERSO_apellidoMaterno,
                        PERSO_direccion,
                        PERSO_telefonoFijo,
                        PERSO_telefonoCelular,
                        PERSO_correo,
                        PERSO_fechaNacimiento)
                        values (ve_personDNI,
                                ve_personNombre,
                                ve_personApellidoPaterno,
                                ve_personApellidoMaterno,
                                ve_personDireccion,
                                ve_personFijo,
                                ve_personCelular,
                                ve_personCorreo,
                                ve_personFeNacimiento);
    insert into usuario(USU_login, USU_password) 
    		values (ve_personUsuario, ve_personPassword);
    SET @usuario_ID = (select usu_id 
                       from usuario order by usu_id desc limit 1);
    insert into personal(PERSO_dni, 
                         SUC_codigo, 
                         PERS_lugarNacimiento, 
                         PERS_fechaIngreso, 
                         PERS_estado, 
                         USU_id)
                        values (ve_personDNI,
                                ve_personSucural,
                                ve_personLugarNacimiento,
                                ve_personFeIngreso,
                                1,
                                @usuario_ID);
END IF;

IF ve_opcion = 'opc_contar' THEN
	SELECT count(*) as total from personal;
END IF;

IF ve_opcion = 'opc_contar_sucursal' THEN
	SELECT count(*) as total from sucursal;
END IF;

IF ve_opcion = 'opc_lista_sucursal' THEN
	select SUC_codigo as codigo, SUC_descripcion as sucursal
    from sucursal;
END IF;

IF ve_opcion='opc_listar' then	
	select p.PERS_id as codigo, 
    		s.SUC_descripcion as sucursal, 
            concat(pe.PERSO_nombres,' ',pe.PERSO_apellidoPaterno,' ',pe.PERSO_apellidoMaterno) as nombres, 
            pe.PERSO_correo as correo, 
            pe.PERSO_telefonoCelular as celular, 
            p.PERS_fechaIngreso as fechaIngreso, 
            CASE p.PERS_estado
            	when 1 then 'Activo'
                when 0 then 'Inactivo'
            end as estado
	from personal p
    join sucursal s on p.SUC_codigo=s.SUC_codigo
    join persona pe on pe.PERSO_dni=p.PERSO_dni;
END IF;
END$$

CREATE DEFINER=`ecs1`@`localhost` PROCEDURE `sp_control_producto`(IN `ve_opcion` VARCHAR(50), IN `ve_prodCodigoBarras` VARCHAR(20), IN `ve_prodNombre` VARCHAR(100), IN `ve_prodLinea` INT, IN `ve_prodMarca` INT, IN `ve_prodEmpaque` VARCHAR(50), IN `ve_prodPresentacion` VARCHAR(50), IN `ve_prodCodigoInterno` VARCHAR(8), IN `ve_prodSucursal` INT, IN `ve_prodTipo` INT, IN `ve_prodPrecioCosto` DOUBLE, IN `ve_prodPrecioVenta` DOUBLE, IN `ve_prodStockRequerido` DOUBLE, IN `ve_prodStockMin` DOUBLE, IN `ve_prodStockActual` DOUBLE)
    NO SQL
BEGIN
IF ve_opcion = 'opc_grabar' THEN
	insert into producto(PROD_id,
                        SUC_codigo,
                        PROD_tipo,
                        MAR_id,
                        LIN_id,
                        PROD_presentacion,
                        PROD_empaque,
                        PROD_codigoInterno,
                        PROD_descripcion,
                        PROD_precioCosto,
                        PROD_precioVenta,
                        PROD_stock,
                        PROD_stockMinimo,
                        PROD_stockRequerido,
                        PROD_estado)
                        values (ve_prodCodigoBarras,
                                ve_prodSucursal,
                                ve_prodTipo,
                                ve_prodMarca,
                                ve_prodLinea,
                                ve_prodPresentacion,
                                ve_prodEmpaque,
                                ve_prodCodigoInterno,
                                ve_prodNombre,
                                ve_prodPrecioCosto,
                                ve_prodPrecioVenta,
                                ve_prodStockActual,
                                ve_prodStockMin,
                                ve_prodStockRequerido,
                                1);    
END IF;

IF ve_opcion = 'opc_contar' THEN
	SELECT count(*) as total from producto;
END IF;

IF ve_opcion = 'opc_contar_linea' THEN
	SELECT count(*) as total from linea;
END IF;

IF ve_opcion = 'opc_lista_linea' THEN
	select LIN_id as codigo, LIN_descripcion as linea
    from linea;
END IF;

IF ve_opcion = 'opc_contar_marca' THEN
	SELECT count(*) as total from marca;
END IF;

IF ve_opcion = 'opc_lista_marca' THEN
	select MAR_id as codigo, MAR_descripcion as marca
    from marca;
END IF;

IF ve_opcion = 'opc_contar_sucursal' THEN
	SELECT count(*) as total from sucursal;
END IF;

IF ve_opcion = 'opc_lista_sucursal' THEN
	select SUC_codigo as codigo, SUC_descripcion as sucursal
    from sucursal;
END IF;


IF ve_opcion='opc_listar' then	
	
IF ve_opcion='opc_listar' then	
		select  
        	p.PROD_id as codigoBarras, 
			s.SUC_descripcion as sucursal,
			p.PROD_codigoInterno as codigoInterno, 
        	p.PROD_descripcion as producto, 
        	p.PROD_stock as stockActual, 
        	p.PROD_stockMinimo as stockMinimo, 
        	p.PROD_precioCosto as precioCosto, 
        	p.PROD_precioVenta as precioVenta, 
        	CASE p.PROD_estado  
	        	WHEN 1 then 'Activo'
	            WHEN 0 then 'Inactivo'
	            end as estado
        from producto p
		join sucursal s on s.SUC_codigo=p.SUC_codigo;
END IF;
END IF;
END$$

CREATE DEFINER=`ecs1`@`localhost` PROCEDURE `sp_control_servicio`(IN `ve_opcion` VARCHAR(50), IN `ve_sucursal` INT, IN `ve_descripcion` VARCHAR(100), IN `ve_precioBase` DOUBLE, IN `ve_codigo` INT)
    NO SQL
BEGIN
IF ve_opcion='opc_grabar' THEN
	INSERT into servicio(SER_id,
                         SUC_codigo, 
                        SER_descripcion,
                        SER_precioBase) 
                        values (ve_codigo,
                            	ve_sucursal,
                                ve_descripcion,
                                ve_precioBase);
END IF;

IF ve_opcion='opc_contar' THEN
		SELECT 
			COUNT(*) AS total 
		FROM servicio;
END IF;
IF ve_opcion='opc_listar' then	
		select s.SER_id as codigo,
        		su.SUC_descripcion as sucursal,
                s.SER_descripcion as servicio,
                s.SER_precioBase as precioBase
        	from servicio s
            join sucursal su on su.SUC_codigo=s.SUC_codigo;
END IF;
END$$

CREATE DEFINER=`ecs1`@`localhost` PROCEDURE `sp_control_sucursal`(IN `ve_opcion` VARCHAR(50))
    NO SQL
BEGIN
IF ve_opcion='opc_contar' THEN
		SELECT 
			COUNT(*) AS total 
		FROM sucursal;
END IF;
IF ve_opcion='opc_listar' then	
		select 
			SUC_codigo as codigo, 
			SUC_descripcion as nombre, 
			SUC_telefono as telefono, 
			SUC_ubicacion as direccion 
	from sucursal;
END IF;
END$$

CREATE DEFINER=`ecs1`@`localhost` PROCEDURE `sp_control_usuario`(IN `ve_opcion` VARCHAR(50), IN `ve_usuario` VARCHAR(50), IN `ve_password` VARCHAR(50))
    NO SQL
BEGIN
IF ve_opcion='opc_login_respuesta' THEN
	SET @CORRECTO = (SELECT COUNT(*) 
			FROM  usuario usu 
			WHERE 
				usu.USU_login = ve_usuario AND
				usu.USU_password = ve_password);
			IF @CORRECTO>0 THEN
				SELECT '1' AS 'respuesta';
			ELSE
				SELECT 'Usuario o clave incorrectos' AS 'respuesta';
			END IF;     
END IF;

IF ve_opcion='opc_login_listar' THEN
	select u.USU_id, u.USU_login, p.PERSO_dni
    	from usuario u 
        join personal p on p.USU_id = u.USU_id
        where u.USU_login = ve_usuario and u.USU_password = ve_password;
END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE IF NOT EXISTS `banco` (
  `BANC_id` int(11) NOT NULL AUTO_INCREMENT,
  `BANC_descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`BANC_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `CLI_id` int(11) NOT NULL AUTO_INCREMENT,
  `CLI_tipoCliente` varchar(20) NOT NULL,
  `CLI_fechaAniversario` date NOT NULL,
  `CLI_motivoAniversario` varchar(50) DEFAULT NULL,
  `PERSO_dni` char(8) NOT NULL,
  `USU_id` int(11) NOT NULL,
  PRIMARY KEY (`CLI_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`CLI_id`, `CLI_tipoCliente`, `CLI_fechaAniversario`, `CLI_motivoAniversario`, `PERSO_dni`, `USU_id`) VALUES
(1, 'Activo', '1986-03-14', 'Cumplea&ntilde;os hijo mayor', '17854747', 8),
(2, 'Activo', '1993-09-10', 'Cumplea&ntilde;os hermano menor', '89452378', 9),
(3, 'Activo', '1946-02-01', 'Cumplea&ntilde;os esposo', '17392840', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `DOC_serie` int(11) NOT NULL,
  `DOC_numero` int(11) NOT NULL,
  `TIPDOC_id` int(11) NOT NULL,
  `SUC_codigo` int(11) NOT NULL,
  `CLI_id` int(11) NOT NULL,
  `PERS_id` int(11) NOT NULL,
  `DOC_precioTotal` double NOT NULL,
  `DOC_fechaHoraEmision` datetime NOT NULL,
  PRIMARY KEY (`DOC_serie`,`DOC_numero`,`SUC_codigo`),
  KEY `TIPDOC_id` (`TIPDOC_id`),
  KEY `SUC_codigo` (`SUC_codigo`),
  KEY `CLI_id` (`CLI_id`),
  KEY `PERS_id` (`PERS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_detalle_producto`
--

CREATE TABLE IF NOT EXISTS `documento_detalle_producto` (
  `DOC_serie` int(11) NOT NULL,
  `DOC_numero` int(11) NOT NULL,
  `DOCDETPROD_numeroDetalle` int(11) NOT NULL,
  `PROD_id` varchar(20) NOT NULL,
  `PERS_id` int(11) NOT NULL,
  `SUC_codigo` int(11) NOT NULL,
  `PROD_tipo` int(11) NOT NULL,
  `DOCDETPROD_cantidad` double NOT NULL,
  `DOCDETPROD_descuentoPorc` double DEFAULT NULL,
  `DOCDETPROD_descuentoMonto` double DEFAULT NULL,
  `DOCDETPROD_montoTotal` double NOT NULL,
  PRIMARY KEY (`DOC_serie`,`DOC_numero`,`DOCDETPROD_numeroDetalle`),
  KEY `PROD_id` (`PROD_id`,`SUC_codigo`,`PROD_tipo`),
  KEY `SUC_codigo` (`SUC_codigo`),
  KEY `PERS_id` (`PERS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_detalle_servicio`
--

CREATE TABLE IF NOT EXISTS `documento_detalle_servicio` (
  `DOC_serie` int(11) NOT NULL,
  `DOC_numero` int(11) NOT NULL,
  `DOCDETSERV_numeroDetalle` int(11) NOT NULL,
  `SER_id` int(11) NOT NULL,
  `SUC_codigo` int(11) NOT NULL,
  `PERS_id` int(11) NOT NULL,
  `DOCDETSERV_variacionPorcentaje` double DEFAULT NULL,
  `DOCDETSERV_variacionMonto` double DEFAULT NULL,
  `DOCDETSERV_montoTotal` double DEFAULT NULL,
  PRIMARY KEY (`DOC_serie`,`DOC_numero`,`DOCDETSERV_numeroDetalle`),
  KEY `SER_id` (`SER_id`,`SUC_codigo`),
  KEY `PERS_id` (`PERS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE IF NOT EXISTS `linea` (
  `LIN_id` int(11) NOT NULL AUTO_INCREMENT,
  `LIN_descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`LIN_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`LIN_id`, `LIN_descripcion`) VALUES
(1, 'Acondicionador'),
(2, 'Shampoo'),
(3, 'Mousse'),
(4, 'Tinte Capilar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `MAR_id` int(11) NOT NULL AUTO_INCREMENT,
  `MAR_descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`MAR_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`MAR_id`, `MAR_descripcion`) VALUES
(1, 'L'' Or&eacute;al'),
(4, 'Schwarzkopf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_canje`
--

CREATE TABLE IF NOT EXISTS `pago_canje` (
  `PAGCAN_id` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_serie` int(11) NOT NULL,
  `DOC_numero` int(11) NOT NULL,
  `PAGCAN_monto` double NOT NULL,
  PRIMARY KEY (`PAGCAN_id`),
  KEY `DOC_serie` (`DOC_serie`,`DOC_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_cheque`
--

CREATE TABLE IF NOT EXISTS `pago_cheque` (
  `PAGCHE_id` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_serie` int(11) NOT NULL,
  `DOC_numero` int(11) NOT NULL,
  `BANC_id` int(11) NOT NULL,
  `PAGCHE_numero` varchar(20) NOT NULL,
  `PAGCHE_fechaCobro` date NOT NULL,
  `PAGCHE_monto` double NOT NULL,
  PRIMARY KEY (`PAGCHE_id`),
  KEY `BANC_id` (`BANC_id`),
  KEY `DOC_serie` (`DOC_serie`,`DOC_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_credito`
--

CREATE TABLE IF NOT EXISTS `pago_credito` (
  `PAGCRE_id` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_serie` int(11) NOT NULL,
  `DOC_numero` int(11) NOT NULL,
  `PAGCRE_monto` double NOT NULL,
  `PAGCRE_fechaPagoReal` date DEFAULT NULL,
  `PAGCRE_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`PAGCRE_id`),
  KEY `DOC_serie` (`DOC_serie`,`DOC_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_efectivo`
--

CREATE TABLE IF NOT EXISTS `pago_efectivo` (
  `PAGEFEC_id` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_serie` int(11) NOT NULL,
  `DOC_numero` int(11) NOT NULL,
  `PAGEFEC_monto` double NOT NULL,
  PRIMARY KEY (`PAGEFEC_id`),
  KEY `DOC_serie` (`DOC_serie`,`DOC_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_regalo`
--

CREATE TABLE IF NOT EXISTS `pago_regalo` (
  `PAGREG_id` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_serie` int(11) NOT NULL,
  `DOC_numero` int(11) NOT NULL,
  `PAGREG_monto` double NOT NULL,
  PRIMARY KEY (`PAGREG_id`),
  KEY `DOC_serie` (`DOC_serie`,`DOC_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_tarjeta`
--

CREATE TABLE IF NOT EXISTS `pago_tarjeta` (
  `PAGTAR_id` int(11) NOT NULL AUTO_INCREMENT,
  `DOC_serie` int(11) NOT NULL,
  `DOC_numero` int(11) NOT NULL,
  `BANC_id` int(11) NOT NULL,
  `PAGTAR_numeroOperacion` varchar(10) NOT NULL,
  `PAGTAR_monto` double NOT NULL,
  PRIMARY KEY (`PAGTAR_id`),
  KEY `DOC_serie` (`DOC_serie`,`DOC_numero`),
  KEY `BANC_id` (`BANC_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `PERSO_dni` char(8) NOT NULL,
  `PERSO_nombres` varchar(50) NOT NULL,
  `PERSO_apellidoPaterno` varchar(50) NOT NULL,
  `PERSO_apellidoMaterno` varchar(50) DEFAULT NULL,
  `PERSO_direccion` varchar(100) NOT NULL,
  `PERSO_telefonoFijo` char(9) DEFAULT NULL,
  `PERSO_telefonoCelular` char(9) DEFAULT NULL,
  `PERSO_correo` varchar(50) DEFAULT NULL,
  `PERSO_fechaNacimiento` date DEFAULT NULL,
  PRIMARY KEY (`PERSO_dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`PERSO_dni`, `PERSO_nombres`, `PERSO_apellidoPaterno`, `PERSO_apellidoMaterno`, `PERSO_direccion`, `PERSO_telefonoFijo`, `PERSO_telefonoCelular`, `PERSO_correo`, `PERSO_fechaNacimiento`) VALUES
('', '', '', '', '', '', '', '', '0000-00-00'),
('17392840', 'Rosa Flor', 'Villanueva', 'Zavaleta', 'Manco Inca 723 - El Porvenir', '044401498', '970270498', 'rosaFlor@hotmail.com', '1930-04-02'),
('17854747', 'Marleny', 'Otiniano', 'Villanueva', 'Manco Inca 723 - El Porvenir', '044401498', '979032250', 'movi723@hotmail.com', '1960-04-18'),
('44426918', 'Analy Pamela', 'Rabanal', 'Roncal', 'Paraguay 181 - Urb El recreo', NULL, NULL, NULL, NULL),
('44582158', 'Diana Zadry ', 'Cruz', 'Rosario', 'Urb. Las Causuarinas Mz T Lt 17', NULL, NULL, NULL, NULL),
('46258500', 'Carmen Rosa', 'Valeriano', 'Gallardo', 'Mz J Lt 43 Alan Garcia - La esperanza', '', '', '', '0000-00-00'),
('47668326', 'Roxana del Pilar', 'Villa', 'Arce', 'AAHH. Mz 1 Lt 13 Maria elena Moyano - La Esperanza', '', '', '', '0000-00-00'),
('70747414', 'Yelsi', 'Aspiros', 'Meza', 'Psje La Amistad 190 - La Rinconada', '', '', '', '0000-00-00'),
('74575805', 'Yolanda Janixa', 'C&aacute;rdenas', 'Polo', 'Calle Pogreso Mz E Lt4 - La Marqueza (Altura Puente Santa)', NULL, NULL, NULL, NULL),
('89452378', 'Romer Angel', 'Vargas', 'Otiniano', 'JosÃ© Olaya 1487 - El Porvenir', '044401498', '949761814', 'mene007@gmail.com', '1986-03-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `PERS_id` int(11) NOT NULL AUTO_INCREMENT,
  `PERSO_dni` char(8) NOT NULL,
  `SUC_codigo` int(11) NOT NULL,
  `PERS_lugarNacimiento` varchar(30) DEFAULT NULL,
  `PERS_fechaIngreso` date DEFAULT NULL,
  `PERS_estado` tinyint(1) NOT NULL,
  `USU_id` int(11) NOT NULL,
  PRIMARY KEY (`PERS_id`),
  KEY `PERSO_dni` (`PERSO_dni`),
  KEY `SUC_codigo` (`SUC_codigo`),
  KEY `USU_id` (`USU_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`PERS_id`, `PERSO_dni`, `SUC_codigo`, `PERS_lugarNacimiento`, `PERS_fechaIngreso`, `PERS_estado`, `USU_id`) VALUES
(1, '74575805', 1, NULL, NULL, 1, 1),
(2, '44426918', 2, NULL, NULL, 1, 2),
(3, '44582158', 1, NULL, NULL, 1, 3),
(4, '47668326', 1, '', '0000-00-00', 1, 5),
(5, '70747414', 2, '', '0000-00-00', 1, 6),
(6, '46258500', 2, '', '0000-00-00', 0, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `PROD_id` varchar(20) NOT NULL,
  `SUC_codigo` int(11) NOT NULL,
  `PROD_tipo` int(11) NOT NULL,
  `MAR_id` int(11) NOT NULL,
  `LIN_id` int(11) NOT NULL,
  `PROD_presentacion` varchar(50) NOT NULL,
  `PROD_empaque` varchar(50) NOT NULL,
  `PROD_codigoInterno` int(11) NOT NULL,
  `PROD_descripcion` varchar(100) NOT NULL,
  `PROD_precioCosto` double NOT NULL,
  `PROD_precioVenta` double NOT NULL,
  `PROD_stock` double NOT NULL,
  `PROD_stockMinimo` double NOT NULL,
  `PROD_stockRequerido` double NOT NULL,
  `PROD_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`PROD_id`,`SUC_codigo`,`PROD_tipo`),
  UNIQUE KEY `PROD_codigoInterno` (`PROD_codigoInterno`),
  KEY `MAR_id` (`MAR_id`),
  KEY `LIN_id` (`LIN_id`),
  KEY `SUC_codigo` (`SUC_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`PROD_id`, `SUC_codigo`, `PROD_tipo`, `MAR_id`, `LIN_id`, `PROD_presentacion`, `PROD_empaque`, `PROD_codigoInterno`, `PROD_descripcion`, `PROD_precioCosto`, `PROD_precioVenta`, `PROD_stock`, `PROD_stockMinimo`, `PROD_stockRequerido`, `PROD_estado`) VALUES
('23456789', 2, 2, 4, 2, '1', '1', 220102, 'MOUSSE L''OREAL', 20, 40, 15, 5, 24, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `SER_id` int(11) NOT NULL,
  `SUC_codigo` int(11) NOT NULL,
  `SER_descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `SER_precioBase` double DEFAULT NULL,
  PRIMARY KEY (`SER_id`,`SUC_codigo`),
  KEY `SUC_codigo` (`SUC_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`SER_id`, `SUC_codigo`, `SER_descripcion`, `SER_precioBase`) VALUES
(110101, 1, 'Corte Var&oacute;n', 20),
(110101, 2, 'Corte Var&oacute;n', 15),
(110102, 1, 'Corte Dama', 30),
(110102, 2, 'Corte Dama', 25),
(110103, 1, 'Corte de Ni&ntilde;o', 15),
(110103, 2, 'Corte de Ni&ntilde;o', 10),
(110104, 1, 'Corte de Ni&ntilde;a', 20),
(110104, 2, 'Corte de Ni&ntilde;a', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE IF NOT EXISTS `sucursal` (
  `SUC_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `SUC_descripcion` varchar(50) NOT NULL,
  `SUC_ubicacion` varchar(50) NOT NULL,
  `SUC_telefono` varchar(15) NOT NULL,
  PRIMARY KEY (`SUC_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`SUC_codigo`, `SUC_descripcion`, `SUC_ubicacion`, `SUC_telefono`) VALUES
(1, 'C&oacute;rdova Calle Mar&iacute;a Edita', 'Av. Guillermo Ganoza Vargas N°850 Urb. El Golf', '044420773'),
(2, 'Corporaci&oacute;n PRO BELLEZA ECS E.I.R.L.', 'Av. F&aacute;tima N. 141A Urb. La Merced III Etapa', '044383106');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `TIPDOC_id` int(11) NOT NULL AUTO_INCREMENT,
  `TIPDOC_descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`TIPDOC_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`TIPDOC_id`, `TIPDOC_descripcion`) VALUES
(1, 'Boleta de Venta'),
(2, 'Factura'),
(3, 'Recibo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_tarjeta`
--

CREATE TABLE IF NOT EXISTS `tipo_tarjeta` (
  `TIPTAR_id` int(11) NOT NULL AUTO_INCREMENT,
  `TIPTA_descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`TIPTAR_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `USU_id` int(11) NOT NULL AUTO_INCREMENT,
  `USU_login` varchar(50) NOT NULL,
  `USU_password` varchar(50) NOT NULL,
  PRIMARY KEY (`USU_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`USU_id`, `USU_login`, `USU_password`) VALUES
(1, 'ycardenasp', 'bf411427bde1fdbc40e3809f87916e3a'),
(2, 'arabanalr', '7c0265aaf6331b553ab7421be64939a5'),
(3, 'dcruzr', '6b450bc9f46f6c1a40f8c97478e44401'),
(5, 'rvillaa', 'd8bec271269da09340fa434cb528de01'),
(6, 'yaspirosm', '072fd78ab84b7e9fb2a8cf8cabd0ceee'),
(7, 'cvalerianog', '516d27de1198312e30fc774864d1ccd7'),
(8, 'motinianov', '2ccab15258986e17bb53cb3dd25a1a87'),
(9, 'rvargaso', 'fdd3e331cda2ed8eabc2f2195fc07fd4'),
(10, 'rvillanuevaz', 'f701458b58cf68b306c472fd48b5378d'),
(11, '', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`TIPDOC_id`) REFERENCES `tipo_documento` (`TIPDOC_id`),
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`SUC_codigo`) REFERENCES `sucursal` (`SUC_codigo`),
  ADD CONSTRAINT `documento_ibfk_3` FOREIGN KEY (`CLI_id`) REFERENCES `cliente` (`CLI_id`),
  ADD CONSTRAINT `documento_ibfk_4` FOREIGN KEY (`PERS_id`) REFERENCES `personal` (`PERS_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
