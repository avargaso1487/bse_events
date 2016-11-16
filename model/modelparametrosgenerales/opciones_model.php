<?php
session_start();
include_once '../../model/conexion_model.php';

class Opcion_Model {

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
            case "comboOpcion":
                echo $this->comboOpciones();
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

    function prepararConsultaOpcion($opcion = '') {
        $consultaSql = "call sp_control_opcion(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_tareaId']."',";
        $consultaSql.= "'".$this->param['param_opcionGrupo']."',";
        $consultaSql.= "'".$this->param['param_tarea']."',";
        $consultaSql.= "'".$this->param['param_tareaDescripcion']."',";
        $consultaSql.= "'".$this->param['param_tareaOrden']."',";
        $consultaSql.= "'".$this->param['param_tareaUrl']."',";                
        $consultaSql.= "'".$this->param['param_tareaEstado']."')";

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
        $this->prepararConsultaOpcion('opc_grabar');        
        $resultado = $this->getArrayResultado();
        echo $resultado;
    }
    

    function editar() {
        $this->prepararConsultaOpcion('opc_editar');        
    }

    function eliminar() {
        $this->prepararConsultaOpcion('opc_eliminar');        
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayOpcion() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "opcCodigo" => $fila["codigo"],
                "grupo" => $fila["grupo"],
                "opcion" => $fila["opcion"],
                "opcDescripcion" => $fila["descripcion"],
                "opcOrden" => $fila["orden"],
                "opcUrl" => $fila["url"],
                "opcEstado" => $fila["estado"]));
        }
        return $datos;
    }

    function listar(){
        $this->prepararConsultaOpcion('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaOpcion('opc_listar');
            $datos = $this->getArrayOpcion();            
            for($i=0; $i<count($datos); $i++)
            {
                if (utf8_decode($datos[$i]["opcEstado"]) == 'Activo')
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
                    <td style='text-align: center; font-size: 11px; height: 10px; width:13%'>".($datos[$i]["grupo"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:14%'>".($datos[$i]["opcion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:23%'>".($datos[$i]["opcDescripcion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:7%'>".($datos[$i]["opcOrden"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:15%'>".($datos[$i]["opcUrl"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:9%'> <span class='".$label."'> ".utf8_decode($datos[$i]["opcEstado"])."</span></td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:15%'>
                        <div class='hidden-sm hidden-xs action-buttons'>                                                        
                            <a href='#modalOpciones' data-toggle='modal' class='blue' onclick='editarDetalle(".$datos[$i]["opcCodigo"].")'>
                                <i class='ace-icon fa fa-pencil bigger-130'></i>
                            </a>
                            <a href='#' class='".$color."' onclick='eliminar(".$datos[$i]["opcCodigo"].", ".$estado.")'>
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
    private function getArrayOpcionCbo()
    {
        $datos = array();
        while($fila = mysqli_fetch_array($this->result))
        {
            array_push($datos, array(
                "opcionCodigo" => $fila["codigo"],
                "opcionNombre" => $fila["opcion"]));
        }
        return $datos;
    }

    function comboGrupos()
    {
        $this->prepararConsultaOpcion('opc_contar_cbo'); 
        $this->cerrarAbrir();
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            
            $this->prepararConsultaOpcion('opc_listar_cbo');
            $this->cerrarAbrir();
            $datos = $this->getArrayOpcionCbo();
            echo    '<div class="input-group col-md-12">                        
                        <select class="form-control" name="param_opcionGrupo" id="param_opcionGrupo">
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
        $this->prepararConsultaOpcion('opc_contarDetalle');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaOpcion('opc_listarDetalle');
            while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
                    }
        }
    }
}
?>