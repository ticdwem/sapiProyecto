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
    private $usuarioVenta; 

    public function __construct($numNota,$numCli,$notaVenta,$total,$limCredito,$descuento)
    {
        parent::__construct($_SESSION['usuario']['camra']);
        $this->numNota = $numNota;
        $this->numCli = $numCli;
        $this->notaVenta = $notaVenta;
        $this->total = $total;
        $this->limCredito = $limCredito;
        $this->descuento = $descuento;
        $this->usuarioVenta = $_SESSION['usuario']['id'];
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
    /**
     * Get the value of total
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Get the value of limCredito
     */
    public function getLimCredito()
    {
        return $this->limCredito;
    }

    /**
     * Get the value of descuento
     */
    public function getDescuento()
    {
        return $this->descuento;
    }
  /**
     * Get the value of descuento
     */
    public function getusuarioVenta()
    {
        return $this->usuarioVenta;
    }



    
    
    public function deleteFromPedidos(){
       $deletePedido = "CALL confirmVenta('{$this->getNumNota()}', 
                                          '{$this->getNumCli()}', 
                                          '{$this->getNumAnden()}', 
                                          '{$this->getTotal()}',
                                          '{$this->getNotaVenta()}',
                                          '{$this->getLimCredito()}',
                                          '{$this->getDescuento()}',
                                          '{$this->getusuarioVenta()}')";


       $query = $this->db->query($deletePedido);
       $this->close_connection_Databa();
       return $query;
    }


}


