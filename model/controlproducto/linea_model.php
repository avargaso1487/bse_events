<?php
include_once '../../model/conexion_model.php';
class Linea_Model {

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
    

    function prepararConsultaLinea($opcion = '') {
        $consultaSql = "call sp_control_linea(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_lineaDescripcion']."')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    
    function grabar() {
        $this->prepararConsultaLinea('opc_grabar');
        header("Location:../../views/linea_list.php");
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayLinea() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "linCodigo" => $fila["codigo"],
                "linDescripcion" => $fila["descripcion"]));
        }
        return $datos;
    }


    function listar(){
        $this->prepararConsultaLinea('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaLinea('opc_listar');
            $datos = $this->getArrayLinea();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["linCodigo"])."</td>
                    <td>".utf8_decode($datos[$i]["linDescripcion"])."</td>                    
                </tr>";
            }
        }        
    }


}

?>