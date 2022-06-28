<?php
function obtenerPartidas($meta)
{
	$partidas=[];

	if(count($meta->childMeta)==0)
	{
		foreach($meta->childPartida as $key => $value)
		{
			$partidas[]=$value;
		}

		return $partidas;
	}

	foreach($meta->childMeta as $key => $value)
	{
		foreach(obtenerPartidas($value) as $index => $item)
		{
			$partidas[]=$item;
		}
	}

	return $partidas;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>FORMATO FF-11</title>
	<style>
		body
		{
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		}
		table
		{
			border-collapse: collapse;
		}
		#tablaContenido td, #tablaContenido th
		{
			font-size: 8px;
			vertical-align: middle;	
			padding: 1px 2px;

		}
		#tablaContenido th
		{
			background-color:#337ab7;
			color:white;	
			text-align:left;
			padding-bottom: 4px;
			padding-top: 4px;
		}

		#tablaContenidoHijo td, #tablaContenidoHijo th
		{
			border: 1px solid black;
			font-size: 8px;
			vertical-align: middle;
			padding: 2px 2px;
		}
		#tablaContenidoHijo th
		{
			color:black;
			background-color:#e2f0f5;
			text-align:left;
		}

	</style>
</head>
<body>
	<div>
		<table style="margin-top: 10px;width: 100%; padding-right: 12px; padding-left: 12px;">
			<tr>
				<td style="width: 65px;">
					<img style="width: 60px;" src="./assets/images/peru.jpg">
				</td>
				<td>
					<div style="text-align: center; font-size: 13px;"><b>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</b></div>
					<div style="text-align: center; font-size: 12px;">"Año del Fortalecimiento de la Soberanía Nacional"</div>							
				</td>
				<td style="width: 65px;">
					<img style="width: 60px;" src="./assets/images/logoUniq.png">
				</td>
			</tr>
		</table>
	</div>
	<div style="text-align: center; font-size: 13px;padding-top:2px;"><b>FORMATO FF-11</b></div>
	<div style="text-align: center; font-size: 13px;padding-bottom:13px;"><b>ANÁLISIS DE COSTOS UNITARIOS</b></div>
	<div style="text-align: center;font-size: 10px; padding-bottom: 18px;"><b>"<?=@$etExpedienteTecnico->nombre_pi;?>"</b></div>
	<div style="font-size: 8px;padding-top:5px;">
		<table style="width: 100%;" id="tablaContenido">
			<tbody>
			<?php if($etExpedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $etExpedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
			if($etExpedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
							?>
			<span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN DIRECTA</span><br><br>
			<?php } ?>
				<?php foreach ($etExpedienteTecnico->childComponente as $key => $value){ ?>
					<?php foreach($value->childMeta as $index => $item){ ?>
						<?php $partidas=obtenerPartidas($item); ?>
						<?php foreach($partidas as $k => $v){ ?>
							<tr>
								<th style="width: 50px;"><b><?=$v->numeracion?></b></th>
								<th><b>PARTIDA:</b></td>
								<th style="width: 550px;"><b><?=$v->desc_partida?></b></th>
							</tr>
							<tr>
								<td></td>
								<td>UNIDAD:</td>
								<td><?=$v->descripcion?></td>
							</tr>
							<tr>
								<td></td>
								<td>RENDIMIENTO:</td>
								<td><?=$v->rendimiento?></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="2">
									<table style="width: 100%;" id="tablaContenidoHijo">
										<thead>
											<tr>
												<th>DESCRIPCIÓN</th>
												<th style="text-align: center;width: 100px;">UND.</th>
												<th style="text-align: center;width: 70px;">CANTIDAD</th>
												<th style="text-align: center;width: 70px;">PRECIO S/.</th>
												<th style="text-align: center;width: 70px;">PARCIAL S/.</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($v->childDetallePartida as $keyTemp => $valueTemp){ ?>
												<?php $totalTemp=0; ?>
												<?php foreach($valueTemp->childAnalisisUnitario as $indexTemp => $itemTemp){ ?>
													<tr>
														<td><b><?=strtoupper($itemTemp->desc_recurso)?></b></td>
														<td colspan="4"></td>
													</tr>
													<?php $subTotalTemp=0; ?>
													<?php foreach($itemTemp->childDetalleAnalisisUnitario as $kTemp => $vTemp){ ?>
														<?php
															$subTotalTemp+=number_format($vTemp->precio_parcial, 2, '.', '');
															$totalTemp+=number_format($vTemp->precio_parcial, 2, '.', '');
															$costoTemporal=number_format($vTemp->precio_parcial, 2, '.', '');
														?>
														<tr>
															<td><?=$vTemp->desc_detalle_analisis?></td>
															<td style="text-align: center;"><?=$vTemp->descripcion?></td>
															<td style="text-align: center;"><?=$vTemp->cantidad?></td>
															<td style="text-align: center;"><?=a_number_format($vTemp->precio_unitario , 2, '.',",",3) ?></td>
															<td style="text-align: center;"><?=a_number_format($costoTemporal , 2, '.',",",3) ?></td>
														</tr>
													<?php } ?>
													<tr>
														<td colspan="3"></td>
														<td style="text-align: center;"><b>Sub-total</b></td>
														<td style="text-align: center;"><b><?=a_number_format($subTotalTemp, 2, '.',",",3) ?></b></td>
													</tr>
												<?php } ?>
												<tr>
													<td colspan="3"></td>
													<td style="text-align: center;">
														<b>TOTAL</b>
													</td>
													<td style="text-align: center;"><b><?=a_number_format($totalTemp, 2, '.',",",3) ?></b></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="3"><div style="border: 1px solid #f5f5f5;"></div></td>
							</tr>
						<?php } ?>
					<?php }?>
				<?php } }?>

				<?php if($etExpedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $etExpedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
			if($etExpedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
							?>
			<span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN INDIRECTA</span><br><br>
			<?php } ?>
				<?php foreach ($etExpedienteTecnico->childComponenteInd as $key => $value){ ?>
					<?php foreach($value->childMeta as $index => $item){ ?>
						<?php $partidas=obtenerPartidas($item); ?>
						<?php foreach($partidas as $k => $v){ ?>
							<tr>
								<th style="width: 50px;"><b><?=$v->numeracion?></b></th>
								<th><b>PARTIDA:</b></td>
								<th style="width: 550px;"><b><?=$v->desc_partida?></b></th>
							</tr>
							<tr>
								<td></td>
								<td>UNIDAD:</td>
								<td><?=$v->descripcion?></td>
							</tr>
							<tr>
								<td></td>
								<td>RENDIMIENTO:</td>
								<td><?=$v->rendimiento?></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="2">
									<table style="width: 100%;" id="tablaContenidoHijo">
										<thead>
											<tr>
												<th>DESCRIPCIÓN</th>
												<th style="text-align: center;width: 100px;">UND.</th>
												<th style="text-align: center;width: 70px;">CANTIDAD</th>
												<th style="text-align: center;width: 70px;">PRECIO S/.</th>
												<th style="text-align: center;width: 70px;">PARCIAL S/.</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($v->childDetallePartida as $keyTemp => $valueTemp){ ?>
												<?php $totalTemp=0; ?>
												<?php foreach($valueTemp->childAnalisisUnitario as $indexTemp => $itemTemp){ ?>
													<tr>
														<td><b><?=strtoupper($itemTemp->desc_recurso)?></b></td>
														<td colspan="4"></td>
													</tr>
													<?php $subTotalTemp=0; ?>
													<?php foreach($itemTemp->childDetalleAnalisisUnitario as $kTemp => $vTemp){ ?>
														<?php
															$subTotalTemp+=number_format($vTemp->precio_parcial, 2, '.', '');
															$totalTemp+=number_format($vTemp->precio_parcial, 2, '.', '');
															$costoTemporal=number_format($vTemp->precio_parcial, 2, '.', '');
														?>
														<tr>
															<td><?=$vTemp->desc_detalle_analisis?></td>
															<td style="text-align: center;"><?=$vTemp->descripcion?></td>
															<td style="text-align: center;"><?=$vTemp->cantidad?></td>
															<td style="text-align: center;"><?=a_number_format($vTemp->precio_unitario , 2, '.',",",3) ?></td>
															<td style="text-align: center;"><?=a_number_format($costoTemporal , 2, '.',",",3) ?></td>
														</tr>
													<?php } ?>
													<tr>
														<td colspan="3"></td>
														<td style="text-align: center;"><b>Sub-total</b></td>
														<td style="text-align: center;"><b><?=a_number_format($subTotalTemp, 2, '.',",",3) ?></b></td>
													</tr>
												<?php } ?>
												<tr>
													<td colspan="3"></td>
													<td style="text-align: center;">
														<b>TOTAL</b>
													</td>
													<td style="text-align: center;"><b><?=a_number_format($totalTemp, 2, '.',",",3) ?></b></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="3"><div style="border: 1px solid #f5f5f5;"></div></td>
							</tr>
						<?php } ?>
					<?php }?>
				<?php } }?>
			</tbody>
		</table>
	</div>
</body>
</html>