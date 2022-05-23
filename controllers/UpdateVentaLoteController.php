<?php
require_once $_SERVER['DOCUMENT_ROOT']."/sapiProyecto/models/anden/DatosAnden.php";


class UpdateVentaLoteController extends DatosAnden
{
    protected $nota;
    private $idProducto;
    private $lote;
    private $peso;
    private $cliente;
    private $idNotaVendido;
    private $piezas;
   

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

        /**
     * Get the value of idNotaVendido
     */
    public function getIdNotaVendido()
    {
        return $this->idNotaVendido;
    }

    /**
     * Set the value of idNotaVendido
     */
    public function setIdNotaVendido($idNotaVendido)
    {
        $this->idNotaVendido = $idNotaVendido;

        return $this;
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

    public function lotePeso(){
        require_once $_SERVER["DOCUMENT_ROOT"]."/sapiProyecto/models/anden/venta/VentaLotenota.php";
        $lote = (Validacion::validarNumero($this->getLote()) == -1) ? false : $this->getLote() ;
        $peso = (Validacion::validarNumero($this->getPeso()) == -1) ? false : $this->getPeso() ;
        $producto = (Validacion::validarNumero($this->getIdProducto()) == -1) ? false : $this->getIdProducto() ;
        $nota = (Validacion::validarNumero($this->getNota()) == -1) ? false : $this->getNota() ;
        $notaVenta = (Validacion::textoLargo($this->getIdNotaVendido(),15) == 900)?false : $this->getIdNotaVendido();
        $pieza = (Validacion::validarNumero($this->getPiezas()) == -1) ? false : $this->getPiezas();
        

        $verif = array('lote' =>$lote ,'peso' =>$peso ,'producto' =>$producto ,'nota' =>$nota,'notaVenta'=>$notaVenta,'pieza '=>$pieza );
        $validar = Utls::sessionValidate($verif);

        if ($validar > 1) {
            echo '<script>window.location="' . base_url . 'Anden/venta&nota='.$this->getNota().'&cli='.$this->getCliente().'"</script>';
        }else{
            $venta = new VentaLotenota($nota,$producto,$lote,$peso);
            $venta -> setNotaVenta($notaVenta);
            $venta-> setPiezas($pieza);
            $datos = $venta->update();

            if($datos){
                echo 1;
            }else{
                echo 0;
            }
        }
        
        
    }
    

}
