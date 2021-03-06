-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2016 at 03:13 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12
use bse_events;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bse_events`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_combos`(IN `ve_opcion` VARCHAR(300), IN `ve_codigo` INT)
    NO SQL
BEGIN
    IF ve_opcion='opc_combo_tipoDocumentoPago' THEN
      select TipDocPago_idTipoDocumentoPago, TipDocPago_descripcion from tipodocumentopago;
    END IF;
    IF ve_opcion='opc_combo_paquetes' THEN
      select Paq_idPaquete, Paq_descripcion from paquete order by Paq_descripcion asc;
    END IF;
    IF ve_opcion='opc_combo_actividades' THEN
      select Acti_idActividad, Acti_nombre from actividad where Even_idEvento = ve_codigo and estado = 'A' order by Acti_nombre asc;
    END IF;
    IF ve_opcion='opc_datos_actividad' THEN
      select Acti_idActividad, Acti_nombre, Acti_precio from actividad where Acti_idActividad = ve_codigo;
    END IF;
    IF ve_opcion='opc_datos_participante' THEN
      select pa.Par_idParticipante,CONCAT(UPPER(pe.Per_apellidos), ', ', UPPER(pe.Per_nombres)) from participante pa inner join persona pe on pe.Per_idPersona = pa.Per_idPersona where pa.Par_idParticipante = ve_codigo;
    END IF;
    IF ve_opcion='opc_combo_evento' THEN
      select Even_idEvento, Even_nombre from evento where Even_estado = 1;
    END IF;
    IF ve_opcion='opc_llenar_todas_actividades' THEN
      select Acti_nombre, Acti_precio, Acti_idActividad from actividad where Even_idEvento = ve_codigo and estado = 'A' order by Acti_nombre;
    END IF;
    IF ve_opcion='opc_obtener_neto' THEN
      select sum(Acti_precio) from actividad where Even_idEvento = ve_codigo;
    END IF;
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_ambiente`(IN `opcion` VARCHAR(200), IN `codigo` INT, IN `descripcion` varchar(50), 
IN `capacidad` int, in `tipoAmbiente` int,in `locala` int )
BEGIN
if opcion = 'opc_listar' then            
select A.Amb_idAmbiente,A.Amb_descripcion,A.Amb_capacidad,TA.TipAm_descripcion,TA.TipAm_idTipoAmbiente,
L.Loc_idLocal,L.Loc_descripcion,
case when A.Amb_estado=1 then 'Activo' 
when A.Amb_estado=0 then 'Inactivo'  end as Amb_estado  from ambiente A inner join
tipoambiente TA on A.TipAm_idTipoAmbiente=TA.TipAm_idTipoAmbiente inner join
locala L on A.Loc_idLocal=L.Loc_idLocal;
end if;  

if opcion = 'opc_grabar' then    
       
insert into ambiente(Amb_descripcion,Amb_capacidad,Amb_estado,TipAm_idTipoAmbiente,Loc_idLocal)
values (descripcion,capacidad,1,tipoAmbiente,locala);
end if; 

if opcion = 'opc_comboLocal' then            
select Loc_idLocal,Loc_descripcion  from locala;
end if; 

if opcion = 'opc_comboTipo' then            
select TipAm_idTipoAmbiente,TipAm_descripcion  from tipoambiente ;
end if; 

if opcion = 'opc_buscar' then            
select A.Amb_idAmbiente,A.Amb_descripcion,A.Amb_capacidad,TA.TipAm_descripcion,TA.TipAm_idTipoAmbiente,
L.Loc_idLocal,L.Loc_descripcion, A.Amb_estado 
from ambiente A inner join
tipoambiente TA on A.TipAm_idTipoAmbiente=TA.TipAm_idTipoAmbiente inner join
locala L on A.Loc_idLocal=L.Loc_idLocal
where A.Amb_idAmbiente=codigo;
end if; 

if opcion = 'opc_actualizar' then            
update ambiente set Amb_descripcion=descripcion,Amb_capacidad=capacidad,TipAm_idTipoAmbiente=tipoAmbiente,
Loc_idLocal=locala
where Amb_idAmbiente=codigo;

end if; 

if opcion = 'opc_eliminar' then
set @estado=(select Amb_estado from ambiente where Amb_idAmbiente=codigo); 
if @estado='1' then          
update ambiente set Amb_estado='0'
where Amb_idAmbiente=codigo;

else 
update ambiente set Amb_estado='1'
where Amb_idAmbiente=codigo;
end if;
end if; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_grupo`(IN `ve_opcion` VARCHAR(50), IN `ve_grupoId` INT, IN `ve_grupo` VARCHAR(50), IN `ve_grupoDescripcion` VARCHAR(200), IN `ve_grupoOrden` INT, IN `ve_grupoEstado` BOOLEAN)
    NO SQL
BEGIN

IF ve_opcion = 'opc_contar' THEN
  SELECT count(*) as total from grupo;
END IF;

IF ve_opcion='opc_listar' then    
  select Gru_idGrupo as codigo, Gru_nombre as grupo, Gru_descripcion as descripcion, Gru_orden as orden, (case Gru_estado when 1 then 'Activo' else 'Inactivo' end) as estado from grupo;
END IF;

IF ve_opcion = 'opc_contar_cbo' THEN
  SELECT count(*) as total from grupo where Gru_estado = 1;
END IF;

IF ve_opcion = 'opc_listar_cbo' THEN
  select Gru_idGrupo as codigo, Gru_nombre as grupo from grupo where Gru_estado = 1 order by Gru_nombre;
END IF;

IF ve_opcion='opc_grabar' then
  insert into grupo(Gru_nombre, Gru_descripcion,
                        Gru_orden, Gru_estado)
           values(ve_grupo, ve_grupoDescripcion,
                  ve_grupoOrden, 1);
  insert into modulo(Mod_descripcion, Mod_estado)
           values(ve_grupo,1);
  select 1 as resultado;
END IF;

IF ve_opcion='opc_editar' then
  update grupo set Gru_nombre = ve_grupo,
              Gru_descripcion = ve_grupoDescripcion,
                        Gru_orden = ve_grupoOrden
           where Gru_idGrupo = ve_grupoId;
  update modulo set Mod_descripcion = ve_grupo
           where Mod_idModulo = ve_grupoId;
END IF;

IF ve_opcion='opc_eliminar' then    
  update grupo set Gru_estado = ve_grupoEstado
      where Gru_idGrupo = ve_grupoId;          
  update modulo set Mod_estado = ve_grupoEstado
      where Mod_idModulo = ve_grupoId;          
END IF;

IF ve_opcion='opc_contarDetalle' then
  SELECT count(*) as total from grupo 
      where Gru_idGrupo = ve_grupoId;
END IF;


IF ve_opcion='opc_listarDetalle' then
  select Gru_idGrupo, Gru_nombre, Gru_descripcion, Gru_orden, Gru_estado from grupo where Gru_idGrupo = ve_grupoId;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_local`(IN `opcion` VARCHAR(200), IN `id` int, IN `descripcion` varchar(50),
IN `direccion` varchar(100))
BEGIN
if opcion = 'opc_listar' then            
select L.Loc_idLocal,L.Loc_descripcion,L.Loc_direccion, case when L.Loc_estado=1 then 'Activo' 
when L.Loc_estado=0 then 'Inactivo'  end as Loc_estado
from locala L;
end if;  


if opcion = 'opc_grabar' then    
insert into locala(Loc_descripcion,Loc_direccion,Loc_estado)
values (descripcion,direccion,1);
end if; 


if opcion = 'opc_buscar' then            
select L.Loc_idLocal,L.Loc_descripcion,L.Loc_direccion,L.Loc_estado
from locala L
where  L.Loc_idLocal=id;
end if; 

if opcion = 'opc_actualizar' then            
update locala set Loc_descripcion=descripcion,Loc_direccion=direccion
where Loc_idLocal=id;
end if; 

if opcion = 'opc_eliminar' then
set @estado=(select Loc_estado from locala where Loc_idLocal=id); 
if @estado='1' then          
update locala set Loc_estado='0'
where Loc_idLocal=id;

else 
update locala set Loc_estado='1'
where Loc_idLocal=id;
end if;
end if; 

END$$

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
        and t.Tar_estado=1 and g.Gru_estado = 1
        order by g.Gru_orden;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_opcion`(IN `ve_opcion` VARCHAR(50), IN `ve_tareaId` INT, IN `ve_grupoId` INT, IN `ve_tarea` VARCHAR(50), IN `ve_tareaDescripcion` VARCHAR(200), IN `ve_tareaOrden` INT, IN `ve_tareaUrl` VARCHAR(100), IN `ve_tareaEstado` BOOLEAN)
    NO SQL
BEGIN

IF ve_opcion = 'opc_contar' THEN
  SELECT count(*) as total from tarea;
END IF;

IF ve_opcion='opc_listar' then    
  select t.Tar_idTarea as codigo, g.Gru_nombre as grupo, t.Tar_nombre as opcion, t.Tar_descripcion as descripcion, t.Tar_orden as orden, t.Tar_url as url, (case t.Tar_estado when 1 then 'Activo' else 'Inactivo' end) as estado
  from tarea t 
    inner join grupo g on g.Gru_idGrupo = t.Gru_idGrupo;
END IF;

IF ve_opcion = 'opc_contar_cbo' THEN
  SELECT count(*) as total from tarea where Tar_estado = 1;
END IF;

IF ve_opcion = 'opc_listar_cbo' THEN
  select Tar_idTarea as codigo, Tar_nombre as opcion from tarea where Tar_estado = 1 order by Tar_nombre;
END IF;

