<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>Estudio de Inversión</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Sector"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b> Estudio de Inversión</b>
									</a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Sector" aria-labelledby="home-tab">
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="x_panel">
												<button type="button" class="btn btn-primary " onclick="paginaAjaxDialogo(null, 'Registrar Estudio de Inversión', null, base_url+'index.php/FEformulacion/insertar', 'GET', null, null, false, true);">
													NUEVO
												</button>
													<div class="x_title">                                                              
											
														<div class="clearfix"></div>
													</div>
													<div class="x_content" >
                                                        <table id="TableEstudioInversion" class="table table-striped jambo_table bulk_action" with="100%" >
                                                            <thead style=" ">
                                                               	<tr>
                                                               		<th style="width: 1%">Código</th>
                                                                 	<th style="width: 40%"><i class="fa fa-thumb-tack"></i> Nombre</th>
                                                                 	<th style="width: 5%"> Función</th>
                                                                 	<th style="width: 5%"> Costo</th>
                                                                 	<th style="width: 5%"> Situación</th>
                                                                 	<th style="width: 5%"> Avance</th>
                                                                 	<th style="width: 20%"><i class="fa fa-users"></i> Coordinador</th>
                                                                 	<th style="width: 19%"> Acciones</th>
                                                              </tr>
                                                           </thead>
                                                           <tbody>
																<?php foreach($ListaEstudio as $item ){ ?>
																<tr>
																	<td>
																		<?=$item->codigo_unico_pi?>		
																    </td>
																    <td>
																		<?=$item->nombre_estudio_inv?>
																    </td>
																    <td>
																    	<?=$item->nombre_funcion?>			
																    </td>
																    <td>
																		<?=$item->costo_estudio?>
																    </td>
																    <td>
																		
																    </td>
																    <td>
																		
																    </td>
																    <td>
																    	<?=$item->coordinador?>				
																    </td>
																	<td>
																	  	<button type='button' class='editar btn btn-primary btn-xs' onclick="paginaAjaxDialogo(null, 'Modificar Modulo',{id:'<?=$item->id_est_inv?>'}, base_url+'index.php/Modulo_FE/editar', 'POST', null, null, false, true)"><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' onclick="EliminarModulo('<?=$item->id_est_inv?>');"><i class='fa fa-trash-o'></i></button>
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