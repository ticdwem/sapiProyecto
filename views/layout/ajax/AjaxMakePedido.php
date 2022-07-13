<?php
require_once "AjaxDefault.php";
require_once "../../../controllers/pedidosAdvanced/PedidoMakeController.php";
require_once "../../../models/pedidosHistorico/PedidoInsertNota.php";
require_once "../../../models/PedidoModel.php";

class AjaxMakePedido extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function sendToController()
    {
        $dato = $this->getDatos();

        $pedido = new PedidoMakeController($dato);
		$pedido->crearPedido(); 
       
    }
}
    
$ajaxAdd = new AjaxMakePedido($_POST["pedido"]);
$ajaxAdd->sendToController();