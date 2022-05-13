<?php
function mostrarAnidado($meta, $expedienteTecnico, $mostrar)
{
	$cantidad = 0;
	$totalMostrar = 0;
	$htmlTemp='';
	$htmlTemp1='';
	$htmlTemp2='';

	$htmlTemp1.='<tr class="elementoBuscar">'.
		'<td><b><i>'.$meta->numeracion.'</i></b></td>'.
		'<td style="text-align: left;"><b><i>'.html_escape($meta->desc_meta).'</i></b></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>';		
	$htmlTemp1.='</tr>';
	if(count($meta->childMeta)==0)
	{		
		foreach($meta->childPartida as $key => $value)
		{
			$metradoActual = 0;
			$valorizadoActual=0;
			$metradoAnterior = 0;
			$valorizadoAnterior =0;
			$metradoAcumulado = 0;
			$valorizadoAcumulado = 0;
			$porcentajeAcumulado = 0;
			$metradoSaldo = 0;
			$valorizadoSaldo = 0;
			$porcentajeSaldo = 0;
			$descripcion = '';

			foreach($value->childDetallePartida->childDetSegValorizacion as $index => $item)
				{
					if($item->id_detalle_partida==$value->childDetallePartida->id_detalle_partida)
					{
						$metradoActual = $item->metrado;
						$valorizadoActual = $item->valorizado;
						break;
					}
				}
			if (!$mostrar || ($mostrar && number_format($metradoActual, 2)!='0.00')){
			$totalMostrar++;
			$htmlTemp2.='<tr class="elementoBuscar">'.
				'<td>'.$value->numeracion.'</td>'.
				'<td style="text-align: left;">'.html_escape($value->desc_partida).'</td>'.
				'<td>'.html_escape($value->descripcion).'</td>'.
				'<td style="text-align: right;">'.$value->cantidad.'</td>'.
				'<td style="text-align: right;">S/.'.$value->precio_unitario.'</td>'.
				'<td style="text-align: right;">S/.'.number_format($value->cantidad*$value->precio_unitario, 2).'</td>';

				foreach($value->childDetallePartida->childDetSegValorizacionAnterior as $index => $item)
				{
					if($item->id_detalle_partida==$value->childDetallePartida->id_detalle_partida)
					{
						$metradoAnterior = $item->metradoAnterior;
						$valorizadoAnterior = $item->valorizadoAnterior;
						break;
					}
				}

				foreach($value->childDetallePartida->childDetSegValorizacionDescripcion as $index => $item)
				{
					if($item->id_detalle_partida==$value->childDetallePartida->id_detalle_partida)
					{
						$descripcion = $item->descripcion;
						break;
					}
				}

				$metradoAcumulado= $metradoAnterior + $metradoActual;
				$valorizadoAcumulado=$valorizadoAnterior + $valorizadoActual;
				$porcentajeAcumulado = (100 * $metradoAcumulado)/($value->cantidad);
				$metradoSaldo = $value->cantidad - $metradoAcumulado;
				$valorizadoSaldo = ($value->cantidad*$value->precio_unitario) - $valorizadoAcumulado;
				$porcentajeSaldo = 100 - $porcentajeAcumulado;

				$htmlTemp2.='<td style="text-align: right;">'.number_format($metradoAnterior, 2).'</td>';
				$htmlTemp2.='<td style="text-align: right;">S/.'.number_format($valorizadoAnterior, 2).'</td>';
				$htmlTemp2.='<td style="text-align: right;">'.number_format($metradoActual, 2).'</td>';
				$htmlTemp2.='<td style="text-align: right;">S/.'.number_format($valorizadoActual, 2).'</td>';
				$htmlTemp2.='<td style="text-align: right;">'.$descripcion.'</td>';
				$htmlTemp2.='<td style="text-align: right;">'.number_format($metradoAcumulado, 2).'</td>';
				$htmlTemp2.='<td style="text-align: right;">S/. '.number_format($valorizadoAcumulado, 2).'</td>';
				$htmlTemp2.='<td style="text-align: right;">'.number_format($porcentajeAcumulado, 2).'% </td>';
				$htmlTemp2.='<td style="text-align: right;">'.number_format($metradoSaldo, 2).'</td>';
				$htmlTemp2.='<td style="text-align: right;">S/. '.number_format($valorizadoSaldo, 2).'</td>';
				$htmlTemp2.='<td style="text-align: right;">'.number_format($porcentajeSaldo, 2).'% </td>';

			$htmlTemp2.='</tr>';
		  }
		}		
	}
	if($totalMostrar>0){
		$htmlTemp=$htmlTemp1.$htmlTemp2;
	}
	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarAnidado($value, $expedienteTecnico, $mostrar);
	}
	return $htmlTemp;
}
?>
<style>
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th 
	{
		padding:6px;
	}
	.btn, .buttons, .modal-footer .btn+.btn, button 
	{
	    margin-bottom: 0px;
	    margin-right: 5px;
	}
