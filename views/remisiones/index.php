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
                                        <div id="showInfoCliente"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group input-group-sm col-lg-12">
                                            <label for="condicionCliente">CONDICION</label>
                                            <select class="form-control form-control-lg condicionCliente" id="condicionCliente" name="condicionCliente">
                                                <option value="">seleccione una opcion</option>
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
                                            <div id="showAlmacenVentas"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row evento" id="prodNewForm">
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
                                    <input type="text" name="inputLoteVenta" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputLoteVenta" readonly>
                                </div>
                                <div class="inputLoteVenta"></div>
                            </div>
                            <div class="col-lg-2">
                                <label class="mr-sm-2" for="inputPrecioVenta">Precio</label>
                                <div class="input-group">
                                    <input type="text" name="inputPrecioVenta" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPrecioVenta" readonly>
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
                            <!-- <button type="button" class="btn btn-info" onclick="limpiarFormulario('frmIdCompra')" name="btn-cancela">Limpiar</button> -->
                        </div>
                    </div>
                </div><!-- FIN DEL CARD -->
            </form>
        </div>
        <div id="cajaVenta" class="col-lg-12">
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
        </div>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Seleccione un lote</h5>
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
  
    const formVentas = document.getElementById("frmidVentas");
        
        formVentas.addEventListener("submit", function (event) {
            event.preventDefault();

            let validar = Array();
            let transactionFormData = new FormData(formVentas); // obtiene los datos del formulario

            let inputCodigo = document.getElementById('inputCodigoVenta').value; 
            let inputNombreProd = document.getElementById('inputNombreProdVenta').value; 
            let inputPieza = document.getElementById('inputPiezaVenta').value; 
            let inputPeso = document.getElementById('inputPesoVenta').value; 
            let inputLote = document.getElementById('inputLoteVenta').value; 
            let inputPrecio = document.getElementById('inputPrecioVenta').value; 
            let inputSubtotal = document.getElementById('inputSubtotalVenta').value; 

            validar.push({"phone_inputCodigoVenta_6":inputCodigo,"nombre_inputNombreProdVenta_80":inputNombreProd,"phone_inputPiezaVenta_12":inputPieza,"decimales_inputPesoVenta_12":inputPeso,
                          "nombre_inputLoteVenta_50":inputLote,"decimales_inputPrecioVenta_12":inputPrecio,"decimales_inputSubtotalVenta_12":inputSubtotal});
            var campos = validarCampos(validar);
            if(campos == 0 ){
                let insertProducto = document.getElementById("registroProductoVenta"); // este es el id de la tabla
                let newProductoRow = insertProducto.insertRow(-1); //este retorna una fila en la ultima fila de 
                
                let newproductoCellNew = newProductoRow.insertCell(0);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputCodigoVenta");
                
                newproductoCellNew = newProductoRow.insertCell(1);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputNombreProdVenta");                    
                
                newproductoCellNew = newProductoRow.insertCell(2);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputPiezaVenta");
                
                newproductoCellNew = newProductoRow.insertCell(3);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputPesoVenta");
                
                newproductoCellNew = newProductoRow.insertCell(4);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputLoteVenta");
                
                newproductoCellNew = newProductoRow.insertCell(5);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputPrecioVenta");
                
                newproductoCellNew = newProductoRow.insertCell(6);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputSubtotalVenta");

                newproductoCellNew = newProductoRow.insertCell(7);// posisicion de la celda
                newproductoCellNew.insertAdjacentHTML("afterbegin","<button type='button' class='btn btn-danger deleteOnclick' onclick='deleteRow(this)'><i class='fa fa-times-circle' id='' aria-hidden='true'></i></button>");
                
                limpiarInput("inputCodigoVenta");
                limpiarInput("inputNombreProdVenta");
                limpiarInput("inputPiezaVenta");
                limpiarInput("inputPesoVenta");
                limpiarInput("inputLoteVenta");
                limpiarInput("inputPrecioVenta");
                limpiarInput("inputSubtotalVenta");
                // este codigo sirve para poner el cursor en la primer input
                focusInput("inputCodigoVenta");
                let totalCompra = 0;
                let totalCompleto = 0;
                let procentaje = $("#descuentoCliente").val();
                    $("#registroProductoVenta tr").each(function(){
                        totalCompra +=parseFloat($(this).find('td').eq(6).html());
                    }) 
                    $("#totalVenta").html(totalCompra.toFixed(2));
                    totalCompleto = porcentaje(procentaje,totalCompra);
                    $("#totalHiden").val(totalCompleto);
                    $("#total").html(totalCompleto);
                    
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'TODOS LOS CAMPOS SON OBLIGATORIOS, VERIFIQUE LOS DATOS ',
                    showConfirmButton: false,
                    timer: 1500
                });  
                
                limpiarInput("inputPesoVenta");
               
             }
        });
</script>