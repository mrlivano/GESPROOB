<style>
#listaComponente
{
	text-transform:uppercase;
}
</style>
<form class="form-horizontal" id="frmAgregarEspecificacionTecnica">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12" id="listaComponente">
						<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
							if($expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
							?>
						<span style="font-weight:bold;">ADMINISTRACIÓN DIRECTA</span><br><br>
						<?php }?>
							<div class="list-group">
								<?php foreach ($expedienteTecnico->childComponente as $key => $value) { ?>
									<a href="<?= site_url('ET_EspecificacionTecnica/FormatoEspecificacionTecnicaPorComponente?query='.@$value->id_componente);?>" target="_blank" class="list-group-item" ><?=$value->descripcion?></a>
								<?php } ?>
							</div>
							<?php }?>

							<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
							if($expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
							?>
						<span style="font-weight:bold;">ADMINISTRACIÓN INDIRECTA</span><br><br>
						<?php }?>
							<div class="list-group">
								<?php foreach ($expedienteTecnico->childComponenteInd as $key => $value) { ?>
									<a href="<?= site_url('ET_EspecificacionTecnica/FormatoEspecificacionTecnicaPorComponente?query='.@$value->id_componente);?>" target="_blank" class="list-group-item" ><?=$value->descripcion?></a>
								<?php } ?>
							</div>
							<?php }?>
							<input type="hidden" name="hdIdExpediente" id="hdIdExpediente" value=<?=@$idExpedienteTecnico?>>
						</div>
					</div>		
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="text-align: right;">
		<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>







