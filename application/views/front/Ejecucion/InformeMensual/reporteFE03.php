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
		<p>FORMATO FE-01 <br>INFORME MENSUAL<br><?=@$fechaReporte?></p>DATOS GENERALES DEL PROYECTO <br> 
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
				<td><?=@$detalleFormato[0]->residente?></td>
			</tr>
			<tr>
				<th>SUPERVISOR DE PROYECTO</th>
				<td><?=@$detalleFormato[0]->supervisor?></td>
			</tr>
			<tr>
				<th>ASISTENTE ADMINISTRATIVO</th>
				<td><?=@$detalleFormato[0]->asistente_administrativo?></td>
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
				<p class="firsttext">PARTIDAS EJECUTADAS DURANTE EL PERIODO<p>
			</div>			
			<div class="secondbox">
				<div class="secondcontent">
					<p class="secondtext">1.1.- GENERALIDADES DEL PROYECTO</p>
				</div>				
				<div class="thirdbox">
					<div class="thirdcontent">
						<p class="thirdtext">1.1.- UBICACIÓN</p>
						<table class="tablastand tablaMayuscula">
							<tr>
								<th>REGIÓN</th>
								<td style="width:80%;"><?=@$detalleFormato[0]->region?></td>
							</tr>
							<tr>
								<th>PROVINCIA</th>
								<td><?=@$detalleFormato[0]->provincia?></td>
							</tr>
							<tr>
								<th>DISTRITO</th>
								<td><?=@$detalleFormato[0]->distrito?></td>
							</tr>
							<tr>
								<th>DIRECCIÓN Y/O UBICACIÓN</th>
								<td><?=@$detalleFormato[0]->direccion?></td>
							</tr>
						</table>
						<br>
						<p class="thirdtext">1.2.- FUNCIÓN PROGRAMÁTICA</p>
						<table class="tablastand tablaMayuscula">
							<tr>
								<th>FUNCIÓN</th>
								<td style="width:80%;"><?=@$proyectoInversion->funcion_et?></td>
							</tr>
							<tr>
								<th>DIVISIÓN FUNCIONAL</th>
								<td><?=@$proyectoInversion->programa_et?></td>
							</tr>
							<tr>
								<th>GRUPO FUNCIONAL</th>
								<td><?=@$proyectoInversion->sub_programa_et?></td>
							</tr>
							<tr>
								<th>PROYECTO</th>
								<td><?=@$proyectoInversion->nombre_pi?></td>
							</tr>
							<!--<tr>
								<th>COMPONENTE</th>
								<td><?=@$proyectoInversion->componente_et?></td>
							</tr>-->
							<tr>
								<th>META</th>
								<td><?=@$proyectoInversion->meta_et?></td>
							</tr>
							<tr>
								<th>MODALIDAD</th>
								<td><?=@$proyectoInversion->modalidad_ejecucion_et?></td>
							</tr>
						</table>
						<br>
						<p class="thirdtext">1.3.- ASPECTOS FINANCIEROS</p>
						<table class="tablastand">
							<tr>
								<th>MONTO APROBADO</th>
								<td style="width:20%;text-align:right;"><?=number_format(@$proyectoInversion->costo_total_inv_et, 2, '.', ',')?></td>
							</tr>
							<tr>
								<th>MONTO ASIGNADO</th>
								<td style="width:20%;text-align:right;"><?=number_format(@$montoasignado, 2, '.', ',')?></td>
							</tr>
							<tr>
								<th colspan="2">FUENTE FINANCIAMIENTO</th>
							</tr>
							<?php foreach($fuenteFinanciamieto as $key => $fuente) { ?>
							<tr>
								<th><?=$fuente->nombre?></th>
								<td style="width:20%;text-align:right;"><?=number_format($fuente->pim, 2, '.', ',')?></td>
							</tr>
							<?php } ?>
							<tr>
								<th>TOTAL</th>
								<td style="width:20%;text-align:right;"><?=number_format(@$montoasignado, 2, '.', ',')?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>	

	</div>	
	</form>
</div> 
