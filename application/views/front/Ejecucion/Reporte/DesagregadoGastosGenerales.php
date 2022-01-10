<?php
function mostrarMetaAnidada($meta)
{
	$htmlTemp='<p class="nivel'.$meta->nivel.'">'.
		'<b>'.@$meta->clasificador.' '.strtoupper(html_escape($meta->desc_meta)).'</b>'.
	'</p>';

	if(count($meta->childMeta)==0)
	{
		$sumatoria = 0;
		$htmlTemp.='<table class="tablaPartidas"><tr><th style="width:5%">Item</th><th style="width:40%">Descripcion</th><th style="width:10%">U.M</th><th style="width:5%">Cantidad</th><th style="width:10%">P.U.</th><th style="width:15%">Subtotal</th></tr>';
		foreach($meta->childPartida as $key => $value)
		{
			$sumatoria+=$value->parcial;
			$htmlTemp.='<tr><td>'.$value->numeracion.'.</td>'.
				'<td style="text-align: left;">'.strtoupper(html_escape(@$value->desc_partida)).'</td>'.
				'<td style="text-align: left;">'.strtoupper(html_escape(@$value->descripcion)).'</td>'.
				'<td style="text-align: right;">'.@$value->cantidad.'</td>'.
				'<td style="text-align: right;">'.a_number_format(@$value->precio_unitario , 2, '.',",",3).'</td>'.
				'<td style="text-align: right;">'.a_number_format(@$value->parcial , 2, '.',",",3).'</td>'.
			'</tr>';
		}
		$htmlTemp.='<tr><td colspan="5">TOTAL</td>'.
				'<td style="text-align: right;">'.a_number_format($sumatoria , 2, '.',",",3).'</td>'.
			'</tr>';

		$htmlTemp.='</table><br>';
	}

	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarMetaAnidada($value);
	}

	return $htmlTemp;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Desagregado de Gastos Generales</title>
	<style>
	.nivel1
	{
		color:white;
		background-color:#337ab7;
		padding:5px;
		text-align:left;
	}
	.nivel2
	{
		color:black;
		background-color:#e2f0f5;
		padding:4px;
		text-align:left;
		padding-left:30px;
	}
	p
	{
		text-align:left;
		padding-left:30px;
	}
	.tablaPartidas
	{
		margin-left: 40px;
		width:98%;
		border: 1px solid black;
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    border-collapse: collapse;

	}
	.tablaPartidas td {
	    border: 1px solid black;
	    padding: 2px 6px;
	}
	.tablaPartidas th {
	    text-align: left;
	    border: 1px solid black;
	    padding: 4px;
		font-weight:bold;
	}
	#tablaResumen
	{
		width:100%;
		border: 1px solid black;
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    border-collapse: collapse;
	}
	#tablaResumen td {
	    border: 1px solid black;
	    padding: 2px 6px;
	}
	#tablaResumen th {
	    text-align: left;
	    border: 1px solid black;
	    padding: 4px;
		font-weight:bold;
		color:white;
		background-color:#337ab7;
	}
	</style>
</head>
<body style="font-family: Helvetica;text-align: center;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 85px;">
				<img style="width: 50px;" src="./assets/images/peru.jpg">
			</td>
			<td id="header_texto">
				<div style="text-align: center;"><b>GOBIERNO REGIONAL DE APURÍMAC</b></div>
				<div style="text-align: center; font-size: 12px;">"Año del Diálogo y la Reconciliación Nacional"</div>
			</td>
			<td style="width: 85px;">
				<img style="width: 60px;" src="./assets/images/apurimac.png">
			</td>
		</tr>
	</table><br>
	<div style="text-align: center;font-size: 13px;font-weight:bold; ">FORMATO FF-08</div>
	<div style="text-align: center;font-size: 15px;font-weight:bold;">DESAGREGADO DE GASTOS GENERALES</div>
	<div style="text-align: center;font-size: 11px;margin-top: 15px; border-color: red; margin-left: 10px;"><b>PROY: "<?=@$expedienteTecnico->nombre_pi;?>"</b></div>
	<br>
	<div>
		<div style="font-size: 9px;">
			<table id="tablaResumen">
				<tr>
					<th>CÓDIGO</th>
					<th>ESPECIFICA DE GASTOS</th>
					<th>G. GRALES</th>
				</tr>
				<?php foreach($expedienteTecnico->childCostoIndirecto as $key => $value) {  ?>
					<?php foreach($value->childMeta as $key => $item) {  ?>
					<tr>
						<td><?=@$item->clasificador?></td>
						<td><?=strtoupper(html_escape(@$item->desc_meta))?></td>
						<td style="text-align: right;">S/. <?=a_number_format($item->costoMeta , 2, '.',",",3)?></td>				
					</tr>
					<?php } ?>
					<tr>
						<td colspan="2">TOTAL GASTOS GENERALES</td>
						<td style="text-align: right;">S/. <?=a_number_format($value->costoComponente , 2, '.',",",3)?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<div style="font-size: 9px;">			
			<?php foreach(@$expedienteTecnico->childComponente as $key => $value) {  ?>
				<?php foreach($value->childMeta as $index => $item){ ?>
					<?=mostrarMetaAnidada($item)?>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</body>
</html>