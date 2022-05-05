<?php
require_once "AjaxDefault.php";
require_once "../../../models/anden/DatosAnden.php";
require_once "../../../config/requireoncedefault.php";
require_once "../../../controllers/UpdateVentaLoteController.php";
require_once "../../../models/anden/venta/VerifStock.php";
require_once "../../../controllers/verifStock/verificarstock.php";

class AjaxCheckLote extends AjaxDefault
{
    
    public function __construct($post)
    {
        parent::__construct($post);        
    }
    public function sendToController(){
        $datos = json_decode($this->getDatos());
        $json = $datos->verificar[0];
        $alm = (Validacion::validarNumero($json->phone_almacen_8) == -1)? false : $json->phone_almacen_8;
        if($alm == false){
            echo -1;
            return;
        }
        $verif = new verificarStock($json, $alm);
        $verif->checkLote();
    }
}

$ajax = new AjaxCheckLote($_POST["existencialote"]);
$ajax->sendToController();



