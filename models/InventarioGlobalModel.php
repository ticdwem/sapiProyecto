<?php
require_once('models/anden/DatosAnden.php');

class InventarioGlobalModel extends DatosAnden
{
    private $idProducto;
    public function __construct(int $almacen = null, $idProducto = null)
    {
        parent::__construct($almacen);
        $this->idProducto = $idProducto;
        
    }
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function inventarioAnden(){
        $prod = "SELECT ac.*,pr.nombreProducto FROM almacencentral ac
                INNER JOIN producto pr
                ON ac.idProductoACentral = pr.idProducto
                WHERE ac.idProductoACentral = '{$this->getIdProducto()}'";
        $query = $this->db->query($prod);
        return $query;
    }

    public function inventarIndiceioAnden(){
        $prod = "SELECT ac.*,pr.nombreProducto FROM almacencentral ac
                INNER JOIN producto pr
                ON ac.idProductoACentral = pr.idProducto
                WHERE ac.almacenACentral = '{$this->getNumAnden()}'
                ORDER BY ac.idProductoACentral ASC
";
        $query = $this->db->query($prod);
        return $query;
    }
}
