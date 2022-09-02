<?php
//include_once '../DatosAnden.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/anden/DatosAnden.php';
class VerifStock extends DatosAnden
{
    private $idProducto;
    private $pzrequired;

    public function __construct($anden,$idProducto,$pzrequired)
    {
        parent::__construct($anden);  
        $this->idProducto = $idProducto; 
        $this->pzrequired = $pzrequired; 
    }
    /**
     * Get the value of idProducto
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Get the value of pzrequired
     */
    public function getPzrequired()
    {
        return $this->pzrequired;
    }

    public function getSTockPRoducto(){
        $verif = "CALL stockPRduct('{$this->getIdProducto()}', '{$this->getNumAnden()}', '{$this->getPzrequired()}')";

        $stored = $this->db->query($verif)->fetch_row();
        return $stored;
    }

    public function allLotes(){
        $lotes = "SELECT ac.cantidadPzACentral,ac.loteACentral,ac.fechaACentral  FROM almacencentral ac WHERE ac.idProductoACentral = '{$this->getIdProducto()}' AND ac.almacenACentral = '{$this->getNumAnden()}'";

        $lotesDatos = $this->db->query($lotes);
        return $lotesDatos;
    }
}
