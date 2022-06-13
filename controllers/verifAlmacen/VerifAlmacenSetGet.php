<?php

class VerifAlmacenSetGet
{
    protected $idAlmacen;

    public function __construct($idAlmacen)
    {
        //validamos si extiste a sesison
      if(!isset($_SESSION['usuario'])){Utls::sinSession();}
        $this->idAlmacen = $idAlmacen;
        
    }

    /**
     * Get the value of idAlmacen
     */
    public function getIdAlmacen()
    {
        return $this->idAlmacen;
    }

    /**
     * Set the value of idAlmacen
     */
    public function setIdAlmacen($idAlmacen)
    {
        $this->idAlmacen = $idAlmacen;

        return $this;
    }
}
