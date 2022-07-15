<?php
 //require_once('../PedidoModel.php');
 require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/models/PedidoModel.php";

class EditarPedidos extends PedidoModels
{
    
    public function __construct()
    {
        parent::__construct();
       
    }

    public function updateComentario(){
		$comnentario = "UPDATE notapedido
						SET
							comentarioNotaPedidos='{$this->getNotaCobranza()}'
						WHERE 
							idNotaPedido={$this->getIdnotaPedido()} and
							idUsuarioNotaPedido= ".IDUSER." and
							idClienteNotaPedido= {$this->getIdClientePedido()}";
		$upVenta = $this->db->query($comnentario);
		$pass = false;
		if($upVenta){
			$pass = true;
		}
		return $pass;
	}
    

}
