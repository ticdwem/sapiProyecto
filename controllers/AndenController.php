<?php
/* require_once $_SERVER[] */
require_once 'models/anden/GetProdutos.php';
require_once 'models/anden/venta/ventaModel.php';
require_once 'models/anden/ClienteVenta.php';

class AndenController{


    public function __construct()
    {
        //validamos si extiste a sesison
      if(!isset($_SESSION['usuario'])){Utls::sinSession();}
    }
    public function index(){
        $prueba = new GetProdutos();
        $datos = $prueba->listas();
        require_once 'views/anden/andenVenta.php';
    }

    public function Venta(){
        /* selecccion los productos dependidendo del  */
        $datos = new VentaModel($_SESSION['usuario']['camra'],$_GET['nota']);
        $productos = $datos->selectNotaVenta();
        
        /* selecciona el numero del cliente y muestra la informacion completa del cliente */
        $cliente = new ClienteVenta($_GET['cli']);
        $datosCli = $cliente->selectCliente()->fetch_object();        
        $domicilio = $cliente->selectDatosPedidos()->fetch_object();
        require_once 'views/remisiones/venta.php';        
    }

    public function traspaso(){
        $anden = new DatosAnden();
        $andenes = $anden->getAll('almacen');
        require 'views/remisiones/traspaso.php';
    }

   

}