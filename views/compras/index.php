<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
    }
$contador = 1;
    ?>
</div>
<div class="">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">CAPTURA DE COMPRAS</li>
                    </ol>
                </nav>
                <form id="frmIdCompra">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3 col-lg-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"  id="inputGroup-sizing-lg">NUMERO DE NOTA.:</span>
                                        </div>
                                        <input type="text" class="form-control" id="nota" aria-label="Large" aria-describedby="inputGroup-sizing-sm">     
                                    </div>                              
                                    <div class="nota"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3 col-lg-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">FECHA DE COMPRA.:</span>
                                        </div>
                                        <input type="text" class="form-control" id="fechaCompra" aria-label="Large" aria-describedby="inputGroup-sizing-sm" id="fechaCompra">
                                    </div>
                                    <div class="fechaCompra"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group-sm col-lg-8">
                                        <label for="selectNombreProveedor">NOMBRE DEL PROVEEDOR</label>
                                        <select class="form-control" id="selectNombreProveedor" name="selectNombreProveedor">
                                            <option value="-1">Elige un proveedor</option>
                                            <?php $contador=1; while ($provedor = $rowsProv->fetch_object()) : ?>
                                                <option value="<?= $provedor->idProveedor; ?>" id="contador_<?=$contador?>"><?= $provedor->nombreProveesor; ?></option>
                                            <?php $contador++; endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="selectNombreProveedor"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group-sm col-lg-8">
                                        <label for="selectAlmacenVenta">ALMACEN</label>
                                        <select class="form-control" id="selectAlmacenVenta" name="selectAlmacenVenta">
                                            <option value="0">Elige un almacen</option>
                                            <?php while ($almacen = $almacenes->fetch_object()) : ?>
                                                <option value="<?= $almacen->idAlmacen ?>"><?= $almacen->nombreAlmacen ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="selectAlmacenVenta"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group" id="domProvListas">
                                        <div id="showProv">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group" id="almacenListas">
                                        <div id="showAlmacen">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="prodNewForm">
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputCodigo">Código</label>
                                    <div class="input-group">
                                        <input type="text" name="inputCodigo" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputCodigo">
                                    </div>
                                    <div class="inputCodigo"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputNombreProd">Nombre</label>
                                    <div class="input-group">
                                        <input type="text" name="inputNombreProd" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputNombreProd" readonly>
                                    </div>
                                    <div class="inputNombreProd"></div>
                                </div>

                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputPieza">Piezas</label>
                                    <div class="input-group">
                                        <input type="text" name="inputPieza" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPieza">
                                    </div>
                                    <div class="inputPieza"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputPeso">Peso</label>
                                    <div class="input-group">
                                        <input type="text" name="inputPeso" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPeso">
                                    </div>
                                    <div class="inputPeso"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputLote">Lote</label>
                                    <div class="input-group">
                                        <input type="text" name="inputLote" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputLote">
                                    </div>
                                    <div class="inputLote"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputPrecio">Precio</label>
                                    <div class="input-group">
                                        <input type="text" name="inputPrecio" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPrecio">
                                    </div>
                                    <div class="inputPrecio"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="mr-sm-2" for="inputSubtotal">Subtotal</label>
                                    <div class="input-group">
                                        <input type="text" name="inputSubtotal" value="" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputSubtotal" /readonly>
                                    </div>
                                    <div class="inputSubtotal"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <button type="submit" class="btn btn-success" id="enterProducto" name="btn-acepta">Aceptar</button>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg">Buscar</button>
                                <button type="button" class="btn btn-info" onclick="limpiarFormulario('frmIdCompra')" name="btn-cancela">Limpiar</button>

                                
                            </div>
                        </div>
                    </div><!-- FIN DEL CARD -->
                </form>


            </div>
        </div>


        <div id="caja" class="col-lg-12">
            <table class="table table-striped" id="registroProductotable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Piezas</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Lote</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody id="registroProducto">
                                                
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="tot-comp col-lg-10 text-right">
            <label for="total">TOTAL:</label> 
        </div>
        <div id="totalDiv" class="tot-comp col-lg-2 text-left">    
            <p  id="total"> $0000.00 </p>
        </div>
    </div>

    <div class="mt-4">
        <button type="button" id="acceptCompra" class="btn btn-primary btn-lg">
        <span  role="status" aria-hidden="true"></span>
        Aceptar
    </button>
        <button type="button" class="btn btn-secondary btn-lg">Cancelar</button>
    </div>
</div>

