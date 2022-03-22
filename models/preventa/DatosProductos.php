<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/config/modeloBase.php';

class Producto extends ModeloBase{
    protected $nota;
    protected $idProducto;


    public function __construct($nota = null,$idProducto = null){
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
     * Set the value of nota
     *
     * @param int $nota
     *
     * @return self
     */
    public function setNota(int $nota): self
    {
        $this->nota = $nota;

        return $this;
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


    /**
     * Set the value of idProducto
     *
     * @param int $idProducto
     *
     * @return self
     */
    public function setIdProducto(int $idProducto): self
    {
        $this->idProducto = $idProducto;

        return $this;
    }
}