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
                                <th>Nombre Chofer</th>
                                <th>Camioneta</th>
                                <th>Fecha Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($ras = $pas->fetch_object()):
                            echo "<pre>";
                            var_dump($ras) ;
                            echo "</pre>";?>
                                <tr>
                                    <td><?=$ras->idClienteNotaPedido?></td>
                                    <td><?=$ras->nombreUsuario?></td>
                                    <td><?=$ras->_camioneta?></td>
                                    <td><?=$ras->fechaSalida?></td>
                                    <td><a class="btn btn-success btn-lg btn-block" href="<?=base_url?>Preventa/asignar&ruta=<?=$ras->rutaIdRutaCamioneta?>&name=<?=SED::encryption($ras->nombreRuta)?>">Editar</a></td>
                                    <td><a class="btn btn-info btn-lg btn-block" href="<?=base_url?>Preventa/verClientes&ruta=<?=$ras->rutaIdRutaCamioneta?>&name=<?=SED::encryption($ras->nombreRuta)?>">Ver Clientes</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>