<?php
include_once '../../model/conexion_model.php';
class Marca_Model {

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
    

    function prepararConsultaMarca($opcion = '') {
        $consultaSql = "call sp_control_marca(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".utf8_decode($this->param['param_marcaDescripcion'])."')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    
    function grabar() {
        $this->prepararConsultaMarca('opc_grabar');
        header("Location:../../views/marca_list.php");
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayMarca() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "marCodigo" => $fila["codigo"],
                "marDescripcion" => $fila["descripcion"]));
        }
        return $datos;
    }


    function listar(){
        $this->prepararConsultaMarca('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaMarca('opc_listar');
            $datos = $this->getArrayMarca();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["marCodigo"])."</td>
                    <td>".utf8_decode($datos[$i]["marDescripcion"])."</td>                    
                </tr>";
            }
        }
    }


}

?>