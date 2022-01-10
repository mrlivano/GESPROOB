<!DOCTYPE html>
<html>
<head>
	<title>FORMATO FE-11</title>
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
	#tablaConsumoMaquinaria td, #tablaConsumoMaquinaria th
	{
		border:1px solid black;
		font-size: 8px;
		padding: 2px 5px;
		vertical-align: middle;
		text-transform: uppercase;
		text-align:center;
	}
	#tablaConsumoMaquinaria th
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
					<div style="text-align: center; font-size: 13px;"><b>GOBIERNO REGIONAL DE APURÍMAC</b></div>
					<div style="text-align: center; font-size: 12px;">"Año del Diálogo y la Reconciliación Nacional"</div>	
				</td>
				<td style="width: 65px;">
					<img style="width: 60px;" src="./assets/images/apurimac.png">
				</td>
			</tr>
		</table>
		<div style="text-align: center; font-size: 13px;padding-bottom:6px;text-transform:uppercase;"><b>FORMATO FE-11 <br> CONSUMO DE COMBUSTIBLE, LUBRICANTES, REPUESTOS Y OTROS DE MAQUINARIA PROPIA <?=$value->tipo?></b></div>
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
		<table id="tablaConsumoMaquinaria" style="width: 100%;">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Tipo</th>
					<th>Descripcion</th>
					<th>Unidad de Medida</th>
					<th>Cantidad</th>
					<th>Precio Unitario</th>
					<th>Parcial</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$sumatoria=0;
			foreach ($value->childConsumo as $key => $item) {
				$sumatoria+=$item->precio_parcial;?>
				<tr>
					<td><?=date('d/m/Y',strtotime($item->fecha))?></td>
					<td><?=$item->tipo_consumo?></td>
					<td><?=$item->descripcion?></td>
					<td><?=$item->unidad_medida?> (<?=$item->abreviatura?>)</td>
					<td><?=$item->cantidad?></td>
					<td><?=number_format($item->precio_unitario, 2, '.', ',') ?></td>
					<td><?=number_format($item->precio_parcial, 2, '.', ',') ?></td>
				</tr>
				
			<?php } ?>
			<tr>
				<td colspan="6">TOTAL</td>
				<td><?=number_format($sumatoria, 2, '.', ',') ?></td>
			</tr>
			</tbody>				
		</table>
	</div>
	<?php } ?>
</body>
</html>