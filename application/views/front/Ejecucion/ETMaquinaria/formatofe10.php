<!DOCTYPE html>
<html>
<head>
	<title>FORMATO FE-10</title>
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
	#tablaMaquinaria td, #tablaMaquinaria th
	{
		border:1px solid black;
		font-size: 8px;
		padding: 2px 5px;
		vertical-align: middle;
		text-transform: uppercase;
		text-align:center;
	}
	#tablaMaquinaria th
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
	#footer { position: fixed; left: 0px; bottom: -200px; right: 0px; height: 100px; }
    #footer .page:after { content: counter(page, upper-roman); }
</style>
</head>
<body>
	<div>
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
		<div style="text-align: left; font-size: 12px;">Usuario: <?php echo $this->session->userdata('nombreUsuario')?> | fecha:<?php echo date("d/m/Y");?></div>
		</div>
		<div style="text-align: center; font-size: 13px;padding-bottom:6px;text-transform:uppercase;"><b>FORMATO FE-10 <br> RESUMEN DE HORAS MAQUINARIA MENSUAL</b></div>
		<div style="font-size: 8px;">
			<p><?=date('d/m/Y H:i:s')?></p>
			<table id="tablaPresentacion" style="width: 100%">
				<tr>
					<td style="width: 8%;font-weight:bold;">PROYECTO</td>
					<td style="width: 92%">: <?=@$proyectoInversion->nombre_pi?> </td>
				</tr>				
				<tr>
					<td style="width: 8%;font-weight:bold;">MODALIDAD</td>
					<td style="width: 92%">: <?=@$proyectoInversion->modalidad_ejecucion_et?> </td>
				</tr>
				<tr>
					<td style="width: 8%;font-weight:bold;">FECHA</td>
					<td style="width: 92%">: <?=@$fecha?></td>
				</tr>
			</table>    
		</div>
		<br>
		<table id="tablaMaquinaria" style="width: 100%;">
			<thead>
				<tr>
					<th rowspan="2">NOMBRE PROVEEDOR/PROPIA</th>
					<th rowspan="2">CONDICIÓN</th>
					<th rowspan="2">DESCRIPCIÓN DE LA MAQUINARIA (Capacidad - Placa)</th>
					<th colspan="3">HORAS TRABAJADAS</th>
					<th rowspan="2">PRECIO ALQUILER POR HORA</th>
					<th rowspan="2">COSTO TOTAL</th>
				</tr>
				<tr>
					<th>ACUMULADO ANTERIOR</th>
					<th>MES</th>
					<th>ACUMULADO ACTUAL</th>
				</tr>
			</thead>
			<tbody>	
			<?php $costoTotal=0;
			foreach ($listadoMaquinaria as $key => $value) 
			{
				$costoTotal+= (@$value->ejecucionanterior+@$value->ejecucionactual)*@$value->costo_hora;
			?>
				<tr>
					<td style="width:22%;text-align:left;"><?=$value->proveedor?></td>
					<td style="width:8%;"><?=$value->tipo?></td>
					<td style="width:32%;text-align:left;"><?=$value->maquinaria?> <?=$value->nro_placa_motor?></td>
					<td style="width:7%;"><?=$value->ejecucionanterior?></td>
					<td style="width:7%;"><?=$value->ejecucionactual?></td>
					<td style="width:7%;"><?=$value->ejecucionanterior+$value->ejecucionactual?></td>
					<td style="width:7%;"><?=$value->costo_hora?></td>
					<td style="width:10%;"><?=number_format((@$value->ejecucionanterior+@$value->ejecucionactual)*@$value->costo_hora, 2, '.', ',')?></td>					
				</tr>
			<?php } ?>	
			<tr>
				<td colspan="7">TOTAL</td>
				<td><?=number_format(@$costoTotal, 2, '.', ',')?></td>
			</tr>	

			</tbody>
		</table>
	</div>
</body>
</html>