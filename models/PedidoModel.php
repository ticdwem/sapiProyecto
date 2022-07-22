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

	protected $nombreCliente;
	protected $telefono;
	protected $ruta;

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

	/**
	 * Get the value of nombreCliente
	 */
	public function getNombreCliente()
	{
		return $this->nombreCliente;
	}

	/**
	 * Set the value of nombreCliente
	 */
	public function setNombreCliente($nombreCliente): self
	{
		$this->nombreCliente = $nombreCliente;

		return $this;
	}

	/**
	 * Get the value of telefono
	 */
	public function getTelefono()
	{
		return $this->telefono;
	}

	/**
	 * Set the value of telefono
	 */
	public function setTelefono($telefono): self
	{
		$this->telefono = $telefono;

		return $this;
	}

	/**
	 * Get the value of ruta
	 */
	public function getRuta()
	{
		return $this->ruta;
	}

	/**
	 * Set the value of ruta
	 */
	public function setRuta($ruta): self
	{
		$this->ruta = $ruta;

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


	public function updatePedidos(){
		$update = "UPDATE notapedido p
		SET
			p.statusNotaPEdido='2'
		WHERE 
			p.idUsuarioNotaPedido = ".IDUSER."
			AND p.fechaEnregaNotaPedido = sumarFecha()
			AND p.statusNotaPEdido = 1";
		$upVenta = $this->db->query($update);
		$pass = false;
		if($upVenta){
			$pass = true;
		}
		return $pass;	
	}

	public function customerWithoutId(){
		$select = "SELECT np.nombreNotaPedido, np.telNotaPEdido,np.rutaNotaPEdido,rt.nombreRuta FROM notapedido np 
					INNER JOIN ruta rt
					ON np.rutaNotaPEdido = rt.idRuta
					WHERE np.idNotaPedido = '{$this->getIdnotaPedido()}' AND np.idClienteNotaPedido = '{$this->getIdClientePedido()}'";
		$query = $this->db->query($select);

		return $query;
	}

	public function repoteModel(){
		$reporte = "SELECT  pr.nombreProducto AS nameP,np.fechaEnregaNotaPedido AS entrega,pd.idProductoPedido AS codigo, sum(pd.pzProductoPedido) AS suma FROM pedidos pd
		INNER JOIN notapedido np
		ON pd.idnotaPedido = np.idNotaPedido
		INNER JOIN producto pr
		ON pd.idProductoPedido = pr.idProducto
		WHERE np.fechaEnregaNotaPedido = CURDATE()+1
		GROUP BY pd.idProductoPedido
		ORDER BY pd.idProductoPedido";
		$query = $this->db->query($reporte);

		return $query;
	}



	
}