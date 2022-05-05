<?php
//include_once '../DatosAnden.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/anden/DatosAnden.php';
class VerifyLoteModels extends DatosAnden
{
    private $idProducto;
    private $idLote;

    public function __construct($anden,$idProducto,$idLote)
    {
        parent::__construct($anden); 
        $this->idProducto = $idProducto;
        $this->idLote = $idLote;  
    } 

    public function getIdLote()
    {
        return $this->idLote;
    }
    public function getIdProducto()
    {
        return $this->idProducto;
    }
    public function verifyLoteProducto(){
        $verif = "SELECT * FROM almacencentral WHERE idProductoACentral = '{$this->getIdProducto()}' 
                    AND loteACentral = '{$this->getIdLote()}' AND almacenACentral = '{$this->getNumAnden()}'";
        $stored = $this->db->query($verif);
        return $stored;
    }

}
