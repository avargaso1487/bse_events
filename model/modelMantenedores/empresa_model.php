<?php 
    include_once '../../model/conexion_model.php';
    class Empresa_model {
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
                case 'new_empresa':
                    echo $this->new_empresa();
                    break;
                case 'mostrar_empresas':
                    echo $this->mostrar_empresas();
                    break; 
                case 'recuperar_datos':
                    echo $this->recuperar_datos();
                    break;
                case 'update_empresa':
                    echo $this->update_empresa();
                    break;                 
                case 'eliminar_empresa':
                    echo $this->eliminar_empresa();
                    break;                 
                case 'active_empresa':
                    echo $this->active_empresa();
                    break; 
                case "get":break; 
            }
        }


        function prepararConsultaGestionarEmpresa($opcion) {
            $consultaSql ="call sp_gestion_empresa(";
            $consultaSql.="'".$opcion . "',";
            $consultaSql.="'".$this->param['param_razonSocial'] . "',";
            $consultaSql.="'".$this->param['param_direccion'] . "',";
            $consultaSql.="'".$this->param['param_ruc'] . "',";
            $consultaSql.="'".$this->param['param_codigo'] . "')";
            //echo $consultaSql;
            $this->result = mysqli_query($this->conexion,$consultaSql);    
        }

        function new_empresa() {
            $this->prepararConsultaGestionarEmpresa('opc_new_empresa');
            $this->cerrarAbrir();
            echo 1;                       
        }

        function update_empresa() {
            $this->prepararConsultaGestionarEmpresa('opc_update_empresa');
            $this->cerrarAbrir();
            echo 1;                       
        }

        function recuperar_datos() {
            $this->prepararConsultaGestionarEmpresa('opc_datos_empresa');            
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
            //echo $row[2];                 
        }

        function eliminar_empresa() {
            $this->prepararConsultaGestionarEmpresa('opc_eliminar_empresa');
            $this->cerrarAbrir();
            echo 1;                       
        }

        function active_empresa() {
            $this->prepararConsultaGestionarEmpresa('opc_active_empresa');
            $this->cerrarAbrir();
            echo 1;                       
        }

        function mostrar_empresas() {
            $i = 0;
            $this->prepararConsultaGestionarEmpresa('opc_mostrar_empresas');
            $this->cerrarAbrir();
            while($row = mysqli_fetch_row($this->result)){
                $i++;    
                echo '<tr>
                    <td style="text-align: center;font-size: 12px; height: 10px; width: 5%;">'.$i.'</td>
                    <td style="font-size: 12px; height: 10px; width: 15%;">'.($row[1]).'</td>
                    <td style="font-size: 12px; height: 10px; width: 15%;">'.($row[2]).'</td>
                    <td style="font-size: 12px; height: 10px; width: 8%;">'.$row[3].'</td>';
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


 