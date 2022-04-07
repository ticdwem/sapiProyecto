<?php
require_once 'PersonaModel.php';

class UsarioModel extends PersonaModel{
    private $password;

    public function __construct($nombre,$password)
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
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    
}