<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>REPORTE DE PIP POR DIVISIÓN FUNCIONAL</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Sector"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b> Division funcional</b>
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

													<div class="clearfix">
														<div class="pull-right tableTools-container"></div>
													</div>
													<div class="x_content">
														<table id="table-PipDivision"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
															<thead>
																<tr>
																	<td>División Funcional</td>
																	<td >Número de PIP</td>
																	<td >Costo total</td>

																</tr>
															</thead>
															<tbody>
															<?php foreach($listaPipDivisionFuncional as $item ){ ?>
															  	<tr>
																	<td>
																		<?=$item->nombre_div_funcional?>
															    	</td>
															    	<td>
																		<?=$item->CantidadPip?>
															    	</td>	
															    	<td>
																		S/. <?= a_number_format($item->CostoPip, 2, '.',",",3);?>
															    	</td>
															  </tr>
															<?php } ?>
															</tbody>
														</table>
													</div>
													<div class="col-md-4 col-sm-12 col-xs-12">
														<table id="table-Resumen"  class="table">
																<tr>
																<td colspan="2"><b>CUADRO RESUMEN DE PIP POR DIVISIÓN FUNCIONAL</b></td>
																</tr>
																<tr>
																	<td >Costo total</td>
																	<td>TOTAL PIP</td>
																</tr>
																<tr>
																
																	<td bgcolor="#D1F2EB">S/. <?= a_number_format($listaMontoTotalGrupoDivFunc->CostoPip, 2, '.',",",3);?></td>
																	<td bgcolor="#D1F2EB"><?=$listaMontoTotalGrupoDivFunc->CantidadPip;?></td>
																</tr>
														</table> 
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
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<script>

$(document).ready(function()
	{
		var myTable=$('#table-PipDivision').DataTable(
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
