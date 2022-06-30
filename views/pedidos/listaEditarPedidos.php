<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
    }

    ?>
</div>
<div class="">
    <div class="row">
        <div class="col-lg-12">
        <?php require_once 'views/layout/breadcrup.php';?>
            <div class="container" id="contenidoTablaHistorico">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="col-sm-12 col-md-12 col-lg-12 row mb-3" id="divbtnClosePedidos">
                        <div class="col-sm-12 col-md-6 col-lg-6" id="idEmptyPedios"></div>
                        <div class="col-sm-12 col-md-6 col-lg-6" id="iddivbntPedidos">
                            <button type="button" class="btn btn-primary btn-lg btn-block">Cerrar Pedidos</button>
                        </div>
                    </div>
                    <table class="table table-striped table-hover tablaGenerica" id="tablaEditarPEdidos">
                        <thead>
                            <tr>
                            <th>Fecha Captura</th>
                            <th>Fecha Entrega</th>
                            <th>Num Nota</th>
                            <th>Cliente</th>
                            <th>Ruta</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($pedido = $pedidos->fetch_object()): ?>
                            <tr>
                                <td><?=$pedido->fechaAltaProductoPedido?></td>
                                <td><?=$pedido->fechaEntregaPedido?></td>
                                <td><?=$pedido->idnotaPedido?></td>
                                <td><?=$pedido->nombreCliente?></td>
                                <td><?=$pedido->nombreRuta?></td>
                                <td><button type="button" class="btn btn-info btnEditarPedido" id="<?=$pedido->idClientePedido?>" data-id="<?=$pedido->idnotaPedido?>">Detalle</button></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    </table>
                    <!-- <div id="showDatos"></div> -->
                </div>
            </div>                      
        </div>        
    </div>
</div>
<script>
    $(document).ready(function(){
        $(document).on('click','.btnEditarPedido',function(e){
            e.preventDefault();
            let idCleinte = $(this).attr('id');
            let nota = $(this).attr('data-id');

            window.location.href = getAbsolutePath() + 'Pedido/editar&id=' + nota + '&cli=' + idCleinte;

        })
    })
</script>