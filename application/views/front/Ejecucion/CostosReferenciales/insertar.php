<style>
	.row
	{
		margin-top: 4px;
	}
</style>
<form  id="form-addExpedienteTecnico" action="<?php echo base_url();?>index.php/RepositorioExpediente/insertar" method="POST">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">							
					<div class="row">
						<div class="col-md-4 col-sm-12 col-xs-12">
							<label class="control-label">Codigo Unico</label>
							<div>
								<input id="txtCodigoUnico" name="txtCodigoUnico" class="form-control" value="<?=@$Listarproyectobuscado->codigo_unico_pi ?>">
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Nombre del Proyecto</label>									
							<textarea id="txtProyecto" name="txtProyecto" class="form-control"><?=trim(@$Listarproyectobuscado->nombre_pi)?></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Carpeta</label>
							<div>
								<input id="txtCarpeta" name="txtCarpeta" class="form-control">
							</div>
						</div>
					</div>			
				</div>				
			</div>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="row" style="text-align: right;">
		<button  id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>






