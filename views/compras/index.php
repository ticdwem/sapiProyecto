<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
    }

    ?>
</div>
<div class="">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">CAPTURA DE COMPRAS</li>
                    </ol>
                </nav>
                <form id="frmIdCompra">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="input-group input-group-sm mb-3 col-lg-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">NUMERO DE NOTA.:</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <div class="input-group input-group-sm mb-3 col-lg-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">FECHA DE COMPRA.:</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" id="fechaCompra">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group-sm col-lg-8">
                                        <label for="selectNombreProveedor">NOMBRE DEL PROVEEDOR</label>
                                        <select class="form-control" id="selectNombreProveedor" name="selectNombreProveedor">
                                            <option value="0">Elige un proveedor</option>
                                            <?php while ($provedor = $rowsProv->fetch_object()) : ?>
                                                <option value="<?= $provedor->idProveedor; ?>"><?= $provedor->nombreProveesor; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="selectNombreProveedor"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group-sm col-lg-8">
                                        <label for="selectAlmacenVenta">ALMACEN</label>
                                        <select class="form-control" id="selectAlmacenVenta" name="selectAlmacenVenta">
                                            <option value="0">Elige un almacen</option>
                                            <?php while ($almacen = $almacenes->fetch_object()) : ?>
                                                <option value="<?= $almacen->idAlmacen ?>"><?= $almacen->nombreAlmacen ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div id="selectAlmacenVenta"></div>
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
                            <div class="row">
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputCodigo">Código</label>
                                    <div class="input-group">
                                        <input type="text" name="inputCodigo" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputCodigo">
                                        <div class="inputCodigo"></div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputNombreProd">Nombre</label>
                                    <div class="input-group">
                                        <input type="text" name="inputNombreProd" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputNombreProd" readonly>
                                        <div class="inputNombreProd"></div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputPieza">Piezas</label>
                                    <div class="input-group">
                                        <input type="text" name="inputPieza" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPieza">
                                        <div class="inputPieza"></div>
                                    </div>
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
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success" name="btn-acepta">Aceptar</button>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg">Buscar</button>
                                <button type="button" class="btn btn-info" name="btn-cancela">Limpiar</button>
                            </div>
                        </div>
                    </div><!-- FIN DEL CARD -->
                </form>
            </div>
        </div>


        <div id="caja" class="col-lg-12">
            <table class="table table-striped" id="registroProducto">
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
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- AQUI ESTA EL MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <div  id="tab-comp">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        
                    </tbody>
                </table>
                </div>

              
            </div>
        </div>
    </div>
</div>
