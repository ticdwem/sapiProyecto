/*
 * cuando abre el modal para asignar una camioneta
 */
$("#designAlmacen").on("click",function(){
    let idRuta = $("#rutaClienteEditar").attr('data-id');
    let nomRuta = $("#rutaClienteEditar").val();
    var selectCar = '';
    if(idRuta == undefined){
       idRuta = $("#rutaClienteSlect").val();
       nomRuta = $("#rutaClienteSlect option:selected").text();
    }

    $.ajax({
        url: getAbsolutePath() + "views/layout/ajax/AjaxVerifCamioneta.php",
        method: "POST",
        data: { "idRuta": idRuta },
        cache: false,
        beforeSend: function () {
        },
        success: function (updateToVenta) {	
            // obtenemos el primer pociion del json
            let firtsPosision = updateToVenta[0];
            // obtenemos la ultima posicion
            let lastObject = Object.keys(updateToVenta)[Object.keys(updateToVenta).length - 1];
            // suggest es el último valor del objeto de mi json
            let suggest = updateToVenta[Object.keys(updateToVenta)[Object.keys(updateToVenta).length -1]];
            selectCar += '<option selected value="' + suggest.idCamioneta + '">' + suggest.idCamioneta + " -- " +suggest.marcaCamioneta+ " -- " +suggest.placaCamioneta +'</option>';
            selectCar += '<option value="" disabled></option>';
           
            $.each(updateToVenta, function(i, item) {
               if(i == 0){return true}
                if(i == lastObject ){ return false}
                selectCar += '<option value="' + item.idCamioneta + '">' + item.idCamioneta + " -- " +item.marcaCamioneta+ " -- " +item.placaCamioneta +'</option>';
            });
            $("#CamionetaSeleccionada").html(selectCar);


            if(firtsPosision.idChofer == "Sin Datos"){
                $("#select").css("display","block");
                $("#inout").css("display","none");
            }else{
                $("#select").css("display","none");
                $("#inout").css("display","block");
                $("#choferAssigned").val(firtsPosision.idChofer+" "+firtsPosision.nomChofer)
            };
        }
    });

    $("#nomRutaModelAignDelivers").html(nomRuta);
    $("#nomRutaModelAignDelivers").attr('data-id',idRuta);
    $("#SelectAlmacen").modal({backdrop: 'static', keyboard: false});
});


/*
 * cuando al abrir el modal para asignar una camioneta y el campo select tiene un dato  por default
 * si este esta lleno con un "sin sugerencia" se devera regresar al campo anterior para llenar el campo
 * si este tiene un id de una camioneta nos dara un default de chofer
 */
$("#inout").on('click',function(){
    $("#select").css("display","block");
    $("#inout").css("display","none");
})

/* $(document).on('click','.selectAlmacen',function(){
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

}); */