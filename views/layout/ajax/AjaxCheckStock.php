<?php
require_once "AjaxDefault.php";
require_once "../../../controllers/UpdateVentaLoteController.php";
require_once "../../../models/anden/venta/VentaLotenota.php";

class AjaxCheckStock extends AjaxDefault
{
    
    public function veriricar($post){
        parent::__construct($post);
    }

    public function sendToController(){
        $datos = json_decode($this->getDatos());
        $json = $datos->verificar[0];

        
    }
}

$ajax = new AjaxCheckStock($_POST["existencia"]);
$ajax->sendToController();



