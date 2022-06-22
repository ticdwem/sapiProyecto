$(document).ready(function() {
    $("#inputCodigoPedido").on("keyup", function(e) {
        let texto = document.getElementsByClassName('inputCodigoPedido')[0].innerHTML;
        let clases = ["inputCodigoPedido", "inputNombreProdPedido", "inputPresentacionPedido", "inputPiezasPedido"];
        if (texto.length > 0) {
            clases.forEach(function(elemento) {
                lipiarDiv(elemento)
            })
        }
    });
});