IF ve_opcion='opc_grabar' then
  insert into tarea(Mod_idModulo, Gru_idGrupo,
                   Tar_nombre, Tar_descripcion,
                   Tar_orden, Tar_url, Tar_estado)
           values(ve_grupoId, ve_grupoId, 
                  ve_tarea, ve_tareaDescripcion,
                  ve_tareaOrden, ve_tareaUrl, 1);
  
  select 1 as resultado;
END IF;

IF ve_opcion='opc_editar' then
  update tarea set Mod_idModulo = ve_grupoId,
              Gru_idGrupo = ve_grupoId,
              Tar_nombre = ve_tarea,
              Tar_descripcion = ve_tareaDescripcion,
              Tar_orden = ve_tareaOrden,
              Tar_url = ve_tareaUrl
           where Tar_idTarea = ve_tareaId;  
END IF;

IF ve_opcion='opc_eliminar' then    
  update tarea set Tar_estado = ve_tareaEstado
      where Tar_idTarea = ve_tareaId;            
END IF;

IF ve_opcion='opc_contarDetalle' then
  SELECT count(*) as total from tarea 
      where Tar_idTarea = ve_tareaId;
END IF;


IF ve_opcion='opc_listarDetalle' then
  select Tar_idTarea, Gru_idGrupo, Tar_nombre, Tar_descripcion, Tar_orden, Tar_url, Tar_estado
  from tarea where Tar_idTarea = ve_tareaId;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_permiso`(IN `ve_opcion` VARCHAR(50), IN `ve_permisoId` INT, IN `ve_usuarioRol` INT, IN `ve_tareaId` INT, IN `ve_permisoEstado` BOOLEAN)
    NO SQL
BEGIN

IF ve_opcion = 'opc_contar' THEN
  SELECT count(*) as total FROM permiso where Rol_idRol = ve_usuarioRol;
END IF;

IF ve_opcion='opc_listar' then    
  SELECT p.Pso_idPermiso as codigoPermiso, t.Tar_nombre as tarea, t.Tar_descripcion as descripcion, g.Gru_nombre as grupo, (case when p.Pso_estado = 1 then 'Activo' else 'Inactivo' end) as estado
  FROM permiso p
    inner join tarea t on t.Tar_idTarea = p.Tar_idTarea
    inner join grupo g on g.Gru_idGrupo = t.Gru_idGrupo
where p.Rol_idRol = ve_usuarioRol and t.Tar_estado = 1
order by g.Gru_orden asc;
END IF;

IF ve_opcion = 'opc_contar_tareas' THEN
  select count(*) as total from tarea t inner join grupo g on g.Gru_idGrupo = t.Gru_idGrupo where t.Tar_estado = 1 and ( t.Tar_idTarea not in (select Tar_idTarea from permiso where Rol_idRol = ve_usuarioRol));
END IF;

IF ve_opcion='opc_listar_tareas' then    
  select t.Tar_idTarea as codigoTarea, t.Tar_nombre as tarea, t.Tar_descripcion as descripcion, g.Gru_nombre as grupo from tarea t inner join grupo g on g.Gru_idGrupo = t.Gru_idGrupo where t.Tar_estado = 1 and ( t.Tar_idTarea not in (select Tar_idTarea from permiso where Rol_idRol = ve_usuarioRol));
END IF;


IF ve_opcion='opc_grabar' then
  insert into permiso(Rol_idRol, Tar_idTarea,
                        Pso_estado)
           values(ve_usuarioRol, ve_tareaId,
                  1);  
  select 1 as resultado;
END IF;

IF ve_opcion='opc_eliminar' then    
  update permiso set Pso_estado = ve_permisoEstado
      where Pso_idPermiso = ve_permisoId;            
END IF;

IF ve_opcion='opc_contarFaltantes' then
  SELECT count(*) as total from grupo 
      where Gru_idGrupo = ve_grupoId;
END IF;


IF ve_opcion='opc_listarDetalleFaltantes' then
  select Gru_idGrupo, Gru_nombre, Gru_descripcion, Gru_orden, Gru_estado from grupo where Gru_idGrupo = ve_grupoId;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_personal`(IN `ve_opcion` VARCHAR(50), IN `ve_colaboradorId` INT, IN `ve_colaboradorCodigo` VARCHAR(15), IN `ve_colaboradorEmpresa` INT, IN `ve_colaboradorSucursal` INT, IN `ve_colaboradorNombre` VARCHAR(100), IN `ve_colaboradorApellido` VARCHAR(100), IN `ve_colaboradorDNI` CHAR(8), IN `ve_colaboradorDireccion` VARCHAR(100), IN `ve_colaboradorNacimiento` DATE, IN `ve_colaboradorFijo` VARCHAR(15), IN `ve_colaboradorMovil` VARCHAR(15), IN `ve_colaboradorMail` VARCHAR(100), IN `ve_colaboradorIngreso` DATE, IN `ve_colaboradorEstado` BOOLEAN)
    NO SQL
BEGIN

IF ve_opcion = 'opc_contar' THEN
  SELECT count(*) as total from personal;
END IF;

IF ve_opcion='opc_listar' then    
  SELECT p.Pers_codigo as codigo, concat(pe.Per_nombres,' ',pe.Per_apellidos) as colaborador, pe.Per_dni as dni, pe.Per_direccion as direccion,
concat(pe.Per_telefonoFijo,' / ',pe.Per_telefonoMovil) as telefono, 
pe.Per_email as email, (case p.Pers_estado when 1 then 'Activo' else 'Inactivo' end) as estado 
  FROM personal p 
    inner join persona pe on pe.Per_idPersona = p.Per_idPersona;
END IF;

IF ve_opcion = 'opc_contar_cbo' THEN
  SELECT count(*) as total from personal where Pers_estado = 1;
END IF;

IF ve_opcion = 'opc_listar_cbo' THEN
  select pe.Pers_codigo as codigo, concat(p.Per_nombres,' ',p.Per_apellidos) as colaborador from personal pe inner join persona p on p.Per_idPersona = pe.Per_idPersona where pe.Pers_estado = 1 order by p.Per_nombres;
END IF;

IF ve_opcion='opc_grabar' then
  insert into persona(Per_apellidos, Per_direccion,
                   Per_dni, Per_email,
                   Per_estado, Per_fechaNacimiento,
                   Per_nombres, Per_telefonoFijo,
                   Per_telefonoMovil)
           values(ve_colaboradorApellido, ve_colaboradorDireccion,ve_colaboradorDNI, ve_colaboradorMail,
                  1, ve_colaboradorNacimiento, 
                  ve_colaboradorNombre, ve_colaboradorFijo,
                  ve_colaboradorMovil);
  SET @idPersona = (select Per_idPersona from persona 
                    order by Per_idPersona DESC Limit 1);
  insert into personal(Pers_codigo, Pers_estado, 
                       Pers_fechaIngreso, Per_idPersona, 
                       Suc_idSucursal)
           values(ve_colaboradorCodigo, 1, 
                  ve_colaboradorIngreso, @idPersona,
                  ve_colaboradorSucursal);  
  select 1 as resultado;
END IF;
                  
IF ve_opcion='opc_editar' then
  set @idPersona = (select Per_idPersona from personal 
                    where Pers_codigo = ve_colaboradorCodigo);
                    
  update personal set Pers_codigo = ve_colaboradorCodigo,
                    Pers_fechaIngreso = ve_colaboradorIngreso,
                    Suc_idSucursal = ve_colaboradorSucursal
                    where Pers_codigo = ve_colaboradorCodigo;
                    
  update persona set Per_apellidos = ve_colaboradorApellido,
            Per_direccion = ve_colaboradorDireccion,
                   Per_dni = ve_colaboradorDNI,
                   Per_email = ve_colaboradorMail,
                   Per_fechaNacimiento = ve_colaboradorNacimiento,
                   Per_nombres = ve_colaboradorNombre,
                   Per_telefonoFijo = ve_colaboradorFijo,
                   Per_telefonoMovil = ve_colaboradorMovil
           where Per_idPersona = @idPersona;  
END IF;

IF ve_opcion='opc_eliminar' then    
  update persona set Per_estado = ve_colaboradorEstado
    where Per_dni = ve_colaboradorDNI;
  set @idPersona = (select Per_idPersona from persona 
                    where Per_dni = ve_colaboradorDNI);
  update personal set Pers_estado = ve_colaboradorEstado
      where Per_idPersona = @idPersona;            
END IF;

IF ve_opcion='opc_contarDetalle' then
  SELECT count(*) as total from personal pe inner join persona p on p.Per_idPersona = p.Per_idPersona
      where p.Per_dni = ve_colaboradorDNI;
END IF;


IF ve_opcion='opc_listarDetalle' then
  SET @idEmpresa = (select s.Emp_idEmpresa 
  from personal p 
    inner join sucursal s on s.Suc_idSucursal=p.Suc_idSucursal
    inner join persona pe on pe.Per_idPersona=p.Per_idPersona 
    where pe.Per_dni = ve_colaboradorDNI);
    
    select pe.Pers_codigo, @idEmpresa, pe.Suc_idSucursal, p.Per_nombres, p.Per_apellidos, p.Per_dni, p.Per_direccion, p.Per_fechaNacimiento, p.Per_telefonoFijo, p.Per_telefonoMovil, p.Per_email, pe.Pers_fechaIngreso
  from personal pe 
    inner join persona p on p.Per_idPersona = pe.Per_idPersona where p.Per_dni = ve_colaboradorDNI;
END IF;

IF ve_opcion ='opc_contar_sucursal_cbo' then
  select count(*) as total from sucursal 
    where Emp_idEmpresa = ve_colaboradorEmpresa and
      Suc_estado = 1;
