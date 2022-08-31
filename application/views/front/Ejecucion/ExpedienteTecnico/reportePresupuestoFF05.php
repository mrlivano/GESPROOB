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
		<div style="text-align: left; font-size: 10px;">Usuario: <?php echo $this->session->userdata('nombreUsuario')?> | fecha: <?php echo date("d/m/Y");?></div>
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

	<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA'){?>
			<br>
			<table id="tablaContenido" style="width: 100%; font-size:12px;">
				<tr>
					<th style="text-align: center;">DESCRIPCIÓN</th>
					<th style="text-align: center;">SUB TOTAL</th>
				</tr>
				<tbody>
					<tr>
						<th style="width: 10%;background-color:#959494;color:white; text-align: center;"><b>COSTO DIRECTO</b></th>
						<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto, 2, '.',",",3)?></b></td>
					</tr>
					<?php $i=0; foreach($MostraExpedienteTecnicoExpe->childComponente as $key => $value){  
						foreach ($value->childMeta as $index => $item){ $i+=1;?>
						<tr>
							<td style="width: 83%"><b>COMPONENTE <?=$i?>: <?=strtoupper(html_escape($item->desc_meta))?></b></td>
							<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
						</tr>
					<?php } } ?>
				</tbody>
			</table>
			<br>
			<table id="tablaResumen" style="width: 100%; font-size:12px;">
			<tr>
					<th style="width: 85%;background-color:#959494;color:white;text-align: center;"><b>COSTO INDIRECTO</b></th>
					<th style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>SUB TOTAL</b></th>
				</tr>
				<?php foreach($MostraExpedienteTecnicoExpe->piePresupuestoDirecta as $key => $value) { ?>
					<tr>
						<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
						<td style="width: 15%;text-align: right; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
					</tr>				
				<?php } ?>
			</table>
			<br>
	<?php } else if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA'){?>
			<br>
			<table id="tablaContenido" style="width: 100%; font-size:12px;">
			<tr>
					<th style="text-align: center;">DESCRIPCIÓN</th>
					<th style="text-align: center;">SUB TOTAL</th>
				</tr>
				<tr>
					<th style="width: 10%;background-color:#959494;color:white; text-align: center;"><b>COSTO DIRECTO</b></th>
					<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
				</tr>
				<tbody>
					<?php $i=0; foreach($MostraExpedienteTecnicoExpe->childComponenteIndirecta as $key => $value){  
						foreach ($value->childMeta as $index => $item){ $i+=1;?>
						<tr>
							<td style="width: 83%"><b>COMPONENTE <?=$i?>: <?=strtoupper(html_escape($item->desc_meta))?></b></td>
							<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
						</tr>
					<?php } } ?>
				</tbody>
			</table>
			<br>
			<table id="tablaResumen" style="width: 100%; font-size:12px;">
			<tr>
					<th style="width: 85%;background-color:#959494;color:white;text-align: center;"><b>COSTO INDIRECTO</b></th>
					<th style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>SUB TOTAL</b></th>
				</tr>
				<?php foreach($MostraExpedienteTecnicoExpe->piePresupuestoIndirecta as $key => $value) { ?>
					<tr>
						<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;': ($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
						<td style="width: 15%;text-align: right; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
				
					</tr>				
				<?php } ?>
			</table>
	<?php } else if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
		<br>
		<?php if($prioridadEjecucion->tipo_ejecucion=='ADMINISTRACION DIRECTA'){ ?>
			<span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN DIRECTA</span><br><br>
			
			<table id="tablaContenido" style="width: 100%; font-size:12px;">
				<tr>
					<th style="text-align: center;">DESCRIPCIÓN</th>
					<th style="text-align: center;">SUB TOTAL</th>
				</tr>
				<tbody>
					<tr>
						<th style="width: 10%;background-color:#959494;color:white; text-align: center;"><b>COSTO DIRECTO</b></th>
						<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto, 2, '.',",",3)?></b></td>
					</tr>
					<?php $i=0; foreach($MostraExpedienteTecnicoExpe->childComponente as $key => $value){  
						foreach ($value->childMeta as $index => $item){ $i+=1;?>
						<tr>
							<td style="width: 83%"><b>COMPONENTE <?=$i?>: <?=strtoupper(html_escape($item->desc_meta))?></b></td>
							<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
						</tr>
					<?php } } ?>
				</tbody>
			</table>
			<br>
			<table id="tablaResumen" style="width: 100%; font-size:12px;">
			<tr>
					<th style="width: 85%;background-color:#959494;color:white;text-align: center;"><b>COSTO INDIRECTO</b></th>
					<th style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>SUB TOTAL</b></th>
				</tr>
				<?php foreach($MostraExpedienteTecnicoExpe->piePresupuestoDirecta as $key => $value) { ?>
					<tr>
						<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
						<td style="width: 15%;text-align: right; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
					</tr>				
				<?php } ?>
			</table>
			<br>
		<!--  -->
		<br>
			<table style='page-break-after:always;'></br></table> 
			<span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN INDIRECTA</span><br><br>
			<table id="tablaContenido" style="width: 100%; font-size:12px;">
			<tr>
					<th style="text-align: center;">DESCRIPCIÓN</th>
					<th style="text-align: center;">SUB TOTAL</th>
				</tr>
				<tr>
					<th style="width: 10%;background-color:#959494;color:white; text-align: center;"><b>COSTO DIRECTO</b></th>
					<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
				</tr>
				<tbody>
					<?php $i=0; foreach($MostraExpedienteTecnicoExpe->childComponenteIndirecta as $key => $value){  
						foreach ($value->childMeta as $index => $item){ $i+=1;?>
						<tr>
							<td style="width: 83%"><b>COMPONENTE <?=$i?>: <?=strtoupper(html_escape($item->desc_meta))?></b></td>
							<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
						</tr>
					<?php } } ?>
				</tbody>
			</table>
			<br>
			<table id="tablaResumen" style="width: 100%; font-size:12px;">
			<tr>
					<th style="width: 85%;background-color:#959494;color:white;text-align: center;"><b>COSTO INDIRECTO</b></th>
					<th style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>SUB TOTAL</b></th>
				</tr>
				<?php foreach($MostraExpedienteTecnicoExpe->piePresupuestoIndirecta as $key => $value) { ?>
					<tr>
						<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;': ($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
						<td style="width: 15%;text-align: right; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
				
					</tr>				
				<?php } ?>
			</table>
				<!--  -->
				<br>
				<table style='page-break-after:always;'></br></table> 
				<span style="font-weight:bold; font-size:0.7rem;">RESUMEN DE PROYECTO</span><br><br>

				<table id="tablaContenido" style="width: 100%; font-size:12px;">
					<tr>
						<th style="text-align: center;">DESCRIPCIÓN</th>
						<th style="text-align: center;">ADMINISTRACIÓN DIRECTA</th>
						<th style="text-align: center;">ADMINISTRACIÓN INDIRECTA (POR CONTRATA)</th>
						<th style="text-align: center;">SUB TOTAL</th>
					</tr>
					<tbody>
					<tr>
						<th style="width: 10%;background-color:#959494;color:white;"><b>COSTO DIRECTO</b></th>
						<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto, 2, '.',",",3)?></b></td>
						<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
						<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto+$MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
					</tr>
					<?php $i=0; foreach($MostraExpedienteTecnicoExpe->childComponente as $key => $value){  
						foreach ($value->childMeta as $index => $item){ $i+=1;?>
							<tr>
							<td style="width: 83%"><b>COMPONENTE <?=$i?>: <?=strtoupper(html_escape($item->desc_meta))?></b></td>
								<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
								<td></td>
								<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
							</tr>
						<?php }} ?>
						<?php foreach($MostraExpedienteTecnicoExpe->childComponenteIndirecta as $key => $value){  
							foreach ($value->childMeta as $index => $item){ $i+=1;?>
							<tr>
							<td style="width: 83%"><b>COMPONENTE <?=$i?>: <?=strtoupper(html_escape($item->desc_meta))?></b></td>
							<td></td>
							<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
							<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
							</tr>
						<?php }} ?>
					</tbody>
				</table>
				<br>
				<table id="tablaResumen" style="width: 100%; font-size:12px;">
					<?php 
					$piePresupuestoR= array();
					$pieD= array();
					$pieI= array();
					$piePresupuestoD = array_filter($MostraExpedienteTecnicoExpe->piePresupuestoDirecta,function ($e){return $e->id_presupuesto_ej!=0 && $e->descripcion!='PRESUPUESTO TOTAL' && $e->gasto=='1';});
					$piePresupuestoI = array_filter($MostraExpedienteTecnicoExpe->piePresupuestoIndirecta,function ($e){return $e->id_presupuesto_ej!=0 && $e->descripcion!='PRESUPUESTO TOTAL' && $e->gasto=='1';});

					$piePresupuesto = array_merge($piePresupuestoD,$piePresupuestoI);
					foreach ($piePresupuesto as $key => $value) {

						$val = $value->variable;
						$result=array_filter($piePresupuesto,function ($e) use($val){return $e->variable==$val && $e->modalidad_ejecucion==1;});

						$resultI=array_filter($piePresupuesto,function ($e) use($val){return $e->variable==$val && $e->modalidad_ejecucion==2;});
						if(count($result)+count($resultI)>0){
						
						$arrayRed=array_reduce($result,function ($s,$e){ (!empty($s)>0)?$s->monto=($s->monto+$e->monto):$s=$e; return $s;},array());
						$arrayRedI=array_reduce($resultI,function ($s,$e){ (!empty($s)>0)?$s->monto=($s->monto+$e->monto):$s=$e; return $s;},array());
						if($arrayRed && $arrayRedI){
							array_push($pieD,$arrayRed);
							array_push($pieI,$arrayRedI);
							$arrayRed->indirecta=$arrayRedI->monto;		
							array_push($piePresupuestoR,$arrayRed);
							
						}
						else if($arrayRed){
							array_push($pieD,$arrayRed);
							array_push($piePresupuestoR,$arrayRed);
						}
						else if($arrayRedI){
							array_push($pieI,$arrayRedI);
							array_push($piePresupuestoR,$arrayRedI);
						}
						if((count($result)+count($resultI))>1){
							$piePresupuesto=array_filter($piePresupuesto,function ($e) use($val){return $e->variable!=$val;});
						}
						}
					}
					$piePresupuestoDTotal=array_reduce($pieD,function ($a, $b){ return ($a + $b->monto);}, 0);
					$piePresupuestoITotal=array_reduce($pieI,function ($a,$b){ return ($a + $b->monto);}, 0);
					?>
					<tr>
					<th style="width: 10%;background-color:#959494;color:white;"><b>COSTO INDIRECTO</b></th>				
					<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($piePresupuestoDTotal, 2, '.',",",3)?></b></td>
					<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($piePresupuestoITotal, 2, '.',",",3)?></b></td>
					<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($piePresupuestoDTotal+$piePresupuestoITotal, 2, '.',",",3)?></b></td>
				
					</tr>		
					<?php
					foreach($piePresupuestoR as $key => $value) { ?>
						<tr>
							<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
							<?php if($value->modalidad_ejecucion==1){ ?>
								<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
								<?php if(!empty($value->indirecta)) { ?>
									<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->indirecta, 2, '.',",",3)?></td>
									<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->monto+$value->indirecta, 2, '.',",",3)?></td>
								<?php } else{?>
									<td style="width: 15%;text-align: right; background-color:white;"></td>
									<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
								<?php } ?>
								
							<?php } else if($value->modalidad_ejecucion==2){ ?>
								<td style="width: 15%;text-align: right; background-color:white;"></td>
								<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
								<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
							<?php } ?>
					
						</tr>				
					<?php } ?>
					<tr>
								<th style="width: 85%; background-color:#959494;color:white;"><b>PRESUPUESTO TOTAL</b></th>
								<td style="width: 15%;text-align: right; background-color:#959494;color:white;"><?=a_number_format($MostraExpedienteTecnicoExpe->costo_total_inv_et_ad, 2, '.',",",3)?></td>
								<td style="width: 15%;text-align: right; background-color:#959494;color:white;"><?=a_number_format($MostraExpedienteTecnicoExpe->costo_total_inv_et_ai, 2, '.',",",3)?></td>
								<td style="width: 15%;text-align: right; background-color:#959494;color:white;"><?=a_number_format($MostraExpedienteTecnicoExpe->costo_total_inv_et, 2, '.',",",3)?></td>
						</tr>		 
				</table>
				<br>
				<table id="tablaResumen" style="width: 100%; font-size:12px;">
						<tr>
								<th style="width: 85%; background-color:#959494;color:white;"><b>PRESUPUESTO TOTAL DEL PROYECTO</b></th>
								<td style="width: 15%;text-align: right; background-color:#959494;color:white;"><?=a_number_format($MostraExpedienteTecnicoExpe->costo_total_inv_et, 2, '.',",",3)?></td>
							
						</tr>		
				</table>
			<?php } else{ ?>
			
			<span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN INDIRECTA</span><br><br>
			<table id="tablaContenido" style="width: 100%; font-size:12px;">
			<tr>
					<th style="text-align: center;">DESCRIPCIÓN</th>
					<th style="text-align: center;">SUB TOTAL</th>
				</tr>
				<tr>
					<th style="width: 10%;background-color:#959494;color:white; text-align: center;"><b>COSTO DIRECTO</b></th>
					<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
				</tr>
				<tbody>
					<?php $i=0; foreach($MostraExpedienteTecnicoExpe->childComponenteIndirecta as $key => $value){  
						foreach ($value->childMeta as $index => $item){ $i+=1;?>
						<tr>
							<td style="width: 83%"><b>COMPONENTE <?=$i?>: <?=strtoupper(html_escape($item->desc_meta))?></b></td>
							<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
						</tr>
					<?php } } ?>
				</tbody>
			</table>
			<br>
			<table id="tablaResumen" style="width: 100%; font-size:12px;">
			<tr>
					<th style="width: 85%;background-color:#959494;color:white;text-align: center;"><b>COSTO INDIRECTO</b></th>
					<th style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>SUB TOTAL</b></th>
				</tr>
				<?php foreach($MostraExpedienteTecnicoExpe->piePresupuestoIndirecta as $key => $value) { ?>
					<tr>
						<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;': ($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
						<td style="width: 15%;text-align: right; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
				
					</tr>				
				<?php } ?>
			</table>
			<!--  -->
			<br>
			<table style='page-break-after:always;'></br></table> 
			<span style="font-weight:bold; font-size:0.7rem;">ADMINISTRACIÓN DIRECTA</span><br><br>
			
			<table id="tablaContenido" style="width: 100%; font-size:12px;">
				<tr>
					<th style="text-align: center;">DESCRIPCIÓN</th>
					<th style="text-align: center;">SUB TOTAL</th>
				</tr>
				<tbody>
					<tr>
						<th style="width: 10%;background-color:#959494;color:white; text-align: center;"><b>COSTO DIRECTO</b></th>
						<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto, 2, '.',",",3)?></b></td>
					</tr>
					<?php $i=0; foreach($MostraExpedienteTecnicoExpe->childComponente as $key => $value){  
						foreach ($value->childMeta as $index => $item){ $i+=1;?>
						<tr>
							<td style="width: 83%"><b>COMPONENTE <?=$i?>: <?=strtoupper(html_escape($item->desc_meta))?></b></td>
							<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
						</tr>
					<?php } } ?>
				</tbody>
			</table>
			<br>
			<table id="tablaResumen" style="width: 100%; font-size:12px;">
			<tr>
					<th style="width: 85%;background-color:#959494;color:white;text-align: center;"><b>COSTO INDIRECTO</b></th>
					<th style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>SUB TOTAL</b></th>
				</tr>
				<?php foreach($MostraExpedienteTecnicoExpe->piePresupuestoDirecta as $key => $value) { ?>
					<tr>
						<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
						<td style="width: 15%;text-align: right; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
					</tr>				
				<?php } ?>
			</table>

				<!--  -->
				<br>
				<table style='page-break-after:always;'></br></table> 
				<span style="font-weight:bold; font-size:0.7rem;">RESUMEN DE PROYECTO</span><br><br>

				<table id="tablaContenido" style="width: 100%; font-size:12px;">
					<tr>
						<th style="text-align: center;">DESCRIPCIÓN</th>
						<th style="text-align: center;">ADMINISTRACIÓN INDIRECTA (POR CONTRATA)</th>
						<th style="text-align: center;">ADMINISTRACIÓN DIRECTA</th>
						<th style="text-align: center;">SUB TOTAL</th>
					</tr>
					<tbody>
					<tr>
						<th style="width: 10%;background-color:#959494;color:white;"><b>COSTO DIRECTO</b></th>
						<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
						<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto, 2, '.',",",3)?></b></td>
						<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($MostraExpedienteTecnicoExpe->costoDirecto+$MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
					</tr>
					<?php $i=0; 
							foreach($MostraExpedienteTecnicoExpe->childComponenteIndirecta as $key => $value){  
							foreach ($value->childMeta as $index => $item){ $i+=1;?>
							<tr>
								<td style="width: 83%"><b>COMPONENTE <?=$i?>: <?=strtoupper(html_escape($item->desc_meta))?></b></td>
								<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
								<td></td>
								<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
							</tr>
						<?php }}
							foreach($MostraExpedienteTecnicoExpe->childComponente as $key => $value){  
							foreach ($value->childMeta as $index => $item){ $i+=1;?>
								<tr>
									<td style="width: 83%"><b>COMPONENTE <?=$i?>: <?=strtoupper(html_escape($item->desc_meta))?></b></td>
									<td></td>
									<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
									<td style="width: 15%;text-align: right;"><?=a_number_format($item->costoMeta, 2, '.',",",3)?></td>
								</tr>
							<?php }} ?>
					</tbody>
				</table>
				<br>
				<table id="tablaResumen" style="width: 100%; font-size:12px;">
					<?php 
					$piePresupuestoR= array();
					$pieD= array();
					$pieI= array();
					$piePresupuestoD = array_filter($MostraExpedienteTecnicoExpe->piePresupuestoDirecta,function ($e){return $e->id_presupuesto_ej!=0 && $e->descripcion!='PRESUPUESTO TOTAL' && $e->gasto=='1';});
					$piePresupuestoI = array_filter($MostraExpedienteTecnicoExpe->piePresupuestoIndirecta,function ($e){return $e->id_presupuesto_ej!=0 && $e->descripcion!='PRESUPUESTO TOTAL' && $e->gasto=='1';});

					$piePresupuesto = array_merge($piePresupuestoI,$piePresupuestoD);
					foreach ($piePresupuesto as $key => $value) {

						$val = $value->variable;
						$result=array_filter($piePresupuesto,function ($e) use($val){return $e->variable==$val && $e->modalidad_ejecucion==1;});
						$resultI=array_filter($piePresupuesto,function ($e) use($val){return $e->variable==$val && $e->modalidad_ejecucion==2;});

						if(count($result)+count($resultI)>0){
						
						$arrayRed=array_reduce($result,function ($s,$e){ (!empty($s)>0)?$s->monto=($s->monto+$e->monto):$s=$e; return $s;},array());
						$arrayRedI=array_reduce($resultI,function ($s,$e){ (!empty($s)>0)?$s->monto=($s->monto+$e->monto):$s=$e; return $s;},array());
						if($arrayRed && $arrayRedI){
							array_push($pieD,$arrayRed);
							array_push($pieI,$arrayRedI);
							$arrayRedI->directa=$arrayRed->monto;		
							array_push($piePresupuestoR,$arrayRedI);
							
						}
						else if($arrayRed){
							array_push($pieD,$arrayRed);
							array_push($piePresupuestoR,$arrayRed);
						}
						else if($arrayRedI){
							array_push($pieI,$arrayRedI);
							array_push($piePresupuestoR,$arrayRedI);
						}
						if((count($result)+count($resultI))>1){
							$piePresupuesto=array_filter($piePresupuesto,function ($e) use($val){return $e->variable!=$val;});
						}
						}
					}
					$piePresupuestoDTotal=array_reduce($pieD,function ($a, $b){ return ($a + $b->monto);}, 0);
					$piePresupuestoITotal=array_reduce($pieI,function ($a,$b){ return ($a + $b->monto);}, 0);
					?>
					<tr>
					<th style="width: 10%;background-color:#959494;color:white;"><b>COSTO INDIRECTO</b></th>		
					<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($piePresupuestoITotal, 2, '.',",",3)?></b></td>		
					<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($piePresupuestoDTotal, 2, '.',",",3)?></b></td>
					<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b><?=a_number_format($piePresupuestoDTotal+$piePresupuestoITotal, 2, '.',",",3)?></b></td>
				
					</tr>		
					<?php
					foreach($piePresupuestoR as $key => $value) { ?>
						<tr>
							<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
							<?php if($value->modalidad_ejecucion==2){ ?>
								<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
								<?php if(!empty($value->directa)) { ?>
									<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->directa, 2, '.',",",3)?></td>
									<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->monto+$value->directa, 2, '.',",",3)?></td>
								<?php } else{?>
									<td style="width: 15%;text-align: right; background-color:white;"></td>
									<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
								<?php } ?>
								
							<?php } else if($value->modalidad_ejecucion==1){ ?>
								<td style="width: 15%;text-align: right; background-color:white;"></td>
								<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
								<td style="width: 15%;text-align: right; background-color:white;"><?=a_number_format($value->monto, 2, '.',",",3)?></td>
							<?php } ?>
					
						</tr>				
					<?php } ?>
					<tr>
								<th style="width: 85%; background-color:#959494;color:white;"><b>PRESUPUESTO TOTAL</b></th>
								<td style="width: 15%;text-align: right; background-color:#959494;color:white;"><?=a_number_format($MostraExpedienteTecnicoExpe->costo_total_inv_et_ai, 2, '.',",",3)?></td>
								<td style="width: 15%;text-align: right; background-color:#959494;color:white;"><?=a_number_format($MostraExpedienteTecnicoExpe->costo_total_inv_et_ad, 2, '.',",",3)?></td>
								<td style="width: 15%;text-align: right; background-color:#959494;color:white;"><?=a_number_format($MostraExpedienteTecnicoExpe->costo_total_inv_et, 2, '.',",",3)?></td>
						</tr>		 
				</table>
				<br>
				<table id="tablaResumen" style="width: 100%; font-size:12px;">
						<tr>
								<th style="width: 85%; background-color:#959494;color:white;"><b>PRESUPUESTO TOTAL DEL PROYECTO</b></th>
								<td style="width: 15%;text-align: right; background-color:#959494;color:white;"><?=a_number_format($MostraExpedienteTecnicoExpe->costo_total_inv_et, 2, '.',",",3)?></td>
							
						</tr>		
				</table>
			<?php } ?>




		
	<?php } ?>
</body>
</html>
