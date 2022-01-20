<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/modeloBase.php";

class RemisionModel extends ModeloBase {
    
    // creamos una funcion para hacer la consulta de los datos del cliente
    private $id;
    private $table1;
    private $table2;
    private $lote;


    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function gettable1(){
        return $this->table1;
    }
    public function setTable1($tabla){
        $this->table1 = $tabla;

        return $this;
    }

    public function gettable2(){
        return $this->table2;
    }

    public function setTable2($tabla2){
        $this->table2 = $tabla2;

        return $this;
    }

    public function getLote()
    {
        return $this->lote;
    }

    public function setLote($lote): self
    {
        $this->lote = $lote;

        return $this;
    }

    public function findCustomerAll(){
       $query = "SELECT * from {$this->gettable1()} 
                INNER JOIN {$this->gettable2()} 
                ON clienteId = idCliente
                WHERE clienteId = {$this->getId()}";
       $queryselect = $this->db->query($query);

       return $queryselect;
            
    }

    public function findProductsALmacen(){
        $query = "SELECT DISTINCT 
                        idProducto,nombreProducto,SUM(pesoACentral) as sumapeso,loteACentral,fechaACentral,SUM(cantidadPzACentral) as sumapz,precioProductoUnidad AS pUnidad
                        FROM productoalmacencentral 
                        WHERE almacenACentral = {$this->getId()}
                        GROUP BY idProducto ORDER BY fechaACentral asc";
        $showAlamcen = $this->db->query($query);

        return $showAlamcen;
    }

    public function prodAlmacen($almacen){
        $query = "SELECT * FROM productoalmacencentral pc WHERE pc.idProducto = {$this->getId()} AND pc.almacenACentral = $almacen";
        $lotes = $this->db->query($query);
        return $lotes;
    }  

    public function getDatosPzPeso(){
        $query = "SELECT * FROM productoalmacencentral pc WHERE pc.loteACentral = {$this->getlote()}";
        $result = $this->db->query($query);
        return $result;
    }

  
}