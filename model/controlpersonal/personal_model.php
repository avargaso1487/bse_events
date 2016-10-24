<?php
include_once '../../model/conexion_model.php';
class Personal_Model {

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
            case "comboSucursal":
                echo $this->comboSucursal();
                break;
        }
    }
    

    function prepararConsultaPersonal($opcion = '') {
        $consultaSql = "call sp_control_personal(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_personDNI']."',";
        $consultaSql.= "'".$this->param['param_personNombre']."',";
        $consultaSql.= "'".$this->param['param_personApellidoPaterno']."',";
        $consultaSql.= "'".$this->param['param_personDireccion']."',";
        $consultaSql.= "'".$this->param['param_personFijo']."',";
        $consultaSql.= "'".$this->param['param_personCelular']."',";
        $consultaSql.= "'".$this->param['param_personCorreo']."',";
        $consultaSql.= "'".$this->param['param_personFeNacimiento']."',";
        $consultaSql.= "'".$this->param['param_personFeIngreso']."',";
        $consultaSql.= "'".$this->param['param_personLugarNacimiento']."',";
        $consultaSql.= "'".$this->param['param_personSucursal']."',";
        $consultaSql.= "'".$this->param['param_personUsuario']."',";
        $consultaSql.= "'".$this->param['param_personPassword']."',";
        $consultaSql.= "'".$this->param['param_personApellidoMaterno']."')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    
    function grabar() {
        $this->prepararConsultaPersonal('opc_grabar');
        header("Location:../../views/personal_list.php");
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayPersonal() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "personalCodigo" => $fila["codigo"],
                "personalSucursal" => $fila["sucursal"],
                "personalNombre" => $fila["nombres"],
                "personalCorreo" => $fila["correo"],
                "personalCelular" => $fila["celular"],
                "personalFechaIngreso" => $fila["fechaIngreso"],
                "personalEstado" => $fila["estado"]));
        }
        return $datos;
    }

    private function getArraySucursal()
    {
        $datos = array();
        while($fila = mysqli_fetch_array($this->result))
        {
            array_push($datos, array(
                "codigoSucursal" => $fila["codigo"],
                "descripcionSucursal" => $fila["sucursal"]));
        }
        return $datos;
    }

    function listar(){
        $this->prepararConsultaPersonal('opc_contar');
        $this->cerrarAbrir();
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {            
            $this->prepararConsultaPersonal('opc_listar');
            $this->cerrarAbrir();
            $datos = $this->getArrayPersonal();
            for($i=0; $i<count($datos); $i++)
            {
                if (utf8_decode($datos[$i]["personalEstado"]) == 'Activo')
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
                    $label = "label label-lg label-danger";
                }
                
                echo "<tr>                                  
                    <td style='font-size: 11px; height: 10px; width: 10%; text-align: center;'>".($datos[$i]["personalCodigo"])."</td>
                    <td style='text-align: center; font-size: 12px; height: 10px; width: 10%;'>".($datos[$i]["personalSucursal"])."</td>                    
                    <td style='text-align: center; font-size: 12px; height: 10px; width: 10%;'>".($datos[$i]["personalNombre"])."</td>                    
                    <td style='text-align: center; font-size: 12px; height: 10px; width: 10%;'>".($datos[$i]["personalCorreo"])."</td>                    
                    <td style='text-align: center; font-size: 12px; height: 10px; width: 10%;'>".($datos[$i]["personalCelular"])."</td>                    
                    <td style='text-align: center; font-size: 12px; height: 10px; width: 8%;'>".($datos[$i]["personalFechaIngreso"])."</td>                    
                    <td style='text-align: center; font-size: 12px; height: 10px; width: 8%;'><span class='".$label."'> ".($datos[$i]["personalEstado"])." </span></td>   
                    <td style='text-align: center; font-size: 12px; height: 10px; width: 10%;'>
                        <div class='hidden-sm hidden-xs action-buttons'>
                            <a href='#modal-detalle' data-toggle='modal' class='blue' onclick='mostrar(".$datos[$i]["personalCodigo"].")'>
                                <i class='ace-icon fa fa-search bigger-130'></i>
                            </a>
                            
                            <a href='#modal-detalle' data-toggle='modal' class='blue' onclick='edit(".$datos[$i]["personalCodigo"].")'>
                                <i class='ace-icon fa fa-pencil bigger-130'></i>
                            </a>

                            <a href='#' class='".$color."' onclick='eliminar(".$datos[$i]["personalCodigo"].", ".$estado.")'>
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

    function comboSucursal()
    {
        $this->prepararconsultaPersonal('opc_contar_sucursal'); 
        $this->cerrarAbrir();
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            
            $this->prepararconsultaPersonal('opc_lista_sucursal');
            $this->cerrarAbrir();
            $datos = $this->getArraySucursal();
            echo    '<div class="input-group">
                        <span class="input-group-addon">
                            <i class="ace-icon fa fa-building-o"></i>
                        </span>
                        <select class="col-md-7" name="param_personSucursal" id="param_personSucursal">
                            <option value=""  disabled selected style="display: none;">Seleccionar opción</option>';
            for($i=0; $i<count($datos); $i++)
            {
                     echo "<option value='".utf8_decode($datos[$i]["codigoSucursal"])."'>".($datos[$i]["descripcionSucursal"])."</option>";
            }
                 echo '</select>
                    </div>';
        }
        else
        {
            echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
        }
    }
}

?>