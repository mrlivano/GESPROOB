<?php
function mostrarMetaAnidada($meta, $idExpedienteTecnico, $listaETEtapaEjecucion, $listaUnidadMedida)
{
	$htmlTemp='';

	if(count($meta->childMeta)==0)
	{
		foreach($meta->childPartida as $key => $value)
		{
			$htmlTemp.='<div class="row">'.
				'<div class="col-md-12 col-sm-12 col-xs-12">'.
					'<div class="x_panel">'.
						'<div class="x_title">'.
							'<div class="row">'.
								'<div class="col-md-7 col-sm-7 col-xs-12">'.$value->desc_partida.'</div>'.
								'<div class="col-md-3 col-sm-3 col-xs-12">'.$value->rendimiento.'</div>'.
								'<div class="col-md-1 col-sm-1 col-xs-12">'.$value->descripcion.'</div>'.
								'<div class="col-md-1 col-sm-1 col-xs-12">'.$value->cantidad.'</div>'.
							'</div>'.
						'</div>'.
						'<div class="x_content">'.
							'<div class="row">'.
								'<div class="col-md-8 col-sm-8 col-xs-12">'.
									'<label>Rendimiento</label>'.
									'<input id="txtRendimiento" name="txtRendimiento" class="form-control col-md-4 col-xs-12"  placeholder="Rendimiento" required="required" autocomplete="off" >'.
								'</div>'.
								'<div class="col-md-2 col-sm-2 col-xs-12">'.
									'<label>Unidad</label>'.
									'<select id="cobUnidad" name="cobUnidad" class="form-control">';

										foreach($listaUnidadMedida as $item)
										{
											$htmlTemp.='<option value="'.$item->id_unidad.'">'.$item->descripcion.'</option>';
										}

									$htmlTemp.='</select>'.
								'</div>'.
								'<div class="col-md-2 col-sm-2 col-xs-12">'.
									'<label>Cant.</label>'.
									'<input id="txtCantidad" name="txtCantidad" class="form-control col-md-4 col-xs-12"  placeholder="" required="required" autocomplete="off" >'.
								'</div>'.
							'</div>'.
							'<div class="row">'.
								'<div class="col-md-2 col-sm-3 col-xs-12">'.
									'<label>Precio</label>'.
									'<input id="txtPrecio" name="txtPrecio" class="form-control col-md-4 col-xs-12"  placeholder="" required="required" autocomplete="off" >'.
								'</div>'.
								'<div class="col-md-2 col-sm-3 col-xs-12">'.
									'<label>Total</label>'.
									'<input id="txtTotal" name="txtTotal" class="form-control col-md-4 col-xs-12"  placeholder="" required="required" autocomplete="off" >'.
								'</div>'.
								'<div class="col-md-6 col-sm-3 col-xs-12">'.
									'<label>Etapa</label>'.
									'<select id="cbxEtapa1" class="form-control">';

										foreach($listaETEtapaEjecucion as $item)
										{
											$htmlTemp.='<option value="'.$item->id_etapa_et.'">'.$item->desc_etapa_et.'</option>';
										}

									$htmlTemp.='</select>'.
								'</div>'.
								'<div class="col-md-2 col-sm-3 col-xs-12">'.
									'<label>.</label>'.
									'<input type="button" class="btn btn-info" value="Proceder" style="width: 100%;">'.
								'</div>'.
							'</div><br>'.
							'<div class="row">'.
								'<table id="table-Partidad" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'.
									'<thead>'.
										'<tr>'.
											'<td>Rendimiento</td>'.
											'<td>Und.</td>'.
											'<td>Cant.</td>'.
											'<td>Precio U.</td>'.
											'<td>Etapa.</td>'.
											'<td>Anl.</td>'.
											'<td>Total</td>'.
											'<td></td>'.
										'</tr>'.
									'</thead>'.
									'<tbody>';

									if($value->childDetallePartida!=null)
									{
										$htmlTemp.='<tr>'.
											'<td>'.$value->childDetallePartida->rendimiento.'</td>'.
											'<td>'.$value->childDetallePartida->id_unidad.'</td>'.
											'<td>'.$value->childDetallePartida->cantidad.'</td>'.
											'<td>'.$value->childDetallePartida->precio_unitario.'</td>'.
											'<td>'.$value->childDetallePartida->id_etapa_et.'</td>'.
											'<td><a href="#" style="color: blue;text-decoration: underline;">Analítico</a></td>'.
											'<td>'.$value->childDetallePartida->parcial.'</td>'.
											'<td>'.''.'</td>'.
										'</tr>';
									}

									$htmlTemp.='</tbody>'.
								'</table>'.
							'</div>'.
						'</div>'.
					'</div>'.
				'</div>'.
			'</div>';
		}
	}

	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarMetaAnidada($value, $idExpedienteTecnico, $listaETEtapaEjecucion, $listaUnidadMedida);
	}

	return $htmlTemp;
}
?>
<form class="form-horizontal">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<label class="control-label" style="text-align: left;">Nombre Proyecto</label>
			<div>
				<textarea name="txtNombreProyectoInversion" id="txtNombreProyectoInversion" rows="3" class="form-control" style="resize: none;resize: vertical;" readonly="readonly"><?=$etExpedienteTecnico->nombre_pi?></textarea>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<label class="control-label">Etapa</label>
			<div>
				<select id="cbxEtapa" name="cbxEtapa" class="form-control"> 
					<?php foreach($listaETEtapaEjecucion as $value) { ?>
						<option value="<?=$value->id_etapa_et?>"><?=$value->desc_etapa_et?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	<hr style="margin-bottom: 4px;margin-top: 4px;">
	<?php foreach($etExpedienteTecnico->childComponente as $key => $value){ ?>
		<?php foreach($value->childMeta as $index => $item){ ?>
			<?=mostrarMetaAnidada($item, $etExpedienteTecnico->id_et, $listaETEtapaEjecucion, $listaUnidadMedida);?>
		<?php } ?>
	<?php } ?>
	<hr>
	<div class="row" style="text-align: right;">
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar
		</button>
	</div>
</form>