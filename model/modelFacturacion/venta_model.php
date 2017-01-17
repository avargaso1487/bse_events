<?php
include_once '../../model/conexion_model.php';
class Ventas_Model {

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
            case 'listarEvento':
                echo $this->listarEvento();
                break;
            case 'listarParticipante':
                echo $this->listarParticipante();
                break;
            case 'listarProductos':
                echo $this->listarProductos();
                break;
            case 'registrar':
                echo $this->registroFactura();
                break;
            case "listarDetalle":
                echo $this->listarDetalle();
                break;
            case 'seleccionar_evento':
                echo $this->seleccionar_evento();
                break;
            case 'seleccionar_participante':
                echo $this->seleccionar_participante();
                break; 
            case 'cargar_datos':
                echo $this->cargar_datos();
                break; 
            case 'mostrarDetalle':
                echo $this->mostrarDetalle();
                break;
            case 'mostrar_monto':
                echo $this->mostrar_monto();
                break;
            case 'estado':
                echo $this->estado();
                break; 
            case "get":break;
        }
    }

    function registroFactura() {
            $this->prepararConsultaVenta('opc_grabar');
            
            
        }
    function prepararConsultaDetalleFactura($opcion, $producto, $cantidad, $precios, $iva,$descuento, $importe,$almacen) {
            $consultaSql = "call sp_controlDetalleFactura(";
            $consultaSql.="'".$opcion . "',";
            $consultaSql.= "'".$producto."',";
            $consultaSql.= "'".$cantidad."',";
            $consultaSql.= "'".$precios."',";
            $consultaSql.= "'".$iva."',";
            $consultaSql.= "'".$descuento."',";
            $consultaSql.= "'".$importe."',";
            $consultaSql.= "'".$almacen."')";
            //echo $consultaSql;
            $this->result = mysqli_query($this->conexion,$consultaSql);    
        }


    private function getArrayVenta() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "NumeroDocumento" => $fila["NumeroDocumento"],
                "NombreParticipante" => $fila["NombreParticipante"],
                "TipDocPago_descripcion" => $fila["TipDocPago_descripcion"],
                "DocPago_fecha" => $fila["DocPago_fecha"],
                "DocPago_neto" => $fila["DocPago_neto"],
                "DocPago_estado" => $fila["DocPago_estado"],
                "Par_idParticipante" => $fila["Par_idParticipante"],
                "Even_idEvento" => $fila["Even_idEvento"]
                
                ));
        }
        return $datos;
    }

    private function getArrayEvento() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "Even_idEvento" => $fila["Even_idEvento"],
                "Even_nombre" => $fila["Even_nombre"]

                
                ));
        }
        return $datos;
    }

    private function getArrayDetalleFactura() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                
                "ART_codigo" => $fila["ART_codigo"],
                "ART_descripcion" => $fila["ART_descripcion"],
                "DETFAC_cantidadUV" => $fila["DETFAC_cantidadUV"],
                "DETFAC_importe" => $fila["DETFAC_importe"]
                
                ));
        }
        return $datos;
    }
    
    
    function prepararConsultaVenta($opcion = '') {
        $consultaSql = "call sp_control_venta(";
        $consultaSql.="'" . $opcion . "',";
        $consultaSql.="'" .$this->param['param_serie'] . "',";
        $consultaSql.=$this->param['param_numero'] . ",";
        $consultaSql.=$this->param['param_tipo'] . ",";
        $consultaSql.=$this->param['param_estado'] . ",";
        $consultaSql.=$this->param['param_evento'] . ",";
        $consultaSql.=$this->param['param_participante'] . ",";
        $consultaSql.=$this->param['param_monto'] . ",";
        $consultaSql.=$this->param['param_descuento'] . ",";
        $consultaSql.=$this->param['param_neto'] . ")";
        
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }
    
    

    function listar() {

                    $datos =array();
            
                    $this->cerrarAbrir();
                    $this->prepararConsultaVenta('opc_listar');
                    $datos = $this->getArrayVenta();
                    
                    for($i=0; $i<count($datos); $i++)
            {
                     

                
                echo "<tr>  
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["NumeroDocumento"])."</td>                                
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["NombreParticipante"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["TipDocPago_descripcion"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".date("d/m/Y H:i:s", strtotime($datos[$i]["DocPago_fecha"]))."</td>                                      
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["DocPago_neto"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["DocPago_estado"])."</td>                    
                    <td style='visibility: hidden'>".($datos[$i]["Par_idParticipante"])."</td>                    
                    <td style='visibility: hidden'>".($datos[$i]["Even_idEvento"])."</td>                    
                    <td style='text-align: center' class='hidden-sm hidden-xs action-buttons'>
                    <a class='blue' >
                    <i  class='ace-icon fa fa-search bigger-130' onclick='listarDetalleFactura(".$datos[$i]["Par_idParticipante"].",".$datos[$i]["Even_idEvento"].")' href='#'' type='button' data-toggle='modal' data-target='#modalEditarArti' value='Editar'></i>  
                    </a>
                    
                    ";
                        
                echo "</tr>";
            }

            // <td style='text-align: center' class='hidden-sm hidden-xs action-buttons'>
                    // <a class='blue' >
                    // <i  class='ace-icon fa fa-search bigger-130' onclick='listarDetalleFactura(".$datos[$i]["NumeroDocumento"].")' href='#'' type='button' data-toggle='modal' data-target='#modalEditarArti' value='Editar'></i>  
                    // </a>
    }

    function listarEvento() {

                    $datos =array();
            
                    $this->cerrarAbrir();
                    $this->prepararConsultaVenta('opc_listarEvento');
                    $datos = $this->getArrayEvento();
                    
                    for($i=0; $i<count($datos); $i++)
            {
                     

                
                echo '<tr>                                  
                    <td style="text-align: center; font-size: 11px;width: 20%; height: 10px; ">'.($datos[$i]["Even_idEvento"]).'</td>
                    <td style="text-align: center; font-size: 11px;width: 50%; height: 10px; ">'.($datos[$i]["Even_nombre"]).'</td>                    
                    <td style="font-size: 11px; height: 10px; width: 30%; text-align: center;">
                        <div class="hidden-sm hidden-xs action-buttons">
                            <a href="#" class="tooltip-error btn btn-minier btn-primary" data-rel="tooltip" onclick="seleccionarEvento('.($datos[$i]["Even_idEvento"]).');">
                        Seleccionar</a>
                        </div>
                        <div class="hidden-md hidden-lg">
                            <div class="inline pos-rel">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="#" class="tooltip-error btn btn-minier btn-primary" data-rel="tooltip" onclick="seleccionarEvento('.($datos[$i]["Even_idEvento"]).');">Seleccionar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>';
                        
                echo "</tr>";
            }

            
    }

    function listarParticipante() {

                    $datos =array();
            
                    $this->cerrarAbrir();
                    $this->prepararConsultaVenta('opc_listarParticipante');
                    $datos = $this->getArrayParticipante();
                    
                    for($i=0; $i<count($datos); $i++)
            {
                     

                
                echo '<tr>                                  
                    <td style="text-align: center; font-size: 11px;width: 20%; height: 10px; ">'.($datos[$i]["Par_idParticipante"]).'</td>
                    <td style="text-align: center; font-size: 11px;width: 50%; height: 10px; ">'.($datos[$i]["NombreParticipante"]).'</td>                    
                    <td style="text-align: center; font-size: 11px;width: 50%; height: 10px; ">'.($datos[$i]["Per_dni"]).'</td>
                    <td style="font-size: 11px; height: 10px; width: 30%; text-align: center;">
                        <div class="hidden-sm hidden-xs action-buttons">
                            <a href="#" class="tooltip-error btn btn-minier btn-primary" data-rel="tooltip" onclick="seleccionarParticipante('.($datos[$i]["Par_idParticipante"]).');">
                        Seleccionar</a>
                        </div>
                        <div class="hidden-md hidden-lg">
                            <div class="inline pos-rel">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="#" class="tooltip-error btn btn-minier btn-primary" data-rel="tooltip" onclick="seleccionarParticipante('.($datos[$i]["Par_idParticipante"]).');">Seleccionar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>';
                        
                echo "</tr>";
            }

            
    }
    

    private function getArrayParticipante() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "Par_idParticipante" => $fila["Par_idParticipante"],
                "NombreParticipante" => $fila["NombreParticipante"],
                "Per_dni" => $fila["Per_dni"]                
                
                ));
        }
        return $datos;
    }

        function listarProductos() {

                    $datos =array();
            
                    $this->cerrarAbrir();
                    $this->prepararConsultaVenta('opc_listarProductos');
                    $datos = $this->getArrayProducto();
                    
                    for($i=0; $i<count($datos); $i++)
            {
                     

                
                echo "<tr>                                  
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_codigo"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_descripcion"])."</td>
                    
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_Precioventa"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_stockActual"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_stockMinimo"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_IVA"])."</td> 
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ALMA_id"])."</td>                   
                    ";
                        
                echo "</tr>";
            }
            // }else{
            //         echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
            // }
            
    }
    

    private function getArrayProducto() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "ART_codigo" => $fila["ART_codigo"],
                "ART_descripcion" => $fila["ART_descripcion"],
                "ALMA_id" => $fila["ALMA_id"],
                "ART_Precioventa" => $fila["ART_Precioventa"],
                "ART_stockActual" => $fila["ART_stockActual"],
                "ART_stockMinimo" => $fila["ART_stockMinimo"],
                "ART_IVA" => $fila["ART_IVA"]
                
                ));
        }
        return $datos;
    }

    function mostrarDetalle() {

                    $datos =array();
            
                    $this->cerrarAbrir();
                    $this->prepararConsultaVenta('opc_detalle');
                    $datos = $this->getArrayDetalle();
                    
                    for($i=0; $i<count($datos); $i++)
            {
                     

                
                echo "<tr>                                  
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["id"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["descripcion"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["precio"])."</td>                   
                    ";
                        
                echo "</tr>";
            }
            // }else{
            //         echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
            // }
            
    }
    

    private function getArrayDetalle() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "id" => $fila["id"],
                "descripcion" => $fila["descripcion"],
                "precio" => $fila["precio"]
                
                ));
        }
        return $datos;
    }
    function seleccionar_evento() {
            $this->prepararConsultaVenta('opc_evento');            
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
            //echo $row[2];                 
        }
    function seleccionar_participante() {
            $this->prepararConsultaVenta('opc_participante');            
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
            //echo $row[2];                 
        }
    function cargar_datos() {
            $this->prepararConsultaVenta('opc_condicion');            
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
            //echo $row[2];                 
        }
    function mostrar_monto() {
            $this->prepararConsultaVenta('opc_total');            
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
            //echo $row[2];                 
        }

    function estado() {
            $this->prepararConsultaVenta('opc_estado');            
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
            //echo $row[2];                 
        }

     function grabar() {
        $this->prepararConsultaVenta('opc_grabar');
        if($this->result)
        header("Location:../../view/articulo.php");
        //echo '{"success":true,"message":{"reason": "Grabado Correctamente"}}';
    }


    function actualizar() {
        $this->prepararConsultaVenta('opc_actualizar');
        if($this->result)
        header("Location:../../view/articulo.php");
    }
    



    function eliminar() {
        $this->prepararConsultaVenta('opc_eliminar');
        $this->cerrarAbrir();
        echo 1;
    }

    function listarDetalle()
    {
        $datos =array();
        $this->prepararConsultaVenta('opc_buscar');
        $datos = $this->getArrayDetalle();
        for($i=0; $i<count($datos); $i++)
            {
                     

                
                echo "<tr>                                  
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["id"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["descripcion"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["precio"])."</td>                    
                    ";
                        
                echo "</tr>";
            }                  
        
    }

    
}

?>