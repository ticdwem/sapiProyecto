<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/modeloBase.php";

class ProveedorModels extends ModeloBase
{

    private $id;
    private $name;
    private $rfc;
    private $nombreCliente;
    private $telefonoCliente;
    private $telefonoDosCliente;
    private $correoCliente;
    private $calle;
    private $numero;
    private $municipio;
    private $cp;
    private $ruta;
    private $numCuenta;
    private $colina;




    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of rfc
     */
    public function getRfc()
    {
        return $this->rfc;
    }

    /**
     * Set the value of rfc
     *
     * @return  self
     */
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;

        return $this;
    }

    /**
     * Get the value of nombreCliente
     */
    public function getNombreCliente()
    {
        return $this->nombreCliente;
    }

    /**
     * Set the value of nombreCliente
     *
     * @return  self
     */
    public function setNombreCliente($nombreCliente)
    {
        $this->nombreCliente = $nombreCliente;

        return $this;
    }

    /**
     * Get the value of telefonoCliente
     */
    public function getTelefonoCliente()
    {
        return $this->telefonoCliente;
    }

    /**
     * Set the value of telefonoCliente
     *
     * @return  self
     */
    public function setTelefonoCliente($telefonoCliente)
    {
        $this->telefonoCliente = $telefonoCliente;

        return $this;
    }

    /**
     * Get the value of telefonoDosCliente
     */
    public function getTelefonoDosCliente()
    {
        return $this->telefonoDosCliente;
    }

    /**
     * Set the value of telefonoDosCliente
     *
     * @return  self
     */
    public function setTelefonoDosCliente($telefonoDosCliente)
    {
        $this->telefonoDosCliente = $telefonoDosCliente;

        return $this;
    }

    /**
     * Get the value of correoCliente
     */
    public function getCorreoCliente()
    {
        return $this->correoCliente;
    }

    /**
     * Set the value of correoCliente
     *
     * @return  self
     */
    public function setCorreoCliente($correoCliente)
    {
        $this->correoCliente = $correoCliente;

        return $this;
    }

    /**
     * Get the value of calle
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set the value of calle
     *
     * @return  self
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get the value of numero
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of municipio
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set the value of municipio
     *
     * @return  self
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get the value of cp
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get the value of ruta
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set the value of ruta
     *
     * @return  self
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get the value of numCuenta
     */
    public function getNumCuenta()
    {
        return $this->numCuenta;
    }

    /**
     * Set the value of numCuenta
     *
     * @return  self
     */
    public function setNumCuenta($numCuenta)
    {
        $this->numCuenta = $numCuenta;

        return $this;
    }

    /**
     * Get the value of colina
     */
    public function getColina()
    {
        return $this->colina;
    }

    /**
     * Set the value of colina
     */
    public function setColina($colina): self
    {
        $this->colina = $colina;

        return $this;
    }


    public function createProveedor()
    {
        $query = "INSERT INTO proveedor (nombreProveesor, rfcProveedor, statuSistema)
				  VALUES ('{$this->getName()}', '{$this->getRfc()}','999999999');";
        $insert = $this->db->query($query);
        $verifica = false;
        if ($insert) {
            $verifica = mysqli_insert_id($this->db);
        }
        return $verifica;
    }

    public function createContactoProveedor()
    {
        $query = "INSERT INTO contactoproveedor (proveedorId, nombreProveesor, telefono1Proveedor, telefono2proveedor, correoproveedor) 
                                                VALUES ('{$this->getId()}', '{$this->getNombreCliente()}', '{$this->getTelefonoCliente()}', '{$this->getTelefonoDosCliente()}', '{$this->getCorreoCliente()}')";
        $contacto = $this->db->query($query);
        $verifica = false;
        if ($contacto) {
            $verifica = true;
        }

        return $verifica;
    }

    public function createDomicilioProveedor()
    {
        $query = "INSERT INTO domiclioproveedor (proveedorId, calleDomicilioPRoveedor, numeroDomiclioProveedor, municipioDomicilioProveedor, cpDomicilioProveedor,coloniaProv) 
                                                VALUES ('{$this->getId()}', '{$this->getCalle()}', '{$this->getNumero()}', '{$this->getMunicipio()}', '{$this->getCp()}','{$this->getColina()}');";

        $domicilio = $this->db->query($query);
        $insert = false;
        if ($domicilio) {
            $insert = true;
        }
        return $insert;
    }

    public function updateContactoProveedor()
    {
        $query = "UPDATE contactoproveedor
                    SET
                        nombreProveesor='{$this->getNombreCliente()}',
                        telefono1Proveedor='{$this->getTelefonoCliente()}',
                        telefono2proveedor='{$this->getTelefonoDosCliente()}',
                        correoproveedor='{$this->getCorreoCliente()}'
                    WHERE idContactoProveedor='{$this->getId()}'";
        $update = $this->db->query($query);
        $pass = false;
        if ($update) {
            $pass = true;
        }
        return $pass;
    }

    public function updateDireccion()
    {
        $query = "UPDATE domiclioproveedor
        SET

            calleDomicilioPRoveedor='{$this->getCalle()}',
            numeroDomiclioProveedor='{$this->getNumero()}',
            municipioDomicilioProveedor='{$this->getMunicipio()}',
            cpDomicilioProveedor={$this->getCp()},
            coloniaProv='{$this->getColina()}'
        WHERE idDomicilioProveedor={$this->getId()}";

        $update = $this->db->query($query);
        $datos = false;
        if($update){
            $datos = true;
        }
        return $datos;
    }
}
