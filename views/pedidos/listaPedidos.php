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
            <div class="container" id="">
                <form>
                    <div class="form-group">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <label for="exampleFormControlFile1">Ingrese Fecha a Buscar</label>
                                <input class="datepicker" data-date-format="dd/mm/yyyy">
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
            </div>                      
        </div>        
    </div>
</div>
<script> 
$(document).ready(function(){
   
$('.datepicker').datepicker({
    startDate: '-3d'
});
});
</script>