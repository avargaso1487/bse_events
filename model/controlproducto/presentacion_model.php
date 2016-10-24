<?php
include_once '../../model/conexion_model.php';
class Presentacion_Model {

    private $param = array();
    private $conexion = null;
    private $result = null;

    function __construct() {
        $this->conexion = Conexion_Model::getConexion();
    }
    function cerrarAbrir()
    {
        mysqli_close($this->conexion);
        $this->conexion = Conexion_Model::getConexion();
    }
    function gestionar($param) {
        $this->param = $param;
        switch ($this->param['param_opcion']) {            
            case "grabar":
                echo $this->grabar();
                break;
            case "mostrar":
                echo $this->listar();
                break;
        }
    }
    

    function prepararConsultaPresentacion($opcion = '') {
        $consultaSql = "call sp_control_Presentacion(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_presentacionDescripcion']."')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    
    function grabar() {
        $this->prepararConsultaPresentacion('opc_grabar');
        header("Location:../../views/presentacion_list.php");
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayPresentacion() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "presCodigo" => $fila["codigo"],
                "presDescripcion" => $fila["descripcion"]));
        }
        return $datos;
    }


    function listar(){
        $this->prepararConsultaPresentacion('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaPresentacion('opc_listar');
            $datos = $this->getArrayPresentacion();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["presCodigo"])."</td>
                    <td>".utf8_decode($datos[$i]["presDescripcion"])."</td>                    
                </tr>";
            }
        }        
    }


}

?>