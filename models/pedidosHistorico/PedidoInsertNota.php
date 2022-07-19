<?php
 //require_once('../PedidoModel.php');
 require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/models/PedidoModel.php";

class PedidoInsertNota extends PedidoModels
{
    private String $fecha;
    public function __construct(String $idnotaPedido,Int $idClientePedido,int $idUsuarioPedido,String $fechaEntrega,String $comentarioNotaPedidos)
    {
        parent::__construct();
        $this->fecha = date('Y-m-d');
        $this->idnotaPedido = $idnotaPedido;
        $this->idClientePedido = $idClientePedido;
        $this->idUsuarioPedido = $idUsuarioPedido;
        $this->fechaEntrega = $fechaEntrega;
        $this->comentarioNotaPedidos = $comentarioNotaPedidos;
    }

    public function getFecha(): String
    {
        return $this->fecha;
    }
    public function insertPedido(){
		$insert= "INSERT INTO notapedido 
								(idNotaPedido, idClienteNotaPedido, idUsuarioNotaPedido, fechaAltaNotaPedido, fechaEnregaNotaPedido, comentarioNotaPedidos, statusNotaPEdido, nombreNotaPedido, telNotaPEdido, rutaNotaPEdido)
                        VALUES ('{$this->getIdnotaPedido()}', '{$this->getIdClientePedido()}', '{$this->getIdUsuarioPedido()}', '{$this->getFecha()}', '{$this->getFechaEntrega()}' ,'{$this->getComentarioNotaPedidos()}',  '1','{$this->getNombreCliente()}','{$this->getTelefono()}','{$this->getRuta()}')";	
		
        $query = $this->db->query($insert);
		$insertPedido = false;
        if($query){
            $insertPedido = true;
        }
        return $insertPedido;
	}
    

}
