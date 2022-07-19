<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
    }
    $contar = 0;
    $com = "";
    $comentario = $prodEditar[0][5];
    if(is_null($comentario)){
        $com = "Sin nota";
    }else{
        $com = $comentario;
    }
    if($_GET['data'] == "0ea4751abee9821ecdecd7da2fa5b7a2"){$data = 1;}elseif ($_GET['data'] == 'a428a6a869c87ef27f982441b9a14171') {$data = 2;}

    ?>
</div>
<div class="">
    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Pedido</li>
                </ol>
            </nav>
            <div class="container" id="">
                <div class="col-md-12 col-sm-12 col-lg" id="comentarioNota">
                    <form action="<?=base_url?>Pedido/editarNota" method="post">
                        <input type="hidden" name="cliente" value="<?=$_GET['cli']?>">
                        <input type="hidden" name="nota" value="<?=$_GET['id']?>">
                        <div class="row">
                            <div id="notaClienteComentario" class="col-lg-1 col-md-1 col-sm-12 notaClienteComentario">
                                <label for="notaComentario">Nota</label>
                            </div>
                            <div id="inputNota" class="col-lg-8 col-md-8 col-sm-12 inputNota">
                                <input type="text" class="form-control" id="notaComentario" name="notaComentario" aria-describedby="id" placeholder="nota" value="<?=$com?>">
                                <small id="notaComentario" class="form-text text-muted"></small>
                            </div>
                            <?php if($_GET['action'] == 'editar' && $data == 1):?>
                                <div id="btnNota" class="col-lg-3 col-md-3 col-sm-12 btnNota">
                                    <button type="submit" class="btn btn-warning btn-lg">Editar Nota</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <div id="nota" class="col-lg-12 col-md-12 col-sm-12 nota">
                    <div class="row">
                        <div id="" class="col-lg-6 col-md-6 col-sm-12">
                            <label for="numNota">Num Nota</label>
                            <input type="text" class="form-control" id="numNota" name="numNota" aria-describedby="id" placeholder="Numero de nota" value="<?=$_GET['id'];?>" readonly>
                            <small id="numNota" class="form-text text-muted"></small>
                        </div>
                        <div id="EmptyRow" class="col-lg-6 col-md-6 col-sm-12 EmptyRow"></div>
                    </div> 
                </div>
                <div id="datosDom" class="col-lg-12 col-md-12 col-sm-12 datosDom">
                    <div class="row">
                        <div id="idCliente" class="col-lg-4 col-md-4 col-sm-12 idCliente">
                            <label for="inputIdClienteEditar">Id Cliente</label>
                            <input type="text" class="form-control" id="inputIdClienteEditar" name="inputIdClienteEditar" aria-describedby="id" placeholder="icCliente" value="<?=$datos->id?>" readonly>
                            <small id="inputIdClienteEditar" class="form-text text-muted"></small>
                        </div>
                        <div id="nombre" class="col-lg-4 col-md-4 col-sm-12 nombre">
                            <label for="inputNombreClienteEditar">Nombre</label>
                            <input type="text" class="form-control" id="inputNombreClienteEditar" name="inputNombreClienteEditar" aria-describedby="nombreCliente" placeholder="Nombre Cliente" value="<?=$datos->nombre?>" readonly>
                            <small id="inputNombreClienteEditar" class="form-text text-muted"></small>
                        </div> 
                        <div id="detalle" class="col-lg-4 col-md-4 col-sm-12 p-4 detalle">
                            <button type="button" id="btnIdModalDomicilio"  class="btn btn-primary btn-lg btn-block" <?php if($_GET["cli"] == 713){echo 'disabled';} ?>>DETALLE</button>
                        </div>
                    </div> 
                </div>
                <?php if(is_null($datosVentaContado)): ?>                
                <div id="datoContacto" class="col-lg-12 col-md-12 col-sm-12 datoContacto">
                    <div class="row">
                        <div id="telPrin" class="col-lg-4 col-md-4 col-sm-12 telPrin">
                            <label for="telefonoPricnipalEditar">Telefono Principal</label>
                            <input type="text" class="form-control" id="telefonoPricnipalEditar" name="telefonoPricnipalEditar" aria-describedby="telPrin" placeholder="Telefono Principal" value="<?=$datos->telPrinContactoCliente?>" readonly>
                            <small id="telefonoPricnipalEditar" class="form-text text-muted"></small>
                        </div>
                        <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                            <label for="TelSecundarioEditar">Telefono Secundario</label>
                            <input type="text" class="form-control" id="TelSecundarioEditar" name="TelSecundarioEditar" aria-describedby="telSec" placeholder="Telefono Secundario" value="<?php if($datos->telSecundario == 500){echo "Sin Datos";}else{$datos->telSecundario;} ?>" readonly>
                            <small id="TelSecundarioEditar" class="form-text text-muted"></small>
                        </div>
                        <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                            <label for="rutaClienteEditar">Ruta</label>
                            <input type="text" class="form-control" id="rutaClienteEditar" name="rutaClienteEditar" aria-describedby="ruta" placeholder="ruta" value="<?=$datos->nomRuta?>" readonly>
                            <small id="rutaClienteEditar" class="form-text text-muted"></small>
                        </div>
                    </div> 
                </div>
                <?php else: ?>
           <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->    
           <div id="datoContacto" class="col-lg-12 col-md-12 col-sm-12 datoContacto">
                <form action="<?=base_url?>Pedido/editarCliente" method="post">
                <input type="hidden" name="idNota" value="<?=$_GET['id']?>">
                <input type="hidden" name="idCli" value="<?=$_GET['cli']?>">
                    <div class="row">
                        <div id="telPrin" class="col-lg-4 col-md-4 col-sm-12 telPrin">
                            <label for="customName">Nombre Cliente</label>
                            <input type="text" class="form-control" id="customName" name="customName" aria-describedby="telPrin" placeholder="Nombre Cliente" value="<?=$datosVentaContado->nombreNotaPedido?>" onkeyup="mayusculas(this)" <?php if($data == 2){echo 'disabled';} ?>>
                            <small id="customName" class="form-text text-muted"></small>
                        </div>
                        <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                            <label for="customPhone">Telefono Contacto</label>
                            <input type="text" class="form-control" id="customPhone" name="customPhone" aria-describedby="telSec" placeholder="Telefono cliente" value="<?=$datosVentaContado->telNotaPEdido?>" <?php if($data == 2){echo 'disabled';} ?>>
                            <small id="customPhone" class="form-text text-muted"></small>
                        </div>
                        <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                            <label for="rutaCliente">Ruta</label>
                            <select class="form-select form-control " name="rutaClienteSlect" id="rutaClienteSlect" <?php if($data == 2){echo 'disabled';} ?>>
                                <option value="<?=$datosVentaContado->rutaNotaPEdido?>" selected><?=$datosVentaContado->nombreRuta?></option>
                                <?php while ($ruta = $rutas->fetch_object()): ?>
                                <option value="<?=$ruta->idRuta;?>"><?=$ruta->nombreRuta;?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <small id="rutaClienteSlect" class="form-text text-muted"></small>
                    </div> 
                    <?php if($_GET['action'] == 'editar' && $data == 1):?>
                        <div class="col-sm-12 col-md-12 col-lg-12 row mt-3">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div id="mensajeEditar"></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <button type="submit" class="btn btn-warning btn-lg btn-block">Editar Cliente</button>
                            </div>

                        </div>
                    <?php endif; ?>
                </form>
            </div> 
            <?php endif; ?>
           <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->     
                <hr>
                <form id="prodEditForm">
                        <?php if($_GET['action'] == 'editar' && $data == 1 || $_GET["controller"] == "Preventa"):?>
                        <div class="row " id="prodNewForm">
                            <div class="col-lg-1">
                                <label class="mr-sm-2" for="inputCodigoPedidoEditar">Clave</label>
                                <div class="input-group">
                                    <input type="text" name="inputCodigoPedidoEditar" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputCodigoPedidoEditar" autocomplete="off">
                                </div>
                                <div class="inputCodigoPedidoEditar"></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="mr-sm-4" for="inputNombreProdPedidoEditar">Nombre</label>
                                <div class="input-group">
                                    <input type="text" name="inputNombreProdPedidoEditar" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputNombreProdPedidoEditar" readonly autocomplete="off">
                                </div>
                                <div class="inputNombreProdPedidoEditar"></div>
                            </div>
                            <div class="col-lg-2">
                                <label class="mr-sm-2" for="inputPiezasPedidoEditar">Piezas</label>
                                <div class="input-group">
                                    <input type="text" name="inputPiezasPedidoEditar" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPiezasPedidoEditar" autocomplete="off">
                                </div>
                                <div class="inputPiezasPedidoEditar"></div>
                            </div>                        
                            <div class="col-lg-6">
                                <label class="mr-sm-2" for="inputPresentacionPedidoEditar">Observaciones </label>
                                <div class="input-group">
                                <input type="text" name="inputPresentacionPedidoEditar" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPresentacionPedidoEditar"  autocomplete="off">
                                </div>
                                <div class="inputPresentacionPedidoEditar"></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="row col-lg-12 mt-4">
                            <div class="col-sm-6 col-md-6 col-lg-6 row">
                                <?php if($_GET['action'] == 'editar' && $data == 1 || $_GET["controller"] == "Preventa"):?>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <button type="button" class="btn btn-success btn-lg btn-block" id="enterProductoEditar" name="btn-acepta">Agregar Producto</button>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <button type="button" class="btn btn-warning btn-lg btn-block" id="btnFindProductEditar">Buscar</button>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 m-1 row" id="DateDevelopersProductoContenedor">
                                <input type="hidden" name="" id="fechaEntregaPedidoEditar" value="<?=$prodEditar[0][4];?>">

                                
                                <div class="row col-sm-6 col-md-6 col-lg-6" id="DateDevelopersProducto" >
                                    <label for="exampleFormControlFile1">Ingrese Fecha de entrega</label>  
                                    <input class="datepicker" data-date-format="dd/mm/yyyy" id="dateIdPedidoEditr" data-id="dateIdPedidoEditar" autocomplete="off" readonly placeholder="<?=$prodEditar[0][4]?>">
                                </div>
                                
                                <?php if($_GET['action'] == 'editar' && $data == 1 || $_GET["controller"] == "Preventa"):?>
                                        <div class="row col-sm-6 col-md-6 col-lg-6" id="BtnDateDevelopersProducto">   
                                            <button type="button" id="btnIdChangeDate" class="btn btn-primary btn-sm">Cambiar Fecha</button>
                                        </div>    
                                    <?php endif; ?>            
                            </div>
                        </div>
                    </form>
            </div>                  
        </div>        
    </div>
    <div id="cajaPedido" class="col-lg-12 m-t-5">
           <table class="table table-striped" id="registroProductotablePedidoEditar">
                <thead>
                    <tr>
                        <th scope="col">Id Producto</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Piezas</th>
                        <th scope="col">Observaciones(nota)</th>
                    </tr>
                </thead>
                <tbody id="registroProductoPedidoEditar"> 
                <?php foreach($prodEditar as $key): ?> 
                    <tr>
                        <td><?=$key[6]?></td>
                        <td><?=$key[9]?></td>
                        <td><?=$key[7]?></td>
                        <td><?=$key[8]?></td>
                        <td>
                        <?php if($_GET['action'] == 'editar' && $data == 1 || $_GET["controller"] == "Preventa"):?>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type='button' class='btn btn-warning btnEditarPzProducto' data-id="<?=$key[7];?>"><i class="fas fa-edit"></i></button>
                                <button type='button' class='btn btn-danger deleteOnclickDb ml-2' id="<?=$key[6];?>" data-get="<?=$_GET['id']?>"><i class='fa fa-times-circle' id='' aria-hidden='true'></i></button>
                            </div>
                        <?php endif; ?>
                        </td>
                    </tr>
               <?php $contar++; endforeach; ?>
                </tbody>
            </table> 

        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 row">

            <div id="" class="col-sm-12 col-md-6 col-lg-6 mt-4 ">
            <?php if($_GET["controller"] == "Preventa"): ?>
                <div id="divBtnPedidoAceptar" class="mt-3">
                    <button type="button" class="btn btn-success" id="designAlmacen">DESIGNAR ALMACEN</button>
                </div>
         <?php endif; ?>
            </div>
            <div id="idViewAllRows" class="col-sm-12 col-md-6 col-lg-6 mt-4 "><div class="alert alert-info" id="rowsCount" role="alert"> Total Productos: <?=$contar?></div></div>
        </div>
