<?php
/* mandamos a llamara al modelo de clientes */
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/RemisionModel.php";

class RemisionController{
    public function index(){
      // hacemos consulta para la lista de clientes
      $cliente = new RemisionModel();
     $clientes = $cliente->getAll("cliente");
      require_once "views/remisiones/index.php";
    }




}