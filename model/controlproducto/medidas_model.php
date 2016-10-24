<?php
include_once '../../model/conexion_model.php';
class Medida_Model {

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
    

    function prepararConsultaMedida($opcion = '') {
        $consultaSql = "call sp_control_medida(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_medidaDescripcion']."')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    
    function grabar() {
        $this->prepararConsultaMedida('opc_grabar');
        header("Location:../../views/medidas_list.php");
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayMedida() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "mediCodigo" => $fila["codigo"],
                "mediDescripcion" => $fila["descripcion"]));
        }
        return $datos;
    }


    function listar(){
        $this->prepararConsultaMedida('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaMedida('opc_listar');
            $datos = $this->getArrayMedida();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["mediCodigo"])."</td>
                    <td>".utf8_decode($datos[$i]["mediDescripcion"])."</td>                    
                </tr>";
            }
        }        
    }


}

?>