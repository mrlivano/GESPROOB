<?php
function mostrarTabla($listaExpDev, $clasificadorMeta, $ultimoDia, $gastoTotalManifiesto)
{
	$costoDirecto=0;
	$costoIndirecto=0;
	$htmlTemp='';
	foreach($listaExpDev as $key => $item)
	{ 
		if(@$item->cantidadDetalle>0) 
		{		
			foreach($item->childDetalleGasto as $llave => $temp) 
			{
				$htmlTemp.='<tr>';
				$htmlTemp.='<td>'.@$ultimoDia.'</td>';
				$htmlTemp.='<td>'.@$item->tipo_doc.'</td>';
				$htmlTemp.='<td>'.(int)@$item->num_doc.'</td>';
				$htmlTemp.='<td>'.@$ultimoDia.'</td>';
				$htmlTemp.='<td>'.(int)@$item->num_comprobante.'</td>';

				if(@$item->tipo_bien=='B')
				{
					$htmlTemp.='<td style="text-align:right;">'.number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '').'</td>';
					$htmlTemp.='<td style="text-align:left;width:10%;">'.@$temp->NOMBRE_ITEM.'</td>';
				}
				else
				{
					$htmlTemp.='<td style="text-align:right;">'.number_format(@$item->total_documento, 2, '.', ',').'</td>';
					$htmlTemp.='<td style="text-align:left;width:10%;">'.@$item->detalle_gasto.'</td>';
				}

				foreach($clasificadorMeta as $clasif)
				{
					$htmlTemp.='<td style="text-align:right;">';
					if(@$item->num_clasificador==@$clasif->num_clasificador)
					{
						if(@$item->tipo_bien=='B') 
						{
							$clasif->sumatoria+=@$temp->PREC_TOT_MONEDA;
							$htmlTemp.=number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '');
						}
						else
						{
							$clasif->sumatoria+=@$item->total_documento;
							$htmlTemp.=number_format(@$item->total_documento, 2, '.', '');
						}
					}
					$htmlTemp.='</td>';
				}
				
				if(@$item->id_presupuesto==2) 
				{ 
					if(@$item->tipo_bien=='B') 
					{	
						$costoDirecto+=@$temp->PREC_TOT_MONEDA;
						$htmlTemp.='<td style="text-align:right;">'.number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '').'</td><td></td>';
					}
					else
					{
						$costoDirecto+=@$item->total_documento;
						$htmlTemp.='<td style="text-align:right;">'.number_format(@$item->total_documento, 2, '.', '').'</td><td></td>';
					}
				}
				else
				{
					if(@$item->tipo_bien=='B') 
					{	
						$costoIndirecto+=@$temp->PREC_TOT_MONEDA;
						$htmlTemp.='<td></td><td style="text-align:right;">'.number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '').'</td>';
					}
					else
					{
						$costoIndirecto+=@$item->total_documento;
						$htmlTemp.='<td></td><td style="text-align:right;">'.number_format(@$item->total_documento, 2, '.', '').'</td>';
					}
				}
				$htmlTemp.='<td></td>';

				if(@$item->tipo_bien=='B') 
				{ 
					$htmlTemp.='<td style="text-align:right;">'.number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '').'</td>';
				}
				else
				{
					$htmlTemp.='<td style="text-align:right;">'.number_format(@$item->total_documento, 2, '.', '').'</td>';
				}
				$htmlTemp.='</tr>';
			}
		}
		else
		{
			$htmlTemp.='<tr>';
			$htmlTemp.='<td>'.@$ultimoDia.'</td>';
			$htmlTemp.='<td>'.@$item->tipo_doc.'</td>';
			$htmlTemp.='<td>'.(int)@$item->num_doc.'</td>';
			$htmlTemp.='<td>'.@$ultimoDia.'</td>';
			$htmlTemp.='<td>'.(int)@$item->num_comprobante.'</td>';
			$htmlTemp.='<td>'.number_format(@$item->total_documento, 2, '.', ',').'</td>';
			$htmlTemp.='<td style="text-align:left;width:10%;">'.(@$item->detalle_gasto!='' ? $item->detalle_gasto : '' ).'</td>';
			
			foreach($clasificadorMeta as $clasif)
			{
				$htmlTemp.='<td style="text-align:right;">';
				if(@$item->num_clasificador==$clasif->num_clasificador)
				{
					$clasif->sumatoria+=$item->total_documento;
					$htmlTemp.=number_format(@$item->total_documento, 2, '.', '');
				}
				$htmlTemp.='</td>';
			}

			if(@$item->id_presupuesto=='2') 
			{ 
				$costoDirecto+=@$item->total_documento;
				$htmlTemp.='<td style="text-align:right;">'.number_format(@$item->total_documento, 2, '.', '').'</td><td></td>';
			}
			else
			{
				$costoIndirecto+=@$item->total_documento;
				$htmlTemp.='<td></td><td style="text-align:right;">'.number_format(@$item->total_documento, 2, '.', '').'</td>';
			}
			$htmlTemp.='<td></td>';
			$htmlTemp.='<td style="text-align:right;">'.number_format(@$item->total_documento, 2, '.', ',').'</td>';
			$htmlTemp.='</tr>';
		}
	}
	$htmlTemp.='<tr>';
	$htmlTemp.='<td style="text-align:center;font-size:9px;" colspan="7"><b>TOTAL</b></td>';
	foreach($clasificadorMeta as $clasif)
	{
		$htmlTemp.='<td style="text-align:right;font-size:9px;"><b>'.number_format(@$clasif->sumatoria, 2, '.', ',').'</b></td>';
	}
	$htmlTemp.='<td style="text-align:right;font-size:9px;"><b>'.number_format(@$costoDirecto, 2, '.', ',').'</b></td>';
	$htmlTemp.='<td style="text-align:right;font-size:9px;"><b>'.number_format(@$costoIndirecto, 2, '.', ',').'</b></td>';
	$htmlTemp.='<td style="text-align:right;font-size:9px;"><b></b></td>';
	$htmlTemp.='<td style="text-align:right;font-size:9px;"><b>'.number_format(@$gastoTotalManifiesto, 2, '.', ',').'</b></td>';
	$htmlTemp.='</tr>';

	return $htmlTemp;
}
?>
<head>
	<title>Ejecucion Presupuestal</title>
	<style>
	body
	{
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	}
	table
	{
		border-collapse: collapse;
		color:black;
	}
	#tablaEjecucionPresupuestal td, #tablaEjecucionPresupuestal th
	{
		border:1px solid black;
		font-size: 8px;
		padding: 2px 5px;
		vertical-align: middle;
		text-transform: uppercase;
		text-align:center;
	}
	#tablaEjecucionPresupuestal th
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
		margin-top: 50px;
	}
	#footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 100px; }
  #footer .page:after { content: counter(page, upper-roman); }
