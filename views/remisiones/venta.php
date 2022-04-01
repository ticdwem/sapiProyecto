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
                                    <input type="hidden" id="idClientesXtienda" value="<?=$datos->id?>">
                                    <label for="idCliente" id="cliLabelVenta"><strong>CLIENTE:</strong> <?=$datos->id?> </label>
                                    <label for="nombreCliente"><strong>NOMBRE:</strong>  <?=$datos->nombre?> </label>
                                    <label for="telefonoCliente"><strong>TEL:</strong>  <?=$datos->telPrinContactoCliente?>  </label>
                                    <label for="rfcCliente"><strong>RFC:</strong>  <?=$datos->rfc?>  </label>
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
                                            <input type="text" name="limCredito" id="limCredito" class="form-control">                       
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group input-group-sm col-lg-12">
                                            <label for="descuentoCliente">DESCUENTO</label>
                                            <input type="hidden" id="descuentoCliente" name="descuentoCliente">
                                            <input type="text" class="form-control" id="descuentoClienteD" autocomplete="off" disabled="disabled">                                                
                                        </div>
                                        <div class="descuentoCliente"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group input-group-sm col-lg-12">
                                            <label for="saldoCredito">Saldo:</label>
                                            <input type="text" name="saldoCredito" id="saldoCredito" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">dsfsd</div>
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
                                                
                </tbody>
            </table>
        <!-- </divss> -->
    </div>
    <div class="row">
        <div class="tot-comp col-lg-10 text-right">
            <label for="totalVenta">Subtotal:</label> 
        </div>
        <div id="totalDivVenta" class="tot-comp col-lg-2 text-left">    
            <p class="total"  id="totalVenta"> $0000.00 </p>
        </div>
    </div>
    <div class="row">
        <div class="tot-comp col-lg-10 text-right">
            <label for="totalVenta">Descuento:</label> 
        </div>
        <div id="totalDivVenta" class="tot-comp col-lg-2 text-left">    
            <p class="totalDescuento"  id="totalDescuento"> 0000.00 </p>
        </div>
    </div>
    <div class="row">
        <div class="tot-comp col-lg-10 text-right">
            <label for="totalVenta">Total:</label> 
        </div>
        <div id="totalDivVenta" class="tot-comp col-lg-2 text-left">
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


<script> 
</script>