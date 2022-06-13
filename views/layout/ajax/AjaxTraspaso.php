<?php
require_once 'AjaxDefault.php';
require_once '../../../controllers/traspasoProductoAlmacen/TraspasoAlmacen.php';

class AjaxTraspaso extends AjaxDefault
{
    public function __construct($datos){
        parent::__construct($datos);
    }

    public function sendToController(){
        $datos = json_decode($this->getDatos());

        $traspasoDatos = new TraspasoAlmacen($datos->data[0]->phone_idProdcuto_10, $datos->data[0]->phone_loteVentaTraspasoModal_20, $datos->data[0]->decimales_pesoTraspasoModal_10, $datos->data[0]->phone_piezasVentaTraspasoModal_10,$datos->data[0]->phone_selectAlmacen_20,$datos->data[0]->phone_DataAlmacenes_20);
        $traspasoDatos->traspasoProducto();
    }
    
}

    $traspaso = new AjaxTraspaso($_POST['traspasoAlmacen']);
    $traspaso->sendToController();
