<?php

class PedidoAnteriorController
{

    public function lista($datos){
        if($datos == 0){            
            $fechahoy = date("d-m-Y");
            $fecha = Utls::diasAnteriores($fechahoy,1);
            $consulta = new PedidoHistorico($fecha);
            $pedidos = $consulta->historicoPedidoRecepcion();
            $this->recorrerWhile($pedidos);            
         }else{
             $validar = Validacion::valFecha($datos);
             if($validar == 0 || $validar == -1){
                 echo -2;
             }else{   
                $validar30Dias = Utls::restarDias($validar,30);
                if($validar30Dias == 1051 || $validar30Dias == 1052){
                    echo -4; // lanzamos alerta que no puede ver mas de 30 dias;
                }else{
                    $consulta = new PedidoHistorico($validar);
                    $pedidos = $consulta->historicoPedidoRecepcion();
                    $this->recorrerWhile($pedidos);
                }  
             }
         }
    }

    public function recorrerWhile($object){
        $contar = mysqli_num_rows($object);        
        if($contar > 0){            
            $whileJson = array();
            while ($historialPedido = $object->fetch_object()) {
                $data = array(
                    'idnotaPedido' => $historialPedido->idnotaPedido,
                    'idUsuarioPedido' => $historialPedido->idUsuarioPedido,
                    'idClientePedido' => $historialPedido->idClientePedido,
                    'nombreCliente' => $historialPedido->nombreCliente,
                    'fechaAltaProductoPedido' => $historialPedido->fechaAltaProductoPedido,
                    'fechaEntregaPedido' => $historialPedido->fechaEntregaPedido,
                    'rutaId' => $historialPedido->rutaId,
                    'nombreRuta' => $historialPedido->nombreRuta,
                );
                array_push($whileJson, $data);
            }
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($whileJson);
            exit();
        }else{
           echo -1;
        }

    }
}
