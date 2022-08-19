<?php
/* require_once '/models/preventa/PreventaController.php';
require_once '/models/preventa/deleteProdPreventa.php'; */
require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/models/preventa/PreventaModel.php";
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
        $almacenes = $detallePEdido->getAll('almacen'); // traer almacenes
        $productos = $detallePEdido->getAll('producto');

        $chofer = new PedidoModels();
        $lista = $chofer->listChofer();
        $datosVentaContado = null;
        if($_GET['cli'] == 713 && $_GET["data"] == 'ba9a452d09970c4d31cd8c076bdd593d'){
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

    public function rutas(){

        $fecha = Utls::sumDays(1);
        $rutas = $this->instancia->getAll('ruta');
        require_once('views/preventa/listarutas.php');
    }

    public function asignarnextDay(){
        require_once "models/preventa/PreventaTrasporteModel.php";
        $rutaGet = 0;
        if(isset($_GET['ruta'])){$rutaGet = $_GET['ruta'];}
        $sinAssign = new PreventaTrasporteModel($rutaGet,0,Utls::sumDays(1));
        $carros = $sinAssign->getAllNoAssigned();

        $chofer = new PreventaTrasporteModel(0,0,Utls::sumDays(1));
        $chofSA = $chofer->getAllNoAssignedChofer();

        $asinados = $this->instancia->getStoredProcedure(Utls::sumDays(1), $rutaGet);

        $asinadoEditar = new PreventaTrasporteModel(0,0,Utls::sumDays(1));
        $sinAsignar = $asinadoEditar->getAllNoAssignedChofer();
        require_once('views/preventa/asignarRutaCamionetaNextDay.php');
    }

    public function asignar(){
        require_once "models/preventa/PreventaTrasporteModel.php";
        $rutaGet = 0;
        if(isset($_GET['ruta'])){$rutaGet = $_GET['ruta'];}
        $sinAssign = new PreventaTrasporteModel($rutaGet,0,Utls::sumDays(0));
        $carros = $sinAssign->getAllNoAssigned();

        $chofer = new PreventaTrasporteModel(0,0,Utls::sumDays(0));
        $chofSA = $chofer->getAllNoAssignedChofer();

        $asinados = $this->instancia->getStoredProcedure(Utls::sumDays(0), $rutaGet);

        $asinadoEditar = new PreventaTrasporteModel(0,0,Utls::sumDays(0));
        $sinAsignar = $asinadoEditar->getAllNoAssignedChofer();
        require_once('views/preventa/asignarRutaCamioneta.php');
    }

    public function createRuta(){
        require_once "models/preventa/PreventaTrasporteModel.php";

        $idRuta = (Validacion::validarNumero($_POST['idRutaCamioneta']) == -1) ? false : $_POST['idRutaCamioneta'];
        $idCamioneta = (Validacion::textoLargo($_POST['idCamionetaAssign'],5) == -1) ? false : $_POST['idCamionetaAssign'];
        $idChofer = (Validacion::validarNumero($_POST['idChoferSelect']) == -1) ? false : $_POST['idChoferSelect'];

        $validar = array("ruta"=>$idRuta,"carro"=>$idCamioneta,"chofer"=>$idChofer);

        $val = Utls::sessionValidate($validar);

        if($val > 1){
            echo '<script>window.location="' . base_url . 'Preventa/asignar&ruta='.$_POST['idRutaCamioneta'].'&name='.$_POST['namert'].'"</script>';
        }else{
            $inserta = new PreventaTrasporteModel($idRuta,$idCamioneta,Utls::sumDays(0));
            $inserta->setIdChofer($idChofer);
            $dato = $inserta->insertRutaCamioneta();
            if($dato){
                echo '<script>window.location="' . base_url . 'Preventa/asignar&ruta='.$_POST['idRutaCamioneta'].'&name='.$_POST['namert'].'"</script>';
            }else{
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'No se inserto el Registro',
                    'datos' => $validar
                );
                echo '<script>window.location="' . base_url . 'Preventa/asignar&ruta='.$_POST['idRutaCamioneta'].'&name='.$_POST['namert'].'"</script>';
            }
        }
    }
    public function createRutaNd(){
        require_once "models/preventa/PreventaTrasporteModel.php";

        $idRuta = (Validacion::validarNumero($_POST['idRutaCamioneta']) == -1) ? false : $_POST['idRutaCamioneta'];
        $idCamioneta = (Validacion::textoLargo($_POST['idCamionetaAssign'],5) == -1) ? false : $_POST['idCamionetaAssign'];
        $idChofer = (Validacion::validarNumero($_POST['idChoferSelect']) == -1) ? false : $_POST['idChoferSelect'];

        $validar = array("ruta"=>$idRuta,"carro"=>$idCamioneta,"chofer"=>$idChofer);

        $val = Utls::sessionValidate($validar);

        if($val > 1){
            echo '<script>window.location="' . base_url . 'Preventa/asignarnextDay&ruta='.$_POST['idRutaCamioneta'].'&name='.$_POST['namert'].'"</script>';
        }else{
            $inserta = new PreventaTrasporteModel($idRuta,$idCamioneta,Utls::sumDays(1));
            $inserta->setIdChofer($idChofer);
            $dato = $inserta->insertRutaCamioneta();
            if($dato){
                echo '<script>window.location="' . base_url . 'Preventa/asignarnextDay&ruta='.$_POST['idRutaCamioneta'].'&name='.$_POST['namert'].'"</script>';
            }else{
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'No se inserto el Registro',
                    'datos' => $validar
                );
                echo '<script>window.location="' . base_url . 'Preventa/asignarnextDay&ruta='.$_POST['idRutaCamioneta'].'&name='.$_POST['namert'].'"</script>';
            }
        }
    }

    public function RutaAsignada(){
        require_once ('models/PreventaRutaModel.php');
        $datos = new PreventaModel();
        $stored = $datos->sotredRutaAsignada();
        $ra = $datos->getAllWhere('viewrutacamionetaasignada','where statusRuta = 0   ORDER BY rutaIdRutaCamioneta ');

        require_once ('views/preventa/listaRutaCamionetaAsignada.php');
    }

    public function RutaHoy(){
        $datos = new PreventaModel();
        $ra = $datos->getAllWhere('viewrutacamionetaasignada','where statusRuta = 1 and fechaSalida = "'.date("Y-m-d").'" ORDER BY rutaIdRutaCamioneta ');

        require_once ('views/preventa/listaRutaCamionetaAsignadaHoy.php');

    }

    public function verClientes(){
        require_once ('models/PreventaRutaModel.php');
        $datos = new PreventaModel();
        $pas = $datos->getAllWhere('ViewNotaPedidoCliente','WHERE rutaNotaPEdido = '.$_GET['ruta'].' AND _status = 2 /* OR _status = 3 */ ');
        $andenvClientes = md5('Preventa');

        require_once('views\preventa\listaPedidosAsignados.php');
    }
}
