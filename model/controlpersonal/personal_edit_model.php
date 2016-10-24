<?php
include_once '../../model/conexion_model.php';
class Personal_Edit_Model {

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
    

    function prepararConsultaPersonalEdit($opcion = '') {
        $consultaSql = "call sp_control_edit_personal(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_codigoPersonal']."',";
        $consultaSql.= "'".$this->param['param_nuevoEstado']."',";
        $consultaSql.= "'".$this->param['param_personalSucursal']."',";        
        $consultaSql.= "'".$this->param['param_personalDNI']."',";        
        $consultaSql.= "'".$this->param['param_personalNombres']."',";        
        $consultaSql.= "'".$this->param['param_personalApellidoPaterno']."',";        
        $consultaSql.= "'".$this->param['param_personalApellidoMaterno']."',";        
        $consultaSql.= "'".$this->param['param_personalDireccion']."',";        
        $consultaSql.= "'".$this->param['param_personalCorreo']."',";        
        $consultaSql.= "'".$this->param['param_personalTelefonoFijo']."',";        
        $consultaSql.= "'".$this->param['param_personalTelefonoCelular']."',";        
        $consultaSql.= "'".$this->param['param_personalNacimiento']."',";                
        $consultaSql.= "'".$this->param['param_personalLugarNacimiento']."',";                
        $consultaSql.= "'".$this->param['param_personalIngreso']."')";                
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
        $this->prepararConsultaPersonalEdit('opc_eliminar');
        //header("Location:../../views/personal_list.php");//$this->listar();
    }

   

    function listar()
    {
        $this->prepararConsultaPersonalEdit('opc_contar');
        $this->cerrarAbrir();
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            
            $this->prepararConsultaPersonalEdit('opc_listar');
            $this->cerrarAbrir();
            while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
                    }
        }        
    }

    function editar()
    {        
        $this->prepararConsultaPersonalEdit('opc_editar');
        $this->cerrarAbrir();
        //header("Location:../../views/personal_list.php");//$this->listar();
    }    
}

?>
