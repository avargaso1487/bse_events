<?php
session_start();
include_once '../../model/conexion_model.php';

class Grupo_Model {

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
            case "comboGrupos":
                echo $this->comboGrupos();
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
    

    function prepararConsultaGrupo($opcion = '') {
        $consultaSql = "call sp_control_grupo(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_grupoId']."',";
        $consultaSql.= "'".$this->param['param_grupo']."',";

        $consultaSql.= "'".$this->param['param_grupoDescripcion']."',";
        $consultaSql.= "'".$this->param['param_grupoOrden']."',";                
        $consultaSql.= "'".$this->param['param_grupoEstado']."')";

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
        $this->prepararConsultaGrupo('opc_grabar');        
        $resultado = $this->getArrayResultado();
        echo $resultado;
    }
    

    function editar() {
        $this->prepararConsultaGrupo('opc_editar');        
    }

    function eliminar() {
        $this->prepararConsultaGrupo('opc_eliminar');        
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayGrupo() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "gruCodigo" => $fila["codigo"],
                "grupo" => $fila["grupo"],
                "gruDescripcion" => $fila["descripcion"],
                "gruOrden" => $fila["orden"],                
                "gruEstado" => $fila["estado"]));
        }
        return $datos;
    }



    function listar(){
        $this->prepararConsultaGrupo('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaGrupo('opc_listar');
            $datos = $this->getArrayGrupo();            
            for($i=0; $i<count($datos); $i++)
            {
                if (utf8_decode($datos[$i]["gruEstado"]) == 'Activo')
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
                    <td style='text-align: center; font-size: 11px; height: 10px; width:20%'>".($datos[$i]["grupo"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:40%'>".($datos[$i]["gruDescripcion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:8%'>".($datos[$i]["gruOrden"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:8%'> <span class='".$label."'> ".utf8_decode($datos[$i]["gruEstado"])."</span></td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:8%'>
                        <div class='hidden-sm hidden-xs action-buttons'>                                                        
                            <a href='#modalGrupos' data-toggle='modal' class='blue' onclick='editarDetalle(".$datos[$i]["gruCodigo"].")'>
                                <i class='ace-icon fa fa-pencil bigger-130'></i>
                            </a>
                            <a href='#' class='".$color."' onclick='eliminar(".$datos[$i]["gruCodigo"].", ".$estado.")'>
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


    private function getArrayGrupoCbo()
    {
        $datos = array();
        while($fila = mysqli_fetch_array($this->result))
        {
            array_push($datos, array(
                "grupoCodigo" => $fila["codigo"],
                "grupoNombre" => $fila["grupo"]));
        }
        return $datos;
    }

    function comboGrupos()
    {
        $this->prepararConsultaGrupo('opc_contar_cbo'); 
        $this->cerrarAbrir();
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            
            $this->prepararConsultaGrupo('opc_listar_cbo');
            $this->cerrarAbrir();
            $datos = $this->getArrayGrupoCbo();
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
    

    function mostrarDetalle()
    {
        $this->prepararConsultaGrupo('opc_contarDetalle');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaGrupo('opc_listarDetalle');
            while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
                    }
        }
    }
}
?>