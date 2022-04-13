<?php
require_once 'PersonaModel.php';

class UsarioModel extends PersonaModel{
    private $password;

    public function __construct($nombre=null,$password=null)
    {
        parent::__construct($nombre);
        $this->password = $password;
    }

    


    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function verificarUser(){
        $select = "SELECT * FROM usuarioempleado WHERE nombreUsuario = '{$this->getNombre()}'";
        $query = $this->db->query($select);
        return $query;
    }

    public function getMenu(){
        $menu = "SELECT * FROM menuEmpleadoLoguin  WHERE id_usuario = {$this->getId()}";
        $query = $this->db->query($menu);
        return $query;
    }
}