<?php
/* require_once 'config/modeloBase.php';  */
require_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/config/modeloBase.php';


class PreventaModel extends ModeloBase{
    
    public function sotredRutaAsignada(){
        $stored = 'CALL RutaAsignada()';
        $query = $this->db->query($stored);
        $sterd = false;
        if($query){
            $sterd = true;
        }
        return $sterd;
    }
}
