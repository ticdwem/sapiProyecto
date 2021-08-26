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
                  $("#"+indice[1]).css('border', '1px solid red')
                  $("."+indice[1]).html('este campo es obligatorio')
                  $("."+indice[1]).css('color', 'red')
                  e.preventDefault();
              }  else {
                  var error = expRegular(indice[0], $("#"+indice[1]).val());
                  if (error != 0) {
                      $("#"+indice[1]).css('border','1px solid green')
                      $("."+indice[1]).html('correcto')
                      $("."+indice[1]).css('color', 'green')
                  }else{
                      $("#"+indice[1]).css('border', '1px solid red')
                      $("."+indice[1]).html('Formato Incorrecto')
                      $("."+indice[1]).css('color', 'red')
                      e.preventDefault();
                  }
  
              }
              
            }

        })
    });
});