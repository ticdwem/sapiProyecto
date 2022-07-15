<?php
require_once "AjaxDefault.php";
require_once "../../../controllers/PedidoController.php";
require_once "../../../controllers/pedidosAdvanced/PedidoMakeController.php";

class AjaxAddPedido extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function addPedidoAjax()
    {
        $dato = $this->getDatos();
        $pedido = new PedidoMakeController($dato);
		$pedido->addPedido();
    }
    
}
$ajaxAdd = new AjaxAddPedido($_POST["data"]);
$ajaxAdd->addPedidoAjax();