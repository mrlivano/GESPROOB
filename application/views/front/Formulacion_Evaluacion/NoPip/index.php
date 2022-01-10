<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>NO PIP</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
							<div id="myTabContent" class="tab-content">
								<!-- /Contenido del sector -->
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Sector" aria-labelledby="home-tab">
									<!-- /tabla de sector desde el row -->
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="x_panel">
												<button type="button" class="btn btn-primary " onclick="paginaAjaxDialogo(null, 'Formulacion y Evaluacion: Registrar no pip', null, base_url+'index.php/NoPipProgramados/insertar', 'GET', null, null, false, true);">
													NUEVO
												</button>
													<div class="x_title">                                                              
											
														<div class="clearfix"></div>
													</div>
													<div class="x_content">
														<div class="table-responsive">
														<table id="table-Nopip"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
															<thead>
																<tr>
																	<td>Código Único</td>
																	<td>Nombre NO Pip</td>
																	<td>Tipo No Pip</td>
																	<td class="col-md-1 col-md-1 col-xs-12">ACCIONES</td>
																</tr>
															</thead>
															<tbody>
															<?php foreach($listarnopipFormulacion as $item ){ ?>
															  	<tr>
																	<td>
																		<?=$item->codigo_unico_pi?>
															    	</td>
																	<td>
																  		<?=$item->nombre_est_inv?>
																	</td>
																	<td>
																  		<?=$item->desc_tipo_nopip?>
																	</td>
																	<td>
																  	<button type='button' class='editar btn btn-primary btn-xs' onclick="paginaAjaxDialogo(null, 'Modificar No Pip',{ id: '<?=$item->id_est_inv?>' }, base_url+'index.php/NoPipProgramados/editar', 'GET', null, null, false, true);"><i class='ace-icon fa fa-pencil bigger-120'></i></button>

																</td>
																	</td>
															  </tr>
															<?php } ?>
															</tbody>
														</table>
														</div>
													</div>
											</div>
										</div>
									</div>
										<!-- / fin tabla de sector desde el row -->
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<?php
$sessionTempCorrecto=$this->session->flashdata('correcto');
$sessionTempError=$this->session->flashdata('error');

if($sessionTempCorrecto){ ?>
	<script>
	$(document).ready(function()
	{
		swal('','<?=$sessionTempCorrecto?>', "success");
	});
	</script>
<?php }

if($sessionTempError){ ?>
	<script>
	$(document).ready(function()
	{
	swal('','<?=$sessionTempError?>', "error");
	});
	</script>
<?php } ?>

<script>
	$(document).ready(function()
	{
		$('#table-Nopip').DataTable(
		{
			"language":idioma_espanol
		});
	});

</script>