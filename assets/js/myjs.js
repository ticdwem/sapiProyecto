$(document).ready(function () {

	var path = window.location.href;
	var login = sessionStorage.getItem("logguin");
	var prevurl = sessionStorage.getItem("lasTUrl");
	// obtener el url
	if (path == getAbsolutePath() && login == "logueado") {
		var session = document.getElementById("frmLogginVerif");
		var attr = session.getAttribute("data-id");
		if (attr == 1) {
			Swal.fire({
				title: '¿Quieres salir de la aplicación?',
				showDenyButton: true,
				confirmButtonText: `Si Salir`,
				denyButtonText: `NO Quedarme`,
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					sessionStorage.removeItem("logguin");
					$(location).attr('href', getAbsolutePath() + 'Loggin/logout');
				} else if (result.isDenied) {
					sessionStorage.removeItem("lasTUrl");
					$(location).attr('href', prevurl);
				}
			})
		}
	}
	/* colocar fechas en los inputs */
	$("#fechaCompra").val(hoy());
	/* datatables  */
	$(".tablaGenerica").DataTable({
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": false,
		"info": true,
		"autoWidth": true
	});
	/* DATATABLE pEDIDOS 
	$("#pedidoIndexId").DataTable({
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": false,
		"info": true,
		"autoWidth": true
	});*/

	/* disabled div usuario */
	$(".permisoDoctor").attr('disabled', 'disabled');
	$('.dropdown-toggle').on("click", function () {
		$('.dropdown-menu').toggleClass('show');
	});
	/* dat picker al campo fecha*/
	$('#dateInicio').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'dd-mm-yyyy'
	})

	/* para mostrar tip en lo sbotones */
	$('[data-toggle="tooltip"]').tooltip();
	/*detectamos el select seleccionado*/
	$(".inpuEstado").on('change', function () {
		var dato = $(this).val();
		var id = new FormData();
		var selectMun = '';
		id.append("idEstado", dato);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: id,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				$('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
			},
			success: function (exist) {
				$.each(exist, function (i, item) {
					selectMun += '<option value="' + item.id + '">' + item.name + '</option>';
				});
				$("#inpuMunicipio").html(selectMun);
				$('.spinnerWhite').html('');
			}
		})
	})


	/*:::::::::::::::::::::::::::::::::::::::::::::::validar el correo que sea unico::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	$("#inpuCorreo").on("change", function () {
		var emailer = $(this).val();
		var validar = expRegular("email", emailer);

		if (validar != 0) {
			var mail = new FormData();
			mail.append("correo", emailer);
			$.ajax({
				url: getAbsolutePath() + "views/layout/ajax.php",
				method: "POST",
				data: mail,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
				},
				success: function (exsisteEmail) {
					if (exsisteEmail == 1) {
						$("#inpuCorreo").removeClass("is-valid");
						$("#error").removeClass("valid-feedback");

						$("#inpuCorreo").addClass("is-invalid");
						$("#error").addClass("invalid-feedback");
						$("#error").html("ESTE CORREO ESTA EN USO");
					} else if (exsisteEmail == 0) {
						$("#inpuCorreo").removeClass("is-invalid");
						$("#error").removeClass("invalid-feedback");

						$("#inpuCorreo").addClass("is-valid");
						$("#error").addClass("valid-feedback");
						$("#error").html("CORRECTO!!");
					}
				}
			})
		}

	});

	/* :::::::::::::::::::::::::::::::::::::::::::::::loguin:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	$("#emailLoggin").on('change', function () {
		var email = $(this).val();
		var validarEmail = expRegular("email", email);

		if (validarEmail != 0) {
			var mail = new FormData();
			mail.append("correoLoggin", email);
			$.ajax({
				url: getAbsolutePath() + "views/layout/ajax.php",
				method: "POST",
				data: mail,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
				},
				success: function (emaillog) {
					if (emaillog) {
						$("#tipoUser").val(emaillog.tipo);
						if (emaillog.tipo == 2 || emaillog.tipo == 3) {
							$(".selectH").css('display', 'block');
						} else {
							$(".selectH").css('display', 'none');
						}
					} else {
						$("#tipoUser").val(0);
					}
				}
			})
		}
	});

	$(".btnstart").on("click", function () {
		$("#frmLogginVerif").submit(function (e) {
			var correo = emptyInput($("#emailLoggin").val());
			var pass = emptyInput($("#inputPassLoggin").val());
			var tipo = $("#tipoUser").val();
			if (correo == "empty") {
				$("#emailLoggin").attr('placeholder', 'RECUERDA ESTE CAMPO ES OBLIGATORIO');
				e.preventDefault();
			}

			if (pass == "empty") {
				$("#inputPassLoggin").attr('placeholder', 'RECUERDA ESTE CAMPO ES OBLIGATORIO');
				e.preventDefault();
			}

			if (tipo == 2 || tipo == 3) {
				var select = emptyInput($("#consul option:selected").val());

				if (select == "empty") {
					$(".errorSelect").css({ 'color': 'red', 'opacity': '0.5', 'font-family': "'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif" });
					$(".errorSelect").html('RECUERDA ESTE CAMPO ES OBLIGATORIO');
					e.preventDefault();
				}
			}


		})
	})
	/* ============================================================================================================================================================================ */
	// agregar conacto al cliente
	/* ============================================================================================================================================================================ */
	$("#btn-AgregarContacto").on("click", function () {
		let registro = Array();
		var nameContactoCustomer = emptyInput($("#nameContactoCustomer").val());
		var emailContactoCustomer = emptyInput($("#emailContactoCustomer").val());
		var telPrCustomer = emptyInput($("#telPrCustomer").val());
		var telSecCustomer = emptyInput($("#telSecCustomer").val());
		var relacionContacto = emptyInput($("#idRelacional").val());


		if (emailContactoCustomer == "empty") { emailContactoCustomer = "empty@empty.com" }
		if (telSecCustomer === "empty") { telSecCustomer = '500' }

		registro.push({ "nombre_nameContactoCustomer_80": nameContactoCustomer, "phone_telPrCustomer_10": telPrCustomer, "email_emailContactoCustomer_100": emailContactoCustomer,
						"phone_telSecCustomer_10": telSecCustomer,"phone_idRelacional_12":relacionContacto })

		var validar = validarCampos(registro)
		if (validar > 0) {
			e.preventDefault();
		} else if (validar === 0) {
			var data = { "data": registro };
			var json = JSON.stringify(data);
			$.ajax({
				url: getAbsolutePath() + "views/layout/ajax.php",
				method: "POST",
				data: { "contactoCliente": json },
				cache: false,
				beforeSend: function (setContacto) {
					$('.spinnerCliente').html('<i class="fas fa-sync fa-spin"></i>');
				},
				success: function (setContacto) {
					
					$('.spinnerCliente').html('');
					if (setContacto > 3) {
						$('#mensajeCliente').html('<div class="alert alert-danger" role="alert">No se puede agregar mas contactos a esta Cliente</div>');
					} else {
						$('#mensajeCliente').html('<div class="alert alert-success" role="alert">se agrego correctamente ' + setContacto + ' ITEMS</div>');
						$(".agregarTelDom").modal('hide');
						$("#btn-input-cliente").removeClass('datosDisbled');
						$("#btn-input-cliente").removeAttr('disabled');
						$('#mensajeCliente').html('');

					}
				}
			});
			$("#nameContactoCustomer").val('');
			$("#emailContactoCustomer").val('');
			$("#telPrCustomer").val('');
			$("#telSecCustomer").val('');
		}
	});
