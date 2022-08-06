<?php 

class EditChoferRutaModels extends PreventaTrasporteModel
{
    public function __construct(int $idRuta = null,string $idCamioneta = null,string $date)
    {
        parent::__construct($idRuta,$idCamioneta,$date);        
    }

    public function editCamionetaChofer(){
        $update = "UPDATE rutacamioenta SET idchofer = '{$this->getIdChofer()}' WHERE 
                     rutaIdRutaCamioneta = '{$this->getIdRuta()}'
                     AND camionetaIdCAmioneta = '{$this->getIdCamioneta()}'
                     AND fechaSalida = '{$this->getDateEntrega()}'";
        $query = $this->db->query($update);

        $pass = false;
        if($query){
            $pass = true;
        }
        return $pass;
    }
}
