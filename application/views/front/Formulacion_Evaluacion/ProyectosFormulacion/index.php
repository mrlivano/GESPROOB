<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>Proyectos en Formulación</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Sector"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b> Proyectos en Formulación</b>
									</a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<!-- /Contenido del sector -->
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Sector" aria-labelledby="home-tab">
									<!-- /tabla de sector desde el row -->
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="x_panel">
													<div class="x_title">                          
														<div class="clearfix"></div>
													</div>
													<div class="x_content" >
                                                        <table id="TableEstudioInversion" class="table table-striped jambo_table bulk_action" with="100%" >
                                                            <thead style=" ">
                                                               	<tr>
                                                               		<th style="width: 1%">Código</th>
                                                                 	<th style="width: 40%"><i class="fa fa-thumb-tack"></i> Nombre</th>
                                                                 	<th style="width: 5%"> Costo</th>
                                                                 	<th style="width: 5%"> Monto</th>
                                                                 	<th style="width: 20%"> Avance</th>
                                                                 	<th style="width: 10%"> Acciones</th>
                                                              </tr>
                                                           </thead>
                                                          <tbody>
																<?php foreach($listarEstudioFormulacionlacionForulador as $item ){ ?>
																<tr>
																	<td>
																		<?=$item->codigo_unico_pi?>		
																    </td>

																    <td>
																		<?=$item->nombre_estudio_inv?>
																    </td>

																    <td>
																		<?=$item->monto_inv?>
																    </td>

																    <td>
																		<?=$item->costo_estudio?>
																    </td>

																    <td>	
																   		<?=$item->avance ?>	
																    </td>


																	<td>
																		<a data-toggle="tooltip" data-original-title="Entregable" href="../FE_Presupuesto_Inv/index/<?=$item->id_est_inv?>"><button type="button" class="btn btn-primary btn-xs"> <i class='ace-icon fa fa-file-text bigger-120'></i></button></a>
																		<button type='button' data-toggle="tooltip" data-original-title="Personal" class='btn btn-success btn-xs' onclick="paginaAjaxDialogo(null, 'Asignación de especialistas requeridos', { id_est_inv : <?=$item->id_est_inv?> }, base_url+'index.php/UF_Req_Personal_Estudio/insertar', 'GET', null, null, false, true);"><i class="glyphicon glyphicon-user"></i></button>
																		<a data-toggle="tooltip" data-original-title="Entregable" href="../UFentregables/inicio/<?=$item->id_est_inv?>"><button type="button" class="btn btn-primary btn-xs"> <i class='ace-icon fa fa-file-text bigger-120'></i></button></a>
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
	<script>swal('','<?=$sessionTempCorrecto?>', "success");</script>
<?php }

if($sessionTempError){ ?>
	<script>swal('','<?=$sessionTempError?>', "error");</script>
<?php } ?>
<script>
	$(document).ready(function()
	{
		$('#TableEstudioInversion').DataTable(
		{
			"language":idioma_espanol
		});
	});
</script>