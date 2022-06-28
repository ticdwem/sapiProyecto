<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/config/modeloBase.php");

class PedidoHistorico extends ModeloBase
{
    private String $dataOrder;
    public function __construct(String $dataORder)
    {
        parent::__construct();
        $this->dataOrder = $dataORder;
        
    }

    public function getDataOrder(): String
    {
        return $this->dataOrder;
    }

    public function setDataOrder(String $dataOrder): self
    {
        $this->dataOrder = $dataOrder;

        return $this;
    }

    public function historicoPedidoRecepcion()
    {
        $query ="SELECT hp.*,cl.idCliente,cl.nombreCliente,dc.rutaId,rt.nombreRuta FROM historico_pedidos hp
        INNER JOIN cliente  cl
        ON hp.idClientePedido = cl.idCliente
        INNER JOIN domiciliocliente dc
        ON dc.clienteId = cl.idCliente
        INNER JOIN ruta rt
        ON rt.idRuta = dc.rutaId        
         WHERE hp.fechaAltaProductoPedido ='{$this->getDataOrder()}' GROUP BY hp.idnotaPedido";
        $consulta = $this->db->query($query);
        return $consulta;
    }
}
