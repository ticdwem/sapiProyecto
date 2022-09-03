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
    /**
     * Set the value of numAnden
     */
    public function setNumAnden($numAnden)
    {
        $this->numAnden = $numAnden;

        return $this;
    }

    public function listas(){
        $datos ='select * from pedidos where idAlmacenPedidos ='.$this->getNumAnden();
        $query = $this->db->query($datos);
        return $query;
    }

    public function inventarioCompleto(){
        $inventario = "SELECT ac.idProductoACentral AS id,pr.idProducto,pr.nombreProducto AS nameP,SUM(ac.cantidadPzACentral) AS total FROM almacencentral ac
                        INNER JOIN producto pr
                        ON ac.idProductoACentral = pr.idProducto
                        GROUP BY (ac.idProductoACentral)
                        ORDER BY ac.idProductoACentral asc";
        $query = $this->db->query($inventario);
        return $query;
    }


    


}
