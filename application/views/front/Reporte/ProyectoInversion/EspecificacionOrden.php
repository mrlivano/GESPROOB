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
	<div>
		<div class="clearfix"></div>
		<div class="x_panel">
			<div class="x_content">
				<div class="row"> 
					<div class="table-responsive" >
						<table id="table-DetallePorCadaOrden"  class="table table-striped table-bordered" cellspacing="0" width="100%;">
							<thead>
								<tr>
									<td>Fecha de Registro</td>
									<td>Item</td>
									<td>U. Medida</td>
									<td>Especificaciones</td>
									<td>Cantidad</td>
									<td>Precio Unitario</td>
									<td>Precio Total</td>
								</tr>
							</thead>
							<tbody>
									<?php foreach($EspecificacionOrden as $item ){ ?>
									<tr>													    	
										<td style="width:5%;"><?=($item->FECHA_REG!='' ? date('d/m/Y H:i',strtotime($item->FECHA_REG)) : '')?></td>	
										<td style="width:15%;"><?=trim($item->NOMBRE_ITEM)?></td>
										<td style="width:5%;"><?=trim($item->ABREVIATURA)?></td>			
										<td style="width:60%;"><?=trim($item->ESPECIFICACIONES)?></td>
										<td style="width:5%;"><?=trim(number_format($item->CANT_ITEM,2))?></td>
										<td style="width:5%;"><?=trim(number_format($item->PREC_UNIT_MONEDA,2))?></td>
										<td style="width:5%;"><?=trim(number_format($item->PREC_TOT_MONEDA,2))?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
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
		var tableDetallePorCadaOrden=$('#table-DetallePorCadaOrden').DataTable(
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
					orientation:'landscape',
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