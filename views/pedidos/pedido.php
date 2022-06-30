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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
                </ol>
            </nav>
            <div class="container" id="">
            <div id="nota" class="col-lg-12 col-md-12 col-sm-12 nota">
                    <div class="row">
                        <div id="" class="col-lg-6 col-md-6 col-sm-12">
                            <label for="numNota">Num Nota</label>
                            <input type="text" class="form-control" id="numNota" name="numNota" aria-describedby="id" placeholder="Numero de nota" value="<?=Utls::createNotaId();?>" readonly>
                            <small id="numNota" class="form-text text-muted"></small>
                        </div>
                        <div id="EmptyRow" class="col-lg-6 col-md-6 col-sm-12 EmptyRow">
                            
                        </div>
                    </div> 
                </div>
                <div id="datosDom" class="col-lg-12 col-md-12 col-sm-12 datosDom">
                    <div class="row">
                        <div id="idCliente" class="col-lg-4 col-md-4 col-sm-12 idCliente">
                            <label for="inputIdCliente">Id Cliente</label>
                            <input type="text" class="form-control" id="inputIdCliente" name="inputIdCliente" aria-describedby="id" placeholder="icCliente" value="<?=$datos->id?>" readonly>
                            <small id="inputIdCliente" class="form-text text-muted"></small>
                        </div>
                        <div id="nombre" class="col-lg-4 col-md-4 col-sm-12 nombre">
                            <label for="inputNombreCliente">Nombre</label>
                            <input type="text" class="form-control" id="inputNombreCliente" name="inputNombreCliente" aria-describedby="nombreCliente" placeholder="Nombre Cliente" value="<?=$datos->nombre?>" readonly>
                            <small id="inputNombreCliente" class="form-text text-muted"></small>
                        </div>
                        <div id="detalle" class="col-lg-4 col-md-4 col-sm-12 p-4 detalle">
                            <button type="button" id="btnIdModalDomicilio"  class="btn btn-primary btn-lg btn-block">DETALLE</button>
                        </div>
                    </div> 
                </div>
                <div id="datoContacto" class="col-lg-12 col-md-12 col-sm-12 datoContacto">
                    <div class="row">
                        <div id="telPrin" class="col-lg-4 col-md-4 col-sm-12 telPrin">
                            <label for="telefonoPricnipal">Telefono Principal</label>
                            <input type="text" class="form-control" id="telefonoPricnipal" name="telefonoPricnipal" aria-describedby="telPrin" placeholder="Telefono Principal" value="<?=$datos->telPrinContactoCliente?>" readonly>
                            <small id="telefonoPricnipal" class="form-text text-muted"></small>
                        </div>
                        <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                            <label for="TelSecundario">Telefono Secundario</label>
                            <input type="text" class="form-control" id="TelSecundario" name="TelSecundario" aria-describedby="telSec" placeholder="Telefono Secundario" value="<?php if($datos->telSecundario == 500){echo "Sin Datos";}else{$datos->telSecundario;} ?>" readonly>
                            <small id="TelSecundario" class="form-text text-muted"></small>
                        </div>
                        <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                            <label for="rutaCliente">Ruta</label>
                            <input type="text" class="form-control" id="rutaCliente" name="rutaCliente" aria-describedby="ruta" placeholder="ruta" value="<?=$datos->nomRuta?>" readonly>
                            <small id="rutaCliente" class="form-text text-muted"></small>
                        </div>
                    </div> 
                </div>
                <hr>
                <form id="frmPedido">
                    <div class="row " id="prodNewForm">
                        <div class="col-lg-2">
                            <label class="mr-sm-2" for="inputCodigoPedido">Código Producto</label>
                            <div class="input-group">
                                <input type="text" name="inputCodigoPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputCodigoPedido" autocomplete="off">
                            </div>
                            <div class="inputCodigoPedido"></div>
                        </div>
                        <div class="col-lg-6">
                            <label class="mr-sm-4" for="inputNombreProdPedido">Nombre</label>
                            <div class="input-group">
                                <input type="text" name="inputNombreProdPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputNombreProdPedido" readonly autocomplete="off">
                            </div>
                            <div class="inputNombreProdPedido"></div>
                        </div>
                        <div class="col-lg-2">
                            <label class="mr-sm-2" for="inputPresentacionPedido">Presentación</label>
                            <div class="input-group">
                            <input type="text" name="inputPresentacionPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPresentacionPedido" readonly autocomplete="off">
                            </div>
                            <div class="inputPresentacionPedido"></div>
                        </div>
                        <div class="col-lg-2">
                            <label class="mr-sm-2" for="inputPiezasPedido">Piezas</label>
                            <div class="input-group">
                                <input type="text" name="inputPiezasPedido" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPiezasPedido" autocomplete="off">
                            </div>
                            <div class="inputPiezasPedido"></div>
                        </div>
                    
                    </div>
                    <div class="row col-lg-12 mt-4">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <button type="submit" class="btn btn-success" id="enterProducto" name="btn-acepta">Aceptar</button>
                            <button type="button" class="btn btn-warning" id="btnFindProduct">Buscar</button>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="row">  
                            <label for="exampleFormControlFile1">Ingrese Fecha de entrega</label>  
                            <input class="datepicker" data-date-format="dd/mm/yyyy" id="dateIdPedido" autocomplete="off" readonly>
                        </div>
                        </div>
                    </div>
                </form>
            </div>                      
        </div>        
    </div>
    <div id="cajaPedido" class="col-lg-12 m-t-5">
           <table class="table table-striped" id="registroProductotablePedido">
                <thead>
                    <tr>
                        <th scope="col">Id Producto</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Presentacion</th>
                        <th scope="col">Piezas</th>
                    </tr>
                </thead>
                 <!-- <tbody id="registroProductoPedido">
                                                
                </tbody>-->
                <tbody id="registroProductoPedido">                                                    
                </tbody>
            </table> 
        </div>
        <div id="divBtnPedidoAceptar">
            <button type="button" class="btn btn-success" id="btnPedidoAceptar">HACER PEDIDO</button>
        </div>
        <div class="alertaInsert col-md-12 col-sm-12 mt-3 mb-3" id="alertaInsert"></div>
