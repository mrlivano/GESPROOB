
<!DOCTYPE html>
<html>
<head>
	<title>PROYECTOS DE INVERSIÓN PROGRAMADOS</title>
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
	#tablaProgramacionEjecucion td, #tablaProgramacionEjecucion th
	{
		border:1px solid black;
		font-size: 8px;
		padding: 2px 5px;
		vertical-align: middle;
		text-transform: uppercase;
		text-align:center;
	}
	#tablaProgramacionEjecucion th
	{
		background-color:#2e6da4;
		color:white;
		text-align:center;
	}	
</style>
	<p style="font-size:8px;">SIGEI - GOBIERNO REGIONAL DE APURÍMAC</p>
    <p style="font-size:8px;"><?=date('d/m/y H:i')?></p>
    <div style="text-align: center; font-size: 13px;padding-bottom:20px;"><b>PROYECTOS DE INVERSIÓN PROGRAMADOS</b></div>
	<table id="tablaProgramacionEjecucion" cellspacing="0" width="100%">
		<thead>
			<tr style="border:none;">
				<th rowspan="2">Orden de Prioridad</th>
				<th rowspan="2">Código Unico</th>
				<th rowspan="2">Inversión</th>
				<th style="text-align:right;" rowspan="2">Costo</th>
				<th rowspan="2">Fase</th>			
				<th style="text-align:right;" rowspan="2">PIM <?=$anio?></th>
				<th style="text-align:right;" rowspan="2">Devengado Acumulado</th>
				<th colspan="3" style="text-align:center;">PROGRAMACIÓN</th>
				<th style="text-align:right;" rowspan="2">Saldo por Ejecutar</th>
			</tr>
			<tr>			
				<th style="text-align:right;"><?=$anio+1?></th>
				<th style="text-align:right;"><?=$anio+2?></th>
				<th style="text-align:right;"><?=$anio+3?></th>			
			</tr>
		</thead>
		<tbody>
			<?php foreach ($ProyectoProgramado as $key => $value) {
			$inv1='Inv_'.($anio+1);
			$inv2='Inv_'.($anio+2);
			$inv3='Inv_'.($anio+3);
			?>
			<tr>
				<td style="width:5%;"><?=$value->prioridad_prog?></td>
				<td style="width:5%;"><?=$value->codigo_unico_pi?></td>
				<td style="text-align:left; width:29%;"><?=$value->nombre_pi?></td>
				<td style="text-align:right; width:8%;"><?=number_format(@$value->costo_pi, 2, '.', ',')?></td>
				<td style="width:5%;"><?=$value->nombre_estado_ciclo?></td>
				<td style="text-align:right; width:8%;"><?=number_format(@$value->pim, 2, '.', ',')?></td>
				<td style="text-align:right; width:8%;"><?=number_format(@$value->devengado_acumulado, 2, '.', ',')?></td>
				<td style="text-align:right; width:8%;"><?=number_format(@$value->$inv1, 2, '.', ',')?></td>
				<td style="text-align:right; width:8%;"><?=number_format(@$value->$inv2, 2, '.', ',')?></td>
				<td style="text-align:right; width:8%;"><?=number_format(@$value->$inv3, 2, '.', ',')?></td>
				<td style="text-align:right; width:8%;"><?=number_format(@$value->saldo, 2, '.', ',')?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>