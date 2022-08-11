<form class="form-horizontal" id="form-addPresupuestoEjecucion" action="<?php echo base_url();?>index.php/ET_Presupuesto_Ejecucion/insertar" method="POST" >
	<div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción<span class="required">*</span></label>
		<input type="hidden" name="hdIdPresupuestoEjecucion" id="hdIdPresupuestoEjecucion" value="<?=@$idPresupuesto?>">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input id="txtDescripcion" name="txtDescripcion" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Ingrese presupuesto ejecucion" required="required" autocomplete="off" type="text">
		</div>
	</div>
	<div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Repositorio<span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="checkbox" class="checkRepositorio" name="checkRepositorio" id="checkRepositorio" checked="true">		
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
		$('#form-addPresupuestoEjecucion').formValidation(
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
		$('#form-addPresupuestoEjecucion').data('formValidation').validate();
        if(!($('#form-addPresupuestoEjecucion').data('formValidation').isValid()))
        {
            return;
        }

		paginaAjaxJSON($('#form-addPresupuestoEjecucion').serialize(), '<?=base_url();?>index.php/ET_Presupuesto_Ejecucion/insertar', 'POST', null, function(objectJSON)
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

