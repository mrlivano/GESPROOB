<style>
	table
	{
		border-collapse: collapse;
		color:#35353e;
	}
	#tablaEjecucionPresupuestal td, #tablaEjecucionPresupuestal th
	{
		font-size: 10px;
		padding: 2px 5px;
		vertical-align: middle;
		text-align:center;
	}
	#tablaEjecucionPresupuestal th
	{
		background-color:#2e6da4;
		color:white;		
	}	
</style>
<table id="tablaEjecucionPresupuestal" class="table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th colspan="3">DOCUMENTO</th>
			<th colspan="3">COMPROBANTE DE PAGO</th>
			<th rowspan="2">DETALLE DE GASTOS</th>
			<th colspan="<?=count($clasificadorMeta)?>">EJECUCIÓN PRESUPUESTAL POR ESPECIFICA (MENSUAL)</th>
			<th colspan="2">COSTOS</th>
			<th rowspan="2">PEC.</th>
			<th rowspan="2">TOTAL</th>
		</tr>
		<tr>
			<th>FECHA</th>
			<th>CLASE</th>
			<th>Nº</th>			
			<th>FECHA</th>
			<th>Nº</th>
			<th>IMPORTE</th>
			<?php
			$costoDirecto=0;
			$costoIndirecto=0;
			foreach($clasificadorMeta as $clasif)
			{
				$clasif->sumatoria=0;
			?>
			<th><?=$clasif->num_clasificador?></th>
			<?php } ?>
			<th>DIRECTOS</th>
			<th>INDIRECTOS</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($listaExpDev as $key => $item ) { 
		if(@$item->cantidadDetalle>0) {?>			
			<?php foreach($item->childDetalleGasto as $llave => $temp) {?>
			<tr>
				<?php if($llave==0) { ?>
				<td style="width:5%;" rowspan="<?=$item->cantidadDetalle?>">
					<?=date('d/m/Y')?>
				</td>				
				<td style="width:5%;" rowspan="<?=$item->cantidadDetalle?>">
					<?=@$item->tipo_doc?>
				</td>
				<td style="width:5%;" rowspan="<?=$item->cantidadDetalle?>">
					<?=(int)@$item->num_doc?>
				</td>					
				<td style="width:5%;" rowspan="<?=$item->cantidadDetalle?>">
					<?=date('d/m/Y')?>
				</td>	
				<td style="width:5%;" rowspan="<?=$item->cantidadDetalle?>">
					<?=(int)@$item->num_comprobante?>
				</td>				
				<?php } ?>
				<td style="width:5%;text-align:right;">
					<?php 
					if(@$item->tipo_bien=='B') 
					{ 
						echo number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '');
					}
					else
					{
						echo number_format(@$item->total_documento, 2, '.', ',');
					}
					?>
				</td>			
				<td style="width:25%;text-align:left;">
					<?php 
					if(@$item->tipo_bien=='B') 
					{ 
						echo @$temp->NOMBRE_ITEM;
					}
					else
					{
						echo @$item->detalle_gasto;
					}
					?>
				</td>
				<?php foreach($clasificadorMeta as $clasif)
				{?>
				<td style="width:8%;text-align:right;">	
					<?php									
					if(@$item->tipo_bien=='B') 
					{			
						echo (@$item->num_clasificador==$clasif->num_clasificador ? number_format(@$temp->PREC_TOT_MONEDA, 2, '.', ''):'');
						if(@$item->num_clasificador==$clasif->num_clasificador)
						{
							$clasif->sumatoria+=@$temp->PREC_TOT_MONEDA;
						}	
					}
					else
					{
						echo (@$item->num_clasificador==$clasif->num_clasificador ? number_format(@$item->total_documento, 2, '.', ''):'');
						if(@$item->num_clasificador==$clasif->num_clasificador)
						{
							$clasif->sumatoria+=@$item->total_documento;
						}
					}
					?>	
				</td>
				<?php } ?>				
				<td style="width:8%;text-align:right;">
					<?php 
					if(@$item->id_presupuesto==2) 
					{ 
						if(@$item->tipo_bien=='B') 
						{	
							$costoDirecto+=@$temp->PREC_TOT_MONEDA;
						}
						else
						{
							$costoDirecto+=@$item->total_documento;
						}
						echo (@$item->tipo_bien=='B' ? number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '') : number_format(@$item->total_documento, 2, '.', ','));
					}
					?>
				</td>
				<td style="width:8%;text-align:right;">
					<?php 
					if(@$item->id_presupuesto!=2) 
					{ 
						if(@$item->tipo_bien=='B') 
						{	
							$costoIndirecto+=@$temp->PREC_TOT_MONEDA;
						}
						else
						{
							$costoIndirecto+=@$item->total_documento;
						}
						echo (@$item->tipo_bien=='B' ? number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '') : number_format(@$item->total_documento, 2, '.', ','));
					}
					?>
				</td>
				<td style="width:3%;">					
				</td>
				<td style="width:8%;text-align:right;">
					<?php 
					if(@$item->tipo_bien=='B') 
					{ 
						echo number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '');
					}
					else
					{
						echo number_format(@$item->total_documento, 2, '.', ',');
					}
					?>
				</td>
			</tr>
			<?php } ?>			
		<?php } else { ?>			
	  	<tr>			
		  	<td style="width:5%;">
				<?=date('d/m/Y')?>
			</td>				
			<td style="width:5%;">
				<?=@$item->tipo_doc?>
			</td>
			<td style="width:5%;">
				<?=(int)@$item->num_doc?>
			</td>			
			<td style="width:5%;">
				<?=date('d/m/Y')?>
			</td>	
			<td style="width:5%;">
				<?=(int)@$item->num_comprobante?>
			</td>
			<td style="width:5%;text-align:right;">
				<?=number_format(@$item->total_documento, 2, '.', ',')?>
			</td>		
			<td style="width:25%;text-align:left;">
				<?=(@$item->detalle_gasto!='' ? $item->detalle_gasto : '' )?>
			</td>			
			<?php foreach($clasificadorMeta as $clasif)
			{
				if(@$item->num_clasificador==$clasif->num_clasificador)
				{
					$clasif->sumatoria+=$item->total_documento;
				}
			?>
			<td style="width:8%;text-align:right;">	
				<?=(@$item->num_clasificador==$clasif->num_clasificador ? number_format(@$item->total_documento, 2, '.', ''):'')?>
			</td>
			<?php } ?>	
			<td style="width:5%;text-align:right;">
				<?php 
				if(@$item->id_presupuesto=='2') 
				{ 
					$costoDirecto+=@$item->total_documento;
					echo (@$item->tipo_bien=='B' ? number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '') : number_format(@$item->total_documento, 2, '.', ','));
				}
				?>			
			</td>
			<td style="width:5%;text-align:right;">
				<?php 
				if(@$item->id_presupuesto!='2') 
				{ 
					$costoIndirecto+=@$item->total_documento;
					echo (@$item->tipo_bien=='B' ? number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '') : number_format(@$item->total_documento, 2, '.', ','));
				}
				?>
			</td>
			<td style="width:3%;text-align:right;"></td>
			<td style="width:8%;text-align:right;">
				<?=number_format(@$item->total_documento, 2, '.', ',')?>
			</td>	
	  	</tr>
	<?php } 
	} ?>
	<tr>
		<td style="text-align:center;width:92%;font-size:11px;" colspan="7"><b>TOTAL</b></td>
		<?php foreach($clasificadorMeta as $clasif)
		{ ?>
		<td style="width:8%;text-align:right;font-size:11px;"><b><?=number_format(@$clasif->sumatoria, 2, '.', ',')?></b></td>
		<?php } ?>
		<td style="text-align:right;width:8%;font-size:11px;"><b><?=number_format(@$costoDirecto, 2, '.', ',')?></b></td>
		<td style="text-align:right;width:8%;font-size:11px;"><b><?=number_format(@$costoIndirecto, 2, '.', ',')?></b></td>
		<td style="text-align:right;width:8%;font-size:11px;"><b></b></td>
		<td style="text-align:right;width:8%;font-size:11px;"><b><?=number_format(@$gastoTotalManifiesto, 2, '.', ',')?></b></td>
	</tr>
	</tbody>
</table>