</div>

<!-- modal de las lista de los productos  -->
<div class="modal fade bd-example-modal-lg" id="ListPRod" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">LISTA DE PRODUCTOS</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="table">
                <table class="table table-hover table-striped tablaGenerica" id="table">
                    <thead>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Presentacion</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        <?php while($producto = $productos->fetch_object() ): ?>
                        <tr>    
                                                    
                            <td><?=$producto->idProducto?></td>
                            <td><?=$producto->nombreProducto?></td>
                            <td><?=$producto->presentacionProducto?></td>
                            <td><button type="button" class="btn btn-success selectPRoductPEdido" id="<?=$producto->idProducto?>">Seleccionar</button></td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- modal -->
<div class="modal fade bd-example-modal-lg" id="modalDomicilio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DETALLES CLIENTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="datoContacto" class="col-lg-12 col-md-12 col-sm-12 datoContacto">
            <div class="row">
                <div id="domContacto1" class="col-lg-4 col-md-4 col-sm-12 domContacto1">
                    <label for="calleCliente">Calle</label>
                    <input type="text" class="form-control" id="calleCliente" name="calleCliente" aria-describedby="telPrin" placeholder="calle Domicilio" value="<?=$dom->calleDomicilioCliente?>" readonly>
                    <small id="calleCliente" class="form-text text-muted"></small>
                </div>
                <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                    <label for="numeroDomicilio">Número</label>
                    <input type="text" class="form-control" id="numeroDomicilio" name="numeroDomicilio" aria-describedby="telSec" placeholder="Telefono Secundario" value="<?=$dom->numeroDomicilioCliente?>" readonly>
                    <small id="numeroDomicilio" class="form-text text-muted"></small>
                </div>
                <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                    <label for="cpDomicilio">CP</label>
                    <input type="text" class="form-control" id="cpDomicilio" name="cpDomicilio" aria-describedby="ruta" placeholder="ruta" value="<?=$dom->cpDomicilioCliente?>" readonly>
                    <small id="cpDomicilio" class="form-text text-muted"></small>
                </div>
            </div> 
        </div>
        <divss id="datoContacto" class="col-lg-12 col-md-12 col-sm-12 datoContacto">
            <div class="row">
                <div id="telPrin" class="col-lg-4 col-md-4 col-sm-12 telPrin">
                    <label for="estadoDomicilio">Estado</label>
                    <input type="text" class="form-control" id="estadoDomicilio" name="estadoDomicilio" aria-describedby="telPrin" placeholder="Telefono Principal" value="<?=$dom->estado?>" readonly>
                    <small id="estadoDomicilio" class="form-text text-muted"></small>
                </div>
                <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                    <label for="minicipioDomicilio">Municipio</label>
                    <input type="text" class="form-control" id="minicipioDomicilio" name="minicipioDomicilio" aria-describedby="telSec" placeholder="Telefono Secundario" value="<?= $dom->municipio; ?>" readonly>
                    <small id="minicipioDomicilio" class="form-text text-muted"></small>
                </div>
                <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                    <label for="coloDimiicxiio">Colonia</label>
                    <input type="text" class="form-control" id="coloDimiicxiio" name="coloDimiicxiio" aria-describedby="ruta" placeholder="ruta" value="<?=$dom->coloniaDomicilioCliente?>" readonly>
                    <small id="coloDimiicxiio" class="form-text text-muted"></small>
                </div>
            </div> 
        </divss>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalEditProductEntrega" tabindex="-1" role="dialog" aria-labelledby="modalEditProductEntregaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document"> 
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="modalEditProductEntregaLabel">Editar Piezas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="pzold"> <input type="hidden" id="pzoldValue" value=""></div>
      <div id="getNota"> <input type="hidden" id="idgetEditar" value="<?=$_GET['id'];?>"></div>
      <div class="modal-body">
        <div class="container">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="idProductoModalEdit">Id</label>
                    <input type="text" class="form-control idProductoModalEdit" id="idProductoModalEdit" value="" disabled>
                    <div class="idProductoModalEdit"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombreProdcutoModalEdit">Nombre </label>
                    <input type="text" class="form-control nombreProdcutoModalEdit" id="nombreProdcutoModalEdit" value="" disabled>
                    <div class="nombreProdcutoModalEdit"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="piezasModalEdit">Piezas </label>
                    <input type="text" class="form-control piezasModalEdit" id="piezasModalEdit" value="">
                    <div class="piezasModalEdit"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="presentacionModalEdit">Observaciones</label>
                    <input type="text" class="form-control presentacionModalEdit" id="presentacionModalEdit" value=""  <?php if($_GET['action'] == 'detalle'){ echo "disabled";}?>>
                    <div class="presentacionModalEdit"></div>
                </div>
            </div>
        </div>
      </div>
      <divx class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
        <button type="button" class="btn btn-primary" id="updatePzModalEdit">Actualizar</button>
      </divx>
    </div>
  </div>