</style>
<style>
	#tableValorizacion td input[type="text"]
	{
		text-align: center;
	}
	#tableValorizacion
	{
		color: #001f3f;
	}

	#tableValorizacion td, #tableValorizacion th
	{
		border: 1px solid #999999;
		font-size: 10px;
		padding: 4px;
		text-align: center;
		vertical-align: middle;
	}
	#tableValorizacionResumen td, #tableValorizacionResumen th
	{
		border: 1px solid #001f3f;
		font-size: 10px;
		padding: 4px;
		text-align: left;
		vertical-align: middle;
	}
	

	.spanMontoValorizacion
	{
		cursor: pointer;
	}

	.spanMontoValorizacion:hover
	{
		text-decoration: underline;
	}
	.espacio{
		height: 20px;
	}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>Valorización Mensual: <?=trim($expedienteTecnico->descripcion_modificatoria)?></b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
                    <div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 12px;">

						</div>
					</div>
                </div>
                <div class="x_content">
                    
                    <div class="row">
                    	<div class="col-md-12">
                    		<label class="control-label"> Nombre del Proyecto:</label>
                    		<div>
                    			<textarea rows="2" class="form-control" readonly="readonly"><?=trim($expedienteTecnico->nombre_pi)?></textarea>
                    			<input type="hidden" id="hdIdEt" name="hdIdEt" value="<?=($expedienteTecnico->id_et)?>">
                    			<br>
                    		</div>
                    	</div>
                    	<div class="col-md-2 col-sm-6 col-xs-12">
							<label for="control-label">Mes:</label>
							<div>
								<select id="txtMes" name="txtMes" class="form-control selectpicker" data-live-search="true">
									<?php foreach ($listaMeses as $key => $value) { ?>
										<option value="<?=$value?>" <?php echo ($mes==$value ? 'selected' : '')?> ><?=$key?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col lg-1 col-md-2 col-sm-6 col-xs-12">
							<label for="control-label">Año</label>
							<div>
								<input type="text" id="txtAnio" name="txtAnio" maxlength="4" autocomplete="off" class="form-control" value="<?=$anio?>">
							</div>
						</div>
						<div class="col-md-2 col-sm-6 col-xs-12">
							<label for="control-label">Mostrar:</label>
							<div>
								<select id="txtMostrar" name="txtMostrar" class="form-control selectpicker">
										<option value="0" <?php echo (!$mostrar ? 'selected' : '')?>>Todas las partidas</option>
										<option value="1" <?php echo ($mostrar ? 'selected' : '')?>>Partidas ejecutadas</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label for="control-label">.</label>
							<div>
								<button class="btn btn-primary" onclick="mostrarReporteMetrado();" ><span class="fa fa-search"></span>  Buscar</button>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 12px;">
							<br>
							<div class="row" style="overflow-y: scroll;overflow-x: scroll;">
								<table id="tableValorizacion"  >
								<thead>
									<tr>
										<th>PROY:</th>
										<th><?=trim($expedienteTecnico->nombre_pi)?></th>
										<th rowspan="3">UNIDAD</th>
										<th rowspan="2" colspan="3" >PRESUPUESTO</th>
										<th colspan="8">AVANCES</th>
										<th colspan="3" rowspan="2">SALDO</th>
									</tr>
									<tr>
										<th rowspan="2">ÍTEM</th>
										<th style="width: 400px;"; rowspan="2">DESCRIPCIÓN</th>
										<th colspan="2">ANTERIOR</th>
										<th colspan="3">ACTUAL</th>
										<th colspan="3">ACUMULADO</th>
									</tr>
									<tr>
										<th>Metrado</th>
										<th>P.Unit. S/.</th>
										<th>Pres.</th>
										<th>Metrado</th>
										<th>Valorizado S/.</th>
										<th>Metrado</th>
										<th>Valorizado S/.</th>
										<th>Descripción.</th>
										<th>Metrado</th>
										<th>Valorizado S/.</th>
										<th>%</th>
										<th>Metrado</th>
										<th>Valorizado S/.</th>
										<th>%</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($expedienteTecnico->childComponente as $key => $value){ ?>
										<tr class="elementoBuscar">
											<td><b><i><?=$value->numeracion?></i></b></td>
											<td style="text-align: left;"><b><i><?=html_escape($value->descripcion)?></i></b></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<?php foreach($value->childMeta as $index => $item){ ?>
											<?= mostrarAnidado($item, $expedienteTecnico,$mostrar)?>
										<?php } ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
						</div>
					</div>
                </div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</div>
<script>
	function valorizar(codigo)
	{
		paginaAjaxDialogo(null, 'Valorizacion de Partida',{ id_DetallePartida: codigo }, base_url+'index.php/Expediente_Tecnico/AsignarValorizacion', 'GET', null, null, false, true);
	}

	function mostrarReporteMetrado()
	{
		var mes = $('#txtMes').val();
		var anio = $('#txtAnio').val();
		var idEt = $('#hdIdEt').val();
		var mostrar = $('#txtMostrar').val();
		if(mostrar==1){
			window.location.href=base_url+"index.php/Expediente_Tecnico/ValorizacionFisicaMetrado?id_et="+idEt+"&mes="+mes+"&anio="+anio+"&mostrar=ejecutada";
		} else {
			window.location.href=base_url+"index.php/Expediente_Tecnico/ValorizacionFisicaMetrado?id_et="+idEt+"&mes="+mes+"&anio="+anio;	
		}
		
	}

</script>
