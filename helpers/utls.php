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
        require_once $_SERVER['DOCUMENT_ROOT']."/config/modeloBase.php";
        $datosWhere = "idUsuarioPedido =".$usuario."
        AND fechaAltaProductoPedido = CURDATE() GROUP BY idClientePedido";
        $datos = new ModeloBase();
        $contados = $datos -> getCountDatos('pedidos',$datosWhere,'idUsuarioPedido')->fetch_all();

        return $contados;
    }
    public function getlastDateOrder(){
        require_once $_SERVER['DOCUMENT_ROOT']."/models/PedidoModel.php";
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

    public static function createNotaId(){
        /* obtenemos los dias transcurridos desde el incio del año */
        $currentDate = strtotime(date("Y-m-d H:i:s"));
        $fecha1 = self::getNumberday($currentDate,0);
        /* obtenenmos el id del usuario */
        $idUsuario = $_SESSION['usuario']['id'];
        /* contamos para saber cuantos dias han pasado desde su ultima conexion  */
        $contar = self::cuentaPedidos($idUsuario);
        $countNota = count($contar);
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
           default:
               # code...
               break;
       }

       return $retorno;
    }
}
