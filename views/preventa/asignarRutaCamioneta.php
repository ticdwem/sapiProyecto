<?php

if (isset($_SESSION['formulario_cliente'])) {
    $sesion = $_SESSION['formulario_cliente']['datos'];
    if ($sesion != "") {
      echo '<p class="alert alert-danger error " role="alert">' . $_SESSION['formulario_cliente']["error"] . "</p>";
    }
  }
  Utls::deleteSession("formulario_cliente");
 $estausRuta;$stilos;$contador=1;?>
<div class="container" id="">
    <div class="cabeceraBtn">
        <?php require_once 'views/layout/cabeceraLogo.php'; ?>
    </div>
    <div class="">
        <div class="row">
            <div class="col-lg-12">
            <?php require_once 'views/layout/breadcrup.php';?>
                <div class="col-lg-12 col-md-12 col-sm-12" id="rutaTittle">
                <div class="alert alert-success" id="rutaNameid" data-id="<?=$_GET['ruta']?>" role="alert">Ruta: <?=SED::decryption($_GET['name'])?></div>
                </div>
                <form action="<?=base_url?>Preventa/createRuta" method="post">
                    <div class="col-lg-12 col-md-12 col-sm-12 row">
                        <input type="hidden" name="idRutaCamioneta" id="idRutaCamioneta" value="<?=$_GET['ruta']?>">
                        <div class="col-lg-4 col-md-4 col-sm-12 border">
                            <label for="idCamionetaAssign" class="form-label">Camioneta</label>
                            <select class="form-select form-control form-select-lg mb-3 idCamionetaAssign" name="idCamionetaAssign" aria-label=".form-select-lg example" id="idCamionetaAssign">
                                <option selected>Seleccione una camioneta</option>
                                <?php while ($camioneta = $carros->fetch_object()):
                                    if($camioneta->idCamioneta == 1){continue;}
                                    ?>
                                    <option value="<?=$camioneta->idCamioneta?>"><?=$camioneta->idCamioneta?> -- <?=$camioneta->placaCamioneta?></option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                            <div class="result"></div>
                            <div class="col-lg-4 col-md-4 col-sm-12 border">
                                <label for="idChoferSelect" class="form-label">Chofer</label>
                                <select class="form-select form-select-lg mb-3 form-control" name="idChoferSelect" aria-label=".form-select-lg example" id="idChoferSelect">
                                    <option selected>Seleccione un chofer</option>
                                    <?php while ($chofer = $chofSA ->fetch_object()): ?>
                                        <option value="<?=$chofer->idEmpleadoUsuario?>"><?=$chofer->nombreUsuario?></option>
                                        <?php endwhile;?>       
                                    </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 border">
                                <button type="submit" class="btn btn-lg btn-primary m-4" >Insertar</button>
                            </div>
                    </div>
                    <input type="hidden" name="namert" id="namert" value="<?=$_GET['name']?>">
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <hr>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Camioneta</th>
                        <th scope="col">Placa</th>
                        <th scope="col">Chofer</th>
                        <th scope="col">Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_object($asinados)): 
                                while ($assignado = $asinados->fetch_object()):
                                    /* echo '<pre>';
                                    var_dump($assignado);
                                    echo '</pre>'; */
                                ?>
                                    <tr>
                                        <th scope="row"><?=$contador ++?></th>
                                        <td><?=$assignado->_camioneta?></td>
                                        <td><?=$assignado->placa?></td>
                                        <td><?=$assignado->nameChofer?></td>
                                        <td><?=$assignado->contacto?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-warning " data-id=""><i class="fas fa-edit" aria-hidden="true"></i></button>
                                                <button type="button" class="btn btn-danger ml-2" id="<?=$assignado->_camioneta?>" data-get="<?=$assignado->idChofer?>"><i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php   endwhile; else: ?>
                            <tr>
                                <th scope="row" colspan="5"><p class="text-center">SIN DATOS REGISTRADOS</p></th>                                        
                            </tr>
                        <?php endif;   ?>
                             
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
