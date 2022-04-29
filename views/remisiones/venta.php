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
            <?php require_once 'views/layout/breadcrup.php';?>
            <form id="frmidVentas">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-sm mb-3 col-lg-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"  id="inputGroup-sizing-lg">NUMERO DE REMISION:</span>
                                    </div>
                                    <input type="text" class="form-control" id="idVentas" aria-label="Large" aria-describedby="inputGroup-sizing-sm">     
                                </div>                              
                                <div class="idVentas"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-sm mb-3 col-lg-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">FECHA DE REMISION :</span>
                                    </div>
                                    <input type="text" class="form-control" id="fechaCompra" aria-label="Large" aria-describedby="inputGroup-sizing-sm" id="fechaCompra" readonly>
                                </div>
                                <div class="fechaRemision"></div>
                            </div>
                            <div class="row col-lg-6">
                                <div class="col-lg-9 border-top border-right border-bottom" id="titleLabelsVenta">                                    
                                    <input type="hidden" id="idClientesXtienda" value="<?=$datosCli->id?>">
                                    <label for="idCliente" id="cliLabelVenta"><strong>CLIENTE:</strong> <?=$datosCli->id?> </label>
                                    <label for="nombreCliente"><strong>NOMBRE:</strong>  <?=$datosCli->nombre?> </label>
                                    <label for="telefonoCliente"><strong>TEL:</strong>  <?=$datosCli->telPrinContactoCliente?>  </label>
                                    <label for="rfcCliente"><strong>RFC:</strong>  <?=$datosCli->rfc?>  </label>
                                </div>
                                <div class="col-lg-3 border-top border-right border-bottom botoncenter">
                                    <label for="numeroCliente"><button type="button" id="btnIdModalDomicilio"  class="btn btn-primary btn-lg btn-block">DIRECCIÓN</button></label><br>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <div class="row ">
                                    <div class="col-lg-6 ">
                                        <div class="form-group input-group-sm col-lg-12 ">
                                            <label for="limCredito">Lim credito:</label>
                                            <input type="text" name="limCredito" id="limCredito" value="<?=$datosCli->limite?>" class="form-control">                       
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group input-group-sm col-lg-12">
                                            <label for="descuentoCliente">DESCUENTO</label>
                                            <input type="hidden" id="descuentoCliente" name="descuentoCliente" value="<?=$datosCli->descuento?>>
                                            <input type="text" class="form-control" id="descuentoClienteD" value="<?=$datosCli->descuento?>" autocomplete="off" disabled="disabled">                                                
                                        </div>
                                        <div class="descuentoCliente"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group input-group-sm col-lg-12">
                                            <label for="saldoCredito">Saldo:</label>
                                            <input type="text" name="saldoCredito" id="saldoCredito" value="<?=$datosCli->saldo?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- FIN DEL CARD -->
            </form>
        </div>
