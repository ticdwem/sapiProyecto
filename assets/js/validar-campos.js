$(document).ready(function () {
    $("#btn-input-cliente").on('click', function () {
        $("#registroCliente").submit(function (e) {
            var nameCustomer = emptyInput($("#nameCustomer").val());
            var rfcCustomer = emptyInput($("#rfcCustomer").val());
            var descuentoCustomer = emptyInput($("#descuentoCustomer").val());

            var registro = { "nombre_nameCustomer": nameCustomer, "rfc_rfcCustomer": rfcCustomer, "decimales_descuentoCustomer": descuentoCustomer }
            for (const clave in registro) {
                var indice = separaTexto(clave)
                if (registro[clave] === "empty") {
                    $("#" + indice[1]).css('border', '1px solid red')
                    $("." + indice[1]).html('este campo es obligatorio')
                    $("." + indice[1]).css('color', 'red')
                    e.preventDefault();
                } else {
                    var error = expRegular(indice[0], $("#" + indice[1]).val());
                    if (error != 0) {
                        $("#" + indice[1]).css('border', '1px solid green')
                        $("." + indice[1]).html('correcto')
                        $("." + indice[1]).css('color', 'green')
                    } else {
                        $("#" + indice[1]).css('border', '1px solid red')
                        $("." + indice[1]).html('Formato Incorrecto')
                        $("." + indice[1]).css('color', 'red')
                        e.preventDefault();
                    }

                }

            }

        })
    });

    
    $("#btn-add-dom").on('click', function () {
        /*  e.preventDefault(); */
        $("#addDomicilio").submit(function (e) {
            let domicilio = Array();
            let contadorDomicilio = 0;
            let streetCustomer = emptyInput($("#streetCustomer").val());
            let numeroCustomer = emptyInput($("#numeroCustomer").val());
            let inputEstado = emptyInput($("#inputEstado").val());
            let inpuMunicipio = emptyInput($("#inpuMunicipio").val());
            let coloniaCustomer = emptyInput($("#coloniaCustomer").val());
            let cpCustomer = emptyInput($("#cpCustomer").val());
            let RutaCustomer = emptyInput($("#RutaCustomer").val());


            if (numeroCustomer == "empty") { numeroCustomer = '0' }


            domicilio.push({ "nombre_streetCustomer_50": streetCustomer, "phone_numeroCustomer_5": numeroCustomer, "phone_inputEstado_5": inputEstado, "phone_inpuMunicipio_5": inpuMunicipio, "nombre_coloniaCustomer_50": coloniaCustomer, "phone_cpCustomer_5": cpCustomer, "phone_RutaCustomer_5": RutaCustomer });

            for (var clave in domicilio[0]) {

                var indice = separaTexto(clave)
                if (domicilio[0][clave] === 'empty') {
                    $("#" + indice[1]).css('border', '1px solid red')
                    $("." + indice[1]).html('este campo es obligatorio')
                    $("." + indice[1]).css('color', 'red')
                    contadorDomicilio = contadorDomicilio + 1;
                } else {

                    var error = expRegular(indice[0], domicilio[0][clave])
                    if (error != 0) {
                        let largoTexto = tamanoTxt(domicilio[0][clave], indice[2])
                        if (largoTexto) {
                            $("#" + indice[1]).css('border', '1px solid green')
                            $("." + indice[1]).html('correcto')
                            $("." + indice[1]).css('color', 'green')
                        } else {
                            ("#" + indice[1]).css('border', '1px solid red')
                            $("." + indice[1]).html('EXCEDE EL TAMAÑO PERMITIDO')
                            $("." + indice[1]).css('color', 'red')
                            contadorDomicilio = contadorDomicilio + 2;
                        }
                    } else {
                        $("#" + indice[1]).css('border', '1px solid red')
                        $("." + indice[1]).html('Formato Incorrecto')
                        $("." + indice[1]).css('color', 'red')
                        contadorDomicilio = contadorDomicilio + 2;
                    }
                }
            }
            if(contadorDomicilio > 0){
                e.preventDefault();
            }

        })
    });
});


function validar(arrayDatos){
    for (var clave in domicilio[0]) {

        var indice = separaTexto(clave)
        if (domicilio[0][clave] === 'empty') {
            $("#" + indice[1]).css('border', '1px solid red')
            $("." + indice[1]).html('este campo es obligatorio')
            $("." + indice[1]).css('color', 'red')
            contadorDomicilio = contadorDomicilio + 1;
        } else {

            var error = expRegular(indice[0], domicilio[0][clave])
            if (error != 0) {
                let largoTexto = tamanoTxt(domicilio[0][clave], indice[2])
                if (largoTexto) {
                    $("#" + indice[1]).css('border', '1px solid green')
                    $("." + indice[1]).html('correcto')
                    $("." + indice[1]).css('color', 'green')
                } else {
                    ("#" + indice[1]).css('border', '1px solid red')
                    $("." + indice[1]).html('EXCEDE EL TAMAÑO PERMITIDO')
                    $("." + indice[1]).css('color', 'red')
                    contadorDomicilio = contadorDomicilio + 2;
                }
            } else {
                $("#" + indice[1]).css('border', '1px solid red')
                $("." + indice[1]).html('Formato Incorrecto')
                $("." + indice[1]).css('color', 'red')
                contadorDomicilio = contadorDomicilio + 2;
            }
        }
    }
}