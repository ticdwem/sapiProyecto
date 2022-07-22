    $(document).ready(function(){
        $(document).on('click','.btnEditarPedido',function(e){
            e .preventDefault();
            let direccion="Pedido/editar";
            let direct = $("#controllerRedirectJs").attr('data-id');
            let idCleinte = $(this).attr('id');
            let nota = $(this).attr('data-id');
            let cmd5 = $("#getmd").attr('data-id');
            
            if(direct == "Preventa"){
                direccion = "Preventa/detalle"
            }
            window.location.href = getAbsolutePath() +direccion+'&id=' + nota + '&cli=' + idCleinte+'&data=' + cmd5;

        });
    })

    $("#btnClosePEdido").on("click", function(e){
        $btnId = $(this).attr("data-id");
        let tabla = existeRegistro("tablaEditarPEdidos");
       if(tabla == 1){
            Swal.fire({
                title: 'Envar los pedidos?',
                text: "Se enviaran los pedidos al area de Anden",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si enviar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: getAbsolutePath() + "views/layout/ajax/AjaxTerminarPedido.php",
                        method: "POST",
                        data: { "idUSEr": $btnId },
                        cache: false,
                        beforeSend: function () {
                        },
                        success: function (terminado) {	
                            console.log(terminado);
                            if(terminado == 1){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Se ha enviado con exito',
                                    showConfirmButton: false,
                                    timer: 2500
                                });
                                $('#tablaEditarPEdidos').load(" #tablaEditarPEdidos");
                            }else if(terminado == 0){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Hubo un problema, llama a tu administrador',
                                    showConfirmButton: false,
                                    timer: 2800
                                })
                            }else if(terminado == -1){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Se ha manipulado el front, llama a tu administrador',
                                    showConfirmButton: false,
                                    timer: 2800
                                })
                            }
                        }
                    });
                
                }
            })
        }else{
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'NO HAY PEDIDOS GUARDADOS',
                showConfirmButton: false,
                timer: 2500
            })
        }
    });

/* eliminar producto de la lista */
$(document).on('click', '.deleteOnclickDb', function(e) {
    let codPRod = $(this).attr('id');
    let nota = $(this).attr('data-get');
    let notadato = Array();
    Swal.fire({
        title: 'Estas Seguro?',
        text: "Eliminar de la lista",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            notadato.push({ 'phone_idProd_10': codPRod, 'phone_numNota_10': nota });
            validar = validarCampos(notadato);
            if (validar > 0) {
                Swal.fire(
                    'ERROR',
                    'Hay errores en los datos',
                    'error'
                )
                e.preventDefault();
            } else {
                let data = { "data": notadato }
                var json = JSON.stringify(data);
                $.ajax({
                    url: getAbsolutePath() + "views/layout/ajax.php",
                    method: "POST",
                    data: { "notaDeleteDb": json },
                    cache: false,
                    beforeSend: function() {},
                    success: function(deletePRoducDbNota) {
                        if (deletePRoducDbNota == 0) {
                            Swal.fire(
                                'error!',
                                'HAY DATOS ERRONEOS VERIFICA O LLAMA A TU ADMINISTRADOR',
                                'error'
                            )
                        } else if (deletePRoducDbNota == 1) {
                            $('#registroProductotablePedidoEditar').load(" #registroProductotablePedidoEditar");
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'SE HA ELIMINADO CORRECTAMENTE',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else {
                            Swal.fire(
                                'error!',
                                'HAY UN FALLO NO SE PUDO ELIMINAR, INTENTA DE NUEVO',
                                'error'
                            )
                        }

                        $('#registroProductotablePedido').load(" #registroProductotablePedido");
                        $('#rowsCount').load(" #rowsCount");
                    }
                });
            }


        }
    })

});

/* cambia fecha de entrega */
$("#btnIdChangeDate").on("click",function(e){
    let validar = Array();
    let dateChange = $("#dateIdPedido").val();
    let numNota = $("#numNota").val();
    let cliente = $("#inputIdClienteEditar").val();
    let idUser = $("#idUser").val();
    validar.push({"date_dateIdPedido_15":dateChange,"phone_numNota_20":numNota,"phone_inputIdClienteEditar_25":cliente,"phone_idUser_20":idUser});
    let campos = validarCampos(validar);

    if(campos == 0){
        let JsonString = JSON.stringify(validar);

        $.ajax({
            url: getAbsolutePath() + "views/layout/ajax/AjaxChangeDate.php",
            method: "POST",
            data: {"data":JsonString},
            cache: false,
            beforeSend: function() {
                $('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
            },
            success: function(resultSentToAjax) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'SE CAMBIO CON EXITO LA FECHA DE ENTREGA',
                    showConfirmButton: false,
                    timer: 1500
                  })
               
            }
        });
    }
});

/* cambiar presentacion y piezas */
$("#updatePzModalEdit").on("click", function(e) {
    let idget = $("#idgetEditar").val();
    let idProducto = $("#idProductoModalEdit").val();
    let pz = $("#piezasModalEdit").val();
    let present = $("#presentacionModalEdit").val();
    let pzold = $("#pzoldValue").val();
    let datosArray = Array();
    datosArray.push({ 'phone_idget_12': idget, 'phone_idProducto_12': idProducto, 'phone_piezas_10': pz,'messagge_presentacionModalEdit_500':present });
    var validar = validarCampos(datosArray);
    if (validar > 0) {
        Swal.fire(
            'error!',
            'HAY DATOS ERRONEOS VERIFICA O LLAMA A TU ADMINISTRADOR',
            'error'
        )
    } else {
        let data = { "data": datosArray }
        var json = JSON.stringify(data);
        $.ajax({
            url: getAbsolutePath() + "views/layout/ajax.php",
            method: "POST",
            data: { "updatePro": json },
            cache: false,
            beforeSend: function() {},
            success: function(updatePz) {
                console.log(updatePz)
                if (updatePz == 1) {
                    $('#modalEditProductEntrega').modal('hide');
                    $('#registroProductotablePedidoEditar').load(" #registroProductotablePedidoEditar");
                } else {
                    Swal.fire(
                        'ERROR?',
                        'Hubo un error al intentar Editar llame a su adminsitrador',
                        'question'
                    )
                }
            }
        });
    }
});

