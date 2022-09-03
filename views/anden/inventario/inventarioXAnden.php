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
                <th scope="col">id Producto</th>
                <th scope="col">Producto</th>
                <th scope="col">lote</th>
                <th scope="col">Peso</th>
                <th scope="col">Almacen</th>
                <th scope="col">Piezas</th>
            </tr>
          </thead>
          <tbody>
          <?php while ($producto = $completo->fetch_object()) : ?>
              <tr>
                <th><?= $producto->idProductoACentral ?></th>
                <td><?= $producto->nombreProducto ?></td>
                <td><?= $producto->loteACentral ?></td>
                <td><?= $producto->pesoACentral ?></td>
                <td><?= ALMACEN[$producto->almacenACentral] ?></td>
                <td><?= $producto->cantidadPzACentral ?></td>
              </tr>
            <?php endwhile ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>