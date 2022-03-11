<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/PreventaController.php";

class PreventaController{

    public function index(){
        $consulta = new PreventaModel();
        $preventa = $consulta->getAllWhere('viewPreventa','GROUP BY idnotaPedido');
        require_once 'views/preventa/index.php';
    }
    
}
