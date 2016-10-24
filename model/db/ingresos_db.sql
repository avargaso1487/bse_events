-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2016 a las 18:36:58
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_cliente`(IN `ve_opcion` VARCHAR(50), IN `ve_cliDNI` CHAR(8), IN `ve_cliNombre` VARCHAR(50), IN `ve_cliApellidoPaterno` VARCHAR(50), IN `ve_cliDireccion` VARCHAR(100), IN `ve_cliFijo` CHAR(9), IN `ve_cliCelular` CHAR(9), IN `ve_cliCorreo` VARCHAR(50), IN `ve_cliFeNacimiento` DATE, IN `ve_cliFeAniversario` DATE, IN `ve_cliLugarNacimiento` VARCHAR(50), IN `ve_cliMotivoAniversario` VARCHAR(100), IN `ve_cliApellidoMaterno` VARCHAR(50))
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_documentoDetalleProducto`(IN `ve_opcion` VARCHAR(50), IN `ve_docSerie` INT, IN `ve_docNumero` INT, IN `ve_productoID` VARCHAR(20), IN `ve_promotorID` INT, IN `ve_productoCantidad` DOUBLE, IN `ve_productoDescuentoPorc` DOUBLE, IN `ve_productoDescuentoMonto` DOUBLE, IN `ve_productoMontoTotal` INT, IN `ve_docDetalleContador` INT, IN `ve_sucursal` INT)
    NO SQL
BEGIN
IF ve_opcion = 'guardarDetalleProducto' THEN	
	insert into documento_detalle_producto
    			values(ve_docSerie,
                       ve_docNumero,
                       ve_docDetalleContador,
                       ve_productoID,
                       ve_promotorID,
                       ve_sucursal,
                       1,
                       ve_productoCantidad,
                       ve_productoDescuentoPorc,
                       ve_productoDescuentoMonto,
                       ve_productoMontoTotal);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_documentoDetalleServicio`(IN `ve_opcion` INT, IN `ve_docSerie` INT, IN `ve_docNumero` INT, IN `ve_servicioID` INT, IN `ve_personalID` INT, IN `ve_servicioVariacionPorc` DOUBLE, IN `ve_servicioVariacionMonto` DOUBLE, IN `ve_servicioMontoTotal` DOUBLE, IN `ve_docDetalleContador` INT, IN `ve_sucursal` INT)
    NO SQL
BEGIN
IF ve_opcion = 'guardarDetalleServicio' THEN	
	insert into documento_detalle_servicio
    			values(ve_docSerie,
                       ve_docNumero,
                       ve_docDetalleContador,
                       ve_servicioID,                       
                       ve_sucursal,
                       ve_personalID,                                              
                       ve_servicioVariacionPorc,
                       ve_servicioVariacionMonto,
                       ve_servicioMontoTotal);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_documentoVenta`(IN `ve_opcion` VARCHAR(50), IN `ve_sucursal` INT, IN `ve_docTipoDocumento` INT, IN `ve_docSerie` INT, IN `ve_docNumero` INT, IN `ve_docFechaHora` DATETIME, IN `ve_docDNICliente` CHAR(8), IN `ve_docCodigoPersonalCaja` INT, IN `ve_montoTotal` DOUBLE, IN `ve_checkEfectivo` INT, IN `ve_checkTarjeta` INT, IN `ve_checkCheque` INT, IN `ve_checkCredito` INT, IN `ve_checkCanje` INT, IN `ve_checkRegalo` INT, IN `ve_docdetPagoContadoMonto` DOUBLE, IN `ve_docdetPagoTarjetaBanco` INT, IN `ve_docdetPagoTarjetaOperacion` VARCHAR(10), IN `ve_docdetPagoTarjetaMonto` DOUBLE, IN `ve_docdetPagoChequeBanco` INT, IN `ve_docdetPagoChequeNumero` INT(20), IN `ve_docdetPagoChequeMonto` DOUBLE, IN `ve_docdetPagoChequeFecha` DATE, IN `ve_docdetPagoCreditoMonto` DOUBLE, IN `ve_docdetPagoCanjeMonto` DOUBLE, IN `ve_docdetPagoRegaloMonto` DOUBLE)
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
    select  p.PROD_codigoInterno as codigo, 
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
    select  se.SER_id as codigo, 
            se.SER_descripcion as servicio,
            se.SER_precioBase as precioBase            
     from servicio se
     where se.SUC_codigo = ve_sucursal;
