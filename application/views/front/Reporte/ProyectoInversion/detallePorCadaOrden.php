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
						<div class="row">  
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="table-responsive" >
									<table id="table-DetallePorCadaNroOrden"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<td>codigo item</td>
												<td>Bien o Servicio</td>
												<td>Cantidad</td>
												<td>Precio unitario moneda</td>
												<td>Precio total moneda</td>
											</tr>
										</thead>
										<tbody>
												<?php foreach($listaDetallePorCadaOrden as $item ){ ?>
												<tr>
													<td>
														<?=trim($item->CODIGO_ITEM)?>
													</td>
													<td>
														<?=trim($item->NOMBRE_ITEM)?>
													</td>
													<td>
														<?=a_number_format($item->CANT_ITEM , 2, '.',"",0)?>
													</td>
													<td>
														<?=a_number_format($item->PREC_UNIT_MONEDA , 2, '.',",",3)?>
													</td>
													<td>
														<?=a_number_format($item->PREC_TOT_MONEDA , 2, '.',",",3)?>
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
		<div class="clearfix"></div>
	</div>
</div>
<script>

	$(document).ready(function()
	{
		var tableDetallePorCadaNroOrden=$('#table-DetallePorCadaNroOrden').DataTable(
		{
			"language" : idioma_espanol,
			"ordering":  false,
			dom: 'Bfrtip',
			buttons: 
			[
				{
					extend: 'pdf',
					text: "<span><i class='fa fa-file-pdf-o red''></i> PDF</span>",
					className : "btn btn-primary btn-sm",
					title:'Detalle por cada Numero de Orden',
					customize: function(doc) 
					{
						doc.defaultStyle.fontSize = 7;
					} 
				},
				{ 
					extend: 'excel', 
					text: "<span><i class='fa fa-file-excel-o green'></i> EXCEL</span>",
					className : "btn btn-primary btn-sm",
				}
			]
		});
	});

</script>
