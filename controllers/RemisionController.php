<?php
/* mandamos a llamara al modelo de clientes */
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/RemisionModel.php";

class RemisionController{

    public function index(){
      // hacemos consulta para la lista de clientes
      $cliente = new RemisionModel();
      $clientes = $cliente->getAll("cliente");

      $alm = new RemisionModel();        
      $almacenes = $alm->getAll('almacen');
    
      $lista = new RemisionModel();
      $listaProducto = $lista->getAll('producto');

      require_once "views/remisiones/index.php";
    }

    public function clienteVenta($tabla1,$tabla2,$id){
      $returnJson = [];
      $id = (Validacion::validarNumero($id) == -1) ? false : $id ;
      $tb1 = (Validacion::textoLargo($tabla1,30) == 900) ? false : $tabla1;
      $tb2 = (Validacion::textoLargo($tabla2,30) == 900) ? false : $tabla2;

      $validar = array('id'=>$id,'tbl1'=> $tb1,'$tb2'=>$tb2);
    
      $val = Utls::sessionValidate($validar);

      if($val > 1){
        echo '<script>window.location="' . base_url . 'Remision/index"</script>';
      }else{
        $cliente = new RemisionModel();
        $cliente->setId($id);
        $cliente->setTable1($tb1);
        $cliente->setTable2($tb2);
        $datosCliente = $cliente->findCustomerAll(); 
        
        while ($cliente = $datosCliente->fetch_object()) {
          
            $idDomicilioCliente = $cliente->idDomicilioCliente;
            $clienteId = $cliente->clienteId;
            $rutaId = $cliente->rutaId;
            $calleDomicilioCliente = $cliente->calleDomicilioCliente;
            $numeroDomicilioCliente = $cliente->numeroDomicilioCliente;
            $estados_municipios_id = $cliente->estados_municipios_id;
            $cpDomicilioCliente = $cliente->cpDomicilioCliente;
            $coloniaDomicilioCliente = $cliente->coloniaDomicilioCliente;
            $idEstado = $cliente->idEstado;
            $estado = $cliente->estado;
            $municipio = $cliente->municipio;
            $nombreRuta = $cliente->nombreRuta;
            $idCliente = $cliente->idCliente;
            $nombreCliente = $cliente->nombreCliente;
            $rfcCliente = $cliente->rfcCliente;
            $descuentoCliente = $cliente->descuentoCliente;
            $limiteCreditoCliente = $cliente->limiteCreditoCliente;
            $saldoCreditoCliente = $cliente->saldoCreditoCliente;
            $statusSietema = $cliente->statusSietema;
            $NunCuentaCliente = $cliente->NunCuentaCliente;

            $returnJson[] = array(
              'idDomicilioCliente'=>$idDomicilioCliente,
              'clienteId'=>$clienteId,
              'rutaId'=>$rutaId,
              'calleDomicilioCliente'=>$calleDomicilioCliente,
              'numeroDomicilioCliente'=>$numeroDomicilioCliente,
              'estados_municipios_id'=>$estados_municipios_id,
              'cpDomicilioCliente'=>$cpDomicilioCliente,
              'coloniaDomicilioCliente'=>$coloniaDomicilioCliente,
              'idEstado'=>$idEstado,
              'estado'=>$estado,
              'municipio'=>$municipio,
              'nombreRuta'=>$nombreRuta,
              'idCliente'=>$idCliente,
              'nombreCliente'=>$nombreCliente,
              'rfcCliente'=>$rfcCliente,
              'descuentoCliente'=>$descuentoCliente,
              'limiteCreditoCliente'=>$limiteCreditoCliente,
              'saldoCreditoCliente'=>$saldoCreditoCliente,
              'statusSietema'=>$statusSietema,
              'NunCuentaCliente'=>$NunCuentaCliente
            );
         
        }
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($returnJson, JSON_FORCE_OBJECT);
        exit();
      }
      
    }

    public function getProductoVenta($id,$tabla){
      $returnJson = [];
      $id = (Validacion::validarNumero($id) == -1) ? false : $id ;
      $tb1 = (Validacion::textoLargo($tabla,30) == 900) ? false : $tabla;

      $validar = array('id'=>$id,'tbl1'=> $tb1);
    
      $val = Utls::sessionValidate($validar);
      if($val > 1){
        echo '<script>window.location="' . base_url . 'Remision/index"</script>';
      }else{
        $where = 'WHERE idProductoACentral ='.$id;
        $producto = new RemisionModel();
        $getPrd = $producto->getAllWhere($tb1,$where);
        var_dump($getPrd);
die();
        while ($producto = $getPrd->fetch_object()) {
          
          ["idACentral"]=>
          string(1) "3"
          ["idProductoACentral"]=>
          string(1) "2"
          ["loteACentral"]=>
          string(4) "1258"
          ["pesoACentral"]=>
          string(7) "177.810"
          ["cantidadPzACentral"]=>
          string(3) "350"
          ["almacenACentral"]=>
          string(1) "3"
          ["fechaACentral"]=>
          string(10) "2021-12-10"
          ["precioTotal"]=>
          string(7) "1515.97"
          ["idProducto"]=>
          string(1) "2"
          ["nombreProducto"]=>
          string(6) "HARINA"
          ["DescripcionProducto"]=>
          string(6) "HARINA"
          ["precioProductoUnidad"]=>
          string(5) "12.70"
          ["UnidadMedidaProducto"]=>
          string(2) "KG"
          ["fechaIngreso"]=>
          string(10) "2021-11-22"
          ["statusProducto"]=>
          string(1) "1"
          $idACentral = $producto->idACentral;
          $idProductoACentral = $producto->idProductoACentral;
          $loteACentral = $producto->loteACentral;
          $pesoACentral = $producto->pesoACentral;
          $cantidadPzACentral = $producto->cantidadPzACentral;
          $almacenACentral = $producto->almacenACentral;
          $fechaACentral = $producto->fechaACentral;
          $precioTotal = $producto->precioTotal;
          $idProducto = $producto->idProducto;
          $nombreProducto = $producto->nombreProducto;
          $DescripcionProducto = $producto->DescripcionProducto;
          $precioProductoUnidad = $producto->precioProductoUnidad;
          $UnidadMedidaProducto = $producto->UnidadMedidaProducto;
          $fechaIngreso = $producto->fechaIngreso;
          $statusProducto = $producto->statusProducto;

          $returnJson[] = array(
            'idRow'=>$idACentral,
            'idProducto'=>$idProductoACentral,
            'lote'=>$loteACentral,
            'pesoTotal'=>$pesoACentral,
            'PzExistente'=>$cantidadPzACentral,
            'almacenSale'=>$almacenACentral,
            'fechaAlta'=>$fechaACentral,
            'precioTotalContado'=>$precioTotal,
            'idPRoducto'=>$idProducto,
            'estado'=>$nombreProducto,
            'municipio'=>$DescripcionProducto,
            'nombreRuta'=>$precioProductoUnidad,
            'idCliente'=>$UnidadMedidaProducto,
            'nombreCliente'=>$fechaIngreso,
            'rfcCliente'=>$statusProducto
          );
       
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($returnJson, JSON_FORCE_OBJECT);
      exit();

      }
    }




}