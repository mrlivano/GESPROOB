
<script src="<?php echo base_url(); ?>assets/js/administrador/DivisionFuncional.js"></script>

<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>CONSULTA DE PIP</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Sector"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b>Parámetro de Busqueda Especifica por Cadena Funcional</b>
									</a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Sector" aria-labelledby="home-tab">
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="x_panel">
													<div class="x_content">
														<br>
														<div class="row">
															<div class="form-group">
										                       <label class="control-label col-md-2 col-sm-2 col-xs-12">Función: </label>
										                       <div class="col-md-4 col-sm-4 col-xs-12">
									                                <select id="listaFuncion" name="listaFuncion" class="selectpicker" data-live-search="true"  title="Seleccionar Función" onchange="">
									                                 </select>
									                            </div>
										                    </div>
										                    <div class="form-group">
										                        <label class="control-label col-md-2 col-sm-2 col-xs-12">División Funcional: </label>
										                        <div class="col-md-4 col-sm-4 col-xs-12">
										                          <select id="listaDivisionFuncional" name="listaDivisionFuncional" class="selectpicker" data-live-search="true"  title="Seleccionar División Funcional">
									                              </select>
										                        </div>
										                    </div>
									                    </div> 
									                    <div class="row">
															<div class="form-group">
										                       <label class="control-label col-md-2 col-sm-2 col-xs-12">Grupo Funcional: </label>
										                        <div class="col-md-4 col-sm-4 col-xs-12">
										                          <select id="listaGrupoFuncional" name="listaGrupoFuncional" class="selectpicker" data-live-search="true"  title="Seleccionar Grupo Funcional">
									                              </select>
										                        </div>
										                    </div>
										                    <div class="form-group">
										                       <label class="control-label col-md-2 col-sm-2 col-xs-12">Provincia: </label>
										                        <div class="col-md-4 col-sm-4 col-xs-12">
										                          <select id="listaProvincia" name="listaProvincia" class="selectpicker" data-live-search="true"  title="Seleccionar Provincia">
									                              </select>
										                        </div>
										                    </div>
									                    </div> 
									                    <div class="row">
										                    <div class="form-group">
										                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Distrito: </label>
										                        <div class="col-md-4 col-sm-4 col-xs-12">
										                          <select id="listaDistrito" name="listaDistrito" class="selectpicker" data-live-search="true"  title="Seleccionar Distrito">
									                              </select>
										                        </div>
										                    </div>
									                    </div> 
									                    <br>
									                    <div class="row">
															<div class="form-group">
										                        <label class="control-label col-md-2 col-sm-2 col-xs-12">De:</label>
										                        <div class="col-md-4 col-sm-4 col-xs-12">
										                          <input type="date" class="form-control" placeholder="Default Input" id="deFecha">
										                        </div>
										                    </div>
										                    <div class="form-group">
										                        <label class="control-label col-md-2 col-sm-2 col-xs-12">A:</label>
										                        <div class="col-md-4 col-sm-4 col-xs-12">
										                          <input type="date" class="form-control" placeholder="Default Input" id="aFecha">
										                        </div>
										                    </div>
									                    </div>

									                    <div class="row">
									                    	<div class="form-group">
										                        <div class="col-md-3 col-sm-3 col-xs-12">
										                          <button type="button" class="btn btn-primary" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
										                        </div>
										                    </div>									                    	
									                    </div><br>

									                    <script type="text/javascript" src="jquery.js"></script>
															<script type="text/javascript">
															$(document).ready(function(){
															  $("#hide").click(function(){
															    $("#dataTableFuncion").hide();
															  });
															  $("#btnBuscar").click(function(){
															    $("#dataTableFuncion").show();
															  });
															});
															</script>

															<!--<a href="#" id="show">Mostrar</a> -->
									                   
									                    <div id="dataTableFuncion" style="display:none;">
										                    <table id="dynamic-table"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<td>Código</td>
																		<td>Proyecto</td>
																		<td>Función</td>
																		<td>División Funcional</td>
																		<td>Grupo Funcional</td>
																		<td>Número de Beneficiarios</td>
																		<td>Costo</td>
																	</tr>
																</thead>
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
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<script>

$(document).ready(function()
	{
		var myTable=$('#dynamic-table').DataTable(
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
<script>
	$(document).ready(function() {
	 	$('.selectpicker').selectpicker({
		  });
		});
</script>
