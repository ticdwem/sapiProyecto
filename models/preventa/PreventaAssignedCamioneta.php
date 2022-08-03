<?php
/* require_once 'config/modeloBase.php';  */
require_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/config/modeloBase.php';


class PreventaAssignedCamioneta extends ModeloBase{
    private int $ruta;
    private String $fecha;

    public function __construct(int $ruta, String $fecha)
    {
        parent::__construct();
       $this->ruta = $ruta; 
       $this->fecha = $fecha;
    }

    public function getRutaAssigned(){
        return $this->ruta;
    }

    public function getFechaAssigned(){
        return $this->fecha;
    }

    public function checkAssigned(){
        $verify = "SELECT COUNT(rc.rutaIdRutaCamioneta) as Estatus FROM rutacamioenta rc 
                    right JOIN ruta rt
                    ON rc.rutaIdRutaCamioneta = rt.idRuta 
                    WHERE rc.rutaIdRutaCamioneta = '{$this->getRutaAssigned()}' AND 
                    rc.fechaSalida = '{$this->getFechaAssigned()}'";
        $query = $this->db->query( $verify );
        return $query;
    }
}