END IF;

IF ve_opcion = 'opc_listar_sucursal_cbo' then
  select Suc_idSucursal as codigo, Suc_nombre as sucursal
    from sucursal 
    where Emp_idEmpresa = ve_colaboradorEmpresa and
      Suc_estado = 1; 
END IF;

IF ve_opcion = 'opc_contar_personal_usuario_cbo' then
  select count(*) as total from personal where Per_idPersona not in (select Per_idPersona from usuario);
END IF;

IF ve_opcion = 'opc_listar_personal_usuario_cbo' then
  select pe.Per_idPersona as personaId, concat(p.Per_nombres,' ',p.Per_apellidos) as personal
  from personal pe
  inner join persona p on p.Per_idPersona = pe.Per_idPersona
where pe.Per_idPersona not in (select Per_idPersona from usuario);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_rol`(IN `ve_opcion` VARCHAR(50), IN `ve_rolId` INT, IN `ve_rol` VARCHAR(50), IN `ve_rolDescripcion` VARCHAR(200), IN `ve_rolEstado` BOOLEAN)
    NO SQL
BEGIN

IF ve_opcion = 'opc_contar' THEN
  SELECT count(*) as total from rol;
END IF;

IF ve_opcion='opc_listar' then    
  select Rol_idRol as codigo, Rol_nombre as rol, Rol_descripcion as descripcion, (case Rol_estado when 1 then 'Activo' else 'Inactivo' end) as estado from rol;
END IF;

IF ve_opcion = 'opc_contar_cbo' THEN
  SELECT count(*) as total from rol where Rol_estado = 1;
END IF;

IF ve_opcion = 'opc_listar_cbo' THEN
  select Rol_idRol as codigo, Rol_nombre as rol from rol where Rol_estado = 1 order by Rol_nombre;
END IF;

IF ve_opcion='opc_grabar' then
  insert into rol(Rol_nombre, Rol_descripcion, Rol_estado)
           values(ve_rol, ve_rolDescripcion, 1);  
  select 1 as resultado;
END IF;

IF ve_opcion='opc_editar' then
  update rol set Rol_nombre = ve_rol,
              Rol_descripcion = ve_rolDescripcion
           where Rol_idRol = ve_rolId;  
END IF;

IF ve_opcion='opc_eliminar' then    
  update rol set Rol_estado = ve_rolEstado
      where Rol_idRol = ve_rolId;            
END IF;

IF ve_opcion='opc_contarDetalle' then
  SELECT count(*) as total from rol 
      where Rol_idRol = ve_rolId;
END IF;


IF ve_opcion='opc_listarDetalle' then
  select Rol_idRol, Rol_nombre, Rol_descripcion, Rol_estado from rol where Rol_idRol = ve_rolId;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_tipoambiente`(IN `opcion` VARCHAR(200), IN `id` int, IN `descripcion` varchar(50))
BEGIN
if opcion = 'opc_listar' then            
select TA.TipAm_idTipoAmbiente, TA.TipAm_descripcion,case when TA.TipAm_estado=1 then 'Activo' 
when TA.TipAm_estado=0 then 'Inactivo'  end as TipAm_estado
from tipoambiente TA;
end if;  


if opcion = 'opc_grabar' then    
insert into tipoambiente(TipAm_idTipoAmbiente,TipAm_descripcion,TipAm_estado)
values (id,descripcion,1);
end if; 


if opcion = 'opc_buscar' then            
select TA.TipAm_idTipoAmbiente, TA.TipAm_descripcion,TA.TipAm_estado
from tipoambiente TA
where  TA.TipAm_idTipoAmbiente=id;
end if; 

if opcion = 'opc_actualizar' then            
update tipoambiente set TipAm_descripcion=descripcion
where TipAm_idTipoAmbiente=id;
end if; 

if opcion = 'opc_eliminar' then
set @estado=(select TipAm_estado from tipoambiente where TipAm_idTipoAmbiente=id); 
if @estado='1' then          
update tipoambiente set TipAm_estado='0'
where TipAm_idTipoAmbiente=id;

else 
update tipoambiente set TipAm_estado='1'
where TipAm_idTipoAmbiente=id;
end if;
end if; 

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_usuarioview`(IN `ve_opcion` VARCHAR(50), IN `ve_personaId` INT, IN `ve_usuarioLogin` VARCHAR(20), IN `ve_usuarioPass` CHAR(32), IN `ve_usuarioSucursal` INT, IN `ve_usuarioRol` INT, IN `ve_usuarioEstado` BOOLEAN)
    NO SQL
BEGIN

IF ve_opcion = 'opc_contar' THEN
  SELECT count(*) as total from usuario;
END IF;

IF ve_opcion='opc_listar' then    
  select p.Per_idPersona as personaId, pe.Pers_codigo as codigo, 
  concat(p.Per_nombres,' ',p.Per_apellidos) as colaborador, 
    u.Usu_login as login, u.Usu_fechaCreacion as creacion, 
    (case when u.Usu_fechaCese is null then '-' else u.Usu_fechaCese end) as cese, 
    (case when u.Usu_estado = 1 then 'Activo' else 'Inactivo' end) as estado,
  r.Rol_nombre as rol
  from persona p 
  inner join personal pe on pe.Per_idPersona = p.Per_idPersona 
  inner join usuario u on u.Per_idPersona = pe.Per_idPersona
  inner join rol_usuario ru on pe.Per_idPersona = ru.Per_idPersona
  inner join rol r on r.Rol_idRol = ru.Rol_idRol;
END IF;

IF ve_opcion = 'opc_contar_cbo' THEN
  SELECT count(*) as total from usuario where Usu_estado = 1;
END IF;

IF ve_opcion = 'opc_listar_cbo' THEN
  select Üsu_login as codigo, Usu_login as usuario from usuario where Usu_estado = 1 order by Usu_login;
END IF;

IF ve_opcion='opc_grabar' then
  insert into usuario(Per_idPersona, Usu_login,
                   Usu_pass, Usu_estado,
                   Usu_fechaCreacion, Suc_idSucursal)
           values(ve_personaId, ve_usuarioLogin, 
                  ve_usuarioPass, 1,
                  curdate(), ve_usuarioSucursal);  
  insert into rol_usuario(Rol_idRol, Per_idPersona,
                          RolUs_estado)
           values(ve_usuarioRol, ve_personaId,
                  1);
  select 1 as resultado;
END IF;

IF ve_opcion='opc_editar' then
  update usuario set Usu_login = ve_usuarioLogin,
              Usu_pass = ve_usuarioPass              
           where Per_idPersona = ve_personaId;  
  update rol_usuario set Rol_idRol = ve_usuarioRol
        where Per_idPersona = ve_personaId;
END IF;

IF ve_opcion='opc_eliminar' then    
  update usuario set Usu_estado = ve_usuarioEstado
      where Per_idPersona = ve_personaId;            
END IF;

IF ve_opcion='opc_contarDetalle' then
  SELECT count(*) as total from usuario 
      where Per_idPersona = ve_personaId;
END IF;


IF ve_opcion='opc_listarDetalle' then
  select u.Per_idPersona, u.Usu_login, ru.Rol_idRol
  from usuario u
    inner join rol_usuario ru on ru.Per_idPersona = u.Per_idPersona    
    where u.Per_idPersona = ve_personaId;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_control_venta`(IN `opcion` VARCHAR(200), IN `serie` varchar(10), 
IN `numero` int, 
IN `tipo` int, in `estado` int,in `evento` int,in `participante` int, in `monto` decimal(10,2),in `descuento` decimal(10,2), 
in `neto` decimal(10,2))
BEGIN

if opcion = 'opc_listar' then            
select concat(D.DocPago_serieDocumentoPago,'-',D.DocPago_numeroDocumentoPago) as NumeroDocumento,
 concat(PS.Per_nombres,' ',PS.Per_apellidos) as NombreParticipante,
 TD.TipDocPago_descripcion, D.DocPago_fecha,D.DocPago_neto,
case when D.DocPago_estado=1 then 'Cancelada' 
when D.DocPago_estado=0 then 'Pendiente'  end as DocPago_estado  from documentopago D inner join
tipodocumentopago TD on  D.TipDocPago_idTipoDocumentoPago=TD.TipDocPago_idTipoDocumentoPago
inner join Participante P on D.Par_idParticipante=P.Par_idParticipante
inner join Persona PS on P.Per_idPersona=PS.Per_idPersona;
end if; 


if opcion = 'opc_listarEvento' then            
select E.Even_idEvento, E.Even_nombre
from Evento E;
end if; 

if opcion = 'opc_evento' then            
select E.Even_idEvento, E.Even_nombre
from Evento E where E.Even_idEvento=evento;
end if; 

if opcion = 'opc_listarParticipante' then            
select  P.Par_idParticipante,concat(PS.Per_nombres,' ',PS.Per_apellidos) as NombreParticipante,PS.Per_dni
from  Participante P inner join Persona PS on P.Per_idPersona=PS.Per_idPersona
inner join inscripciones I on P.Par_idParticipante=I.Par_idParticipante
where I.Even_idEvento=evento;
end if; 

if opcion = 'opc_participante' then            
select  P.Par_idParticipante,concat(PS.Per_nombres,' ',PS.Per_apellidos) as NombreParticipante
from  Participante P inner join Persona PS on P.Per_idPersona=PS.Per_idPersona 
where P.Par_idParticipante=participante;
end if; 

