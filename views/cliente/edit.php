<div class="container" id="editarCliente">
    <div class="cabeceraBtn">
        <?php require_once 'views/layout/cabeceraLogo.php'; ?>
    </div>
    <?php $sesion = "";

    if (isset($_SESSION['formulario_cliente'])) {
        $sesion = $_SESSION['formulario_cliente']['datos'];
    }
    $contador = 1;

    $contadorCli = $cli->num_rows;
    $contador_dom = $dom->num_rows;
    ?>

    <div class="texcto">
        <?php if ($sesion != "") {
            echo '<p class="alert alert-danger error" role="alert">' . $_SESSION['formulario_cliente']["error"] . "</p>";
        }
        if (isset($_SESSION['statusSave'])) echo '<p class="alert alert-success error" role="alert">' . $_SESSION['statusSave'] . "</p>";
        /*  Utls::deleteSession('formulario_cliente'); */
        Utls::deleteSession('formulario_cliente');
        Utls::deleteSession('statusSave');  ?>
    </div>
    <div class="container card mb-5">
        <form action="<?= base_url ?>Cliente/editCliente" method="POST" novalidate>
            <div class="cliente">
                <input type="hidden" name="idCleinte" value="<?= $_GET['id'] ?>">
                <label for="inputnombre">Nombre</label>
                <input type="text" id="inputnombre" name="inputnombre" class="form-control" placeholder="nombreCliente" value="<?= $cliente[1] ?>" onkeyup="mayusculas(this)">
                <label for="inputRfc">RFC</label>
                <input type="text" id="inputRfcC" name="inputRfc" class="form-control" placeholder="RFC" value="<?= $cliente[2] ?>" onkeyup="mayusculas(this)">
                <label for="inputDescuento">Descuento</label>
                <input type="text" id="inputDescuento" name="inputDescuento" class="form-control" placeholder="descuento Cliente" value="<?= $cliente[3] ?>">
                <label for="inputLimite">Limite de Credito</label>
                <input type="text" id="inputLimite" name="inputLimite" class="form-control" placeholder="limite Credito" value="<?= $cliente[4] ?>">
                <label for="inputSaldo">Saldo Cliente</label>
                <input type="text" id="inputSaldo" class="form-control" name="inputSaldo" placeholder="Saldo del cliente" value="<?= $cliente[5] ?>">
            </div>
            <input type="submit" name="btnGuardarCliente" class="btn btn-primary" value="Editar">
        </form>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 gral card mt-4" id="">
        <div id="contactoCli" class="col-lg-6 col-md-6 col-sm-12 table-responsive">
            <small>CONTACTO CLIENTE</small>
            <table class="table table-striped" id="tbl-contacto">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Principal</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($contacto = $cli->fetch_object()) : ?>
                        <tr>
                            <th><?= $contacto->nombreContatoCliente ?></th>
                            <td><?= $contacto->telPrinContactoCliente ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-id="<?= $contacto->idContactoCliente; ?>" id="contacto_<?= $contador; ?>" data-toggle="modal" data-target="#Cliente_Edit">ver</button>
                            </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php
            if ($contadorCli  < 3) {
                echo ' <button type="button" class="btn btn-primary btn-lg btn-block boton_4" id="contacto_4" data-toggle="modal" data-target="#Cliente_Add">Agregar</button>';
            }
            ?>
        </div>
        <div id="direccionCli" class="col-lg-6 col-md-6 col-sm-12 table-responsive">
            <small>Dirección Cliente</small>
            <table class="table table-striped" id="tbl-direccion">
                <thead>
                    <tr>
                        <th scope="col">calle</th>
                        <th scope="col">Principal</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($domicilio = $dom->fetch_object()) : ?>
                        <tr>
                            <th><?= Validacion::recotarPuntos($domicilio->calleDomicilioCliente, 15, 10) ?></th>
                            <td><?= $domicilio->numeroDomicilioCliente ?></td>
                            <td><button class="btn btn-primary" role="button" data-id="<?= $domicilio->idDomicilioCliente; ?>" id="domicilio_<?= $contador; ?>" data-toggle="modal" data-target="#domicilio_id">VER</button></td>
                        </tr>
                    <?php $contador++;
                    endwhile ?>
                </tbody>
            </table>
            <?php
            if ($contador_dom  < 3) {
                 echo ' <button type="button" class="btn btn-primary btn-lg btn-block" id="contacto_5" data-toggle="modal" data-target="#add_domiclio">Agregar</button>';
               
            }
            ?>
        </div>
    </div>

    <!-- Modal  agregar contacto-->
    <div class="modal fade" id="Cliente_Add" tabindex="-1" role="dialog" aria-labelledby="Cliente_AddLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Cliente_AddLabel">Agregar Contacto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url ?>Cliente/addContacto" id="frm_add_contacto" method="post">
                    <input type="hidden" name="iCliente" id="customerModal" class="addId" value="<?= $_GET['id'] ?>">
                    <div class="modal-body">
                        <div id="contactoCliente" class="">
                            <div class="contactoCli" id="contactoCli">
                                <div id="mensajeCliente"></div>
                                <div class="">
                                    <div class="">
                                        <label for="inputnombreContactoAdd">Nombre Contacto</label>
                                        <input type="text" id="inputnombreContactoAdd" name="inputnombreContactoAdd" class="form-control" onkeyup="mayusculas(this)">
                                        <div class="inputnombreContactoAdd"></div>
                                        <label for="inputTelObligatorio">Teléfono Contacto</label>
                                        <input type="tel" id="inputTelObligatorio" name="inputTelObligatorio" class="form-control">
                                        <div class="inputTelObligatorio"></div>
                                        <label for="inputTelSecundarioAdd">Teléfono Secundario</label>
                                        <input type="tel" id="inputTelSecundarioAdd" name="inputTelSecundarioAdd" class="form-control" placeholder="SI NO TIENE TELÉFONO DEJAR EN BLANCO">
                                        <div class="inputTelSecundarioAdd"></div>
                                        <label for="inputEmailAdd">Correo</label>
                                        <input type="text" id="inputEmailAdd" name="inputEmailAdd" class="form-control" placeholder="SI NO TIENE CORREO DEJAR EN BLANCO">
                                        <div class="inputEmailAdd"></div>
                                    </div>
                                    <div class="spinnerCliente"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="deleteContato" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="add_Contacto" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal  agregar contacto-->

    <!-- Modal agregar domicilio-->
    <div class="modal fade" id="add_domiclio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelClienteAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action=" <?= base_url ?>Cliente/addDomicilio" method="post" id="addDomicilio">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelClienteAdd" id="modalTittlaCliente"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="DomClienteAdd" class="">
                            <div class="DomClienteAdd" id="domicilioCliAdd">
                                <div id="mensajeAdd"></div>
                                <div class="">
                                    <input type="hidden" name="iClienteAdd" id="customerAdd" value="<?= $_GET['id'] ?>">
                                    <div class=" domicilioCliente">
                                        <label for="streetCustomer">Calle</label>
                                        <input type="text" id="streetCustomer" name="streetCustomer" class="form-control" onkeyup="mayusculas(this)">
                                        <div class="streetCustomer"></div>
                                        <label for="numeroCustomer">Número</label>
                                        <input type="text" id="numeroCustomer" name="numeroCustomer" class="form-control" placeholder="SI NO TIENE NUMERO DEJAR VACIO">
                                        <div class="numeroCustomer"></div>
                                        <label for="inputEstado">Estado</label>
                                        <select name="inputEstado" id="inputEstado" class="form-control selectEstado inpuEstado">
                                            <option value="" id="idselectEstadoModalAdd" selected></option>
                                            <option value="0">Elije un Estado </option>
                                            <?php while ($var = $estadoAdd->fetch_object()) : ?>
                                                <option value="<?= $var->idEstado ?>"> <?= $var->estado ?> </option>
                                            <?php endwhile ?>
                                        </select>
                                        <div class="inputEstado"></div>
                                        <div class="spinnerWhite"></div>
                                        <label for="inpuMunicipio">Municipio</label>
                                        <select name="inpuMunicipio" id="inpuMunicipio" class="form-control selectMunicipio">
                                            <option value="0" id="idselectMunicipioModalAdd" selected></option>
                                            <option value="0">Elije un Estado </option>
                                        </select>
                                        <div class="inpuMunicipio"></div>
                                        <label for="coloniaCustomer">Colonia</label>
                                        <input type="text" class="form-control" name="coloniaCustomer" id="coloniaCustomer" onkeyup="mayusculas(this)" value="">
                                        <div class="coloniaCustomer"></div>
                                        <label for="cpCustomer">C.P</label>
                                        <input type="text" id="cpCustomer" name="cpCustomer" class="form-control">
                                        <div class="cpCustomer"></div>
                                        <label for="RutaCustomer">Ruta </label>
                                        <select name="RutaCustomer" id="RutaCustomer" class="form-control">
                                            <option value="0" id="idselectRutaModalAdd" selected></option>
                                            <option value="10">Elige una ruta</option>
                                            <option value="20">Elige una ruta</option>
                                            <option value="30">Elige una ruta</option>
                                            <option value="40">Elige una ruta</option>
                                            <option value="50">Elige una ruta</option>
                                            <?php while ($listRuta = $ruta->fetch_object()) : ?>
                                                <option value="<?= $listRuta->idRuta; ?>"><?= $listRuta->nombreRuta; ?></option>
                                            <?php endwhile ?>
                                        </select>
                                        <div class="RutaCustomer"></div>
                                    </div>
                                    <div class="spinnerDom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btn-add-dom" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
     <!-- End Modal agregar domicilio-->

     <!-- Modal modificar domicilio-->
    <div class="modal fade" id="domicilio_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url ?>Cliente/update" method="post">
                <input type="hidden" name="selectMunicipioHidden" id="idselectMunicipioModalHidden">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title exampleModalLabel" id="modalTittlaCliente" style="text-transform:uppercase"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="DomCliente" class="">
                            <div class="DomCliente" id="domicilioCli">
                                <div id="mensaje"></div>
                                <div class="">
                                    <input type="hidden" id="idBoton" value="">
                                    <input type="hidden" id="idTbla" value="">
                                    <input type="hidden" name="iCliente" id="customer" value="">
                                    <input type="hidden" name="iddomicilio" id="iddomicilio" value="">
                                    <input type="hidden" name="hiddenRuta" id="hiddenRuta" value="">
                                    <div class=" domicilioCliente">
                                        <label for="inputCalleModal">Calle</label>
                                        <input type="text" id="inputCalleModal" name="inputCalleModal" class="form-control" onkeyup="mayusculas(this)">
                                        <label for="inputNumeroModal">Número</label>
                                        <input type="text" id="inputNumeroModal" name="inputNumeroModal" class="form-control">
                                        <label for="selectEstado">Estado</label>
                                        <select name="selectEstado" id="selectEstado" class="form-control selectEstado" disabled>
                                            <option value="" id="idselectEstadoModal" selected></option>
                                            <option value="0">Elije un Estado </option>
                                            <?php while ($var = $estado->fetch_object()) : ?>
                                                <option value="<?= $var->idEstado ?>"> <?= $var->estado ?> </option>
                                            <?php
                                                endwhile; 
                                            ?>
                                        </select>
                                        <div class="spinnerWhite"></div>
                                        <label for="selectMunicipio">Municipio</label>
                                        <select name="selectMunicipio" id="selectMunicipio" class="form-control selectMunicipio" disabled>
                                            <option value="0" id="idselectMunicipioModal" selected></option>
                                            <option value="0">Elije un Estado </option>
                                        </select>
                                        <label for="coloniaCustomerAdd">Colonia</label>
                                        <input type="text" id="coloniaCustomerAdd" name="coloniaCustomerAdd" class="form-control" onkeyup="mayusculas(this)">
                                        <label for="inputCPModal">C.P</label>
                                        <input type="text" id="inputCPModal" name="inputCPModal" class="form-control">
                                        <label for="selectRutaModal">Ruta </label>
                                        <select name="selectRutaModal" id="selectRutaModal" class="form-control" disabled>
                                            <option value="0" id="idselectRutaModal" selected></option>
                                            <?php while ($listRuta = $ruta->fetch_object()) : ?>
                                                <option value="<?= $listRuta->idRuta; ?>"><?= $listRuta->nombreRuta; ?></option>
                                            <?php endwhile ?>

                                        </select>

                                    </div>
                                    <div class="spinnerDom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="deleteDom" data-dismiss="modal">ELIMINAR</button>
                            <button type="submit" class="btn btn-primary" id="editDom">ACTUALIAZAR</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal modificar domicilio-->
    <!-- modificar contacto -->
    <div class="modal fade" id="Cliente_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCleinteEdit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title exampleModalLabel" id="modalTittlaCliente" style="text-transform:uppercase"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url ?>Cliente/updateContacto" id="frmUpdateCli" method="post">
                    <input type="hidden" name="idClienteEdit" id="customerModalEdit" class="addId" value="<?= $_GET['id'] ?>">
                    <div class="modal-body">
                        <div id="contactoCliente" class="">
                            <div class="contactoCli" id="contactoCli">
                                <div id="mensajeCliente"></div>
                                <div class="">
                                    <input type="hidden" name="idContactoCliente" id="idContactoCliente" value="">
                                    <div class="">
                                        <label for="inputnombreContactoEdit">Nombre Contacto</label>
                                        <input type="text" id="inputnombreContactoEdit" name="inputnombreContactoEdit" class="form-control" value="<?= $cliente[4] ?>" onkeyup="mayusculas(this)">
                                        <label for="inputTelObligatorioEdit">Teléfono Contacto</label>
                                        <input type="tel" id="inputTelObligatorioEdit" name="inputTelObligatorioEdit" class="form-control">
                                        <label for="inputTelSecundarioEdit">Teléfono Secundario</label>
                                        <input type="tel" id="inputTelSecundarioEdit" name="inputTelSecundarioEdit" class="form-control">
                                        <label for="inputEmailEdit">Correo</label>
                                        <input type="email" id="inputEmailEdit" name="inputEmailEdit" class="form-control">
                                    </div>
                                </div>
                                <div class="spinnerCliente"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="deleteCli" data-dismiss="modal">ELIMINAR</button>
                        <button type="submit" id="updateCli" class="btn btn-primary">ACTUALIAZAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modificar contacto -->
</div>