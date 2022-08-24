<?php
require_once 'models/anden/DatosAnden.php';

class VentaModel extends DatosAnden
{
    private $numNota;

    public function __construct($numAnden,$numNota = 0)
    {
        parent::__construct($numAnden);
        $nota = Validacion::validarNumero($numNota) ;
        if($nota == -1){
            echo "error";
            return;
        }
        $this->numNota = $numNota;
    }  

    /**
     * Get the value of numNota
     */
    public function getNumNota()
    {
        return $this->numNota;
    }

    public function selectNotaVenta(){
       $conection = new DatosAnden($this->getNumAnden());
   /*     $prCentas = $conection->getAllWhere('viewpedidosproducto','WHERE idnotaPedido ='.$this->getNumNota().' AND almacen = '.$this->getNumAnden()); */
       $prCentas = $conection->getAllWhere('viewpedidosproducto','WHERE idnotaPedido ='.$this->getNumNota());
       
       return $prCentas;
    }

}
