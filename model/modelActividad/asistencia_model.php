<?php 
    include_once '../../model/conexion_model.php';
    class Asistencia_model {
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
                case 'mostrar_participante':
                    echo $this->mostrar_participante();
                    break;               
                case 'registro_asistencia':
                    echo $this->registro_asistencia();
                    break; 
                case 'mostrar_nombre':
                    echo $this->mostrar_nombre();
                    break;    
                case "get":break; 
            }
        }


        function prepararConsultaGestionarAsistencia($opcion) {
            $consultaSql ="call sp_gestion_asistencia(";
            $consultaSql.="'".$opcion . "',";
            $consultaSql.="'".$this->param['param_codigo']."',";
            $consultaSql.="'".$this->param['param_participante']."')";
            //echo $consultaSql;
            $this->result = mysqli_query($this->conexion,$consultaSql);    
        }

       
        
        
        function mostrar_participante() {
            $this->prepararConsultaGestionarAsistencia('opc_mostrar_participantes');
            $this->cerrarAbrir();
            $item = 0;
            while($row = mysqli_fetch_row($this->result)){
                $item++;
                echo '<tr>
                        <td style="text-align:center; font-size: 11px; height: 10px; width: 5%">'.$item.'</td>
                        <td style="text-align:left;font-size: 11px; height: 10px; width: 15%;">'.html_entity_decode($row[1]).'</td>
                        <td style="text-align:center;font-size: 11px; height: 10px; width: 9%;" class="text-center">'.html_entity_decode($row[4]).'</td>
                        <td style="text-align:center;font-size: 11px; height: 10px; width: 9%;" class="text-center">'.html_entity_decode($row[2]).'</td>
                        <td style="text-align:center;font-size: 11px; height: 10px; width: 9%;" class="text-center">'.html_entity_decode($row[3]).'</td>';
                        if ($row[5] == '1') {
                            echo '<td style="font-size: 11px; height: 10px; width: 8%;" class="text-center"><input type="radio" name="form-field-radio" id="param_condicion" class="ace" onclick="registrarAsistencia('.$row[0].')"><span class="lbl"></span></td>';
                        } else {
                            echo '<td style="text-align:center;font-size: 11px; height: 10px; width: 9%;" class="text-center">A</td>';
                        }
                        echo '
                                            
                    </tr>';
            }
        }

        function registro_asistencia() {
            $this->prepararConsultaGestionarAsistencia('opc_registrar_asistencia');
            echo 1;
            //$this->cerrarAbrir();
        }

        function mostrar_nombre() {
            $this->prepararConsultaGestionarAsistencia('opc_mostrar_nombre');
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
            //$this->cerrarAbrir();
        }


       
    }

?>


 