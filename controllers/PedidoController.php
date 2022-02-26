<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/PedidoModel.php";

class PedidoController
{
    public function index(){
        $ruta = new PedidoModels();
        $pedido = $ruta->getAllWhere('clientepedido','GROUP BY clientepedido.id,clientepedido.nomRuta ORDER BY	clientepedido.idruta');
        require_once 'views/pedidos/index.php';
    }

    public function pedido(){
        $pedidos = new PedidoModels();
        $datos = $pedidos->getAllWhere('clientepedido','WHERE id='.$_GET['id'])->fetch_object();

        $dom = $pedidos->getAllWhere('mostrardatospedido','WHERE clienteId='.$_GET['id'])->fetch_object();
        require_once 'views/pedidos/pedido.php';
    }

    public function crearPedido($dato){
        $decod = json_decode($dato);
        var_dump($decod);
        var_dump("jajajajaj");
    }
}