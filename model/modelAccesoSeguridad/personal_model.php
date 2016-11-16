<?php
session_start();
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
            case "comboPersonalUsuario":
                echo $this->comboPersonalUsuario();
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
            case "comboSucursal":
                echo $this->comboSucursal();
                break;

        }
    }    

    function prepararConsultaPersonal($opcion = '') {
        $consultaSql = "call sp_control_personal(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_colaboradorId']."',";
        $consultaSql.= "'".$this->param['param_colaboradorCodigo']."',";
        $consultaSql.= "'".$this->param['param_colaboradorEmpresa']."',";
        $consultaSql.= "'".$this->param['param_colaboradorSucursal']."',";
        $consultaSql.= "'".$this->param['param_colaboradorNombre']."',";
        $consultaSql.= "'".$this->param['param_colaboradorApellidos']."',";
        $consultaSql.= "'".$this->param['param_colaboradorDNI']."',";                
        $consultaSql.= "'".$this->param['param_colaboradorDireccion']."',";
        $consultaSql.= "'".$this->param['param_colaboradorNacimiento']."',";
        $consultaSql.= "'".$this->param['param_colaboradorFijo']."',";                
        $consultaSql.= "'".$this->param['param_colaboradorMovil']."',";
        $consultaSql.= "'".$this->param['param_colaboradorMail']."',";        
        $consultaSql.= "'".$this->param['param_colaboradorIngreso']."',";    
        $consultaSql.= "'".$this->param['param_colaboradorEstado']."')";

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
        $this->prepararConsultaPersonal('opc_grabar');        
        $resultado = $this->getArrayResultado();
        echo $resultado;
    }
    

    function editar() {
        $this->prepararConsultaPersonal('opc_editar');        
    }

    function eliminar() {
        $this->prepararConsultaPersonal('opc_eliminar');        
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
                "persCodigo" => $fila["codigo"],                                
                "persNombre" => $fila["colaborador"],
                "persDni" => $fila["dni"],
                "persDireccion" => $fila["direccion"],
                "persTelefono" => $fila["telefono"],
                "persEmail" => $fila["email"],
                "persEstado" => $fila["estado"]));
        }
        return $datos;
    }

    function listar(){
        $this->prepararConsultaPersonal('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaPersonal('opc_listar');
            $datos = $this->getArrayPersonal();            
            for($i=0; $i<count($datos); $i++)
            {
                if (utf8_decode($datos[$i]["persEstado"]) == 'Activo')
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
                    <td style='text-align: center; font-size: 11px; height: 10px; width:8%'>".($datos[$i]["persCodigo"])."</td>                                        
                    <td style='text-align: center; font-size: 11px; height: 10px; width:20%'>".($datos[$i]["persNombre"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:7%'>".($datos[$i]["persDni"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:20%'>".($datos[$i]["persDireccion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:8%'>".($datos[$i]["persTelefono"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:15%'>".($datos[$i]["persEmail"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:9%'> <span class='".$label."'> ".utf8_decode($datos[$i]["persEstado"])."</span></td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:15%'>
                        <div class='hidden-sm hidden-xs action-buttons'>                                                        
                            <a href='#modalColaboradores' data-toggle='modal' class='blue' onclick='editarDetalle(".$datos[$i]["persDni"].")'>
                                <i class='ace-icon fa fa-pencil bigger-130'></i>
                            </a>
                            <a href='#' class='".$color."' onclick='eliminar(".$datos[$i]["persDni"].", ".$estado.")'>
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

    
    private function getArraySucursalCbo()
    {
        $datos = array();
        while($fila = mysqli_fetch_array($this->result))
        {
            array_push($datos, array(
                "sucCodigo" => $fila["codigo"],
                "sucNombre" => $fila["sucursal"]));
        }
        return $datos;
    }

    function comboSucursal()
    {
        $this->prepararConsultaPersonal('opc_contar_sucursal_cbo'); 
        $this->cerrarAbrir();
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $sucursal = $this->param['param_colaboradorSucursal'];
            $this->prepararConsultaPersonal('opc_listar_sucursal_cbo');
            $this->cerrarAbrir();
            $datos = $this->getArraySucursalCbo();
            echo    '<div class="input-group col-md-12">                        
                        <select class="form-control" name="param_colaboradorSucursal" id="param_colaboradorSucursal">
                            <option value=""  disabled selected style="display: none;">Seleccionar Sucursal de la Empresa</option>';
            for($i=0; $i<count($datos); $i++)
            {
                if ($datos[$i]["sucCodigo"] == $sucursal)
                {
                    echo "<option value='".utf8_decode($datos[$i]["sucCodigo"])."' selected='selected'>".($datos[$i]["sucNombre"])."</option>";
                }                     
                else
                    echo "<option value='".utf8_decode($datos[$i]["sucCodigo"])."'>".($datos[$i]["sucNombre"])."</option>";
            }
                 echo '</select>
                    </div>';
        }
        else
        {
            echo '<div class="input-group col-md-12">                        
                        <select class="form-control" name="param_colaboradorSucursal" id="param_colaboradorSucursal">
                            <option value=""  disabled selected style="display: none;">No se encontraron Sucursales</option>
                        </select>
                    </div>';
        }
    }
    
    private function getArrayPersonalUsuarioCbo()
    {
        $datos = array();
        while($fila = mysqli_fetch_array($this->result))
        {
            array_push($datos, array(
                "perId" => $fila["personaId"],
                "persNombre" => $fila["personal"]));
        }
        return $datos;
    }

    function comboPersonalUsuario()
    {
        $this->prepararConsultaPersonal('opc_contar_personal_usuario_cbo'); 
        $this->cerrarAbrir();
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {            
            $this->prepararConsultaPersonal('opc_listar_personal_usuario_cbo');
            $this->cerrarAbrir();
            $datos = $this->getArrayPersonalUsuarioCbo();
            echo    '<div class="input-group col-md-12">                        
                        <select class="form-control" name="param_usuarioColaborador" id="param_usuarioColaborador">
                            <option value=""  disabled selected style="display: none;">Seleccionar Colaborador</option>';
            for($i=0; $i<count($datos); $i++)
            {
                echo "<option value='".utf8_decode($datos[$i]["perId"])."'>".($datos[$i]["persNombre"])."</option>";            
            }
                 echo '</select>
                    </div>';
        }
        else
        {
            echo '  <div class="input-group col-md-12">                        
                        <select class="form-control" name="param_usuarioColaborador" id="param_usuarioColaborador">
                            <option value=""  disabled selected style="display: none;">Todos los Colaboradores cuentan con un Usuario</option>
                        </select>
                    </div>';
        }
    }


    function mostrarDetalle()
    {
        $this->prepararConsultaPersonal('opc_contarDetalle');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaPersonal('opc_listarDetalle');
            while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
                    }
        }
    }
}
?>