<?php
function mostrarAnidado($meta, $expedienteTecnico)
{
	$cantidad = 0;
	$htmlTemp='';

	$htmlTemp.='<tr class="elementoBuscar">'.
		'<td><b>'.$meta->numeracion.'</b></td>'.
		'<td style="text-align: left;" colspan="15"><b>'.html_escape($meta->desc_meta).'</b></td>'.
	
	$htmlTemp.='</tr>';
	if(count($meta->childMeta)==0)
	{		
		foreach($meta->childPartida as $key => $value)
		{
			$metradoActual = 0;
			$valorizadoActual=0;
			$metradoAnterior = 0;
			$valorizadoAnterior =0;
			$metradoAcumulado = 0;
			$valorizadoAcumulado = 0;
			$porcentajeAcumulado = 0;
			$metradoSaldo = 0;
			$valorizadoSaldo = 0;
			$porcentajeSaldo = 0;
			$htmlTemp.='<tr class="elementoBuscar">'.
				'<td style="width:3%;">'.$value->numeracion.'</td>'.
				'<td style="text-align: left;width:21%;">'.html_escape($value->desc_partida).'</td>'.
				'<td style="text-align: center;width:5%;">'.html_escape($value->descripcion).'</td>'.
				'<td style="text-align: right;width:5%;">'.$value->cantidad.'</td>'.
				'<td style="text-align: right;width:5%;">S/.'.$value->precio_unitario.'</td>'.
				'<td style="text-align: right;width:7%;">S/.'.number_format($value->cantidad*$value->precio_unitario, 2).'</td>';

				foreach($value->childDetallePartida->childDetSegValorizacion as $index => $item)
				{
					if($item->id_detalle_partida==$value->childDetallePartida->id_detalle_partida)
					{
						$metradoActual = $item->metrado;
						$valorizadoActual = $item->valorizado;
						break;
					}
				}

				foreach($value->childDetallePartida->childDetSegValorizacionAnterior as $index => $item)
				{
					if($item->id_detalle_partida==$value->childDetallePartida->id_detalle_partida)
					{
						$metradoAnterior = $item->metradoAnterior;
						$valorizadoAnterior = $item->valorizadoAnterior;
						break;
					}
				}

				$metradoAcumulado= $metradoAnterior + $metradoActual;
				$valorizadoAcumulado=$valorizadoAnterior + $valorizadoActual;
				$porcentajeAcumulado = (100 * $metradoAcumulado)/($value->cantidad);
				$metradoSaldo = $value->cantidad - $metradoAcumulado;
				$valorizadoSaldo = ($value->cantidad*$value->precio_unitario) - $valorizadoAcumulado;
				$porcentajeSaldo = 100 - $porcentajeAcumulado;

				$htmlTemp.='<td style="text-align: right;width:5%;">'.number_format($metradoAnterior, 2).'</td>';
				$htmlTemp.='<td style="text-align: right;width:7%;">S/.'.number_format($valorizadoAnterior, 2).'</td>';
				$htmlTemp.='<td style="text-align: right;width:5%;">'.number_format($metradoActual, 2).'</td>';
				$htmlTemp.='<td style="text-align: right;width:7%;">S/.'.number_format($valorizadoActual, 2).'</td>';
				$htmlTemp.='<td style="text-align: right;width:5%;">'.number_format($metradoAcumulado, 2).'</td>';
				$htmlTemp.='<td style="text-align: right;width:7%;">S/. '.number_format($valorizadoAcumulado, 2).'</td>';
				$htmlTemp.='<td style="text-align: right;width:3%;">'.number_format($porcentajeAcumulado, 2).'% </td>';
				$htmlTemp.='<td style="text-align: right;width:5%;">'.number_format($metradoSaldo, 2).'</td>';
				$htmlTemp.='<td style="text-align: right;width:7%;">S/. '.number_format($valorizadoSaldo, 2).'</td>';
				$htmlTemp.='<td style="text-align: right;width:3%;">'.number_format($porcentajeSaldo, 2).'% </td>';

			$htmlTemp.='</tr>';

		}		
	}
	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarAnidado($value, $expedienteTecnico);
	}
	return $htmlTemp;
}
?>
<style>	
	body
	{
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	}

	#tablaPresentacion td, #tablaPresentacion th
	{
		font-size: 7.5px;
		padding: 2px;
		text-align: left;
		vertical-align: middle;
		border-collapse: collapse;
	}

	#tablaContenido td, #tablaContenido th
	{
		border: 1px solid black;
		font-size: 8px;
		padding: 4px;
		text-align: left;
		vertical-align: middle;
		border-collapse: collapse;
		text-transform: uppercase;
	}

	#tablaContenido th
	{
		background-color:#337ab7;
		color:white;
		text-align:center;
	}

	table
	{
		border-collapse: collapse;
	}

	#footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 100px; }
  #footer .page:after { content: counter(page, upper-roman); }

