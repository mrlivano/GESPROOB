<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h6><b>Estudio <?= $MostrarNombreEstudio->nombre_estudio_inv ?></b> </h6>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Sector"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b> Proyectos Entregable</b>
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
													<button type='button'  class="btn btn-primary" onclick="paginaAjaxDialogo(null, 'Agregar Entregable',{id_est_inv : <?= $MostrarNombreEstudio->id_est_inv ?> }, base_url+'index.php/UF_ModuloEntregable/insertar', 'GET', null, null, false, true)">Nuevo</button>
													<div class="x_content" >
                                                        <table id="TableEstudioEntregable" class="table table-striped jambo_table bulk_action" with="100%" >
                                                            <thead style=" ">
                                                               	<tr>
                                                               		<th style="width: 1%">Entregable</th>
                                                                 	<th style="width: 40%"><i class="fa fa-thumb-tack"></i> Fecha Inicio</th>
                                                                 	<th style="width: 5%"> Fecha</th>
                                                                 	<th style="width: 5%"> Valor</th>
                                                                 	<th style="width: 20%"> Avance</th>
                                                                 	<th style="width: 10%"> Acciones</th>	
                                                            	</tr>
                                                           </thead>
                                                          <tbody>
																<?php foreach($listarEntregable as $item ){ ?>
																<tr>
																	<td>
																		<?=$item->desc_entregable?>		
																    </td>

																    <td>
																		<?=$item->fecha_inicio?>
																    </td>

																    <td>
																		<?=$item->fecha_final?>
																    </td>

																    <td>
																		<?=$item->valor?>
																    </td>

																    <td>	
																   		<?=$item->avance_entregbale ?>	
																    </td>

																	<td>
																		<button type='button' data-toggle="tooltip" data-original-title="Personal" class='btn btn-success btn-xs' onclick="paginaAjaxDialogo(null, 'Asignación de especialistas requeridos', { id_est_inv : <?=$item->id_est_inv?> }, base_url+'index.php/UF_Req_Personal_Estudio/insertar', 'GET', null, null, false, true);"><i class="glyphicon glyphicon-user"></i></button>
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
<script>
	$(document).ready(function()
	{
		$('#TableEstudioEntregable').DataTable(
		{
			"language":idioma_espanol
		});
	});
</script>
