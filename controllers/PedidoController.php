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
        require_once 'views/pedidos/pedido.php';
    }

    public function crearPedido($dato){
        $decod = json_decode($dato);

        $contar = count($decod->productos);
        $notaComentario = (Validacion::textoLargo($decod->notaComentario,500)==0) ? "s/c" : 0;
        if($notaComentario == 0){
            $notaComentario = (Validacion::textoLargo($decod->notaComentario,500)==900) ? false : $decod->notaComentario;
        }
        $idCliente = (Validacion::validarNumero($decod->idCliente)== -1) ? false : true;
        $fechaEnvio = (Validacion::valFecha($decod->fecha) == 0) ? false:Validacion::valFecha($decod->fecha);
        if($idCliente == false || $fechaEnvio == false){
            $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de cliente');
        }else{
            for ($i=0; $i <$contar ; $i++) { 
                $codigo = (Validacion::validarNumero($decod->productos[$i]->codigo) != -1) ?  true: $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break; 
                $prod = (Validacion::validarNumero($decod->productos[$i]->producto) != -1) ?  true:$_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break;
                $presn = (Validacion::textoLargo($decod->productos[$i]->present,250) != -1) ?  true : $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break;
                $pz = (Validacion::validarNumero($decod->productos[$i]->pz) != -1) ?  true : $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break; ;
            }
            
            if (isset($_SESSION['formulario_cliente'])) {
                echo '<script>window.location="' . base_url . 'Pedido/pedido&id="'.$idCliente.'</script>';
            } else {
            
                $registroInsert = 0;
                
                for ($j=0; $j <$contar ; $j++) { 
                    $registerPedido = new PedidoModels();
                    $registerPedido->setIdnotaPedido($decod->nota);
                    $registerPedido->setIdClientePedido($decod->idCliente);
                    $registerPedido->setIdUsuarioPedido($decod->user);
                    $registerPedido->setIdProductoPedido($decod->productos[$j]->codigo);
                    $registerPedido->setPresentacionProductoPedido($decod->productos[$j]->present);
                    $registerPedido->setPzProductoPedido($decod->productos[$j]->pz);
                    $registerPedido->setDetalleEntrega($decod->productos[$j]->present);
                    $registerPedido->setFechaEntrega($fechaEnvio);
                    $registerPedido->setComentarioNotaPedidos($notaComentario);
                    $registro = $registerPedido->insertPedido();
                    
                    if($registro){
                        $registroInsert ++;
                    }else{
                        $registroInsert = 0;
                    }

                    echo $registroInsert;
                }
            


            }
        }

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
        $verPedidosDia = new PedidoModels();
        $pedidos =$verPedidosDia->getPedidosEditar();
        require_once('views/pedidos/listaEditarPedidos.php');
    }

    public function editar()
    {
        $detallePEdido = new PedidoModels();
        $datos = $detallePEdido->getAllWhere('clientepedido','WHERE id='.$_GET['cli'])->fetch_object();  // datos de contacto de cliente      
        $dom = $detallePEdido->getAllWhere('mostrardatospedido','WHERE clienteId='.$_GET['cli'])->fetch_object(); // datos de domicilio de cliente
        $prod = $detallePEdido->getAllWhere('viewPedidosProducto','WHERE idnotaPedido = '.$_GET['id']); // datos de productos
        $almacenes = $detallePEdido->distinctQuery('fechaEntregaPedido','pedidos','WHERE idnotaPedido = '.$_GET['id'])->fetch_object();
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
        $notaNueva = (Validacion::textoLargo($_POST["notaComentario"],500) == 0) ? "s/c" : 0;
        if($notaNueva == 0){
            $notaNueva = (Validacion::textoLargo($_POST["notaComentario"],500) == 0) ? false : $_POST["notaComentario"];
        }
        $nota = (Validacion::validarNumero($_POST["nota"]) == -1) ? false : $_POST["nota"];
        $cliente = (Validacion::validarNumero($_POST["cliente"]) == -1) ? false : $_POST["cliente"];

        $notaModels = new PedidoModels();
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

}