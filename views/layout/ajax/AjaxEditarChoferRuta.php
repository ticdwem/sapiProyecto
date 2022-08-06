<?php
require_once "AjaxDefault.php";
require_once ("../../../controllers/preventa/EditChoferRuta.php");
require_once ("../../../models/preventa/PreventaTrasporteModel.php");
require_once ("../../../models/preventa/EditChoferRutaModels.php");

class AjaxEditarChoferRuta extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function sendToController()
    {
        $dato = $this->getDatos();
        $pedido = new EditChoferRuta();
		$pedido->editarcr($dato);
    }
    
}
$ajaxAdd = new AjaxEditarChoferRuta($_POST["editarChofRt"]);
$ajaxAdd->sendToController();