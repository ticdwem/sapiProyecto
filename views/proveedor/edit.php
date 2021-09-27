<div class="container" id="editarCliente">
    <div class="cabeceraBtn">
        <?php require_once 'views/layout/cabeceraLogo.php'; ?>
    </div>
    <?php $sesion = "";
    if (isset($_SESSION['formulario_cliente'])) {
        $sesion = $_SESSION['formulario_cliente']['datos'];
    }
    $contador = 1;
    $contadorCli = count($consulta);
    $dom = count($domicilio);
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
        <form action="<?= base_url ?>Proveedor/editProveedor" method="POST" novalidate>
            <div class="cliente">
                <input type="hidden" name="idProveedor" value="<?= $domicilio[0][0] ?>">
                <label for="inputnombre">Nombre</label>
                <input type="text" id="inputnombre" name="inputnombre" class="form-control" placeholder="nombreCliente" value="<?= $domicilio[0][1] ?>" onkeyup="mayusculas(this)">
                <label for="inputRfc">RFC</label>
                <input type="text" id="inputRfcC" name="inputRfc" class="form-control" placeholder="RFC" value="<?= $domicilio[0][2] ?>" onkeyup="mayusculas(this)">
            </div>
            <input type="submit" name="btnGuardarCliente" class="btn btn-primary" value="Editar">
        </form>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 gral card mt-4" id="">
        <div id="contactoCli" class="col-lg-6 col-md-6 col-sm-12 table-responsive">
            <small>CONTACTO PROVEEDOR</small>
            <table class="table table-striped" id="tbl-contacto-Prov">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Principal</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < $contadorCli; $i++) :
                    ?>
                        <tr>
                            <th><?= Validacion::recotarPuntos($consulta[$i][2], 15, 10) ?></th>
                            <td><?= Validacion::recotarPuntos($consulta[$i][3], 5, 4) ?></td>
                            <td><button class="btn btn-primary" role="button" data-id="<?= $consulta[$i][0]; ?>" id="domicilio_<?= $contador; ?>" data-toggle="modal" data-target="#contactoPro_id">VER</button></td>
                        </tr>
                    <?php
                        $contador++;
                    endfor;
                    ?>
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
            <table class="table table-striped" id="tbl-direccionProveedor">
                <thead>
                    <tr>
                        <th scope="col">calle</th>
                        <th scope="col">Principal</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < $dom; $i++) :
                    ?>
                        <tr>
                            <th><?= Validacion::recotarPuntos($domicilio[$i][6], 15, 10) ?></th>
                            <td><?= Validacion::recotarPuntos($domicilio[$i][7], 5, 4) ?></td>
                            <td><button class="btn btn-primary" role="button" data-id="<?= $domicilio[$i][4]; ?>" id="domicilio_<?= $contador; ?>" data-toggle="modal" data-target="#edit_domiclio">VER</button></td>
                        </tr>
                    <?php
                        $contador++;
                    endfor
                    ?>
                </tbody>
            </table>
            <?php
            if ($dom  < 3) {
                echo ' <button type="button" class="btn btn-primary btn-lg btn-block" id="contacto_5" data-toggle="modal" data-target="#add_domiclio">Agregar</button>';
            }
            ?>
        </div>

    </div>
    <!-- Modal  agregar contacto proveedor-->
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
                    <input type="hidden" name="contactoAdd" id="customerModal" class="addId" value="<?= md5('proveedor') ?>">
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
                            <button type="button" id="deleteContato" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="add_Contacto" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal  agregar contacto-->
    <!-- modificar contacto proveedor-->
    <div class="modal fade" id="contactoPro_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCleinteEdit" aria-hidden="true">
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
                    <input type="hidden" name="contactoAddProv" id="provModalEdit" class="addId" value="<?= md5('proveedor') ?>">
                    <div class="modal-body">
                        <div id="contactoCliente" class="">
                            <div class="contactoCli" id="contactoCli">
                                <div id="mensajeCliente"></div>
                                <div class="">
                                    <input type="hidden" name="idContactoCliente" id="idContactoCliente" value="">
                                    <div class="">
                                        <label for="inputnombreContactoEdit">Nombre Contacto</label>
                                        <input type="text" id="inputnombreContactoEdit" name="inputnombreContactoEdit" class="form-control" onkeyup="mayusculas(this)">
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
                        <button type="button" class="btn btn-danger" id="deleteContactProveedor" data-dismiss="modal">ELIMINAR</button>
                        <button type="submit" id="updateCli" class="btn btn-primary">ACTUALIAZAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modificar contacto -->

    <!-- Modal agregar domicilio proveedor-->
    <div class="modal fade" id="add_domiclio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelClienteAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?=base_url?>Proveedor/addDomicilio" method="POST" id="addDomicilio">
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
                                    <input type="hidden" name="iClienteAdd" id="customerAddDom" value="<?= $_GET['id'] ?>">
                                    <input type="hidden" name="contactoAdd" id="customerModalAddDom" class="addId" value="<?= md5('proveedor') ?>">
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
                                    </div>
                                    <div class="spinnerDom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary"  id="btn-add-dom" value="enviar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal agregar domicilio-->

     <!-- Modal agregar domicilio proveedor-->
     <div class="modal fade" id="edit_domiclio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelClienteAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?=base_url?>Proveedor/update" method="POST" id="editDomicilio">
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
                                    <input type="hidden" name="idGet" id="idGet" value="<?=$_GET['id']?>">
                                    <input type="hidden" name="ProveedodId" id="customerEditDom" value="">
                                    <input type="hidden" name="edoEdit" id="editDomProvEdo" class="addId" value="">
                                    <input type="hidden" name="munEdit" id="editDomProvMun" class="addId" value="">
                                    <div class=" domicilioCliente">
                                        <label for="streetCustomerEdit">Calle</label>
                                        <input type="text" id="streetCustomerEdit" name="streetCustomer" class="form-control" value="" onkeyup="mayusculas(this)">
                                        <div class="streetCustomerEdit"></div>
                                        <label for="numeroCustomerEdit">Número</label>
                                        <input type="text" id="numeroCustomerEdit" name="numeroCustomer" class="form-control" placeholder="SI NO TIENE NUMERO DEJAR VACIO">
                                        <div class="numeroCustomerEdit"></div>
                                        <label for="inputEstadoEdit">Estado</label>
                                        <select name="inputEstado" id="inputEstadoEdit" class="form-control selectEstado inpuEstado" disabled>
                                            <option value="" id="idselectEstadoModalEdit" selected></option>
                                        </select>
                                        <div class="inputEstadoEdit"></div>
                                        <div class="spinnerWhite"></div>
                                        <label for="inpuMunicipioEdit">Municipio</label>
                                        <select name="inpuMunicipio" id="inpuMunicipioEdit" class="form-control selectMunicipio" disabled>
                                            <option value="0" id="idselectMunicipioModalEdit" selected></option>
                                            <option value="0">Elije un Estado </option>
                                        </select>
                                        <div class="inpuMunicipioEdit"></div>
                                        <label for="coloniaCustomerEdit">Colonia</label>
                                        <input type="text" class="form-control" name="coloniaCustomer" id="coloniaCustomerEdit" onkeyup="mayusculas(this)" value="">
                                        <div class="coloniaCustomerEdit"></div>
                                        <label for="cpCustomerEdit">C.P</label>
                                        <input type="text" id="cpCustomerEdit" name="cpCustomer" class="form-control">
                                        <div class="cpCustomerEdit"></div>
                                    </div>
                                    <div class="spinnerDom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                           <button id="deleteDomicilioProv" class="btn btn-danger">Eliminar</button>
                            <input type="submit" class="btn btn-primary"  id="btn-edit-dom" value="enviar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal agregar domicilio-->



</div>