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
                                    <input type="text" class="form-control" id="idVentas" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="A10547">     
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
                                            <input type="text" name="limCredito" id="limCredito" value="<?=$datosCli->limite?>" class="form-control" disabled="disabled">                       
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group input-group-sm col-lg-12">
                                            <label for="descuentoCliente">DESCUENTO</label>
                                            <input type="hidden" id="descuentoCliente" name="descuentoCliente" value="<?=$datosCli->descuento?>">
                                            <input type="text" class="form-control" id="descuentoClienteD" value="<?=$datosCli->descuento?>" autocomplete="off" disabled="disabled">                                                
                                        </div>
                                        <div class="descuentoCliente"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group input-group-sm col-lg-12">
                                            <label for="saldoCredito">Saldo:</label>
                                            <input type="text" name="saldoCredito" id="saldoCredito" value="<?=$datosCli->saldo?>" class="form-control" disabled="disabled">
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
                    $conId = 1;
                    $sub = 0;
                    $total = 0;
                    while ($producto = $productos->fetch_object()): $sub=Utls::multiply($producto->peso,$producto->precioProductoUnidad);?>
                        <tr class="rowVenta">                            
                            <td class="id"><?=$producto->idProductoPedido?></td>
                            <td class="nombre"><?=$producto->nombreProducto?></td>
                            <td class="pz"><?=$producto->pzProductoPedido?></td>
                            <td class="peso"><?=$producto->peso?></td>
                            <td class="lote"><?=$producto->lote?></td>
                            <td class='status'><?=$producto->precioProductoUnidad?></td>
                            <td><?= $sub; ?></td>
                            <td >
                                <button type="button" class="btn btn-success modalEditProduct " data-id="<?=$conId?>btnSelect" id="<?=$producto->idProductoPedido?>">
                                Seleccionar
                                </button>
                            </td>
                        </tr>
                    <?php $total +=$sub;$conId++; endwhile; 
                        $descuento = Utls::porcentaje($datosCli->descuento,$total);
                        $totalCdescuento = Utls::restar($total,$descuento);
                    ?>                          
                </tbody>
            </table>
        <!-- </divss> -->
    </div>
    <div class="row">
        <div class="tot-comp col-lg-9 text-right">
            <label for="totalVenta">Subtotal:</label> 
        </div>
        <div id="totalDivVenta" class="tot-comp col-lg-3 text-left"> 
            <input type="hidden" name="totalVentaHidden" id="totalVentaHidden" value="<?=$total?>">   
            <p class="total"  id="totalVenta">$ <?= number_format($total,2);?> </p>
        </div>
    </div>
    <div class="row">
        <div class="tot-comp col-lg-9 text-right">
            <label for="totalVenta">Descuento:</label> 
        </div>
        <div id="totalDescuentoVenta" class="tot-comp col-lg-3 text-left">    
            <p class="totalDescuentoShow"  id="totalDescuentoShow">$ <?= number_format($descuento,2) ?></p>
        </div>
    </div>
    <div class="row">
        <div class="tot-comp col-lg-9 text-right">
            <label for="totalVenta">Total:</label> 
        </div>
        <div id="total" class="tot-comp col-lg-3 text-left">
            <input type="hidden" name="totalHiden" id="totalHiden" class="totalHiden" value="<?=$totalCdescuento?>">    
            <p class="totalCliente"  id="total">$ <?=number_format($totalCdescuento,2)?> </p>
        </div>
    </div>
    <div class="mt-4">
        <button type="button" id="acceptCompraVenta" class="btn btn-primary btn-lg"><span  role="status" aria-hidden="true"></span>Aceptar</button>
        <!-- <button type="button" class="btn btn-secondary btn-lg">Cancelar</button> -->
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
      <div id="btnBoton"> <input type="hidden" id="getidBtn" value=""></div>
      <div class="modal-body">
        <div class="container">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="idProducto">Id</label>
                    <input type="text" class="form-control idProducto" id="idProductoModal" value="" disabled>
                    <div class="idProducto"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombreProdcuto">Nombre </label>
                    <input type="text" class="form-control nombreProdcuto" id="nombreProdcutoModal" value="" disabled>
                    <div class="nombreProdcuto"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="loteVenta">Lote</label>
                    <input type="text" class="form-control loteVenta" id="loteVentaModal" value="">
                    <div class="loteVenta"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="peso">Peso </label>
                    <input type="text" class="form-control peso" id="pesoModal" value="">
                    <div class="peso"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
        <button type="button" class="btn btn-primary" id="updatePesoVenta">Aceptar</button>
      </div>
      <div id="message"></div>
    </div>
  </div>
</div>

<script> 




$("#acceptCompraVenta").on('click',function(e){
    let aceptArray = Array();
    let valarray;
    let idget = $("#idget").val();
    let idcli = $("#idcli").val();
    let notaPEdidos = $("#idVentas").val();
    let limCredito = $("#limCredito").val();
    let descuentoCliente = $("#descuentoCliente").val();
    let totalHiden = redondearNumero($("#totalHiden").val());
    let validar;
    
    aceptArray.push({'phone_idget_20':idget,'phone_idcli_20':idcli,'messagge_idVentas_40':notaPEdidos,'decimales_totalHiden_50':totalHiden,'decimales_limCredito_50':limCredito,'decimales_descuentoCliente_50':descuentoCliente});

    valarray = validarCampos(aceptArray);

    if(valarray>0){
        e.preventDefault();
        return;
    }else{
        /* validamos que se hallan reigistrado todos los productos */
        validar = valTable("registroProductoVenta","rowVenta","peso");
        if(validar>0){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'AÚN FALTAN PRODUCTOS POR REGISTRAR',
                showConfirmButton: false,
                timer: 1800
            })
        }else{
            let data = { "data": aceptArray }
            var json = JSON.stringify(data);
            $.ajax({
                url: getAbsolutePath() + "views/layout/ajax/AjaxVenta.php",
                method: "POST",
                data: { "getVEnta": json },
                cache: false,
                beforeSend: function () {
                },
                success: function (upventa) {	
                    console.log(upventa)
                    /* if(upventa == 1){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'SE HA HECHO LA VENTA',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function(){
                            window.location = getAbsolutePath()+'Anden/index';
                        });
                    }else if(upventa == -1){
                        alert("Hay datos que estan mal en la venta");
                    }else if(upventa == 0){
                        alert("no se pudo hacer la venta");
                    } */
                    
                    
                }
            });
        }
    }

    
})
</script>