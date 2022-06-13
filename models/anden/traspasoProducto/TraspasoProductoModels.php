<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/anden/DatosAnden.php';

class TraspasoProductoModels extends DatosAnden 
{

    private $andenFin;
    private $idProducto;
    private $lote;
    private $peso;
    private $piezas;

    
    public function __construct($andenInicio,$andenFin,$idProducto,$lote,$peso,$piezas)
    {
        parent::__construct($andenInicio);
        $this->andenFin = $andenFin;
        $this->idProducto = $idProducto;
        
    }
    

    public function getAndenFin()
    {
        return $this->andenFin;
    }
    public function getIdProducto()
    {
        return $this->idProducto;
    }
    public function getLote()
    {
        return $this->lote;
    }
    public function getPeso()
    {
        return $this->peso;
    }
    public function getPiezas()
    {
        return $this->piezas;
    }

    public function makeTraspaso(){
        $cambio = "CALL CambioDeAlmacen('{$this->getNumAnden()}', '{$this->getAndenFin()}', '{$this->getPiezas()}', '{$this->getPeso()}', '{$this->getLote()}', '{$this->getIdProducto()}')";
        $query = $this->db->query($cambio);
        return $query;

    }
}
