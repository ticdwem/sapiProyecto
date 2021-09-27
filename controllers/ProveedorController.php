<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/proveedorModels.php";


class ProveedorController
{
    public function index()
    {
        $estado = new ModeloBase();
        $variable = $estado->getAll("estados");

        $ruta = new ModeloBase();
        $nombreRuta = $ruta->getAll('ruta');
        require_once "views/proveedor/index.php";
    }

    public function create()
    {
        if (isset($_POST['btnGuardarProveedor'])) {
            #verificamos que losa campos no halla caracateres especiales
            $nombre = (Validacion::textoLargo($_POST['nameProveedor'], 50) == '900') ? false : htmlspecialchars($_POST['nameProveedor']);
            $rfc = (Validacion::validarRFC($_POST['rfcProveedor']) == false) ? false : htmlspecialchars($_POST['rfcProveedor']);

            if (isset($_SESSION["contactoProveedor"])) {
                $nombreArray = (Validacion::validarArray($_SESSION["contactoProveedor"]["nombreContacto"], 'string') == '800') ? false : true;
                $tel1Array = (Validacion::validarArray($_SESSION["contactoProveedor"]["telefonoContacto"], 'number') == '800') ? false : true;
                $tel2Array = (Validacion::validarArray($_SESSION["contactoProveedor"]["telefonoSec"], 'number') == '800') ? false : true;
                $emailArray = (Validacion::validarArray($_SESSION["contactoProveedor"]["correo"], 'email') == '800') ? false : true;
            } else {
                $nombreArray = 0;
                $tel1Array = 0;
                $tel2Array = 0;
                $emailArray = 0;
            }
            if (isset($_SESSION["domicilioprov"])) {
                $calleArray = (Validacion::validarArray($_SESSION["domicilioprov"]["calleDomicilio"], 'string') == '800') ? false : true;
                $NumeroArray = (Validacion::validarArray($_SESSION["domicilioprov"]["numeroDomcilio"], 'string') == '800') ? false : true;
                $MunicipioArray = (Validacion::validarArray($_SESSION["domicilioprov"]["municipioDomcilio"], 'integer') == '800') ? false : true;
                $colonia = (Validacion::validarArray($_SESSION["domicilioprov"]["coloniaDomcilio"], 'string') == '800') ? false : true;
                $cpArray = (Validacion::validarArray($_SESSION["domicilioprov"]["cpDomcilio"], 'integer') == '800') ? false : true;
                $RutaArray = (Validacion::validarArray($_SESSION["domicilioprov"]["rutaDomcilio"], 'integer') == '800') ? false : true;
            } else {
                $calleArray = 0;
                $NumeroArray = 0;
                $MunicipioArray = 0;
                $colonia = 0;
                $cpArray = 0;
                $RutaArray = 0;
            }
            // guardo los resultados en un array, para velidarlos en un  foreach  si resulta alguno con valor false cortamos el flujo y mandamos una alerta
            $cliente = array('name' => $nombre, 'rfc' => $rfc);


            foreach ($cliente as $dato => $valor) {
                if ($valor == false) {
                    $_SESSION['formulario_cliente'] = array(
                        'error' => 'El campo ' . $dato . ' es incorrecto, llena los campos faltantes',
                        'datos' => $cliente
                    );
                    break;
                }
            }

            if (isset($_SESSION['formulario_cliente'])) {
                echo '<script>window.location="' . base_url . 'Proveedor/index"</script>';
            } else {
                // ya que verificamos los campos empezamos a insertar en la base de datos
                $alta = new ProveedorModels();
                $alta->setName($nombre);
                $alta->setRfc($rfc);

                $grabar = $alta->createProveedor();
                if ($grabar) {
                    if (isset($_SESSION["contactoProveedor"])) {
                        for ($i = 0; $i < count($_SESSION["contactoProveedor"]["nombreContacto"]); $i++) {
                            $altaContacto = new ProveedorModels();

                            $altaContacto->setId($grabar);
                            $altaContacto->setNombreCliente(htmlspecialchars($_SESSION["contactoProveedor"]["nombreContacto"][$i]));
                            $altaContacto->setTelefonoCliente(htmlspecialchars($_SESSION["contactoProveedor"]["telefonoContacto"][$i]));
                            $altaContacto->setTelefonoDosCliente(htmlspecialchars($_SESSION["contactoProveedor"]["telefonoSec"][$i]));
                            $altaContacto->setCorreoCliente(htmlspecialchars($_SESSION["contactoProveedor"]["correo"][$i]));

                            $verifInsert = $altaContacto->createContactoProveedor();
                        }
                        if ($verifInsert) {
                            $_SESSION['statusSave'] = "SE INSERTO CORRECTAMENTE";
                            Utls::deleteSession('contactoProveedor');
                        } else {
                            $_SESSION['formulario_cliente_session'] = array(
                                'error' => 'hubo un error al insertar los contactos'
                            );
                            echo '<script>window.location="' . base_url . 'Proveedor/index"</script>';
                        }
                    }
                    if (isset($_SESSION["domicilioprov"])) {

                        for ($i = 0; $i < count($_SESSION["domicilioprov"]["calleDomicilio"]); $i++) {

                            $altaDomicilio = new ProveedorModels();

                            $altaDomicilio->setId($grabar);
                            $altaDomicilio->setRuta($_SESSION["domicilioprov"]["rutaDomcilio"][$i]);
                            $altaDomicilio->setCalle(htmlspecialchars($_SESSION["domicilioprov"]["calleDomicilio"][$i]));
                            $altaDomicilio->setNumero(htmlspecialchars($_SESSION["domicilioprov"]["numeroDomcilio"][$i]));
                            $altaDomicilio->setMunicipio($_SESSION["domicilioprov"]["municipioDomcilio"][$i]);
                            $altaDomicilio->setCp(htmlspecialchars($_SESSION["domicilioprov"]["cpDomcilio"][$i]));
                            $altaDomicilio->setColina(htmlspecialchars($_SESSION["domicilioprov"]["coloniaDomcilio"][$i]));

                            $verifInsertDomicilio = $altaDomicilio->createDomicilioProveedor();
                        }
                        if ($verifInsertDomicilio) {
                            $_SESSION['statusSave'] = "SE INSERTO CORRECTAMENTE";
                            Utls::deleteSession('domicilioprov');
                            echo '<script>window.location="' . base_url . 'Proveedor/index"</script>';
                        } else {
                            $_SESSION['formulario_cliente_session'] = array(
                                'error' => 'hubo un error al insertar los domicilios'
                            );
                            echo '<script>window.location="' . base_url . 'Proveedor/index"</script>';
                        }
                    }
                } else {
                    $_SESSION['formulario_cliente'] = array('error' => 'hubo un error al insertar favor de contactar a su administrador', 'datos' => $cliente);
                    echo '<script>window.location="' . base_url . 'Proveedor/index"</script>';
                }
            }
        }
    }

