<style>
	table
	{
		border-collapse: collapse;
		color: black;
	}
	.tablaCuadroComparativo td, .tablaCuadroComparativo th
	{
		border:1px solid black;
		font-size: 12px;
		padding: 2px 5px;
		vertical-align: middle;
	}
	.tablaCuadroComparativo th
	{
		background-color:#2e6da4;
		color:white;
		text-align:center;
	}
</style>
<table class="tablaCuadroComparativo" style="width:100%;">
	<thead>
		<tr>
			<th colspan="3" style="text-transform:uppercase">RESUMEN CONSOLIDADO DE FUENTES DE FINANCIAMIENTO DEL PROYECTO <?=@$fechaReporte?></th>
		</tr>
		<tr>
			<th>DESCRIPCIÓN</th>
			<th>%</th>
			<th>TOTAL</th>
		</tr>
	</thead>
	<tbody>
		<?php 			
		$presupuesto=0;
		foreach($fuenteFinanciamiento as $key => $value ) 
		{ 
			$presupuesto+=$value->pim;
			?>
			<tr>
				<td><?=@$value->nombre?></td>
				<td style="text-align:center;"></td>
				<td style="text-align:right;"><?=number_format(@$value->pim, 2, '.', ',')?></td>
			</tr>
		<?php 
		} ?>
		<tr>
			<td>TOTAL</td>
			<td style="text-align:center;">100%</td>
			<td style="text-align:right;"><?=number_format(@$presupuesto, 2, '.', ',')?></td>
		</tr>
		<tr>
			<td>GASTO EJECUTADO TOTAL</td>
			<td style="text-align:center;"><?=number_format(((@$gastoEjecutado[0]->gastoEjecutado*100)/@$presupuesto) , 2, '.', ',')?>%</td>
			<td style="text-align:right;"><?=number_format(@$gastoEjecutado[0]->gastoEjecutado, 2, '.', ',')?></td>
		</tr>
		<tr>
			<td>SALDO TOTAL DEL PROYECTO</td>
			<td style="text-align:center;"><?=number_format((100-((@$gastoEjecutado[0]->gastoEjecutado*100)/@$presupuesto)), 2, '.', ',')?>%</td>
			<td style="text-align:right;"><?=number_format((@$presupuesto-@$gastoEjecutado[0]->gastoEjecutado), 2, '.', ',')?></td>
		</tr>
	</tbody>
</table>