if opcion = 'opc_condicion' then            
select PA.Paq_descripcion, case when I.Ins_condicion='N' then 'Normal' when I.Ins_condicion='B' then 'Becado'
when I.Ins_condicion='D' then 'Descuento' end as Ins_condicion
from  Participante P inner join Persona PS on P.Per_idPersona=PS.Per_idPersona
inner join inscripciones I on P.Par_idParticipante=I.Par_idParticipante
inner join paquete PA on I.Paq_idPaquete=PA.Paq_idPaquete
where I.Even_idEvento=evento and P.Par_idParticipante=participante;
end if; 

if opcion = 'opc_detalle' then 
SET @PAQUETE = (SELECT Paq_idPaquete AS paquete FROM inscripciones where Par_idParticipante=participante and Even_idEvento=evento);
SET @INSCRIPCION = (SELECT Ins_idInscripcion AS inscripcion FROM inscripciones where Par_idParticipante=participante and Even_idEvento=evento);
if @PAQUETE=1 then
select  I.Even_idEvento as id, E.Even_nombre as descripcion ,E.Even_precioTotal as precio
from inscripciones I inner join evento E on I.Even_idEvento=E.Even_idEvento
where I.Ins_idInscripcion=@INSCRIPCION;
end if; 

if @PAQUETE=2 then
select  A.Acti_idActividad as id,A.Acti_nombre as descripcion ,A.Acti_precio as precio
from inscripcion_actividad IA inner join actividad A on IA.Acti_idActividad=A.Acti_idActividad
where IA.Ins_idInscripcion=@INSCRIPCION;
end if; 
end if;

if opcion = 'opc_total' then            
SET @PAQUETE = (SELECT Paq_idPaquete AS paquete FROM inscripciones where Par_idParticipante=participante and Even_idEvento=evento);
SET @INSCRIPCION = (SELECT Ins_idInscripcion AS inscripcion FROM inscripciones where Par_idParticipante=participante and Even_idEvento=evento);
if @PAQUETE=1 then
select  E.Even_precioTotal as precio,I.Ins_descuento as descuento, E.Even_precioTotal-(E.Even_precioTotal*I.Ins_descuento/100) as neto
from inscripciones I inner join evento E on I.Even_idEvento=E.Even_idEvento
where I.Ins_idInscripcion=@INSCRIPCION;
end if; 

if @PAQUETE=2 then
select  sum(A.Acti_precio) as precio, I.Ins_descuento as descuento,sum(A.Acti_precio)-(sum(A.Acti_precio)*I.Ins_descuento/100)as neto
from inscripcion_actividad IA inner join actividad A on IA.Acti_idActividad=A.Acti_idActividad
inner join inscripciones I on IA.Ins_idInscripcion=I.Ins_idInscripcion
where IA.Ins_idInscripcion=@INSCRIPCION;
end if; 
end if; 

if opcion = 'opc_grabar' then 
SET @DOCUMENTO = (SELECT TipDocPago_idTipoDocumentoPago AS tipodoc FROM inscripciones where Par_idParticipante=participante and Even_idEvento=evento);           
insert into documentopago(DocPago_serieDocumentoPago,DocPago_numeroDocumentoPago,TipDocPago_idTipoDocumentoPago,DocPago_estado,
Par_idParticipante,DocPago_fecha, DocPago_montoTotal,DocPago_descuento,DocPago_neto)
values (serie,numero,@DOCUMENTO,1,participante,curdate(),monto, descuento, neto);



set @serie=serie;
set @numero=numero;
set @monto=monto;
SET @PAQUETE = (SELECT Paq_idPaquete AS paquete FROM inscripciones where Par_idParticipante=participante and Even_idEvento=evento);
SET @INSCRIPCION = (SELECT Ins_idInscripcion AS inscripcion FROM inscripciones where Par_idParticipante=participante and Even_idEvento=evento);
if @PAQUETE=1 then
insert into detalledocumento(DocPago_serieDocumentoPago,DocPago_numeroDocumentoPago,DetaDoc_precioPago)
values(serie,numero,monto);
end if; 

if @PAQUETE=2 then

INSERT INTO detalledocumento (DocPago_serieDocumentoPago,DocPago_numeroDocumentoPago,Acti_idActividad,DetaDoc_precioPago) 
SELECT @serie,@numero, A.Acti_idActividad ,A.Acti_precio FROM 
inscripcion_actividad IA inner join actividad A on IA.Acti_idActividad=A.Acti_idActividad
 where IA.Ins_idInscripcion=@INSCRIPCION;
end if; 
end if; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gestionar_inscripcion`(IN `ve_opcion` VARCHAR(200), IN `ve_participante` INT, IN `ve_banco` VARCHAR(300), IN `ve_nroOperacion` VARCHAR(300), IN `ve_fechaPago` DATE, IN `ve_ruta` VARCHAR(300), IN `ve_tipoPago` INT, IN `ve_paquete` INT, IN `ve_actividad` INT, IN `ve_evento` INT, IN `ve_condicion` VARCHAR(300), IN `ve_montoTotal` VARCHAR(100), IN `ve_descuento` VARCHAR(100))
    NO SQL
BEGIN
IF ve_opcion='opc_nueva_inscripcion' THEN
  insert into inscripciones (Par_idParticipante,Ins_banco,  Ins_numeroOperacion, Ins_fechaPago, Ins_imagenVoucher, TipDocPago_idTipoDocumentoPago,Paq_idPaquete, Even_idEvento, Ins_condicion, Ins_montoTotal, Ins_descuento) values (ve_participante, ve_banco, ve_nroOperacion, ve_fechaPago, ve_ruta, ve_tipoPago, ve_paquete, ve_evento, ve_condicion, ve_montoTotal, ve_descuento);
END IF;
IF ve_opcion='opc_grabar_inscripcion_actividad' THEN
  SET @INCRIPCION = (SELECT MAX(Ins_idInscripcion) AS id FROM inscripciones);
  insert into inscripcion_actividad (Ins_idInscripcion, Acti_idActividad) values (@INCRIPCION, ve_actividad);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gestion_asistencia`(IN `ve_opcion` VARCHAR(300), IN `ve_actividad` INT, IN `ve_participante` INT)
    NO SQL
BEGIN
    IF ve_opcion='opc_mostrar_participantes' THEN
      select P.Par_idParticipante,CONCAT(PE.Per_apellidos,' ',PE.Per_nombres) as nombres, P.Par_nivel, P.Par_carreraProfesional, PE.Per_dni, IA.Ins_parametro from inscripcion_actividad IA
    INNER JOIN inscripciones I ON I.Ins_idInscripcion = IA.Ins_idInscripcion
    INNER JOIN participante P ON P.Par_idParticipante = I.Par_idParticipante
    INNER JOIN persona PE ON PE.Per_idPersona = P.Per_idPersona
where IA.Acti_idActividad = ve_actividad
ORDER BY CONCAT(PE.Per_nombres,' ',PE.Per_apellidos) asc;
    END IF;
    IF ve_opcion='opc_registrar_asistencia' THEN
        INSERT INTO asistencia_actividad (Par_idParticipante, Acti_idActividad, ASIAC_estado) VALUES (ve_participante, ve_actividad, 1);
        UPDATE inscripcion_actividad AS IA
INNER JOIN actividad AS A ON A.Acti_idActividad = IA.Acti_idActividad
INNER JOIN inscripciones I ON I.Ins_idInscripcion = IA.Ins_idInscripcion
INNER JOIN participante P ON P.Par_idParticipante = I.Par_idParticipante
SET IA.Ins_parametro = 0
WHERE IA.Acti_idActividad = ve_actividad and P.Par_idParticipante = ve_participante;
    END IF;
    IF ve_opcion='opc_mostrar_nombre' THEN
        select Acti_nombre from actividad where Acti_idActividad = ve_actividad;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gestion_empresa`(IN `ve_opcion` VARCHAR(100), IN `ve_razonSocial` VARCHAR(200), IN `ve_direccion` VARCHAR(200), IN `ve_ruc` VARCHAR(11), IN `ve_codigo` INT)
    NO SQL
BEGIN
IF ve_opcion='opc_new_empresa' THEN
  INSERT INTO empresa (Emp_razonSocial, Emp_direccion, Emp_RUC, Emp_estado) VALUES (ve_razonSocial, ve_direccion, ve_ruc, 1);
END IF;
IF ve_opcion='opc_mostrar_empresas' THEN
  SELECT Emp_idEmpresa, Emp_razonSocial, Emp_direccion, Emp_RUC, Emp_estado FROM empresa;
END IF;
IF ve_opcion='opc_datos_empresa' THEN 
  SELECT Emp_idEmpresa, Emp_razonSocial, Emp_RUC, Emp_direccion FROM empresa where Emp_idEmpresa = ve_codigo;
END IF;
IF ve_opcion='opc_update_empresa' THEN 
  UPDATE empresa SET Emp_razonSocial = ve_razonSocial, Emp_RUC = ve_ruc, Emp_direccion=ve_direccion where Emp_idEmpresa = ve_codigo;
END IF;
IF ve_opcion='opc_eliminar_empresa' THEN 
  UPDATE empresa SET Emp_estado = 0 where Emp_idEmpresa = ve_codigo;
END IF;
IF ve_opcion='opc_active_empresa' THEN 
  UPDATE empresa SET Emp_estado = 1 where Emp_idEmpresa = ve_codigo;
END IF;

IF ve_opcion = 'opc_contar_empresa_cbo' THEN
  select count(*) as total from empresa 
      where Emp_estado = 1;
END IF;

IF ve_opcion = 'opc_listar_empresa_cbo' THEN
  select Emp_idEmpresa as codigo, Emp_razonSocial as empresa
      from empresa where Emp_estado = 1 
        order by Emp_razonSocial ASC;
END IF;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gestion_participante`(IN `opcion` VARCHAR(50), IN `nombre` VARCHAR(250), IN `apellido` VARCHAR(250), IN `dni` CHAR(8), IN `direccion` TEXT, IN `fechaNacimiento` DATE, IN `telefonoFijo` VARCHAR(100), IN `telefonoMovil` VARCHAR(100), IN `email` VARCHAR(250), IN `nivel` VARCHAR(30), IN `profesion` VARCHAR(250), IN `centroTrabajo` TEXT, IN `codigoParticipante` INT)
    NO SQL