    public function lista()
    {
        $proveedor = new ProveedorModels;
        $proveedor =  $proveedor->getAllWhere('proveedor', 'ORDER BY idProveedor DESC ');

        require_once "views/proveedor/lista.php";
    }

    public function edit()
    {
        if (isset($_GET["id"])) {
            $editPr = new ProveedorModels();
            $consulta = $editPr->getAllWhere('contactoproveedor', 'WHERE proveedorId =' . $_GET["id"])->fetch_all();

            $editDom = new ProveedorModels();
            $domicilio = $editDom->getAllWhere('ShowProveedorEdit', 'WHERE idProveedor=' . $_GET["id"])->fetch_all();

            $estado = new ModeloBase();
            $estadoAdd = $estado->getAll("estados");

            $rta = new ModeloBase();
            $ruta = $rta->getAll('ruta');

            require_once 'views/proveedor/edit.php';
        }
    }

    public function addDomicilio()
    {
        $iddomicilio = (Validacion::validarNumero($_POST['iClienteAdd']) == '-1') ? false : htmlspecialchars($_POST['iClienteAdd']);
        $idCliente = (Validacion::validarNumero($_POST['iClienteAdd']) == '-1') ? false : htmlspecialchars($_POST['iClienteAdd']);
        $nombreCalle = (Validacion::textoLargo($_POST['streetCustomer'], 50) == '900') ? false : htmlspecialchars($_POST['streetCustomer']);
        $numeroCasa = (Validacion::textoLargo($_POST['numeroCustomer'], 3) == '900') ? false : htmlspecialchars($_POST['numeroCustomer']);
        $estado = (Validacion::validarNumero($_POST['inputEstado']) == '-1') ? false : htmlspecialchars($_POST['inputEstado']);
        $municipio = (Validacion::validarNumero($_POST['inpuMunicipio']) == '-1') ? false : htmlspecialchars($_POST['inpuMunicipio']);
        $colonia = (Validacion::textoLargo($_POST['coloniaCustomer'], 80) == '900') ? false : htmlspecialchars($_POST['coloniaCustomer']);
        $cpCliente = (Validacion::validarNumero($_POST['cpCustomer']) == '-1') ? false : htmlspecialchars($_POST['cpCustomer']);

        if ($numeroCasa === false || $numeroCasa === "") {
            $numeroCasa = "SN";
        }

        $verificar = array('idDom' => $iddomicilio, 'id' => $idCliente, 'calle' => $nombreCalle, 'numero' => $numeroCasa, 'estado' => $estado, 'municipio' => $municipio, 'colonia' => $colonia, 'codido postal' => $cpCliente);

        foreach ($verificar as $dato => $valor) {
            if ($valor == false) {
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'El campo ' . $dato . ' es incorrecto, llena los campos faltantes',
                    'datos' => $verificar
                );
                break;
            }
        }

