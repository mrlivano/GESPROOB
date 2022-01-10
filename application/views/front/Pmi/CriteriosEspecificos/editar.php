
<form  id="form-editarCriteriosEspecificos">

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Criterio específico</label>
							<div>
								<input id="hdId" name="hdId" value="<?=$CriterioEspecifico->id_criterio;?>" class="form-control col-md-7 col-xs-12" type="hidden">
								<input id="txtcriterioespecifico" name="txtcriterioespecifico" value="<?=$CriterioEspecifico->nombre_criterio;?>" class="form-control col-md-4 col-xs-12">	
							</div>	
						</div>
					</div>
			
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Peso</label>
							<div>
								<input id="txtpeso" name="txtpeso" value="<?=$CriterioEspecifico->peso;?>" class="form-control col-md-4 col-xs-12">	
							</div>	
						</div>
					</div>
		
				</div>
				
			</div>
		</div>
	</div>
		<div class="row" style="text-align: right;">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<input type="button" id="btnEnviarFormulario" onclick="btnEnviarFormularioE();" class="btn btn-primary form-control" value="Guardar">
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			</div>

		</div>
</form>

<script>
$(function()
{

});
function btnEnviarFormularioE()
{
		event.preventDefault();

		paginaAjaxJSON($('#form-editarCriteriosEspecificos').serialize(), '<?=base_url();?>index.php/PmiCriterioEspecifico/editar', 'POST', null, function(objectJSON)
		{
			$('#modalTemp').modal('show');
			$('#2').modal('hide');
			$('#11').modal('hide');
			objectJSON=JSON.parse(objectJSON);
			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
			},
			function()
			{
				paginaAjaxDialogo(null, 'Registro Criterio Generales', { id_funcion:objectJSON.id_funcion, nombre_funcion:'SALUD',anio:objectJSON.anio_criterio_gen}, base_url+'index.php/PmiCriterioG/insertar', 'GET', null, null, false, true);

				paginaAjaxDialogo(2, 'Registro Criterio Específicos',{ id_criterio_gen:objectJSON.id_criterio_gen}, base_url+'index.php/PmiCriterioEspecifico/index', 'GET', null, null, false, true);

			});
		}, false, true);
}
</script>
