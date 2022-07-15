<?php
require_once "AjaxDefault.php";
require_once '../../../controllers/preventa/AsignarAlmacen.php';
require_once '../../../models/preventa/UpdateProducto.php';

class AjaxAsignarAlmacen extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function addPedidoAjax()
    {
        $dato = $this->getDatos();
        $pedido = new AsignarAlmacen();
		$pedido->almacen($dato);
    }
    
}
$ajaxAdd = new AjaxAsignarAlmacen($_POST["updateToVenta"]);
$ajaxAdd->addPedidoAjax();