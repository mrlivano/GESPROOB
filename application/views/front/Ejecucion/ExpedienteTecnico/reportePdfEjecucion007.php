<?php

$costoDirectoTotal=0;
function mostrarMetaAnidada($meta, $expedienteTecnico, &$costoDirectoTotal)
{
	$htmlTemp='';
	$htmlTempP='';
	$sumaTemp=0;

	if(count($meta->childMeta)==0)
	{
		foreach($meta->childPartida as $key => $value)
		{
			$htmlTemp.='<tr>'.
				'<td>'.$value->numeracion.'</td>'.
				'<td style="text-align: left;">'.html_escape($value->desc_partida).'</td>'.
				'<td>'.html_escape($value->descripcion).'</td>'.
				'<td>'.number_format($value->cantidad, 2, '.', '').'</td>'.
				'<td style="text-align: right;">'.number_format($value->precio_unitario,4).'</td>'.
				'<td style="text-align: right;">'.number_format($value->parcial, 4).'</td>';

			$htmlTemp.='</tr>';

			$costoDirectoTotal+=($value->parcial);
			$sumaTemp+=($value->parcial);
		}
		
	}
	else {
		foreach($meta->childPartida as $key => $value)
		{
			$htmlTemp.='<tr>'.
				'<td>'.$value->numeracion.'</td>'.
				'<td style="text-align: left;">'.html_escape($value->desc_partida).'</td>'.
				'<td>'.html_escape($value->descripcion).'</td>'.
				'<td>'.number_format($value->cantidad, 2, '.', '').'</td>'.
				'<td style="text-align: right;">'.number_format($value->precio_unitario, 4).'</td>'.
				'<td style="text-align: right;">'.number_format($value->parcial, 4).'</td>';

			$htmlTemp.='</tr>';

			$costoDirectoTotal+=($value->parcial);
			$sumaTemp+=($value->parcial);
		}
	}

	foreach($meta->childMeta as $key => $value)
	{
		$temp = mostrarMetaAnidada($value, $expedienteTecnico, $costoDirectoTotal);
		$htmlTemp.=$temp['htmlT'];
		$sumaTemp+=$temp['sumaTemp'];
	}
	
	$htmlTempP.='<tr>'.
		'<td><b><i>'.$meta->numeracion.'</i></b></td>'.
		'<td style="text-align: left;"><b><i>'.html_escape($meta->desc_meta).'</i></b></td>'.
		'<td>---</td>'.
		'<td>---</td>'.
		'<td style="text-align: right;">---</td>'.
		'<td style="text-align: right;"><b><i>'.number_format($sumaTemp, 4).'</i></b></td>';	

	$htmlTempP.='</tr>';
	$htmlTempP.=$htmlTemp;

	$arrayMeta=array('htmlT'=> $htmlTempP,'sumaTemp'=>$sumaTemp);

	return $arrayMeta;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>FORMATO FF-07</title>
		<meta charset="utf-8">
		<style>
			body
			{
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			}
			table
			{
				border-collapse: collapse;
			}
			#tableValorizacion td, #tableValorizacion th
			{
				border: 1px solid black;
				font-size: 8px;
				padding: 4px;
				text-align: center;
				vertical-align: middle;
			}
			#tableValorizacion th
			{
				background-color:#337ab7;
				color:white;	
				padding:5px 5px;
			}

			#tableResumen td, #tableResumen th
			{
				border: 1px solid black;
				font-size: 8px;
				padding: 4px;
				text-align: left;
				vertical-align: middle;		
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
		<div style="text-align: center; font-size: 13px;padding-top:2px;"><b>FORMATO FF-07</b></div>
		<div style="text-align: center; font-size: 13px;padding-bottom:15px;"><b>PRESUPUESTO GENERAL</b></div>
		<div style="font-size: 8px;padding-bottom:15px;">
			<table id="tablaPresentacion" style="width: 100%">
				<tr>
					<td style="width: 8%;font-weight:bold;">PROYECTO</td>
					<td style="width: 92%">: <?=$expedienteTecnico->nombre_pi;?> </td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">COMPONENTE</td>
					<td style="width: 92%">: <?=$expedienteTecnico->componente_et;?> </td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">META</td>				
					<td style="width: 92%">: <?=$expedienteTecnico->meta_et;?> </td>
				</tr>				
				<tr>
					<td style="width: 8%;font-weight:bold;">FTE. FTO</td>
					<td style="width: 92%">: <?=$expedienteTecnico->fuente_financiamiento_et;?> </td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">MODALIDAD</td>
					<td style="width: 92%">: <?=$expedienteTecnico->modalidad_ejecucion_et;?> </td>
				</tr>
			</table>    
		</div>
		<div>
		<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
			if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
							?>
			<span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN DIRECTA</span><br><br>
			<?php } ?>
		<?php $costoDirectoTotal=0; ?>
			<table id="tableValorizacion" style="width:100%;">
				<thead>
					<tr>
						<th style="width:7%;">ÍTEM</th>
						<th style="width:50%;">DESCRIPCIÓN</th>
						<th style="width:10%;">UND.</th>
						<th style="width:10%;">METRADO</th>
						<th style="width:10%;">PRECIO (S/.)</th>
						<th style="width:13%;">PARCIAL (S/.)</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($expedienteTecnico->childComponente as $key => $value){ 
						$resultadoMetaAnidada='';
						$resultadoSumaAnidada=0;
							foreach($value->childMeta as $index => $item){ 
								$resultado=mostrarMetaAnidada($item, $expedienteTecnico, $costoDirectoTotal);
								$resultadoMetaAnidada.= $resultado['htmlT'];
								$resultadoSumaAnidada+=$resultado['sumaTemp'];
							 } 
						?>
						<tr>
							<td style="width:5%;"><b><i><?=$value->numeracion?></i></b></td>
							<td style="text-align: left;width:50%;"><b><i><?=html_escape($value->descripcion)?></i></b></td>
							<td style="width:10%;">---</td>
							<td style="width:10%;">---</td>
							<td style="width:10%;text-align: right;">---</td>
							<td style="width:15%;text-align: right;"><b><?=a_number_format($resultadoSumaAnidada, 4, '.',",",3)?></b></td>
						</tr>
					    <?=$resultadoMetaAnidada?>
					<?php } ?>
					<tr>
					<td style="width: 85%;text-decoration: underline; background-color:#959494;color:white; text-align: left;" colspan="5"><b>COSTO DIRECTO (NDIRECTO)</b></td>
					<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>S/. <?=a_number_format($costoDirectoTotal, 4, '.',",",3)?></b></td>
				</tr>
				</tbody>
			</table>
			<br>
			<table id="tableResumen" style="width: 100%; font-size:12px;">
			<tr>
					<td style="width: 87%;background-color:#337ab7;color:white;"><b>PIE DE PRESUPUESTO</b></td>
					<td style="width: 13%;text-align: right;background-color:#337ab7;color:white;"><b>COSTO</b></td>
				</tr>
				<?php foreach($expedienteTecnico->piePresupuestoDirecta as $key => $value) { ?>
					<tr>
						<td style="width: 87%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><?=strtoupper(html_escape($value->descripcion))?> <span style="font-style: italic;">(<?=strtoupper(html_escape($value->variable))?>)</span> (<?=strtoupper(html_escape($value->macro))?>)</b></td>
						<td style="width: 13%;text-align: right;<?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>">S/. <?=a_number_format($value->monto, 2, '.',",",3)?></td>
					</tr>				
				<?php } ?>
			</table>
			<?php } ?>

		<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
			if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
							?>
			<br><span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN INDIRECTA</span><br><br>
			<?php } ?>
		<?php $costoDirectoTotal=0; ?>
			<table id="tableValorizacion" style="width:100%;">
				<thead>
					<tr>
						<th style="width:7%;">ÍTEM</th>
						<th style="width:50%;">DESCRIPCIÓN</th>
						<th style="width:10%;">UND.</th>
						<th style="width:10%;">METRADO</th>
						<th style="width:10%;">PRECIO (S/.)</th>
						<th style="width:13%;">PARCIAL (S/.)</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($expedienteTecnico->childComponenteIndirecta as $key => $value){ 
						$resultadoMetaAnidada='';
						$resultadoSumaAnidada=0;
							foreach($value->childMeta as $index => $item){ 
								$resultado=mostrarMetaAnidada($item, $expedienteTecnico, $costoDirectoTotal);
								$resultadoMetaAnidada.= $resultado['htmlT'];
								$resultadoSumaAnidada+=$resultado['sumaTemp'];
							 } 
						?>
						<tr>
							<td style="width:7%;"><b><i><?=$value->numeracion?></i></b></td>
							<td style="text-align: left;width:50%;"><b><i><?=html_escape($value->descripcion)?></i></b></td>
							<td style="width:10%;">---</td>
							<td style="width:10%;">---</td>
							<td style="width:10%;text-align: right;">---</td>
							<td style="width:13%;text-align: right;"><b><?=a_number_format($resultadoSumaAnidada, 4, '.',",",3)?></b></td>
						</tr>
					    <?=$resultadoMetaAnidada?>
					<?php } ?>
					<tr>
					<td style="width: 87%;text-decoration: underline; background-color:#959494;color:white; text-align: left;" colspan="5"><b>COSTO DIRECTO (NDIRECTO)</b></td>
					<td style="width: 13%;text-align: right;background-color:#959494;color:white;"><b>S/. <?=a_number_format($costoDirectoTotal, 4, '.',",",3)?></b></td>
				</tr>
				</tbody>
			</table>
			<br>
			<table id="tableResumen" style="width: 100%; font-size:12px;">
			<tr>
					<td style="width: 87%;background-color:#337ab7;color:white;"><b>PIE DE PRESUPUESTO</b></td>
					<td style="width: 13%;text-align: right;background-color:#337ab7;color:white;"><b>COSTO</b></td>
				</tr>
				<?php foreach($expedienteTecnico->piePresupuestoIndirecta as $key => $value) { ?>
					<tr>
						<td style="width: 87%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><?=strtoupper(html_escape($value->descripcion))?> <span style="font-style: italic;">(<?=strtoupper(html_escape($value->variable))?>)</span> (<?=strtoupper(html_escape($value->macro))?>)</b></td>
						<td style="width: 13%;text-align: right;<?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>">S/. <?=a_number_format($value->monto, 2, '.',",",3)?></td>
					</tr>				
				<?php } ?>
			</table>
			<?php } ?>
		</div>
	</body>
</html>