</div>
<div class="card col-lg-12">
        <!-- <divss id="" class="card"> -->
            <table class="table table-striped" id="registroProductotableVenta"> 
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Piezas</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Lote</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody id="registroProductoVenta">
                    <?php
                    $sub = 0;
                    $total = 0;
                    while ($producto = $productos->fetch_object()): $sub=Utls::multiply($producto->peso,$producto->precioProductoUnidad);?>
                        <tr>                            
                            <td><?=$producto->idProductoPedido?></td>
                            <td><?=$producto->nombreProducto?></td>
                            <td><?=$producto->pzProductoPedido?></td>
                            <td><?=$producto->peso?></td>
                            <td><?=$producto->lote?></td>
                            <td><?=$producto->precioProductoUnidad?></td>
                            <td><?= $sub; ?></td>
                            <td><button type="button" class="btn btn-success modalEditProduct" id="<?=$producto->idProducto?>">Seleccionar</button></td>
                        </tr>
                    <?php $total +=$sub; endwhile; ?>                          
                </tbody>
            </table>
        <!-- </divss> -->
    </div>
    <div class="row">
        <div class="tot-comp col-lg-10 text-right">
            <label for="totalVenta">Subtotal: $</label> 
        </div>
        <div id="totalDivVenta" class="tot-comp col-lg-2 text-left">    
            <p class="total"  id="totalVenta"> <?= number_format($total,2);?> </p>
        </div>
    </div>
    <div class="row">
        <div class="tot-comp col-lg-10 text-right">
            <label for="totalVenta">Descuento:</label> 
        </div>
        <div id="totalDescuento" class="tot-comp col-lg-2 text-left">    
            <p class="totalDescuento"  id="totalDescuento"> 0000.00 </p>
        </div>
    </div>
    <div class="row">
        <div class="tot-comp col-lg-10 text-right">
            <label for="totalVenta">Total:</label> 
        </div>
        <div id="total" class="tot-comp col-lg-2 text-left">
            <input type="hidden" name="totalHiden" id="totalHiden" class="totalHiden">    
            <p class="totalCliente"  id="total"> $0000.00 </p>
        </div>
    </div>
    <div class="mt-4">
        <button type="button" id="acceptCompraVenta" class="btn btn-primary btn-lg"><span  role="status" aria-hidden="true"></span>Aceptar</button>
        <button type="button" class="btn btn-secondary btn-lg">Cancelar</button>
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
                    <input type="text" class="form-control" id="calleCliente" name="calleCliente" aria-describedby="telPrin" placeholder="calle Domicilio" value="<?=$domicilio->calleDomicilioCliente?>" readonly>
                    <small id="calleCliente" class="form-text text-muted"></small>
                </div>
                <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                    <label for="numeroDomicilio">Número</label>
                    <input type="text" class="form-control" id="numeroDomicilio" name="numeroDomicilio" aria-describedby="telSec" placeholder="Telefono Secundario" value="<?=$domicilio->numeroDomicilioCliente?>" readonly>
                    <small id="numeroDomicilio" class="form-text text-muted"></small>
                </div>
                <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                    <label for="cpDomicilio">CP</label>
                    <input type="text" class="form-control" id="cpDomicilio" name="cpDomicilio" aria-describedby="ruta" placeholder="ruta" value="<?=$domicilio->cpDomicilioCliente?>" readonly>
                    <small id="cpDomicilio" class="form-text text-muted"></small>
                </div>
            </div> 
        </div>
        <divss id="datoContacto" class="col-lg-12 col-md-12 col-sm-12 datoContacto">
            <div class="row">
                <div id="telPrin" class="col-lg-4 col-md-4 col-sm-12 telPrin">
                    <label for="estadoDomicilio">Estado</label>
                    <input type="text" class="form-control" id="estadoDomicilio" name="estadoDomicilio" aria-describedby="telPrin" placeholder="Telefono Principal" value="<?=$domicilio->estado?>" readonly>
                    <small id="estadoDomicilio" class="form-text text-muted"></small>
                </div>
                <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                    <label for="minicipioDomicilio">Municipio</label>
                    <input type="text" class="form-control" id="minicipioDomicilio" name="minicipioDomicilio" aria-describedby="telSec" placeholder="Telefono Secundario" value="<?= $domicilio->municipio; ?>" readonly>
                    <small id="minicipioDomicilio" class="form-text text-muted"></small>
                </div>
                <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                    <label for="coloDimiicxiio">Colonia</label>
                    <input type="text" class="form-control" id="coloDimiicxiio" name="coloDimiicxiio" aria-describedby="ruta" placeholder="ruta" value="<?=$domicilio->coloniaDomicilioCliente?>" readonly>
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

<div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="modalEditProductLabel">Editar Piezas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div id="getNota"> <input type="hidden" id="idget" value="<?=$_GET['nota'];?>"></div>
      <div id="getcli"> <input type="hidden" id="idcli" value="<?=$_GET['cli'];?>"></div>
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
                    <label for="loteVenta">Lote</label>
                    <input type="text" class="form-control loteVenta" id="loteVenta" value="">
                    <div class="loteVenta"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="peso">Peso </label>
                    <input type="text" class="form-control peso" id="peso" value="">
                    <div class="peso"></div>
                </div>
            </div>
        </div>
      </div>
      <divx class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
        <button type="button" class="btn btn-primary" id="updatePesoVenta">Aceptar</button>
      </divx>
    </div>
  </div>
</div>

<script> 
$(document).on('click','.modalEditProduct',function(){
    let idPro = $(this).parents("tr").find("td")[0].innerHTML;
    let producto = $(this).parents("tr").find("td")[1].innerHTML;
    $("#idProducto").val(idPro);
    $("#nombreProdcuto").val(producto);
    $('#modalProducto').modal('show');
});

$("#updatePesoVenta").on('click',function(e){
    let verif = Array();
    let nota = $("#idget").val();
    let idp =  $("#idProducto").val();
    let lote = $("#loteVenta").val();
    let peso = $("#peso").val();
    let cliente = $("#idcli").val();

    verif.push({'phone_idget_50':nota,'phone_idProducto_80':idp,'phone_loteVenta_50':lote,'decimales_peso_50':peso,'phone_idcli_10':cliente});
			
    validar = validarCampos(verif);
    if(validar>0){
        e.preventDefault();
        return;
    }
    let data = { "data": verif }
	var json = JSON.stringify(data);
    $.ajax({
        url: getAbsolutePath() + "views/layout/ajax.php",
        method: "POST",
        data: { "updateVenta": json },
        cache: false,
        beforeSend: function () {
        },
        success: function (upventa) {	
            if(upventa == 1){
                $('#registroProductotableVenta').load(" #registroProductotableVenta");
                $('#totalDivVenta').load(" #totalDivVenta");
                $('#modalProducto').modal('hide');
            }
            
            
        }
    });
    
})
</script>