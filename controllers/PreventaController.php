<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/preventa/PreventaController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/preventa/deleteProdPreventa.php";

class PreventaController{
    private $instancia;

    public function __construct(){
        $this->instancia = new PreventaModel();
    }

    public function index(){
        //$preventa = $this->instancia->getAllWhere('viewPreventa','WHERE statusProductoPedido = 1 GROUP BY idnotaPedido');
        $preventa = $this->instancia->getAllWhere('viewPreventa','Where statusProductoPedido = 1 GROUP BY idnotaPedido');
        require_once 'views/preventa/index.php';
    }

    public function detalle(){
        $datos = $this->instancia->getAllWhere('clientepedido','WHERE id='.$_GET['cli'])->fetch_object();  // datos de contacto de cliente      
        $dom = $this->instancia->getAllWhere('mostrardatospedido','WHERE clienteId='.$_GET['cli'])->fetch_object(); // datos de domicilio de cliente
        $prod = $this->instancia->getAllWhere('viewPedidosProducto','WHERE idnotaPedido = '.$_GET['id']); // datos de productos
        $almacenes = $this->instancia->getAllwhere('almacen','WHERE idAlmacen <> 1'); // traer almacenes excepto el almacen 1 que es el default
        require_once 'views/preventa/detalleVenta.php';
    }

    public function deleteDatoPedido($datos){
        $datosJso = json_decode($datos,true);
        $dato = $datosJso["data"][0];
        
        $producto = (Validacion::validarNumero($dato["phone_idProd_10"])== -1) ? false :  $dato["phone_idProd_10"];
        $nota = (Validacion::validarNumero($dato["phone_nota_10"])== -1) ? false :  $dato["phone_nota_10"];

        $valArray = array('producto'=>$producto , 'nota'=> $nota);
        $dato = Utls::sessionValidate($valArray);
        if($dato > 1){
            echo 0;
        }else{
            $deletePro = new DeleteProducto($nota, $producto );
            $eliminar = $deletePro->eliminarDatos();
           if($eliminar){
               echo 1;
           }else{
               echo 2;
           }
        }
    }

    public function updatePiezas($datos){
        $datosJson = json_decode($datos,true);
        $update = $datosJson["data"][0];

        $nota =(Validacion::validarNumero($update["phone_idget_12"])==-1)? false: $update["phone_idget_12"];
        $producto =(Validacion::validarNumero($update["phone_idProducto_12"])==-1)? false: $update["phone_idProducto_12"];
        $piezas = (Validacion::validarNumero($update["phone_piezas_10"])==-1)? false: $update["phone_piezas_10"];

        $valArray = array('producto'=>$producto , 'nota'=> $nota,'piezas'=>$piezas);
        $dato = Utls::sessionValidate($valArray);
        if($dato>1){
            echo 0;
        }else{
            $updateDatos = new UpdateProducto( $piezas, $nota,$producto);
            $edit = $updateDatos->updateDato();
            if($edit){
                echo 1;
            }else{
                echo 0;
            }
        }
        /* var_dump($datosJson); */
    }

    public function sendToVentas($datos){
        $jsonVentas = json_decode($datos,true);
        $venta = $jsonVentas["data"][0];

        $almacen =(Validacion::validarNumero($venta["phone_idAlmacen_9"])==-1)? false: $venta["phone_idAlmacen_9"];
        $nota =(Validacion::validarNumero($venta["phone_nota_10"])==-1)? false: $venta["phone_nota_10"];

        $validar = array('almacen'=>$almacen,'nota'=>$nota);
        $valDato= Utls::sessionValidate($validar);

        if($valDato>1){
            echo 0;
        }else{
            $updateToventa = new UpdateProducto(0,$nota,0);
            $updateToventa->setAlmacen($almacen);
            $todoVenta = $updateToventa->passToVenta();
            if ($todoVenta) {
                echo 1;
            } else {
                echo 2;
            }
            
        }
    }
    
}
