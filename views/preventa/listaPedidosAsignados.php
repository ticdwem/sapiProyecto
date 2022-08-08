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
                                <th>Num Pedido</th>
                                <th>Nombre Cliente</th>
                                <th>Comentario Nota</th>
                                <th>Fecha Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($nota = $pas->fetch_object()):
                             if($nota->idCliente == 713){$name = $nota->nameCliente." -> ".$nota->nombreAdicional;}else{$name = $nota->nameCliente;}?>
                                <tr>
                                    <td><?=$nota->nota?></td>
                                    <td><?=$name?></td>
                                    <td><?=$nota->comentario?></td>
                                    <td><?=$nota->entrega?></td>
                                    <td><a class="btn btn-info btn-lg btn-block" href="<?=base_url?>Preventa/detalle&id=<?=$nota->nota?>&cli=<?=$nota->idCliente?>&data=<?=$andenvClientes?>">Detalles</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>