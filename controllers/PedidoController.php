<?php 
/* require_once 'models/PedidoModel.php'; */
require_once $_SERVER['DOCUMENT_ROOT'] . "/sapiProyecto/models/PedidoModel.php";

class PedidoController
{
    public function __construct()
    {
        //validamos si extiste a sesison
      if(!isset($_SESSION['usuario'])){Utls::sinSession();}
    }
    public function index(){
        $ruta = new PedidoModels();
        $pedido = $ruta->getAllWhere('clientepedido','GROUP BY clientepedido.id,clientepedido.nomRuta ORDER BY	clientepedido.idruta');
        require_once 'views/pedidos/index.php';
    }

    public function pedido(){       
        
        $pedidos = new PedidoModels();
        $datos = $pedidos->getAllWhere('clientepedido','WHERE id='.$_GET['id'])->fetch_object();        
        $dom = $pedidos->getAllWhere('mostrardatospedido','WHERE clienteId='.$_GET['id'])->fetch_object();        
        $prod = $pedidos->getAll('producto');
        if($_GET['id'] == 713){
            $rutas = $pedidos->getAll('ruta');
        }
        require_once 'views/pedidos/pedido.php';
    }

    Public function PedidoAnterior(){
        require_once('views/pedidos/listaPedidos.php');
    }

    public function detalle(){
        $detallePEdido = new PedidoModels();
        $datos = $detallePEdido->getAllWhere('clientepedido','WHERE id='.$_GET['cli'])->fetch_object();  // datos de contacto de cliente      
        $dom = $detallePEdido->getAllWhere('mostrardatospedido','WHERE clienteId='.$_GET['cli'])->fetch_object(); // datos de domicilio de cliente
        $prod = $detallePEdido->getAllWhere('viewPedidosProducto','WHERE idnotaPedido = '.$_GET['id']); // datos de productos
        $almacenes = $detallePEdido->getAllwhere('almacen','WHERE idAlmacen <> 1'); // traer almacenes excepto el almacen 1 que es el default

        require_once 'views/preventa/detalleVenta.php';
    }

    public function pedidos()
    {
        require_once ('models/pedidosHistorico/ListarPedidos.php');
        $getController = "Pedido";
        $verPedidosDia = new ListarPedidos(1);
        $pedidos =$verPedidosDia->getPedidosEditar();
        $anden = md5('PedidosDia');
        require_once('views/pedidos/listaEditarPedidos.php');
    }

    public function editar()
    {
        $detallePEdido = new PedidoModels();
        $datosVentaContado = null;
        if($_GET['cli'] == 713){
                $detallePEdido->setIdnotaPedido($_GET['id']);
                $detallePEdido->setIdClientePedido($_GET['cli']);
                $datosVentaContado = $detallePEdido->customerWithoutId()->fetch_object();

                $rutas = $detallePEdido->getAll('ruta');
            }

        $datos = $detallePEdido->getAllWhere('clientepedido','WHERE id='.$_GET['cli'])->fetch_object();  // datos de contacto de cliente      
        $dom = $detallePEdido->getAllWhere('mostrardatospedido','WHERE clienteId='.$_GET['cli'])->fetch_object(); // datos de domicilio de cliente
        $prodEditar = $detallePEdido->getAllWhere('viewPedidosProducto','WHERE idnotaPedido = '.$_GET['id'])->fetch_all(); // datos de productos
        //$almacenes = $detallePEdido->distinctQuery('fechaEntregaPedido','pedidos','WHERE idnotaPedido = '.$_GET['id'])->fetch_object();
        $productos = $detallePEdido->getAll('producto');
       require_once 'views/pedidos/detalleVenta.php';

    }

