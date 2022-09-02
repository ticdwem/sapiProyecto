$(document).ready(function(){
    $("#seleccionarLoteDuplicado").on('click',function(){
        let loteSeleccion = $("select[name=selectLote]").val();
       let sesion = (sessionStorage.getItem('datosModel'));
       let json = JSON.parse(sesion)

        $("#getidBtn").val(json[0].idBtn);
        $("#idProductoModal").val(json[0].id_producto);
        $("#nombreProdcutoModal").val(json[0].producto);
        $("#piezaSolcitadaModal").val(json[0].piezas);        
        $("#loteVentaModal").val(loteSeleccion);
        $("#pesoModal").val(json[0].peso);
        $(".modal-footer").css('display', 'block');
        $("#message").css('display', 'none');
        $("#message").html('');
        if (json[0].peso != 0 && loteSeleccion != 0) {
            $("#updatePesoVenta").css("display", "none");
        } else if (json[0].peso == 0 && loteSeleccion == 0) {
            $("#updatePesoVenta").css("display", "inline");
            
        }
        $("#loteVentaModal").attr('disabled','disabled' );
        $('#modal-loteExistencia').modal('hide');
        $('#modalProducto').modal({ backdrop: 'static', keyboard: false });
        sessionStorage.removeItem('datosModel')

    });
})