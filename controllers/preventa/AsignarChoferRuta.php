<?php

class AsignarChoferRuta
{
   public function verifCamioneta($datos)
   {
    $idCamioneta = 0;
    $idChofer = 0;
    $numeroDeCamioneta = -1;
    $datosChofer = array();
    $suggest = array('idCamioneta' => "Sin Sugerencia",
                     'placaCamioneta' => "Sin Sugerencia",
                     'marcaCamioneta' => "Sin Sugerencia");
    $idRuta = (Validacion::validarNumero($datos) == -1) ? 0 : $datos ;


    if($idRuta == 0){
        echo 0;
    }else{
        $updateToventa = new DesignarCamioneta(0,$idRuta);
        $todoVenta = $updateToventa->checkRutaCamioneta();
        if ($todoVenta) {
            while ($selectCar = $todoVenta->fetch_object()) {
               if(!is_null($selectCar->idCamionetaPedido)){
                    $idCamioneta = $selectCar->idCamionetaPedido;
                    $idChofer = $selectCar->idChoferNotaPedido;
                    $numeroDeCamioneta = (int)$idCamioneta;
                    break;
               }
            }
       if(is_null($idChofer)){
         $datosChofer = array(
            'idChofer' => "Sin Datos",
            'nomChofer' => "Sin Datos"
         );
        }else{
            $datosChoferConsulta = new DesignarCamioneta(0,$idRuta);
            $datosChoferConsulta->setIdChofer($idChofer);
            $todoChofer = $datosChoferConsulta->checkChofer()->fetch_object();
            
           $datosChofer = array(
              'idChofer' => $todoChofer->idUsuario,
              'nomChofer' => $todoChofer->nomCompleto
           );

       }
            if($idCamioneta != 0){
                $suggestCar = new ModeloBase();
                $selectedCar = $suggestCar->getAllWhere('camioneta','WHERE idCamioneta = '.$numeroDeCamioneta)->fetch_object();

                $suggest = array(
                    'idCamioneta' => $selectedCar->idCamioneta,
                    'placaCamioneta' => $selectedCar->placaCamioneta,
                    'marcaCamioneta' => $selectedCar->marcaCamioneta

                );
            }
           
            $listaRuta = new ModeloBase();
            $car = $listaRuta->getAll('camioneta');
            $datosCar = array();
            array_push($datosCar,$datosChofer );
            while($cars = $car->fetch_object()){
                $returnSuggest = array(
                    'idCamioneta' => $cars->idCamioneta,
                    'placaCamioneta' => $cars->placaCamioneta,
                    'marcaCamioneta' => $cars->marcaCamioneta,
                    
                    
                );
            array_push($datosCar,$returnSuggest);
        }
            array_push($datosCar,$suggest);

           
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($datosCar, JSON_FORCE_OBJECT);
            exit();
        } else {
            echo 2;
        }
        
    }


   }

   public function assignChofer(){

   }
    
}
