<style>
	.row {
		margin-top: 4px;
	}
</style>

<form class="form-horizontal" id="form-EditarExpedienteTecnico" action="<?php echo base_url(); ?>index.php/Expediente_Tecnico/modalidad" method="POST" enctype="multipart/form-data">

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">

							<div class="item form-group row">
								<label class="control-label col-md-4 col-sm-4 col-xs-12 ">Modalidad de Ejecución*</label>
								 
								<div class="col-md-8 col-sm-8 col-xs-12">
									<select class="selectpicker form-control col-md-6 col-sm-6 col-xs-12" id="txtModalidadEjecucion" name="txtModalidadEjecucion" data-live-search="true" style="display: block !important;">
									<option value="">Seleccione una opción</option>
									<?php foreach ($listaModalidadEjecucion as $key => $value) { ?>
										<option value='<?= $value->nombre_modalidad_ejec ?>' <?php echo ($ExpedienteTecnicoM->modalidad_ejecucion_et == $value->nombre_modalidad_ejec ? "selected" : "") ?>>
											<?= $value->nombre_modalidad_ejec ?></option>
									<?php } ?>
								</select>
								<input id="hdIdExpediente" name="hdIdExpediente" value="<?= $ExpedienteTecnicoM->id_et ?>" placeholder="" autocomplete="off" type="hidden">
								</div>
							</div>
					
			</div>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="row" style="text-align: right;">
		<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
		<button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>

<script>
	$(function() {
		
		$('#form-EditarExpedienteTecnico').formValidation({
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields: {
				txtModalidadEjecucion: {
					validators: {
						notEmpty: {
							message: '<b style="color: red;">El campo "Modalidad Ejecucion" es requerido.</b>'
						}
					}
				},

			}
		});
	});
</script>