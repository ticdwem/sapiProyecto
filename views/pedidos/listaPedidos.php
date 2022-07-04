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
                <form>
                    <div class="form-group">
                        <div class="col-md-12 col-lg-12 col-sm-12">                           
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <label for="exampleFormControlFile1">Ingrese Fecha a Buscar</label>
                                <input class="datepicker" data-date-format="dd/mm/yyyy" id="dateId" autocomplete="off">
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12 mt-4">
                                <button id="sentDate" class="btn btn-primary btn-block">BUSCAR</button>
                            </div>                            
                        </div>
                    </div>
                </form>
                <hr>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th>Fecha Creacion</th>
                            <th>Fecha Entrega</th>
                            <th>Num Nota</th>
                            <th>Cliente</th>
                            <th>ruta</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody id="showDatos">
                        
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
   
    $('.datepicker').datepicker({
        minDate:restarDias(30),
        format: 'dd-mm-yyyy',
        uiLibrary: 'bootstrap4',
        locale: 'es-es',
        startDate: '-3d'
    });

    $(findDate());
    function findDate(datesF){
        $.ajax({
                url: getAbsolutePath() + "views/layout/ajax/AjaxFindOrder.php",
                method: "POST",
                data: datesF,
                cache: false,
                contentType: false,
                 processData: false,
                beforeSend: function() {
                    $("#showDatos").html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Cargando...</span></div></div>')
                },
                success: function(verificar) {
                   
                    let tblLotesPRoducto = '';
                    if(verificar == -1){
                        tblLotesPRoducto += '<tr><td colspan="6"><p style="position:relative;left:40%;font-weight: bold">NO HAY DATOS QUE MOSTRAR</p></td></tr>';       
                    }else if(verificar == -4){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'SOLO PUEDES VER LOS PEDIDOS DE 30 DIAS ATRAS A LA FECHA DE HOY',
                            footer: 'Necesitas algo mas especifico? solicitalo con tu adminstrador'
                        });
                       
                    }
                    else{               
                        for (let x of Object.keys(verificar)) {
                            var pedidoHis = verificar[x];
                            tblLotesPRoducto += '<tr><td>' + pedidoHis.fechaAltaProductoPedido + '</td><td>' + pedidoHis.fechaEntregaPedido + '</td><td>' + pedidoHis.idnotaPedido + '</td><td>' + pedidoHis.nombreCliente + '</td><td>' + pedidoHis.nombreRuta + '</td><td><button type="button" id="' + pedidoHis.idnotaPedido + '" class="btn btn-primary btn-lg detallePedidoAnterior" data-id="'+pedidoHis.idClientePedido+'">Seleccionar</button></td></tr>'; 
                        }
                        tblLotesPRoducto += '</table>';
                    }
                    $("#showDatos").html(tblLotesPRoducto);
                }
            });
    }

    $("#sentDate").on("click",function(e){
        e.preventDefault();
        let buscarFecha = $("#dateId").val();
        let validar = expRegular("date",buscarFecha);
        if(validar == 0){
            e.preventDefault();
            $("#dateId").val("");
            focusInput('dateId');
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'LA FECHA INGRESADA ES INCORRECTA, USA EL CALENDARIO PARA EVITAR ERRORES',
                showConfirmButton: false,
                timer: 2500
            })
        }else{
            var almacen = new FormData();
			almacen.append("buscarFecha", buscarFecha);
            findDate(almacen);
        }
    });

    $(document).on('click', '.detallePedidoAnterior', function() {
    let idNota = $(this).attr('id');
    let cliente = $(this).attr('data-id');
    window.location.href = getAbsolutePath() + 'Pedido/detalle&id=' + idNota + '&cli=' + cliente;

})
});
</script>