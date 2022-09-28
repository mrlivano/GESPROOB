<style>
	.informe
	{
		background-color:#fdfdfd;
		padding: 20px 30px;
		color:black;
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;		
		font-size:10px;
	}
	table
	{
		border-collapse: collapse;
		color:#35353e;
		width:100%;		
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
</style>


<div class="informe">
	<form id="frmFichaInforme"  action="<?php echo base_url();?>index.php/ET_Detalle_Formato/reportePdf" method="POST" target="_blank">
	<input type="hidden" name="hdIdExpedienteTecnico" id="hdIdExpedienteTecnico" value="<?=$idExpedienteTecnico?>">
	<input type="hidden" name="hdMetaPresupuestal" id="hdMetaPresupuestal" value="<?=$metaPresupuestal?>">
	<input type="hidden" name="hdMes" id="hdMes" value="<?=$mes?>">
	<input type="hidden" name="hdFechaReporte" id="hdFechaReporte" value="<?=$fechaReporte?>">
	<input type="hidden" name="hdIdDetalleFormato" id="hdIdDetalleFormato" value="<?=@$detalleFormato[0]->id_detalle?>">			
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
				<td>
					<div>
						<input class="form-control input-sm field" value="<?=(@$detalleFormato[0]->residente=='' ? @$responsableDetalle->residente : @$detalleFormato[0]->residente)?>" name="txtResidente" id="txtResidente" type="text">
					</div>
				</td>
			</tr>
			<tr>
				<th>SUPERVISOR DE PROYECTO</th>
				<td>	
					<div>
						<input class="form-control input-sm field" value="<?=(@$detalleFormato[0]->supervisor=='' ? @$responsableDetalle->supervisor : @$detalleFormato[0]->supervisor)?>" name="txtSupervisor" id="txtSupervisor" type="text">
					</div>
				</td>
			</tr>
			<tr>
				<th>ASISTENTE ADMINISTRATIVO</th>
				<td>
					<div>
						<input class="form-control input-sm field" value="<?=(@$detalleFormato[0]->asistente_administrativo=='' ? @$responsableDetalle->asistente_administrativo : @$detalleFormato[0]->asistente_administrativo)?>" name="txtAsistenteAdministrativo" id="txtAsistenteAdministrativo" type="text">
					</div>
				</td>
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
						<p class="thirdtext">1.1.1.- UBICACIÓN</p>
						<table class="tablastand tablaMayuscula">
							<tr>
								<th>REGIÓN</th>
								<td style="width:80%;">
									<div>
										<input class="form-control input-sm field" value="<?=(@$detalleFormato[0]->region=='' ? @$proyectoInversion->region : @$detalleFormato[0]->region)?>" name="txtRegion" id="txtRegion" type="text">
									</div>
								</td>
							</tr>
							<tr>
								<th>PROVINCIA</th>
								<td>
									<div>
										<input class="form-control input-sm field" value="<?=(@$detalleFormato[0]->provincia=='' ? @$proyectoInversion->provincia : @$detalleFormato[0]->provincia)?>" name="txtProvincia" id="txtProvincia" type="text">
									</div>
								</td>
							</tr>
							<tr>
								<th>DISTRITO</th>
								<td>
									<div>
										<input class="form-control input-sm field" value="<?=(@$detalleFormato[0]->distrito=='' ? @$proyectoInversion->distrito : @$detalleFormato[0]->distrito)?>" name="txtDistrito" id="txtDistrito" type="text">
									</div>
								</td>
							</tr>
							<tr>
								<th>DIRECCIÓN Y/O UBICACIÓN</th>
								<td>
									<div>
										<input class="form-control input-sm field" value="<?=(@$detalleFormato[0]->direccion=='' ? @$proyectoInversion->centroPoblado : @$detalleFormato[0]->direccion)?>" name="txtDireccion" id="txtDireccion" type="text">
									</div>
								</td>
							</tr>
						</table>
						<br>
						<p class="thirdtext">1.1.2.- FUNCIÓN PROGRAMÁTICA</p>
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
								<td><? /*=@$proyectoInversion->componente_et*/?></td>
							</tr>-->
							<tr>
								<th>META</th>
								<td><?=$metaPresupuestal?></td>
							</tr>
							<tr>
								<th>MODALIDAD</th>
								<td>ADMINISTRACIÓN DIRECTA</td>
							</tr>
						</table>
						<br>
						<p class="thirdtext">1.1.3.- ASPECTOS FINANCIEROS</p>
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
				<p class="secondtext">2.1. APROBACIÓN DE EXPEDIENTE TÉCNICO</p>			
				<table class="tablastand tablaMayuscula">
							<tr>
								<th>DOCUMENTO</th>
								<td style="width:80%;">
								<div>
								<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->documento_aprobacion?>" name="txtDocumentoAprobacion" id="txtDocumentoAprobacion" type="text" >
								</div>								
								</td>
							</tr>
							<tr>
								<th>FECHA</th>
								<td>								
								<div>
								<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->fecha_aprobacion?>" name="txtFechaAprobacion" id="txtFechaAprobacion" type="text" >
								</div>	
								</td>
							</tr>
						</table>
			</div>	
				<div class="secondbox">	
				<p class="secondtext">2.2. DESCRIPCION DEL PROYECTO</p>			
				<textarea style="resize: none;resize: vertical;" name="txtDescripcionProyecto" id="txtDescripcionProyecto" class="form-control field" rows="4" cols="50" placeholder="Descripcion del Proyecto."><?=@$detalleFormato[0]->descripcion_proyecto?></textarea>		
				</div>
				<div class="secondbox">	
				<p class="secondtext">2.3. OBJETIVO DEL PROYECTO</p>			
				<textarea style="resize: none;resize: vertical;" name="txtObjetivoProyecto" id="txtObjetivoProyecto" class="form-control field" rows="3" cols="50" placeholder="Objetivo del Proyecto."><?=@$detalleFormato[0]->objetivo_proyecto?></textarea>		
				</div>
				<div class="secondbox">	
				<p class="secondtext">2.4. IMPACTO SOCIAL</p>			
				<textarea style="resize: none;resize: vertical;" name="txtImpactoProyecto" id="txtImpactoProyecto" class="form-control field" rows="4" cols="50" placeholder="Impacto Social."><?=@$detalleFormato[0]->impacto_proyecto?></textarea>		
				</div>	
					
			<div class="secondbox">
				<div class="secondcontent">
					<p class="secondtext">2.5.- PLAZO DE EJECUCIÓN</p>
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
							<td colspan="5">
								<div>
									<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->plazo_ejecucion_real?>" name="txtPlazoEjecReal" id="txtPlazoEjecReal" type="text">
								</div>
							</td>
						</tr>
					</table>
					<br>
					<p class="secondtext">2.6.- PARTIDAS EJECUTADAS DURANTE EL PERIODO</p>
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
					<textarea style="resize: none;resize: vertical;" class="form-control field" name="txtPartidasEjecutadas" id="txtPartidasEjecutadas" rows="3" cols="50" placeholder="Eventos u ocurrencias"><?=@$detalleFormato[0]->descripcion_partidas_ejecutadas?></textarea>
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
					<textarea style="resize: none;resize: vertical;" class="form-control field" name="txtAdicionales" id="txtAdicionales" rows="3" cols="50" placeholder="Información descriptiva de adicionales de obra"><?=@$detalleFormato[0]->descripcion_adicionales?></textarea>
					<br>
					<p class="secondtext">2.7.- INFORMACIÓN FÍSICA - FINANCIERA DEL PROYECTO</p>
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
		<!-- <div class="firstbox">
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
							<td>
								<div>									
									<input class="form-control input-sm field" value="<?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->de_fecha :'')?>" name="txtDeSemana<?=$i?>" id="txtDeSemana<?=$i?>" type="date" max="2050-12-31">
								</div>
							</td>
							<td>
								<div>
									<input class="form-control input-sm field" value="<?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->a_fecha :'')?>"  name="txtASemana<?=$i?>" id="txtASemana<?=$i?>" type="date" max="2050-12-31">
								</div>
							</td>
							<td>
								<div>
									<input class="form-control input-sm field" value="<?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->jornal_peon :'')?>" name="txtJornalPeon<?=$i?>" id="txtJornalPeon<?=$i?>" type="text">
								</div>
							</td>
							<td>
								<div>
									<input class="form-control input-sm field" value="<?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->jornal_oficial :'')?>" name="txtJornalOficial<?=$i?>" id="txtJornalOficial<?=$i?>" type="text">
								</div>
							</td>
							<td>
								<div>
									<input class="form-control input-sm field" value="<?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->jornal_operario :'')?>" name="txtJornalOperario<?=$i?>" id="txtJornalOperario<?=$i?>" type="text">
								</div>
							</td>
							<td>
								<div>
									<input class="form-control input-sm field" value="<?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->monto_peon :'')?>" name="txtMontoPeon<?=$i?>" id="txtMontoPeon<?=$i?>" type="text">
								</div>
							</td>
							<td>
								<div>
									<input class="form-control input-sm field" value="<?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->monto_oficial :'')?>" name="txtMontoOficial<?=$i?>" id="txtMontoOficial<?=$i?>" type="text">
								</div>
							</td>
							<td>
								<div>
									<input class="form-control input-sm field" value="<?=(@$childManoObra[$i-1]->nro_semana==$i ? @$childManoObra[$i-1]->monto_operario :'')?>" name="txtMontoOperario<?=$i?>" id="txtMontoOperario<?=$i?>" type="text">
								</div>
							</td>
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
						<td style="width:18%;">
							<div>
								<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->presupuesto_prog_mo?>" name="txtProgramado" id="txtProgramado" type="text" >
							</div>
						</td>
						<td style="width:10%;">
							<div>
								<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->presupuesto_prog_anterior?>" name="txtProgramadoAnterior" id="txtProgramadoAnterior" type="text" >
							</div>
						</td>
						<td style="width:8%;">
							<?=(@$detalleFormato[0]->presupuesto_prog_mo!='' && @$detalleFormato[0]->presupuesto_prog_mo!=0 ? ((100*@$detalleFormato[0]->presupuesto_prog_anterior)/@$detalleFormato[0]->presupuesto_prog_mo).'%' :  '')?>						
						</td>
						<td style="width:10%;">
							<div>
								<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->presupuesto_prog_actual?>" name="txtProgramadoActual" id="txtProgramadoActual" type="text" >
							</div>
						</td>
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
						<td>
							<div>
								<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->presupuesto_ejec_mo?>" name="txtEjecutado" id="txtEjecutado" type="text" >
							</div>
						</td>
						<td>
							<div>
								<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->presupuesto_ejec_anterior?>" name="txtEjecutadoAnterior" id="txtEjecutadoAnterior" type="text" >
							</div>
						</td>
						<td>
							<?=(@$detalleFormato[0]->presupuesto_ejec_mo!='' && @$detalleFormato[0]->presupuesto_ejec_mo!=0 ? ((100*@$detalleFormato[0]->presupuesto_ejec_anterior)/@$detalleFormato[0]->presupuesto_ejec_mo).'%' :  '')?>
						</td>
						<td>
							<div>
								<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->presupuesto_ejec_actual?>" name="txtEjecutadoActual" id="txtEjecutadoActual" type="text" >
							</div>
						</td>
						<td>
							<?=(@$detalleFormato[0]->presupuesto_ejec_mo!='' && @$detalleFormato[0]->presupuesto_ejec_mo!=0 ? ((100*@$detalleFormato[0]->presupuesto_ejec_actual)/@$detalleFormato[0]->presupuesto_ejec_mo).'%' :  '')?>
						</td>
						<td>
							<?=(@$detalleFormato[0]->presupuesto_ejec_anterior+@$detalleFormato[0]->presupuesto_ejec_actual)?>
						</td>
						<td>
							<?=(@$detalleFormato[0]->presupuesto_ejec_mo!='' && @$detalleFormato[0]->presupuesto_ejec_mo!=0 ? ((100*(@$detalleFormato[0]->presupuesto_ejec_anterior+@$detalleFormato[0]->presupuesto_ejec_actual))/@$detalleFormato[0]->presupuesto_ejec_mo).'%' :  '')?>						
						</td>
						<td>
							<?=@$detalleFormato[0]->presupuesto_ejec_mo-(@$detalleFormato[0]->presupuesto_ejec_anterior+@$detalleFormato[0]->presupuesto_ejec_actual)?>
						</td>
						<td>
							<?=(@$detalleFormato[0]->presupuesto_ejec_mo!='' && @$detalleFormato[0]->presupuesto_ejec_mo!=0 ? ((100*(@$detalleFormato[0]->presupuesto_ejec_mo-(@$detalleFormato[0]->presupuesto_ejec_anterior+@$detalleFormato[0]->presupuesto_ejec_actual)))/@$detalleFormato[0]->presupuesto_ejec_mo).'%' :  '')?>							
						</td>
					</tr>
				</table>
				<br>
				<textarea style="resize: none;resize: vertical;" name="txtObservaciones" id="txtObservaciones" class="form-control field" rows="3" cols="50" placeholder="Observaciones y/o Comentarios"><?=@$detalleFormato[0]->descripcion_observaciones?></textarea>					
			</div>				
		</div> -->
		<!--<div class="firstbox">
			<div class="firstcontent">
				<p class="firsttext">IV. PRINCIPALES OCURRENCIAS EN EL MES</p>				
				<textarea style="resize: none;resize: vertical;" name="txtOcurrencias" id="txtOcurrencias" class="form-control field" rows="10" cols="50" placeholder="Comentarios de las principales ocurrencias respecto a los materiales utilizados, personal, equipo, maquinarias, alcance de las metas previstas."><?=@$detalleFormato[0]->descripcion_ocurrencias?></textarea>		
			</div>				
		</div>-->
		<div class="firstbox">
			<div class="firstcontent">
				<p class="firsttext">IV. CONCLUSIONES Y RECOMENDACIONES</p>	
				<div class="secondbox">	
				<p class="secondtext">4.1. CONCLUSIONES</p>			
				<textarea style="resize: none;resize: vertical;" name="txtConclusiones" id="txtConclusiones" class="form-control field" rows="10" cols="50" placeholder="Conclusiones."><?=@$detalleFormato[0]->conclusiones?></textarea>		
				</div>
				<div class="secondbox">	
				<p class="secondtext">4.2. RECOMENDACIONES</p>			
				<textarea style="resize: none;resize: vertical;" name="txtRecomendaciones" id="txtRecomendaciones" class="form-control field" rows="10" cols="50" placeholder="Recomendaciones."><?=@$detalleFormato[0]->recomendaciones?></textarea>		
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
								<td>
									<div>
										<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->del_folio?>" name="txtDelFolio" id="txtDelFolio" type="text">
									</div>
								</td>
								<td>
									<div>
										<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->al_folio?>" name="txtAlFolio" id="txtAlFolio" type="text">									
									</div>
								</td>
							</tr>
							<tr>
								<th>Asiento</th>
								<th>Asiento</th>
							</tr>
							<tr>	
								<td>
									<div>
										<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->del_asiento?>" name="txtDelAsiento" id="txtDelAsiento" type="text">
									</div>
								</td>
								<td>
									<div>
										<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->al_asiento?>" name="txtAlAsiento" id="txtAlAsiento" type="text">									
									</div>
								</td>
							</tr>
						</table>
					</div>
					<br>
					<p class="secondtext">5.2.- SECUENCIA FOTOGRÁFICA</p>					
					<input type="button" class="btn btn-info" value="Agregar Fotografia" onclick="agregarFotografia('<?=@$detalleFormato[0]->id_detalle?>');">
					<input type="button" class="btn btn-warning" value="Exportar a PDF" onclick="exportarFicha();">	
				</div>	
			</div>				
		</div>
	</div>
	<hr>
	<div style="float:right;">       
		<input style="width:100%;" type="button" class="btn btn-primary" value="Guardar Informe" onclick="guardarInformeMensual();">
	</div>	
	</form>
</div> 
<script>
	
	$(function()
	{
		$('input').attr('autocomplete', 'off');		
	});

    function guardarInformeMensual()
    {
		// if($('#txtProgramado').val().trim()==''){
		// 	swal('','El campo "Programado es requerido ".','error');
		// 	$('#txtProgramado').focus();
		// 	return;
		// }
		// else if($('#txtProgramadoAnterior').val().trim()==''){
		// 	swal('','El campo "Programado Anterior es requerido ".','error');
		// 	$('#txtProgramadoAnterior').focus();
		// 	return;
		// }
		// else if($('#txtProgramadoActual').val().trim()==''){
		// 	swal('','El campo "Programado Actual es requerido ".','error');
		// 	$('#txtProgramadoActual').focus();
		// 	return;
		// }
		// else if($('#txtEjecutado').val().trim()==''){
		// 	swal('','El campo "Ejecutado es requerido ".','error');
		// 	$('#txtEjecutado').focus();
		// 	return;
		// }
		// else if($('#txtEjecutadoAnterior').val().trim()==''){
		// 	swal('','El campo "Ejecutado Anterior es requerido ".','error');
		// 	$('#txtEjecutadoAnterior').focus();
		// 	return;
		// }
		// else if($('#txtEjecutadoActual').val().trim()==''){
		// 	swal('','El campo "Ejecutado Actual es requerido ".','error');
		// 	$('#txtEjecutadoActual').focus();
		// 	return;
		// }




		var formulario = $('#frmFichaInforme');
		$.ajax({
            type:"POST",
            url:base_url+"index.php/ET_Detalle_Formato/guardarDetalleFormato",
            data: formulario.serialize(),
            cache: false,
            beforeSend:function() 
			{
            	renderLoading();
		    },
            success:function(objectJSON)
            {
				objectJSON=JSON.parse(objectJSON);
				swal('',objectJSON.mensaje,(objectJSON.proceso=='Correcto' ? 'success' : 'error'));
				$('#divModalCargaAjax').hide();
			},
			error:function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
        });
    }

	function agregarFotografia(detalleFormato)
	{
		if(detalleFormato.trim()=='')
		{
			swal('', 'Tiene que guardar el informe para poder agregar fotografias','error');
			return;
		}
		paginaAjaxDialogo(null, 'Agregar Fotografia',{ idDetalleFormato: detalleFormato}, base_url+'index.php/ET_Detalle_Formato/guardarFotografia', 'GET', null, null, false, true);
	}

	function exportarFicha()
	{
		$('#frmFichaInforme').submit();
	}
</script>
