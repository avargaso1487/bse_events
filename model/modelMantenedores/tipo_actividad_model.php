<?php 
    include_once '../../model/conexion_model.php';
    class Tipo_actividad_model {
        public $param = array();
        function __construct() {
            $this->conexion = Conexion_Model::getConexion();
        }
        function cerrarAbrir(){
            mysqli_close($this->conexion);
            $this->conexion = Conexion_Model::getConexion();
        }
        function get_tipos_actividad(){
            $sql = "SELECT
                    TipoActi_idTipoActividad,
                    TipoActi_descripcion
                    FROM TipoActividad
                    ";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
            return json_encode($data);
        }
    }
?>