/* 	$("#preibabtn").on('click',function(){

		$(".agregarTelDom").modal();
	}) */
	$("#btn-AgregarDomicilio").on('click', function (e) {
		let domicilio = Array();
		let streetCustomer = emptyInput($("#streetCustomer").val());
		let numeroCustomer = emptyInput($("#numeroCustomer").val());
		let inputEstado = emptyInput($("#inputEstado").val());
		let inpuMunicipio = emptyInput($("#inpuMunicipio").val());
		let coloniaCustomer = emptyInput($("#coloniaCustomer").val());
		let cpCustomer = emptyInput($("#cpCustomer").val());
		let RutaCustomer = emptyInput($("#RutaCustomer").val());
		let idLastDomicilio = emptyInput($("#idDato").val());


		if (numeroCustomer == "empty") { numeroCustomer = '0' }


		domicilio.push({ "nombre_streetCustomer_50": streetCustomer, "phone_numeroCustomer_5": numeroCustomer, "phone_inputEstado_5": inputEstado, 
						  "phone_inpuMunicipio_5": inpuMunicipio, "nombre_coloniaCustomer_50": coloniaCustomer, "phone_cpCustomer_5": cpCustomer, 
						  "phone_RutaCustomer_5": RutaCustomer, "phone_idDato_12":idLastDomicilio });

		validar = validarCampos(domicilio)
		if (validar > 0) {
			e.preventDefault();
		} else if (validar == 0) {
			let data = { "data": domicilio }
			var json = JSON.stringify(data);
			$.ajax({
				url: getAbsolutePath() + "views/layout/ajax.php",
				method: "POST",
				data: { "domicilio": json },
				cache: false,
				beforeSend: function (setDomicilio) {
					$('.spinnerDomicilio').html('<i class="fas fa-sync fa-spin"></i>');
				},
				success: function (setDomicilio) {
					let separador = separaTexto(setDomicilio,2);			
					$('.spinnerDomicilio').html('');
					if (separador[0] > 3) {
						$('#mensajeDomicilio').html('<div class="alert alert-danger" role="alert">No se puede agregar mas contactos a esta Cliente</div>');
					} else {
						$("#idRelacional").val(separador[1]);
						$('#mensajeDomicilio').html('<div class="alert alert-success" role="alert">Se agrego correctamente ' + separador[0] + ' ITEMS</div>');
						$(".agregarTelDom").modal();
						
					}
				}
			});
			$("#streetCustomer").val('')
			$("#numeroCustomer").val('')
			$("#inputEstado").val('')
			$("#inpuMunicipio").val('')
			$("#coloniaCustomer").val('')
			$("#cpCustomer").val('')
			$("#RutaCustomer").val('')
		}


	});
	/* ============================================================================================= 
						 detectamos el boton que fue presionado de una tabla de clientes
	============================================================================================= */
	$('body').on('click', '#tbl-contacto button', function (i) {
		i.preventDefault();
		var idboton = $(this).attr('data-id');
		var cliente = $("#inputnombre").val();
		var datos = new FormData();
		datos.append('idcontacto', idboton);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function (contacto) {
				$("#idContactoCliente").val(contacto.idContactoCliente);
				$(".exampleModalLabel").html(cliente)
				$("#inputnombreContactoEdit").val(contacto.nombreCliente);
				$("#inputTelObligatorioEdit").val(contacto.telefonoPrincipal);
				$("#inputTelSecundarioEdit").val(cambiarAempty(contacto.telefonoScundario));
				$("#inputEmailEdit").val(cambiarAempty(contacto.correoContacto));
			}
		})
	});

	/* ============================================================================================= 
					 detectamos el boton que fue presionado de una tabla de proveedores
============================================================================================= */
	$('body').on('click', '#tbl-contacto-Prov button', function (i) {
		i.preventDefault();
		var idboton = $(this).attr('data-id');
		var cliente = $("#inputnombre").val();
		var datos = new FormData();
		datos.append('idcontactoProv', idboton);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function (contacto) {
				$("#idContactoCliente").val(contacto.idContactoCliente);
				$(".exampleModalLabel").html(cliente)
				$("#inputnombreContactoEdit").val(contacto.nombreCliente);
				$("#inputTelObligatorioEdit").val(contacto.telefonoPrincipal);
				$("#inputTelSecundarioEdit").val(contacto.telefonoScundario);
				$("#inputEmailEdit").val(contacto.correoContacto);
			}
		})
	});


	/* ============================================================================================= 
					 detectamos el boton que fue presionado de una tabla de cliente de proveedores
============================================================================================= */
	$("body").on('click', '#tbl-direccionProveedor button', function (e) {
		e.preventDefault();
		let btnidDirProveedor = $(this).attr('data-id')
		let datosDirProv = new FormData();
		datosDirProv.append('idDirProv', btnidDirProveedor);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: datosDirProv,
			cache: false,
			contentType: false,
			processData: false,
			success: function (dirProv) {
				$("#customerEditDom").val(btnidDirProveedor);
				$("#streetCustomerEdit").val(dirProv.calleDomicilioPRoveedor)
				$("#numeroCustomerEdit").val(dirProv.numeroDomiclioProveedor)
				$("#editDomProvEdo").val(dirProv.idEstado)
				$("#idselectEstadoModalEdit").val(dirProv.idEstado)
				$("#idselectEstadoModalEdit").html(dirProv.estado)
				$("#editDomProvMun").val(dirProv.idMunicipio)
				$("#idselectMunicipioModalEdit").val(dirProv.idMunicipio)
				$("#idselectMunicipioModalEdit").html(dirProv.municipio)
				$("#coloniaCustomerEdit").val(dirProv.coloniaProv)
				$("#cpCustomerEdit").val(dirProv.cpDomicilioProveedor)
			}
		})
	})
	/* ============================================================================================= 
			 detectamos el boton que se ha clickeado de una tabla de direcciones de parte clientess
	============================================================================================= */
	$('body').on('click', '#tbl-direccion button', function (e) {
		e.preventDefault();
		var boton = $(this).attr('id');
		var idboton = $(this).attr('data-id');  // id de la tabla de contacto cliente
		var NombreClient = $("#inputnombre").val(); // nombre de cliente
		var idDatos = new FormData();
		idDatos.append("idcliente", idboton);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: idDatos,
			cache: false,
			contentType: false,
			processData: false,
			success: function (mun) {
				$("#customer").val(mun.idcliente);
				$("#iddomicilio").val(mun.idDomicilio);
				$(".exampleModalLabel").html(NombreClient);
				$("#inputCalleModal").val(mun.calle);
				$("#inputNumeroModal").val(mun.numeroCasa);
				$("#idselectEstadoModal").val(mun.idEstado)
				$("#idselectEstadoModal").html(mun.nombreEstado)
				$("#coloniaCustomerAdd").val(mun.colonia)
				$("#idselectMunicipioModalHidden").val(mun.idMunicipio)
				$("#idselectMunicipioModal").val(mun.idMunicipio)
				$("#idselectMunicipioModal").html(mun.nombreMunicipio)
				$("#inputCPModal").val(mun.cp);
				$("#idselectRutaModal").html(mun.nombreRuta);
				$("#hiddenRuta").val(mun.idRuta);
				$("#idselectRutaModal").val(mun.idRuta);

			}
		})

	});
	/* ============================================================================================= 
										ELIMINAR DE LA TABLA cliente
	   ============================================================================================= */
	$("#deleteDom").on('click', function (e) {
		e.preventDefault();
		var idDomicilio = $("#iddomicilio").val();  // id del domicilio del cliente
		let botontr = $("#idBoton").val();
		let idDatosDelete = new FormData();
		idDatosDelete.append("idDomicilioDelete", idDomicilio);

		Swal.fire({
			title: 'ELIMINAR?',
			text: "ESTAS SEGURO DE ELIMNINAR ESTA DIRECCIÓN, ESTA ACCIÓN ES IRREVERSIBLE",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'SI ELIMINAR'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: getAbsolutePath() + "views/layout/ajax.php",
					method: "POST",
					data: idDatosDelete,
					cache: false,
					contentType: false,
					processData: false,
					success: function (deleteUser) {
						if (deleteUser == 1) {

							location.reload();
						} else if (deleteUser == 0) {
							Swal.fire(
								'NO SE ELIMINO',
								'HUBO UN ERRO EN LA TAREA',
								'error'
							)
						}
					}
				})
			}
		})
	})

	/* ============================================================================================= 
									eliminar de contacto proveedor
	   ============================================================================================= */
	$("#deleteContactProveedor").on('click', function (e) {
		e.preventDefault();
		let idcontactPo = $("#idContactoCliente").val();
		let idProveedorDelete = new FormData();
		idProveedorDelete.append("idProvDelete", idcontactPo);
		Swal.fire({
			title: 'ELIMINAR?',
			text: "ESTAS SEGURO DE ELIMNINAR ESTA DIRECCIÓN, ESTA ACCIÓN ES IRREVERSIBLE",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'SI ELIMINAR'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: getAbsolutePath() + "views/layout/ajax.php",
					method: "POST",
					data: idProveedorDelete,
					cache: false,
					contentType: false,
					processData: false,
					success: function (deleteUser) {
						if (deleteUser == 1) {

							location.reload();
						} else if (deleteUser == 0) {
							Swal.fire(
								'NO SE ELIMINO',
								'HUBO UN ERRO EN LA TAREA',
								'error'
							)
						}
					}
				})
			}
		})
	})

	$("#deleteDomicilioProv").on("click", function (e) {
		e.preventDefault();

		let idEliminar = $("#customerEditDom").val();
		let idProveedorDelete = new FormData();
		idProveedorDelete.append("idDomicilioProvDelete", idEliminar);
		Swal.fire({
			title: 'ELIMINAR?',
			text: "ESTAS SEGURO DE ELIMNINAR ESTA DIRECCIÓN, ESTA ACCIÓN ES IRREVERSIBLE",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'SI ELIMINAR'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: getAbsolutePath() + "views/layout/ajax.php",
					method: "POST",
					data: idProveedorDelete,
					cache: false,
					contentType: false,
					processData: false,
					success: function (deleteUser) {
						if (deleteUser == 1) {

							location.reload();
						} else if (deleteUser == 0) {
							Swal.fire(
								'NO SE ELIMINO',
								'HUBO UN ERRO EN LA TAREA',
								'error'
							)
						}
					}
				})
			}
		})
	});

	/* selececciona un nombre de proveedor para mostrar su información en el textarea */
	$("#selectNombreProveedor").on("change", function () {
		let idPRoveedorSelect = $(this).val();
		var selectProvProd = '';
		let idProveedorS = new FormData();
		idProveedorS.append("idProveedorSelect", idPRoveedorSelect);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: idProveedorS,
			cache: false,
			contentType: false,
			processData: false,
			success: function (Adress) {
				selectProvProd += "<table class='table'><thead><tr><th>Estado</th><th>Municipio</th><th>Colonia</th><th>Calle</th></tr></thead>";
				for (let index = 0; index < Adress.length; index++) {
					selectProvProd += '<tr><td>' + Adress[index]['estado'] + '</td><td>' + Adress[index]['municipio'] + '</td><td>' + Adress[index]['coloniaProv'] + '</td><td>' + Adress[index]['calleDomicilioPRoveedor'] + '</td>';
				}
				selectProvProd += '</table>';
				$("#showProv").html(selectProvProd);
			}
		})
	})

	/* selececciona un nombre de proveedor para mostrar su información en el textarea */
	$("#selectAlmacenVenta").on("change", function () {
		let idAlmacenSelect = $(this).val();
		var selectAlmacen = '';
		var status = 0;
		let idAlmacen = new FormData();
		idAlmacen.append("idAlmacenSelect", idAlmacenSelect);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: idAlmacen,
			cache: false,
			contentType: false,
			processData: false,
			success: function (almacen) {
				if (almacen['statusAlamcen'] == 1) { status = "Activo" } else { status = "Inactivo" }
				selectAlmacen += "<table class='table'><thead><tr><th>Ubicacion</th><th>Status</th></tr></thead>";
				selectAlmacen += '<tr><td>' + almacen['areaAlmacen'] + '</td><td>' + status + '</td></tr>';

				selectAlmacen += '</table>';
				$("#showAlmacen").html(selectAlmacen);
			}
		})
	});
	$("#selectAlmacenVenta").on("change", function () {
		let idAlmacenSelect = $(this).val();
		var selectAlmacen = '';
		var status = 0;
		let idAlmacen = new FormData();
		idAlmacen.append("idAlmacenSelect", idAlmacenSelect);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: idAlmacen,
			cache: false,
			contentType: false,
			processData: false,
			success: function (almacen) {
				if (almacen['statusAlamcen'] == 1) { status = "Activo" } else { status = "Inactivo" }
				selectAlmacen += "<table class='table'><thead><tr><th>Ubicacion</th><th>Status</th></tr></thead>";
				selectAlmacen += '<tr><td>' + almacen['areaAlmacen'] + '</td><td>' + status + '</td></tr>';

				selectAlmacen += '</table>';
				$("#showAlmacenVentas").html(selectAlmacen);
			}
		})
	});
	/* ajax quw consulta e imprime en las casillas para los productos  expRegular("email", emailer); */
	$("#inputCodigo").on("change", function () {
		$id = $(this).val();
		let producto = new FormData();
		producto.append('idProductoCompra', $id);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: producto,
			cache: false,
			contentType: false,
			processData: false,
			success: function (producto) {
				if (producto == 0) {
					Swal.fire({
						position: 'center',
						icon: 'info',
						title: 'EL PRODUCTO NO SE HA ENCONTRADO',
						showConfirmButton: false,
						timer: 1500
					});
					$("#inputCodigo").focus('inputCodigo');
				} else {

					focusInput('inputPieza')
					$("#inputNombreProd").val(producto.nombreProd);
				}
			}
		})
	})

	/*  calculamos el total multiplicando el precio por el precio */
	$("#inputPrecio").on("change", function () {
		let precio = $(this).val();
		let peso = $("#inputPeso").val();
		let Multiplicacion = multi(peso, precio);
		$("#inputSubtotal").val(Multiplicacion);
	})
	/* esta fucnion sirve para insertar el id y el nombre de los productor */
	$('body').on("click", "#tablaPRoductos button", function (e) {
		e.preventDefault();
		let idboton = $(this).attr("id");
		let botonName = $(this).attr("data-idname");

		$("#inputCodigo").val(idboton);
		$("#inputNombreProd").val(botonName);
	});

	// buscamos los datos del cliente (BUSQUEDA MANUAL)
	$("#numeroCliente").on("change", function () {
		let cliente = Array();
		let numeroCliente = $(this).val();

		cliente.push({ 'phone_numeroCliente_10': numeroCliente });
		validar = validarCampos(cliente);

		if (validar > 0) {
			e.preventDefault();
		} else if (validar == 0) {
			let clienteId = new FormData();
			clienteId.append('idClienteVenta', numeroCliente);

			$.ajax({
				url: getAbsolutePath() + "views/layout/ajax.php",
				method: "POST",
				data: clienteId,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$('#circuloCliente').html('<i class="fas fa-sync fa-spin"></i>');
				},
				success: function (clientes) {
					let countCliente = Object.keys(clientes).length;
					switch (countCliente) {
						case 2:
						case 3:
						//CREAMOS LA TABLA CON LA SIGUIENTE FUNCION
						tablasClientes(clientes,'datosTiendas');
						// TOMAMOS EL NOMBRE DEL CLIENTE
						$("#NomClienteTitulo").html(clientes[0].nombreCliente);
						// GENERAMOS EL MODAL 
						$('#TablaDatosClientes').modal({backdrop: 'static', keyboard: false});
						$('#circuloCliente').html('');
						$("#idClientesXtienda").val(numeroCliente);
						// LIMPIO EL INPUT PARA EVITAR QUE SE USE DE NUEVO DE SER NECESARIO
						limpiarInput('numeroCliente');
						// LIMPIMOS EL MODAL
						jQuery('#TablaDatosClientes').on('hidden.bs.modal', function (e) {
							jQuery(this).removeData('bs.modal');
							jQuery(this).find('.datosTiendas').empty();
						})
						 // insertamos el descuento en la etiqueta p
						 $("#descuentoCliente").val(clientes[0].descuentoCliente);
						 $("#descuentoClienteD").val(clientes[0].descuentoCliente);
						 $("#totalDescuento").html(clientes[0].descuentoCliente);
					 
							break;
					    case 1:
							for(let x of Object.keys(clientes)) {
								var CliOne = '';
								var unDato = clientes[x];
								CliOne += "<table class='table'><thead><tr><th>Cliente</th><th>Estado</th><th>Municipio</th><th>Calle</th></tr></thead>";
								CliOne += '<tr><td>' + unDato.nombreCliente + '</td><td>' + unDato.estado + '</td><td>' + unDato.municipio + '</td><td>' + unDato.calleDomicilioCliente + '</td>';
								CliOne += '</table>';	
								$("#showInfoCliente").html(CliOne);
								$('#circuloCliente').html('');
								$("#idClientesXtienda").val(numeroCliente);
								// LIMPIO EL INPUT PARA EVITAR QUE SE USE DE NUEVO DE SER NECESARIO
								limpiarInput('numeroCliente');
								// asignamos el descuento a el input de descuento
								$("#descuentoCliente").val(unDato.descuentoCliente);
						 		$("#descuentoClienteD").val(unDato.descuentoCliente);
								 $("#totalDescuento").html(clientes[0].descuentoCliente);
							}
							break;
						default:
							Swal.fire(
								'ERROR',
								'NO SE ENCONTRARON DOMICILIOS RELACIONADOS CON ESTE ID, PRESIONA F2 PARA BUSCAR',
								'error'
							  )
							break;
					}
				}
			});
		}


	})

	$("#modalTblProductos").on("click",function(e){
		e.preventDefault();
		let almacen = $("#selectAlmacenVenta").val();
		if(almacen == 0){
			alert("seleccione un almacen");
		}else{
			let idAlmacen = new FormData();
				idAlmacen.append('almacenFindProduct', almacen);
			$.ajax({
				url: getAbsolutePath() + "views/layout/ajax.php",
				method: "POST",
				data: idAlmacen,
				cache: false,
				contentType: false,
				processData: false,
				success: function (productoAlmacen) {
					tablasProductos(productoAlmacen,'productosAlmacenLotes');
					$('#TablaDatosLotes').modal({backdrop: 'static', keyboard: false});
				}
			})
		}
	});

	$("#selectAlmacenVenta").on("change",function(){
		var dato = $(this).val();
		if(dato != ""){
			$("#prodNewForm").removeClass("evento");
		}else{
			$("#prodNewForm").addClass("evento");
		}
	})

	$("#inputPiezaVenta").on('change',function(e){
		var valor = $(this).val();
		var lote = $("#inputLoteVenta").val();
		var valValor = Array({'phone_inputPiezaVenta_10':valor,"phone_inputLoteVenta_15":lote});
		var validar = validarCampos(valValor);
		if(validar>0){
			e.preventDefault();
		}else{
			let dato = {"data":valValor}
			var json =JSON.stringify(dato);
			$.ajax({
				url: getAbsolutePath() + "views/layout/ajax.php",
				method: "POST",
				data: { "catidadPz": json },
				cache: false,
				beforeSend: function () {
				},
				success: function (piezas) {
					if(piezas[0].id == 1){
						document.getElementById("inputPiezaVenta").focus();
							Swal.fire({
								position: 'center',
								icon: 'warning',
								title: 'NO TIENES ESTA CANTIDAD DE PRODUCTOS EN STOCK',
								showConfirmButton: false,
								timer: 1500
							});
							$("#inputPiezaVenta").val("");
					}
/* 					switch (piezas[0].id) {
						case "0":
							
							break;
						case 1:
							document.getElementById("inputPiezaVenta").focus();
							Swal.fire({
								position: 'center',
								icon: 'warning',
								title: 'NO TIENES ESTA CANTIDAD DE PRODUCTOS EN STOCK',
								showConfirmButton: false,
								timer: 1500
							});
							$("#inputPiezaVenta").val("");
							break;
						case 2:
							//$("#inputPesoVenta").val(piezas[0].sumaPeso);
							break;
						default:
							break;
					} */
				}
			});
		}

	})
	$("#inputCodigoVenta").on("change",function(e){
		let valor = $(this).val();
		let camara = $("#selectAlmacenVenta").val()
		let producto = Array();
		producto.push({ 'phone_inputCodigoVenta_10': valor, 'phone_selectAlmacenVenta_4':camara });
		var validar = validarCampos(producto);
		if (validar > 0) {
			e.preventDefault();
			$("#selectAlmacenVenta").val('');
			$("#inputCodigoVenta").val($("#inputCodigoVenta").data("default-value"));
		}else{
			let data = { "data": producto }
				var json = JSON.stringify(data);
			$.ajax({
				url: getAbsolutePath() + "views/layout/ajax.php",
				method: "POST",
				data: { "loteAlamcen": json },
				cache: false,
				beforeSend: function () {
				},
				success: function (verifLote) {
					let keyOBJ = Object.keys(verifLote).length
					if(keyOBJ == 1){
						let keyss = verifLote[0];
						 /* $("#inputCodigoVenta").val(unDato.id); */
						 $("#inputNombreProdVenta").val(keyss.nombre);
						 $("#inputLoteVenta").val(keyss.lote);
						 $("#inputPrecioVenta").val(keyss.precioUnitario);
						 sessionStorage.clear();
						 focusInput('inputPiezaVenta')
					}else{
						let tblLotesPRoducto = '';
						tblLotesPRoducto += "<table class='table'><thead><tr><th>idProducto</th><th>Nombre</th><th>Precio</th><th>Lote</th><th>Peso</th><th>Piezas</th></tr></thead>";
						for(let x of Object.keys(verifLote)) {
							var unDato = verifLote[x];
							tblLotesPRoducto += '<tr><td>' + unDato.id + '</td><td>' + unDato.nombre + '</td><td>' + unDato.precioUnitario + '</td><td>' + unDato.lote + '</td><td>' + unDato.sumaPeso + '</td><td>'+unDato.sumapz+'</td><td><button type="button" id="'+unDato.lote+'" class="btn btn-primary btn-lg seleccionarIdProductoXLote">Seleccionar</button></td>';	
							sessionStorage.setItem('LOTE_'+unDato.lote,JSON.stringify(unDato));
						}
						tblLotesPRoducto += '</table>';	
						$("#lotesExistentes").html(tblLotesPRoducto);
						$('#TablaDatosLotes').modal('hide');
						$("#modalLotesExistentes").modal({backdrop: 'static', keyboard: false});
					}
					
				}
			});
		}

	});
	/*  calculamos el total multiplicando el precio por el peso */
	$("#inputPesoVenta").on("change", function () {
		/* alert("hola") */
		let peso = $(this).val();
		let precio = $("#inputPrecioVenta").val();
		let Multiplicacion = multi(peso, precio);
		$("#inputSubtotalVenta").val(Multiplicacion);
	});

	$('#rutaPedido select').on('click', 'option', function(e) {
        console.log(this.value, 'Yeah');
        // this refers to the option so you can do this.value if you need..
    });
	
	// verificar si existe un id
	$("#idCliente").on('change', function(){
		var idcli = $(this).val();
		var cliente = new FormData();
		cliente.append('idCliente',idcli);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data:cliente,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				$('#circuloCliente').html('<i class="fas fa-sync fa-spin"></i>');
			},
			success: function (clientesFind) {
				console.log(clientesFind);
				if(clientesFind == 1){
					$(".idCliente").css("color","red");
					$(".idCliente").html("YA EXISTE ESTE ID");
					$("#idCliente").css("border","1px solid red");
				}else{
					$(".idCliente").css("color","green");
					$(".idCliente").html("");
					$("#idCliente").css("border","1px solid green");
				}
			}
		});
	})

	$("#modalContactocliente").on("click",function(){
		var idContacto=$(this).attr('data-id')
		$("#Cliente_Add").modal('show');
		$("#customerModal").val(idContacto);
	})
	
});


