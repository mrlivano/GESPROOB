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

	#footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 100px; }
   	 #footer .page:after { content: counter(page, upper-roman); }
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
	<div id="footer">
		<div style="text-align: left; font-size: 12px;">Usuario: <?php echo $this->session->userdata('nombreUsuario')?> | fecha:<?php echo date("d/m/Y");?></div>
	</div>
	<div style="text-align: center; font-size: 13px;padding-top:2px;"><b>FORMATO FF-05</b></div>
	<div style="text-align: center; font-size: 13px;padding-bottom:10px;"><b>PRESUPUESTO RESUMEN</b></div>
	<div style="font-size: 8px;">
		<table id="tablaPresentacion" style="width: 100%">
			<tr>
				<td style="width: 8%;font-weight:bold;">PROYECTO</td>
				<td style="width: 92%">: <?=$MostraExpedienteNombre->nombre_pi;?> </td>
			</tr>			
			<tr>
				<td style="width: 8%;font-weight:bold;">FTE. FTO</td>
				<td style="width: 92%">: <?=$MostraExpedienteNombre->fuente_financiamiento_et;?> </td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">MODALIDAD</td>
				<td style="width: 92%">: <?=$MostraExpedienteNombre->modalidad_ejecucion_et;?> </td>
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
			<th>EXPEDIENTE GENERAL</th>
			<th style="text-align: right;">COSTO TOTAL</th>
		</tr>
		<tbody>
			<?php foreach($MostraExpedienteTecnicoExpe->childComponente as $key => $value2){  ?>
				<tr>
					<td style="width: 83%"><b><?=strtoupper(html_escape($value2->descripcion))?></b></td>
					<td style="width: 15%;text-align: right;">S/. <?=a_number_format($value2->costoComponente, 2, '.',",",3)?></td>
				</tr>
			<?php } ?>
			<tr>
			<th style="width: 10%;text-decoration: underline;background-color:#959494;color:white;"><b>COSTO DIRECTO</b></th>
			<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto, 2, '.',",",3)?></b></td>
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
				<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
				<td style="width: 15%;text-align: right; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>">S/. <?=a_number_format($value->monto, 2, '.',",",3)?></td>
		
			</tr>				
		<?php } ?>
	</table>
	<br>
	<?php } ?>
	<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
		<br>
		<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){ ?>
	<table style='page-break-after:always;'></br></table> 
	<span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN INDIRECTA</span><br><br>
	<?php } ?>
	<table id="tablaContenido" style="width: 100%; font-size:12px;">
		<tr>
			<th>EXPEDIENTE GENERAL</th>
			<th style="text-align: right;">COSTO TOTAL</th>
		</tr>
		<tbody>
			<?php foreach($MostraExpedienteTecnicoExpe->childComponenteIndirecta as $key => $value2){  ?>
				<tr>
					<td style="width: 83%"><b><?=strtoupper(html_escape($value2->descripcion))?></b></td>
					<td style="width: 15%;text-align: right;">S/. <?=a_number_format($value2->costoComponente, 2, '.',",",3)?></td>
				</tr>
			<?php } ?>
			<tr>
			<th style="width: 10%;text-decoration: underline;background-color:#959494;color:white;"><b>COSTO DIRECTO</b></th>
			<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
		</tr>
		</tbody>
	</table>
	<br>
	<table id="tablaResumen" style="width: 100%; font-size:12px;">
	<tr>
			<th style="width: 85%;background-color:#337ab7;color:white;"><b>PIE DE PRESUPUESTO</b></th>
			<th style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>COSTOS</b></th>
		</tr>
		<?php foreach($MostraExpedienteTecnicoExpe->piePresupuestoIndirecta as $key => $value) { ?>
			<tr>
				<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;': ($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
				<td style="width: 15%;text-align: right; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>">S/. <?=a_number_format($value->monto, 2, '.',",",3)?></td>
		
			</tr>				
		<?php } ?>
	</table>
	<?php } ?>

	<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
		<br>
	<table style='page-break-after:always;'></br></table> 
	<span style="font-weight:bold; font-size:0.7rem;">RESUMEN DE PROYECTO</span><br><br>

	<table id="tablaContenido" style="width: 100%; font-size:12px;">
		<tr>
			<th>EXPEDIENTE GENERAL</th>
			<th style="text-align: right;">COSTO TOTAL</th>
		</tr>
		<tbody>
		<?php foreach($MostraExpedienteTecnicoExpe->childComponente as $key => $value2){  ?>
				<tr>
					<td style="width: 83%"><b><?=strtoupper(html_escape($value2->descripcion))?></b></td>
					<td style="width: 15%;text-align: right;">S/. <?=a_number_format($value2->costoComponente, 2, '.',",",3)?></td>
				</tr>
			<?php } ?>
			<?php foreach($MostraExpedienteTecnicoExpe->childComponenteIndirecta as $key => $value2){  ?>
				<tr>
					<td style="width: 83%"><b><?=strtoupper(html_escape($value2->descripcion))?></b></td>
					<td style="width: 15%;text-align: right;">S/. <?=a_number_format($value2->costoComponente, 2, '.',",",3)?></td>
				</tr>
			<?php } ?>
			<tr>
			<th style="width: 10%;text-decoration: underline;background-color:#959494;color:white;"><b>COSTO DIRECTO TOTAL</b></th>
			<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto+$MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
		</tr>
		</tbody>
	</table>
	<br>
	<table id="tablaResumen" style="width: 100%; font-size:12px;">
	<tr>
			<th style="width: 85%;background-color:#337ab7;color:white;"><b>PIE DE PRESUPUESTO</b></th>
			<th style="width: 15%;text-align: right;background-color:#337ab7;color:white;"><b>COSTOS</b></th>
		</tr>
		<?php 
		$piePresupuestoR= array();
		$piePresupuesto = array_filter(array_merge($MostraExpedienteTecnicoExpe->piePresupuestoDirecta,$MostraExpedienteTecnicoExpe->piePresupuestoIndirecta),function ($e){return $e->id_presupuesto_ej!=0 && $e->descripcion!='PRESUPUESTO TOTAL';});
		foreach ($piePresupuesto as $key => $value) {
			$val = $value->variable;
			$result=array_filter($piePresupuesto,function ($e) use($val){return $e->variable==$val;});
			if(count($result)>0){
			$arrayRed=array_reduce($result,function ($s,$e){ (!empty($s)>0)?$s->monto=($s->monto+$e->monto):$s=$e; return $s;},array());
			array_push($piePresupuestoR,$arrayRed);
				if(count($result)>1){
					$piePresupuesto=array_filter($piePresupuesto,function ($e) use($val){return $e->variable!=$val;});
				}
			}
		 }
		
		$piePresupuestoTotal = array_reduce(array_filter(array_merge($MostraExpedienteTecnicoExpe->piePresupuestoDirecta,$MostraExpedienteTecnicoExpe->piePresupuestoIndirecta),function ($e){return $e->id_presupuesto_ej==0 && $e->descripcion=='PRESUPUESTO TOTAL';}),function ($s,$e){ (!empty($s)>0)?$s->monto=($s->monto+$e->monto):$s=$e; return $s;},array());

		foreach($piePresupuestoR as $key => $value) { ?>
			<tr>
				<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
				<td style="width: 15%;text-align: right; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>">S/. <?=a_number_format($value->monto, 2, '.',",",3)?></td>
		
			</tr>				
		<?php } ?>
			<tr>
				<th style="width: 85%; <?= ($piePresupuestoTotal->id_presupuesto_ej=='' && $piePresupuestoTotal->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;': ($piePresupuestoTotal->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($piePresupuestoTotal->descripcion))?></b></th>
				<td style="width: 15%;text-align: right; <?= ($piePresupuestoTotal->id_presupuesto_ej=='' && $piePresupuestoTotal->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($piePresupuestoTotal->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>">S/. <?=a_number_format($piePresupuestoTotal->monto, 2, '.',",",3)?></td>
		
			</tr>		
	</table>
	<?php } ?>
</body>
</html>
