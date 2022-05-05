<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/config/modeloBase.php';

class DatosAnden extends ModeloBase
{
    protected $numAnden;

    
    public function __construct($numAnden=null)
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

    public function listas(){
        $datos ='select * from pedidos where idAlmacenPedidos ='.$this->getNumAnden();
        $query = $this->db->query($datos);
        return $query;
    }


    
}
