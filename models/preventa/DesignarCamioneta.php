<?php
require_once('DatosProductos.php');

class DesignarCamioneta extends Producto
{
    private Int $idCamioneta;
    private int $idChofer;

    function __construct($nota = null, int $idCamioneta)
    {
        parent::__construct();

        $this->idCamioneta = $idCamioneta;
    }
    

    /**
     * Get the value of idCamioneta
     *
     * @return Int
     */
    public function getIdCamioneta(): Int
    {
        return $this->idCamioneta;
    }

    /**
     * Get the value of idChofer
     *
     * @return int
     */
    public function getIdChofer(): int
    {
        return $this->idChofer;
    }

    /**
     * Set the value of idChofer
     *
     * @param int $idChofer
     *
     * @return self
     */
    public function setIdChofer(int $idChofer): self
    {
        $this->idChofer = $idChofer;

        return $this;
    }

    public function checkRutaCamioneta(){
        $selectCamioneta = "SELECT np.idNotaPedido,np.idClienteNotaPedido,np.rutaNotaPEdido,np.idCamionetaPedido,np.idChoferNotaPedido FROM notapedido np WHERE np.rutaNotaPEdido = {$this->getIdCamioneta()}";
        $query = $this->db->query($selectCamioneta);
        return $query;
    }

    public function checkChofer(){
        $chofer = "SELECT np.idNotaPedido,us.idUsuario,CONCAT(emp.nombrEmpleado,' ',emp.apellidosEmpleado) nomCompleto FROM notapedido np
                    INNER JOIN usuario us
                    ON np.idChoferNotaPedido = us.idUsuario
                    INNER JOIN empleado emp
                    ON us.idEmpleadoUsuario = emp.idEmpleado
                    WHERE np.idChoferNotaPedido = {$this->getIdChofer()}";
        $query = $this->db->query($chofer);
        return $query;
    }


}
