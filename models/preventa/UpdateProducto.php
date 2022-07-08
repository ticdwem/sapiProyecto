<?php
require_once 'DatosProductos.php';

class UpdateProducto extends Producto{
    private $piezas;
    private $almacen;
    private $presentacion;

    public function __construct($piezas = null,$nota = null,$idProducto = null,$presentacion = null)
    {
        parent::__construct($nota,$idProducto);

        $this->piezas = $piezas;
        $this->presentacion = $presentacion;
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
    public function setPiezas($piezas): self
    {
        $this->piezas = $piezas;

        return $this;
    }

    /**
     * Get the value of almacen
     */
    public function getAlmacen()
    {
        return $this->almacen;
    }

    /**
     * Set the value of almacen
     */
    public function setAlmacen($almacen): self
    {
        $this->almacen = $almacen;

        return $this;
    }

        /**
     * Get the value of presentacion
     */
    public function getPresentacion()
    {
        return $this->presentacion;
    }

    /**
     * Set the value of presentacion
     */
    public function setPresentacion($presentacion): self
    {
        $this->presentacion = $presentacion;

        return $this;
    }

    public function updateDato(){
        $update = "UPDATE pedidos
                        SET
                            pzProductoPedido={$this->getPiezas()},
                            detalleEntrega = '{$this->getPresentacion()}'
                        WHERE 	
                            idnotaPedido={$this->getNota()}
                            and
                            idProductoPedido={$this->getIdProducto()}";
/* var_dump($update);
die(); */
         $UpdatePedidoProducto = $this->db->query($update);
         $upPedido = false;
         if($UpdatePedidoProducto){
             $upPedido = true;
         }
         return $upPedido;
    }

    public function passToVenta(){
        $update = "UPDATE pedidos
                    SET
                        statusProductoPedido='2',
                        idAlmacenPedidos='{$this->getAlmacen()}'
                    WHERE 
                        idnotaPedido='{$this->getNota()}'";
        $ventasUp = $this->db->query($update);
        $venta = false;
        if($ventasUp){
            $venta = true;
        }
        return $venta;
    }

    






}