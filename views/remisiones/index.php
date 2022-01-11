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
                        <li class="breadcrumb-item active" aria-current="page">Remisiones</li>
                    </ol>
                </nav>
                <form id="frmIdRemision">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3 col-lg-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"  id="inputGroup-sizing-lg">NUMERO DE REMISION:</span>
                                        </div>
                                        <input type="text" class="form-control" id="idRemision" aria-label="Large" aria-describedby="inputGroup-sizing-sm">     
                                    </div>                              
                                    <div class="idRemision"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3 col-lg-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">FECHA DE REMISION :</span>
                                        </div>
                                        <input type="text" class="form-control" id="fechaCompra" aria-label="Large" aria-describedby="inputGroup-sizing-sm" id="fechaCompra">
                                    </div>
                                    <div class="fechaRemision"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group-sm col-lg-9">
                                        <label for="numeroCliente">CLIENTE</label>
                                        <small>introduce un numero o presiona <b>f2</b> para buscar un cliente</small>
                                        <input type="hidden" id="idClientesXtienda">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="numeroCliente" name="numeroCliente" placeholder="NUMERO DE CLIENTE" autocomplete="off">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <div id="circuloCliente"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-12">
                                        <div class="input-group" id="infoCliente">
                                            <div id="showInfoCliente">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group input-group-sm col-lg-12">
                                                <label for="condicionCliente">CONDICION</label>
                                                <select class="form-control form-control-lg condicionCliente" id="condicionCliente" name="condicionCliente">
                                                    <option value="-1">seleccione una opcion</option>
                                                    <option value="1">Anticipo</option>
                                                    <option value="2">Credito</option>
                                                    <option value="3">Contado</option>
                                                </select>                                                    
                                            </div>
                                            <div class="condicionCliente"></div>
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
                                                <label for="selectAlmacenVenta">ALMACEN</label>
                                                <select class="form-control" id="selectAlmacenVenta" name="selectAlmacenVenta">
                                                    <option value="">Elige un almacen</option>
                                                    <?php while ($almacen = $almacenes->fetch_object()) : ?>
                                                        <option value="<?= $almacen->idAlmacen ?>"><?= $almacen->nombreAlmacen ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                            <div class="selectAlmacenVenta"></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group" id="almacenListasVentas">
                                                <div id="showAlmacenVentas">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="prodNewForm">
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputCodigoVenta">Código</label>
                                    <div class="input-group">
                                        <input type="text" name="inputCodigoVenta" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputCodigoVenta">
                                    </div>
                                    <div class="inputCodigoVenta"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputNombreProdVenta">Nombre</label>
                                    <div class="input-group">
                                        <input type="text" name="inputNombreProdVenta" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputNombreProdVenta" readonly>
                                    </div>
                                    <div class="inputNombreProdVenta"></div>
                                </div>

                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputPiezaVenta">Piezas</label>
                                    <div class="input-group">
                                        <input type="text" name="inputPiezaVenta" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPiezaVenta">
                                    </div>
                                    <div class="inputPiezaVenta"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputPesoVenta">Peso</label>
                                    <div class="input-group">
                                        <input type="text" name="inputPesoVenta" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPesoVenta">
                                    </div>
                                    <div class="inputPesoVenta"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputLoteVenta">Lote</label>
                                    <div class="input-group">
                                        <input type="text" name="inputLoteVenta" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputLoteVenta">
                                    </div>
                                    <div class="inputLoteVenta"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputPrecioVenta">Precio</label>
                                    <div class="input-group">
                                        <input type="text" name="inputPrecioVenta" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPrecioVenta">
                                    </div>
                                    <div class="inputPrecioVenta"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputSubtotalVenta">Subtotal</label>
                                    <div class="input-group">
                                        <input type="text" name="inputSubtotalVenta" value="" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputSubtotalVenta" /readonly>
                                    </div>
                                    <div class="inputSubtotalVenta"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <button type="submit" class="btn btn-success" id="enterProducto" name="btn-acepta">Aceptar</button>
                                <button type="button" class="btn btn-warning" id="modalTblProductos">Buscar</button>
                                <button type="button" class="btn btn-info" onclick="limpiarFormulario('frmIdCompra')" name="btn-cancela">Limpiar</button>

                                
                            </div>
                        </div>
                    </div><!-- FIN DEL CARD -->
                </form>


            </div>
        </div>
