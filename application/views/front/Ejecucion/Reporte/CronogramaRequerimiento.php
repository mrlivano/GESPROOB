<html>
<head>
	<title>Cronograma de Requerimiento</title>
	<meta charset="utf-8">
	<style>
		body
		{
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		}
		#tableValorizacion td, #tableValorizacion th
		{
			border: 1px solid black;
			font-size: 8px;
			padding: 5px 2px;
			text-align: center;
			vertical-align: middle;
			text-transform: uppercase;
			
		}
		#tableValorizacion th
		{
			color:white;
			background-color:#337ab7;
			font-weight: bold;
			padding:2px 5px;
			font-size:9px;
		}
		table
		{
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<div id="header">
    	<table style="width: 100%">
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
  	</div>
	<div id="content">
		<div style="text-align: center; font-size: 13px;"><b>FORMATO FF-<?=@$numeroReporte?></b></div>
		<div style="text-align: center; font-size: 13px; padding-bottom:10px;text-transform:uppercase;"><b>CRONOGRAMA REQUERIMIENTO DE <?=@$nombreReporte?></b></div>
		<div style="text-align: center;font-size: 11px;margin-bottom: 15px;"><b>"<?=@$expedienteTecnico->nombre_pi;?>"</b></div>				
		<table id="tableValorizacion" style="width: 100%;">
			<thead>
				<tr>
					<th>DESCRIPCIÓN</th>
					<th>UND.</th>
					<th>CANT.</th>
					<th>P.U. S/.</th>
					<th>TOTAL S/.</th>
					<?php if($expedienteTecnico->num_meses!=null)
					{
						for($i=0; $i<$expedienteTecnico->num_meses; $i++)
						{ ?>
							<th>M<?=($i+1)?> S/.</th>
						<?php }
					} ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach($recurso as $key => $value) { ?>
					<?php foreach($value->childInsumo as $key => $item) { ?>								
					<tr>
						<td style="text-align: left;width:25%"><?=$item->desc_insumo?></td>
						<td style="width:7%;"><?=@$item->descripcion?></td>
						<td style="text-align: right;width:7%;"><?=$item->cantidad?></td>
						<td style="text-align: right;width:7%;"><?=a_number_format($item->precioUnitario , 2, '.',",",3)?></td>
						<td style="text-align: right;width:7%;"><?=a_number_format($item->parcial , 2, '.',",",3)?></td>
						<?php if($expedienteTecnico->num_meses!=null) {
							for($i=0; $i<$expedienteTecnico->num_meses; $i++) {
								if(!isset($sumatoriasTotales[$i]))
								{
									$sumatoriasTotales[]=0;
								} 
								$cantidadPorMes=0;
								$costoPorMes=0;
								foreach($item->childMesValorizacion as $key => $child) { 
									if($child->numero_mes==($i+1))
									{
										$sumatoriasTotales[$i]+=$child->parcial;
										$cantidadPorMes+=$child->cantidad;
										$costoPorMes+=$child->parcial;
									}
								}
								?>
								<td style="text-align: right;"><?=a_number_format(@$costoPorMes , 2, '.',",",3)?></td>
							<?php }
						} ?>
					</tr>
					<?php } ?>
					<tr>
						<td colspan="4" style="text-align: left;">TOTAL</td>
						<td style="text-align: right;"><b><?=a_number_format(@$value->costoTotalRecurso , 2, '.',",",3)?></b></td>
						<?php if($expedienteTecnico->num_meses!=null) {
							for($i=0; $i<$expedienteTecnico->num_meses; $i++) { ?>
								<td style="text-align: right;"><b><?=a_number_format(@$sumatoriasTotales[$i], 2, '.',",",3);?></b></td>
							<?php }
						}?>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</body>
</html>
