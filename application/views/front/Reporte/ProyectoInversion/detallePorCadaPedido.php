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
											<table id="DetallePorCadaPedido"  class="table table-striped table-bordered  table-hover" cellspacing="0" width="100%;">
												<thead>
													<tr>
														<td>Tipo bien</td>
														<td>Tipo Pedido</td>
														<td>Nro Pedido</td>
														<td>Descripción Item</td>
														<td>Secuencia</td>
														<td>Cant. solicitada</td>
														<td>Cant. Aprobada</td>
														<td>Cant. Atendida</td>
														<td>Precio unitario</td>
														<td>Valor total </td>
														<td>Fecha conformidad</td>
														<td>Fecha cuadro</td>
														<td>Fecha registro</td>
														<td>Fecha pecosa</td>
														<td>Fecha aprobado</td>
														<td>Clasificador</td>
														<td>Nombre Clasificador</td>
													</tr>
												</thead>
												<tbody>
														<?php foreach($listadetalleporcadapedido as $item ){ ?>
													  	<tr>

													    	<td>
																<?=$item->TIPO_BIEN?>
													    	</td>
													    	<td>
																<?=$item->TIPO_PEDIDO?>
													    	</td>
															<td>
																<?=$item->NRO_PEDIDO?>
													    	</td>
															<td>
																<?=$item->NOMBRE_ITEM?>
													    	</td>
													    	<td>
																<?=$item->SECUENCIA?>
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
																<?=a_number_format($item->PRECIO_UNIT , 2, '.',",",3)?>
													    	</td>
															<td>
																<?=a_number_format($item->VALOR_TOTAL , 2, '.',",",3)?>
													    	</td>
													    	<td>
																<?=($item->FECHA_CONFOR!='' ? date('d/m/Y',strtotime($item->FECHA_CONFOR)) : '')?>
													    	</td>
													    	<td>
																<?=($item->FECHA_CUADRO!='' ? date('d/m/Y',strtotime($item->FECHA_CUADRO)) : '')?>
													    	</td>
													    	<td>
																<?=($item->FECHA_REG!='' ? date('d/m/Y',strtotime($item->FECHA_REG)) : '')?>
													    	</td>
													    	<td>
																<?=($item->FECHA_PECOSA!='' ? date('d/m/Y',strtotime($item->FECHA_PECOSA)) : '')?>
													    	</td>
													    	<td>
																<?=($item->FECHA_APROB!='' ? date('d/m/Y',strtotime($item->FECHA_APROB)) : '')?>
													    	</td>
													    	<td>
																<?=$item->CLASIFICADOR?>
													    	</td>
													    	<td>
																<?=$item->NOMBRE_CLASIF?>
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