</div>
<!-- Modal para mostrar los clientes-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">SELECCIONE UN CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="tab-comp">
                    <table class="table table-striped" id="tablaClientesBuscar">
                        <thead>
                            <tr>
                                <th scope="col"># Cliente</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($cliente = $clientes->fetch_object() ):?>                                
                            <tr>
                                <td><?=$cliente->idCliente;?></td>
                                <td><?=$cliente->nombreCliente;?></td>
                                <td><button type="button" id="<?=$cliente->idCliente;?>"  class="btn btn-info findCliente" data-dismiss="modal">AGREGAR</button></td>
                            </tr>     
                        <?php endwhile;?>                  
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>
<!-- modal para las direcciones de los cliente -->
<div class="modal fade bd-example-modal-lg" id="TablaDatosClientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NomClienteTitulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="datosTiendas" class="">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal para mostrar si hay mas de dos lotes existentes -->
<div class="modal fade bd-example-modal-lg" id="modalLotesExistentes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="dtos"></div>
                <div id="lotesExistentes" class=""></div>
            </div>
        </div>
    </div>
</div>
<!-- Modal para los productos-->
<!-- <div class="modal fade TablaDatosProductos" id="TablaDatosProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NomClienteTitulo">SELECCIONE UN PRODUCTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div div  id="tab-comp">
                    <table class="table table-striped" id="tablaPRoductosVentas">
                        <thead>
                            <tr>
                                <th scope="col">idProducto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Pieza Aprox</th>
                                <th scope="col">acción</th>
                            </tr>
                        </thead>
                        <tbody> -->
                            <!-- <?php while ($listaProd = $listaProducto->fetch_object() ):?>                                
                            <tr>
                                <td><?=$listaProd->idProducto;?></td>
                                <td><?=$listaProd->nombreProducto;?></td>
                                <td><?=$listaProd->suma;?></td>
                                <td><button type="button" id="<?=$listaProd->idProducto?>" data-idname="<?=$listaProd->nombreProducto;?>" class="btn btn-info btnVentasPRoducto" data-dismiss="modal">AGREGAR</button></td>
                            </tr>     
                            <?php endwhile;?>        -->           
                      <!--   </tbody>
                    </table>
                </div>              
            </div>
        </div>
    </div>
</div> -->
<!-- modal para los lotes -->
<div class="modal fade TablaDatosLotes" id="TablaDatosLotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NomClienteTitulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="productosAlmacenLotes" class="">
                    

                </div>
            </div>
        </div>
    </div>
</div>
<script> 
//sessionStorage.clear();
// inserta los datos en el textarea de los clientes que tienen mas de un negocio
$(document).on('click','.seleccionarIdCliente',function(e){
        e.stopPropagation();
        var infoCliente = '';
        let id = $(this).attr('data-id');
        let recuperarJson = sessionStorage.getItem('JSON_'+id);
        let parsejson = JSON.parse(recuperarJson);
        infoCliente += "<table class='table'><thead><tr><th>Cliente</th><th>Estado</th><th>Municipio</th><th>Calle</th></tr></thead>";
        infoCliente += '<tr><td>' + parsejson.nombreCliente + '</td><td>' + parsejson.estado + '</td><td>' + parsejson.municipio + '</td><td>' + parsejson.calleDomicilioCliente + '</td>';
        infoCliente += '</table>';	
        $("#showInfoCliente").html(infoCliente);
        $('#TablaDatosClientes').modal('hide');
        sessionStorage.clear();

   });
   $(document).on('click','.seleccionarIdProductoXLote',function(e){
       e.stopPropagation();
       let id = $(this).attr('id');
       let recuperarproducto = JSON.parse(sessionStorage.getItem('LOTE_'+id));
        $("#inputCodigoVenta").val(recuperarproducto.id);
        $("#inputNombreProdVenta").val(recuperarproducto.nombre);
        $("#inputLoteVenta").val(recuperarproducto.lote);
        $("#inputPrecioVenta").val(recuperarproducto.precioUnitario);
        sessionStorage.clear();
        $("#modalLotesExistentes").modal('hide');

   })
   // si la pagina detecta que se preciona la tecla f12
    $(document).keydown(function(tecla){
       if(tecla.keyCode == 113){
          $("#exampleModalLong").modal('toggle',{backdrop: 'static', keyboard: false});
       }  
    });
</script>