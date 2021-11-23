<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/logginModel.php";

// require_once $_SERVER['DOCUMENT_ROOT']."/models/logginModel.php";

class LogginController
{
    public $table;
    public $match;
    public $id;

    public function index(){
        $_SESSION['usuario'] = array(
            'id' => 1,
            'consultorio' =>1,
            'nombre'=>"Miguel",
            'apeliidos'=>"Dewm",
            'tipo'=>1,
            'status'=>1
        );

        echo '<script>window.location="' . base_url . 'Cliente/index"</script>';


    }

    public function consultaRows()
    {
        $returnJsonDatos = array();
        $tabla = (Validacion::pregmatchletras($this->table) == '0') ? false : true;
        $rowMatch = (Validacion::validarLArgo($this->match, 30) == '-1') ? false : true;
        $idrow = (Validacion::validarNumero($this->id) == '-1') ? false : true;
        $verif = array('tabla' => $tabla, 'rowmatch' => $rowMatch, 'idrow' => $idrow);

        foreach ($verif as $key => $value) {
            if ($value == false) {
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'El campo ' . $key . ' es incorrecto, llena los campos faltantes',
                    'datos' => $verif
                );
                break;
            }
        }

        if (isset($_SESSION['formulario_cliente'])) {
            echo '<script>window.location="' . base_url . 'Consultorio/nuevo"</script>';
        } else {
            $regresojson = new Login();
            $regreso =  $regresojson->getAllWhere($this->table, 'where ' . $this->match . ' = ' . $this->id);
            $createArray = ($regreso->fetch_all());
            if ($regreso) {
                switch ($this->table) {
                    case 'getdomproveedor':
                        for ($i = 0; $i < count($createArray); $i++) {
                            $returnJsonDatos[] = array(
                                'idDomicilioProveedor' => $createArray[$i][0],
                                'proveedorId' => $createArray[$i][1],
                                'calleDomicilioPRoveedor' => $createArray[$i][2],
                                'numeroDomiclioProveedor' => $createArray[$i][3],
                                'municipioDomicilioProveedor' => $createArray[$i][4],
                                'cpDomicilioProveedor' => $createArray[$i][5],
                                'coloniaProv' => $createArray[$i][6],
                                'idMunicipio' => $createArray[$i][7],
                                'municipio' => $createArray[$i][8],
                                'idEstado' => $createArray[$i][9],
                                'estado' => $createArray[$i][10]
                            );
                        }
                        break;

                    default:
                        # code...
                        break;
                }
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($returnJsonDatos);
                /*  echo $datos;*/
                exit();
            }
        }
    }

    public function verifEmailLog($email)
    {
        $validarEmail = Validacion::validarEmail($email);
        if ($validarEmail != '0') {
            $login = new Login();
            $tipoUser = $login->getEmailExis($validarEmail);
            if ($tipoUser && $tipoUser->num_rows == 1) {
                $tipo = $tipoUser->fetch_object();
                $logiin["correo"] = $tipo->correoUsuario;
                $logiin["tipo"] = $tipo->tipoUsuario;

                header('content-type: application/json; charset=utf8');
                echo json_encode($logiin);
            }
        }
    }

    public function verificar()
    {

        /* 
            
            Utls::deleteSession('usuario'); */
        $user = (Validacion::validarEmail($_POST["username"]) == '0') ? false : $_POST["username"];
        //$password = (Validacion::validarPass($_POST["pass"]) == '0') ? false : $_POST["pass"];
        $tipo = (Validacion::validarNumero("0") == '-1') ? false : "0";

        if ($tipo === "0") {
            $_SESSION['usuario'] = array(
                'id' => 1,
                'consultorio' => "pilarica",
                'nombre' => $_POST["username"],
                'apeliidos' => "trujillo",
                'tipo' => 1,
                'status' => 1,
                'datos' => "hola"
            );
            echo '<script>window.location="' . base_url . 'Consultorio/nuevo"</script>';
            /*   $_SESSION['loggin'] = 'USUARIO O CONTRASEÑA SON INCORRECTOS';
                echo '<script>window.location="'.base_url.'"</script>';
            }elseif($tipo === "2" || $tipo === '3'){
                $consul = (Validacion::validarNumero($_POST["consul"]) == '-1') ? false : $_POST["consul"];
                if($consul == false){;
                    $_SESSION['loggin'] = 'SE HAN INGRESADO DATOS INCORRECTAMENTE VERIFIQUE POR FAVOR';
                    echo '<script>window.location="'.base_url.'"</script>';
                }else{
                    // buscar el usuario en la tabla consultorio
                    $doctor = new Login();
                    $doctor->setEmail($user);
                    $doctor->setPass($_POST["pass"]);
                    $resupuesta = $doctor->getDoctor();
                    if($resupuesta){
                        $consulName = new Login();
                        $consulName->setId($consul);
                        $cosnultorio = $consulName->getConsultorio();
                        if($cosnultorio){
                            $getMnu = new ModeloBase();
                            $mostrarMEnu = $getMnu->getMenUsuario($resupuesta->idUsuario);
                            if($mostrarMEnu){

                            
                                // creamos una session para mostrar titulos y para validaciones
                                $_SESSION['usuario'] = array(
                                    'id' => $resupuesta->idUsuario,
                                    'consultorio' =>$consul,
                                    'nombre'=>$resupuesta->nombreUsuario,
                                    'apeliidos'=>$resupuesta->apellidoUsuario,
                                    'tipo'=>$resupuesta->tipoUsuario,
                                    'status'=>$resupuesta->statusUusario,
                                    'datos'=>$cosnultorio,
                                    'menu'=>$mostrarMEnu
                                );  
                                // redireccionamos
                                echo '<script>window.location="'.base_url.'Consultorio/nuevo"</script>';
                            }else{
                                $_SESSION['loggin'] = 'ALGO SALIO MAL NO SE RECUPERARON TODOS LOS DATOS, INTENTE DE NUEVO O LLAME A SU ADMINISTRADOR';
                                echo '<script>window.location="'.base_url.'"</script>';
                            }
                            
                        }else{
                            $_SESSION['loggin'] = 'ALGO SALIO MAL NO SE RECUPERARON TODOS LOS DATOS,LLAME A SU ADMINISTRADOR';
                            echo '<script>window.location="'.base_url.'"</script>';
                        }
                    }else{
                        $_SESSION['loggin'] = 'USUARIO O CONTRASEÑA SON INCORRECTOS';
                        echo '<script>window.location="'.base_url.'"</script>';
                    }
                } */
        }
    }

    public function logout()
    {
        session_destroy();
        echo '<script>
            sessionStorage.removeItem("lasTUrl");
            sessionStorage.removeItem("logguin");
            window.location="' . base_url . '"</script>';
    }

    public function getMunicipio($id)
    {
        $idMun = Validacion::validarNumero($id);

        if ($idMun != -1) {
            $estado = new Login();
            $estado->setIdEstado($idMun);
            $verMun = $estado->getMunModels();
            if ($verMun->num_rows > 0) {
                $whileJson = array();
                while ($muni = $verMun->fetch_object()) {
                    $data = array(
                        'id' => $muni->idMunicipio,
                        'name' => $muni->municipio
                    );
                    array_push($whileJson, $data);
                }
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($whileJson, JSON_FORCE_OBJECT);
                exit();
            }
        }
    }

    public function getCorreoExistent($email)
    {
        $correo = Validacion::validarEmail($email);

        if ($correo != '0') {
            $mail = new Usuario();
            $resultado = $mail->getEmailExis($correo);
            if ($resultado->num_rows > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 2;
        }
    }

    // esta consulta siempre esta disponible para las consulta de ajax simples que solicite tabla y tipo. estara conectado a funcion getAllWhere(tabla,datos);
    public function consultaGeneral($tabla, $match, $datos)
    {
        $returnJson = "";
        $tbl = (Validacion::textoLargo($tabla, 30) == '900') ? false : true;
        $idTabla = (Validacion::textoLargo($match, 30) == '900') ? false : true;
        $dta = (Validacion::validarNumero($datos) == '-1') ? false : true;

        $validacion = array("tabla" => $tbl, "idTabla" => $idTabla, "id" => $dta);
        foreach ($validacion as $key => $value) {
            if ($value == false) {
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'El campo ' . $key . ' es incorrecto, llena los campos faltantes',
                    'datos' => $validacion
                );
                break;
            }
        }
        if (isset($_SESSION['formulario_cliente'])) {
            echo '<script>window.location="' . base_url . 'Cliente/index"</script>';
        } else {
            $conuslta = new ModeloBase();
            $datos_consultados = mysqli_fetch_object($conuslta->getAllWhere($tabla, "where " . $match . " = " . $datos));

            switch ($tabla) {
                case 'getDomCliente':
                    $returnJson = array(
                        'idDomicilio' => $datos_consultados->idDomicilioCliente,
                        'idcliente' => $datos_consultados->clienteId,
                        'calle' => $datos_consultados->calleDomicilioCliente,
                        'numeroCasa' => $datos_consultados->numeroDomicilioCliente,

                        'idEstado' => $datos_consultados->idEstado,
                        'nombreEstado' => $datos_consultados->estado,
                        'idMunicipio' => $datos_consultados->estados_municipios_id,
                        'nombreMunicipio' => $datos_consultados->municipio,
                        'colonia' => $datos_consultados->coloniaDomicilioCliente,

                        'cp' => $datos_consultados->cpDomicilioCliente,
                        'idRuta' => $datos_consultados->rutaId,
                        'nombreRuta' => $datos_consultados->nombreRuta

                    );
                    break;
                case 'contactocliente':
                    $returnJson = array(
                        'idContactoCliente' => $datos_consultados->idContactoCliente,
                        'idcliente' => $datos_consultados->ClienteId,
                        'nombreCliente' => $datos_consultados->nombreContatoCliente,
                        'telefonoPrincipal' => $datos_consultados->telPrinContactoCliente,

                        'telefonoScundario' => $datos_consultados->telSecundarioContactoCliente,
                        'correoContacto' => $datos_consultados->correoContactoSecundario

                    );
                    break;
                case 'contactoproveedor':
                    $returnJson = array(
                        'idContactoCliente' => $datos_consultados->idContactoProveedor,
                        'idcliente' => $datos_consultados->proveedorId,
                        'nombreCliente' => $datos_consultados->nombreProveesor,
                        'telefonoPrincipal' => $datos_consultados->telefono1Proveedor,

                        'telefonoScundario' => $datos_consultados->telefono2proveedor,
                        'correoContacto' => $datos_consultados->correoproveedor

                    );
                    break;
                case 'getdomproveedor':
                    $returnJson = array(
                        'idDomicilioProveedor' => $datos_consultados->idDomicilioProveedor,
                        'proveedorId' => $datos_consultados->proveedorId,
                        'calleDomicilioPRoveedor' => $datos_consultados->calleDomicilioPRoveedor,
                        'numeroDomiclioProveedor' => $datos_consultados->numeroDomiclioProveedor,
                        'municipioDomicilioProveedor' => $datos_consultados->municipioDomicilioProveedor,
                        'cpDomicilioProveedor' => $datos_consultados->cpDomicilioProveedor,
                        'coloniaProv' => $datos_consultados->coloniaProv,
                        'idMunicipio' => $datos_consultados->idMunicipio,
                        'municipio' => $datos_consultados->municipio,
                        'idEstado' => $datos_consultados->idEstado,
                        'estado' => $datos_consultados->estado
                    );
                    break;
                case 'almacen':
                    $returnJson = array(
                        'idAlmacen' => $datos_consultados->idAlmacen,
                        'nombreAlmacen' => $datos_consultados->nombreAlmacen,
                        'areaAlmacen' => $datos_consultados->areaAlmacen,
                        'cuentaContableAlmacen' => $datos_consultados->cuentaContableAlmacen,
                        'statusAlamcen' => $datos_consultados->statusAlamcen,
                    );
                    break;
                case 'producto':
                    
                    $returnJson = array(
                        'idProducto' => $datos_consultados->idProducto,
                        'nombreProd' => $datos_consultados->nombreProducto,
                        'descripcionProd' => $datos_consultados->DescripcionProducto,
                        'unidadMedida' => $datos_consultados->UnidadMedidaProducto,
                        'statusProd' => $datos_consultados->statusProducto,
                        'fechaIngreso' => $datos_consultados->fechaIngreso
                    );
                    break;
                default:
                    # code...
                    break;
            }
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($returnJson, JSON_FORCE_OBJECT);
            exit();
        }
    }
}