$(document).on('click','.deleteOnclick',function(){
	let totalCompra = 0;
	let procentaje = $("#descuentoCliente").val();
	$("#registroProductoVenta tr").each(function(){
		totalCompra +=parseFloat($(this).find('td').eq(6).html());
	}) 
	$("#totalVenta").html(totalCompra.toFixed(2));
	totalCompleto = porcentaje(procentaje,totalCompra);
	$("#totalHiden").val(totalCompleto);
	$("#total").html(totalCompleto);
})
$(document).on('click','.seleccionarIdProducto',function(){
    let idPro = $(this).attr('data-id');
	sessionStorage.clear();
    let id_producto = new FormatData();
	id_producto.append('idProductoAlamcen',idPro)
    $.ajax({
		url: getAbsolutePath() + "views/layout/ajax.php",
		method: "POST",
		data: id_producto,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () {
			$('#circuloCliente').html('<i class="fas fa-sync fa-spin"></i>');
		},
		success: function (clientesFind) {
			alert(clientesFind);
		}
	});
})

 // verifica e inserta los datos en el textarea si el usuario es encontrado
 $(document).on('click','.findCliente', function(e){
	e.preventDefault();
	let btnId = $(this).attr('id');

	let clienteIdFind = new FormData();
		clienteIdFind.append('idClienteFind', btnId);

		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: clienteIdFind,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				$('#circuloCliente').html('<i class="fas fa-sync fa-spin"></i>');
			},
			success: function (clientesFind) {
				let countCliente = Object.keys(clientesFind).length;
				switch (countCliente) {
					case 1:
						for(let x of Object.keys(clientesFind)) {
							var CliOne = '';
							var unDato = clientesFind[x];
							CliOne += "<table class='table'><thead><tr><th>Cliente</th><th>Estado</th><th>Municipio</th><th>Calle</th></tr></thead>";
							CliOne += '<tr><td>' + unDato.nombreCliente + '</td><td>' + unDato.estado + '</td><td>' + unDato.municipio + '</td><td>' + unDato.calleDomicilioCliente + '</td>';
							CliOne += '</table>';	
							$("#showInfoCliente").html(CliOne);
						}
						$('#circuloCliente').html('');
						$("#idClientesXtienda").val(btnId);
						// LIMPIO EL INPUT PARA EVITAR QUE SE USE DE NUEVO DE SER NECESARIO
						limpiarInput('numeroCliente');
						// asignamos el descuento a el input de descuento
						$("#descuentoCliente").val(clientesFind[0].descuentoCliente);
						$("#descuentoClienteD").val(clientesFind[0].descuentoCliente);
						$("#totalDescuento").html(clientesFind[0].descuentoCliente);
						break;
					case 2:
					case 3:
						//CREAMOS LA TABLA CON LA SIGUIENTE FUNCION
						tablasClientes(clientesFind,'datosTiendas');
						// TOMAMOS EL NOMBRE DEL CLIENTE
						$("#NomClienteTitulo").html(clientesFind[0].nombreCliente);
						// GENERAMOS EL MODAL 
						$('#TablaDatosClientes').modal({backdrop: 'static', keyboard: false});
						$('#circuloCliente').html('');
						$("#idClientesXtienda").val(btnId);
						// LIMPIO EL INPUT PARA EVITAR QUE SE USE DE NUEVO DE SER NECESARIO
						limpiarInput('numeroCliente');
						// LIMPIMOS EL MODAL
						jQuery('#TablaDatosClientes').on('hidden.bs.modal', function (e) {
							jQuery(this).removeData('bs.modal');
							jQuery(this).find('.datosTiendas').empty();
						})
						$('#circuloCliente').html('');

						// asignamos el descuento a el input de descuento
						$("#descuentoCliente").val(clientesFind[0].descuentoCliente);
						$("#descuentoClienteD").val(clientesFind[0].descuentoCliente);
						$("#totalDescuento").html(clientes[0].descuentoCliente);
						break
					default:
						Swal.fire(
							'ERROR',
							'NO HAY DOMICILIOS AGREGADOS CON ESTE CLIENTE, REPORTALO CON TU SUPERIOR',
							'error'
						  );
						  $('#circuloCliente').html('');
						break;
				}
			}
		});
});