</style>
<head>
	<title>FORMATO FE-03</title>
	<meta charset="utf-8">
</head>
<body>
	<div id="header">
    	<table style="width: 100%;margin-top: -20px">
			<tr>
				<td style="width: 75px;">
					<img style="width: 60px;" src="./assets/images/peru.jpg">
				</td>
			<td id="header_texto">
					<div style="text-align: center; font-size: 13px;"><b>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</b></div>
					<div style="text-align: center; font-size: 12px;">"Año del Fortalecimiento de la Soberanía Nacional"</div>					
				</td>
				<td style="width:75px;">
					<img style="width:60px;" src="./assets/images/logoUniq.png">
				</td>
			</tr>
		</table>
  	</div>
  	<div id="footer">
		<div style="text-align: left; font-size: 10px;">Usuario: <?php echo $this->session->userdata('nombreUsuario')?> | fecha: <?php echo date("d/m/Y");?></div>
		</div>
	<div id="content">
		<div style="text-align: center; font-size: 13px;"><b>FORMATO FE-03B</b></div>
		<div style="text-align: center; font-size: 13px; padding-bottom:10px;"><b>VALORIZACIÓN MENSUAL DE MAYORES METRADOS</b></div>
		<div style="text-align: center;font-size: 11px;margin-bottom: 15px;text-transform:uppercase;"><b>MES DE: <?=$mes?></b></div>		
		<div style="font-size: 8px;">
			<table id="tablaPresentacion" style="width: 100%">
				<tr>
					<td style="width: 8%;font-weight:bold;">PROYECTO</td>
					<td style="width: 92%">: <?=$expedienteTecnico->nombre_pi;?> </td>
				</tr>				
				<tr>
					<td style="width: 8%;font-weight:bold;">FTE. FTO</td>
					<td style="width: 92%">: <?=$expedienteTecnico->fuente_financiamiento_et;?> </td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">MODALIDAD</td>
					<td style="width: 92%">: <?=$expedienteTecnico->modalidad_ejecucion_et;?> </td>
				</tr>
			</table>    
		</div>
		<br>
		<table id="tablaContenido" style="width: 100%; font-size:10px;">
			<thead>
				<tr>
					<th rowspan="3">ÍTEM</th>
					<th rowspan="3">DESCRIPCIÓN</th>
					<th rowspan="3">UNIDAD</th>
					<th rowspan="2" colspan="3" >PRESUPUESTO</th>
					<th colspan="7">AVANCES</th>
					<th colspan="3" rowspan="2">SALDO</th>
				</tr>
				<tr>
					<th colspan="2">ANTERIOR</th>
					<th colspan="2">ACTUAL</th>
					<th colspan="3">ACUMULADO</th>
				</tr>
				<tr>
					<th>Metrado</th>
					<th>P.Unit. S/.</th>
					<th>Pres.</th>
					<th>Metrado</th>
					<th>Valoriz. S/.</th>
					<th>Metrado</th>
					<th>Valoriz. S/.</th>
					<th>Metrado</th>
					<th>Valoriz. S/.</th>
					<th>%</th>
					<th>Metrado</th>
					<th>Valoriz. S/.</th>
					<th>%</th>
				</tr>
			</thead>
			<tbody>

			<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
					if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
						?>
			<td colspan="16" style="text-align:center; background-color:#cbe1f6;"><b>ADMINISTRACIÓN DIRECTA</b></td>
			<?php } ?>
				<?php foreach($expedienteTecnico->childComponente as $key => $value){ ?>
					<tr class="elementoBuscar">
						<td><b><?=$value->numeracion?></b></td>
						<td style="text-align: left;" colspan="15"><b><?=html_escape($value->descripcion)?></b></td>
					</tr>
					<?php foreach($value->childMeta as $index => $item){ ?>
						<?= mostrarAnidado($item, $expedienteTecnico)?>
					<?php } ?>
				<?php } }?>

			<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
					if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
						?>
			<td colspan="16" style="text-align:center; background-color:#cbe1f6;"><b>ADMINISTRACIÓN INDIRECTA</b></td>
			<?php } ?>
				<?php foreach($expedienteTecnico->childComponenteInd as $key => $value){ ?>
					<tr class="elementoBuscar">
						<td><b><?=$value->numeracion?></b></td>
						<td style="text-align: left;" colspan="15"><b><?=html_escape($value->descripcion)?></b></td>
					</tr>
					<?php foreach($value->childMeta as $index => $item){ ?>
						<?= mostrarAnidado($item, $expedienteTecnico)?>
					<?php } ?>
				<?php } }?>
			</tbody>
		</table>
	</div>
</body>
</html>