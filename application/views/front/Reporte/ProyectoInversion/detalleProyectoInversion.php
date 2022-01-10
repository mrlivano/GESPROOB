<script src="<?php echo base_url(); ?>assets/vendors/echarts/dist/echarts-all-3.js"></script>
<style>
	.modal-dialog
	{
		width: 90%;
		margin: 0;
		margin-left: 5%;
		padding: 0;
	}

	.modal-content
	{
		height: auto;
		min-height: 100%;
		border-radius: 0;
	}
</style>

<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
					
							<div id="myTabContent" class="tab-content">
								<!-- /Contenido del sector -->
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Sector" aria-labelledby="home-tab">
									<!-- /tabla de sector desde el row -->
																		<br>
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="table-responsive">
											<table id="table-DetalleMensualizado"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
												<tbody>
													<?php foreach($dataDetalle as $item ){ ?>
													  	<tbody>
													  		<tr>
													  			<th>Código único de inversiones</th>
													  			<td><?= $item->act_proy?></td>
													  			<th style="width:170px;">Año</th>
													  			<td><?=$item->ano_eje?></td>
												  			</tr>
												  			<tr>
													  			<th>Código SNIP</th>
													  			<td>
													  				<?=$item->proyecto_snip?>
													  			</td>
													  			<th>Estado</th>
													  			<td><?= $res = ($item->estado == 'A') ? "Activo" : "Inactivo";?></td>
													  		</tr>
													  		<tr>
													  			<th>Meta</th>
													  			<td><?=$item->sec_func?></td>
													  			<th>-----</th><td>-----</td>
													  		</tr>
													  		<tr>
													  			<th>Nombre PIP</th>
													  			<td colspan="3"><?=$item->nombre?></td>
													  		</tr>
													  		<tr>
													  			<th>Cadena Funcional</th>
													  			<td colspan="3"><?=$item->funcion." - ".$item->programa." - ".$item->sub_programa?> </td>
													  		</tr>
													  		<tr>
													  			<th>Costo Actual</th>
													  			<td class="alt"><?=$item->costo_actual?></td>
													  			<th>Costo Expediente</th>
													  			<td class="alt"><?=$item->costo_expediente?></td>
													  		</tr>
													  		<tr>
													  			<th>Costo Viabilidad</th>
													  			<td class="alt"><?=$item->costo_viabilidad?></td>
													  			<th>Costo Año Anterior</th>
													  			<td class="alt"><?=$item->ejecucion_ano_anterior?></td>
													  		</tr>
													  		<tr>
													  			<th>Programa Presupuestal</th>
													  			<td><?=$item->programa_ppto?></td>
													  			<th>Tipo de Programa Presupuestal</th>
													  			<td><?=$item->tipo_programa_ppto?></td>
													  		</tr>
													  		<tr>
													  			<th>Region</th>
													  			<td colspan="3"><?=$item->departamento?></td>
													  		</tr>
													  		<tr>
													  			<th>Provincia</th>
													  			<td colspan="3"><?=$item->provincia?></td>
													  		</tr>
													  		<tr>
													  			<th>Distrito</th>
													  			<td colspan="3"><?=$item->distrito?></td>
													  		</tr>
													  	</tbody>
													<?php } ?>
												</tbody>
											
											</table>
											<div class="table-responsive">
										</div>
									
									</div>
										<!-- / fin tabla de sector desde el row -->

								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		<div class="clearfix"></div>
	</div>
</div>