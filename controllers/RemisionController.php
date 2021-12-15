<?php
/* mandamos a llamara al modelo de clientes */
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/RemisionModel.php";

class RemisionController{

    public function index(){
      // hacemos consulta para la lista de clientes
      $cliente = new RemisionModel();
     $clientes = $cliente->getAll("cliente");
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
        /* var_dump($cliente);*/
        
        while ($cliente = $datosCliente->fetch_object()) {
          /* var_dump($cliente); */
          
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




}