<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . "/models/ComprasModel.php";


class ComprasController  
{
    public function index(){
        $Proveedor = new ComprasModel();
        $rowsProv = $Proveedor->getAll('proveedor');

        $alm = new ComprasModel();        
        $almacenes = $alm->getAll('almacen');

        require_once 'views/compras/index.php';
    }

    public function create(){

    }
    
}
