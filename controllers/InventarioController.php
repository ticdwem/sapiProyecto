<?php
/* require_once($_SERVER['DOCUMENT_ROOT'] . '/sapiProyecto/models/anden/Inventario/InventarioGlobalModel.php'); */
require_once 'models/InventarioGlobalModel.php';
require_once 'models/anden/selectAnden/ConsultaAlmacenModel.php';
class InventarioController 
{
    public function inXproducto(){
        $prodcuto = (Validacion::validarNumero(SED::decryption($_GET['id'])) == -1) ? false : SED::decryption($_GET['id']);
        if($prodcuto == false){
            $_SESSION['formulario_cliente'] = array(
                'error' => 'faltan datos necesarios para hacer la acción'
            );
            echo '<script>window.location="' . base_url .'Anden/inventario"</script>';
            exit;
        }

        $datos = new InventarioGlobalModel(NULL,$prodcuto);
        $inv = $datos->inventarioAnden();

        require_once('views/anden/inventario/inventarioXprodcuto.php'); 
    }   
    // este contiene le inventario de todos lo almacenes
    public function Almacenes(){
        $anden = new ConsultaAlmacenModel();
        $list = $anden->getAll('almacen');

        require_once('views/anden/listAnden.php');
    }
    // este contiene el inventario por letra de almacen
    public function almacen(){
        $almacen = (Validacion::validarNumero(SED::decryption($_GET['id'])) == -1) ? false : SED::decryption($_GET['id']);
        if($almacen == false){
            $_SESSION['formulario_cliente'] = array(
                'error' => 'ALMACEN NO EXISTE O DATOS ERRONEOS'
            );
            echo '<script>window.location="' . base_url .'Inventario/Almacenes"</script>';
            exit();
        }
        
        $inventario = new InventarioGlobalModel(SED::decryption($_GET['id']));
        $completo = $inventario->inventarIndiceioAnden();
        require_once('views/anden/inventario/inventarioXAnden.php');
    }
}
