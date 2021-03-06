<?php 
    include_once '../../model/conexion_model.php';
    class Actividad_model {
        public $param = array();
        function __construct() {
            $this->conexion = Conexion_Model::getConexion();
        }
        function cerrarAbrir(){
            mysqli_close($this->conexion);
            $this->conexion = Conexion_Model::getConexion();
        }
        function get_participantes($param){
            $sql = "SELECT * FROM inscripcion_actividad
                    WHERE Acti_idActividad = ".$param['actividadID'];
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            return mysqli_num_rows($res);
        }
        function actualizar_por_actividad($param){
            $sql = "UPDATE evento 
                    SET Even_precioTotal = Even_precioTotal + '".$param['precio']."'
                    WHERE Even_idEvento = '".$param['eventoID']."'
                    ";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            if(!$res) return  0;
            return  1;
        }
        function eliminar_actividad($param){
            $sql = "DELETE FROM actividad 
                    WHERE Acti_idActividad = ".$param['actividadID']." and Even_idEvento = ".$param['eventoID'];
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            if(!$res) return  "No se pudo eliminar";
            else return 1;
        }
        function update_actividad($param){
            $sql = "UPDATE actividad 
                    SET 
                    Pon_idPonente = '".$param['ponenteID']."',
                    Acti_nombre = '".strtoupper($param['actividad'])."',
                    Acti_descripcion = '".$param['descripcion']."',
                    Acti_precio = '".$param['precio']."',
                    Amb_idAmbiente = '".$param['ambienteID']."',
                    Acti_fecha = '".$param['fecha']."',
                    Acti_horaInicio = '".$param['horaI']."',
                    Acti_horaFin = '".$param['horaF']."',
                    TipoActi_idTipoActividad = '".$param['tipoActividadID']."',
                    estado = '".$param['estado']."'

                    WHERE Acti_idActividad = '".$param['actividadID']."' and Even_idEvento = '".$param['eventoID']."' 
                    ";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            if(!$res) return  0;
            else return 1;
        }
        function registrar_nueva_actividad($param){
            $sql = "INSERT INTO actividad (
                    Even_idEvento,
                    Pon_idPonente,
                    Acti_nombre,
                    Acti_descripcion,
                    Acti_precio,
                    Amb_idAmbiente,
                    Acti_fecha,
                    Acti_horaInicio,
                    Acti_horaFin,
                    TipoActi_idTipoActividad,
                    estado
                    ) VALUES(
                    '".$param['eventoID']."',"; 
                    if($param['ponenteID'] == 0) $sql = $sql.'null,';
                    else $sql = $sql.$param['ponenteID'].",";
            $sql = $sql."
                    '".$param['actividad']."',
                    '".$param['descripcion']."',
                    '".$param['precio']."',
                    '".$param['ambienteID']."',
                    '".$param['fecha']."',
                    '".$param['horaI']."',
                    '".$param['horaF']."',
                    '".$param['tipoActividadID']."',
                    '".$param['estado']."'
                    )";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            if(!$res) return 0;
            return 1;
        }
        // Actividades de un evento
        function get_actividades($param){
            $sql = "SELECT
                    a.Acti_idActividad,
                    a.Even_idEvento,
                    a.Pon_idPonente,
                    p.Pon_nombre,
                    p.Pon_apellidos,
                    a.Acti_nombre,
                    a.Acti_descripcion,
                    a.Acti_precio,
                    a.Amb_idAmbiente,
                    a.Acti_fecha,
                    a.Acti_horaInicio,
                    a.Acti_horaFin,
                    a.TipoActi_idTipoActividad,
                    a.estado,
                    ta.TipoActi_descripcion
                    FROM actividad a
                    INNER JOIN tipoActividad ta ON ta.TipoActi_idTipoActividad = a.TipoActi_idTipoActividad
                    INNER JOIN ponente p ON p.Pon_idPonente = a.Pon_idPonente
                    WHERE a.Even_idEvento = '$param[eventoID]'
                    order by a.Acti_fecha
                    ";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
            return json_encode($data);
        }
        function get_actividad($param){
             $sql = "SELECT
                    a.Acti_idActividad,
                    a.Even_idEvento,
                    a.Pon_idPonente,
                    a.Acti_nombre,
                    a.Acti_descripcion,
                    a.Acti_precio,
                    a.Amb_idAmbiente,
                    a.Acti_fecha,
                    a.Acti_horaInicio,
                    a.Acti_horaFin,
                    a.TipoActi_idTipoActividad,
                    a.estado,
                    ta.TipoActi_descripcion,
                    l.Loc_idLocal
                    FROM actividad a
                    INNER JOIN tipoActividad ta ON ta.TipoActi_idTipoActividad = a.TipoActi_idTipoActividad
                    INNER JOIN ambiente b ON b.Amb_idAmbiente = a.Amb_idAmbiente
                    INNER JOIN locala l ON l.Loc_idLocal = b.Loc_idLocal
                    WHERE a.Acti_idActividad = '$param[actividadID]'
                    ";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            $data['actividad'] = mysqli_fetch_all($res, MYSQLI_ASSOC);
            return json_encode($data);
        }
        
        function get_eventos(){
            $sql = "SELECT
                    e.Even_idEvento,
                    e.Suc_idSucursal,
                    e.Even_nombre,
                    e.Even_descripcion,
                    e.Even_duracion,
                    e.Even_fechaInicio,
                    e.Even_fechaFin,
                    e.Even_precioTotal                    
                    FROM evento e
                    ";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
            return json_encode($data);
        }
    }
?>