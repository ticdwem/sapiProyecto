<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/models/anden/selectAnden/ConsultaAlmacenModel.php";
//include_once "../../models/anden/selectAnden/ConsultaAlmacenModel.php";
include_once "VerifAlmacenSetGet.php";

class ConsultaAlmacen extends VerifAlmacenSetGet
{
    public function __construct($datos){
        parent::__construct($datos);
        //validamos si extiste a sesison
      if(!isset($_SESSION['usuario'])){Utls::sinSession();}
    }

    public function andenQuery(){
        $idAlmacen = (Validacion::validarNumero($this->getIdAlmacen()) == -1 ) ? false : $this->getIdAlmacen();

        if($idAlmacen == false){
            echo -1;
        }else{
            $where = "WHERE almacen.indiceAlmacen <> ".$this->getIdAlmacen()." AND almacen.indiceAlmacen <> 0";

               $almacen = new ConsultaAlmacenModel();
               $seleccion = $almacen->getAllWhere("almacen",$where);

               $whileJson = array();
               while ($almacenesSelect = $seleccion->fetch_object()) {
                   $data = array(
                       'id' => $almacenesSelect->indiceAlmacen,
                       'name' => $almacenesSelect->nombreAlmacen
                   );
                   array_push($whileJson, $data);
               }
               header('Content-type: application/json; charset=utf-8');
               echo json_encode($whileJson);
               exit();

        }
    }

    public function findProducto(){
        $producto = (Validacion::textoLargo($this->getIdAlmacen()->messagge_inputIdProducto_80,80) == 0) ? false : $this->getIdAlmacen()->messagge_inputIdProducto_80;
        $idAlmacen = (Validacion::validarNumero($this->getIdAlmacen()->phone_selectAlmacen_10) == -1) ? false : $this->getIdAlmacen()->phone_selectAlmacen_10;
        $jsonWhile = array();
        if($producto == false || $idAlmacen == false){
            echo -1;
        }else{
            $buscar = new ConsultaAlmacenModel();
            $buscar->setProducto($producto);
            $buscar->setNumAnden($idAlmacen);
            $founded = $buscar->searchQuery();

            while ($a = $founded->fetch_object()) {
                $data = array(
                    'id'=> $a->idProducto,
                    'nombreProducto'=> $a->nombreProducto,
                    'loteACentral'=> $a->loteACentral,
                    'cantidadPzACentral'=> $a->cantidadPzACentral,
                    'almacenACentral'=>$a->almacenACentral,
                    'pesoACentral' => $a->pesoACentral
                );

                array_push($jsonWhile,$data);
            }
            header('Content-type: application/json; charset=utf-8');
               echo json_encode($jsonWhile);
               exit();
        }

    }
    
}
