<?php
session_start();
require_once "../../config/parameters.php";
require_once "../../models/pacienteModels.php";
require_once "../../models/PedidoModel.php";
require_once "../../models/preventa/deleteProdPreventa.php";
require_once "../../models/preventa/UpdateProducto.php";
require_once "../../models/usuario/UsuarioModel.php";
require_once "../../models/anden/clienteVenta.php";
require_once "../../models/anden/venta/VentaLotenota.php";
require_once "../../helpers/validacion.php";
require_once "../../helpers/crypt.php";
require_once "../../helpers/utls.php";
require_once "../../controllers/LogginController.php";
require_once "../../controllers/ClienteController.php";
require_once "../../controllers/ComprasController.php";
require_once "../../controllers/RemisionController.php";
require_once "../../controllers/PedidoController.php";
require_once "../../controllers/PreventaController.php";
require_once "../../controllers/UpdateVentaLoteController.php";


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
		$sent->verifNameLog($query);
	}

	// creamo session para agregar al contacto solo se permiten 3 contactos por cliente
	public function sessionContacto($sessioncontacto)
	{
		$datos = $this->getDato();
		$decode = json_decode($datos, true);

		if ($sessioncontacto == "contactoCliente") {
			if (isset($_SESSION[$sessioncontacto])) {
				 $contar = count($_SESSION[$sessioncontacto]["nombreContacto"]);
				/*$regreso = $contar + 1;
				echo $regreso; */
				if ($contar < 3) {
					array_push($_SESSION[$sessioncontacto]["nombreContacto"], $decode["data"][0]["nombre_nameContactoCustomer_80"]);
					array_push($_SESSION[$sessioncontacto]["telefonoContacto"], $decode["data"][0]["phone_telPrCustomer_10"]);
					array_push($_SESSION[$sessioncontacto]["telefonoSec"], $decode["data"][0]["phone_telSecCustomer_10"]);
					array_push($_SESSION[$sessioncontacto]["correo"], $decode["data"][0]["email_emailContactoCustomer_100"]);
					array_push($_SESSION[$sessioncontacto]["idrelacionDomicilio"], $decode["data"][0]["phone_idRelacional_12"]);
				}
			} else {
				echo 1;
				$_SESSION[$sessioncontacto] = array(
					"nombreContacto" => array($decode["data"][0]["nombre_nameContactoCustomer_80"]),
					"telefonoContacto" => array($decode["data"][0]["phone_telPrCustomer_10"]),
					"telefonoSec" => array($decode["data"][0]["phone_telSecCustomer_10"]),
					"correo" => array($decode["data"][0]["email_emailContactoCustomer_100"]),
					"idrelacionDomicilio" => array($decode["data"][0]["phone_idRelacional_12"])
				);
			}
		} elseif ($sessioncontacto == "contactoProveedor") {
			if (isset($_SESSION[$sessioncontacto])) {
				$contar = count($_SESSION[$sessioncontacto]["nombreContacto"]);
				/* $regreso = $contar + 1;
				echo $regreso; */
				if ($contar < 3) {
					array_push($_SESSION[$sessioncontacto]["nombreContacto"], $decode["datacontactoProveedor"][0]["nombre_nombreContactoProveedor_80"]);
					array_push($_SESSION[$sessioncontacto]["telefonoContacto"], $decode["datacontactoProveedor"][0]["phone_telefonoContactoProveedor_12"]);
					array_push($_SESSION[$sessioncontacto]["telefonoSec"], $decode["datacontactoProveedor"][0]["phone_telefonoSecProveedor_12"]);
					array_push($_SESSION[$sessioncontacto]["correo"], $decode["datacontactoProveedor"][0]["email_correoProveedor_100"]);
				}
			} else {
				echo 1;
				$_SESSION[$sessioncontacto] = array(
					"nombreContacto" => array($decode["datacontactoProveedor"][0]["nombre_nombreContactoProveedor_80"]),
					"telefonoContacto" => array($decode["datacontactoProveedor"][0]["phone_telefonoContactoProveedor_12"]),
					"telefonoSec" => array($decode["datacontactoProveedor"][0]["phone_telefonoSecProveedor_12"]),
					"correo" => array($decode["datacontactoProveedor"][0]["email_correoProveedor_100"])
				);
			}
		}
	}

	public function sessionDomicilios($sesionNombre)
	{
		$idDomicilio=0;$regreso = 0;
		$numeroDomicilio = "";
		$datos = $this->getDato();
		$decode = json_decode($datos, true);

		if ($sesionNombre == "domiciliocli") {
			if ($decode["data"][0]["phone_numeroCustomer_5"] == '0') {	$numeroDomicilio = "S_N";} else {$numeroDomicilio = $decode["data"][0]["phone_numeroCustomer_5"];}

			if (isset($_SESSION["domiciliocli"])) {

				$lastSession = Utls::lastArray($_SESSION['domiciliocli']["idlastDom"]);
				$contaDomicilio = count($_SESSION[$sesionNombre]["calleDomicilio"]);
				$regreso = $contaDomicilio + 1;
				if ($contaDomicilio < 3) {
					$idDomicilio = $lastSession +1;
					array_push($_SESSION[$sesionNombre]["calleDomicilio"], $decode["data"][0]["nombre_streetCustomer_50"]);
					array_push($_SESSION[$sesionNombre]["numeroDomcilio"], $numeroDomicilio);
					array_push($_SESSION[$sesionNombre]["estadoDomcilio"], $decode["data"][0]["phone_inputEstado_5"]);
					array_push($_SESSION[$sesionNombre]["municipioDomcilio"], $decode["data"][0]["phone_inpuMunicipio_5"]);
					array_push($_SESSION[$sesionNombre]["coloniaDomcilio"], $decode["data"][0]["nombre_coloniaCustomer_50"]);
					array_push($_SESSION[$sesionNombre]["cpDomcilio"], $decode["data"][0]["phone_cpCustomer_5"]);
					array_push($_SESSION[$sesionNombre]["rutaDomcilio"], $decode["data"][0]["phone_RutaCustomer_5"]);
					array_push($_SESSION[$sesionNombre]["idlastDom"], $idDomicilio);
				}
			} else {
				$regreso  = 1;
				$idDomicilio = $decode["data"][0]["phone_idDato_12"];

				$_SESSION["domiciliocli"] = array(
					"calleDomicilio" => array($decode["data"][0]["nombre_streetCustomer_50"]),
					"numeroDomcilio" => array($numeroDomicilio),
					"estadoDomcilio" => array($decode["data"][0]["phone_inputEstado_5"]),
					"municipioDomcilio" => array($decode["data"][0]["phone_inpuMunicipio_5"]),
					"coloniaDomcilio" => array($decode["data"][0]["nombre_coloniaCustomer_50"]),
					"cpDomcilio" => array($decode["data"][0]["phone_cpCustomer_5"]),
					"rutaDomcilio" => array($decode["data"][0]["phone_RutaCustomer_5"]),
					"idlastDom" => array((int)$decode["data"][0]["phone_idDato_12"])
				);
			}
		} elseif ($sesionNombre == "domicilioprov") {

			if ($decode["dataProveedor"][0]["phone_numeroCasaProveedor_10"] == '0') {
				$numeroDomicilio = "S_N";
			} else {
				$numeroDomicilio = $decode["dataProveedor"][0]["phone_numeroCasaProveedor_10"];
			}

			if (isset($_SESSION[$sesionNombre])) {
				$contaDomicilio = count($_SESSION[$sesionNombre]["calleDomicilio"]);
				$regreso = $contaDomicilio + 1;
				if ($contaDomicilio < 3) {
					array_push($_SESSION[$sesionNombre]["calleDomicilio"], $decode["dataProveedor"][0]["nombre_nombreCalleProveedor_80"]);
					array_push($_SESSION[$sesionNombre]["numeroDomcilio"], $numeroDomicilio);
					array_push($_SESSION[$sesionNombre]["estadoDomcilio"], $decode["dataProveedor"][0]["phone_inpuMunicipio_5"]);
					array_push($_SESSION[$sesionNombre]["municipioDomcilio"], $decode["dataProveedor"][0]["phone_inpuMunicipio_5"]);
					array_push($_SESSION[$sesionNombre]["coloniaDomcilio"], $decode["dataProveedor"][0]["nombre_coloniaProveedor_50"]);
					array_push($_SESSION[$sesionNombre]["cpDomcilio"], $decode["dataProveedor"][0]["phone_cpProveedor_5"]);
					array_push($_SESSION[$sesionNombre]["rutaDomcilio"], $decode["dataProveedor"][0]["phone_RutaProveedor_5"]);
				}
			} else {
				echo 1;
				$_SESSION[$sesionNombre] = array(
					"calleDomicilio" => array($decode["dataProveedor"][0]["nombre_nombreCalleProveedor_80"]),
					"numeroDomcilio" => array($numeroDomicilio),
					"estadoDomcilio" => array($decode["dataProveedor"][0]["phone_inpuMunicipio_5"]),
					"municipioDomcilio" => array($decode["dataProveedor"][0]["phone_inpuMunicipio_5"]),
					"coloniaDomcilio" => array($decode["dataProveedor"][0]["nombre_coloniaProveedor_50"]),
					"cpDomcilio" => array($decode["dataProveedor"][0]["phone_cpProveedor_5"]),
					"rutaDomcilio" => array($decode["dataProveedor"][0]["phone_RutaProveedor_5"])
				);
			}
		}
		echo $regreso."_".$idDomicilio;
	}

	public function getAllRows($tabla,$idmatch){
		$row = new LogginController();
		$row->table = $tabla;
		$row->match = $idmatch;
		$row->id = $this->getDato();
		$row->consultaRows();
	}
	

	public function findDatosCleente($tabla, $idMatch)
	{

	
		$datos = $this->getDato();
		$consulta = new LogginController();
		$consulta->consultaGeneral($tabla, $idMatch, $datos);
	}

	public function deleteUSer()
	{
		$id = $this->getDato();
		$delete = new ClienteModels();
		$delete->deleteTable($this->getTabla(), $this->getWhere(), $id);
		echo $delete->db->affected_rows;
	}

	public function registroCompra(){
		$ver = $this->getDato();
		$registro = new ComprasController();
		$registro->insertCompras($ver);
		//echo $registro;
	}

	public function datosClienteVentas($tabla1,$tabla2){
		$id = (int)$this->getDato();
		
		$cliente = new RemisionController();
		$cliente->clienteVenta($tabla1,$tabla2,$id);

	}

	public function findPVenta(){
		$id = (int)$this->getDato();
		$tbl = $this->getTabla();
		$cliente = new RemisionController();
		$cliente->getProductoVenta($id,$tbl);

	}

	public function datosAlmacen(){
		$suitch = 0;
		$id = json_decode($this->getDato());
		if(is_object($id)){
			$suitch = 1;
		}
		$almacen = new RemisionController();
		$almacen->getProductoAlmacen($this->getDato(),$suitch); 
	}

	public function countPizas(){
		$datos = $this->getDato();
		$pz = new RemisionController();
		$pz->piezaPeso($datos);
	}

	public function verifCliente(){
		$dato = $this->getDato();
		$cliente = new ClienteController();
		$cliente->verificarId($dato);
	}

	public function pedidos(){
		$dato = $this->getDato();
		$pedido = new PedidoController();
		$pedido->crearPedido($dato);
	}

	public function deletePordPEdido(){
		$datos = $this->getDato();
		$pedidoDelete = new PreventaController();
		$pedidoDelete->deleteDatoPedido($datos); 
	}

	public function updatePz(){
		$datos = $this->getDato();
		$UpdateDato = new PreventaController();
		$UpdateDato->updatePiezas($datos);
	}

	public function toVenta(){
		$datos = $this->getDato();
		$toventas = new PreventaController();
		$toventas->sendToVentas($datos);

	}

	public function upLotePeso(){
		
		$datoJson = json_decode($this->getDato(),true);
		$datos = $datoJson["data"][0];
/* 		var_dump($datos);
		die(); */
		$venta = new UpdateVentaLoteController($datos["phone_idget_50"],$datos["phone_idProductoModal_80"],$datos["phone_loteVentaModal_50"],$datos["decimales_pesoModal_50"]);
		$venta->setCliente($datos["phone_idcli_10"]);  
		$venta->setIdNotaVendido($datos["messagge_idVentas_50"]) ; 
		$venta->setPiezas($datos["phone_pz_10"]);
		$venta->lotePeso();
		
	}
}
/* echo "<pre> //////";
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

if (isset($_POST["contactoCliente"])) {
	$contact = new Ajax();
	$contact->setDato($_POST["contactoCliente"]);
	$contact->sessionContacto('contactoCliente');
}

if (isset($_POST["contactoProv"])) {
	$contactoProv = new Ajax();
	$contactoProv->setDato($_POST["contactoProv"]);
	$contactoProv->sessionContacto('contactoProveedor');
}

if (isset($_POST["domicilio"])) {
	$contact = new Ajax();
	$contact->setDato($_POST["domicilio"]);
	$contact->sessionDomicilios("domiciliocli");
}

if (isset($_POST["domicilioProv"])) {
	$provDom = new Ajax();
	$provDom->setDato($_POST["domicilioProv"]);
	$provDom->sessionDomicilios("domicilioprov");
}

if (isset($_POST['idcliente'])) {
	$contact = new Ajax();
	$contact->setDato($_POST["idcliente"]);
	$contact->findDatosCleente("getDomCliente", "idDomicilioCliente");
}

if (isset($_POST['idcontacto'])) {
	$contact = new Ajax();
	$contact->setDato($_POST["idcontacto"]);
	$contact->findDatosCleente("contactocliente", "idContactoCliente");
}

if (isset($_POST['idDomicilioDelete'])) {
	$contact = new Ajax();
	$contact->setDato($_POST["idDomicilioDelete"]);
	$contact->setTabla('domiciliocliente');
	$contact->setWhere('idDomicilioCliente');
	$contact->deleteUSer();
}

if (isset($_POST['idProvDelete'])) {
	$contact = new Ajax();
	$contact->setDato($_POST["idProvDelete"]);
	$contact->setTabla('contactoproveedor');
	$contact->setWhere('idContactoProveedor');
	$contact->deleteUSer();
}
if (isset($_POST['idDomicilioProvDelete'])) {
	$contact = new Ajax();
	$contact->setDato($_POST["idDomicilioProvDelete"]);
	$contact->setTabla('domiclioproveedor');
	$contact->setWhere('idDomicilioProveedor');
	$contact->deleteUSer();
}

if (isset($_POST["idcontactoProv"])) {
	$provCont = new Ajax();
	$provCont->setDato($_POST["idcontactoProv"]);
	$provCont->findDatosCleente('contactoproveedor','idContactoProveedor');
}

if (isset($_POST["idDirProv"])) {
	$dirPro = new Ajax();
	$dirPro->setDato($_POST["idDirProv"]);
	$dirPro->findDatosCleente('getdomproveedor','idDomicilioProveedor');
}
if (isset($_POST["idProveedorSelect"])) {
	$dirPro = new Ajax();
	$dirPro->setDato($_POST["idProveedorSelect"]);
	$dirPro->getAllRows('getdomproveedor','proveedorId');
}
if (isset($_POST["idAlmacenSelect"])) {
	$dirPro = new Ajax();
	$dirPro->setDato($_POST["idAlmacenSelect"]);
	$dirPro->findDatosCleente('almacen','idAlmacen');
}
if (isset($_POST["idProductoCompra"])) {
	$dirPro = new Ajax();
	$dirPro->setDato($_POST["idProductoCompra"]);
	$dirPro->findDatosCleente('producto','idProducto');
}
if(isset($_POST['compra'])){
	$compra = new Ajax();
	$compra->setDato($_POST['compra']);
	$compra->registroCompra();
}
if (isset($_POST['idClienteVenta'])) {
	$contact = new Ajax();
	$contact->setDato($_POST["idClienteVenta"]);
	$contact->datosClienteVentas('getdomcliente','cliente');
}
if (isset($_POST['idClienteFind'])) {
	$contact = new Ajax();
	$contact->setDato($_POST["idClienteFind"]);
	$contact->datosClienteVentas('getdomcliente','cliente');
}
if (isset($_POST['idProductoventa'])) {
	$contact = new Ajax();
	$contact->setDato($_POST["idProductoventa"]);
	$contact->setTabla('productoAlmacenCentral');
	$contact->setWhere('idDomicilioProveedor');
	$contact->findPVenta();
}
if (isset($_POST['almacenFindProduct'])) {
	$contact = new Ajax();
	$contact->setDato($_POST["almacenFindProduct"]);
	$contact->datosAlmacen();
}
if (isset($_POST['idProductoAlamcen'])) {
	$contact = new Ajax();
	$contact->setDato($_POST["idProductoAlamcen"]);
	$contact->datosAlmacen();
}

if(isset($_POST['loteAlamcen'])){
	$lote = new Ajax();
	$lote->setDato($_POST['loteAlamcen']);
	$lote->datosAlmacen();

}
if(isset($_POST['catidadPz'])){
	$lote = new Ajax();
	$lote->setDato($_POST['catidadPz']);
	$lote->countPizas();

}
if(isset($_POST['idCliente'])){
	$lote = new Ajax();
	$lote->setDato($_POST['idCliente']);
	$lote->verifCliente();

}
if (isset($_POST["producto"])) {
	$dirPro = new Ajax();
	$dirPro->setDato($_POST["producto"]);
	$dirPro->findDatosCleente('producto','idProducto');
}

if(isset($_POST["pedido"])){
	$dirPro = new Ajax();
	$dirPro->setDato($_POST["pedido"]);
	$dirPro->pedidos();
}
if(isset($_POST['notaDeleteDb'])){
	$idDelete = new Ajax();
	$idDelete->setDato($_POST["notaDeleteDb"]);
	$idDelete->deletePordPEdido();
}

if(isset($_POST['updatePro'])){
	$update = new Ajax();
	$update->setDato($_POST['updatePro']);
	$update->updatePz();
}

if(isset($_POST['updateToVenta'])){
	$update = new Ajax();
	$update->setDato($_POST['updateToVenta']);
	$update->toVenta();
}

if(isset($_POST['updateVenta'])){
	$venta = new Ajax();
	$venta->setDato($_POST['updateVenta']);
	$venta->upLotePeso();
}

/* if(isset($_POST['existencia'])){
	$existencia = new Ajax
} */