<?php
session_start();
include_once '../../model/conexion_model.php';

class Usuario_Model {

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
            case "comboUsuario":
                echo $this->comboUsuarios();
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

    function prepararConsultaUsuario($usuario = '') {
        $consultaSql = "call sp_control_usuarioview(";
        $consultaSql.= "'".$usuario."',";
        $consultaSql.= "'".$this->param['param_usuarioColaborador']."',";        
        $consultaSql.= "'".$this->param['param_usuarioLogin']."',";
        $consultaSql.= "'".$this->param['param_usuarioPassword']."',";        
        $consultaSql.= "'".$_SESSION['usuarioSucursalID']."',";                
        $consultaSql.= "'".$this->param['param_usuarioRol']."',";                        
        $consultaSql.= "'".$this->param['param_usuarioEstado']."')";

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
        $this->prepararConsultaUsuario('opc_grabar');        
        $resultado = $this->getArrayResultado();
        echo $resultado;
    }
    

    function editar() {
        $this->prepararConsultaUsuario('opc_editar');        
    }

    function eliminar() {
        $this->prepararConsultaUsuario('opc_eliminar');        
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayUsuario() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "perId" => $fila["personaId"],
                "persCodigo" => $fila["codigo"],
                "colaborador" => $fila["colaborador"],
                "usuLogin" => $fila["login"],                
                "usuRol" => $fila["rol"],   
                "usuCreacion" => $fila["creacion"],
                "usuCese" => $fila["cese"],
                "usuEstado" => $fila["estado"]));
        }
        return $datos;
    }

    function listar(){
        $this->prepararConsultaUsuario('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaUsuario('opc_listar');
            $datos = $this->getArrayUsuario();            
            for($i=0; $i<count($datos); $i++)
            {
                if (utf8_decode($datos[$i]["usuEstado"]) == 'Activo')
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
                    <td style='text-align: center; font-size: 11px; height: 10px; width:15%'>".($datos[$i]["persCodigo"])."</td>                                        
                    <td style='text-align: center; font-size: 11px; height: 10px; width:25%'>".($datos[$i]["colaborador"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:20%'>".($datos[$i]["usuLogin"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:20%'>".($datos[$i]["usuRol"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:10%'>".($datos[$i]["usuCreacion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:10%'>".($datos[$i]["usuCese"])."</td>                                        
                    <td style='text-align: center; font-size: 11px; height: 10px; width:9%'> <span class='".$label."'> ".utf8_decode($datos[$i]["usuEstado"])."</span></td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:15%'>
                        <div class='hidden-sm hidden-xs action-buttons'>                                                        
                            <a href='#modalUsuarios' data-toggle='modal' class='blue' onclick='editarDetalle(".$datos[$i]["perId"].")'>
                                <i class='ace-icon fa fa-pencil bigger-130'></i>
                            </a>
                            <a href='#' class='".$color."' onclick='eliminar(".$datos[$i]["perId"].", ".$estado.")'>
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

    /*
    private function getArrayUsuarioCbo()
    {
        $datos = array();
        while($fila = mysqli_fetch_array($this->result))
        {
            array_push($datos, array(
                "usuarioCodigo" => $fila["codigo"],
                "usuarioNombre" => $fila["usuario"]));
        }
        return $datos;
    }

    function comboGrupos()
    {
        $this->prepararConsultaUsuario('opc_contar_cbo'); 
        $this->cerrarAbrir();
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            
            $this->prepararConsultaUsuario('opc_listar_cbo');
            $this->cerrarAbrir();
            $datos = $this->getArrayUsuarioCbo();
            echo    '<div class="input-group col-md-12">                        
                        <select class="form-control" name="param_usuarioGrupo" id="param_usuarioGrupo">
                            <option value=""  disabled selected style="display: none;">Seleccionar grupo de la tarea</option>';
            for($i=0; $i<count($datos); $i++)
            {
                     echo "<option value='".utf8_decode($datos[$i]["grupoCodigo"])."'>".($datos[$i]["grupoNombre"])."</option>";
            }
                 echo '</select>
                    </div>';
        }
        else
        {
            echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
        }
    }
    */

    function mostrarDetalle()
    {
        $this->prepararConsultaUsuario('opc_contarDetalle');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaUsuario('opc_listarDetalle');
            while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
                    }
        }
    }
}
?>