</div>

<!-- modal de las editar Pedido  -->
<div class="modal fade bd-example-modal-lg" id="editProductoPedido" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar pedido</h5>
            <input type="hidden" id="idhiddeneditproduct" value="">

        </div>
        <div class="modal-body">
            <div class="editProducto">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputIdProdcuto">IdProducto</label>
                        <input type="text" class="form-control inputIdProdcuto" id="inputIdProdcuto" placeholder="id Producto" disabled>
                        <div class="inputIdProdcuto"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNombreProducto">Nombre</label>
                        <input type="text" class="form-control inputNombreProducto" id="inputNombreProducto" placeholder="Nombre Producto" disabled>
                        <div class="inputNombreProducto"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPresentacionEditar">Presentacion</label>
                        <input type="text" class="form-control inputPresentacionEditar" id="inputPresentacionEditar" placeholder="Presentacion Producto" disabled>
                        <div class="inputPresentacionEditar"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPiezasEditar">Piezas</label>
                        <input type="text" class="form-control inputPiezasEditar" id="inputPiezasEditar" placeholder="Nombre Producto">
                        <div class="inputPiezasEditar"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-12 mt-4">
                        <button type="button" class="btn btn-success" id="idEditarPzProdcuto">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- modal de las lista de los productos  -->
<div class="modal fade bd-example-modal-lg" id="ListPRod" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">LISTA DE PRODUCTOS</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="table">
                <table class="table table-hover table-striped tablaGenerica" id="table">
                    <thead>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Presentación</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        <?php while($producto = $prod->fetch_object() ): ?>
                        <tr>                            
                            <td><?=$producto->idProducto?></td>
                            <td><?=$producto->nombreProducto?></td>
                            <td><?=$producto->presentacionProducto?></td>
                            <td><button type="button" class="btn btn-success selectPRoductPEdido" id="<?=$producto->idProducto?>">Seleccionar</button></td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- modal -->
