<?php
require_once "AjaxDefault.php";
require_once ("../../../controllers/preventa/deleteChoferRuta.php");
require_once("../../../models/preventa/PreventaTrasporteModel.php");

class AjaxDeleteChoferRuta extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function sendToController()
    {
        $dato = $this->getDatos();
        $pedido = new DeleteChoferRuta();
		$pedido->deletecr($dato);
    }
    
}
$ajaxAdd = new AjaxDeleteChoferRuta($_POST["datosDelete"]);
$ajaxAdd->sendToController();