<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/modeloBase.php';

class DeleteProducto extends ModeloBase{
    private int $nota;
    private int $idProducto;


    public function __construct(int $nota = null, int $idProducto = null){
        parent::__construct();
        $this->nota = $nota;
        $this->idProducto = $idProducto;
    }

    /**
     * Get the value of nota
     *
     * @return int
     */
    public function getNota(): int
    {
        return $this->nota;
    }

    /**
     * Get the value of idProducto
     *
     * @return int
     */
    public function getIdProducto(): int
    {
        return $this->idProducto;
    }

    public function eliminarDatos(){
        $query = "DELETE FROM pedidos WHERE idnotaPedido = {$this->getNota()} and idProductoPedido = {$this->getIdProducto()}";
        $eliminar = $this->db->query($query);
        return $eliminar;
    }

}
