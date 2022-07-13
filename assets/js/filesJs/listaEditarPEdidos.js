    $(document).ready(function(){
        $(document).on('click','.btnEditarPedido',function(e){
            e.preventDefault();
            let idCleinte = $(this).attr('id');
            let nota = $(this).attr('data-id');

            window.location.href = getAbsolutePath() + 'Pedido/editar&id=' + nota + '&cli=' + idCleinte;

        })
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
                            if(terminado == 1){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Se ha enviado con exito',
                                    showConfirmButton: false,
                                    timer: 2500
                                })
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