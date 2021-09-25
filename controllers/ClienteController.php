<?php
/* mandamos a llamara al modelo de clientes */
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/ClienteModel.php";

class ClienteController
{

    /* invocamos a al metodo index */
    public function index()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/models/logginModel.php";
        $estado = new Login();
        $nombreE = $estado->getAll('estados');

        $ruta = new ClienteModels();
        $rta = $ruta->getAll('ruta');

        require_once 'views/cliente/nuevo.php';
    }

    public function create()
    {
        if (isset($_POST["btnEnviar"])) {

            $nameCustomer = (Validacion::textoLargo($_POST['nameCustomer'], 50) == 900) ? false :  htmlspecialchars($_POST['nameCustomer']);
            $rfcCustomer = (Validacion::validarRFC($_POST['rfcCustomer'] == false)) ? false :  htmlspecialchars($_POST['rfcCustomer']);
            $descuento = (Validacion::validarFloat($_POST['descuentoCustomer'] == false)) ? false :  htmlspecialchars($_POST['descuentoCustomer']);

            if (isset($_SESSION["contacto"])) {
                $nombreArray = (Validacion::validarArray($_SESSION["contacto"]["nombreContacto"], 'string') == '800') ? false : true;
                $tel1Array = (Validacion::validarArray($_SESSION["contacto"]["telefonoContacto"], 'number') == '800') ? false : true;
                $tel2Array = (Validacion::validarArray($_SESSION["contacto"]["telefonoSec"], 'number') == '800') ? false : true;
                $emailArray = (Validacion::validarArray($_SESSION["contacto"]["correo"], 'email') == '800') ? false : true;
            } else {
                $nombreArray = 0;
                $tel1Array = 0;
                $tel2Array = 0;
                $emailArray = 0;
            }
            if (isset($_SESSION["domicilio"])) {
                $calleArray = (Validacion::validarArray($_SESSION["domicilio"]["calleDomicilio"], 'string') == '800') ? false : true;
                $NumeroArray = (Validacion::validarArray($_SESSION["domicilio"]["numeroDomcilio"], 'string') == '800') ? false : true;
                $MunicipioArray = (Validacion::validarArray($_SESSION["domicilio"]["municipioDomcilio"], 'integer') == '800') ? false : true;
                $coloniaArray = (Validacion::validarArray($_SESSION["domicilio"]["coloniaDomcilio"], 'integer') == '800') ? false : true;
                $cpArray = (Validacion::validarArray($_SESSION["domicilio"]["cpDomcilio"], 'integer') == '800') ? false : true;
                $RutaArray = (Validacion::validarArray($_SESSION["domicilio"]["rutaDomcilio"], 'integer') == '800') ? false : true;
            } else {
                $calleArray = 0;
                $NumeroArray = 0;
                $MunicipioArray = 0;
                $coloniaArray = 0;
                $cpArray = 0;
                $RutaArray = 0;
            }

            $cliente = array("nombre" => $nameCustomer, "rfc" => $rfcCustomer, "descuento" => $descuento, "nombreCliente" => $nombreArray, "telefonoCleinte" => $tel1Array, "telefono2Cliente" => $tel2Array, "emailCliente" => $emailArray, "calleCleinte" => $calleArray, "numeroCliente" => $NumeroArray, "MunicipioCleinte" => $MunicipioArray, "coloniaCliente" => $coloniaArray, "cpCliente" => $cpArray, "rutaCliente" => $RutaArray);

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
                echo '<script>window.location="' . base_url . 'Cliente/index"</script>';
            } else {
                // ya que verificamos los campos empezamos a insertar en la base de datos */
                $insertCliente = new ClienteModels();
                $insertCliente->setName($nameCustomer);
                $insertCliente->setRfc($rfcCustomer);
                $insertCliente->setDescuento($descuento);
                $inserta = $insertCliente->createCliente();
                if ($inserta) {
                    if (isset($_SESSION['contacto'])) {
                        for ($i = 0; $i < count($_SESSION["contacto"]["nombreContacto"]); $i++) {
                            $insertContacto = new ClienteModels();
                            $insertContacto->setId($inserta);
                            $insertContacto->setNombreCliente($_SESSION["contacto"]["nombreContacto"][$i]);
                            $insertContacto->setTelefonoCliente($_SESSION["contacto"]["telefonoContacto"][$i]);
                            $insertContacto->setTelefonoDosCliente($_SESSION["contacto"]["telefonoSec"][$i]);
                            $insertContacto->setCorreoCliente($_SESSION["contacto"]["correo"][$i]);

                            $verifInsert = $insertContacto->createContacto();
                        }
                        if ($verifInsert) {
                            $_SESSION['statusSave'] = "SE INSERTO CORRECTAMENTE";
                            Utls::deleteSession('contacto');
                        } else {
                            $_SESSION['formulario_cliente'] = array(
                                'error' => 'hubo un error al insertar',
                                'datos' => $cliente
                            );
                            echo '<script>window.location="' . base_url . 'Cliente/index"</script>';
                        }
                    }
                    if (isset($_SESSION['domicilio'])) {

                        for ($i = 0; $i < count($_SESSION["domicilio"]["calleDomicilio"]); $i++) {
                            $altaDomicilio = new ClienteModels();

                            $altaDomicilio->setId($inserta);
                            $altaDomicilio->setRuta($_SESSION["domicilio"]["rutaDomcilio"][$i]);
                            $altaDomicilio->setCalle(htmlspecialchars($_SESSION["domicilio"]["calleDomicilio"][$i]));
                            $altaDomicilio->setNumero(htmlspecialchars($_SESSION["domicilio"]["numeroDomcilio"][$i]));
                            $altaDomicilio->setMunicipio($_SESSION["domicilio"]["municipioDomcilio"][$i]);
                            $altaDomicilio->setCp(htmlspecialchars($_SESSION["domicilio"]["cpDomcilio"][$i]));
                            $altaDomicilio->setColonia(htmlspecialchars($_SESSION["domicilio"]["coloniaDomcilio"][$i]));

                            $verifInsertDomicilio = $altaDomicilio->createDomicilio();
                        }
                        if ($verifInsertDomicilio) {
                            $_SESSION['statusSave'] = "SE INSERTO CORRECTAMENTE";
                            Utls::deleteSession('domicilio');
                        } else {
                            $_SESSION['formulario_cliente'] = array(
                                'error' => 'hubo un error al insertar',
                                'datos' => $cliente
                            );
                            echo '<script>window.location="' . base_url . 'Cliente/index"</script>';
                        }
                    }

                    echo '<script>window.location="' . base_url . 'Cliente/index"</script>';
                } else {
                    $_SESSION['formulario_cliente'] = array('error' => 'hubo un error al insertar favor de contactar a su administrador', 'datos' => $cliente);
                    echo '<script>window.location="' . base_url . 'Cliente/index"</script>';
                }
            }
        }
    }

    public function lista()
    {
        $clientes = new ModeloBase();
        $cliente = $clientes->getAll("cliente");
        require_once "views/cliente/vista.php";
    }

    public function edit()
    {

        if (isset($_GET["id"])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . "/models/logginModel.php";
            // obtenemos informacion del cliente
            $clientes = new ModeloBase();
            $cliente = mysqli_fetch_row($clientes->getAllWhere("cliente", "WHERE idCliente = " . $_GET['id']));
            // obtenemos infromacion de contacto cliente
            $contacto = new ModeloBase();
            $cli = $contacto->getAllWhere("contactocliente", "WHERE ClienteId = " . $_GET['id']);
            //obtenemos la informacion de los domicilios
            $domicilio = new ModeloBase();
            $dom = $domicilio->getAllWhere("domiciliocliente", "WHERE clienteId = " . $_GET['id']);
            /*  var_dump($dom->fetch_object()); */
            // obtenemos los estados
            $estadoEditar = new Login();
            $estado = $estadoEditar->getAll("estados");

            $estadosAdd = new ModeloBase();
            $estadoAdd = $estadosAdd->getAll("estados");
            // obtenemos la ruta
            $getRuta = new ClienteModels();
            $ruta = $getRuta->getAll("ruta");

            require_once "views/cliente/edit.php";
        } else {
            echo '<script>window.location="' . base_url . 'Error/index"</script>';
        }
    }

    /* 
    =======================================================================================================================================================
    =======================================================================================================================================================
    */

    // funcion para editar el cliente en general
    public function editCliente()
    {
        #verificamos que losa campos no halla caracateres especiales $_GET['id']
        $idCliente = (Validacion::validarNumero($_POST['idCleinte']) == '-1') ? false : htmlspecialchars($_POST['idCleinte']);
        $nombre = (Validacion::textoLargo($_POST['inputnombre'], 50) == '900') ? false : htmlspecialchars($_POST['inputnombre']);
        $rfc = (Validacion::validarRFC($_POST['inputRfc']) == '0') ? false : htmlspecialchars($_POST['inputRfc']);
        $descuento = (Validacion::validarNumero($_POST['inputDescuento']) == '-1') ? false : htmlspecialchars($_POST['inputDescuento']);
        $limite = (Validacion::validarNumero($_POST['inputLimite']) == '-1') ? false : htmlspecialchars($_POST['inputLimite']);
        $saldo = (Validacion::validarNumero($_POST['inputSaldo']) == '-1') ? false : htmlspecialchars($_POST['inputSaldo']);

        // guardo los resultados en un array, para velidarlos en un  foreach  si resulta alguno con valor false cortamos el flujo y mandamos una alerta
        $cliente = array('id' => $idCliente, 'name' => $nombre, 'rfc' => $rfc, 'descuento' => $descuento, 'limite' => $limite, 'saldo' => $saldo);

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
            echo '<script>window.location="' . base_url . 'Cliente/edit&id' . $_GET['id'] . '"</script>';
        } else {
            $actualiza = new ClienteModels();
            $actualiza->setId($idCliente);
            $actualiza->setName($nombre);
            $actualiza->setRfc($rfc);
            $actualiza->setDescuento($descuento);
            $actualiza->setLimiteCredito($limite);
            $actualiza->setSaldoCliente($saldo);

            $ClienteUpdate = $actualiza->updateClite();
            if ($ClienteUpdate) {
                $_SESSION['statusSave'] = "se actualizo correctamente";
                echo '<script>window.location="' . base_url . 'Cliente/edit&id=' . $idCliente . '"</script>';
            } else {
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'El campo al tratar de insertar intente más tarde o llame a su administrador',
                    'datos' => $cliente
                );
                echo '<script>window.location="' . base_url . 'Cliente/edit&id' . $idCliente . '"</script>';
            }
        }
    }

    // funcion para actualizar la direccion de los clientes independientemente
    public function update()
    {
        $iddomicilio = (Validacion::validarNumero($_POST['iddomicilio']) == '-1') ? false : htmlspecialchars($_POST['iddomicilio']);
        $idCliente = (Validacion::validarNumero($_POST['iCliente']) == '-1') ? false : htmlspecialchars($_POST['iCliente']);
        $nombreCalle = (Validacion::textoLargo($_POST['inputCalleModal'], 50) == '900') ? false : htmlspecialchars($_POST['inputCalleModal']);
        $numeroCasa = (Validacion::textoLargo($_POST['inputNumeroModal'], 3) == '900') ? false : htmlspecialchars($_POST['inputNumeroModal']);
        $municipio = (Validacion::validarNumero($_POST['selectMunicipioHidden']) == '-1') ? false : htmlspecialchars($_POST['selectMunicipioHidden']);
        $colonia = (Validacion::textoLargo($_POST['coloniaCustomerAdd'], 80) == '900') ? false : htmlspecialchars($_POST['coloniaCustomerAdd']);
        $cpCliente = (Validacion::validarNumero($_POST['inputCPModal']) == '-1') ? false : htmlspecialchars($_POST['inputCPModal']);
        $rutaCliente = (Validacion::validarNumero($_POST['hiddenRuta']) == '-1') ? false : htmlspecialchars($_POST['hiddenRuta']);

        $verificar = array('idDom' => $iddomicilio, 'id' => $idCliente, 'calle' => $nombreCalle, 'numero' => $numeroCasa, 'municipio' => $municipio, 'colonia' => $colonia, 'codido postal' => $cpCliente, 'ruta' => $rutaCliente);

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
            echo '<script>window.location="' . base_url . 'Cliente/edit&id' . $idCliente . '"</script>';
        } else {
            $actualiza = new ClienteModels();
            $actualiza->setCalle($nombreCalle);
            $actualiza->setNumero($numeroCasa);
            $actualiza->setMunicipio($municipio);
            $actualiza->setColonia($colonia);
            $actualiza->setCp($cpCliente);
            $actualiza->setRuta($rutaCliente);
            $actualiza->setId($iddomicilio);

            $domicilio = $actualiza->updateDomicilio();
            if ($domicilio) {
                $_SESSION['statusSave'] = "se actualizo correctamente";
                echo '<script>window.location="' . base_url . 'Cliente/edit&id=' . $idCliente . '"</script>';
            } else {
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'El campo al tratar de insertar intente más tarde o llame a su administrador',
                    'datos' => $verificar
                );
                echo '<script>window.location="' . base_url . 'Cliente/edit&id' . $idCliente . '"</script>';
            }
        }
    }

    // funcion para la insercion de los domicilios independientenmente
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
        $rutaCliente = (Validacion::validarNumero($_POST['RutaCustomer']) == '-1') ? false : htmlspecialchars($_POST['RutaCustomer']);

        if ($numeroCasa === false || $numeroCasa === "") {
            $numeroCasa = "SN";
        }

        $verificar = array('idDom' => $iddomicilio, 'id' => $idCliente, 'calle' => $nombreCalle, 'numero' => $numeroCasa, 'estado' => $estado, 'municipio' => $municipio, 'colonia' => $colonia, 'codido postal' => $cpCliente, 'ruta' => $rutaCliente);

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
            echo '<script>window.location="' . base_url . 'Cliente/edit&id=' . $idCliente . '"</script>';
        } else {
            $actualiza = new ClienteModels();
            $actualiza->setCalle($nombreCalle);
            $actualiza->setNumero($numeroCasa);
            $actualiza->setMunicipio($municipio);
            $actualiza->setColonia($colonia);
            $actualiza->setCp($cpCliente);
            $actualiza->setRuta($rutaCliente);
            $actualiza->setId($iddomicilio);

            $domicilio = $actualiza->createDomicilio();

            if ($domicilio) {
                $_SESSION['statusSave'] = "se actualizo correctamente";
                echo '<script>window.location="' . base_url . 'Cliente/edit&id=' . $idCliente . '"</script>';
            } else {
                $_SESSION['formulario_cliente'] = array(
                    'error' => 'El campo al tratar de insertar intente más tarde o llame a su administrador',
                    'datos' => $verificar
                );
                echo '<script>window.location="' . base_url . 'Cliente/edit&id=' . $idCliente . '"</script>';
            }
        }
    }

    // funcion que actualiza los contactos independientemente
    public function updateContacto()
    {
        if (isset($_POST['contactoAddProv'])) {
            $idCliente = (Validacion::validarNumero($_POST['idClienteEdit']) == '-1') ? false : htmlspecialchars($_POST['idClienteEdit']);
            $idcontacto = (Validacion::validarNumero($_POST['idContactoCliente']) == '-1') ? false : htmlspecialchars($_POST['idContactoCliente']);
            $nombreContacto = (Validacion::textoLargo($_POST['inputnombreContactoEdit'], 50) == '900') ? false : htmlspecialchars($_POST['inputnombreContactoEdit']);
            $telfono = (Validacion::textoLargo($_POST['inputTelObligatorioEdit'], 12) == '900') ? false : htmlspecialchars($_POST['inputTelObligatorioEdit']);
            $telefonoSec = (Validacion::textoLargo($_POST['inputTelSecundarioEdit'], 12) == '900') ? false : htmlspecialchars($_POST['inputTelSecundarioEdit']);
            $email = (Validacion::validarEmail($_POST['inputEmailEdit'], 0) == '-1') ? false : htmlspecialchars($_POST['inputEmailEdit']);

            $verificar = array('idDom' => $idcontacto, 'id' => $idCliente, 'nombre_Contacto' => $nombreContacto, 'telfono' => $telfono, 'telefono Sec' => $telefonoSec, 'email' => $email);

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
                switch ($_POST['contactoAddProv']) {
                    case 'ed53a12cecc92e4014e5f0438e17185a':
                        echo '<script>window.location="' . base_url . 'Proveedor/edit&id' . $idCliente . '"</script>';
                        break;
                    case '4983a0ab83ed86e0e7213c8783940193':
                        echo '<script>window.location="' . base_url . 'Cliente/edit&id' . $idCliente . '"</script>';
                        break;
                    default:
                        echo '<script>window.location="' . base_url . 'Cliente/edit&id' . $idCliente . '"</script>';
                        break;
                }
            } else {
                switch ($_POST['contactoAddProv']) {
                    case 'ed53a12cecc92e4014e5f0438e17185a':
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/models/proveedorModels.php";
                        $actualiza = new ProveedorModels();
                        $actualiza->setNombreCliente($nombreContacto);
                        $actualiza->setTelefonoCliente($telfono);
                        $actualiza->setTelefonoDosCliente($telefonoSec);
                        $actualiza->setCorreoCliente($email);
                        $actualiza->setId($idcontacto);

                        $domicilio = $actualiza->updateContactoProveedor();
                        if ($domicilio) {
                            $_SESSION['statusSave'] = "se actualizo correctamente";
                            echo '<script>window.location="' . base_url . 'Proveedor/edit&id=' . $idCliente . '"</script>';
                        } else {
                            $_SESSION['formulario_cliente'] = array(
                                'error' => 'El campo al tratar de insertar intente más tarde o llame a su administrador',
                                'datos' => $verificar
                            );
                            echo '<script>window.location="' . base_url . 'Proveedor/edit&id' . $idCliente . '"</script>';
                        }
                        break;
                    case '4983a0ab83ed86e0e7213c8783940193':
                        $actualiza = new ClienteModels();
                        $actualiza->setNombreCliente($nombreContacto);
                        $actualiza->setTelefonoCliente($telfono);
                        $actualiza->setTelefonoDosCliente($telefonoSec);
                        $actualiza->setCorreoCliente($email);
                        $actualiza->setId($idcontacto);

                        $domicilio = $actualiza->updateCliente();
                        if ($domicilio) {
                            $_SESSION['statusSave'] = "se actualizo correctamente";
                            echo '<script>window.location="' . base_url . 'Cliente/edit&id=' . $idCliente . '"</script>';
                        } else {
                            $_SESSION['formulario_cliente'] = array(
                                'error' => 'El campo al tratar de insertar intente más tarde o llame a su administrador',
                                'datos' => $verificar
                            );
                            echo '<script>window.location="' . base_url . 'Cliente/edit&id' . $idCliente . '"</script>';
                        }
                        break;
                    default:
                    echo '<script>window.location="' . base_url . 'Error/update"</script>';
                        break;
                }
            }
        }
    }

    // funcion que agrega los contactos clientes independientemente
    public function addContacto()
    {
        if (isset($_POST['contactoAdd'])) {
            $url = "";
            $verifInsert = false;
            $iCliente = (Validacion::validarNumero($_POST["iCliente"]) == '-1') ? false : true;
            $nombreArray = (Validacion::textoLargo($_POST["inputnombreContactoAdd"], 50) == '900') ? false : true;
            $tel1Array = (Validacion::validarNumero($_POST["inputTelObligatorio"]) == '-1') ? false : true;
            $tel2Array = (Validacion::validarNumero($_POST["inputTelSecundarioAdd"]) == '-1') ? false : true;
            $emailArray = (Validacion::validarEmail($_POST["inputEmailAdd"], 0) == '0') ? false : true;

            if ($tel2Array === false || $tel2Array === "") {
                $tel2Array = "500";
            }
            if ($emailArray === false || $emailArray === "") {
                $emailArray = "empty@empty.com";
            }

            $verificar = array('idCliente' => $iCliente, 'nombre_Contacto' => $nombreArray, 'telfono' => $tel1Array, 'telefono Sec' => $tel2Array, 'email' => $emailArray);

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
                switch ($_POST["contactoAdd"]) {
                    case 'ed53a12cecc92e4014e5f0438e17185a':
                        $url = 'Proveedor/';
                        break;
                    case '4983a0ab83ed86e0e7213c8783940193':
                        $url = 'Cliente/';
                        break;
                    default:
                        # code...
                        break;
                }
                echo '<script>window.location="' . base_url . $url . 'edit&id=' . $_POST["iCliente"] . '"</script>';
            } else {
                switch ($_POST["contactoAdd"]) {
                    case 'ed53a12cecc92e4014e5f0438e17185a':
                        $url = 'Proveedor/';
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/models/proveedorModels.php";
                        $altaContactoPro = new ProveedorModels();

                        $altaContactoPro->setId($_POST['iCliente']);
                        $altaContactoPro->setNombreCliente(htmlspecialchars($_POST['inputnombreContactoAdd']));
                        $altaContactoPro->setTelefonoCliente(htmlspecialchars($_POST['inputTelObligatorio']));
                        $altaContactoPro->setTelefonoDosCliente(htmlspecialchars($tel2Array));
                        $altaContactoPro->setCorreoCliente(htmlspecialchars($emailArray));

                        $verifInsert = $altaContactoPro->createContactoProveedor();
                        break;
                    case '4983a0ab83ed86e0e7213c8783940193':
                        $url = 'Cliente/';
                        $altaContacto = new ClienteModels();

                        $altaContacto->setId($_POST['iCliente']);
                        $altaContacto->setNombreCliente(htmlspecialchars($_POST['inputnombreContactoAdd']));
                        $altaContacto->setTelefonoCliente(htmlspecialchars($_POST['inputTelObligatorio']));
                        $altaContacto->setTelefonoDosCliente(htmlspecialchars($tel2Array));
                        $altaContacto->setCorreoCliente(htmlspecialchars($emailArray));

                        $verifInsert = $altaContacto->createContacto();
                        break;
                    default:
                        $verifInsert = false;
                        break;
                }

                if ($verifInsert) {
                    $_SESSION['statusSave'] = "SE INSERTO CORRECTAMENTE";
                    Utls::deleteSession('contacto');
                    echo '<script>window.location="' . base_url . $url . 'edit&id=' . $_POST["iCliente"] . '"</script>';
                } else {
                    $_SESSION['formulario_cliente'] = array(
                        'error' => 'hubo un error al insertar',
                        'datos' => $verificar
                    );
                    echo '<script>window.location="' . base_url . $url . 'index"</script>';
                }
            }
        } else {
            $_SESSION['formulario_cliente'] = array(
                'error' => 'faltan datos necesarios para hacer la acción'
            );
            echo '<script>window.location="' . base_url . $url . 'edit&id=' . $_POST["iCliente"] . '"</script>';
        }
    }
}
