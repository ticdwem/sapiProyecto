<?php
$directory = dirname(__FILE__,2);
 //require_once('PedidoModel.php');
/*  require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/models/PedidoModel.php"; */
 require_once $directory."\PedidoModel.php";

class ListarPedidos extends PedidoModels
{

    private int $statusPedido;
    public function __construct($statusPedido)
    {
        parent::__construct();
        $this->statusPedido = $statusPedido;
       
    }

    public function getNumero(){
        return $this->statusPedido;
    }

    public function getPedidosEditar(){
        $verPedidos = "SELECT 
                            np.fechaAltaNotaPedido AS fechaInicial,np.fechaEnregaNotaPedido AS fechaFin,np.idNotaPedido AS nota,np.idClienteNotaPedido AS clente,cl.nombreCliente AS nameCl,
                            rt.nombreRuta AS rutaname,np.rutaNotaPEdido as rutaNP , rta.nombreRuta as nameRuta
                        FROM 
                            notapedido np
                        INNER JOIN 
                            cliente cl
                            ON np.idClienteNotaPedido = cl.idCliente
                        INNER JOIN 
                            domiciliocliente dc
                            ON dc.clienteId = cl.idCliente
                        INNER JOIN 
                            ruta rt
                            ON dc.rutaId = rt.idRuta
                        left JOIN 
                            ruta rta
                            ON np.rutaNotaPEdido = rta.idRuta
                        WHERE np.statusNotaPEdido = '{$this->getNumero()}'
                        AND np.idUsuarioNotaPedido = '".IDUSER."'";	
		$query = $this->db->query($verPedidos);

		return $query;

	}

    public function getPedidosPreventa(){
        $verPedidos = "SELECT 
                            np.fechaAltaNotaPedido AS fechaInicial,np.fechaEnregaNotaPedido AS fechaFin,np.idNotaPedido AS nota,np.idClienteNotaPedido AS clente,cl.nombreCliente AS nameCl,
                            rt.nombreRuta AS rutaname,np.rutaNotaPEdido as rutaNP , rta.nombreRuta as nameRuta
                        FROM 
                            notapedido np
                        INNER JOIN 
                            cliente cl
                            ON np.idClienteNotaPedido = cl.idCliente
                        INNER JOIN 
                            domiciliocliente dc
                            ON dc.clienteId = cl.idCliente
                        INNER JOIN 
                            ruta rt
                            ON dc.rutaId = rt.idRuta
                        left JOIN 
                            ruta rta
                            ON np.rutaNotaPEdido = rta.idRuta
                        WHERE np.statusNotaPEdido = '{$this->getNumero()}' order by cl.nombreCliente";	
		$query = $this->db->query($verPedidos);

		return $query;

	}
    

}
