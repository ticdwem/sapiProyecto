<?php
require_once $_SERVER['DOCUMENT_ROOT']."/sapiProyecto/models/anden/DatosAnden.php";


class UpdateVentaLoteController extends DatosAnden
{
    protected $nota;
    private $idProducto;
    private $lote;
    private $peso;
    private $cliente;
   

    public function __construct($nota,$idProducto,$lote,$peso)
    {
        parent::__construct();
        $this->nota=$nota;
        $this->idProducto=$idProducto;
        $this->lote=$lote;
        $this->peso=$peso;
        
        

    }
    /**
     * Get the value of nota
     */
    public function getNota()
    {
            return $this->nota;
    }

    /**
     * Get the value of idProducto
     */
    public function getIdProducto()
    {
            return $this->idProducto;
    }

    /**
     * Get the value of lote
     */
    public function getLote()
    {
            return $this->lote;
    }

    /**
     * Get the value of peso
     */
    public function getPeso()
    {
            return $this->peso;
    }

    

    /**
     * Get the value of cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set the value of cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function lotePeso(){
        require_once $_SERVER["DOCUMENT_ROOT"]."/sapiProyecto/models/anden/venta/VentaLotenota.php";
        $lote = (Validacion::validarNumero($this->getLote()) == -1) ? false : $this->getLote() ;
        $peso = (Validacion::validarNumero($this->getPeso()) == -1) ? false : $this->getPeso() ;
        $producto = (Validacion::validarNumero($this->getIdProducto()) == -1) ? false : $this->getIdProducto() ;
        $nota = (Validacion::validarNumero($this->getNota()) == -1) ? false : $this->getNota() ;
        $verif = array('lote' =>$lote ,'peso' =>$peso ,'producto' =>$producto ,'nota' =>$nota);

        $validar = Utls::sessionValidate($verif);
        if ($validar > 1) {
            echo '<script>window.location="' . base_url . 'Anden/venta&nota='.$this->getNota().'&cli='.$this->getCliente().'"</script>';
        }else{
            $venta = new VentaLotenota($nota,$producto,$lote,$peso);
            $datos = $venta->update();

            if($datos){
                echo 1;
            }else{
                echo 0;
            }
        }
        
        
    }
    
}
