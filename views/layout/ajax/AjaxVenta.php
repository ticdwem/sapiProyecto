<?php
require_once 'AjaxDefault.php';
require_once '../../../controllers/verifStock/MakeVentaControllers.php';
require_once '../../../models/anden/venta/VentaTerminadaModel.php';
class AjaxVenta extends AjaxDefault
{

    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function sendToController(){
        $datos = json_decode($this->getDatos());
        $json = $datos->data[0];

        $datos = new MakeVentaControllers();
        $datos->venta($json);

        
    }
    
}

$venta = new AjaxVenta($_POST['getVEnta']);
$venta->sendToController();


