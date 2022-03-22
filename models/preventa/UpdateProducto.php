<?php
require_once 'DatosProductos.php';

class UpdateProducto extends Producto{
    private $piezas;

    public function __construct($piezas = null,$nota = null,$idProducto = null)
    {
        parent::__construct($nota,$idProducto);

        $this->piezas = $piezas;
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

    public function updateDato(){
        $update = "UPDATE pedidos
                        SET
                            pzProductoPedido={$this->getPiezas()}
                        WHERE 	
                            idnotaPedido={$this->getNota()}
                            and
                            idProductoPedido={$this->getIdProducto()}";

         $UpdatePedidoProducto = $this->db->query($update);
         $upPedido = false;
         if($UpdatePedidoProducto){
             $upPedido = true;
         }
         return $upPedido;
    }


}