
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
        Utls::deleteSession('formulario_cliente');
        Utls::deleteSession('statusSave') ?>
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
                echo ' <button type="button" class="btn btn-primary btn-lg btn-block"  id="contacto_5" data-toggle="modal" data-target="#add_domiclio">Agregar</button>';
            }
            ?>
        </div>
    </div>
   
    <!-- Modal  agregar contacto-->
    <div class="modal fade" id="Cliente_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelClienter" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelClienter">Agregar Contacto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url ?>Cliente/addContacto" method="post">
                    <input type="hidden" name="iCliente" id="customerModal" class="addId" value="<?= $_GET['id'] ?>">
                    <div class="modal-body">
                        <div id="contactoCliente" class="">
                            <div class="contactoCli" id="contactoCli">
                                <div id="mensajeCliente"></div>
                                <div class="">
                                    <div class="">
                                        <label for="inputnombreContactoAdd">Nombre Contacto</label>
                                        <input type="text" id="inputnombreContactoAdd" name="inputnombreContactoAdd" class="form-control" onkeyup="mayusculas(this)">
                                        <label for="inputTelObligatorio">Teléfono Contacto</label>
                                        <input type="tel" id="inputTelObligatorio" name="inputTelObligatorio" class="form-control">
                                        <label for="inputTelSecundarioAdd">Teléfono Secundario</label>
                                        <input type="tel" id="inputTelSecundarioAdd" name="inputTelSecundarioAdd" class="form-control">
                                        <label for="inputEmailAdd">Correo</label>
                                        <input type="email" id="inputEmailAdd" name="inputEmailAdd" class="form-control">
                                    </div>
                                </div>
                                <div class="spinnerCliente"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Modal agregar domicilio-->
    <div class="modal fade" id="add_domiclio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelClienteAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url ?>Cliente/addDomicilio" method="post">
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
                                        <label for="inputCalleModalAdd">Calle</label>
                                        <input type="text" id="inputCalleModalAdd" name="inputCalleModalAdd" class="form-control" onkeyup="mayusculas(this)">
                                        <label for="inputNumeroModalAdd">Número</label>
                                        <input type="text" id="inputNumeroModalAdd" name="inputNumeroModalAdd" class="form-control">
                                        <label for="selectEstadoAdd">Estado</label>
                                        <select name="selectEstadoAdd" id="selectEstadoAdd" class="form-control selectEstado">
                                            <option value="" id="idselectEstadoModalAdd" selected></option>
                                            <option value="0">Elije un Estado </option>
                                            <?php while ($var = $estadoAdd->fetch_object()) : ?>
                                                <option value="<?= $var->idEstado ?>"> <?= $var->estado ?> </option>
                                            <?php endwhile ?>
                                        </select>
                                        <div class="spinnerWhite"></div>
                                        <label for="selectMunicipioAdd">Municipio</label>
                                        <select name="selectMunicipioAdd" id="selectMunicipioAdd" class="form-control selectMunicipio">
                                            <option value="0" id="idselectMunicipioModalAdd" selected></option>
                                            <option value="0">Elije un Estado </option>
                                        </select>
                                        <label for="inputCPModalAdd">C.P</label>
                                        <input type="text" id="inputCPModalAdd" name="inputCPModalAdd" class="form-control">
                                        <label for="selectRutaModalAdd">Ruta </label>
                                        <select name="selectRutaModalAdd" id="selectRutaModalAdd" class="form-control">
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

                                    </div>
                                    <div class="spinnerDom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- Modal modificar domicilio-->
    <div class="modal fade" id="domicilio_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url ?>Cliente/update" method="post">
                <input type="text" name="selectMunicipioHidden" id="idselectMunicipioModalHidden">
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
                                    <input type="hidden" name="iCliente" id="customer" value="">
                                    <input type="hidden" name="iddomicilio" id="iddomicilio" value="">
                                    <div class=" domicilioCliente">                                        
                                        <label for="inputCalleModal">Calle</label>
                                        <input type="text" id="inputCalleModal" name="inputCalleModal" class="form-control" onkeyup="mayusculas(this)">
                                        <label for="inputNumeroModal">Número</label>
                                        <input type="text" id="inputNumeroModal" name="inputNumeroModal" class="form-control">
                                        <label for="selectEstado">Estado</label>
                                        <select name="selectEstado" id="selectEstado" class="form-control selectEstado">
                                            <option value="" id="idselectEstadoModal" selected></option>
                                            <option value="0">Elije un Estado </option>
                                            <?php while ($var = $estado->fetch_object()) : ?>
                                                <option value="<?= $var->idEstado ?>"> <?= $var->estado ?> </option>
                                            <?php 
                                            
                                            endwhile;?>
                                        </select>
                                        <div class="spinnerWhite"></div>
                                        <label for="selectMunicipio">Municipio</label>
                                        <select name="selectMunicipio" id="selectMunicipio" class="form-control selectMunicipio" disabled>
                                            <option value="0" id="idselectMunicipioModal" selected></option>
                                            <option value="0">Elije un Estado </option>
                                        </select>
                                        <label for="coloniaCustomer">Colonia</label>
                                        <input type="text" id="coloniaCustomer" name="coloniaCustomer" class="form-control" onkeyup="mayusculas(this)">
                                        <label for="inputCPModal">C.P</label>
                                        <input type="text" id="inputCPModal" name="inputCPModal" class="form-control">
                                        <label for="selectRutaModal">Ruta </label>
                                        <select name="selectRutaModal" id="selectRutaModal" class="form-control">
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                            <button type="submit" class="btn btn-primary">ACTUALIAZAR</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
                <form action="<?= base_url ?>Cliente/updateContacto" method="post">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>