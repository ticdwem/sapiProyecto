<?php $name = "";?>
<div class="container" id="">
    <div class="cabeceraBtn">
        <?php require_once 'views/layout/cabeceraLogo.php'; ?>
    </div>
    <div class="">
        <div class="row">
                <div class="col-lg-12">
                <?php require_once 'views/layout/breadcrup.php';?>
                <div class="table-responsive">
                    <table id="example" class="table table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Ruta</th>
                                <th>Anden</th>
                                <th>Notas</th>
                                <th>accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($ruta = $rutas->fetch_object()):
                                $conteo = Utls::countVentaToday($ruta->idRuta)->fetch_object();
                                /* Utls::dd($conteo); */
                                ?>
                                <tr>
                                    <td><?=$ruta->nombreRuta?></td>
                                    <td><?=$ruta->nombreAlmacen?></td>
                                    <td><?=$conteo->contar?></td>
                                    <td><a class="btn btn-info btn-lg btn-block" href="<?=base_url?>Anden/lista&ruta=<?=SED::encryption($ruta->idRuta)?>&name=<?=SED::encryption($ruta->nombreRuta)?>">Venta</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>