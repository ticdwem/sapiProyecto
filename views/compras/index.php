<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';
    if (isset($_SESSION['formulario_cliente'])) {
        echo '<div class="alert alert-danger" role="alert" style="width:80%;">HUBO UN ERROR INTERNO EN EL SISTEMA, CONTACTA A TU ADMINISTRADOR DE SISTEMAS</div>';
        Utls::deleteSession('formulario_cliente');
    }

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
                                            <option value="<?=$almacen->idAlmacen?>"><?=$almacen->nombreAlmacen?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div id="selectAlmacenVenta"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group" id="domProvListas">
                                    <!--   DOMICILIO PROVEEDOR -->
                                    <!--                                     <div class="input-group-prepend" id="textDomProv">
                                        <span class="input-group-text">DOMICILIO PROVEEDOR</span>
                                    </div> -->
                                    <div id="showProv">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group" id="almacenListas">
                                    <!-- <div class="input-group-prepend">
                                        <span class="input-group-text">With textarea</span>
                                    </div> -->
                                    <!-- <textarea class="form-control" aria-label="With textarea"></textarea> -->
                                    <div id="showAlmacen">                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-lg-2">

                                <form>
                                    <div class="form-row align-items-center">
                                        <div class="col-auto my-1">
                                            <label class="mr-sm-2" for="formProducto">Producto</label>
                                            <select class="custom-select mr-sm-2" name="formProducto" id="formProducto">
                                                <option selected>Elegir...</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            <div class="formProducto"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-2">
                                <label class="mr-sm-2" for="inputPieza">Piezas</label>
                                <div class="input-group">
                                    <input type="text" name="inputPieza" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputPieza">
                                    <div class="inputPieza"></div>
                                </div>
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
                                    <input type="text" name="inputSubtotal" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputSubtotal" /disabled>
                                </div>
                                <div class="inputSubtotal"></div>
                            </div>

                        </div>
                        <!--<div class="col-lg-12">
                            <p class=" float-right">$$$$$$$$$$$$ </p>
                            <h5 class=" float-right">TOTAL:</h5>
                        </div> -->


                        <div class="col-lg-12">
                            <button type="button" class="btn btn-success" name="btn-acepta">Aceptar</button>
                            <button type="button" class="btn btn-info" name="btn-cancela">Limpiar</button>
                        </div>


                  
                    </div>





                </div><!-- FIN DEL CARD -->

            </div>
        </div>

      
        <div id="caja" class="col-lg-12">
                    <p >
                
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                  
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                  
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                  
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                  
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                  
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.

                       
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.

                       
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.

                       
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.

                       
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore laborum assumenda iusto itaque.
                 Cum et laudantium aut assumenda, obcaecati fugiat eum ducimus quia hic inventore perspiciatis 
                 nulla maxime sapiente nam.
                </p>







                    </div>








    </div>
</div>