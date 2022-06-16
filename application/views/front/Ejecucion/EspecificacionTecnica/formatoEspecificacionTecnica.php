<?php
function mostrarAnidado($meta, $expedienteTecnico)
{
	$htmlTemp='';

	$htmlTemp.='<h3>'.$meta->numeracion.'. '.$meta->desc_meta.'</h3>';
	if(count($meta->childMeta)==0)
	{		
		foreach($meta->childPartida as $key => $value)
		{
			$htmlTemp.='<h4>'.$value->numeracion.'. '.$value->desc_partida.'</h4>';
			$htmlTemp.='<div style="text-align: justify;text-justify: inter-word;font-size:12px;">'.$value->especificacion_tecnica;
			$htmlTemp.='</div>';					
		}		
	}
	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarAnidado($value, $expedienteTecnico);
	}
	return $htmlTemp;
}
?>

<html>
<head>
  <style>
    @page { margin: 100px 50px;  }
    #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 100px;text-align: center;}
    #footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 100px; }
    #footer .page:after { content: counter(page, upper-roman); }

	body
	{
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	}

	hr { 
		display: block;
		margin-left: auto;
		margin-right: auto;
		border-style: inset;
		border-width: 1px;
	} 
	body{
		font-size:12px;
	}
	p {
		margin: 1 auto;
	}
	table, th, td {
    	padding: 5px 15px;
	}
	h2 {
		text-transform:uppercase;
		font-size:14px;
	}
	h3 {
		text-transform:uppercase;
		font-size:13px;
	}
	h4 {
		text-transform:uppercase;
		font-size:12px;
		text-decoration: underline;
	}
  </style>
</head>
<body>
	<div id="header">
		<table style="width: 100%;">
			<tr>
				<td style="width: 85px;">
					<img style="width: 50px;" src="./assets/images/peru.jpg">
				</td>
				<td>
					<div style="text-align: center;font-size: 15px;"><b>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</b></div>
					<div style="text-align: center; font-size: 12px;">"Año del Fortalecimiento de la Soberanía Nacional"</div>
				</td>
				<td style="width: 85px;">
					<img style="width: 60px;" src="./assets/images/logoUniq.png">
				</td>
			</tr>
		</table>
		<hr>
  	</div>
  	<div id="footer">
	  	<hr class="style4">
	  	<div style="text-align: center; font-size: 9px;"><span><?=$expedienteTecnico->proyecto_et?></span></div>	  
  	</div>
  	<div id="content">
	  	<div style="text-align: center; font-size: 15px;"><b>FORMATO FF-04</b></div>
		<div style="text-align: center; font-size: 15px;"><b>ESPECIFICACIONES TECNICAS</b></div>
	  	<div id="Generalidades">
		  	<h2>GENERALIDADES</h2>
		  	<div style="text-align: justify;text-justify: inter-word;">
				<?=@$expedienteTecnico->generalidad_especificacion_tecnica?>
			</div>
		</div>
		<div>
		<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
		if($expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
			?>
		<br><span><b>ADMINISTRACIÓN DIRECTA</b></span><br><br>
		<?php } 
		foreach($expedienteTecnico->childComponente as $key => $value){ ?>
				<h2><?=$value->numeracion?>. <?=html_escape($value->descripcion)?></h2>
				<?php foreach($value->childMeta as $index => $item) { ?>
					<?= mostrarAnidado($item, $expedienteTecnico)?>
				<?php } ?>
			<?php } }?>

			<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
		if($expedienteTecnico->modalidad_ejecucion_et=='MIXTO'){
			?>
		<br><span><b>ADMINISTRACIÓN INDIRECTA</b></span><br><br>
		<?php } 
		foreach($expedienteTecnico->childComponenteInd as $key => $value){ ?>
				<h2><?=$value->numeracion?>. <?=html_escape($value->descripcion)?></h2>
				<?php foreach($value->childMeta as $index => $item) { ?>
					<?= mostrarAnidado($item, $expedienteTecnico)?>
				<?php } ?>
			<?php } }?>
		</div>
	</div>
</body>
</html>