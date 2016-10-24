<?php
include_once '../../model/conexion_model.php';

class Cliente_Model {

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
    

    function prepararConsultaCliente($opcion = '') {
        $consultaSql = "call sp_control_cliente(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_cliDNI']."',";
        $consultaSql.= "'".$this->param['param_cliNombre']."',";
        $consultaSql.= "'".$this->param['param_cliApellidoPaterno']."',";        
        $consultaSql.= "'".$this->param['param_cliDireccion']."',";
        $consultaSql.= "'".$this->param['param_cliFijo']."',";
        $consultaSql.= "'".$this->param['param_cliCelular']."',";
        $consultaSql.= "'".$this->param['param_cliCorreo']."',";
        $consultaSql.= "'".$this->param['param_cliFeNacimiento']."',";
        $consultaSql.= "'".$this->param['param_cliFeAniversario']."',";
        $consultaSql.= "'".$this->param['param_cliLugarNacimiento']."',";
        $consultaSql.= "'".$this->param['param_cliMotivoAniversario']."',";
        $consultaSql.= "'".$this->param['param_cliApellidoMaterno']."')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    
    function grabar() {
        $this->prepararConsultaCliente('opc_grabar');
        header("Location:../../views/cliente_list.php");
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayCliente() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "cliCodigo" => $fila["codigo"],
                "cliNombre" => $fila["nombres"],
                "cliCorreo" => $fila["correo"],
                "cliCelular" => $fila["celular"],
                "cliTipo" => $fila["tipo"],
                "cliFechaAniversario" => $fila["fechaAniversario"],
                "cliMotivoAniversario" => $fila["motivoAniversario"]));
        }
        return $datos;
    }


    function listar(){
        $this->prepararConsultaCliente('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaCliente('opc_listar');
            $datos = $this->getArrayCliente();
            for($i=0; $i<count($datos); $i++)
            {
                if (utf8_decode($datos[$i]["cliTipo"]) == 'Activo')
                {
                    $class= "ace-icon fa fa-trash-o bigger-130";
                    $color= "red";
                    $estado = 0;
                    $label = "label label-lg label-success";
                }
                else
                {
                    $color="green";
                    $class= "ace-icon fa fa-check-square-o bigger-130";
                    $estado = 1;
                    $label = "label label-lg label-warning";
                }
                
                
                echo "<tr>                                  
                    <td style='text-align:center;' class='col-md-1'>".utf8_decode($datos[$i]["cliCodigo"])."</td>
                    <td style='text-align:center;' class='col-md-1'>".($datos[$i]["cliNombre"])."</td>                    
                    <td style='text-align:center;' class='col-md-1'>".utf8_decode($datos[$i]["cliCorreo"])."</td>                    
                    <td style='text-align:center;' class='col-md-1'>".utf8_decode($datos[$i]["cliCelular"])."</td>
                    <td style='text-align:center;' class='col-md-1'>".utf8_decode($datos[$i]["cliFechaAniversario"])."</td>                    
                    <td style='text-align:center;' class='col-md-1'>".utf8_decode($datos[$i]["cliMotivoAniversario"])."</td>                    
                    <td style='text-align:center;' class='col-md-1'> <span class='".$label."'> ".utf8_decode($datos[$i]["cliTipo"])."</span></td>                    
                    <td style='text-align: center; font-size: 12px; height: 10px; width: 10%;'>
                        <div class='hidden-sm hidden-xs action-buttons'>
                            <a href='#modal-detalle' data-toggle='modal' class='blue' onclick='mostrar(".$datos[$i]["cliCodigo"].")'>
                                <i class='ace-icon fa fa-search bigger-130'></i>
                            </a>
                            
                            <a href='#modal-detalle' data-toggle='modal' class='blue' onclick='edit(".$datos[$i]["cliCodigo"].")'>
                                <i class='ace-icon fa fa-pencil bigger-130'></i>
                            </a>
                            <a href='#' class='".$color."' onclick='eliminar(".$datos[$i]["cliCodigo"].", ".$estado.")'>
                                <i class='".$class."'></i>
                            </a>
                        </div>
                    </td>                 
                </tr>";
            }
        }
        else
            {echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';}
    }


}

?>