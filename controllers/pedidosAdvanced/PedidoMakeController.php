<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/pedidosHistorico/PedidoInsertNota.php';                     
include_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/pedidosHistorico/InsertPedidoDetalle.php';                     
/* include_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/PedidoModel.php' */;
class PedidoMakeController
{
    private $arraydatos;
    public function __construct($arraydatos)
    {
        $this->arraydatos = json_decode($arraydatos);
    }


    public function getArraydatos()
    {
        return $this->arraydatos;
    }
    
    public function crearPedido(){
        $contarf = count($this->getArraydatos()->vc);
        if($contarf == 1){
            $nombre = -1;
            $tel = -1;
            $ruta = -1;
        }else if($contarf == 2){
            $nombre =(Validacion::textoLargo($this->getArraydatos()->vc[1]->nombre,50) == 0) ? false : $this->getArraydatos()->vc[1]->nombre;
            $tel =(Validacion::textoLargo($this->getArraydatos()->vc[1]->telNombre,10) == 0) ? false : $this->getArraydatos()->vc[1]->telNombre;
            $ruta =(Validacion::validarNumero($this->getArraydatos()->vc[1]->rutaCliente,50) == -1) ? false : $this->getArraydatos()->vc[1]->rutaCliente;

            if($nombre == false || $tel == false || $ruta == false){
                $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de cliente sin numero de cliente');
            }
        }

        $notaComentario = (Validacion::textoLargo($this->getArraydatos()->notaComentario,500)==0) ? "S/C" : 0;

        if($notaComentario == 0){
            $notaComentario = (Validacion::textoLargo($this->getArraydatos()->notaComentario,500)==900) ? false : $this->getArraydatos()->notaComentario;
        }
        $idCliente = (Validacion::validarNumero($this->getArraydatos()->idCliente)== -1) ? false : true;
        $fechaEnvio = (Validacion::valFecha($this->getArraydatos()->fecha) == 0) ? false:Validacion::valFecha($this->getArraydatos()->fecha);
        
        if($idCliente == false || $fechaEnvio == false){
            $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de cliente');
        }else{           
            $contar = count($this->getArraydatos()->productos);
            for ($i=0; $i <$contar ; $i++) { 
                $codigo = (Validacion::validarNumero($this->getArraydatos()->productos[$i]->codigo) != -1) ?  true: $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break; 
                $prod = (Validacion::validarNumero($this->getArraydatos()->productos[$i]->producto) != -1) ?  true:$_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break;
                $presn = (Validacion::textoLargo($this->getArraydatos()->productos[$i]->present,250) != -1) ?  true : $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break;
                $pz = (Validacion::validarNumero($this->getArraydatos()->productos[$i]->pz) != -1) ?  true : $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break; ;
            }
            
            if (isset($_SESSION['formulario_cliente'])) {
                echo '<script>window.location="' . base_url . 'Pedido/pedido&id="'.$idCliente.'</script>';
            } else {
               $registroNota = new PedidoInsertNota($this->getArraydatos()->nota,$this->getArraydatos()->idCliente,$this->getArraydatos()->user,$fechaEnvio,$notaComentario);
               $registroNota->setNombreCliente($nombre);
               $registroNota->setTelefono($tel);
               $registroNota->setRuta($ruta);
               $insertado = $registroNota->insertPedido();
               if($insertado){
                   $registroInsert = 0;
                   for ($j=0; $j <$contar ; $j++) { 
                       $registerPedido = new InsertPedidoDetalle($this->getArraydatos()->nota,$this->getArraydatos()->productos[$j]->codigo,$this->getArraydatos()->productos[$j]->pz,$this->getArraydatos()->productos[$j]->present);
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
    
    } 

    public function addPedido(){
        $idCliente = $this->getArraydatos()->idCliente;
        $contar = count($this->getArraydatos()->productos);
            for ($i=0; $i <$contar ; $i++) { 
                $codigo = (Validacion::validarNumero($this->getArraydatos()->productos[$i]->codigo) != -1) ?  true: $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break; 
                $prod = (Validacion::validarNumero($this->getArraydatos()->productos[$i]->producto) != -1) ?  true:$_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break;
                $presn = (Validacion::textoLargo($this->getArraydatos()->productos[$i]->present,250) != -1) ?  true : $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break;
                $pz = (Validacion::validarNumero($this->getArraydatos()->productos[$i]->pz) != -1) ?  true : $_SESSION['formulario_cliente'] = array('error' => 'Error en los datos de productos'); break; ;
            }
            
            if (isset($_SESSION['formulario_cliente'])) {
                echo '<script>window.location="' . base_url . 'Pedido/pedido&id="'.$idCliente.'</script>';
            } else {
                
                   $registroInsert = 0;
                   for ($j=0; $j <$contar ; $j++) { 
                       $registerPedido = new InsertPedidoDetalle($this->getArraydatos()->nota,$this->getArraydatos()->productos[$j]->codigo,$this->getArraydatos()->productos[$j]->pz,$this->getArraydatos()->productos[$j]->present);
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