        if (isset($_SESSION['formulario_cliente'])) {
            echo '<script>window.location="' . base_url . 'Proveedor/edit&id=' . $idCliente . '"</script>';
        } else {
            $inserta = new ProveedorModels();
            $inserta->setId($idCliente);
            $inserta->setCalle($nombreCalle);
            $inserta->setNumero($numeroCasa);
            $inserta->setMunicipio($municipio);
            $inserta->setCp($cpCliente);
            $inserta->setColina($colonia);

            $domicilio = $inserta->createDomicilioProveedor();

            if ($domicilio) {
                $_SESSION['statusSave'] = "se inserto correctamente";
                echo '<script>window.location="' . base_url . 'Proveedor/edit&id=' . $idCliente . '"</script>';
            } else {
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'El campo al tratar de insertar intente más tarde o llame a su administrador',
                    'datos' => $verificar
                );
                echo '<script>window.location="' . base_url . 'Proveedor/edit&id=' . $idCliente . '"</script>';
            }
        }
    }

    public function update()
    {

        $iddomicilio = (Validacion::validarNumero($_POST['ProveedodId']) == '-1') ? false : htmlspecialchars($_POST['ProveedodId']);
        $idCliente = (Validacion::validarNumero($_POST['idGet']) == '-1') ? false : htmlspecialchars($_POST['idGet']);
        $nombreCalle = (Validacion::textoLargo($_POST['streetCustomer'], 50) == '900') ? false : htmlspecialchars($_POST['streetCustomer']);
        $numeroCasa = (Validacion::textoLargo($_POST['numeroCustomer'], 5) == '900') ? false : htmlspecialchars($_POST['numeroCustomer']);
        $estado = (Validacion::validarNumero($_POST['edoEdit']) == '-1') ? false : htmlspecialchars($_POST['edoEdit']);
        $municipio = (Validacion::validarNumero($_POST['munEdit']) == '-1') ? false : htmlspecialchars($_POST['munEdit']);
        $colonia = (Validacion::textoLargo($_POST['coloniaCustomer'], 80) == '900') ? false : htmlspecialchars($_POST['coloniaCustomer']);
        $cpCliente = (Validacion::validarNumero($_POST['cpCustomer']) == '-1') ? false : htmlspecialchars($_POST['cpCustomer']);

        $datos = array('iddomicilio' => $iddomicilio, 'nombreCalle' => $nombreCalle, 'numeroCasa' => $numeroCasa, 'estado' => $estado, 'municipio' => $municipio, 'colonia' => $colonia, 'cpCliente' => $cpCliente,);

        foreach ($datos as $dato => $valor) {
            if ($valor == false) {
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'El campo ' . $dato . ' es incorrecto, llena los campos faltantes',
                    'datos' => $datos
                );
                break;
            }
        }

        if(isset($_SESSION['formulario_cliente'])){
            echo '<script>window.location="' . base_url . 'Proveedor/edit&id=' . $idCliente . '"</script>';
        }else{
            $update = new ProveedorModels();
            $update->setId($iddomicilio);
            $update->setCalle($nombreCalle);
            $update->setNumero($numeroCasa);
            $update->setMunicipio($municipio);
            $update->setCp($cpCliente);
            $update->setColina($colonia);
            $envio = $update->updateDireccion();
            if ($envio) {
                $_SESSION['statusSave'] = "se inserto correctamente";
                echo '<script>window.location="' . base_url . 'Proveedor/edit&id=' . $idCliente . '"</script>';
            } else {
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'El campo al tratar de insertar es incorrecto, intente más tarde o llame a su administrador',
                    'datos' => $datos
                );
                echo '<script>window.location="' . base_url . 'Proveedor/edit&id=' . $idCliente . '"</script>';
            }
        }
    }
}
