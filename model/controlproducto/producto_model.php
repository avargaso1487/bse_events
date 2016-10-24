<?php
include_once '../../model/conexion_model.php';
class Producto_Model {

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
            case "grabar":
                echo $this->grabar();
                break;
            case "mostrar":
                echo $this->listar();
                break;
            case "comboSucursal":
                echo $this->comboSucursal();
                break;
            case "comboLinea":
                echo $this->comboLinea();
                break;
            case "comboMarca":
                echo $this->comboMarca();
                break;
            case "comboMedida":
                echo $this->comboMedida();
                break;
            case "comboPresentacion":
                echo $this->comboPresentacion();
                break;
            case "comboGama":
                echo $this->comboGama();
                break;
        }
    }
    

    function prepararConsultaProducto($opcion = '') {
        $consultaSql = "call sp_control_producto(";
        $consultaSql.= "'".$opcion."',";
        $consultaSql.= "'".$this->param['param_prodCodigoBarras']."',";
        $consultaSql.= "'".$this->param['param_prodNombre']."',";
        $consultaSql.= "'".$this->param['param_prodLinea']."',";
        $consultaSql.= "'".$this->param['param_prodMarca']."',";
        $consultaSql.= "'".$this->param['param_prodEmpaque']."',";
        $consultaSql.= "'".$this->param['param_prodPresentacion']."',";
        $consultaSql.= "'".$this->param['param_prodCodigoInterno']."',";
        $consultaSql.= "'".$this->param['param_prodSucursal']."',";
        $consultaSql.= "'".$this->param['param_prodTipo']."',";
        $consultaSql.= "'".$this->param['param_prodPrecioCosto']."',";
        $consultaSql.= "'".$this->param['param_prodPrecioVenta']."',";
        $consultaSql.= "'".$this->param['param_prodStockRequerido']."',";
        $consultaSql.= "'".$this->param['param_prodStockMin']."',";
        $consultaSql.= "'".$this->param['param_prodStockActual']."',";
        $consultaSql.= "'".$this->param['param_prodGama']."')";

        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    
    function grabar() {
        $this->prepararConsultaProducto('opc_grabar');        
       // header("Location:../../views/producto_list.php");
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayProducto() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "prodCodigoBarras" => $fila["codigoBarras"],
                "prodSucursal" => $fila["sucursal"],
                "prodCodigoInterno" => $fila["codigoInterno"],
                "prodDescripcion" => $fila["producto"],
                "prodStockActual" => $fila["stockActual"],
                "prodStockMinimo" => $fila["stockMinimo"],
                "prodPrecioCosto" => $fila["precioCosto"],
                "prodPrecioVenta" => $fila["precioVenta"],
                "prodEstado" => $fila["estado"]));
        }
        return $datos;
    }


    function listar(){
        $this->prepararConsultaProducto('opc_contar');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaProducto('opc_listar');
            $datos = $this->getArrayProducto();
            for($i=0; $i<count($datos); $i++)
            {
                echo "<tr>                                  
                    <td>".utf8_decode($datos[$i]["prodCodigoBarras"])."</td>
                    <td>".utf8_decode($datos[$i]["prodCodigoInterno"])."</td>                    
                    <td>".utf8_decode($datos[$i]["prodDescripcion"])."</td>                    
                    <td>".utf8_decode($datos[$i]["prodSucursal"])."</td>                    
                    <td>".utf8_decode($datos[$i]["prodStockActual"])."</td>     
                    <td>".utf8_decode($datos[$i]["prodStockMinimo"])."</td>
                    <td>".utf8_decode($datos[$i]["prodPrecioCosto"])."</td>                    
                    <td>".utf8_decode($datos[$i]["prodPrecioVenta"])."</td>                    
                    <td>".utf8_decode($datos[$i]["prodEstado"])."</td>                    
                </tr>";
            }
        }
    }

    private function getArraySucursal()
    {
        $datos = array();
        while($fila = mysqli_fetch_array($this->result))
        {
            array_push($datos, array(
                "codigoSucursal" => $fila["codigo"],
                "descripcionSucursal" => $fila["sucursal"]));
        }
        return $datos;
    }

    function comboSucursal()
    {
        $this->prepararconsultaProducto('opc_contar_sucursal');
        $total = $this->getArrayTotal();
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararconsultaProducto('opc_lista_sucursal');
            $datos = $this->getArraySucursal();
            echo    '
                        <select class="form-control" name="param_prodSucursal" id="param_prodSucursal">
                            <option value=""  disabled selected style="display: none;">Seleccionar opción</option>';
            for($i=0; $i<count($datos); $i++)
            {
                echo "<option value='".utf8_decode($datos[$i]["codigoSucursal"])."'>".utf8_decode($datos[$i]["descripcionSucursal"])."</option>";
            }
            echo '</select>
                    ';
        }
        else
        {
            echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
        }
    }

    private function getArrayLinea() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "linCodigo" => $fila["codigo"],
                "linDescripcion" => $fila["linea"]));
        }
        return $datos;
    }
    
    function comboLinea()
    {
        $this->prepararConsultaProducto('opc_contar_linea');
        $total = $this->getArrayTotal();
        $datos = array();        
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaProducto('opc_lista_linea');
            $datos = $this->getArrayLinea();
            echo    '<select class="form-control" name="param_prodLinea" id="param_prodLinea">
                            <option value=""  disabled selected style="display: none;">Seleccione línea del producto</option>';
            for($i=0; $i<count($datos); $i++)
            {
                echo "<option value='".utf8_decode($datos[$i]["linCodigo"])."'>".utf8_decode($datos[$i]["linDescripcion"])."</option>";
            }
            echo '</select>';
        }
        else
        {
            echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
        }
    }


    private function getArrayMarca() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "marCodigo" => $fila["codigo"],
                "marDescripcion" => $fila["marca"]));
        }
        return $datos;
    }
    
    function comboMarca()
    {
        $this->prepararConsultaProducto('opc_contar_marca');
        $total = $this->getArrayTotal();
        $datos = array();        
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaProducto('opc_lista_marca');
            $datos = $this->getArrayMarca();
            echo    '<select class="form-control" name="param_prodMarca" id="param_prodMarca">
                            <option value=""  disabled selected style="display: none;">Seleccione línea del producto</option>';
            for($i=0; $i<count($datos); $i++)
            {
                echo "<option value='".utf8_decode($datos[$i]["marCodigo"])."'>".utf8_decode($datos[$i]["marDescripcion"])."</option>";
            }
            echo '</select>';
        }
        else
        {
            echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
        }
    }

    private function getArrayMedida() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "medCodigo" => $fila["codigo"],
                "medDescripcion" => $fila["medida"]));
        }
        return $datos;
    }
    
    function comboMedida()
    {
        $this->prepararConsultaProducto('opc_contar_medida');
        $total = $this->getArrayTotal();
        $datos = array();        
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaProducto('opc_lista_medida');
            $datos = $this->getArrayMedida();
            echo    '<select class="form-control" name="param_prodEmpaque" id="param_prodEmpaque">
                            <option value=""  disabled selected style="display: none;">Seleccione empaque del producto</option>';
            for($i=0; $i<count($datos); $i++)
            {
                echo "<option value='".utf8_decode($datos[$i]["medCodigo"])."'>".utf8_decode($datos[$i]["medDescripcion"])."</option>";
            }
            echo '</select>';
        }
        else
        {
            echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
        }
    }

    private function getArrayPresentacion() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "presCodigo" => $fila["codigo"],
                "presDescripcion" => $fila["presentacion"]));
        }
        return $datos;
    }
    
    function comboPresentacion()
    {
        $this->prepararConsultaProducto('opc_contar_presentacion');
        $total = $this->getArrayTotal();
        $datos = array();        
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaProducto('opc_lista_presentacion');
            $datos = $this->getArrayPresentacion();
            echo    '<select class="form-control" name="param_prodPresentacion" id="param_prodPresentacion">
                            <option value=""  disabled selected style="display: none;">Seleccione presentación del producto</option>';
            for($i=0; $i<count($datos); $i++)
            {
                echo "<option value='".utf8_decode($datos[$i]["presCodigo"])."'>".utf8_decode($datos[$i]["presDescripcion"])."</option>";
            }
            echo '</select>';
        }
        else
        {
            echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
        }
    }


    private function getArrayGama() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "gamaCodigo" => $fila["codigo"],
                "gamaDescripcion" => $fila["gama"]));
        }
        return $datos;
    }
    
    function comboGama()
    {
        $this->prepararConsultaProducto('opc_contar_gama');
        $total = $this->getArrayTotal();
        $datos = array();        
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaProducto('opc_lista_gama');
            $datos = $this->getArrayGama();
            echo    '<select class="form-control" name="param_prodGama" id="param_prodGama">
                            <option value=""  disabled selected style="display: none;">Seleccione gama del producto</option>';
            for($i=0; $i<count($datos); $i++)
            {
                echo "<option value='".utf8_decode($datos[$i]["gamaCodigo"])."'>".utf8_decode($datos[$i]["gamaDescripcion"])."</option>";
            }
            echo '</select>';
        }
        else
        {
            echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
        }
    }

}

?>                                                    