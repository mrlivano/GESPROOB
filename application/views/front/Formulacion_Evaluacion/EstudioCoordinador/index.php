<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>ESTUDIO DE INVERSIÓN COORDINADOR/FUNCIÓN</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Sector"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b> Estudio</b>
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
													<div class="clearfix">
														<div class="pull-right tableTools-container"></div>
													</div>
													<div class="x_content">
														<table id="table-EstudioCoordinadorFuncion"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
															<thead>
																<tr>
																	<td>Codigo</td>
																	<td>Nombre</td>
																	<td>Costo de inversion</td>
																	<td>Ubicacion</td>
																	<td>Nivel</td>
																	<td>Formulador</td>
																	<td>Avance</td>
																	<td>Situacion</td>
																	<td>Acciones</td>
																</tr>
															</thead>
															<tbody>
															<?php foreach($listarEstudioCoordinadorFuncion as $item ){ ?>
															  	<tr>
																	<td>
																		<?=$item->codigo_unico_pi?>
															    	</td>
															    	<td>
																		<?=$item->nombre_estudio_inv?>
															    	</td>	
																	<td>
																		<?=$item->costo_pi?>
															    	</td>
															    	<td>
																		<?=$item->provincia?>
															    	</td>	
															    	<td>
																		<?=$item->denom_nivel_estudio?>
															    	</td>
															    	<td>
																		
															    	</td>
															    	<td>
																		
															    	</td>
															    	<td>
																		<?=$item->avance?>
															    	</td>
															    	<td>
																		<button type='button' data-toggle="tooltip" data-original-title="Personal" class='btn btn-success btn-xs' onclick="paginaAjaxDialogo(null, 'Asignar formuladores',null, base_url+'index.php/Estudio_Inversion/AsignarFormulador', 'GET', null, null, false, true);"><i class="glyphicon glyphicon-user"></i></button>
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

<script>

$(document).ready(function()
	{
		var myTable=$('#table-EstudioCoordinadorFuncion').DataTable(
		{
			"language":idioma_espanol,
            "searching": true,
             "info":     true,
            "paging":   true,
		});
			
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
			
			})
</script>
