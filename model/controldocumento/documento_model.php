<?php
include_once '../../model/conexion_model.php';
class Documento_Model {

    private $param    = array();
    private $conexion = null;
    private $result   = null;
    private $result2  = null;
    private $result3  = null;

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
            /*case "grabar":
                echo $this->grabar();
                break;*/
            case "mostrarClientes":
                echo $this->listarClientes();
                break;
            case "mostrarPersonal":
                echo $this->listarPersonal();
                break;
            case "mostrarProductos":
                echo $this->listarProductos();
                break;
            case "mostrarServicios":
                echo $this->listarServicios();
                break;
            case "guardarDocumento":
                echo $this->guardarDocumentoCabecera();
            case "mostrarDocumento":
                echo $this->mostrarDocumento();
        }
    }

    function prepararConsultaDocumentoDetalleProducto($opcion='',$productoID,$promotorID,$productoCantidad,$productoDescuentoPorc,$productoDescuentoMonto,$productoMontoTotal,$contador)
    {
        $consultaSql2 = "call sp_control_documentoDetalleProducto(";
        $consultaSql2.= "'".$opcion."',";
        $consultaSql2.= "'".$this->param['param_docSerie']."',";
        $consultaSql2.= "'".$this->param['param_docNumero']."',";
        $consultaSql2.= "'".$productoID."',";
        $consultaSql2.= "'".$promotorID."',";
        $consultaSql2.= "'".$productoCantidad."',";
        $consultaSql2.= "'".$productoDescuentoPorc."',";
        $consultaSql2.= "'".$productoDescuentoMonto."',";
        $consultaSql2.= "'".$productoMontoTotal."',";
        $consultaSql2.= "'".$contador."',";
        $consultaSql2.= "'".$this->param['param_sucursal']."')";
        //echo $consultaSql2;
        $this->result2 = mysqli_query($this->conexion,$consultaSql2);
    }

    function prepararConsultaDocumentoDetalleServicio($opcion='',$servicioID, $personalID, $servicioVariacionPorc, $servicioVariacionMonto, $servicioMontoTotal, $contador)
    {
        $consultaSql3 = "call sp_control_documentoDetalleServicio(";
        $consultaSql3.= "'".$opcion."',";
        $consultaSql3.= "'".$this->param['param_docSerie']."',";
        $consultaSql3.= "'".$this->param['param_docNumero']."',";
        $consultaSql3.= "'".$servicioID."',";
        $consultaSql3.= "'".$personalID."',";
        $consultaSql3.= "'".$servicioVariacionPorc."',";
        $consultaSql3.= "'".$servicioVariacionMonto."',";
        $consultaSql3.= "'".$servicioMontoTotal."',";        
        $consultaSql3.= "'".$contador."',";
        $consultaSql3.= "'".$this->param['param_sucursal']."')";
        //echo $consultaSql3;
        $this->result3 = mysqli_query($this->conexion,$consultaSql3);
    }

    function prepararConsultaDocumento($opcion = '') {
        $consultaSql = "call sp_control_documentoVenta(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_sucursal']."',";
        $consultaSql.= "'".$this->param['param_docTipoDocumento']."',";
        $consultaSql.= "'".$this->param['param_docSerie']."',";
        $consultaSql.= "'".$this->param['param_docNumero']."',";
        $consultaSql.= "'".$this->param['param_docFechaHora']."',";
        $consultaSql.= "'".$this->param['param_docDNICliente']."',";
        $consultaSql.= "'".$this->param['param_docCodigoPersonalCaja']."',";
        $consultaSql.= "'".$this->param['param_montoTotal']."',";
        
        $consultaSql.= "'".$this->param['param_checkEfectivo']."',";
        $consultaSql.= "'".$this->param['param_checkTarjeta']."',";
        $consultaSql.= "'".$this->param['param_checkCheque']."',";
        $consultaSql.= "'".$this->param['param_checkCredito']."',";
        $consultaSql.= "'".$this->param['param_checkCanje']."',";
        $consultaSql.= "'".$this->param['param_checkRegalo']."',";

        $consultaSql.= "'".$this->param['param_docdetPagoContadoMonto']."',";

        $consultaSql.= "'".$this->param['param_docdetPagoTarjetaBanco']."',";
        $consultaSql.= "'".$this->param['param_docdetPagoTarjetaOperacion']."',";
        $consultaSql.= "'".$this->param['param_docdetPagoTarjetaMonto']."',";

        $consultaSql.= "'".$this->param['param_docdetPagoChequeBanco']."',";
        $consultaSql.= "'".$this->param['param_docdetPagoChequeNumero']."',";
        $consultaSql.= "'".$this->param['param_docdetPagoChequeMonto']."',";
        $consultaSql.= "'".$this->param['param_docdetPagoChequeFecha']."',";

        $consultaSql.= "'".$this->param['param_docdetPagoCreditoMonto']."',";

        $consultaSql.= "'".$this->param['param_docdetPagoCanjeMonto']."',";

        $consultaSql.= "'".$this->param['param_docdetPagoRegaloMonto']."')";        

        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }
    
    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }

    private function getArrayClientes() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "cliDNI" => $fila["dni"],
                "cliNombre" => $fila["cliente"]));
        }
        return $datos;
    }

    function guardarDocumentoCabecera()
    {
        $this->prepararConsultaDocumento('opc_grabarDocumentoCabecera');
        for($i=0; $i<count($this->param['param_numeroDetalleProducto']); $i++)
        {                        
            $opcion                 = "guardarDetalleProducto";
            $productoID             = $this->param['param_productoID'][$i];
            $promotorID             = $this->param['param_promotorID'][$i];
            $productoCantidad       = $this->param['param_productoCantidad'][$i];
            $productoDescuentoPorc  = $this->param['param_productoDescuentoPorc'][$i];
            $productoDescuentoMonto = $this->param['param_productoDescuentoMonto'][$i];
            $productoMontoTotal     = $this->param['param_productoMontoTotal'][$i];            
            $this->prepararConsultaDocumentoDetalleProducto($opcion, $productoID, $promotorID, $productoCantidad, $productoDescuentoPorc, $productoDescuentoMonto, $productoMontoTotal, $i);
        }
        for($j=0; $j<count($this->param['param_numeroDetalleServicio']); $j++)
        {
            $opcion                 = "guardarDetalleServicio";
            $servicioID             = $this->param['param_servicioID'][$j];
            $personalID             = $this->param['param_personalID'][$j];
            $servicioVariacionPorc  = $this->param['param_servicioVariacionPorc'][$j];
            $servicioVariacionMonto = $this->param['param_servicioVariacionMonto'][$j];
            $servicioMontoTotal     = $this->param['param_servicioMontoTotal'][$j];   

            $this->prepararConsultaDocumentoDetalleServicio($opcion, $servicioID, $personalID, $servicioVariacionPorc, $servicioVariacionMonto, $servicioMontoTotal, $j);
        }
        
    }

    function listarClientes(){
        $this->prepararConsultaDocumento('opc_contarClientes');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaDocumento('opc_listarClientes');
            $datos = $this->getArrayClientes();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["cliDNI"])."</td>
                    <td>".($datos[$i]["cliNombre"])."</td>                    
                </tr>";
            }
        }
    }


    private function getArrayDocumento() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "docSerie" => $fila["serie"],
                "docNumero" => $fila["numero"],
                "doctipo" => $fila["tipo"],
                "docSucursal" => $fila["sucursal"],
                "docFecha" => $fila["fecha"],
                "docCliente" => $fila["cliente"],
                "docMontoTotal" => $fila["montoTotal"],
                "docEstado" => $fila["estado"]));
        }
        return $datos;
    }


    function mostrarDocumento(){
        $this->prepararConsultaDocumento('opc_contarDocumentosCabecera');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaDocumento('opc_listarDocumento');
            $datos = $this->getArrayDocumento();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td class='col-md-2' style='text-align: center;'>".utf8_decode($datos[$i]["docSerie"])." - ".utf8_decode($datos[$i]["docNumero"])."</td>
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["doctipo"])."</td>                    
                    <td style='text-align: center;'>".($datos[$i]["docSucursal"])."</td>                    
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["docFecha"])."</td>                    
                    <td style='text-align: center;'>".($datos[$i]["docCliente"])."</td>                    
                    <td class='col-md-1' style='text-align: center;'>S/.".utf8_decode($datos[$i]["docMontoTotal"])."</td>                    
                    <td style='text-align: center;' class='col-md-1'>".utf8_decode($datos[$i]["docEstado"])."</td>                    
                    <td style='text-align: center;' class='col-md-1'>
                        <div class='hidden-sm hidden-xs action-buttons'>
                            <a class='green' onclick='mostrar(".$datos[$i]["docSerie"].",".$datos[$i]["docNumero"].")'>
                                <i class='ace-icon fa fa-pencil bigger-130'></i>
                            </a>

                            <a class='red' href='#'>
                                <i class='ace-icon fa fa-trash-o bigger-130'></i>
                            </a>
                        </div>
                    </td>
                </tr>";
            }
        }
    }

    private function getArrayPersonal() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "persCodigo" => $fila["codigo"],
                "persNombres" => $fila["personal"]));
        }
        return $datos;
    }


    function listarPersonal(){
        $this->prepararConsultaDocumento('opc_contarPersonal');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaDocumento('opc_listarPersonal');
            $datos = $this->getArrayPersonal();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["persCodigo"])."</td>
                    <td>".($datos[$i]["persNombres"])."</td>                    
                </tr>";
            }
        }
    }


    private function getArrayProductos() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "prodCodigo" => $fila["codigo"],
                "prodNombre" => $fila["producto"],
                "prodStock" => $fila["stock"],
                "prodPrecioUni" => $fila["precio"]));
        }
        return $datos;
    }


    function listarProductos(){
        $this->prepararConsultaDocumento('opc_contarProductos');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaDocumento('opc_listarProductos');
            $datos = $this->getArrayProductos();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["prodCodigo"])."</td>
                    <td>".utf8_decode($datos[$i]["prodNombre"])."</td>                    
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["prodStock"])."</td>                
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["prodPrecioUni"])."</td>
                </tr>";
            }
        }
    }


    private function getArrayServicios() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "servCodigo" => $fila["codigo"],
                "servNombre" => $fila["servicio"],                
                "servPrecioBase" => $fila["precioBase"]));
        }
        return $datos;
    }


    function listarServicios(){
        $this->prepararConsultaDocumento('opc_contarServicios');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaDocumento('opc_listarServicios');
            $datos = $this->getArrayServicios();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["servCodigo"])."</td>
                    <td>".utf8_decode($datos[$i]["servNombre"])."</td>                                        
                    <td style='text-align: center;'>".utf8_decode($datos[$i]["servPrecioBase"])."</td>
                </tr>";
            }
        }
    }

}

?>