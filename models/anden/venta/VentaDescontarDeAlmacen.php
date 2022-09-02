<?php 

class VentaDescontarDeAlmacen extends DatosAnden
{
    private string $lote;
    private string $peso;
    private string $codigoPRoducto;
    private string $precio;
    private string $piezas;
    public $almacen;

    public function __construct(string $numAnden, string $lote, string $peso,string $codigoPRoducto, string $precio, int $piezas)
    {
        parent::__construct($numAnden);
        $this->lote = $lote;
        $this->peso = $peso;
        $this->codigoPRoducto=$codigoPRoducto;
        $this->precio = $precio;
        $this->piezas = $piezas;
        $this->almacen = ALMACEN[$_SESSION['usuario']['camra']].'-'.$this->getNumAnden();

    }

    public function getLote(): string
    {
        return $this->lote;
    }
    public function getPrecio(): string
    {
        return $this->precio;
    }

    public function getCodigoPRoducto(): string
    {
        return $this->codigoPRoducto;
    }   

    public function getPeso(): string
    {
        return $this->peso;
    }
    public function getPiezas(): string
    {
        return $this->piezas;
    }

    public function updateProductoAlmacen(){
        $update = "CALL updateVentaLote('{$this->getLote()}','{$this->getPeso()}','{$this->getCodigoPRoducto()}','{$this->getPiezas()}','{$this->almacen}')";

        $upVenta = $this->db->query($update);
        $pass = false;
        if($upVenta){
            $pass = true;
        }
        return $pass;
    }


}
