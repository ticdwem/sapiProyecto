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
        $inserta =0;
        $datos = json_decode($compras, true);
        $contar = count($datos["productos"]);
       
        // verificamos que los datos no hayan sido altaerados;
        $idUsuer = (Validacion::validarNumero($datos["idUser"]) == -1) ? false : htmlspecialchars($datos["idUser"]);
        $nota = (Validacion::textoLargo($datos["nota"],12) == 900 ) ? false : htmlspecialchars($datos["nota"]);
        $fecha = (Validacion::valFecha($datos["fecha"]) == -1) ? false :htmlspecialchars(Validacion::valFecha($datos["fecha"]));

       
        $validar = array("idUsuer"=>$idUsuer,"nota"=>$nota,"fecha"=>$fecha);
        $val = Utls::sessionValidate($validar);
       
       
        if($val > 1){
            echo '<script>window.location="' . base_url . 'Compras/index"</script>';
        }else{
            $notaCompra = new ComprasModel();
            $notaCompra->setIdUsuer($idUsuer);
            $notaCompra->setNota($nota);
            $notaCompra->setFecha($fecha);
            $notaCompra->setProveedor($datos['provedor']);
            $insert = $notaCompra->insertCompras();
            if($insert){
                for ($i=0; $i < $contar; $i++) { 
                   $producto = new ComprasModel();
                   $producto->setIdProducto($datos["productos"][$i]['codigo']);
                   $producto->setNota($nota);
                   $producto->setPzDetalleCompra($datos["productos"][$i]['pieza']);
                   $producto->setPesoDetalleCompra($datos["productos"][$i]['peso']);
                   $producto->setLoteDetalleCompra($datos["productos"][$i]['lote']);
                   $producto->setPrecioUnitarioDetalleCompra($datos["productos"][$i]['precio']);
                   $producto->setSubtotalDetalleCompra($datos["productos"][$i]['sub']);
                   $producto->setAlmacen($datos["productos"][$i]["almacen"]);
                   $inserta = $producto->insertDetalleCompras();
                   if($inserta ==  false){
                    $inserta ++;
                     $_SESSION["nombre"] = $datos["productos"][$i]['nombre'];
                   }
                }
                if($inserta > 0){
                    $_SESSION['formulario_Inserta'] = "hubo un error al insertar ".$_SESSION["nombre"]." corrige los datos e ingresa de nuevo";
                }else{
                    echo 0;
                }
            }
        }
        
    }
    
}
