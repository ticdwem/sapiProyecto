<?php
/* require_once 'config/modeloBase.php'; */
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/modeloBase.php";
class PersonaModel extends ModeloBase {
     
   protected $nombre;
   protected $apellido;
   protected $id;

    public function __construct($nombre = null)
    {
        parent::__construct();
        $this->nombre = $nombre;
        
    }
   /**
    * Get the value of nombre
    */
   public function getNombre()
   {
      return $this->nombre;
   }

   /**
    * Set the value of nombre
    */
   public function setNombre($nombre): self
   {
      $this->nombre = $nombre;

      return $this;
   }

   /**
    * Get the value of apellido
    */
   public function getApellido()
   {
      return $this->apellido;
   }

   /**
    * Set the value of apellido
    */
   public function setApellido($apellido): self
   {
      $this->apellido = $apellido;

      return $this;
   }

   /**
    * Get the value of id
    */
   public function getId()
   {
      return $this->id;
   }

   /**
    * Set the value of id
    */
   public function setId($id): self
   {
      $this->id = $id;

      return $this;
   }
}
