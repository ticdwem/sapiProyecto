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
                                <div class="input-group input-group-sm mb-3 col-lg-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">NUMERO DE NOTA.:</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <div class="input-group input-group-sm mb-3 col-lg-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">FECHA DE COMPRA.:</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" id="fechaCompra">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group input-group-sm col-lg-8">
                                        <label for="selectNombreProveedor">NOMBRE DEL PROVEEDOR</label>
                                        <select class="form-control" id="selectNombreProveedor" name="selectNombreProveedor">
                                            <option value="0">Elige un proveedor</option>
                                            <?php while ($provedor = $rowsProv->fetch_object()) : ?>
                                                <option value="<?= $provedor->idProveedor; ?>"><?= $provedor->nombreProveesor; ?></option>
                                            <?php endwhile; ?>
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
                                    <div id="selectAlmacenVenta"></div>
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
                            <div class="col-lg-12">
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
            <table class="table table-striped" id="registroProducto">
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
                <tbody>
                    
                </tbody>
            </table>
        </div>
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
        var json ="";
        $('body').on("click","#tablaPRoductos button", function(e){
            e.preventDefault();
            let idboton = $(this).attr("id");
            let botonName = $(this).attr("data-idname");

            $("#inputCodigo").val(idboton);
            $("#inputNombreProd").val(botonName);
        });   
        
        $("#enterProducto").on('click',function(e){
             if(e.which == 13){
               verificar();
            }else{ 
                verificar();
            }  
            
        })



    });

     function verificar(e){      
            let validar = Array();
            const formCompras = document.getElementById("frmIdCompra");

            formCompras.addEventListener("submit", function (event) {
                event.preventDefault();

                let transactionFormData = new FormData(formCompras); // obtiene los datos del formulario

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
                console.log(campos);
                if(campos > 0 ){
                    Swal.fire({
                        position: 'center',
						icon: 'info',
						title: 'TODOS LOD CAMPOS SON OBLIGATORIOS',
						showConfirmButton: false,
						timer: 1500
					});
                    return
                }else{

                    let insertProducto = document.getElementById("registroProducto"); // este es el id de la tabla
                    let newProductoRow = insertProducto.insertRow(-1); //este retorna una fila en la ultima fila de 

                    let newproductoCellNew = newProductoRow.insertCell(0);// posisicion de la celda
                    newproductoCellNew.textContent = transactionFormData.get("inputCodigo");

                    newproductoCellNew = newProductoRow.insertCell(1);// posisicion de la celda
                    newproductoCellNew.textContent = transactionFormData.get("inputNombreProd")
                    limpiarInput("inputCodigo");
                    limpiarInput("inputNombreProd");
                    limpiarInput("inputPieza");
                    limpiarInput("inputPeso");
                    limpiarInput("inputLote");
                    limpiarInput("inputPrecio");
                    limpiarInput("inputSubtotal");
                    // este codigo sirve para poner el cursor en la primer input
                    focusInput("inputCodigo");
                    validar.length = "";

                    newproductoCellNew = newProductoRow.insertCell(2);// posisicion de la celda
                    newproductoCellNew.textContent = transactionFormData.get("inputPieza")

                    newproductoCellNew = newProductoRow.insertCell(3);// posisicion de la celda
                    newproductoCellNew.textContent = transactionFormData.get("inputPeso")

                    newproductoCellNew = newProductoRow.insertCell(4);// posisicion de la celda
                    newproductoCellNew.textContent = transactionFormData.get("inputLote")

                    newproductoCellNew = newProductoRow.insertCell(5);// posisicion de la celda
                    newproductoCellNew.textContent = transactionFormData.get("inputPrecio")

                    newproductoCellNew = newProductoRow.insertCell(6);// posisicion de la celda
                    newproductoCellNew.textContent = transactionFormData.get("inputSubtotal");

                
                   
                 }
            });
        
    }
 

</script>