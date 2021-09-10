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
           
            if(isset($_SESSION["contacto"])){
                $nombreArray= (Validacion::validarArray($_SESSION["contacto"]["nombreContacto"],'string') == '800') ? false : true;
                $tel1Array= (Validacion::validarArray($_SESSION["contacto"]["telefonoContacto"],'number') == '800') ? false : true;
                $tel2Array= (Validacion::validarArray($_SESSION["contacto"]["telefonoSec"],'number') == '800') ? false : true;
                $emailArray= (Validacion::validarArray($_SESSION["contacto"]["correo"],'email') == '800') ? false : true;
            }else{
                $nombreArray=0;
                $tel1Array= 0;
                $tel2Array= 0;
                $emailArray= 0;
            }
            if(isset($_SESSION["Domiiclio"])){
                $calleArray= (Validacion::validarArray($_SESSION["Domiiclio"]["nombreCalle"],'string') == '800') ? false : true;
                $NumeroArray= (Validacion::validarArray($_SESSION["Domiiclio"]["numeroCasa"],'string') == '800') ? false : true;
                $MunicipioArray= (Validacion::validarArray($_SESSION["Domiiclio"]["Municipio"],'integer') == '800') ? false : true;
                $cpArray= (Validacion::validarArray($_SESSION["Domiiclio"]["cp"],'integer') == '800') ? false : true;
                $RutaArray= (Validacion::validarArray($_SESSION["Domiiclio"]["ruta"],'integer') == '800') ? false : true;
            }else{
                $calleArray= 0;
                $NumeroArray= 0;
                $MunicipioArray= 0;
                $cpArray= 0;
                $RutaArray= 0;
            }
            // guardo los resultados en un array, para velidarlos en un  foreach  si resulta alguno con valor false cortamos el flujo y mandamos una alerta
            $cliente = array('name'=>$nombre,'rfc'=>$rfc,'nombre'=>$nombreArray,
            'telefono_principal'=>$tel1Array,'telefono_secundario'=>$tel2Array,'email'=>$emailArray,'calle'=>$calleArray,'Numero'=>$NumeroArray,'Municipio'=>$MunicipioArray,'cp'=>$cpArray,'Ruta'=>$RutaArray);
           

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
                  if(isset($_SESSION["contacto"])){
                        for($i = 0; $i < count($_SESSION["contacto"]["nombreContacto"]); $i++){
                            $altaContacto = new ProveedorModels();
                            
                            $altaContacto->setId($grabar);
                            $altaContacto->setNombreCliente(htmlspecialchars($_SESSION["contacto"]["nombreContacto"][$i]));
                            $altaContacto->setTelefonoCliente(htmlspecialchars($_SESSION["contacto"]["telefonoContacto"][$i]));
                            $altaContacto->setTelefonoDosCliente(htmlspecialchars($_SESSION["contacto"]["telefonoSec"][$i]));
                            $altaContacto->setCorreoCliente(htmlspecialchars($_SESSION["contacto"]["correo"][$i]));

                            $verifInsert = $altaContacto->createContactoProveedor();
                            
                        }                   

                        if($verifInsert){
                            $_SESSION['statusSave'] = "SE INSERTO CORRECTAMENTE";
                            Utls::deleteSession('contacto');
                        }else{
                            $_SESSION['formulario_cliente'] = array(
                                'error' => 'hubo un error al insertar',
                                'datos' => $cliente
                            );
                            echo '<script>window.location="'.base_url.'Proveedor/index"</script>';
                        }
                    }
                    if(isset($_SESSION["Domiiclio"])){
                        
                        for($i = 0; $i < count($_SESSION["Domiiclio"]["nombreCalle"]); $i++){

                            $altaDomicilio = new ProveedorModels();   

                            $altaDomicilio->setId($grabar);
                            $altaDomicilio->setRuta($_SESSION["Domiiclio"]["ruta"][$i]);
                            $altaDomicilio->setCalle(htmlspecialchars($_SESSION["Domiiclio"]["nombreCalle"][$i]));
                            $altaDomicilio->setNumero(htmlspecialchars($_SESSION["Domiiclio"]["numeroCasa"][$i]));
                            $altaDomicilio->setMunicipio($_SESSION["Domiiclio"]["Municipio"][$i]);
                            $altaDomicilio->setCp(htmlspecialchars($_SESSION["Domiiclio"]["cp"][$i]));

                            $verifInsertDomicilio = $altaDomicilio->createDomicilioProveedor();
                            
                        }                   
                        if($verifInsertDomicilio){
                            $_SESSION['statusSave'] = "SE INSERTO CORRECTAMENTE";
                            Utls::deleteSession('Domiiclio');
                            echo '<script>window.location="'.base_url.'Proveedor/index"</script>';
                        }else{
                            $_SESSION['formulario_cliente'] = array(
                                'error' => 'hubo un error al insertar',
                                'datos' => $cliente
                            );
                            echo '<script>window.location="'.base_url.'Proveedor/index"</script>';
                        }
                        
                    }
                }else{ $_SESSION['formulario_cliente'] = array( 'error' => 'hubo un error al insertar favor de contactar a su administrador','datos' => $cliente);echo '<script>window.location="'.base_url.'Cliente/index"</script>';}
            }
        }

    }

}