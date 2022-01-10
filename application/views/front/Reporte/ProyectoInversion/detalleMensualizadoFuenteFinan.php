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
									
									<div class="row">
						                <div class="col-md-12 col-sm-12 col-xs-12">
										
					                        <div class="tabla-responsive">
					                        	<table id="table-DatoGenerales"  class="table-hover" cellspacing="0" width="100%">
													<body>
														
														<tr>
															<td>AÑO: <?=$listaDetalleMensualizadoFuenteFinanDatosG->ano_eje;?>  </td>
														</tr>
														<tr>
															<td>CORRELATIVO META: <?=$listaDetalleMensualizadoFuenteFinanDatosG->meta;?>  </td>
														</tr>
														<tr>
															<td>NOMBRE DEL PROYECTO: <?=$listaDetalleMensualizadoFuenteFinanDatosG->nombre;?>  </td>
														</tr>
														<tr>
															<td>FINALIDAD: <?=$listaDetalleMensualizadoFuenteFinanDatosG->nombre_finalidad;?>  </td>
														</tr>
													</body>
												</table>

					                        </div>

						                </div>
						        	</div>
									<br>
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="table-responsive">
												<table id="table-DetalleMensualizado"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
													<thead>
														<tr>
											
															<td>Fuente Financiamiento</td>
															<td style="text-align:right">Pia</td>
															<td style="text-align:right">Pim</td>
															<td style="text-align:right">Pim Acumulado</td>
															<td style="text-align:right">Monto Finan 1</td>
															<td style="text-align:right">Monto Finan 2</td>
															<td style="text-align:right">Ejecución</td>
															<td style="text-align:right">Certificado</td>
															<td style="text-align:right">Compromiso</td>
															<td style="text-align:right">Devengado</td>
															<td style="text-align:right">Girado</td>
															<td style="text-align:right">Pagado</td>
															<td style="text-align:right">Ampliación</td>
															<td style="text-align:right">Crédito</td>
															
														</tr>
													</thead>
													<tbody>
														<?php foreach($listaDetalleMensualizadoFuenteFinan as $item ){ ?>
															<tr>

																<td>
																	<?=$item->fuente_financ?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->pia, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->pim, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->pim_acumulado, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->monto_financ1, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->monto_financ2, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->ejecucion, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->monto_certificado, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->compromiso, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->devengado, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->girado, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->pagado, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->ampliacion, 2, '.',",",3)?>
																</td>
																<td style="text-align:right">
																	<?=a_number_format($item->credito, 2, '.',",",3)?>
																</td>
																
														</tr>
														<?php } ?>
													</tbody>
												
												</table>
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
		<div class="clearfix"></div>
	</div>
</div>