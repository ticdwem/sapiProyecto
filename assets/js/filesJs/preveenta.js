$("#designAlmacen").on("click",function(){
    $("#SelectAlmacen").modal({backdrop: 'static', keyboard: false});
});

$(document).on('click','.selectAlmacen',function(){
    /* let idAlmacen = $(this).parents("tr").find("td")[0].innerHTML; */
    let idAlmacen = $(this).attr('data-id');
    let nota = $("#numNota").val();
    let datos = Array();
    let validar;

    datos.push({'phone_idAlmacen_9':idAlmacen,'phone_nota_10':nota});
    validar=validarCampos(datos);
    if(validar > 0){
        Swal.fire(
                'error!',
                'HAY DATOS ERRONEOS VERIFICA O LLAMA A TU ADMINISTRADOR',
                'error'
                )
        
    }else{
        let data = { "data": datos }
		var json = JSON.stringify(data);
        $.ajax({
            url: getAbsolutePath() + "views/layout/ajax/AjaxAsignarAlmacen.php",
            method: "POST",
            data: { "updateToVenta": json },
            cache: false,
            beforeSend: function () {
            },
            success: function (updateToVenta) {	
                if(updateToVenta == 1){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $(location).attr('href',getAbsolutePath() + "Preventa/index");
                }
            }
        });
    }

});