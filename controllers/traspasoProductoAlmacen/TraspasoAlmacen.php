<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/anden/traspasoProducto/TraspasoProductoModels.php';
class TraspasoAlmacen
{   
    private $idProducto;
    private $lote;
    private $peso;
    private $piezas;
    private $almacenInicio;
    private $almacenfin;
    
    public function __construct($idProducto,$lote,$peso,$piezas,$almacenInicio,$almacenfin)
    {
        //validamos si extiste a sesison
      if(!isset($_SESSION['usuario'])){Utls::sinSession();}
        $this->idProducto = $idProducto;
        $this->lote = $lote;
        $this->peso = $peso;
        $this->piezas = $piezas;
        $this->almacenInicio = $almacenInicio;
        $this->almacenfin = $almacenfin;
        
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

    public function getAlmacenInicio()
    {
        return $this->almacenInicio;
    }

    public function getAlmacenfin()
    {
        return $this->almacenfin;
    }

    public function traspasoProducto(){
         $idProducto = (Validacion::validarNumero($this->getIdProducto()) == -1 ) ? false : $this->getIdProducto();
         $lote = (Validacion::validarNumero($this->getLote()) == -1 ) ? false : $this->getLote();
         $peso = (Validacion::validarFloat($this->getPeso()) == false ) ? false : $this->getPeso();
         $piezas = (Validacion::validarNumero($this->getPiezas()) == -1 ) ? false : $this->getPiezas();
         $almacenInicio = (Validacion::validarFloat($this->getAlmacenInicio()) == false ) ? false : $this->getAlmacenInicio();
         $almacenfin = (Validacion::validarFloat($this->getAlmacenfin()) == false ) ? false : $this->getAlmacenfin();

         $traspaso = array('id' =>$idProducto ,'lote'=>$lote,'peso'=>$peso,'piezas'=>$piezas,'almacenInicio'=>$almacenInicio,'almacenfin'=>$almacenfin );
         
         $val = Utls::sessionValidate($traspaso);

         if($val > 1){
             echo 0;
         }else{
             $traspaso = new TraspasoProductoModels($almacenInicio,$almacenfin,$idProducto,$lote,$peso,$piezas);
             $traspasoStatus = $traspaso->makeTraspaso();
             if($traspasoStatus){
                echo 1;
             }else{
                echo 0;
             }
         }

    }


}
