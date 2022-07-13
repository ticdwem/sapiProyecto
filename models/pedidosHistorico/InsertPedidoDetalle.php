<?php
 //require_once('../PedidoModel.php');
 require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/models/PedidoModel.php";

class InsertPedidoDetalle extends PedidoModels
{
    public function __construct(Int $idnotaPedido,Int $idProductoPedido,int $pzProductoPedido,String $presentacion)
    {
        parent::__construct();
        $this->idnotaPedido = $idnotaPedido;
        $this->idProductoPedido = $idProductoPedido;
        $this->pzProductoPedido = $pzProductoPedido;
        $this->presentacion = $presentacion;
    }

    public function insertPedido(){
		$insert= "INSERT INTO pedidos
                            (idnotaPedido, idProductoPedido, pzProductoPedido, detalleEntrega)
                            VALUES ('{$this->getIdnotaPedido()}', '{$this->getIdProductoPedido()}', '{$this->getPzProductoPedido()}', '{$this->getPresentacionProductoPedido()}')";	
		
        $query = $this->db->query($insert);
		$insertPedido = false;
        if($query){
            $insertPedido = true;
        }
        return $insertPedido;
	}
    

}