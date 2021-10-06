<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . "/models/ComprasModel.php";


class ComprasController  
{
    public function index(){
        $Proveedor = new ComprasModel;
        $rows = $Proveedor->getAll('proveedor');

        require_once 'views/compras/index.php';
    }

    public function create(){

    }
    
}
