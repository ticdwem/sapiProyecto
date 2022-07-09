<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
    }
    $com = "";
    $comentario = $prod->fetch_object()->comentario;
    if(is_null($comentario)){
        $com = "Sin nota";
    }else{
        $com = $comentario;
    }
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
                    <form action="<?=base_url?>Pedido/editarNota" method="post">
                        <input type="hidden" name="cliente" value="<?=$_GET['cli']?>">
                        <input type="hidden" name="nota" value="<?=$_GET['id']?>">
                        <div class="row">
                            <div id="notaClienteComentario" class="col-lg-1 col-md-1 col-sm-12 notaClienteComentario">
                                <label for="notaComentario">Nota</label>
                            </div>
                            <div id="inputNota" class="col-lg-8 col-md-8 col-sm-12 inputNota">
                                <input type="text" class="form-control" id="notaComentario" name="notaComentario" aria-describedby="id" placeholder="nota" value="<?=$com?>" disabled>
                                <small id="notaComentario" class="form-text text-muted"></small>
                            </div>
                            <?php if($_GET['action']!="detalle"): ?>
                            <div id="btnNota" class="col-lg-3 col-md-3 col-sm-12 btnNota">
                                <button type="submit" class="btn btn-warning btn-lg">Editar Nota</button>
                            </div>
                            <?php endif;?>
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
                    <hr>
                <?php if($_GET["controller"] == "Pedido"): ?>
                    <!-- <form id="">
                        <div class="row " id="prodNewForm">
                            <div class="col-lg-2">
                                <label class="mr-sm-2" for="inputCodigoPedido">Código</label>
                                <div class="input-group">
                                    <input type="text" name="inputCodigoPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputCodigoPedidoEditar" autocomplete="off">
                                </div>
                                <div class="inputCodigoPedido"></div>
                            </div>
                            <div class="col-lg-6">
                                <label class="mr-sm-4" for="inputNombreProdPedido">Nombre</label>
                                <div class="input-group">
                                    <input type="text" name="inputNombreProdPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputNombreProdPedido" readonly autocomplete="off">
                                </div>
                                <div class="inputNombreProdPedido"></div>
                            </div>
                            <div class="col-lg-2">
                                <label class="mr-sm-2" for="inputPresentacionPedido">Observaciones(nota)</label>
                                <div class="input-group">
                                <input type="text" name="inputPresentacionPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPresentacionPedido" readonly autocomplete="off">
                                </div>
                                <div class="inputPresentacionPedido"></div>
                            </div>
                            <div class="col-lg-2">
                                <label class="mr-sm-2" for="inputPiezasPedido">Piezas</label>
                                <div class="input-group">
                                    <input type="text" name="inputPiezasPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPiezasPedido" autocomplete="off">
                                </div>
                                <div class="inputPiezasPedido"></div>
                            </div>                        
                        </div>
                        <div class="row col-lg-12 mt-4">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <button type="submit" class="btn btn-success" id="enterProducto" name="btn-acepta">Aceptar</button>
                                <button type="button" class="btn btn-warning" id="btnFindProduct">Buscar</button>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="row">
                                    <label for="exampleFormControlFile1">Ingrese Fecha de entrega (YYYY-MM-DD)</label> 
                                    <input type="text" class="form-control" name="" id="" value="<?=$almacenes->fechaEntregaPedido?>" disabled> 
                                </div>                        
                            </div>
                        </div>
                    </form> -->
                <?php endif; ?>
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
                        <th scope="col">Presentacion</th>
                    </tr>
                </thead>
                <tbody id="registroProductoPedido"> 
                <?php while ($producto = $prod->fetch_object()): ?> 
                    <tr>
                        <td><?=$producto->idProductoPedido;?></td>
                        <td><?=$producto->nombreProducto;?></td>
                        <td><?=$producto->pzProductoPedido;?></td>
                        <td><?=$producto->detalleEntrega;?></td>
                        <?php if($_GET['action']!="detalle"): ?>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type='button' class='btn btn-warning modalEditProduct' data-id="<?=$producto->pzProductoPedido;?>"><i class="fas fa-edit"></i></button>
                                <button type='button' class='btn btn-danger deleteOnclickDb ml-2' id="<?=$producto->idProductoPedido?>" data-get="<?=$_GET['id']?>"><i class='fa fa-times-circle' id='' aria-hidden='true'></i></button>
                            </div>                            
                        </td>
                        <?php endif ?>
                    </tr>
               <?php endwhile; ?>
                </tbody>
            </table> 
        </div>
        <?php if($_GET["controller"] == "Preventa"): ?>
            <div id="divBtnPedidoAceptar" class="mt-3">
                <button type="button" class="btn btn-success" id="designAlmacen">DESIGNAR ALMACEN</button>
            </div>
         <?php endif; ?>
        <div class="alertaInsert col-md-12 col-sm-12 mt-3 mb-3" id="alertaInsert"></div>
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
<div class="modal fade" id="modalEditProduct" tabindex="-1" role="dialog" aria-labelledby="modalEditProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document"> 
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="modalEditProductLabel">Editar Piezas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="pzold"> <input type="hidden" id="pzoldValue" value=""></div>
      <div id="getNota"> <input type="hidden" id="idget" value="<?=$_GET['id'];?>"></div>
      <div class="modal-body">
        <div class="container">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="idProducto">Id</label>
                    <input type="text" class="form-control idProducto" id="idProducto" value="" disabled>
                    <div class="idProducto"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombreProdcuto">Nombre </label>
                    <input type="text" class="form-control nombreProdcuto" id="nombreProdcuto" value="" disabled>
                    <div class="nombreProdcuto"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="presentacion">Presentacion</label>
                    <input type="text" class="form-control presentacion" id="presentacion" value="" disabled>
                    <div class="presentacion"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="piezas">Piezas </label>
                    <input type="text" class="form-control piezas" id="piezas" value="">
                    <div class="piezas"></div>
                </div>
            </div>
        </div>
      </div>
      <divx class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
        <button type="button" class="btn btn-primary" id="updatePz">Actualizar</button>
      </divx>
    </div>
  </div>
