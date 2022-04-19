<?php
require_once 'DatosAnden.php';

class verifyExistence extends DatosAnden
{
    protected $productosNotas;
    protected $productosanden;

   public function __construct()
   {
       $this->productosNotas = Array();
       $this->productosanden = Array();
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

    
}
