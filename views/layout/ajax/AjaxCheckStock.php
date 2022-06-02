<?php
require_once "AjaxDefault.php";
require_once "../../../models/anden/DatosAnden.php";
require_once "../../../config/requireoncedefault.php";
require_once "../../../controllers/UpdateVentaLoteController.php";
require_once "../../../models/anden/venta/VerifStock.php";
require_once "../../../controllers/verifStock/verificarstock.php";

class AjaxCheckStock extends AjaxDefault
{
    
    public function __construct($post)
    {
        parent::__construct($post);        
    }
    
    public function sendToController(){
        $datos = json_decode($this->getDatos());
        $json = $datos->verificar[0];
        
        $alm = (Validacion::validarNumero($json->almacen) == -1)? false : $json->almacen;
        if($alm == false){
            echo -1;
        }
        $verif = new verificarStock($json,$alm);
        $verif->checkDatos();
    }
}



$ajax = new AjaxCheckStock($_POST["existencia"]);
$ajax->sendToController();



