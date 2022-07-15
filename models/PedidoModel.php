<?php
/* require_once 'config/modeloBase.php'; */
require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/config/modeloBase.php";

class PedidoModels extends ModeloBase
{
	
	protected $idUsuarioPedido; // id del usuario
 	protected $idnotaPedido; // id de la nota del pedido
	protected $idClientePedido; //id del cliente
	
	protected $idProductoPedido; // del producto
	protected $pzProductoPedido; //piezas del producto
	private $detalleEntrega; // detalle de la entrega
	protected $presentacion; // presentacion
	protected $fechaEntrega; // fecha de entrega
	protected $comentarioNotaPedidos;
	protected $notaCobranza;

	public function __construct()
    {
        parent::__construct();
    }
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
	 * Get the value of detalleEntrega
	 */
	public function getDetalleEntrega()
	{
		return $this->detalleEntrega;
	}

	/**
	 * Set the value of detalleEntrega
	 */
	public function setDetalleEntrega($detalleEntrega): self
	{
		$this->detalleEntrega = $detalleEntrega;

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
	/**
	 * Get the value of comentarioNotaPedidos
	 */
	public function getComentarioNotaPedidos()
	{
		return $this->comentarioNotaPedidos;
	}

	/**
	 * Set the value of comentarioNotaPedidos
	 */
	public function setComentarioNotaPedidos($comentarioNotaPedidos): self
	{
		$this->comentarioNotaPedidos = $comentarioNotaPedidos;

		return $this;
	}

	
	/**
	 * Get the value of notaCobranza
	 */
	public function getNotaCobranza()
	{
		return $this->notaCobranza;
	}

	/**
	 * Set the value of notaCobranza
	 */
	public function setNotaCobranza($notaCobranza): self
	{
		$this->notaCobranza = $notaCobranza;

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

/* 	
este metodo se pasa a pedidoinsertNota
public function insertPedido(){
		$insert= "INSERT INTO pedidos 
							(idnotaPedido, idUsuarioPedido, idClientePedido, idProductoPedido, pzProductoPedido,detalleEntrega, fechaAltaProductoPedido, statusProductoPedido,fechaEntregaPedido,comentarioNotaPedidos)
							 VALUES ('{$this->getIdnotaPedido()}', '{$this->getIdUsuarioPedido()}', '{$this->getIdClientePedido()}', '{$this->getIdProductoPedido()}', '{$this->getPzProductoPedido()}','{$this->getDetalleEntrega()}' ,now(), '1','{$this->getFechaEntrega()}','{$this->getComentarioNotaPedidos()}')";	

		$query = $this->db->query($insert);
		$insertPedido = false;
        if($query){
            $insertPedido = true;
        }
        return $insertPedido;
	} */

/* 	public function getPedidosEditar()
	{
		$verPedidos = "SELECT np.fechaAltaNotaPedido AS fechaInicial,np.fechaEnregaNotaPedido AS fechaFin,np.idNotaPedido AS nota,np.idClienteNotaPedido AS clente,cl.nombreCliente AS nameCl,rt.nombreRuta AS rutaname
		FROM notapedido np
		INNER JOIN cliente cl
		ON np.idClienteNotaPedido = cl.idCliente
		INNER JOIN domiciliocliente dc
		ON dc.clienteId = cl.idCliente
		INNER JOIN ruta rt
		ON dc.rutaId = rt.idRuta
		WHERE np.statusNotaPEdido = 1";			
		
		$query = $this->db->query($verPedidos);

		return $query;

	} */

	public function updatePedidos(){
		$update = "UPDATE notapedido p
		SET
			p.statusNotaPEdido='2'
		WHERE 
			p.idUsuarioNotaPedido = ".IDUSER."
			AND p.fechaEnregaNotaPedido = sumarFecha()
			AND p.statusNotaPEdido = 1";
/* 		var_dump($update);
		die(); */
	$upVenta = $this->db->query($update);
	$pass = false;
	if($upVenta){
		$pass = true;
	}
	return $pass;	
}

}