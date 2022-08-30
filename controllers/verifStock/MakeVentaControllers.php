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
        $data = $datos->data[0];
        /* Utls::dd($_SESSION['usuario']['camra']);
        Utls::dd($datos->producto); 
        die();*/
        if($data->decimales_descuentoCliente_50 == "0.00"){
            $descuento = $data->decimales_descuentoCliente_50;
        }else{
            $descuento = ((Validacion::validarFloat($data->decimales_descuentoCliente_50) == false)) ? false : $data->decimales_descuentoCliente_50;
        } 
        
        $nota = ((Validacion::validarNumero($data->phone_idget_20) == -1)) ? false : $data->phone_idget_20;
        $idCli = ((Validacion::validarNumero($data->phone_idcli_20) == -1)) ? false : $data->phone_idcli_20;
        $idNotaVena = ((Validacion::validarLArgo($data->messagge_idVentas_40,40)==-1)) ? false : $data->messagge_idVentas_40;
        $total = ((Validacion::validarFloat($data->decimales_totalHiden_50) == false)) ? false : $data->decimales_totalHiden_50;
        $limCredito = ((Validacion::validarFloat($data->decimales_limCredito_50) == false)) ? false : $data->decimales_limCredito_50;
        
        $validar = array("nota"=>$nota,"idCli"=>$idCli,"idNotaVena"=>$idNotaVena,"total"=>$total,"limCredito"=>$limCredito,"descuento"=>$descuento);
        
        $val = Utls::sessionValidate($validar);
        if($val > 1){
            echo 0;
        }else{
            $venta = new VentaTerminadaModel($nota,$idCli,$idNotaVena,$total,$limCredito,$descuento);
            $datosVenta = $venta->deleteFromNotaPedidos();
            if($datosVenta){
                foreach ($datos->producto as $key => $value) {
                   $update = new VentaDescontarDeAlmacen($_SESSION['usuario']['camra'],$value->lote,$value->peso,$value->codigo,$value->precio,$value->piezas);
                   $update->updateProductoAlmacen();
                }
                echo 1;
            }else{
                echo 0;
            }

        }
    }
}
