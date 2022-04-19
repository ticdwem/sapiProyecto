<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/config/modeloBase.php';

class DatosAnden extends ModeloBase
{
    protected $numAnden;

    
    public function __construct($numAnden)
    {
        parent::__construct();
        $this->numAnden = $numAnden;
    }

    /**
     * Get the value of numAnden
     */
    public function getNumAnden()
    {
        return $this->numAnden;
    }

    /**
     * Set the value of numAnden
     */
    public function setNumAnden($numAnden): self
    {
        $this->numAnden = $numAnden;

        return $this;
    }/* 

    public function verifyExistence(){
        
    } */



}
