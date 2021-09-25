<div class="cabeceraBtn">
  <?php require_once 'views/layout/cabeceraLogo.php'; ?>
</div>
<div class="container">
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
          <td><a class="btn btn-primary" href="<?= base_url ?>Proveedor/edit&id=<?= $prov->idProveedor ?>" role="button">Link</a></td>
        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>