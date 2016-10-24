<?php 

include_once '../../model/conexion_model.php';


class Sucursal_model{

	private $param = array();
	private $conexion = null;
	private $result = null;

	function __construct(){
		$this->conexion = Conexion_Model::getConexion();
	}

	function cerrarAbrir(){
		mysqli_close($this->conexion);
        $this->conexion = Conexion_Model::getConexion();
	}

    private function getArraySucursal() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "sucCodigo" => $fila["codigo"],
                "sucNombre" => $fila["nombre"],
                "sucTelefono" => $fila["telefono"],
                "sucDireccion" => $fila["direccion"]));
        }
        return $datos;
    }

	private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }


	function gestionar($param){
		$this->param = $param;
		switch($this->param['param_opcion'])
		{
			case "listar":
				echo $this->listar();
				break;
		}
	}

	function prepararConsultaSucursal($opcion = ''){
		$consultaSql = "call sp_control_sucursal(";
        $consultaSql.="'" . $opcion ."')";                
        $this->result = mysqli_query($this->conexion,$consultaSql);
	}

	function listar(){
		$this->prepararConsultaSucursal('opc_contar');
		$total = $this->getArrayTotal();
		$datos = array();
		if($total>0)
		{
			$this->cerrarAbrir();
			$this->prepararConsultaSucursal('opc_listar');
			$datos = $this->getArraySucursal();
			for ($i=0; $i<count($datos); $i++){
				echo '
					<div class="widget-main padding-24">
						<div class="row">
							<div class="col-sm-6">
								<div class="row">
									<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
										<b>Información de la Sucursal '.($i+1).'</b>
									</div>
								</div>

								<div>
									<ul class="list-unstyled spaced">
										<li>
											<i class="ace-icon fa fa-caret-right blue"></i>Código:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp00'.	($datos[$i]["sucCodigo"]).'
										</li>
										<li>
											<i class="ace-icon fa fa-caret-right blue"></i>Nombre:&nbsp&nbsp&nbsp&nbsp&nbsp'.($datos[$i]["sucNombre"]).'
										</li>
										<li>
											<i class="ace-icon fa fa-caret-right blue"></i>Dirección:&nbsp&nbsp&nbsp'.($datos[$i]["sucTelefono"]).'
										</li>
										<li>
										<i class="ace-icon fa fa-caret-right blue"></i>Teléfono:&nbsp&nbsp&nbsp&nbsp'.($datos[$i]["sucDireccion"]).'
										</li>
									</ul>
								</div>
							</div><!-- /.col -->
							
						</div><!-- /.row -->
	
						<div class="space"></div>
					
					</div>											
				';
                    }
            }else{
	                echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
            }		
		}
	}


 ?>