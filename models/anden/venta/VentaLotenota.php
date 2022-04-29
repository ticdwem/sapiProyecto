<?php
require_once $_SERVER['DOCUMENT_ROOT'].'../models/anden/DatosAnden.php';

class VentaLotenota extends DatosAnden
{
    private $nota;
    private $idProducto;
    private $lote;
    private $peso;

    public function __construct($nota,$idProducto,$lote,$peso)
    {
        parent::__construct($nota,$idProducto,$lote,$peso);
        $this->nota=$nota;
        $this->idProducto=$idProducto;
        $this->lote=$lote;
        $this->peso=$peso;
    }
    /**
     * Get the value of nota
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Get the value of idProducto
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Get the value of lote
     */
    public function getLote()
    {
        return $this->lote;
    }

    /**
     * Get the value of peso
     */
    public function getPeso()
    {
        return $this->peso;
    }
    public function update(){
        $update = "UPDATE pedidos
                            SET                                
                                loteProductoPedido='{$this->getLote()}',
                                pesoProductoPedido='{$this->getPeso()}'
                            WHERE 
                                idProductoPedido='{$this->getIdProducto()}'  AND 
                                idnotaPedido='{$this->getNota()}'";
        $upVenta = $this->db->query($update);
        $pass = false;
        if($upVenta){
            $pass = true;
        }
        return $pass;
    }


}
