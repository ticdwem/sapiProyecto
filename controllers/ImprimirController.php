<?php //require_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/controllers/AndenController.php';    
require_once '../vendor/autoload.php'; 
require_once '../models/anden/Imprimir/ImprimirVentaModel.php'; 
/* class ImprimirController{    */ 
  /*   public function imp(){         */
        ob_start();
        $datos = new ImprimirVentaModel();
        $vista = $datos->getAll();
        var_dump($vista);
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml(ob_get_clean());        
        $dompdf->render();
        $dompdf->stream();
    /* } */

/* } */