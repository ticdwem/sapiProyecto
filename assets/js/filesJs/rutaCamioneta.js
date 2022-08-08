$(function(){
   //$(document).on('click','button[type="button"]',function(event){
    $(document).on('click','.eliminarRutaChofer',function(e){
        let idCamioneta = this.id;
        let chofer = this.dataset.get;
        let nameruta = document.getElementById('namert').value;
        let idRuta = document.getElementById('rutaNameid').dataset.id;
        let fecha = $(this).parents("tr").find("td")[4].innerHTML;
        let sendDatos = Array();

        let camioneta = expRegular('dir',idCamioneta);
        let chof = expRegular('phone',chofer);

        if(camioneta != 0 || chof != 0){
            Swal.fire({
                title: 'Eliminar',
                text: "Se eliminara el chofer y camioneta de esta ruta",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si Eliminar'
              }).then((result) => {
                if (result.isConfirmed) {
                    sendDatos.push({"idCamioneta":idCamioneta,"chofer":chofer,"idRuta":idRuta,"nameRuta":nameruta,"date":fecha})
                    let data = { "Datos": sendDatos }
                    var json = JSON.stringify(data);
                    $.ajax({
                        url: getAbsolutePath() + "views/layout/ajax/AjaxDeleteChoferRuta.php",
                        method: "POST",
                        data: { "datosDelete": json },
                        cache: false,
                        beforeSend: function (setDomicilio) {
                            $('.spinnerDomicilio').html('<i class="fas fa-sync fa-spin"></i>');
                        },
                        success: function (deleleteCamionetRuta) {
                            $('#showTableRutaCamioneta').load(" #showTableRutaCamioneta");
                            
                         $('#postCamionetaChofer').load(" #postCamionetaChofer");
                             /*   $('#idChoferSelect').load(" #idChoferSelect"); */
                            if(deleleteCamionetRuta == 1){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'se ha eliminado correctamente',
                                    text: 'EL CHOFER Y CAMIONETA ESTAN DISPONIBLES PARA SER ASIGNADOS',
                                    showConfirmButton: false,
                                    timer: 3500
                                  })
                            }else if(deleleteCamionetRuta == 1){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: 'Datos Erroneos',
                                    text: 'LOS DATOS SON ERRONES VERIFICA NUEVAMENTE',
                                    showConfirmButton: false,
                                    timer: 1500
                                  })
                            }else{
                                Swal.fire({
                                    position: 'center',
                                    icon: 'ERROR',
                                    title: 'ERROR AL ELIMINAR',
                                    text: 'NO SE HA PODIDO ELIMINAR, INTENTA NUEVAMENTE O CONSULTA A TU ADMINSITRADOR',
                                    showConfirmButton: false,
                                    timer: 1500
                                  })
                            }
                        }
                    });
                }
              })
        }


    })
}); 

$(function(){
    $(document).on('click','.EditarChoferCamioenta',function(e){
        let idChofer = $(this).attr('data-id');
        let nameCh = $(this).parents("tr").find("td")[2].innerHTML;

        let fecha = $(this).parents("tr").find("td")[4].innerHTML;

        let IdCamioneta = $(this).parents("tr").find("td")[0].innerHTML;
        let nameCamioneta = $(this).parents("tr").find("td")[1].innerHTML;
        let ruta = $("#rutaNameid").attr('data-id');

        $("#idCamionetaEditar").attr('data-id',IdCamioneta);
        $("#idFechaEditar").attr('data-id',fecha);
        $("#caioneta").val(IdCamioneta+'--'+nameCamioneta);
        $("#idChoferSelectEditar").prepend("<option value='"+idChofer+"' selected='selected'>"+nameCh+"</option>")
        $("#ModalEditarRutaCamioneta").modal({ backdrop: 'static', keyboard: false });
    });
})

$(document).on('click','#actualizarChoferDisponible',function(e){
    let idChofer = $("#idChoferSelectEditar option:selected").val();
    let idruta = $("#rutaNameid").attr('data-id');
    let idCamioneta = $("#idCamionetaEditar").attr('data-id');
    let Fecha=$("#idFechaEditar").attr('data-id');

    let valUpdate = Array();

    valUpdate.push({"phone_idChofer_10":idChofer,"phone_idruta_10":idruta,"dir_idCamioneta_20":idCamioneta,"dateUs_Fecha_20":Fecha})
    let validar = validarCampos(valUpdate);
    

    if (validar > 0) {
        Swal.fire(
            'ERROR',
            'Hay errores en los datos',
            'error'
        )
        e.preventDefault();
    } else {
        let data = { "data": valUpdate }
        var json = JSON.stringify(data);
        $.ajax({
            url: getAbsolutePath() + "views/layout/ajax/AjaxEditarChoferRuta.php",
            method: "POST",
            data: { "editarChofRt": json },
            cache: false,
            beforeSend: function() {},
            success: function(updateEdit) {
                if(updateEdit == 1){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Se actualizo correctamente',
                        text: 'EL CHOFER REEMPLAZADO HA QUEDADO DISPONIBLE PARA SER ASIGNADO A OTRA RUTA',
                        showConfirmButton: false,
                        timer: 2500
                      }).then((result) => {
                        $('#showTableRutaCamioneta').load(" #showTableRutaCamioneta");
                        $("#ModalEditarRutaCamioneta").modal('hide');
                      })
                }else if(updateEdit == 2){
                    Swal.fire(
                        'ERROR!',
                        'NO SE PUDO ACTUALIZAR ERROR DESCONOCIDO',
                        'error'
                      )
                }else{
                    Swal.fire(
                        'ERROR!',
                        'Hay errores que impiden que se actualize',
                        'error'
                      )
                }
            }
        });
    }

})