<!-- AQUI ESTA EL MODAL -->
<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div div  id="tab-comp">

                    <table class="table table-striped" id="tablaPRoductos">
                        <thead>
                            <tr>
                                <th scope="col">idProdducto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($listaProd = $listaProducto->fetch_object() ):?>
                                        
                            <tr>
                                <td><?=$listaProd->idProducto;?></td>
                                <td><?=$listaProd->nombreProducto;?></td>
                                <td><button type="button" id="<?=$listaProd->idProducto?>" data-idname="<?=$listaProd->nombreProducto;?>" class="btn btn-info" data-dismiss="modal">AGREGAR</button></td>
                            </tr>     
                            <?php endwhile;?>                  
                        </tbody>
                    </table>
                </div>

              
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        let valor = new Array(); // declaramos un nuevo array
        /* hacemos un */
        $("#acceptCompra").on('click',function(e){
            let campos = Array();
            e.preventDefault();
            let idUser = $("#idUser").attr("id-user");
            let nota = $("#nota").val();
            let fechaCompra = $("#fechaCompra").val();
            let selectNombreProveedor = $('#selectNombreProveedor option:selected').val();
            let selectAlmacenVenta = $("#selectAlmacenVenta option:selected").val();
            campos.push({"phone_idUser_12":idUser,"phone_nota_12":nota,"date_fechaCompra_16":fechaCompra,"phone_selectNombreProveedor_6":selectNombreProveedor,"phone_selectAlmacenVenta_6":selectAlmacenVenta})

            var datos = validarCampos(campos)
            if(datos == 0){
                let tabla = existeRegistro(registroProductotable);
                if (tabla == 0){
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'DEBES REGISTR AL MENOS UN PRODUCTO',
                        showConfirmButton: false,
                        timer: 1500
                    });  
                }else{
                    $("#registroProducto tr").each(function(){
                        let codigo = $(this).find('td').eq(0).html();
                        let nombre = $(this).find('td').eq(1).html();
                        let pz = $(this).find('td').eq(2).html();
                        let peso = $(this).find('td').eq(3).html();
                        let lote = $(this).find('td').eq(4).html();
                        let precio = $(this).find('td').eq(5).html();
                        let sub = $(this).find('td').eq(6).html();
                        valor.push({'codigo':codigo,'nombre':nombre,'pieza':pz,'peso':peso,'lote':lote,'precio':precio,'sub':sub,'almacen':selectAlmacenVenta});
                    })

                    var data = {
                        "idUser":idUser,
                        "nota":nota,
                        "fecha":fechaCompra,
                        "provedor":selectNombreProveedor,
                        "productos":valor
                    }
                    let jsonString = JSON.stringify(data);
                    $.ajax({
                        url: getAbsolutePath() + "views/layout/ajax.php",
                        method: "POST",
                        data: { "compra": jsonString },
                        cache: false,
                        beforeSend: function (setContacto) {
                            $("#acceptCompra").attr('disabled','disabled');
                            $("#acceptCompra span").addClass("spinner-border spinner-border-sm");
                            $('.spinnerCliente').html('<i class="fas fa-sync fa-spin"></i>');
                        },
                        success: function (Compra) {
                            console.log(Compra)
                            $("#acceptCompra").removeAttr('disabled','disabled');
                            $("#acceptCompra span").removeClass("spinner-border spinner-border-sm");
                            location.reload();
                        }
                    });                   
                }
            }else{
                campos="";
            }

        })
        
    });
    
        const formVentas = document.getElementById("frmIdCompra");
        
        formVentas.addEventListener("submit", function (event) {
            event.preventDefault();

            let validar = Array();
            let transactionFormData = new FormData(formVentas); // obtiene los datos del formulario

            let inputCodigo = document.getElementById('inputCodigo').value; 
            let inputNombreProd = document.getElementById('inputNombreProd').value; 
            let inputPieza = document.getElementById('inputPieza').value; 
            let inputPeso = document.getElementById('inputPeso').value; 
            let inputLote = document.getElementById('inputLote').value; 
            let inputPrecio = document.getElementById('inputPrecio').value; 
            let inputSubtotal = document.getElementById('inputSubtotal').value; 

            validar.push({"phone_inputCodigo_6":inputCodigo,"nombre_inputNombreProd_80":inputNombreProd,"phone_inputPieza_12":inputPieza,"decimales_inputPeso_12":inputPeso,
                          "nombre_inputLote_50":inputLote,"decimales_inputPrecio_12":inputPrecio,"decimales_inputSubtotal_12":inputSubtotal});
            var campos = validarCampos(validar);
            if(campos == 0 ){
                let insertProducto = document.getElementById("registroProducto"); // este es el id de la tabla
                let newProductoRow = insertProducto.insertRow(-1); //este retorna una fila en la ultima fila de 
                
                let newproductoCellNew = newProductoRow.insertCell(0);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputCodigo");
                
                newproductoCellNew = newProductoRow.insertCell(1);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputNombreProd");                    
                
                newproductoCellNew = newProductoRow.insertCell(2);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputPieza");
                
                newproductoCellNew = newProductoRow.insertCell(3);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputPeso");
                
                newproductoCellNew = newProductoRow.insertCell(4);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputLote");
                
                newproductoCellNew = newProductoRow.insertCell(5);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputPrecio");
                
                newproductoCellNew = newProductoRow.insertCell(6);// posisicion de la celda
                newproductoCellNew.textContent = transactionFormData.get("inputSubtotal");
                
                limpiarInput("inputCodigo");
                limpiarInput("inputNombreProd");
                limpiarInput("inputPieza");
                limpiarInput("inputPeso");
                limpiarInput("inputLote");
                limpiarInput("inputPrecio");
                limpiarInput("inputSubtotal");
                // este codigo sirve para poner el cursor en la primer input
                focusInput("inputCodigo");
                let totalCompra = 0;
                    $("#registroProducto tr").each(function(){
                        totalCompra +=parseFloat($(this).find('td').eq(6).html());
                    }) 
                    $("#total").html(totalCompra.toFixed(2));
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'TODOS LOS CAMPOS SON OBLIGATORIOS, VERIFIQUE LOS DATOS ',
                    showConfirmButton: false,
                    timer: 1500
                });  
                
                limpiarInput("inputPeso");
                limpiarInput("inputPrecio");
                limpiarInput("inputSubtotal");
               
             }
        });

</script>