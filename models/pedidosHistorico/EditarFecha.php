<?php
 //require_once('../PedidoModel.php');
 require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/models/PedidoModel.php";

class EditarFecha extends PedidoModels
{
    
    public function __construct()
    {
        parent::__construct();
       
    }

    public function changeDatePEdido(){
		$changeFecha = "UPDATE notapedido
						SET
                        fechaEnregaNotaPedido='{$this->getFechaEntrega()}'
						WHERE 
                        idNotaPedido={$this->getIdnotaPedido()} and
                        idUsuarioNotaPedido= ".IDUSER." and
							idClienteNotaPedido= {$this->getIdClientePedido()}";
		$upVenta = $this->db->query($changeFecha);
		$pass = false;
		if($upVenta){
			$pass = true;
		}
		return $pass;
	}
    

}


