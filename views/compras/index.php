<div class="cabeceraBtn">
    <?php require_once 'views/layout/cabeceraLogo.php';

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
                        <!--  This is some text within a card body. -->
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
                                <label for="">26-04-2021</label>
                                <!-- <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"> -->
                            </div>




                            <div class="col-lg-6">

                                <!--  <div class="input-group-prepend col-lg-2">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">PROVEEDOR.:</span>
                                                    </div> -->
                                <!--  <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"> -->
                                <div class="form-group input-group-sm col-lg-8">
                                    <label for="exampleFormControlSelect1">NOMBRE DEL PROVEEDOR</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <!--  <div class="input-group-prepend col-lg-2">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">PROVEEDOR.:</span>
                                                    </div> -->
                                <!--  <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"> -->
                                <div class="form-group input-group-sm col-lg-8">
                                    <label for="exampleFormControlSelect1">NOMBRE DEL PROVEEDOR</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">With textarea</span>
                                    </div>
                                    <textarea class="form-control" aria-label="With textarea"></textarea>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">With textarea</span>
                                    </div>
                                    <textarea class="form-control" aria-label="With textarea"></textarea>
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