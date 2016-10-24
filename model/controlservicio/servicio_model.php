<?php 
include_once '../../model/conexion_model.php';
header("Content-Type: text/html;charset=utf-8");
class Servicio_Model {

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
    

    function prepararConsultaServicio($opcion = '') {
        $consultaSql = "call sp_control_servicio(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".utf8_decode($this->param['param_personSucursal'])."',";
        $consultaSql.= "'".utf8_decode($this->param['param_servDescripcion'])."',";
        $consultaSql.= "'".utf8_decode($this->param['param_servPrecioBase'])."',";
        $consultaSql.= "'".utf8_decode($this->param['param_servCodigo'])."')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    
    function grabar() {
        $this->prepararConsultaServicio('opc_grabar');
        header("Location:../../views/servicio.php");
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayServicio() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "serCodigo" => $fila["codigo"],
                "serSucursal" => $fila["sucursal"],
                "serDescripcion" => $fila["servicio"],
                "serPrecioBase" => $fila["precioBase"]));
        }
        return $datos;
    }


    function listar(){
        $this->prepararConsultaServicio('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaServicio('opc_listar');
            $datos = $this->getArrayServicio();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["serCodigo"])."</td>
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["serDescripcion"])."</td>
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["serSucursal"])."</td>                    
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["serPrecioBase"])."</td>
                </tr>";
            }
        }
    }


}

 ?>