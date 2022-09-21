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
		<p>FORMATO FE-05 <br>INFORME MENSUAL<br><?=@$fechaReporte?></p>RESUMEN DE ESTADO FINANCIERO <br> 
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

					<p class="secondtext">INFORMACIÓN FÍSICA - FINANCIERA DEL PROYECTO</p>
					<table class="tablastand tablacenter" style="text-align:center;">
						<tr>
							<th rowspan="2">AVANCE FÍSICO</th>
							<th rowspan="2">Presupuesto de Obra S/. </th>
							<th colspan="2">Anterior</th>
							<th colspan="2">Actual</th>
							<th colspan="2">Acumulado</th>
							<th colspan="2">Saldo</th>
						</tr>
						<tr>
							<th>S/.</th>
							<th>%</th>
							<th>S/.</th>
							<th>%</th>
							<th>S/.</th>
							<th>%</th>
							<th>S/.</th>
							<th>%</th>
						</tr>
						<tr>
							<th style="width:10%;">PROGRAMADO</th>
							<td style="width:18%;"><?=number_format(@$presupuestoProgramado, 2, '.', ',')?></td>
							<td style="width:10%;"><?=number_format(@$presupuestoAnterior, 2, '.', ',')?></td>
							<td style="width:8%;"><?=(@$presupuestoProgramado!=0 ? number_format((100*@$presupuestoAnterior)/@$presupuestoProgramado, 2, '.', ','):'')?>%</td>
							<td style="width:10%;"><?=number_format(@$presupuestoActual, 2, '.', ',')?></td>
							<td style="width:8%;"><?=(@$presupuestoProgramado!=0 ? number_format((100*@$presupuestoActual)/@$presupuestoProgramado, 2, '.', ',') :'')?>%</td>
							<td style="width:10%;"><?=number_format(@$presupuestoAnterior+@$presupuestoActual, 2, '.', ',')?></td>
							<td style="width:8%;"><?=(@$presupuestoProgramado!=0 ? number_format((100*(@$presupuestoAnterior+@$presupuestoActual))/@$presupuestoProgramado, 2, '.', ',') :'')?>%</td>
							<td style="width:10%;"><?=number_format(@$presupuestoProgramado-(@$presupuestoAnterior+@$presupuestoActual), 2, '.', ',')?></td>
							<td style="width:8%;"><?=(@$presupuestoProgramado!=0 ? number_format((100*(@$presupuestoProgramado-(@$presupuestoAnterior+@$presupuestoActual)))/@$presupuestoProgramado, 2, '.', ',') :'')?>%</td>
						</tr>
						<tr>
							<th>EJECUTADO</th>
							<td><?=number_format(@$presupuestoProgramado, 2, '.', ',')?></td>
							<td><?=number_format(@$ejecutadoAnterior, 2, '.', ',')?></td>
							<td><?=(@$presupuestoProgramado!=0 ? number_format((100*@$ejecutadoAnterior)/@$presupuestoProgramado, 2, '.', ',') :'')?>%</td>
							<td><?=number_format(@$ejecutadoActual, 2, '.', ',')?></td>
							<td><?=(@$presupuestoProgramado!=0 ? number_format((100*@$ejecutadoActual)/@$presupuestoProgramado, 2, '.', ',') :'')?>%</td>
							<td><?=number_format(@$ejecutadoAnterior+@$ejecutadoActual, 2, '.', ',')?></td>
							<td><?=(@$presupuestoProgramado!=0 ? number_format((100*(@$ejecutadoAnterior+@$ejecutadoActual))/@$presupuestoProgramado, 2, '.', ',') :'')?>%</td>
							<td><?=number_format(@$presupuestoProgramado-(@$ejecutadoAnterior+@$ejecutadoActual), 2, '.', ',')?></td>
							<td><?=(@$presupuestoProgramado!=0 ? number_format((100*(@$presupuestoProgramado-(@$ejecutadoAnterior+@$ejecutadoActual)))/@$presupuestoProgramado, 2, '.', ',') :'')?>%</td>
						</tr>
						<tr>
							<th>ADICIONALES</th>
							<td><?=number_format(@$adicionalProgramado, 2, '.', ',')?></td>
							<td><?=number_format(@$adicionalAnterior, 2, '.', ',')?></td>
							<td><?=(@$adicionalProgramado!=0 ? number_format((100*@$adicionalAnterior)/@$adicionalProgramado, 2, '.', ',') :'')?>%</td>
							<td><?=number_format(@$adicionalActual, 2, '.', ',')?></td>
							<td><?=(@$adicionalProgramado!=0 ? number_format((100*@$adicionalActual)/@$adicionalProgramado, 2, '.', ',') :'')?>%</td>
							<td><?=number_format(@$adicionalAnterior+@$adicionalActual, 2, '.', ',')?></td>
							<td><?=(@$adicionalProgramado!=0 ? number_format((100*(@$adicionalAnterior+@$adicionalActual))/@$adicionalProgramado, 2, '.', ',') :'')?>%</td>
							<td><?=number_format(@$adicionalProgramado-(@$adicionalAnterior+@$adicionalActual), 2, '.', ',')?></td>
							<td><?=(@$adicionalProgramado!=0 ? number_format((100*(@$adicionalProgramado-(@$adicionalAnterior+@$adicionalActual)))/@$adicionalProgramado, 2, '.', ',') :'')?>%</td>
						</tr>
					</table>
					<br>
					<table class="tablastand tablacenter">
						<tr>
							<th rowspan="2">AVANCE FINANCIERO</th>
							<th rowspan="2">Presupuesto de Obra S/. </th>
							<th colspan="2">Anterior</th>
							<th colspan="2">Actual</th>
							<th colspan="2">Acumulado</th>
							<th colspan="2">Saldo</th>
						</tr>
						<tr>
							<th>S/.</th>
							<th>%</th>
							<th>S/.</th>
							<th>%</th>
							<th>S/.</th>
							<th>%</th>
							<th>S/.</th>
							<th>%</th>
						</tr>
						<tr>
							<th style="width:10%;">PROGRAMADO</th>
							<td style="width:18%;"><?=number_format(@$presupuestoProgramado+@$costoIndirectoProgramado, 2, '.', ',')?></td>
							<td style="width:10%;"><?=number_format(@$presupuestoAnterior+@$costoIndirectoAnterior, 2, '.', ',')?></td>
							<td style="width:8%;"><?=(@$presupuestoProgramado+@$costoIndirectoProgramado!=0 ? number_format((100*(@$presupuestoAnterior+@$costoIndirectoAnterior))/(@$presupuestoProgramado+@$costoIndirectoProgramado), 2, '.', ',')  :'')?>%</td>
							<td style="width:10%;"><?=number_format(@$presupuestoActual+@$costoIndirectoActual, 2, '.', ',')?></td>
							<td style="width:8%;"><?=(@$presupuestoProgramado+@$costoIndirectoProgramado!=0 ? number_format((100*(@$presupuestoActual+@$costoIndirectoActual))/(@$presupuestoProgramado+@$costoIndirectoProgramado), 2, '.', ',')  :'')?>%</td>
							<td style="width:10%;"><?=number_format(@$presupuestoAnterior+@$costoIndirectoAnterior+@$presupuestoActual+@$costoIndirectoActual, 2, '.', ',')?></td>
							<td style="width:8%;"><?=(@$presupuestoProgramado+@$costoIndirectoProgramado!=0 ? number_format((100*(@$presupuestoAnterior+@$costoIndirectoAnterior+@$presupuestoActual+@$costoIndirectoActual))/(@$presupuestoProgramado+@$costoIndirectoProgramado), 2, '.', ',')  :'')?>%</td>
							<td style="width:10%;"><?=number_format((@$presupuestoProgramado+@$costoIndirectoProgramado)-(@$presupuestoAnterior+@$costoIndirectoAnterior+@$presupuestoActual+@$costoIndirectoActual), 2, '.', ',')?></td>
							<td style="width:8%;"><?=(@$presupuestoProgramado+@$costoIndirectoProgramado!=0 ? number_format((100*((@$presupuestoProgramado+@$costoIndirectoProgramado)-(@$presupuestoAnterior+@$costoIndirectoAnterior+@$presupuestoActual+@$costoIndirectoActual)))/(@$presupuestoProgramado+@$costoIndirectoProgramado), 2, '.', ',') :'')?>%</td>
						</tr>
						<tr>
							<th>EJECUTADO</th>
							<td><?=number_format(@$montoasignado, 2, '.', ',')?></td>
							<td><?=number_format(@$financieroAnterior[0]->devengado, 2, '.', ',')?></td>
							<td><?=(@$montoasignado!=0 ? number_format((100*@$financieroAnterior[0]->devengado)/@$montoasignado, 2, '.', ',') :'')?>%</td>
							<td><?=number_format(@$financieroActual[0]->devengado, 2, '.', ',')?></td>
							<td><?=(@$montoasignado!=0 ?number_format((100*@$financieroActual[0]->devengado)/@$montoasignado, 2, '.', ',') :'')?>%</td>
							<td><?=number_format(@$financieroActual[0]->devengado+@$financieroAnterior[0]->devengado, 2, '.', ',')?></td>
							<td><?=(@$montoasignado!=0 ?number_format((100*(@$financieroActual[0]->devengado+@$financieroAnterior[0]->devengado))/@$montoasignado, 2, '.', ',') :'')?>%</td>
							<td><?=number_format(@$montoasignado-(@$financieroActual[0]->devengado+@$financieroAnterior[0]->devengado), 2, '.', ',')?></td>
							<td><?=(@$montoasignado!=0 ?number_format((100*(@$montoasignado-(@$financieroActual[0]->devengado+@$financieroAnterior[0]->devengado)))/@$montoasignado, 2, '.', ',') :'')?>%</td>
						</tr>
					</table>
				</div>					
			</div>
		</div>

	</div>	
	</form>
</div> 
