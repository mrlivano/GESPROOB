<style>
	.row
	{
		margin-top: 4px;
	}
</style>

<form class="form-horizontal" id="form-EditarExpedienteTecnico" action="<?php echo base_url();?>index.php/Expediente_Tecnico/modalidad" method="POST" enctype="multipart/form-data" >

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">

				<div class="x_content">
				
					<div class="row">
					<div class=" col-md-4 col-sm-4 col-xs-12">
					  		<label class="control-label">Modalidad de Ejecución*</label>
					    	<div class="form-group">
							<input id="hdIdExpediente" name="hdIdExpediente" value="<?= $ExpedienteTecnicoM->id_et?>" class="form-control col-md-4 col-xs-12" placeholder="" autocomplete="off"  type="hidden">	
						      	<select class="selectpicker form-control" id="txtModalidadEjecucion" name="txtModalidadEjecucion" data-live-search="true" onChange="mostrar(this.value);">
								  	<option value="">Seleccione una opción</option>
									<?php foreach ($listaModalidadEjecucion as $key => $value) { ?>
						      			<option  value='<?=$value->nombre_modalidad_ejec?>' <?php echo ($ExpedienteTecnicoM->modalidad_ejecucion_et == $value->nombre_modalidad_ejec ? "selected" : "")?> >
						      			<?=$value->nombre_modalidad_ejec?></option>		      								      			
						      		<?php } ?>
						      	</select>
					    	</div>
					  	</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="row" style="text-align: right;">
		<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>

<script>
	  
$(function()
{
	mostrar($("#txtModalidadEjecucion").val());
	

	$('#form-EditarExpedienteTecnico').formValidation(
	{
		framework: 'bootstrap',
		excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
		live: 'enabled',
		message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
		trigger: null,
		fields:
		{		
			txtModalidadEjecucion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Modalidad Ejecucion" es requerido.</b>'
					} 
				}
			},	
						
		}
	});
});

</script>