END IF;

IF ve_opcion = 'opc_grabarDocumentoCabecera' THEN
	SET @cliente_ID = (select CLI_id 
                       from cliente 
                       where PERSO_dni =  ve_docDNICliente);
	insert into documento values (ve_docSerie,
                                  ve_docNumero,
                                  ve_docTipoDocumento,
                                  ve_sucursal,
                                  @cliente_ID,
                                  ve_docCodigoPersonalCaja,
                                  ve_montoTotal,
                                  ve_docFechaHora);
END IF;       

IF ve_checkEfectivo % 2 = 1 THEN
	insert into pago_efectivo (DOC_serie,
                               DOC_numero,
                               PAGEFEC_monto)
                               values (ve_docNumero,
                                   ve_docSerie,
                                   ve_docdetPagoContadoMonto);
END IF;
IF ve_checkTarjeta % 2 = 1 THEN
	insert into pago_tarjeta (DOC_serie,
                              DOC_numero,
                             BANC_id,
                             PAGTAR_numeroOperacion,
                             PAGTAR_monto)
    					values(ve_docSerie,
                               ve_docNumero,
                               ve_docdetPagoTarjetaBanco,
                               ve_docdetPagoTarjetaOperacion,
                               ve_docdetPagoTarjetaMonto);
END IF;                            
IF ve_checkCheque % 2 = 1 THEN
	insert into pago_cheque (DOC_serie,
                              DOC_numero,
                             BANC_id,
                             PAGCHE_numero,
                             PAGCHE_fechaCobro,
                             PAGCHE_monto)
    					values(ve_docSerie,
                               ve_docNumero,
                               ve_docdetPagoChequeBanco,
                               ve_docdetPagoChequeNumero,
                               ve_docdetPagoChequeFecha,
                               ve_docdetPagoChequeMonto);
END IF;
IF ve_checkCredito % 2 = 1 THEN
	insert into pago_credito (DOC_serie,
                              DOC_numero,
                             PAGCRE_monto,                             
                             PAGCRE_estado)
    					values(ve_docSerie,
                               ve_docNumero,
                               ve_docdetPagoCreditoMonto,
                               0);
END IF;
IF ve_checkCanje % 2 = 1 THEN
	insert into pago_canje (DOC_serie,
                              DOC_numero,
                             PAGCAN_monto)
    					values(ve_docSerie,
                               ve_docNumero,
                               ve_docdetPagoCanjeMonto);
END IF;
IF ve_checkRegalo % 2 = 1 THEN
	insert into pago_regalo (DOC_serie,
                              DOC_numero,
                             PAGREG_monto)
    					values(ve_docSerie,
                               ve_docNumero,
                               ve_docdetPagoRegaloMonto);
END IF;

IF ve_opcion='opc_contarDocumentosCabecera' THEN
	select count(*) as total
    	from documento;
END IF;

