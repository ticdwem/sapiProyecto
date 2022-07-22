<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
    }
    $total = 0;
    ?>
</div>
<div class="">
    <div class="row">
        <div class="col-lg-12">
            <?php require_once 'views/layout/breadcrup.php';?>      
            <div class="container" id="">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Codigo Producto</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Piezas</th>
                            <th scope="col">Fecha Entrega</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($totales = $lista->fetch_object()) :?>
                            <tr>
                                <th scope="row"><?=$totales->codigo?></th>
                                <td><?=$totales->nameP?></td>
                                <td><?=$totales->suma?></td>
                                <td><?=$totales->entrega?></td>
                            </tr>                        
                        <?php $total += $totales->suma;endwhile; ?>
                        <tr>
                            <th scope="row" colspan="2" ><p class="sumatoriaProducto">Total :</p></th>
                            <th><p class=""><?=$total?> Piezas</p></th>
                        <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>