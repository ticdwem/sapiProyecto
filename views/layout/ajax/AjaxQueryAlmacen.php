<?php
require_once "AjaxDefault.php";
require_once "../../../controllers/verifAlmacen/VerifAlmacenSetGet.php";
require_once "../../../controllers/verifAlmacen/ConsultaAlmacen.php";
require_once "../../../models/anden/selectAnden/ConsultaAlmacenModel.php";

class AjaxQueryAlmacen extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);        
    }

    public function consultaAlmacen(){
        $idAlmacen = $this->getDatos();
        $almacen = new ConsultaAlmacen($idAlmacen);
        $almacen->andenQuery();

    }
}

$consulta = new AjaxQueryAlmacen($_POST["almacenData"]);
$consulta->consultaAlmacen();
