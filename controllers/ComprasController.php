<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . "/models/ComprasModel.php";


class ComprasController  
{
    public function index(){
        $Proveedor = new ComprasModel();
        $rowsProv = $Proveedor->getAll('getdomproveedor');

        $alm = new ComprasModel();
        $almacen = $alm->getAll('almacen');
        require_once 'views/compras/index.php';
    }

    public function create(){

    }
    
}