BEGIN

  IF opcion = 'opc_mostrar_participante' THEN
      SELECT pe.Per_idPersona, CONCAT(UPPER(pe.Per_apellidos), ', ', UPPER(pe.Per_nombres)), pe.Per_dni, UPPER(pa.Par_nivel), UPPER(pa.Par_carreraProfesional),pe.Per_email, pe.Per_estado, pa.Par_idParticipante  
  FROM persona pe
    JOIN participante pa ON pe.Per_idPersona = pa.Per_idPersona;
    END IF;

  IF opcion = 'opc_registrar_participante' THEN
      INSERT INTO persona (Per_nombres, Per_apellidos, Per_dni, Per_direccion, Per_fechaNacimiento, Per_telefonoFijo, Per_telefonoMovil, Per_email, Per_estado) VALUES (nombre, apellido, dni, direccion, fechaNacimiento, telefonoFijo, telefonoMovil, email, 1);
        SET @ID = (SELECT MAX(Per_idPersona) FROM persona);
        INSERT INTO participante (Per_idPersona, Par_nivel, Par_carreraProfesional, Par_centroTrabajo) VALUES (@ID, nivel, profesion, centroTrabajo);
    END IF;
    
    IF opcion = 'opc_datos_participante' THEN
      SELECT pe.Per_idPersona, pe.Per_nombres,  pe.Per_apellidos,  pe.Per_dni, pe.Per_direccion, pe.Per_fechaNacimiento, pe.Per_telefonoFijo, pe.Per_telefonoMovil, pe.Per_email, pa.Par_nivel, pa.Par_carreraProfesional, pa.Par_centroTrabajo, pe.Per_estado 
  FROM persona pe
    JOIN participante pa ON pe.Per_idPersona = pa.Per_idPersona
    WHERE pe.Per_idPersona = codigoParticipante;
    END IF;
    
    IF opcion = 'opc_editar_participante' THEN
      UPDATE persona pe
        JOIN participante pa ON pe.Per_idPersona=pa.Per_idPersona
        SET pe.Per_nombres = nombre, pe.Per_apellidos = apellido, pe.Per_dni = dni, pe.Per_direccion = direccion, pe.Per_fechaNacimiento = fechaNacimiento, pe.Per_telefonoFijo = telefonoFijo, pe.Per_telefonoMovil = telefonoMovil, pe.Per_email = email, pa.Par_nivel = nivel, pa.Par_carreraProfesional = profesion, pa.Par_centroTrabajo = centroTrabajo
        WHERE pe.Per_idPersona = codigoParticipante;
    END IF;
    
    IF opcion = 'opc_eliminar_participante' THEN
      UPDATE persona pe
        JOIN participante pa ON pe.Per_idPersona=pa.Per_idPersona
        SET pe.Per_estado = 0
        WHERE pe.Per_idPersona = codigoParticipante AND pe.Per_estado = 1;
    END IF;
    
    IF opcion = 'opc_activar_participante' THEN
      UPDATE persona pe
        JOIN participante pa ON pe.Per_idPersona=pa.Per_idPersona
        SET pe.Per_estado = 1
        WHERE pe.Per_idPersona = codigoParticipante AND pe.Per_estado = 0;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gestion_ponente`(IN `ve_opcion` VARCHAR(200), IN `ve_nombres` VARCHAR(300), IN `ve_apellidos` VARCHAR(300), IN `ve_tipoDoc` INT, IN `ve_nroDoc` VARCHAR(20), IN `ve_direccion` VARCHAR(400), IN `ve_fijo` VARCHAR(400), IN `ve_email` VARCHAR(400), IN `ve_celular` VARCHAR(400), IN `ve_carreraProfesional` VARCHAR(400), IN `ve_fechaNac` DATE, IN `ve_nacionalidad` VARCHAR(200), IN `ve_estadoLaboral` VARCHAR(300), IN `ve_resumenVida` VARCHAR(600), IN `ve_centroTrabajo` VARCHAR(500), IN `ve_cv` VARCHAR(300), IN `ve_codigo` INT)
    NO SQL
BEGIN
IF ve_opcion='opc_combo_tipoDocumento' THEN 
  SELECT  TipoDocId_idTipoDocumentoIdentidad, TipoDocId_descripcion FROM tipodocumentoidentidad ORDER BY TipoDocId_descripcion ASC;
END IF;
IF ve_opcion='opc_mostrar_ponente' THEN 
  SELECT  P.Pon_idPonente, P.Pon_nombre, P.Pon_apellidos, TD.TipoDocId_descripcion, P.Pon_numeroDocumentoIdentidad, P.Pon_carreraProfesional, P.Pon_fechaNacimiento, P.Pon_nacionalidad, P.Pon_estadoLaboral, P.Pon_hojaVida, P.Pon_centroTrabajoActual, P.Pon_estado, P.Pon_cv FROM ponente P INNER JOIN tipodocumentoidentidad TD ON TD.TipoDocId_idTipoDocumentoIdentidad = P.TipoDocId_idTipoDocumentoIdentidad;
END IF;
IF ve_opcion='opc_new_ponente' THEN 
  INSERT INTO ponente (Pon_nombre, Pon_apellidos, TipoDocId_idTipoDocumentoIdentidad, Pon_numeroDocumentoIdentidad, Pon_direccion, Pon_fijo, Pon_email, Pon_celular, Pon_carreraProfesional, Pon_fechaNacimiento, Pon_nacionalidad, Pon_estadoLaboral, Pon_hojaVida, Pon_centroTrabajoActual, Pon_cv, Pon_estado) VALUES (ve_nombres, ve_apellidos, ve_tipoDoc, ve_nroDoc, ve_direccion, ve_fijo, ve_email, ve_celular, ve_carreraProfesional, ve_fechaNac, ve_nacionalidad, ve_estadoLaboral, ve_resumenVida, ve_centroTrabajo, ve_cv, 1);
END IF;
IF ve_opcion='opc_datos_ponente' THEN 
  SELECT P.Pon_nombre, P.Pon_apellidos, P.TipoDocId_idTipoDocumentoIdentidad, P.Pon_numeroDocumentoIdentidad, P.Pon_direccion, P.Pon_fijo, P.Pon_email, P.Pon_celular, P.Pon_carreraProfesional, P.Pon_fechaNacimiento, P.Pon_nacionalidad, P.Pon_estadoLaboral, P.Pon_hojaVida, P.Pon_centroTrabajoActual, P.Pon_cv, P.Pon_estado, TD.TipoDocId_descripcion FROM ponente P INNER JOIN tipodocumentoidentidad TD ON TD.TipoDocId_idTipoDocumentoIdentidad = P.TipoDocId_idTipoDocumentoIdentidad WHERE Pon_idPonente = ve_codigo;
END IF;
IF ve_opcion='opc_update_ponente_nocv' THEN 
  UPDATE ponente SET Pon_nombre = ve_nombres, Pon_apellidos = ve_apellidos, TipoDocId_idTipoDocumentoIdentidad = ve_tipoDoc, Pon_numeroDocumentoIdentidad = ve_nroDoc, Pon_direccion = ve_direccion, Pon_fijo = ve_fijo, Pon_email = ve_email, Pon_celular = ve_celular, Pon_carreraProfesional = ve_carreraProfesional, Pon_fechaNacimiento = ve_fechaNac, Pon_nacionalidad = ve_nacionalidad, Pon_estadoLaboral = ve_estadoLaboral, Pon_hojaVida = ve_resumenVida, Pon_centroTrabajoActual = ve_centroTrabajo WHERE Pon_idPonente = ve_codigo;
END IF;
IF ve_opcion='opc_update_ponente_sicv' THEN 
  UPDATE ponente SET Pon_nombre = ve_nombres, Pon_apellidos = ve_apellidos, TipoDocId_idTipoDocumentoIdentidad = ve_tipoDoc, Pon_numeroDocumentoIdentidad = ve_nroDoc, Pon_direccion = ve_direccion, Pon_fijo = ve_fijo, Pon_email = ve_email, Pon_celular = ve_celular, Pon_carreraProfesional = ve_carreraProfesional, Pon_fechaNacimiento = ve_fechaNac, Pon_nacionalidad = ve_nacionalidad, Pon_estadoLaboral = ve_estadoLaboral, Pon_hojaVida = ve_resumenVida, Pon_centroTrabajoActual = ve_centroTrabajo, Pon_cv = ve_cv WHERE Pon_idPonente = ve_codigo;
END IF;
IF ve_opcion='opc_eliminar_ponente' THEN 
  UPDATE ponente SET Pon_estado = 0 WHERE Pon_idPonente = ve_codigo;
END IF;
IF ve_opcion='opc_active_ponente' THEN 
  UPDATE ponente SET Pon_estado = 1 WHERE Pon_idPonente = ve_codigo;
END IF;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gestion_sucursal`(IN `ve_opcion` VARCHAR(100), IN `ve_nombre` VARCHAR(200), IN `ve_direccion` VARCHAR(200), IN `ve_empresa` INT, IN `ve_codigo` INT)
    NO SQL
