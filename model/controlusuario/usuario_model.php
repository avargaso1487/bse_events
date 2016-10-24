<?php 
	
include_once '../../model/conexion_model.php';


class Usuario_model
{

	private $param = array();
	private $conexion = null;	

	function __construct()
	{
		$this->conexion = Conexion_model::getConexion();
	}

	function cerrarAbrir()
	{
		mysqli_close($this->conexion);
		$this->conexion = Conexion_model::getConexion();
	}

	function gestionar($param)
	{
		$this->param = $param;
		switch ($this->param['opcion'])
		{
			case 'login':
				echo $this->login();
				break;
		}
	}

	function prepararConsultaUsuario($opcion='')
	{
		$consultaSql = "call sp_control_usuario(";
		$consultaSql.="'".$opcion."',";
		$consultaSql.="'".$this->param['usuario']."',";
		$consultaSql.="'".$this->param['password']."')";
		//echo $consultaSql;
		$this->result = mysqli_query($this->conexion,$consultaSql);
	}

	function ejecutarConsultaRespuesta() {
        $respuesta = '';
        while ($fila = mysqli_fetch_array($this->result)) {
            $respuesta = $fila['respuesta'];
        }
        return $respuesta;
    }

	function login()
	{
		$this->prepararConsultaUsuario('opc_login_respuesta');
		$respuesta = $this->ejecutarConsultaRespuesta();
		
		if($respuesta == '1')
		{
			$this->cerrarAbrir();
			$this->prepararConsultaUsuario('opc_login_listar');
			while($fila = mysqli_fetch_array($this->result))
			{
				$_SESSION['idPersona'] = $fila['PERSO_id'];
				$_SESSION['usuario'] = $fila['USU_login'];
				$_SESSION['usuarioDNI'] = $fila['PERSO_dni'];
				$_SESSION['usuarioSucursalID'] = $fila['SUC_codigo'];
				$_SESSION['usuarioSucursal'] = $fila['SUC_descripcion'];
			}
			header("Location:../../views/bienvenido.php");
		} 
		else
		{			
			header("Location:../../index.php");
		}

	}

}

 ?>





