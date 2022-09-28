<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
					</div>
							<div id="myTabContent" class="tab-content">
								<div class="row">  
									<div class="col-md-12 col-sm-12 col-xs-12">	
										<div class="x_content">
											<table id="table-ResponsableExpediente"  class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
												<thead>
													<tr>
														<td><b>1. Unidad ejecutora</b></td>
														<td>GESPRO - UE</td>		
													</tr>
													<tr>
														<td>1.1. Dirección</td>
														<td><?=$detalleExpediente->direccion_ue;?>  </td>		
													</tr>
													<tr>
														<td>1.2. Distrito/Provincia/Departamento</td>
														<td><?=$detalleExpediente->distrito_provincia_departamento_ue;?></td>		
													</tr>
													<tr>
														<td>1.3. Teléfono</td>
														<td><?=$detalleExpediente->telefono_ue;?></td>		
													</tr>
													<tr>
														<td>1.4. RUC</td>
														<td><?=$detalleExpediente->ruc_ue;?></td>		
													</tr>
													<tr>
														<td><b>2. Nombre del Proyecto</b></td>
														<td><?=$detalleExpediente->nombre_pi;?></td>		
													</tr>
													<tr>
														<td>2.1. Ubicación distrital donde se plantea su ejecución</td>
														<td><?=$detalleExpediente->provincia;?></td>		
													</tr>
													<tr>
														<td>2.2. Codigo único</td>
														<td><?=$detalleExpediente->codigo_unico_pi;?></td>		
													</tr>
													<tr>
														<td><b>3. Costo Total Proyecto(Pre Invesión)</b></td>
														<td>S/. <?=a_number_format($detalleExpediente->costo_total_preinv_et, 2, '.',",",3);?></td>		
													</tr>
													<tr>
														<td>3.1. Costo Directo</td>
														<td>S/. <?=a_number_format($detalleExpediente->costo_directo_preinv_et,2,'.',",",3);?></td>		
													</tr>
													<tr>
														<td>3.2. Costo Indirecto</td>
														<td>S/. <?=a_number_format($detalleExpediente->costo_indirecto_preinv_et,2,'.',",",3);?></td>		
													</tr>
													<tr>
														<td><b>4. Costo Total Proyecto(Invesión)</b></td>
														<td>S/. <?=a_number_format($detalleExpediente->costo_total_inv_et,2,'.',",",3);?></td>		
													</tr>
													<tr>
														<td>4.1. Costo Directo</td>
														<td></td>		
													</tr>
													<tr>
														<td>4.2. Gasto General</td>
														<td>S/. <?=a_number_format($detalleExpediente->gastos_generales_et,2,'.',",",3);?></td>	
													</tr>
													<tr>
														<td>4.3. Gasto de Supervisión</td>
														<td>S/. <?=a_number_format($detalleExpediente->gastos_supervision_et,2,'.',",",3);?></td>		
													</tr>
													<tr>
														<td><b>5. Función Programática</b></td>
														<td></td>		
													</tr>
													<tr>
														<td>5.1. Función</td>
														<td><?=$detalleExpediente->funcion_et;?></td>		
													</tr>
													<tr>
														<td>5.2. Programa</td>
														<td><?=$detalleExpediente->programa_et;?></td>		
													</tr>
													<tr>
														<td>5.3. Sub programa</td>
														<td><?=$detalleExpediente->sub_programa_et;?></td>		
													</tr>
													<tr>
														<td>5.4. Proyecto</td>
														<td><?=$detalleExpediente->proyecto_et;?></td>		
													</tr>
													<tr>
														<td>5.5. Componente</td>
														<td><?=$detalleExpediente->componente_et;?></td>		
													</tr>
													<tr>
														<td>5.6. Meta</td>
														<td><?=$detalleExpediente->meta_et;?></td>		
													</tr>
													<tr>
														<td>5.7. Fuente de financiamiento</td>
														<td><?=$detalleExpediente->fuente_financiamiento_et;?></td>		
													</tr>
													<tr>
														<td>5.8. Modalidad de ejecución</td>
														<td><?=$detalleExpediente->modalidad_ejecucion_et;?></td>		
													</tr>
													<tr>
														<td><b>6. Plazo de ejecución</b></td>
														<td><?=$detalleExpediente->tiempo_ejecucion_pi_et;?></td>		
													</tr>
													<tr>
														<td><b>7. Número de beneficiarios</b> </td>
														<td><?=a_number_format($detalleExpediente->num_beneficiarios_indirectos,0,'.',",",3);?></td>		
													</tr>
													
												</thead>
												<tbody>
												
												</tbody>
											</table>
										</div>
									</div>
								</div>
										<!-- / fin tabla de sector desde el row -->
							</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<script>

</script>