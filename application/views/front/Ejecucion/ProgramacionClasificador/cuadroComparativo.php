<style>
	table
	{
		border-collapse: collapse;
		color:#35353e;
	}
	#tablaCuadroComparativo td, #tablaCuadroComparativo th
	{
		font-size: 10px;
		padding: 2px 5px;
		vertical-align: middle;
	}
	#tablaCuadroComparativo th
	{
		background-color:#2e6da4;
		color:white;
		text-align:center;
	}
</style>
<table id="tablaCuadroComparativo" class="table table-bordered table-sm" style="width:100%;">
	<thead>
		<tr>
			<th rowspan="2">ESP. DEL GASTO</th>
			<th rowspan="2">DETALLE</th>
			<th rowspan="2">PIM</th>
			<th colspan="12">PIM</th>
			<th colspan="2">ACUMULADO</th>
			<th colspan="2">SALDO</th>
		</tr>
		<tr>
			<?php 
			$sumatoriasTotales=[];
			foreach($listaMeses as $key => $mes) 
			{
				$sumatoriasTotales[$key]=0; 
			?>
			<th><?=$key?></th>
			<?php } ?>
			<th>S/.</th>
			<th>%</th>
			<th>S/.</th>
			<th>%</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($PresupuestoEjecucion as $key => $value) {?>
			<tr id="trPresupuestoEjecucion<?=$value->id_presupuesto_ej?>">
				<td style="background-color: #f1f1f1;color:#3f5367;" colspan="19">
					<?=$value->desc_presupuesto_ej?>								
				</td>
				<?php if(count($value->childPresupuesto)==0) 
				{							
					foreach ($value->ChilpresupuestoAnalitico as $key => $temp) { ?>
						<tr>
							<td><?= $temp->num_clasificador?></td>
							<td><?= $temp->desc_clasificador?></td>
							<td style="text-align:right;"><?=number_format($temp->monto, 2, '.', ',')?></td>
							<?php foreach($listaMeses as $key1 =>$mes)
							{
								$montoTotalMensual=0;
								foreach($temp->childProgramacion as $key => $childProgramacion)
								{ 
									if($childProgramacion->mes==$mes)
									{
										$montoTotalMensual=$childProgramacion->montomensual;
										$sumatoriasTotales[$key1]+=$montoTotalMensual;
									}
								}?>
								<td style="text-align:right;">
								<?=number_format($montoTotalMensual, 2, '.', ',')?>
								</td>
							<?php } ?>
							<td style="text-align:right;"><?=number_format($temp->acumulado, 2, '.', ',')?></td>
							<td style="text-align:right;"><?=number_format($temp->porcentajeAcumulado, 2, '.', ',')?>%</td>
							<td style="text-align:right;"><?=number_format($temp->saldo, 2, '.', ',')?></td>
							<td style="text-align:right;"><?=number_format($temp->porcentajeSaldo, 2, '.', ',')?>%</td>
						</tr>							 	
					<?php } 							 	
				}?>
				<?php if(count($value->childPresupuesto)>0) { 
					foreach ($value->childPresupuesto as $key => $item) { ?>
						<tr id="trPresupuestoEjecucion<?=$item->id_presupuesto_ej?>">
							<?php if(count($item->ChilpresupuestoAnalitico)>0) 
							{ ?>
							<td style="background-color:#f1f1f1;" colspan="19"><?=$item->desc_presupuesto_ej?></td>
							<?php foreach ($item->ChilpresupuestoAnalitico as $key => $temp2) { ?>
								<tr>
									<td><?= $temp2->num_clasificador?></td>
									<td><?= $temp2->desc_clasificador?></td>
									<td style="text-align:right;"><?=number_format($temp2->monto, 2, '.', ',')?></td>
									<?php foreach($listaMeses as $key1 =>$mes)
									{
										$montoTotalMensual=0;
										foreach($temp2->childProgramacion as $key => $childProgramacionA)
										{ 
											if($childProgramacionA->mes==$mes)
											{
												$montoTotalMensual=$childProgramacionA->montomensual;
												$sumatoriasTotales[$key1]+=$montoTotalMensual;
											}
										}?>
										<td style="text-align:right;">
										<?=number_format($montoTotalMensual, 2, '.', ',')?>
										</td>
									<?php } ?>
									<td style="text-align:right;"><?=number_format($temp2->acumulado, 2, '.', ',')?></td>
									<td style="text-align:right;"><?=number_format($temp2->porcentajeAcumulado, 2, '.', ',')?>%</td>
									<td style="text-align:right;"><?=number_format($temp2->saldo, 2, '.', ',')?></td>
									<td style="text-align:right;"><?=number_format($temp2->porcentajeSaldo, 2, '.', ',')?>%</td>
								</tr>							 	
							<?php } 
							}?>
						</tr>
					<?php }
				} ?>
			</tr>						
		<?php } ?>	
		<tr>
			<td colspan="2" style="text-align:center;"><b>TOTAL</b></td>
			<td style="text-align:right;"><b><?=number_format($sumatoriaProgramado, 2, '.', ',')?></b></td>
			<?php foreach($listaMeses as $key1 => $mes) 
			{?>
			<td style="text-align:right;">
				<b><?=number_format(@$sumatoriasTotales[$key1], 2, '.', ',')?></b
			></td>
			<?php } ?>
			<td style="text-align:right;">
				<b><?=number_format(@$montoTotalFuente, 2, '.', ',')?></b></td>
			</td>
			<td style="text-align:right;">
				<b><?=number_format(((@$montoTotalFuente*100)/@$fuenteFinanciamiento[0]->pim), 2, '.', ',')?>%</b>
			</td>
			<td style="text-align:right;">
				<b><?=number_format((@$fuenteFinanciamiento[0]->pim-@$montoTotalFuente), 2, '.', ',')?></b>
			</td>
			<td style="text-align:right;">
				<b><?=number_format((100-((@$montoTotalFuente*100)/@$fuenteFinanciamiento[0]->pim)), 2, '.', ',')?>%</b>
			</td>
		</tr>
	</tbody>
</table>
