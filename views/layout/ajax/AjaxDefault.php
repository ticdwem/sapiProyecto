<?php
require '../../../config/requireoncedefault.php';

class AjaxDefault{
    protected $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
        
    }

    /**
     * Get the value of datos
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * Set the value of datos
     */
    public function setDatos($datos)
    {
        $this->datos = $datos;

        return $this;
    }

    public function sendToController(){
        return 0;
    }
    
}