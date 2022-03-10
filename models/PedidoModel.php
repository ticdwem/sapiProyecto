<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/modeloBase.php";

class PedidoModels extends ModeloBase
{
	private $idUsuarioPedido; // id del usuario
 	private $idnotaPedido; // id de la nota del pedido
	private $idClientePedido; //id del cliente

	private $idProductoPedido; // del producto
	private $pzProductoPedido; //piezas del producto
	private $presentacion; // presentacion
	protected $fechaEntrega; // fecha de entrega

	/**
	 * Get the value of idUsuarioPedido
	 */
	public function getIdUsuarioPedido()
	{
		return $this->idUsuarioPedido;
	}

	/**
	 * Set the value of idUsuarioPedido
	 */
	public function setIdUsuarioPedido($idUsuarioPedido)
	{
		$this->idUsuarioPedido = $idUsuarioPedido;

		return $this;
	}

	
 	/**
 	 * Get the value of idnotaPedido
 	 */
	  public function getIdnotaPedido()
	  {
		   return $this->idnotaPedido;
	  }
 
	  /**
	   * Set the value of idnotaPedido
	   */
	  public function setIdnotaPedido($idnotaPedido): self
	  {
		   $this->idnotaPedido = $idnotaPedido;
 
		   return $this;
	  }
 
	 /**
	  * Get the value of idClientePedido
	  */
	 public function getIdClientePedido()
	 {
		 return $this->idClientePedido;
	 }
 
	 /**
	  * Set the value of idClientePedido
	  */
	 public function setIdClientePedido($idClientePedido): self
	 {
		 $this->idClientePedido = $idClientePedido;
 
		 return $this;
	 }
 
	 /**
	  * Get the value of idProductoPedido
	  */
	 public function getIdProductoPedido()
	 {
		 return $this->idProductoPedido;
	 }
 
	 /**
	  * Set the value of idProductoPedido
	  */
	 public function setIdProductoPedido($idProductoPedido): self
	 {
		 $this->idProductoPedido = $idProductoPedido;
 
		 return $this;
	 }
 
	 /**
	  * Get the value of pzProductoPedido
	  */
	 public function getPzProductoPedido()
	 {
		 return $this->pzProductoPedido;
	 }
 
	 /**
	  * Set the value of pzProductoPedido
	  */
	 public function setPzProductoPedido($pzProductoPedido): self
	 {
		 $this->pzProductoPedido = $pzProductoPedido;
 
		 return $this;
	 }
 
	 /**
	  * Get the value of fechaAltaProductoPedido
	  */
	 public function getPresentacionProductoPedido()
	 {
		 return $this->presentacion;
	 }
 
	 /**
	  * Set the value of fechaAltaProductoPedido
	  */
	 public function setPresentacionProductoPedido($presentacion)
	 {
		 $this->presentacion = $presentacion;
 
		 return $this;
	 }
 	/**
	 * Get the value of fechaEntrega
	 */
	public function getFechaEntrega()
	{
		return $this->fechaEntrega;
	}

	/**
	 * Set the value of fechaEntrega
	 */
	public function setFechaEntrega($fechaEntrega)
	{
		$this->fechaEntrega = $fechaEntrega;

		return $this;
	}


	public function lastDate(){
		$consulta = "SELECT * FROM pedidos
		WHERE 
			idUsuarioPedido = '{$this->getIdUsuarioPedido()}'
			and pedidos.fechaAltaProductoPedido = 
			(SELECT MAX(pedidos.fechaAltaProductoPedido) FROM sapi.pedidos WHERE pedidos.idUsuarioPedido = '{$this->getIdUsuarioPedido()}')
			LIMIT 1";

			$query = $this->db->query($consulta);

			return $query;
	}

	public function insertPedido(){
		$insert= "INSERT INTO pedidos 
							(idnotaPedido, idUsuarioPedido, idClientePedido, idProductoPedido, pzProductoPedido, fechaAltaProductoPedido, statusProductoPedido,fechaEntregaPedido)
							 VALUES ('{$this->getIdnotaPedido()}', '{$this->getIdUsuarioPedido()}', '{$this->getIdClientePedido()}', '{$this->getIdProductoPedido()}', '{$this->getPzProductoPedido()}', now(), '1','{$this->getFechaEntrega()}')";

		$query = $this->db->query($insert);
		$insertPedido = false;
        if($query){
            $insertPedido = true;
        }
        return $insertPedido;
	}


}