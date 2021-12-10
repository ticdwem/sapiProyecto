<?php

require_once $_SERVER['DOCUMENT_ROOT']."/config/modeloBase.php";

class ComprasModel extends ModeloBase
{
    private $idUsuer;    
    private $nota;    
    private $fecha;    
    private $proveedor;    
    private $almacen; 
    private $idProducto; 
    private $pzDetalleCompra; 
    private $pesoDetalleCompra; 
    private $loteDetalleCompra; 
    private $precioUnitarioDetalleCompra; 
    private $subtotalDetalleCompra;
   

    /**
     * Get the value of idUsuer
     */ 
    public function getIdUsuer()
    {
        return $this->idUsuer;
    }

    /**
     * Set the value of idUsuer
     *
     * @return  self
     */ 
    public function setIdUsuer($idUsuer)
    {
        $this->idUsuer = $idUsuer;

        return $this;
    }

    /**
     * Get the value of nota
     */ 
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set the value of nota
     *
     * @return  self
     */ 
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of proveedor
     */ 
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set the value of proveedor
     *
     * @return  self
     */ 
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get the value of almacen
     */ 
    public function getAlmacen()
    {
        return $this->almacen;
    }

    /**
     * Set the value of almacen
     *
     * @return  self
     */ 
    public function setAlmacen($almacen)
    {
        $this->almacen = $almacen;

        return $this;
    }

      /**
     * Get the value of idProducto
     */ 
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set the value of idProducto
     *
     * @return  self
     */ 
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get the value of pzDetalleCompra
     */ 
    public function getPzDetalleCompra()
    {
        return $this->pzDetalleCompra;
    }

    /**
     * Set the value of pzDetalleCompra
     *
     * @return  self
     */ 
    public function setPzDetalleCompra($pzDetalleCompra)
    {
        $this->pzDetalleCompra = $pzDetalleCompra;

        return $this;
    }

    /**
     * Get the value of pesoDetalleCompra
     */ 
    public function getPesoDetalleCompra()
    {
        return $this->pesoDetalleCompra;
    }

    /**
     * Set the value of pesoDetalleCompra
     *
     * @return  self
     */ 
    public function setPesoDetalleCompra($pesoDetalleCompra)
    {
        $this->pesoDetalleCompra = $pesoDetalleCompra;

        return $this;
    }

    /**
     * Get the value of loteDetalleCompra
     */ 
    public function getLoteDetalleCompra()
    {
        return $this->loteDetalleCompra;
    }

    /**
     * Set the value of loteDetalleCompra
     *
     * @return  self
     */ 
    public function setLoteDetalleCompra($loteDetalleCompra)
    {
        $this->loteDetalleCompra = $loteDetalleCompra;

        return $this;
    }

    /**
     * Get the value of precioUnitarioDetalleCompra
     */ 
    public function getPrecioUnitarioDetalleCompra()
    {
        return $this->precioUnitarioDetalleCompra;
    }

    /**
     * Set the value of precioUnitarioDetalleCompra
     *
     * @return  self
     */ 
    public function setPrecioUnitarioDetalleCompra($precioUnitarioDetalleCompra)
    {
        $this->precioUnitarioDetalleCompra = $precioUnitarioDetalleCompra;

        return $this;
    }

    /**
     * Get the value of subtotalDetalleCompra
     */ 
    public function getSubtotalDetalleCompra()
    {
        return $this->subtotalDetalleCompra;
    }

    /**
     * Set the value of subtotalDetalleCompra
     *
     * @return  self
     */ 
    public function setSubtotalDetalleCompra($subtotalDetalleCompra)
    {
        $this->subtotalDetalleCompra = $subtotalDetalleCompra;

        return $this;
    }

    public function insertCompras(){
        $query = "INSERT INTO compras
                    (usuario_compra, NumeroDeNotasCompras, FechaCompra,idProveedor)
                VALUES ({$this->getIdUsuer()}, {$this->getNota()}, '{$this->getFecha()}',{$this->getProveedor()})";

$querydb = $this->db->query($query);
$insert = false;
if ($querydb) {
    $insert = true;
}
return $insert;     
}

public function insertDetalleCompras(){
    $query = "CALL insertProducto({$this->getIdProducto()}, {$this->getNota()}, {$this->getPzDetalleCompra()}, '{$this->getPesoDetalleCompra()}', {$this->getLoteDetalleCompra()}, '{$this->getPrecioUnitarioDetalleCompra()}', '{$this->getSubtotalDetalleCompra()}', {$this->getAlmacen()})";
        $querydb = $this->db->query($query);
        $insert = false;
        if ($querydb) {
            $insert = true;
        }
       return $insert;         
    }

  
}