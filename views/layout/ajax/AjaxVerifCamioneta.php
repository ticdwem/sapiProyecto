<?php
require_once "AjaxDefault.php";
require_once '../../../controllers/preventa/AsignarChoferRuta.php';
require_once '../../../models/preventa/DesignarCamioneta.php';

class AjaxVerifCamioneta extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function addPedidoAjax()
    {
        $dato = $this->getDatos();
        $pedido = new AsignarChoferRuta();
		$pedido->verifCamioneta($dato);
    }
    
}
$ajaxAdd = new AjaxVerifCamioneta($_POST["idRuta"]);
$ajaxAdd->addPedidoAjax();