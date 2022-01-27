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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
                </ol>
            </nav>
            <div class="col-sm-12 col-md-12 col-xs-12 pedidoIndex" id="pedidoIndexId">
                <div class="row">
                    <table>
                        <thead>
                            <tr>
                                <th>No Cliente</th>
                                <th>Nombre Cliente</th>
                                <th>Teléfono</th>
                                <th>Ruta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($clientes = $cliente->fetch_object()): ?>
                                <tr>
                                    <td>
                                        
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>                      
        </div>        
    </div>
</div>
<script> 
/* $(document).on('mouseover','.optionje',function(){
    alert("hola")
}) */
</script>