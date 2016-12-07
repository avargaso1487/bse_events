<?php 
    include_once '../../model/conexion_model.php';
    class Inscripcion_model {
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
                case 'combo_evento':
                    echo $this->combo_evento();
                    break;               
                case 'combo_tipoDocumentoPago':
                    echo $this->combo_tipoDocumentoPago();
                    break;
                case 'combo_paquetes':
                    echo $this->combo_paquetes();
                    break;                 
                case 'combo_actividades':
                    echo $this->combo_actividades();
                    break;   
                case 'seleccionar_actividad':
                    echo $this->seleccionar_actividad();
                    break;  
                case 'seleccionar_participante':
                    echo $this->seleccionar_participante();
                    break; 
                case 'registrar_inscripcion':
                    echo $this->registrar_inscripcion();
                    break; 
                case 'llenar_totas_actividades':
                    echo $this->llenar_totas_actividades();
                    break; 
                case 'obtener_neto':
                    echo $this->obtener_neto();
                    break; 
                case "get":break; 
            }
        }


        function prepararConsultaGestionarCombos($opcion) {
            $consultaSql ="call sp_combos(";
            $consultaSql.="'".$opcion . "',";
            $consultaSql.="'".$this->param['param_codigo']."')";
            //echo $consultaSql;
            $this->result = mysqli_query($this->conexion,$consultaSql);    
        }

        function prepararConsultaGestionarInscripcion($opcion, $codigo) {
            $consultaSql ="call sp_gestionar_inscripcion(";
            $consultaSql.="'".$opcion . "',";
            $consultaSql.="'".$this->param['param_participanteID']."',";
            $consultaSql.="'".$this->param['param_banco']."',";
            $consultaSql.="'".$this->param['param_nroOperacion']."',";
            $consultaSql.="'".$this->param['param_fechaPago']."',";
            $consultaSql.="'".$this->param['ruta']."',";
            $consultaSql.="'".$this->param['param_tipoDocumentoPago']."',";
            $consultaSql.="'".$this->param['param_paquete']."',";               
            $consultaSql.="'".$codigo."',";           
            $consultaSql.="'".$this->param['param_evento']."',";            
            $consultaSql.="'".$this->param['param_condicion']."',";
            $consultaSql.="'".$this->param['param_monto']."',";
            $consultaSql.="'".$this->param['param_descuento']."')";
            //echo $consultaSql;            
            $this->result = mysqli_query($this->conexion,$consultaSql);    
        }
       

        function registrar_inscripcion() {
            $this->prepararConsultaGestionarInscripcion('opc_nueva_inscripcion','');
            $this->cerrarAbrir();
            echo 1;  
            $destino = '../../view/voucher/'.$this->param['param_archivo'];
            $archivo = $this->param['param_fileArchivo'];
            move_uploaded_file($archivo, $destino);
            echo 1;          
            for($i=0; $i<count($this->param['codigoActividad']); $i++) {                        
                $codigo                 = $this->param['codigoActividad'][$i];               
                $this->prepararConsultaGestionarInscripcion('opc_grabar_inscripcion_actividad', $codigo);
            }
        }

        function seleccionar_participante() {
            $this->prepararConsultaGestionarCombos('opc_datos_participante');            
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
            //echo $row[2];                 
        }

        function combo_tipoDocumentoPago() {
            $this->prepararConsultaGestionarCombos('opc_combo_tipoDocumentoPago');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="param_tipoDocumentoPago" name="param_tipoDocumentoPago">
                    <option value="" disabled selected style="display: none;">Seleccione Tipo Documento Pago</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }

        function combo_paquetes() {
            $this->prepararConsultaGestionarCombos('opc_combo_paquetes');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="param_paquete" name="param_paquete" onchange="activarActividades();">
                    <option value="" disabled selected style="display: none;">Seleccione Paquete</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }  

        function combo_actividades() {
            $this->prepararConsultaGestionarCombos('opc_combo_actividades');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="param_actividad" name="param_actividad" onchange="verActividad();">
                    <option value="" disabled selected style="display: none;">Seleccione Actividades</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        } 

        function combo_evento() {
            $this->prepararConsultaGestionarCombos('opc_combo_evento');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="param_evento" name="param_evento" onchange="mostrarActividades();">>
                    <option value="" disabled selected style="display: none;">Seleccione Evento</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }    

        function seleccionar_actividad() {
            $this->prepararConsultaGestionarCombos('opc_datos_actividad');
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
        }    
        
        function llenar_totas_actividades() {
            $this->prepararConsultaGestionarCombos('opc_llenar_todas_actividades');
            $this->cerrarAbrir();
            $item = 0;
            while($row = mysqli_fetch_row($this->result)){
                $item++;
                echo '<tr>
                        <td style="text-align:center; font-size: 11px; height: 10px; width: 5%">'.$row[2].'</td>
                        <td style="text-align:center;font-size: 11px; height: 10px; width: 20%;">'.html_entity_decode($row[0]).'</td>
                        <td style="text-align:center;font-size: 11px; height: 10px; width: 10%;" class="text-center">'.$row[1].'</td>
                        <td style="font-size: 11px; height: 10px; width: 10%;" class="text-center"> - </td>                       
                    </tr>';
            }
        }

        function obtener_neto() {
            $this->prepararConsultaGestionarCombos('opc_obtener_neto');
            $row = mysqli_fetch_row($this->result);
            echo json_encode($row);
        }
    }

?>


 