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
		<p>FORMATO FE-02 <br>INFORME MENSUAL<br>MES : <?=@$fechaReporte?></p>
	</div>
	<form id="frmFichaInforme">
	<div class="cuerpo">
		<table class="tablastand tablaMayuscula">
			<tr>
				<th>NOMBRE DEL PROYECTO</th>
				<td style="width:80%;"><?=@$proyectoInversion->nombre_pi?></td>
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
				<p class="firsttext">I. GENERALIDADES<p>
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
							<tr>
								<th>COMPONENTE</th>
								<td><?=@$proyectoInversion->componente_et?></td>
							</tr>
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
		<div class="firstbox">
			<div class="firstcontent">
				<p class="firsttext">II. EJECUCIÓN DE OBRA<p>
			</div>			
			<div class="secondbox">
				<div class="secondcontent">
					<p class="secondtext">2.1.- PLAZO DE EJECUCIÓN</p>
					<table class="tablastand tablacenter">
						<tr>
							<th>Fecha de Entrega de Terreno</th>
							<th>Fecha de Inicio de Obra</th>
							<th>Fecha de Termino Programada Original</th>
							<th>Fecha de Termino Real</th>
						</tr>
						<tr>
							<td style="width:25%;"></td>
							<td style="width:25%;"><?=date('d/m/Y',strtotime(@$plazoPogramado[0]->fecha_inicio))?></td>
							<td style="width:25%;"><?=date('d/m/Y',strtotime(@$plazoPogramado[0]->fecha_fin))?></td>
							<td style="width:25%;">								
							</td>
						</tr>
					</table>
					<br>
					<div style="page-break-after:always;"></div>
					<table class="tablastand">
						<tr>
							<th style="width:25%;">Plazo de Ejec. Programado Original</th>
							<td colspan="5"><?=@$plazoPogramado[0]->num_dias?></td>
						</tr>
						<?php 
						$plazototalAprobado=@$plazoPogramado[0]->num_dias;
						foreach($ampliacionPlazo as $key => $value) { 
						$plazototalAprobado+=$value->num_dias?>
						<tr>
							<th>Ampliación de Plazo Nº <?=$key+1?></th>
							<td><?=$value->num_dias?></td>
							<th>R.G. Nº</th>
							<td><?=$value->numero_resolucion?></td>
							<th>Fecha</th>
							<td><?=date('d/m/Y',strtotime($value->fecha_resolucion))?></td>
						</tr>
						<?php } ?>
						<tr>
							<th>Plazo TOTAL APROBADO</th>
							<td colspan="5"><?=$plazototalAprobado?></td>
						</tr>
						<tr>
							<th>Plazo de Ejec. REAL</th>
							<td colspan="5"><?=@$detalleFormato[0]->plazo_ejecucion_real?></td>
						</tr>
					</table>
					<br>
					<p class="secondtext">2.2.- PARTIDAS EJECUTADAS DURANTE EL PERIODO</p>
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
						<p>Eventos u ocurrencias: <?=@$detalleFormato[0]->descripcion_partidas_ejecutadas?></p>
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
					<br>
					<p class="secondtext">2.3.- INFORMACIÓN FÍSICA - FINANCIERA DEL PROYECTO</p>
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
		<div class="firstbox">
			<div class="firstcontent">
				<p class="firsttext">III. CONTROL DE MANO DE OBRA<p>
				<p>RESUMEN MENSUAL DE TRABAJADORES</p>
				<table class="tablastand tablacenter">
					<tr>
						<th colspan="10" style="text-transform:uppercase">MES DE <?=@$fechaReporte?></th>							
					</tr>
					<tr>
						<th rowspan="2">Nº de Semana del mes</th>
						<th colspan="2">Semana</th>
						<th colspan="3">Nº Jornales por semana</th>
						<th colspan="3">Monto Pagado por categoria</th>
						<th rowspan="2">TOTAL</th>
					</tr>
					<tr>
						<th>Del</th>
						<th>Al</th>
						<th>Peón</th>
						<th>Oficial</th>
						<th>Operario</th>
						<th>Peón</th>
						<th>Oficial</th>
						<th>Operario</th>
					</tr>
					<?php
					$montoTotal=0;
					for($i=1; $i<=5; $i++) 
					{?>
						<tr>
							<td><?=$i?></td>
							<td><?=(@$childManoObra[$i-1]->nro_semana==$i ? (@$childManoObra[$i-1]->de_fecha!='' ? date('d/m/Y',strtotime(@$childManoObra[$i-1]->de_fecha)) :'') : '')?></td>
							<td><?=(@$childManoObra[$i-1]->nro_semana==$i ? (@$childManoObra[$i-1]->a_fecha!='' ? date('d/m/Y',strtotime(@$childManoObra[$i-1]->a_fecha)) : '') : '')?></td>
							<td><?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->jornal_peon :'')?></td>
							<td><?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->jornal_oficial :'')?></td>
							<td><?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->jornal_operario :'')?></td>
							<td><?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->monto_peon :'')?></td>
							<td><?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->monto_oficial :'')?></td>
							<td><?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->monto_operario :'')?></td>
							<td>
								<?php 								
								if(@$childManoObra[$i-1]->nro_semana==$i)
								{
									$montoPorSemana=@$childManoObra[$i-1]->monto_peon+@$childManoObra[$i-1]->monto_oficial+@$childManoObra[$i-1]->monto_operario;
									$montoTotal+=$montoPorSemana;
								}
								?>							
								<?=(@$montoPorSemana)?>
							</td>
						</tr>			
					<?php } ?>
					<tr>
						<td colspan="3">Total de jornales del mes</td>
						<td><?=@$sumatoriaManodeObra[0]->totalpeon?></td>
						<td><?=@$sumatoriaManodeObra[0]->totaloficial?></td>
						<td><?=@$sumatoriaManodeObra[0]->totaloperario?></td>
						<td><?=@$sumatoriaManodeObra[0]->montopeon?></td>
						<td><?=@$sumatoriaManodeObra[0]->montooficial?></td>
						<td><?=@$sumatoriaManodeObra[0]->montooperario?></td>
						<td><?=(@$montoTotal)?></td>
					</tr>				
				</table>	
				<br>
				<table class="tablastand tablacenter">
					<tr>
						<th rowspan="2">CONTROL DE MANO DE OBRA</th>
						<th rowspan="2">Presupuesto de Mano Obra S/. </th>
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
						<td style="width:18%;"><?=@$detalleFormato[0]->presupuesto_prog_mo?></td>
						<td style="width:10%;"><?=@$detalleFormato[0]->presupuesto_prog_anterior?></td>
						<td style="width:8%;"><?=(@$detalleFormato[0]->presupuesto_prog_mo!='' && @$detalleFormato[0]->presupuesto_prog_mo!=0 ? ((100*@$detalleFormato[0]->presupuesto_prog_anterior)/@$detalleFormato[0]->presupuesto_prog_mo).'%' :  '')?></td>
						<td style="width:10%;"><?=@$detalleFormato[0]->presupuesto_prog_actual?></td>
						<td style="width:8%;">
							<?=(@$detalleFormato[0]->presupuesto_prog_mo!='' && @$detalleFormato[0]->presupuesto_prog_mo!=0 ? ((100*@$detalleFormato[0]->presupuesto_prog_actual)/@$detalleFormato[0]->presupuesto_prog_mo).'%' :  '')?>						
						</td>
						<td style="width:10%;">
							<?=(@$detalleFormato[0]->presupuesto_prog_anterior+@$detalleFormato[0]->presupuesto_prog_actual)?>
						</td>
						<td style="width:8%;">
							<?=(@$detalleFormato[0]->presupuesto_prog_mo!='' && @$detalleFormato[0]->presupuesto_prog_mo!=0 ? ((100*(@$detalleFormato[0]->presupuesto_prog_anterior+@$detalleFormato[0]->presupuesto_prog_actual))/@$detalleFormato[0]->presupuesto_prog_mo).'%' :  '')?>												
						</td>
						<td style="width:10%;">
							<?=@$detalleFormato[0]->presupuesto_prog_mo-(@$detalleFormato[0]->presupuesto_prog_anterior+@$detalleFormato[0]->presupuesto_prog_actual)?>						
						</td>
						<td style="width:8%;">
							<?=(@$detalleFormato[0]->presupuesto_prog_mo!='' && @$detalleFormato[0]->presupuesto_prog_mo!=0 ? ((100*(@$detalleFormato[0]->presupuesto_prog_mo-(@$detalleFormato[0]->presupuesto_prog_anterior+@$detalleFormato[0]->presupuesto_prog_actual)))/@$detalleFormato[0]->presupuesto_prog_mo).'%' :  '')?>							
						</td>
					</tr>
					<tr>
						<th>EJECUTADO</th>
						<td><?=@$detalleFormato[0]->presupuesto_ejec_mo?></td>
						<td><?=@$detalleFormato[0]->presupuesto_ejec_anterior?></td>
						<td><?=(@$detalleFormato[0]->presupuesto_ejec_mo!='' && @$detalleFormato[0]->presupuesto_ejec_mo!=0 ? ((100*@$detalleFormato[0]->presupuesto_ejec_anterior)/@$detalleFormato[0]->presupuesto_ejec_mo).'%' :  '')?></td>
						<td><?=@$detalleFormato[0]->presupuesto_ejec_actual?></td>
						<td><?=(@$detalleFormato[0]->presupuesto_ejec_mo!='' && @$detalleFormato[0]->presupuesto_ejec_mo!=0 ? ((100*@$detalleFormato[0]->presupuesto_ejec_actual)/@$detalleFormato[0]->presupuesto_ejec_mo).'%' :  '')?></td>
						<td><?=(@$detalleFormato[0]->presupuesto_ejec_anterior+@$detalleFormato[0]->presupuesto_ejec_actual)?></td>
						<td><?=(@$detalleFormato[0]->presupuesto_ejec_mo!='' && @$detalleFormato[0]->presupuesto_ejec_mo!=0 ? ((100*(@$detalleFormato[0]->presupuesto_ejec_anterior+@$detalleFormato[0]->presupuesto_ejec_actual))/@$detalleFormato[0]->presupuesto_ejec_mo).'%' :  '')?></td>
						<td><?=@$detalleFormato[0]->presupuesto_ejec_mo-(@$detalleFormato[0]->presupuesto_ejec_anterior+@$detalleFormato[0]->presupuesto_ejec_actual)?></td>
						<td><?=(@$detalleFormato[0]->presupuesto_ejec_mo!='' && @$detalleFormato[0]->presupuesto_ejec_mo!=0 ? ((100*(@$detalleFormato[0]->presupuesto_ejec_mo-(@$detalleFormato[0]->presupuesto_ejec_anterior+@$detalleFormato[0]->presupuesto_ejec_actual)))/@$detalleFormato[0]->presupuesto_ejec_mo).'%' :  '')?></td>
					</tr>
				</table>
				<br>
				<div class="cuadroContenedor">
					<p><?=@$detalleFormato[0]->descripcion_observaciones?></p>
				</div>
			</div>				
		</div>
		<div class="firstbox">
			<div class="firstcontent">
				<p class="firsttext">IV. PRINCIPALES OCURRENCIAS EN EL MES</p>	
				<div class="cuadroContenedor">
					<p>Observaciones y/o comentarios: <?=@$detalleFormato[0]->descripcion_ocurrencias?></p>
				</div>		
			</div>				
		</div>
		<div class="firstbox">
			<div class="firstcontent">
				<p class="firsttext">V. DOCUMENTACIÓN</p>			
			</div>
			<div class="secondbox">
				<div class="secondcontent">
					<p class="secondtext">5.1.- CUADERNO DE OBRA</p>
					<div style="text-aling:center;">
						<table class="tablastand tablacenter" align="center" style="width:30%;">
							<tr>
								<th colspan="2" style="text-transform:uppercase">MES DE <?=@$fechaReporte?></th>
							</tr>
							<tr>
								<th>Del Folio</th>
								<th>Al folio</th>
							</tr>
							<tr>	
								<td><?=@$detalleFormato[0]->del_folio?></td>
								<td><?=@$detalleFormato[0]->al_folio?></td>
							</tr>
						</table>
					</div>
					<div style="page-break-after:always;"></div>
					<p class="secondtext">5.2.- SECUENCIA FOTOGRÁFICA</p>					
					<?php 
					if(count(@$detalleFormato)>0)
					{ 
						foreach ($detalleFormato[0]->childFotografia as $fotografia) { ?>	
						<div class="cuadroContenedor" style="text-align:center;">
							<div>
								<img style="width:auto;height:300px;" src="./uploads/InformeMensual/<?=$fotografia->id_fotografia?><?=$fotografia->extension?>">
								<!-- <img style="width:100%;" src='<?php echo base_url()."/uploads/InformeMensual/".$fotografia->id_fotografia.$fotografia->extension;?>'> -->
							</div>
							<hr>
							<p><?=$fotografia->descripcion?></p>
						</div>	
						<br>	
						<?php 
						} 
					} ?>								
				</div>	
			</div>				
		</div>
	</div>	
	</form>
</div> 