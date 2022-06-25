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
            <div class="container" id="">
                <form>
                    <div class="form-group">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <label for="exampleFormControlFile1">Ingrese Fecha a Buscar</label>
                                <input class="datepicker" data-date-format="dd/mm/yyyy" id="dateId">
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div id="showDatos"></div>
                </div>
            </div>                      
        </div>        
    </div>
</div>
<script> 
$(document).ready(function(){
   
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        uiLibrary: 'bootstrap4',
        locale: 'es-es',
        startDate: '-3d'
    });

$(findDate());
function findDate(datesF){
    $.ajax({
            url: getAbsolutePath() + "views/layout/ajax/AjaxFindOrder.php",
            method: "POST",
            data: { buscarFecha: datesF },
            cache: false,
            beforeSend: function() {
                $("#showDatos").html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Cargando...</span></div></div>')
            },
            success: function(verificar) {
               console.log(verificar);
            }
        });
}
});
</script>