</div>
<?php if($_GET["controller"] == "Preventa"): ?>
<!-- Modal -->
<div class="modal fade" id="SelectAlmacen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Asignar a un Almacen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Almacen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($almacen = $almacenes->fetch_object()):?>
                            <tr>
                                <th><?=$almacen->idAlmacen?></th>
                                <td><?=$almacen->nombreAlmacen?></td>
                                <td>
                                    <button type='button' class='btn btn-success selectAlmacen' data-id="<?=$almacen->idAlmacen;?>">SELECCIONAR</button>
                                </td>
                            </tr>                        
                        <?php endwhile?>
                    </tbody>
                </table>
            </div>
      </div>
<!--       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div> -->
    </div>
  </div>
</div>
<?php endif;?>
<script> 
$(document).ready(function(){

    $('#dateIdPedidoEditr').datepicker(
        {
        defaultDate: sumarDias(1),
        minDate:sumarDias(1),
        format: 'dd-mm-yyyy',
        uiLibrary: 'bootstrap4',
        locale: 'es-es',
        beforeShowDay:  function(date){
                show = true;
                if(date.getDay() == 0 || date.getDay() == 6){show = false;}//No Weekends
                for (var i = 0; i < holidays.length; i++) {
                    if (new Date(holidays[i]).toString() == date.toString()) {show = false;}//No Holidays
                }
                var display = [show,'',(show)?'':'No Weekends or Holidays'];//With Fancy hover tooltip!
                return display;
            }
    })


});
    
</script>