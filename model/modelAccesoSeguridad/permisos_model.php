<?php
session_start();
include_once '../../model/conexion_model.php';

class Permiso_Model {

    private $param = array();
    private $conexion = null;
    private $result = null;
    private $result2 = null;

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
            case "asignar":
                echo $this->grabar();
                break;            
            case "mostrarPermisos":
                echo $this->listarPermisos();
                break;
            case "mostrarTareas":
                echo $this->listarTareas();
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

    function prepararConsultaPermiso($opcion = '') {
        $consultaSql = "call sp_control_permiso(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_permisoId']."',";
        $consultaSql.= "'".$this->param['param_usuarioRol']."',";        
        $consultaSql.= "'".$this->param['param_tareaId']."',";                            
        $consultaSql.= "'".$this->param['param_permisoEstado']."')";

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

    function prepararAsignarPermiso($opcion = '', $tareaId) {
        $consultaSql2 = "call sp_control_permiso(";
        $consultaSql2.= "'".$opcion."',";
        $consultaSql2.= "'".$this->param['param_permisoId']."',";
        $consultaSql2.= "'".$this->param['param_usuarioRol']."',";        
        $consultaSql2.= "'".$tareaId."',";                            
        $consultaSql2.= "'".$this->param['param_permisoEstado']."')";

        //echo $consultaSql;
        $this->result2 = mysqli_query($this->conexion,$consultaSql2);
    }

    private function getArrayResultadoAsignacion() {
        $resultado2 = 0;
        while ($fila2 = mysqli_fetch_array($this->result2)) {
            $resultado2 = $fila2["resultado"];
        }
        return $resultado2;
    }

    function grabar() {        
        $resultado2 = 0;
        for($i=0; $i<count($this->param['param_tareaId']); $i++)
        {
            $opcion = 'opc_grabar';
            $tareaId = $this->param['param_tareaId'][$i];            
            $this->prepararAsignarPermiso($opcion, $tareaId);                    
            $resultado2 = $this->getArrayResultadoAsignacion();
            $this->cerrarAbrir();
        }
        echo $resultado2;
        /*$this->prepararConsultaPermiso('opc_grabar');        
        $resultado = $this->getArrayResultado();
        echo $resultado;*/
    }
    

    function editar() {
        $this->prepararConsultaPermiso('opc_editar');        
    }

    function eliminar() {
        $this->prepararConsultaPermiso('opc_eliminar');        
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayPermiso() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(                
                "permId" => $fila["codigoPermiso"],
                "tarea" => $fila["tarea"],
                "tarDescripcion" => $fila["descripcion"],
                "tarGrupo" => $fila["grupo"],                
                "permEstado" => $fila["estado"]));
        }
        return $datos;
    }

    function listarPermisos(){
        $this->prepararConsultaPermiso('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaPermiso('opc_listar');
            $datos = $this->getArrayPermiso();            
            for($i=0; $i<count($datos); $i++)
            {
                if (utf8_decode($datos[$i]["permEstado"]) == 'Activo')
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
                    <td style='text-align: center; font-size: 11px; height: 10px; width:15%'>".($datos[$i]["tarGrupo"])."</td>                                        
                    <td style='text-align: center; font-size: 11px; height: 10px; width:20%'>".($datos[$i]["tarea"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:30%'>".($datos[$i]["tarDescripcion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:9%'> <span class='".$label."'> ".utf8_decode($datos[$i]["permEstado"])."</span></td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:10%'>
                        <div class='hidden-sm hidden-xs action-buttons'>                                                                                    
                            <a href='#' class='".$color."' onclick='eliminar(".$datos[$i]["permId"].", ".$estado.")'>
                                <i class='".$class."'></i>
                            </a>
                        </div>
                    </td>                 
                </tr>";
            }
        }
        
    }

    private function getArrayTarea() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(                
                "tarId" => $fila["codigoTarea"],
                "tarea" => $fila["tarea"],
                "tarDescripcion" => $fila["descripcion"],
                "grupo" => $fila["grupo"]));
        }
        return $datos;
    }

    function listarTareas(){
        if($this->param['param_usuarioRol'] != '')
        {                   
            $this->prepararConsultaPermiso('opc_contar_tareas');
            $total = $this->getArrayTotal();
            $datos = array();
            if($total>0)
            {
                $this->cerrarAbrir();
                $this->prepararConsultaPermiso('opc_listar_tareas');
                $datos = $this->getArrayTarea();            
                for($i=0; $i<count($datos); $i++)
                {                
                    echo "<tr>                                     
                        <td style='text-align: center; font-size: 11px; height: 10px; width: 7%;'>
                            <label class='pos-rel'>
                                <input type='checkbox' onclick='checkselected(this)' name='seleccion[]' value='".($datos[$i]["tarId"])."' />
                                <span class='lbl'></span>
                            </label>
                        </td>                                     
                        <td style='text-align: center; font-size: 11px; height: 10px; width:15%'>".($datos[$i]["grupo"])."</td>                                        
                        <td style='text-align: center; font-size: 11px; height: 10px; width:15%'>".($datos[$i]["tarea"])."</td>                    
                        <td style='text-align: left; font-size: 11px; height: 10px; width:30%'>".($datos[$i]["tarDescripcion"])."</td>                    
                    </tr>";
                }
            }
        }
    }    

    /*
    function mostrarDetalle()
    {
        $this->prepararConsultaPermiso('opc_contarDetalle');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaPermiso('opc_listarDetalle');
            while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
                    }
        }
    }*/
}
?>