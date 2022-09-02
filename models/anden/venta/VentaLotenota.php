<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/anden/DatosAnden.php';

class VentaLotenota extends DatosAnden
{
    private $nota;
    private $idProducto;
    private $lote;
    private $peso;
    private $idUsuario;
    private $notaVenta;
    private $almacen;
    private $piezas;

    public function __construct($nota,$idProducto,$lote,$peso)
    {
        parent::__construct($nota,$idProducto,$lote,$peso);
        $this->nota=$nota;
        $this->idProducto=$idProducto;
        $this->lote=$lote;
        $this->peso=$peso;
        $this->idUsuario = $_SESSION['usuario']['id'];
        $this->almacen = $_SESSION['usuario']['camra'];
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

    public function getidUsuario(){
        return $this->idUsuario;
    }
    /**
     * Get the value of notaVenta
     */
    public function getNotaVenta()
    {
        return $this->notaVenta;
    }

    /**
     * Set the value of notaVenta
     */
    public function setNotaVenta($notaVenta)
    {
        $this->notaVenta = $notaVenta;

        return $this;
    }

    public function getAlmacen(){
        return $this->almacen;
    }

        /**
     * Get the value of piezas
     */
    public function getPiezas()
    {
        return $this->piezas;
    }

    /**
     * Set the value of piezas
     */
    public function setPiezas($piezas)
    {
        $this->piezas = $piezas;

        return $this;
    }

    public function update(){
/* 
       $update = "CALL updateVentaLote('{$this->getLote()}','{$this->getPeso()}', '{$this->getIdProducto()}', '{$this->getNota()}', '{$this->getNotaVenta()}', '{$this->getPiezas()}', '{$this->getidUsuario()}', '{$this->getAlmacen()}')";

       var_dump($update);
       die();*/
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