$(document).on('click','.seleccionarIdProductoXAlmacen', function(e){
	let idPRoducto = $(this).attr('id');
	let almacen = $("#selectAlmacenVenta").val();
	let consultaPRoducto = Array();

	consultaPRoducto.push({'phone_inputCodigoVenta_10':idPRoducto,'phone_selectAlmacenVenta_4':almacen});
	
	var validar = validarCampos(consultaPRoducto);

	if (validar > 0) {
		e.preventDefault();
	}else{
		let data = { "data": consultaPRoducto }
		var json = JSON.stringify(data);
		$.ajax({
			url: getAbsolutePath() + "views/layout/ajax.php",
			method: "POST",
			data: { "loteAlamcen": json },
			cache: false,
			beforeSend: function () {
			},
			success: function (verifLote) {				
				let keyOBJ = Object.keys(verifLote).length
				if(keyOBJ == 1){
					$("#inputCodigoVenta").val(verifLote[0].id)
					$("#inputNombreProdVenta").val(verifLote[0].nombre)
					$("#inputLoteVenta").val(verifLote[0].lote)
					$("#inputPrecioVenta").val(verifLote[0].precioUnitario)
					$('#TablaDatosLotes').modal('hide');
				}else{
					let tblLotesPRoducto = '';
					tblLotesPRoducto += "<table class='table'><thead><tr><th>idProducto</th><th>Nombre</th><th>Precio</th><th>Lote</th><th>Peso</th><th>Piezas</th></tr></thead>";
					for(let x of Object.keys(verifLote)) {
						var unDato = verifLote[x];
						tblLotesPRoducto += '<tr><td>' + unDato.id + '</td><td>' + unDato.nombre + '</td><td>' + unDato.precioUnitario + '</td><td>' + unDato.lote + '</td><td>' + unDato.sumaPeso + '</td><td>'+unDato.sumapz+'</td><td><button type="button" id="'+unDato.lote+'" class="btn btn-primary btn-lg seleccionarIdProductoXLote">Seleccionar</button></td>';	
						sessionStorage.setItem('LOTE_'+unDato.lote,JSON.stringify(unDato));
					}
					tblLotesPRoducto += '</table>';	
					$("#lotesExistentes").html(tblLotesPRoducto);
					$('#TablaDatosLotes').modal('hide');
					$("#modalLotesExistentes").modal({backdrop: 'static', keyboard: false});
				}
				
			}
		});
	}
})




