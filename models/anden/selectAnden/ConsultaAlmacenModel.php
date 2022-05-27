<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/anden/DatosAnden.php';

class ConsultaAlmacenModel extends DatosAnden
{
    private $producto;   
    
    public function getProducto()
    {
        return $this->producto;
    }

    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }

 
    public function searchQuery(){
        $queryProducto =  " SELECT * FROM almacenCentralProducto acp WHERE  acp.almacenACentral = ".$this->getNumAnden()." AND acp.idProducto LIKE '%".$this->getProducto()."%'";

        $query = $this->db->query($queryProducto);
        return $query;
    }
}
