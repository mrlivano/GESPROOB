<form class="form-horizontal" id="form-addTipoResponsable" action="<?php echo base_url();?>index.php/ET_Tipo_Responsable/insertar" method="POST" >
	<div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción<span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input id="txtDescripcion" name="txtDescripcion" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Ingrese Tipo de Responsable" required="required" autocomplete="off" type="text">
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

	$(function()
	{
		$('#form-addTipoResponsable').formValidation(
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
				}
			}
		});
	});
	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();
		$('#form-addTipoResponsable').data('formValidation').validate();
        if(!($('#form-addTipoResponsable').data('formValidation').isValid()))
        {
            return;
        }

		paginaAjaxJSON($('#form-addTipoResponsable').serialize(), '<?=base_url();?>index.php/ET_Tipo_Responsable/insertar', 'POST', null, function(objectJSON)
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
				window.location.href='<?=base_url();?>index.php/ET_Presupuesto_Ejecucion/index/';

				renderLoading();
			});
		}, false, true);
	});

</script>

