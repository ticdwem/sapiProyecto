<?php
/* mandamos a llamara al modelo de clientes */
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/RemisionModel.php";

class RemisionController{
    public function index(){
      //  return "views/remisiones/index.php"; 
      require_once "views/remisiones/index.php";
    }




}