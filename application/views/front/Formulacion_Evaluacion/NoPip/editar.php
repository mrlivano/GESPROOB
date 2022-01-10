<form class="form-horizontal" id="form-EditarNoPipFE" action="<?php echo base_url();?>index.php/NoPipProgramados/editar" method="POST">
	<div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">NOMBRE DEL NO PIP<span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input id="hdId" name="hdId" value="<?=$NoPipData->id_est_inv;?>" class="form-control col-md-7 col-xs-12" type="hidden">
			<input id="txtNombreNoPip" name="txtNombreNoPip" value="<?=$NoPipData->nombre_est_inv;?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" autocomplete="off" type="text">
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="form-group">
		<div class="col-md-6 col-md-offset-3">
			<button type="submit" id="btnEnviarFormulario" class="btn btn-success">
				<span class="glyphicon glyphicon-floppy-disk"></span>
				Guardar
			</button>
			<button class="btn btn-danger" data-dismiss="modal">
				<span class="glyphicon glyphicon-remove"></span>
				Cancelar
			</button>
		</div>
	</div>
</form>

<script>

	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();

		paginaAjaxJSON($('#form-EditarNoPipFE').serialize(), '<?=base_url();?>index.php/NoPipProgramados/editar', 'POST', null, function(objectJSON)
		{
			$('#modalTemp').modal('hide');

			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
			},
			function()
			{
				window.location.href='<?=base_url();?>index.php/NoPipProgramados/nopipformulacion/';

				renderLoading();
			});
		}, false, true);
	});
</script>
