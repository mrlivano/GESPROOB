<style>
	.informe
	{
		color:black;
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;		
		font-size:10px;
	}
	table
	{
		border-collapse: collapse;
		color:#35353e;
		width:100%;	
		font-size:10px;	
	}
	.tablastand td, .tablastand th
	{
		border:1px solid black;
		padding: 2px 5px;
		vertical-align: middle;		
	}
	.tablastand th
	{
		background-color:#f1f1f1;
		font-weight:bold;
		text-align:left;
	}
	.firstbox
	{
		margin: 0 0 10px;
	}
	.secondbox
	{
		margin: 5px 14px;
	}
	.thirdbox
	{
		margin: 0px 30px;
	}
	.firsttext
	{
		font-weight:bold;
	}
	.secondtext
	{
		text-decoration: underline;		
	}
	.tablacenter td, .tablacenter th
	{
		text-align:center;
	}
	.tablaMayuscula td, .tablacenter th
	{
		text-transform:uppercase;
	}
	.field:focus 
	{
    	border: 2px solid #2e6da4;		
	}
	.cuadroContenedor
	{
		border:1px solid black;
		padding: 2px 10px;
		font-size:12px;
		text-align: justify;
    	text-justify: inter-word;
	}
	.titulo
	{
		text-align:center;
		text-transform:uppercase;
		font-weight:bold;
		font-size:14px;

	}
</style>
<div class="informe">
	<div class="titulo">
		<!-- <p>FORMATO FE-02</p>
		<p>INFORME MENSUAL</p>
		<p>MES : <?=@$fechaReporte?></p> -->
		<p>FORMATO FE-03 <br>INFORME MENSUAL<br><?=@$fechaReporte?></p>DETALLE DE PARTIDAS EJECUTADAS <br> 
	</div>
	<br>
	<form id="frmFichaInforme">
	<div class="cuerpo">
		<table class="tablastand tablaMayuscula">
			<tr>
				<th>NOMBRE DEL PROYECTO</th>
				<td style="width:80%;"><?=@$proyectoInversion->nombre_pi?></td>
			</tr>
			<tr>
				<th>CODIGO ÚNICO</th>
				<td><?=@$proyectoInversion->codigo_unico_pi?></td>
			</tr>
			<tr>
				<th>UNIDAD EJECUTORA</th>
				<td><?=@$proyectoInversion->nombre_ue?></td>
			</tr>
			<tr>
				<th>RESIDENTE DE PROYECTO</th>
				<td><?=(@$detalleFormato[0]->residente=='' ? @$responsableDetalle->residente : @$detalleFormato[0]->residente)?></td>
			</tr>
			<tr>
				<th>SUPERVISOR DE PROYECTO</th>
				<td><?=(@$detalleFormato[0]->supervisor=='' ? @$responsableDetalle->supervisor : @$detalleFormato[0]->supervisor)?></td>
			</tr>
			<tr>
				<th>ASISTENTE ADMINISTRATIVO</th>
				<td><?=(@$detalleFormato[0]->asistente_administrativo=='' ? @$responsableDetalle->asistente_administrativo : @$detalleFormato[0]->asistente_administrativo)?></td>
			</tr>
		</table>
		<table class="tablastand" style="margin-top: 6px;">
			<tr>
				<th>FECHA</th>
				<td style="width:80%;"><?=date('d/m/Y')?></td>
			</tr>
		</table>
		<br>
		
		<div class="firstbox">
			<div class="firstcontent">
				<p class="firsttext">EJECUCIÓN DE OBRA<p>
			</div>			
			<div class="secondbox">
				<div class="secondcontent">
					
					<p class="secondtext">PARTIDAS EJECUTADAS DURANTE EL PERIODO</p>
					<p>OBRAS PRINCIPAL EXPEDIENTE TÉCNICO</p>
					<table class="tablastand">
						<tr>
							<th>ÍTEM</th>
							<th>PARTIDAS DEL EXPEDIENTE APROBADO</th>
							<th>UND</th>
							<th>METRADO</th>
						</tr>
						<?php foreach($arrayPartidaEjecutada as $partidaEjecutada) 
						{?>
						<tr>
							<td style="width:10%;"><?=$partidaEjecutada->numeracion?></td>
							<td style="width:50%;"><?=$partidaEjecutada->desc_partida?></td>
							<td style="width:20%;"><?=$partidaEjecutada->descripcion?></td>
							<td style="width:20%;"><?=$partidaEjecutada->metradoEjecutado?></td>
						</tr>
						<?php } ?>
					</table>
					<br>
					<div class="cuadroContenedor">
						<p>Información descriptiva de metas físicas alcanzadas: <?=@$detalleFormato[0]->descripcion_partidas_ejecutadas?></p>
					</div>
					<p>OBRAS ADICIONALES</p>
					<table class="tablastand">
						<tr>
							<th>ÍTEM</th>
							<th>PARTIDAS DEL EXPEDIENTE APROBADO</th>
							<th>UND</th>
							<th>METRADO</th>
						</tr>
						<?php foreach($arrayAdicional as $adicional) 
						{?>
						<tr>
							<td style="width:10%;"><?=$adicional->numeracion?></td>
							<td style="width:50%;"><?=$adicional->desc_partida?></td>
							<td style="width:20%;"><?=$adicional->descripcion?></td>
							<td style="width:20%;"><?=$adicional->metradoEjecutado?></td>
						</tr>
						<?php } ?>
					</table>
					<br>
					<div class="cuadroContenedor">
						<p>Información descriptiva de adicionales de obra: <?=@$detalleFormato[0]->descripcion_adicionales?></p>
					</div>
					
				</div>					
			</div>
		</div>

	</div>	
	</form>
</div> 
