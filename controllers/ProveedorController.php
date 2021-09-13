<?php
require_once $_SERVER['DOCUMENT_ROOT']. "/models/proveedorModels.php";


class ProveedorController{
    public function index(){
        $estado = new ModeloBase();
        $variable = $estado -> getAll("estados");
       
        $ruta = new ModeloBase();
        $nombreRuta = $ruta->getAll('ruta');
        require_once "views/proveedor/index.php";
    }

    public function create(){
        if(isset($_POST['btnGuardarProveedor'])){
            #verificamos que losa campos no halla caracateres especiales
            $nombre = (Validacion::textoLargo($_POST['nameProveedor'],50) == '900') ? false : htmlspecialchars($_POST['nameProveedor']);
            $rfc = (Validacion::validarRFC($_POST['rfcProveedor']) == false) ? false : htmlspecialchars($_POST['rfcProveedor']);
           
            if(isset($_SESSION["contactoProveedor"])){
                $nombreArray= (Validacion::validarArray($_SESSION["contactoProveedor"]["nombreContacto"],'string') == '800') ? false : true;
                $tel1Array= (Validacion::validarArray($_SESSION["contactoProveedor"]["telefonoContacto"],'number') == '800') ? false : true;
                $tel2Array= (Validacion::validarArray($_SESSION["contactoProveedor"]["telefonoSec"],'number') == '800') ? false : true;
                $emailArray= (Validacion::validarArray($_SESSION["contactoProveedor"]["correo"],'email') == '800') ? false : true;
            }else{
                $nombreArray=0;
                $tel1Array= 0;
                $tel2Array= 0;
                $emailArray= 0;
            }
            if(isset($_SESSION["domicilioprov"])){
                $calleArray= (Validacion::validarArray($_SESSION["domicilioprov"]["calleDomicilio"],'string') == '800') ? false : true;
                $NumeroArray= (Validacion::validarArray($_SESSION["domicilioprov"]["numeroDomcilio"],'string') == '800') ? false : true;
                $MunicipioArray= (Validacion::validarArray($_SESSION["domicilioprov"]["municipioDomcilio"],'integer') == '800') ? false : true;
                $colonia= (Validacion::validarArray($_SESSION["domicilioprov"]["coloniaDomcilio"],'string') == '800') ? false : true;
                $cpArray= (Validacion::validarArray($_SESSION["domicilioprov"]["cpDomcilio"],'integer') == '800') ? false : true;
                $RutaArray= (Validacion::validarArray($_SESSION["domicilioprov"]["rutaDomcilio"],'integer') == '800') ? false : true;
            }else{
                $calleArray= 0;
                $NumeroArray= 0;
                $MunicipioArray= 0;
                $colonia=0;
                $cpArray= 0;
                $RutaArray= 0;
            }
            // guardo los resultados en un array, para velidarlos en un  foreach  si resulta alguno con valor false cortamos el flujo y mandamos una alerta
            $cliente = array('name'=>$nombre,'rfc'=>$rfc);
           

            foreach ($cliente as $dato => $valor) {
                if($valor == false){
                    $_SESSION['formulario_cliente'] = array(
                        'error' => 'El campo '.$dato.' es incorrecto, llena los campos faltantes',
                        'datos' => $cliente
                    );
                    break;
                }
            }

            if(isset( $_SESSION['formulario_cliente'])){
                echo '<script>window.location="'.base_url.'Proveedor/index"</script>';
            }else{
                // ya que verificamos los campos empezamos a insertar en la base de datos
                $alta = new ProveedorModels();
                $alta->setName($nombre);
                $alta->setRfc($rfc);

                $grabar = $alta->createProveedor();
                if($grabar){
                    if(isset($_SESSION["contactoProveedor"])){
                        for($i = 0; $i < count($_SESSION["contactoProveedor"]["nombreContacto"]); $i++){
                            $altaContacto = new ProveedorModels();
                            
                            $altaContacto->setId($grabar);
                            $altaContacto->setNombreCliente(htmlspecialchars($_SESSION["contactoProveedor"]["nombreContacto"][$i]));
                            $altaContacto->setTelefonoCliente(htmlspecialchars($_SESSION["contactoProveedor"]["telefonoContacto"][$i]));
                            $altaContacto->setTelefonoDosCliente(htmlspecialchars($_SESSION["contactoProveedor"]["telefonoSec"][$i]));
                            $altaContacto->setCorreoCliente(htmlspecialchars($_SESSION["contactoProveedor"]["correo"][$i]));
                            
                            $verifInsert = $altaContacto->createContactoProveedor();
                            
                        }                          
                        if($verifInsert){
                            $_SESSION['statusSave'] = "SE INSERTO CORRECTAMENTE";
                            Utls::deleteSession('contactoProveedor');
                        }else{
                            $_SESSION['formulario_cliente_session'] = array(
                                'error' => 'hubo un error al insertar los contactos'
                            );
                            echo '<script>window.location="'.base_url.'Proveedor/index"</script>';
                        }
                    }
                    if(isset($_SESSION["domicilioprov"])){
                        
                        for($i = 0; $i < count($_SESSION["domicilioprov"]["calleDomicilio"]); $i++){

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
                        if($verifInsertDomicilio){
                            $_SESSION['statusSave'] = "SE INSERTO CORRECTAMENTE";
                            Utls::deleteSession('domicilioprov');
                            echo '<script>window.location="'.base_url.'Proveedor/index"</script>';
                        }else{
                            $_SESSION['formulario_cliente_session'] = array(
                                'error' => 'hubo un error al insertar los domicilios'
                            );
                            echo '<script>window.location="'.base_url.'Proveedor/index"</script>';
                        }
                        
                    }
                }else{ $_SESSION['formulario_cliente'] = array( 'error' => 'hubo un error al insertar favor de contactar a su administrador','datos' => $cliente);echo '<script>window.location="'.base_url.'Cliente/index"</script>';}
            }
        }

    }

}