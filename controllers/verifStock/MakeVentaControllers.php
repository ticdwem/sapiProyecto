<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/models/anden/venta/VentaTerminadaModel.php';

class MakeVentaControllers
{
    public function __construct()
    {
        //validamos si extiste a sesison
      if(!isset($_SESSION['usuario'])){Utls::sinSession();}
    }
    public function venta($datos){
        $nota = ((Validacion::validarNumero($datos->phone_idget_20) == -1)) ? false : $datos->phone_idget_20;
        $idCli = ((Validacion::validarNumero($datos->phone_idcli_20) == -1)) ? false : $datos->phone_idcli_20;
        $idNotaVena = ((Validacion::validarLArgo($datos->messagge_idVentas_40,40)==-1)) ? false : $datos->messagge_idVentas_40;
        $total = ((Validacion::validarFloat($datos->decimales_totalHiden_50) == false)) ? false : $datos->decimales_totalHiden_50;
        $limCredito = ((Validacion::validarFloat($datos->decimales_limCredito_50) == false)) ? false : $datos->decimales_limCredito_50;
        $descuento = ((Validacion::validarFloat($datos->decimales_descuentoCliente_50) == false)) ? false : $datos->decimales_descuentoCliente_50;
       
        $validar = array("nota"=>$nota,"idCli"=>$idCli,"idNotaVena"=>$idNotaVena,"total"=>$total,"limCredito"=>$limCredito,"descuento"=>$descuento);

        $val = Utls::sessionValidate($validar);
        if($val > 1){
            echo '<script>window.location="' . base_url . 'Anden/index"</script>';
        }else{
            $venta = new VentaTerminadaModel($nota,$idCli,$idNotaVena,$total,$limCredito,$descuento);
            $datosVenta = $venta->deleteFromPedidos();
            if($datosVenta){
                echo 1;
            }else{
                echo 0;
            }

        }
    }
}
