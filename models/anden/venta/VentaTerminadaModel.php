<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/anden/DatosAnden.php';

class VentaTerminadaModel extends DatosAnden
{
    private $numNota;
    private $numCli;
    private $notaVenta;
    private $total;
    private $limCredito;
    private $descuento;

    public function __construct($numNota,$numCli,$notaVenta,$total,$limCredito,$descuento)
    {
        parent::__construct($_SESSION['usuario']['camra']);
        $this->numNota = $numNota;
        $this->numCli = $numCli;
        $this->notaVenta = $notaVenta;
        $this->total = $total;
        $this->limCredito = $limCredito;
        $this->descuento = $descuento;
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
    /**
     * Get the value of notaVenta
     */
    public function getNotaVenta()
    {
        return $this->notaVenta;
    }
    
    public function deleteFromPedidos(){
       $deletePedido = "CALL confirmVenta('{$this->getNumNota()}', '{$this->getNumCli()}', '{$this->getNumAnden()}', '8450.97','{$this->getNotaVenta()}')";

       $query = $this->db->query($deletePedido);
       $this->close_connection_Databa();
       return $query;
    }

}


