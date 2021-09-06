<?php
session_start();
require_once "../../models/pacienteModels.php";
require_once "../../helpers/validacion.php";
require_once "../../helpers/crypt.php";
require_once "../../controllers/LogginController.php";
require_once "../../controllers/ClienteController.php";


class Ajax
{
	public $tabla;
	public $idDato;
	public $where;
	private $dato;

	public function getDato()
	{
		return $this->dato;
	}

	public function setDato($archivo)
	{
		$this->dato = $archivo;
		return $this;
	}

	/**
	 * Get the value of tabla
	 */
	public function getTabla()
	{
		return $this->tabla;
	}

	/**
	 * Set the value of tabla
	 */
	public function setTabla($tabla): self
	{
		$this->tabla = $tabla;

		return $this;
	}

	/**
	 * Get the value of idDato
	 */
	public function getIdDato()
	{
		return $this->idDato;
	}

	/**
	 * Set the value of idDato
	 */
	public function setIdDato($idDato): self
	{
		$this->idDato = $idDato;

		return $this;
	}

	/**
	 * Get the value of where
	 */
	public function getWhere()
	{
		return $this->where;
	}

	/**
	 * Set the value of where
	 */
	public function setWhere($where): self
	{
		$this->where = $where;

		return $this;
	}


	public function selectMun()
	{
		$query = $this->getDato();
		$sent = new LogginController();
		$sent->getMunicipio($query);
	}

	public function verifCorreo()
	{
		$query = $this->getDato();
		$sent = new LogginController();
		$sent->getCorreoExistent($query);
	}

	public function verifLogg()
	{
		$query = $this->getDato();
		$sent = new LogginController();
		$sent->verifEmailLog($query);
	}

	// creamo session para agregar al contacto solo se permiten 3 contactos por cliente
	public function sessionContacto()
	{
		$datos = $this->getDato();
		$decode = json_decode($datos, true);

		if (isset($_SESSION["contacto"])) {
			$contar = count($_SESSION["contacto"]["nombreContacto"]);
			$regreso = $contar + 1;
			echo $regreso;
			if ($contar < 3) {
				array_push($_SESSION["contacto"]["nombreContacto"], $decode["data"][0]["nombre_nameContactoCustomer_30"]);
				array_push($_SESSION["contacto"]["telefonoContacto"], $decode["data"][0]["phone_telPrCustomer_12"]);
				array_push($_SESSION["contacto"]["telefonoSec"], $decode["data"][0]["phone_telSecCustomer_12"]);
				array_push($_SESSION["contacto"]["correo"], $decode["data"][0]["email_emailContactoCustomer_100"]);
			}
		} else {
			echo 1;
			$_SESSION["contacto"] = array(
				"nombreContacto" => array($decode["data"][0]["nombre_nameContactoCustomer_30"]),
				"telefonoContacto" => array($decode["data"][0]["phone_telPrCustomer_12"]),
				"telefonoSec" => array($decode["data"][0]["phone_telSecCustomer_12"]),
				"correo" => array($decode["data"][0]["email_emailContactoCustomer_100"])
			);
		}
	}

	public function sessionDomicilios()
	{
		$numeroDomicilio = "";
		$datos = $this->getDato();
		$decode = json_decode($datos, true);

		if($decode["data"][0]["phone_numeroCustomer_5"] == '0'){$numeroDomicilio = "S_N";}else{$numeroDomicilio = $decode["data"][0]["phone_numeroCustomer_5"];}

		if (isset($_SESSION["domicilio"])) {
			$contaDomicilio = count($_SESSION["domicilio"]["calleDomicilio"]);
			$regreso = $contaDomicilio +1;
			echo $regreso;
			if($contaDomicilio<3){
				array_push($_SESSION["domicilio"]["calleDomicilio"],$decode["data"][0]["nombre_streetCustomer_50"]);
				array_push($_SESSION["domicilio"]["numeroDomcilio"],$numeroDomicilio);
				array_push($_SESSION["domicilio"]["estadoDomcilio"],$decode["data"][0]["phone_inputEstado_5"]);
				array_push($_SESSION["domicilio"]["municipioDomcilio"],$decode["data"][0]["phone_inpuMunicipio_5"]);
				array_push($_SESSION["domicilio"]["coloniaDomcilio"],$decode["data"][0]["nombre_coloniaCustomer_50"]);
				array_push($_SESSION["domicilio"]["cpDomcilio"],$decode["data"][0]["phone_cpCustomer_5"]);
				array_push($_SESSION["domicilio"]["rutaDomcilio"],$decode["data"][0]["phone_RutaCustomer_5"]);
			}
		} else {
			echo 1;
			$_SESSION["domicilio"] = array(
				"calleDomicilio" => array($decode["data"][0]["nombre_streetCustomer_50"]),
				"numeroDomcilio" => array($numeroDomicilio),
				"estadoDomcilio" => array($decode["data"][0]["phone_inputEstado_5"]),
				"municipioDomcilio" => array($decode["data"][0]["phone_inpuMunicipio_5"]),
				"coloniaDomcilio" => array($decode["data"][0]["nombre_coloniaCustomer_50"]),
				"cpDomcilio" => array($decode["data"][0]["phone_cpCustomer_5"]),
				"rutaDomcilio" => array($decode["data"][0]["phone_RutaCustomer_5"])
			);
		}
	}

	public function findDatosCleente($tabla,$idMatch){
		if($idMatch == 'idDomicilioCliente'){
			$datos = $this->getDato();
			$consulta = new LogginController();
			$consulta->consultaGeneral($tabla,$idMatch,$datos);
		}elseif($idMatch == 'idContactoCliente'){
			$datos = $this->getDato();
			$consulta = new LogginController();
			$consulta->consultaGeneral($tabla,$idMatch,$datos);
		}
	}

	public function deleteUSer(){
		$id = $this->getDato();
		$delete = new ClienteModels();
		$delete->deleteTable($this->getTabla(),$this->getWhere(),$id);
		echo $delete->db->affected_rows;
	}

	
}
  /* echo "<pre>";
    var_dump($_POST);
   echo "</pre>";
      exit(); */

if (isset($_POST["idEstado"])) {
	$sent = new Ajax();
	$sent->setDato($_POST["idEstado"]);
	$sent->selectMun();
}

if (isset($_POST["correo"])) {
	$sent = new Ajax();
	$sent->setDato($_POST["correo"]);
	$sent->verifCorreo();
}

if (isset($_POST["correoLoggin"])) {
	$sent = new Ajax();
	$sent->setDato($_POST["correoLoggin"]);
	$sent->verifLogg();
}

if (isset($_POST["contacto"])) {
	$contact = new Ajax();
	$contact->setDato($_POST["contacto"]);
	$contact->sessionContacto();
}

if (isset($_POST["domicilio"])) {
	$contact = new Ajax();
	$contact->setDato($_POST["domicilio"]);
	$contact->sessionDomicilios();
}

if(isset($_POST['idcliente'])){
	$contact = new Ajax();
	$contact->setDato($_POST["idcliente"]);
	$contact->findDatosCleente("getDomCliente","idDomicilioCliente");
}

if(isset($_POST['idcontacto'])){
	$contact = new Ajax();
	$contact->setDato($_POST["idcontacto"]);
	$contact->findDatosCleente("contactocliente","idContactoCliente");
}

if(isset($_POST['idDomicilioDelete'])){
	$contact = new Ajax();
	$contact->setDato($_POST["idDomicilioDelete"]);
	$contact->setTabla('domiciliocliente');
	$contact->setWhere('idDomicilioCliente');
	$contact->deleteUSer();
}
