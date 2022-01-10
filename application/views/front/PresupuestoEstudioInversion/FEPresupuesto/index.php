<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title" style="color: black; ">
						&nbsp;&nbsp;<h5><u>Presupuesto del  Proyecto Inversión:" <?=strtoupper($nombreProyectoInv->nombre_est_inv)?>"</u></h5>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<!--<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab_etapasFE" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"> <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>Presupuesto</a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="#tab_etapasFE" aria-labelledby="home-tab">-->
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<!--<div class="x_panel">-->
												<button type="button" class="btn btn-primary " onclick="paginaAjaxDialogo(null, 'Registro de presupuesto para formulación y evaluación', { idEstInv: '<?=$nombreProyectoInv->id_est_inv?>' }, base_url+'index.php/FE_Presupuesto_Inv/insertar', 'GET', null, null, false, true);"  >
													<span class="fa fa-plus-circle"></span>
													Nuevo
												</button>
											</button>
											<div class="x_title">
												<div class="clearfix"></div>
											</div>
											<div class="x_content">
												<div class="table-responsive">
												<table id="table-Presupuesto" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
													<thead>
														<tr>
															<td>Sector</td>
															<td>Pliego</td>
															<td>Presupuesto</td>
															<td class="col-md-2 col-md-2 col-xs-12"></td>
														</tr>
													</thead>
													<tbody>
														<?php foreach($ListarPresupuesto as $item ){ ?>
															<tr>
																<td>
																<?=$item->nombre_sector?>
																</td>
																<td>
																<?=$item->pliego?>
																</td>
																<td>
																S/.<?=$item->PresupuestoTotal?>
																</td>
																<td>

																  	<button title='Fuentes y Detalle de presupuesto' class='btn btn-success btn-xs' onclick="paginaAjaxDialogo(null, 'ESTUDIO: <?= ($nombreProyectoInv->nombre_est_inv)?>',{ id: '<?=$item->id_presupuesto_fe?>', id_est_inv: '<?=$nombreProyectoInv->id_est_inv?>' }, base_url+'index.php/FE_Presupuesto_Inv/verDetalle', 'GET', null, null, false, true)" ><i class='ace-icon fa fa-eye bigger-120'></i></button>
																	<a type="button" title='Presupuesto para la elaboración del estudio' class="btn btn-info btn-xs" href="<?= site_url('FE_Presupuesto_Inv/reportePdfDetalleGasto?id_pres='.$item->id_presupuesto_fe);?>" target="_blank"><i class='ace-icon fa fa-file-pdf-o bigger-120'></i></a>
																  	<button title='Edición de presupuesto para formulación y evaluación' class='btn btn-primary btn-xs' onclick="paginaAjaxDialogo(null, 'Edición de presupuesto para formulación y evaluación', { idPresupuestoFE : '<?=$item->id_presupuesto_fe?>' }, base_url+'index.php/FE_Presupuesto_Inv/editar', 'POST', null, null, false, true);"><i class='ace-icon fa fa-pencil bigger-120'></i></button>
																  	<button title='Registrar detalle de gastos' class='btn btn-primary btn-xs' onclick="paginaAjaxDialogo(null, 'Registrar detalle de gastos', { idPresupuestoFE : '<?=$item->id_presupuesto_fe?>' }, base_url+'index.php/FE_Detalle_Presupuesto/insertar', 'GET', null, null, false, true);"><i class='ace-icon fa fa-bars bigger-120'></i></button>
																</td>
															</tr>
														<?php } ?>
													</tbody>
													
												</table>
												</div>
											<!--</div>-->
										</div>
									</div>
								<!--</div>
							</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</div>
<script>
	$(document).ready(function()
	{
		$('#table-Presupuesto').DataTable(
		{
			"language" : idioma_espanol
		});
	});
</script>