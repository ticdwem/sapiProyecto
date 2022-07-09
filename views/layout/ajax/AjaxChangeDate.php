<?php
require_once "AjaxDefault.php";
require_once "../../../controllers/PedidoController.php";

class AjaxChangeDate extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function ajaxchangeDatePEdido()
    {
        $dato = $this->getDatos();
        $pedido = new PedidoController();
		$pedido->changeDatePEdido($dato); 
    }
    
}
$ajaxAdd = new AjaxChangeDate($_POST["data"]);
$ajaxAdd->ajaxchangeDatePEdido();