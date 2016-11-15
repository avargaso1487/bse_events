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
                    estado,
                    ) VALUES(
                    '".$param['eventoID']."',
                    '".$param['ponenteID']."',
                    '".$param['nombre']."',
                    '".$param['descripcion']."',
                    '".$param['precio']."',
                    '".$param['ambienteID']."',
                    '".$param['fecha']."',
                    '".$param['horaI']."',
                    '".$param['horaF']."',
                    '".$param['tipoActividadID']."',
                    '".$param['estado']."',
                    )";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            if(!$res) $exito = false;
            echo 1;

    
        }
        function get_evento($param){
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
                    WHERE e.Even_idEvento = '$param[eventoID]'
                    ";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            $data['evento'] = mysqli_fetch_all($res, MYSQLI_ASSOC);
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