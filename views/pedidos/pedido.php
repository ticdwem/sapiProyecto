<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
    }
    Utls::getisNull($datos);
    ?>
</div>
<div class="">
    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
                </ol>
            </nav>
            <div class="container" id="">
                <div class="col-md-12 col-sm-12 col-lg" id="comentarioNota">
                    <div class="row">
                        <div id="notaClienteComentario" class="col-lg-1 col-md-1 col-sm-12 notaClienteComentario">
                            <label for="notaComentario">Nota</label>
                        </div>
                        <div id="inputNota" class="col-lg-11 col-md-11 col-sm-12 inputNota">
                            <input type="text" class="form-control" id="notaComentario" name="notaComentario" aria-describedby="id" placeholder="nota" value="">
                            <small id="notaComentario" class="form-text text-muted"></small>
                        </div>
                    </div>
                </div>
            <div id="nota" class="col-lg-12 col-md-12 col-sm-12 nota">
                    <div class="row">
                        <div id="" class="col-lg-6 col-md-6 col-sm-12">
                            <label for="numNota">Num Nota</label>
                            <input type="text" class="form-control" id="numNota" name="numNota" aria-describedby="id" placeholder="Numero de nota" value="<?=Utls::createNotaId();?>" readonly>
                            <small id="numNota" class="form-text text-muted"></small>
                        </div>
                        <div id="EmptyRow" class="col-lg-6 col-md-6 col-sm-12 EmptyRow">
                            
                        </div>
                    </div> 
                </div>
                <div id="datosDom" class="col-lg-12 col-md-12 col-sm-12 datosDom">
                    <div class="row">
                        <div id="idCliente" class="col-lg-4 col-md-4 col-sm-12 idCliente">
                            <label for="inputIdCliente">Id Cliente</label>
                            <input type="text" class="form-control" id="inputIdCliente" name="inputIdCliente" aria-describedby="id" placeholder="icCliente" value="<?=$datos->id?>" readonly>
                            <small id="inputIdCliente" class="form-text text-muted"></small>
                        </div>
                        <div id="nombre" class="col-lg-4 col-md-4 col-sm-12 nombre">
                            <label for="inputNombreCliente">Nombre</label>
                            <input type="text" class="form-control" id="inputNombreCliente" name="inputNombreCliente" aria-describedby="nombreCliente" placeholder="Nombre Cliente" value="<?=$datos->nombre?>" readonly>
                            <small id="inputNombreCliente" class="form-text text-muted"></small>
                        </div>
                        <div id="detalle" class="col-lg-4 col-md-4 col-sm-12 p-4 detalle">
                            <button type="button" id="btnIdModalDomicilio"  class="btn btn-primary btn-lg btn-block">DETALLE</button>
                        </div>
                    </div> 
                </div>
                <?php if($_GET['id'] != 713):?>
                    <div id="datoContacto" class="col-lg-12 col-md-12 col-sm-12 datoContacto">
                        <div class="row">
                            <div id="telPrin" class="col-lg-4 col-md-4 col-sm-12 telPrin">
                                <label for="telefonoPricnipal">Telefono Principal</label>
                                <input type="text" class="form-control" id="telefonoPricnipal" name="telefonoPricnipal" aria-describedby="telPrin" placeholder="Telefono Principal" value="<?=$datos->telPrinContactoCliente?>" readonly>
                                <small id="telefonoPricnipal" class="form-text text-muted"></small>
                            </div>
                            <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                                <label for="TelSecundario">Telefono Secundario</label>
                                <input type="text" class="form-control" id="TelSecundario" name="TelSecundario" aria-describedby="telSec" placeholder="Telefono Secundario" value="<?php if($datos->telSecundario == 500){echo "Sin Datos";}else{$datos->telSecundario;} ?>" readonly>
                                <small id="TelSecundario" class="form-text text-muted"></small>
                            </div>
                            <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                                <label for="rutaCliente">Ruta</label>
                                <input type="text" class="form-control" id="rutaCliente" name="rutaCliente" aria-describedby="ruta" placeholder="ruta" value="<?=$datos->nomRuta?>" readonly>
                                <small id="rutaCliente" class="form-text text-muted"></small>
                            </div>
                        </div> 
                    </div>
                <?php endif; ?>
                <?php if($_GET['id'] == 713):?>
                    <div id="datoContacto" class="col-lg-12 col-md-12 col-sm-12 datoContacto">
                        <div class="row">
                            <div id="telPrin" class="col-lg-4 col-md-4 col-sm-12 telPrin">
                                <label for="customName">Nombre Cliente</label>
                                <input type="text" class="form-control" id="customName" name="customName" aria-describedby="telPrin" placeholder="Nombre Cliente" value="" onkeyup="mayusculas(this)">
                                <small id="customName" class="form-text text-muted"></small>
                            </div>
                            <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                                <label for="customPhone">Telefono Contacto</label>
                                <input type="text" class="form-control" id="customPhone" name="customPhone" aria-describedby="telSec" placeholder="Telefono cliente" value="" >
                                <small id="customPhone" class="form-text text-muted"></small>
                            </div>
                            <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                                <label for="rutaCliente">Ruta</label>
                                <select class="form-select form-control " id="rutaClienteSlect" >
                                    <option selected>Selecciona una ruta</option>
                                   <?php while ($ruta = $rutas->fetch_object()): ?>
                                    <option value="<?=$ruta->idRuta;?>"><?=$ruta->nombreRuta;?></option>
                                   <?php endwhile; ?>
                                </select>
                            </div>
                            <small id="rutaClienteSlect" class="form-text text-muted"></small>
                        </div> 
                    </div>
                <?php endif; ?>
                <hr>
                <form id="frmPedido">
                    <div class="row " id="prodNewForm">
                        <div class="col-lg-1">
                            <label class="mr-sm-2" for="inputCodigoPedido">Clave</label>
                            <div class="input-group">
                                <input type="text" name="inputCodigoPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputCodigoPedido" autocomplete="off">
                            </div>
                            <div class="inputCodigoPedido"></div>
                        </div>
                        <div class="col-lg-3">
                            <label class="mr-sm-4" for="inputNombreProdPedido">Nombre</label>
                            <div class="input-group">
                                <input type="text" name="inputNombreProdPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputNombreProdPedido" readonly autocomplete="off">
                            </div>
                            <div class="inputNombreProdPedido"></div>
                        </div>
                        <div class="col-lg-2">
                            <label class="mr-sm-2" for="inputPiezasPedido">Piezas</label>
                            <div class="input-group">
                                <input type="text" name="inputPiezasPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPiezasPedido" autocomplete="off">
                            </div>
                            <div class="inputPiezasPedido"></div>
                        </div>
                    
                        <div class="col-lg-6">
                            <label class="mr-sm-2" for="inputPresentacionPedido">Observaciones(nota)</label>
                            <div class="input-group">
                            <input type="text" name="inputPresentacionPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPresentacionPedido"  autocomplete="off">
                            </div>
                            <div class="inputPresentacionPedido"></div>
                        </div>
                    </div>
                    <div class="row col-lg-12 mt-4">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <button type="submit" class="btn btn-success" id="enterProducto" name="btn-acepta">Aceptar</button>
                            <button type="button" class="btn btn-warning" id="btnFindProduct">Buscar</button>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 ">
                            <div class="col-sm-12 col-md-12 col-lg-12 row">  
                                <label for="exampleFormControlFile1">Ingrese Fecha de entrega</label>  
                                <input class="datepicker" data-date-format="dd/mm/yyyy" id="dateIdPedido" autocomplete="off" readonly>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 row mt-2">  
                                <div id="alertDaySunday"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>                      
        </div>        
    </div>
    <div id="cajaPedido" class="col-lg-12 m-t-5">
           <table class="table table-striped" id="registroProductotablePedido">
                <thead>
                    <tr>
                        <th scope="col">Id Producto</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Piezas</th>
                        <th scope="col">Observaciones</th>
                    </tr>
                </thead>
                 <!-- <tbody id="registroProductoPedido">
                                                
                </tbody>-->
                <tbody id="registroProductoPedido">                                                    
                </tbody>
            </table> 
        </div>
        <div class="col-sm-12 col-lg-12 col-md-12 row">
            <div id="divBtnPedidoAceptar" class=" mt-4 col-md-6 col-sm-12 col-lg-6">
                <button type="button" class="btn btn-success btn-block" id="btnPedidoAceptar">HACER PEDIDO</button>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div id="idViewAllRows" class="mt-4 "></div>
            </div>
        </div>
        <div class="alertaInsert col-md-12 col-sm-12 mt-3 mb-3" id="alertaInsert"></div>
