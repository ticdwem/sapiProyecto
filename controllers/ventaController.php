<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/venta/ventaModel.php";

class VentaController{
  private $instancia;

    public function __construct(){
        $this->instancia = new VentaModel();
    }

    public function venta(){
         $datos = $this->instancia->getAllWhere('clientepedido','WHERE id='.$_GET['cli'])->fetch_object();   //datos de contacto de cliente      
         $dom = $this->instancia->getAllWhere('mostrardatospedido','WHERE clienteId='.$_GET['cli'])->fetch_object(); //datos de domicilio de cliente
        $prod = $this->instancia->getAllWhere('viewPedidosProducto','WHERE idnotaPedido = '.$_GET['id']);  //datos de productos
        $almacenes = $this->instancia->getAllwhere('almacen','WHERE idAlmacen <> 1');  //traer almacenes excepto el almacen 1 que es el default
        require_once 'views/remisiones/venta.php';
    }
}