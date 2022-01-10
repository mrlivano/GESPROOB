<form class="form-horizontal" id="form-EditarTipoResponsable" action="<?php echo base_url();?>index.php/ET_Presupuesto_Ejecucion/editar" method="POST">
	<div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripcion<span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input id="hdId" name="hdId" value="<?=$tiporesponsable->id_tipo_responsable_et;?>" class="form-control col-md-7 col-xs-12" type="hidden">
			<input id="txtDescripcion" name="txtDescripcion" value="<?=$tiporesponsable->desc_tipo_responsable_et;?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" autocomplete="off" type="text">
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
				Cerrar
			</button>
		</div>
	</div>
</form>

<script>

	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();

		paginaAjaxJSON($('#form-EditarTipoResponsable').serialize(), '<?=base_url();?>index.php/ET_Tipo_Responsable/editar', 'POST', null, function(objectJSON)
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
				window.location.href='<?=base_url();?>index.php/ET_Tipo_Responsable/index/';

				renderLoading();
			});
		}, false, true);
	});
</script>
