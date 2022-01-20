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
      $listaProducto = $lista->distinctQuery('idProducto,nombreProducto,loteACentral,fechaACentral,SUM(cantidadPzACentral) as suma',
                                             'productoalmacencentral',
                                             'WHERE almacenACentral = 3 GROUP BY idProducto ORDER BY fechaACentral asc');

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
        
        while ($producto = $getPrd->fetch_object()) {
          
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
            'nombreProd'=>$nombreProducto,
            'descripcion'=>$DescripcionProducto,
            'precioXunidad'=>$precioProductoUnidad,
            'unidadMedida'=>$UnidadMedidaProducto,
            'fechaIngreso'=>$fechaIngreso,
            'status'=>$statusProducto
          );
       
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($returnJson, JSON_FORCE_OBJECT);
      exit();

      }
    }

    public function getProductoAlmacen($idAlmacen,$busqueda){
      $returnJson = [];
      switch ($busqueda) {
        case '0':
          $id = (Validacion::validarNumero($idAlmacen) == -1 ) ? false : $idAlmacen; 
          if($id == false){ 
            $_SESSION['formulario_cliente'] = array(
              'error' => 'El dato enviado es incorrecto',
              'datos' => $id
            );
            echo '<script>window.location="' . base_url . 'Remision/index"</script>';
          }else{
            $producto = new RemisionModel();
            $producto->setId($id);
            $getPrd = $producto->findProductsALmacen();
            while ($prod = $getPrd->fetch_object()) {
              $returnJson[] = array(
                'id'=>$prod->idProducto,
                'nombre'=>$prod->nombreProducto,
                'lote'=>$prod->loteACentral,
                'fecha'=>$prod->fechaACentral,
                'sumapz'=>$prod->sumapz,
                'sumaPeso'=>$prod->sumapeso,
                'precio'=>$prod->pUnidad
              );
            }
            /*var_dump($returnJson); */
             header('Content-type: application/json; charset=utf-8');
            echo json_encode($returnJson, JSON_FORCE_OBJECT);
            exit();
  
          }
          break;
        case '1':
          $datos = json_decode($idAlmacen,true);
          $idProducto = (Validacion::validarNumero($datos["data"][0]["phone_inputCodigoVenta_10"])==-1) ? false : $datos["data"][0]["phone_inputCodigoVenta_10"] ;
          $Almacen = (Validacion::validarNumero($datos["data"][0]["phone_selectAlmacenVenta_4"])==-1) ? false : $datos["data"][0]["phone_selectAlmacenVenta_4"] ;
          $datosVAlidar = array('producto' => $idProducto,'almacen' => $Almacen);  

          
          $validar = Utls::sessionValidate($datosVAlidar);
          if($validar > 1){
            echo '<script>window.location="' . base_url . 'Remision/index"</script>';
          }else{
            $lotes = new RemisionModel();
            $lotes->setId($idProducto);
            $resultado = $lotes->prodAlmacen($Almacen);
            while ($dato = $resultado->fetch_object()) {
              $returnJson[] = array(
                'id'=>$dato->idProductoACentral,
                'lote'=>$dato->loteACentral,
                'sumaPeso'=>$dato->pesoACentral,
                'sumapz'=>$dato->cantidadPzACentral,
                'fecha'=>$dato->fechaACentral,
                'nombre'=>$dato->nombreProducto,
                'precioUnitario'=>$dato->precioProductoUnidad
              );
            }
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($returnJson, JSON_FORCE_OBJECT);
            exit();
          }
          break;
        
        default:
          # code...
          break;
      }     
        
    
    }

    public function piezaPeso($datos){
      $returnPz = [];
      $datos = json_decode($datos,true);
      $total = (Validacion::validarNumero($datos["data"][0]["phone_inputPiezaVenta_10"])==-1) ? false : $datos["data"][0]["phone_inputPiezaVenta_10"] ;
      $lote = (Validacion::validarNumero($datos["data"][0]["phone_inputLoteVenta_15"])==-1) ? false : $datos["data"][0]["phone_inputLoteVenta_15"] ;
      $datosVAlidar = array('pz' => $total,'lote' => $lote);  
      
      
      $validar = Utls::sessionValidate($datosVAlidar);
      if($validar > 1){
        echo '<script>window.location="' . base_url . 'Remision/index"</script>';
      }else{
        $datpsPz = new RemisionModel();
        $datpsPz->setId($total);
        $datpsPz->setlote($lote);
        $result = $datpsPz->getDatosPzPeso();
        $completo = $result->fetch_object();
        if($total > $completo->cantidadPzACentral ){
          $returnPz[] = array(
            'id'=>1,
            'lote'=>0,
            'sumaPeso'=>0,
            'sumapz'=>0
          );
        }elseif($total == $completo->cantidadPzACentral){
          $returnPz[] = array(
            'id'=>2,
            'lote'=>$completo->loteACentral,
            'sumaPeso'=>$completo->pesoACentral,
            'sumapz'=>$completo->cantidadPzACentral
          );
        }else{
          $returnPz[] = array(
            'id'=>0,
            'lote'=>$completo->loteACentral,
            'sumaPeso'=>$completo->pesoACentral,
            'sumapz'=>$completo->cantidadPzACentral
          );
        }
        header('Content-type: application/json; charset=utf-8');
            echo json_encode($returnPz, JSON_FORCE_OBJECT);
            exit();
      }
    }




}