<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/anden/DatosAnden.php';

class VentaTerminadaModel extends DatosAnden
{
    private $numNota;
    private $numCli;

    public function __construct($numNota,$numCli)
    {
        parent::__construct($_SESSION['usuario']['camra']);
        $this->numNota = $numNota;
        $this->numCli = $numCli;
    }  

    /**
     * Get the value of numNota
     */
    public function getNumNota()
    {
        return $this->numNota;
    }
    /**
     * Get the value of numCli
     */
    public function getNumCli()
    {
        return $this->numCli;
    }
    
    public function deleteFromPedidos(){
       $deletePedido = "DELETE FROM pedidos 
       WHERE idnotaPedido = '{$this->getNumNota()}' And
               idClientePedido = '{$this->getNumCli()}' and 
               idAlmacenPedidos='{$this->getNumAnden()}'";

       $query = $this->db->query($deletePedido);
       $this->close_connection_Databa();
       return $query;
    }
}


