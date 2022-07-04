<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
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
                            <button type="button" id="btnIdModalDomicilio"  class="btn btn-primary btn-lg btn-block">DETALLE</button>
                        </div>
                    </div> 
                </div>
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
                    <hr>
                    <form id="prodEditForm">
                        <div class="row " id="prodNewForm">
                            <div class="col-lg-2">
                                <label class="mr-sm-2" for="inputCodigoPedidoEditar">Código</label>
                                <div class="input-group">
                                    <input type="text" name="inputCodigoPedidoEditar" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputCodigoPedidoEditar" autocomplete="off">
                                </div>
                                <div class="inputCodigoPedidoEditar"></div>
                            </div>
                            <div class="col-lg-6">
                                <label class="mr-sm-4" for="inputNombreProdPedidoEditar">Nombre</label>
                                <div class="input-group">
                                    <input type="text" name="inputNombreProdPedidoEditar" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputNombreProdPedidoEditar" readonly autocomplete="off">
                                </div>
                                <div class="inputNombreProdPedidoEditar"></div>
                            </div>
                            <div class="col-lg-2">
                                <label class="mr-sm-2" for="inputPresentacionPedidoEditar">Presentación</label>
                                <div class="input-group">
                                <input type="text" name="inputPresentacionPedidoEditar" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPresentacionPedidoEditar" readonly autocomplete="off">
                                </div>
                                <div class="inputPresentacionPedidoEditar"></div>
                            </div>
                            <div class="col-lg-2">
                                <label class="mr-sm-2" for="inputPiezasPedidoEditar">Piezas</label>
                                <div class="input-group">
                                    <input type="text" name="inputPiezasPedidoEditar" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPiezasPedidoEditar" autocomplete="off">
                                </div>
                                <div class="inputPiezasPedidoEditar"></div>
                            </div>                        
                        </div>
                        <div class="row col-lg-12 mt-4">
                            <div class="col-sm-6 col-md-6 col-lg-6 row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <button type="button" class="btn btn-success btn-lg btn-block" id="enterProductoEditar" name="btn-acepta">Agregar Producto</button>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <button type="button" class="btn btn-warning btn-lg btn-block" id="btnFindProductEditar">Buscar</button>
                                </div>
                            </div>
                    
                            <div class="col-sm-6 col-md-6 col-lg-6 m-1" id="DateDevelopersProductoContenedor">
                                <div class="row" id="DateDevelopersProducto">
                                    <label for="exampleFormControlFile1" class="ml-6">Ingrese Fecha de entrega (YYYY-MM-DD)</label> 
                                    <input type="text" id="fechaEntregaEditar" class="form-control" name="" id="" value="<?=$almacenes->fechaEntregaPedido?>" disabled> 
                                </div>                        
                            </div>
                        </div>
                    </form>
            </div>                      
        </div>        
    </div>
    <div id="divproductosEditar" class="col-lg-12 m-t-5">
           <table class="table table-striped" id="registroProductotablePedidoEditar">
                <thead>
                    <tr>
                        <th scope="col">Id Producto</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Presentacion</th>
                        <th scope="col">Piezas</th>
                    </tr>
                </thead>
                <tbody id="registroProductoPedidoEditar"> 
                <?php while ($producto = $prod->fetch_object()):?> 
                    <tr>
                        <td><?=$producto->idProductoPedido;?></td>
                        <td><?=$producto->nombreProducto;?></td>
                        <td><?=$producto->presentacionProducto;?></td>
                        <td><?=$producto->pzProductoPedido;?></td>
                        <td>
                            
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type='button' class='btn btn-warning btnEditarPzProducto' data-id="<?=$producto->pzProductoPedido;?>"><i class="fas fa-edit"></i></button>
                                <button type='button' class='btn btn-danger deleteOnclickDb ml-2' id="<?=$producto->idProductoPedido?>" data-get="<?=$_GET['id']?>"><i class='fa fa-times-circle' id='' aria-hidden='true'></i></button>
                            </div>
                            
                        </td>
                    </tr>
               <?php endwhile; ?>
                </tbody>
            </table> 
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
                        <th>Presentación</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        <?php while($producto = $productos->fetch_object() ): /* var_dump($prod); */
                            ?>
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
                    <label for="presentacionModalEdit">Presentacion</label>
                    <input type="text" class="form-control presentacionModalEdit" id="presentacionModalEdit" value="" disabled>
                    <div class="presentacionModalEdit"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="piezasModalEdit">Piezas </label>
                    <input type="text" class="form-control piezasModalEdit" id="piezasModalEdit" value="">
                    <div class="piezasModalEdit"></div>
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