</div>

<!-- almacen -->
<div class="modal fade bd-example-modal-lg" id="SelectAlmacen" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditProductLabel">Almacenes</h5>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
        <button type="button" class="btn btn-primary" id="updatePz">Actualizar</button>
      </div> -->
    </div>
   </div>
</div>
<script> 

$(document).on('click','.modalEditProduct',function(){
    let idPro = $(this).parents("tr").find("td")[0].innerHTML;
    let producto = $(this).parents("tr").find("td")[1].innerHTML;
    let present = $(this).parents("tr").find("td")[2].innerHTML;
    let pieza = $(this).parents("tr").find("td")[3].innerHTML;
    let pzOld = $(this).attr('data-id')
    $("#idProducto").val(idPro);
    $("#nombreProdcuto").val(producto);
    $("#presentacion").val(present);
    $("#piezas").val(pieza);
    $("#pzoldValue").val(pieza)
    $('#modalEditProduct').modal('show');
});

$("#designAlmacen").on("click",function(){
    $("#SelectAlmacen").modal({backdrop: 'static', keyboard: false});
});

$(document).on('click','.selectAlmacen',function(){
    /* let idAlmacen = $(this).parents("tr").find("td")[0].innerHTML; */
    let idAlmacen = $(this).attr('data-id');
    let nota = $("#numNota").val();
    let datos = Array();
    let validar;

    datos.push({'phone_idAlmacen_9':idAlmacen,'phone_nota_10':nota});
    validar=validarCampos(datos);
    if(validar > 0){
        Swal.fire(
                'error!',
                'HAY DATOS ERRONEOS VERIFICA O LLAMA A TU ADMINISTRADOR',
                'error'
                )
        
    }else{
        let data = { "data": datos }
		var json = JSON.stringify(data);
        $.ajax({
            url: getAbsolutePath() + "views/layout/ajax.php",
            method: "POST",
            data: { "updateToVenta": json },
            cache: false,
            beforeSend: function () {
            },
            success: function (updateToVenta) {	
                if(updateToVenta == 1){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $(location).attr('href',getAbsolutePath() + "Preventa/index");
                }
            }
        });
    }

});


</script>