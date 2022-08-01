<?php

class Utls{

    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
                $_SESSION[$name] = null;
                unset($_SESSION[$name]);
        }
        return $name;
    }
    public static function getApellido($apellido){
        $second = "";
        $dato = explode(' ',$apellido);
        
        $primer = $dato[0];
        if(isset($dato[1])){
            $datoDos = $dato[1];
            $second = SED::decryption($datoDos);
        }

        return ucwords(SED::decryption($primer).' '.$second);
    }

    public static function createId($sessionUser,$idbd){
        $increment=0;
        $Ano = date('Y');
        $mes = date('m'); 
        $consultorio = ($sessionUser >= 10) ? $sessionUser : '0'.$sessionUser ;
        if($mes === '01'){
            $increment = '0001';
        }else{
            if ($idbd == '1') {
                $increment = '0001';
            }else{
                $increment = substr($idbd,7); 
            }
        }

        return $consultorio.$Ano.$mes.$increment;
    }

    
    public static function disbled($nameSession){
        if($nameSession == 'dndMc3')
        return ' disabled=disabled ';
    } 

    public static function nameMonth($numberMonth){
        date_default_timezone_set("America/Mexico_City");

        $mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][$numberMonth - 1];

        return $mes;
    }

    public static function createDAte($date){
        $fecha = explode("-", $date);
        if(isset($fecha[2])){  
            if (preg_match("/^[0-9]{4}+$/", $fecha[2])) {
                $fechames = (Validacion::validarNumero($fecha[1]) == '-1') ? false : $fecha[1] ;
                $fechadia = (Validacion::validarNumero($fecha[0]) == '-1') ? false : $fecha[0] ;
                $fechaaño = (Validacion::validarNumero($fecha[2]) == '-1') ? false : $fecha[2] ;

                if(checkdate($fechames, $fechadia, $fechaaño)){
                    $checkday = Validacion::addZeroDate($fecha[0]);
                    $checkMonth = Validacion::addZeroDate($fecha[1]);    
                    return $fechaaño.$checkMonth.$checkday;
                    
                }else{
                    return "-100";
                }
            }else{

                return "-200";
            }
        }else{
            return "-300";
        }
    }

    public static function sinSession(){
        $_SESSION['errorLoguin'] = "NECESITAS CREDENCIALES PARA INGRESAR";
                    echo '<script>window.location="'.base_url.'"</script>';
    }

    public static function cuentaPedidos($usuario){
        require_once $_SERVER['DOCUMENT_ROOT']."/sapiProyecto/config/modeloBase.php";
        $datosWhere = "idUsuarioNotaPedido = ".$usuario." AND fechaAltaNotaPedido = CURDATE()";
        $datos = new ModeloBase();
        $contados = $datos -> getCountDatos('notapedido',$datosWhere,'idUsuarioNotaPedido')->fetch_all();
        return $contados;
    }
    public function getlastDateOrder(){
        require_once $_SERVER['DOCUMENT_ROOT']."/sapiProyecto/models/PedidoModel.php";
        $myDate = '';
        $dateOrder = new PedidoModels();
        $dateOrder->setIdUsuarioPedido($_SESSION['usuario']['id']);
        $datos = $dateOrder->lastDate();
        if($datos){
            $datesObtained = $datos->fetch_all();
            $myDate = $datesObtained[0][6];
        }
        return $myDate;
        
    }

    public static function sessionValidate($array){
        $valida = 1;
        foreach ($array as $dato => $valor) {
            if ($valor == false) {
                $valida ++;
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'El campo ' . $dato . ' es incorrecto, llena los campos faltantes',
                    'datos' => $array
                );
                break;
            }
        }
        return $valida;
    }

    public static function lastArray($datoArray){
        
        return end($datoArray);
    }

    /* esta funcion sirve para retornar  */
    public static function getNumberday($enterDate,$startYear){
        $year_start = '';
        // este ontiene la fecha de hoy
        $currentDate = strtotime(date("Y-m-d H:i:s"));
        switch ($startYear) {
            case '0':
                $year_start = strtotime('first day of January', time());
                break;
            case '1':
                    $year_start = strtotime($enterDate);  
                break;
            default:
                    $year_start = 500;
                    break;
        }

        // contamos los que han passdo
        $daysPassed = ($currentDate - $year_start) / MINXDAY; 

        
        return ceil($daysPassed);
        
    }

    /* public static function numOrderCreated(){
        $message = "0";
        $fecha = self::getlastDateOrder();
        $currentDate = date($fecha);
        $compareDates = self::getNumberday($currentDate,1);
        if($compareDates != 0){
            $message = $compareDates;
        }

        return $message;

    } */

    public static function getisNull($get){
        if(is_null($get)){
            $_SESSION['errorCliente'] = "EL CLIENTE NO ESTA REGISTRADO, FAVOR DE VERIFICAR LOS DATOS";
            echo '<script>window.location="' . base_url .'Pedido/index"</script>';
        
        }
    }

    public static function createNotaId(){
        /* obtenemos los dias transcurridos desde el incio del año */
        $currentDate = strtotime(date("Y-m-d H:i:s"));
        $fecha1 = self::getNumberday($currentDate,0);
        /* obtenenmos el id del usuario */
        $idUsuario = $_SESSION['usuario']['id'];
        /* contamos para saber cuantos dias han pasado desde su ultima conexion  */
        $contar = self::cuentaPedidos($idUsuario);
        $countNota = $contar[0][0];
        $yearNumber = date('y');

        $nota = $fecha1.$idUsuario.$countNota.$yearNumber;

        return $nota;
        
    }

    public static function namebreadcum($linkGet){
        $action = $linkGet ["action"];
        $retorno ='';
       switch ($linkGet["controller"]) {
           case 'Preventa':
                if($action == 'index'){
                    $retorno = 'Lista Pedidos';
                }elseif ($action == 'reportePedidoDetallado') {
                    $retorno = 'Lista De Productos Pedidos';
                }
               break;
            case 'Cliente':
                if($action == 'index'){
                    $retorno = 'Cliente Nuevo';
                }elseif ($action == 'lista') {
                    $retorno = 'Lista de Clientes';
                }elseif ($action == 'edit') {
                    $retorno = 'Editar Cliente';
                }
                break;
            case 'Compras':
                if($action == 'index'){
                    $retorno = 'Compras';
                }
                break;
            case 'Proveedor':
                if($action == 'index'){
                    $retorno = 'Proveedor Nuevo';
                }elseif ($action == 'lista') {
                    $retorno = 'Lista de Proveedores';
                }elseif ($action == 'edit') {
                    $retorno = 'Editar Proveedor';
                }
                break;
            case 'Remision':
                if($action == 'index'){
                    $retorno = 'Remision';
                }
                break;
            case 'Venta':
                if($action == 'index'){
                    $retorno = 'Venta';
                }elseif ($action == 'venta') {
                    $retorno = 'Venta';
                }
                break;
            case 'Anden':
                if($action == 'venta'){
                    $retorno = 'Venta';
                }elseif ($action == 'traspaso') {
                    $retorno = 'Traspaso Producto';
                }
                break;
            case 'Pedido':
                if ($action == 'PedidoAnterior') {
                    $retorno = 'Lista de Pedidos Anteriores';
                }elseif ($action == 'pedidos') {
                    $retorno = 'Lista de Pedidos A Editar';
                }elseif($action == 'anden') {
                    $retorno = 'Pedidos Enviado a Anden';
                }elseif($action == 'reportePedido'){
                    $retorno = 'Reporte De Pedido (Oaxaca, Panela y Crema)';
                }elseif($action == 'reportePedidoDetallado'){
                    $retorno = 'Reporte De Pedido (Completo)';
                }
           default:
               # code...
               break;
       }

       return $retorno;
    }
