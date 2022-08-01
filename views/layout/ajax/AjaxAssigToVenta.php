<?php
require_once "AjaxDefault.php";
require_once "../../../controllers/preventa/AssignNotaToVenta.php";
require_once "../../../models/preventa/UpdateToVentaModel.php";

class AjaxVerifCamioneta extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function sendToController()
    {
        $dato = $this->getDatos();
        $venta = new AssignNotaToVenta();
        $venta->updateNotaVenta($dato);

        
    }
    
}
$ajaxAdd = new AjaxVerifCamioneta($_POST["toVenta"]);
$ajaxAdd->sendToController();