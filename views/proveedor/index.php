<?php require_once 'views/layout/cabeceraLogo.php';
if (isset($_SESSION['formulario_cliente'])) {
  $sesion = $_SESSION['formulario_cliente']['datos'];
  if ($sesion != "") {
    echo '<p class="alert alert-danger error " role="alert">' . $_SESSION['formulario_cliente']["error"] . "</p>";
  }
}

?>

<div class="texcto m-3">
  <?php
  if (isset($_SESSION['statusSave'])) echo '<p class="alert alert-success error" role="alert">' . $_SESSION['statusSave'] . "</p>";
  Utls::deleteSession('formulario_cliente');
  Utls::deleteSession('statusSave'); ?>
</div>

<div class="container viewTop">
  <div class="card">
    <form action="<?= base_url ?>Proveedor/create" method="POST" id="registroProveedor" novalidate>
      <div class="smallSubtitle">
        <small>PROVEEDOR</small>
        <hr>
      </div>
      <div class="form-row p-2">
        <div class="form-group col-md-6">
          <label for="nameProveedor">Nombre</label>
          <input type="text" class="form-control" name="nameProveedor" id="nameProveedor" onkeyup="mayusculas(this)">

          <div class="nameProveedor"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="rfcProveedor">RFC</label>
          <input type="text" class="form-control" name="rfcProveedor" id="rfcProveedor" onkeyup="mayusculas(this)">
          <div class="rfcProveedor"></div>
        </div>
      </div>
      <div class="smallSubtitle">
        <small>DOMICILIO</small>
        <hr>
      </div>
      <div class="form-row p-2">
        <div class="form-group col-md-6">
          <label for="nombreCalleProveedor">Calle</label>
          <input type="text" class="form-control" name="nombreCalleProveedor" id="nombreCalleProveedor" onkeyup="mayusculas(this)">
          <div class="nombreCalleProveedor"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="numeroCasaProveedor">Número</label>
          <input type="text" class="form-control" name="numeroCasaProveedor" id="numeroCasaProveedor" placeholder="SI NO TIENE NUMERO DEJAR VACIO">
          <div class="numeroCasaProveedor"></div>
        </div>
      </div>
      <div class="form-row p-2">
        <div class="form-group col-md-6">
          <label for="inputEstado">Estado</label>
          <select class="form-control inpuEstado" id="inputEstado" name="inputEstado">
            <option value="" selected>Escoge un estado</option>
            <?php while ($estado = $variable->fetch_object()) : ?>
              <option value="<?= $estado->idEstado ?>"><?= $estado->estado ?></option>
            <?php endwhile; ?>
          </select>
          <div class="inputEstado"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="inpuMunicipio">Municipio</label>
          <select class="form-control" id="inpuMunicipio" name="inpuMunicipio">
            <option value="" selected>Escoge un municipio</option>
          </select>
          <div class="inpuMunicipio"></div>
        </div>
      </div>
      <div class="form-row p-2">
        <div class="form-group col-md-6">
          <label for="coloniaProveedor">Colonia</label>
          <input type="text" class="form-control" name="coloniaProveedor" id="coloniaProveedor" onkeyup="mayusculas(this)">
          <div class="coloniaProveedor"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="cpProveedor">Código Postal</label>
          <input type="text" class="form-control" name="cpProveedor" id="cpProveedor">
          <div class="cpProveedor"></div>
        </div>
      </div>
      <div class="form-row p-2">
        <div class="form-group col-md-6">
          <label for="RutaProveedor">Ruta</label>
          <select name="RutaProveedor" id="RutaProveedor" class="form-control">
            <option value="">Escoge una Ruta</option>
            <?php while ($ruta = $nombreRuta->fetch_object()) : ?>
              <option value="<?= $ruta->idRuta ?>"><?= $ruta->nombreRuta ?></option>
            <?php endwhile ?>
          </select>
          <div class="RutaProveedor"></div>
        </div>
        <div class="form-group col-md-6">

        </div>
      </div>
      <div class="form-row p-2">
        <div class="">
          <button id="btn-AgregarDomicilioProveedor" class="btn btn-success mt-3" type="button">Agregar</button>
        </div>
        <div class="spinnerDomicilio"></div>
        <div id="mensajeDomicilio"></div>
        <div id="activa">
        </div>
      </div>
      <div class="smallSubtitle">
        <small>CONTACTO</small>
        <hr>
      </div>
      <div class="form-row p-2" id="contactos">
        <div class="form-group col-md-6">
          <label for="nombreContactoProveedor">Nombre Contacto</label>
          <input type="text" class="form-control" name="nombreContactoProveedor" id="nombreContactoProveedor" onkeyup="mayusculas(this)">
          <div class="nombreContactoProveedor"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="correoProveedor">Correo Contacto</label>
          <input type="text" class="form-control" name="correoProveedor" id="correoProveedor" placeholder="SI NO TIENE CORREO DEJAR EN BLANCO">
          <div class="correoProveedor"></div>
        </div>
      </div>
      <div class="form-row p-2 " id="contacto">
        <div class="form-group col-md-6">
          <label for="telefonoContactoProveedor">Teléfono Principal</label>
          <input type="text" class="form-control" name="telefonoContactoProveedor" id="telefonoContactoProveedor">
          <div class="telefonoContactoProveedor"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="telefonoSecProveedor">Teléfono Secundario</label>
          <input type="text" class="form-control" name="telefonoSecProveedor" id="telefonoSecProveedor" placeholder="SI NO TIENE TELÉFONO DEJAR EN BLANCO">
          <div class="telefonoSecProveedor"></div>
        </div>
      </div>
      <div class="form-row p-2">
        <div class="">
          <button id="btn-AgregarContactoProveedor" class="btn btn-success mt-3" type="button">Agregar</button>
        </div>
        <div class="spinnerCliente"></div>
        <div id="mensajeClienteProveedor"></div>
        <div id="activa">
        </div>
      </div>
      <hr>
      <div class="form-row p-2">
        <input type="submit" class="form-control btn btn-primary btn-lg btn-block" id="btn-input-Proveedor" name="btnGuardarProveedor" value="ENVIAR">
      </div>
    </form>
  </div>
</div>