<script> 
$(document).ready(function(){

$("#updatePzModalEdit").on("click", function(e) {
        let idget = $("#idgetEditar").val();
        let idProducto = $("#idProductoModalEdit").val();
        let pz = $("#piezasModalEdit").val();
        let pzold = $("#pzoldValue").val();
        let datosArray = Array();
        datosArray.push({ 'phone_idget_12': idget, 'phone_idProducto_12': idProducto, 'phone_piezas_10': pz });
        var validar = validarCampos(datosArray);
        if (validar > 0) {
            Swal.fire(
                'error!',
                'HAY DATOS ERRONEOS VERIFICA O LLAMA A TU ADMINISTRADOR',
                'error'
            )
        } else {
            let data = { "data": datosArray }
            var json = JSON.stringify(data);
            if (pz == pzold) {
                $("#piezas").css('border', '1px solid red')
                $(".piezas").html('correcto')
                $(".piezas").css('color', 'red')

                Swal.fire(
                    'CAMBIOS?',
                    'No se ha hecho algún cambio, para actualizar debes cambiar las piezas',
                    'question'
                )
                e.preventDefault();
            } else {
                $.ajax({
                    url: getAbsolutePath() + "views/layout/ajax.php",
                    method: "POST",
                    data: { "updatePro": json },
                    cache: false,
                    beforeSend: function() {},
                    success: function(updatePz) {
                        console.log(updatePz)
                        if (updatePz == 1) {
                            $('#modalEditProductEntrega').modal('hide');
                            $('#registroProductotablePedidoEditar').load(" #registroProductotablePedidoEditar");
                        } else {
                            Swal.fire(
                                'ERROR?',
                                'Hubo un error al intentar Editar llame a su adminsitrador',
                                'question'
                            )
                        }
                    }
                });
            }

        }
    });

    $("#inputCodigoPedidoEditar").on("change", function() {
        let codigo = $(this).val();

        var validarCodugo = expRegular("phone", codigo);
        if (validarCodugo != 0) {
            var verifProd = new FormData();
            verifProd.append("producto", codigo);
            $.ajax({
                url: getAbsolutePath() + "views/layout/ajax.php",
                method: "POST",
                data: verifProd,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
                },
                success: function (datos) {
                    if(datos != "0"){

                        $("#inputNombreProdPedidoEditar").val(datos.descripcionProd);
                        $("#inputPresentacionPedidoEditar").val(datos.presentacion);
                        
                        focusInput('inputPiezasPedidoEditar');
                    }else{
                        focusInput('inputCodigoPedidoEditar');
                        Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR',
                                    text: 'No hay registro de este identificador de producto'
                                })
                    }
                }
            })
        }else{
            alert("algo salio mal")
        }
    })
    $("#btnFindProductEditar").on('click', function() {
        $("#ListPRod").modal({backdrop: 'static', keyboard: false})
    });

    $("#enterProductoEditar").on('click',function(e){
        let valorPedido = Array();
        let numNota = $("#numNota").val();
        let idUser = $("#idUser").val();
        let inputIdClienteEditar = $("#inputIdClienteEditar").val();
        let fechaEntregaEditar = $("#fechaEntregaEditar").val();
        e.preventDefault();
        const formPedidos = document.getElementById("prodEditForm");
        /* ////////////////////////////////// */
        let validar = Array();
            let transactionFormData = new FormData(formPedidos); // obtiene los datos del formulario 
            
            let inputCodigo = document.getElementById('inputCodigoPedidoEditar').value; 
            let inputNombreProd = document.getElementById('inputNombreProdPedidoEditar').value; 
            let inputPresentacion = document.getElementById('inputPresentacionPedidoEditar').value; 
            let inputPieza = document.getElementById('inputPiezasPedidoEditar').value; 
            
            validar.push({"phone_inputCodigoPedido_6":inputCodigo,"nombre_inputNombreProdPedido_80":inputNombreProd,"nombre_inputPresentacionPedido_80":inputPresentacion,"decimales_inputPiezasPedido_12":inputPieza});
            var campos = validarCampos(validar);
            if(campos == 0 ){
                valorPedido.push({ 'codigo': inputCodigo, 'producto': inputNombreProd, 'present': inputPresentacion, 'pz': inputPieza });
                let data = {
                    "idCliente": inputIdClienteEditar,
                    "nota": numNota,
                    "user": idUser,
                    "fecha":fechaEntregaEditar,
                    "productos": valorPedido
                }
                let JsonString = JSON.stringify(data);
                $.ajax({
                    url: getAbsolutePath() + "views/layout/ajax/AjaxAddPedido.php",
                    method: "POST",
                    data: {"data":JsonString},
                    cache: false,
                    beforeSend: function() {
                        $('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
                    },
                    success: function(resultSentToAjax) {
                        console.log(resultSentToAjax);
                        $('#registroProductotablePedidoEditar').load(" #registroProductotablePedidoEditar");
                    }
                });
            }
        /* ////////////////////////////////// */

    })
})
    $(document).on('click','.btnEditarPzProducto',function(){
    let idPro = $(this).parents("tr").find("td")[0].innerHTML;
    let producto = $(this).parents("tr").find("td")[1].innerHTML;
    let present = $(this).parents("tr").find("td")[2].innerHTML;
    let pieza = $(this).parents("tr").find("td")[3].innerHTML;
    let pzOld = $(this).attr('data-id')
    $("#idProductoModalEdit").val(idPro);
    $("#nombreProdcutoModalEdit").val(producto);
    $("#presentacionModalEdit").val(present);
    $("#piezasModalEdit").val(pieza);
    $("#pzoldValue").val(pieza)
    $('#modalEditProductEntrega').modal('show');
});


$(document).on('click','.selectPRoductPEdido',function(e){
    let codigo = $(this).parents("tr").find("td")[0].innerHTML;
    let nombre = $(this).parents("tr").find("td")[1].innerHTML;
    let presentacion = $(this).parents("tr").find("td")[2].innerHTML;
    $("#inputCodigoPedidoEditar").val(codigo);
    $("#inputNombreProdPedidoEditar").val(nombre);
    $("#inputPresentacionPedidoEditar").val(presentacion);
    $("#ListPRod").modal('hide');
    if ($('.modal-backdrop').is(':visible')) {
        $('body').removeClass('modal-open'); 
        $('.modal-backdrop').remove(); 
        focusInput('inputPiezasPedido');
    };
});
</script>