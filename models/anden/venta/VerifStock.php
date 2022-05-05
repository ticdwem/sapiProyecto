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
        $stored = $this->db->query($verif);
        return $stored;
    }
}
