<?php
require_once('DatosAnden.php');

class CountNotaVenta extends DatosAnden{

    private string $date;

    public function __construct(int $ruta, string $date){
        parent::__construct($ruta);
        $this->date = $date;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function conteoNotas(){
        $notas = "SELECT COUNT(idNotaPedido) as contar FROM notapedido WHERE rutaNotaPEdido = '{$this->getNumAnden()}' AND fechaEnregaNotaPedido = '{$this->getDate()}'";
        $query = $this->db->query($notas);
        return $query;
    }
}