<form class="form-horizontal" id="form-addCronogramaValorizacion" action="<?php echo base_url();?>index.php/CronogramaValorizacion/insertar" method="POST" >
	<div class="row">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" >Descripción<span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input id="txtCronogramaValorizacion" name="txtCronogramaValorizacion" class="form-control col-md-7 col-xs-12"  placeholder="Ingrese Etapa" required="required" autocomplete="off" >
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="row" style="text-align: center;">
			<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar Cronograma Valorización</button>
			<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>
</form>

<script>

	$(function()
	{
		$('#form-addCronogramaValorizacion').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtCronogramaValorizacion:
				{
					validators: 
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripción" es requerido.</b>'
						}
					}
				}
			}
		});
	});
	
	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();

		$('#form-addCronogramaValorizacion').data('formValidation').validate();

		if(!($('#form-addCronogramaValorizacion').data('formValidation').isValid()))
		{
			return;
		}

		paginaAjaxJSON($('#form-addCronogramaValorizacion').serialize(), '<?=base_url();?>index.php/CronogramaValorizacion/insertar', 'POST', null, function(objectJSON)
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
				window.location.href='<?=base_url();?>index.php/CronogramaValorizacion/index/';
				renderLoading();
			});
		}, false, true);
	});
</script>