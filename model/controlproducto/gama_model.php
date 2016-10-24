<?php
include_once '../../model/conexion_model.php';
class Gama_Model {

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
    

    function prepararConsultaGama($opcion = '') {
        $consultaSql = "call sp_control_gama(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_gamaDescripcion']."')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    
    function grabar() {
        $this->prepararConsultaGama('opc_grabar');
        header("Location:../../views/gama_list.php");
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayGama() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "gamaCodigo" => $fila["codigo"],
                "gamaDescripcion" => $fila["gama"]));
        }
        return $datos;
    }


    function listar(){
        $this->prepararConsultaGama('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaGama('opc_listar');
            $datos = $this->getArrayGama();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["gamaCodigo"])."</td>
                    <td>".utf8_decode($datos[$i]["gamaDescripcion"])."</td>                    
                </tr>";
            }
        }        
    }


}

?>