/* insertar nuevo producto */
$("#enterProductoEditar").on('click',function(e){
    let valorPedido = Array();
    let numNota = $("#numNota").val();
    let idUser = $("#idUser").val();
    let inputIdClienteEditar = $("#inputIdClienteEditar").val();
    let fechaEntregaEditar = $("#fechaEntregaPedidoEditar").val();
    let comentario = $("#notaComentario").val();
    e.preventDefault();
    const formPedidos = document.getElementById("prodEditForm");
    /* ////////////////////////////////// */
    let validar = Array();
        let transactionFormData = new FormData(formPedidos); // obtiene los datos del formulario 
        
        let inputCodigo = document.getElementById('inputCodigoPedidoEditar').value; 
        let inputNombreProd = document.getElementById('inputNombreProdPedidoEditar').value; 
        let inputPresentacion = document.getElementById('inputPresentacionPedidoEditar').value; 
        let inputPieza = document.getElementById('inputPiezasPedidoEditar').value; 
        
        validar.push({"phone_inputCodigoPedido_6":inputCodigo,"nombre_inputNombreProdPedido_80":inputNombreProd,"nombre_inputPresentacionPedido_80":inputPresentacion,"decimales_inputPiezasPedido_12":inputPieza});
        var campos = validarCampos(validar);
        if(campos == 0 ){
            valorPedido.push({ 'codigo': inputCodigo, 'producto': inputNombreProd, 'present': inputPresentacion, 'pz': inputPieza });
            let data = {
                "idCliente": inputIdClienteEditar,
                "nota": numNota,
                "user": idUser,
                "fecha":fechaEntregaEditar,
                "notaComentario":comentario,
                "productos": valorPedido
            }
            let JsonString = JSON.stringify(data);
            $.ajax({
                url: getAbsolutePath() + "views/layout/ajax/AjaxAddPedido.php",
                method: "POST",
                data: {"data":JsonString},
                cache: false,
                beforeSend: function() {
                    $('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
                },
                success: function(resultSentToAjax) {
                    let inputsCorrects = ["inputCodigoPedidoEditar","inputNombreProdPedidoEditar","inputPresentacionPedidoEditar","inputPiezasPedidoEditar"];
                    inputsCorrects.forEach(function(element){
                        limpiarInput(element);
                    })
                    $('#registroProductotablePedidoEditar').load(" #registroProductotablePedidoEditar");
                    $('#rowsCount').load(" #rowsCount");
                }
            });
        }


});



    $("#inputCodigoPedidoEditar").on("change", function() {
        let codigo = $(this).val();

        var validarCodugo = expRegular("phone", codigo);
        if (validarCodugo != 0) {
            var verifProd = new FormData();
            verifProd.append("producto", codigo);
            $.ajax({
                url: getAbsolutePath() + "views/layout/ajax.php",
                method: "POST",
                data: verifProd,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
                },
                success: function (datos) {
                    if(datos != "0"){

                        $("#inputNombreProdPedidoEditar").val(datos.descripcionProd);
                        $("#inputPresentacionPedidoEditar").val("Nada");
                        
                        focusInput('inputPiezasPedidoEditar');
                    }else{
                        focusInput('inputCodigoPedidoEditar');
                        Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR',
                                    text: 'No hay registro de este identificador de producto'
                                })
                    }
                }
            })
        }else{
            alert("algo salio mal")
        }
    })
    $("#btnFindProductEditar").on('click', function() {
        $("#ListPRod").modal({backdrop: 'static', keyboard: false})
    });


    

    $(document).on('click','.btnEditarPzProducto',function(){
    let idPro = $(this).parents("tr").find("td")[0].innerHTML;
    let producto = $(this).parents("tr").find("td")[1].innerHTML;
    let present = $(this).parents("tr").find("td")[3].innerHTML;
    let pieza = $(this).parents("tr").find("td")[2].innerHTML;
    let pzOld = $(this).attr('data-id')
    $("#idProductoModalEdit").val(idPro);
    $("#nombreProdcutoModalEdit").val(producto);
    $("#presentacionModalEdit").val(present);
    $("#piezasModalEdit").val(pieza);
    $("#pzoldValue").val(pieza)
    $('#modalEditProductEntrega').modal('show');
});


$(document).on('click','.selectEditarPRoductPEdido',function(e){
    let codigo = $(this).parents("tr").find("td")[0].innerHTML;
    let nombre = $(this).parents("tr").find("td")[1].innerHTML;
    let presentacion = $(this).parents("tr").find("td")[2].innerHTML;
    $("#inputCodigoPedidoEditar").val(codigo);
    $("#inputNombreProdPedidoEditar").val(nombre);
    $("#inputPresentacionPedidoEditar").val(presentacion);
    $("#ListPRod").modal('hide');
    if ($('.modal-backdrop').is(':visible')) {
        $('body').removeClass('modal-open'); 
        $('.modal-backdrop').remove(); 
        focusInput('inputPiezasPedido');
    };
});