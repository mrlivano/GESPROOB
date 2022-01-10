<style>
	.row
	{
		margin-top: 4px;
	}
</style>
<form  id="form-addExpedienteTecnico" action="<?php echo base_url();?>index.php/Expediente_Tecnico/insertar" method="POST">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">					
					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Nombre del Proyecto</label>
							<input type="hidden" id="txtIdPi" name="txtIdPi" value="<?= $Listarproyectobuscado->id_pi?>" readonly="readonly" >									
							<textarea id="txtProyecto" name="txtProyecto" class="form-control" readonly="readonly"><?= $Listarproyectobuscado->codigo_unico_pi ?> - <?=trim($Listarproyectobuscado->nombre_pi)?></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-3 col-xs-12">
							<label class="control-label">Funcion</label>
							<div>
								<input id="txtFuncion" name="txtFuncion" class="form-control col-md-4 col-xs-12" value="<?= $Listarproyectobuscado->nombre_funcion?>"  placeholder="Funcion"  autocomplete="off" readonly="readonly">
							</div>
						</div>
						<div class="col-md-4 col-sm-3 col-xs-12">
							<label class="control-label">Programa</label>
							<div>
								<input id="txtPrograma" name="txtPrograma" class="form-control col-md-4 col-xs-12" value="<?= $Listarproyectobuscado->nombre_div_funcional?>" placeholder="Programa"  autocomplete="off" readonly="readonly">
							</div>
						</div>
						<div class="col-md-4 col-sm-3 col-xs-12">
							<label class="control-label">Sub Programa</label>
							<div>
								<input id="txtSubPrograma" name="txtSubPrograma" class="form-control col-md-4 col-xs-12" value="<?= $Listarproyectobuscado->nombre_grup_funcional?>" placeholder="Sub Programa"  autocomplete="off" readonly="readonly">
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Nombre de la Unidad Ejecutora</label>
							<div>
								<input id="txtNombreUe" name="txtNombreUe" value="<?= $Listarproyectobuscado->nombre_ue?>" class="form-control"  placeholder="Nombre de la Unidad Ejecutora"  autocomplete="off" >	
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






