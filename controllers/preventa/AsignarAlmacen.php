<?php

class AsignarAlmacen
{
   public function almacen($datos)
   {
    $jsonVentas = json_decode($datos,true);
        $venta = $jsonVentas["data"][0];

        $almacen =(Validacion::validarNumero($venta["phone_idAlmacen_9"])==-1)? false: $venta["phone_idAlmacen_9"];
        $nota =(Validacion::validarNumero($venta["phone_nota_10"])==-1)? false: $venta["phone_nota_10"];

        $validar = array('almacen'=>$almacen,'nota'=>$nota);
        $valDato= Utls::sessionValidate($validar);

        if($valDato>1){
            echo 0;
        }else{
            $updateToventa = new UpdateProducto(0,$nota,0);
            $updateToventa->setAlmacen($almacen);
            $todoVenta = $updateToventa->passToVenta();
            if ($todoVenta) {
                echo 1;
            } else {
                echo 2;
            }
            
        }

   }
    
}