    public function finishPedido($dato){
        $usuario = new PedidoModels();
        $actualizar = $usuario->updatePedidos();
        if($actualizar){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function editarNota(){
        require_once 'models/pedidosHistorico/EditarPedidos.php';
        $notaNueva = (Validacion::textoLargo($_POST["notaComentario"],500) == 0) ? "s/c" : 0;
        if($notaNueva == 0){
            $notaNueva = (Validacion::textoLargo($_POST["notaComentario"],500) == 0) ? false : $_POST["notaComentario"];
        }
        $nota = (Validacion::validarNumero($_POST["nota"]) == -1) ? false : $_POST["nota"];
        $cliente = (Validacion::validarNumero($_POST["cliente"]) == -1) ? false : $_POST["cliente"];

        $notaModels = new EditarPedidos();
        $notaModels->setIdnotaPedido($nota);
        $notaModels->setIdClientePedido($cliente);
        $notaModels->setNotaCobranza($notaNueva);
       $comentario =  $notaModels->updateComentario();
       if($comentario){
            echo '<script>window.location="' . base_url .'Pedido/editar&id='.$nota.'&cli='.$cliente.'"</script>';
       }else{
        $_SESSION['formulario_cliente'] = array(
            'error' => 'faltan datos necesarios para hacer la acción'
        );
        echo '<script>window.location="' . base_url .'Pedido/editar&id='.$nota.'&cli='.$cliente.'"</script>';
       }

    }

    public function changeDatePEdido($fechaChange){
       $datos = json_decode($fechaChange);
       $data = $datos[0];
        
       $fecha = (Validacion::valFecha($data->date_dateIdPedido_15) == 0) ? false:$data->date_dateIdPedido_15;
       $nota = (Validacion::validarNumero($data->phone_numNota_20) == -1) ? false:$data->phone_numNota_20;
       $cliente = (Validacion::validarNumero($data->phone_inputIdClienteEditar_25) == -1) ? false:$data->phone_inputIdClienteEditar_25;
       $usuario = (Validacion::validarNumero($data->phone_idUser_20) == -1) ? false:$data->phone_idUser_20;

       $validar = array('fecha' =>$fecha ,'nota' =>$nota ,'cliente' =>$cliente ,'usuario' =>$usuario);
         
       $val = Utls::sessionValidate($validar);

       if($val > 1){
            echo 0;
        }else{
            $changeFecha = new EditarFecha();
            $changeFecha->setFechaEntrega(Validacion::valFecha($data->date_dateIdPedido_15));
            $changeFecha->setIdnotaPedido($nota);
            $changeFecha->setIdClientePedido($cliente);
            $changeFecha->setIdUsuarioPedido($usuario);
            $nuevaFecha = $changeFecha->changeDatePEdido();

            if($nuevaFecha){
                echo 1;
            }else{
                echo 2;
            }
        }
    }

    public function anden(){
        require_once ('models/pedidosHistorico/ListarPedidos.php');
        $verPedidosDia = new ListarPedidos(2);
        $pedidos =$verPedidosDia->getPedidosEditar();
        $anden = md5('sendFromRecept');
        require_once('views/pedidos/listaEditarPedidos.php');
    }

    public function editarCliente(){
        require_once ('models/pedidosHistorico/EditarCliente.php');
        $IdNota = (Validacion::validarNumero($_POST['idNota']) == -1) ? false : $_POST['idNota']; 
        $IdCli = (Validacion::validarNumero($_POST['idCli']) == -1) ? false : $_POST['idCli']; 
        $name = (Validacion::validarLArgo($_POST['customName'],50) == -1) ? false : $_POST['customName'] ;
        $telefono = (Validacion::validarLArgo($_POST['customPhone'],10) == -1) ? false : $_POST['customPhone'] ;
        $ruta = (Validacion::validarNumero($_POST['rutaClienteSlect']) == -1) ? false : $_POST['rutaClienteSlect'] ;

        if($IdNota == false ||$IdCli == false ||$name == false || $telefono == false || $ruta == false){
            $_SESSION['formulario_cliente'] = array(
                'error' => 'faltan datos necesarios para hacer la acción'
            );
        }else{
            $editar = new EditarCliente($IdNota,$IdCli,$name,$telefono,$ruta,);
            $edit = $editar->editarCliente();

            if($edit){
               echo "<script>Swal.fire({position: 'center',icon: 'success',title: 'SE ACTUALIZO CON EXITO',showConfirmButton: false,timer: 6000}).then(window.location='" . base_url ."Pedido/editar&id=".$IdNota."&cli=".$IdCli."')</script>";
               //echo '<script>window.location="' . base_url .'Pedido/editar&id='.$IdNota.'&cli='.$IdCli.'"</script>';
            }
        }
    }

}