<?php
//require_once ('../../models/preventa/PreventaModel.php');
class AssignNotaToVenta
{
    public function updateNotaVenta($datos){
        $datosUpdate = json_decode($datos);
        $udate = $datosUpdate->data[0];
        $nota = (Validacion::validarNumero($udate->phone_numNota_20) == -1) ? false : $udate->phone_numNota_20;
        $ruta = (Validacion::validarNumero($udate->phone_rutaClienteEditar_20) == -1) ? false : $udate->phone_rutaClienteEditar_20;

        if($nota == false || $ruta == false){
            echo -1;
        }else{
           $venta = new UpdateToVentaModel($ruta,$nota);
           $dato = $venta->vena();

           if($dato){
            echo 1;
           }
        }
    }
}
