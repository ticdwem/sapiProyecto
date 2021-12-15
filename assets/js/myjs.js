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
	/* datatavles  */
	$(".tablaGenerica").DataTable({
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": false,
		"info": true,
		"autoWidth": true
	});
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


		if (emailContactoCustomer == "empty") { emailContactoCustomer = "empty@empty.com" }
		if (telSecCustomer === "empty") { telSecCustomer = '500' }

		registro.push({ "nombre_nameContactoCustomer_80": nameContactoCustomer, "phone_telPrCustomer_12": telPrCustomer, "email_emailContactoCustomer_100": emailContactoCustomer, "phone_telSecCustomer_12": telSecCustomer })

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
					}
				}
			});
			$("#nameContactoCustomer").val('');
			$("#emailContactoCustomer").val('');
			$("#telPrCustomer").val('');
			$("#telSecCustomer").val('');
		}
	});

	$("#btn-AgregarDomicilio").on('click', function () {
		let domicilio = Array();
		let streetCustomer = emptyInput($("#streetCustomer").val());
		let numeroCustomer = emptyInput($("#numeroCustomer").val());
		let inputEstado = emptyInput($("#inputEstado").val());
		let inpuMunicipio = emptyInput($("#inpuMunicipio").val());
		let coloniaCustomer = emptyInput($("#coloniaCustomer").val());
		let cpCustomer = emptyInput($("#cpCustomer").val());
		let RutaCustomer = emptyInput($("#RutaCustomer").val());


		if (numeroCustomer == "empty") { numeroCustomer = '0' }


		domicilio.push({ "nombre_streetCustomer_50": streetCustomer, "phone_numeroCustomer_5": numeroCustomer, "phone_inputEstado_5": inputEstado, "phone_inpuMunicipio_5": inpuMunicipio, "nombre_coloniaCustomer_50": coloniaCustomer, "phone_cpCustomer_5": cpCustomer, "phone_RutaCustomer_5": RutaCustomer });

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
					$('.spinnerDomicilio').html('');
					if (setDomicilio > 3) {
						$('#mensajeDomicilio').html('<div class="alert alert-danger" role="alert">No se puede agregar mas contactos a esta Cliente</div>');
					} else {
						$('#mensajeDomicilio').html('<div class="alert alert-success" role="alert">Se agrego correctamente ' + setDomicilio + ' ITEMS</div>');
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
				$("#inputTelSecundarioEdit").val(contacto.telefonoScundario);
				$("#inputEmailEdit").val(contacto.correoContacto);
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

	// buscamos los datos del cliente 
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
				success: function (cliente) {
					let countCliente = Object.keys(cliente).length;
					if(countCliente>1){
						
						$("#NomClienteTitulo").html(cliente[0].nombreCliente)
						let contador = 2;
						let ContadorSecundario=1;
						$('#TablaDatosClientes').modal('toggle');

						// creamos la tabla
						let table = document.createElement('table');
						table.classList.add('table');
						table.classList.add('table-hover');
						table.classList.add('tblDatosCliente');
						let thead = document.createElement('thead');
						let tbody = document.createElement('tbody');

						table.appendChild(thead);
						table.appendChild(tbody);

						// Agregar la tabla completa a la etiqueta del cuerpo
						document.getElementById('datosTiendas').appendChild(table);

						// Crear y agregar datos a la primera fila de la tabla este es el encabezado
						let row_1 = document.createElement('tr');
						let heading_1 = document.createElement('th');
						heading_1.innerHTML = "ESTADO";
						let heading_2 = document.createElement('th');
						heading_2.innerHTML = "MUNICIPIO";
						let heading_3 = document.createElement('th');
						heading_3.innerHTML = "COLINIA";
						let heading_4 = document.createElement('th');
						heading_4.innerHTML = "CALLE";

						row_1.appendChild(heading_1);
						row_1.appendChild(heading_2);
						row_1.appendChild(heading_3);
						row_1.appendChild(heading_4);
						thead.appendChild(row_1);
						// iteramos en cada uno de los datos que tiene json y hacemos la tabla
						for(let x of Object.keys(cliente)) {
							var capital = cliente[x];
							let titulo = "row_"+contador;
							let titulofila1 = "row_"+contador+"_data_"+ContadorSecundario;
							let titulofila2 = "row_"+(contador+1)+"_data_"+ContadorSecundario;
							let titulofila3 = "row_"+(contador+2)+"_data_"+ContadorSecundario;
							let titulofila4 = "row_"+(contador+3)+"_data_"+ContadorSecundario;

							console.log(x,capital.calleDomicilioCliente);
							

														// Creating and adding data to second row of the table
							titulo= document.createElement('tr');
							titulofila1 = document.createElement('td');
							titulofila1.innerHTML = capital.estado;
							titulofila2 = document.createElement('td');
							titulofila2.innerHTML = capital.municipio;
							titulofila3 = document.createElement('td');
							titulofila3.innerHTML = capital.calleDomicilioCliente;
							titulofila4 = document.createElement('td');
							titulofila4.innerHTML = '<button type="button" id="porLoMientras" class="btn btn-primary btn-lg">Seleccionar</button>';

							titulo.appendChild(titulofila1);
							titulo.appendChild(titulofila2);
							titulo.appendChild(titulofila3);
							titulo.appendChild(titulofila4);
							tbody.appendChild(titulo);

							contador++;
							ContadorSecundario++;

						}

					}else{
						alert("solo es uno");
					}
				}
			});
			/* $("#streetCustomer").val('')
			$("#numeroCustomer").val('')
			$("#inputEstado").val('')
			$("#inpuMunicipio").val('')
			$("#coloniaCustomer").val('')
			$("#cpCustomer").val('')
			$("#RutaCustomer").val('') */
		}


	})
});