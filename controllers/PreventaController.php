<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/preventa/PreventaController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/preventa/deleteProdPreventa.php";

class PreventaController{
    private $instancia;

    public function __construct(){
        $this->instancia = new PreventaModel();
    }

    public function index(){
        $preventa = $this->instancia->getAllWhere('viewPreventa','GROUP BY idnotaPedido');
        require_once 'views/preventa/index.php';
    }

    public function detalle(){
        $datos = $this->instancia->getAllWhere('clientepedido','WHERE id='.$_GET['cli'])->fetch_object();        
        $dom = $this->instancia->getAllWhere('mostrardatospedido','WHERE clienteId='.$_GET['cli'])->fetch_object();
        $prod = $this->instancia->getAllWhere('viewPedidosProducto','WHERE idnotaPedido = '.$_GET['id']);
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
            $updateDatos->updateDato();
        }
        /* var_dump($datosJson); */
    }
    
}
