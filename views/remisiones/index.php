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
                                        <input type="text" class="form-control" id="fechaRemision" aria-label="Large" aria-describedby="inputGroup-sizing-sm" id="fechaRemision">
                                    </div>
                                    <div class="fechaRemision"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group-sm col-lg-8">
                                        <label for="numeroCliente">CLIENTE</label>
                                        <div class="input-group mb-3">
                                            <!-- ========================================= -->
                                            <input type="text" class="form-control" id="numeroCliente" name="numeroCliente" placeholder="NUMERO DE CLIENTE" autocomplete="off">
                                            <divl class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <div id="circuloCliente"></div>
                                                </div>
                                            </divl>
                                            <!-- ========================================= -->
                                        </div>
                                    </div>
                                    <div class="numeroCliente"></div>
                                </div>
                                <!-- ========================== -->
                                <!-- <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <div></div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                                </div> -->
                                <!-- ========================== -->
                                <div class="col-lg-6">
                                    <div class="form-group input-group-sm col-lg-8">
                                        <label for="selectAlmacenVenta">ALMACEN</label>
                                       
                                    </div>
                                    <div class="selectAlmacenVenta"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group" id="domProvListas">
                                        <div id="showProv">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group" id="almacenListas">
                                        <div id="showAlmacen">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="prodNewForm">
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputCodigo">Código</label>
                                    <div class="input-group">
                                        <input type="text" name="inputCodigo" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputCodigo">
                                    </div>
                                    <div class="inputCodigo"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputNombreProd">Nombre</label>
                                    <div class="input-group">
                                        <input type="text" name="inputNombreProd" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputNombreProd" readonly>
                                    </div>
                                    <div class="inputNombreProd"></div>
                                </div>

                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputPieza">Piezas</label>
                                    <div class="input-group">
                                        <input type="text" name="inputPieza" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPieza">
                                    </div>
                                    <div class="inputPieza"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputPeso">Peso</label>
                                    <div class="input-group">
                                        <input type="text" name="inputPeso" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPeso">
                                    </div>
                                    <div class="inputPeso"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputLote">Lote</label>
                                    <div class="input-group">
                                        <input type="text" name="inputLote" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputLote">
                                    </div>
                                    <div class="inputLote"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputPrecio">Precio</label>
                                    <div class="input-group">
                                        <input type="text" name="inputPrecio" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPrecio">
                                    </div>
                                    <div class="inputPrecio"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputSubtotal">Subtotal</label>
                                    <div class="input-group">
                                        <input type="text" name="inputSubtotal" value="" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputSubtotal" /readonly>
                                    </div>
                                    <div class="inputSubtotal"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <button type="submit" class="btn btn-success" id="enterProducto" name="btn-acepta">Aceptar</button>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg">Buscar</button>
                                <button type="button" class="btn btn-info" onclick="limpiarFormulario('frmIdCompra')" name="btn-cancela">Limpiar</button>

                                
                            </div>
                        </div>
                    </div><!-- FIN DEL CARD -->
                </form>


            </div>
        </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div div  id="tab-comp">
                    <table class="table table-striped" id="tablaClientes">
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
                                <td><button type="button" id="<?=$cliente->idCliente;?>" data-name="<?=$cliente->nombreCliente;?>" class="btn btn-info" data-dismiss="modal">AGREGAR</button></td>
                            </tr>     
                        <?php endwhile;?>                  
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
    </div>
</div>
<script>
    $(document).keydown(function(tecla){
       if(tecla.keyCode == 113){
          $("#exampleModalLong").modal('toggle');
       }
    });
</script>