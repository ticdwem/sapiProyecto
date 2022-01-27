<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/PedidoModel.php";

class PedidoController
{
    public function index(){
        $ruta = new PedidoModels();
        $pedido = $ruta->getAll('ruta');
        require_once 'views/pedidos/index.php';
    }
}