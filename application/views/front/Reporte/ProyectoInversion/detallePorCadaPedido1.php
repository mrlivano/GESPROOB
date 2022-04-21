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
											<div class="table-responsive">
											<table id="DetallePorCadaPedido1"  class="table table-striped table-bordered  table-hover"  width="100%;">
												<thead>
													<tr>
														<td class="col-md-1 col-xs-12">Codigo</td>
														<td width="100%" class="col-md-4 col-xs-12">Descripcion</td>
														<td class="col-md-1 col-xs-12">Unidad</td>
														<td class="col-md-1 col-xs-12">Cant. solicitada</td>
														<td class="col-md-1 col-xs-12">Cant. Aprobada</td>
														<td class="col-md-1 col-xs-12">Cant. Atendida</td>
														<td class="col-md-1 col-xs-12">PAO</td>
														<td class="col-md-1 col-xs-12">Num Orden </td>
														<td class="col-md-1 col-xs-12">Num Pecosa</td>
													</tr>
												</thead>
												<tbody>
														<?php foreach($listadetalleporcadapedido1 as $item ){ ?>
													  	<tr>

													    	<td>
																<?=$item->codigo?>
													    	</td>
													    	<td>
																<?=$item->DESCRIPCION?>
													    	</td>
															<td>
																<?=$item->UNIDAD?>
													    	</td>
															<td>
																<?=a_number_format($item->CANT_SOLICITADA , 2, '.',"",0)?>
													    	</td>
															<td>
																<?=a_number_format($item->CANT_APROBADA , 2, '.',"",0)?>
													    	</td>
													  		<td>
																<?=a_number_format($item->CANT_ATENDIDA , 2, '.',"",0)?>
													    	</td>
															<td>
																<?=$item->NRO_CONS_PAAC?>
													    	</td>
													    	<td>
																<?=$item->NRO_ORDEN?>
													    	</td>
															<td>
																<?=$item->NRO_PECOSA?>
													    	</td>
													  </tr>
													<?php } ?>
												</tbody>
											</table>
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
	var myTable=$('#DetallePorCadaPedido').DataTable(
	{
		"language":idioma_espanol,
		"searching": true,
			"info":     true,
		"paging":   true,
		destroy: true,
	});
})

</script>
