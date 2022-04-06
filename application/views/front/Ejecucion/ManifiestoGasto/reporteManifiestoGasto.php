<!DOCTYPE html>
<html>
<head>
	<title>Manifiesto de Gasto</title>
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
	#tablaDinamicaManifiestoGasto td, #tablaDinamicaManifiestoGasto th
	{
		border:1px solid black;
		font-size: 8px;
		padding: 2px 5px;
		vertical-align: middle;
		text-transform: uppercase;
		text-align:center;
	}
	#tablaDinamicaManifiestoGasto th
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
	<div style="text-align: center; font-size: 13px;padding-bottom:6px;"><b>MANIFIESTO DE GASTOS MENSUAL</b></div>
	<div style="font-size: 8px;">
		<p><?=date('d/m/Y H:i:s')?></p>
		<table id="tablaPresentacion" style="width: 100%">
			<tr>
				<td style="width: 8%;font-weight:bold;">PROYECTO</td>
				<td style="width: 92%">: <?=@$proyectoInversion->nombre_pi;?> </td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">COMPONENTE</td>
				<td style="width: 92%">: <?=@$proyectoInversion->componente_et;?> </td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">CORRELATIVO</td>				
				<td style="width: 92%">: <?=@$correlativoMeta;?> </td>
			</tr>				
			<tr>
				<td style="width: 8%;font-weight:bold;">FTE. FTO</td>
				<td style="width: 92%">: <?=@$nombreFuenteFinanciamiento;?> </td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">MODALIDAD</td>
				<td style="width: 92%">: <?=@$proyectoInversion->modalidad_ejecucion_et;?> </td>
			</tr>
			<tr>
				<td style="width: 8%;font-weight:bold;">MES</td>
				<td style="width: 92%">: <?=@$fechaReporte?></td>
			</tr>
		</table>    
	</div>
	<br>
	<table id="tablaDinamicaManifiestoGasto" style="width: 100%;">
		<thead>
			<tr>
				<th rowspan="2">FECHA</th>
				<th rowspan="2">SIAF</th>
				<th colspan="3">DOCUMENTO</th>
				<th rowspan="2">NOMBRE/PROVEEDOR</th>
				<th rowspan="2">DETALLE DEL GASTO</th>
				<th rowspan="2">UNID. MEDIDA</th>
				<th rowspan="2">CANTIDAD</th>
				<th rowspan="2">P.U</th>
				<th rowspan="2">TOTAL DOCUMENTO</th>
			</tr>
			<tr>
				<th >CLASE</th>
				<th >Nº</th>
				<th >Nº C/P.</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($listaExpDev as $key => $item ) { 
			if(@$item->cantidadDetalle>0) {?>			
				<?php foreach($item->childDetalleGasto as $llave => $temp) {?>
				<tr>											
					<td>
						<?=@$ultimoDia?>
					</td>
					<td>
						<?=(int) @$item->expediente?>
					</td>
					<td>
						<?=@$item->tipo_doc?>
					</td>
					<td>
						<?=(int) @$item->nro_documento?>
					</td>
					<td>
						<?=(int) @$item->nro_comprobante?>
					</td>
					<td style="width:15%;text-align:left;">
						<?=@$item->nombre_proveedor?>
					</td>		
					<td style="width:25%;text-align:left;">
					<?php 
					if(@$item->tipo_bien=='B') 
					{ 
						echo @$temp->NOMBRE_ITEM;
					}
					else
					{
						echo (@$item->detalle_gasto=='' ? @$temp->NOMBRE_ITEM : @$item->detalle_gasto);
					}
					?>
					</td>
					<td>
						<?=@$temp->ABREVIATURA?>
					</td>
					<td>
						<?php echo (@$temp->ABREVIATURA!='SERVICIO' ? number_format(@$temp->CANT_ITEM, 2, '.', '') : '');?>
					</td>
					<td style="text-align:right;">
						<?php echo (@$temp->ABREVIATURA!='SERVICIO' ? number_format(@$temp->PREC_UNIT_MONEDA, 2, '.', '') : '');?>
					</td>
					<td style="text-align:right;">
					<?php 
					if(@$item->tipo_bien=='B') 
					{ 
						echo number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '');
					}
					else
					{
						echo number_format(@$item->total_documento, 2, '.', '');
					}
					?>
					</td>
				</tr>
				<?php }?>			
			<?php } else { ?>			
			<tr>
				<td>
					<?=@$ultimoDia?>
				</td>
				<td>
					<?=(int) @$item->expediente?>
				</td>
				<td>
					<?=@$item->tipo_doc?>
				</td>
				<td>
					<?=@$item->nro_documento?>
				</td>
				<td>
					<?=(int) @$item->nro_comprobante?>
				</td>
				<td style="width:15%;text-align:left;">
					<?=(@$item->nombre_proveedor!='' ? @$item->nombre_proveedor : '' )?>
				</td>
				<td style ="width:25%;text-align:left;">
					<?=(@$item->detalle_gasto!='' ? @$item->detalle_gasto : '' )?>
				</td>			
				<td></td>
				<td></td>
				<td></td>
				<td style="text-align:right">
					<?=number_format(@$item->total_documento, 2, '.', ',')?>
				</td>	
			</tr>
		<?php } 
		} ?>
		<tr>
			<td style="text-align:center;font-size:11px;" colspan="10"><b>TOTAL</b></td>
			<td style="text-align:right;font-size:11px;"><b><?=number_format(@$gastoTotalManifiesto, 2, '.', ',')?></b></td>
		</tr>
		</tbody>
	</table>
</body>
</html>