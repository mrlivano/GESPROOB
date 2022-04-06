<style>

	#tableValorizacion td, #tableValorizacion th
	{
		border: 1px solid black;
		font-size: 8px;
		padding: 5px 8px;
		text-align: center;
		vertical-align: middle;		
	}

	#tableValorizacion th
	{
		background-color:#e2f0f5;	
	}

	table
	{
		border-collapse: collapse;
	}

	.nivel1
	{
		color:white;
		background-color:#337ab7;
		padding:5px;
		text-align:center;
		text-transform:uppercase;
		font-size:11px;
		font-weight:bold;
	}
</style>
<head>
	<title>FORMATO FF-12 - Lista de Insumos</title>
	<meta charset="utf-8">
</head>
<body style="font-family: Helvetica;text-align: center;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 85px;">
				<img style="width: 50px;" src="./assets/images/peru.jpg">
			</td>
			<td id="header_texto">
				<div style="text-align: center;"><b>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</b></div>
				<div style="text-align: center; font-size: 12px;">"Año del Fortalecimiento de la Soberanía Nacional"</div>
			</td>
			<td style="width: 85px;">
				<img style="width: 60px;" src="./assets/images/logoUniq.png">
			</td>
		</tr>
	</table>
	<br>
	<div style="text-align: center;font-size: 13px;font-weight:bold; ">FORMATO FF-12</div>
	<div style="text-align: center;font-size: 15px;font-weight:bold;">LISTA DE INSUMOS DEL COSTO DIRECTO</div>
	<div style="text-align: center;font-size: 11px;margin-top: 15px; border-color: red; margin-left: 10px;"><b>"<?=@$expedienteTecnico->nombre_pi;?>"</b></div>
	<br>
	<div>
		<?php foreach($recurso as $key => $value) { ?>
			<p class="nivel1"><?=$value->desc_recurso?></p>
			<table id="tableValorizacion" style="width:100%;">
				<thead>
					<tr>
						<th style="width:40%;">RECURSO</th>
						<th style="width:10%;">UNIDAD</th>
						<th style="width:10%;">CANTIDAD</th>
						<th style="width:10%;">PRECIO S/.</th>
						<th style="width:15%;">PARCIAL S/. </th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($value->childInsumo as $key => $item) { ?>
						<tr>
							<td style="text-align: left;"><?=html_escape($item->desc_insumo)?></td>
							<td><?=html_escape($item->descripcion)?></td>
							<td style="text-align: right;"><?=$item->cantidad?></td>
							<td style="text-align: right;"><?=a_number_format($item->precioUnitario , 2, '.',",",3)?></td>
							<td style="text-align: right;"><?=a_number_format($item->parcial , 2, '.',",",3)?></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan = "4">TOTAL</td>
						<td style="text-align: right;"><b><?=a_number_format($value->costoTotalRecurso , 2, '.',",",3)?><b></td>					
					</tr>
				</tbody>
			</table><br>
		<?php } ?>
		<p style="text-align: right;font-size:11px;"><b>TOTAL S/. <?=a_number_format(@$expedienteTecnico->costoDirecto , 2, '.',",",3)?></b><p>

	</div>
</body>