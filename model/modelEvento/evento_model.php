<?php 
    include_once '../../model/conexion_model.php';
    class Evento_model {
        public $param = array();
        function __construct() {
            $this->conexion = Conexion_Model::getConexion();
        }
        function cerrarAbrir(){
            mysqli_close($this->conexion);
            $this->conexion = Conexion_Model::getConexion();
        }
        
        function registrar_nuevo_evento($param){
            $sql = "INSERT INTO evento (
                    Suc_idSucursal,
                    Even_nombre,
                    Even_descripcion,
                    Even_fechaInicio,
                    Even_fechaFin,
                    Even_duracion,
                    Even_precioTotal,
                    Even_estado
                    ) VALUES(
                    '".$param['sucursalID']."',
                    '".strtoupper($param['nombre'])."',
                    '".$param['descripcion']."',
                    '".$param['fechaI']."',
                    '".$param['fechaF']."',
                    '".$param['duracion']."',
                    '".$param['precioT']."',
                    '".$param['estado']."'
                    )";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            if(!$res) return  0;
            else return mysqli_insert_id($this->conexion);
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