<?php
/* require_once 'config/modeloBase.php';  */
require_once $_SERVER['DOCUMENT_ROOT'].'/sapiProyecto/config/modeloBase.php';


class PreventaTrasporteModel extends ModeloBase{
    
    private int $idRuta;
    private string $idCamioneta;
    private int $idChofer;
    private string $date;

    public function __construct(int $idRuta = null,string $idCamioneta = null,string $date)
    {
        parent::__construct();
        $this->idRuta = $idRuta;
        $this->idCamioneta = $idCamioneta;
        $this->date = $date;
    }

    public function getIdRuta(){
        return $this->idRuta;
    }

    public function getIdCamioneta(){
        return $this->idCamioneta;
    }
    public function getDateEntrega(){
        return $this->date;
    }

    public function getIdChofer(){
        return $this->idChofer;
    }

    public function setIdChofer(int $idChofer){
       $this->idChofer = $idChofer;

        return $this;
    }

    public function getAllNoAssigned(){
        $camioneta = "SELECT * FROM camioneta cta
                        WHERE NOT EXISTS (SELECT * FROM rutacamioenta rc WHERE rc.camionetaIdCAmioneta = cta.idCamioneta AND rc.fechaSalida = '{$this->getDateEntrega()}')";
        $query = $this->db->query($camioneta);
        return $query;
    }

    public function getAllNoAssignedChofer(){
        $camioneta = "SELECT * FROM usuario us 
                        WHERE 
                            us.gerarquiaUsuario = 5 AND 
                        NOT EXISTS (SELECT * FROM rutacamioenta rc WHERE rc.idchofer = us.idUsuario AND rc.fechaSalida = '{$this->getDateEntrega()}')";
        $query = $this->db->query($camioneta);
        return $query;
    }

    public function insertRutaCamioneta(){
        $insert = "INSERT INTO rutacamioenta
                    (rutaIdRutaCamioneta, camionetaIdCAmioneta, idchofer, fechaSalida)
                    VALUES ('{$this->getIdRuta()}', '{$this->getIdCamioneta()}', '{$this->getIdChofer()}', '{$this->getDateEntrega()}')";
         $query = $this->db->query($insert);
         $verifica = false;
         if($query){
             $verifica = true;
         }
         return $verifica;
    }

}
