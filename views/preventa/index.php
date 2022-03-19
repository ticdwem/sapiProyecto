<div class="container" id="">
    <div class="cabeceraBtn">
        <?php require_once 'views/layout/cabeceraLogo.php'; ?>
    </div>
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <?php require_once 'views/layout/breadcrup.php';?>        
                <table class="table table-striped tablaGenerica">
                    <thead>
                        <tr>
                            <th scope="col">numNota</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Ruta</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($nota = $preventa->fetch_object()): ?>
                            <tr>
                                <th scope="row"><?=$nota->idnotaPedido?></th>
                                <td><?=$nota->nombreCliente?></td>
                                <td><?=$nota->nombreRuta?></td>
                                <td><button type="button" class="btn btn-success detallesPreventa" data-id="<?=$nota->idClientePedido?>" id="<?=$nota->idnotaPedido?>">Detalles</button></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>