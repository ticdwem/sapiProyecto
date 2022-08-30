<?php
//define("base_url", "192.168.1.20/sapi"); // base url para llamadas absolutas de la url 
define("host","192.168.1.25");
define('bd','sapi');
define('pasword','Pilarica2021');
define('user','pilarica');
define('project','sapiProyecto');
define("base_url", "http://".host.'/'.project.'/'); // base url para llamadas absolutas de la url 
define("controller_default", "LogginController"); // controlador por defecto
define("action_default","index");
define ('MINXDAY',86400); // OBTENEMOS LOS MINUTOS DE TOTALE DE UNA HORA
const GERARQUIA = array('anden','recepcion','supervision','administrador','superadminmistrador','chofer');
const ALMACEN = array('z','A','B','C','D');
const STATUSYSTEM = array('capturado','Aprobado Don Lalo','Asignado a Ruta','Venta');

//define("root",$_SERVER['DOCUMENT_ROOT']);
if(isset($_SESSION['usuario'])){
    define("IDUSER",$_SESSION["usuario"]["id"]);
}