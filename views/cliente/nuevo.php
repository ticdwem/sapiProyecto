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
  Utls::deleteSession('contactoCliente');
  Utls::deleteSession('statusSave'); ?>
</div>

<div class="container viewTop">
  <div class="card">
    <form action="<?= base_url ?>Cliente/create" method="POST" id="registroCliente" novalidate>
      <div class="smallSubtitle">
        <small>CLIENTES</small>
        <hr>
      </div>
      <div class="form-row p-2">
        <div class="form-group col-md-6">
          <label for="nameCustomer">Nombre:</label>
          <input type="text" class="form-control" name="nameCustomer" id="nameCustomer" onkeyup="mayusculas(this)">

          <div class="nameCustomer"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="rfcCustomer">RFC:</label>
          <input type="text" class="form-control" name="rfcCustomer" id="rfcCustomer" onkeyup="mayusculas(this)">
          <div class="rfcCustomer"></div>
        </div>
      </div>
      <div class="form-row p-2">
        <div class="form-group col-md-6">
          <label for="descuentoCustomer">Descuento %:</label>
          <input type="text" class="form-control" name="descuentoCustomer" id="descuentoCustomer">
          <div class="descuentoCustomer"></div>
        </div>
        <div class="form-group col-md-6"></div>
      </div>
      <div class="smallSubtitle">
        <small>DOMICILIO</small>
        <hr>
      </div>
      <div class="form-row p-2">
        <div class="form-group col-md-6">
          <label for="streetCustomer">Calle</label>
          <input type="text" class="form-control" name="streetCustomer" id="streetCustomer" onkeyup="mayusculas(this)">
          <div class="streetCustomer"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="numeroCustomer">Número</label>
          <input type="text" class="form-control" name="numeroCustomer" id="numeroCustomer" placeholder="SI NO TIENE NUMERO DEJAR VACIO">
          <div class="numeroCustomer"></div>
        </div>
      </div>
      <div class="form-row p-2">
        <div class="form-group col-md-6">
          <label for="inputEstado">Estado</label>
          <select class="form-control inpuEstado" id="inputEstado" name="inputEstado">
            <option value="" selected>Escoge un estado</option>
            <?php while ($estado = $nombreE->fetch_object()) : ?>
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
          <label for="coloniaCustomer">Colonia</label>
          <input type="text" class="form-control" name="coloniaCustomer" id="coloniaCustomer" onkeyup="mayusculas(this)">
          <div class="coloniaCustomer"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="cpCustomer">Código Postal</label>
          <input type="text" class="form-control" name="cpCustomer" id="cpCustomer">
          <div class="cpCustomer"></div>
        </div>
      </div>
      <div class="form-row p-2">
        <div class="form-group col-md-6">
          <label for="RutaCustomer">Ruta</label>
          <select name="RutaCustomer" id="RutaCustomer" class="form-control">
            <option value="">Escoge una Ruta</option>
            <?php while ($ruta = $rta->fetch_object()) : ?>
              <option value="<?= $ruta->idRuta ?>"><?= $ruta->nombreRuta ?></option>
            <?php endwhile ?>
          </select>
          <div class="RutaCustomer"></div>
        </div>
        <div class="form-group col-md-6">

        </div>
      </div>
      <div class="form-row p-2">
        <div class="">
          <button id="btn-AgregarDomicilio" class="btn btn-success mt-3" type="button">Agregar</button>
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
          <label for="nameContactoCustomer">Nombre Contacto:</label>
          <input type="text" class="form-control" name="nameContactoCustomer" id="nameContactoCustomer" onkeyup="mayusculas(this)">
          <div class="nameContactoCustomer"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="emailContactoCustomer">Correo Contacto:</label>
          <input type="text" class="form-control" name="emailContactoCustomer" id="emailContactoCustomer" placeholder="SI NO TIENE CORREO DEJAR EN BLANCO">
          <div class="emailContactoCustomer"></div>
        </div>
      </div>
      <div class="form-row p-2 " id="contacto">
        <div class="form-group col-md-6">
          <label for="telPrCustomer">Teléfono Principal:</label>
          <input type="text" class="form-control" name="telPrCustomer" id="telPrCustomer">
          <div class="telPrCustomer"></div>
        </div>
        <div class="form-group col-md-6">
          <label for="telSecCustomer">Teléfono Secundario:</label>
          <input type="text" class="form-control" name="telSecCustomer" id="telSecCustomer" placeholder="SI NO TIENE TELÉFONO DEJAR EN BLANCO">
          <div class="telSecCustomer"></div>
        </div>
      </div>
      <div class="form-row p-2">
        <div class="">
          <button id="btn-AgregarContacto" class="btn btn-success mt-3" type="button">Agregar</button>
        </div>
        <div class="spinnerCliente"></div>
        <div id="mensajeCliente"></div>
        <div id="activa">
        </div>
      </div>
      <hr>
      <div class="form-row p-2">
        <input type="submit" class="form-control btn btn-primary btn-lg btn-block" id="btn-input-cliente" name="btnEnviar" value="ENVIAR">
      </div>
    </form>
  </div>
</div>




<br>
<br><br>



  <div class="row"> 
    <div class="col-lg-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">CAPTURA DE COMPRAS</li>
      </ol>
    </nav>

    <div class="card">
      <div class="card-body">
       <!--  This is some text within a card body. -->
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
            <label for="" >26-04-2021</label>
            <!-- <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"> -->
          </div> 
            
        
        

            <div class="col-lg-6">
           
             <!--  <div class="input-group-prepend col-lg-2">
                <span class="input-group-text" id="inputGroup-sizing-sm">PROVEEDOR.:</span>
              </div> -->
             <!--  <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"> -->
             <div class="form-group input-group-sm col-lg-8">
                <label for="exampleFormControlSelect1">NOMBRE DEL PROVEEDOR</label>
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            
            </div>

            <div class="col-lg-6">
           
           <!--  <div class="input-group-prepend col-lg-2">
              <span class="input-group-text" id="inputGroup-sizing-sm">PROVEEDOR.:</span>
            </div> -->
           <!--  <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"> -->
           <div class="form-group input-group-sm col-lg-8">
              <label for="exampleFormControlSelect1">NOMBRE DEL PROVEEDOR</label>
              <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          
          </div>

          <div class="col-lg-6">
           
          <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">With textarea</span>
  </div>
  <textarea class="form-control" aria-label="With textarea"></textarea>
</div>
          
          </div>

      <div class="col-lg-6">
           
          <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">With textarea</span>
              </div>
              <textarea class="form-control" aria-label="With textarea"></textarea>
            </div>
          </div>     
        </div>

        <div class="col-lg-12">

        <table class="table">
  <caption>List of users</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Producto</th>
      <th scope="col">Piezas</th>
      <th scope="col">Peso</th>
      <th scope="col">Lote</th>
      <th scope="col">Precio</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>###</td>
      <td>###</td>
      <td>###</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>###</td>
      <td>###</td>
      <td>###</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>###</td>
      <td>###</td>
      <td>###</td>
    </tr>
  </tbody>
</table>

        </div>

      </div>
    </div><!-- FIN DEL CARD -->

  </div>
</div>