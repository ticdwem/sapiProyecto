<?php
require_once "AjaxDefault.php";
require_once "../../../controllers/PedidoController.php";

class AjaxAddPedido extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function addPedidoAjax()
    {
        $dato = $this->getDatos();
		$pedido = new PedidoController();
		$pedido->crearPedido($dato);
    }
    
}
$ajaxAdd = new AjaxAddPedido($_POST["data"]);
$ajaxAdd->addPedidoAjax();