<?php
require_once 'models/anden/DatosAnden.php';

class ClienteVenta extends DatosAnden
{
    private $idCliente;

    public function __construct($idCliente)
    {
        $cliente = Validacion::validarNumero($idCliente) ;
        if($cliente == -1){
            echo "error";
            return;
        }
        $this->idCliente = $idCliente;
    }  

    /**
     * Set the value of idCliente
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function selectCliente(){
       $conection = new ModeloBase();
       $prCentas = $conection->getAllWhere('clientepedido','WHERE id ='.$this->getIdCliente());
        return $prCentas;        
    }
    
    public function selectDatosPedidos(){
        $conexion = new ModeloBase();
        $dom = $conexion->getAllWhere('mostrardatospedido','WHERE clienteId='.$this->getIdCliente());
        return $dom;
    }
}



