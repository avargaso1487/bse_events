<?php 
    include_once '../../model/conexion_model.php';
    class Ponente_model {
        public $param = array();
        function __construct() {
            $this->conexion = Conexion_Model::getConexion();
        }

        function cerrarAbrir(){
            mysqli_close($this->conexion);
            $this->conexion = Conexion_Model::getConexion();
        }

        function gestionar($param) {
            $this->param = $param;
            switch ($this->param['param_opcion']) {               
                case 'new_ponente':
                    echo $this->new_ponente();
                    break;
                case 'mostrar_ponente':
                    echo $this->mostrar_ponente();
                    break; 
                case 'recuperar_datos':
                    echo $this->recuperar_datos();
                    break;
                case 'update_ponente':
                    echo $this->update_ponente();
                    break;                 
                case 'eliminar_ponente':
                    echo $this->eliminar_ponente();
                    break;                 
                case 'active_ponente':
                    echo $this->active_ponente();
                    break; 
                case 'combo_tipoDocumento':
                    echo $this->combo_tipoDocumento();
                    break;                
                case "get":break; 
            }
        }


        function prepararConsultaGestionarponente($opcion) {
            $consultaSql ="call sp_gestion_ponente(";
            $consultaSql.="'".$opcion . "',";
            $consultaSql.="'".$this->param['param_nombres'] . "',";
            $consultaSql.="'".$this->param['param_apellidos'] . "',";
            $consultaSql.="'".$this->param['param_tipoDocumento'] . "',";
            $consultaSql.="'".$this->param['param_nroDocumento'] . "',";
            $consultaSql.="'".$this->param['param_direccion'] . "',";
            $consultaSql.="'".$this->param['param_telefonoFijo'] . "',";
            $consultaSql.="'".$this->param['param_email'] . "',";
            $consultaSql.="'".$this->param['param_celular'] . "',";
            $consultaSql.="'".$this->param['param_carreraProfesional'] . "',";
            $consultaSql.="'".$this->param['param_fechaNacimiento'] . "',";
            $consultaSql.="'".$this->param['param_nacionalidad'] . "',";
            $consultaSql.="'".$this->param['param_estadoLaboral'] . "',";
            $consultaSql.="'".$this->param['param_resumenHojaVida'] . "',";
            $consultaSql.="'".$this->param['param_centroTrabajo'] . "',";    
            $consultaSql.="'".$this->param['ruta']."',";                       
            $consultaSql.="'".$this->param['param_codigo']."')";  
            //echo $consultaSql;         
            $this->result = mysqli_query($this->conexion,$consultaSql);    
        }

        function combo_tipoDocumento() {
            $this->prepararConsultaGestionarponente('opc_combo_tipoDocumento');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="param_tipoDocumento" name="param_tipoDocumento">
                    <option value="" disabled selected style="display: none;">Seleccione Tipo Documento Identidad</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }

        function new_ponente() {  
            $this->prepararConsultaGestionarponente('opc_new_ponente');
            $this->cerrarAbrir();                                
            $destino = '../../view/cv/'.$this->param['param_archivo'];
            $archivo = $this->param['param_fileArchivo'];
            move_uploaded_file($archivo, $destino);
            echo 1; 
            //echo $this->param['ruta'];     
        }

       

        function update_ponente() {
            if ($this->param['param_archivo'] == '') {
                $this->prepararConsultaGestionarponente('opc_update_ponente_nocv');
                $this->cerrarAbrir();
                echo 1;
            } else {
                $this->prepararConsultaGestionarponente('opc_update_ponente_sicv');
                $this->cerrarAbrir();                                
                $destino = '../../view/cv/'.$this->param['param_archivo'];
                $archivo = $this->param['param_fileArchivo'];
                move_uploaded_file($archivo, $destino);
                echo 1; 
            }
                                
        }


        function recuperar_datos() {
            $this->prepararConsultaGestionarponente('opc_datos_ponente');            
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
            //echo $row[2];                 
        }

        function eliminar_ponente() {
            $this->prepararConsultaGestionarponente('opc_eliminar_ponente');
            $this->cerrarAbrir();
            echo 1;                       
        }

        function active_ponente() {
            $this->prepararConsultaGestionarponente('opc_active_ponente');
            $this->cerrarAbrir();
            echo 1;                       
        }

        function mostrar_ponente() {
            $i = 0;
            $this->prepararConsultaGestionarponente('opc_mostrar_ponente');
            $this->cerrarAbrir();
            while($row = mysqli_fetch_row($this->result)){
                $i++;    
                echo '<tr>
                    <td style="text-align: center;font-size: 12px; height: 10px; width: 5%;">'.$i.'</td>
                    <td style="font-size: 12px; height: 10px; width: 15%;">'.($row[2]).' '.($row[1]).'</td>
                    <td style="font-size: 12px; height: 10px; width: 9%;">'.($row[3]).'</td>
                    <td style="font-size: 12px; height: 10px; width: 9%;">'.($row[4]).'</td>
                    <td style="font-size: 12px; height: 10px; width: 10%;">'.$row[5].'</td>
                    <td style="font-size: 12px; height: 10px; width: 9%;">'.$row[6].'</td>
                    <td style="font-size: 12px; height: 10px; width: 10%;">'.$row[7].'</td>';
                    if ($row[12] == '') {
                    echo '<td style="font-size: 12px; height: 10px; width: 5%; text-align: center;">                                
                            <a href="#" class="tooltip-error" data-rel="tooltip" title="View">
                                <span class="blue">
                                    
                                </span>
                            </a>
                        </td>';
                    } else {
                        echo '<td style="font-size: 12px; height: 10px; width: 5%; text-align: center;">                                
                                
                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Descargar Cv">
                                    <span class="red">
                                        <i class="ace-icon fa fa-cloud-download bigger-150" onClick="descargar('."'".$row[12]."'".')"></i>
                                    </span>
                                </a>
                            </td>';
                    }
                    if ($row[11] == 1) {
                        echo '<td style="font-size: 12px; height: 10px; width: 5%; text-align: center;">                                
                                <img src="../../view/default/assets/img/check.png" style="height: 15px; width: 25%;" alt="">
                            </td>';
                    } else {
                        echo '<td style="font-size: 12px; height: 10px; width: 5%; text-align: center;">                                
                                    <img src="../../view/default/assets/img/aspa.png" style="height: 13px; width: 20%;" alt="">
                            </td>';
                    }
                echo '<td style="font-size: 11px; height: 10px; width: 8%; text-align: center;">
                        <div class="hidden-sm hidden-xs action-buttons">                                              
                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Información">
                                <span class="blue">
                                    <i class="ace-icon fa fa-info-circle bigger-150" onclick="detalles('.$row[0].');"></i>
                                </span>
                            </a>
                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Edit">
                                <span class="green">
                                    <i class="ace-icon fa fa-pencil bigger-150" onclick="editar('.$row[0].');"></i>
                                </span>
                            </a>';
                if ($row[11] == 1) {
                    echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red">
                                        <i class="ace-icon fa fa-trash-o bigger-150" onclick="eliminar('.$row[0].');"></i>
                                    </span>
                                </a>';
                } else {
                    echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Active">
                                <span class="green">
                                    <i class="ace-icon fa fa-pencil-square-o  bigger-150" onclick="activar('.$row[0].');"></i>
                                </span>
                            </a>';
                }

                echo '</div>
                        <div class="hidden-md hidden-lg">
                            <div class="inline pos-rel">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                    <li>    
                                        <a class="tooltip-error" data-rel="tooltip" title="Edit">
                                            <span class="blue">
                                                <i class="ace-icon fa fa-info-circle bigger-150" onclick="detalles('.$row[0].');"></i>
                                            </span>
                                        </a>                               
                                        <a class="tooltip-error" data-rel="tooltip" title="Edit" >
                                            <span class="green">
                                                <i class="ace-icon fa fa-pencil bigger-120" onclick="editar('.$row[0].');"></i>
                                            </span>
                                        </a>';
                if ($row[11] == 1) {
                    echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                            <span class="red">
                                                <i class="ace-icon fa fa-trash-o bigger-150" onclick="eliminar('.$row[7].');"></i>
                                            </span>
                                        </a>';
                } else {
                    echo '<a href="#" class="green" data-rel="tooltip" title="Active">
                                            <span class="green">
                                                <i class="ace-icon fa fa-pencil-square-o  bigger-150" onclick="activar('.$row[0].');"></i>
                                            </span>
                                        </a>';
                }
                echo '</li>
                            </ul>
                        </div>
                    </div>
                </td>';
            }                   
        }
        function get_ponentes(){
            $sql = "SELECT
                    Pon_idPonente,
                    Pon_nombre,
                    Pon_apellidos
                    FROM ponente
                    ";
            $res = mysqli_query($this->conexion,$sql) or die (mysqli_error($this->conexion));
            $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
            return json_encode($data);
        }
    }

?>


 