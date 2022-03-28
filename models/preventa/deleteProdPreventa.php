<?php 
require_once 'DatosProductos.php';
class DeleteProducto extends Producto{

    public function __construct( $nota,$idProducto){
        parent::__construct( $nota,  $idProducto);
    }

    public function eliminarDatos(){
        $query = "DELETE FROM pedidos WHERE idnotaPedido = {$this->getNota()} and idProductoPedido = {$this->getIdProducto()}";
        $eliminar = $this->db->query($query);
        return $eliminar;
    }

}
