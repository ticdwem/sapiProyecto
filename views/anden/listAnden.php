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
                <th scope="col">Anden</th>
                <th scope="col">letra Anden</th>
                <th scope="col">accion</th>
            </tr>
          </thead>
          <tbody>
          <?php while ($anden = $list->fetch_object()) : 
            if($anden->indiceAlmacen == 0){continue;}
            ?>
              <tr>
                <th><?= $anden->indiceAlmacen ?></th>
                <td><?= $anden->nombreAlmacen ?></td>
                <td><a href="<?=base_url?>Inventario/almacen&id=<?=SED::encryption($anden->indiceAlmacen)?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Inventario</a></td>
              </tr>
            <?php endwhile ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>