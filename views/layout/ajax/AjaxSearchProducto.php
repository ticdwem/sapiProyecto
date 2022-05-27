<?php
require_once "AjaxDefault.php";
require_once "../../../controllers/verifAlmacen/ConsultaAlmacen.php";

class AjaxSearchProducto extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function sendToController(){
        $datos = json_decode($this->getDatos());
        
        $producto = new ConsultaAlmacen($datos->data[0]);
        $producto->findProducto();
    }
}

$traspaso = new AjaxSearchProducto($_POST['productoAlmacen']);
$traspaso->sendToController();
