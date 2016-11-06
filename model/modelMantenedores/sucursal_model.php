<?php 
    include_once '../../model/conexion_model.php';
    class Sucursal_model {
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
                case 'new_sucursal':
                    echo $this->new_sucursal();
                    break;
                case 'mostrar_sucursal':
                    echo $this->mostrar_sucursal();
                    break; 
                case 'recuperar_datos':
                    echo $this->recuperar_datos();
                    break;
                case 'update_sucursal':
                    echo $this->update_sucursal();
                    break;                 
                case 'eliminar_sucursal':
                    echo $this->eliminar_sucursal();
                    break;                 
                case 'active_sucursal':
                    echo $this->active_sucursal();
                    break; 
                case 'combo_empresa':
                    echo $this->combo_empresa();
                    break; 
                case "get":break; 
            }
        }


        function prepararConsultaGestionarsucursal($opcion) {
            $consultaSql ="call sp_gestion_sucursal(";
            $consultaSql.="'".$opcion . "',";
            $consultaSql.="'".$this->param['param_nombres'] . "',";
            $consultaSql.="'".$this->param['param_direccion'] . "',";
            $consultaSql.="'".$this->param['param_empresa'] . "',";
            $consultaSql.="'".$this->param['param_codigo'] . "')";
            //echo $consultaSql;
            $this->result = mysqli_query($this->conexion,$consultaSql);    
        }

        function combo_empresa() {
            $this->prepararConsultaGestionarsucursal('opc_combo_empresa');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="param_empresa" name="param_empresa">
                    <option value="" disabled selected style="display: none;">Seleccione Empresa</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }

        function new_sucursal() {
            $this->prepararConsultaGestionarsucursal('opc_new_sucursal');
            $this->cerrarAbrir();
            echo 1;                       
        }

        function update_sucursal() {
            $this->prepararConsultaGestionarsucursal('opc_update_sucursal');
            $this->cerrarAbrir();
            echo 1;                       
        }

        function recuperar_datos() {
            $this->prepararConsultaGestionarsucursal('opc_datos_sucursal');            
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
            //echo $row[2];                 
        }

        function eliminar_sucursal() {
            $this->prepararConsultaGestionarsucursal('opc_eliminar_sucursal');
            $this->cerrarAbrir();
            echo 1;                       
        }

        function active_sucursal() {
            $this->prepararConsultaGestionarsucursal('opc_active_sucursal');
            $this->cerrarAbrir();
            echo 1;                       
        }

        function mostrar_sucursal() {
            $i = 0;
            $this->prepararConsultaGestionarsucursal('opc_mostrar_sucursal');
            $this->cerrarAbrir();
            while($row = mysqli_fetch_row($this->result)){
                $i++;    
                echo '<tr>
                    <td style="text-align: center;font-size: 12px; height: 10px; width: 5%;">'.$i.'</td>
                    <td style="font-size: 12px; height: 10px; width: 10%;">'.($row[1]).'</td>
                    <td style="font-size: 12px; height: 10px; width: 15%;">'.($row[2]).'</td>
                    <td style="font-size: 12px; height: 10px; width: 15%;">'.$row[3].'</td>';
                if ($row[4] == 1) {
                    echo '<td style="font-size: 12px; height: 10px; width: 5%; text-align: center;">                                
                            <img src="../../view/default/assets/img/check.png" style="height: 15px; width: 25%;" alt="">
                        </td>';
                } else {
                    echo '<td style="font-size: 12px; height: 10px; width: 5%; text-align: center;">                                
                                <img src="../../view/default/assets/img/aspa.png" style="height: 13px; width: 20%;" alt="">
                        </td>';
                }
                echo '<td style="font-size: 11px; height: 10px; width: 8%; text-align: center;">
                        <div class="hidden-sm hidden-xs action-buttons">                                              <a href="#" class="tooltip-error" data-rel="tooltip" title="Edit">
                                <span class="green">
                                    <i class="ace-icon fa fa-pencil bigger-150" onclick="editar('.$row[0].');"></i>
                                </span>
                            </a>';
                if ($row[4] == 1) {
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
                                        <a class="tooltip-error" data-rel="tooltip" title="Edit" >
                                            <span class="green">
                                                <i class="ace-icon fa fa-pencil bigger-120" onclick="editar('.$row[0].');"></i>
                                            </span>
                                        </a>';
                if ($row[4] == 1) {
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
        
    }

?>


 