BEGIN
IF ve_opcion='opc_new_sucursal' THEN
  INSERT INTO sucursal (Suc_nombre, Suc_direccion, Suc_estado, Emp_idEmpresa) VALUES (ve_nombre, ve_direccion, 1, ve_empresa);
END IF;
IF ve_opcion='opc_mostrar_sucursal' THEN
  SELECT S.Suc_idSucursal, S.Suc_nombre, S.Suc_direccion, E.Emp_razonSocial, S.Suc_estado FROM sucursal S INNER JOIN empresa E ON E.Emp_idEmpresa = S.Emp_idEmpresa;
END IF;
IF ve_opcion='opc_datos_sucursal' THEN 
  SELECT S.Suc_idSucursal, S.Suc_nombre, S.Suc_direccion, S.Emp_idEmpresa, S.Suc_estado FROM sucursal S WHERE S.Suc_idSucursal = ve_codigo;
END IF;
IF ve_opcion='opc_update_sucursal' THEN 
  UPDATE sucursal SET Suc_nombre = ve_nombre, Suc_direccion = ve_direccion, Emp_idEmpresa=ve_empresa where Suc_idSucursal = ve_codigo;
END IF;
IF ve_opcion='opc_eliminar_sucursal' THEN 
  UPDATE sucursal SET Suc_estado = 0 where Suc_idSucursal = ve_codigo;
END IF;
IF ve_opcion='opc_active_sucursal' THEN 
  UPDATE sucursal SET Suc_estado = 1 where Suc_idSucursal = ve_codigo;
END IF;
IF ve_opcion='opc_combo_empresa' THEN 
  SELECT Emp_idEmpresa, Emp_razonSocial FROM empresa where Emp_estado = 1 ORDER BY Emp_razonSocial ASC;
