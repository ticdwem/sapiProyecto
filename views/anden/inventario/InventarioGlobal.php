<div class="container" id=""> 
    <div class="cabeceraBtn">
        <?php require_once 'views/layout/cabeceraLogo.php'; ?>
    </div>
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12 mt-4">
                    <?php require_once 'views/layout/breadcrup.php';?>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id Producto</th>
                                <th>Nombre Producto</th>
                                <th>Piezas</th>
                                <th>Boton</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($inv = $inventario->fetch_object()):?>
                            <tr>
                                <td><?=$inv->id?></td>
                                <td><?=$inv->nameP?></td>
                                <td><?=$inv->total?></td>
                                <td><a class="btn btn-success" href="<?=base_url?>Inventario/inXproducto&id=<?=SED::encryption($inv->id)?>">Detalles</a></td>    
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>