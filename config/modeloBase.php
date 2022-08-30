<?php
require_once 'db.php';
class ModeloBase{
    public $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    public function close_connection_Databa(){
        $this->db->close();
    }
    public function getAll($tabla){
    	$consulta = "SELECT * FROM $tabla";
        $query = $this->db->query($consulta);
        return $query;
    }

    public function getStoredProcedure($param1,$param2){
        $stored = "CALL rutasManana('".$param1."','".$param2."')";
       
        $query = $this->db->query($stored);
        return $query;
       // $saber = $query->num_rows;
        /* if($query !== false && $query->num_rows > 0){echo 0;}else{echo 1;} */
        /* var_dump($query);
        return $query; */
    }
    
    public function getAllWhere($tabla,$where){
        $consulta = "SELECT * FROM $tabla $where";
        /* Utls::dd($consulta); */
        $query = $this->db->query($consulta);
        return $query;
    }

    public function getCountDatos($tabla,$where,$idAContar){
        $consulta = "SELECT COUNT($idAContar) FROM $tabla
                    WHERE $where ";
        $contar = $this->db->query($consulta);
        return $contar;
    }
    public function getIdCleinte($idAlmacen){
        /*  $getId = "SELECT ifnull(MAX(idnotaVendida),0)+1 AS id FROM notaventa WHERE almacenNotaVenta =  $idAlmacen"; */
         $getId = "SELECT IFNULL(MAX(notaventa.idNotaVenta),0)+1 AS nota FROM notaventa WHERE notaventa.idAlmacenVenta =  $idAlmacen";
         $id = $this->db->query($getId);
         return $id;
    }

    public function getAllStatus($consultorio,$status){
        $getAll="SELECT * FROM listado_pacientes
                 WHERE statusCliente = $status
                 AND id_consultorio = $consultorio";
        $nuevo = $this->db->query($getAll);
        return $nuevo;
    }

    public function getEmailExis($email){
        $validar = "SELECT us.correoUsuario, us.tipoUsuario FROM usuario us WHERE us.correoUsuario = '$email'";
        $query = $this->db->query($validar);

        return $query;
    }

    public function distinctQuery($distin,$table,$where){
        $distinto = "SELECT  $distin FROM $table $where";
       
        $query = $this->db->query($distinto);

        return $query;
    }
    public function deleteTable($tabla,$where,$idUser){
        $validar = "DELETE FROM $tabla WHERE $where='$idUser'";
        $query = $this->db->query($validar);
        return $query;
       
    }

    public function lastId($tabla,$identificador){
        $getId = "SELECT sumar_id(MAX($identificador)) as idTabla FROM  $tabla";
        $query = $this->db->query($getId);
        return $query;
    }


    public function getMenUsuario($getIdUsuario){
        $menu = "SELECT * FROM menuUsuarioDoctor WHERE idUsuario = $getIdUsuario";
        $getMEnu = $this->db->query($menu);
        // //var_dump($menu);

      $menu = array();
      while($arrayMenu = $getMEnu->fetch_object()){
        $menu[]= array( 
                        array($arrayMenu->idMenu,$arrayMenu->nombreSubmenu,$arrayMenu->urlSubmenu,$arrayMenu->iconoMEnu)
                    );
      }
    //   $suMEnu =  json_encode($menu);

        return json_encode($menu);
      
      
        
    }

    public function getdatetomorrow(){
        $dia = getdate();
        if($dia["wday"] == 6){
            $CalcularMañana = date("Y-m-d",strtotime("+2 day"));
        }else{
            $CalcularMañana = date("Y-m-d",strtotime("+1 day"));
        }

        return $CalcularMañana;
    }



}