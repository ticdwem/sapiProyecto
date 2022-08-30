<?php
require_once 'AjaxDefault.php';
require_once '../../../models/anden/DatosAnden.php';
require_once '../../../controllers/verifStock/MakeVentaControllers.php';
require_once '../../../models/anden/venta/VentaTerminadaModel.php';
require_once '../../../models/anden/venta/VentaDescontarDeAlmacen.php';
class AjaxVenta extends AjaxDefault
{

    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function sendToController(){

        $datos = new MakeVentaControllers();
        $datos->venta(json_decode($this->getDatos()));

        
    }
    
}

$venta = new AjaxVenta($_POST['getVEnta']);
$venta->sendToController();


