<?php
/* require_once $_SERVER[] */
require_once 'models/anden/GetProdutos.php';
require_once 'models/anden/venta/ventaModel.php';
require_once 'models/anden/ClienteVenta.php';

class AndenController{


    public function index(){
        $prueba = new GetProdutos();
        $datos = $prueba->listas();

        require_once 'views/anden/andenVenta.php';
    }

    public function detalle(){
        $datos = new VentaModel($_SESSION['usuario']['camra'],$_GET['nota']);
        $productos = $datos->selectNotaVenta();
        
        $cliente = new ClienteVenta($_GET['cli']);
        $datosCli = $cliente->selectCliente();
        
        $domicilio = $cliente->selectDatosPedidos();
        
        require_once 'views/anden/venta.php';

        
    }

}