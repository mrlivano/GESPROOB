<div class="modal-body">
   <div class="row">
     <div class="col-xs-12">
       <table class="table">
          <thead>
            <tr>
              <th scope="col">Documento de orden de Servicio</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <?php if (isset($conformidad_orden[0]->pathfile) != null || isset($conformidad_orden[0]->pathfile) != ''): ?>
                  <div style="margin-top:15px;">
                    <i class='fa fa-file fa-2x'></i><a href="../../uploads/ConformidadOrden/<?= $conformidad_orden[0]->pathfile ?>" target="_blank"> <?= $conformidad_orden[0]->pathfile ?></a>
                  </div>
                <?php else : ?>
                  <label for="">No se encontró.</label>
                <?php endif; ?>
              </td>
            </tr>
          </tbody>
        </table>
     </div>
     <hr>
        <div class="col-xs-12">
          <?php if (isset($conformidad_orden[0]->pathfile) != null || isset($conformidad_orden[0]->pathfile) != ''): ?>
            <form id="formUpdateConformidad" class="feedback" name="feedback">
							<div class="form-row">
								<div class="form-group col-md-6" name="inputFile" id="inputFile">
									<label for="exampleFormControlFile1">Documento</label>
                  <input type="hidden" name="nro_orden" value="<?=$nro_orden?>">
                  <input type="file" class="form-control-file" name="conformidadFile" id="conformidadFile">
								</div>
							</div>
              <br>
              <hr>
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
									<button class="btn btn-primary" id="send" type="submit">Guardar</button>
								</div>
							</div>
						</form>
          <?php else : ?>
            <form id="formAddEstadoPedido" class="feedback" name="feedback">
							<div class="form-row">
								<div class="form-group col-md-6" name="inputFile" id="inputFile">
									<label for="exampleFormControlFile1">Documento</label>
                  <input type="hidden" name="nro_orden" value="<?=$nro_orden?>">
                  <input type="file" class="form-control-file" name="conformidadFile" id="conformidadFile">
								</div>
							</div>
              <br>
              <hr>
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
									<button class="btn btn-primary" id="send" type="submit">Guardar</button>
								</div>
							</div>
						</form>
          <?php endif; ?>
        </div>
    </div>
</div>

<script>

$(function () {
    $(".custom-close").on('click', function() {
        $('#my_modal').modal('hide');
    });
});

var base_url = '<?php echo base_url(); ?>';

			$("#formAddEstadoPedido").submit(function(event)
			{
					event.preventDefault();

					var formData=new FormData($("#formAddEstadoPedido")[0]);

					$.ajax({
							url: base_url+"index.php/ProyectoInversion/addOrdenServicio",
							type:'POST',
							enctype: 'multipart/form-data',
							data:formData,
							cache: false,
							contentType:false,
							processData:false,
							success:function(resp)
							{
								swal("Bien!", "Se registro correctamente!", "success");
							},
							error: function ()
							{
									swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error");
							}
					});
			});

      $("#formUpdateConformidad").submit(function(event)
			{
					event.preventDefault();

					var formData=new FormData($("#formUpdateConformidad")[0]);

					$.ajax({
							url: base_url+"index.php/ProyectoInversion/updateOrdenServicio",
							type:'POST',
							enctype: 'multipart/form-data',
							data:formData,
							cache: false,
							contentType:false,
							processData:false,
							success:function(resp)
							{
								swal("Bien!", "Se registro correctamente!", "success");
							},
							error: function ()
							{
									swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error");
							}
					});
			});

</script>
