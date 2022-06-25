<?php

class PedidoAnteriorController
{

    public function lista($datos){
        if($datos == 0){            
           //$fechahoy = date("d-m-Y");
           $fechahoy = date("2022-03-10");
           $fecha = Utls::diasAnteriores($fechahoy,1);
           $consulta = new PedidoHistorico();
           $pedidos = $consulta->getAllWhere("historico_pedidos","WHERE fechaAltaProductoPedido ='".$fecha."'");
          if(count($pedidos->fetch_row()) > 0){
            
          }
           
        }
    }
    
}
