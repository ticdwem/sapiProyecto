<div class="cabeceraBtn">
  <?php require_once 'views/layout/cabeceraLogo.php'; ?>
</div>
<div class="container">
  <divx class="">
      <div class="row">
        <div class="col-lg-12">
          <?php require_once 'views/layout/breadcrup.php';?>
          <table class="table table-striped tablaGenerica">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Rfc</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($prov = $proveedor->fetch_object()) : ?>
                <tr>
                  <th><?= $prov->nombreProveesor ?></th>
                  <td><?= $prov->rfcProveedor ?></td>
                  <td><a class="btn btn-primary" href="<?= base_url ?>Proveedor/edit&id=<?= $prov->idProveedor ?>" role="button">Ver</a></td>
                </tr>
              <?php endwhile ?>
            </tbody>
          </table>
      </div>
    </div>  
  </divx>
</div>