</div>

<!-- modal de las editar Pedido  -->
<div class="modal fade bd-example-modal-lg" id="editProductoPedido" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar pedido</h5>
            <input type="hidden" id="idhiddeneditproduct" value="">

        </div>
        <div class="modal-body">
            <div class="editProducto">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputIdProdcuto">IdProducto</label>
                        <input type="text" class="form-control inputIdProdcuto" id="inputIdProdcuto" placeholder="id Producto" disabled>
                        <div class="inputIdProdcuto"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNombreProducto">Nombre</label>
                        <input type="text" class="form-control inputNombreProducto" id="inputNombreProducto" placeholder="Nombre Producto" disabled>
                        <div class="inputNombreProducto"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPiezasEditar">Piezas</label>
                        <input type="text" class="form-control inputPiezasEditar" id="inputPiezasEditar" placeholder="Nombre Producto">
                        <div class="inputPiezasEditar"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPresentacionEditar">Observaciones</label>
                        <input type="text" class="form-control inputPresentacionEditar" id="inputPresentacionEditar" placeholder="Presentacion Producto" >
                        <div class="inputPresentacionEditar"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-12 mt-4">
                        <button type="button" class="btn btn-success" id="idEditarPzProdcuto">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        <th>Observaciones</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        <?php while($producto = $prod->fetch_object() ): ?>
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
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
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
