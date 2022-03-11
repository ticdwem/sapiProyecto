<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
    }

    ?>
</div>
<divdddddd class="">
    <divdddd class="row">
        <divdddddd class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
                </ol>
            </nav>
            <div class="container" id="">
                <!-- <div class="row"> -->
                    <table class="table table-striped tablaGenerica">
                        <thead>
                            <tr>
                                <th>No Cliente</th>
                                <th>Nombre Cliente</th>
                                <!-- <th>Teléfono</th> -->
                                <th>Ruta</th>
                                <th>Pedido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($clientes = $pedido->fetch_object()): ?>
                                <tr>
                                    <td>
                                        <?=$clientes->id?>
                                    </td>
                                    <td>
                                        <?=$clientes->nombre?>
                                    </td>
                                    <!-- <td>
                                        <?=$clientes->telPrinContactoCliente?>
                                    </td> -->
                                    <td>
                                        <?=$clientes->nomRuta?>
                                    </td>
                                    <td>
                                    <a href="<?=base_url?>Pedido/pedido&id=<?=$clientes->id?>" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Hacer Pedido</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <!-- </div> -->
            </div>                      
        </divdddddd>        
    </divdddd>
</divdddddd>