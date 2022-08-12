<?php
function mostrarMetaAnidada($meta)
{
	$htmlTemp='<tr>'.
		'<td>'.$meta->numeracion.'.</td>'.
		'<td style="text-align: left;">'.strtoupper(html_escape($meta->desc_meta)).'</td>'.
		'<td style="text-align: center;"></td>'.
		'<td style="text-align: center;"></td>'.
	'</tr>';

	if(count($meta->childMeta)==0)
	{
		foreach($meta->childPartida as $key => $value)
		{
			$htmlTemp.='<tr>'.
				'<td>'.$value->numeracion.'.</td>'.
				'<td>'.strtoupper(html_escape($value->desc_partida)).'</td>'.
				'<td style="text-align: left;">'.strtoupper(html_escape($value->descripcion)).'</td>'.
				'<td style="text-align: right;">'.$value->cantidad.'</td>'.
			'</tr>';
		}
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
	<title>FORMATO FF-10</title>
	<style>
		body
		{
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		}
		table
		{
			border-collapse: collapse;
		}
		#tablaContenido td, #tablaContenido th
		{
			border: 1px solid black;
			font-size: 10px;
			padding: 4px;
			vertical-align: middle;
			text-align:left;
		}
		#tablaContenido th
		{
			background-color:#337ab7;
			color:white;	
			padding:8px 8px;			
		}

		#footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 100px; }
    #footer .page:after { content: counter(page, upper-roman); }
	</style>
</head>
<body style="font-family: Helvetica;text-align: center;">
	<div>
		<table style="margin-top: 10px;width: 100%; padding-right: 12px; padding-left: 12px;">
			<tr>
				<td style="width: 65px;">
					<img style="width: 60px;" src="./assets/images/peru.jpg">
				</td>
				<td>
					<div style="text-align: center; font-size: 13px;"><b>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</b></div>
					<div style="text-align: center; font-size: 12px;">"Año del Fortalecimiento de la Soberanía Nacional"</div>							
				</td>
				<td style="width: 65px;">
					<img style="width: 60px;" src="./assets/images/logoUniq.png">
				</td>
			</tr>
		</table>
	</div>
	<div id="footer">
		<div style="text-align: left; font-size: 12px;">Usuario: <?php echo $this->session->userdata('nombreUsuario')?> | fecha:<?php echo date("d/m/Y");?></div>
		</div>
	<div style="text-align: center; font-size: 13px;padding-top:2px;"><b>FORMATO FF-10</b></div>
	<div style="text-align: center; font-size: 13px;padding-bottom:15px;"><b>SUSTENTACIÓN DE METRADOS</b></div>
	<div style="font-size: 9px;">
		<table style="width: 100%;" id="tablaContenido">
			<thead>
				<tr>
					<th>PROY:</th>
					<th colspan="3"><?=html_escape($MostraExpedienteTecnicoExpe->nombre_pi)?></th>
				</tr>
				<tr>
					<th>ÍTEM</th>
					<th>DESCRIPCIÓN</th>
					<th>UND.</th>
					<th style="text-align: right;">TOTAL</th>
				</tr>
			</thead>
			<tbody>
			<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
					if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
						?>
			<td colspan="16" style="text-align:center; background-color:#cbe1f6;"><b>ADMINISTRACION DIRECTA</b></td>
			<?php } ?>
				<?php foreach($MostraExpedienteTecnicoExpe->childComponente as $key => $value){  ?>
					<tr>
						<td  style="width:10%;"><b><?=$value->numeracion?>.</b></td>
						<td  style="width:70%;"><b><?=strtoupper(html_escape($value->descripcion))?></b></td>
						<td  style="width:10%;"></td>
						<td  style="width:10%;"></td>
					</tr>
					<?php foreach($value->childMeta as $index => $item){ ?>
							<?=mostrarMetaAnidada($item)?>
					<?php } ?>
				<?php } }?>

				<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
					if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){
						?>
			<td colspan="16" style="text-align:center; background-color:#cbe1f6;"><b>ADMINISTRACION INDIRECTA</b></td>
			<?php } ?>
				<?php foreach($MostraExpedienteTecnicoExpe->childComponenteInd as $key => $value){  ?>
					<tr>
						<td  style="width:10%;"><b><?=$value->numeracion?>.</b></td>
						<td  style="width:70%;"><b><?=strtoupper(html_escape($value->descripcion))?></b></td>
						<td  style="width:10%;"></td>
						<td  style="width:10%;"></td>
					</tr>
					<?php foreach($value->childMeta as $index => $item){ ?>
							<?=mostrarMetaAnidada($item)?>
					<?php } ?>
				<?php } }?>
			</tbody>
		</table>
	</div>
</body>
</html>