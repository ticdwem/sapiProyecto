

$(document).on('click','.selectPRoductPEdido',function(e){
    let codigo = $(this).parents("tr").find("td")[0].innerHTML;
    let nombre = $(this).parents("tr").find("td")[1].innerHTML;
    let presentacion = $(this).parents("tr").find("td")[2].innerHTML;
    $("#inputCodigoPedido").val(codigo);
    $("#inputNombreProdPedido").val(nombre);
    $("#inputPresentacionPedido").val(presentacion);
    $("#ListPRod").modal('hide');
    if ($('.modal-backdrop').is(':visible')) {
        $('body').removeClass('modal-open'); 
        $('.modal-backdrop').remove(); 
        focusInput('inputPiezasPedido');
    };
});

    const formPedidos = document.getElementById("frmPedido");

    let num = 0;
    formPedidos.addEventListener("submit", function (event) {
        num++;
        event.preventDefault();
        let validar = Array();
        let transactionFormData = new FormData(formPedidos); // obtiene los datos del formulario
        
        let inputCodigo = document.getElementById('inputCodigoPedido').value; 
        let inputNombreProd = document.getElementById('inputNombreProdPedido').value; 
        let inputPresentacion = document.getElementById('inputPresentacionPedido').value; 
        let inputPieza = document.getElementById('inputPiezasPedido').value; 
        
        validar.push({"phone_inputCodigoPedido_6":inputCodigo,"nombre_inputNombreProdPedido_80":inputNombreProd,"messagge_inputPresentacionPedido_500":inputPresentacion,"decimales_inputPiezasPedido_12":inputPieza});
        var campos = validarCampos(validar);
        if(campos == 0 ){
            let inputsCorrects = ["inputCodigoPedido","inputNombreProdPedido","inputPresentacionPedido","inputPiezasPedido"];
            let insertProducto = document.getElementById("registroProductoPedido"); // este es el id de la tabla
            let newProductoRow = insertProducto.insertRow(-1); //este retorna una fila en la ultima fila de 
            let newproductoCellNew = newProductoRow.insertCell(0);// posisicion de la celda
            newproductoCellNew.textContent = transactionFormData.get("inputCodigoPedido");
            
            newproductoCellNew = newProductoRow.insertCell(1);// posisicion de la celda
            newproductoCellNew.textContent = transactionFormData.get("inputNombreProdPedido");                    
            
            newproductoCellNew = newProductoRow.insertCell(2);// posisicion de la celda
            newproductoCellNew.textContent = transactionFormData.get("inputPiezasPedido");   
                            
            newproductoCellNew = newProductoRow.insertCell(3);// posisicion de la celda
            newproductoCellNew.textContent = transactionFormData.get("inputPresentacionPedido");
            
            newproductoCellNew.setAttribute("id","editPedido_"+num)

            
            newproductoCellNew = newProductoRow.insertCell(4);// posisicion de la celda
            newproductoCellNew.insertAdjacentHTML("afterbegin","<button type='button' class='btn btn-warning mr-1 editProductoPedido' onclick='changetrtd(this)' data-id='editPedido_"+num+"'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button><button type='button' class='btn btn-danger deleteOnclick' onclick='deleteRow(this)'><i class='fa fa-times-circle' id='' aria-hidden='true'></i></button>");
            
            inputsCorrects.forEach(function(element){
                limpiarInput(element);
            })
            // este codigo sirve para poner el cursor en la primer input
            focusInput('inputCodigoPedido');

            $("#idViewAllRows").html('<div class="alert alert-info" id="rowsCount" role="alert"> Total Productos: '+num+'</div>');
        }else{
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'TODOS LOS CAMPOS SON OBLIGATORIOS, VERIFIQUE LOS DATOS ',
                showConfirmButton: false,
                timer: 2500
            });  
            
            limpiarInput("inputPeso");
            limpiarInput("inputPrecio");
            limpiarInput("inputSubtotal");
            
            }
    });

        $(document).ready(function(){

            /* este funcion es para ingresar los datos a la base de dato pedidos */
            $("#btnPedidoAceptar").on("click", function(e) {
                let valorPedido = Array();
                let ventaContado = Array({2:2});
                let notaComentario = $("#notaComentario").val();
                let idNota = $("#numNota").val();
                let idCliente = $("#inputIdCliente").val();
                let idUser = $("#idUser").val();
                let fechaEntrega = $("#dateIdPedido").val();
                let ruta = $("#rutaCliente").attr('data-id');
                let valId = expRegular("phone", idCliente);
                let valNota = expRegular("phone", idNota);
                let valFecha = expRegular("date",fechaEntrega);
                
                if(idCliente == 713){
                    let ClienteArray = Array();
                    let name = $("#customName").val();
                    let tel = $("#customPhone").val();
                    let ruta = $("#rutaClienteSlect").val();

                    ClienteArray.push({"nombre_customName_60":name,"messagge_customPhone_10":tel,"phone_rutaClienteSlect_10":ruta});
                    var campos = validarCampos(ClienteArray);
                    if(campos != 0){
                        return false;
                    }else{
                        ventaContado.push({'nombre':name,'telNombre':tel,'rutaCliente':ruta});
                    }
                }

                let numeroFecha = numberDay(fechaEntrega);

                if(numeroFecha == 0){
                    
                }

                if (valId != 0 && valNota != 0 && valFecha != 0) {
                    let tabla = existeRegistro('registroProductotablePedido');
                    if (tabla == 0) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'DEBES REGISTR AL MENOS UN PRODUCTO',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        
                        $("#registroProductoPedido tr").each(function() {
                            let codigo = $(this).find('td').eq(0).html();
                            let producto = $(this).find('td').eq(1).html();
                            let pieza = $(this).find('td').eq(2).html();
                            let presentacion = $(this).find('td').eq(3).html();
                            valorPedido.push({ 'codigo': codigo, 'producto': producto, 'present': presentacion, 'pz': pieza });
                        });
        
                        let data = {
                            "notaComentario":notaComentario,
                            "idCliente": idCliente,
                            "nota": idNota,
                            "user": idUser,
                            "fecha":fechaEntrega,
                            "ruta": ruta,
                            "vc":ventaContado,
                            "productos": valorPedido
                        }
                        let JsonString = JSON.stringify(data);
        
                        $.ajax({
                            url: getAbsolutePath() + "views/layout/ajax/AjaxMakePedido.php",
                            method: "POST",
                            data: { "pedido": JsonString },
                            cache: false,
                            beforeSend: function(setContacto) {
        
                            },
                            success: function(pedido) {
                                if (pedido >= 1) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'SE HA GUARDADO SU PEDIDO CON ÉXITO',
                                        showConfirmButton: false,
                                        timer: 2500
                                    }).then(function() {
        
                                        $(location).attr('href', getAbsolutePath() + 'Pedido/index')
                                    });
                                    $('#alertaInsert').html('<div class="alert alert-success" role="alert"> El producto correctamente </div>');
                                } else {
                                    $('#alertaInsert').html('<div class="alert alert-danger" role="alert">LLAMA A TU ADMINISTRADOR NO SE INSERTO</div>');
        
                                }
        
                                //location.reload();
                            }
                        });
                    } 
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'HAY ERRORES EN LOS IDENTIFICADORES INGRESE DE NUEVO '
                    })
                }/* ddes peus de ste debe pegar el else */
            });
    /* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
        $('#dateIdPedido').datepicker({
            defaultDate: sumarDias(1),
            minDate:sumarDias(1),
            inputs: "hola",
            format: 'dd-mm-yyyy',
            uiLibrary: 'bootstrap4',
            locale: 'es-es',
            startDate: '-3d',
            beforeShowDay:  function(date){
                    show = true;
                    if(date.getDay() == 0 || date.getDay() == 6){show = false;}//No Weekends
                    for (var i = 0; i < holidays.length; i++) {
                        if (new Date(holidays[i]).toString() == date.toString()) {show = false;}//No Holidays
                    }
                    var display = [show,'',(show)?'':'No Weekends or Holidays'];//With Fancy hover tooltip!
                    return display;
                }
        }).val(verifDay(1))
        
        $("#inputCodigoPedido").on('change',function(){
            let codigo = $(this).val();
            var validarCodugo = expRegular("phone", codigo);
            if (validarCodugo != 0) {
                var verifProd = new FormData();
                verifProd.append("producto", codigo);
                console.log(verifProd);
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
                        console.log(datos);
                        if(datos != "0"){
    
                            $("#inputNombreProdPedido").val(datos.descripcionProd);
                            $("#inputPresentacionPedido").val("NADA");
                            
                            focusInput('inputPiezasPedido');
                        }else{
                            focusInput('inputCodigoPedido');
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
        });

        $(document).keydown(function(tecla){
           if(tecla.keyCode == 113){
            let texto = document.getElementsByClassName('inputCodigoPedido')[0].innerHTML;
            let clases = ["inputCodigoPedido", "inputNombreProdPedido", "inputPresentacionPedido", "inputPiezasPedido"];
            if (texto.length > 0) {
                clases.forEach(function(elemento) {
                    lipiarDiv(elemento)
                })
            }
              $("#ListPRod").modal('toggle',{backdrop: 'static', keyboard: false});
           }  
        });
        $("#btnFindProduct").on('click',function(e){
            e.preventDefault();
            let texto = document.getElementsByClassName('inputCodigoPedido')[0].innerHTML;
            let clases = ["inputCodigoPedido", "inputNombreProdPedido", "inputPresentacionPedido", "inputPiezasPedido"];
            if (texto.length > 0) {
                clases.forEach(function(elemento) {
                    lipiarDiv(elemento)
                })
            }
            $("#ListPRod").modal('toggle',{backdrop: 'static', keyboard: false});
        })
        
        
    });