<!DOCTYPE html>
<html>
<head>
	<title>Formato FE-06</title>
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
		.tablaCuadroComparativo td, .tablaCuadroComparativo th
		{
			border:1px solid black;
			font-size: 9px;
			padding: 2px 5px;
			vertical-align: middle;
		}
		.tablaCuadroComparativo th
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
		#footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 100px; }
  	#footer .page:after { content: counter(page, upper-roman); }
		@page 
		{ 
			margin-bottom: 130px;
		}
	</style>
	</head>
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
	<div style="text-align: center; font-size: 13px;padding-bottom:6px;"><b>FORMATO FE-06</b></div>
	<div style="text-align: center; font-size: 13px;padding-bottom:6px;"><b>CUADRO COMPARATIVO DEL PRESUPUESTO ANALITICO APROBADO Y EJECUTADO</b></div>
	<div style="font-size: 8px;">
		<p><?=date('d/m/Y H:i:s')?></p>
		<table id="tablaPresentacion" style="width: 100%">
			<tr>
				<td style="width: 8%;font-weight:bold;">PROYECTO</td>
				<td style="width: 92%">: <?=@$proyectoInversion->nombre_pi;?></td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">CORRELATIVO</td>				
				<td style="width: 92%">: <?=@$correlativo?></td>
			</tr>				
			<tr>
				<td style="width: 8%;font-weight:bold;">FTE. FTO</td>
				<td style="width: 92%">: <?=@$fuenteFinanciamiento[0]->nombre?></td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">MODALIDAD</td>
				<td style="width: 92%">: <?=@$proyectoInversion->modalidad_ejecucion_et;?></td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">MES</td>
				<td style="width: 92%; text-transform:uppercase; ">: <?=@$fechaReporte?></td>
			</tr>
		</table>    
	</div>
	<br>
	<table class="tablaCuadroComparativo" style="width:100%;">
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
				<th><?=substr($key, 0, 3)?></th>
				<?php } ?>
				<th>S/.</th>
				<th>%</th>
				<th>S/.</th>
				<th>%</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($PresupuestoEjecucion as $key => $value) 
			{?>
				<tr>
					<td style="background-color:#f1f1f1;"  colspan="19">
						<?=$value->desc_presupuesto_ej?>								
					</td>
				</tr>
				<?php if(count($value->childPresupuesto)>0) 
				{	
					foreach ($value->childPresupuesto as $key => $item) 
					{
						if(count($item->ChilpresupuestoAnalitico)>0) 
						{?>
							<tr>
								<td style="background-color:#f1f1f1;" colspan="19"><?=$item->desc_presupuesto_ej?></td>
							</tr>
							<?php foreach ($item->ChilpresupuestoAnalitico as $key => $temp2) 
							{?>
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
									<?php
									}?>	
									<td style="text-align:right;"><?=number_format($temp2->acumulado, 2, '.', ',')?></td>
									<td style="text-align:right;"><?=number_format($temp2->porcentajeAcumulado, 2, '.', ',')?>%</td>
									<td style="text-align:right;"><?=number_format($temp2->saldo, 2, '.', ',')?></td>
									<td style="text-align:right;"><?=number_format($temp2->porcentajeSaldo, 2, '.', ',')?>%</td>
								</tr>							 	
							<?php } 
						}
					}
				} 
				else
				{
					foreach ($value->ChilpresupuestoAnalitico as $key => $temp) 
					{?>
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
							<?php 
							}?>
							<td style="text-align:right;"><?=number_format($temp->acumulado, 2, '.', ',')?></td>
							<td style="text-align:right;"><?=number_format($temp->porcentajeAcumulado, 2, '.', ',')?>%</td>
							<td style="text-align:right;"><?=number_format($temp->saldo, 2, '.', ',')?></td>
							<td style="text-align:right;"><?=number_format($temp->porcentajeSaldo, 2, '.', ',')?>%</td>
						</tr>							 	
					<?php 
					}
				}
			}?>	
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
					<?php
						$porcentajeAcumulado=((@$montoTotalFuente*100)/@$fuenteFinanciamiento[0]->pim);
					?>
					<b><?=number_format($porcentajeAcumulado, 2, '.', ',')?>%</b>
				</td>
				<td style="text-align:right;">
					<b><?=number_format((@$fuenteFinanciamiento[0]->pim-@$montoTotalFuente), 2, '.', ',')?></b>
				</td>
				<td style="text-align:right;">
					<b><?=number_format((100-$porcentajeAcumulado), 2, '.', ',')?>%</b>
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<table class="tablaCuadroComparativo" style="width:40%;">
		<thead>
			<tr>
				<th colspan="3">RESUMEN</th>
			</tr>
			<tr>
				<th>DESCRIPCIÓN</th>
				<th>%</th>
				<th>TOTAL</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=@$fuenteFinanciamiento[0]->nombre?></td>
				<td style="text-align:center;">100%</td>
				<td style="text-align:right;"><?=number_format(@$fuenteFinanciamiento[0]->pim, 2, '.', ',')?></td>
			</tr>
			<tr>
				<td>GASTO EJECUTADO TOTAL</td>
				<td style="text-align:center;"><?=number_format($porcentajeAcumulado, 2, '.', ',')?>%</td>
				<td style="text-align:right;"><?=number_format(@$montoTotalFuente, 2, '.', ',')?></td>
			</tr>
			<tr>
				<td>SALDO TOTAL DEL PROYECTO</td>
				<td style="text-align:center;"><?=number_format((100-$porcentajeAcumulado), 2, '.', ',')?>%</td>
				<td style="text-align:right;"><?=number_format((@$fuenteFinanciamiento[0]->pim-@$montoTotalFuente), 2, '.', ',')?></td>
			</tr>
		</tbody>
	</table>
</body>
</html>
