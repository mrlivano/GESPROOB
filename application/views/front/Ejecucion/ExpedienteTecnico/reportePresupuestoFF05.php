<!DOCTYPE html>
<html>
<head>
	<title>Formato FF-05</title>
</head>
<style>

	body
	{
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	}

	#tablaPresentacion td, #tablaPresentacion th
	{
		font-size: 10px;
		padding: 4px;
		text-align: left;
		vertical-align: middle;
		border-collapse: collapse;
	}

	#tablaContenido td, #tablaContenido th
	{
		border: 1px solid black;
		font-size: 10px;
		padding: 4px;
		text-align: left;
		vertical-align: middle;
		border-collapse: collapse;
	}
	#tablaContenido th
	{
		background-color:#337ab7;
		color:white;
	}

	#tablaResumen td, #tablaResumen th
	{
		border: 1px solid black;
		font-size: 10px;
		padding: 4px;
		text-align: left;
		vertical-align: middle;
		border-collapse: collapse;
	}

	table
	{
		border-collapse: collapse;
	}
</style>
<body>
	<table style="width: 100%;">
		<tr>
			<td style="width: 65px;">
				<img style="width: 60px;" src="./assets/images/peru.jpg">
			</td>
			<td id="header_texto">
				<div style="text-align: center; font-size: 13px;"><b>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</b></div>
				<div style="text-align: center; font-size: 12px;">"Año del Fortalecimiento de la Soberanía Nacional"</div>	
			</td>
			<td style="width: 65px;">
				<img style="width: 60px;" src="./assets/images/logoUniq.png">
			</td>
		</tr>
	</table>
	<div style="text-align: center; font-size: 13px;padding-top:2px;"><b>FORMATO FF-05</b></div>
	<div style="text-align: center; font-size: 13px;padding-bottom:10px;"><b>PRESUPUESTO RESUMEN</b></div>
	<div style="font-size: 8px;">
		<table id="tablaPresentacion" style="width: 100%">
			<tr>
				<td style="width: 8%;font-weight:bold;">PROYECTO</td>
				<td style="width: 92%">: <?=$MostraExpedienteNombre->nombre_pi;?> </td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">COMPONENTE</td>
				<td style="width: 92%">: <?=$MostraExpedienteNombre->componente_et;?> </td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">META</td>				
				<td style="width: 92%">: <?=$MostraExpedienteNombre->meta_et;?> </td>
			</tr>				
			<tr>
				<td style="width: 8%;font-weight:bold;">FTE. FTO</td>
				<td style="width: 92%">: <?=$MostraExpedienteNombre->fuente_financiamiento_et;?> </td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">MODALIDAD</td>
				<td style="width: 92%">: <?=$MostraExpedienteNombre->modalidad_ejecucion_et;?> </td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">AÑO</td>
				<td style="width: 92%">: <?=date('d/m/Y',strtotime($MostraExpedienteNombre->fecha_registro))?> </td>
			</tr>
		</table>    
	</div>

	<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
		<br>
		<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){ ?>
	<span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN DIRECTA</span><br><br>
	<?php } ?>
	<table id="tablaContenido" style="width: 100%; font-size:12px;">
		<tr>
			<th>ÍTEM</th>
			<th>EXPEDIENTE GENERAL GLOBAL</th>
			<th style="text-align: right;">COSTO TOTAL</th>
		</tr>
		<tbody>
			<?php foreach($MostraExpedienteTecnicoExpe->childComponente as $key => $value2){  ?>
				<tr>
					<td style="width: 2% !important"><b><?=$value2->numeracion?>.</b></td>
					<td style="width: 83%"><b><?=strtoupper(html_escape($value2->descripcion))?></b></td>
					<td style="width: 15%;text-align: right;">S/. <?=a_number_format($value2->costoComponente, 2, '.',",",3)?></td>
				</tr>
			<?php } ?>
			<tr>
			<th style="width: 10%;text-decoration: underline;background-color:#b5b5b5;color:white;" colspan="2"><b>COSTO DIRECTO (NDIRECTO)</b></th>
			<td style="width: 15%;text-align: right;background-color:#b5b5b5;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto, 2, '.',",",3)?></b></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table id="tablaResumen" style="width: 100%; font-size:12px;">
	<tr>
			<th style="width: 85%;background-color:#337ab7;color:white;"><b>PIE DE PRESUPUESTO</b></th>
			<th style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>COSTOS</b></th>
		</tr>
		<?php foreach($MostraExpedienteTecnicoExpe->piePresupuestoDirecta as $key => $value) { ?>
			<tr>
				<th style="width: 85%; <?= $value->id_presupuesto_ej==''?'background-color:#b5b5b5;color:white;':''?>"><b><?=strtoupper(html_escape($value->descripcion))?> (<?=strtoupper(html_escape($value->macro))?>)</b></th>
				<td style="width: 15%;text-align: right; <?= $value->id_presupuesto_ej==''?'background-color:#b5b5b5;color:white;':''?>">S/. <?=a_number_format($value->monto, 2, '.',",",3)?></td>
		
			</tr>				
		<?php } ?>
	</table>
	<br>
	<?php } ?>
	<!-- <table id="tablaResumen" style="width: 100%; font-size:12px;">
	<tr>
			<th style="width: 85%;text-decoration: underline;background-color:#337ab7;color:white;"><b>COSTO DIRECTO TOTAL</b></th>
			<td style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto, 2, '.',",",3)?></b></td>
		</tr>
		<tr>
			<th style="width: 85%;text-decoration: underline;background-color:#337ab7;color:white;"><b>COSTO INDIRECTO TOTAL</b></th>
			<td style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoIndirecto, 2, '.',",",3)?></b></td>
		</tr>
		<tr>
			<th style="width: 85%;background-color:#f8f8f8;"><b>COSTO TOTAL DE INVERSIÓN</b></th>
			<td style="width: 15%;text-align: right;background-color:#f8f8f8;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->presupuestoGeneral, 2, '.',",",3)?></b></td>
		</tr>
	</table> -->
	<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
		<br>
		<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){ ?>
	<span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN INDIRECTA</span><br><br>
	<?php } ?>
	<table id="tablaContenido" style="width: 100%; font-size:12px;">
		<tr>
			<th>ÍTEM</th>
			<th>EXPEDIENTE GENERAL GLOBAL</th>
			<th style="text-align: right;">COSTO TOTAL</th>
		</tr>
		<tbody>
			<?php foreach($MostraExpedienteTecnicoExpe->childComponenteIndirecta as $key => $value2){  ?>
				<tr>
					<td style="width: 2%"><b><?=$value2->numeracion?>.</b></td>
					<td style="width: 83%"><b><?=strtoupper(html_escape($value2->descripcion))?></b></td>
					<td style="width: 15%;text-align: right;">S/. <?=a_number_format($value2->costoComponente, 2, '.',",",3)?></td>
				</tr>
			<?php } ?>
			<tr>
			<th style="width: 10%;text-decoration: underline;background-color:#337ab7;color:white;" colspan="2"><b>COSTO DIRECTO TOTAL</b></th>
			<td style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
		</tr>

		<?php foreach($MostraExpedienteTecnicoExpe->childCostoDirectoTotalIndirecta as $key => $value) { ?>
			<tr>
			<td style="width: 2%"><b><?=$value2->numeracion?>.</b></td>
				<td style="width: 83%"><b><?=strtoupper(html_escape($value->descripcion))?></b></td>
				<td style="width: 15%;text-align: right;">S/. <?=a_number_format($value->costoComponente, 2, '.',",",3)?></td>
			</tr>				
		<?php } ?>
		<tr>
			<th style="width: 10%;text-decoration: underline;background-color:#337ab7;color:white;" colspan="2"><b>COSTO DIRECTO TOTAL TOTAL</b></th>
			<td style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoDirectoTotalIndirecta, 2, '.',",",3)?></b></td>
		</tr>
		</tbody>
	</table>
	<br>
	<table id="tablaResumen" style="width: 100%; font-size:12px;">
	<tr>
			<th style="width: 85%;"><b>COSTOS INDIRECTOS</b></th>
			<th style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>COSTO</b></td>
		</tr>
		<?php foreach($MostraExpedienteTecnicoExpe->childCostoIndirectoIndirecta as $key => $value) { ?>
			<tr>
				<th style="width: 85%"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
				<td style="width: 15%;text-align: right;">S/. <?=a_number_format($value->costoComponente, 2, '.',",",3)?></td>
			</tr>				
		<?php } ?>
		<tr>
			<th style="width: 85%;text-decoration: underline;background-color:#337ab7;color:white;"><b>COSTO INDIRECTO TOTAL</b></th>
			<td style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoIndirectoIndirecta, 2, '.',",",3)?></b></td>
		</tr>
		
	</table>
	<?php } ?>
	<br>
	<table id="tablaResumen" style="width: 100%; font-size:12px;">
	<tr>
			<th style="width: 85%;text-decoration: underline;background-color:#337ab7;color:white;"><b>COSTO DIRECTO TOTAL</b></th>
			<td style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoDirectoTotalIndirecta, 2, '.',",",3)?></b></td>
		</tr>
		<tr>
			<th style="width: 85%;text-decoration: underline;background-color:#337ab7;color:white;"><b>COSTO INDIRECTO TOTAL</b></th>
			<td style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoIndirectoIndirecta, 2, '.',",",3)?></b></td>
		</tr>
		<tr>
			<th style="width: 85%;background-color:#f8f8f8;"><b>COSTO TOTAL DE INVERSIÓN</b></th>
			<td style="width: 15%;text-align: right;background-color:#f8f8f8;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->presupuestoGeneralIndirecta, 2, '.',",",3)?></b></td>
		</tr>
	</table>
</body>
</html>
