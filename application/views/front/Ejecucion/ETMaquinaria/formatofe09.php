<!DOCTYPE html>
<html>
<head>
	<title>Formato FE-09</title>
	<style>
	body
	{
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	}
	table
	{
		border-collapse: collapse;
		color: black;
	}
	#tablaMaquinaria td, #tablaMaquinaria th
	{
		border:1px solid black;
		font-size: 8px;
		padding: 2px 5px;
		vertical-align: middle;
		text-transform: uppercase;
		text-align:center;
	}
	#tablaMaquinaria th
	{
		background-color:#2e6da4;
		color:white;
		text-align:center;
	}	
	#tablaPresentacion td
	{
		font-size: 8px;
		padding: 2px;
		text-align: left;
		vertical-align: middle;
		text-transform: uppercase;
	}
	@page 
	{ 
		margin-bottom: 150px;
	}
</style>
</head>
<body>
	<?php foreach ($listadoMaquinaria as $key => $value) { ?>
	<div style="page-break-after:always;">
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
		<div style="text-align: center; font-size: 13px;padding-bottom:6px;text-transform:uppercase;"><b>FORMATO FE-09 <br> MAQUINARIA <?=$value->tipo?> <br> HORAS TRABAJADAS</b></div>
		<div style="font-size: 8px;">
			<p><?=date('d/m/Y H:i:s')?></p>
			<table id="tablaPresentacion" style="width: 100%">
				<tr>
					<td style="width: 8%;font-weight:bold;">PROYECTO</td>
					<td style="width: 92%">: <?=@$proyectoInversion->nombre_pi?> </td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">COMPONENTE</td>
					<td style="width: 92%">: <?=@$proyectoInversion->componente_et?> </td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">SUM META</td>				
					<td style="width: 92%">: <?=@$proyectoInversion->meta_et?> </td>
				</tr>				
				<tr>
					<td style="width: 8%;font-weight:bold;">MODALIDAD</td>
					<td style="width: 92%">: <?=@$proyectoInversion->modalidad_ejecucion_et?> </td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">FECHA</td>
					<td style="width: 92%">: <?=@$fecha?></td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">MAQUINARIA</td>
					<td style="width: 92%">: <?=@$value->maquinaria?> </td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">POTENCIA</td>				
					<td style="width: 92%">: <?=@$value->potencia?> </td>
				</tr>				
				<tr>
					<td style="width: 8%;font-weight:bold;">CAPACIDAD</td>
					<td style="width: 92%">: <?=@$value->capacidad?> </td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">PLACA N° MOTOR</td>
					<td style="width: 92%">: <?=@$value->nro_placa_motor?></td>
				</tr>
			</table>    
		</div>
		<br>
		<table id="tablaMaquinaria" style="width: 100%;">
			<thead>
				<tr>
					<th rowspan="2">FECHA</th>
					<th rowspan="2">TRABAJOS REALIZADOS</th>
					<th colspan="3">HORAS TRABAJADAS (HM)</th>
				</tr>
				<tr>
					<th>ACUMULADO ANTERIOR</th>
					<th>MES</th>
					<th>ACUMULADO ACTUAL</th>
				</tr>
			</thead>
			<tbody>
				<?php $sumatoriaMensual=0;
				foreach ($value->childEjecucion as $key => $childMaquinaria) 
				{
					$sumatoriaMensual+=$childMaquinaria->acumuladomensual;
					 
				?>				
				<tr>
					<td style="width:5%;"><?=date('d/m/Y', strtotime($childMaquinaria->fecha))?></td>
					<td style="width:50%;text-align:left;"><?=$childMaquinaria->trabajos_realizados?></td>
					<td style="width:15%;"></td>
					<td style="width:15%;"><?=$childMaquinaria->acumuladomensual?></td>
					<td style="width:15%;"></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="2" style="text-align:left;">TOTAL HORAS TRABAJADAS</td>
					<td><?=@$value->ejecucionanterior?></td>
					<td><?=@$sumatoriaMensual?></td>
					<td><?=@$value->ejecucionanterior+@$sumatoriaMensual?></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:left;">PRECIO POR ALQUILER O DEPRECIACIÓN HORARIA (S/.)</td>
					<td><?=@$value->costo_hora?></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:left;">TOTAL</td>
					<td><?=number_format((@$value->ejecucionanterior+@$sumatoriaMensual)*@$value->costo_hora, 2, '.', ',')?></td>
				</tr>				
			</tbody>
		</table>
	</div>
	<?php } ?>
</body>
</html>