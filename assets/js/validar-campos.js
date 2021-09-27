$(document).ready(function () {
    /* ========================================================================= 
                    validar cliente
========================================================================= */
    $("#btn-input-cliente").on('click', function () {
        $("#registroCliente").submit(function (e) {
            var nameCustomer = emptyInput($("#nameCustomer").val());
            var rfcCustomer = emptyInput($("#rfcCustomer").val());
            var descuentoCustomer = emptyInput($("#descuentoCustomer").val());

            var registro = { "nombre_nameCustomer": nameCustomer, "rfc_rfcCustomer": rfcCustomer, "decimales_descuentoCustomer": descuentoCustomer }
            validar = validarCampos(registro)
            if (validar > 0) {
                e.preventDefault();
            }

        })
    });


    $("#btn-add-dom").on('click', function () {
        $("#addDomicilio").submit(function (e) {
            let domicilio = Array();
            let validar = 0;
            let streetCustomer = emptyInput($("#streetCustomer").val());
            let numeroCustomer = emptyInput($("#numeroCustomer").val());
            let inputEstado = emptyInput($("#inputEstado").val());
            let inpuMunicipio = emptyInput($("#inpuMunicipio").val());
            let coloniaCustomer = emptyInput($("#coloniaCustomer").val());
            let cpCustomer = emptyInput($("#cpCustomer").val());

            if (numeroCustomer == "empty") { numeroCustomer = '0' }

            domicilio.push({ "nombre_streetCustomer_50": streetCustomer, "phone_numeroCustomer_5": numeroCustomer, "phone_inputEstado_5": inputEstado, "phone_inpuMunicipio_5": inpuMunicipio, "nombre_coloniaCustomer_50": coloniaCustomer, "phone_cpCustomer_5": cpCustomer });

            validar = validarCampos(domicilio)
            if (validar > 0) {
                e.preventDefault();
            }

        })
    });

    $("#add_Contacto").on('click', function () {
        $("#frm_add_contacto").submit(function (e) {
            let contactoArray = Array();
            let val = 0;
            let NombreContacto = emptyInput($("#inputnombreContactoAdd").val());
            let Telefono1Contacto = emptyInput($("#inputTelObligatorio").val());
            let Telefono2Contacto = emptyInput($("#inputTelSecundarioAdd").val());
            let EmailContacto = emptyInput($("#inputEmailAdd").val());

            if (EmailContacto == "empty") { EmailContacto = "empty@empty.com" }
            if (Telefono2Contacto === "empty") { Telefono2Contacto = '500' }

            contactoArray.push({ "nombre_inputnombreContactoAdd_80": NombreContacto, "phone_inputTelObligatorio_12": Telefono1Contacto, "phone_inputTelSecundarioAdd_12": Telefono2Contacto, "email_inputEmailAdd_100": EmailContacto })

            val = validarCampos(contactoArray)
            if (val > 0) {
                e.preventDefault();
            }
        });
    });


    /* ========================================================================= 
                        validar proveedor
    ========================================================================= */
    $("#btn-input-Proveedor").on('click', function () {
        $("#registroProveedor").submit(function (e) {
            let proveedor = Array();
            var nameProveedor = emptyInput($("#nameProveedor").val());
            var rfcProveedor = emptyInput($("#rfcProveedor").val());

            proveedor.push({ "nombre_nameProveedor_50": nameProveedor, "rfc_rfcProveedor_13": rfcProveedor })
            validar = validarCampos(proveedor)
            if (validar > 0) {
                e.preventDefault();
            }

        })
    });

    /* validar agregar a session de domicilio */
    $("#btn-AgregarDomicilioProveedor").on("click", function (e) {
        e.preventDefault();
        let addDomProveedor = Array();
        let validar = 0;
        let nombreCalleProveedor = emptyInput($("#nombreCalleProveedor").val());
        let numeroCasaProveedor = emptyInput($("#numeroCasaProveedor").val());
        let inputEstado = emptyInput($("#inputEstado").val());
        let inpuMunicipio = emptyInput($("#inpuMunicipio").val());
        let coloniaProveedor = emptyInput($("#coloniaProveedor").val());
        let cpProveedor = emptyInput($("#cpProveedor").val());
        let RutaProveedor = emptyInput($("#RutaProveedor").val());

        if (numeroCasaProveedor == 'empty') { numeroCasaProveedor = '0' }

        addDomProveedor.push({ 'nombre_nombreCalleProveedor_80': nombreCalleProveedor, 'phone_numeroCasaProveedor_10': numeroCasaProveedor, 'phone_inputEstado_2': inputEstado, 'phone_inpuMunicipio_5': inpuMunicipio, 'nombre_coloniaProveedor_50': coloniaProveedor, 'phone_cpProveedor_5': cpProveedor, 'phone_RutaProveedor_5': RutaProveedor })
        validar = validarCampos(addDomProveedor);
        if (validar > 0) {
            e.preventDefault();
        } else if (validar == 0) {
            let data = { "dataProveedor": addDomProveedor }
            var json = JSON.stringify(data);
            $.ajax({
                url: getAbsolutePath() + "views/layout/ajax.php",
                method: "POST",
                data: { "domicilioProv": json },
                cache: false,
                beforeSend: function (setDomicilio) {
                    $('.spinnerDomicilio').html('<i class="fas fa-sync fa-spin"></i>');
                },
                success: function (setDomicilio) {
                    $('.spinnerDomicilio').html('');
                    if (setDomicilio > 3) {
                        $('#mensajeDomicilio').html('<div class="alert alert-danger" role="alert">No se puede agregar mas contactos a esta Cliente</div>');
                    } else {
                        $('#mensajeDomicilio').html('<div class="alert alert-success" role="alert">Se agrego correctamente ' + setDomicilio + ' ITEMS</div>');
                    }
                    $("#nombreCalleProveedor").val('');
                    $("#numeroCasaProveedor").val('');
                    /*  $("#inputEstado").html('');
                     $("#inpuMunicipio").html(''); */
                    $("#coloniaProveedor").val('');
                    $("#cpProveedor").val('');
                    $("#RutaProveedor").val('');
                }
            });
        }

    });

    /* validar agegar contacto a la session de contacto */
    $("#btn-AgregarContactoProveedor").on("click", function (e) {
        let addContactoProv = Array();
        let validarContacto = 0;
        let nombreContactoProveedor = emptyInput($("#nombreContactoProveedor").val());
        let correoProveedor = emptyInput($("#correoProveedor").val());
        let telefonoContactoProveedor = emptyInput($("#telefonoContactoProveedor").val());
        let telefonoSecProveedor = emptyInput($("#telefonoSecProveedor").val());

        if (correoProveedor == "empty") { correoProveedor = "empty@empty.com" }
        if (telefonoSecProveedor === "empty") { telefonoSecProveedor = '500' }

        addContactoProv.push({ 'nombre_nombreContactoProveedor_80': nombreContactoProveedor, 'email_correoProveedor_100': correoProveedor, 'phone_telefonoContactoProveedor_12': telefonoContactoProveedor, 'phone_telefonoSecProveedor_12': telefonoSecProveedor, })
        validarContacto = validarCampos(addContactoProv);
        if (validarContacto > 0) {
            e.preventDefault()
        } else if (validarContacto == 0) {
            let data = { "datacontactoProveedor": addContactoProv }
            var json = JSON.stringify(data);
            $.ajax({
                url: getAbsolutePath() + "views/layout/ajax.php",
                method: "POST",
                data: { "contactoProv": json },
                cache: false,
                beforeSend: function (setcontacto) {
                    $('.spinnerDomicilio').html('<i class="fas fa-sync fa-spin"></i>');
                },
                success: function (setcontacto) {
                    $('.spinnerDomicilio').html('');
                    if (setcontacto > 3) {
                        $('#mensajeClienteProveedor').html('<div class="alert alert-danger" role="alert">No se puede agregar mas contactos a esta Cliente</div>');
                    } else {
                        $('#mensajeClienteProveedor').html('<div class="alert alert-success" role="alert">Se agrego correctamente ' + setcontacto + ' ITEMS</div>');
                    }
                }
            });
        }

    })
/* ================================================================================================================================================================ 
                                                validar editar direccion proveedor
   ================================================================================================================================================================ */
    $("#btn-edit-dom").on("click", function(){
        $("#editDomicilio").submit(function(e){        
            let addDomProveedor = Array();
            let validar = 0;
            let streetCustomerEdit = emptyInput($("#streetCustomerEdit").val());
            let numeroCustomerEdit = emptyInput($("#numeroCustomerEdit").val());
            let inputEstadoEdit = emptyInput($("#inputEstadoEdit").val());
            let inpuMunicipioEdit = emptyInput($("#inpuMunicipioEdit").val());
            let coloniaCustomerEdit = emptyInput($("#coloniaCustomerEdit").val());
            let cpCustomerEdit = emptyInput($("#cpCustomerEdit").val());

            addDomProveedor.push({"nombre_streetCustomerEdit_80":streetCustomerEdit,"phone_numeroCustomerEdit_5":numeroCustomerEdit,"phone_inputEstadoEdit_2":inputEstadoEdit,"phone_inpuMunicipioEdit_4":inpuMunicipioEdit,"nombre_coloniaCustomerEdit_50":coloniaCustomerEdit,"phone_cpCustomerEdit_5":cpCustomerEdit})
            validar = validarCampos(addDomProveedor);
            if(validar > 0){
                e.preventDefault();
            }
        })
    })

});


