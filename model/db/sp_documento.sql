CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_documentoVenta`(IN `ve_opcion` VARCHAR(50),
 IN `ve_sucursal` INT,
  IN `ve_docTipoDocumento` INT,
  IN `ve_docSerie` INT, 
  IN `ve_docNumero` INT, 
  IN `ve_docFechaHora` DATETIME, 
  IN `ve_docDNICliente` CHAR(8), 
  IN `ve_docCodigoPersonalCaja` INT, 
  IN `ve_montoTotal` DOUBLE, 
  
  IN `ve_checkEfectivo` INT, 
  IN `ve_checkTarjeta` INT, 
  IN `ve_checkCheque` INT, 
  IN `ve_checkCredito` INT, 
  IN `ve_checkCanje` INT, 
  IN `ve_checkRegalo` INT, 
  IN `ve_docdetPagoContadoMonto` DOUBLE, 
  IN `ve_docdetPagoTarjetaBanco` INT, 
  IN `ve_docdetPagoTarjetaOperacion` VARCHAR(10), 
  IN `ve_docdetPagoTarjetaMonto` DOUBLE, 
  IN `ve_docdetPagoChequeBanco` INT, 
  IN `ve_docdetPagoChequeNumero` VARCHAR(20), 
  IN `ve_docdetPagoChequeMonto` DOUBLE, 
  IN `ve_docdetPagoChequeFecha` DATE, 
  IN `ve_docdetPagoCreditoMonto` DOUBLE, 
  IN `ve_docdetPagoCanjeMonto` DOUBLE, 
  IN `ve_docdetPagoRegaloMonto` DOUBLE)
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
END