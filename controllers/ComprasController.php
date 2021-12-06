<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . "/models/ComprasModel.php";


class ComprasController  
{
    public function index(){
        $Proveedor = new ComprasModel();
        $rowsProv = $Proveedor->getAll('proveedor');

        $alm = new ComprasModel();        
        $almacenes = $alm->getAll('almacen');

        $prod = new ComprasModel();
        $producto = $prod->getAll('productos');

        $lista = new ComprasModel();
        $listaProducto = $lista->getAll('producto');

        require_once 'views/compras/index.php';
    }

    public function insertCompras($compras){
        $datos = json_decode($compras, true);

        // verificamos que los datos no hayan sido altaerados;
        $idUsuer = (Validacion::validarNumero($datos["idUser"]) == -1) ? false : htmlspecialchars($datos["idUser"]);
        $nota = (Validacion::textoLargo($datos["nota"],12) == 900 ) ? false : htmlspecialchars($datos["nota"]);
        $fecha = (Validacion::valFecha($datos["fechaCompra"]) == -1) ? false :htmlspecialchars($datos["fechaCompra"]);
        $proveedor = (Validacion::validarNumero($datos["selectNombreProveedor"]) == -1) ? false : htmlspecialchars($datos["selectNombreProveedor"]);
        $almacen = (Validacion::validarNumero($datos["selectAlmacenVenta"]) == -1) ? false : htmlspecialchars($datos["selectAlmacenVenta"]);

        $validar = array("idUsuer"=>$idUsuer,"nota"=>$nota,"fecha"=>$fecha,"proveedor"=>$proveedor,"almacen"=>$almacen);
        $val = Utls::sessionValidate($validar);
        if($val > 1){
            echo '<script>window.location="' . base_url . 'Compras/index"</script>';
        }else{

        }
        
    }
    
}
