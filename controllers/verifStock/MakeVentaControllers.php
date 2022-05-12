<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/anden/venta/VentaTerminadaModel.php';

class MakeVentaControllers
{
    public function venta($datos){
        $nota = ((Validacion::validarNumero($datos->phone_idget_20) == -1)) ? false : $datos->phone_idget_20;
        $idCli = ((Validacion::validarNumero($datos->phone_idcli_20) == -1)) ? false : $datos->phone_idcli_20;

        if($nota == false || $idCli == false){
            echo -1;
            return;
        }else{
            $venta = new VentaTerminadaModel($nota,$idCli);
            $datosVenta = $venta->deleteFromPedidos();
            if($datosVenta){
                echo 1;
            }else{
                echo 0;
            }

        }
    }
}
