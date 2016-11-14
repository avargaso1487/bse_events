<?php
include_once '../../model/conexion_model.php';
class ParticipanteModel {
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
        switch ($this->param['opcion']) {
            case 'mostrar_participante':
                echo $this->mostrarParticipante();
                break;
            case 'registrar_participante':
                echo $this->registrarParticipante();
                break;
            case 'datos_participante':
                echo $this->datosParticipante();
                break;
            case 'editar_participante':
                echo $this->editarParticipante();
                break;
            case 'eliminar_participante':
                echo $this->eliminarParticipante();
                break;
            case 'activar_participante':
                echo $this->activarParticipante();
                break;
            case "get":break;
        }
    }


    function gestionarParticipante($opcion) {
        $consultaSql = "call sp_gestion_participante(";
        $consultaSql.="'".$opcion . "',";
        $consultaSql.="'".$this->param['nombre'] . "',";
        $consultaSql.="'".$this->param['apellido'] . "',";
        $consultaSql.="'".$this->param['dni'] . "',";
        $consultaSql.="'".$this->param['direccion'] . "',";
        $consultaSql.="'".$this->param['fechaNacimiento'] . "',";
        $consultaSql.="'".$this->param['telefonoFijo'] . "',";
        $consultaSql.="'".$this->param['telefonoMovil'] . "',";
        $consultaSql.="'".$this->param['email'] . "',";
        $consultaSql.="'".$this->param['nivel'] . "',";
        $consultaSql.="'".$this->param['profesion'] . "',";
        $consultaSql.="'".$this->param['centroTrabajo'] . "',";
        $consultaSql.="'".$this->param['codigoParticipante'] ."')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function mostrarParticipante() {
        $this->gestionarParticipante('opc_mostrar_participante');
        $this->cerrarAbrir();
        $item = 0;
        while($row = mysqli_fetch_row($this->result)){
            $item++;
            echo '<tr>
                    <td style="text-align:center; font-size: 11px; height: 10px; width: 5%; font-weight: bolder;">'.$item.'</td>
                    <td style="font-size: 11px; height: 10px; width: 20%;">'.html_entity_decode($row[1]).'</td>
                    <td style="font-size: 11px; height: 10px; width: 10%;" class="text-center">'.$row[2].'</td>
                    <td style="font-size: 11px; height: 10px; width: 10%;" class="text-center">'.html_entity_decode($row[3]).'</td>
                    <td style="font-size: 11px; height: 10px; width: 12%;" class="text-center">'.html_entity_decode($row[4]).'</td>
                    <td style="font-size: 11px; height: 10px; width: 17%;" class="text-center">'.html_entity_decode($row[5]).'</td>';
            if ($row[6] == 1) {
                echo '<td style="font-size: 11px; height: 10px; width: 10%; text-align: center;">
                          <div id="estado" class="text-center">
                              <span class="label label-success">ACTIVO</span>
                          </div>
                      </td>';
            } else {
                echo '<td style="font-size: 11px; height: 10px; width: 10%; text-align: center;">
                          <div id="estado" class="text-center">
                              <span class="label label-danger">INACTIVO</span>
                          </div>
                      </td>';
            }
            echo ' <td style="font-size: 11px; height: 10px; width: 8%; text-align: center;">                        
                      <div class="hidden-sm hidden-xs action-buttons"> 
                          <a href="#" class="tooltip-error" data-rel="tooltip" title="Ver Información">
                              <span class="blue">
                                  <i class="ace-icon fa fa-info-circle bigger-150" onclick="mostrarInformacion('.$row[0].');"></i>
                              </span>
                          </a>
                          <a href="#" class="tooltip-error" data-rel="tooltip" title="Editar">
                              <span class="green">
                                  <i class="ace-icon fa fa-pencil bigger-150" onclick="editar('.$row[0].');"></i>
                              </span>
                          </a>';
                          if ($row[6] == 1) {
                              echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Eliminar">
                                      <span class="red">
                                          <i class="ace-icon fa fa-trash-o bigger-150" onclick="eliminar('.$row[0].');"></i>
                                      </span>
                                  </a>';
                          } else {
                              echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Activar">
                                      <span class="red">
                                          <i class="ace-icon fa fa-pencil-square-o bigger-150" onclick="activar('.$row[0].');"></i>
                                      </span>
                                  </a>';
                          }
                echo'</div>                                                 
                   </td>';
        }
    }

    function registrarParticipante() {
        $this->gestionarParticipante('opc_registrar_participante');
        $this->cerrarAbrir();
        echo 1;
    }

    function datosParticipante() {
        $this->gestionarParticipante('opc_datos_participante');
        $row = mysqli_fetch_row($this->result);
        $output[]=array_map('html_entity_decode', $row);
        echo json_encode($output);
    }


    function editarParticipante() {
        $this->gestionarParticipante('opc_editar_participante');
        $this->cerrarAbrir();
        echo 1;
    }

    function eliminarParticipante() {
        $this->gestionarParticipante('opc_eliminar_participante');
        $this->cerrarAbrir();
        echo 1;
    }

    function activarParticipante() {
        $this->gestionarParticipante('opc_activar_participante');
        $this->cerrarAbrir();
        echo 1;
    }

}




