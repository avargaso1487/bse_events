<?php
include_once '../../model/conexion_model.php';
class Cliente_Edit_Model {

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
            case "eliminar":
                echo $this->eliminar();
                break;
            case "mostrarDetalle":
                echo $this->listar();
                break;
            case "editar":
                echo $this->editar();
                break;    
        }
    }
    

    function prepararConsultaClienteEdit($opcion = '') {
        $consultaSql = "call sp_control_edit_cliente(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_codigoCliente']."',";
        $consultaSql.= "'".$this->param['param_nuevoTipo']."',";   

        $consultaSql.= "'".$this->param['param_clienteDNI']."',";        
        $consultaSql.= "'".$this->param['param_clienteNombres']."',";        
        $consultaSql.= "'".$this->param['param_clienteApellidoPaterno']."',";        
        $consultaSql.= "'".$this->param['param_clienteApellidoMaterno']."',";        
        $consultaSql.= "'".$this->param['param_clienteDireccion']."',";        
        $consultaSql.= "'".$this->param['param_clienteTelefonoFijo']."',";        
        $consultaSql.= "'".$this->param['param_clienteTelefonoCelular']."',";        
        $consultaSql.= "'".$this->param['param_clienteCorreo']."',";        
        $consultaSql.= "'".$this->param['param_clienteNacimiento']."',";        
        $consultaSql.= "'".$this->param['param_clienteFechaAniversario']."',";        
        $consultaSql.= "'".$this->param['param_clienteMotivo']."')";                

        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }
    

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }        

    function eliminar()
    {
        $this->prepararConsultaClienteEdit('opc_eliminar');
        //header("Location:../../views/personal_list.php");//$this->listar();
    }

    function editar()
    {
        $this->prepararConsultaClienteEdit('opc_editar');
        //header("Location:../../views/personal_list.php");//$this->listar();
    }

    private function getArrayCliente() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "clienteCodigo" => $fila["codigo"],                
                "clienteDNI" => $fila["dni"],
                "clienteNombre" => $fila["nombres"],
                "clienteDireccion" => $fila["direccion"],
                "clienteTelefonoFijo" => $fila["fijo"],    
                "clienteTelefonoCelular" => $fila["celular"],                            
                "clienteCorreo" => $fila["correo"],
                "clienteFechaNacimiento" => $fila["fechaNacimiento"],
                "clienteTipo" => $fila["tipo"],
                "clienteFechaAniversario" => $fila["fechaAniversario"],
                "clienteMotivo" => $fila["motivo"]));
        }
        return $datos;
    }

    function listar()
    {
        $this->prepararConsultaClienteEdit('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaClienteEdit('opc_listar');
            while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
                    }
        }
    }
}

?>
