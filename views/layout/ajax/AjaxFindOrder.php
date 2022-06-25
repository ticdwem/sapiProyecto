<?php
require_once "AjaxDefault.php";
require_once ('../../../controllers/pedidosAdvanced/PedidoAnteriorController.php');
require_once ('../../../models/pedidosHistorico/PedidoHistorico.php');

class AjaxFindOrder extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function sendToController(){
        $pedido = new PedidoAnteriorController();
        $pedido->lista($this->datos);
    }
}
if(isset($_POST['buscarFecha'])){$ajacDAta=$_POST['buscarFecha'];}else{$ajacDAta = 0;}
$fecha = new AjaxFindOrder($ajacDAta);
$fecha->sendToController();