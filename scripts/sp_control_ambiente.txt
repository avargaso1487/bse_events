USE `bse_events`;
DROP procedure IF EXISTS `sp_control_ambiente`;

DELIMITER $$
USE `bse_events`$$
CREATE  PROCEDURE `sp_control_ambiente`(IN `opcion` VARCHAR(200), IN `codigo` INT, IN `descripcion` varchar(50), 
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

DELIMITER ;

