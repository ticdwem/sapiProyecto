<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/PreventaController.php";

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
        $datosJso = json_decode($datos);
        var_dump($datosJso);
    }
    
}
