<div class="">
   <!--  <div class=""> -->
        <div id="imagenDefault"></div>
   <!--  </div> -->
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <input type="hidden" id="hid">
        <input type="hidden" id="hin">
        <input type="hidden" id="ventaCliente" data-id="<?=$andenvClientes?>">
        <h5 class="modal-title" id="exampleModalLabel">Rutas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         
        </button>
      </div>
      <div class="modal-body">
      
        <div class="form-group">
            <label for="rutaVFenta">Seleccione Una Ruta</label>
            <select class="form-control" id="rutaVFenta">
                <option value="-1">Rutas</option>
                <?php while($ruta = $datos->fetch_object()): ?>
                    <option data-id="<?=SED::encryption($ruta->idRuta)?>" data-name="<?=SED::encryption($ruta->nombreRuta)?>" value="<?=$ruta->idRuta?>"><?=$ruta->nombreRuta?></option>
                <?php endwhile; ?>
            </select>
        </div>  
        
        
    </div>
    <div class="modal-footer">
        <button type="button" id="gotoVentas" class="btn btn-primary">Save changes</button>
    </div>
</div>
</div>
</div>

<script>
/*     $(document).ready(function(){
        $("#exampleModal").modal({ backdrop: 'static', keyboard: false });
        
    })
    $(document).on('change','#rutaVFenta',function(){
        let rutachange = $(this).val();
        let rutachangedataid = $('select#rutaVFenta option:selected').attr('data-id');
        let rtname = $('select#rutaVFenta option:selected').text();
        let rtnamedataname = $('select#rutaVFenta option:selected').attr('data-name');
        let val = expRegular('phone',rutachange);
        console.log(rutachangedataid);
       if (val != 0) {
            $("#hid").val(rutachangedataid);
            $("#hin").val(rtnamedataname)
        }
    }); */
    $(document).on('click','#gotoVentas',function(){
        let id = $("#hid").val();
        let name = $("#hin").val();
        /* let md5 = $("#ventaCliente").val(); */
       
            window.location.href = getAbsolutePath() +'Anden/lista&ruta='+id+'&name='+name;
        
  
    })
</script>