<div class="modal fade bd-example-modal-lg" id="modalDomicilio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="datoContacto" class="col-lg-12 col-md-12 col-sm-12 datoContacto">
            <div class="row">
                <div id="domContacto1" class="col-lg-4 col-md-4 col-sm-12 domContacto1">
                    <label for="calleCliente">Calle</label>
                    <input type="text" class="form-control" id="calleCliente" name="calleCliente" aria-describedby="telPrin" placeholder="calle Domicilio" value="<?=$dom->calleDomicilioCliente?>" readonly>
                    <small id="calleCliente" class="form-text text-muted"></small>
                </div>
                <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                    <label for="numeroDomicilio">Número</label>
                    <input type="text" class="form-control" id="numeroDomicilio" name="numeroDomicilio" aria-describedby="telSec" placeholder="Telefono Secundario" value="<?=$dom->numeroDomicilioCliente?>" readonly>
                    <small id="numeroDomicilio" class="form-text text-muted"></small>
                </div>
                <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                    <label for="cpDomicilio">CP</label>
                    <input type="text" class="form-control" id="cpDomicilio" name="cpDomicilio" aria-describedby="ruta" placeholder="ruta" value="<?=$dom->cpDomicilioCliente?>" readonly>
                    <small id="cpDomicilio" class="form-text text-muted"></small>
                </div>
            </div> 
        </div>
        <divss id="datoContacto" class="col-lg-12 col-md-12 col-sm-12 datoContacto">
            <div class="row">
                <div id="telPrin" class="col-lg-4 col-md-4 col-sm-12 telPrin">
                    <label for="estadoDomicilio">Estado</label>
                    <input type="text" class="form-control" id="estadoDomicilio" name="estadoDomicilio" aria-describedby="telPrin" placeholder="Telefono Principal" value="<?=$dom->estado?>" readonly>
                    <small id="estadoDomicilio" class="form-text text-muted"></small>
                </div>
                <div id="telSec" class="col-lg-4 col-md-4 col-sm-12 telSec">
                    <label for="minicipioDomicilio">Municipio</label>
                    <input type="text" class="form-control" id="minicipioDomicilio" name="minicipioDomicilio" aria-describedby="telSec" placeholder="Telefono Secundario" value="<?= $dom->municipio; ?>" readonly>
                    <small id="minicipioDomicilio" class="form-text text-muted"></small>
                </div>
                <div id="ruta" class="col-lg-4 col-md-4 col-sm-12 ruta">
                    <label for="coloDimiicxiio">Colonia</label>
                    <input type="text" class="form-control" id="coloDimiicxiio" name="coloDimiicxiio" aria-describedby="ruta" placeholder="ruta" value="<?=$dom->coloniaDomicilioCliente?>" readonly>
                    <small id="coloDimiicxiio" class="form-text text-muted"></small>
                </div>
            </div> 
        </divss>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script> 

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

$(document).ready(function(){

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
    }).val(sumarDias(1))
    $("#inputCodigoPedido").on('change',function(){
        let codigo = $(this).val();

        var validarCodugo = expRegular("phone", codigo);
        if (validarCodugo != 0) {
            var verifProd = new FormData();
			verifProd.append("producto", codigo);
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
                    if(datos != "0"){

                        $("#inputNombreProdPedido").val(datos.descripcionProd);
                        $("#inputPresentacionPedido").val(datos.presentacion);
                        
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
            
            validar.push({"phone_inputCodigoPedido_6":inputCodigo,"nombre_inputNombreProdPedido_80":inputNombreProd,"nombre_inputPresentacionPedido_80":inputPresentacion,"decimales_inputPiezasPedido_12":inputPieza});
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
                newproductoCellNew.textContent = transactionFormData.get("inputPresentacionPedido");
                
                newproductoCellNew = newProductoRow.insertCell(3);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputPiezasPedido");                
                newproductoCellNew.setAttribute("id","editPedido_"+num)

                
                newproductoCellNew = newProductoRow.insertCell(4);// posisicion de la celda
                newproductoCellNew.insertAdjacentHTML("afterbegin","<button type='button' class='btn btn-warning mr-1 editProductoPedido' onclick='changetrtd(this)' data-id='editPedido_"+num+"'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button><button type='button' class='btn btn-danger deleteOnclick' onclick='deleteRow(this)'><i class='fa fa-times-circle' id='' aria-hidden='true'></i></button>");
             
                inputsCorrects.forEach(function(element){
                    limpiarInput(element);
                })
                // este codigo sirve para poner el cursor en la primer input
                focusInput('inputCodigoPedido');
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

</script>