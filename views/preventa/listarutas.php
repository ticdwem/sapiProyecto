
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
                            <th scope="col">Id Ruta</th>
                            <th scope="col">Nombre Ruta</th>
                            <th scope="col">Status</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($ruta = $rutas->fetch_object()): ?>
                            <tr>
                                <th scope="row"><?=$ruta->idRuta?></th>
                                <td><?=$ruta->nombreRuta?></td>
                                <td><?php ?></td>                                
                                <td><button type="button" class="btn btn-success detallesPreventa" data-id="">Detalles</button></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
