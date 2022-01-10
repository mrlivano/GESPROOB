<div class="form-horizontal">
	<hr style="margin: 4px;">
	<div id="divListaAnalisisUnitario" style="height: 350px;overflow-y: scroll;">
		<?php foreach($listaETAnalisisUnitario as $value) { ?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div id="divFormDetallaAnalisisUnitario<?=$value->id_analisis?>" style="padding: 4px;">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="control-label">(Clasificador | Presupuesto ejecución)</label>
								<div>
									<select disabled name="selectPresupuestoAnalitico<?=$value->id_analisis?>" id="selectPresupuestoAnalitico<?=$value->id_analisis?>" class="form-control selectPresupuestoAnaliticoAux">
										<option></option>
										<?php foreach($listaETPresupuestoAnalitico as $item){ ?>
											<option value="<?=$item->id_analitico?>" <?=($item->id_analitico==$value->id_analitico ? 'selected' : '')?>><?=html_escape($item->desc_clasificador.' | '.$item->desc_presupuesto_ej)?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<hr style="margin-top: 4px;">
	<div class="row" style="text-align: right;">
		<input type="hidden" id="hdIdPartidaEnAnalisisPresupuestal" value="<?=$idPartida?>">
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar
		</button>
	</div>
</div>
<script>
	$(function()
	{
		$('#selectPresupuestoAnalitico').selectpicker({ liveSearch: true });
	});
</script>