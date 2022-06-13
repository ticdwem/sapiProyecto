<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sapiProyecto/models/anden/venta/VerifStock.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sapiProyecto/models/anden/venta/VerifyLoteModels.php";
//require_once "../../models/anden/venta/VerifStock.php";

class verificarStock
{
    private $jsonStock;
    private $array = [];
    private $almacen;

    public function __construct($jsonStock,$almacen)
    {
        //validamos si extiste a sesison
      if(!isset($_SESSION['usuario'])){Utls::sinSession();}
       $this->jsonStock = $jsonStock;
       $this->almacen = $almacen;
    }   
    public function getJsonStock()
    {
        return $this->jsonStock;
    }
    public function getAlmacen()
    {
        return $this->almacen;
    }

    public function checkDatos(){
        $contarProducto = -1;
        $id = (Validacion::validarNumero($this->getJsonStock()->id_producto) == -1) ? false : $this->getJsonStock()->id_producto;
        $pz = (Validacion::validarNumero($this->getJsonStock()->piezas) == -1)? false : $this->getJsonStock()->piezas;

        if($id == false || $pz == false){
            $_SESSION['formulario_cliente'] = array(
                'error' => 'Hay errores en los campos verifica de nuevo'
            );
        }else{
            $stock = new VerifStock($this->getAlmacen(),$id,$pz);
            $datos = $stock->getSTockPRoducto()->fetch_row();
            if($datos[0] != -1){
                $contarProducto = 1;
            }else{
                $contarProducto = 0;
            }
            $array = array('canPz'=>$datos[0],'statusModal'=>$contarProducto);            
         }

         header('Content-type: application/json; charset=utf-8');
         echo json_encode($array, JSON_FORCE_OBJECT);
         exit();
    }

    public function checkLote(){
        $idProducto = (Validacion::validarNumero($this->getJsonStock()->phone_idProductoModal_25) == -1) ? false : $this->getJsonStock()->phone_idProductoModal_25;
        $lote = (Validacion::validarNumero($this->getJsonStock()->phone_loteVentaModal_50) == -1) ? false : $this->getJsonStock()->phone_loteVentaModal_50;
        if($idProducto == false || $lote == false){
            $_SESSION['formulario_cliente'] = array(
                'error' => 'Hay errores en los campos verifica de nuevo'
            );
        }else{
            $lote = new VerifyLoteModels($this->getAlmacen(),$idProducto,$lote);
            $lVerify = $lote->verifyLoteProducto()->fetch_row();
            if($lVerify >= 1){
                echo 1;
            }else{
                echo 0;
            }
            
        }
    }


}
