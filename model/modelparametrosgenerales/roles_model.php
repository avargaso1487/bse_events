<?php
session_start();
include_once '../../model/conexion_model.php';

class Rol_Model {

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
            case "comboRoles":
                echo $this->comboRoles();
                break;
            case "mostrarDetalle":
                echo $this->mostrarDetalle();
                break;
            case "editar":
                echo $this->editar();
                break;
            case "eliminar":
                echo $this->eliminar();
                break;
        }
    }
    

    function prepararConsultaRol($opcion = '') {
        $consultaSql = "call sp_control_rol(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_rolId']."',";
        $consultaSql.= "'".$this->param['param_rol']."',";

        $consultaSql.= "'".$this->param['param_rolDescripcion']."',";        
        $consultaSql.= "'".$this->param['param_rolEstado']."')";

        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    private function getArrayResultado() {
        $resultado = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $resultado = $fila["resultado"];
        }
        return $resultado;
    }

    function grabar() {
        $this->prepararConsultaRol('opc_grabar');        
        $resultado = $this->getArrayResultado();
        echo $resultado;
    }
    

    function editar() {
        $this->prepararConsultaRol('opc_editar');        
    }

    function eliminar() {
        $this->prepararConsultaRol('opc_eliminar');        
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayRol() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "rolCodigo" => $fila["codigo"],
                "rol" => $fila["rol"],
                "rolDescripcion" => $fila["descripcion"],                
                "rolEstado" => $fila["estado"]));
        }
        return $datos;
    }



    function listar(){
        $this->prepararConsultaRol('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaRol('opc_listar');
            $datos = $this->getArrayRol();            
            for($i=0; $i<count($datos); $i++)
            {
                if (utf8_decode($datos[$i]["rolEstado"]) == 'Activo')
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
                    <td style='text-align: center; font-size: 11px; height: 10px; width:5%'>".($i+1)."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:17%'>".($datos[$i]["rol"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:35%'>".($datos[$i]["rolDescripcion"])."</td>                                        
                    <td style='text-align: center; font-size: 11px; height: 10px; width:10%'> <span class='".$label."'> ".utf8_decode($datos[$i]["rolEstado"])."</span></td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:11%'>
                        <div class='hidden-sm hidden-xs action-buttons'>                                                        
                            <a href='#modalRoles' data-toggle='modal' class='blue' onclick='editarDetalle(".$datos[$i]["rolCodigo"].")'>
                                <i class='ace-icon fa fa-pencil bigger-130'></i>
                            </a>
                            <a href='#' class='".$color."' onclick='eliminar(".$datos[$i]["rolCodigo"].", ".$estado.")'>
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


    private function getArrayRolCbo()
    {
        $datos = array();
        while($fila = mysqli_fetch_array($this->result))
        {
            array_push($datos, array(
                "rolCodigo" => $fila["codigo"],
                "rolNombre" => $fila["rol"]));
        }
        return $datos;
    }

    function comboRoles()
    {
        $this->prepararConsultaRol('opc_contar_cbo'); 
        $this->cerrarAbrir();
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            
            $this->prepararConsultaRol('opc_listar_cbo');
            $this->cerrarAbrir();
            $datos = $this->getArrayRolCbo();
            echo    '<div class="input-group col-md-12">                        
                        <select class="form-control" name="param_usuarioRol" id="param_usuarioRol" onchange="mostrarDatosTablaPermisos()">
                            <option value=""  disabled selected style="display: none;">SELECCIONAR EL ROL</option>';
            for($i=0; $i<count($datos); $i++)
            {
                     echo "<option value='".utf8_decode($datos[$i]["rolCodigo"])."'>".($datos[$i]["rolNombre"])."</option>";
            }
                 echo '</select>
                    </div>';
        }
        else
        {
            echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
        }
    }
    

    function mostrarDetalle()
    {
        $this->prepararConsultaRol('opc_contarDetalle');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaRol('opc_listarDetalle');
            while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
                    }
        }
    }
}
?>