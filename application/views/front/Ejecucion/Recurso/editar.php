<form class="form-horizontal" id="form-EditarRecurso" action="<?php echo base_url();?>index.php/ET_Recurso/editar" method="POST">
	<div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripcion<span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input id="hdId" name="hdId" value="<?=$recurso->id_recurso;?>" class="form-control col-md-7 col-xs-12" type="hidden">
			<input id="txtDescripcion" name="txtDescripcion" value="<?=$recurso->desc_recurso;?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" autocomplete="off" type="text">
		</div>
	</div>
	<div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Modalidad<span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" id="cbxModalidad" name="cbxModalidad">
						<option value="">Seleccione modalidad</option>
						<option value="1" <?=($recurso->modalidad==1 ? 'selected' : '')?>>Administración Directa</option>
						<option value="2" <?=($recurso->modalidad==2 ? 'selected' : '')?>>Administración Indirecta</option>
			</select>
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

	$(function()
	{
		$('#form-EditarRecurso').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtDescripcion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripción" es requerido.</b>'
						}
					}
				},
				cbxModalidad: {
					validators: {
						notEmpty: {
							message: '<b style="color: red;">El campo "Modalidad" es requerido.</b>'
						}
					}

				}
			}
		});
	});

	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();

		paginaAjaxJSON($('#form-EditarRecurso').serialize(), '<?=base_url();?>index.php/ET_Recurso/editar', 'POST', null, function(objectJSON)
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
				window.location.href='<?=base_url();?>index.php/ET_Recurso/index/';

				renderLoading();
			});
		}, false, true);
	});
</script>

