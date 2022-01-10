<form class="form-horizontal" id="form-editarClasificador" action="<?php echo base_url();?>index.php/ET_Clasificador/editar" method="POST" >
	<div class="row">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" >Número<span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input id="hdIdClasificadro" name="hdIdClasificadro" type="hidden" class="form-control col-md-7 col-xs-12" value="<?= $ETClasificador->id_clasificador?>" placeholder="Ingrese Número" notValidate>
			<input id="txtNumeroClasi" name="txtNumeroClasi" value="<?= $ETClasificador->num_clasificador?>" class="form-control col-md-7 col-xs-12"  placeholder="Ingrese Número"  autocomplete="off" maxlength="15" >
		</div>
	</div><br>
	<div class="row">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" >Descripción<span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input id="txtDescripcionClasi" name="txtDescripcionClasi"  value="<?= $ETClasificador->desc_clasificador?>" class="form-control col-md-7 col-xs-12"  placeholder="Ingrese Descripción"  autocomplete="off" maxlength="300">
		</div>
	</div><br>
	<div class="row">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" >Detalle<span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<textarea id="txtDetalleClasi" name="txtDetalleClasi" class="form-control col-md-7 col-xs-12"  placeholder="Ingrese Detalle" required="required" autocomplete="off" rows="5" maxlength="1000"><?= $ETClasificador->detalle_clasificador?></textarea>
		</div>
	</div><br>
	<div class="ln_solid"></div>
	<div class="row" style="text-align: center;">
			<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar Clasificador</button>
			<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>
</form>

<script>

	$(function()
	{
		$('#form-editarClasificador').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtNumeroClasi:
				{
					validators: 
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Numero" es requerido.</b>'
						},
						stringLength:
	                    {
	                        max: 15,
	                        message: '<b style="color: red;">El campo "Numero" no puede exceder los 15 cáracteres.</b>'
	                    }
					}
				},
				txtDescripcionClasi:
				{
					validators: 
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripción" es requerido.</b>'
						},
						stringLength:
	                    {
	                        max: 300,
	                        message: '<b style="color: red;">El campo "Descripción" no puede exceder los 300 cáracteres.</b>'
	                    }
					}
				},
				txtDetalleClasi:
				{
					validators: 
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Detalle" es requerido.</b>'
						},
						stringLength:
	                    {
	                        max: 1000,
	                        message: '<b style="color: red;">El campo "Detalle" no puede exceder los 1000 cáracteres.</b>'
	                    }
					}
				}
			}
		});
	});
	
	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();

		$('#form-editarClasificador').data('formValidation').validate();

		if(!($('#form-editarClasificador').data('formValidation').isValid()))
		{
			return;
		}

		paginaAjaxJSON($('#form-editarClasificador').serialize(), '<?=base_url();?>index.php/ET_Clasificador/editar', 'POST', null, function(objectJSON)
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
				window.location.href='<?=base_url();?>index.php/ET_Clasificador/index/';

				renderLoading();
			});
		}, false, true);
	});
</script>