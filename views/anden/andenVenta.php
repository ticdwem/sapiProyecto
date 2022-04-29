<div class="cabeceraBtn">
  <?php require_once 'views/layout/cabeceraLogo.php'; ?>
</div>
<div class="container">
  <div class="">
    <div class="row">
      <div class="col-lg-12">
        <?php require_once 'views/layout/breadcrup.php';?>
        <table class="table table-striped tablaGenerica">
          <thead>
            <tr>
              <th scope="col">No. Nota</th>
              <th scope="col">Cliente</th>
              <th scope="col">Venta</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php while ($notas = $datos->fetch_object()) : ?>
              <tr>
                <td><?= $notas->idnotaPedido ?></td>
                <th ><?= $notas->nombreCliente ?></th>
                <td ><a class="btn btn-primary btn-lg btn-block" href="<?= base_url ?>Anden/venta&nota=<?= $notas->idnotaPedido ?>&cli=<?=$notas->idClientePedido?>" role="button">Venta</a></td>
                <th ></th>
              </tr>
            <?php endwhile ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>