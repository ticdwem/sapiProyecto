<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
    }
    ?>
</div>
<div class="">
    <div class="row">
        <div class="col-lg-12">
            <?php require_once 'views/layout/breadcrup.php';?>
            <form id="frmidTtraspaso">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group col-md-6 col-lg-6">
                                    <select class="form-control form-control-lg" id="selectAlmacen">
                                        <option value="-1" selected>Selecciona un Anden</option>
                                        <?php while ($anden = $andenes->fetch_object()):?>
                                            <option value="<?=$anden->idAlmacen?>"><?=$anden->nombreAlmacen?></option>
                                            <?php endwhile;?>
                                        </select>
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <select class="form-control form-control-lg" id="DataAlmacenes">
                                        <option selected>Anden Destino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <form class="form-inline">
                            <div class="form-group mb-2">
                                <label for="textProducto" class="sr-only">Ingresa id de producto</label>
                                <input type="text" readonly class="form-control-plaintext" id="textProducto" value="Ingresa id de producto">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputIdProducto" class="sr-only">IdProducto</label>
                                <input type="text" class="form-control" id="inputIdProducto" placeholder="IdProducto">
                            </div>
                           
                            </form>
                        </div>
                    </div>
                </div><!-- FIN DEL CARD -->
            </form>

            <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Lote</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody id="tblTraspasoProducto">
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalProductoTraspaso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="modalEditProductLabel">Editar Piezas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div class="modal-body">
          <input type="hidden" id="hiddenPesoTotalTraspaso" value="">
          <input type="hidden" id="hiddenPiezastotalTraspaso" value="">
        <div class="container">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="idProductoTraspaso">Id</label>
                    <input type="text" class="form-control idProductoTraspaso" id="idProductoTraspasoModal" value="" disabled>
                    <div class="idProductoTraspaso"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombreProdcutoTraspaso">Nombre </label>
                    <input type="text" class="form-control nombreProdcutoTraspaso" id="nombreProdcutoTraspasoModal" value="" disabled>
                    <div class="nombreProdcutoTraspaso"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="loteVentaTraspaso">Lote</label>
                    <input type="text" class="form-control loteVentaTraspaso" id="loteVentaTraspasoModal" value="" disabled>
                    <div class="loteVentaTraspaso"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="pesoTraspaso">Peso </label>
                    <input type="text" class="form-control pesoTraspaso" id="pesoTraspasoModal" value="">
                    <div class="pesoTraspaso"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="piezasVentaTraspaso">Piezas</label>
                    <input type="text" class="form-control piezasVentaTraspaso" id="piezasVentaTraspasoModal" value="">
                    <div class="piezasVentaTraspaso"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
        <button type="button" class="btn btn-primary" id="traspasoAceptar">Aceptar</button>
      </div>
      <div id="message"></div>
    </div>
  </div>
</div>