END IF;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
  `Acti_idActividad` int(11) NOT NULL AUTO_INCREMENT,
  `Even_idEvento` int(11) NOT NULL,
  `Pon_idPonente` int(11) DEFAULT NULL,
  `Acti_nombre` varchar(200) NOT NULL,
  `Acti_descripcion` varchar(500) NOT NULL,
  `Acti_precio` decimal(9,2) DEFAULT NULL,
  `Amb_idAmbiente` int(11) DEFAULT NULL,
  `Acti_fecha` varchar(11) DEFAULT NULL,
  `Acti_horaInicio` varchar(10) DEFAULT NULL,
  `Acti_horaFin` varchar(10) DEFAULT NULL,
  `TipoActi_idTipoActividad` int(11) NOT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`Acti_idActividad`),
  KEY `Even_idEvento` (`Even_idEvento`),
  KEY `Pon_idPonente` (`Pon_idPonente`),
  KEY `Amb_idAmbiente` (`Amb_idAmbiente`),
  KEY `TipoActi_idTipoActividad` (`TipoActi_idTipoActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ambiente`
--

CREATE TABLE IF NOT EXISTS `ambiente` (
  `Amb_idAmbiente` int(11) NOT NULL AUTO_INCREMENT,
  `Amb_descripcion` varchar(50) DEFAULT NULL,
  `Amb_capacidad` int(11) DEFAULT NULL,
  `Amb_estado` int(11) DEFAULT NULL,
  `TipAm_idTipoAmbiente` int(11) DEFAULT NULL,
  `Loc_idLocal` int(11) DEFAULT NULL,
  PRIMARY KEY (`Amb_idAmbiente`),
  KEY `TipAm_idTipoAmbiente` (`TipAm_idTipoAmbiente`),
  KEY `Loc_idLocal` (`Loc_idLocal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

insert into ambiente(Amb_idAmbiente, Amb_descripcion, Amb_capacidad, Amb_estado, TipAm_idTipoAmbiente, Loc_idLocal) values
  (1,'Ambiente 1','200',1,'1',1);

-- --------------------------------------------------------

--
-- Table structure for table `asistencia_actividad`
--

CREATE TABLE IF NOT EXISTS `asistencia_actividad` (
  `ASIAC_id` int(11) NOT NULL AUTO_INCREMENT,
  `Par_idParticipante` int(11) NOT NULL,
  `Acti_idActividad` int(11) NOT NULL,
  `ASIAC_estado` char(1) NOT NULL,
  PRIMARY KEY (`ASIAC_id`),
  KEY `Par_idParticipante` (`Par_idParticipante`),
  KEY `Acti_idActividad` (`Acti_idActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `certificacion`
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
-- Table structure for table `detalledocumento`
--

CREATE TABLE IF NOT EXISTS `detalledocumento` (
  `DetaDoc_correlativoDetalleDocumento` int(11) NOT NULL AUTO_INCREMENT,
  `DocPago_serieDocumentoPago` varchar(10) NOT NULL,
  `DocPago_numeroDocumentoPago` int(11) NOT NULL,
  `Acti_idActividad` int(11) DEFAULT NULL,
  `DetaDoc_precioPago` decimal(10,2) NOT NULL,
  PRIMARY KEY (`DetaDoc_correlativoDetalleDocumento`),
  KEY `DocPago_serieDocumentoPago` (`DocPago_serieDocumentoPago`,`DocPago_numeroDocumentoPago`),
  KEY `Acti_idActividad` (`Acti_idActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `documentopago`
--

CREATE TABLE IF NOT EXISTS `documentopago` (
  `DocPago_serieDocumentoPago` varchar(10) NOT NULL,
  `DocPago_numeroDocumentoPago` int(11) NOT NULL,
  `TipDocPago_idTipoDocumentoPago` int(11) NOT NULL,
  `DocPago_estado` int(11) NOT NULL,
  `Par_idParticipante` int(11) NOT NULL,
  `DocPago_fecha` datetime NOT NULL,
  PRIMARY KEY (`DocPago_serieDocumentoPago`,`DocPago_numeroDocumentoPago`),
  KEY `TipDocPago_idTipoDocumentoPago` (`TipDocPago_idTipoDocumentoPago`),
  KEY `Par_idParticipante` (`Par_idParticipante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `Emp_idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `Emp_RUC` char(11) NOT NULL,
  `Emp_razonSocial` varchar(100) NOT NULL,
  `Emp_direccion` varchar(100) NOT NULL,
  `Emp_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Emp_idEmpresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`Emp_idEmpresa`, `Emp_RUC`, `Emp_razonSocial`, `Emp_direccion`, `Emp_estado`) VALUES
(1, '12345678901', 'Business Solution Enterprise S.A.C.', 'DirecciÃ³n de BSE 123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `especializacion`
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
-- Table structure for table `evento`
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
  `Even_estado` char(1) NOT NULL,
  `Even_simultaneo` char(2) NULL, 
  PRIMARY KEY (`Even_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
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
-- Dumping data for table `grupo`
--

INSERT INTO `grupo` (`Gru_idGrupo`, `Gru_nombre`, `Gru_descripcion`, `Gru_orden`, `Gru_estado`) VALUES
(1, 'Parámetros', 'Modulo de parametros generales del sistema', 1, 1),
(2, 'Acceso y Seguridad', 'Modulo para el control de accesos y seguridad del sistema', 2, 1),
(3, 'Auditoría', 'Modulo para la realizacion de la auditoria del sistema', 3, 1),
(4, 'Mantenedores', 'Modulo para las tablas maestras del sistema', 4, 1),
(5, 'Gestión de Eventos', 'Modulo para la gestion de eventos realizados por BSE', 5, 1),
(6, 'Facturacion', 'Modulo para la realizacion de las facturaciones de cada evento', 6, 1),
(7, 'Reportes', 'Modulo para la generacion de los reportes necesarios para la toma de decisiones.', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inscripciones`
--

CREATE TABLE IF NOT EXISTS `inscripciones` (
  `Ins_idInscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `Par_idParticipante` int(11) NOT NULL,
  `Even_idEvento` int(11) NOT NULL,
  `Ins_banco` varchar(50) NOT NULL,
  `Ins_numeroOperacion` varchar(50) NOT NULL,
  `Ins_fechaPago` date DEFAULT NULL,
  `Ins_imagenVoucher` varchar(100) NOT NULL,
  `TipDocPago_idTipoDocumentoPago` int(11) NOT NULL,
  `Paq_idPaquete` int(11) NOT NULL,
  `Ins_descuento` varchar(100) NOT NULL,
  `Ins_MontoTotal` varchar(100) NOT NULL,
  `Ins_condicion` char(1) NOT NULL,
  PRIMARY KEY (`Ins_idInscripcion`),
  KEY `Par_idParticipante` (`Par_idParticipante`),
  KEY `Even_idEvento` (`Even_idEvento`),
  KEY `TipDocPago_idTipoDocumentoPago` (`TipDocPago_idTipoDocumentoPago`),
  KEY `Paq_idPaquete` (`Paq_idPaquete`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inscripcion_actividad`
--

CREATE TABLE IF NOT EXISTS `inscripcion_actividad` (
  `InsAct_idInscripcionActividad` int(11) NOT NULL AUTO_INCREMENT,
  `Ins_idInscripcion` int(11) NOT NULL,
  `Acti_idActividad` int(11) NOT NULL,
  `Ins_parametro` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`InsAct_idInscripcionActividad`),
  KEY `Ins_idInscripcion` (`Ins_idInscripcion`),
  KEY `Acti_idActividad` (`Acti_idActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `locala`
--

CREATE TABLE IF NOT EXISTS `locala` (
  `Loc_idLocal` int(11) NOT NULL AUTO_INCREMENT,
  `Loc_descripcion` varchar(50) DEFAULT NULL,
  `Loc_direccion` varchar(50) DEFAULT NULL,
  `Loc_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`Loc_idLocal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

insert into locala(Loc_idLocal, Loc_descripcion, Loc_direccion, Loc_estado) values
  (1,'Primer local','Direccion',1);
-- --------------------------------------------------------

--
-- Table structure for table `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `Mod_idModulo` int(11) NOT NULL AUTO_INCREMENT,
  `Mod_descripcion` varchar(50) NOT NULL,
  `Mod_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Mod_idModulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `modulo`
--

INSERT INTO `modulo` (`Mod_idModulo`, `Mod_descripcion`, `Mod_estado`) VALUES
(1, 'Parámetros', 1),
(2, 'Acceso y Seguridad', 1),
(3, 'Auditoría', 1),
(4, 'Mantenedores', 1),
(5, 'Gestión de Eventos', 1),
(6, 'Facturacion', 1),
(7, 'Reportes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `paquete`
--

CREATE TABLE IF NOT EXISTS `paquete` (
  `Paq_idPaquete` int(11) NOT NULL AUTO_INCREMENT,
  `Paq_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Paq_idPaquete`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `paquete`
--

INSERT INTO `paquete` (`Paq_idPaquete`, `Paq_descripcion`) VALUES
(1, 'Paquete 1'),
(2, 'Paquete 2');

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE IF NOT EXISTS `participante` (
  `Par_idParticipante` int(11) NOT NULL AUTO_INCREMENT,
  `Per_idPersona` int(11) NOT NULL,
  `Par_nivel` varchar(50) NOT NULL,
  `Par_carreraProfesional` varchar(50) NOT NULL,
  `Par_centroTrabajo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Par_idParticipante`),
  KEY `Per_idPersona` (`Per_idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `participante`
--

INSERT INTO `participante` (`Par_idParticipante`, `Per_idPersona`, `Par_nivel`, `Par_carreraProfesional`, `Par_centroTrabajo`) VALUES
(1, 2, 'estudiante', 'Ing. sistemas', 'UNTweqe'),
(2, 3, 'profesional', 'ing. industrial', 'CAMPOSOL'),
(4, 5, 'profesional', 'Ing. Informática', 'CAJA TRUJILLO');

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
  `Pso_idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `Rol_idRol` int(11) NOT NULL,
  `Tar_idTarea` int(11) NOT NULL,
  `Pso_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Pso_idPermiso`),
  KEY `Rol_idRol` (`Rol_idRol`),
  KEY `Tar_idTarea` (`Tar_idTarea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `permiso`
--

INSERT INTO `permiso` (`Pso_idPermiso`, `Rol_idRol`, `Tar_idTarea`, `Pso_estado`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 1),
(13, 1, 13, 1),
(14, 1, 14, 1),
(15, 1, 15, 1),
(16, 1, 16, 1),
(17, 1, 17, 1),
(18, 1, 18, 1),
(19, 1, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`Per_idPersona`, `Per_nombres`, `Per_apellidos`, `Per_dni`, `Per_direccion`, `Per_fechaNacimiento`, `Per_telefonoFijo`, `Per_telefonoMovil`, `Per_email`, `Per_estado`) VALUES
(1, 'Alberto', 'Mendoza de los Santos', '12345678', 'Direccion del ing. Mendoza', '2016-11-03', '044192837', '949147839', 'amds@yahoo.es', 1),
(2, 'Erick ', 'Alfaro Gómez ', '12345678', 'Av. Perú 1025 ', '1994-09-12', '555555', '965825416', 'egag@hotmail.com', 1),
(3, 'Juan', 'Pérez Pérez', '17246598', 'Jr. San Manuel 154', '1989-01-01', '44-256253', '956854126', 'juan.perez@gmail.com', 1),
(5, 'José Carlos', 'Sánchez Fernández', '56497810', 'Av. América 2155', '1990-10-05', '01-1245871', '956481236', 'jsanchez@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal`
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
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`Per_idPersona`, `Pers_codigo`, `Pers_fechaIngreso`, `Pers_fechaSalida`, `Suc_idSucursal`, `Pers_estado`) VALUES
(1, 'AMDS01', '2016-11-03', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ponente`
--

CREATE TABLE IF NOT EXISTS `ponente` (
  `Pon_idPonente` int(11) NOT NULL AUTO_INCREMENT,
  `Pon_nombre` varchar(100) NOT NULL,
  `Pon_apellidos` varchar(100) NOT NULL,
  `TipoDocId_idTipoDocumentoIdentidad` int(11) NOT NULL,
  `Pon_numeroDocumentoIdentidad` varchar(20) DEFAULT NULL,
  `Pon_direccion` varchar(500) NOT NULL,
  `Pon_fijo` varchar(15) NOT NULL,
  `Pon_email` varchar(100) NOT NULL,
  `Pon_celular` varchar(15) NOT NULL,
  `Pon_carreraProfesional` varchar(50) DEFAULT NULL,
  `Pon_fechaNacimiento` date DEFAULT NULL,
  `Pon_nacionalidad` varchar(50) DEFAULT NULL,
  `Pon_estadoLaboral` varchar(50) DEFAULT NULL,
  `Pon_hojaVida` mediumtext,
  `Pon_centroTrabajoActual` varchar(200) DEFAULT NULL,
  `Pon_cv` varchar(200) NOT NULL,
  `Pon_estado` int(11) NOT NULL,
  PRIMARY KEY (`Pon_idPonente`),
  KEY `TipoDocId_idTipoDocumentoIdentidad` (`TipoDocId_idTipoDocumentoIdentidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ponente`
--

INSERT INTO `ponente` (`Pon_idPonente`, `Pon_nombre`, `Pon_apellidos`, `TipoDocId_idTipoDocumentoIdentidad`, `Pon_numeroDocumentoIdentidad`, `Pon_direccion`, `Pon_fijo`, `Pon_email`, `Pon_celular`, `Pon_carreraProfesional`, `Pon_fechaNacimiento`, `Pon_nacionalidad`, `Pon_estadoLaboral`, `Pon_hojaVida`, `Pon_centroTrabajoActual`, `Pon_cv`, `Pon_estado`) VALUES
(1, 'Jorge Luis', 'Arias Tandaypan', 1, '47934182', 'Ramón Castilla 263', '044-414514', 'ariastandaypan@gmail.com', '953536749', 'Ingenieria de Sistemas', '1993-09-09', 'Peruana', 'PROGRAMADOR', 'RESUMEN DE HOJA DE VIDA PRUEBA', 'PREMIUN.NET', '../../view/cv/CV_JORGE LUIS ARIAS TANDAYPAN.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `Rol_idRol` int(11) NOT NULL AUTO_INCREMENT,
  `Rol_nombre` varchar(50) NOT NULL,
  `Rol_descripcion` varchar(100) NOT NULL,
  `Rol_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Rol_idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`Rol_idRol`, `Rol_nombre`, `Rol_descripcion`, `Rol_estado`) VALUES
(1, 'Administrador', 'Rol que se le asignara al administrador del sistema', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rol_usuario`
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
-- Dumping data for table `rol_usuario`
--

INSERT INTO `rol_usuario` (`RolUs_idRolUsuario`, `Rol_idRol`, `Per_idPersona`, `RolUs_estado`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sucursal`
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
-- Dumping data for table `sucursal`
--

INSERT INTO `sucursal` (`Suc_idSucursal`, `Suc_nombre`, `Suc_direccion`, `Suc_estado`, `Emp_idEmpresa`) VALUES
(1, 'BSE Events', 'Direccion de BSE', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tarea`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tarea`
--

INSERT INTO `tarea` (`Tar_idTarea`, `Mod_idModulo`, `Gru_idGrupo`, `Tar_nombre`, `Tar_descripcion`, `Tar_orden`, `Tar_url`, `Tar_estado`) VALUES
(1, 1, 1, 'Grupos', 'Grupos', 1, '../Param_generales/grupo_view.php', 1),
(2, 1, 1, 'Opciones', 'Opciones', 2, '../Param_generales/opcion_view.php', 1),
(3, 1, 1, 'Roles', 'Roles', 3, '../Param_generales/rol_view.php', 1),
(4, 1, 1, 'Multitabla', 'Multitabla', 4, '../Param_generales/multitabla_view.php', 1),
(5, 2, 4, 'Ponentes', 'Gestion de Ponentes', 1, '../Mantenedores/ponente_view.php', 1),
(6, 2, 4, 'Empresas', 'Gestion de Empresas', 2, '../Mantenedores/empresa_view.php', 1),
(7, 2, 4, 'Sucursales', 'Gestión de Sucursales', 3, '../Mantenedores/sucursal_view.php', 1),
(8, 2, 4, 'Ambientes', 'Mantenedor de Ambientes', 4, '../Mantenedores/ambiente_view.php', 1),
(9, 5, 5, 'Listado de Eventos', 'Listado de eventos', 1, '../eventos/lista_eventos.php', 1),
(10, 5, 5, 'Nuevo Evento', 'Nuevo evento', 1, '../eventos/registrar_evento.php', 1),
(11, 2, 4, 'Participantes', 'Gestion de Participantes', 5, '../Mantenedores/participante_view.php', 1),
(12, 3, 5, 'Inscripciones', 'Inscripciones de los participantes', 3, '../Evento/Inscripcion_view.php', 1),
(13, 2, 2, 'Personal', 'Mantenedor para el personal de trabajo', 1, '../AccesoSeguridad/personal_view.php', 1),
(14, 2, 2, 'Usuarios', 'Control de Usuarios del sistema', 2, '../AccesoSeguridad/usuario_view.php', 1),
(15, 2, 2, 'Permisos', 'Vista para la gestión de los permisos para cada rol', 3, '../AccesoSeguridad/permiso_view.php', 1),
(16, 6, 6, 'Listado de Ventas', 'Listado de ventas', 1, '../Facturacion/ventas_view.php', 1),
(17, 6, 6, 'Registro de Ventas', 'Registro de ventas', 2, '../Facturacion/nuevaVenta_view.php', 1),
(18, 2, 4, 'Tipo Ambiente', 'Mantenedor de tipo ambiente', 6, '../Mantenedores/tipoambiente_view.php', 1),
(19, 2, 4, 'Local', 'Mantenedor de local', 7, '../Mantenedores/local_view.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipoactividad`
--

CREATE TABLE IF NOT EXISTS `tipoactividad` (
  `TipoActi_idTipoActividad` int(11) NOT NULL AUTO_INCREMENT,
  `TipoActi_descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`TipoActi_idTipoActividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tipoactividad`
--

INSERT INTO `tipoactividad` (`TipoActi_idTipoActividad`, `TipoActi_descripcion`) VALUES
(1, 'PONENCIA'),
(2, 'TALLER');

-- --------------------------------------------------------

--
-- Table structure for table `tipoambiente`
--

CREATE TABLE IF NOT EXISTS `tipoambiente` (
  `TipAm_idTipoAmbiente` int(11) NOT NULL AUTO_INCREMENT,
  `TipAm_descripcion` varchar(50) DEFAULT NULL,
  `TipAm_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`TipAm_idTipoAmbiente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tipoambiente`
--

INSERT INTO `tipoambiente` (`TipAm_idTipoAmbiente`, `TipAm_descripcion`, `TipAm_estado`) VALUES
(1, 'Auditorio', 1),
(2, 'Laboratorio', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipodocumentoidentidad`
--

CREATE TABLE IF NOT EXISTS `tipodocumentoidentidad` (
  `TipoDocId_idTipoDocumentoIdentidad` int(11) NOT NULL AUTO_INCREMENT,
  `TipoDocId_descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`TipoDocId_idTipoDocumentoIdentidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tipodocumentoidentidad`
--

INSERT INTO `tipodocumentoidentidad` (`TipoDocId_idTipoDocumentoIdentidad`, `TipoDocId_descripcion`) VALUES
(1, 'DNI'),
(2, 'LIBRETA MILITAR'),
(3, 'CARNET DE EXTRANJERIA');

-- --------------------------------------------------------

--
-- Table structure for table `tipodocumentopago`
--

CREATE TABLE IF NOT EXISTS `tipodocumentopago` (
  `TipDocPago_idTipoDocumentoPago` int(11) NOT NULL AUTO_INCREMENT,
  `TipDocPago_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`TipDocPago_idTipoDocumentoPago`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tipodocumentopago`
--

INSERT INTO `tipodocumentopago` (`TipDocPago_idTipoDocumentoPago`, `TipDocPago_descripcion`) VALUES
(1, 'Tipo Pago 1'),
(2, 'Tipo Pago 2');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `Per_idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `Usu_login` varchar(30) NOT NULL,
  `Usu_pass` varchar(32) NOT NULL,
  `Usu_estado` tinyint(1) NOT NULL,
  `Usu_fechaCreacion` date NOT NULL,
  `Usu_fechaCese` date DEFAULT NULL,
  `Suc_idSucursal` int(11) NOT NULL,
  PRIMARY KEY (`Per_idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`Per_idPersona`, `Usu_login`, `Usu_pass`, `Usu_estado`, `Usu_fechaCreacion`, `Usu_fechaCese`, `Suc_idSucursal`) VALUES
(1, 'amds', '202cb962ac59075b964b07152d234b70', 1, '0000-00-00', NULL, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`Even_idEvento`) REFERENCES `evento` (`Even_idEvento`),
  ADD CONSTRAINT `actividad_ibfk_2` FOREIGN KEY (`Pon_idPonente`) REFERENCES `ponente` (`Pon_idPonente`),
  ADD CONSTRAINT `actividad_ibfk_3` FOREIGN KEY (`Amb_idAmbiente`) REFERENCES `ambiente` (`Amb_idAmbiente`),
  ADD CONSTRAINT `actividad_ibfk_4` FOREIGN KEY (`TipoActi_idTipoActividad`) REFERENCES `tipoactividad` (`TipoActi_idTipoActividad`);

--
-- Constraints for table `ambiente`
--
ALTER TABLE `ambiente`
  ADD CONSTRAINT `ambiente_ibfk_1` FOREIGN KEY (`TipAm_idTipoAmbiente`) REFERENCES `tipoambiente` (`TipAm_idTipoAmbiente`),
  ADD CONSTRAINT `ambiente_ibfk_2` FOREIGN KEY (`Loc_idLocal`) REFERENCES `locala` (`Loc_idLocal`);

--
-- Constraints for table `asistencia_actividad`
--
ALTER TABLE `asistencia_actividad`
  ADD CONSTRAINT `asistencia_actividad_ibfk_1` FOREIGN KEY (`Par_idParticipante`) REFERENCES `participante` (`Par_idParticipante`),
  ADD CONSTRAINT `asistencia_actividad_ibfk_2` FOREIGN KEY (`Acti_idActividad`) REFERENCES `actividad` (`Acti_idActividad`);

--
-- Constraints for table `certificacion`
--
ALTER TABLE `certificacion`
  ADD CONSTRAINT `certificacion_ibfk_1` FOREIGN KEY (`Pon_idPonente`) REFERENCES `ponente` (`Pon_idPonente`);

--
-- Constraints for table `detalledocumento`
--
ALTER TABLE `detalledocumento`
  ADD CONSTRAINT `detalledocumento_ibfk_1` FOREIGN KEY (`DocPago_serieDocumentoPago`, `DocPago_numeroDocumentoPago`) REFERENCES `documentopago` (`DocPago_serieDocumentoPago`, `DocPago_numeroDocumentoPago`),
  ADD CONSTRAINT `detalledocumento_ibfk_2` FOREIGN KEY (`Acti_idActividad`) REFERENCES `actividad` (`Acti_idActividad`);

--
-- Constraints for table `documentopago`
--
ALTER TABLE `documentopago`
  ADD CONSTRAINT `documentopago_ibfk_1` FOREIGN KEY (`TipDocPago_idTipoDocumentoPago`) REFERENCES `tipodocumentopago` (`TipDocPago_idTipoDocumentoPago`),
  ADD CONSTRAINT `documentopago_ibfk_2` FOREIGN KEY (`Par_idParticipante`) REFERENCES `participante` (`Par_idParticipante`);

--
-- Constraints for table `especializacion`
--
ALTER TABLE `especializacion`
  ADD CONSTRAINT `especializacion_ibfk_1` FOREIGN KEY (`Pon_idPonente`) REFERENCES `ponente` (`Pon_idPonente`);

--
-- Constraints for table `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`Par_idParticipante`) REFERENCES `participante` (`Par_idParticipante`),
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`Even_idEvento`) REFERENCES `evento` (`Even_idEvento`),
  ADD CONSTRAINT `inscripciones_ibfk_3` FOREIGN KEY (`TipDocPago_idTipoDocumentoPago`) REFERENCES `tipodocumentopago` (`TipDocPago_idTipoDocumentoPago`),
  ADD CONSTRAINT `inscripciones_ibfk_4` FOREIGN KEY (`Paq_idPaquete`) REFERENCES `paquete` (`Paq_idPaquete`);

--
-- Constraints for table `inscripcion_actividad`
--
ALTER TABLE `inscripcion_actividad`
  ADD CONSTRAINT `inscripcion_actividad_ibfk_1` FOREIGN KEY (`Ins_idInscripcion`) REFERENCES `inscripciones` (`Ins_idInscripcion`),
  ADD CONSTRAINT `inscripcion_actividad_ibfk_2` FOREIGN KEY (`Acti_idActividad`) REFERENCES `actividad` (`Acti_idActividad`);

--
-- Constraints for table `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `participante_ibfk_1` FOREIGN KEY (`Per_idPersona`) REFERENCES `persona` (`Per_idPersona`);

--
-- Constraints for table `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`Rol_idRol`) REFERENCES `rol` (`Rol_idRol`),
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`Tar_idTarea`) REFERENCES `tarea` (`Tar_idTarea`);

--
-- Constraints for table `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`Per_idPersona`) REFERENCES `persona` (`Per_idPersona`),
  ADD CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`Suc_idSucursal`) REFERENCES `sucursal` (`Suc_idSucursal`);

--
-- Constraints for table `ponente`
--
ALTER TABLE `ponente`
  ADD CONSTRAINT `ponente_ibfk_1` FOREIGN KEY (`TipoDocId_idTipoDocumentoIdentidad`) REFERENCES `tipodocumentoidentidad` (`TipoDocId_idTipoDocumentoIdentidad`);

--
-- Constraints for table `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD CONSTRAINT `rol_usuario_ibfk_1` FOREIGN KEY (`Rol_idRol`) REFERENCES `rol` (`Rol_idRol`),
  ADD CONSTRAINT `rol_usuario_ibfk_2` FOREIGN KEY (`Per_idPersona`) REFERENCES `usuario` (`Per_idPersona`);

--
-- Constraints for table `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`Emp_idEmpresa`) REFERENCES `empresa` (`Emp_idEmpresa`);

--
-- Constraints for table `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`Mod_idModulo`) REFERENCES `modulo` (`Mod_idModulo`),
  ADD CONSTRAINT `tarea_ibfk_2` FOREIGN KEY (`Gru_idGrupo`) REFERENCES `grupo` (`Gru_idGrupo`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Per_idPersona`) REFERENCES `personal` (`Per_idPersona`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
