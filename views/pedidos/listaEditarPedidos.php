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
                    <?php if($_GET['action'] == "pedidos"):?>
                        <div class="col-sm-12 col-md-12 col-lg-12 row mb-3" id="divbtnClosePedidos">
                            <div class="col-sm-12 col-md-6 col-lg-6" id="idEmptyPedios"></div>
                            <div class="col-sm-12 col-md-6 col-lg-6" id="iddivbntPedidos">
                                <button type="button" class="btn btn-primary btn-lg btn-block btnClosePEdido" id="btnClosePEdido" data-id="<?=IDUSER?>">Enviar Pedidos</button>
                            </div>
                        </div>
                    <?php endif; ?>
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
                        <?php while ($pedido = $pedidos->fetch_object()):?>
                            <tr>
                                <td><?=$pedido->fechaInicial?></td>
                                <td><?=$pedido->fechaFin?></td>
                                <td><?=$pedido->nota?></td>
                                <td><?=$pedido->nameCl?></td>
                                <td><?=$pedido->rutaname?></td>
                                <td><button type="button" class="btn btn-info btnEditarPedido" id="<?=$pedido->clente?>" data-id="<?=$pedido->nota?>">Detalle</button></td>
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