<script>
    $("#selectAlmacen").on("change",function(){
        let idSelect = $(this).val();
		var validar = expRegular("phone", idSelect);

        if (validar != 0) {
            $("#DataAlmacenes").empty();
			var almacen = new FormData();
			almacen.append("almacenData", idSelect);
			$.ajax({
				url: getAbsolutePath() + "views/layout/ajax/ajaxQueryAlmacen.php",
				method: "POST",
				data: almacen,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
				},
				success: function (queryAlmacen) {
                   for (let i in queryAlmacen) {
                       $("#DataAlmacenes").append('<option value="' + queryAlmacen[i].id + '">' + queryAlmacen[i].name + '</option>');
                   }
				}
			})
		}
    })

        $("#inputIdProducto").keyup(function(e){         
            let producto = $(this).val();
            let almacen = $("#selectAlmacen").val();
            let productoArray = Array();
            let validar;
            $('#tblTraspasoProducto').empty()
            if(almacen == -1){
                Swal.fire({
                    icon: 'error',
                    title: 'ANDEN',
                    text: 'DEBES SELECCIONAR UN ANDEN '
                });
                $("#inputIdProducto").val("");
                e.preventDefault();
            }else{
                productoArray.push({'phone_selectAlmacen_10':almacen,'messagge_inputIdProducto_80':producto});
                validar = validarCampos(productoArray);
                if(validar > 0){
                    e.preventDefault();
                }else{
                    let data = { "data": productoArray }
                    var json = JSON.stringify(data);
                    $.ajax({
                        url: getAbsolutePath() + "views/layout/ajax/AjaxSearchProducto.php",
                        method: "POST",
                        data: { "productoAlmacen": json },
                        cache: false,
                        beforeSend: function () {
                        
                        },
                        success: function (searchprd) {
                            let encontrado = Object.keys(searchprd).length;
                            if(encontrado > 0){
                                var contador = 1;
                                for(let x of Object.keys(searchprd)){
                                    let datoProducto = searchprd[x];
                                    var contenido = '<tr>';
                                        contenido += '<td>'+datoProducto.id+'</td>';
                                        contenido += '<td>'+datoProducto.nombreProducto+'</td>';
                                        contenido += '<td>'+datoProducto.loteACentral+'</td>';
                                        contenido += '<td>'+datoProducto.cantidadPzACentral+'</td>';
                                        contenido += '<td><button type="button" data-id="'+datoProducto.pesoACentral+'" class="btn btn-primary btnselectidProducto">Traspasar</button></td>';
                                        contenido += '</tr>';
                                        contador ++;
                                    $('#tblTraspasoProducto').append(contenido);
                                } 
                            }  
                        }
                    })
                
                }
            }
        })

    $("#traspasoAceptar").on('click',function(e){
        let errordatos = 0;
        let traspasoArray = Array();
        let selectAlmacen = parseInt($("#selectAlmacen").val());
        let DataAlmacenes = parseInt($("#DataAlmacenes").val());
        let idProdcuto = $("#idProductoTraspasoModal").val();
        let loteVentaTraspasoModal = $("#loteVentaTraspasoModal").val();
        let pesoTraspasoModal = parseFloat($("#pesoTraspasoModal").val());
        let piezasVentaTraspasoModal =parseInt($("#piezasVentaTraspasoModal").val());
        let hiddenPesoTotalTraspaso = parseFloat($("#hiddenPesoTotalTraspaso").val());
        let hiddenPiezastotalTraspaso = parseInt($("#hiddenPiezastotalTraspaso").val());

        traspasoArray.push({'phone_idProdcuto_10':idProdcuto,
                            'phone_loteVentaTraspasoModal_20':loteVentaTraspasoModal,
                            "decimales_pesoTraspasoModal_10":pesoTraspasoModal,
                            "phone_piezasVentaTraspasoModal_10":piezasVentaTraspasoModal,
                            "phone_selectAlmacen_20":selectAlmacen,
                            "phone_DataAlmacenes_20":DataAlmacenes,});
        validar = validarCampos(traspasoArray);
        if(validar > 0){
            alert("hay problemas");
        }else{
            if(pesoTraspasoModal > hiddenPesoTotalTraspaso){
                $("#pesoTraspasoModal").css('border','1px solid red');
                $(".pesoTraspaso").css({"color":"red", "font-size":"12px"});
                $(".pesoTraspaso").html("INSERTASTE UN PESO MAYOR AL REGISTRADO EN LA BASE DE DATOS");
               errordatos++;
            }else{
                $("#pesoTraspasoModal").css('border','1px solid green');
                $(".pesoTraspaso").css({"color":"green", "font-size":"12px"});
                $(".pesoTraspaso").html("correcto");
            }
            if(piezasVentaTraspasoModal > hiddenPiezastotalTraspaso){
                $("#piezasVentaTraspasoModal").css('border','1px solid red');
                $(".piezasVentaTraspaso").css({"color":"red", "font-size":"12px"});
                $(".piezasVentaTraspaso").html("NO HAY SUFICIENTE PIEZAS EN LA BASE DE DATOS");
                errordatos++
            }else{
                $("#piezasVentaTraspasoModal").css('border','1px solid green');
                $(".piezasVentaTraspaso").css({"color":"green", "font-size":"12px"});
                $(".piezasVentaTraspaso").html("correcto");
            }
/* ############################################################################################################################################### */
              if(errordatos>0){
                  return
              }else{
                let data = { "data": traspasoArray }
                var json = JSON.stringify(data);
                $.ajax({
                    url: getAbsolutePath() + "views/layout/ajax/AjaxTraspaso.php",
                    method: "POST",
                    data: { "traspasoAlmacen": json },
                    cache: false,
                    beforeSend: function () {
                    
                    },
                    success: function (traspasoWherhouse) {
                        if(traspasoWherhouse == 1){
                            alert('traspaso correcto');
                        }else{
                            alert('no se realizo clgun traspaso');
                        }
                    }
                })
/* ############################################################################################################################################### */
            }
        }

    });



</script>