<?php
require_once('DatosPedidos.php');
class EditarCliente extends DatosAnden
{
    private Int $idNota;
    private Int $idCliente;
    private String $nombre;
    private String $telefono;
    private Int $IdRuta;

    function __construct(Int $idNota, Int $idCliente,String $nombre,String $telefono, int $IdRuta)
    {
        parent::__construct();
      $this->idNota = $idNota;
      $this->idCliente = $idCliente;
      $this->nombre = $nombre;
      $this->telefono = $telefono;
      $this->IdRuta = $IdRuta;   
    }  
    
    /**
     * Get the value of idNota
     *
     * @return Int
     */
    public function getIdNota(): Int
    {
        return $this->idNota;
    }

    /**
     * Get the value of idCliente
     *
     * @return Int
     */
    public function getIdCliente(): Int
    {
        return $this->idCliente;
    }
    /**
     * Get the value of nombre
     *
     * @return String
     */
    public function getNombre(): String
    {
        return $this->nombre;
    }

    /**
     * Get the value of telefono
     *
     * @return String
     */
    public function getTelefono(): String
    {
        return $this->telefono;
    }

    /**
     * Get the value of IdRuta
     *
     * @return Int
     */
    public function getIdRuta(): Int
    {
        return $this->IdRuta;
    }

    public function editarCliente(){
        $update = "UPDATE notapedido
                    SET
                        nombreNotaPedido='{$this->getNombre()}',
                        telNotaPEdido='{$this->getTelefono()}',
                        rutaNotaPEdido='{$this->getIdRuta()}'
                    WHERE 
                    idNotaPedido='{$this->getIdNota()}' AND 
                    idClienteNotaPedido='{$this->getIdCliente()}'";
    
        $actualizar = $this->db->query($update);

        $pass = false;
		if($actualizar){
			$pass = true;
		}
		return $pass;	
    }


}
