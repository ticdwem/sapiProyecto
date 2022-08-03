<?php  $estausRuta;$stilos;?>
<div class="container" id="">
    <div class="cabeceraBtn">
        <?php require_once 'views/layout/cabeceraLogo.php'; ?>
    </div>
    <div class="">
        <div class="row">
            <div class="col-lg-12">
            <?php require_once 'views/layout/breadcrup.php';?>
                <table class="table table-striped tablaGenerica" id="rutaCamonetaAssign">
                    <thead>
                        <tr>
                            <th scope="col">Id Ruta</th>
                            <th scope="col">Nombre Ruta</th>
                            <th scope="col">Status</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($ruta = $rutas->fetch_object()):
                           $Estatus =  Utls::getassigned($ruta->idRuta)->fetch_object();
                           if($Estatus->Estatus == 0){$estausRuta = "No Asignado";$stilos = "color:red;";}else{$estausRuta = "ASIGNADO";$stilos = "color:green";}
                            ?>
                            <tr>
                                <th scope="row"><?=$ruta->idRuta?></th>
                                <td><?=$ruta->nombreRuta?></td>
                                <td><p style="<?=$stilos?>"><?=$estausRuta ?></p></td>                                
                                <!-- <td><button type="button" class="btn btn-success rutaCamionetaAssign" data-id="<?=$ruta->idRuta?>">Detalles</button></td> -->
                                <td><a class="btn btn-success rutaCamionetaAssign" href="<?=base_url?>Preventa/asignar&ruta=<?=$ruta->idRuta?>&name=<?=SED::encryption($ruta->nombreRuta)?>">Asignar Camioneta</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="SelectCamionetaRuta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title row" id="exampleModalLongTitle">Asignar a camioneta:  Ruta <p id="nomRutaModelAignDelivers" data-id=""></p></h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="container">
                <div class="col-sm-12 col-md-12 col-lg-12 row">
                    <div class="col-sm-12 col-md-6 col-lg-6" id="idCarDeliver">
                        <div class="form-group">
                            <label for="nombreProdcutoModalEdit">Camioneta </label>
                            <select class="form-select form-control" aria-label="Default select example" id="CamionetaSeleccionada"></select>
                            <div id="alertCamionetaSeleccionada"></div>
                        </div>   
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6" id="idDeliverman">
                        <div class="form-group" >
                            <label for="choferSelect">Chofer </label>
                            <div id="inout" >
                                <input type="text"  class="form-control" name="choferAssigned" id="choferAssigned" value="" readonly>
                            </div>
                            <div id="select">
                                <select class="form-select form-control" aria-label="Default select example" name="choferSelect" id="choferSelect">
                                   <?php while ($chofer = $lista->fetch_object()):?>
                                    <option value="<?=$chofer->idEmpleadoUsuario?>"><?=$chofer->complete?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="nombreProdcutoModalEdit"></div>
                        </div>   
                    </div>
                </div>
                <div class="botones">
                <button type="button" class="btn btn-secondary btn-lg">Large button</button>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>