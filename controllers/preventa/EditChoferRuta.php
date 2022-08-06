<?php 
class EditChoferRuta
{
    public function editarcr ($datosjsonEditar){
        $datos = json_decode($datosjsonEditar);
        $datosJson = $datos->data[0];

        $chofer = (Validacion::validarNumero($datosJson->phone_idChofer_10) == -1) ? false : $datosJson->phone_idChofer_10;
        $Ruta = (Validacion::validarNumero($datosJson->phone_idruta_10) == -1) ? false : $datosJson->phone_idruta_10;
        $camioneta = (Validacion::textoLargo($datosJson->dir_idCamioneta_20,10) == 900) ? false : $datosJson->dir_idCamioneta_20;
        $fecha = (Validacion::valFecha($datosJson->dateUs_Fecha_20) == 0) ? false : $datosJson->dateUs_Fecha_20;

        if($chofer == false|| $Ruta == false|| $camioneta == false|| $fecha == false){
            echo 0;
        }else{
            $update= new EditChoferRutaModels($Ruta,$camioneta,$fecha);
            $update->setIdChofer($chofer);
            $choferUpdate = $update->editCamionetaChofer();
            if($choferUpdate){
                echo 1;
            }else{
                echo 2;
            }
        }


    }    
}
