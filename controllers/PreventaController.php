<?php
/* require_once '/models/preventa/PreventaController.php';
require_once '/models/preventa/deleteProdPreventa.php'; */
require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/models/preventa/PreventaController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/models/preventa/deleteProdPreventa.php";

class PreventaController{
    private $instancia;

    public function __construct(){
        //validamos si extiste a sesison
      if(!isset($_SESSION['usuario'])){Utls::sinSession();}
        $this->instancia = new PreventaModel();

    }

    public function index(){
        require_once ('models/pedidosHistorico/ListarPedidos.php');
        $getController = "Preventa";
        $verPedidosDia = new ListarPedidos(2);
        $pedidos =$verPedidosDia->getPedidosPreventa();
        $anden = md5('Preventa');
        require_once('views/pedidos/listaEditarPedidos.php');
       // require_once 'views/preventa/index.php';
    }


    public function detalle(){
        require_once ('models/PedidoModel.php');
        $detallePEdido = new PedidoModels();
        $datos = $detallePEdido->getAllWhere('clientepedido','WHERE id='.$_GET['cli'])->fetch_object();  // datos de contacto de cliente  
            
        $dom = $detallePEdido->getAllWhere('mostrardatospedido','WHERE clienteId='.$_GET['cli'])->fetch_object(); // datos de domicilio de cliente
        $prodEditar = $detallePEdido->getAllWhere('viewPedidosProducto','WHERE idnotaPedido = '.$_GET['id'])->fetch_all(); // datos de productos
        $almacenes = $detallePEdido->getAll('almacen'); // traer almacenes excepto el almacen 1 que es el default
        $productos = $detallePEdido->getAll('producto');

        $chofer = new PedidoModels();
        $lista = $chofer->listChofer();
        $datosVentaContado = null;
        if($_GET['cli'] == 713 || $_GET["data"] == 'ba9a452d09970c4d31cd8c076bdd593d'){
                $detallePEdido->setIdnotaPedido($_GET['id']);
                $detallePEdido->setIdClientePedido($_GET['cli']);
                $datosVentaContado = $detallePEdido->customerWithoutId()->fetch_object();

                $rutas = $detallePEdido->getAll('ruta');
                $camionetas = $detallePEdido->getAll('camioneta');
               // $chofer = $detallePEdido->getAll('camioneta');
            }
       require_once 'views/pedidos/detalleVenta.php';

       /*  $datos = $this->instancia->getAllWhere('clientepedido','WHERE id='.$_GET['cli'])->fetch_object();  // datos de contacto de cliente      
        $dom = $this->instancia->getAllWhere('mostrardatospedido','WHERE clienteId='.$_GET['cli'])->fetch_object(); // datos de domicilio de cliente
        $prod = $this->instancia->getAllWhere('viewPedidosProducto','WHERE idnotaPedido = '.$_GET['id']); // datos de productos
        $almacenes = $this->instancia->getAllwhere('almacen','WHERE idAlmacen <> 1'); // traer almacenes excepto el almacen 1 que es el default
        require_once 'views/preventa/detalleVenta.php'; */
    }

    public function deleteDatoPedido($datos){
        $datosJso = json_decode($datos,true);
        $dato = $datosJso["data"][0];
        
        $producto = (Validacion::validarNumero($dato["phone_idProd_10"])== -1) ? false :  $dato["phone_idProd_10"];
        $nota = (Validacion::validarNumero($dato["phone_numNota_10"])== -1) ? false :  $dato["phone_numNota_10"];

        $valArray = array('producto'=>$producto , 'nota'=> $nota);
        $dato = Utls::sessionValidate($valArray);
        if($dato > 1){
            echo 0;
        }else{
            $deletePro = new DeleteProducto($nota, $producto );
            $eliminar = $deletePro->eliminarDatos();
           if($eliminar){
               echo 1;
           }else{
               echo 2;
           }
        }
    }

    public function updatePiezas($datos){
        $datosJson = json_decode($datos,true);
        $update = $datosJson["data"][0];
        
        $nota =(Validacion::validarNumero($update["phone_idget_12"])==-1)? false: $update["phone_idget_12"];
        $producto =(Validacion::validarNumero($update["phone_idProducto_12"])==-1)? false: $update["phone_idProducto_12"];
        $piezas = (Validacion::validarNumero($update["phone_piezas_10"])==-1)? false: $update["phone_piezas_10"];
        $presentacion = (Validacion::textoLargo($update["messagge_presentacionModalEdit_500"],500) == 900) ? false : $update["messagge_presentacionModalEdit_500"];
        
        $valArray = array('producto'=>$producto , 'nota'=> $nota,'piezas'=>$piezas,'presentacion'=>$presentacion);
        $dato = Utls::sessionValidate($valArray);
/*         var_dump($valArray);
        die(); */

        if($dato>1){
            echo 0;
        }else{
            $updateDatos = new UpdateProducto( $piezas, $nota,$producto,$presentacion);
            $edit = $updateDatos->updateDato();
            if($edit){
                echo 1;
            }else{
                echo 0;
            }
        }
        /* var_dump($datosJson); */
    }

    public function sendToVentas($datos){
        
    }
    
    public function reportePedidoDetallado(){
        require_once ('models/PedidoModel.php');
        $reporte = new PedidoModels();
        $lista = $reporte->repoteModel();

        require_once('views/pedidos/reportePedidoDetallado.php');
    }
}