/* 
* dependiendo del perfil es la primer pantalla vista que entra
*/
    public static function viewProfile($profile){
        $menu = '';
        switch ($profile) {
            case '0':
                $menu = 'Anden/index';
                break;
            case '1': 
               $menu = 'Pedido/index';
                break;
            default:
                $menu = 'Vista/default';
                # code...
                break;
        }

        return $menu;
    }

    public static function multiply($dato1 = 0,$dato2 = 0){
        $resultado = 0;
        $uno = (Validacion::validarNumero($dato1) == -1) ? false : $dato1 ;
        $dos = (Validacion::validarNumero($dato2) == -1) ? false : $dato2 ;

        if($uno == false || $dos == false ){
            $resultado = 0;
            return $resultado;
        }
        $resultado = round($uno * $dos,2);

        return $resultado;

    }

    public static function porcentaje($porcentaje,$total){
         $dato1 = floatval($porcentaje);
         $dato2 = floatval($total);
         $reesultadoDato  =  (($dato1 * $dato2) / 100);
        /*  reesultado = restar(total, reesultadoDato) */
        return $reesultadoDato;
       }

       public static function restar($uno, $dos) {
        $resultado = 0;
        $resultado = (floatval($uno) - floatval($dos));
      
        if ($resultado < 0) {
          return -1;
        } else {
          return $resultado;
        }
      }

      public static function getNumRemision(){
        require_once $_SERVER['DOCUMENT_ROOT']."/sapiProyecto/config/modeloBase.php";

        $idAlmacen = new ModeloBase();
        $id =  $idAlmacen->getIdCleinte($_SESSION['usuario']['camra'])->fetch_object();
        return $id->id;
      }

      public static function printHeaderAlmacen(){
        $almacen = ($_SESSION['usuario']['camra']);
        $name = "";

        if($almacen != 0){
            $anden = $almacen-1;
            $name = "--".ALMACEN[$anden];
        }

        return $name;
      }

      public static function diasAnteriores($fecha,$diasAtrazo){
        $fecha;
        $dateToday = Validacion::valFecha($fecha);
        if($dateToday == 0 || $dateToday == -1){
            $fecha = 0;
        }else{
            if($diasAtrazo == 1){            
                $ayer = strtotime('-1 days',strtotime($dateToday));
                $nameDay = date('l',$ayer);
                if($nameDay == "Sunday"){
                    $TwoDays = strtotime('-2 days',strtotime($dateToday));
                    $fecha = date('Y-m-d',$TwoDays);
                }else{
                    $fecha = date('Y-m-d',$ayer);
                }
            }
        }

        return $fecha;
      }

      public static function restarDias($fechaincial,$diasArestar){
        $regreso = '';
        $fechahoy = date("d-m-Y");
        $incial = (Validacion::valFecha($fechaincial) == 0) ? false :  $fechaincial;
        $dias = (Validacion::validarNumero($diasArestar) == -1) ? false : $diasArestar;
        if($incial == false || $dias == false ){
            $regreso=0;
        }else{            
            // esta es la fecha calculada de la fecha de hoy a N dias a tras; 
            $fechaUno = strtotime('-'.$diasArestar.' days',strtotime($fechahoy));
            $fecha = date('Y-m-d',$fechaUno);
            $mesFechaUno = date('m',$fechaUno);
            $mesincial = date('m',strtotime($incial));
            if( $mesFechaUno == $mesincial){
                /* verificamos que los dias fechauno sea igual o mayor a diaIncial*/
                $diaincial = intval(date('d',strtotime($incial)));
                $diaFechaUno = intval(date('d',strtotime($fecha)));

                if($diaFechaUno <=$diaincial){
                    $regreso=1050;// correcto
                }else{
                    $regreso=1051; // por dias se pasa de los 30 dias
                }
            }else if($mesFechaUno > $mesincial){
                $regreso=1052; // se pasa por meses
            }else{
                $regreso=1053; // default regreso este es por que la fecha esta dentro de los 30 dias
            }

        }

        return $regreso;
      }

      /**
       * toma la fecha de hoy, le pasamos como parameto un numero, este parametro nos indica de cuantos dias sumara a la fecha
       */
      public static function sumDays($sumDays){
        $currenteDate =date("Y-m-d");
        
        $newDate = date('Y-m-d',strtotime($currenteDate."+ ".$sumDays." days"));
        return $newDate;
      }

      public static function getassigned($idrutaCamioneta){
        require_once $_SERVER['DOCUMENT_ROOT']."/sapiProyecto/models/preventa/PreventaAssignedCamioneta.php";
        $fecha = self::sumDays(1);
        $ass = new PreventaAssignedCamioneta($idrutaCamioneta, $fecha);                                                   
        $verify = $ass->checkAssigned();

        return $verify;
      }

}