IF ve_opcion='opc_listarDocumento' THEN
select d.DOC_serie as serie, d.DOC_numero as numero,  td.TIPDOC_descripcion as tipo, s.SUC_descripcion as sucursal, Date(d.DOC_fechaHoraEmision) as fecha, concat(p.PERSO_nombres,' ',p.PERSO_apellidoPaterno,' ',p.PERSO_apellidoMaterno) as cliente, d.DOC_precioTotal as montoTotal, 'Pagado' as estado
	from documento d
    inner join tipo_documento td on td.TIPDOC_id = d.TIPDOC_id
    inner join sucursal s on s.SUC_codigo = d.SUC_codigo
    inner join cliente c on d.CLI_id = c.CLI_id
    inner join persona p on c.PERSO_dni=p.PERSO_dni;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_linea`(IN `ve_opcion` VARCHAR(50), IN `ve_lineaDescripcion` VARCHAR(50))
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_marca`(IN `ve_opcion` VARCHAR(50), IN `ve_marcaDescripcion` VARCHAR(50))
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_medida`(IN `ve_opcion` VARCHAR(50), IN `ve_medidaDescripcion` VARCHAR(50))
    NO SQL
BEGIN
IF ve_opcion='opc_grabar' THEN
	INSERT into medida(MED_descripcion) 
    				values (ve_medidaDescripcion);
END IF;


IF ve_opcion='opc_contar' THEN
		SELECT 
			COUNT(*) AS total 
		FROM medida;
END IF;

IF ve_opcion='opc_listar' then	
		select 
			MED_id as codigo, 
			MED_descripcion as descripcion			 
	from medida;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_personal`(IN `ve_opcion` VARCHAR(50), IN `ve_personDNI` CHAR(8), IN `ve_personNombre` VARCHAR(50), IN `ve_personApellidoPaterno` VARCHAR(50), IN `ve_personDireccion` VARCHAR(50), IN `ve_personFijo` CHAR(9), IN `ve_personCelular` CHAR(9), IN `ve_personCorreo` VARCHAR(50), IN `ve_personFeNacimiento` DATE, IN `ve_personFeIngreso` DATE, IN `ve_personLugarNacimiento` VARCHAR(30), IN `ve_personSucural` INT, IN `ve_personUsuario` VARCHAR(50), IN `ve_personPassword` VARCHAR(50), IN `ve_personApellidoMaterno` VARCHAR(50))
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
    SET @variable = lower(concat(substring(ve_personNombre,1,1),
                           ve_personApellidoPaterno,
                           substring(ve_personApellidoMaterno,1,1)));
                           
    insert into usuario(USU_login, USU_password) 
    		values (@variable, MD5(@variable));
                
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
                                @variable);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_presentacion`(IN `ve_opcion` VARCHAR(50), IN `ve_presentacionDescripcion` VARCHAR(50))
    NO SQL
BEGIN
IF ve_opcion='opc_grabar' THEN
	INSERT into presentacion(PRES_descripcion) 
    				values (ve_presentacionDescripcion);
END IF;


IF ve_opcion='opc_contar' THEN
		SELECT 
			COUNT(*) AS total 
		FROM presentacion;
END IF;
IF ve_opcion='opc_listar' then	
		select 
			PRES_id as codigo, 
			PRES_descripcion as descripcion			 
	from presentacion;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_producto`(IN `ve_opcion` VARCHAR(50), IN `ve_prodCodigoBarras` VARCHAR(20), IN `ve_prodNombre` VARCHAR(100), IN `ve_prodLinea` INT, IN `ve_prodMarca` INT, IN `ve_prodEmpaque` VARCHAR(50), IN `ve_prodPresentacion` VARCHAR(50), IN `ve_prodCodigoInterno` VARCHAR(8), IN `ve_prodSucursal` INT, IN `ve_prodTipo` INT, IN `ve_prodPrecioCosto` DOUBLE, IN `ve_prodPrecioVenta` DOUBLE, IN `ve_prodStockRequerido` DOUBLE, IN `ve_prodStockMin` DOUBLE, IN `ve_prodStockActual` DOUBLE)
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_servicio`(IN `ve_opcion` VARCHAR(50), IN `ve_sucursal` INT, IN `ve_descripcion` VARCHAR(100), IN `ve_precioBase` DOUBLE, IN `ve_codigo` INT)
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_sucursal`(IN `ve_opcion` VARCHAR(50))
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_usuario`(IN `ve_opcion` VARCHAR(50), IN `ve_usuario` VARCHAR(50), IN `ve_password` VARCHAR(50))
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
	select u.USU_id, u.USU_login, p.PERSO_dni, p.SUC_codigo, s.SUC_descripcion
    	from usuario u 
        join personal p on p.USU_id = u.USU_id
        join sucursal s on s.SUC_codigo = p.SUC_codigo
        where u.USU_login = ve_usuario and u.USU_password = ve_password;
END IF;
END$$

DELIMITER ;

/*
create database IF NOT EXISTS ingresos_db;
use ingresos_db;

create table IF NOT EXISTS sucursal (
  SUC_codigo int(11) NOT NULL AUTO_INCREMENT,
  SUC_descripcion varchar(50) NOT NULL,
  SUC_ubicacion varchar(50) NOT NULL,
  SUC_telefono varchar(15) NOT NULL,
  PRIMARY KEY (SUC_codigo)
);
INSERT INTO sucursal (SUC_codigo, SUC_descripcion, SUC_ubicacion, SUC_telefono) VALUES (1, 'C&oacute;rdova Calle Mar&iacute;a Edita', 'Av. Guillermo Ganoza Vargas N°850 Urb. El Golf', '044420773');
INSERT INTO sucursal (SUC_codigo, SUC_descripcion, SUC_ubicacion, SUC_telefono) VALUES (2, 'Corporaci&oacute;n PRO BELLEZA ECS E.I.R.L.', 'Av. F&aacute;tima N. 141A Urb. La Merced III Etapa', '044383106');

create table IF NOT EXISTS banco (
  BANC_id int(11) NOT NULL AUTO_INCREMENT,
  BANC_descripcion varchar(50) NOT NULL,
  PRIMARY KEY (BANC_id)
);


create table IF NOT EXISTS tipo_documento (
  TIPDOC_id int(11) NOT NULL AUTO_INCREMENT,
  TIPDOC_descripcion varchar(20) NOT NULL,
  PRIMARY KEY (TIPDOC_id)
);
INSERT INTO tipo_documento (TIPDOC_id, TIPDOC_descripcion) VALUES (1, 'Boleta de Venta');
INSERT INTO tipo_documento (TIPDOC_id, TIPDOC_descripcion) VALUES (2, 'Factura');
INSERT INTO tipo_documento (TIPDOC_id, TIPDOC_descripcion) VALUES (3, 'Recibo');

create table IF NOT EXISTS tipo_tarjeta (
  TIPTAR_id int(11) NOT NULL AUTO_INCREMENT,
  TIPTA_descripcion varchar(50) NOT NULL,
  PRIMARY KEY (TIPTAR_id)
);

create table IF NOT EXISTS persona (
  PERSO_id int not null AUTO_INCREMENT,
  PERSO_dni char(8) NOT NULL unique,
  PERSO_nombres varchar(50) NOT NULL,
  PERSO_apellidoPaterno varchar(50) NOT NULL,
  PERSO_apellidoMaterno varchar(50) NOT NULL,
  PERSO_direccion varchar(100) DEFAULT NULL,
  PERSO_telefonoFijo char(9) DEFAULT NULL,
  PERSO_telefonoCelular char(9) DEFAULT NULL,
  PERSO_correo varchar(50) DEFAULT NULL,
  PERSO_fechaNacimiento date DEFAULT NULL,
  PRIMARY KEY (PERSO_id)
);
INSERT INTO persona (PERSO_id, PERSO_dni ,PERSO_nombres, PERSO_apellidoPaterno, PERSO_apellidoMaterno, PERSO_direccion, PERSO_telefonoFijo, PERSO_telefonoCelular, PERSO_correo, PERSO_fechaNacimiento) VALUES (1,'47900626', 'Daniela Edith', 'Cordova', 'Diaz', '', '', '', 'marketing.edithcordovasalon@gmail.com', '0000-00-00');


create table IF NOT EXISTS usuario (
  PERSO_id int  NOT NULL AUTO_INCREMENT,
  USU_login varchar(50) NOT NULL,
  USU_password varchar(50) NOT NULL,
  USU_estado boolean not null,
  PRIMARY KEY (PERSO_id)
);
INSERT INTO usuario (PERSO_id, USU_login, USU_password, USU_estado) VALUES (1, 'admin', '704b037a97fa9b25522b7c014c300f8a', 1);



create table IF NOT EXISTS  personal (
  PERS_id int(11) NOT NULL AUTO_INCREMENT,
  PERSO_id int NOT NULL,
  SUC_codigo int(11) NOT NULL,
  PERS_lugarNacimiento varchar(30) DEFAULT NULL,
  PERS_fechaIngreso date DEFAULT NULL,
  PERS_estado tinyint(1) NOT NULL,  
  PRIMARY KEY (PERS_id),
  FOREIGN KEY (PERSO_id) references persona(PERSO_id),
  FOREIGN KEY (SUC_codigo) references sucursal(SUC_codigo)
);
INSERT INTO personal (PERS_id, PERSO_id, SUC_codigo, PERS_lugarNacimiento, PERS_fechaIngreso, PERS_estado) VALUES (1, 1, 1, NULL, NULL, 1);


create table IF NOT EXISTS cliente (
  CLI_id int(11) NOT NULL AUTO_INCREMENT,
  CLI_tipoCliente varchar(20) NOT NULL,
  CLI_fechaAniversario date DEFAULT NULL,
  CLI_motivoAniversario varchar(50) DEFAULT NULL,
  PERSO_id int NOT NULL,  
  PRIMARY KEY (CLI_id),
  FOREIGN KEY (PERSO_id) references persona(PERSO_id)
);


create table IF NOT EXISTS presentacion (
  PRES_id int NOT NULL AUTO_INCREMENT,
  PRES_descripcion varchar(50) NOT NULL,
  PRIMARY KEY (PRES_id)
);
INSERT INTO presentacion (PRES_id, PRES_descripcion) VALUES
(1, 'Ampollas'),
(2, 'Chisguete'),
(3, 'Frasco'),
(4, 'Pote'),
(5, 'Spray');


create table IF NOT EXISTS linea (
  LIN_id int(11) NOT NULL AUTO_INCREMENT,
  LIN_descripcion varchar(50) NOT NULL,
  PRIMARY KEY (LIN_id)
);


create table IF NOT EXISTS marca (
  MAR_id int(11) NOT NULL AUTO_INCREMENT,
  MAR_descripcion varchar(50) NOT NULL,
  PRIMARY KEY (MAR_id)
);


create table IF NOT EXISTS medida (
  MED_id int NOT NULL AUTO_INCREMENT,
  MED_descripcion varchar(50) NOT NULL,
  PRIMARY KEY (MED_id)
);
INSERT INTO medida (MED_id, MED_descripcion) VALUES (1, '10 x 6 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (2, '120 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (3, '125 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (4, '150 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (5, '18 gr');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (6, '200 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (7, '250 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (8, '30 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (9, '30 x 6 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (10, '300 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (11, '42 x 6 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (12, '50 ml');
INSERT INTO medida (MED_id, MED_descripcion) VALUES (13, '75 ml');

create table IF NOT EXISTS gama(
	GAMA_id int not null AUTO_INCREMENT,
	GAMA_descripcion varchar(50) not null,
	primary key (GAMA_id)
);

create table IF NOT EXISTS producto (
  PROD_id int(11) DEFAULT NULL,
  SUC_codigo int(11) NOT NULL,
  PROD_tipo int(11) NOT NULL,
  MAR_id int(11) NOT NULL,
  LIN_id int(11) NOT NULL,
  PRES_id int NOT NULL,
  MED_id int NOT NULL,
  GAMA_id int NOT NULL,
  PROD_codioBarras varchar(20) NOT NULL unique,
  PROD_descripcion varchar(100) NOT NULL,
  PROD_precioCosto double DEFAULT NULL,
  PROD_precioVenta double DEFAULT NULL,
  PROD_stock double DEFAULT NULL,
  PROD_stockMinimo double DEFAULT NULL,
  PROD_stockRequerido double DEFAULT NULL,
  PROD_estado tinyint(1) NOT NULL,
  PRIMARY KEY (PROD_id,SUC_codigo,PROD_tipo),  
  FOREIGN KEY (MAR_id) references marca(MAR_id),
  FOREIGN KEY (LIN_id) references linea(LIN_id),
  FOREIGN KEY (SUC_codigo) references sucursal(SUC_codigo),
  FOREIGN KEY (PRES_id) references presentacion(PRES_id),
  FOREIGN KEY (MED_id) references medida(MED_id),
  FOREIGN KEY (GAMA_id) references gama(GAMA_id)
);


create table IF NOT EXISTS servicio (
  SER_id int(11) NOT NULL,
  SUC_codigo int(11) NOT NULL,
  SER_descripcion varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  SER_precioBase double DEFAULT NULL,
  PRIMARY KEY (SER_id,SUC_codigo),
  FOREIGN KEY (SUC_codigo) references sucursal(SUC_codigo)
);


INSERT INTO servicio (SER_id, SUC_codigo, SER_descripcion, SER_precioBase) VALUES (110101, 1, 'Corte Var&oacute;n', 20);
INSERT INTO servicio (SER_id, SUC_codigo, SER_descripcion, SER_precioBase) VALUES (110101, 2, 'Corte Var&oacute;n', 15);
INSERT INTO servicio (SER_id, SUC_codigo, SER_descripcion, SER_precioBase) VALUES (110102, 1, 'Corte Dama', 30);
INSERT INTO servicio (SER_id, SUC_codigo, SER_descripcion, SER_precioBase) VALUES (110102, 2, 'Corte Dama', 25);
INSERT INTO servicio (SER_id, SUC_codigo, SER_descripcion, SER_precioBase) VALUES (110103, 1, 'Corte de Ni&ntilde;o', 15);
INSERT INTO servicio (SER_id, SUC_codigo, SER_descripcion, SER_precioBase) VALUES (110103, 2, 'Corte de Ni&ntilde;o', 10);
INSERT INTO servicio (SER_id, SUC_codigo, SER_descripcion, SER_precioBase) VALUES (110104, 1, 'Corte de Ni&ntilde;a', 20);
INSERT INTO servicio (SER_id, SUC_codigo, SER_descripcion, SER_precioBase) VALUES (110104, 2, 'Corte de Ni&ntilde;a', 15);


create table IF NOT EXISTS documento (
  DOC_serie int(11) NOT NULL,
  DOC_numero int(11) NOT NULL,
  TIPDOC_id int(11) NOT NULL,
  SUC_codigo int(11) NOT NULL,
  CLI_id int(11) NOT NULL,
  PERS_id int(11) NOT NULL,
  DOC_precioTotal double NOT NULL,
  DOC_fechaHoraEmision datetime NOT NULL,
  PRIMARY KEY (DOC_serie,DOC_numero,SUC_codigo),
  FOREIGN KEY (TIPDOC_id) references tipo_documento(TIPDOC_id),
  FOREIGN KEY (SUC_codigo) references sucursal (SUC_codigo),
  foreign key (CLI_id) references cliente(CLI_id),
  foreign key (PERS_id) references personal(PERS_id)
);

create table IF NOT EXISTS documento_detalle_producto (
  DOC_serie int(11) NOT NULL,
  DOC_numero int(11) NOT NULL,
  DOCDETPROD_numeroDetalle int(11) NOT NULL,
  PROD_id int NOT NULL,
  PERS_id int(11) NOT NULL,
  SUC_codigo int(11) NOT NULL,
  SUC_codigoProducto int not null,
  PROD_tipo int(11) NOT NULL,
  DOCDETPROD_cantidad double NOT NULL,
  DOCDETPROD_descuentoPorc double DEFAULT NULL,
  DOCDETPROD_descuentoMonto double DEFAULT NULL,
  DOCDETPROD_montoTotal double NOT NULL,
  PRIMARY KEY (DOC_serie,DOC_numero,SUC_codigo, DOCDETPROD_numeroDetalle),
  FOREIGN KEY (DOC_serie, DOC_numero, SUC_codigo) references documento(DOC_serie, DOC_numero, SUC_codigo),
  FOREIGN KEY (PROD_id,  SUC_codigoProducto, PROD_tipo) references producto(PROD_id, SUC_codigo, PROD_tipo),  
  FOREIGN KEY (PERS_id) references personal(PERS_id)
);

create table IF NOT EXISTS documento_detalle_servicio (
  DOC_serie int(11) NOT NULL,
  DOC_numero int(11) NOT NULL,
  DOCDETSERV_numeroDetalle int(11) NOT NULL,
  SER_id int(11) NOT NULL,
  SUC_codigo int(11) NOT NULL,
  SUC_codigoServicio int not null,
  PERS_id int(11) NOT NULL,
  DOCDETSERV_variacionPorcentaje double DEFAULT NULL,
  DOCDETSERV_variacionMonto double DEFAULT NULL,
  DOCDETSERV_montoTotal double DEFAULT NULL,
  PRIMARY KEY (DOC_serie,DOC_numero,SUC_codigo,DOCDETSERV_numeroDetalle),
  foreign key (DOC_serie, DOC_numero, SUC_codigo) references documento(DOC_serie, DOC_numero, SUC_codigo),
  FOREIGN KEY (SER_id, SUC_codigoServicio) REFERENCES servicio(SER_id,SUC_codigo),
  FOREIGN KEY (PERS_id) references personal(PERS_id)
);



create table IF NOT EXISTS  pago_canje (
  PAGCAN_id int(11) NOT NULL AUTO_INCREMENT,
  DOC_serie int(11) NOT NULL,
  DOC_numero int(11) NOT NULL,
  SUC_codigo int not null,
  PAGCAN_monto double NOT NULL,
  PRIMARY KEY (PAGCAN_id),
  FOREIGN KEY (DOC_serie,DOC_numero, SUC_codigo) references documento(DOC_serie,DOC_numero, SUC_codigo)
);


create table IF NOT EXISTS pago_cheque (
  PAGCHE_id int(11) NOT NULL AUTO_INCREMENT,
  DOC_serie int(11) NOT NULL,
  DOC_numero int(11) NOT NULL,
  BANC_id int(11) NOT NULL,
  SUC_codigo int not null,
  PAGCHE_numero varchar(20) NOT NULL,
  PAGCHE_fechaCobro date NOT NULL,
  PAGCHE_monto double NOT NULL,
  PRIMARY KEY (PAGCHE_id),
  KEY BANC_id (BANC_id),
  FOREIGN KEY (DOC_serie,DOC_numero, SUC_codigo) references documento(DOC_serie,DOC_numero, SUC_codigo)
);


create table IF NOT EXISTS pago_credito (
  PAGCRE_id int(11) NOT NULL AUTO_INCREMENT,
  DOC_serie int(11) NOT NULL,
  DOC_numero int(11) NOT NULL,
  SUC_codigo int not null,
  PAGCRE_monto double NOT NULL,
  PAGCRE_fechaPagoReal date DEFAULT NULL,
  PAGCRE_estado tinyint(1) NOT NULL,
  PRIMARY KEY (PAGCRE_id),
  FOREIGN KEY (DOC_serie, DOC_numero, SUC_codigo) references documento(DOC_serie,DOC_numero,SUC_codigo)
);


create table IF NOT EXISTS  pago_efectivo (
  PAGEFEC_id int(11) NOT NULL AUTO_INCREMENT,
  DOC_serie int(11) NOT NULL,
  DOC_numero int(11) NOT NULL,
  SUC_codigo int not null,
  PAGEFEC_monto double NOT NULL,
  PRIMARY KEY (PAGEFEC_id),
  FOREIGN KEY (DOC_serie, DOC_numero, SUC_codigo) references documento(DOC_serie,DOC_numero, SUC_codigo)
);


create table IF NOT EXISTS pago_regalo (
  PAGREG_id int(11) NOT NULL AUTO_INCREMENT,
  DOC_serie int(11) NOT NULL,
  DOC_numero int(11) NOT NULL,
  SUC_codigo int not null,
  PAGREG_monto double NOT NULL,
  PRIMARY KEY (PAGREG_id),
  FOREIGN KEY (DOC_serie,DOC_numero,SUC_codigo) references documento(DOC_serie,DOC_numero,SUC_codigo)
);


create table IF NOT EXISTS pago_tarjeta (
  PAGTAR_id int(11) NOT NULL AUTO_INCREMENT,
  DOC_serie int(11) NOT NULL,
  DOC_numero int(11) NOT NULL,
  SUC_codigo int not null,
  BANC_id int(11) NOT NULL,
  PAGTAR_numeroOperacion varchar(10) NOT NULL,
  PAGTAR_monto double NOT NULL,
  PRIMARY KEY (PAGTAR_id),
  FOREIGN KEY (DOC_serie, DOC_numero, SUC_codigo) references documento(DOC_serie,DOC_numero,SUC_codigo),
  FOREIGN KEY (BANC_id) references banco(BANC_id)
);




/*
create table if not exists grupo(
);

create table if not exists modulo(
);

create table if not exists permiso(
);

create table if not exists roles(
);

create table if not exists roles_usuario(
);

create table if not exists tarea(
);
*/*/