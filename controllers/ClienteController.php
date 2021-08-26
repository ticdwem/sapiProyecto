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

            $nameCustomer = (Validacion::textoLargo($_POST['nameCustomer'] == 900)) ? false :  htmlspecialchars($_POST['nameCustomer']);
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
            // obtenemos informacion del cliente
            $clientes = new ModeloBase();
            $cliente = mysqli_fetch_row($clientes->getAllWhere("cliente", "WHERE idCliente = " . $_GET['id']));
            // obtenemos infromacion de contacto cliente
            $contacto = new ModeloBase();
            $cli = $contacto->getAllWhere("contactocliente", "WHERE ClienteId = " . $_GET['id']);
            //obtenemos la informacion de los domicilios
            $domicilio = new ModeloBase();
            $dom = $domicilio->getAllWhere("domiciliocliente", "WHERE clienteId = " . $_GET['id']);
            // obtenemos los estados
            $estadoEditar = new ModeloBase();
            $estado = $estadoEditar->getAll("estados");

            $estadosAdd = new ModeloBase();
            $estadoAdd = $estadosAdd->getAll("estados");
            // obtenemos la ruta
            $getRuta = new ModeloBase();
            $ruta = $getRuta->getAll("ruta");
            require_once "views/cliente/edit.php";
        } else {
            echo '<script>window.location="' . base_url . 'Error/index"</script>';
        }
    }
}
