
<table id="tableSub3" width="100%" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0">
	<thead >
		<tr>
			<th rowspan="3">Descripción del producto</th>
			<th rowspan="3">Actividades</th>
			<th colspan="7">Ejecución Física</th>
			<th colspan="6">Ejecución Financiera</th>
		</tr>
		<tr>
			<th rowspan="2">Unidad Med.</th>
			<th rowspan="2">Meta</th>
			<th colspan="2">Meta Programada</th>
			<th colspan="2">Meta Ejecutada</th>
			<th rowspan="2">% Avance Acum.</th>
			<th rowspan="2">Monto Total</th>
			<th colspan="2">Monto Programado</th>
			<th colspan="2">Monto Ejecutado</th>
			<th rowspan="2">% Avance Acum.</th>
		</tr>
		<tr>
			<th>Del mes</th>
			<th>Acumulado</th>
			<th>Del mes</th>
			<th>Acumulado</th>
			<th>Del mes</th>
			<th>Acumulado</th>
			<th>Del mes</th>
			<th>Acumulado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($listaProducto as $key => $value) {?>
			<tr>

				<td style="text-align: left; text-transform: uppercase;"><?=$value->desc_producto?></td>
				<td style="text-align: left;text-transform: uppercase;"><?=$value->desc_actividad?></td>
				<td><?=$value->uni_medida?></td>
				<td><?=$value->meta?></td>
				<td><?=$value->MetaProgdelMes?></td>
				<td><?=$value->MetaAcumulado?></td>
				<td><?=$value->MetaEjecdelMes?></td>
				<td><?=$value->MetaEjecAcumulado?></td>
				<td><?=a_number_format($value->PorcentajeEjecAcumulado, 2, '.',",",0)?> %</td>
				<td><?=a_number_format($value->costo_total, 2, '.',",",3)?></td>
				<td><?=a_number_format($value->MontoProgdelMes , 2, '.',",",3)?></td>
				<td><?=a_number_format($value->MontoAcumulado, 2, '.',",",3)?></td>
				<td><?=a_number_format($value->MontoEjecdelMes , 2, '.',",",3)?></td>
				<td><?=a_number_format($value->MontoEjecAcumulado , 2, '.',",",3)?></td>	
				<td><?=a_number_format($value->PorcentajeProgAcumulado, 2, '.',",",0)?> %</td>						
			</tr>
		<?php } ?>							
	</tbody>						
</table>

					