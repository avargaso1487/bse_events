<?php
include_once '../../model/conexion_model.php';
class Ambiente_Model {

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
            
            case "listar":
                echo $this->listar();
                break;
            case 'comboT':
                echo $this->comboT();
                break;
            case 'comboT_e':
                echo $this->comboT_e();
                break;
            case 'comboL':
                echo $this->comboL();
                break;
            case 'comboL_e':
                echo $this->comboL_e();
                break;
            case "registrar":
                echo $this->grabar();
                break;
            case "eliminar":
                echo $this->eliminar();
                break;
            case "buscar":
                echo $this->buscar();
                break;
            case "buscarAmbiente":
                echo $this->buscarAmbiente();
                break;
            case "actualizar":
                echo $this->actualizar();
                break;
            case "get":break;
        }
    }
    private function getArrayAmbiente() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "Amb_idAmbiente" => $fila["Amb_idAmbiente"],
                "Amb_descripcion" => $fila["Amb_descripcion"],
                "Amb_capacidad" => $fila["Amb_capacidad"],
                "TipAm_descripcion" => $fila["TipAm_descripcion"],
                "Loc_descripcion" => $fila["Loc_descripcion"],
                "TipAm_idTipoAmbiente" => $fila["TipAm_idTipoAmbiente"],
                "Loc_idLocal" => $fila["Loc_idLocal"],
                "Amb_estado" => $fila["Amb_estado"]
                ));
        }
        return $datos;
    }
    
    function comboT() {
            $this->prepararConsultaAmbiente('opc_comboTipo');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="tipoAmb" name="param_ambiente_tipo" >
                                    <option value="0"> Seleccione tipo </option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }

    function comboT_e() {
            $this->prepararConsultaAmbiente('opc_comboTipo');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="tipoAmb_e" name="param_ambiente_tipo" >
                                    <option value="0"> Seleccione tipo</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }

    function comboL() {
            $this->prepararConsultaAmbiente('opc_comboLocal');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="local" name="param_ambiente_local" >
                                    <option value="0"> Seleccione local</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }

    function comboL_e() {
            $this->prepararConsultaAmbiente('opc_comboLocal');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="local_e" name="param_ambiente_local" >
                                    <option value="0"> Seleccione local</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }

    function prepararConsultaAmbiente($opcion = '') {
        $consultaSql = "call sp_control_ambiente(";
        $consultaSql.="'" . $opcion . "',";
        $consultaSql.=$this->param['param_ambiente_id'] . ",";
        $consultaSql.="'" .$this->param['param_ambiente_descripcion'] . "',";
        $consultaSql.=$this->param['param_ambiente_capacidad'] . ",";
        $consultaSql.=$this->param['param_ambiente_tipo'] . ",";
        $consultaSql.=$this->param['param_ambiente_local'] . ")";
        
        
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }
    
    
    function listar() {

                    $datos =array();
            
                    $this->cerrarAbrir();
                    $this->prepararConsultaAmbiente('opc_listar');
                    $datos = $this->getArrayAmbiente();
                    
                    for($i=0; $i<count($datos); $i++)
            {
                     

                echo "<tr>                                  
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["Amb_idAmbiente"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["Amb_descripcion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["Amb_capacidad"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["TipAm_descripcion"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["Loc_descripcion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["Amb_estado"])."</td>                    
                    
                    <td style='text-align: center' class='hidden-sm hidden-xs action-buttons'>
                    <a class='blue' >
                    <i  class='ace-icon fa fa-search bigger-130' onclick='mostrarAmbiente(".$datos[$i]["Amb_idAmbiente"].")' href='#'' type='button' data-toggle='modal' data-target='#modalEditarAmb' value='Editar'></i>  
                    </a>
                    <a class='green' href='#'>
                    <i  class='ace-icon fa fa-pencil bigger-130' onclick='editarAmbiente(".$datos[$i]["Amb_idAmbiente"].")' href='#'' type='button' data-toggle='modal' data-target='#modalEditarAmb' value='Eliminar'></i>
                    </a>";
                    if (utf8_decode($datos[$i]["Amb_estado"]) == 'Activo') {
                                    echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                            <span class="red">
                                                <i class="ace-icon fa fa-trash-o bigger-150" onclick="anularAmbiente('.$datos[$i]["Amb_idAmbiente"].');"></i>
                                            </span>
                                        </a>';
                    } else {
                        echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Active">
                                     <span class="green">
                                      <i class="ace-icon fa fa-check-square-o  bigger-150" onclick="anularAmbiente('.$datos[$i]["Amb_idAmbiente"].');"></i>
                                      </span></a>';

                        
                                }     
                echo "</tr>";
            }
            // }else{
            //         echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
            // }
            
    }

    
     function grabar() {
        
        
        $this->prepararConsultaAmbiente('opc_grabar');
        if($this->result)
        header("Location:../../view/Mantenedores/ambientes.php");
        //echo '{"success":true,"message":{"reason": "Grabado Correctamente"}}';
    }

    function actualizar() {
        $this->prepararConsultaAmbiente('opc_actualizar');
        if($this->result)
        header("Location:../../view/mantenedores/ambientes.php");
    }
    



    function eliminar() {
        $this->prepararConsultaAmbiente('opc_eliminar');
        $this->cerrarAbrir();
        echo 1;
    }

    function eliminarF() {
        $this->prepararConsultaAmbiente('opc_eliminarFisica');
        if($this->result)
        {echo 1;}
    
    }

    function buscar()
    {
        $datos =array();
        $this->prepararConsultaAmbiente('opc_buscar');
        $datos = $this->getArrayAmbiente();
        
            echo json_encode($datos);                   
        
    }

    function buscarAmbiente()
    {
        $datos =array();
        $this->prepararConsultaAmbiente('opc_buscarAmbiente');
        $datos = $this->getArrayAmbiente();
        if(count($datos)>0)
        { 

            echo '$datos[0]["ART_codigo"]';
            //else
                             
        }
    }

    
}

?>