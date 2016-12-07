<?php
include_once '../../model/conexion_model.php';
class Local_Model {

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
                "Loc_idLocal" => $fila["Loc_idLocal"],
                "Loc_descripcion" => $fila["Loc_descripcion"],
                "Loc_direccion" => $fila["Loc_direccion"],
                "Loc_estado" => $fila["Loc_estado"],
                ));
        }
        return $datos;
    }
    
    

    function prepararConsultaAmbiente($opcion = '') {
        $consultaSql = "call sp_control_local(";
        $consultaSql.="'" . $opcion . "',";
        $consultaSql.=$this->param['param_local_id'] . ",";
        $consultaSql.="'" .$this->param['param_local_descripcion'] . "',";
        $consultaSql.="'" .$this->param['param_local_direccion'] . "')";
        
        
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
                    <td style='text-align: center; font-size: 11px; height: 20px; '>".($datos[$i]["Loc_idLocal"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["Loc_descripcion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["Loc_direccion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["Loc_estado"])."</td>                                       
                    
                    <td style='text-align: center' class='hidden-sm hidden-xs action-buttons'>
                    
                    <a class='green' href='#'>
                    <i  class='ace-icon fa fa-pencil bigger-130' onclick='editarAmbiente(".$datos[$i]["Loc_idLocal"].")' href='#'' type='button' data-toggle='modal' data-target='#modalEditarAmb' value='Eliminar'></i>
                    </a>";
                    if (utf8_decode($datos[$i]["Loc_estado"]) == 'Activo') {
                                    echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                            <span class="red">
                                                <i class="ace-icon fa fa-trash-o bigger-150" onclick="anularAmbiente('.$datos[$i]["Loc_idLocal"].');"></i>
                                            </span>
                                        </a>';
                    } else {
                        echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Active">
                                     <span class="green">
                                      <i class="ace-icon fa fa-check-square-o  bigger-150" onclick="anularAmbiente('.$datos[$i]["Loc_idLocal"].');"></i>
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
        header("Location:../../view/Mantenedores/local_view.php");
        //echo '{"success":true,"message":{"reason": "Grabado Correctamente"}}';
    }

    function actualizar() {
        $this->prepararConsultaAmbiente('opc_actualizar');
        if($this->result)
        header("Location:../../view/mantenedores/local_view.php");
    }
    



    function eliminar() {
        $this->prepararConsultaAmbiente('opc_eliminar');
        $this->cerrarAbrir();
        echo 1;
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
    function get_ambientes(){
            $sql = "SELECT
                    Amb_idAmbiente,
                    Amb_descripcion                    
                    FROM ambiente
                    ";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
            return json_encode($data);
        }

    
}

?>