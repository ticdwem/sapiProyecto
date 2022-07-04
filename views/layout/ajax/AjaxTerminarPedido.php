<?php
require_once "AjaxDefault.php";
require_once "../../../controllers/PedidoController.php";

class AjaxAddPedido extends AjaxDefault
{
    public function __construct($datos)
    {
        parent::__construct($datos);
    }

    public function terminarPedido()
    {
        $dato = $this->getDatos();
        $usuario = (Validacion::validarNumero($dato) == -1 ) ? false : $dato ;
        if($usuario == false){
            echo -1;
        }else{
            if($usuario == IDUSER){
                $pedido = new PedidoController();
                $pedido->finishPedido($dato);
            }else{
                echo -2;
            }
        }
    }
    
}
$ajaxAdd = new AjaxAddPedido($_POST["idUSEr"]);
$ajaxAdd->terminarPedido();