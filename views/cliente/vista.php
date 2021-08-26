<div class="cabeceraBtn">
  <?php require_once 'views/layout/cabeceraLogo.php'; ?>
</div>
<div class="container">
  <table class="table table-striped tablaGenerica">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Rfc</th>
        <th scope="col">Saldo</th>
        <th scope="col">Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($clientes = $cliente->fetch_object()) : ?>
        <tr>
          <th><?= $clientes->nombreCliente ?></th>
          <td><?= $clientes->rfcCliente ?></td>
          <td><?= $clientes->saldoCreditoCliente ?></td>
          <td><a class="btn btn-primary" href="<?= base_url ?>Cliente/edit&id=<?= $clientes->idCliente ?>" role="button">Link</a></td>
        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>