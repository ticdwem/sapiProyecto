<?php
require_once 'DatosAnden.php';

class GetProdutos extends DatosAnden
{

   public function __construct()
   {
       parent::__construct($_SESSION['usuario']['camra']);
   }
    

    /**
     * Get the value of productosNotas
     */
    public function getProductosNotas()
    {
        return $this->productosNotas;
    }

    /**
     * Set the value of productosNotas
     */
    public function setProductosNotas($productosNotas): self
    {
        $this->productosNotas = $productosNotas;

        return $this;
    }

    /**
     * Get the value of productosanden
     */
    public function getProductosanden()
    {
        return $this->productosanden;
    }

    /**
     * Set the value of productosanden
     */
    public function setProductosanden($productosanden): self
    {
        $this->productosanden = $productosanden;

        return $this;
    }

    public function listas(){
        $datos ='SELECT SUM(pzProductoPedido)AS suma,pedidoscliente.* FROM pedidoscliente WHERE idAlmacenPedidos ='.$this->getNumAnden().' GROUP BY idnotaPedido';      
        $query = $this->db->query($datos);
        return $query;
    }

    public function rutasAsignadas(){
        $andenRuta = "SELECT * FROM RutaAsignadaANden raa WHERE raa.idAlmacen = '{$this->getNumAnden()}'";
        $query = $this->db->query($andenRuta);
        return $query;
    }
   
}
