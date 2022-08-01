<?php

class UpdateToVentaModel extends ModeloBase{

    private int $nota;
    private int $ruta;

    public function __construct(int $ruta, int $nota)
    {
        parent::__construct();
        $this->nota = $nota;
        $this->ruta = $ruta;
        
    }

    public function getNota(){
        return $this->nota;
    }
    
    public function getRuta(){
        return $this->ruta;
    }
   
    public function vena(){
       $venta = "UPDATE notapedido SET statusNotaPEdido='3' WHERE  idNotaPedido='{$this->getNota()}' and rutaNotaPEdido = '{$this->getRuta()}'";
       $query = $this->db->query($venta);

       $pass = false;
       if($query){
           $pass = true;
       }
       return $pass;
    }
}