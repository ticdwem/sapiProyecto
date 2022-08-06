<?php
class DeleteChoferRuta
{
    public function deletecr($jsontoDelete){
        $datos = json_decode($jsontoDelete);
        $datosJson = $datos->Datos[0];
        
        $chofer = (Validacion::validarNumero($datosJson->chofer) == -1) ? false : $datosJson->chofer;
        $camioneta = (Validacion::textoLargo($datosJson->idCamioneta,10) == -1) ? false : $datosJson->idCamioneta;
        $fecha = (Validacion::valFecha($datosJson->date) == 0) ? false :$datosJson->date;

        if($chofer == false || $camioneta == false || $fecha == false){
            echo 0;
        }else{
            $eliminar = new PreventaTrasporteModel($datosJson->idRuta,$datosJson->idCamioneta,$datosJson->date);
            $eliminar->setIdChofer($datosJson->chofer);
            $delte = $eliminar->deleteRutaassigned();

            if($delte){
                echo 1;
            }else{
                echo 2;
            }
        }

    }
    
}