</style>
</head>
<body>
<div id="footer">
		<div style="text-align: left; font-size: 12px;">Usuario: <?php echo $this->session->userdata('nombreUsuario')?> | fecha:<?php echo date("d/m/Y");?></div>
</div>
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
	<div style="text-align: center; font-size: 13px;padding-bottom:6px;"><b>EJECUCIÓN PRESUPUESTAL MENSUAL</b></div>
	<div style="font-size: 6px;">
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
				<td style="width: 92%">:  <?=@$correlativoMeta?></td>
			</tr>				
			<tr>
				<td style="width: 8%;font-weight:bold;">FTE. FTO</td>
				<td style="width: 92%">: <?=@$nombreFuenteFinanciamiento?></td>
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
	<table id="tablaEjecucionPresupuestal" style="width: 100%;">
		<thead>
			<tr>
				<th colspan="3">DOCUMENTO</th>
				<th colspan="3">COMPROBANTE DE PAGO</th>
				<th rowspan="2">DETALLE DE GASTOS</th>
				<th colspan="<?=count(@$clasificadorMeta)?>">EJECUCIÓN PRESUPUESTAL POR ESPECIFICA (MENSUAL)</th>
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
				foreach($clasificadorMeta as $clasif)
				{
					$clasif->sumatoria=0;
				?>
				<th><?=@$clasif->num_clasificador?></th>
				<?php } ?>
				<th>DIRECTOS</th>
				<th>INDIRECTOS</th>
			</tr>
		</thead>
		<tbody>
			<?=mostrarTabla($listaExpDev, $clasificadorMeta, $ultimoDia, $gastoTotalManifiesto)?>
		</tbody>
	</table>
</body>