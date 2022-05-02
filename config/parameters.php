<?php
//define("base_url", "192.168.1.20/sapi"); // base url para llamadas absolutas de la url 
define("base_url", "http://192.168.1.10/sapiProyecto/"); // base url para llamadas absolutas de la url 
define("controller_default", "LogginController"); // controlador por defecto
define("action_default","index");
DEFINE ('MINXDAY',86400); // OBTENEMOS LOS MINUTOS DE TOTALE DE UNA HORA
const GERARQUIA = array('anden','recepcion','supervision','administrador','superadminmistrador');

//define("root",$_SERVER['DOCUMENT_ROOT']);
/* if(isset($_SESSION['usuario'])){
define("Consultorio",$_SESSION['usuario']['consultorio']);
} */